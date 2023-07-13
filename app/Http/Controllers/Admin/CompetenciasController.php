<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyCompetenciumRequest;
use App\Http\Requests\StoreCompetenciumRequest;
use App\Http\Requests\UpdateCompetenciumRequest;
use App\Models\Area;
use App\Models\CertificacionesEmpleados;
use App\Models\Competencium;
use App\Models\CursosDiplomasEmpleados;
use App\Models\Empleado;
use App\Models\EvidenciasDocumentosEmpleados;
use App\Models\Language;
use App\Models\ListaDocumentoEmpleado;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompetenciasController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('competencias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Competencium::with(['nombrecolaborador', 'team'])->select(sprintf('%s.*', (new Competencium)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'competencias_show';
                $editGate = 'competencias_editar';
                $deleteGate = 'competencias_eliminar';
                $crudRoutePart = 'competencia';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->addColumn('nombrecolaborador_name', function ($row) {
                return $row->nombrecolaborador ? $row->nombrecolaborador->name : '';
            });

            $table->editColumn('perfilpuesto', function ($row) {
                return $row->perfilpuesto ? $row->perfilpuesto : '';
            });
            $table->editColumn('certificados', function ($row) {
                if (!$row->certificados) {
                    return '';
                }

                $links = [];

                foreach ($row->certificados as $media) {
                    $links[] = '<a href="' . $media->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>';
                }

                return implode(', ', $links);
            });

            $table->rawColumns(['actions', 'placeholder', 'nombrecolaborador', 'certificados']);

            return $table->make(true);
        }

        $users = User::getAll();
        $teams = Team::get();

        return view('admin.competencia.index', compact('users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('competencias_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrecolaboradors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.competencia.create', compact('nombrecolaboradors'));
    }

    public function store(StoreCompetenciumRequest $request)
    {
        abort_if(Gate::denies('competencias_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competencium = Competencium::create($request->all());

        foreach ($request->input('certificados', []) as $file) {
            $competencium->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificados');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $competencium->id]);
        }

        return redirect()->route('admin.competencia.index')->with('success', 'Guardado con éxito');
    }

    public function edit(Competencium $competencium)
    {
        abort_if(Gate::denies('competencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrecolaboradors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $competencium->load('nombrecolaborador', 'team');

        return view('admin.competencia.edit', compact('nombrecolaboradors', 'competencium'));
    }

    public function update(UpdateCompetenciumRequest $request, Competencium $competencium)
    {
        abort_if(Gate::denies('competencias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competencium->update($request->all());

        if (count($competencium->certificados) > 0) {
            foreach ($competencium->certificados as $media) {
                if (!in_array($media->file_name, $request->input('certificados', []))) {
                    $media->delete();
                }
            }
        }

        $media = $competencium->certificados->pluck('file_name')->toArray();

        foreach ($request->input('certificados', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $competencium->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificados');
            }
        }

        return redirect()->route('admin.competencia.index')->with('success', 'Editado con éxito');
    }

    public function show(Competencium $competencium)
    {
        abort_if(Gate::denies('competencias_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competencium->load('nombrecolaborador', 'team');

        return view('admin.competencia.show', compact('competencium'));
    }

    public function destroy(Competencium $competencium)
    {
        abort_if(Gate::denies('competencias_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $competencium->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyCompetenciumRequest $request)
    {
        Competencium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
//        abort_if(Gate::denies('competencium_create') && Gate::denies('competencium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Competencium();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }

    public function buscarcv(Request $request)
    {
        $areas = Area::get();

        return view('admin.competencia.buscarCV', compact('areas'));
    }

    public function expedientesProfesionales(Request $request)
    {
        abort_if(Gate::denies('perfiles_profesionales_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $areas = Area::get();

        return view('admin.competencia.expedientes', compact('areas'));
    }

    public function miCurriculum(Request $request, Empleado $empleado)
    {
        $empleado->load('idiomas');
        // dd($empleado);
        abort_if(Gate::denies('mi_perfil_mis_datos_ver_perfil_profesional'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $lista_docs = ListaDocumentoEmpleado::get();

        return view('admin.competencia.mi-cv', compact('empleado', 'lista_docs'));
    }

    public function editarCompetencias(Empleado $empleado)
    {
        abort_if(Gate::denies('mi_perfil_mis_datos_ver_perfil_profesional'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $isEditAdmin = false;
        $idiomas = Language::get();

        return view('admin.empleados.edit', compact('isEditAdmin', 'empleado', 'idiomas'));
    }

    public function cargarDocumentos(Request $request, Empleado $empleado)
    {
        $doc_viejo = EvidenciasDocumentosEmpleados::where('nombre', $request->nombre)->where('archivado', false)->first();
        if ($doc_viejo) {
            $doc_viejo->update([
                'archivado' => true,
            ]);
        }

        $request->merge([
            'empleado_id' => $empleado->id,
        ]);
        $request->validate([
            'nombre' => 'required|string|max:255',
            // 'numero' => 'required|string|max:255',
            // 'documentos' => 'required|mimes:jpeg,bmp,png,gif,svg,pdf|max:10000',
            'empleado_id' => 'required|exists:empleados,id',
        ]);

        // dd($empleado);
        $evidencia = EvidenciasDocumentosEmpleados::create($request->all());

        if ($request->hasFile('documentos')) {
            $file = $request->file('documentos');
            if (Storage::putFileAs('public/expedientes/' . Str::slug($empleado->name), $file, $file->getClientOriginalName())) {
                $evidencia->update([
                    'documentos' => $file->getClientOriginalName(),
                ]);
            }
        }

        dd(back());

        if (back() == route('inicio-Usuario.expediente')) {
            return redirect()->route('inicio-Usuario.expediente');
        }

        return response()->json(['status' => 'success', 'message' => 'Documentos cargados con éxito']);
    }

    public function cargarCapacitaciones(Request $request, $empleado)
    {
        $request->merge([
            'empleado_id' => $empleado,
        ]);
        $request->merge(['duracion' => Carbon::parse($request->año)->diffInDays($request->fecha_fin) + 1]);
        $request->validate([
            'curso_diploma' => 'required|string|max:255',
            'tipo' => 'required',
            'año' => 'required|date|before_or_equal:fecha_fin',
            'fecha_fin' => 'required|date|after_or_equal:año',
            'duracion' => 'required',
            'empleado_id' => 'required|exists:empleados,id',
        ], [
            'curso_diploma.required' => 'El campo nombre es requerido',
            'año.required' => 'El campo fecha inicio es requerido',
        ]);

        $empleado = Empleado::find(intval($empleado));
        $curso = CursosDiplomasEmpleados::create([
            'empleado_id' => $empleado->id,
            'curso_diploma' => $request->curso_diploma,
            'tipo' =>  $request->tipo,
            'año' =>  $request->año,
            'fecha_fin' =>  $request->fecha_fin,
            'duracion' =>  $request->duracion,
        ]);

        if ($request->hasFile('file')) {
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('file')->storeAs('public/cursos_empleados', $fileNameToStore);

            $curso->update([
                'file' => $fileNameToStore,
            ]);
        }
        if ($curso) {
            return response()->json(['status' => 'success', 'message' => 'Capacitación cargada con éxito']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Ocurrió un error']);
        }
    }

    public function cargarCertificacion(Request $request, Empleado $empleado)
    {
        if ($request->esVigente == 'true') {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'documento' => 'required|mimes:pdf|max:10000',
                'vigencia' => 'required|date|max:255',
                'estatus' => 'required|string|max:255',
            ]);
        } else {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'documento' => 'required|mimes:pdf|max:10000',
            ]);
        }

        $certificado = CertificacionesEmpleados::create([
            'empleado_id' => $empleado->id,
            'nombre' => $request->nombre,
            'estatus' =>  $request->estatus,
            'vigencia' =>  $request->vigencia,
        ]);
        if ($request->hasFile('documento')) {
            $filenameWithExt = $request->file('documento')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('documento')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload Image
            $path = $request->file('documento')->storeAs('public/certificados_empleados', $fileNameToStore);

            $certificado->update([
                'documento' => $fileNameToStore,
            ]);
        }

        return response()->json(['status' => 'success', 'message' => 'Certificación guardada']);
    }
}

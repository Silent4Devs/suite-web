<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEvidenciasSgsiRequest;
use App\Http\Requests\StoreEvidenciasSgsiRequest;
use App\Http\Requests\UpdateEvidenciasSgsiRequest;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\EvidenciaSgsiPdf;
use App\Models\EvidenciasSgsi;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EvidenciasSgsiController extends Controller
{
    use MediaUploadingTrait, ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = EvidenciasSgsi::with([
                'empleado' => function ($query) {
                    $query->select('id', 'name', 'foto');
                },
            ])
                ->select(sprintf('%s.*', (new EvidenciasSgsi)->table))
                ->orderByDesc('id');

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'evidencia_asignacion_recursos_sgsi_ver';
                $editGate = 'evidencia_asignacion_recursos_sgsi_editar';
                $deleteGate = 'evidencia_asignacion_recursos_sgsi_eliminar';
                $crudRoutePart = 'evidencias-sgsis';

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
            $table->editColumn('nombredocumento', function ($row) {
                return $row->nombredocumento ? $row->nombredocumento : '';
            });
            $table->editColumn('objetivodocumento', function ($row) {
                return $row->objetivodocumento ? $row->objetivodocumento : '';
            });
            $table->addColumn('responsable_name', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });

            $table->editColumn('area', function ($row) {
                return $row->area ? $row->area : '';
            });

            $table->editColumn('fecha_documento', function ($row) {
                return $row->fechadocumento ? $row->fechadocumento : '';
            });

            $table->editColumn('evidencia', function ($row) {
                return $row->evidencia_sgsi ? $row->evidencia_sgsi : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'archivopdf']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.evidenciasSgsis.index', compact('logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $areas = Area::getAll();

        return view('admin.evidenciasSgsis.create', compact('responsables', 'empleados', 'areas'));
    }

    public function store(StoreEvidenciasSgsiRequest $request)
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //Esta validado en StoreEvidenciasSgsiRequest
        $evidenciasSgsi = EvidenciasSgsi::create($request->all());

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/evidencias_sgsi', $file, $file->getClientOriginalName())) {
                    EvidenciaSgsiPdf::create([
                        'evidencia' => $file->getClientOriginalName(),
                        'id_evidencias_sgsis' => $evidenciasSgsi->id,
                    ]);
                }
            }
        }

        // if ($request->input('archivopdf', false)) {
        //     $evidenciasSgsi->addMedia(storage_path('tmp/uploads/' . $request->input('archivopdf')))->toMediaCollection('archivopdf');
        // }

        // if ($media = $request->input('ck-media', false)) {
        //     Media::whereIn('id', $media)->update(['model_id' => $evidenciasSgsi->id]);
        // }

        return redirect()->route('admin.evidencias-sgsis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::getAll()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $empleados = Empleado::getAltaEmpleadosWithArea();
        $areas = Area::getAll();
        $evidenciasSgsi->load('responsable', 'team');

        return view('admin.evidenciasSgsis.edit', compact('responsables', 'evidenciasSgsi', 'empleados', 'areas'));
    }

    public function update(UpdateEvidenciasSgsiRequest $request, EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $evidenciasSgsi->update($request->all());
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if (Storage::putFileAs('public/evidencias_sgsi', $file, $file->getClientOriginalName())) {
                    EvidenciaSgsiPdf::create([
                        'evidencia' => $file->getClientOriginalName(),
                        'id_evidencias_sgsis' => $evidenciasSgsi->id,
                    ]);
                }
            }
        }

        // if ($request->input('archivopdf', false)) {
        //     if (!$evidenciasSgsi->archivopdf || $request->input('archivopdf') !== $evidenciasSgsi->archivopdf->file_name) {
        //         if ($evidenciasSgsi->archivopdf) {
        //             $evidenciasSgsi->archivopdf->delete();
        //         }

        //         $evidenciasSgsi->addMedia(storage_path('tmp/uploads/' . $request->input('archivopdf')))->toMediaCollection('archivopdf');
        //     }
        // } elseif ($evidenciasSgsi->archivopdf) {
        //     $evidenciasSgsi->archivopdf->delete();
        // }

        return redirect()->route('admin.evidencias-sgsis.index')->with('success', 'Editado con éxito');
    }

    public function show(EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evidenciasSgsi->load('responsable', 'team');

        return view('admin.evidenciasSgsis.show', compact('evidenciasSgsi'));
    }

    public function destroy(EvidenciasSgsi $evidenciasSgsi)
    {
        abort_if(Gate::denies('evidencia_asignacion_recursos_sgsi_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evidenciasSgsi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyEvidenciasSgsiRequest $request)
    {
        EvidenciasSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        $model = new EvidenciasSgsi();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

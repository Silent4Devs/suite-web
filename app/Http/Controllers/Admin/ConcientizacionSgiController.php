<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyConcientizacionSgiRequest;
use App\Http\Requests\StoreConcientizacionSgiRequest;
use App\Http\Requests\UpdateConcientizacionSgiRequest;
use App\Models\Area;
use App\Models\ConcientizacionSgi;
use App\Models\DocumentoConcientizacionSgis;
use App\Models\Team;
use App\Traits\ObtenerOrganizacion;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ConcientizacionSgiController extends Controller
{
    use MediaUploadingTrait, ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('concientizacion_sgsi_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ConcientizacionSgi::with(['arearesponsable', 'team', 'documentos_concientizacion'])->select(sprintf('%s.*', (new ConcientizacionSgi)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'concientizacion_sgsi_ver';
                $editGate = 'concientizacion_sgsi_editar';
                $deleteGate = 'concientizacion_sgsi_eliminar';
                $crudRoutePart = 'concientizacion-sgis';

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
            $table->editColumn('objetivocomunicado', function ($row) {
                return $row->objetivocomunicado ? $row->objetivocomunicado : '';
            });
            $table->editColumn('personalobjetivo', function ($row) {
                return $row->personalobjetivo ? ConcientizacionSgi::PERSONALOBJETIVO_SELECT[$row->personalobjetivo] : '';
            });
            $table->addColumn('arearesponsable_area', function ($row) {
                return $row->arearesponsable ? $row->arearesponsable->area : '';
            });

            $table->editColumn('medio_envio', function ($row) {
                return $row->medio_envio ? ConcientizacionSgi::MEDIO_ENVIO_SELECT[$row->medio_envio] : '';
            });

            $table->editColumn('fecha_publicacion', function ($row) {
                return $row->fecha_publicacion ? $row->fecha_publicacion : '';
            });

            $table->editColumn('archivo', function ($row) {
                return $row->documentos_concientizacion ? $row->documentos_concientizacion : [];
            });

            $table->rawColumns(['actions', 'placeholder', 'arearesponsable', 'archivo']);

            return $table->make(true);
        }

        $areas = Area::getAll();
        $teams = Team::get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.concientizacionSgis.index', compact('areas', 'teams', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function create()
    {
        abort_if(Gate::denies('concientizacion_sgsi_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::getAllPluck();
        $documentos = DocumentoConcientizacionSgis::get();

        return view('admin.concientizacionSgis.create', compact('arearesponsables', 'documentos'));
    }

    public function store(StoreConcientizacionSgiRequest $request)
    {
        abort_if(Gate::denies('concientizacion_sgsi_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgi = ConcientizacionSgi::create($request->all());

        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/documentos_concientSgsi', $file, $file->getClientOriginalName())) {
                    DocumentoConcientizacionSgis::create([
                        'documento' => $file->getClientOriginalName(),
                        'concientSgsi_id' => $concientizacionSgi->id,
                    ]);
                }
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $concientizacionSgi->id]);
        }

        return redirect()->route('admin.concientizacion-sgis.index')->with('success', 'Guardado con éxito');
    }

    public function edit(ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::getAllPluck();
        $documentos = DocumentoConcientizacionSgis::get();
        $concientizacionSgi->load('arearesponsable', 'team');

        return view('admin.concientizacionSgis.edit', compact('arearesponsables', 'concientizacionSgi', 'documentos'));
    }

    public function update(UpdateConcientizacionSgiRequest $request, ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgi->update($request->all());

        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if (Storage::putFileAs('storage/documentos_concientSgsi', $file, $file->getClientOriginalName())) {
                    DocumentoConcientizacionSgis::create([
                        'documento' => $file->getClientOriginalName(),
                        'concientSgsi_id' => $controlAcceso->id,
                    ]);
                }
            }
        }

        // if ($request->input('archivo', false)) {
        //     if (!$concientizacionSgi->archivo || $request->input('archivo') !== $concientizacionSgi->archivo->file_name) {
        //         if ($concientizacionSgi->archivo) {
        //             $concientizacionSgi->archivo->delete();
        //         }

        //         $concientizacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        //     }
        // } elseif ($concientizacionSgi->archivo) {
        //     $concientizacionSgi->archivo->delete();
        // }

        return redirect()->route('admin.concientizacion-sgis.index')->with('success', 'Editado con éxito');
    }

    public function show(ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgsi_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgi->load('arearesponsable', 'team');

        return view('admin.concientizacionSgis.show', compact('concientizacionSgi'));
    }

    public function destroy(ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgsi_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgi->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyConcientizacionSgiRequest $request)
    {
        ConcientizacionSgi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('concientizacion_sgsi_agregar') && Gate::denies('concientizacion_sgsi_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new ConcientizacionSgi();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

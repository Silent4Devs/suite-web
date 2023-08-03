<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyControlAccesoRequest;
use App\Http\Requests\StoreControlAccesoRequest;
use App\Http\Requests\UpdateControlAccesoRequest;
use App\Models\ControlAcceso;
use App\Models\DocumentoControlAcceso;
use App\Models\Empleado;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ControlAccesoController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('control_de_accesos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ControlAcceso::with(['team', 'documentos_controlA'])->select(sprintf('%s.*', (new ControlAcceso)->table))->orderByDesc('id');
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'control_de_accesos_ver';
                $editGate = 'control_de_accesos_editar';
                $deleteGate = 'control_de_accesos_eliminar';
                $crudRoutePart = 'control-accesos';

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
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
            });
            // $table->editColumn('archivo', function ($row) {
            //     return $row->archivo ? '<a href="' . $row->archivo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            // });

            $table->editColumn('archivo', function ($row) {
                return $row->documentos_controlA ? $row->documentos_controlA : [];
            });

            $table->rawColumns(['actions', 'placeholder', 'archivo']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.controlAccesos.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('control_de_accesos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documentos = DocumentoControlAcceso::get();
        $responsables = Empleado::getAll();

        return view('admin.controlAccesos.create', compact('responsables', 'documentos'));
    }

    public function store(StoreControlAccesoRequest $request)
    {
        abort_if(Gate::denies('control_de_accesos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        //dd($request->all());
        $controlAcceso = ControlAcceso::create($request->all());
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                if (Storage::putFileAs('public/documentos_control_accesos', $file, $file->getClientOriginalName())) {
                    DocumentoControlAcceso::create([
                        'documento' => $file->getClientOriginalName(),
                        'controlA_id' => $controlAcceso->id,
                    ]);
                }
            }
        }

        // if ($request->input('archivo', false)) {
        //     $controlAcceso->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        // }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $controlAcceso->id]);
        }

        return redirect()->route('admin.control-accesos.index')->with('success', 'Guardado con éxito');
    }

    public function edit(ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_de_accesos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $documentos = DocumentoControlAcceso::get();
        $controlAcceso->load('team');

        return view('admin.controlAccesos.edit', compact('controlAcceso', 'documentos'));
    }

    public function update(UpdateControlAccesoRequest $request, ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_de_accesos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAcceso->update($request->all());
        $files = $request->file('files');
        if ($request->hasFile('files')) {
            foreach ($files as $file) {
                if (Storage::putFileAs('storage/documentos_control_accesos', $file, $file->getClientOriginalName())) {
                    DocumentoControlAcceso::create([
                        'documento' => $file->getClientOriginalName(),
                        'controlA_id' => $controlAcceso->id,
                    ]);
                }
            }
        }

        return redirect()->route('admin.control-accesos.index')->with('success', 'Editado con éxito');
    }

    public function show(ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_de_accesos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAcceso->load('team');

        return view('admin.controlAccesos.show', compact('controlAcceso'));
    }

    public function destroy(ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_de_accesos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAcceso->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyControlAccesoRequest $request)
    {
        ControlAcceso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('control_de_accesos_agregar') && Gate::denies('control_de_accesos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new ControlAcceso();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

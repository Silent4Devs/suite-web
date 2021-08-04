<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyComunicacionSgiRequest;
use App\Http\Requests\StoreComunicacionSgiRequest;
use App\Http\Requests\UpdateComunicacionSgiRequest;
use App\Models\ComunicacionSgi;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ComunicacionSgiController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('comunicacion_sgi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = ComunicacionSgi::with(['team'])->select(sprintf('%s.*', (new ComunicacionSgi)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'comunicacion_sgi_show';
                $editGate      = 'comunicacion_sgi_edit';
                $deleteGate    = 'comunicacion_sgi_delete';
                $crudRoutePart = 'comunicacion-sgis';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });
            $table->editColumn('archivo', function ($row) {
                return $row->archivo ? '<a href="' . $row->archivo->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'archivo']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.comunicacionSgis.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('comunicacion_sgi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.comunicacionSgis.create');
    }

    public function store(StoreComunicacionSgiRequest $request)
    {
        $comunicacionSgi = ComunicacionSgi::create($request->all());

        if ($request->input('archivo', false)) {
            $comunicacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $comunicacionSgi->id]);
        }

        return redirect()->route('admin.comunicacion-sgis.index')->with("success", 'Guardado con éxito');
    }

    public function edit(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicacion_sgi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->load('team');

        return view('admin.comunicacionSgis.edit', compact('comunicacionSgi'));
    }

    public function update(UpdateComunicacionSgiRequest $request, ComunicacionSgi $comunicacionSgi)
    {
        $comunicacionSgi->update($request->all());

        if ($request->input('archivo', false)) {
            if (!$comunicacionSgi->archivo || $request->input('archivo') !== $comunicacionSgi->archivo->file_name) {
                if ($comunicacionSgi->archivo) {
                    $comunicacionSgi->archivo->delete();
                }

                $comunicacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($comunicacionSgi->archivo) {
            $comunicacionSgi->archivo->delete();
        }

        return redirect()->route('admin.comunicacion-sgis.index')->with("success", 'Editado con éxito');
    }

    public function show(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicacion_sgi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->load('team');

        return view('admin.comunicacionSgis.show', compact('comunicacionSgi'));
    }

    public function destroy(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicacion_sgi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->delete();

        return back()->with('deleted','Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyComunicacionSgiRequest $request)
    {
        ComunicacionSgi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('comunicacion_sgi_create') && Gate::denies('comunicacion_sgi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ComunicacionSgi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

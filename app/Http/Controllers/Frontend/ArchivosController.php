<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyArchivoRequest;
use App\Http\Requests\StoreArchivoRequest;
use App\Http\Requests\UpdateArchivoRequest;
use App\Models\Archivo;
use App\Models\Carpetum;
use App\Models\EstadoDocumento;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ArchivosController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('archivo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Archivo::with(['carpeta', 'estado', 'team'])->select(sprintf('%s.*', (new Archivo)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'archivo_show';
                $editGate = 'archivo_edit';
                $deleteGate = 'archivo_delete';
                $crudRoutePart = 'archivos';

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
            $table->addColumn('carpeta_nombre', function ($row) {
                return $row->carpeta ? $row->carpeta->nombre : '';
            });

            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? '<a href="'.$row->nombre->getUrl().'" target="_blank">'.trans('global.downloadFile').'</a>' : '';
            });
            $table->addColumn('estado_estado', function ($row) {
                return $row->estado ? $row->estado->estado : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'carpeta', 'nombre', 'estado']);

            return $table->make(true);
        }

        $carpeta = Carpetum::get();
        $estado_documentos = EstadoDocumento::get();
        $teams = Team::get();

        return view('frontend.archivos.index', compact('carpeta', 'estado_documentos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('archivo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetas = Carpetum::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estados = EstadoDocumento::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.archivos.create', compact('carpetas', 'estados'));
    }

    public function store(StoreArchivoRequest $request)
    {
        $archivo = Archivo::create($request->all());

        if ($request->input('nombre', false)) {
            $archivo->addMedia(storage_path('tmp/uploads/'.$request->input('nombre')))->toMediaCollection('nombre');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $archivo->id]);
        }

        return redirect()->route('archivos.index');
    }

    public function edit(Archivo $archivo)
    {
        abort_if(Gate::denies('archivo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $carpetas = Carpetum::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estados = EstadoDocumento::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $archivo->load('carpeta', 'estado', 'team');

        return view('frontend.archivos.edit', compact('carpetas', 'estados', 'archivo'));
    }

    public function update(UpdateArchivoRequest $request, Archivo $archivo)
    {
        $archivo->update($request->all());

        if ($request->input('nombre', false)) {
            if (! $archivo->nombre || $request->input('nombre') !== $archivo->nombre->file_name) {
                if ($archivo->nombre) {
                    $archivo->nombre->delete();
                }

                $archivo->addMedia(storage_path('tmp/uploads/'.$request->input('nombre')))->toMediaCollection('nombre');
            }
        } elseif ($archivo->nombre) {
            $archivo->nombre->delete();
        }

        return redirect()->route('archivos.index');
    }

    public function show(Archivo $archivo)
    {
        abort_if(Gate::denies('archivo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $archivo->load('carpeta', 'estado', 'team');

        return view('frontend.archivos.show', compact('archivo'));
    }

    public function destroy(Archivo $archivo)
    {
        abort_if(Gate::denies('archivo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $archivo->delete();

        return back();
    }

    public function massDestroy(MassDestroyArchivoRequest $request)
    {
        Archivo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('archivo_create') && Gate::denies('archivo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new Archivo();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrganizacionRequest;
use App\Http\Requests\StoreOrganizacionRequest;
use App\Http\Requests\UpdateOrganizacionRequest;
use App\Models\Organizacion;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class OrganizacionController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('organizacion_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Organizacion::with(['team'])->select(sprintf('%s.*', (new Organizacion)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'organizacion_show';
                $editGate      = 'organizacion_edit';
                $deleteGate    = 'organizacion_delete';
                $crudRoutePart = 'organizacions';

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
            $table->editColumn('empresa', function ($row) {
                return $row->empresa ? $row->empresa : "";
            });
            $table->editColumn('direccion', function ($row) {
                return $row->direccion ? $row->direccion : "";
            });
            $table->editColumn('telefono', function ($row) {
                return $row->telefono ? $row->telefono : "";
            });
            $table->editColumn('correo', function ($row) {
                return $row->correo ? $row->correo : "";
            });
            $table->editColumn('pagina_web', function ($row) {
                return $row->pagina_web ? $row->pagina_web : "";
            });
            $table->editColumn('giro', function ($row) {
                return $row->giro ? $row->giro : "";
            });
            $table->editColumn('servicios', function ($row) {
                return $row->servicios ? $row->servicios : "";
            });
            $table->editColumn('mision', function ($row) {
                return $row->mision ? $row->mision : "";
            });
            $table->editColumn('vision', function ($row) {
                return $row->vision ? $row->vision : "";
            });
            $table->editColumn('valores', function ($row) {
                return $row->valores ? $row->valores : "";
            });
            $table->editColumn('logotipo', function ($row) {
                if ($photo = $row->logotipo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });

            $table->rawColumns(['actions', 'placeholder', 'logotipo']);

            return $table->make(true);
        }

        $teams = Team::get();

        return view('admin.organizacions.index', compact('teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('organizacion_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.organizacions.create');
    }

    public function store(StoreOrganizacionRequest $request)
    {
        $organizacion = Organizacion::create($request->all());

        if ($request->input('logotipo', false)) {
            $organizacion->addMedia(storage_path('tmp/uploads/' . $request->input('logotipo')))->toMediaCollection('logotipo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $organizacion->id]);
        }

        return redirect()->route('admin.organizacions.index');
    }

    public function edit(Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion->load('team');

        return view('admin.organizacions.edit', compact('organizacion'));
    }

    public function update(UpdateOrganizacionRequest $request, Organizacion $organizacion)
    {
        $organizacion->update($request->all());

        if ($request->input('logotipo', false)) {
            if (!$organizacion->logotipo || $request->input('logotipo') !== $organizacion->logotipo->file_name) {
                if ($organizacion->logotipo) {
                    $organizacion->logotipo->delete();
                }

                $organizacion->addMedia(storage_path('tmp/uploads/' . $request->input('logotipo')))->toMediaCollection('logotipo');
            }
        } elseif ($organizacion->logotipo) {
            $organizacion->logotipo->delete();
        }

        return redirect()->route('admin.organizacions.index');
    }

    public function show(Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion->load('team');

        return view('admin.organizacions.show', compact('organizacion'));
    }

    public function destroy(Organizacion $organizacion)
    {
        abort_if(Gate::denies('organizacion_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizacionRequest $request)
    {
        Organizacion::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('organizacion_create') && Gate::denies('organizacion_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Organizacion();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

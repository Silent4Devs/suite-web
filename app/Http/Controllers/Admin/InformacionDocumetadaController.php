<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyInformacionDocumetadaRequest;
use App\Http\Requests\StoreInformacionDocumetadaRequest;
use App\Http\Requests\UpdateInformacionDocumetadaRequest;
use App\Models\InformacionDocumetada;
use App\Models\PoliticaSgsi;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class InformacionDocumetadaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('informacion_documentada_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = InformacionDocumetada::with(['politicas', 'elaboro', 'reviso', 'aprobacion', 'team'])->select(sprintf('%s.*', (new InformacionDocumetada)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'informacion_documentada_ver';
                $editGate = 'informacion_documetada_edit';
                $deleteGate = 'informacion_documetada_delete';
                $crudRoutePart = 'informacion-documetadas';

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
            $table->editColumn('titulodocumento', function ($row) {
                return $row->titulodocumento ? $row->titulodocumento : '';
            });
            $table->editColumn('tipodocumento', function ($row) {
                return $row->tipodocumento ? InformacionDocumetada::TIPODOCUMENTO_SELECT[$row->tipodocumento] : '';
            });
            $table->editColumn('identificador', function ($row) {
                return $row->identificador ? $row->identificador : '';
            });
            $table->editColumn('version', function ($row) {
                return $row->version ? $row->version : '';
            });
            $table->editColumn('politicas', function ($row) {
                $labels = [];

                foreach ($row->politicas as $politica) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $politica->politicasgsi);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('contenido', function ($row) {
                return $row->contenido ? $row->contenido : '';
            });
            $table->addColumn('elaboro_name', function ($row) {
                return $row->elaboro ? $row->elaboro->name : '';
            });

            $table->addColumn('reviso_name', function ($row) {
                return $row->reviso ? $row->reviso->name : '';
            });

            $table->addColumn('aprobacion_name', function ($row) {
                return $row->aprobacion ? $row->aprobacion->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'politicas', 'elaboro', 'reviso', 'aprobacion', 'logotipo']);

            return $table->make(true);
        }

        $politica_sgsis = PoliticaSgsi::getAll();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.informacionDocumetadas.index', compact('politica_sgsis', 'users', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('informacion_documetada_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicas = PoliticaSgsi::getAll()->pluck('politicasgsi', 'id');

        $users = User::getAll();

        $elaboros = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aprobacions = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.informacionDocumetadas.create', compact('politicas', 'elaboros', 'revisos', 'aprobacions'));
    }

    public function store(StoreInformacionDocumetadaRequest $request)
    {
        $informacionDocumetada = InformacionDocumetada::create($request->all());
        $informacionDocumetada->politicas()->sync($request->input('politicas', []));

        if ($request->input('logotipo', false)) {
            $informacionDocumetada->addMedia(storage_path('tmp/uploads/'.$request->input('logotipo')))->toMediaCollection('logotipo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $informacionDocumetada->id]);
        }

        return redirect()->route('admin.informacion-documetadas.index')->with('success', 'Guardado con éxito');
    }

    public function edit(InformacionDocumetada $informacionDocumetada)
    {
        abort_if(Gate::denies('informacion_documetada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicas = PoliticaSgsi::getAll()->pluck('politicasgsi', 'id');

        $users = User::getAll();

        $elaboros = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aprobacions = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $informacionDocumetada->load('politicas', 'elaboro', 'reviso', 'aprobacion', 'team');

        return view('admin.informacionDocumetadas.edit', compact('politicas', 'elaboros', 'revisos', 'aprobacions', 'informacionDocumetada'));
    }

    public function update(UpdateInformacionDocumetadaRequest $request, InformacionDocumetada $informacionDocumetada)
    {
        $informacionDocumetada->update($request->all());
        $informacionDocumetada->politicas()->sync($request->input('politicas', []));

        if ($request->input('logotipo', false)) {
            if (! $informacionDocumetada->logotipo || $request->input('logotipo') !== $informacionDocumetada->logotipo->file_name) {
                if ($informacionDocumetada->logotipo) {
                    $informacionDocumetada->logotipo->delete();
                }

                $informacionDocumetada->addMedia(storage_path('tmp/uploads/'.$request->input('logotipo')))->toMediaCollection('logotipo');
            }
        } elseif ($informacionDocumetada->logotipo) {
            $informacionDocumetada->logotipo->delete();
        }

        return redirect()->route('admin.informacion-documetadas.index')->with('success', 'Editado con éxito');
    }

    public function show(InformacionDocumetada $informacionDocumetada)
    {
        abort_if(Gate::denies('informacion_documentada_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $informacionDocumetada->load('politicas', 'elaboro', 'reviso', 'aprobacion', 'team');

        return view('admin.informacionDocumetadas.show', compact('informacionDocumetada'));
    }

    public function destroy(InformacionDocumetada $informacionDocumetada)
    {
        abort_if(Gate::denies('informacion_documetada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $informacionDocumetada->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function massDestroy(MassDestroyInformacionDocumetadaRequest $request)
    {
        InformacionDocumetada::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('informacion_documetada_create') && Gate::denies('informacion_documetada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new InformacionDocumetada();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

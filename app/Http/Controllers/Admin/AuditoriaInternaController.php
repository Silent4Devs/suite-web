<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAuditoriaInternaRequest;
use App\Http\Requests\StoreAuditoriaInternaRequest;
use App\Http\Requests\UpdateAuditoriaInternaRequest;
use App\Models\AuditoriaInterna;
use App\Models\Controle;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class AuditoriaInternaController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = AuditoriaInterna::with(['clausulas', 'auditorlider', 'equipoauditoria', 'team'])->select(sprintf('%s.*', (new AuditoriaInterna)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'auditoria_interna_show';
                $editGate      = 'auditoria_interna_edit';
                $deleteGate    = 'auditoria_interna_delete';
                $crudRoutePart = 'auditoria-internas';

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
            $table->editColumn('alcance', function ($row) {
                return $row->alcance ? $row->alcance : "";
            });
            $table->addColumn('clausulas_control', function ($row) {
                return $row->clausulas ? $row->clausulas->control : '';
            });

            $table->addColumn('auditorlider_name', function ($row) {
                return $row->auditorlider ? $row->auditorlider->name : '';
            });

            $table->addColumn('equipoauditoria_name', function ($row) {
                return $row->equipoauditoria ? $row->equipoauditoria->name : '';
            });

            $table->editColumn('hallazgos', function ($row) {
                return $row->hallazgos ? $row->hallazgos : "";
            });
            $table->editColumn('cheknoconformidadmenor', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->cheknoconformidadmenor ? 'checked' : null) . '>';
            });
            $table->editColumn('totalnoconformidadmenor', function ($row) {
                return $row->totalnoconformidadmenor ? $row->totalnoconformidadmenor : "";
            });
            $table->editColumn('checknoconformidadmayor', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checknoconformidadmayor ? 'checked' : null) . '>';
            });
            $table->editColumn('totalnoconformidadmayor', function ($row) {
                return $row->totalnoconformidadmayor ? $row->totalnoconformidadmayor : "";
            });
            $table->editColumn('checkobservacion', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checkobservacion ? 'checked' : null) . '>';
            });
            $table->editColumn('totalobservacion', function ($row) {
                return $row->totalobservacion ? $row->totalobservacion : "";
            });
            $table->editColumn('checkmejora', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->checkmejora ? 'checked' : null) . '>';
            });
            $table->editColumn('totalmejora', function ($row) {
                return $row->totalmejora ? $row->totalmejora : "";
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

            $table->rawColumns(['actions', 'placeholder', 'clausulas', 'auditorlider', 'equipoauditoria', 'cheknoconformidadmenor', 'checknoconformidadmayor', 'checkobservacion', 'checkmejora', 'logotipo']);

            return $table->make(true);
        }

        $controles = Controle::get();
        $users     = User::get();
        $users     = User::get();
        $teams     = Team::get();

        return view('admin.auditoriaInternas.index', compact('controles', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('auditoria_interna_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clausulas = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipoauditorias = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.auditoriaInternas.create', compact('clausulas', 'auditorliders', 'equipoauditorias'));
    }

    public function store(StoreAuditoriaInternaRequest $request)
    {
        $auditoriaInterna = AuditoriaInterna::create($request->all());

        if ($request->input('logotipo', false)) {
            $auditoriaInterna->addMedia(storage_path('tmp/uploads/' . $request->input('logotipo')))->toMediaCollection('logotipo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $auditoriaInterna->id]);
        }

        return redirect()->route('admin.auditoria-internas.index');
    }

    public function edit(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clausulas = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipoauditorias = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditoriaInterna->load('clausulas', 'auditorlider', 'equipoauditoria', 'team');

        return view('admin.auditoriaInternas.edit', compact('clausulas', 'auditorliders', 'equipoauditorias', 'auditoriaInterna'));
    }

    public function update(UpdateAuditoriaInternaRequest $request, AuditoriaInterna $auditoriaInterna)
    {
        $auditoriaInterna->update($request->all());

        if ($request->input('logotipo', false)) {
            if (!$auditoriaInterna->logotipo || $request->input('logotipo') !== $auditoriaInterna->logotipo->file_name) {
                if ($auditoriaInterna->logotipo) {
                    $auditoriaInterna->logotipo->delete();
                }

                $auditoriaInterna->addMedia(storage_path('tmp/uploads/' . $request->input('logotipo')))->toMediaCollection('logotipo');
            }
        } elseif ($auditoriaInterna->logotipo) {
            $auditoriaInterna->logotipo->delete();
        }

        return redirect()->route('admin.auditoria-internas.index');
    }

    public function show(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'auditorlider', 'equipoauditoria', 'team');

        return view('admin.auditoriaInternas.show', compact('auditoriaInterna'));
    }

    public function destroy(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuditoriaInternaRequest $request)
    {
        AuditoriaInterna::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('auditoria_interna_create') && Gate::denies('auditoria_interna_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AuditoriaInterna();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

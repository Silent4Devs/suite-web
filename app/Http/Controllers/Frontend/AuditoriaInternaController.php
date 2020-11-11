<?php

namespace App\Http\Controllers\Frontend;

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

class AuditoriaInternaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('auditoria_interna_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInternas = AuditoriaInterna::all();

        $controles = Controle::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.auditoriaInternas.index', compact('auditoriaInternas', 'controles', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('auditoria_interna_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clausulas = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipoauditorias = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.auditoriaInternas.create', compact('clausulas', 'auditorliders', 'equipoauditorias'));
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

        return redirect()->route('frontend.auditoria-internas.index');
    }

    public function edit(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $clausulas = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $equipoauditorias = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditoriaInterna->load('clausulas', 'auditorlider', 'equipoauditoria', 'team');

        return view('frontend.auditoriaInternas.edit', compact('clausulas', 'auditorliders', 'equipoauditorias', 'auditoriaInterna'));
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

        return redirect()->route('frontend.auditoria-internas.index');
    }

    public function show(AuditoriaInterna $auditoriaInterna)
    {
        abort_if(Gate::denies('auditoria_interna_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaInterna->load('clausulas', 'auditorlider', 'equipoauditoria', 'team');

        return view('frontend.auditoriaInternas.show', compact('auditoriaInterna'));
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

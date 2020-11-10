<?php

namespace App\Http\Controllers\Frontend;

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

class InformacionDocumetadaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('informacion_documetada_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $informacionDocumetadas = InformacionDocumetada::all();

        $politica_sgsis = PoliticaSgsi::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.informacionDocumetadas.index', compact('informacionDocumetadas', 'politica_sgsis', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('informacion_documetada_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicas = PoliticaSgsi::all()->pluck('politicasgsi', 'id');

        $elaboros = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aprobacions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.informacionDocumetadas.create', compact('politicas', 'elaboros', 'revisos', 'aprobacions'));
    }

    public function store(StoreInformacionDocumetadaRequest $request)
    {
        $informacionDocumetada = InformacionDocumetada::create($request->all());
        $informacionDocumetada->politicas()->sync($request->input('politicas', []));

        if ($request->input('logotipo', false)) {
            $informacionDocumetada->addMedia(storage_path('tmp/uploads/' . $request->input('logotipo')))->toMediaCollection('logotipo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $informacionDocumetada->id]);
        }

        return redirect()->route('frontend.informacion-documetadas.index');
    }

    public function edit(InformacionDocumetada $informacionDocumetada)
    {
        abort_if(Gate::denies('informacion_documetada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $politicas = PoliticaSgsi::all()->pluck('politicasgsi', 'id');

        $elaboros = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $revisos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $aprobacions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $informacionDocumetada->load('politicas', 'elaboro', 'reviso', 'aprobacion', 'team');

        return view('frontend.informacionDocumetadas.edit', compact('politicas', 'elaboros', 'revisos', 'aprobacions', 'informacionDocumetada'));
    }

    public function update(UpdateInformacionDocumetadaRequest $request, InformacionDocumetada $informacionDocumetada)
    {
        $informacionDocumetada->update($request->all());
        $informacionDocumetada->politicas()->sync($request->input('politicas', []));

        if ($request->input('logotipo', false)) {
            if (!$informacionDocumetada->logotipo || $request->input('logotipo') !== $informacionDocumetada->logotipo->file_name) {
                if ($informacionDocumetada->logotipo) {
                    $informacionDocumetada->logotipo->delete();
                }

                $informacionDocumetada->addMedia(storage_path('tmp/uploads/' . $request->input('logotipo')))->toMediaCollection('logotipo');
            }
        } elseif ($informacionDocumetada->logotipo) {
            $informacionDocumetada->logotipo->delete();
        }

        return redirect()->route('frontend.informacion-documetadas.index');
    }

    public function show(InformacionDocumetada $informacionDocumetada)
    {
        abort_if(Gate::denies('informacion_documetada_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $informacionDocumetada->load('politicas', 'elaboro', 'reviso', 'aprobacion', 'team');

        return view('frontend.informacionDocumetadas.show', compact('informacionDocumetada'));
    }

    public function destroy(InformacionDocumetada $informacionDocumetada)
    {
        abort_if(Gate::denies('informacion_documetada_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $informacionDocumetada->delete();

        return back();
    }

    public function massDestroy(MassDestroyInformacionDocumetadaRequest $request)
    {
        InformacionDocumetada::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('informacion_documetada_create') && Gate::denies('informacion_documetada_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new InformacionDocumetada();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

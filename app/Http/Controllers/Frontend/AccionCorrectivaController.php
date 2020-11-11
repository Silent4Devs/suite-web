<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyAccionCorrectivaRequest;
use App\Http\Requests\StoreAccionCorrectivaRequest;
use App\Http\Requests\UpdateAccionCorrectivaRequest;
use App\Models\AccionCorrectiva;
use App\Models\Puesto;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class AccionCorrectivaController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('accion_correctiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectivas = AccionCorrectiva::all();

        $users = User::get();

        $puestos = Puesto::get();

        $teams = Team::get();

        return view('frontend.accionCorrectivas.index', compact('accionCorrectivas', 'users', 'puestos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('accion_correctiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrereportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.accionCorrectivas.create', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas'));
    }

    public function store(StoreAccionCorrectivaRequest $request)
    {
        $accionCorrectiva = AccionCorrectiva::create($request->all());

        if ($request->input('documentometodo', false)) {
            $accionCorrectiva->addMedia(storage_path('tmp/uploads/' . $request->input('documentometodo')))->toMediaCollection('documentometodo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $accionCorrectiva->id]);
        }

        return redirect()->route('frontend.accion-correctivas.index');
    }

    public function edit(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $nombrereportas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoreportas = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombreregistras = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $puestoregistras = Puesto::all()->pluck('puesto', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsable_accions = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $nombre_autorizas = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team');

        return view('frontend.accionCorrectivas.edit', compact('nombrereportas', 'puestoreportas', 'nombreregistras', 'puestoregistras', 'responsable_accions', 'nombre_autorizas', 'accionCorrectiva'));
    }

    public function update(UpdateAccionCorrectivaRequest $request, AccionCorrectiva $accionCorrectiva)
    {
        $accionCorrectiva->update($request->all());

        if ($request->input('documentometodo', false)) {
            if (!$accionCorrectiva->documentometodo || $request->input('documentometodo') !== $accionCorrectiva->documentometodo->file_name) {
                if ($accionCorrectiva->documentometodo) {
                    $accionCorrectiva->documentometodo->delete();
                }

                $accionCorrectiva->addMedia(storage_path('tmp/uploads/' . $request->input('documentometodo')))->toMediaCollection('documentometodo');
            }
        } elseif ($accionCorrectiva->documentometodo) {
            $accionCorrectiva->documentometodo->delete();
        }

        return redirect()->route('frontend.accion-correctivas.index');
    }

    public function show(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->load('nombrereporta', 'puestoreporta', 'nombreregistra', 'puestoregistra', 'responsable_accion', 'nombre_autoriza', 'team', 'accioncorrectivaPlanaccionCorrectivas');

        return view('frontend.accionCorrectivas.show', compact('accionCorrectiva'));
    }

    public function destroy(AccionCorrectiva $accionCorrectiva)
    {
        abort_if(Gate::denies('accion_correctiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accionCorrectiva->delete();

        return back();
    }

    public function massDestroy(MassDestroyAccionCorrectivaRequest $request)
    {
        AccionCorrectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('accion_correctiva_create') && Gate::denies('accion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new AccionCorrectiva();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

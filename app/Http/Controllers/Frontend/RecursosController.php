<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyRecursoRequest;
use App\Http\Requests\StoreRecursoRequest;
use App\Http\Requests\UpdateRecursoRequest;
use App\Models\Recurso;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class RecursosController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('recurso_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recursos = Recurso::with(['participantes', 'team', 'media'])->get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.recursos.index', compact('recursos', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('recurso_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantes = User::all()->pluck('name', 'id');

        return view('frontend.recursos.create', compact('participantes'));
    }

    public function store(StoreRecursoRequest $request)
    {
        $recurso = Recurso::create($request->all());
        $recurso->participantes()->sync($request->input('participantes', []));

        foreach ($request->input('certificado', []) as $file) {
            $recurso->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificado');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $recurso->id]);
        }

        return redirect()->route('frontend.recursos.index');
    }

    public function edit(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participantes = User::all()->pluck('name', 'id');

        $recurso->load('participantes', 'team');

        return view('frontend.recursos.edit', compact('participantes', 'recurso'));
    }

    public function update(UpdateRecursoRequest $request, Recurso $recurso)
    {
        $recurso->update($request->all());
        $recurso->participantes()->sync($request->input('participantes', []));

        if (count($recurso->certificado) > 0) {
            foreach ($recurso->certificado as $media) {
                if (!in_array($media->file_name, $request->input('certificado', []))) {
                    $media->delete();
                }
            }
        }

        $media = $recurso->certificado->pluck('file_name')->toArray();

        foreach ($request->input('certificado', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $recurso->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('certificado');
            }
        }

        return redirect()->route('frontend.recursos.index');
    }

    public function show(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->load('participantes', 'team');

        return view('frontend.recursos.show', compact('recurso'));
    }

    public function destroy(Recurso $recurso)
    {
        abort_if(Gate::denies('recurso_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $recurso->delete();

        return back();
    }

    public function massDestroy(MassDestroyRecursoRequest $request)
    {
        Recurso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('recurso_create') && Gate::denies('recurso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Recurso();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

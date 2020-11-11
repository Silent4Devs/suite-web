<?php

namespace App\Http\Controllers\Frontend;

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

class ComunicacionSgiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('comunicacion_sgi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgis = ComunicacionSgi::all();

        $teams = Team::get();

        return view('frontend.comunicacionSgis.index', compact('comunicacionSgis', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('comunicacion_sgi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.comunicacionSgis.create');
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

        return redirect()->route('frontend.comunicacion-sgis.index');
    }

    public function edit(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicacion_sgi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->load('team');

        return view('frontend.comunicacionSgis.edit', compact('comunicacionSgi'));
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

        return redirect()->route('frontend.comunicacion-sgis.index');
    }

    public function show(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicacion_sgi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->load('team');

        return view('frontend.comunicacionSgis.show', compact('comunicacionSgi'));
    }

    public function destroy(ComunicacionSgi $comunicacionSgi)
    {
        abort_if(Gate::denies('comunicacion_sgi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $comunicacionSgi->delete();

        return back();
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

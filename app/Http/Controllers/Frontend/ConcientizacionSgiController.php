<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyConcientizacionSgiRequest;
use App\Http\Requests\StoreConcientizacionSgiRequest;
use App\Http\Requests\UpdateConcientizacionSgiRequest;
use App\Models\Area;
use App\Models\ConcientizacionSgi;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ConcientizacionSgiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('concientizacion_sgi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgis = ConcientizacionSgi::all();

        $areas = Area::get();

        $teams = Team::get();

        return view('frontend.concientizacionSgis.index', compact('concientizacionSgis', 'areas', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('concientizacion_sgi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.concientizacionSgis.create', compact('arearesponsables'));
    }

    public function store(StoreConcientizacionSgiRequest $request)
    {
        $concientizacionSgi = ConcientizacionSgi::create($request->all());

        if ($request->input('archivo', false)) {
            $concientizacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $concientizacionSgi->id]);
        }

        return redirect()->route('frontend.concientizacion-sgis.index');
    }

    public function edit(ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $concientizacionSgi->load('arearesponsable', 'team');

        return view('frontend.concientizacionSgis.edit', compact('arearesponsables', 'concientizacionSgi'));
    }

    public function update(UpdateConcientizacionSgiRequest $request, ConcientizacionSgi $concientizacionSgi)
    {
        $concientizacionSgi->update($request->all());

        if ($request->input('archivo', false)) {
            if (!$concientizacionSgi->archivo || $request->input('archivo') !== $concientizacionSgi->archivo->file_name) {
                if ($concientizacionSgi->archivo) {
                    $concientizacionSgi->archivo->delete();
                }

                $concientizacionSgi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($concientizacionSgi->archivo) {
            $concientizacionSgi->archivo->delete();
        }

        return redirect()->route('frontend.concientizacion-sgis.index');
    }

    public function show(ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgi->load('arearesponsable', 'team');

        return view('frontend.concientizacionSgis.show', compact('concientizacionSgi'));
    }

    public function destroy(ConcientizacionSgi $concientizacionSgi)
    {
        abort_if(Gate::denies('concientizacion_sgi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $concientizacionSgi->delete();

        return back();
    }

    public function massDestroy(MassDestroyConcientizacionSgiRequest $request)
    {
        ConcientizacionSgi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('concientizacion_sgi_create') && Gate::denies('concientizacion_sgi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ConcientizacionSgi();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

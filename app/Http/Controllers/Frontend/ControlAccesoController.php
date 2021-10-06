<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyControlAccesoRequest;
use App\Http\Requests\StoreControlAccesoRequest;
use App\Http\Requests\UpdateControlAccesoRequest;
use App\Models\ControlAcceso;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ControlAccesoController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('control_acceso_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAccesos = ControlAcceso::all();

        $teams = Team::get();

        return view('frontend.controlAccesos.index', compact('controlAccesos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('control_acceso_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.controlAccesos.create');
    }

    public function store(StoreControlAccesoRequest $request)
    {
        $controlAcceso = ControlAcceso::create($request->all());

        if ($request->input('archivo', false)) {
            $controlAcceso->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $controlAcceso->id]);
        }

        return redirect()->route('frontend.control-accesos.index');
    }

    public function edit(ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_acceso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAcceso->load('team');

        return view('frontend.controlAccesos.edit', compact('controlAcceso'));
    }

    public function update(UpdateControlAccesoRequest $request, ControlAcceso $controlAcceso)
    {
        $controlAcceso->update($request->all());

        if ($request->input('archivo', false)) {
            if (!$controlAcceso->archivo || $request->input('archivo') !== $controlAcceso->archivo->file_name) {
                if ($controlAcceso->archivo) {
                    $controlAcceso->archivo->delete();
                }

                $controlAcceso->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($controlAcceso->archivo) {
            $controlAcceso->archivo->delete();
        }

        return redirect()->route('frontend.control-accesos.index');
    }

    public function show(ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_acceso_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAcceso->load('team');

        return view('frontend.controlAccesos.show', compact('controlAcceso'));
    }

    public function destroy(ControlAcceso $controlAcceso)
    {
        abort_if(Gate::denies('control_acceso_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controlAcceso->delete();

        return back();
    }

    public function massDestroy(MassDestroyControlAccesoRequest $request)
    {
        ControlAcceso::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('control_acceso_create') && Gate::denies('control_acceso_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new ControlAcceso();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

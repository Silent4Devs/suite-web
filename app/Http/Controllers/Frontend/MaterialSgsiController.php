<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaterialSgsiRequest;
use App\Http\Requests\StoreMaterialSgsiRequest;
use App\Http\Requests\UpdateMaterialSgsiRequest;
use App\Models\Area;
use App\Models\MaterialSgsi;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MaterialSgsiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('material_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialSgsis = MaterialSgsi::all();

        $areas = Area::get();

        $teams = Team::get();

        return view('frontend.materialSgsis.index', compact('materialSgsis', 'areas', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('material_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.materialSgsis.create', compact('arearesponsables'));
    }

    public function store(StoreMaterialSgsiRequest $request)
    {
        $materialSgsi = MaterialSgsi::create($request->all());

        if ($request->input('archivo', false)) {
            $materialSgsi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $materialSgsi->id]);
        }

        return redirect()->route('frontend.material-sgsis.index');
    }

    public function edit(MaterialSgsi $materialSgsi)
    {
        abort_if(Gate::denies('material_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::all()->pluck('area', 'id')->prepend(trans('global.pleaseSelect'), '');

        $materialSgsi->load('arearesponsable', 'team');

        return view('frontend.materialSgsis.edit', compact('arearesponsables', 'materialSgsi'));
    }

    public function update(UpdateMaterialSgsiRequest $request, MaterialSgsi $materialSgsi)
    {
        $materialSgsi->update($request->all());

        if ($request->input('archivo', false)) {
            if (!$materialSgsi->archivo || $request->input('archivo') !== $materialSgsi->archivo->file_name) {
                if ($materialSgsi->archivo) {
                    $materialSgsi->archivo->delete();
                }

                $materialSgsi->addMedia(storage_path('tmp/uploads/' . $request->input('archivo')))->toMediaCollection('archivo');
            }
        } elseif ($materialSgsi->archivo) {
            $materialSgsi->archivo->delete();
        }

        return redirect()->route('frontend.material-sgsis.index');
    }

    public function show(MaterialSgsi $materialSgsi)
    {
        abort_if(Gate::denies('material_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialSgsi->load('arearesponsable', 'team');

        return view('frontend.materialSgsis.show', compact('materialSgsi'));
    }

    public function destroy(MaterialSgsi $materialSgsi)
    {
        abort_if(Gate::denies('material_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialSgsi->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaterialSgsiRequest $request)
    {
        MaterialSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('material_sgsi_create') && Gate::denies('material_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new MaterialSgsi();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

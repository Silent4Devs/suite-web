<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMaterialIsoVeinticienteRequest;
use App\Http\Requests\StoreMaterialIsoVeinticienteRequest;
use App\Http\Requests\UpdateMaterialIsoVeinticienteRequest;
use App\Models\Area;
use App\Models\MaterialIsoVeinticiente;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MaterialIsoVeinticienteController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('material_iso_veinticiente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MaterialIsoVeinticiente::with(['arearesponsable', 'team'])->select(sprintf('%s.*', (new MaterialIsoVeinticiente)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'material_iso_veinticiente_show';
                $editGate = 'material_iso_veinticiente_edit';
                $deleteGate = 'material_iso_veinticiente_delete';
                $crudRoutePart = 'material-iso-veinticientes';

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
            $table->editColumn('objetivo', function ($row) {
                return $row->objetivo ? $row->objetivo : '';
            });
            $table->editColumn('listaasistencia', function ($row) {
                return $row->listaasistencia ? '<a href="'.$row->listaasistencia->getUrl().'" target="_blank">'.trans('global.downloadFile').'</a>' : '';
            });
            $table->addColumn('arearesponsable_area', function ($row) {
                return $row->arearesponsable ? $row->arearesponsable->area : '';
            });

            $table->editColumn('tipoimparticion', function ($row) {
                return $row->tipoimparticion ? MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT[$row->tipoimparticion] : '';
            });

            $table->editColumn('materialarchivo', function ($row) {
                return $row->materialarchivo ? '<a href="'.$row->materialarchivo->getUrl().'" target="_blank">'.trans('global.downloadFile').'</a>' : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'listaasistencia', 'arearesponsable', 'materialarchivo']);

            return $table->make(true);
        }

        $areas = Area::getAll();
        $teams = Team::get();

        return view('admin.materialIsoVeinticientes.index', compact('areas', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('material_iso_veinticiente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::getAllPluck();

        return view('admin.materialIsoVeinticientes.create', compact('arearesponsables'));
    }

    public function store(StoreMaterialIsoVeinticienteRequest $request)
    {
        $materialIsoVeinticiente = MaterialIsoVeinticiente::create($request->all());

        if ($request->input('listaasistencia', false)) {
            $materialIsoVeinticiente->addMedia(storage_path('tmp/uploads/'.$request->input('listaasistencia')))->toMediaCollection('listaasistencia');
        }

        if ($request->input('materialarchivo', false)) {
            $materialIsoVeinticiente->addMedia(storage_path('tmp/uploads/'.$request->input('materialarchivo')))->toMediaCollection('materialarchivo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $materialIsoVeinticiente->id]);
        }

        return redirect()->route('admin.material-iso-veinticientes.index');
    }

    public function edit(MaterialIsoVeinticiente $materialIsoVeinticiente)
    {
        abort_if(Gate::denies('material_iso_veinticiente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $arearesponsables = Area::getAllPluck();

        $materialIsoVeinticiente->load('arearesponsable', 'team');

        return view('admin.materialIsoVeinticientes.edit', compact('arearesponsables', 'materialIsoVeinticiente'));
    }

    public function update(UpdateMaterialIsoVeinticienteRequest $request, MaterialIsoVeinticiente $materialIsoVeinticiente)
    {
        $materialIsoVeinticiente->update($request->all());

        if ($request->input('listaasistencia', false)) {
            if (! $materialIsoVeinticiente->listaasistencia || $request->input('listaasistencia') !== $materialIsoVeinticiente->listaasistencia->file_name) {
                if ($materialIsoVeinticiente->listaasistencia) {
                    $materialIsoVeinticiente->listaasistencia->delete();
                }

                $materialIsoVeinticiente->addMedia(storage_path('tmp/uploads/'.$request->input('listaasistencia')))->toMediaCollection('listaasistencia');
            }
        } elseif ($materialIsoVeinticiente->listaasistencia) {
            $materialIsoVeinticiente->listaasistencia->delete();
        }

        if ($request->input('materialarchivo', false)) {
            if (! $materialIsoVeinticiente->materialarchivo || $request->input('materialarchivo') !== $materialIsoVeinticiente->materialarchivo->file_name) {
                if ($materialIsoVeinticiente->materialarchivo) {
                    $materialIsoVeinticiente->materialarchivo->delete();
                }

                $materialIsoVeinticiente->addMedia(storage_path('tmp/uploads/'.$request->input('materialarchivo')))->toMediaCollection('materialarchivo');
            }
        } elseif ($materialIsoVeinticiente->materialarchivo) {
            $materialIsoVeinticiente->materialarchivo->delete();
        }

        return redirect()->route('admin.material-iso-veinticientes.index');
    }

    public function show(MaterialIsoVeinticiente $materialIsoVeinticiente)
    {
        abort_if(Gate::denies('material_iso_veinticiente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialIsoVeinticiente->load('arearesponsable', 'team');

        return view('admin.materialIsoVeinticientes.show', compact('materialIsoVeinticiente'));
    }

    public function destroy(MaterialIsoVeinticiente $materialIsoVeinticiente)
    {
        abort_if(Gate::denies('material_iso_veinticiente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $materialIsoVeinticiente->delete();

        return back();
    }

    public function massDestroy(MassDestroyMaterialIsoVeinticienteRequest $request)
    {
        MaterialIsoVeinticiente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('material_iso_veinticiente_create') && Gate::denies('material_iso_veinticiente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new MaterialIsoVeinticiente();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

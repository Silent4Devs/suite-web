<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPlanBaseActividadeRequest;
use App\Http\Requests\StorePlanBaseActividadeRequest;
use App\Http\Requests\UpdatePlanBaseActividadeRequest;
use App\Models\EnlacesEjecutar;
use App\Models\EstatusPlanTrabajo;
use App\Models\PlanBaseActividade;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class PlanBaseActividadesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('plan_base_actividade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = PlanBaseActividade::with(['actividad_padre', 'ejecutar', 'estatus', 'responsable', 'colaborador', 'team'])->select(sprintf('%s.*', (new PlanBaseActividade)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'plan_base_actividade_show';
                $editGate = 'plan_base_actividade_edit';
                $deleteGate = 'plan_base_actividade_delete';
                $crudRoutePart = 'plan-base-actividades';

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
            $table->editColumn('actividad', function ($row) {
                return $row->actividad ? $row->actividad : '';
            });
            $table->editColumn('actividad_padre', function ($row) {
                return $row->actividad_padre ? $row->actividad_padre->actividad : '';
            });

            $table->editColumn('ejecutar', function ($row) {
                return $row->ejecutar ? $row->ejecutar->ejecutar : '';
            });

            $table->editColumn('guia', function ($row) {
                return $row->guia ? '<a href="' . $row->guia->getUrl() . '" target="_blank">' . trans('global.downloadFile') . '</a>' : '';
            });
            $table->editColumn('estado', function ($row) {
                return $row->estatus ? $row->estatus->estado : '';
            });

            $table->editColumn('responsable', function ($row) {
                return $row->responsable ? $row->responsable->name : '';
            });

            $table->editColumn('colaborador', function ($row) {
                return $row->colaborador ? $row->colaborador->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'actividad_padre', 'ejecutar', 'guia', 'estatus', 'responsable', 'colaborador']);

            //$table->rawColumns(['actions', 'placeholder']);
            return $table->make(true);
        }

        $plan_base_actividades = PlanBaseActividade::get();
        $enlaces_ejecutars = EnlacesEjecutar::get();
        $estatus_plan_trabajos = EstatusPlanTrabajo::get();
        $users = User::getAll();
        $teams = Team::get();

        return view('admin.planBaseActividades.index', compact('plan_base_actividades', 'enlaces_ejecutars', 'estatus_plan_trabajos', 'users', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_base_actividade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::getAll();

        $actividad_padres = PlanBaseActividade::all()->pluck('actividad', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ejecutars = EnlacesEjecutar::all()->pluck('ejecutar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estatuses = EstatusPlanTrabajo::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colaboradors = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.planBaseActividades.create', compact('actividad_padres', 'ejecutars', 'estatuses', 'responsables', 'colaboradors'));
    }

    public function store(StorePlanBaseActividadeRequest $request)
    {
        $planBaseActividade = PlanBaseActividade::create($request->all());

        if ($request->input('guia', false)) {
            $planBaseActividade->addMedia(storage_path('tmp/uploads/' . $request->input('guia')))->toMediaCollection('guia');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $planBaseActividade->id]);
        }

        return redirect()->route('admin.plan-base-actividades.index');
    }

    public function edit(PlanBaseActividade $planBaseActividade)
    {
        abort_if(Gate::denies('plan_base_actividade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::getAll();

        $actividad_padres = PlanBaseActividade::all()->pluck('actividad', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ejecutars = EnlacesEjecutar::all()->pluck('ejecutar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estatuses = EstatusPlanTrabajo::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colaboradors = $users->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planBaseActividade->load('actividad_padre', 'ejecutar', 'estatus', 'responsable', 'colaborador', 'team');

        return view('admin.planBaseActividades.edit', compact('actividad_padres', 'ejecutars', 'estatuses', 'responsables', 'colaboradors', 'planBaseActividade'));
    }

    public function update(UpdatePlanBaseActividadeRequest $request, PlanBaseActividade $planBaseActividade)
    {
        $planBaseActividade->update($request->all());

        if ($request->input('guia', false)) {
            if (!$planBaseActividade->guia || $request->input('guia') !== $planBaseActividade->guia->file_name) {
                if ($planBaseActividade->guia) {
                    $planBaseActividade->guia->delete();
                }

                $planBaseActividade->addMedia(storage_path('tmp/uploads/' . $request->input('guia')))->toMediaCollection('guia');
            }
        } elseif ($planBaseActividade->guia) {
            $planBaseActividade->guia->delete();
        }

        return redirect()->route('admin.plan-base-actividades.index');
        // if ($request->ajax()) {
        //     switch ($request->name) {
        //         case 'estatus_id':
        //             $planBaseActividade = PlanBaseActividade::findOrFail($request->id);
        //             $planBaseActividade->estatus_id = $request->value;
        //             $planBaseActividade->save();
        //             return response()->json(['success' => true]);
        //             break;
        //         default:
        //             break;
        //     }
        // }

        // if ($request->ajax()) {​​
        //     switch ($request->name) {​​
        //         case 'estatus_id':
        //             $planBaseActividade = PlanBaseActividade::findOrFail($id);
        //             $planBaseActividade->estatus_id = $request->value;
        //             $planBaseActividade->save();
        //             return response()->json(['success' => true]);
        //         break;
        //     }​
        // }
    }

    /*public function update(Request $request, $id){
    if ($request->ajax()) {​​
        switch ($request->name) {​​
            case 'estatus_id':
                $gapun = PlanBaseActividade::findOrFail($id);
                $gapun->estatus_id = $request->value;
                $gapun->save();
                return response()->json(['success' => true]);
                break;
            }​
        }
    }*/

    public function show(PlanBaseActividade $planBaseActividade)
    {
        abort_if(Gate::denies('plan_base_actividade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planBaseActividade->load('actividad_padre', 'ejecutar', 'estatus', 'responsable', 'colaborador', 'team');

        return view('admin.planBaseActividades.show', compact('planBaseActividade'));
    }

    public function destroy(PlanBaseActividade $planBaseActividade)
    {
        abort_if(Gate::denies('plan_base_actividade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planBaseActividade->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanBaseActividadeRequest $request)
    {
        PlanBaseActividade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('plan_base_actividade_create') && Gate::denies('plan_base_actividade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model = new PlanBaseActividade();
        $model->id = $request->input('crud_id', 0);
        $model->exists = true;
        $media = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

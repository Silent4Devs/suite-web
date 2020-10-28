<?php

namespace App\Http\Controllers\Frontend;

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

class PlanBaseActividadesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('plan_base_actividade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planBaseActividades = PlanBaseActividade::all();

        $plan_base_actividades = PlanBaseActividade::get();

        $enlaces_ejecutars = EnlacesEjecutar::get();

        $estatus_plan_trabajos = EstatusPlanTrabajo::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.planBaseActividades.index', compact('planBaseActividades', 'plan_base_actividades', 'enlaces_ejecutars', 'estatus_plan_trabajos', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_base_actividade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actividad_padres = PlanBaseActividade::all()->pluck('actividad', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ejecutars = EnlacesEjecutar::all()->pluck('ejecutar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estatuses = EstatusPlanTrabajo::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colaboradors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.planBaseActividades.create', compact('actividad_padres', 'ejecutars', 'estatuses', 'responsables', 'colaboradors'));
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

        return redirect()->route('frontend.plan-base-actividades.index');
    }

    public function edit(PlanBaseActividade $planBaseActividade)
    {
        abort_if(Gate::denies('plan_base_actividade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $actividad_padres = PlanBaseActividade::all()->pluck('actividad', 'id')->prepend(trans('global.pleaseSelect'), '');

        $ejecutars = EnlacesEjecutar::all()->pluck('ejecutar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $estatuses = EstatusPlanTrabajo::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $colaboradors = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planBaseActividade->load('actividad_padre', 'ejecutar', 'estatus', 'responsable', 'colaborador', 'team');

        return view('frontend.planBaseActividades.edit', compact('actividad_padres', 'ejecutars', 'estatuses', 'responsables', 'colaboradors', 'planBaseActividade'));
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

        return redirect()->route('frontend.plan-base-actividades.index');
    }

    public function show(PlanBaseActividade $planBaseActividade)
    {
        abort_if(Gate::denies('plan_base_actividade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planBaseActividade->load('actividad_padre', 'ejecutar', 'estatus', 'responsable', 'colaborador', 'team');

        return view('frontend.planBaseActividades.show', compact('planBaseActividade'));
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

        $model         = new PlanBaseActividade();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}

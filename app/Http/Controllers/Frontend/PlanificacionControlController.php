<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanificacionControlRequest;
use App\Http\Requests\StorePlanificacionControlRequest;
use App\Http\Requests\UpdatePlanificacionControlRequest;
use App\Models\PlanificacionControl;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanificacionControlController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('planificacion_control_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControls = PlanificacionControl::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.planificacionControls.index', compact('planificacionControls', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('planificacion_control_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.planificacionControls.create', compact('duenos'));
    }

    public function store(StorePlanificacionControlRequest $request)
    {
        $planificacionControl = PlanificacionControl::create($request->all());

        return redirect()->route('frontend.planificacion-controls.index');
    }

    public function edit(PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_control_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $duenos = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planificacionControl->load('dueno', 'team');

        return view('frontend.planificacionControls.edit', compact('duenos', 'planificacionControl'));
    }

    public function update(UpdatePlanificacionControlRequest $request, PlanificacionControl $planificacionControl)
    {
        $planificacionControl->update($request->all());

        return redirect()->route('frontend.planificacion-controls.index');
    }

    public function show(PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_control_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControl->load('dueno', 'team');

        return view('frontend.planificacionControls.show', compact('planificacionControl'));
    }

    public function destroy(PlanificacionControl $planificacionControl)
    {
        abort_if(Gate::denies('planificacion_control_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planificacionControl->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanificacionControlRequest $request)
    {
        PlanificacionControl::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

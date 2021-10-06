<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstatusPlanTrabajoRequest;
use App\Http\Requests\StoreEstatusPlanTrabajoRequest;
use App\Http\Requests\UpdateEstatusPlanTrabajoRequest;
use App\Models\EstatusPlanTrabajo;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class EstatusPlanTrabajoController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estatus_plan_trabajo_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajos = EstatusPlanTrabajo::all();

        $teams = Team::get();

        return view('frontend.estatusPlanTrabajos.index', compact('estatusPlanTrabajos', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('estatus_plan_trabajo_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.estatusPlanTrabajos.create');
    }

    public function store(StoreEstatusPlanTrabajoRequest $request)
    {
        $estatusPlanTrabajo = EstatusPlanTrabajo::create($request->all());

        return redirect()->route('frontend.estatus-plan-trabajos.index');
    }

    public function edit(EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajo->load('team');

        return view('frontend.estatusPlanTrabajos.edit', compact('estatusPlanTrabajo'));
    }

    public function update(UpdateEstatusPlanTrabajoRequest $request, EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        $estatusPlanTrabajo->update($request->all());

        return redirect()->route('frontend.estatus-plan-trabajos.index');
    }

    public function show(EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajo->load('team');

        return view('frontend.estatusPlanTrabajos.show', compact('estatusPlanTrabajo'));
    }

    public function destroy(EstatusPlanTrabajo $estatusPlanTrabajo)
    {
        abort_if(Gate::denies('estatus_plan_trabajo_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estatusPlanTrabajo->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstatusPlanTrabajoRequest $request)
    {
        EstatusPlanTrabajo::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanMejoraRequest;
use App\Http\Requests\StorePlanMejoraRequest;
use App\Http\Requests\UpdatePlanMejoraRequest;
use App\Models\PlanMejora;
use App\Models\Registromejora;
use App\Models\Team;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PlanMejoraController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('plan_mejora_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planMejoras = PlanMejora::all();

        $registromejoras = Registromejora::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.planMejoras.index', compact('planMejoras', 'registromejoras', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_mejora_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.planMejoras.create', compact('mejoras', 'responsables'));
    }

    public function store(StorePlanMejoraRequest $request)
    {
        $planMejora = PlanMejora::create($request->all());

        return redirect()->route('frontend.plan-mejoras.index');
    }

    public function edit(PlanMejora $planMejora)
    {
        abort_if(Gate::denies('plan_mejora_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mejoras = Registromejora::all()->pluck('nombre', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planMejora->load('mejora', 'responsable', 'team');

        return view('frontend.planMejoras.edit', compact('mejoras', 'responsables', 'planMejora'));
    }

    public function update(UpdatePlanMejoraRequest $request, PlanMejora $planMejora)
    {
        $planMejora->update($request->all());

        return redirect()->route('frontend.plan-mejoras.index');
    }

    public function show(PlanMejora $planMejora)
    {
        abort_if(Gate::denies('plan_mejora_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planMejora->load('mejora', 'responsable', 'team');

        return view('frontend.planMejoras.show', compact('planMejora'));
    }

    public function destroy(PlanMejora $planMejora)
    {
        abort_if(Gate::denies('plan_mejora_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planMejora->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanMejoraRequest $request)
    {
        PlanMejora::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

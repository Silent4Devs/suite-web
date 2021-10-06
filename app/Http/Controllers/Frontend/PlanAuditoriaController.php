<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanAuditoriumRequest;
use App\Http\Requests\StorePlanAuditoriumRequest;
use App\Http\Requests\UpdatePlanAuditoriumRequest;
use App\Models\AuditoriaAnual;
use App\Models\PlanAuditorium;
use App\Models\Team;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class PlanAuditoriaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('plan_auditorium_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditoria = PlanAuditorium::all();

        $auditoria_anuals = AuditoriaAnual::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.planAuditoria.index', compact('planAuditoria', 'auditoria_anuals', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('plan_auditorium_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditados = User::all()->pluck('name', 'id');

        return view('frontend.planAuditoria.create', compact('fechas', 'auditados'));
    }

    public function store(StorePlanAuditoriumRequest $request)
    {
        $planAuditorium = PlanAuditorium::create($request->all());
        $planAuditorium->auditados()->sync($request->input('auditados', []));

        return redirect()->route('frontend.plan-auditoria.index');
    }

    public function edit(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fechas = AuditoriaAnual::all()->pluck('fechainicio', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditados = User::all()->pluck('name', 'id');

        $planAuditorium->load('fecha', 'auditados', 'team');

        return view('frontend.planAuditoria.edit', compact('fechas', 'auditados', 'planAuditorium'));
    }

    public function update(UpdatePlanAuditoriumRequest $request, PlanAuditorium $planAuditorium)
    {
        $planAuditorium->update($request->all());
        $planAuditorium->auditados()->sync($request->input('auditados', []));

        return redirect()->route('frontend.plan-auditoria.index');
    }

    public function show(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->load('fecha', 'auditados', 'team');

        return view('frontend.planAuditoria.show', compact('planAuditorium'));
    }

    public function destroy(PlanAuditorium $planAuditorium)
    {
        abort_if(Gate::denies('plan_auditorium_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planAuditorium->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanAuditoriumRequest $request)
    {
        PlanAuditorium::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

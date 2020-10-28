<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPlanaccionCorrectivaRequest;
use App\Http\Requests\StorePlanaccionCorrectivaRequest;
use App\Http\Requests\UpdatePlanaccionCorrectivaRequest;
use App\Models\AccionCorrectiva;
use App\Models\PlanaccionCorrectiva;
use App\Models\Team;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlanaccionCorrectivaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('planaccion_correctiva_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planaccionCorrectivas = PlanaccionCorrectiva::all();

        $accion_correctivas = AccionCorrectiva::get();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.planaccionCorrectivas.index', compact('planaccionCorrectivas', 'accion_correctivas', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('planaccion_correctiva_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accioncorrectivas = AccionCorrectiva::all()->pluck('tema', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.planaccionCorrectivas.create', compact('accioncorrectivas', 'responsables'));
    }

    public function store(StorePlanaccionCorrectivaRequest $request)
    {
        $planaccionCorrectiva = PlanaccionCorrectiva::create($request->all());

        return redirect()->route('frontend.planaccion-correctivas.index');
    }

    public function edit(PlanaccionCorrectiva $planaccionCorrectiva)
    {
        abort_if(Gate::denies('planaccion_correctiva_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $accioncorrectivas = AccionCorrectiva::all()->pluck('tema', 'id')->prepend(trans('global.pleaseSelect'), '');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $planaccionCorrectiva->load('accioncorrectiva', 'responsable', 'team');

        return view('frontend.planaccionCorrectivas.edit', compact('accioncorrectivas', 'responsables', 'planaccionCorrectiva'));
    }

    public function update(UpdatePlanaccionCorrectivaRequest $request, PlanaccionCorrectiva $planaccionCorrectiva)
    {
        $planaccionCorrectiva->update($request->all());

        return redirect()->route('frontend.planaccion-correctivas.index');
    }

    public function show(PlanaccionCorrectiva $planaccionCorrectiva)
    {
        abort_if(Gate::denies('planaccion_correctiva_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planaccionCorrectiva->load('accioncorrectiva', 'responsable', 'team');

        return view('frontend.planaccionCorrectivas.show', compact('planaccionCorrectiva'));
    }

    public function destroy(PlanaccionCorrectiva $planaccionCorrectiva)
    {
        abort_if(Gate::denies('planaccion_correctiva_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $planaccionCorrectiva->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlanaccionCorrectivaRequest $request)
    {
        PlanaccionCorrectiva::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

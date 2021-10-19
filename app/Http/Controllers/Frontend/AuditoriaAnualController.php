<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAuditoriaAnualRequest;
use App\Http\Requests\StoreAuditoriaAnualRequest;
use App\Http\Requests\UpdateAuditoriaAnualRequest;
use App\Models\AuditoriaAnual;
use App\Models\Team;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class AuditoriaAnualController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('auditoria_anual_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnuals = AuditoriaAnual::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.auditoriaAnuals.index', compact('auditoriaAnuals', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('auditoria_anual_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.auditoriaAnuals.create', compact('auditorliders'));
    }

    public function store(StoreAuditoriaAnualRequest $request)
    {
        $auditoriaAnual = AuditoriaAnual::create($request->all());

        return redirect()->route('frontend.auditoria-anuals.index');
    }

    public function edit(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('auditoria_anual_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditorliders = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $auditoriaAnual->load('auditorlider', 'team');

        return view('frontend.auditoriaAnuals.edit', compact('auditorliders', 'auditoriaAnual'));
    }

    public function update(UpdateAuditoriaAnualRequest $request, AuditoriaAnual $auditoriaAnual)
    {
        $auditoriaAnual->update($request->all());

        return redirect()->route('frontend.auditoria-anuals.index');
    }

    public function show(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('auditoria_anual_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnual->load('auditorlider', 'team', 'fechaPlanAuditoria');

        return view('frontend.auditoriaAnuals.show', compact('auditoriaAnual'));
    }

    public function destroy(AuditoriaAnual $auditoriaAnual)
    {
        abort_if(Gate::denies('auditoria_anual_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $auditoriaAnual->delete();

        return back();
    }

    public function massDestroy(MassDestroyAuditoriaAnualRequest $request)
    {
        AuditoriaAnual::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

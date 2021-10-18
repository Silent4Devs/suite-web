<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIndicadoresSgsiRequest;
use App\Http\Requests\StoreIndicadoresSgsiRequest;
use App\Http\Requests\UpdateIndicadoresSgsiRequest;
use App\Models\IndicadoresSgsi;
use App\Models\Team;
use App\Models\User;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class IndicadoresSgsiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('indicadores_sgsi_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsis = IndicadoresSgsi::all();

        $users = User::get();

        $teams = Team::get();

        return view('frontend.indicadoresSgsis.index', compact('indicadoresSgsis', 'users', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('indicadores_sgsi_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.indicadoresSgsis.create', compact('responsables'));
    }

    public function store(StoreIndicadoresSgsiRequest $request)
    {
        $indicadoresSgsi = IndicadoresSgsi::create($request->all());

        return redirect()->route('frontend.indicadores-sgsis.index');
    }

    public function edit(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $responsables = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $indicadoresSgsi->load('responsable', 'team');

        return view('frontend.indicadoresSgsis.edit', compact('responsables', 'indicadoresSgsi'));
    }

    public function update(UpdateIndicadoresSgsiRequest $request, IndicadoresSgsi $indicadoresSgsi)
    {
        $indicadoresSgsi->update($request->all());

        return redirect()->route('frontend.indicadores-sgsis.index');
    }

    public function show(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsi->load('responsable', 'team');

        return view('frontend.indicadoresSgsis.show', compact('indicadoresSgsi'));
    }

    public function destroy(IndicadoresSgsi $indicadoresSgsi)
    {
        abort_if(Gate::denies('indicadores_sgsi_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $indicadoresSgsi->delete();

        return back();
    }

    public function massDestroy(MassDestroyIndicadoresSgsiRequest $request)
    {
        IndicadoresSgsi::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

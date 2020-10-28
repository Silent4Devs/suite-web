<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyRiesgosoportunidadeRequest;
use App\Http\Requests\StoreRiesgosoportunidadeRequest;
use App\Http\Requests\UpdateRiesgosoportunidadeRequest;
use App\Models\Controle;
use App\Models\Riesgosoportunidade;
use App\Models\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RiesgosoportunidadesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('riesgosoportunidade_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgosoportunidades = Riesgosoportunidade::all();

        $controles = Controle::get();

        $teams = Team::get();

        return view('frontend.riesgosoportunidades.index', compact('riesgosoportunidades', 'controles', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('riesgosoportunidade_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.riesgosoportunidades.create', compact('controls'));
    }

    public function store(StoreRiesgosoportunidadeRequest $request)
    {
        $riesgosoportunidade = Riesgosoportunidade::create($request->all());

        return redirect()->route('frontend.riesgosoportunidades.index');
    }

    public function edit(Riesgosoportunidade $riesgosoportunidade)
    {
        abort_if(Gate::denies('riesgosoportunidade_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $controls = Controle::all()->pluck('control', 'id')->prepend(trans('global.pleaseSelect'), '');

        $riesgosoportunidade->load('control', 'team');

        return view('frontend.riesgosoportunidades.edit', compact('controls', 'riesgosoportunidade'));
    }

    public function update(UpdateRiesgosoportunidadeRequest $request, Riesgosoportunidade $riesgosoportunidade)
    {
        $riesgosoportunidade->update($request->all());

        return redirect()->route('frontend.riesgosoportunidades.index');
    }

    public function show(Riesgosoportunidade $riesgosoportunidade)
    {
        abort_if(Gate::denies('riesgosoportunidade_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgosoportunidade->load('control', 'team');

        return view('frontend.riesgosoportunidades.show', compact('riesgosoportunidade'));
    }

    public function destroy(Riesgosoportunidade $riesgosoportunidade)
    {
        abort_if(Gate::denies('riesgosoportunidade_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $riesgosoportunidade->delete();

        return back();
    }

    public function massDestroy(MassDestroyRiesgosoportunidadeRequest $request)
    {
        Riesgosoportunidade::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

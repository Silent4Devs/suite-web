<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEstadoIncidenteRequest;
use App\Http\Requests\StoreEstadoIncidenteRequest;
use App\Http\Requests\UpdateEstadoIncidenteRequest;
use App\Models\EstadoIncidente;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class EstadoIncidentesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('estado_incidente_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidentes = EstadoIncidente::all();

        $teams = Team::get();

        return view('frontend.estadoIncidentes.index', compact('estadoIncidentes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('estado_incidente_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.estadoIncidentes.create');
    }

    public function store(StoreEstadoIncidenteRequest $request)
    {
        $estadoIncidente = EstadoIncidente::create($request->all());

        return redirect()->route('frontend.estado-incidentes.index');
    }

    public function edit(EstadoIncidente $estadoIncidente)
    {
        abort_if(Gate::denies('estado_incidente_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidente->load('team');

        return view('frontend.estadoIncidentes.edit', compact('estadoIncidente'));
    }

    public function update(UpdateEstadoIncidenteRequest $request, EstadoIncidente $estadoIncidente)
    {
        $estadoIncidente->update($request->all());

        return redirect()->route('frontend.estado-incidentes.index');
    }

    public function show(EstadoIncidente $estadoIncidente)
    {
        abort_if(Gate::denies('estado_incidente_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidente->load('team');

        return view('frontend.estadoIncidentes.show', compact('estadoIncidente'));
    }

    public function destroy(EstadoIncidente $estadoIncidente)
    {
        abort_if(Gate::denies('estado_incidente_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $estadoIncidente->delete();

        return back();
    }

    public function massDestroy(MassDestroyEstadoIncidenteRequest $request)
    {
        EstadoIncidente::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

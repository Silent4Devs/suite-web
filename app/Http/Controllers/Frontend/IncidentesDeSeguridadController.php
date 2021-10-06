<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyIncidentesDeSeguridadRequest;
use App\Http\Requests\StoreIncidentesDeSeguridadRequest;
use App\Http\Requests\UpdateIncidentesDeSeguridadRequest;
use App\Models\Activo;
use App\Models\EstadoIncidente;
use App\Models\IncidentesDeSeguridad;
use App\Models\Team;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class IncidentesDeSeguridadController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incidentes_de_seguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesDeSeguridads = IncidentesDeSeguridad::all();

        $activos = Activo::get();

        $estado_incidentes = EstadoIncidente::get();

        $teams = Team::get();

        return view('frontend.incidentesDeSeguridads.index', compact('incidentesDeSeguridads', 'activos', 'estado_incidentes', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('incidentes_de_seguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activos = Activo::all()->pluck('descripcion', 'id');

        $estados = EstadoIncidente::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('frontend.incidentesDeSeguridads.create', compact('activos', 'estados'));
    }

    public function store(StoreIncidentesDeSeguridadRequest $request)
    {
        $incidentesDeSeguridad = IncidentesDeSeguridad::create($request->all());
        $incidentesDeSeguridad->activos()->sync($request->input('activos', []));

        return redirect()->route('frontend.incidentes-de-seguridads.index');
    }

    public function edit(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $activos = Activo::all()->pluck('descripcion', 'id');

        $estados = EstadoIncidente::all()->pluck('estado', 'id')->prepend(trans('global.pleaseSelect'), '');

        $incidentesDeSeguridad->load('activos', 'estado', 'team');

        return view('frontend.incidentesDeSeguridads.edit', compact('activos', 'estados', 'incidentesDeSeguridad'));
    }

    public function update(UpdateIncidentesDeSeguridadRequest $request, IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        $incidentesDeSeguridad->update($request->all());
        $incidentesDeSeguridad->activos()->sync($request->input('activos', []));

        return redirect()->route('frontend.incidentes-de-seguridads.index');
    }

    public function show(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesDeSeguridad->load('activos', 'estado', 'team');

        return view('frontend.incidentesDeSeguridads.show', compact('incidentesDeSeguridad'));
    }

    public function destroy(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesDeSeguridad->delete();

        return back();
    }

    public function massDestroy(MassDestroyIncidentesDeSeguridadRequest $request)
    {
        IncidentesDeSeguridad::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

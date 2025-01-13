<?php

namespace App\Http\Controllers\Api\Mobile\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIncidentesDeSeguridadRequest;
use App\Http\Requests\UpdateIncidentesDeSeguridadRequest;
use App\Http\Resources\Admin\IncidentesDeSeguridadResource;
use App\Models\IncidentesDeSeguridad;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class IncidentesDeSeguridadApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('incidentes_de_seguridad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidentesDeSeguridadResource(IncidentesDeSeguridad::with(['activos', 'estado', 'team'])->get());
    }

    public function store(StoreIncidentesDeSeguridadRequest $request)
    {
        $incidentesDeSeguridad = IncidentesDeSeguridad::create($request->all());
        $incidentesDeSeguridad->activos()->sync($request->input('activos', []));

        return (new IncidentesDeSeguridadResource($incidentesDeSeguridad))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new IncidentesDeSeguridadResource($incidentesDeSeguridad->load(['activos', 'estado', 'team']));
    }

    public function update(UpdateIncidentesDeSeguridadRequest $request, IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        $incidentesDeSeguridad->update($request->all());
        $incidentesDeSeguridad->activos()->sync($request->input('activos', []));

        return (new IncidentesDeSeguridadResource($incidentesDeSeguridad))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        abort_if(Gate::denies('incidentes_de_seguridad_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $incidentesDeSeguridad->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Observers;

use App\Events\IncidentesDeSeguridadEvent;
use App\Models\IncidentesDeSeguridad;

class IncidentesDeSeguridadObserver
{
    /**
     * Handle the IncidentesDeSeguridad "created" event.
     *
     * @param  \App\Models\IncidentesDeSeguridad  $incidentesDeSeguridad
     * @return void
     */
    public function created(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        event(new IncidentesDeSeguridadEvent($incidentesDeSeguridad, 'create', 'incidentes-de-seguridad', 'Incidente de Seguridad'));
    }

    /**
     * Handle the IncidentesDeSeguridad "updated" event.
     *
     * @param  \App\Models\IncidentesDeSeguridad  $incidentesDeSeguridad
     * @return void
     */
    public function updated(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        event(new IncidentesDeSeguridadEvent($incidentesDeSeguridad, 'update', 'incidentes-de-seguridad', 'Incidente de Seguridad'));
    }

    /**
     * Handle the IncidentesDeSeguridad "deleted" event.
     *
     * @param  \App\Models\IncidentesDeSeguridad  $incidentesDeSeguridad
     * @return void
     */
    public function deleted(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        event(new IncidentesDeSeguridadEvent($incidentesDeSeguridad, 'delete', 'incidentes-de-seguridad', 'Incidente de Seguridad'));
    }

    /**
     * Handle the IncidentesDeSeguridad "restored" event.
     *
     * @param  \App\Models\IncidentesDeSeguridad  $incidentesDeSeguridad
     * @return void
     */
    public function restored(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        //
    }

    /**
     * Handle the IncidentesDeSeguridad "force deleted" event.
     *
     * @param  \App\Models\IncidentesDeSeguridad  $incidentesDeSeguridad
     * @return void
     */
    public function forceDeleted(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        //
    }
}

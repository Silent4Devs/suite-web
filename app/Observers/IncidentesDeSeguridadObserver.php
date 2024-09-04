<?php

namespace App\Observers;

use App\Events\IncidentesDeSeguridadEvent;
use App\Models\IncidentesDeSeguridad;
use Illuminate\Support\Facades\Queue;

class IncidentesDeSeguridadObserver
{
    /**
     * Handle the IncidentesDeSeguridad "created" event.
     *
     * @return void
     */
    public function created(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        Queue::push(function () use ($incidentesDeSeguridad) {
            event(new IncidentesDeSeguridadEvent($incidentesDeSeguridad, 'create', 'incidentes-de-seguridad', 'Incidente de Seguridad'));
        });
    }

    /**
     * Handle the IncidentesDeSeguridad "updated" event.
     *
     * @return void
     */
    public function updated(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        Queue::push(function () use ($incidentesDeSeguridad) {
            event(new IncidentesDeSeguridadEvent($incidentesDeSeguridad, 'update', 'incidentes-de-seguridad', 'Incidente de Seguridad'));
        });
    }

    /**
     * Handle the IncidentesDeSeguridad "deleted" event.
     *
     * @return void
     */
    public function deleted(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        Queue::push(function () use ($incidentesDeSeguridad) {
            event(new IncidentesDeSeguridadEvent($incidentesDeSeguridad, 'delete', 'incidentes-de-seguridad', 'Incidente de Seguridad'));
        });
    }

    /**
     * Handle the IncidentesDeSeguridad "restored" event.
     *
     * @return void
     */
    public function restored(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        //
    }

    /**
     * Handle the IncidentesDeSeguridad "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(IncidentesDeSeguridad $incidentesDeSeguridad)
    {
        //
    }
}

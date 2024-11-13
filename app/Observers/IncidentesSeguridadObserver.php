<?php

namespace App\Observers;

use App\Models\IncidentesSeguridad;
use Illuminate\Support\Facades\Cache;

class IncidentesSeguridadObserver
{
    /**
     * Handle the IncidentesSeguridad "created" event.
     *
     * @return void
     */
    public function created(IncidentesSeguridad $incidentesSeguridad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesSeguridad "updated" event.
     *
     * @return void
     */
    public function updated(IncidentesSeguridad $incidentesSeguridad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesSeguridad "deleted" event.
     *
     * @return void
     */
    public function deleted(IncidentesSeguridad $incidentesSeguridad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesSeguridad "restored" event.
     *
     * @return void
     */
    public function restored(IncidentesSeguridad $incidentesSeguridad)
    {
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesSeguridad "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(IncidentesSeguridad $incidentesSeguridad)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('incidentes_seguridad_all');
    }
}

<?php

namespace App\Observers;

use App\Models\IncidentesVacaciones;
use Illuminate\Support\Facades\Cache;

class IncidentesVacacionesObserver
{
    /**
     * Handle the IncidentesVacaciones "created" event.
     */
    public function created(IncidentesVacaciones $incidentesVacaciones)
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesVacaciones "updated" event.
     */
    public function updated(IncidentesVacaciones $incidentesVacaciones)
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesVacaciones "deleted" event.
     */
    public function deleted(IncidentesVacaciones $incidentesVacaciones)
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesVacaciones "restored" event.
     */
    public function restored(IncidentesVacaciones $incidentesVacaciones)
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesVacaciones "force deleted" event.
     */
    public function forceDeleted(IncidentesVacaciones $incidentesVacaciones)
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('IncidentesVacaciones:incidentes_vacaciones_all');
    }
}

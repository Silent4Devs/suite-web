<?php

namespace App\Observers;

use App\Models\IncidentesDayoff;
use Illuminate\Support\Facades\Cache;

class IncidentesDayoffObserver
{
    /**
     * Handle the IncidentesDayoff "created" event.
     */
    public function created(IncidentesDayoff $incidentesDayoff): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesDayoff "updated" event.
     */
    public function updated(IncidentesDayoff $incidentesDayoff): void
    {
        $this->forgetCache();
        //
    }

    /**
     * Handle the IncidentesDayoff "deleted" event.
     */
    public function deleted(IncidentesDayoff $incidentesDayoff): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the IncidentesDayoff "restored" event.
     */
    public function restored(IncidentesDayoff $incidentesDayoff): void
    {
        $this->forgetCache();
        //
    }

    /**
     * Handle the IncidentesDayoff "force deleted" event.
     */
    public function forceDeleted(IncidentesDayoff $incidentesDayoff): void
    {
        $this->forgetCache();
        //
    }

    private function forgetCache()
    {
        Cache::forget('IncidentesDayoff:incidentes_dayoff_all');
    }
}

<?php

namespace App\Observers;

use App\Models\SolicitudDayOff;
use Illuminate\Support\Facades\Cache;

class SolicitudDayOffObserver
{
    /**
     * Handle the SolicitudDayOff "created" event.
     */
    public function created(SolicitudDayOff $solicitudDayOff): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudDayOff "updated" event.
     */
    public function updated(SolicitudDayOff $solicitudDayOff): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudDayOff "deleted" event.
     */
    public function deleted(SolicitudDayOff $solicitudDayOff): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudDayOff "restored" event.
     */
    public function restored(SolicitudDayOff $solicitudDayOff): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudDayOff "force deleted" event.
     */
    public function forceDeleted(SolicitudDayOff $solicitudDayOff): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SolicitudDayOff:solicitud_day_off_all');
    }
}

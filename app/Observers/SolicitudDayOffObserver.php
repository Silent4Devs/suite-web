<?php

namespace App\Observers;

use App\Events\SolicitudDayofEvent;
use App\Models\SolicitudDayOff;
use Illuminate\Support\Facades\Cache;

class SolicitudDayOffObserver
{
    /**
     * Handle the SolicitudDayOff "created" event.
     */
    public function created(SolicitudDayOff $solicitudDayOff): void
    {
        event(new SolicitudDayofEvent($solicitudDayOff, 'create', 'solicitud_dayoff', 'DayOff'));
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudDayOff "updated" event.
     */
    public function updated(SolicitudDayOff $solicitudDayOff): void
    {
        event(new SolicitudDayofEvent($solicitudDayOff, 'update', 'solicitud_dayoff', 'DayOff'));
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudDayOff "deleted" event.
     */
    public function deleted(SolicitudDayOff $solicitudDayOff): void
    {
        event(new SolicitudDayofEvent($solicitudDayOff, 'delete', 'solicitud_dayoff', 'DayOff'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SolicitudDayOff:solicitud_day_off_all');
    }
}

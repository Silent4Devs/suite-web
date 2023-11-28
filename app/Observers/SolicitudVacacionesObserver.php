<?php

namespace App\Observers;

use App\Models\SolicitudVacaciones;
use Illuminate\Support\Facades\Cache;

class SolicitudVacacionesObserver
{
    /**
     * Handle the SolicitudVacaciones "created" event.
     */
    public function created(SolicitudVacaciones $solicitudVacaciones): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudVacaciones "updated" event.
     */
    public function updated(SolicitudVacaciones $solicitudVacaciones): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudVacaciones "deleted" event.
     */
    public function deleted(SolicitudVacaciones $solicitudVacaciones): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudVacaciones "restored" event.
     */
    public function restored(SolicitudVacaciones $solicitudVacaciones): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudVacaciones "force deleted" event.
     */
    public function forceDeleted(SolicitudVacaciones $solicitudVacaciones): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SolicitudVacaciones:solicitud_vacaciones_all');
    }
}

<?php

namespace App\Observers;

use App\Events\SolicitudVacacionesEvent;
use App\Models\SolicitudVacaciones;
use Illuminate\Support\Facades\Cache;

class SolicitudVacacionesObserver
{
    /**
     * Handle the SolicitudVacaciones "created" event.
     */
    public function created(SolicitudVacaciones $solicitudVacaciones): void
    {
        event(new SolicitudVacacionesEvent($solicitudVacaciones, 'create', 'solicitud_vacaciones', 'Vacaciones'));
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudVacaciones "updated" event.
     */
    public function updated(SolicitudVacaciones $solicitudVacaciones): void
    {
        event(new SolicitudVacacionesEvent($solicitudVacaciones, 'create', 'solicitud_vacaciones', 'Vacaciones'));
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudVacaciones "deleted" event.
     */
    public function deleted(SolicitudVacaciones $solicitudVacaciones): void
    {
        event(new SolicitudVacacionesEvent($solicitudVacaciones, 'create', 'solicitud_vacaciones', 'Vacaciones'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SolicitudVacaciones:solicitud_vacaciones_all');
    }
}

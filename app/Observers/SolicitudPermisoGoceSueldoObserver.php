<?php

namespace App\Observers;

use App\Models\SolicitudPermisoGoceSueldo;
use Illuminate\Support\Facades\Cache;

class SolicitudPermisoGoceSueldoObserver
{
    /**
     * Handle the SolicitudPermisoGoceSueldo "created" event.
     */
    public function created(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudPermisoGoceSueldo "updated" event.
     */
    public function updated(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudPermisoGoceSueldo "deleted" event.
     */
    public function deleted(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudPermisoGoceSueldo "restored" event.
     */
    public function restored(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudPermisoGoceSueldo "force deleted" event.
     */
    public function forceDeleted(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SolicitudPermisoGoceSueldo:solicitud_permiso_goce_sueldo_all');
    }
}

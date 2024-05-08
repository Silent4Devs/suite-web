<?php

namespace App\Observers;

use App\Events\SolicitudPermisoEvent;
use App\Models\SolicitudPermisoGoceSueldo;
use Illuminate\Support\Facades\Cache;

class SolicitudPermisoGoceSueldoObserver
{
    /**
     * Handle the SolicitudPermisoGoceSueldo "created" event.
     */
    public function created(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {

        event(new SolicitudPermisoEvent($solicitudPermisoGoceSueldo, 'create', 'solicitud_permiso_goce_sueldo', 'Permiso'));
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudPermisoGoceSueldo "updated" event.
     */
    public function updated(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        event(new SolicitudPermisoEvent($solicitudPermisoGoceSueldo, 'update', 'solicitud_permiso_goce_sueldo', 'Permiso'));
        $this->forgetCache();
    }

    /**
     * Handle the SolicitudPermisoGoceSueldo "deleted" event.
     */
    public function deleted(SolicitudPermisoGoceSueldo $solicitudPermisoGoceSueldo): void
    {
        event(new SolicitudPermisoEvent($solicitudPermisoGoceSueldo, 'delete', 'solicitud_permiso_goce_sueldo', 'Permiso'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('SolicitudPermisoGoceSueldo:solicitud_permiso_goce_sueldo_all');
    }
}

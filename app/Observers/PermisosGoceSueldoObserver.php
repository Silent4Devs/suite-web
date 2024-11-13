<?php

namespace App\Observers;

use App\Events\PermisoEvent;
use App\Models\PermisosGoceSueldo;
use Illuminate\Support\Facades\Cache;

class PermisosGoceSueldoObserver
{
    /**
     * Handle the PermisosGoceSueldo "created" event.
     */
    public function created(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        event(new PermisoEvent($permisosGoceSueldo, 'create', 'permisos_goce_sueldo', 'permiso'));
        $this->forgetCache();
    }

    /**
     * Handle the PermisosGoceSueldo "updated" event.
     */
    public function updated(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        event(new PermisoEvent($permisosGoceSueldo, 'update', 'permisos_goce_sueldo', 'permiso'));
        $this->forgetCache();
    }

    /**
     * Handle the PermisosGoceSueldo "deleted" event.
     */
    public function deleted(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        event(new PermisoEvent($permisosGoceSueldo, 'delete', 'permisos_goce_sueldo', 'permiso'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('PermisoGoceSueldo:permiso_goce_sueldo_all');
    }
}

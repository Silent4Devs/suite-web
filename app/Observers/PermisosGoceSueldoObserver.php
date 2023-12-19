<?php

namespace App\Observers;

use App\Models\PermisosGoceSueldo;
use Illuminate\Support\Facades\Cache;

class PermisosGoceSueldoObserver
{
    /**
     * Handle the PermisosGoceSueldo "created" event.
     */
    public function created(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the PermisosGoceSueldo "updated" event.
     */
    public function updated(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the PermisosGoceSueldo "deleted" event.
     */
    public function deleted(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the PermisosGoceSueldo "restored" event.
     */
    public function restored(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the PermisosGoceSueldo "force deleted" event.
     */
    public function forceDeleted(PermisosGoceSueldo $permisosGoceSueldo): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('PermisoGoceSueldo:permiso_goce_sueldo_all');
    }
}

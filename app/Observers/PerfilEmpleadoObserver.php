<?php

namespace App\Observers;

use App\Models\PerfilEmpleado;
use Illuminate\Support\Facades\Cache;

class PerfilEmpleadoObserver
{
    /**
     * Handle the PerfilEmpleado "created" event.
     */
    public function created(PerfilEmpleado $perfilEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PerfilEmpleado "updated" event.
     */
    public function updated(PerfilEmpleado $perfilEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PerfilEmpleado "deleted" event.
     */
    public function deleted(PerfilEmpleado $perfilEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PerfilEmpleado "restored" event.
     */
    public function restored(PerfilEmpleado $perfilEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the PerfilEmpleado "force deleted" event.
     */
    public function forceDeleted(PerfilEmpleado $perfilEmpleado): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('PerfilEmpleado:perfiles_empleados_all');
    }
}

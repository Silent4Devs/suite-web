<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;
use App\Models\EntendimientoOrganizacion;

class EntendimientoOrganizacionObserver
{
    /**
     * Handle the EntendimientoOrganizacion "created" event.
     */
    public function created(EntendimientoOrganizacion $entendimientoOrganizacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EntendimientoOrganizacion "updated" event.
     */
    public function updated(EntendimientoOrganizacion $entendimientoOrganizacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EntendimientoOrganizacion "deleted" event.
     */
    public function deleted(EntendimientoOrganizacion $entendimientoOrganizacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EntendimientoOrganizacion "restored" event.
     */
    public function restored(EntendimientoOrganizacion $entendimientoOrganizacion): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EntendimientoOrganizacion "force deleted" event.
     */
    public function forceDeleted(EntendimientoOrganizacion $entendimientoOrganizacion): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('EntendimientoOrganizacion:entendimientoorganizacion_with_empleado_participantes');
        Cache::forget('EntendimientoOrganizacion:entendimientoorganizacion_first');
    }
}

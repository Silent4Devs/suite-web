<?php

namespace App\Observers;

use App\Models\EntendimientoOrganizacion;
use Illuminate\Support\Facades\Cache;

class EntendimientoOrganizacionObserver
{
    /**
     * Handle the EntendimientoOrganizacion "created" event.
     */
    public function created(EntendimientoOrganizacion $entendimiento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the Documento "updated" event.
     */
    public function aprobado(EntendimientoOrganizacion $entendimiento): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the EntendimientoOrganizacion "deleted" event.
     */
    public function deleted(EntendimientoOrganizacion $entendimiento): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('EntendimientoOrganizacion:entendimientoorganizacion_with_empleado_participantes');
        Cache::forget('EntendimientoOrganizacion:entendimientoorganizacion_first');
    }
}

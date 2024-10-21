<?php

namespace App\Observers;

use App\Events\EntendimientoOrganizacionEvent;
use App\Models\EntendimientoOrganizacion;
use Illuminate\Support\Facades\Cache;

class EntendimientoOrganizacionObserver
{
    /**
     * Handle the EntendimientoOrganizacion "created" event.
     */
    public function created(EntendimientoOrganizacion $entendimiento): void
    {
        event(new EntendimientoOrganizacionEvent($entendimiento, 'create', 'entendimiento_organizacions', 'Entendimiento'));
        $this->forgetCache();
    }

    /**
     * Handle the Documento "updated" event.
     */
    public function aprobado(EntendimientoOrganizacion $entendimiento): void
    {
        event(new EntendimientoOrganizacionEvent($entendimiento, 'aprobado', 'entendimiento_organizacions', 'Foda'));
        $this->forgetCache();
    }

    /**
     * Handle the EntendimientoOrganizacion "deleted" event.
     */
    public function deleted(EntendimientoOrganizacion $entendimiento): void
    {
        event(new EntendimientoOrganizacionEvent($entendimiento, 'delete', 'entendimiento_organizacions', 'Entendimiento'));
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('EntendimientoOrganizacion:entendimientoorganizacion_with_empleado_participantes');
        Cache::forget('EntendimientoOrganizacion:entendimientoorganizacion_first');
    }
}

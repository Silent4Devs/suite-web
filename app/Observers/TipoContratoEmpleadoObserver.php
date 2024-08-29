<?php

namespace App\Observers;

use App\Models\RH\TipoContratoEmpleado;
use Illuminate\Support\Facades\Cache;

class TipoContratoEmpleadoObserver
{
    /**
     * Handle the TipoContratoEmpleado "created" event.
     */
    public function created(TipoContratoEmpleado $tipoContratoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoContratoEmpleado "updated" event.
     */
    public function updated(TipoContratoEmpleado $tipoContratoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoContratoEmpleado "deleted" event.
     */
    public function deleted(TipoContratoEmpleado $tipoContratoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoContratoEmpleado "restored" event.
     */
    public function restored(TipoContratoEmpleado $tipoContratoEmpleado): void
    {
        $this->forgetCache();
    }

    /**
     * Handle the TipoContratoEmpleado "force deleted" event.
     */
    public function forceDeleted(TipoContratoEmpleado $tipoContratoEmpleado): void
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('TipoContratoEmpleado:Tipocontratoempleado_all');
    }
}

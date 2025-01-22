<?php

namespace App\Observers;

use App\Models\RH\ObjetivoEmpleado;
use Illuminate\Support\Facades\Cache;

class ObjetivoEmpleadoObserver
{
    /**
     * Handle the ObjetivoEmpleado "created" event.
     */
    public function created(ObjetivoEmpleado $objetivoEmpleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ObjetivoEmpleado "updated" event.
     */
    public function updated(ObjetivoEmpleado $objetivoEmpleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ObjetivoEmpleado "deleted" event.
     */
    public function deleted(ObjetivoEmpleado $objetivoEmpleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ObjetivoEmpleado "restored" event.
     */
    public function restored(ObjetivoEmpleado $objetivoEmpleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the ObjetivoEmpleado "force deleted" event.
     */
    public function forceDeleted(ObjetivoEmpleado $objetivoEmpleado): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('ObjetivoEmpleado:get_all_with_objetivo');
        Cache::forget('Empleados:empleados_alta_all_area');
        Cache::forget('Empleados:empleados_alta_all_evaluaciones');
        Cache::forget('Empleados:empleados_all_objetivos_empleado');
        Cache::forget('Empleados:empleados_alta_all_objetivos_generales');
        Cache::forget('Empleados:empleados_index_all');
    }
}

<?php

namespace App\Observers;

use App\Models\Empleado;
use Illuminate\Support\Facades\Cache;

class EmpleadosObserver
{
    /**
     * Handle the Empleado "created" event.
     */
    public function created(Empleado $empleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Empleado "updated" event.
     */
    public function updated(Empleado $empleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Empleado "deleted" event.
     */
    public function deleted(Empleado $empleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Empleado "restored" event.
     */
    public function restored(Empleado $empleado): void
    {
        //
        $this->forgetCache();
    }

    /**
     * Handle the Empleado "force deleted" event.
     */
    public function forceDeleted(Empleado $empleado): void
    {
        //
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Empleados:empleados_all');
        Cache::forget('Empleados:empleados_all_borrados');
        Cache::forget('Empleados:empleados_alta');
        Cache::forget('Empleados:empleados_alta_all');
        Cache::forget('Empleados:empleados_reportes_all');
        Cache::forget('Empleados:empleados_alta_id');
        Cache::forget('Empleados:empleados_exists');
        Cache::forget('Empleados:empleados_ceo_exists');
        Cache::forget('Empleados:empleados_select_area');
        Cache::forget('Empleados:empleados_alta_area_sede_supervisor');
        Cache::forget('Empleados:empleados_alta_data_columns_all');
        Cache::forget('Empleados:empleados_data_columns_all');
        Cache::forget('Empleados:empleados_alta_WithCertificacionesCursosExperiencia');
        Cache::forget('Empleados:empleados_alta_all_area');
        Cache::forget('Empleados:empleados_all_data_columns_all');
        Cache::forget('Empleados:empleados_alta_all_evaluaciones');
        Cache::forget('Empleados:empleados_all_objetivos_empleado');
        Cache::forget('Empleados:empleados_all_evaluaciones');
        Cache::forget('Empleados:empleados_all_organigrama_tree');
        Cache::forget('Empleados:empleados_all_organigrama_tree_else');
        Cache::forget('Empleados:empleados_alta_all_objetivos_generales');
        Cache::forget('Empleados:portal_cumpleaños');
        Cache::forget('Empleados:portal_nuevos');
    }
}

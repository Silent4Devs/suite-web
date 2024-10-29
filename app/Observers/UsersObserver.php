<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;

class UsersObserver
{
    /**
     * Handle the User "created" event.
     *
     * @return void
     */
    public function created(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "updated" event.
     *
     * @return void
     */
    public function updated(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "deleted" event.
     *
     * @return void
     */
    public function deleted(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "restored" event.
     *
     * @return void
     */
    public function restored(User $user)
    {
        $this->forgetCache();
    }

    /**
     * Handle the User "force deleted" event.
     *
     * @return void
     */
    public function forceDeleted(User $user)
    {
        $this->forgetCache();
    }

    private function forgetCache()
    {
        Cache::forget('Users:users_all');
        if (auth()->check()) {
            Cache::forget('Auth_user:user' . auth()->user()->id);
        }
        Cache::forget('Users:users_exists');
        Cache::forget('Users:users_with_empleado');
        Cache::forget('Users:user_with_role');

        //Empleados
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

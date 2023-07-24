<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosDashboardTimesheet extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = [
            [
                'title' => 'visualizar_registros_dashboard_timesheet',
                'name' => 'Este permiso permite al usuario visualizar los registros del timesheet',
            ],
            [
                'title' => 'visualizar_registros_dashboard_empleados_timesheet',
                'name' => 'Este permiso permite al usuario visualizar los registros de empleados del timesheet',            ],
            [
                'title' => 'visualizar_registros_dashboard_proyectos_timesheet',
                'name' => 'Este permiso permite al usuario visualizar los registros de proyectos del timesheet',
            ],
        ];

        Permission::insert($permissions);
    }
}

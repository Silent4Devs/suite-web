<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosTimesheetAdministrador extends Seeder
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
                'title' => 'timesheet_administrador_reportes_aprobador_access',
                'name' => 'Este permiso permite al administrador acceder al modulo Reportes Aprobador de Timesheet',
            ],
            [
                'title' => 'timesheet_administrador_configuracion_access',
                'name' => 'Este permiso permite al administrador acceder al modulo Configuracion de Timesheet',
            ],
            [
                'title' => 'timesheet_administrador_reportes_access',
                'name' => 'Este permiso permite al administrador acceder al modulo Reportes Aprobador de Timesheet',
            ],
            [
                'title' => 'timesheet_administrador_dashboard_access',
                'name' => 'Este permiso permite al administrador acceder al modulo Dashboard de Timesheet',
            ],
        ];

        Permission::insert($permissions);
    }
}

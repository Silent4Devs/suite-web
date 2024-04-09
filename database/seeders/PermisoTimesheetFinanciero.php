<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisoTimesheetFinanciero extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'timesheet_administrador_reporte_financiero_access',
                'name' => 'Este permiso permite al administrador acceder al modulo Reporte financiero de Timesheet',
            ],
            [
                'title' => 'timesheet_administrador_dashboard_financiero_access',
                'name' => 'Este permiso permite al administrador acceder al modulo dashboard financiero de Timesheet',
            ],
        ];

        Permission::insert($permissions);
    }
}

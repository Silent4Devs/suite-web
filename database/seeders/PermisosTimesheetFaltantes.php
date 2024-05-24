<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosTimesheetFaltantes extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            [
                'title' => 'timesheet_edit',
                'name' => 'Este permiso permite al usuario modificar los registros de timesheet',
            ],
            [
                'title' => 'timesheet_show',
                'name' => 'Este permiso permite al usuario observar todos los registros de timesheet.',
            ],
            [
                'title' => 'timesheet_delete',
                'name' => 'Este permiso permite al usuario eliminar los registros de timesheet.',
            ],
            [
                'title' => 'timesheet_administrador_proyectos_edit',
                'name' => 'Editar Proyectos Para TimeSheet',
            ],
            [
                'title' => 'timesheet_administrador_proyectos_show',
                'name' => 'Consultar Proyectos Para TimeSheet.',
            ],

        ];

        Permission::insert($permissions);
    }
}

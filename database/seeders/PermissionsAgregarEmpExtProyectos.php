<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsAgregarEmpExtProyectos extends Seeder
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
                'title' => 'asignar_empleados',
                'name' => 'Este permiso permite al usuario asignar empleados a proyectos',
            ],
            [
                'title' => 'asignar_externos',
                'name' => 'Este permiso permite al usuario asignar proveedores externos a proyectos',
            ],
        ];

        Permission::insert($permissions);
    }
}

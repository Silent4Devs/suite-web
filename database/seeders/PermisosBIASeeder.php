<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermisosBIASeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'title' => 'matriz_bia_menu_acceder',
                'name' => 'Este permiso permite al usuario acceder al menu de Análisis BIA',
            ],
            [
                'title' => 'matriz_bia_cuestionario_acceder',
                'name' => 'Este permiso permite al usuario acceder a los registros de cuestionarios BIA',
            ],
            [
                'title' => 'matriz_bia_cuestionario_ver',
                'name' => 'Este permiso permite al usuario acceder ver cuestionario BIA',
            ],
            [
                'title' => 'matriz_bia_cuestionario_editar',
                'name' => 'Este permiso permite al usuario editar cuestionario BIA',
            ],
            [
                'title' => 'matriz_bia_cuestionario_eliminar',
                'name' => 'Este permiso permite al usuario eliminar cuestionario BIA',
            ],
            [
                'title' => 'matriz_bia_cuestionario_agregar',
                'name' => 'Este permiso permite al usuario agregar cuestionario BIA',
            ],
            [
                'title' => 'matriz_bia_matriz',
                'name' => 'Este permiso permite al usuario acceder a la matriz BIA',
            ],
            [
                'title' => 'matriz_bia_matriz_ajustes',
                'name' => 'Este permiso permite al usuario acceder los ajustes de matriz BIA',
            ],
            [
                'title' => 'matriz_bia_matriz_ajustes_modificar',
                'name' => 'Este permiso permite al usuario modificar los ajustes de matriz BIA',
            ],

        ];

        Permission::insert($permissions);

        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
    }
}

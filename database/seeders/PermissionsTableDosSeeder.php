<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableDosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        $permissions = [
            [
                'name' => 'Agregar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_create',
            ],
            [
                'name' => 'Editar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_edit',
            ],
            [
                'name' => 'Visualizar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_show',
            ],
            [
                'name' => 'Eliminar Carta de Aceptación Riesgo',
                'title' => 'carta_aceptacion_delete',
            ],
        ];

        Permission::insert($permissions);
    }
}

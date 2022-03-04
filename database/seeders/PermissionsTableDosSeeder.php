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
            'title' => 'carta-aceptacion_create',
        ],
        [
            'name' => 'Editar Carta de Aceptación Riesgo',
            'title' => 'carta-aceptacion_edit',
        ],
        [
            'name' => 'Visualizar Carta de Aceptación Riesgo',
            'title' => 'carta-aceptacion_show',
        ],
        [
            'name' => 'Eliminar Carta de Aceptación Riesgo',
            'title' => 'carta-aceptacion_delete',
        ],
        ];

        Permission::insert($permissions);
    }
}

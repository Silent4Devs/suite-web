<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermisosListasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permisos = [
            [
                'title' => 'lista_distribucion_acceder',
                'name' => 'Permite Acceder al Modulo Lista de Distribución',
            ],
            [
                'title' => 'lista_distribucion_editar',
                'name' => 'Permite Editar los participantes de las Listas de Distribución',
            ],
            [
                'title' => 'lista_informativa_acceder',
                'name' => 'Permite Acceder al Modulo Lista Informativa',
            ],
            [
                'title' => 'lista_informativa_editar',
                'name' => 'Permite Editar los participantes de las Listas Informativas',
            ],
        ];

        Permission::insert($permisos);
    }
}

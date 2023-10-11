<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionQuejasClientesSeeder extends Seeder
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
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista edit "Queja Cliente"',
                'title' => 'centro_atencion_quejas_clientes_acceder',
            ],
            [
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista crear de "Queja Cliente"',
                'title' => 'centro_atencion_quejas_clientes_create',
            ],
            [
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista edit de "Queja Cliente"',
                'title' => 'centro_atencion_quejas_cliente_edit',
            ],
            [
                'name' => 'Ese permiso permite al usuario acceder al módulo de "Centro de Atención", a la vista dashboard de "Queja Cliente"',
                'title' => 'centro_atencion_quejas_cliente_dashboard',
            ],

        ];

        Permission::insert($permissions);
    }
}

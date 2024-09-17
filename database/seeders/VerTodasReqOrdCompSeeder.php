<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class VerTodasReqOrdCompSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            [
                'name' => 'Este permiso permite visualizar todas las Requisiciones por aprobar',
                'title' => 'visualizar_todas_requisicion',
            ],

            [
                'name' => 'Este permiso permite visualizar todas las Ordenes de Comprapor aprobar',
                'title' => 'visualizar_todas_orden_compra',
            ],
        ];
        Permission::insert($permissions);
    }
}

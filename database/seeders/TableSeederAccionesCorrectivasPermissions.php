<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class TableSeederAccionesCorrectivasPermissions extends Seeder
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
                'title' => 'accion_correctiva_crear',
                'name' => 'Este permiso permite al usuario crear una "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_editar',
                'name' => 'Este permiso permite al usuario editar una "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_eliminar',
                'name' => 'Este permiso permite al usuario eliminar una "Accion correctiva"',
            ],
            [
                'title' => 'accion_correctiva_show',
                'name' => 'Este permiso permite al usuario ver una "Accion correctiva"',
            ],
        ];

        Permission::insert($permissions);
    }
}

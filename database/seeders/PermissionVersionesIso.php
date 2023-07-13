<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionVersionesIso extends Seeder
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
                'title' => 'control_versiones_iso',
                'name' => 'Este permiso permite al usuario cambiar la version activa del sistema de gestion',
            ],
        ];

        Permission::insert($permissions);
    }
}

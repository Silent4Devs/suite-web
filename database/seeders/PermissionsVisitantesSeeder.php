<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionsVisitantesSeeder extends Seeder
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
                'title' => 'visitantes_acceder',
                'name' => 'Este permiso permite al usuario acceder al módulo de visitantes',
            ],
            [
                'title' => 'visitantes_administrador',
                'name' => 'Este permiso permite al usuario administrar el módulo de visitantes',
            ],
        ];

        Permission::insert($permissions);

        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
    }
}

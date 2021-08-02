<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $consultor_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'team_';
        });
        Role::findOrFail(2)->permissions()->sync($consultor_permissions);

        $consulta_permission = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_' && substr($permission->title, 0, 5) != 'team_' && substr($permission->title, 0, 8) != 'ajustes_';
        });
        Role::findOrFail(3)->permissions()->sync($consulta_permission);
    }
}

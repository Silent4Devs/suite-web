<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsProfileProfessionalEditSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'title' => 'profile_professional_edit',
                'name' => 'Este permiso permite al usuario acceder a editar el cv de los colaboradores en prerfiles profesionales',
            ],

        ];

        Permission::insert($permissions);
    }
}

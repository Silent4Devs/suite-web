<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'title' => 'Admin',
            ],
            [
                'title' => 'Consultor',
            ],
            [
                'title' => 'Consulta',
            ],
        ];

        Role::insert($roles);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        Role::truncate();
        $roles = [
            [
                'title' => 'Admin',
            ],
            // [
            //     'title' => 'Consultor',
            // ],
            // [
            //     'title' => 'Consulta',
            // ],
            [
                'title' => 'Colaborador',
            ],
        ];

        Role::insert($roles);
    }
}

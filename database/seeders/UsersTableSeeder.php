<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => bcrypt('#S3cur3P4$$w0Rd!'),
                'remember_token' => null,
                'verification_token' => '',
                'two_factor_code' => '',
                'empleado_id' => 1,
            ],
        ];

        User::insert($users);
    }
}

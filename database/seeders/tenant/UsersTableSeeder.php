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
            ],
            [
                'name' => 'John',
                'email' => 'john@admin.com',
                'password' => bcrypt('Administrador1'),
                'remember_token' => null,
                'verification_token' => '',
                'two_factor_code' => '',
            ],
            // [
            //     'name'               => 'Omar',
            //     'email'              => 'omar@admin.com',
            //     'password'           => bcrypt('password'),
            //     'remember_token'     => null,
            //     'verification_token' => '',
            //     'two_factor_code'    => '',
            // ],
        ];

        User::insert($users);
    }
}

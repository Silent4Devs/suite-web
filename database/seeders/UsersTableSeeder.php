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
                'id'                 => 1,
                'name'               => 'Admin',
                'email'              => 'admin@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verification_token' => '',
                'two_factor_code'    => '',
            ],
            [
                'id'                 => 2,
                'name'               => 'John',
                'email'              => 'john@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verification_token' => '',
                'two_factor_code'    => '',
            ],
            [
                'id'                 => 3,
                'name'               => 'Omar',
                'email'              => 'omar@admin.com',
                'password'           => bcrypt('password'),
                'remember_token'     => null,
                'verification_token' => '',
                'two_factor_code'    => '',
            ],
        ];

        User::insert($users);
    }
}

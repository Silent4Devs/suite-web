<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class RoleUserTableSeeder extends Seeder
{
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1);

        if (! is_null(User::find(2))) {
            User::findOrFail(2)->roles()->sync(2);
        }

        // if (!is_null(User::find(3))) {
        //     User::findOrFail(3)->roles()->sync(3);
        // }

        // if (!is_null(User::find(4))) {
        //     User::findOrFail(4)->roles()->sync(4);
        // }
    }
}

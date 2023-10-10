<?php

namespace App\Traits;

use Illuminate\Support\Facades\Hash;

trait GeneratePassword
{
    public function generatePassword()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 10);
        $hashed_random_password = Hash::make($password);

        return ['hash' => $hashed_random_password, 'password' => $password];
    }
}

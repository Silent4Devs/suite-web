<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Modulo;

class ModulosTableSeeder extends Seeder
{
    public function run()
    {
        $modulos = [
            ['name' => 'Centro de Atención'],
            ['name' => 'Gestión contractual'],
            ['name' => 'Gestión Normativa'],
            ['name' => 'Gestión de Talento'],
        ];

        foreach ($modulos as $modulo) {
            Modulo::create($modulo);
        }
    }
}

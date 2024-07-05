<?php

namespace Database\Seeders;

use App\Models\Modulo;
use Illuminate\Database\Seeder;

class ModulosTableSeeder extends Seeder
{
    public function run()
    {
        $modulos = [
            ['name' => 'Centro de Atención'],
            ['name' => 'Gestión contractual'],
            ['name' => 'Gestión de Talento'],
        ];

        foreach ($modulos as $modulo) {
            Modulo::create($modulo);
        }
    }
}

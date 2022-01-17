<?php

namespace Database\Seeders;

use App\Models\Tipoactivo;
use Illuminate\Database\Seeder;

class CategoriaActivosSeeder extends Seeder
{
    public function run()
    {
        $categoria = [
            ['tipo' => 'Hardware'],
            ['tipo' => 'Software'],
            ['tipo' => 'Moviliario'],
            ['tipo' => 'Accesorios'],
            ['tipo' => 'Consumibles'],
            ['tipo' => 'Herramientas'],
            ['tipo' => 'Controles de Entorno'],
        ];

        Tipoactivo::insert($categoria);
    }
}

<?php

namespace Database\Seeders;

use App\Models\CategoriaIncidente;
use Illuminate\Database\Seeder;

class CategoriaIncidenteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = [
            [
                'id' => 1,
                'categoria' => 'Ataques',
            ],
            [
                'id' => 2,
                'categoria' => 'Código malicioso',
            ],
            [
                'id' => 3,
                'categoria' => 'Acceso no autorizado, robo o pérdida de datos',
            ],
            [
                'id' => 4,
                'categoria' => 'Pruebas y reconocimientos',
            ],
            [
                'id' => 5,
                'categoria' => 'Daños físicos',
            ],
            [
                'id' => 6,
                'categoria' => 'Abuso de privilegios y usos inadecuados',
            ],
        ];

        CategoriaIncidente::insert($categorias);
    }
}

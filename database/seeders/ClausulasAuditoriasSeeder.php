<?php

namespace Database\Seeders;

use App\Models\ClausulasAuditorias;
use Illuminate\Database\Seeder;

class ClausulasAuditoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $claus = [
            [
                'identificador' => '1',
                'nombre_clausulas' => 'Contexto',
                'descripcion' => '',
            ],
            [
                'identificador' => '2',
                'nombre_clausulas' => 'Liderazgo',
                'descripcion' => '',
            ],
            [
                'identificador' => '3',
                'nombre_clausulas' => 'Planificación',
                'descripcion' => '',
            ],
            [
                'identificador' => '4',
                'nombre_clausulas' => 'Soporte',
                'descripcion' => '',
            ],
            [
                'identificador' => '5',
                'nombre_clausulas' => 'Operación',
                'descripcion' => '',
            ],
            [
                'identificador' => '6',
                'nombre_clausulas' => 'Evaluación',
                'descripcion' => '',
            ],
            [
                'identificador' => '7',
                'nombre_clausulas' => 'Mejora',
                'descripcion' => '',
            ],
        ];

        ClausulasAuditorias::insert($claus);
    }
}

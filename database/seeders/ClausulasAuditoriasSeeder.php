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
                'nombre' => 'Contexto',
                'descripcion' => '',
            ],
            [
                'identificador' => '2',
                'nombre' => 'Liderazgo',
                'descripcion' => '',
            ],
            [
                'identificador' => '3',
                'nombre' => 'Planificación',
                'descripcion' => '',
            ],
            [
                'identificador' => '4',
                'nombre' => 'Soporte',
                'descripcion' => '',
            ],
            [
                'identificador' => '5',
                'nombre' => 'Operación',
                'descripcion' => '',
            ],
            [
                'identificador' => '6',
                'nombre' => 'Evaluación',
                'descripcion' => '',
            ],
            [
                'identificador' => '7',
                'nombre' => 'Mejora',
                'descripcion' => '',
            ],
        ];

        ClausulasAuditorias::insert($claus);
    }
}

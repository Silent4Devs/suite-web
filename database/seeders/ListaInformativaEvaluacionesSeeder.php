<?php

namespace Database\Seeders;

use App\Models\ListaInformativa;
use Illuminate\Database\Seeder;

class ListaInformativaEvaluacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $modulo = [
            [
                'modulo' => 'Capital Humano',
                'submodulo' => 'Evaluaciones Desempeño',
                'modelo' => 'EvaluacionDesempeno',
            ],
        ];

        ListaInformativa::insert($modulo);
    }
}

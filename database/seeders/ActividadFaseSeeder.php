<?php

namespace Database\Seeders;

use App\Models\ActividadFase;
use Illuminate\Database\Seeder;

class ActividadFaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ActividadFase::create(
            [
                'id' => 1,
                'fase_nombre' => 'ANALISIS INICIAL',
            ],
        );

        ActividadFase::create(
            [
                'id' => 2,
                'fase_nombre' => 'PLANEACIÓN',
            ],
        );

        ActividadFase::create(
            [
                'id' => 3,
                'fase_nombre' => 'SOPORTE',
            ],
        );

        ActividadFase::create(
            [
                'id' => 4,
                'fase_nombre' => 'OPERACIÓN DE SGSI',
            ],
        );

        ActividadFase::create(
            [
                'id' => 5,
                'fase_nombre' => 'EVALUACIÓN',
            ],
        );

        ActividadFase::create(
            [
                'id' => 6,
                'fase_nombre' => 'MEJORA CONTINUA',
            ],
        );
    }
}

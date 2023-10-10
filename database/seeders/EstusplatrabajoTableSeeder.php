<?php

namespace Database\Seeders;

use App\Models\EstatusPlanTrabajo;
use Illuminate\Database\Seeder;

class EstusplatrabajoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estadoplan = [
            [
                'id' => 1,
                'estado' => 'Sin iniciar',
                'descripcion' => 'Sin iniciar',

            ],
            [
                'id' => 2,
                'estado' => 'En proceso',
                'descripcion' => 'En proceso',

            ],
            [
                'id' => 3,
                'estado' => 'Completadas',
                'descripcion' => 'Completadas',

            ],
            [
                'id' => 4,
                'estado' => 'Retrasadas',
                'descripcion' => 'Retrasadas',

            ],
            [
                'id' => 5,
                'estado' => 'Cancelado',
                'descripcion' => 'Cancelado',

            ],
        ];
        EstatusPlanTrabajo::insert($estadoplan);
    }
}

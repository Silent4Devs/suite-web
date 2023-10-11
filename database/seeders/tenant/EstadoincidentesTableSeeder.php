<?php

namespace Database\Seeders;

use App\Models\EstadoIncidente;
use Illuminate\Database\Seeder;

class EstadoincidentesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $estadoincide = [
            [
                'id' => 1,
                'estado' => 'Cerrado',

            ],
            [
                'id' => 2,
                'estado' => 'En curso',

            ],
            [
                'id' => 3,
                'estado' => 'Pendiente',

            ],
            [
                'id' => 4,
                'estado' => 'Asignado',

            ],
            [
                'id' => 5,
                'estado' => 'Cancelado',

            ],
        ];
        EstadoIncidente::insert($estadoincide);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Iso27\ClasificacionIso;
use Illuminate\Database\Seeder;

class ClasificacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clasificacion = [
            [
                'nombre' => 'Organizacionales',
            ],
            [
                'nombre' => 'Personales',
            ],
            [
                'nombre' => 'Fisicas',
            ],
            [
                'nombre' => 'Tecnólogicas',
            ],

        ];

        ClasificacionIso::insert($clasificacion);
    }
}

<?php

namespace Database\Seeders;

use App\Models\RH\RangosResultado;
use Illuminate\Database\Seeder;

class Ev360RangosResultadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RangosResultado::create([
            'inaceptable' => 60,
            'minimo_aceptable' => 80,
            'aceptable' => 100,
            'sobresaliente' => 100,
        ]);
    }
}

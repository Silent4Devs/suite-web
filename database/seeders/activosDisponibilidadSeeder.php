<?php

namespace Database\Seeders;

use App\Models\activoDisponibilidad;
use Illuminate\Database\Seeder;

class activosDisponibilidadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $inputs = [
            [
                'id' => 1,
                'disponibilidad' => 'Baja',
                'valor' => '1',
            ],
            [
                'id' => 2,
                'disponibilidad' => 'Media',
                'valor' => '2',
            ],
            [
                'id' => 3,
                'disponibilidad' => 'Alta',
                'valor' => '3',
            ],
            [
                'id' => 4,
                'disponibilidad' => 'Crítica',
                'valor' => '4',
            ],
        ];

        activoDisponibilidad::insert($inputs);
    }
}

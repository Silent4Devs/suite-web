<?php

namespace Database\Seeders;

use App\Models\Norma;
use Illuminate\Database\Seeder;

class NormasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $normas = [
            [
                'norma' => 'iso27001',
                'descripcion' => 'Modulo de iso27001',
            ],
            [
                'norma' => 'iso9001',
                'descripcion' => 'Modulo de iso9001',
            ],
        ];

        Norma::insert($normas);
    }
}

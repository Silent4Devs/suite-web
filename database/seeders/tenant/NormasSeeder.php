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
                'norma' => 'ISO27001',
                'descripcion' => 'Módulo de ISO27001',
            ],
            [
                'norma' => 'ISO9001',
                'descripcion' => 'Módulo de ISO9001',
            ],
            [
                'norma' => 'ISO37000',
                'descripcion' => 'Módulo de ISO37000',
            ],
            [
                'norma' => 'ISO37001',
                'descripcion' => 'Módulo de ISO37001',
            ],
            [
                'norma' => 'ISO20000',
                'descripcion' => 'Módulo de ISO20000',
            ],
            [
                'norma' => 'ISO22301',
                'descripcion' => 'Módulo de ISO22301',
            ],
        ];

        Norma::insert($normas);
    }
}

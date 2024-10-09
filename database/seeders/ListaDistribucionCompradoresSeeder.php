<?php

namespace Database\Seeders;

use App\Models\ListaDistribucion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaDistribucionCompradoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $LD = [
            [
                'modulo' => 'Gestión Contractual',
                'submodulo' => 'Compradores',
                'modelo' => 'Comprador',
                'niveles' => 1,
            ],
        ];

        ListaDistribucion::insert($LD);
    }
}

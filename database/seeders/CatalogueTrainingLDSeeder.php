<?php

namespace Database\Seeders;

use App\Models\ListaDistribucion;
use Illuminate\Database\Seeder;

class CatalogueTrainingLDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modulos = [
            [
                'modulo' => 'Certificaciones',
                'submodulo' => 'Catálogo de certificaciones',
                'modelo' => 'TBCatalogueTrainingModel',
                'niveles' => 1,
            ],
        ];

        ListaDistribucion::insert($modulos);
    }
}

<?php

namespace Database\Seeders;

use App\Models\TBCatalogueTrainingModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogueTrainingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $catalogue = [
            [
                'name' => 'Curso',
                'default' => true,
            ],
            [
                'name' => 'Taller',
                'default' => true,
            ],
            [
                'name' => 'Simposio',
                'default' => true,
            ],
            [
                'name' => 'Diplomado',
                'default' => true,
            ],
            [
                'name' => 'Seminario',
                'default' => true,
            ],
            [
                'name' => 'Coloquio',
                'default' => true,
            ],
            [
                'name' => 'Congreso',
                'default' => true,
            ],
            [
                'name' => 'Foro',
                'default' => true,
            ],
            ];
        TBCatalogueTrainingModel::insert($catalogue);
    }
}
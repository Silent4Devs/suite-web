<?php

namespace Database\Seeders;

use App\Models\activoConfidencialidad;
use Illuminate\Database\Seeder;

class activosConfidencialidadSeeder extends Seeder
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
                'confidencialidad' => 'Público',
                'valor' => '1',
            ],
            [
                'id' => 2,
                'confidencialidad' => 'Uso interno',
                'valor' => '2',
            ],
            [
                'id' => 3,
                'confidencialidad' => 'Confidencial',
                'valor' => '3',
            ],
            [
                'id' => 4,
                'confidencialidad' => 'Restringido',
                'valor' => '4',
            ],
        ];

        activoConfidencialidad::insert($inputs);
    }
}

<?php

namespace Database\Seeders;

use App\Models\activoIntegridad;
use Illuminate\Database\Seeder;

class activosIntegridadSeeder extends Seeder
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
                'integridad' => 'Baja',
                'valor' => '1',
            ],
            [
                'id' => 2,
                'integridad' => 'Media',
                'valor' => '2',
            ],
            [
                'id' => 3,
                'integridad' => 'Alta',
                'valor' => '3',
            ],
            [
                'id' => 4,
                'integridad' => 'Crítica',
                'valor' => '4',
            ],
        ];

        activoIntegridad::insert($inputs);
    }
}

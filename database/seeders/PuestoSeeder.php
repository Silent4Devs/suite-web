<?php

namespace Database\Seeders;

use App\Models\Puesto;
use Illuminate\Database\Seeder;

class PuestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $puestos = [
            [
                'puesto' => 'Director(a) General',
            ],
        ];

        Puesto::insert($puestos);
    }
}

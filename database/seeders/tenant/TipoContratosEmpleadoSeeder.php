<?php

namespace Database\Seeders;

use App\Models\RH\TipoContratoEmpleado;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TipoContratosEmpleadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tipos = [
            [
                'name' => 'Indeterminado',
                'slug' => Str::slug('Indeterminado'),
                'description' => null,
            ],
            [
                'name' => 'Por proyecto',
                'slug' => Str::slug('Por proyecto'),
                'description' => null,
            ],
        ];

        TipoContratoEmpleado::insert($tipos);
    }
}

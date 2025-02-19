<?php

namespace Database\Seeders;

use App\Models\Organizacion;
use App\Models\Sede;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sede::create([
            'sede' => 'Direccion General',
            'descripcion' => 'Direccion General',
            'organizacion_id' => Organizacion::first()->id,
            'direccion' => 'Direccion General',
        ]);
    }
}

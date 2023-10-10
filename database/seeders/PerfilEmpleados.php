<?php

namespace Database\Seeders;

use App\Models\PerfilEmpleado;
use Illuminate\Database\Seeder;

class PerfilEmpleados extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfiles = [
            ['nombre' => 'Director'],
            ['nombre' => 'Gerente'],
            ['nombre' => 'Colaborador'],
        ];

        PerfilEmpleado::insert($perfiles);
    }
}

<?php

namespace Database\Seeders;

use App\Models\PanelInicioRule;
use Illuminate\Database\Seeder;

class PanelInicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $panel = [
            [
                'nombre' => 'true',
                'area' => 'true',
                'puesto' => 'true',
                'jefe_inmediato' => 'true',
                'n_empleado' => 'false',
                'perfil' => 'false',
                'fecha_ingreso' => 'false',
                'genero' => 'false',
                'estatus' => 'false',
                'email' => 'false',
                'movil' => 'false',
                'telefono' => 'false',
                'sede' => 'false',
                'direccion' => 'false',
                'cumpleaños' => 'false',
            ],
        ];

        PanelInicioRule::insert($panel);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ConvergenciaContratos;
use App\Models\TimesheetProyecto;
use Illuminate\Database\Seeder;

class ClientesdeProyectosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $proyectos = TimesheetProyecto::get();

        foreach ($proyectos as $key => $proyecto) {
            $clientes[] =
                [
                    'timesheet_proyecto_id' => $proyecto->id,
                    'timesheet_cliente_id' => $proyecto->cliente_id,
                ];
        }

        ConvergenciaContratos::insert($clientes);
    }
}

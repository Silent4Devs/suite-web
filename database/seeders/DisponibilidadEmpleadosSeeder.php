<?php

namespace Database\Seeders;

use App\Models\DisponibilidadEmpleados;
use App\Models\Empleado;
use Illuminate\Database\Seeder;

class DisponibilidadEmpleadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $ids_empleados = Empleado::getAltaDataColumns()->sortBy('id')->pluck('id');

        foreach ($ids_empleados as $key => $id) {
            $empleados[] =
                [
                    'empleado_id' => $id,
                    'disponibilidad' => 1,
                ];
        }

        DisponibilidadEmpleados::insert($empleados);
    }
}

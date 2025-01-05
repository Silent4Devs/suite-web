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
        // Obtener IDs de empleados activos
        $ids_empleados = Empleado::getAltaDataColumns()->sortBy('id')->pluck('id')->toArray();

        // Validar que los IDs existen en la tabla empleados
        $ids_validos = Empleado::whereIn('id', $ids_empleados)->pluck('id')->toArray();

        $empleados = [];
        foreach ($ids_validos as $id) {
            $empleados[] = [
                'empleado_id' => $id,
                'disponibilidad' => 1,
            ];
        }

        // Insertar datos si hay empleados válidos
        if (!empty($empleados)) {
            DisponibilidadEmpleados::insert($empleados);
        }
    }

}

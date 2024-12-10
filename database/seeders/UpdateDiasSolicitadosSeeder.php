<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SolicitudVacaciones;
use Carbon\Carbon;

class UpdateDiasSolicitadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todas las solicitudes donde dias_solicitados está vacío o es nulo
        $solicitudes = SolicitudVacaciones::whereNull('dias_solicitados')->get();

        foreach ($solicitudes as $solicitud) {
            // Verificar que las columnas de fecha no sean nulas
            if ($solicitud->fecha_inicio && $solicitud->fecha_fin) {
                // Calcular la diferencia en días entre fecha_inicio y fecha_fin
                $fechaInicio = Carbon::parse($solicitud->fecha_inicio);
                $fechaFin = Carbon::parse($solicitud->fecha_fin);
                $diasSolicitados = $fechaInicio->diffInDays($fechaFin) + 1; // +1 para incluir el día inicial

                // Actualizar el registro con el valor calculado
                $solicitud->update([
                    'dias_solicitados' => $diasSolicitados,
                ]);
            }
        }
    }
}

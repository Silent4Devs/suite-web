<?php

namespace Database\Seeders;

use App\Models\TimesheetHoras;
use Illuminate\Database\Seeder;

class EspaciosBlancoTimesheetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campos_vacios = TimesheetHoras::where('horas_lunes', '=', '')
            ->orWhere('horas_martes', '=', '')
            ->orWhere('horas_miercoles', '=', '')
            ->orWhere('horas_jueves', '=', '')
            ->orWhere('horas_viernes', '=', '')
            ->orWhere('horas_sabado', '=', '')
            ->orWhere('horas_domingo', '=', '')
            ->get();

        foreach ($campos_vacios as $registro) {
            $registro->horas_lunes = $registro->horas_lunes === '' ? null : $registro->horas_lunes;
            $registro->horas_martes = $registro->horas_martes === '' ? null : $registro->horas_martes;
            $registro->horas_miercoles = $registro->horas_miercoles === '' ? null : $registro->horas_miercoles;
            $registro->horas_jueves = $registro->horas_jueves === '' ? null : $registro->horas_jueves;
            $registro->horas_viernes = $registro->horas_viernes === '' ? null : $registro->horas_viernes;
            $registro->horas_sabado = $registro->horas_sabado === '' ? null : $registro->horas_sabado;
            $registro->horas_domingo = $registro->horas_domingo === '' ? null : $registro->horas_domingo;

            $registro->save();
        }
    }
}

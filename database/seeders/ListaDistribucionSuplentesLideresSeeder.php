<?php

namespace Database\Seeders;

use App\Models\Empleado;
use App\Models\ListaDistribucion;
use App\Models\ParticipantesListaDistribucion;
use Illuminate\Database\Seeder;

class ListaDistribucionSuplentesLideresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $employees = Empleado::getIdNameAll();
        $supervisores = $employees->filter(function ($emp) {
            return $emp->es_supervisor;
        })->pluck('id');

        $cuenta = $supervisores->count();

        $modulo = ListaDistribucion::create([
            'modulo' => 'Gestión Contractual',
            'submodulo' => 'Requisiciones-Lideres',
            'modelo' => 'Empleado',
            'niveles' => $cuenta,
        ]);

        foreach ($supervisores as $key => $supervisor_id) {
            ParticipantesListaDistribucion::create([
                'modulo_id' => $modulo->id,
                'nivel' => $key + 1,
                'numero_orden' => 1,
                'empleado_id' => $supervisor_id,
            ]);
        }
    }
}

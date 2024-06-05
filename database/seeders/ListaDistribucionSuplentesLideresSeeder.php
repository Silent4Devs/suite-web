<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\ListaDistribucion;
use App\Models\ParticipantesListaDistribucion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ListaDistribucionSuplentesLideresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $areas = Area::get();
        $cuentaArea = $areas->count();

        $modulo = ListaDistribucion::create([
            'modulo' => 'Gestión Contractual',
            'submodulo' => 'Requisiciones-Lideres',
            'modelo' => 'Empleado',
            'niveles' => $cuentaArea,
        ]);

        foreach ($areas as $key => $area) {

            $lider = ParticipantesListaDistribucion::create([
                'modulo_id' => $modulo->id,
                'nivel' => $key + 1,
                'numero_orden' => 1,
                'empleado_id' => $area->lider->id,
            ]);
        }
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Sede;
use App\Models\Proceso;
use Livewire\Component;
use App\Models\Controle;
use App\Models\MatrizRiesgo;

class MatrizHeatmap extends Component
{
    public $id_analisis, $sede, $control, $matriz, $area, $proceso;

    public function render()
    {
        $sedes = Sede::get();
        $matriz_heat = MatrizRiesgo::with(['controles'])->where('id_analisis', '=', $this->id_analisis)->get();
        $areas = Area::get();
        $procesos = Proceso::get();

        return view('livewire.matriz-heatmap', [
            'sedes' => $sedes,
            /*'controles' => $controles,
            'matriz_heat' => $matriz_heat,*/
            'areas' => $areas,
            'procesos' => $procesos,
        ]);
    }

    public function updateQuery(){

    }


}

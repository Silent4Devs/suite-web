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
    public $id_analisis, $sede, $control, $matriz, $area, $proceso, $valor_riesgo;
    public $listado = "";

    public function render()
    {
        $sedes = Sede::get();
        $matriz_heat = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad', 'impacto', 'nivelriesgo')->with(['controles'])->where('id_analisis', '=', $this->id_analisis)->get();
        $matriz_heat_residual = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad_residual', 'impacto_residual', 'nivelriesgo_residual')->with(['controles'])->where('id_analisis', '=', $this->id_analisis)->get();
        $areas = Area::get();
        $procesos = Proceso::get();

        return view('livewire.matriz-heatmap', [
            'sedes' => $sedes,
            'matriz_heats' => $matriz_heat,
            'matriz_heat_residuals' => $matriz_heat_residual,
            'areas' => $areas,
            'procesos' => $procesos,
        ]);
    }

    public function updateQueryRiesgo(){
        dd("test");
    }

    public function callFunction()
    {
        dd("test");
        $this->listado = "You clicked on button";
    }

}

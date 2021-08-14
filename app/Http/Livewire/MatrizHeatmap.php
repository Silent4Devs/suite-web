<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Sede;
use App\Models\Proceso;
use Livewire\Component;
use App\Models\MatrizRiesgo;

class MatrizHeatmap extends Component
{
    public $id_analisis, $sede, $control, $matriz, $area, $proceso, $valor_riesgo;
    public $listados = [];
    public $mensaje = '';
    public $conteo = '';
    public $changer;

    public function render()
    {
        $sedes = Sede::get();
        $areas = Area::get();
        $procesos = Proceso::get();

        return view('livewire.matriz-heatmap', [
            'sedes' => $sedes,
            'areas' => $areas,
            'procesos' => $procesos,
        ]);
    }

    public function callQuery($id, $valor)
    {
        $matriz_riesgos = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad', 'impacto', 'nivelriesgo')->with(['controles'])->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', $id)->get();
        if ($matriz_riesgos->count() == 0) {
            $this->alert('warning', 'No se encontro registro con este nivel de riesgo', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  'Por favor ingrese un nuevo valor',
                'confirmButtonText' =>  'OK',
                'cancelButtonText' =>  '',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  true,
            ]);
        } else {
            $this->changer = '';
            $this->listados = $matriz_riesgos;
            $this->changer = $valor;
            $this->conteo = $matriz_riesgos->count();
        }
    }
}

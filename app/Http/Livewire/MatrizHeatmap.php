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
    public $listados_residual = [];
    public $mensaje = '';
    public $conteo = '';
    public $conteo_residual = '';
    public $changer, $changer_residual;

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

    public function callQueryResidual($id, $valor)
    {
        $matriz_riesgos_residual = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad_residual', 'impacto_residual', 'nivelriesgo_residual')->with(['controles'])->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', $id)->get();
        if ($matriz_riesgos_residual->count() == 0) {
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
            $this->changer_residual = '';
            $this->listados_residual = $matriz_riesgos_residual;
            $this->changer_residual = $valor;
            $this->conteo_residual = $matriz_riesgos_residual->count();
        }
    }
}

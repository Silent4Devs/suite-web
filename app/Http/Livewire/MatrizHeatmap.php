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
    public $muy_alto, $alto, $medio, $bajo, $muy_alto_residual, $alto_residual, $medio_residual, $bajo_residual;

    public function mount(){

    }

    public function render()
    {
        $sedes = Sede::get();
        $areas = Area::get();
        $procesos = Proceso::get();
        $muy_alto = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '81')->count();
        $alto = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '27')->count();
        $medio = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '9')->count();
        $bajo = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '0')->count();
        $muy_alto_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '81')->count();
        $alto_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '27')->count();
        $medio_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '9')->count();
        $bajo_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '0')->count();

        return view('livewire.matriz-heatmap', [
            'sedes' => $sedes,
            'areas' => $areas,
            'procesos' => $procesos,
            'muy_altos' => $muy_alto,
            'altos' => $alto,
            'medios' => $medio,
            'bajos' => $bajo,
            'muy_altos_residual' => $muy_alto_residual,
            'altos_residual' => $alto_residual,
            'medios_residual' => $medio_residual,
            'bajos_residual' => $bajo_residual,
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

<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\Sede;
use App\Models\Proceso;
use Livewire\Component;
use App\Models\MatrizRiesgo;

class MatrizHeatmap extends Component
{
    public $id_analisis, $control, $matriz, $valor_riesgo;
    public $sede_id = "";
    public $area_id = "";
    public $proceso_id = "";
    public $listados = [];
    public $listados_residual = [];
    public $mensaje = '';
    public $conteo = '';
    public $conteo_residual = '';
    public $changer, $changer_residual;
    public $muy_alto, $alto, $medio, $bajo, $muy_alto_residual, $alto_residual, $medio_residual, $bajo_residual;

    public function clean()
    {
        $this->sede_id = "";
        $this->area_id = "";
        $this->proceso_id = "";
        $this->changer = '';
        $this->listados = [];
        $this->conteo = '';
        $this->callAlert('info', 'Los filtros se han restablecido', true, 'La información volvio a su estado original');
    }

    public function updatedSedeId($value)
    {
        $this->sede_id = $value;
    }

    public function updatedAreaId($value)
    {
        $this->area_id = $value;
    }

    public function updatedProcesoId($value)
    {
        $this->proceso_id = $value;
    }

    public function render()
    {
        $sedes = Sede::select('id', 'sede')->get();
        $areas = Area::select('id', 'area')->get();
        $procesos = Proceso::select('id', 'nombre')->get();

        $muy_alto = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo', array('54', '81'));
        $alto = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo', array('27', '36'));
        $medio = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '9');
        $bajo = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '0');
        $muy_alto_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo', array('54', '81'));
        $alto_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo', array('27', '36'));
        $medio_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '9');
        $bajo_residual = MatrizRiesgo::select('id')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '0');

        if ($this->sede_id != "") {
            if (MatrizRiesgo::select('id')->Where('id_sede', '=', $this->sede_id)->count() > 0) {
                $muy_alto->Where('id_sede', '=', $this->sede_id);
                $alto->Where('id_sede', '=', $this->sede_id);
                $medio->Where('id_sede', '=', $this->sede_id);
                $bajo->Where('id_sede', '=', $this->sede_id);
                $muy_alto_residual->Where('id_sede', '=', $this->sede_id);
                $alto_residual->Where('id_sede', '=', $this->sede_id);
                $medio_residual->Where('id_sede', '=', $this->sede_id);
                $bajo_residual->Where('id_sede', '=', $this->sede_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con esta sede', false, 'El dashboard volvio a sus valores originales sin sede');
                $this->sede_id = "";
            }
        }

        if ($this->area_id != "") {
            if (MatrizRiesgo::select('id')->Where('id_area', '=', $this->area_id)->count() > 0) {
                $muy_alto->Where('id_area', '=', $this->area_id);
                $alto->Where('id_area', '=', $this->area_id);
                $medio->Where('id_area', '=', $this->area_id);
                $bajo->Where('id_area', '=', $this->area_id);
                $muy_alto_residual->Where('id_area', '=', $this->area_id);
                $alto_residual->Where('id_area', '=', $this->area_id);
                $medio_residual->Where('id_area', '=', $this->area_id);
                $bajo_residual->Where('id_area', '=', $this->area_id);
                //dd($muy_alto->get());
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con esta área', false, 'El dashboard volvio a sus valores originales sin área');
                $this->area_id = "";
            }
        }

        if ($this->proceso_id != "") {
            if (MatrizRiesgo::select('id')->Where('id_proceso', '=', $this->proceso_id)->count() > 0) {
                $muy_alto->Where('id_proceso', '=', $this->proceso_id);
                $alto->Where('id_proceso', '=', $this->proceso_id);
                $medio->Where('id_proceso', '=', $this->proceso_id);
                $bajo->Where('id_proceso', '=', $this->proceso_id);
                $muy_alto_residual->Where('id_proceso', '=', $this->proceso_id);
                $alto_residual->Where('id_proceso', '=', $this->proceso_id);
                $medio_residual->Where('id_proceso', '=', $this->proceso_id);
                $bajo_residual->Where('id_proceso', '=', $this->proceso_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con este proceso', false, 'El dashboard volvio a sus valores originales sin proceso');
                $this->proceso_id = "";
            }
        }

        return view('livewire.matriz-heatmap', [
            'sedes' => $sedes,
            'areas' => $areas,
            'procesos' => $procesos,
            'muy_altos' => $muy_alto->count(),
            'altos' => $alto->count(),
            'medios' => $medio->count(),
            'bajos' => $bajo->count(),
            'muy_altos_residual' => $muy_alto_residual->count(),
            'altos_residual' => $alto_residual->count(),
            'medios_residual' => $medio_residual->count(),
            'bajos_residual' => $bajo_residual->count(),
        ]);
    }

    public function callQuery($id, $valor)
    {
        $matriz_riesgos = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad', 'impacto', 'nivelriesgo')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', $id);

        if ($this->sede_id != "") {
            $matriz_riesgos->Where('id_sede', '=', $this->sede_id);
        }

        if ($this->area_id != "") {
            $matriz_riesgos->Where('id_area', '=', $this->area_id);
        }

        if ($this->proceso_id != "") {
            $matriz_riesgos->Where('id_proceso', '=', $this->proceso_id);
        }

        //dd($matriz_riesgos->toSql());

        if ($matriz_riesgos->count() == 0) {
            $this->callAlert('warning', 'No se encontro registro con este nivel de riesgo', false, 'Por favor ingrese un nuevo valor');
            $this->changer = '';
            $this->listados = [];
            $this->conteo = '';
        } else {
            $this->changer = '';
            $this->listados = $matriz_riesgos->get();
            $this->changer = $valor;
            $this->conteo = $matriz_riesgos->count();
        }
    }

    public function callQueryResidual($id, $valor)
    {
        $matriz_riesgos_residual = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad_residual', 'impacto_residual', 'nivelriesgo_residual')->with(['controles'])->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', $id)->get();
        if ($matriz_riesgos_residual->count() == 0) {
            $this->callAlert('warning', 'No se encontro registro con este nivel de riesgo residual', false, 'Por favor ingrese un nuevo valor');
        } else {
            $this->changer_residual = '';
            $this->listados_residual = $matriz_riesgos_residual;
            $this->changer_residual = $valor;
            $this->conteo_residual = $matriz_riesgos_residual->count();
        }
    }

    public function callAlert($tipo, $mensaje, $bool, $test = "")
    {
        $this->alert($tipo, $mensaje, [
            'position' =>  'top-end',
            'timer' =>  3100,
            'toast' =>  true,
            'text' =>  $test,
            'confirmButtonText' =>  'Entendido',
            'cancelButtonText' =>  '',
            'showCancelButton' =>  false,
            'showConfirmButton' =>  $bool,
        ]);
    }
}

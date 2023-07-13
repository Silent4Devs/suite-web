<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\MatrizRiesgo;
use App\Models\Proceso;
use App\Models\Sede;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MatrizHeatmap extends Component
{
    use LivewireAlert;

    public $id_analisis;
    public $control;
    public $matriz;
    public $valor_riesgo;
    public $sede_id = '';
    public $area_id = '';
    public $proceso_id = '';
    public $listados = [];
    public $listados_residual = [];
    public $mensaje = '';
    public $changer;
    public $changer_residual;
    public $muy_alto;
    public $alto;
    public $medio;
    public $bajo;
    public $muy_alto_residual;
    public $alto_residual;
    public $medio_residual;
    public $bajo_residual;
    //var conta
    public $nula_muyalto = 0;
    public $nula_alto = 0;
    public $nula_medio = 0;
    public $nula_bajo = 0;
    public $baja_bajo = 0;
    public $baja_medio = 0;
    public $baja_alto = 0;
    public $baja_muyalto = 0;
    public $media_bajo = 0;
    public $media_medio = 0;
    public $media_alto = 0;
    public $media_muyalto = 0;
    public $alta_bajo = 0;
    public $alta_medio = 0;
    public $alta_alto = 0;
    public $alta_muyalto = 0;
    //var conta residual
    public $nula_muyalto_r = 0;
    public $nula_alto_r = 0;
    public $nula_medio_r = 0;
    public $nula_bajo_r = 0;
    public $baja_bajo_r = 0;
    public $baja_medio_r = 0;
    public $baja_alto_r = 0;
    public $baja_muyalto_r = 0;
    public $media_bajo_r = 0;
    public $media_medio_r = 0;
    public $media_alto_r = 0;
    public $media_muyalto_r = 0;
    public $alta_bajo_r = 0;
    public $alta_medio_r = 0;
    public $alta_alto_r = 0;
    public $alta_muyalto_r = 0;
    public $mapas = [];

    public function mount($mapas = [])
    {
        $this->mapas = $mapas;
    }

    public function clean()
    {
        $this->sede_id = '';
        $this->area_id = '';
        $this->proceso_id = '';
        $this->changer = '';
        $this->listados = [];
        $this->changer_residual = '';
        $this->listados_residual = [];
        //$this->conteo = '';
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
        $sedes = Sede::getAll(['id', 'sede']);
        $areas = Area::select('id', 'area')->get();
        $procesos = Proceso::select('id', 'nombre')->get();

        $muy_alto = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo', ['54', '81']);
        $alto = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo', ['27', '36']);
        $medio = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '9');
        $bajo = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '0');
        $muy_alto_residual = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo_residual', ['54', '81']);
        $alto_residual = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->whereIn('nivelriesgo_residual', ['27', '36']);
        $medio_residual = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '9');
        $bajo_residual = MatrizRiesgo::select('id', 'probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo_residual', '=', '0');
        //querys contador en grafica
        $matriz_query = MatrizRiesgo::select('probabilidad', 'impacto')->where('id_analisis', '=', $this->id_analisis);
        $matriz_query_r = MatrizRiesgo::select('probabilidad_residual', 'impacto_residual')->where('id_analisis', '=', $this->id_analisis);

        if ($this->sede_id != '') {
            if (MatrizRiesgo::select('id')->Where('id_sede', '=', $this->sede_id)->count() > 0) {
                $muy_alto->Where('id_sede', '=', $this->sede_id);
                $alto->Where('id_sede', '=', $this->sede_id);
                $medio->Where('id_sede', '=', $this->sede_id);
                $bajo->Where('id_sede', '=', $this->sede_id);
                $muy_alto_residual->Where('id_sede', '=', $this->sede_id);
                $alto_residual->Where('id_sede', '=', $this->sede_id);
                $medio_residual->Where('id_sede', '=', $this->sede_id);
                $bajo_residual->Where('id_sede', '=', $this->sede_id);
                $matriz_query->Where('id_sede', '=', $this->sede_id);
                $matriz_query_r->Where('id_sede', '=', $this->sede_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con esta sede', false, 'El dashboard volvio a sus valores originales sin sede');
                $this->sede_id = '';
            }
        }

        if ($this->area_id != '') {
            if (MatrizRiesgo::select('id')->Where('id_area', '=', $this->area_id)->count() > 0) {
                $muy_alto->Where('id_area', '=', $this->area_id);
                $alto->Where('id_area', '=', $this->area_id);
                $medio->Where('id_area', '=', $this->area_id);
                $bajo->Where('id_area', '=', $this->area_id);
                $muy_alto_residual->Where('id_area', '=', $this->area_id);
                $alto_residual->Where('id_area', '=', $this->area_id);
                $medio_residual->Where('id_area', '=', $this->area_id);
                $bajo_residual->Where('id_area', '=', $this->area_id);
                $matriz_query->Where('id_area', '=', $this->area_id);
                $matriz_query_r->Where('id_area', '=', $this->area_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con esta área', false, 'El dashboard volvio a sus valores originales sin área');
                $this->area_id = '';
            }
        }

        if ($this->proceso_id != '') {
            if (MatrizRiesgo::select('id')->Where('id_proceso', '=', $this->proceso_id)->count() > 0) {
                $muy_alto->Where('id_proceso', '=', $this->proceso_id);
                $alto->Where('id_proceso', '=', $this->proceso_id);
                $medio->Where('id_proceso', '=', $this->proceso_id);
                $bajo->Where('id_proceso', '=', $this->proceso_id);
                $muy_alto_residual->Where('id_proceso', '=', $this->proceso_id);
                $alto_residual->Where('id_proceso', '=', $this->proceso_id);
                $medio_residual->Where('id_proceso', '=', $this->proceso_id);
                $bajo_residual->Where('id_proceso', '=', $this->proceso_id);
                $matriz_query->Where('id_proceso', '=', $this->proceso_id);
                $matriz_query_r->Where('id_proceso', '=', $this->proceso_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con este proceso', false, 'El dashboard volvio a sus valores originales sin proceso');
                $this->proceso_id = '';
            }
        }

        //$matriz_riesgos = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad', 'impacto', 'nivelriesgo')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', '0');

        foreach ($matriz_query->get() as $key => $value) {
            switch ($value->probabilidad) {
                case 0:
                    switch ($value->impacto) {
                        case 0:
                            $this->nula_bajo++;
                            break;
                        case 3:
                            $this->nula_medio++;
                            break;
                        case 6:
                            $this->nula_alto++;
                            break;
                        case 9:
                            $this->nula_muyalto++;
                            break;
                    }
                    break;
                case 3:
                    switch ($value->impacto) {
                        case 0:
                            $this->baja_bajo++;
                            break;
                        case 3:
                            $this->baja_medio++;
                            break;
                        case 6:
                            $this->baja_alto++;
                            break;
                        case 9:
                            $this->baja_muyalto++;
                            break;
                    }
                    break;
                case 6:
                    switch ($value->impacto) {
                        case 0:
                            $this->media_bajo++;
                            break;
                        case 3:
                            $this->media_medio++;
                            break;
                        case 6:
                            $this->media_alto++;
                            break;
                        case 9:
                            $this->media_muyalto++;
                            break;
                    }
                    break;
                case 9:
                    switch ($value->impacto) {
                        case 0:
                            $this->alta_bajo++;
                            break;
                        case 3:
                            $this->alta_medio++;
                            break;
                        case 6:
                            $this->alta_alto++;
                            break;
                        case 9:
                            $this->alta_muyalto++;
                            break;
                    }
                    break;
            }
        }

        foreach ($matriz_query_r->get() as $key => $value_r) {
            switch ($value_r->probabilidad_residual) {
                case 0:
                    switch ($value_r->impacto_residual) {
                        case 0:
                            $this->nula_bajo_r++;
                            break;
                        case 3:
                            $this->nula_medio_r++;
                            break;
                        case 6:
                            $this->nula_alto_r++;
                            break;
                        case 9:
                            $this->nula_muyalto_r++;
                            break;
                    }
                    break;
                case 3:
                    switch ($value_r->impacto_residual) {
                        case 0:
                            $this->baja_bajo_r++;
                            break;
                        case 3:
                            $this->baja_medio_r++;
                            break;
                        case 6:
                            $this->baja_alto_r++;
                            break;
                        case 9:
                            $this->baja_muyalto_r++;
                            break;
                    }
                    break;
                case 6:
                    switch ($value_r->impacto_residual) {
                        case 0:
                            $this->media_bajo_r++;
                            break;
                        case 3:
                            $this->media_medio_r++;
                            break;
                        case 6:
                            $this->media_alto_r++;
                            break;
                        case 9:
                            $this->media_muyalto_r++;
                            break;
                    }
                    break;
                case 9:
                    switch ($value_r->impacto_residual) {
                        case 0:
                            $this->alta_bajo_r++;
                            break;
                        case 3:
                            $this->alta_medio_r++;
                            break;
                        case 6:
                            $this->alta_alto_r++;
                            break;
                        case 9:
                            $this->alta_muyalto_r++;
                            break;
                    }
                    break;
            }
        }

        return view('livewire.matriz-heatmap', [
            'sedes' => $sedes,
            'areas' => $areas,
            'procesos' => $procesos,
            'mapas' => $this->mapas,
            'muy_altos' => $muy_alto->count(),
            'altos' => $alto->count(),
            'medios' => $medio->count(),
            'bajos' => $bajo->count(),
            'muy_altos_residual' => $muy_alto_residual->count(),
            'altos_residual' => $alto_residual->count(),
            'medios_residual' => $medio_residual->count(),
            'bajos_residual' => $bajo_residual->count(),
            //conta
            'nula_bajo' => $this->nula_bajo,
            'nula_medio' => $this->nula_medio,
            'nula_alto' => $this->nula_alto,
            'nula_muyalto' => $this->nula_muyalto,
            'baja_bajo' => $this->baja_bajo,
            'baja_medio' => $this->baja_medio,
            'baja_alto' => $this->baja_alto,
            'baja_muyalto' => $this->baja_muyalto,
            'media_bajo' => $this->media_bajo,
            'media_medio' => $this->media_medio,
            'media_alto' => $this->media_alto,
            'media_muyalto' => $this->media_muyalto,
            'alta_bajo' => $this->alta_bajo,
            'alta_medio' => $this->alta_medio,
            'alta_alto' => $this->alta_alto,
            'alta_muyalto' => $this->alta_muyalto,
            //conta residuales
            'nula_bajo_r' => $this->nula_bajo_r,
            'nula_medio_r' => $this->nula_medio_r,
            'nula_alto_r' => $this->nula_alto_r,
            'nula_muyalto_r' => $this->nula_muyalto_r,
            'baja_bajo_r' => $this->baja_bajo_r,
            'baja_medio_r' => $this->baja_medio_r,
            'baja_alto_r' => $this->baja_alto_r,
            'baja_muyalto_r' => $this->baja_muyalto_r,
            'media_bajo_r' => $this->media_bajo_r,
            'media_medio_r' => $this->media_medio_r,
            'media_alto_r' => $this->media_alto_r,
            'media_muyalto_r' => $this->media_muyalto_r,
            'alta_bajo_r' => $this->alta_bajo_r,
            'alta_medio_r' => $this->alta_medio_r,
            'alta_alto_r' => $this->alta_alto_r,
            'alta_muyalto_r' => $this->alta_muyalto_r,
        ]);
    }

    public function callQuery($id, $valor)
    {
        // dd($id);
        $matriz_riesgos = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad', 'impacto', 'nivelriesgo')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', $id);

        if ($this->sede_id != '') {
            $matriz_riesgos->Where('id_sede', '=', $this->sede_id);
        }

        if ($this->area_id != '') {
            $matriz_riesgos->Where('id_area', '=', $this->area_id);
        }

        if ($this->proceso_id != '') {
            $matriz_riesgos->Where('id_proceso', '=', $this->proceso_id);
        }

        //dd($matriz_riesgos->toSql());

        if ($matriz_riesgos->count() == 0) {
            $this->callAlert('warning', 'No se encontro registro con este nivel de riesgo', false, 'Por favor ingrese un nuevo valor');
            $this->changer = '';
            $this->listados = [];
        } else {
            $this->changer = '';
            $this->listados = $matriz_riesgos->get();
            $this->changer = $valor;
            $this->cleanData();
        }
    }

    public function callQueryResidual($id, $valor)
    {
        $matriz_riesgos_residual = MatrizRiesgo::select('id', 'descripcionriesgo', 'probabilidad_residual', 'impacto_residual', 'nivelriesgo_residual')->where('id_analisis', '=', $this->id_analisis)->where('nivelriesgo', '=', $id);

        if ($this->sede_id != '') {
            $matriz_riesgos_residual->Where('id_sede', '=', $this->sede_id);
        }

        if ($this->area_id != '') {
            $matriz_riesgos_residual->Where('id_area', '=', $this->area_id);
        }

        if ($this->proceso_id != '') {
            $matriz_riesgos_residual->Where('id_proceso', '=', $this->proceso_id);
        }

        //dd($matriz_riesgos->toSql());

        if ($matriz_riesgos_residual->count() == 0) {
            $this->callAlert('warning', 'No se encontro registro con este nivel de riesgo', false, 'Por favor ingrese un nuevo valor');
            $this->changer_residual = '';
            $this->listados_residual = [];
        } else {
            $this->changer_residual = '';
            $this->listados_residual = $matriz_riesgos_residual->get();
            $this->changer_residual = $valor;
            $this->cleanData();
        }
    }

    public function callAlert($tipo, $mensaje, $bool, $test = '')
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
        $this->cleanData();
    }

    public function cleanData()
    {
        $this->nula_muyalto = 0;
        $this->nula_alto = 0;
        $this->nula_medio = 0;
        $this->nula_bajo = 0;
        $this->baja_bajo = 0;
        $this->baja_medio = 0;
        $this->baja_alto = 0;
        $this->baja_muyalto = 0;
        $this->media_bajo = 0;
        $this->media_medio = 0;
        $this->media_alto = 0;
        $this->media_muyalto = 0;
        $this->alta_bajo = 0;
        $this->alta_medio = 0;
        $this->alta_alto = 0;
        $this->alta_muyalto = 0;
        $this->nula_muyalto_r = 0;
        $this->nula_alto_r = 0;
        $this->nula_medio_r = 0;
        $this->nula_bajo_r = 0;
        $this->baja_bajo_r = 0;
        $this->baja_medio_r = 0;
        $this->baja_alto_r = 0;
        $this->baja_muyalto_r = 0;
        $this->media_bajo_r = 0;
        $this->media_medio_r = 0;
        $this->media_alto_r = 0;
        $this->media_muyalto_r = 0;
        $this->alta_bajo_r = 0;
        $this->alta_medio_r = 0;
        $this->alta_alto_r = 0;
        $this->alta_muyalto_r = 0;
    }
}

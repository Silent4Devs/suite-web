<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\MatrizOctave;
use App\Models\Proceso;
use App\Models\Sede;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class MatrizOctaveheatmap extends Component
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

    public $mensaje = '';

    public $changer;

    public $mapas = [];

    //cards count
    public $critico;

    public $alto;

    public $medio;

    public $bajo;

    public $muy_bajo;

    //count mapa calor
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

    public function mount($mapas = [])
    {
        $this->mapas = $mapas;
    }

    public function render()
    {
        $sedes = Sede::getAll(['id', 'sede']);
        $areas = Area::getAll();
        $procesos = Proceso::select('id', 'nombre')->get();
        //Contadores
        $critico = MatrizOctave::select('id', 'vp', 'valor')->where('id_analisis', '=', $this->id_analisis)->whereIn('valor', ['25', '20']);
        $alto = MatrizOctave::select('id', 'vp', 'valor')->where('id_analisis', '=', $this->id_analisis)->whereIn('valor', ['10', '12', '15', '16']);
        $medio = MatrizOctave::select('id', 'vp', 'valor')->where('id_analisis', '=', $this->id_analisis)->whereIn('valor', ['9', '8', '6', '5', '4']);
        $bajo = MatrizOctave::select('id', 'vp', 'valor')->where('id_analisis', '=', $this->id_analisis)->whereIn('valor', ['4', '3', '2']);
        $muy_bajo = MatrizOctave::select('id', 'vp', 'valor')->where('id_analisis', '=', $this->id_analisis)->whereIn('valor', ['1']);
        //query matriz
        $matriz_query = MatrizOctave::select('id', 'vp', 'valor')->where('id_analisis', '=', $this->id_analisis);

        if ($this->sede_id != '') {
            if (MatrizOctave::select('id')->Where('id_sede', '=', $this->sede_id)->count() > 0) {
                $critico->Where('id_sede', '=', $this->sede_id);
                $alto->Where('id_sede', '=', $this->sede_id);
                $medio->Where('id_sede', '=', $this->sede_id);
                $bajo->Where('id_sede', '=', $this->sede_id);
                $matriz_query->Where('id_sede', '=', $this->sede_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con esta sede', false, 'El dashboard volvio a sus valores originales sin sede');
                $this->sede_id = '';
            }
        }

        if ($this->area_id != '') {
            if (MatrizOctave::select('id')->Where('id_area', '=', $this->area_id)->count() > 0) {
                $critico->Where('id_area', '=', $this->area_id);
                $alto->Where('id_area', '=', $this->area_id);
                $medio->Where('id_area', '=', $this->area_id);
                $bajo->Where('id_area', '=', $this->area_id);
                $matriz_query->Where('id_area', '=', $this->area_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con esta área', false, 'El dashboard volvio a sus valores originales sin área');
                $this->area_id = '';
            }
        }

        if ($this->proceso_id != '') {
            if (MatrizOctave::select('id')->Where('id_proceso', '=', $this->proceso_id)->count() > 0) {
                $critico->Where('id_proceso', '=', $this->proceso_id);
                $alto->Where('id_proceso', '=', $this->proceso_id);
                $medio->Where('id_proceso', '=', $this->proceso_id);
                $bajo->Where('id_proceso', '=', $this->proceso_id);
                $matriz_query->Where('id_proceso', '=', $this->proceso_id);
                $this->callAlert('success', 'La información se actualizo correctamente', true);
            } else {
                $this->callAlert('warning', 'No se encontro registro con este proceso', false, 'El dashboard volvio a sus valores originales sin proceso');
                $this->proceso_id = '';
            }
        }

        foreach ($matriz_query->get() as $key => $value) {
            switch ($value->valor) {
                case 5:
                    $this->nula_muyalto++;
                    break;
                case 10:
                    $this->baja_muyalto++;
                    break;
                case 20:
                    $this->media_muyalto++;
                    break;
                case 25:
                    $this->alta_muyalto++;
                    break;
                case 4:
                    $this->nula_alto++;
                    break;
                case 8:
                    $this->baja_alto++;
                    break;
                case 16:
                    $this->media_alto++;
                    break;
                case 20:
                    $this->alta_alto++;
                    break;
                case 3:
                    $this->nula_medio++;
                    break;
                case 6:
                    $this->baja_medio++;
                    break;
                case 9:
                    $this->media_medio++;
                    break;
                case 15:
                    $this->alta_medio++;
                    break;
                case 1:
                    $this->nula_bajo++;
                    break;
                case 2:
                    $this->baja_bajo++;
                    break;
                case 4:
                    $this->media_bajo++;
                    break;
                case 5:
                    $this->alta_bajo++;
                    break;
            }
        }

        return view('livewire.matriz-octaveheatmap', [
            'sedes' => $sedes,
            'areas' => $areas,
            'procesos' => $procesos,
            'criticos' => $critico->count(),
            'altos' => $alto->count(),
            'medios' => $medio->count(),
            'bajos' => $bajo->count(),
            'muy_bajos' => $muy_bajo->count(),
        ]);
    }

    public function callQuery($id, $valor)
    {
        $matriz_riesgos = MatrizOctave::select('id', 'vp', 'valor', 'cumplimiento', 'legal', 'reputacional', 'tecnologico')->where('id_analisis', '=', $this->id_analisis)->where('valor', '=', $id);

        if ($this->sede_id != '') {
            $matriz_riesgos->Where('id_sede', '=', $this->sede_id);
        }

        if ($this->area_id != '') {
            $matriz_riesgos->Where('id_area', '=', $this->area_id);
        }

        if ($this->proceso_id != '') {
            $matriz_riesgos->Where('id_proceso', '=', $this->proceso_id);
        }

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

    public function callAlert($tipo, $mensaje, $bool, $test = '')
    {
        $this->alert($tipo, $mensaje, [
            'position' => 'top-end',
            'timer' => 3100,
            'toast' => true,
            'text' => $test,
            'confirmButtonText' => 'Entendido',
            'cancelButtonText' => '',
            'showCancelButton' => false,
            'showConfirmButton' => $bool,
        ]);
        $this->cleanData();
    }

    public function clean()
    {
        $this->sede_id = '';
        $this->area_id = '';
        $this->proceso_id = '';
        $this->changer = '';
        $this->listados = [];
        //$this->conteo = '';
        $this->callAlert('info', 'Los filtros se han restablecido', true, 'La información volvio a su estado original');
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
    }
}

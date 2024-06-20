<?php

namespace App\Http\Livewire;

use App\Models\Area;
use App\Models\EvaluacionDesempeno;
use Carbon\Carbon;
use Livewire\Component;

class EvDesempenoDashboardGeneral extends Component
{
    public $evaluaciones;

    public $contadores = [];

    public $areas;
    public $area_anual = "todas";
    public $area_mensual = "todas";

    public $tipo_anual = "general_anual";
    public $tipo_mensual = "general_mensual";

    public $general_anual = true;
    public $objetivos_anual = true;
    public $competencias_anual = true;
    public $general_mensual = true;
    public $objetivos_mensual = true;
    public $competencias_mensual = true;

    public $anos_evaluaciones = [];
    public $datos_evaluaciones = [];

    public function mount()
    {
        $this->evaluaciones = EvaluacionDesempeno::getAll()->where('estatus', '!=', 0);
        $this->contadoresEvaluaciones();
        $this->extraeraAnosEvaluaciones();

        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        return view('livewire.ev-desempeno-dashboard-general');
    }

    public function cargarTablas()
    {
        $datosAnuales = [
            "labels" => $this->anos_evaluaciones,
            "data" => $this->datos_evaluaciones,
        ];
        $this->emit('dataAnual', $datosAnuales);

        $datosMensuales = [
            "labels" => $this->anos_evaluaciones,
            "data" => $this->datos_evaluaciones,
        ];
        $this->emit("dataMensual", $datosMensuales);
    }

    public function extraeraAnosEvaluaciones()
    {
        $this->evaluaciones;
        foreach ($this->evaluaciones as $key => $evaluacion) {
            $ano_creacion = Carbon::parse($evaluacion->created_at)->format('Y');

            $this->calificacionesEvaluacion($evaluacion);

            $anos[] = $ano_creacion;
            $datos[0][] = 86;
            $datos[1][] = 69;
            $datos[2][] = 78;
        }

        $this->anos_evaluaciones = array_unique($anos);
        $this->datos_evaluaciones = $datos;
    }

    public function contadoresEvaluaciones()
    {
        $this->contadores["activo"] = $this->evaluaciones->where('estatus', '=', 1)->count();
        $this->contadores["cerrado"] = $this->evaluaciones->where('estatus', '=', 2)->count();
        $this->contadores["pausado"] = $this->evaluaciones->where('estatus', '=', 3)->count();
    }

    public function calificacionesEvaluacion($evaluacion)
    {
        $sumaObjetivos = 0;
        foreach ($evaluacion->evaluados as $key_evaluado => $evaluado) {
            // dump($evaluado, $evaluado->calificaciones_objetivos_evaluado);
            $calificacionesObjetivos = $evaluado->calificaciones_objetivos_evaluado;
            $sumaObjetivos += $calificacionesObjetivos["promedio_total"];
            // dd($calificacionesObjetivos["promedio_total"]);
        }
        $totalEvaluacion = ($sumaObjetivos / $evaluacion->evaluados->count());
        // dd($totalEvaluacion, $evaluacion->evaluados->count());
    }

    public function updatedAreaAnual($value)
    {
        // dd($value);
        $this->cargarTablas();
    }

    public function updatedTipoAnual($value)
    {
        $this->cargarTablas();
    }

    public function updatedAreaMensual($value)
    {
        // dd($value);
        $this->cargarTablas();
    }

    public function updatedTipoMensual($value)
    {
        // dd($value);
        $this->cargarTablas();
    }

    public function updatedGeneralAnual()
    {
        $this->cargarTablas();
    }
    public function updatedObjetivosAnual()
    {
        $this->cargarTablas();
    }
    public function updatedCompetenciasAnual()
    {
        $this->cargarTablas();
    }
    public function updatedGeneralMensual()
    {
        $this->cargarTablas();
    }
    public function updatedObjetivosMensual()
    {
        $this->cargarTablas();
    }
    public function updatedCompetenciasMensual()
    {
        $this->cargarTablas();
    }
}

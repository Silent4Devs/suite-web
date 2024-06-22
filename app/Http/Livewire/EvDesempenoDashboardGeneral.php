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
        $evaluaciones = EvaluacionDesempeno::getAll()->where('estatus', '!=', 0);

        $this->evaluaciones = $evaluaciones;

        $this->contadoresEvaluaciones($evaluaciones);
        $this->extraeraAnosEvaluaciones($evaluaciones);

        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        return view('livewire.ev-desempeno-dashboard-general');
    }

    public function cargarTablas()
    {
        $datosAnuales = [
            "labels" =>  $this->datos_evaluaciones,
            "data" => $this->datos_evaluaciones,
        ];
        $this->emit('dataAnual', $datosAnuales);

        $datosMensuales = [
            "labels" => $this->anos_evaluaciones,
            "data" => $this->datos_evaluaciones,
        ];
        $this->emit("dataMensual", $datosMensuales);
    }

    public function extraeraAnosEvaluaciones($evaluaciones)
    {
        $evaluaciones;

        foreach ($evaluaciones as $key => $evaluacion) {
            $ano_creacion = Carbon::parse($evaluacion->created_at)->format('Y');
            $anos[] = $ano_creacion;
        }

        $this->anos_evaluaciones = array_unique($anos);

        $this->extraerDatosEvaluaciones($evaluaciones);
    }

    public function extraerDatosEvaluaciones($evaluaciones)
    {
        foreach ($evaluaciones as $key => $evaluacion) {
            $ano_creacion = Carbon::parse($evaluacion->created_at)->format('Y');
            $resultados = $this->calificacionesEvaluacion($evaluacion);

            $datos[$ano_creacion][] = $resultados;
        }

        $datos_evaluaciones = $datos;

        $this->promedioEvaluacionesAnual($datos_evaluaciones);
    }

    public function contadoresEvaluaciones($evaluaciones)
    {
        $this->contadores["activo"] = $evaluaciones->where('estatus', '=', 1)->count();
        $this->contadores["cerrado"] = $evaluaciones->where('estatus', '=', 2)->count();
        $this->contadores["pausado"] = $evaluaciones->where('estatus', '=', 3)->count();
    }

    public function calificacionesEvaluacion($evaluacion)
    {
        $sumaObjetivos = 0;
        $sumaCompetencias = 0;

        $promedioEvaluacionObjetivos = 0;
        $promedioEvaluacionCompetencias = 0;

        foreach ($evaluacion->evaluados as $key_evaluado => $evaluado) {

            if ($evaluacion->activar_objetivos) {
                $calificacionesObjetivos = $evaluado->calificaciones_objetivos_evaluado;
                $sumaObjetivos += $calificacionesObjetivos["promedio_total"];
            }

            if ($evaluacion->activar_competencias) {
                $calificacionesCompetencias = $evaluado->calificaciones_competencias_evaluado;
                $sumaCompetencias += $calificacionesCompetencias["promedio_total"];
            }
        }

        $totalEvaluacionObjetivos = ($sumaObjetivos / $evaluacion->evaluados->count());
        $totalEvaluacionCompetencias = ($sumaCompetencias / $evaluacion->evaluados->count());

        $promedioEvaluacionObjetivos = (($totalEvaluacionObjetivos * $evaluacion->porcentaje_objetivos) / 100);
        $promedioEvaluacionCompetencias = (($totalEvaluacionCompetencias * $evaluacion->porcentaje_competencias) / 100);

        $promedioEvaluacionTotal = $promedioEvaluacionObjetivos + $promedioEvaluacionCompetencias;

        return [
            'objetivos_activos' => $evaluacion->activar_objetivos,
            'objetivos' => $promedioEvaluacionObjetivos,
            'competencias_activos' => $evaluacion->activar_competencias,
            'competencias' => $promedioEvaluacionCompetencias,
            'total' => $promedioEvaluacionTotal,
        ];
    }

    public function promedioEvaluacionesAnual($datos_evaluaciones)
    {
        foreach ($datos_evaluaciones as $key_ano => $ev_ano) {

            $cuenta_obj = 0;
            $suma_anual_obj = 0;

            $cuenta_comp = 0;
            $suma_anual_comp = 0;

            foreach ($ev_ano as $key_ev => $ev) {
                if ($ev["objetivos_activos"]) {
                    $cuenta_obj++;
                    $suma_anual_obj += $ev["objetivos"];
                }

                if ($ev["competencias_activos"]) {
                    $cuenta_comp++;
                    $suma_anual_comp += $ev["competencias"];
                }
            }

            $promedioObj = ($suma_anual_obj / $cuenta_obj);
            $promedioComp = ($suma_anual_comp / $cuenta_comp);

            $promedioGen = $promedioObj + $promedioComp;

            $this->datos_evaluaciones[$key_ano] =
                [
                    "objetivos" => $promedioObj,
                    "competencias" => $promedioComp,
                    "general" => $promedioGen,
                ];
        }
    }

    public function updatedAreaAnual($value)
    {
        $this->cargarTablas();
    }

    public function updatedTipoAnual($value)
    {
        $this->cargarTablas();
    }

    public function updatedAreaMensual($value)
    {
        $this->cargarTablas();
    }

    public function updatedTipoMensual($value)
    {
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

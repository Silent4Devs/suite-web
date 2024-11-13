<?php

namespace App\Livewire;

use App\Models\Area;
use App\Models\EvaluacionDesempeno;
use Carbon\Carbon;
use Livewire\Component;

class EvDesempenoDashboardGeneral extends Component
{
    public $evaluaciones;

    public $contadores = [];

    public $areas;

    public $ano_anual = 'todos';

    public $mes_mensual = 'ninguno';

    public $area_anual = 'todas';

    public $area_mensual = 'todas';

    public $general_anual = true;

    public $objetivos_anual = true;

    public $competencias_anual = true;

    public $general_mensual = true;

    public $objetivos_mensual = true;

    public $competencias_mensual = true;

    public $anos_evaluaciones = [];

    public $datos_evaluaciones_anuales = [];

    public $meses_evaluaciones = [
        '1' => 'Enero',
        '2' => 'Febrero',
        '3' => 'Marzo',
        '4' => 'Abril',
        '5' => 'Mayo',
        '6' => 'Junio',
        '7' => 'Julio',
        '8' => 'Agosto',
        '9' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre',
    ];

    public $datos_evaluaciones_mensuales = [];

    public function mount()
    {
        $evaluaciones = EvaluacionDesempeno::getAll();

        $this->evaluaciones = $evaluaciones;

        $this->contadoresEvaluaciones($evaluaciones);
        $this->extraeraAnosEvaluaciones($evaluaciones);
        $this->extraerDatosEvaluacionesMensual($evaluaciones);

        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        return view('livewire.ev-desempeno-dashboard-general');
    }

    public function contadoresEvaluaciones($evaluaciones)
    {
        $this->contadores['activo'] = $evaluaciones->where('estatus', '=', 1)->count();
        $this->contadores['cerrado'] = $evaluaciones->where('estatus', '=', 2)->count();
        $this->contadores['pausado'] = $evaluaciones->where('estatus', '=', 3)->count();
    }

    public function cargarTablas()
    {
        $evaluaciones = EvaluacionDesempeno::getAll()->where('estatus', '!=', 0);
        $this->extraeraAnosEvaluaciones($evaluaciones);
        $this->extraerDatosEvaluacionesMensual($evaluaciones);
        $años = array_keys($this->datos_evaluaciones_anuales);

        $datosAnuales = [
            'labels' => $años,
            'data' => $this->datos_evaluaciones_anuales,
            'filtro_general_anual' => $this->general_anual,
            'filtro_objetivos_anual' => $this->objetivos_anual,
            'filtro_competencias_anual' => $this->competencias_anual,
        ];
        $this->dispatch('dataAnual', datosAnuales: $datosAnuales);

        $meses = array_keys($this->datos_evaluaciones_mensuales);
        $datosMensuales = [
            'labels' => $meses,
            'data' => $this->datos_evaluaciones_mensuales,
            'filtro_objetivos_mensual' => $this->objetivos_mensual,
            'filtro_competencias_mensual' => $this->competencias_mensual,
            'filtro_general_mensual' => $this->general_mensual,
        ];

        $this->dispatch('dataMensual', datosMensuales: $datosMensuales);
    }

    public function extraeraAnosEvaluaciones($evaluaciones)
    {
        $anos = [];

        foreach ($evaluaciones as $key => $evaluacion) {
            $ano_creacion = Carbon::parse($evaluacion->created_at)->format('Y');
            $anos[] = $ano_creacion;
        }

        $this->anos_evaluaciones = array_unique($anos);

        $this->extraerDatosEvaluacionesAnual($evaluaciones);
    }

    public function extraerDatosEvaluacionesAnual($evaluaciones)
    {
        if ($this->ano_anual != 'todos') {
            $evaluaciones = $evaluaciones->filter(function ($evaluacion) {
                return $evaluacion->created_at->year == $this->ano_anual;
            });
        }

        if ($this->area_anual != 'todas') {
            $evaluaciones = $evaluaciones->filter(function ($evaluacion) {
                foreach ($evaluacion->evaluados as $evaluado) {
                    if ($evaluado->empleado->area_id == $this->area_anual) {
                        return true;
                    }
                }

                return false;
            });
        }

        // Verificar si la colección no está vacía
        if ($evaluaciones->isEmpty()) {
            $this->datos_evaluaciones_anuales = [];

            return;
        }

        $datos = [];

        foreach ($evaluaciones as $key => $evaluacion) {
            $ano_creacion = Carbon::parse($evaluacion->created_at)->format('Y');
            $resultados = $this->calificacionesEvaluacionAnual($evaluacion);

            $datos[$ano_creacion][] = $resultados;
        }

        $this->promedioEvaluacionesAnual($datos);
    }

    public function calificacionesEvaluacionAnual($evaluacion)
    {
        $sumaObjetivos = 0;
        $sumaCompetencias = 0;

        foreach ($evaluacion->evaluados as $key_evaluado => $evaluado) {
            if ($evaluacion->activar_objetivos) {
                $calificacionesObjetivos = $evaluado->calificaciones_objetivos_evaluado;
                $sumaObjetivos += $calificacionesObjetivos['promedio_total'];
            }

            if ($evaluacion->activar_competencias) {
                $calificacionesCompetencias = $evaluado->calificaciones_competencias_evaluado;
                $sumaCompetencias += $calificacionesCompetencias['promedio_total'];
            }
        }

        $totalEvaluacionObjetivos = $evaluacion->evaluados->count() > 0 ? ($sumaObjetivos / $evaluacion->evaluados->count()) : 0;
        $totalEvaluacionCompetencias = $evaluacion->evaluados->count() > 0 ? ($sumaCompetencias / $evaluacion->evaluados->count()) : 0;

        $promedioEvaluacionObjetivos = ($totalEvaluacionObjetivos * $evaluacion->porcentaje_objetivos) / 100;
        $promedioEvaluacionCompetencias = ($totalEvaluacionCompetencias * $evaluacion->porcentaje_competencias) / 100;

        $promedioEvaluacionTotal = $promedioEvaluacionObjetivos + $promedioEvaluacionCompetencias;

        return [
            'objetivos_activos' => $evaluacion->activar_objetivos,
            'objetivos' => $promedioEvaluacionObjetivos,
            'competencias_activos' => $evaluacion->activar_competencias,
            'competencias' => $promedioEvaluacionCompetencias,
            'total' => $promedioEvaluacionTotal,
        ];
    }

    public function promedioEvaluacionesAnual($datos_evaluaciones_anuales)
    {
        foreach ($datos_evaluaciones_anuales as $key_ano => $ev_ano) {
            $this->datos_evaluaciones_anuales[$key_ano] = null;

            $cuenta_obj = 0;
            $suma_anual_obj = 0;

            $cuenta_comp = 0;
            $suma_anual_comp = 0;

            foreach ($ev_ano as $key_ev => $ev) {
                if ($ev['objetivos_activos']) {
                    $cuenta_obj++;
                    $suma_anual_obj += $ev['objetivos'];
                }

                if ($ev['competencias_activos']) {
                    $cuenta_comp++;
                    $suma_anual_comp += $ev['competencias'];
                }
            }

            $promedioObj = $cuenta_obj > 0 ? ($suma_anual_obj / $cuenta_obj) : 0;
            if ($this->objetivos_anual) {
                $this->datos_evaluaciones_anuales[$key_ano]['objetivos'] = $promedioObj;
                $this->datos_evaluaciones_anuales[$key_ano]['colorObjetivos'] = '#8C91D6';
            }

            $promedioComp = $cuenta_comp > 0 ? ($suma_anual_comp / $cuenta_comp) : 0;
            if ($this->competencias_anual) {
                $this->datos_evaluaciones_anuales[$key_ano]['competencias'] = $promedioComp;
                $this->datos_evaluaciones_anuales[$key_ano]['colorCompetencias'] = '#BB68A8';
            }

            if ($this->general_anual) {
                $promedioGen = $promedioObj + $promedioComp;
                $this->datos_evaluaciones_anuales[$key_ano]['general'] = $promedioGen;
                $this->datos_evaluaciones_anuales[$key_ano]['colorGeneral'] = '#36B0BE';
            }
        }
    }

    public function extraerDatosEvaluacionesMensual($evaluaciones)
    {
        // Inicializamos el array de datos
        $this->datos_evaluaciones_mensuales = [];
        $datos = [];

        // Validamos si las evaluaciones están vacías y los filtros no son "todos" o "ninguno"
        if ($evaluaciones->isEmpty() && $this->ano_anual != 'todos' && $this->mes_mensual != 'ninguno') {
            $this->datos_evaluaciones_mensuales = [];

            return;
        }

        // Filtramos por mes si no es "ninguno"
        if ($this->mes_mensual != 'ninguno') {
            foreach ($evaluaciones as $key_evaluacion => $evaluacion) {
                foreach ($evaluacion->periodos as $key_periodo => $periodo) {
                    $mes_evaluacion = Carbon::parse($periodo->fecha_inicio)->format('m');
                    if ($mes_evaluacion == $this->mes_mensual) {
                        $resultados = $this->calificacionesEvaluacionMensual($evaluacion, $periodo->id);
                        if (! empty($resultados)) {
                            $datos[] = $resultados;
                        }
                    }
                }
            }
        }

        // Filtramos por área si no es "todas"
        if ($this->area_mensual != 'todas') {
            $evaluaciones = $evaluaciones->filter(function ($evaluacion) {
                foreach ($evaluacion->evaluados as $evaluado) {
                    if ($evaluado->empleado->area_id == $this->area_mensual) {
                        return true;
                    }
                }

                return false;
            });
        }

        // Verificamos si la colección no está vacía después del filtrado
        if ($evaluaciones->isEmpty()) {
            $this->datos_evaluaciones_mensuales = [];

            return;
        }

        // Calculamos el promedio de las evaluaciones mensuales
        $this->promedioEvaluacionesMensual($datos);
    }

    public function calificacionesEvaluacionMensual($evaluacion, $id_periodo)
    {
        $sumaObjetivos = 0;
        $sumaCompetencias = 0;

        foreach ($evaluacion->evaluados as $key_evaluado => $evaluado) {
            if ($evaluacion->activar_objetivos) {
                $calificacionesObjetivos = $evaluado->calificacionesObjetivosEvaluadoPeriodo($id_periodo);
                $sumaObjetivos += $calificacionesObjetivos['promedio_total'];
            }

            if ($evaluacion->activar_competencias) {
                $calificacionesCompetencias = $evaluado->calificacionesCompetenciasEvaluadoPeriodo($id_periodo);
                $sumaCompetencias += $calificacionesCompetencias['promedio_total'];
            }
        }

        $totalEvaluacionObjetivos = $evaluacion->evaluados->count() > 0 ? ($sumaObjetivos / $evaluacion->evaluados->count()) : 0;
        $totalEvaluacionCompetencias = $evaluacion->evaluados->count() > 0 ? ($sumaCompetencias / $evaluacion->evaluados->count()) : 0;

        $promedioEvaluacionObjetivos = ($totalEvaluacionObjetivos * $evaluacion->porcentaje_objetivos) / 100;
        $promedioEvaluacionCompetencias = ($totalEvaluacionCompetencias * $evaluacion->porcentaje_competencias) / 100;

        $promedioEvaluacionTotal = $promedioEvaluacionObjetivos + $promedioEvaluacionCompetencias;

        return [
            'objetivos_activos' => $evaluacion->activar_objetivos,
            'objetivos' => $promedioEvaluacionObjetivos,
            'competencias_activos' => $evaluacion->activar_competencias,
            'competencias' => $promedioEvaluacionCompetencias,
            'total' => $promedioEvaluacionTotal,
        ];
    }

    public function promedioEvaluacionesMensual($datos_evaluaciones_mensuales)
    {
        foreach ($datos_evaluaciones_mensuales as $key_mes => $ev_mes) {
            $mesPalabra = $this->convertirMes($this->mes_mensual);
            $this->datos_evaluaciones_mensuales[$mesPalabra] = null;

            $cuenta_obj = 0;
            $suma_mensual_obj = 0;

            $cuenta_comp = 0;
            $suma_mensual_comp = 0;

            if ($ev_mes['objetivos_activos']) {
                $cuenta_obj++;
                $suma_mensual_obj += $ev_mes['objetivos'];
            }

            if ($ev_mes['competencias_activos']) {
                $cuenta_comp++;
                $suma_mensual_comp += $ev_mes['competencias'];
            }

            $promedioObj = $cuenta_obj > 0 ? ($suma_mensual_obj / $cuenta_obj) : 0;
            if ($this->objetivos_mensual) {
                $this->datos_evaluaciones_mensuales[$mesPalabra]['objetivos'] = $promedioObj;
                $this->datos_evaluaciones_mensuales[$mesPalabra]['colorObjetivos'] = '#8C91D6';
            }

            $promedioComp = $cuenta_comp > 0 ? ($suma_mensual_comp / $cuenta_comp) : 0;
            if ($this->competencias_mensual) {
                $this->datos_evaluaciones_mensuales[$mesPalabra]['competencias'] = $promedioComp;
                $this->datos_evaluaciones_mensuales[$mesPalabra]['colorCompetencias'] = '#BB68A8';
            }

            if ($this->general_mensual) {
                $promedioGen = $promedioObj + $promedioComp;
                $this->datos_evaluaciones_mensuales[$mesPalabra]['general'] = $promedioGen;
                $this->datos_evaluaciones_mensuales[$mesPalabra]['colorGeneral'] = '#36B0BE';
            }
        }
    }

    public function convertirMes($numeroMes)
    {
        switch ($numeroMes) {

            case '1':
                return 'Enero';
                break;
            case '2':
                return 'Febrero';
                break;
            case '3':
                return 'Marzo';
                break;
            case '4':
                return 'Abril';
                break;
            case '5':
                return 'Mayo';
                break;
            case '6':
                return 'Junio';
                break;
            case '7':
                return 'Julio';
                break;
            case '8':
                return 'Agosto';
                break;
            case '9':
                return 'Septiembre';
                break;
            case '10':
                return 'Octubre';
                break;
            case '11':
                return 'Noviembre';
                break;
            case '12':
                return 'Diciembre';
                break;
            default:
                return 'Indefinido';
                break;
        }
    }

    public function updatedAnoAnual($value)
    {
        // dd($value);
        $this->cargarTablas();
    }

    public function updatedAreaAnual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedGeneralAnual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedObjetivosAnual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedCompetenciasAnual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedAreaMensual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedMesMensual($value)
    {
        // dd($value);
        $this->cargarTablas();
    }

    public function updatedGeneralMensual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedObjetivosMensual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }

    public function updatedCompetenciasMensual($value)
    {
        //dd($value);
        $this->cargarTablas();
    }
}

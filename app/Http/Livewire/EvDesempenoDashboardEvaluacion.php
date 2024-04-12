<?php

namespace App\Http\Livewire;

use App\Mail\CorreoRecordatorioEvDesempeno;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\CuestionarioCompetenciaEvDesempeno;
use App\Models\CuestionarioObjetivoEvDesempeno;
use App\Models\EvaluacionDesempeno;
use App\Models\EvaluadosEvaluacionDesempeno;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class EvDesempenoDashboardEvaluacion extends Component
{
    public $id_evaluacion;
    public $evaluacion;
    public $evaluados_tabla;

    public $array_periodos;
    public $periodo_seleccionado = 0;

    public $areas;
    public $area_select;
    public $select_area_tabla = "todos";
    public $select_colaborador_tabla = "todos";
    public $select_evaluadores_tabla = "todos";

    public $opciones_area_select;
    public $opciones_evaluadores_select;

    public $evaluadores_evaluado = [];
    public $totales_evaluado = [];

    public $chartData;
    public $grafica_area = [];
    public $grafica_objetivos = [];
    public $grafica_competencias = [];

    public $promedio_evaluados_area = [];

    public $escalas = [];

    public $promedio_total = 0;
    public $promedio_objetivos = 0;
    public $promedio_competencias = 0;

    public function mount($id_evaluacion)
    {
        $this->id_evaluacion = $id_evaluacion;
        $this->areas = Area::getIdNameAll();
    }

    public function render()
    {
        $this->evaluacion = EvaluacionDesempeno::find($this->id_evaluacion);

        //Datos generales
        $this->secciones();
        $this->evaluadoTotales();
        $this->evaluadores();
        $this->recopilarAreas();

        if ($this->evaluacion->activar_objetivos) {
            $this->obtenerEscalas();
            $this->resultadoPorArea();
            $this->resultadoObjetivos();
        }

        if ($this->evaluacion->activar_competencias) {
            $this->resultadoCompetencias();
        }

        $this->porcentajesTotales();

        $this->evaluados_tabla = EvaluacionDesempeno::with('evaluados');

        if ($this->select_area_tabla != "todos") {
            $this->evaluados_tabla->whereHas('evaluados.empleado', function ($query) {
                $query->where('area_id', $this->select_area_tabla);
            });
        }

        if ($this->select_colaborador_tabla != "todos") {
            $this->evaluados_tabla->whereHas('evaluados', function ($query) {
                $query->where('id', $this->select_colaborador_tabla);
            });
        }

        if ($this->select_evaluadores_tabla != "todos") {
            if ($this->evaluacion->activar_competencias) {
                $this->evaluados_tabla->whereHas('evaluados.evaluadoresCompetencias', function ($query) {
                    $query->where('evaluador_desempeno_id', $this->select_evaluadores_tabla);
                });
            }

            if ($this->evaluacion->activar_competencias) {
                $this->evaluados_tabla->whereHas('evaluados.evaluadoresObjetivos', function ($query) {
                    $query->where('evaluador_desempeno_id', $this->select_evaluadores_tabla);
                });
            }
        }

        $this->evaluados_tabla = $this->evaluados_tabla->find($this->id_evaluacion);

        $this->chartData = [
            "labels" => $this->grafica_area["nombres"],
            "data" => $this->grafica_area["resultados"],
        ];

        $this->emit('chartDataUpdated', $this->chartData);

        return view('livewire.ev-desempeno-dashboard-evaluacion');
    }

    public function cambiarSeccion($llave)
    {
        $this->periodo_seleccionado = $llave;
    }

    public function secciones()
    {
        foreach ($this->evaluacion->periodos as $key => $periodo) {
            $this->array_periodos[$key] = [
                "id_periodo" => $periodo->id,
                "nombre_evaluacion" => $periodo->nombre_evaluacion,
                "fecha_inicio" => $periodo->fecha_inicio,
                "fecha_fin" => $periodo->fecha_fin,
                "habilitado" => $periodo->habilitado,
                "finalizado" => $periodo->finalizado,
            ];
        }
    }

    public function evaluadoTotales()
    {


        //Calificaciones Generales (todos los periodos)
        // foreach ($this->evaluacion->evaluados as $evaluado) {
        //     $this->totales_evaluado[$evaluado->id] =
        //         [
        //             'competencias' => $evaluado->calificaciones_competencias_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100),
        //             'objetivos' => $evaluado->calificaciones_objetivos_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
        //             'final' => $evaluado->calificaciones_competencias_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100) + $evaluado->calificaciones_objetivos_evaluado['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
        //         ];

        //     $this->promedio_evaluados_area[$evaluado->empleado->area_id]["promedioEvdsObjs"][] = $this->totales_evaluado[$evaluado->id]["objetivos"];
        // }
        foreach ($this->evaluacion->evaluados as $evaluado) {
            // dd(
            //     $evaluado->calificacionesCompetenciasEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"]),
            //     $evaluado->calificacionesObjetivosEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"])
            // );
            $this->totales_evaluado[$evaluado->id] =
                [
                    'competencias' => $evaluado->calificacionesCompetenciasEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"])['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100),
                    'objetivos' => $evaluado->calificacionesObjetivosEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"])['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
                    'final' => $evaluado->calificacionesCompetenciasEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"])['promedio_total'] * ($this->evaluacion->porcentaje_competencias / 100) + $evaluado->calificacionesObjetivosEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"])['promedio_total'] * ($this->evaluacion->porcentaje_objetivos / 100),
                ];

            $this->promedio_evaluados_area[$evaluado->empleado->area_id]["promedioEvdsObjs"][] = $this->totales_evaluado[$evaluado->id]["objetivos"];
        }
    }

    public function obtenerEscalas()
    {
        foreach ($this->evaluacion->escalas as $key => $escala) {
            $this->escalas['nombres'][$key] = $escala->parametro;
            $this->escalas['colores'][$key] = $escala->color;
        }
    }

    public function enviarRecordatorio()
    {
        dump($this->evaluacion->evaluados);
        foreach ($this->evaluacion->evaluados as $evaluado) {
            if ($evaluado->estatus_evaluado == false) {
                dd($evaluado);
                if ($this->evaluacion->activar_competencias) {
                    # code...
                    dd($evaluado->evaluadoresCompetencias);
                }

                if ($this->evaluacion->activar_objetivos) {
                    # code...
                    dd($evaluado->evaluadoresObjetivos);
                }
            }
            // dd($evaluado->empleado->email);
        }
    }

    public function cerrarEvaluacion()
    {
        $this->evaluacion->update(
            [
                'estatus' => 2,
            ]
        );
    }

    public function evaluadores()
    {
        $empleados = Empleado::getAllDataColumns();

        foreach ($this->evaluacion->evaluados as $evaluado) {
            foreach ($evaluado->nombres_evaluadores as $key => $evdr) {

                $evaluador = $empleados->find($evdr->evaluador_desempeno_id);
                $this->evaluadores_evaluado[$evaluado->id][] = [
                    'id' => $evaluador->evaluador_desempeno_id,
                    'nombre' => $evaluador->name,
                    // 'email' => $evaluador->email, //No necesario
                    'foto' => $evaluador->foto,
                ];
            }
        }

        $allEvaluators = array_reduce($this->evaluadores_evaluado, function ($carry, $item) {
            return array_merge($carry, $item);
        }, []);

        $uniqueEvaluators = array_map("unserialize", array_unique(array_map("serialize", $allEvaluators)));

        $uniqueEvaluators = array_values($uniqueEvaluators);

        $this->opciones_evaluadores_select = $uniqueEvaluators;
    }

    public function recopilarAreas()
    {
        $areas = Area::getIdNameAll();

        $ids_areas = $this->evaluacion->areas_evaluacion;

        foreach ($ids_areas as $key => $area_id) {
            $area = $areas->find($area_id);

            $this->opciones_area_select[$key] = [
                "id" => $area->id,
                "area" => $area->area
            ];
        }
    }

    public function resultadoPorArea()
    {
        $areas = Area::getIdNameAll();

        $ids_areas = $this->evaluacion->areas_evaluacion;

        foreach ($ids_areas as $key => $area_id) {
            $area = $areas->find($area_id);

            $promedioEvdsObjsArray = $this->promedio_evaluados_area[$area_id]["promedioEvdsObjs"];

            $allObjetivos = collect($promedioEvdsObjsArray)->flatMap(function ($array) {
                return collect($array);
            });

            $averageObjetivos = $allObjetivos->avg();

            $this->grafica_area["nombres"][$key] = $area->area;
            $this->grafica_area["resultados"][$key] = $averageObjetivos;
        }
    }

    public function resultadoObjetivos()
    {
        $query_objetivos = CuestionarioObjetivoEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)->get();

        foreach ($query_objetivos as $pregunta) {
            $lista_objetivos[] = $pregunta->infoObjetivo->tipo_objetivo;
        }

        $lo = array_unique($lista_objetivos);

        foreach ($lo as $o) {
            $this->grafica_objetivos["nombres"][] = $o;
        }

        $promedios_tipo_objetivo = [];

        $evaluadosCollection = collect($this->evaluacion->evaluados);

        foreach ($this->grafica_objetivos["nombres"] as $key => $tipo) {
            // Map evaluados to their respective "calificacion_total" values for the current tipo
            $calificacionTotals = $evaluadosCollection->flatMap(function ($evaluado) use ($tipo) {
                return collect($evaluado->calificacionesObjetivosEvaluadoPeriodo($this->array_periodos[$this->periodo_seleccionado]["id_periodo"])["calif_total"])
                    ->filter(function ($objetivo) use ($tipo) {
                        return $objetivo['tipo'] == $tipo;
                    })
                    ->pluck('calificacion_total');
            });

            $promedios_tipo_objetivo[$tipo] = $calificacionTotals->avg();
            $this->grafica_objetivos["resultados"][$key] = $promedios_tipo_objetivo[$tipo];
        }
    }

    public function resultadoCompetencias()
    {
        $query_competencias = CuestionarioCompetenciaEvDesempeno::where('evaluacion_desempeno_id', $this->id_evaluacion)->get();

        foreach ($query_competencias as $pregunta) {
            $lista_competencias[] = $pregunta->infoCompetencia->competencia;
        }

        $lc = array_unique($lista_competencias);

        foreach ($lc as $c) {
            $this->grafica_competencias["nombres"][] = $c;
        }

        $promedios_tipo_competencias = [];

        $evaluadosCollection = collect($this->evaluacion->evaluados);

        foreach ($this->grafica_competencias["nombres"] as $key => $competencia) {
            // Map evaluados to their respective "calificacion_total" values for the current competencia
            $calificacionTotals = $evaluadosCollection->flatMap(function ($evaluado) use ($competencia) {
                return collect($evaluado->calificaciones_competencias_evaluado["calif_total"])
                    ->filter(function ($competencias) use ($competencia) {
                        return $competencias['competencia'] == $competencia;
                    })
                    ->pluck('calificacion_total');
            });

            $promedios_tipo_competencias[$competencia] = $calificacionTotals->avg();
            $this->grafica_competencias["resultados"][$key] = $promedios_tipo_competencias[$competencia];
        }
    }

    public function porcentajesTotales()
    {
        $this->promedio_total = 0;

        $this->promedio_objetivos = 0;

        $this->promedio_competencias = 0;

        if ($this->evaluacion->activar_objetivos) {
            $suma_objetivos = array_sum($this->grafica_objetivos["resultados"]);

            $n_objetivos = count($this->grafica_objetivos["resultados"]);

            $this->promedio_objetivos = round((($suma_objetivos / $n_objetivos) * $this->evaluacion->porcentaje_objetivos / 100), 2);
        }

        if ($this->evaluacion->activar_competencias) {
            $suma_competencias = array_sum($this->grafica_competencias["resultados"]);

            $n_competencias = count($this->grafica_competencias["resultados"]);

            $this->promedio_competencias = round((($suma_competencias / $n_competencias) * $this->evaluacion->porcentaje_competencias / 100), 2);
        }

        $this->promedio_total = $this->promedio_competencias + $this->promedio_objetivos;
    }
}

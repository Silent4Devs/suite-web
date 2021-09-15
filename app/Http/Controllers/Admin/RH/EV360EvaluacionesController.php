<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\RH\Competencia;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionCompetencia;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EV360EvaluacionesController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();
        $empleados = Empleado::all();

        if ($request->ajax()) {
            $evaluaciones = Evaluacion::all();
            return datatables()->of($evaluaciones)->toJson();
        }
        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.index', compact('areas', 'empleados'));
    }

    public function create()
    {
        $evaluacion = new Evaluacion;
        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.create', compact('evaluacion'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string|max:255',
            'evaluados_objetivo' => 'required',
            'evaluados_grupo_dinamico' => 'required_if:evaluados_objetivo,0',
            'evaluados_areas' => 'required_if:evaluados_grupo_dinamico,1',
            'evaluados_manual' => 'required_if:evaluados_objetivo,1',
        ], [
            'evaluados_objetivo.required' => 'Este campo es necesario para definir a los evaluados objetivo del cuestionario',
            'evaluados_grupo_dinamico.required' => 'Este campo es necesario para definir el grupo de evaluados al que será dirigida la evaluación',
            'evaluados_areas.required' => 'Este campo es necesario para definir el área a la que será aplicada la evaluación',
        ]);
        if ($request->ajax()) {
            $evaluados_objetivo = intval($request->evaluados_objetivo);
            if ($evaluados_objetivo == 0) {
                $evaluados_grupo_dinamico = intval($request->evaluados_grupo_dinamico);
                if ($evaluados_grupo_dinamico == 0) {
                    $evaluados = Empleado::pluck('id')->toArray();
                } else {
                    $evaluados_area = intval($request->evaluados_areas);
                    $evaluados = Empleado::where('area_id', $evaluados_area)->pluck('id')->toArray();
                }
            } else {
                $evaluados = $request->evaluados_manual;
            }

            $evaluacion = Evaluacion::create($request->all() + ['autor_id' => auth()->user()->empleado->id]);
            $evaluacion->evaluados()->sync($evaluados);
            foreach ($evaluados as $evaluado) {
                $this->relacionarEvaluadoConEvaluadores($evaluacion, $evaluado);
            }

            return response()->json(['response' => $evaluados]);
        }
    }

    public function relacionarEvaluadoConEvaluadores($evaluacion, $evaluado)
    {
        $empleado = Empleado::with('children')->find(intval($evaluado));
        $evaluadores = array();
        $evaluacion = Evaluacion::find($evaluacion->id);

        if ($evaluacion->autoevaluacion) {
            array_push($evaluadores, intval($empleado->id));
        }
        if ($evaluacion->evaluado_por_jefe) {
            if ($empleado->jefe_inmediato) {
                array_push($evaluadores, intval($empleado->jefe_inmediato->id));
            }
        }
        if ($evaluacion->evaluado_por_misma_area) {
            if ($empleado->empleados_misma_area) {
                foreach ($empleado->empleados_misma_area as $evaluador) {
                    array_push($evaluadores, intval($evaluador));
                }
            }
        }
        if ($evaluacion->evaluado_por_equipo_a_cargo) {
            if ($empleado->children) {
                foreach ($empleado->children as $evaluador) {
                    array_push($evaluadores, intval($evaluador->id));
                }
            }
        }
        $evaluadores = array_unique($evaluadores);
        foreach ($evaluadores as $evaluador) {
            EvaluadoEvaluador::create([
                'evaluado_id' => $empleado->id,
                'evaluador_id' => intval($evaluador),
                'evaluacion_id' => $evaluacion->id
            ]);
        }
        // $competencia = Competencia::find($evaluacion->competencia_id);
        // foreach ($evaluadores as $evaluador) {
        //     EvaluacionRepuesta::create([
        //         'calificacion' => 0,
        //         'competencia_id' => $competencia->id
        //     ]);
        // }
    }

    public function crearCuestionario($evaluacion, $evaluado)
    {
        $empleado = Empleado::with('children')->find(intval($evaluado));
        $evaluadores = array();
        $evaluacion = Evaluacion::with('competencias')->find($evaluacion->id);

        if ($evaluacion->autoevaluacion) {
            array_push($evaluadores, intval($empleado->id));
        }
        if ($evaluacion->evaluado_por_jefe) {
            if ($empleado->jefe_inmediato) {
                array_push($evaluadores, intval($empleado->jefe_inmediato->id));
            }
        }
        if ($evaluacion->evaluado_por_misma_area) {
            if ($empleado->empleados_misma_area) {
                foreach ($empleado->empleados_misma_area as $evaluador) {
                    array_push($evaluadores, intval($evaluador));
                }
            }
        }
        if ($evaluacion->evaluado_por_equipo_a_cargo) {
            if ($empleado->children) {
                foreach ($empleado->children as $evaluador) {
                    array_push($evaluadores, intval($evaluador->id));
                }
            }
        }

        $competencias = $evaluacion->competencias;
        $evaluadores = array_unique($evaluadores);
        foreach ($evaluadores as $evaluador) {
            foreach ($competencias as $competencia) {
                EvaluacionRepuesta::create([
                    'calificacion' => 0,
                    'descripcion' => null,
                    'competencia_id' => $competencia->id,
                    'evaluado_id' => $empleado->id,
                    'evaluador_id' => $evaluador,
                    'evaluacion_id' => $evaluacion->id
                ]);
            }
        }
    }

    public function iniciarEvaluacion(Request $request, $evaluacion)
    {
        $request->validate([
            'fecha_fin' => 'required|date',
            'fecha_inicio' => 'nullable|date',
        ]);
        $evaluacion = Evaluacion::find(intval($evaluacion));
        if ($request->ajax()) {
            $fecha_inicio = $request->fecha_inicio ? $request->fecha_inicio : Carbon::now();
            $evaluacion_u = $evaluacion->update([
                'fecha_inicio' => $fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'estatus' => Evaluacion::ACTIVE,
            ]);
            $evaluados = $evaluacion->evaluados;
            foreach ($evaluados as $evaluado) {
                $this->crearCuestionario($evaluacion, $evaluado->id);
            }
            if ($evaluacion_u) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function postergarEvaluacion(Request $request, $evaluacion)
    {
        $request->validate([
            'fecha_fin' => 'required|date',
        ]);
        $evaluacion = Evaluacion::find(intval($evaluacion));
        if ($request->ajax()) {
            $evaluacion_u = $evaluacion->update([
                'fecha_fin' => $request->fecha_fin,
                'estatus' => Evaluacion::ACTIVE,
            ]);

            if ($evaluacion_u) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }
    public function cerrarEvaluacion(Request $request, $evaluacion)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));
        if ($request->ajax()) {
            $evaluacion_u = $evaluacion->update([
                'fecha_fin' => Carbon::now(),
                'estatus' => Evaluacion::CLOSED,
            ]);

            if ($evaluacion_u) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function contestarCuestionario($evaluacion, $evaluado, $evaluador)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));
        $evaluado = Empleado::find(intval($evaluado));
        $evaluador = Empleado::find(intval($evaluador));
        $preguntas_sql = EvaluacionRepuesta::with(['competencia' => function ($q) {
            $q->with(['opciones' => function ($qry) {
                $qry->orderByDesc('ponderacion');
            }]);
        }, 'evaluado', 'evaluador', 'evaluacion'])
            ->where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)
            ->where('evaluador_id', $evaluador->id);
        $preguntas = $preguntas_sql->get();
        $total_preguntas = $preguntas_sql->count();
        $preguntas_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)
            ->where('evaluador_id', $evaluador->id)
            ->where('calificacion', '>', 0)->count();
        $preguntas_no_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)
            ->where('evaluador_id', $evaluador->id)
            ->where('calificacion', '=', 0)->count();
        $progreso = floatval(number_format((($preguntas_contestadas / $total_preguntas) * 100)));
        $finalizo_tiempo = false;
        if (Carbon::parse($evaluacion->fecha_fin)->diffInDays(Carbon::now()) == 0) {
            $finalizo_tiempo = true;
        }

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.cuestionario', compact('evaluacion', 'preguntas', 'evaluado', 'evaluador', 'total_preguntas', 'preguntas_contestadas', 'preguntas_no_contestadas', 'progreso', 'finalizo_tiempo'));
    }

    public function evaluacion(Evaluacion $evaluacion)
    {
        $evaluacion->load('autor');
        $competencias = Competencia::select('id', 'nombre')->get();
        $competencias_seleccionadas = EvaluacionCompetencia::where('evaluacion_id', $evaluacion->id)->pluck('competencia_id')->toArray();
        $competencias_seleccionadas_text = EvaluacionCompetencia::with(['competencia' => function ($q) {
            $q->with(['tipo']);
        }])->where('evaluacion_id', $evaluacion->id)->get();
        $total_evaluaciones = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->count();
        $contestadas = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->where('evaluado', true)->count();
        $progreso = floatval(number_format((($contestadas / $total_evaluaciones) * 100), 2));
        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.evaluacion', compact('evaluacion', 'competencias', 'competencias_seleccionadas', 'competencias_seleccionadas_text', 'total_evaluaciones', 'contestadas', 'progreso'));
    }

    public function getParticipantes(Request $request, $evaluacion)
    {

        if ($request->ajax()) {
            $lista_evaluados = [];
            $evaluados_evaluacion = Evaluacion::with(['evaluados' => function ($q) use ($evaluacion) {
                return $q->with(['area', 'evaluadores' => function ($qry) use ($evaluacion) {
                    $qry->where('evaluacion_id', $evaluacion);
                }]);
            }])->where('id', intval($evaluacion))->first();
            if ($evaluados_evaluacion->evaluados) {
                $evaluados = $evaluados_evaluacion->evaluados;
                foreach ($evaluados as $evaluado) {
                    $evaluadores = EvaluadoEvaluador::with('evaluador')->where('evaluado_id', $evaluado->id)->where('evaluacion_id', intval($evaluacion))->get();
                    $total_evaluaciones = count($evaluadores);
                    $contestadas = EvaluadoEvaluador::where('evaluado_id', $evaluado->id)
                        ->where('evaluacion_id', intval($evaluacion))
                        ->where('evaluado', true)->count();
                    $progreso = floatval(number_format((($contestadas / $total_evaluaciones) * 100), 2));
                    array_push($lista_evaluados, array([
                        'id' => $evaluado->id,
                        'name' => $evaluado->name,
                        'area' => $evaluado->area->area,
                        'evaluadores' => $evaluadores,
                        'total_evaluaciones' => $total_evaluaciones,
                        'contestadas' => $contestadas,
                        'progreso' => $progreso,
                    ])[0]);
                }

                return datatables()->of($lista_evaluados)->toJson();
            } else {
                $evaluados = array();
                return datatables()->of($evaluados)->toJson();
            }
        }
    }

    public function relatedCompetenciaWithEvaluacion(Request $request, $evaluacion)
    {

        if ($request->ajax()) {
            $evaluacion_competencia = EvaluacionCompetencia::create([
                'competencia_id' => $request->competencia_id,
                'evaluacion_id' => $evaluacion
            ]);
            if ($evaluacion_competencia) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function deleteRelatedCompetenciaWithEvaluacion(Request $request, $evaluacion)
    {
        if ($request->ajax()) {
            $evaluacion_competencia = EvaluacionCompetencia::where('evaluacion_id', intval($evaluacion))->where('competencia_id', $request->competencia_id)->first();
            $d_evaluacion_competencia = $evaluacion_competencia->delete();
            if ($d_evaluacion_competencia) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }
}

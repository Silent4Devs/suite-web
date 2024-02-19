<?php

namespace App\Http\Controllers\Admin\RH;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Ev360ResumenTabla;
use App\Mail\RH\Evaluaciones\CitaEvaluadorEvaluado;
use App\Mail\RH\Evaluaciones\RecordatorioEvaluadores;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\RH\CatalogoRangosObjetivos;
use App\Models\RH\Competencia;
use App\Models\RH\CompetenciaPuesto;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionCompetencia;
use App\Models\RH\EvaluacionesEvaluados;
use App\Models\RH\EvaluacionObjetivo;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoCalificacion;
use App\Models\RH\ObjetivoEmpleado;
use App\Models\RH\ObjetivoRespuesta;
use App\Models\RH\RangosResultado;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Spatie\CalendarLinks\Link;

class EV360EvaluacionesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('seguimiento_evaluaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($this->obtenerCantidadMaximaDeObjetivos(20));
        $areas = Area::all();
        $empleados = Empleado::getaltaAll();

        if ($request->ajax()) {
            $evaluaciones = Evaluacion::orderByDesc('id')->get();

            return datatables()->of($evaluaciones)->toJson();
        }

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.index', compact('areas', 'empleados'));
    }

    public function create()
    {
        abort_if(Gate::denies('seguimiento_evaluaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $evaluacion = Evaluacion::getAll();
        $areas = Area::all();
        $empleados = Empleado::getaltaAll();

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.create', compact('evaluacion', 'areas', 'empleados'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('seguimiento_evaluaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
                    $evaluados = Empleado::getaltaAll()->pluck('id')->toArray();
                } else {
                    $evaluados_area = intval($request->evaluados_areas);
                    $evaluados = Empleado::getaltaAll()->where('area_id', $evaluados_area)->pluck('id')->toArray();
                }
            } else {
                $evaluados = $request->evaluados_manual;
            }

            $evaluacion = Evaluacion::create($request->all() + ['autor_id' => User::getCurrentUser()->empleado->id]);
            $evaluacion->evaluados()->sync($evaluados);
            foreach ($evaluados as $evaluado) {
                $this->relacionarEvaluadoConEvaluadores($evaluacion, $evaluado);
            }

            return response()->json(['response' => $evaluados]);
        }
    }

    public function obtenerEquipoACargo($childrens)
    {
        $equipo_a_cargo = collect();

        foreach ($childrens as $evaluador) {
            $equipo_a_cargo->push($evaluador->id);

            if (count($evaluador->children)) {
                $equipo_a_cargo->push($this->obtenerEquipoACargo($evaluador->children));
            }
        }

        return $equipo_a_cargo->flatten(1)->toArray();
    }

    public function relacionarEvaluadoConEvaluadores($evaluacion, $evaluado)
    {
        $empleado = Empleado::with('children', 'supervisor')->find(intval($evaluado));
        $evaluadores = collect();
        $evaluacion = Evaluacion::with('competencias')->find($evaluacion->id);

        if ($evaluacion->autoevaluacion) {
            $evaluadores->push(intval($empleado->id));
        }
        if ($evaluacion->evaluado_por_jefe) {
            if ($empleado->supervisor) {
                $evaluadores->push(intval($empleado->supervisor->id));
            }
        }
        if ($evaluacion->evaluado_por_misma_area) {
            if ($empleado->empleados_misma_area) {
                foreach ($empleado->empleados_misma_area as $evaluador) {
                    $evaluadores->push(intval($evaluador));
                }
            }
        }
        if ($evaluacion->evaluado_por_equipo_a_cargo) {
            if ($empleado->children) {
                $childrens = $empleado->children;
                $evaluadores->push($this->obtenerEquipoACargo($childrens));
            }
        }
        $evaluadores = $evaluadores->flatten(1)->unique()->toArray();

        foreach ($evaluadores as $evaluador) {
            EvaluadoEvaluador::create([
                'evaluado_id' => $empleado->id,
                'evaluador_id' => intval($evaluador),
                'evaluacion_id' => $evaluacion->id,
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
        $empleado = Empleado::with('children', 'supervisor')->find(intval($evaluado));
        $evaluadores = collect();
        $evaluacion = Evaluacion::with('competencias')->find($evaluacion->id);

        if ($evaluacion->autoevaluacion) {
            $evaluadores->push(intval($empleado->id));
        }
        if ($evaluacion->evaluado_por_jefe) {
            if ($empleado->supervisor) {
                $evaluadores->push(intval($empleado->supervisor->id));
            }
        }
        if ($evaluacion->evaluado_por_misma_area) {
            if ($empleado->empleados_misma_area) {
                foreach ($empleado->empleados_misma_area as $evaluador) {
                    $evaluadores->push(intval($evaluador));
                }
            }
        }
        if ($evaluacion->evaluado_por_equipo_a_cargo) {
            if ($empleado->children) {
                $childrens = $empleado->children;
                $evaluadores->push($this->obtenerEquipoACargo($childrens));
            }
        }

        $competencias = $evaluacion->competencias;
        $objetivos = $evaluacion->objetivos;
        $evaluadores = $evaluadores->flatten(1)->unique()->toArray();

        foreach ($evaluadores as $evaluador) {
            foreach ($competencias as $competencia) {
                EvaluacionRepuesta::create([
                    'calificacion' => 0,
                    'descripcion' => null,
                    'competencia_id' => $competencia->id,
                    'evaluado_id' => $empleado->id,
                    'evaluador_id' => $evaluador,
                    'evaluacion_id' => $evaluacion->id,
                ]);
            }
        }

        foreach ($evaluadores as $evaluador) {
            foreach ($objetivos as $objetivo) {
                ObjetivoRespuesta::create([
                    'meta_alcanzada' => 'Sin evaluar',
                    'calificacion' => 0,
                    'objetivo_id' => $objetivo->id,
                    'evaluado_id' => $empleado->id,
                    'evaluador_id' => $evaluador,
                    'evaluacion_id' => $evaluacion->id,
                ]);
                ObjetivoEmpleado::where('empleado_id', '=', $empleado->id)
                    ->where('objetivo_id', '=', $objetivo->id)
                    ->where('en_curso', '=', true)
                    ->update([
                        'evaluacion_id' => $evaluacion->id,
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

    public function cerrarEvaluacion($evaluacion)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));

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

    public function contestarCuestionario($evaluacion, $evaluado, $evaluador)
    {
        $usuario = User::getCurrentuser();

        if ($usuario->empleado->id == $evaluador) {
            $evaluacion = Evaluacion::with('rangos')->find(intval($evaluacion));
            // dd($evaluacion);
            $evaluado = Empleado::alta()->with(['puestoRelacionado' => function ($q) {
                $q->with(['competencias' => function ($q) {
                    $q->with('competencia');
                }]);
            }, 'objetivos'])->find(intval($evaluado));

            $evaluador = Empleado::getAll()->find(intval($evaluador));
            $isJefeInmediato = EvaluadoEvaluador::select('tipo')
                ->where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluador->id)
                ->where('evaluacion_id', $evaluacion->id)
                ->first();
            if (is_null($isJefeInmediato)) {
                $isJefeInmediato = false;
            } else {
                $isJefeInmediato = $isJefeInmediato->tipo == EvaluadoEvaluador::JEFE_INMEDIATO;
            }
            $preguntas = collect();
            $total_preguntas = 0;
            $preguntas_contestadas = 0;
            $preguntas_no_contestadas = 0;
            $progreso = 0;
            if ($evaluacion->include_competencias) {
                $preguntas_sql = EvaluacionRepuesta::with(['competencia' => function ($q) use ($evaluado) {
                    $q->with(['opciones' => function ($qry) {
                        $qry->orderByDesc('ponderacion');
                    }, 'competencia_puesto' => function ($q) use ($evaluado) {
                        $q->where('puesto_id', $evaluado->puestoRelacionado->id);
                    }]);
                }, 'evaluado', 'evaluador', 'evaluacion'])
                    ->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluador->id);
                $preguntas = $preguntas_sql->orderBy('id')->get();
                // $total_preguntas = $preguntas_sql->count();
                $total_preguntas = 0;
                foreach ($preguntas_sql->get() as $competenciaE) {
                    if (!is_null(Competencia::find($competenciaE->competencia_id))) {
                        $total_preguntas++;
                    }
                }
                $preguntas_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluador->id)
                    ->where('calificacion', '>', 0)->count();
                $preguntas_no_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluador->id)
                    ->where('calificacion', '=', 0)->count();
                if ($total_preguntas > 0) {
                    $progreso = floatval(number_format((($preguntas_contestadas / $total_preguntas) * 100)));
                }
            }

            $objetivos = collect();
            $objetivos_evaluados = 0;
            $objetivos_no_evaluados = 0;
            $progreso_objetivos = 0;
            if ($evaluacion->include_objetivos) {
                $objetivos = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                    $q->with(['metrica']);
                }])->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluador->id)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->get()->sortBy('objetivo.tipo_id');
                // dd($objetivos);
                $objetivos_evaluados = ObjetivoRespuesta::where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluador->id)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado', true)
                    ->count();
                $objetivos_no_evaluados = ObjetivoRespuesta::where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluador->id)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado', false)
                    ->count();
                if (count($objetivos)) {
                    $progreso_objetivos = floatval(number_format((($objetivos_evaluados / count($objetivos)) * 100)));
                }
            }
            // dd($objetivos);
            // dd($objetivos, $objetivos_evaluados, $objetivos_no_evaluados);
            $esta_evaluado = EvaluadoEvaluador::where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluador->id)
                ->where('evaluacion_id', $evaluacion->id)->first()->evaluado;
            // dd($esta_evaluado);
            $finalizo_tiempo = false;
            if (Carbon::now()->diffInDays(Carbon::parse($evaluacion->fecha_fin), false) + 1 <= 0) {
                $finalizo_tiempo = true;
            }
            $competencias_por_puesto_nivel_esperado = $evaluado->puestoRelacionado;
            if ($competencias_por_puesto_nivel_esperado) {
                $competencias_por_puesto_nivel_esperado = $evaluado->puestoRelacionado->competencias;
                $competencias_evaluadas_en_esta_evaluacion = $preguntas->pluck('competencia_id')->toArray();
                $competencias_por_puesto_nivel_esperado = $competencias_por_puesto_nivel_esperado->map(function ($competencia) use ($competencias_evaluadas_en_esta_evaluacion) {
                    if (!is_null($competencia->competencia)) {
                        if (in_array($competencia->competencia->id, $competencias_evaluadas_en_esta_evaluacion)) {
                            return $competencia;
                        }
                    }
                }); //Filtro para obtener solo las competencias evaluadas al momento de la creación de la evaluacion
            } else {
                $competencias_por_puesto_nivel_esperado = collect();
            }

            $evaluaciones_a_realizar = EvaluadoEvaluador::with('empleado_evaluado')->where('evaluacion_id', $evaluacion->id)
                ->where('evaluador_id', $evaluador->id)->get();

            // dd($evaluaciones_a_realizar);
            return view(
                'admin.recursos-humanos.evaluacion-360.evaluaciones.cuestionario',
                compact(
                    'evaluacion',
                    'preguntas',
                    'evaluado',
                    'evaluador',
                    'total_preguntas',
                    'preguntas_contestadas',
                    'preguntas_no_contestadas',
                    'progreso',
                    'finalizo_tiempo',
                    'objetivos',
                    'progreso_objetivos',
                    'objetivos_evaluados',
                    'objetivos_no_evaluados',
                    'esta_evaluado',
                    'competencias_por_puesto_nivel_esperado',
                    'isJefeInmediato',
                    'evaluaciones_a_realizar',
                )
            );
        } else {
            return redirect(route('admin.inicio-Usuario.index'));
        }
    }

    public function evaluacion(Evaluacion $evaluacion)
    {
        abort_if(Gate::denies('seguimiento_evaluaciones_evaluacion'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $evaluacion->load('autor');

        $lista_evaluados = [];
        //close evaluation if the end date is passed and if the evaluation is not closed
        if ($evaluacion->estatus == Evaluacion::ACTIVE) {
            if (Carbon::now()->diffInDays(Carbon::parse($evaluacion->fecha_fin), false) + 1 <= 0) {
                $this->cerrarEvaluacion($evaluacion->id);
            }
        }

        $evaluados_evaluacion = Evaluacion::getEvaluados($evaluacion->id);
        if ($evaluados_evaluacion->evaluados) {
            $evaluados = $evaluados_evaluacion->evaluados;
            foreach ($evaluados as $evaluado) {
                $evaluadores = EvaluadoEvaluador::with('evaluador')->where('evaluado_id', $evaluado->id)->where('evaluacion_id', $evaluacion->id)->get();
                $total_evaluaciones = count($evaluadores);
                $contestadas = EvaluadoEvaluador::where('evaluado_id', $evaluado->id)
                    ->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado', true)->count();
                $progreso = floatval(number_format((($contestadas / $total_evaluaciones) * 100), 2));
                $lista_evaluados[] =
                    [
                        'id' => $evaluado->id,
                        'name' => $evaluado->name,
                        'area' => $evaluado->area->area,
                        'evaluadores' => $evaluadores,
                        'total_evaluaciones' => $total_evaluaciones,
                        'contestadas' => $contestadas,
                        'progreso' => $progreso,
                        'evaluacion' => $evaluacion->id,
                        'can_edit' => $evaluados_evaluacion->estatus == Evaluacion::DRAFT ? true : false,
                    ];
                // array_push($evaluados, [[
                //     'id' => $evaluado->id,
                //     'name' => $evaluado->name,
                //     'area' => $evaluado->area->area,
                //     'evaluadores' => $evaluadores,
                //     'total_evaluaciones' => $total_evaluaciones,
                //     'contestadas' => $contestadas,
                //     'progreso' => $progreso,
                //     'evaluacion' => $evaluacion->id,
                //     'can_edit' => $evaluados_evaluacion->estatus == Evaluacion::DRAFT ? true : false,
                // ]][0]);
            }
        } else {
            $lista_evaluados = [];
        }
        // dd($lista_evaluados[0]['evaluadores'][0]->evaluador);
        // dd($evaluacion, $evaluados_evaluacion, $evaluados, $lista_evaluados);
        // $competencias = Competencia::select('id', 'nombre')->get();
        // $objetivos = Objetivo::select('id', 'nombre')->get();
        // $competencias_seleccionadas = EvaluacionCompetencia::where('evaluacion_id', $evaluacion->id)->pluck('competencia_id')->toArray();
        // $objetivos_seleccionados = EvaluacionObjetivo::where('evaluacion_id', $evaluacion->id)->pluck('objetivo_id')->toArray();
        // $competencias_seleccionadas_text = EvaluacionCompetencia::with(['competencia' => function ($q) {
        //     $q->with(['tipo']);
        // }])->where('evaluacion_id', $evaluacion->id)->get();
        // $objetivos_seleccionados_text = EvaluacionObjetivo::with(['objetivo' => function ($q) {
        //     $q->with(['tipo', 'metrica']);
        // }])->where('evaluacion_id', $evaluacion->id)->get();
        $total_evaluaciones = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->count();
        $contestadas = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->where('evaluado', true)->count();
        $progreso = floatval(number_format((($contestadas / $total_evaluaciones) * 100), 2));

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.evaluacion', compact('evaluacion', 'total_evaluaciones', 'contestadas', 'progreso', 'lista_evaluados'));
        // return view('admin.recursos-humanos.evaluacion-360.evaluaciones.evaluacion', compact('evaluacion', 'competencias', 'competencias_seleccionadas', 'competencias_seleccionadas_text', 'total_evaluaciones', 'contestadas', 'progreso', 'objetivos', 'objetivos_seleccionados', 'objetivos_seleccionados_text'));
    }

    public function getParticipantes(Request $request, $evaluacion)
    {
        if ($request->ajax()) {
            // dd($evaluacion);
            // dd(intval($evaluacion));
            $lista_evaluados = [];
            // $evaluados_evaluacion = Evaluacion::with(['evaluados' => function ($q) use ($evaluacion) {
            //     return $q->with(['area', 'evaluadores' => function ($qry) use ($evaluacion) {
            //         $qry->where('evaluacion_id', $evaluacion);
            //     }]);
            // }])->where('id', intval($evaluacion))->first();
            // dd($evaluacion, $evaluados_evaluacion);
            $id_evaluacion = intval($evaluacion);
            $evaluados_evaluacion = Evaluacion::getEvaluados($id_evaluacion);
            // dd('1');
            if ($evaluados_evaluacion->evaluados) {
                $evaluados = $evaluados_evaluacion->evaluados;
                foreach ($evaluados as $evaluado) {
                    $evaluadores = EvaluadoEvaluador::with('evaluador')->where('evaluado_id', $evaluado->id)->where('evaluacion_id', $id_evaluacion)->get();
                    $total_evaluaciones = count($evaluadores);
                    $contestadas = EvaluadoEvaluador::where('evaluado_id', $evaluado->id)
                        ->where('evaluacion_id', $id_evaluacion)
                        ->where('evaluado', true)->count();
                    $progreso = floatval(number_format((($contestadas / $total_evaluaciones) * 100), 2));
                    array_push($lista_evaluados, [[
                        'id' => $evaluado->id,
                        'name' => $evaluado->name,
                        'area' => $evaluado->area->area,
                        'evaluadores' => $evaluadores,
                        'total_evaluaciones' => $total_evaluaciones,
                        'contestadas' => $contestadas,
                        'progreso' => $progreso,
                        'evaluacion' => $id_evaluacion,
                        'can_edit' => $evaluados_evaluacion->estatus == Evaluacion::DRAFT ? true : false,
                    ]][0]);
                }

                return datatables()->of($lista_evaluados)->toJson();
            } else {
                $evaluados = [];

                return datatables()->of($evaluados)->toJson();
            }
        }
    }

    public function relatedCompetenciaWithEvaluacion(Request $request, $evaluacion)
    {
        if ($request->ajax()) {
            $evaluacion_competencia = EvaluacionCompetencia::create([
                'competencia_id' => $request->competencia_id,
                'evaluacion_id' => $evaluacion,
            ]);
            if ($evaluacion_competencia) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function relatedObjetivoWithEvaluacion(Request $request, $evaluacion)
    {
        if ($request->ajax()) {
            $evaluacion_objetivo = EvaluacionObjetivo::create([
                'objetivo_id' => $request->objetivo_id,
                'evaluacion_id' => $evaluacion,
            ]);
            if ($evaluacion_objetivo) {
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

    public function deleteRelatedCompetenciWithEvaluacion(Request $request, $evaluacion)
    {
        if ($request->ajax()) {
            $evaluacion_objetivo = EvaluacionObjetivo::where('evaluacion_id', intval($evaluacion))->where('objetivo_id', $request->objetivo_id)->first();
            $d_evaluacion_objetivo = $evaluacion_objetivo->delete();
            if ($d_evaluacion_objetivo) {
                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function storeMetaAlcanzadaDescripcion(Request $request)
    {
        $objetivo = ObjetivoRespuesta::where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluador)
            ->where('evaluacion_id', $request->evaluacion)
            ->where('objetivo_id', $request->objetivo);
        $update_objetivo = $objetivo->update([
            'meta_alcanzada' => $request->meta_alcanzada,
        ]);
        if ($update_objetivo) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function saveCalificacionPersepcion(Request $request)
    {
        $objetivo = ObjetivoRespuesta::with('evaluacion.rangos')
            ->where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluador)
            ->where('evaluacion_id', $request->evaluacion)
            ->where('objetivo_id', $request->objetivo)
            ->first();

        $update_objetivo = $objetivo->update([
            'calificacion_persepcion' => $request->calificacion_persepcion,
        ]);

        if ($update_objetivo) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function storeCalificacion($evaluado, $evaluador, $evaluacion, $objetivo, $calificacion)
    {
        $objetivo = ObjetivoRespuesta::where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('evaluacion_id', $evaluacion)
            ->where('objetivo_id', $objetivo);
        $update_objetivo = $objetivo->update([
            'calificacion' => intval($calificacion),
            'evaluado' => true,
        ]);

        $objetivos = ObjetivoRespuesta::where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('evaluacion_id', $evaluacion)
            ->count();
        $objetivos_evaluados = ObjetivoRespuesta::where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('evaluacion_id', $evaluacion)
            ->where('evaluado', true)
            ->count();
        $objetivos_no_evaluados = ObjetivoRespuesta::where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('evaluacion_id', $evaluacion)
            ->where('evaluado', false)
            ->count();
        if ($objetivos) {
            $progreso_objetivos = floatval(number_format((($objetivos_evaluados / $objetivos) * 100)));
        } else {
            $progreso_objetivos = 0;
        }

        if ($update_objetivo) {
            return response()->json(['success' => true, 'progreso' => $progreso_objetivos, 'contestadas' => $objetivos_evaluados, 'sin_contestar' => $objetivos_no_evaluados]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function storeMetaAlcanzada(Request $request)
    {
        $objetivo = ObjetivoRespuesta::where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluador)
            ->where('evaluacion_id', $request->evaluacion)
            ->where('objetivo_id', $request->objetivo);
        $update_objetivo = $objetivo->update([
            'calificacion' => intval($request->calificacion),
            'evaluado' => true,
        ]);

        $objetivos = ObjetivoRespuesta::where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluador)
            ->where('evaluacion_id', $request->evaluacion)
            ->count();
        $objetivos_evaluados = ObjetivoRespuesta::where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluador)
            ->where('evaluacion_id', $request->evaluacion)
            ->where('evaluado', true)
            ->count();
        $objetivos_no_evaluados = ObjetivoRespuesta::where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluador)
            ->where('evaluacion_id', $request->evaluacion)
            ->where('evaluado', false)
            ->count();
        if ($objetivos) {
            $progreso_objetivos = floatval(number_format((($objetivos_evaluados / $objetivos) * 100)));
        } else {
            $progreso_objetivos = 0;
        }

        if ($update_objetivo) {
            return response()->json(['success' => true, 'progreso' => $progreso_objetivos, 'contestadas' => $objetivos_evaluados, 'sin_contestar' => $objetivos_no_evaluados]);
        } else {
            return response()->json(['error' => true]);
        }
    }

    public function finalizarEvaluacion(Request $request, $evaluacion, $evaluado, $evaluador)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));
        $existsFolderFirmasEvaluacion = Storage::exists('public/evaluaciones/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $evaluacion->nombre));
        if (!$existsFolderFirmasEvaluacion) {
            Storage::makeDirectory('public/evaluaciones/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $evaluacion->nombre));
        }

        if (isset($request->firma_evaluado)) {
            if (preg_match('/^data:image\/(\w+);base64,/', $request->firma_evaluado)) {
                $value = substr($request->firma_evaluado, strpos($request->firma_evaluado, ',') + 1);
                $value = base64_decode($value);
                $new_name_image = 'FirmaEvaluado' . $evaluacion->id . $evaluado . $evaluador . '.png';
                $image = $new_name_image;
                $route = 'public/evaluaciones/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $evaluacion->nombre) . '/' . $new_name_image;
                Storage::put($route, $value);
                $evaluacion_especifica = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                    ->where('evaluador_id', $evaluador)
                    ->where('evaluacion_id', $evaluacion->id)->first();
                $evaluacion_especifica->update([
                    'firma_evaluado' => $image,
                ]);
            }
        }
        if (isset($request->firma_evaluador)) {
            if (preg_match('/^data:image\/(\w+);base64,/', $request->firma_evaluador)) {
                $value = substr($request->firma_evaluador, strpos($request->firma_evaluador, ',') + 1);
                $value = base64_decode($value);
                $new_name_image = 'FirmaEvaluador' . $evaluacion->id . $evaluador . $evaluado . '.png';
                $image = $new_name_image;
                $route = 'public/evaluaciones/firmas/' . preg_replace(['/\s+/i', '/-/i'], '_', $evaluacion->nombre) . '/' . $new_name_image;
                Storage::put($route, $value);
                $evaluacion_especifica = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                    ->where('evaluador_id', $evaluador)
                    ->where('evaluacion_id', $evaluacion->id)->first();
                $evaluacion_especifica->update([
                    'firma_evaluador' => $image,
                ]);
            }
        }

        if ($evaluacion->include_competencias && $evaluacion->include_objetivos) {
            $progreso_objetivos = $this->progresoObjetivos($evaluado, $evaluador, $evaluacion->id);
            $progreso_competencias = $this->progresoCompetencias($evaluado, $evaluador, $evaluacion->id);
            $objetivos = ObjetivoRespuesta::where('evaluado_id', $evaluado)
                ->where('evaluador_id', $evaluador)
                ->where('evaluacion_id', $evaluacion->id)
                ->count();
            $competencias = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado)
                ->where('evaluador_id', $evaluador)->count();
            if ($objetivos == 0) {
                $progreso_objetivos = 100;
            }
            if ($competencias == 0) {
                $progreso_competencias = 100;
            }
            if ($progreso_objetivos == 100 && $progreso_competencias == 100) {
                $evaluacion_especifica = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                    ->where('evaluador_id', $evaluador)
                    ->where('evaluacion_id', $evaluacion->id)->first();
                $evaluacion_especifica->update([
                    'evaluado' => true,
                ]);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
        if ($evaluacion->include_competencias && !$evaluacion->include_objetivos) {
            $progreso_competencias = $this->progresoCompetencias($evaluado, $evaluador, $evaluacion->id);
            if ($progreso_competencias == 100) {
                $evaluacion_especifica = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                    ->where('evaluador_id', $evaluador)
                    ->where('evaluacion_id', $evaluacion->id)->first();
                $evaluacion_especifica->update([
                    'evaluado' => true,
                ]);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
        if (!$evaluacion->include_competencias && $evaluacion->include_objetivos) {
            $progreso_objetivos = $this->progresoObjetivos($evaluado, $evaluador, $evaluacion->id);
            $progreso_competencias = $this->progresoCompetencias($evaluado, $evaluador, $evaluacion->id);
            if ($progreso_objetivos == 100) {
                $evaluacion_especifica = EvaluadoEvaluador::where('evaluado_id', $evaluado)
                    ->where('evaluador_id', $evaluador)
                    ->where('evaluacion_id', $evaluacion->id)->first();
                $evaluacion_especifica->update([
                    'evaluado' => true,
                ]);

                return response()->json(['success' => true]);
            } else {
                return response()->json(['error' => true]);
            }
        }
    }

    public function progresoObjetivos($evaluado, $evaluador, $evaluacion)
    {
        $objetivos = ObjetivoRespuesta::where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('evaluacion_id', $evaluacion)
            ->count();
        $objetivos_evaluados = ObjetivoRespuesta::where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('evaluacion_id', $evaluacion)
            ->where('evaluado', true)
            ->count();
        $objetivos = $objetivos > 0 ? $objetivos : 1;
        $objetivos_evaluados = $objetivos_evaluados > 0 ? $objetivos_evaluados : 1;
        if ($objetivos) {
            $progreso_objetivos = floatval(number_format((($objetivos_evaluados / $objetivos) * 100)));
        } else {
            $progreso_objetivos = 0;
        }

        return $progreso_objetivos;
    }

    public function progresoCompetencias($evaluado, $evaluador, $evaluacion)
    {
        $preguntas_sql = EvaluacionRepuesta::where('evaluacion_id', $evaluacion)
            ->where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador);
        $total_preguntas = 0;
        foreach ($preguntas_sql->get() as $competenciaE) {
            if (!is_null(Competencia::find($competenciaE->competencia_id))) {
                $total_preguntas++;
            }
        }

        $preguntas_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion)
            ->where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('calificacion', '>', 0)->count();
        $preguntas_contestadas = $preguntas_contestadas > 0 ? $preguntas_contestadas : 1;
        $total_preguntas = $total_preguntas > 0 ? $total_preguntas : 1;
        $progreso = floatval(number_format((($preguntas_contestadas / $total_preguntas) * 100)));

        return $progreso;
    }

    public function getAutoevaluacionCompetencias(Request $request)
    {
        $evaluacion = EvaluacionRepuesta::with('competencia')->where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluado)
            ->where('evaluacion_id', $request->evaluacion)
            ->get();

        return json_encode($evaluacion);
    }

    public function getAutoevaluacionObjetivos(Request $request)
    {
        $evaluacion = ObjetivoRespuesta::with(['objetivo' => function ($q) {
            $q->with('metrica');
        }])->where('evaluado_id', $request->evaluado)
            ->where('evaluador_id', $request->evaluado)
            ->where('evaluacion_id', $request->evaluacion)
            ->get();

        return json_encode($evaluacion);
    }

    public function consultaPorEvaluado($evaluacion, $evaluado)
    {
        $ev360ResumenTabla = new Ev360ResumenTabla();
        $informacion_obtenida = $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion, $evaluado);
        $calificaciones = $this->desglosarCalificaciones($informacion_obtenida);
        $nombresObjetivos = [];
        $metaObjetivos = [];
        $calificacionObjetivos = [];
        foreach ($informacion_obtenida['evaluadores_objetivos'] as $item) {
            if ($item['esSupervisor']) {
                foreach ($item['objetivos'] as $objetivo) {
                    array_push($nombresObjetivos, $objetivo['nombre']);
                    array_push($metaObjetivos, $objetivo['meta']);
                    array_push($calificacionObjetivos, $objetivo['calificacion']);
                }
            }
        }

        $calificaciones_autoevaluacion_competencias = $calificaciones['calificaciones_autoevaluacion_competencias'];
        $calificaciones_jefe_competencias = $calificaciones['calificaciones_jefe_competencias'];
        $calificaciones_equipo_competencias = $calificaciones['calificaciones_equipo_competencias'];
        $calificaciones_area_competencias = $calificaciones['calificaciones_area_competencias'];
        $competencias_lista_nombre = $calificaciones['competencias_lista_nombre'];
        $peso_general_competencias = $informacion_obtenida['peso_general_competencias'];
        $peso_general_objetivos = $informacion_obtenida['peso_general_objetivos'];
        $lista_autoevaluacion = $informacion_obtenida['lista_autoevaluacion'];
        $jefe_evaluador = $informacion_obtenida['jefe_evaluador'];
        $lista_jefe_inmediato = $informacion_obtenida['lista_jefe_inmediato'];
        $lista_equipo_a_cargo = $informacion_obtenida['lista_equipo_a_cargo'];
        $lista_misma_area = $informacion_obtenida['lista_misma_area'];
        $promedio_competencias = $informacion_obtenida['promedio_competencias'];
        $promedio_general_competencias = $informacion_obtenida['promedio_general_competencias'];
        $evaluadores_objetivos = $informacion_obtenida['evaluadores_objetivos'];
        $promedio_objetivos = $informacion_obtenida['promedio_objetivos'];
        $promedio_general_objetivos = $informacion_obtenida['promedio_general_objetivos'];
        $calificacion_final = $informacion_obtenida['calificacion_final'];
        $evaluacion = Evaluacion::find(intval($evaluacion));
        $evaluado = Empleado::with(['area', 'puestoRelacionado' => function ($q) {
            $q->with('competencias');
        }])->find(intval($evaluado));
        $nivelesEsperadosCompetencias = $evaluado->puestoRelacionado->competencias->map(function ($item) {
            return $item->nivel_esperado;
        })->toArray();
        $existeFirmaAuto = false;
        $firmaAuto = 'img/signature.png';

        if (!empty($informacion_obtenida['lista_autoevaluacion']) && is_array($informacion_obtenida['lista_autoevaluacion'])) {
            // Check if the array is not empty and is an array
            if (!empty($informacion_obtenida['lista_autoevaluacion'][0]['firma'])) {
                $existeFirmaAuto = Storage::exists('/public/' . $informacion_obtenida['lista_autoevaluacion'][0]['firma']);
            }
        }

        if ($existeFirmaAuto) {
            $firmaAuto = '/storage/' . $informacion_obtenida['lista_autoevaluacion'][0]['firma'];
        }

        $existeFirmaJefe = false;
        $firmaJefe = 'img/signature.png';

        if (!empty($informacion_obtenida['lista_jefe_inmediato']) && is_array($informacion_obtenida['lista_jefe_inmediato'])) {
            if (!empty($informacion_obtenida['lista_jefe_inmediato'][0]['firma'])) {
                $existeFirmaJefe = Storage::exists('/public/' . $informacion_obtenida['lista_jefe_inmediato'][0]['firma']);
            }
        }

        if ($existeFirmaJefe) {
            $firmaJefe = '/storage/' . $informacion_obtenida['lista_jefe_inmediato'][0]['firma'];
        }

        $existeFirmaSubordinado = false;
        $firmaEquipo = 'img/signature.png';

        if (!empty($informacion_obtenida['lista_equipo_a_cargo']) && is_array($informacion_obtenida['lista_equipo_a_cargo'])) {
            if (!empty($informacion_obtenida['lista_equipo_a_cargo'][0]['firma'])) {
                $existeFirmaSubordinado = Storage::exists('/public/' . $informacion_obtenida['lista_equipo_a_cargo'][0]['firma']);
            }
        }

        if ($existeFirmaSubordinado) {
            $firmaEquipo = '/storage/' . $informacion_obtenida['lista_equipo_a_cargo'][0]['firma'];
        }

        $existeFirmaPar = false;
        $firmaPar = 'img/signature.png';

        if (!empty($informacion_obtenida['lista_misma_area']) && is_array($informacion_obtenida['lista_misma_area'])) {
            if (!empty($informacion_obtenida['lista_misma_area'][0]['firma'])) {
                $existeFirmaPar = Storage::exists('/public/' . $informacion_obtenida['lista_misma_area'][0]['firma']);
            }
        }

        if ($existeFirmaPar) {
            $firmaPar = '/storage/' . $informacion_obtenida['lista_misma_area'][0]['firma'];
        }


        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluado', compact(
            'evaluacion',
            'evaluado',
            'lista_autoevaluacion',
            'jefe_evaluador',
            'lista_jefe_inmediato',
            'lista_equipo_a_cargo',
            'lista_misma_area',
            'promedio_competencias',
            'promedio_general_competencias',
            'evaluadores_objetivos',
            'promedio_objetivos',
            'promedio_general_objetivos',
            'calificacion_final',
            'competencias_lista_nombre',
            'calificaciones_autoevaluacion_competencias',
            'calificaciones_jefe_competencias',
            'calificaciones_equipo_competencias',
            'calificaciones_area_competencias',
            'nivelesEsperadosCompetencias',
            'peso_general_competencias',
            'peso_general_objetivos',
            'firmaAuto',
            'firmaJefe',
            'firmaEquipo',
            'firmaPar',
            'existeFirmaAuto',
            'existeFirmaJefe',
            'existeFirmaSubordinado',
            'existeFirmaPar',
            'nombresObjetivos',
            'metaObjetivos',
            'calificacionObjetivos'
        ));
    }

    // public function reactivarPorEvaluado($evaluacion, $evaluado)
    // {
    //     $evaluacion = Evaluacion::find(intval($evaluacion));
    //     $evaluado = Empleado::find(intval($evaluado));

    //     $reactivacion=EvaluadoEvaluador::where('evaluacion_id', '=', $evaluacion->id)
    //     ->where('evaluado_id', '=', $evaluado->id)->get();

    //     foreach($reactivacion as $react)
    //     {
    //         $react->update([
    //             'evaluado' => 'false',
    //         ]);
    //     }

    //     return response()->json(['success' => 'true']);
    // }

    public function reactivarPorEvaluador($evaluacion, $evaluado, $evaluador)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));
        $empleados = Empleado::getAll();
        $evaluado = $empleados->find(intval($evaluado));
        $evaluador = $empleados->find(intval($evaluador));
        // dd($evaluacion->id, $evaluado->id, $evaluador->id);

        $reactivacion = EvaluadoEvaluador::where('evaluacion_id', '=', $evaluacion->id)
            ->where('evaluado_id', '=', $evaluado->id)
            ->where('evaluador_id', '=', $evaluador->id)
            ->first();

        $reactivacion->update([
            'evaluado' => 'false',
        ]);

        return redirect()->back()
            ->with('success', 'Se ha reactivado al usuario: ' . $evaluador->name .
                ', para evaluar al usuario: ' . $evaluado->name);
    }

    public function normalizarCalificacionObjetivo(Request $request)
    {
        $objetivo = ObjetivoCalificacion::find(intval($request->id));
        $objetivo->update([
            'calificacion' => $request->calificacion,
        ]);

        return response()->json(['success' => 'true']);
    }

    public function desglosarCalificaciones($informacion_obtenida)
    {
        $competencias_lista_nombre = collect();
        $calificaciones_meta_competencias = collect();
        foreach ($informacion_obtenida['lista_autoevaluacion'] as $autoevaluacion_calificaciones) {
            foreach ($autoevaluacion_calificaciones['evaluaciones'] as $evaluacion_auto) {
                foreach ($evaluacion_auto['competencias'] as $competencia_auto) {
                    $calificaciones_meta_competencias->push($competencia_auto['meta']);
                }
            }
        }

        $calificaciones_autoevaluacion_competencias = collect();
        foreach ($informacion_obtenida['lista_autoevaluacion'] as $autoevaluacion_calificaciones) {
            foreach ($autoevaluacion_calificaciones['evaluaciones'] as $evaluacion_auto) {
                foreach ($evaluacion_auto['competencias'] as $competencia_auto) {
                    $competencias_lista_nombre->push($competencia_auto['competencia']);
                    $calificaciones_autoevaluacion_competencias->push($competencia_auto['calificacion']);
                }
            }
        }
        $calificaciones_jefe_competencias = collect();
        foreach ($informacion_obtenida['lista_jefe_inmediato'] as $jefe_calificaciones) {
            foreach ($jefe_calificaciones['evaluaciones'] as $evaluacion_jefe) {
                foreach ($evaluacion_jefe['competencias'] as $competencia_jefe) {
                    $calificaciones_jefe_competencias->push($competencia_jefe['calificacion']);
                }
            }
        }

        $calificaciones_equipo_competencias = collect();
        foreach ($informacion_obtenida['lista_equipo_a_cargo'] as $equipo_calificaciones) {
            foreach ($equipo_calificaciones['evaluaciones'] as $evaluacion_equipo) {
                foreach ($evaluacion_equipo['competencias'] as $competencia_equipo) {
                    $calificaciones_equipo_competencias->push($competencia_equipo['calificacion']);
                }
            }
        }
        $calificaciones_area_competencias = collect();
        foreach ($informacion_obtenida['lista_misma_area'] as $area_calificaciones) {
            foreach ($area_calificaciones['evaluaciones'] as $evaluacion_area) {
                foreach ($evaluacion_area['competencias'] as $competencia_area) {
                    $calificaciones_area_competencias->push($competencia_area['calificacion']);
                }
            }
        }

        return [
            'competencias_lista_nombre' => $competencias_lista_nombre,
            'calificaciones_meta_competencias' => $calificaciones_meta_competencias,
            'calificaciones_autoevaluacion_competencias' => $calificaciones_autoevaluacion_competencias,
            'calificaciones_jefe_competencias' => $calificaciones_jefe_competencias,
            'calificaciones_equipo_competencias' => $calificaciones_equipo_competencias,
            'calificaciones_area_competencias' => $calificaciones_area_competencias,
        ];
    }

    public function obtenerInformacionDeLaConsultaPorEvaluado($evaluacion, $evaluado)
    {
        $evaluacion = Evaluacion::find(intval($evaluacion));
        $evaluado = Empleado::with(['area', 'puestoRelacionado' => function ($q) {
            $q->with('competencias');
        }])->find(intval($evaluado));
        $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
            ->where('evaluado_id', $evaluado->id)
            ->get();

        $calificacion_final = 0;

        $promedio_competencias = 0;
        $promedio_general_competencias = 0;
        $lista_autoevaluacion = collect();
        $lista_jefe_inmediato = collect();
        $lista_equipo_a_cargo = collect();
        $lista_misma_area = collect();
        if ($evaluacion->include_competencias) {
            $filtro_autoevaluacion = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::AUTOEVALUACION;
            });
            $filtro_jefe_inmediato = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
            });

            $filtro_equipo_a_cargo = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::EQUIPO;
            });
            $filtro_misma_area = $evaluadores->filter(function ($evaluador) {
                return intval($evaluador->tipo) == EvaluadoEvaluador::MISMA_AREA;
            });
            $promedio_competencias = 0;
            $promedio_competencias_collect = collect();
            // $cantidad_competencias_evaluadas = $evaluado->puestoRelacionado->competencias->count() > 0 ? $evaluado->puestoRelacionado->competencias->count() : 1;
            $cantidad_competencias_evaluadas = count($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id)) ? count($this->obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion->id)) : 1;
            $lista_autoevaluacion->push([
                'tipo' => 'Autoevaluación',
                'peso_general' => $evaluacion->peso_autoevaluacion,
                'evaluaciones' => $filtro_autoevaluacion->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_autoevaluacion->first()['evaluaciones'])) {
                foreach ($lista_autoevaluacion->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }

                // $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
                $promedio_competencias_collect->push(($calificacion * 100) / $cantidad_competencias_evaluadas);
                // } else {
                //     $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
            }

            $lista_jefe_inmediato->push([
                'tipo' => 'Jefe Inmediato',
                'peso_general' => $evaluacion->peso_jefe_inmediato,
                'evaluaciones' => $filtro_jefe_inmediato->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_jefe_inmediato->first()['evaluaciones'])) {
                foreach ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                // $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100);
                $promedio_competencias_collect->push(($calificacion * 100) / $cantidad_competencias_evaluadas);
                // } else {
                //     $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100);
            }

            $lista_equipo_a_cargo->push([
                'tipo' => 'Equipo a cargo',
                'peso_general' => $evaluacion->peso_equipo,
                'evaluaciones' => $filtro_equipo_a_cargo->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_equipo_a_cargo->first()['evaluaciones'])) {
                foreach ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                // $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100);
                $promedio_competencias_collect->push(($calificacion * 100) / $cantidad_competencias_evaluadas);
                // } else {
                //     $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100);
            }

            $lista_misma_area->push([
                'tipo' => 'Misma área',
                'peso_general' => $evaluacion->peso_area,
                'evaluaciones' => $filtro_misma_area->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::getAll()->find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_misma_area->first()['evaluaciones'])) {
                foreach ($lista_misma_area->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                // $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100);
                $promedio_competencias_collect->push(($calificacion * 100) / $cantidad_competencias_evaluadas);
                // } else {
                //     $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100);
            }

            // $promedio_competencias = number_format($promedio_competencias / 100, 2);
            $cantidad_participantes = $promedio_competencias_collect->count();
            if ($this->empleadoTieneCompetenciasAsignadas($evaluado->id, $evaluacion->id)) {
                $promedio_competencias = number_format($promedio_competencias_collect->sum(), 2);
                $promedio_general_competencias = number_format(($promedio_competencias * ($evaluacion->peso_general_competencias / 100)) / $cantidad_participantes, 2);
                $calificacion_final += $promedio_general_competencias;
            } else {
                $promedio_competencias = 1;
                $promedio_general_competencias = 100 * ($evaluacion->peso_general_competencias / 100);
                $calificacion_final += $evaluacion->peso_general_competencias;
            }
        } else {
            //Logica para cuando no se evaluan competencias
        }
        $promedio_objetivos = 0;
        $promedio_general_objetivos = 0;
        $evaluadores_objetivos = collect();

        $supervisorObjetivos = $evaluadores->filter(function ($item) {
            return intval($item->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
        })->first();
        if ($evaluacion->include_objetivos) {
            if ($supervisorObjetivos) {
                $objetivos_calificaciones = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                    return $q->with('metrica');
                }])->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $supervisorObjetivos->evaluador_id)
                    ->get();
                $evaluadores_objetivos->push([
                    'id' => $supervisorObjetivos->evaluador_id,
                    'nombre' => Empleado::select('name')->find($supervisorObjetivos->evaluador_id)->name,
                    'esSupervisor' => true,
                    'esAutoevaluacion' => false,
                    'objetivos' => $objetivos_calificaciones->map(function ($objetivo) {
                        return [
                            'nombre' => $objetivo->objetivo->nombre,
                            'KPI' => $objetivo->objetivo->KPI,
                            'meta' => $objetivo->objetivo->meta,
                            'descripcion_meta' => $objetivo->objetivo->descripcion_meta,
                            'metrica' => $objetivo->objetivo->metrica->definicion,
                            'meta_alcanzada' => $objetivo->meta_alcanzada,
                            'calificacion' => $objetivo->calificacion,
                        ];
                    }),
                ]);
            }
            $calificacion_objetivos = 0;
            if ($evaluadores_objetivos->first()) {
                if (count($evaluadores_objetivos->first()['objetivos'])) {
                    foreach ($evaluadores_objetivos->first()['objetivos'] as $objetivo) {
                        $calificacion_objetivos += $objetivo['calificacion'] / ($objetivo['meta'] > 0 ? $objetivo['meta'] : 1);
                    }
                }
            }

            $objetivos_calificaciones_autoevaluacion = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                return $q->with('metrica');
            }])->where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluado->id)
                ->get();

            $evaluadores_objetivos->push([
                'id' => $evaluado->id, 'nombre' => $evaluado->name,
                'esSupervisor' => false,
                'esAutoevaluacion' => true,
                'objetivos' => $objetivos_calificaciones_autoevaluacion->map(function ($objetivo) {
                    return [
                        'nombre' => $objetivo->objetivo->nombre,
                        'KPI' => $objetivo->objetivo->KPI,
                        'meta' => $objetivo->objetivo->meta,
                        'descripcion_meta' => $objetivo->objetivo->descripcion_meta,
                        'metrica' => $objetivo->objetivo->metrica->definicion,
                        'meta_alcanzada' => $objetivo->meta_alcanzada,
                        'calificacion' => $objetivo->calificacion,
                    ];
                }),
            ]);

            if ($this->empleadoTieneObjetivosAsignados($evaluado->id, $evaluacion->id)) {
                $promedio_objetivos += (($calificacion_objetivos * 100) / 2) / 100;
                $promedio_general_objetivos += $promedio_objetivos * $evaluacion->peso_general_objetivos;
                $promedio_objetivos = floatval(number_format($promedio_objetivos, 2));
                $promedio_general_objetivos = floatval(number_format($promedio_general_objetivos, 2));
                $calificacion_final += $promedio_general_objetivos;
            } else {
                $promedio_objetivos = 1;
                $promedio_general_objetivos = 100 * ($evaluacion->peso_general_objetivos / 100);
                $calificacion_final += $evaluacion->peso_general_objetivos;
            }
        }

        return [
            'peso_general_competencias' => $evaluacion->peso_general_competencias,
            'peso_general_objetivos' => $evaluacion->peso_general_objetivos,
            'lista_autoevaluacion' => $lista_autoevaluacion,
            'lista_jefe_inmediato' => $lista_jefe_inmediato,
            'lista_equipo_a_cargo' => $lista_equipo_a_cargo,
            'lista_misma_area' => $lista_misma_area,
            'promedio_competencias' => number_format(($promedio_competencias / 100) / $cantidad_competencias_evaluadas, 2),
            'promedio_general_competencias' => number_format($promedio_general_competencias, 2),
            'evaluadores_objetivos' => $evaluadores_objetivos,
            'promedio_objetivos' => $promedio_objetivos,
            'promedio_general_objetivos' => $promedio_general_objetivos,
            'calificacion_final' => $calificacion_final,
            'evaluadores' => Empleado::getAll()->find($evaluadores->pluck('evaluador_id')),
        ];
    }

    public function obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias, $evaluacion)
    {
        $esSupervisor = intval($evaluador->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
        $competencias = $this->obtenerCompetenciasDelPuestoDelEvaluadoEnLaEvaluacion($evaluacion->id, $evaluado->id);

        return [
            'id' => $evaluador_empleado->id, 'nombre' => $evaluador_empleado->name,
            'esSupervisor' => $esSupervisor,
            'esAutoevaluacion' => $evaluado->id == $evaluador->evaluador_id ? true : false,
            'tipo' => $evaluador->tipo_formateado,
            'competencias' => $evaluaciones_competencias->map(function ($competencia) use ($evaluador, $competencias) {
                $nivel_esperado = $competencias->filter(function ($compe) use ($competencia) {
                    return $compe->competencia_id == $competencia->competencia_id;
                })->first()->nivel_esperado;

                $porcentaje = 0;
                if ($competencia->calificacion > 0) {
                    $porcentaje = number_format((($competencia->calificacion) / $nivel_esperado), 2);
                }

                return [
                    'id_competencia' => $competencia->competencia->id,
                    'competencia' => $competencia->competencia ? $competencia->competencia->nombre : 'Sin Nombre',
                    'tipo_competencia' => $competencia->competencia ? $competencia->competencia->tipo_competencia : 'Sin Tipo',
                    'calificacion' => $competencia->calificacion,
                    'porcentaje' => $porcentaje,
                    'evaluado' => $evaluador->evaluado,
                    'peso' => $evaluador->peso,
                    'meta' => $nivel_esperado,
                    'firma_evaluador' => $evaluador->firma_evaluador,
                    'firma_evaluado' => $evaluador->firma_evaluado,
                ];
            }),
        ];
    }

    public function resumen($evaluacion)
    {
        abort_if(Gate::denies('seguimiento_evaluaciones_grafica'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $evaluacion = Evaluacion::with('evaluados', 'rangos')->find(intval($evaluacion));

        if (optional($evaluacion->rangos)->isNotEmpty()) {
            $evaluados = $evaluacion->evaluados;
            $lista_evaluados = collect();
            $calificaciones = collect();
            $inaceptable = 0;
            $minimo_aceptable = 0;
            $aceptable = 0;
            $sobresaliente = 0;
            $rangosResultados = optional($evaluacion->rangos)->pluck('valor', 'parametro')->all();
            $rangosColores = optional($evaluacion->rangos)->pluck('color', 'parametro')->all();
            // dd($rangosResultados, $rangosColores);
            $maxValue = max(array_map('intval', $rangosResultados));

            $ev360ResumenTabla = new Ev360ResumenTabla();
            foreach ($evaluados as $evaluado) {
                $evaluado->load('area', 'supervisorEv360');
                $lista_evaluados->push([
                    'evaluado' => $evaluado->name,
                    'puesto' => $evaluado->puesto,
                    'area' => $evaluado->area->area,
                    'informacion_evaluacion' => $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $evaluado->id),
                ]);
            }

            foreach ($lista_evaluados as $evaluado) {
                $calificacionFinal = $evaluado['informacion_evaluacion']['calificacion_final'];
                foreach ($rangosResultados as $parametro => $valor) {
                    // dd($calificacionFinal, $valor);
                    if ($calificacionFinal <= $valor) {
                        $counts[$parametro] = isset($counts[$parametro]) ? $counts[$parametro] + 1 : 1;
                    } elseif ($valor == $maxValue && $calificacionFinal > $valor) {
                        // dd('entra elseif');
                        $counts[$parametro] = isset($counts[$parametro]) ? $counts[$parametro] + 1 : 1;
                    }
                }
            }
            $calificaciones->push($counts);
            $calificaciones = $calificaciones->first();
            // dd($calificaciones);
            return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.resumen-parametros', compact('evaluacion', 'calificaciones', 'rangosResultados', 'rangosColores'));
        } else {
            $evaluados = $evaluacion->evaluados;
            $lista_evaluados = collect();
            $calificaciones = collect();
            $inaceptable = 0;
            $minimo_aceptable = 0;
            $aceptable = 0;
            $sobresaliente = 0;
            $rangosResultados = RangosResultado::select('inaceptable', 'minimo_aceptable', 'aceptable', 'sobresaliente')->where('evaluacion_id', $evaluacion->id)->count();
            if ($rangosResultados > 0) {
                $rangosResultados = RangosResultado::select('inaceptable', 'minimo_aceptable', 'aceptable', 'sobresaliente')->where('evaluacion_id', $evaluacion->id)->first();
            } else {
                $rangosResultados = collect();
                $rangosResultados->put('inaceptable', 60);
                $rangosResultados->put('minimo_aceptable', 80);
                $rangosResultados->put('aceptable', 100);
                $rangosResultados->put('sobresaliente', 100);
            }
            $ev360ResumenTabla = new Ev360ResumenTabla();
            foreach ($evaluados as $evaluado) {
                $evaluado->load('area', 'supervisorEv360');
                $lista_evaluados->push([
                    'evaluado' => $evaluado->name,
                    'puesto' => $evaluado->puesto,
                    'area' => $evaluado->area->area,
                    'informacion_evaluacion' => $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $evaluado->id),
                ]);
            }

            foreach ($lista_evaluados as $evaluado) {
                // dump($evaluado['informacion_evaluacion']['calificacion_final']);
                if ($evaluado['informacion_evaluacion']['calificacion_final'] <= $rangosResultados['inaceptable']) {
                    $inaceptable++;
                } elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= $rangosResultados['minimo_aceptable']) {
                    $minimo_aceptable++;
                } elseif ($evaluado['informacion_evaluacion']['calificacion_final'] <= $rangosResultados['aceptable']) {
                    $aceptable++;
                } elseif ($evaluado['informacion_evaluacion']['calificacion_final'] > $rangosResultados['sobresaliente']) {
                    $sobresaliente++;
                }
            }
            $calificaciones->push([
                'Inaceptable' => $inaceptable,
                'Mínimo Aceptable' => $minimo_aceptable,
                'Aceptable' => $aceptable,
                'Sobresaliente' => $sobresaliente,
            ]);
            $calificaciones = $calificaciones->first();
            return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.resumen', compact('evaluacion', 'calificaciones', 'rangosResultados'));
        }
    }

    public function resumenJefe($evaluacion)
    {
        $evaluacion = Evaluacion::with('evaluados')->find(intval($evaluacion));
        $evaluados = $evaluacion->evaluados;

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.resumen', compact('calificaciones', 'evaluacion'));
    }

    public function evaluacionesDelEmpleado($empleado)
    {
        $empleado = Empleado::getAll()->find($empleado);
        $evaluacione = Evaluacion::whereHas('evaluados', function ($q) use ($empleado) {
            $q->where('evaluado_id', $empleado->id);
        })->get();
        $lista_evaluaciones = collect();
        $ev360ResumenTabla = new Ev360ResumenTabla();
        foreach ($evaluacione as $evaluacion) {
            $lista_evaluaciones->push([
                'id' => $evaluacion->id,
                'nombre' => $evaluacion->nombre,
                'fecha_inicio' => Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y'),
                'fecha_fin' => Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y'),
                'informacion_evaluacion' => $ev360ResumenTabla->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $empleado->id),
            ]);
        }

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.lista-evaluaciones-por-empleado', compact('lista_evaluaciones', 'empleado'));
    }

    public function enviarCorreoAEvaluadores(Evaluacion $evaluacion)
    {
        $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->pluck('evaluador_id')->unique()->toArray();
        foreach ($evaluadores as $evaluador) {
            $evaluados = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
                ->where('evaluador_id', $evaluador)
                ->where('evaluado', false)
                ->pluck('evaluado_id')
                ->unique()
                ->toArray();
            $empleados = Empleado::getAll();
            $evaluados = $empleados->find($evaluados);
            $evaluador_model = $empleados->find($evaluador);
            if (count($evaluados)) {
                $this->enviarNotificacionAlEvaluador($evaluador_model->email, $evaluacion, $evaluador_model, $evaluados);
                if (env('APP_ENV') == 'local') { // solo funciona en desarrollo, es una muy mala práctica, es para que funcione con mailtrap y la limitación del plan gratuito
                    if (env('MAIL_HOST') == 'smtp.mailtrap.io') {
                        sleep(4); //use usleep(500000) for half a second or less
                    }
                }
            }
        }

        return response()->json(['success' => true]);
    }

    public function enviarNotificacionAlEvaluador($email, $evaluacion, $evaluador, $evaluados)
    {
        Mail::to(removeUnicodeCharacters($email))->queue(new RecordatorioEvaluadores($evaluacion, $evaluador, $evaluados));
    }

    public function enviarInvitacionDeEvaluacion(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'descripcion' => 'nullable|string',
        ]);
        $evaluacion = Evaluacion::find(intval($request->evaluacion));
        $empleados = Empleado::getAll();
        $evaluado = $empleados->find(intval($request->evaluado));
        $evaluador = $empleados->find(intval($request->evaluador));
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $nombre = $request->nombre;
        $descripcion = $request->descripcion ? $request->descripcion : 'Sin descripción';
        $from = DateTime::createFromFormat('Y-m-d H:i', Carbon::parse($fecha_inicio)->format('Y-m-d H:i'));
        $to = DateTime::createFromFormat('Y-m-d H:i', Carbon::parse($fecha_fin)->format('Y-m-d H:i'));
        $link = Link::create($nombre, $from, $to)
            ->description($descripcion);
        $link_outlook = $link->google();

        $this->enviarCorreoInvitacionAlEvaluado($evaluador->email, $evaluacion, $evaluador, $evaluado, $link_outlook);

        return response()->json(['success' => true]);
    }

    public function enviarCorreoInvitacionAlEvaluado($email, $evaluacion, $evaluador, $evaluado, $enlace)
    {
        Mail::to(removeUnicodeCharacters($email))->queue(new CitaEvaluadorEvaluado($evaluacion, $evaluador, $evaluado, $enlace));
    }

    public function obtenerCompetenciasEvaluadasEnLaEvaluacion($evaluacion)
    {
        $competencias = EvaluacionRepuesta::where('evaluacion_id', $evaluacion)->pluck('competencia_id')->unique()->toArray();

        return $competencias;
    }

    public function empleadoTieneCompetenciasAsignadas($empleado, $evaluacion)
    {
        $existsObjetivos = EvaluacionRepuesta::where('evaluado_id', $empleado)->where('evaluacion_id', $evaluacion)->exists();
        if ($existsObjetivos) {
            return true;
        }

        return false;
    }

    public function empleadoTieneObjetivosAsignados($empleado, $evaluacion)
    {
        $existsObjetivos = ObjetivoRespuesta::where('evaluado_id', $empleado)->where('evaluacion_id', $evaluacion)->exists();
        if ($existsObjetivos) {
            return true;
        }

        return false;
    }

    public function misEvaluaciones($evaluacion, $evaluado)
    {
        $evaluacion = Evaluacion::select('id', 'nombre')->find(intval($evaluacion));
        $evaluado = Empleado::select('id', 'name')->find(intval($evaluado));
        $equipo = false;

        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.mis-evaluaciones', compact('evaluacion', 'evaluado', 'equipo'));
    }

    public function evaluacionesDeMiEquipo($evaluacion, $evaluador)
    {
        $evaluacion = Evaluacion::select('id', 'nombre')->find(intval($evaluacion));
        $evaluador = Empleado::select('id', 'name')->with('children')->find(intval($evaluador));
        $evaluado = $this->obtenerEquipoACargo($evaluador->children);
        $evaluado = $evaluador->children->first();
        $equipo = true;

        // dd($informacion_obtenida);
        return view('admin.recursos-humanos.evaluacion-360.evaluaciones.consultas.mis-evaluaciones', compact('evaluacion', 'evaluador', 'equipo', 'evaluado'));
    }

    public function normalizarResultados(Request $request, $evaluacion)
    {
        $normalizar = RangosResultado::where('evaluacion_id', $evaluacion)->exists();
        if ($normalizar) {
            $rangosResultados = RangosResultado::where('evaluacion_id', $evaluacion)->first();
            $rangosResultados->update([
                'inaceptable' => $request->inaceptable,
                'minimo_aceptable' => $request->minimoAceptable,
                'aceptable' => $request->aceptable,
                'sobresaliente' => $request->sobresaliente,
            ]);
        } else {
            RangosResultado::create([
                'evaluacion_id' => $evaluacion,
                'inaceptable' => $request->inaceptable,
                'minimo_aceptable' => $request->minimoAceptable,
                'aceptable' => $request->aceptable,
                'sobresaliente' => $request->sobresaliente,
            ]);
        }

        return redirect()->back();
    }

    public function destroy($evaluacion)
    {
        abort_if(Gate::denies('seguimiento_evaluaciones_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $evaluacion = Evaluacion::find($evaluacion);
        $evaluacion->delete();

        return response()->json(['deleted' => true]);
    }

    public function objetivostemporal()
    {
        $reacLA = EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', '140')->where('evaluador_id', '=', '132')
            ->where('tipo', '=', '1')->first();
        $reacLA->update([
            'firma_evaluado' => null,
            'firma_evaluador' => null,
            'tipo' => '2',
            'evaluado' => 'false',
        ]);

        $reacAL = EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', '140')->where('evaluador_id', '=', '193')
            ->where('tipo', '=', '2')->first();
        $reacAL->update([
            'firma_evaluado' => null,
            'firma_evaluador' => null,
            'tipo' => '1',
            'evaluado' => 'false',
        ]);

        $cambioLA = ObjetivoRespuesta::where('evaluado_id', '=', 140)->where('evaluacion_id', '=', '24')->where('evaluador_id', '=', '132');
        $cambioLA->update([
            'evaluador_id' => '193',
            'evaluado' => 'false',
        ]);

        //Cambio de fecha
        // $fecha=Evaluacion::find('24');
        // $fecha->update([
        //     'fecha_fin' => '2023-04-15'
        // ]);

        //Borra registros sobrantes que no fueron borrados correctamente de 2 tablas relacionadas,
        //se tuvieron que buscar los registros especificos al no haber relacion directa
        //     $borrarrut1=ObjetivoRespuesta::where('objetivo_id', '1077')->where('evaluador_id', '=', '150')->where('evaluacion_id','=', '24')->first();
        //     $borrarrut2=ObjetivoRespuesta::where('objetivo_id', '1077')->where('evaluador_id', '=', '326')->where('evaluacion_id','=', '24')->first();
        //     $borrarrut3=ObjetivoRespuesta::where('objetivo_id', '1087')->where('evaluador_id', '=', '150')->where('evaluacion_id','=', '24')->first();
        //     $borrarrut4=ObjetivoRespuesta::where('objetivo_id', '1087')->where('evaluador_id', '=', '326')->where('evaluacion_id','=', '24')->first();
        //     $borrarrut5=ObjetivoRespuesta::where('objetivo_id', '1081')->where('evaluador_id', '=', '150')->where('evaluacion_id','=', '24')->first();
        //     $borrarrut6=ObjetivoRespuesta::where('objetivo_id', '1081')->where('evaluador_id', '=', '326')->where('evaluacion_id','=', '24')->first();

        //     $borrarrut1->delete();
        //     $borrarrut2->delete();
        //     $borrarrut3->delete();
        //     $borrarrut4->delete();
        //     $borrarrut5->delete();
        //     $borrarrut6->delete();

        // $borrarG=ObjetivoRespuesta::where('evaluado_id', '=', '254')->where('evaluador_id', '=', '254')->where('evaluacion_id','=', '24');
        // $borrarGJ=ObjetivoRespuesta::where('evaluado_id', '=', '254')->where('evaluador_id', '=', '150')->where('evaluacion_id','=', '24');

        // $borrarG->delete();
        // $borrarGJ->delete();

        // $borradoEvaEvaluados = EvaluacionesEvaluados::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', '242')->where('puesto_id', '=', '156')->get();
        // $borradoEvaEvaluados->each->delete();

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //PUESTO ID 176

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '2',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '3',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '3',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '2',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '4',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '3',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '5',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '2',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '6',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '2',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '7',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '2',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '8',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '2',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '15',
        //     'puesto_id' => '176',
        //     'nivel_esperado' => '3',
        // ]);

        //Puesto id 175

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '2',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '3',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '4',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '5',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '6',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '7',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '8',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '1',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '17',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '2',
        // ]);

        // CompetenciaPuesto::firstOrCreate([
        //     'competencia_id' => '18',
        //     'puesto_id' => '175',
        //     'nivel_esperado' => '2',
        // ]);

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        // EvaluacionesEvaluados::firstOrCreate([
        //     'evaluacion_id' => '24',
        //     'evaluado_id' => '242',
        //     'puesto_id' => '156',
        // ]);

        // $borradoEvaluEvaluador = EvaluadoEvaluador::where('evaluado_id', '=', '242')
        // ->where('evaluacion_id', '=', '24')
        // ->where('peso', '=', '25')
        // ->get();
        // $borradoEvaluEvaluador->each->delete();

        // EvaluadoEvaluador::firstOrCreate([
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        //     'peso' => '25',
        //     'tipo' => '0',
        // ]);

        // EvaluadoEvaluador::firstOrCreate([
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        //     'peso' => '25',
        //     'tipo' => '1',
        // ]);

        // EvaluadoEvaluador::firstOrCreate([
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        //     'peso' => '25',
        //     'tipo' => '2',
        // ]);

        // EvaluadoEvaluador::firstOrCreate([
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        //     'peso' => '25',
        //     'tipo' => '3',
        // ]);

        // //Autoevaluacion

        // $borrarCompetencias = EvaluacionRepuesta::where('evaluado_id', '=', '242')
        // ->where('evaluacion_id', '=', '24')->get();
        // $borrarCompetencias->each->delete();

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '5',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '2',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '3',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '6',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '4',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '7',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '8',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '22',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '21',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // // //Evaluacion Gustavo

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '5',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '2',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '3',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '6',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '4',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '7',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '8',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '22',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '21',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // // //Evaluacion Gabriela Peralta Diaz

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '5',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '2',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '3',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '6',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '4',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '7',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '8',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '22',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '21',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '135',
        //     'evaluacion_id' => '24',
        // ]);

        // // //Gerardo Cruz

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '5',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '2',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '3',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '6',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '4',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '7',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '8',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '22',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // EvaluacionRepuesta::firstOrCreate([
        //     'calificacion' => 0,
        //     'descripcion' => null,
        //     'competencia_id' => '21',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '240',
        //     'evaluacion_id' => '24',
        // ]);

        // $borrarObjetivos = ObjetivoRespuesta::where('evaluado_id', '=', '242')
        // ->where('evaluacion_id', '=', '24')->get();
        // $borrarObjetivos->each->delete();

        // dd($borrarCompetencias);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '755',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '755',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '756',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '756',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '757',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '757',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '758',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '758',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '759',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '759',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '760',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '760',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '761',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '242',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::firstOrCreate([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '761',
        //     'evaluado_id' => '242',
        //     'evaluador_id' => '164',
        //     'evaluacion_id' => '24',
        // ]);

        // $reacLD=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 242)->where('evaluador_id', '=', 242);
        // $reacLD->update([
        //     'evaluado' => 'false',
        // ]);

        // $reacLDG=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 242)->where('evaluador_id', '=', 164);
        // $reacLDG->update([
        //     'evaluado' => 'false',
        // ]);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1169',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '254',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1170',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '254',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1171',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '254',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1173',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '254',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1175',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '254',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1169',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '150',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1170',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '150',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1171',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '150',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1173',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '150',
        //     'evaluacion_id' => '24',
        // ]);

        // ObjetivoRespuesta::create([
        //     'meta_alcanzada' => 'Sin evaluar',
        //     'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //     'calificacion' => 0,
        //     'objetivo_id' => '1175',
        //     'evaluado_id' => '254',
        //     'evaluador_id' => '150',
        //     'evaluacion_id' => '24',
        // ]);

        // $cambioEr = EvaluadoEvaluador::where('evaluado_id', '=', 134)->where('evaluacion_id', '=', 24)
        // ->where('evaluador_id', '=', 158)->where('tipo', '=', 2);
        // $cambioEr->update([
        //     'evaluador_id' => '132',
        //     'firma_evaluador' => null,
        //     'evaluado' => false,
        // ]);

        // $cambioCEr1 = EvaluacionRepuesta::where('id', '=', '6920');
        // $cambioCEr1->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr2 = EvaluacionRepuesta::where('id', '=', '6921');
        // $cambioCEr2->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr3 = EvaluacionRepuesta::where('id', '=', '6922');
        // $cambioCEr3->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr4 = EvaluacionRepuesta::where('id', '=', '6923');
        // $cambioCEr4->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr5 = EvaluacionRepuesta::where('id', '=', '6924');
        // $cambioCEr5->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr6 = EvaluacionRepuesta::where('id', '=', '6925');
        // $cambioCEr6->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr7 = EvaluacionRepuesta::where('id', '=', '6926');
        // $cambioCEr7->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr8 = EvaluacionRepuesta::where('id', '=', '6927');
        // $cambioCEr8->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr9 = EvaluacionRepuesta::where('id', '=', '6928');
        // $cambioCEr9->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr10 = EvaluacionRepuesta::where('id', '=', '6929');
        // $cambioCEr10->update([
        //     'evaluador_id' => '132',
        // ]);
        // $cambioCEr11 = EvaluacionRepuesta::where('id', '=', '6930');
        // $cambioCEr11->update([
        //     'evaluador_id' => '132',
        // ]);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        // $cambioA = EvaluadoEvaluador::where('evaluado_id', '=', 140)->where('evaluacion_id', '=', 24)
        // ->where('evaluador_id', '=', 132)->first();
        // $cambioA->update([
        //     'tipo' => '1',
        // ]);

        // $cambioM = EvaluadoEvaluador::where('evaluado_id', '=', 140)->where('evaluacion_id', '=', 24)
        // ->where('evaluador_id', '=', 193)->first();
        // $cambioM->update([
        //     'tipo' => '2',
        // ]);

        // $cambioMO = ObjetivoRespuesta::where('evaluado_id', '=', 140)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 193);
        // $cambioMO->update([
        //     'evaluador_id' => '132',
        // ]);

        // $cambioE = EvaluadoEvaluador::where('evaluado_id', '=', 134)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 132)->first();
        // $cambioE->update([
        //     'evaluador_id' => '158',
        // ]);

        // $cambioEC = EvaluacionRepuesta::where('evaluado_id', '=', 134)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 132);
        // $cambioEC->update([
        //     'evaluador_id' => '158',
        // ]);

        // $cambioEO = ObjetivoRespuesta::where('evaluado_id', '=', 134)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 132);
        // $cambioEO->update([
        //     'evaluador_id' => '158',
        // ]);

        // $cambioGA = EvaluadoEvaluador::where('evaluado_id', '=', 135)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 346)->first();
        // $cambioGA->update([
        //     'evaluador_id' => '132',
        // ]);

        // $cambioGAC = EvaluacionRepuesta::where('evaluado_id', '=', 135)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 346);
        // $cambioGAC->update([
        //     'evaluador_id' => '132',
        // ]);

        // $cambioGAO = ObjetivoRespuesta::where('evaluado_id', '=', 135)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 346);
        // $cambioGAO->update([
        //     'evaluador_id' => '132',
        // ]);

        // $cambioGU = EvaluadoEvaluador::where('evaluado_id', '=', 164)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 346)->first();
        // $cambioGU->update([
        //     'evaluador_id' => '132',
        // ]);

        // $cambioGUC = EvaluacionRepuesta::where('evaluado_id', '=', 164)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 346);
        // $cambioGUC->update([
        //     'evaluador_id' => '132',
        // ]);

        // $cambioGUO = ObjetivoRespuesta::where('evaluado_id', '=', 164)->where('evaluacion_id', '=', 24)->where('evaluador_id', '=', 346);
        // $cambioGUO->update([
        //     'evaluador_id' => '132',
        // ]);

        //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        //Funcion para reactivar evaluaciones 360,
        // a algunos usuarios se les agregaron sus objetivos tras finalizar su evaluacion360,
        //por lo que hubo la necesidad de reactivar la evaluacion
        //Se busca al evaluado y al evaluador en la evaluacion actual (24) y se rectivan al cambiar el estatus
        // de true a false para que puedan volver a contestar

        // $reacGG=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 254)->where('evaluador_id', '=', 254);
        // $reacGG->update([
        //     'evaluado' => 'false',
        // ]);

        //CESAR 152
        // $reacCC=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 152)->where('evaluador_id', '=', 152);
        //      $reacCC->update([
        //          'evaluado' => 'false',
        //      ]);

        //REACTIVAR A LAURA(305) y MARCO (138)

        //     $reacLL=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 305)->where('evaluador_id', '=', 305);
        //     $reacLL->update([
        //         'evaluado' => 'false',
        //     ]);
        //     $reacLM=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 305)->where('evaluador_id', '=', 138);
        //     $reacLM->update([
        //         'evaluado' => 'false',
        //     ]);
        // //REACTIVAR A OMAR(290) Y A NERI(259)
        // $reacOO=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 290)->where('evaluador_id', '=', 290);
        //     $reacOO->update([
        //         'evaluado' => 'false',
        //     ]);
        //     $reacON=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 290)->where('evaluador_id', '=', 259);
        //     $reacON->update([
        //         'evaluado' => 'false',
        //     ]);
        // //Rodrigo B (268) REACTIVAR A NERI(259)
        // $reacRR=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 268)->where('evaluador_id', '=', 268);
        // $reacRR->update([
        //     'evaluado' => 'false',
        // ]);
        // $reacRN=EvaluadoEvaluador::where('evaluacion_id', '=', '24')->where('evaluado_id', '=', 268)->where('evaluador_id', '=', 259);
        // $reacRN->update([
        //     'evaluado' => 'false',
        // ]);

        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        //Funcion para agregar los objetivos pendientes, esta funcion toma todos los objetivos de la tabla
        // ev_360_objetivos_empleados que no se agregaron a la tabla ev360_objetivos_respuestas
        //por estar en estado "Pendiente" y los agrega a dicha tabla cambiando su
        //estatus a aprobado en el proceso

        //     $objetivo=Objetivo::where('esta_aprobado', '=', '0')->where('created_at', '>=', '2023-03-06')->get();
        //     // dd($objetivo);

        //     foreach($objetivo as $obj)
        //     {
        //         $evaluado=ObjetivoEmpleado::where('objetivo_id','=',$obj->id)->get();
        //         // dd($evaluado);
        //         foreach($evaluado as $eva)
        //         {
        //             $evaluacion=EvaluacionesEvaluados::where('evaluado_id','=', $eva->empleado_id)->get();
        //             // dd($evaluacion);
        //             foreach($evaluacion as $evalu)
        //             {
        //                 $evaluador=EvaluadoEvaluador::where('evaluado_id', '=', $evalu->evaluado_id)->where('evaluacion_id','=',$evalu->evaluacion_id)->whereIn('tipo',['0','1'])->get();

        //                 foreach($evaluador as $evldr){
        //                     ObjetivoRespuesta::create([
        //                         'meta_alcanzada' => 'Sin evaluar',
        //                         'calificacion_persepcion' => ObjetivoRespuesta::INACEPTABLE,
        //                         'calificacion' => 0,
        //                         'objetivo_id' => $obj->id,
        //                         'evaluado_id' => $eva->empleado_id,
        //                         'evaluador_id' => $evldr->evaluador_id,
        //                         'evaluacion_id' => $evalu->evaluacion_id,
        //                     ]);
        //                     // dd($obj->id,$eva->empleado_id,$evalu->evaluacion_id,$evldr->evaluador_id);
        //                     $obj->update([
        //                         'esta_aprobado'=>1,
        //                     ]);
        //                 }
        //             }
        //         }
        //     }
    }
}

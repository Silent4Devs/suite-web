<?php

namespace App\Http\Controllers\Frontend\RH;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\RH\Competencia;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionCompetencia;
use App\Models\RH\EvaluacionObjetivo;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\Objetivo;
use App\Models\RH\ObjetivoRespuesta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EV360EvaluacionesController extends Controller
{
    public function index(Request $request)
    {
        $areas = Area::all();
        $empleados = Empleado::all();

        if ($request->ajax()) {
            $evaluaciones = Evaluacion::getAll();

            return datatables()->of($evaluaciones)->toJson();
        }

        return view('frontend.recursos-humanos.evaluacion-360.evaluaciones.index', compact('areas', 'empleados'));
    }

    public function create()
    {
        $evaluacion = new Evaluacion;
        $areas = Area::all();
        $empleados = Empleado::all();

        return view('frontend.recursos-humanos.evaluacion-360.evaluaciones.create', compact('evaluacion', 'areas', 'empleados'));
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
        $evaluado = Empleado::with(['puestoRelacionado' => function ($q) {
            $q->with(['competencias' => function ($q) {
                $q->with('competencia');
            }]);
        }, 'objetivos'])->find(intval($evaluado));

        $evaluador = Empleado::find(intval($evaluador));
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
            $total_preguntas = $preguntas_sql->count();
            $preguntas_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluador->id)
                ->where('calificacion', '>', 0)->count();
            $preguntas_no_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion->id)
                ->where('evaluado_id', $evaluado->id)
                ->where('evaluador_id', $evaluador->id)
                ->where('calificacion', '=', 0)->count();
            if ($total_preguntas) {
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
                ->get();
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

        $esta_evaluado = EvaluadoEvaluador::where('evaluado_id', $evaluado->id)
            ->where('evaluador_id', $evaluador->id)
            ->where('evaluacion_id', $evaluacion->id)->first()->evaluado;

        $finalizo_tiempo = false;
        if (Carbon::parse($evaluacion->fecha_fin)->diffInDays(Carbon::now()) == 0) {
            $finalizo_tiempo = true;
        }

        $competencias_por_puesto_nivel_esperado = $evaluado->puestoRelacionado->competencias;
        $competencias_evaluadas_en_esta_evaluacion = $preguntas->pluck('competencia_id')->toArray();
        $competencias_por_puesto_nivel_esperado = $competencias_por_puesto_nivel_esperado->map(function ($competencia) use ($competencias_evaluadas_en_esta_evaluacion) {
            if (in_array($competencia->competencia->id, $competencias_evaluadas_en_esta_evaluacion)) {
                return $competencia;
            }
        }); //Filtro para obtener solo las competencias evaluadas al momento de la creación de la evaluacion

        return view('frontend.recursos-humanos.evaluacion-360.evaluaciones.cuestionario', compact('evaluacion', 'preguntas', 'evaluado', 'evaluador', 'total_preguntas', 'preguntas_contestadas', 'preguntas_no_contestadas', 'progreso', 'finalizo_tiempo', 'objetivos', 'progreso_objetivos', 'objetivos_evaluados', 'objetivos_no_evaluados', 'esta_evaluado', 'competencias_por_puesto_nivel_esperado'));
    }

    public function evaluacion(Evaluacion $evaluacion)
    {
        $evaluacion->load('autor');
        $competencias = Competencia::select('id', 'nombre')->get();
        $objetivos = Objetivo::select('id', 'nombre')->get();
        $competencias_seleccionadas = EvaluacionCompetencia::where('evaluacion_id', $evaluacion->id)->pluck('competencia_id')->toArray();
        $objetivos_seleccionados = EvaluacionObjetivo::where('evaluacion_id', $evaluacion->id)->pluck('objetivo_id')->toArray();
        $competencias_seleccionadas_text = EvaluacionCompetencia::with(['competencia' => function ($q) {
            $q->with(['tipo']);
        }])->where('evaluacion_id', $evaluacion->id)->get();
        $objetivos_seleccionados_text = EvaluacionObjetivo::with(['objetivo' => function ($q) {
            $q->with(['tipo', 'metrica']);
        }])->where('evaluacion_id', $evaluacion->id)->get();
        $total_evaluaciones = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->count();
        $contestadas = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)->where('evaluado', true)->count();
        $progreso = floatval(number_format((($contestadas / $total_evaluaciones) * 100), 2));

        return view('frontend.recursos-humanos.evaluacion-360.evaluaciones.evaluacion', compact('evaluacion', 'competencias', 'competencias_seleccionadas', 'competencias_seleccionadas_text', 'total_evaluaciones', 'contestadas', 'progreso', 'objetivos', 'objetivos_seleccionados', 'objetivos_seleccionados_text'));
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
                    array_push($lista_evaluados, [[
                        'id' => $evaluado->id,
                        'name' => $evaluado->name,
                        'area' => $evaluado->area->area,
                        'evaluadores' => $evaluadores,
                        'total_evaluaciones' => $total_evaluaciones,
                        'contestadas' => $contestadas,
                        'progreso' => $progreso,
                        'evaluacion' => intval($evaluacion),
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
        $total_preguntas = $preguntas_sql->count();
        $preguntas_contestadas = EvaluacionRepuesta::where('evaluacion_id', $evaluacion)
            ->where('evaluado_id', $evaluado)
            ->where('evaluador_id', $evaluador)
            ->where('calificacion', '>', 0)->count();
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
        $informacion_obtenida = $this->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion, $evaluado);
        $lista_autoevaluacion = $informacion_obtenida['lista_autoevaluacion'];
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

        // dd($evaluadores_objetivos);
        return view('frontend.recursos-humanos.evaluacion-360.evaluaciones.consultas.evaluado', compact('evaluacion', 'evaluado', 'lista_autoevaluacion', 'lista_jefe_inmediato', 'lista_equipo_a_cargo', 'lista_misma_area', 'promedio_competencias', 'promedio_general_competencias', 'evaluadores_objetivos', 'promedio_objetivos', 'promedio_general_objetivos', 'calificacion_final'));
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
        $evalaciones_lista = collect();
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
            $cantidad_competencias_evaluadas = $evaluado->puestoRelacionado->competencias->count() > 0 ? $evaluado->puestoRelacionado->competencias->count() : 1;
            $lista_autoevaluacion->push(array(
                'tipo' => 'Autoevaluación',
                'peso_general' => $evaluacion->peso_autoevaluacion,
                'evaluaciones' => $filtro_autoevaluacion->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_autoevaluacion->first()['evaluaciones'])) {
                foreach ($lista_autoevaluacion->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
            } else {
                $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
            }

            $lista_jefe_inmediato->push([
                'tipo' => 'Jefe Inmediato',
                'peso_general' => $evaluacion->peso_jefe_inmediato,
                'evaluaciones' => $filtro_jefe_inmediato->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_jefe_inmediato->first()['evaluaciones'])) {
                foreach ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100);
            } else {
                $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100);
            }

            $lista_equipo_a_cargo->push([
                'tipo' => 'Equipo a cargo',
                'peso_general' => $evaluacion->peso_equipo,
                'evaluaciones' => $filtro_equipo_a_cargo->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_equipo_a_cargo->first()['evaluaciones'])) {
                foreach ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100);
            } else {
                $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100);
            }

            $lista_misma_area->push([
                'tipo' => 'Misma área',
                'peso_general' => $evaluacion->peso_area,
                'evaluaciones' => $filtro_misma_area->map(function ($evaluador) use ($evaluacion, $evaluado) {
                    $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
                        ->where('evaluado_id', $evaluado->id)
                        ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
                    $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

                    return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
                }),
            ]);

            $calificacion = 0;
            if (count($lista_misma_area->first()['evaluaciones'])) {
                foreach ($lista_misma_area->first()['evaluaciones'] as $evaluacion_b) {
                    foreach ($evaluacion_b['competencias'] as $competencia) {
                        $calificacion += $competencia['porcentaje'];
                    }
                }
                $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100);
            } else {
                $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100);
            }
            // dd($promedio_competencias);
            $promedio_competencias = number_format($promedio_competencias / 100, 2);
            $promedio_general_competencias = $promedio_competencias * $evaluacion->peso_general_competencias;
            $calificacion_final += $promedio_general_competencias;
        } else {
            //Logica para cuando no se evaluan competencias
        }

        $promedio_objetivos = 0;
        $promedio_general_objetivos = 0;
        $evaluadores_objetivos = collect();
        if ($evaluacion->include_objetivos) {
            if ($evaluado->supervisor) {
                $objetivos_calificaciones = ObjetivoRespuesta::with(['objetivo' => function ($q) {
                    return $q->with('metrica');
                }])->where('evaluacion_id', $evaluacion->id)
                    ->where('evaluado_id', $evaluado->id)
                    ->where('evaluador_id', $evaluado->supervisor->id)
                    ->get();
                $evaluadores_objetivos->push([
                    'id' => $evaluado->supervisor->id, 'nombre' => $evaluado->supervisor->name,
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
            if (count($evaluadores_objetivos->first()['objetivos'])) {
                foreach ($evaluadores_objetivos->first()['objetivos'] as $objetivo) {
                    $calificacion_objetivos += $objetivo['calificacion'] / $objetivo['meta'];
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

            $promedio_objetivos += (($calificacion_objetivos * 100) / 2) / 100;
            $promedio_general_objetivos += $promedio_objetivos * $evaluacion->peso_general_objetivos;
            $promedio_objetivos = number_format($promedio_objetivos, 2);
            $promedio_general_objetivos = number_format($promedio_general_objetivos, 2);
            $calificacion_final += $promedio_general_objetivos;
        }
        return [
            'lista_autoevaluacion' => $lista_autoevaluacion,
            'lista_jefe_inmediato' => $lista_jefe_inmediato,
            'lista_equipo_a_cargo' => $lista_equipo_a_cargo,
            'lista_misma_area' => $lista_misma_area,
            'promedio_competencias' => $promedio_competencias,
            'promedio_general_competencias' => $promedio_general_competencias,
            'evaluadores_objetivos' => $evaluadores_objetivos,
            'promedio_objetivos' => $promedio_objetivos,
            'promedio_general_objetivos' => $promedio_general_objetivos,
            'calificacion_final' => $calificacion_final,
            'evaluadores' => Empleado::find($evaluadores->pluck('evaluador_id')),
        ];
    }


    public function obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias)
    {
        return [
            'id' => $evaluador_empleado->id, 'nombre' => $evaluador_empleado->name,
            'esSupervisor' => $evaluado->supervisor ? ($evaluado->supervisor->id == $evaluador->evaluador_id ? true : false) : false,
            'esAutoevaluacion' => $evaluado->id == $evaluador->evaluador_id ? true : false,
            'tipo' => $evaluador->tipo_formateado,
            'competencias' => $evaluaciones_competencias->map(function ($competencia) use ($evaluador, $evaluado) {
                $nivel_esperado = $evaluado->puestoRelacionado->competencias->filter(function ($compe) use ($competencia) {
                    return $compe->competencia_id == $competencia->competencia_id;
                })->first()->nivel_esperado;

                $porcentaje = 0;
                if ($competencia->calificacion > 0) {
                    $porcentaje = number_format((($competencia->calificacion) / $nivel_esperado), 2);
                }

                return [
                    'competencia' => $competencia->competencia->nombre,
                    'tipo_competencia' => $competencia->competencia->tipo_competencia,
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
        $evaluacion = Evaluacion::with('evaluados')->find(intval($evaluacion));
        $evaluados = $evaluacion->evaluados;
        $lista_evaluados = collect();
        $calificaciones = collect();
        $inaceptable = 0;
        $minimo_aceptable = 0;
        $aceptable = 0;
        $sobresaliente = 0;

        foreach ($evaluados as $evaluado) {
            // $evaluado->load('area');
            $lista_evaluados->push(array(
                'evaluado' => $evaluado->name,
                'puesto' => $evaluado->puesto,
                'area' => $evaluado->area->area,
                'informacion_evaluacion' => $this->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $evaluado->id)
            ));
        }

        foreach ($lista_evaluados as $evaluado) {
            if ($evaluado['informacion_evaluacion']['calificacion_final'] <= 60) {
                $inaceptable++;
            } else if ($evaluado['informacion_evaluacion']['calificacion_final'] <= 80) {
                $minimo_aceptable++;
            } else if ($evaluado['informacion_evaluacion']['calificacion_final'] <= 100) {
                $aceptable++;
            } else if ($evaluado['informacion_evaluacion']['calificacion_final'] > 100) {
                $sobresaliente++;
            }
        }
        $calificaciones->push(array(
            'Inaceptable' => $inaceptable,
            'Mínimo Aceptable' => $minimo_aceptable,
            'Aceptable' => $aceptable,
            'Sobresaliente' => $sobresaliente,
        ));
        $calificaciones = $calificaciones->first();

        return view('frontend.recursos-humanos.evaluacion-360.evaluaciones.consultas.resumen', compact('lista_evaluados', 'calificaciones', 'evaluacion'));
    }
}

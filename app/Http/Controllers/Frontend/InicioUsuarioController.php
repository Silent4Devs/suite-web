<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\Area;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Denuncias;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\EvidenciasDenuncia;
use App\Models\EvidenciasQueja;
use App\Models\EvidenciasRiesgo;
use App\Models\EvidenciasSeguridad;
use App\Models\IncidentesSeguridad;
use App\Models\Mejoras;
use App\Models\PlanImplementacion;
use App\Models\Proceso;
use App\Models\Quejas;
use App\Models\Recurso;
use App\Models\RevisionDocumento;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\ObjetivoRespuesta;
use App\Models\RiesgoIdentificado;
use App\Models\Sede;
use App\Models\SubcategoriaIncidente;
use App\Models\Sugerencias;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class InicioUsuarioController extends Controller
{
    public function index()
    {
        //abort_if(Gate::denies('mi_perfil_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = auth()->user();
        $empleado_id = $usuario->empleado ? $usuario->empleado->id : 0;
        $actividades = [];
        $implementaciones = PlanImplementacion::getAll();
        $actividades = collect();
        if ($implementaciones) {
            foreach ($implementaciones as $implementacion) {
                $tasks = $implementacion->tasks;
                foreach ($tasks as $task) {
                    $task->parent_id = $implementacion->id;
                    $task->status = isset($task->status) ? $task->status : 'STATUS_UNDEFINED';
                    $task->end = intval($task->end);
                    $task->start = intval($task->start);
                    $task->canAdd = $task->canAdd == 'true' ? true : false;
                    $task->canWrite = $task->canWrite == 'true' ? true : false;
                    $task->duration = intval($task->duration);
                    $task->progress = intval($task->progress);
                    $task->canDelete = $task->canDelete == 'true' ? true : false;
                    isset($task->level) ? $task->level = intval($task->level) : $task->level = 0;
                    isset($task->collapsed) ? $task->collapsed = $task->collapsed == 'true' ? true : false : $task->collapsed = false;
                    $task->canAddIssue = $task->canAddIssue == 'true' ? true : false;
                    $task->endIsMilestone = $task->endIsMilestone == 'true' ? true : false;
                    $task->startIsMilestone = $task->startIsMilestone == 'true' ? true : false;
                    $task->progressByWorklog = $task->progressByWorklog == 'true' ? true : false;
                }

                $implementacion->tasks = $tasks;
                // if (!isset($implementacion->assigs)) {
                //     $implementacion = (object)array_merge((array)$implementacion, array('assigs' => []));
                // }
                $actividades_collet = collect($implementacion->tasks)->filter(function ($task) use ($empleado_id, $implementacion) {
                    if ($task->level > 1) {
                        if (isset($task->assigs)) {
                            $assigs = $task->assigs;
                            $task->parent = $implementacion->parent;
                            $task->slug = $implementacion->slug;
                            foreach ($assigs as $assig) {
                                if ($assig->resourceId == $empleado_id) {
                                    return $task;
                                }
                            }
                        }
                    }
                });

                $actividades->push($actividades_collet);
            }
        }
        $actividades = $actividades->flatten(1);

        $contador_actividades = 0;

        foreach ($actividades as $actividad) {
            $progreso = $actividad->progress;

            if (intval($progreso) < 100) {
                $contador_actividades++;
            }
        }

        $auditorias_anual = AuditoriaAnual::getAll();
        $auditoria_internas = new AuditoriaInterna;
        $empleado = auth()->user()->empleado;
        $recursos = new Recurso;
        if ($usuario->empleado) {
            $auditoria_internas_participante = AuditoriaInterna::whereHas('equipo', function ($query) use ($empleado) {
                $query->where('auditoria_interno_empleado.empleado_id', $empleado->id);
            })->orWhere('lider_id', auth()->user()->empleado->id)->get();
            $auditoria_internas_lider = AuditoriaInterna::where('lider_id', auth()->user()->empleado->id)->get();
            $auditoria_internas = collect();
            foreach ($auditoria_internas_lider as $auditoria) {
                $auditoria_internas->push($auditoria);
            }
            foreach ($auditoria_internas_participante as $auditoria) {
                $auditoria_internas->push($auditoria);
            }
            $auditoria_internas = $auditoria_internas->unique();
            $recursos = Recurso::whereHas('empleados', function ($query) use ($empleado) {
                $query->where('empleados.id', $empleado->id)->where('archivado', '=', 0);
            })->get();
        }

        $contador_recursos = 0;
        if ($usuario->empleado) {
            $contador_recursos = Recurso::whereHas('empleados', function ($query) use ($empleado) {
                $query->where('empleados.id', $empleado->id);
            })->where('fecha_fin', '>=', Carbon::now()->toDateString())->count();
        }
        $documentos_publicados = Documento::with('macroproceso')->where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(5);
        $revisiones = [];
        $mis_documentos = [];
        $contador_revisiones = 0;
        $evaluaciones = new EvaluadoEvaluador;
        $mis_evaluaciones = new EvaluadoEvaluador;
        if ($usuario->empleado) {
            $revisiones = RevisionDocumento::with('documento')->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO)->get();

            $contador_revisiones = RevisionDocumento::with('documento')->where('empleado_id', $usuario->empleado->id)->where('archivado', RevisionDocumento::NO_ARCHIVADO)->where('estatus', Documento::SOLICITUD_REVISION)->count();
            $mis_documentos = Documento::with('macroproceso')->where('elaboro_id', $usuario->empleado->id)->get();
            //Evaluaciones
            $evaluaciones = EvaluadoEvaluador::whereHas('evaluacion', function ($q) {
                $q->where('estatus', Evaluacion::ACTIVE)
                    ->where('fecha_inicio', '<=', Carbon::now())
                    ->where('fecha_fin', '>', Carbon::now());
            })->with('empleado_evaluado', 'evaluador')->where('evaluador_id', auth()->user()->empleado->id)->get();
            $mis_evaluaciones = EvaluadoEvaluador::with('evaluacion', 'empleado_evaluado', 'evaluador')->where('evaluado_id', auth()->user()->empleado->id)->get();
            //Objetivos
            $mis_objetivos = Empleado::with(['objetivos' => function ($q) {
                $q->with(['objetivo' => function ($query) {
                    $query->with(['calificacion']);
                }])->where('completado', false);
            }])->find($usuario->empleado->id)->objetivos;
            $evaluaciones_mis_objetivos = Evaluacion::whereHas('evaluados', function ($q) use ($usuario) {
                $q->where('evaluado_id', $usuario->empleado->id);
            })->get();
            $lista_evaluaciones = collect();
            foreach ($evaluaciones_mis_objetivos as $evaluacion) {
                $lista_evaluaciones->push([
                    'id' => $evaluacion->id,
                    'nombre' => $evaluacion->nombre,
                    'fecha_inicio' => Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y'),
                    'fecha_fin' => Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y'),
                    'informacion_evaluacion' => $this->obtenerInformacionDeLaConsultaPorEvaluado($evaluacion->id, $usuario->empleado->id),
                ]);
            }
            // dd($lista_evaluaciones);
            // SECCION MIS DATOS
            $equipo_a_cargo = $this->obtenerEquipoACargo($usuario->empleado->children);
            $equipo_a_cargo = Empleado::find($equipo_a_cargo);
            $supervisor = $usuario->empleado->supervisor;
        } else {
            $equipo_a_cargo = collect();
            $supervisor = null;
            $mis_objetivos = collect();
        }

        return view('frontend.inicioUsuario.index', compact('usuario', 'recursos', 'actividades', 'documentos_publicados', 'auditorias_anual', 'revisiones', 'mis_documentos', 'contador_actividades', 'contador_revisiones', 'contador_recursos', 'evaluaciones', 'mis_evaluaciones', 'equipo_a_cargo', 'supervisor', 'mis_objetivos', 'auditoria_internas', 'lista_evaluaciones'));
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
            $lista_autoevaluacion->push([
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

    public function optenerTareas($tarea)
    {
        $assigs = $tarea['assigs'];
        foreach ($assigs as $assig) {
            if ($assig == auth()->user()) {
                return $tarea;
            }
        }
    }

    public function quejas()
    {
        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getAll();

        $sedes = Sede::getAll();

        abort_if(Gate::denies('quejas_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inicioUsuario.formularios.quejas', compact('areas', 'procesos', 'empleados', 'activos', 'sedes'));
    }

    public function storeQuejas(Request $request)
    {
        $quejas = Quejas::create([
            'anonimo' => $request->anonimo,
            'empleado_quejo_id' => auth()->user()->empleado->id,

            'area_quejado' => $request->area_quejado,
            'colaborador_quejado' => $request->colaborador_quejado,
            'proceso_quejado' => $request->proceso_quejado,
            'externo_quejado' => $request->externo_quejado,

            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'estatus' => 'nuevo',
        ]);

        AnalisisSeguridad::create([
            'quejas_id' => $quejas->id,
            'formulario' => 'queja',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_image = 'Queja_file_' . $quejas->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_quejas';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasQueja::create([
                    'evidencia' => $image,
                    'id_quejas' => $quejas->id,
                ]);
            }
        }

        return redirect()->route('inicioUsuario.index')->with('success', 'Reporte generado');
    }

    public function denuncias()
    {
        $empleados = Empleado::getAll();

        $sedes = Sede::getAll();

        abort_if(Gate::denies('denuncias_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inicioUsuario.formularios.denuncias', compact('empleados', 'sedes'));
    }

    public function storeDenuncias(Request $request)
    {
        $denuncias = Denuncias::create([
            'anonimo' => $request->anonimo,
            'empleado_denuncio_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'empleado_denunciado_id' => $request->empleado_denunciado_id,
            'tipo' => $request->tipo,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'fecha' => $request->fecha,
            'estatus' => 'nuevo',
        ]);

        AnalisisSeguridad::create([
            'denuncias_id' => $denuncias->id,
            'formulario' => 'denuncia',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_image = 'Denuncia_file_' . $denuncias->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_denuncias';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasDenuncia::create([
                    'evidencia' => $image,
                    'id_denuncias' => $denuncias->id,
                ]);
            }
        }

        return redirect()->route('inicioUsuario.index')->with('success', 'Reporte generado');
    }

    public function mejoras()
    {
        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        abort_if(Gate::denies('mejoras_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inicioUsuario.formularios.mejoras', compact('areas', 'procesos'));
    }

    public function storeMejoras(Request $request)
    {
        $mejoras = Mejoras::create([
            'empleado_mejoro_id' => auth()->user()->empleado->id,
            'descripcion' => $request->descripcion,
            'beneficios' => $request->beneficios,
            'titulo' => $request->titulo,
            'area_mejora' => $request->area_mejora,
            'proceso_mejora' => $request->proceso_mejora,
            'tipo' => $request->tipo,
            'otro' => $request->otro,
            'estatus' => 'nuevo',
        ]);

        AnalisisSeguridad::create([
            'mejoras_id' => $mejoras->id,
            'formulario' => 'mejora',
        ]);

        return redirect()->route('inicioUsuario.index')->with('success', 'Reporte generado');
    }

    public function sugerencias()
    {
        $areas = Area::getAll();

        $empleados = Empleado::getAll();

        $procesos = Proceso::getAll();

        return view('frontend.inicioUsuario.formularios.sugerencias', compact('areas', 'empleados', 'procesos'));
    }

    public function storeSugerencias(Request $request)
    {
        $sugerencias = Sugerencias::create([
            'empleado_sugirio_id' => auth()->user()->empleado->id,

            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,

            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estatus' => 'nuevo',
        ]);

        AnalisisSeguridad::create([
            'sugerencias_id' => $sugerencias->id,
            'formulario' => 'sugerencia',
        ]);

        return redirect()->route('inicioUsuario.index')->with('success', 'Reporte generado');
    }

    public function seguridad()
    {
        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getAll();

        $sedes = Sede::getAll();

        $subcategorias = SubcategoriaIncidente::get();

        abort_if(Gate::denies('incidentes_seguridad_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inicioUsuario.formularios.seguridad', compact('activos', 'areas', 'procesos', 'sedes', 'subcategorias'));
    }

    public function storeSeguridad(Request $request)
    {
        $incidentes_seguridad = IncidentesSeguridad::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        AnalisisSeguridad::create([
            'seguridad_id' => $incidentes_seguridad->id,
            'formulario' => 'seguridad',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_image = 'Seguridad_file_' . $incidentes_seguridad->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_seguridad';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasSeguridad::create([
                    'evidencia' => $image,
                    'id_seguridad' => $incidentes_seguridad->id,
                ]);
            }
        }

        return redirect()->route('inicioUsuario.index')->with('success', 'Reporte generado');
    }

    public function evidenciaSeguridad()
    {
    }

    public function riesgos()
    {
        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getAll();

        $sedes = Sede::getAll();

        abort_if(Gate::denies('riesgos_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('frontend.inicioUsuario.formularios.riesgos', compact('activos', 'areas', 'procesos', 'sedes'));
    }

    public function storeRiesgos(Request $request)
    {
        $riesgos = RiesgoIdentificado::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'comentarios' => $request->comentarios,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => auth()->user()->empleado->id,
        ]);

        AnalisisSeguridad::create([
            'riesgos_id' => $riesgos->id,
            'formulario' => 'riesgo',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or !empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.' . $extension);

                $new_name_image = 'Riesgo_file_' . $riesgos->id . '_' . $name_image . '.' . $extension;

                $route = 'public/evidencias_riesgos';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasRiesgo::create([
                    'evidencia' => $image,
                    'id_riesgos' => $riesgos->id,
                ]);
            }
        }

        return redirect()->route('inicioUsuario.index')->with('success', 'Reporte generado');
    }

    public function archivarCapacitacion(Request $request)
    {
        $int_empleado = intval($request->id_empleado);
        $recurso = Recurso::find(intval($request->recurso_id));
        $recurso->empleados()->syncWithoutDetaching([$int_empleado => ['archivado' => true]]);

        return response()->json(['success' => true]);
    }
}

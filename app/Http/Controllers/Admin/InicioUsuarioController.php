<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Activo;
use App\Models\AnalisisSeguridad;
use App\Models\Area;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\Denuncias;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\EvidenciaDocumentoEmpleadoArchivo;
use App\Models\EvidenciasDenuncia;
use App\Models\EvidenciasDocumentosEmpleados;
use App\Models\EvidenciasQueja;
use App\Models\EvidenciasRiesgo;
use App\Models\EvidenciasSeguridad;
use App\Models\FelicitarCumpleaños;
use App\Models\IncidentesSeguridad;
use App\Models\ListaDocumentoEmpleado;
use App\Models\Mejoras;
use App\Models\Organizacion;
use App\Models\PanelInicioRule;
use App\Models\PlanImplementacion;
use App\Models\Proceso;
use App\Models\Puesto;
use App\Models\PuestoIdiomaPorcentajePivot;
use App\Models\Quejas;
use App\Models\Recurso;
use App\Models\RevisionDocumento;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluacionRepuesta;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RH\ObjetivoRespuesta;
use App\Models\RiesgoIdentificado;
use App\Models\Sede;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use App\Models\SubcategoriaIncidente;
use App\Models\Sugerencias;
use App\Models\User;
use App\Models\VersionesIso;
use Carbon\Carbon;
use Essa\APIToolKit\Api\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class InicioUsuarioController extends Controller
{
    use ApiResponse;

    public function index()
    {
        abort_if(Gate::denies('mi_perfil_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hoy = Carbon::now();
        $hoy->toDateString();

        $usuario = User::getCurrentUser();
        $usuarioVinculadoConEmpleado = false;
        if ($usuario->empleado) {
            $usuarioVinculadoConEmpleado = true;
        }
        // dd($usuarioVinculadoConEmpleado);
        $empleado_id = $usuario->empleado ? $usuario->empleado->id : 0;
        $actividades = [];
        // Check if the result is already cached
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
                    $task->archivo = $implementacion->archivo;
                    $task->id_implementacion = $implementacion->id;
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
        $empleado = $usuario->empleado;
        $recursos = collect();
        $eventos = Calendario::getAll();
        $oficiales = CalendarioOficial::getAll();
        $cumples_aniversarios = Empleado::getAltaEmpleadosWithArea();
        $mis_quejas = collect();
        $mis_quejas_count = 0;
        $mis_denuncias = collect();
        $mis_denuncias_count = 0;
        $mis_propuestas = collect();
        $mis_propuestas_count = 0;
        $mis_sugerencias = collect();
        $mis_sugerencias_count = 0;
        $solicitud_vacacion = 0;
        $solicitud_dayoff = 0;
        $solicitud_permiso = 0;
        $solicitudes_pendientes = 0;
        $cacheKey = 'AuditoriaInterna:auditoria_internas_'.$usuario->id;
        $auditoria_internas = Cache::remember($cacheKey, 3600 * 8, function () use ($usuario, $empleado) {
            return AuditoriaInterna::where(function ($query) use ($usuario, $empleado) {
                $query->whereHas('equipo', function ($subquery) use ($empleado) {
                    $subquery->where('auditoria_interno_empleado.empleado_id', $empleado->id);
                })->orWhere('lider_id', $usuario->empleado->id);
            })->distinct()->get();
        });

        $cacheKeyRecursos = 'Recursos:recursos_'.$usuario->id;
        $recursos = Cache::remember($cacheKeyRecursos, 3600 * 8, function () use ($empleado) {
            return Recurso::whereHas('empleados', function ($query) use ($empleado) {
                $query->where('empleados.id', $empleado->id);
            })->get();
        });

        $contador_recursos = $recursos->where('fecha_fin', '>=', Carbon::now()->toDateString())->count();

        $documentos_publicados = Documento::getLastFiveWithMacroproceso();
        $revisiones = [];
        $mis_documentos = [];
        $contador_revisiones = 0;
        $evaluaciones = collect();
        $mis_evaluaciones = collect();
        $lista_evaluaciones = collect();
        $last_evaluacion = collect();
        $esLider = false;
        $equipo_a_cargo = collect();
        $equipo_trabajo = collect();
        $supervisor = null;
        $mis_objetivos = collect();

        if ($usuario->empleado) {
            $revisiones = RevisionDocumento::getAllWithDocumento();

            $contador_revisiones = $revisiones->where('estatus', Documento::SOLICITUD_REVISION)->count();
            $mis_documentos = Documento::getWithMacroproceso($usuario->empleado->id);
            //Evaluaciones
            $last_evaluacion = Evaluacion::select('id', 'nombre', 'fecha_inicio', 'fecha_fin')->latest()->first();
            if ($last_evaluacion) {
                $evaluaciones = EvaluadoEvaluador::whereHas('evaluacion', function ($q) use ($last_evaluacion) {
                    $q->where('estatus', Evaluacion::ACTIVE)
                        ->where('fecha_inicio', '<=', Carbon::now())
                        ->where('fecha_fin', '>', Carbon::now())
                        ->where('id', $last_evaluacion->id);
                })->with('empleado_evaluado', 'evaluador')->where('evaluador_id', $usuario->empleado->id)
                    ->where('evaluado_id', '!=', $usuario->empleado->id)
                    ->where('evaluado', false)
                    ->get();
                $mis_evaluaciones = EvaluadoEvaluador::whereHas('evaluacion', function ($q) use ($last_evaluacion) {
                    $q->where('estatus', Evaluacion::ACTIVE)
                        ->where('fecha_inicio', '<=', Carbon::now())
                        ->where('fecha_fin', '>', Carbon::now())
                        ->where('id', $last_evaluacion->id);
                })->with('empleado_evaluado', 'evaluador')->where('evaluador_id', $usuario->empleado->id)
                    ->where('evaluado_id', $usuario->empleado->id)
                    ->first();
            }
            $mis_objetivos = $usuario->empleado->objetivos;

            // SECCION MIS DATOS
            if ($usuario->empleado->children->count()) {
                $esLider = true;
                $equipo_a_cargo = $this->obtenerEquipo($usuario->empleado->children);
                $equipo_a_cargo = Empleado::getAll()->find($equipo_a_cargo);
            } else {
                $equipo_trabajo = $usuario->empleado->empleados_misma_area;
                $equipo_trabajo = Empleado::getAll()->find($equipo_trabajo);
            }
            $supervisor = $usuario->empleado->supervisor;
        }

        $panel_rules = PanelInicioRule::getAll();

        if (! is_null($usuario->empleado)) {
            $activos = Activo::select('*')->where('id_responsable', '=', $usuario->empleado->id)->get();
            if ($usuario->empleado->cumpleaños) {
                $cumpleaños_usuario = Carbon::parse($usuario->empleado->cumpleaños)->format('d-m');
            } else {
                $cumpleaños_usuario = null;
            }

            $felicitar = FelicitarCumpleaños::getAllWhereYear($usuario->empleado->id, $hoy->format('Y'));

            $cumpleaños_felicitados_like_contador = $felicitar->where('like', true)->count();

            $cumpleaños_felicitados_like_usuarios = $felicitar->where('like', true);

            $cumpleaños_felicitados_comentarios = $felicitar->where('like', false)->where('comentarios', '!=', null);
        } else {
            $activos = false;
            $cumpleaños_usuario = null;
            $cumpleaños_felicitados_like_contador = collect();
            $cumpleaños_felicitados_like_usuarios = collect();
            $cumpleaños_felicitados_comentarios = collect();
        }

        $organizacion = Organizacion::getFirst();
        $competencias = collect();

        if ($usuario->empleado) {
            $competencias = Empleado::with(
                ['puestoRelacionado' => function ($q) {
                    $q->with(['competencias' => function ($q) {
                        $q->with('competencia');
                    }]);
                }]
            )->find($usuario->empleado->id)->puestoRelacionado;
            $competencias = ! is_null($competencias) ? $competencias->competencias : collect();

            $quejas = Quejas::getAll()->where('empleado_quejo_id', $usuario->empleado->id);
            $denuncias = Denuncias::getAll()->where('empleado_denuncio_id', $usuario->empleado->id);
            $mejoras = Mejoras::getAll()->where('empleado_mejoro_id', $usuario->empleado->id);
            $sugerencias = Sugerencias::getAll()->where('empleado_sugirio_id', $usuario->empleado->id);

            $mis_quejas = $quejas->where('empleado_quejo_id', $usuario->empleado->id);
            $mis_quejas_count = $quejas->count();
            $mis_denuncias = $denuncias;
            $mis_denuncias_count = $denuncias->count();
            $mis_propuestas = $mejoras;
            $mis_propuestas_count = $mejoras->count();
            $mis_sugerencias = $sugerencias;
            $mis_sugerencias_count = $sugerencias->count();

            $solicitud_vacacion = SolicitudVacaciones::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
            $solicitud_dayoff = SolicitudDayOff::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
            $solicitud_permiso = SolicitudPermisoGoceSueldo::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
            $solicitudes_pendientes = $solicitud_vacacion + $solicitud_dayoff + $solicitud_permiso;
            // $solicitudes_pendientes = 1;
        }

        $existsEmpleado = Empleado::getExists();
        $existsOrganizacion = Organizacion::getExists();
        $existsAreas = Area::getExists();
        $existsPuesto = Puesto::getExists();
        $existsVinculoEmpleadoAdmin = User::getExists();

        return view('admin.inicioUsuario.index', compact(
            'solicitudes_pendientes',
            'usuario',
            'competencias',
            'recursos',
            'actividades',
            'documentos_publicados',
            'auditorias_anual',
            'revisiones',
            'mis_documentos',
            'contador_actividades',
            'contador_revisiones',
            'contador_recursos',
            'auditoria_internas',
            'evaluaciones',
            'oficiales',
            'mis_evaluaciones',
            'equipo_a_cargo',
            'equipo_trabajo',
            'supervisor',
            'mis_objetivos',
            'last_evaluacion',
            'panel_rules',
            'activos',
            'eventos',
            'cumpleaños_usuario',
            'cumpleaños_felicitados_like_contador',
            'cumpleaños_felicitados_comentarios',
            'cumples_aniversarios',
            'cumpleaños_felicitados_like_usuarios',
            'esLider',
            'organizacion',
            'usuarioVinculadoConEmpleado',
            'mis_quejas',
            'mis_quejas_count',
            'mis_denuncias',
            'mis_denuncias_count',
            'mis_propuestas',
            'mis_propuestas_count',
            'mis_sugerencias',
            'mis_sugerencias_count',
            'existsEmpleado',
            'existsOrganizacion',
            'existsVinculoEmpleadoAdmin',
            'existsAreas',
            'existsPuesto'
        ));
    }

    // public function obtenerInformacionDeLaConsultaPorEvaluado($evaluacion, $evaluado)
    // {
    //     $evaluacion = Evaluacion::find(intval($evaluacion));
    //     $evaluado = Empleado::with(['area', 'puestoRelacionado' => function ($q) {
    //         $q->with('competencias');
    //     }])->find(intval($evaluado));
    //     $evaluadores = EvaluadoEvaluador::where('evaluacion_id', $evaluacion->id)
    //         ->where('evaluado_id', $evaluado->id)
    //         ->get();
    //     $calificacion_final = 0;

    //     $promedio_competencias = 0;
    //     $promedio_general_competencias = 0;
    //     $evalaciones_lista = collect();
    //     $lista_autoevaluacion = collect();
    //     $lista_jefe_inmediato = collect();
    //     $lista_equipo_a_cargo = collect();
    //     $lista_misma_area = collect();
    //     if ($evaluacion->include_competencias) {
    //         $filtro_autoevaluacion = $evaluadores->filter(function ($evaluador) {
    //             return intval($evaluador->tipo) == EvaluadoEvaluador::AUTOEVALUACION;
    //         });
    //         $filtro_jefe_inmediato = $evaluadores->filter(function ($evaluador) {
    //             return intval($evaluador->tipo) == EvaluadoEvaluador::JEFE_INMEDIATO;
    //         });
    //         $filtro_equipo_a_cargo = $evaluadores->filter(function ($evaluador) {
    //             return intval($evaluador->tipo) == EvaluadoEvaluador::EQUIPO;
    //         });
    //         $filtro_misma_area = $evaluadores->filter(function ($evaluador) {
    //             return intval($evaluador->tipo) == EvaluadoEvaluador::MISMA_AREA;
    //         });
    //         $promedio_competencias = 0;
    //         $cantidad_competencias_evaluadas = $evaluado->puestoRelacionado->competencias->count() > 0 ? $evaluado->puestoRelacionado->competencias->count() : 1;
    //         $lista_autoevaluacion->push([
    //             'tipo' => 'Autoevaluación',
    //             'peso_general' => $evaluacion->peso_autoevaluacion,
    //             'evaluaciones' => $filtro_autoevaluacion->map(function ($evaluador) use ($evaluacion, $evaluado) {
    //                 $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
    //                     ->where('evaluado_id', $evaluado->id)
    //                     ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
    //                 $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

    //                 return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
    //             }),
    //         ]);

    //         $calificacion = 0;
    //         if (count($lista_autoevaluacion->first()['evaluaciones'])) {
    //             foreach ($lista_autoevaluacion->first()['evaluaciones'] as $evaluacion_b) {
    //                 foreach ($evaluacion_b['competencias'] as $competencia) {
    //                     $calificacion += $competencia['porcentaje'];
    //                 }
    //             }
    //             $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
    //         } else {
    //             $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_autoevaluacion / 100);
    //         }

    //         $lista_jefe_inmediato->push([
    //             'tipo' => 'Jefe Inmediato',
    //             'peso_general' => $evaluacion->peso_jefe_inmediato,
    //             'evaluaciones' => $filtro_jefe_inmediato->map(function ($evaluador) use ($evaluacion, $evaluado) {
    //                 $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
    //                     ->where('evaluado_id', $evaluado->id)
    //                     ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
    //                 $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

    //                 return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
    //             }),
    //         ]);

    //         $calificacion = 0;
    //         if (count($lista_jefe_inmediato->first()['evaluaciones'])) {
    //             foreach ($lista_jefe_inmediato->first()['evaluaciones'] as $evaluacion_b) {
    //                 foreach ($evaluacion_b['competencias'] as $competencia) {
    //                     $calificacion += $competencia['porcentaje'];
    //                 }
    //             }
    //             $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100);
    //         } else {
    //             $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_jefe_inmediato / 100);
    //         }

    //         $lista_equipo_a_cargo->push([
    //             'tipo' => 'Equipo a cargo',
    //             'peso_general' => $evaluacion->peso_equipo,
    //             'evaluaciones' => $filtro_equipo_a_cargo->map(function ($evaluador) use ($evaluacion, $evaluado) {
    //                 $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
    //                     ->where('evaluado_id', $evaluado->id)
    //                     ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
    //                 $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

    //                 return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
    //             }),
    //         ]);

    //         $calificacion = 0;
    //         if (count($lista_equipo_a_cargo->first()['evaluaciones'])) {
    //             foreach ($lista_equipo_a_cargo->first()['evaluaciones'] as $evaluacion_b) {
    //                 foreach ($evaluacion_b['competencias'] as $competencia) {
    //                     $calificacion += $competencia['porcentaje'];
    //                 }
    //             }
    //             $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100);
    //         } else {
    //             $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_equipo / 100);
    //         }

    //         $lista_misma_area->push([
    //             'tipo' => 'Misma área',
    //             'peso_general' => $evaluacion->peso_area,
    //             'evaluaciones' => $filtro_misma_area->map(function ($evaluador) use ($evaluacion, $evaluado) {
    //                 $evaluaciones_competencias = EvaluacionRepuesta::with('competencia', 'evaluador')->where('evaluacion_id', $evaluacion->id)
    //                     ->where('evaluado_id', $evaluado->id)
    //                     ->where('evaluador_id', $evaluador->evaluador_id)->orderBy('id')->get();
    //                 $evaluador_empleado = Empleado::find($evaluador->evaluador_id);

    //                 return $this->obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias);
    //             }),
    //         ]);

    //         $calificacion = 0;
    //         if (count($lista_misma_area->first()['evaluaciones'])) {
    //             foreach ($lista_misma_area->first()['evaluaciones'] as $evaluacion_b) {
    //                 foreach ($evaluacion_b['competencias'] as $competencia) {
    //                     $calificacion += $competencia['porcentaje'];
    //                 }
    //             }
    //             $promedio_competencias += (($calificacion * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100);
    //         } else {
    //             $promedio_competencias += (($cantidad_competencias_evaluadas * 100) / $cantidad_competencias_evaluadas) * ($evaluacion->peso_area / 100);
    //         }
    //         // dd($promedio_competencias);
    //         $promedio_competencias = number_format($promedio_competencias / 100, 2);
    //         $promedio_general_competencias = $promedio_competencias * $evaluacion->peso_general_competencias;
    //         $calificacion_final += $promedio_general_competencias;
    //     } else {
    //         //Logica para cuando no se evaluan competencias
    //     }

    //     $promedio_objetivos = 0;
    //     $promedio_general_objetivos = 0;
    //     $evaluadores_objetivos = collect();
    //     if ($evaluacion->include_objetivos) {
    //         if ($evaluado->supervisor) {
    //             $objetivos_calificaciones = ObjetivoRespuesta::with(['objetivo' => function ($q) {
    //                 return $q->with('metrica');
    //             }])->where('evaluacion_id', $evaluacion->id)
    //                 ->where('evaluado_id', $evaluado->id)
    //                 ->where('evaluador_id', $evaluado->supervisor->id)
    //                 ->get();
    //             $evaluadores_objetivos->push([
    //                 'id' => $evaluado->supervisor->id, 'nombre' => $evaluado->supervisor->name,
    //                 'esSupervisor' => true,
    //                 'esAutoevaluacion' => false,
    //                 'objetivos' => $objetivos_calificaciones->map(function ($objetivo) {
    //                     return [
    //                         'nombre' => $objetivo->objetivo->nombre,
    //                         'KPI' => $objetivo->objetivo->KPI,
    //                         'meta' => $objetivo->objetivo->meta,
    //                         'descripcion_meta' => $objetivo->objetivo->descripcion_meta,
    //                         'metrica' => $objetivo->objetivo->metrica->definicion,
    //                         'meta_alcanzada' => $objetivo->meta_alcanzada,
    //                         'calificacion' => $objetivo->calificacion,
    //                     ];
    //                 }),
    //             ]);
    //         }
    //         $calificacion_objetivos = 0;
    //         if (count($evaluadores_objetivos->first()['objetivos'])) {
    //             foreach ($evaluadores_objetivos->first()['objetivos'] as $objetivo) {
    //                 $calificacion_objetivos += $objetivo['calificacion'] / $objetivo['meta'];
    //             }
    //         }

    //         $objetivos_calificaciones_autoevaluacion = ObjetivoRespuesta::with(['objetivo' => function ($q) {
    //             return $q->with('metrica');
    //         }])->where('evaluacion_id', $evaluacion->id)
    //             ->where('evaluado_id', $evaluado->id)
    //             ->where('evaluador_id', $evaluado->id)
    //             ->get();

    //         $evaluadores_objetivos->push([
    //             'id' => $evaluado->id, 'nombre' => $evaluado->name,
    //             'esSupervisor' => false,
    //             'esAutoevaluacion' => true,
    //             'objetivos' => $objetivos_calificaciones_autoevaluacion->map(function ($objetivo) {
    //                 return [
    //                     'nombre' => $objetivo->objetivo->nombre,
    //                     'KPI' => $objetivo->objetivo->KPI,
    //                     'meta' => $objetivo->objetivo->meta,
    //                     'descripcion_meta' => $objetivo->objetivo->descripcion_meta,
    //                     'metrica' => $objetivo->objetivo->metrica->definicion,
    //                     'meta_alcanzada' => $objetivo->meta_alcanzada,
    //                     'calificacion' => $objetivo->calificacion,
    //                 ];
    //             }),
    //         ]);

    //         $promedio_objetivos += (($calificacion_objetivos * 100) / 2) / 100;
    //         $promedio_general_objetivos += $promedio_objetivos * $evaluacion->peso_general_objetivos;
    //         $promedio_objetivos = number_format($promedio_objetivos, 2);
    //         $promedio_general_objetivos = number_format($promedio_general_objetivos, 2);
    //         $calificacion_final += $promedio_general_objetivos;
    //     }

    //     return [
    //         'lista_autoevaluacion' => $lista_autoevaluacion,
    //         'lista_jefe_inmediato' => $lista_jefe_inmediato,
    //         'lista_equipo_a_cargo' => $lista_equipo_a_cargo,
    //         'lista_misma_area' => $lista_misma_area,
    //         'promedio_competencias' => $promedio_competencias,
    //         'promedio_general_competencias' => $promedio_general_competencias,
    //         'evaluadores_objetivos' => $evaluadores_objetivos,
    //         'promedio_objetivos' => $promedio_objetivos,
    //         'promedio_general_objetivos' => $promedio_general_objetivos,
    //         'calificacion_final' => $calificacion_final,
    //         'evaluadores' => Empleado::find($evaluadores->pluck('evaluador_id')),
    //     ];
    // }

    // public function obtenerInformacionDeLaEvaluacionDeCompetencia($evaluador_empleado, $evaluador, $evaluado, $evaluaciones_competencias)
    // {
    //     return [
    //         'id' => $evaluador_empleado->id, 'nombre' => $evaluador_empleado->name,
    //         'esSupervisor' => $evaluado->supervisor ? ($evaluado->supervisor->id == $evaluador->evaluador_id ? true : false) : false,
    //         'esAutoevaluacion' => $evaluado->id == $evaluador->evaluador_id ? true : false,
    //         'tipo' => $evaluador->tipo_formateado,
    //         'competencias' => $evaluaciones_competencias->map(function ($competencia) use ($evaluador, $evaluado) {
    //             $nivel_esperado = $evaluado->puestoRelacionado->competencias->filter(function ($compe) use ($competencia) {
    //                 return $compe->competencia_id == $competencia->competencia_id;
    //             })->first()->nivel_esperado;

    //             $porcentaje = 0;
    //             if ($competencia->calificacion > 0) {
    //                 $porcentaje = number_format((($competencia->calificacion) / $nivel_esperado), 2);
    //             }

    //             return [
    //                 'competencia' => $competencia->competencia->nombre,
    //                 'tipo_competencia' => $competencia->competencia->tipo_competencia,
    //                 'calificacion' => $competencia->calificacion,
    //                 'porcentaje' => $porcentaje,
    //                 'evaluado' => $evaluador->evaluado,
    //                 'peso' => $evaluador->peso,
    //                 'meta' => $nivel_esperado,
    //                 'firma_evaluador' => $evaluador->firma_evaluador,
    //                 'firma_evaluado' => $evaluador->firma_evaluado,
    //             ];
    //         }),
    //     ];
    // }

    public function obtenerEquipo($childrens)
    {
        $equipo_a_cargo = collect();

        foreach ($childrens as $evaluador) {
            if ($evaluador->estatus == 'alta') {
                $equipo_a_cargo->push($evaluador->id);

                if (count($evaluador->children)) {
                    $equipo_a_cargo->push($this->obtenerEquipo($evaluador->children));
                }
            }
        }

        return $equipo_a_cargo->flatten(1)->toArray();
    }

    public function optenerTareas($tarea)
    {
        $assigs = $tarea['assigs'];
        foreach ($assigs as $assig) {
            if ($assig == User::getCurrentUser()) {
                return $tarea;
            }
        }
    }

    public function quejas()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_queja'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $sedes = Sede::getAll();

        return view('admin.inicioUsuario.formularios.quejas', compact('areas', 'procesos', 'empleados', 'activos', 'sedes'));
    }

    public function storeQuejas(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_queja'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $quejas = Quejas::create([
            'anonimo' => $request->anonimo,
            'empleado_quejo_id' => User::getCurrentUser()->empleado->id,

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

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Queja_file_'.$quejas->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_quejas';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasQueja::create([
                    'evidencia' => $image,
                    'id_quejas' => $quejas->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function denuncias()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_denuncia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $empleados = Empleado::getAll();

        $sedes = Sede::getAll();

        return view('admin.inicioUsuario.formularios.denuncias', compact('empleados', 'sedes'));
    }

    public function storeDenuncias(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_denuncia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $denuncias = Denuncias::create([
            'anonimo' => $request->anonimo,
            'empleado_denuncio_id' => User::getCurrentUser()->empleado->id,
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

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Denuncia_file_'.$denuncias->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_denuncias';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasDenuncia::create([
                    'evidencia' => $image,
                    'id_denuncias' => $denuncias->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function mejoras()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        return view('admin.inicioUsuario.formularios.mejoras', compact('areas', 'procesos'));
    }

    public function storeMejoras(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'area_mejora' => 'nullable|string',
            'proceso_mejora' => 'nullable|string',
            'titulo' => 'required',
            'tipo' => 'required',
            'descripcion' => 'required',
            'beneficios' => 'required',
        ]);

        $mejoras = Mejoras::create([
            'empleado_mejoro_id' => User::getCurrentUser()->empleado->id,
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

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function sugerencias()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $empleados = Empleado::getaltaAll();

        $procesos = Proceso::getAll();

        return view('admin.inicioUsuario.formularios.sugerencias', compact('areas', 'empleados', 'procesos'));
    }

    public function storeSugerencias(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sugerencias = Sugerencias::create([
            'empleado_sugirio_id' => User::getCurrentUser()->empleado->id,

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

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function seguridad()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $sedes = Sede::getAll();

        $subcategorias = SubcategoriaIncidente::get();

        $incidentes_seguridad = IncidentesSeguridad::getAll();

        return view('admin.inicioUsuario.formularios.seguridad', compact('incidentes_seguridad', 'activos', 'areas', 'procesos', 'sedes', 'subcategorias'));
    }

    public function storeSeguridad(Request $request)
    {
        // $incidente_procedente = intval($request->procedente ? $request->procedente : $incidentes_seguridad->procedente) == 1 ? true : false;
        $incidente_procedente = intval($request->procedente) == 1 ? true : false;

        $request->validate([
            'titulo' => 'required|string',
            'fecha' => 'required',
            'sede' => 'required',
            'ubicacion' => 'nullable|string',
            'descripcion' => 'required',
            'procedente' => 'required',
        ]);

        $incidentes_seguridad = IncidentesSeguridad::create([
            'titulo' => $request->titulo,
            'fecha' => $request->fecha,
            'sede' => $request->sede,
            'ubicacion' => $request->ubicacion,
            'descripcion' => $request->descripcion,
            'areas_afectados' => $request->areas_afectados,
            'procesos_afectados' => $request->procesos_afectados,
            'activos_afectados' => $request->activos_afectados,
            'empleado_reporto_id' => User::getCurrentUser()->empleado->id,
            'procedente' => $incidente_procedente,
            'justificacion' => $request->justificacion,
        ]);

        if ($incidente_procedente) {
            $incidentes_seguridad->update([
                'estatus' => 'Sin atender',

            ]);
        } else {
            $incidentes_seguridad->update([
                'estatus' => 'No procedente',
            ]);
        }

        AnalisisSeguridad::create([
            'seguridad_id' => $incidentes_seguridad->id,
            'formulario' => 'seguridad',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Seguridad_file_'.$incidentes_seguridad->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_seguridad';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasSeguridad::create([
                    'evidencia' => $image,
                    'id_seguridad' => $incidentes_seguridad->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function evidenciaSeguridad()
    {
    }

    public function riesgos()
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $areas = Area::getAll();

        $procesos = Proceso::getAll();

        $activos = Activo::getAll();

        $empleados = Empleado::getaltaAll();

        $sedes = Sede::getAll();

        return view('admin.inicioUsuario.formularios.riesgos', compact('activos', 'areas', 'procesos', 'sedes'));
    }

    public function storeRiesgos(Request $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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
            'empleado_reporto_id' => User::getCurrentUser()->empleado->id,
        ]);

        AnalisisSeguridad::create([
            'riesgos_id' => $riesgos->id,
            'formulario' => 'riesgo',
        ]);

        $image = null;

        if ($request->file('evidencia') != null or ! empty($request->file('evidencia'))) {
            foreach ($request->file('evidencia') as $file) {
                $extension = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

                $name_image = basename(pathinfo($file->getClientOriginalName(), PATHINFO_BASENAME), '.'.$extension);

                $new_name_image = 'Riesgo_file_'.$riesgos->id.'_'.$name_image.'.'.$extension;

                $route = 'public/evidencias_riesgos';

                $image = $new_name_image;

                $file->storeAs($route, $image);

                EvidenciasRiesgo::create([
                    'evidencia' => $image,
                    'id_riesgos' => $riesgos->id,
                ]);
            }
        }

        return redirect()->route('admin.desk.index')->with('success', 'Reporte generado');
    }

    public function archivarCapacitacion($id)
    {
        $recurso = Recurso::find($id);

        $recurso->update([
            'archivar' => 'archivado',
        ]);

        return redirect('admin/inicioUsuario/capacitaciones/archivo');
    }

    public function recuperarCapacitacion($id)
    {
        $recurso = Recurso::find($id);

        $recurso->update([
            'archivar' => 'recuperado',
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function archivoCapacitacion()
    {
        $recursos = Recurso::getAll();

        return view('admin.inicioUsuario.capacitaciones_archivo', compact('recursos'));
    }

    public function archivarAprobacion($id)
    {
        $mis_documentos = Documento::find($id);

        $mis_documentos->update([
            'archivo' => 'archivado',
        ]);

        return redirect()->route('admin.inicio-Usuario.aprobacion.archivo');
    }

    public function recuperarAprobacion($id)
    {
        $mis_documentos = Documento::find($id);

        $mis_documentos->update([
            'archivo' => 'recuperado',
        ]);

        return redirect()->route('admin.inicio-Usuario.index');
    }

    public function archivoAprobacion()
    {
        $mis_documentos = Documento::getAll()->where('deleted_at', '=', null);

        return view('admin.inicioUsuario.aprobaciones_archivo', compact('mis_documentos'));
    }

    public function archivoActividades()
    {
        $usuario = User::getCurrentUser();
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
                    $task->archivo = $implementacion->archivo;
                    $task->id_implementacion = $implementacion->id;
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

        // dd($actividades);

        return view('admin.inicioUsuario.actividades_archivo', compact('actividades'));
    }

    public function archivarActividades(Request $request)
    {
        $implementacion = PlanImplementacion::where('id', $request->planImplementacionID)->first();
        $tasks = $implementacion->tasks;
        $taskID = $request->taskID;
        $updatedTasks = array_map(function ($item) use ($taskID) {
            if ($item->id == $taskID) {
                $item->archivado = true;
            }

            return $item;
        }, $tasks);

        $implementacion->update([
            'tasks' => $updatedTasks,
        ]);

        return response()->json(['success' => true]);

        // return redirect()->route('admin.inicio-Usuario.acctividades.archivo');
    }

    public function cambiarEstatusActividad(Request $request)
    {
        $implementacion = PlanImplementacion::where('id', $request->planImplementacionID)->first();
        $tasks = $implementacion->tasks;
        $taskID = $request->taskID;
        $estatus = $request->estatusSeleccionado;

        $updatedTasks = array_map(function ($item) use ($taskID, $estatus, $request) {
            if ($estatus == 'STATUS_UNDEFINED') {
                $progreso = 0;
            }
            if ($estatus == 'STATUS_ACTIVE') {
                $progreso = array_key_exists('progreso', $request->all()) != null ? $request->progreso : 50;
            }
            if ($estatus == 'STATUS_DONE') {
                $progreso = 100;
            }

            if ($item->id == $taskID) {
                $item->status = $estatus;
                if (isset($progreso)) {
                    $item->progress = $progreso;
                }
            }

            return $item;
        }, $tasks);

        $implementacion->update([
            'tasks' => $updatedTasks,
        ]);

        return response()->json(['success' => true]);

        // return redirect()->route('admin.inicio-Usuario.acctividades.archivo');
    }

    public function recuperarActividades(Request $request)
    {
        $implementacion = PlanImplementacion::where('id', $request->planImplementacionID)->first();
        $tasks = $implementacion->tasks;
        $taskID = $request->taskID;
        $updatedTasks = array_map(function ($item) use ($taskID) {
            if ($item->id == $taskID) {
                $item->archivado = false;
            }

            return $item;
        }, $tasks);

        $implementacion->update([
            'tasks' => $updatedTasks,
        ]);

        return response()->json(['success' => true]);
    }

    public function perfilPuesto()
    {
        abort_if(Gate::denies('mi_perfil_mis_datos_ver_perfil_de_puesto'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $puesto_id = User::getCurrentUser()->empleado->puesto_id;
        $puesto = Puesto::getAll()->find($puesto_id);

        $idiomas = PuestoIdiomaPorcentajePivot::where('id_puesto', '=', $puesto->id)->get();

        return view('admin.inicioUsuario.perfil_puesto', compact('puesto', 'idiomas'));
    }

    public function expediente($id_empleado)
    {
        $empleado = Empleado::getAll()->find($id_empleado);

        $evidendiasdocumentos = EvidenciasDocumentosEmpleados::getAll();
        $docs_empleado = $evidendiasdocumentos->where('empleado_id', $id_empleado);
        $lista_docs_model = ListaDocumentoEmpleado::getAll();
        $lista_docs = collect();
        foreach ($lista_docs_model as $doc) {
            $documentos_empleado = $evidendiasdocumentos->where('empleado_id', $id_empleado)->where('lista_documentos_empleados_id', $doc->id)->first();
            if ($documentos_empleado) {
                $documento = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $documentos_empleado->id)->where('archivado', false)->first();
                if ($documento) {
                    $doc_viejo = $documento->ruta_documento;
                    $nombre_doc = $documento->documento;
                } else {
                    $doc_viejo = null;
                    $nombre_doc = null;
                }
            } else {
                $doc_viejo = null;
                $nombre_doc = null;
            }

            $lista_docs->push((object) [
                'id' => $doc->id,
                'documento' => $doc->documento,
                'tipo' => $doc->tipo,
                'empleado' => $documentos_empleado,
                'ruta_documento' => $doc_viejo,
                'nombre_doc' => $nombre_doc,
            ]);
        }

        // dd($lista_docs);

        return view('admin.inicioUsuario.expediente', compact('empleado', 'docs_empleado', 'lista_docs'));
    }

    public function expedienteUpdate(Request $request)
    {
        // dd($request->all());
        if ($request->name == 'file') {
            $fileName = time().$request->file('value')->getClientOriginalName();
            // dd($request->file('value'));
            $empleado = Empleado::getAll()->find($request->empleadoId);
            $request->file('value')->storeAs('public/expedientes/'.Str::slug($empleado->name), $fileName);
            $expediente = EvidenciasDocumentosEmpleados::updateOrCreate(['empleado_id' => $request->empleadoId, 'lista_documentos_empleados_id' => $request->documentoId], [$request->name => $request->value]);

            $doc_viejo = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $expediente->id)->where('archivado', false)->first();
            if ($doc_viejo) {
                $doc_viejo->update([
                    'archivado' => true,
                ]);
            }

            $archivo = EvidenciaDocumentoEmpleadoArchivo::create([
                'evidencias_documentos_empleados_id' => $expediente->id,
                'documento' => $fileName,
                'archivado' => false,
            ]);

            return response()->json(['status' => 201, 'message' => 'Registro Actualizado']);
        } else {
            $expediente = EvidenciasDocumentosEmpleados::updateOrCreate(['empleado_id' => $request->empleadoId, 'lista_documentos_empleados_id' => $request->documentoId], [$request->name => $request->value]);
        }

        // $expediente->update([
        //     $request->name => $request->value,
        // ]);

        return response()->json(['status' => 200, 'message' => 'Registro Actualizado']);
    }

    public function updateVersionIso(Request $request)
    {
        foreach ($request->toArray() as $var) {
            if ($var === false) {
                $valor = false;
            } else {
                $valor = true;
            }
        }

        $ver = VersionesIso::getFirst();
        $ver->update([
            'version_historico' => $valor,
        ]);
    }
}

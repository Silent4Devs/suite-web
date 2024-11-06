<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRiesgosRequest;
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
use App\Models\EvaluacionDesempeno;
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
use App\Models\PeriodoCargaObjetivos;
use App\Models\PermisosCargaObjetivos;
use App\Models\PlanImplementacion;
use App\Models\Proceso;
use App\Models\Puesto;
use App\Models\PuestoIdiomaPorcentajePivot;
use App\Models\Quejas;
use App\Models\Recurso;
use App\Models\RevisionDocumento;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\RiesgoIdentificado;
use App\Models\Sede;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use App\Models\SubcategoriaIncidente;
use App\Models\Sugerencias;
use App\Models\User;
use App\Models\VersionesIso;
use App\Services\SentimentService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use VXM\Async\AsyncFacade as Async;
use Illuminate\Support\Facades\Concurrency;
use Illuminate\Support\Facades\DB;

class InicioUsuarioController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('mi_perfil_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hoy = Carbon::now();

        $hoy->toDateString();

        [$first, $second] = Concurrency::run([
            fn () => DB::table('users')->count(),
            fn () => Empleado::exists()
        ]);

        dd($first, $second);

        Async::batchRun(
            function () use (&$implementaciones) {
                // Check if the result is already cached
                $implementaciones = PlanImplementacion::getAll();
            },
            function () use (&$existsEmpleado) {
                $existsEmpleado = Empleado::exists();
            },
            function () use (&$existsOrganizacion) {
                $existsOrganizacion = Organizacion::exists();
            },
            function () use (&$existsAreas) {
                $existsAreas = Area::exists();
            },
            function () use (&$existsPuesto) {
                $existsPuesto = Puesto::exists();
            },
            function () use (&$existsVinculoEmpleadoAdmin) {
                $existsVinculoEmpleadoAdmin = User::exists();
            },
            function () use (&$organizacion) {
                $organizacion = Organizacion::getFirst();
            },
            function () use (&$panel_rules) {
                $panel_rules = PanelInicioRule::getAll();
            },
            function () use (&$documentos_publicados) {
                $documentos_publicados = Documento::getLastFiveWithMacroproceso();
            },
            function () use (&$auditorias_anual) {
                $auditorias_anual = AuditoriaAnual::getAll();
            },
            function () use (&$eventos) {
                $eventos = Calendario::getAll();
            },
            function () use (&$oficiales) {
                $oficiales = CalendarioOficial::getAll();
            },
            function () use (&$cumples_aniversarios) {
                $cumples_aniversarios = Empleado::getAltaEmpleadosWithArea();
            },
        );

        $usuario = User::getCurrentUser();
        $empleado = Empleado::getMyEmpleadodata($usuario->empleado->id);

        // dd($empleado->estado_disponibilidad);

        $usuarioVinculadoConEmpleado = false;
        if ($empleado) {
            $usuarioVinculadoConEmpleado = true;
        }

        $empleado_id = $empleado ? $empleado->id : 0;
        $actividades = [];

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
                    if (! isset($task->progress) || empty($task->progress)) {
                        $task->progress = 0;
                    } else {
                        $task->progress = intval($task->progress);
                    }
                    $task->canDelete = $task->canDelete == 'true' ? true : false;
                    isset($task->level) ? ($task->level = intval($task->level)) : ($task->level = 0);
                    isset($task->collapsed) ? ($task->collapsed = $task->collapsed == 'true' ? true : false) : ($task->collapsed = false);
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

        $auditoria_internas = new AuditoriaInterna;
        $recursos = collect();
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
        $auditoria_internas = Cache::remember($cacheKey, 3600 * 8, function () use ($empleado) {
            return AuditoriaInterna::where(function ($query) use ($empleado) {
                $query
                    ->whereHas('equipo', function ($subquery) use ($empleado) {
                        $subquery->where('auditoria_interno_empleado.empleado_id', $empleado->id);
                    })
                    ->orWhere('lider_id', $empleado->id);
            })
                ->distinct()
                ->get();
        });

        $cacheKeyRecursos = 'Recursos:recursos_'.$usuario->id;
        $recursos = Cache::remember($cacheKeyRecursos, 3600 * 8, function () use ($empleado) {
            return Recurso::whereHas('empleados', function ($query) use ($empleado) {
                $query->where('empleados.id', $empleado->id);
            })->get();
        });

        $contador_recursos = $recursos->where('fecha_fin', '>=', Carbon::now()->toDateString())->count();

        $revisiones = [];
        $mis_documentos = [];
        $contador_revisiones = 0;
        $evaluaciones = collect();
        $mis_evaluaciones = collect();
        $como_evaluador = collect();
        $lista_evaluaciones = collect();
        $last_evaluacion = collect();
        $esLider = false;
        $equipo_a_cargo = collect();
        $equipo_trabajo = collect();
        $supervisor = null;
        $mis_objetivos = collect();

        if ($empleado) {
            $revisiones = RevisionDocumento::with('documento')
                ->where('empleado_id', $empleado->id)
                ->where('archivado', 0)
                ->get();

            $contador_revisiones = $revisiones->where('estatus', Documento::SOLICITUD_REVISION)->count();
            $mis_documentos = Documento::getWithMacroproceso($empleado->id);
            //Evaluaciones
            $last_evaluacion = Evaluacion::getAllLatestFirst();
            if ($last_evaluacion) {
                $evaluaciones = EvaluadoEvaluador::whereHas('evaluacion', function ($q) use ($last_evaluacion) {
                    $q->where(function ($query) {
                        $query->where('estatus', Evaluacion::ACTIVE)->orWhere('estatus', Evaluacion::CLOSED);
                    })
                        ->where('fecha_inicio', '<=', Carbon::now())
                        // ->where('fecha_fin', '>', Carbon::now())
                        ->where('id', $last_evaluacion->id);
                })
                    ->with('empleado_evaluado', 'evaluador')
                    ->where('evaluador_id', $empleado->id)
                    ->where('evaluado_id', '!=', $empleado->id)
                    ->where('evaluado', false)
                    ->get();
                $mis_evaluaciones = EvaluadoEvaluador::whereHas('evaluacion', function ($q) use ($last_evaluacion) {
                    $q->where(function ($query) {
                        $query->where('estatus', Evaluacion::ACTIVE)->orWhere('estatus', Evaluacion::CLOSED);
                    })
                        ->where('fecha_inicio', '<=', Carbon::now())
                        // ->where('fecha_fin', '>', Carbon::now())
                        ->where('id', $last_evaluacion->id);
                })
                    ->with('empleado_evaluado', 'evaluador')
                    ->where('evaluador_id', $empleado->id)
                    ->where('evaluado_id', $empleado->id)
                    ->first();
            }

            if ($last_evaluacion) {
                $evaluaciones = EvaluadoEvaluador::whereHas('evaluacion', function ($q) use ($last_evaluacion) {
                    $q->where('estatus', Evaluacion::CLOSED)
                        ->where('fecha_inicio', '<=', Carbon::now())
                        ->where('fecha_fin', '>', Carbon::now())
                        ->where('id', $last_evaluacion->id);
                })
                    ->with('empleado_evaluado', 'evaluador')
                    ->where('evaluador_id', $empleado->id)
                    ->where('evaluado_id', '!=', $empleado->id)
                    ->where('evaluado', false)
                    ->get();
                $como_evaluador = EvaluadoEvaluador::whereHas('evaluacion', function ($q) use ($last_evaluacion) {
                    $q->where('estatus', Evaluacion::CLOSED)
                        ->where('fecha_inicio', '<=', Carbon::now())
                        ->where('fecha_fin', '>', Carbon::now())
                        ->where('id', $last_evaluacion->id);
                })
                    ->with('empleado_evaluado', 'evaluador')
                    ->where('evaluador_id', $empleado->id)
                    ->where('evaluado_id', '!=', $empleado->id)
                    ->first();
            }
            // dd($como_evaluador->evaluacion, $mis_evaluaciones);
            $mis_objetivos = $empleado->objetivos;

            // SECCION MIS DATOS
            if ($empleado->children->count()) {
                $esLider = true;
                $equipo_a_cargo = $this->obtenerEquipo($empleado->children);
                $equipo_a_cargo = Empleado::getaltaAll()->find($equipo_a_cargo);
            } else {
                $equipo_trabajo = $empleado->empleados_misma_area;
                $equipo_trabajo = Empleado::getaltaAll()->find($equipo_trabajo);
            }
            $supervisor = $empleado->supervisor;
        }

        $panel_rules = PanelInicioRule::getAll();

        if (! is_null($empleado)) {
            $activos = Activo::select('*')
                ->where('id_responsable', '=', $empleado->id)
                ->get();
            if ($empleado->cumpleaños) {
                $cumpleaños_usuario = Carbon::parse($empleado->cumpleaños)->format('d-m');
            } else {
                $cumpleaños_usuario = null;
            }

            $felicitar = FelicitarCumpleaños::getAllWhereYear($empleado->id, $hoy->format('Y'));

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

        $competencias = collect();

        if ($empleado) {
            $competencias = Empleado::with([
                'puestoRelacionado' => function ($q) {
                    $q->with([
                        'competencias' => function ($q) {
                            $q->with('competencia');
                        },
                    ]);
                },
            ])->find($empleado->id)->puestoRelacionado;
            $competencias = ! is_null($competencias) ? $competencias->competencias : collect();

            $quejas = Quejas::getAll()->where('empleado_quejo_id', $empleado->id);
            $denuncias = Denuncias::getAll()->where('empleado_denuncio_id', $empleado->id);
            $mejoras = Mejoras::getAll()->where('empleado_mejoro_id', $empleado->id);
            $sugerencias = Sugerencias::getAll()->where('empleado_sugirio_id', $empleado->id);

            $mis_quejas = $quejas->where('empleado_quejo_id', $empleado->id);
            $mis_quejas_count = $quejas->count();
            $mis_denuncias = $denuncias;
            $mis_denuncias_count = $denuncias->count();
            $mis_propuestas = $mejoras;
            $mis_propuestas_count = $mejoras->count();
            $mis_sugerencias = $sugerencias;
            $mis_sugerencias_count = $sugerencias->count();

            $solicitud_vacacion = SolicitudVacaciones::where('autoriza', $empleado->id)
                ->where('aprobacion', 1)
                ->count();
            $solicitud_dayoff = SolicitudDayOff::where('autoriza', $empleado->id)
                ->where('aprobacion', 1)
                ->count();
            $solicitud_permiso = SolicitudPermisoGoceSueldo::where('autoriza', $empleado->id)
                ->where('aprobacion', 1)
                ->count();
            $solicitudes_pendientes = $solicitud_vacacion + $solicitud_dayoff + $solicitud_permiso;
            // $solicitudes_pendientes = 1;
        }

        $redirigirEvaluacion = false;

        try {
            //Evaluaciones desempeno
            $evDes = EvaluacionDesempeno::where('estatus', 1)->get();

            $id_evaluado = null;
            $id_periodo = null;
            $id_evaluacion = null;

            foreach ($evDes as $keyEv => $evD) {
                $periodosEv = $evD->periodos->where('habilitado', true)->where('finalizado', false);

                $areasEv = $evD->areas_evaluacion;

                foreach ($periodosEv as $keyP => $p) {
                    $hoyContestarEvaluacion = $hoy->between($p->fecha_inicio, $p->fecha_fin);
                    if ($hoyContestarEvaluacion) {
                        foreach ($evD->evaluados as $keyEval => $evaluado) {
                            // $evaluado->nombres_evaluadores;
                            $evaluador = in_array($empleado->id, $evaluado->nombres_evaluadores);
                            if ($evaluador) {
                                $redirigirEvaluacion = true;
                                $id_evaluado = $evaluado->id;
                                $id_periodo = $p->id;
                                $id_evaluacion = $evD->id;
                            }
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $mostrarCargaObjetivos = false;

        try {
            //code...
            //Carga de objetivos propios
            $carga_objetivos_activo = PeriodoCargaObjetivos::first();

            $permisos = PermisosCargaObjetivos::get();

            $fechaInicio = $carga_objetivos_activo->fecha_inicio;
            $fechaFin = $carga_objetivos_activo->fecha_fin;

            $hoyCargaObjetivos = $hoy->between($fechaInicio, $fechaFin);

            $perfilAdministrador = $permisos->where('perfil', 'Administrador')->first();
            $perfilJefeInmediato = $permisos->where('perfil', 'Jefe Inmediato')->first();
            $perfilColaborador = $permisos->where('perfil', 'Colaborador')->first();

            if ($hoyCargaObjetivos && $perfilAdministrador->permisos_asignacion == true && $usuario->roles->contains('title', 'Admin')) {
                $mostrarCargaObjetivos = true;
            } elseif ($hoyCargaObjetivos && $perfilJefeInmediato->permisos_asignacion == true && $empleado->es_supervisor) {
                $mostrarCargaObjetivos = true;
            } elseif ($hoyCargaObjetivos && ($perfilColaborador->permisos_asignacion || $perfilColaborador->permiso_objetivos || $perfilColaborador->permiso_escalas)) {
                $mostrarCargaObjetivos = true;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        $mostrarCargaObjetivosArea = false;

        try {
            //code...
            //Carga de objetivos area
            $carga_objetivos_activo_area = PeriodoCargaObjetivos::first();

            $permisosArea = PermisosCargaObjetivos::get();

            $fechaInicioArea = $carga_objetivos_activo_area->fecha_inicio;
            $fechaFinArea = $carga_objetivos_activo_area->fecha_fin;

            $hoyCargaObjetivosArea = $hoy->between($fechaInicioArea, $fechaFinArea);

            $perfilJefeInmediatoArea = $permisosArea->where('perfil', 'Jefe Inmediato')->first();

            if ($hoyCargaObjetivosArea && $perfilJefeInmediatoArea->permisos_asignacion == true && $empleado->es_supervisor) {
                $mostrarCargaObjetivosArea = true;
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        return view(
            'admin.inicioUsuario.index',
            compact(
                'empleado',
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
                'como_evaluador',
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
                'existsPuesto',
                'redirigirEvaluacion',
                'id_periodo',
                'id_evaluacion',
                'id_evaluado',
                'mostrarCargaObjetivos',
                'mostrarCargaObjetivosArea',
            ),
        );
    }

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

        $request->validate(
            [
                'titulo' => 'required|max:255',
                'ubicacion' => 'required|max:255',
                'descripcion' => 'required|max:550',
            ],
            [
                'titulo.max' => 'El campo título no puede exceder los 255 caracteres.',
                'ubicacion.max' => 'El campo ubicación no puede exceder los 255 caracteres.',
                'descripcion.max' => 'El campo descripción no puede exceder los 550 caracteres.',
            ],
        );

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

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
            'sentimientos' => $sentimientos,
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
        $request->validate(
            [
                'ubicacion' => 'required|max:255',
                'descripcion' => 'required|max:550',
            ],
            [
                'descripcion.max' => 'El campo título no puede exceder los 550 caracteres.',
                'ubicacion.max' => 'El campo descripción no puede exceder los 255 caracteres.',
            ],
        );

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

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
            'sentimientos' => $sentimientos,
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

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

        $mejoras = Mejoras::create([
            'empleado_mejoro_id' => optional(User::getCurrentUser()->empleado)->id ?? '',
            'descripcion' => $request->descripcion,
            'beneficios' => $request->beneficios,
            'titulo' => $request->titulo,
            'area_mejora' => $request->area_mejora,
            'proceso_mejora' => $request->proceso_mejora,
            'tipo' => $request->tipo,
            'otro' => $request->otro,
            'estatus' => 'nuevo',
            'sentimientos' => $sentimientos,
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

        $request->validate(
            [
                'titulo' => 'required|max:255',
                'descripcion' => 'required|max:550',
            ],
            [
                'titulo.max' => 'El campo título no puede exceder los 255 caracteres.',
                'descripcion.max' => 'El campo descripción no puede exceder los 550 caracteres.',
            ],
        );

        $sentimientos = SentimentService::analyzeSentiment($request->descripcion);

        $sugerencias = Sugerencias::create([
            'empleado_sugirio_id' => User::getCurrentUser()->empleado->id,

            'area_sugerencias' => $request->area_sugerencias,
            'proceso_sugerencias' => $request->proceso_sugerencias,

            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'estatus' => 'nuevo',
            'sentimientos' => $sentimientos,
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

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

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
            'sentimientos' => $sentimientos,
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

    public function evidenciaSeguridad() {}

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

    public function storeRiesgos(StoreRiesgosRequest $request)
    {
        abort_if(Gate::denies('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $sentimientos = json_encode(SentimentService::analyzeSentiment($request->descripcion));

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
            'sentimientos' => $sentimientos,
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
                    isset($task->level) ? ($task->level = intval($task->level)) : ($task->level = 0);
                    isset($task->collapsed) ? ($task->collapsed = $task->collapsed == 'true' ? true : false) : ($task->collapsed = false);
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
        $user = User::getCurrentUser();

        if ($user->empleado->id != $id_empleado) {
            abort_if(Gate::denies('mi_perfil_mis_datos_ver_expediente'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        }

        $empleado = Empleado::getAll()->find($id_empleado);

        $evidendiasdocumentos = EvidenciasDocumentosEmpleados::getAll();
        $docs_empleado = $evidendiasdocumentos->where('empleado_id', $id_empleado);
        $lista_docs_model = ListaDocumentoEmpleado::getAll();
        $lista_docs = collect();
        foreach ($lista_docs_model as $doc) {
            $documentos_empleado = $evidendiasdocumentos
                ->where('empleado_id', $id_empleado)
                ->where('lista_documentos_empleados_id', $doc->id)
                ->first();
            if ($documentos_empleado) {
                $documento = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $documentos_empleado->id)
                    ->where('archivado', false)
                    ->first();
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

            $lista_docs->push(
                (object) [
                    'id' => $doc->id,
                    'documento' => $doc->documento,
                    'tipo' => $doc->tipo,
                    'empleado' => $documentos_empleado,
                    'ruta_documento' => $doc_viejo,
                    'nombre_doc' => $nombre_doc,
                ],
            );
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

            $doc_viejo = EvidenciaDocumentoEmpleadoArchivo::where('evidencias_documentos_empleados_id', $expediente->id)
                ->where('archivado', false)
                ->first();
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
        // Obtén el valor booleano de 'version' directamente
        $valor = $request->input('version');

        // Asegúrate de que haya un registro en la base de datos
        $ver = VersionesIso::first();

        if ($ver) {
            // Actualiza el registro
            $ver->update(['version_historico' => $valor]);

            return response()->json(['success' => 'Version updated']); // Respuesta de éxito
        } else {
            return response()->json(['error' => 'No version found'], 404); // Respuesta de error
        }
    }

    public function solicitud()
    {
        abort_if(Gate::denies('mi_perfil_modulo_solicitud_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $solicitudes_pendientes = 0;

        return view('admin.inicioUsuario.solicitudesv2', compact('solicitudes_pendientes'));
    }

    public function cambiarEstadoDisponibilidad(Request $request)
    {
        // dd($request);
        $usuario = User::getCurrentUser();
        $empleado = Empleado::getMyEmpleadodata($usuario->empleado->id);

        $cambioED = $empleado->disponibilidad;

        $cambioED->update([
            'disponibilidad' => $request->cambiar,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api\InicioUsuario;

use App\Http\Controllers\Controller;
use App\Models\Activo;
use App\Models\Area;
use App\Models\AuditoriaAnual;
use App\Models\AuditoriaInterna;
use App\Models\Calendario;
use App\Models\CalendarioOficial;
use App\Models\Denuncias;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\FelicitarCumpleaños;
use App\Models\Mejoras;
use App\Models\Organizacion;
use App\Models\PanelInicioRule;
use App\Models\PlanImplementacion;
use App\Models\Puesto;
use App\Models\Quejas;
use App\Models\Recurso;
use App\Models\RevisionDocumento;
use App\Models\RH\Evaluacion;
use App\Models\RH\EvaluadoEvaluador;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\SolicitudVacaciones;
use App\Models\Sugerencias;
use App\Models\User;
use Carbon\Carbon;
use Essa\APIToolKit\Api\ApiResponse;
use Illuminate\Support\Facades\Cache;

class InicioUsuarioController extends Controller
{
    use ApiResponse;

    public function index()
    {
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
            $last_evaluacion = Evaluacion::getAllLatestFirst();
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

        return $this->responseSuccess('Data found successfully', [
            'usuario' => $usuario,
            'usuarioVinculadoConEmpleado' => $usuarioVinculadoConEmpleado,
            'empleado' => $empleado,
            'actividades' => $actividades,
            'contador_actividades' => $contador_actividades,
            'auditorias_anual' => $auditorias_anual,
            'auditoria_internas' => $auditoria_internas,
            'recursos' => $recursos,
            'eventos' => $eventos,
            'oficiales' => $oficiales,
            'cumples_aniversarios' => $cumples_aniversarios,
            'cumpleaños_usuario' => $cumpleaños_usuario,
            'cumpleaños_felicitados_like_contador' => $cumpleaños_felicitados_like_contador,
            'cumpleaños_felicitados_like_usuarios' => $cumpleaños_felicitados_like_usuarios,
            'cumpleaños_felicitados_comentarios' => $cumpleaños_felicitados_comentarios,
            'activos' => $activos,
            'documentos_publicados' => $documentos_publicados,
            'revisiones' => $revisiones,
            'mis_documentos' => $mis_documentos,
            'contador_revisiones' => $contador_revisiones,
            'evaluaciones' => $evaluaciones,
            'mis_evaluaciones' => $mis_evaluaciones,
            'lista_evaluaciones' => $lista_evaluaciones,
            'last_evaluacion' => $last_evaluacion,
            'esLider' => $esLider,
            'equipo_a_cargo' => $equipo_a_cargo,
            'equipo_trabajo' => $equipo_trabajo,
            'supervisor' => $supervisor,
            'mis_objetivos' => $mis_objetivos,
            'panel_rules' => $panel_rules,
            'organizacion' => $organizacion,
            'competencias' => $competencias,
            'mis_quejas' => $mis_quejas,
            'mis_quejas_count' => $mis_quejas_count,
            'mis_denuncias' => $mis_denuncias,
            'mis_denuncias_count' => $mis_denuncias_count,
            'mis_propuestas' => $mis_propuestas,
            'mis_propuestas_count' => $mis_propuestas_count,
            'mis_sugerencias' => $mis_sugerencias,
            'mis_sugerencias_count' => $mis_sugerencias_count,
            'solicitud_vacacion' => $solicitud_vacacion,
            'solicitud_dayoff' => $solicitud_dayoff,
            'solicitud_permiso' => $solicitud_permiso,
            'solicitudes_pendientes' => $solicitudes_pendientes,
            'contador_recursos' => $contador_recursos,
            'existsEmpleado' => $existsEmpleado,
            'existsOrganizacion' => $existsOrganizacion,
            'existsAreas' => $existsAreas,
            'existsPuesto' => $existsPuesto,
            'existsVinculoEmpleadoAdmin' => $existsVinculoEmpleadoAdmin,
        ]);
    }
}

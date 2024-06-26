<?php

namespace App\Http\Controllers\Api\V1\SolicitudPermisoGoceSueldo;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaDayOff as MailRespuestaPermisoGoceSueldo;
use App\Mail\SolicitudPermisoGoceSueldo as MailSolicitudPermisoGoceSueldo;
use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\Organizacion;
use App\Models\PermisosGoceSueldo;
use App\Models\SolicitudPermisoGoceSueldo;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SolicitudPermisoGoceSueldoApiController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'SolicitudPermisoGoceSueldo';

    public function index($id_user)
    {
        //abort_if(Gate::denies('solicitud_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::find($id_user)->empleado->id;

        $solicitudesPermisos = SolicitudPermisoGoceSueldo::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();

        foreach ($solicitudesPermisos as $key_solicitud => $solicitante) {


            switch ($solicitante->aprobacion) {
                case 1:
                    $solicitante->estatus = 'Pendiente';
                    break;
                case 2:
                    $solicitante->estatus = 'Rechazado';
                    break;
                case 3:
                    $solicitante->estatus = 'Aprobado';
                    break;
                default:
                    $solicitante->estatus = 'Sin Seguimiento';
            }

            $solicitante->makeHidden(['aprobacion']);

            if ($solicitante && $solicitante->empleado) {
                $solicitante->empleado->makeHidden([
                    'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                    'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
                ]);

                $solicitante->empleado->nombre_area = $solicitante->empleado->area->area;
                $solicitante->empleado->nombre_puesto = $solicitante->empleado->puesto;

                $solicitante->empleado->makeHidden([
                    'puestoRelacionado', 'area_id', 'puesto_id'
                ]);
            }
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'solicitudesPermisos' => $solicitudesPermisos
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function create($id_user)
    {
        //abort_if(Gate::denies('solicitud_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = new SolicitudPermisoGoceSueldo();
        $autoriza = User::find($id_user)->empleado->supervisor_id;
        $permisos = PermisosGoceSueldo::get();

        return response(json_encode([
            'vacacion' => $vacacion,
            'autoriza' => $autoriza,
            'permisos' => $permisos
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $newSolicitud = $request->input('solicitud');

        $empleado = Empleado::getAll();

        $supervisor = $empleado->find($request->autoriza);
        $solicitante = $empleado->find($request->empleado_id);
        $solicitud = SolicitudPermisoGoceSueldo::create([
            'fecha_inicio' => $newSolicitud['fecha_inicio'],
            'fecha_fin' => $newSolicitud['fecha_fin'],
            'empleado_id' => $newSolicitud['empleado_id'],
            'dias_solicitados' => $newSolicitud['dias_solicitados'],
            'descripcion' => $newSolicitud['descripcion'],
            'año' => $newSolicitud['año'],
            'autoriza' => $newSolicitud['autoriza'],
        ]);

        $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', $this->modelo)->first();

        if (isset($informados->participantes[0]) || isset($informados->usuarios[0])) {

            if (isset($informados->participantes[0])) {
                foreach ($informados->participantes as $participante) {
                    $correos[] = $participante->empleado->email;
                }
            }

            if (isset($informados->usuarios[0])) {
                foreach ($informados->usuarios as $usuario) {
                    $correos[] = $usuario->usuario->email;
                }
            }
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudPermisoGoceSueldo($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudPermisoGoceSueldo($solicitante, $supervisor, $solicitud));
        }
        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect()->route('admin.solicitud-dayoff.index');
        return json_encode(['data' => 'La solicitud fue creada exitosamente.'], 200);
    }

    public function show($id)
    {
        //abort_if(Gate::denies('solicitud_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudPermisoGoceSueldo::with(['empleado', 'permiso'])->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Regla de Day´s Off no asociada');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

        switch ($vacacion->aprobacion) {
            case 1:
                $vacacion->estatus = 'Pendiente';
                break;
            case 2:
                $vacacion->estatus = 'Rechazado';
                break;
            case 3:
                $vacacion->estatus = 'Aprobado';
                break;
            default:
                $vacacion->estatus = 'Sin Seguimiento';
        }

        $vacacion->makeHidden(['aprobacion']);

        if ($vacacion && $vacacion->empleado) {
            $empleado = $vacacion->empleado->makeHidden([
                'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
            ]);

            $empleado->nombre_area = $empleado->area->area;
            $empleado->nombre_puesto = $empleado->puesto;

            $empleado->makeHidden([
                'puestoRelacionado', 'area_id', 'puesto_id'
            ]);

            $vacacion->makeHidden([
                'empleado'
            ]);
        }

        return response(json_encode([
            'vacacion' => $vacacion,
            'empleado' => $empleado
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function edit(Request $request, $id)
    {
    }

    public function update(Request $request, $id)
    {
        //abort_if(Gate::denies('solicitud_permiso_goce_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuestaSolicitud = $request->input('solicitud');

        $solicitud = SolicitudPermisoGoceSueldo::find($id);

        $empleado = Empleado::getAll();

        $supervisor = $empleado->find($respuestaSolicitud['autoriza']);
        $solicitante = $empleado->find($respuestaSolicitud['empleado_id']);

        $solicitud->update([
            'fecha_inicio' => $respuestaSolicitud['fecha_inicio'],
            'fecha_fin' => $respuestaSolicitud['fecha_fin'],
            'empleado_id' => $respuestaSolicitud['empleado_id'],
            'dias_solicitados' => $respuestaSolicitud['dias_solicitados'],
            'año' => $respuestaSolicitud['año'],
            'autoriza' => $respuestaSolicitud['autoriza'],
            'aprobacion' => $respuestaSolicitud['aprobacion'],
        ]);

        $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', $this->modelo)->first();

        if (isset($informados->participantes[0]) || isset($informados->usuarios[0])) {

            if (isset($informados->participantes[0])) {
                foreach ($informados->participantes as $participante) {
                    $correos[] = $participante->empleado->email;
                }
            }

            if (isset($informados->usuarios[0])) {
                foreach ($informados->usuarios as $usuario) {
                    $correos[] = $usuario->usuario->email;
                }
            }
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaPermisoGoceSueldo($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaPermisoGoceSueldo($solicitante, $supervisor, $solicitud));
        }
        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect(route('admin.solicitud-dayoff.aprobacion'));
        return json_encode(['data' => 'Se ha enviado la respuesta de la solicitud.'], 200);
    }

    public function destroy($id_solicitud)
    {
        //abort_if(Gate::denies('solicitud_goce_sueldo_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = SolicitudPermisoGoceSueldo::find($id_solicitud);
        $vacaciones->delete();

        return json_encode(['éxito', 'Solicitud eliminada con éxito'], 200);
    }

    public function aprobacion($id_user)
    {
        //abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = User::find($id_user);
        $data = $usuario->empleado->id;

        $solicitudesPermisos = SolicitudPermisoGoceSueldo::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();

        foreach ($solicitudesPermisos as $key_solicitud => $solicitante) {

            switch ($solicitante->aprobacion) {
                case 1:
                    $solicitante->estatus = 'Pendiente';
                    break;
                case 2:
                    $solicitante->estatus = 'Rechazado';
                    break;
                case 3:
                    $solicitante->estatus = 'Aprobado';
                    break;
                default:
                    $solicitante->estatus = 'Sin Seguimiento';
            }

            $solicitante->makeHidden(['aprobacion']);

            if ($solicitante && $solicitante->empleado) {
                $solicitante->empleado->makeHidden([
                    'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                    'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
                ]);

                $solicitante->empleado->nombre_area = $solicitante->empleado->area->area;
                $solicitante->empleado->nombre_puesto = $solicitante->empleado->puesto;

                $solicitante->empleado->makeHidden([
                    'puestoRelacionado', 'area_id', 'puesto_id'
                ]);
            }
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'solicitudesPermisos' => $solicitudesPermisos
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function respuesta($id)
    {
        //abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudPermisoGoceSueldo::with('empleado')->find($id);

        switch ($vacacion->aprobacion) {
            case 1:
                $vacacion->estatus = 'Pendiente';
                break;
            case 2:
                $vacacion->estatus = 'Rechazado';
                break;
            case 3:
                $vacacion->estatus = 'Aprobado';
                break;
            default:
                $vacacion->estatus = 'Sin Seguimiento';
        }

        $vacacion->makeHidden(['aprobacion']);

        if ($vacacion && $vacacion->empleado) {
            $empleado = $vacacion->empleado->makeHidden([
                'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
            ]);

            $empleado->nombre_area = $empleado->area->area;
            $empleado->nombre_puesto = $empleado->puesto;

            $empleado->makeHidden([
                'puestoRelacionado', 'area_id', 'puesto_id'
            ]);

            $vacacion->makeHidden([
                'empleado'
            ]);
        }

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }
        $solicitante = $vacacion->empleado_id;
        $ingreso = Empleado::where('id', $solicitante)->pluck('antiguedad')->first();
        $año = Carbon::createFromDate($ingreso)->age;

        return response(json_encode([
            'empleado' => $empleado,
            'vacacion' => $vacacion,
            'año' => $año
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function archivo($id_usuario)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::find($id_usuario)->empleado->id;

        $solicitudesPermisos = SolicitudPermisoGoceSueldo::with('empleado')
            ->where('empleado_id', '=', $data)
            ->where('aprobacion', '=', 2)
            ->orwhere('aprobacion', '=', 3)
            ->orderByDesc('id')
            ->get();

        foreach ($solicitudesPermisos as $key_solicitud => $solicitante) {

            switch ($solicitante->aprobacion) {
                case 1:
                    $solicitante->estatus = 'Pendiente';
                    break;
                case 2:
                    $solicitante->estatus = 'Rechazado';
                    break;
                case 3:
                    $solicitante->estatus = 'Aprobado';
                    break;
                default:
                    $solicitante->estatus = 'Sin Seguimiento';
            }

            $solicitante->makeHidden(['aprobacion']);
            if ($solicitante && $solicitante->empleado) {
                $solicitante->empleado->makeHidden([
                    'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                    'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
                ]);

                $solicitante->empleado->nombre_area = $solicitante->empleado->area->area;
                $solicitante->empleado->nombre_puesto = $solicitante->empleado->puesto;

                $solicitante->empleado->makeHidden([
                    'puestoRelacionado', 'area_id', 'puesto_id'
                ]);
            }
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'solicitudesPermisos' => $solicitudesPermisos
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function showVistaGlobal($id)
    {
        // abort_if(Gate::denies('reglas_dayoff_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudPermisoGoceSueldo::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

        switch ($vacacion->aprobacion) {
            case 1:
                $vacacion->estatus = 'Pendiente';
                break;
            case 2:
                $vacacion->estatus = 'Rechazado';
                break;
            case 3:
                $vacacion->estatus = 'Aprobado';
                break;
            default:
                $vacacion->estatus = 'Sin Seguimiento';
        }

        $vacacion->makeHidden(['aprobacion']);

        $vacacion->empleado->makeHidden([
            'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
            'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
        ]);

        $vacacion->empleado->nombre_area = $vacacion->empleado->area->area;
        $vacacion->empleado->nombre_puesto = $vacacion->empleado->puesto;

        $vacacion->empleado->makeHidden([
            'puestoRelacionado', 'area_id', 'puesto_id'
        ]);

        return response(json_encode([
            'vacacion' => $vacacion,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function showArchivo($id)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudPermisoGoceSueldo::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

        switch ($vacacion->aprobacion) {
            case 1:
                $vacacion->estatus = 'Pendiente';
                break;
            case 2:
                $vacacion->estatus = 'Rechazado';
                break;
            case 3:
                $vacacion->estatus = 'Aprobado';
                break;
            default:
                $vacacion->estatus = 'Sin Seguimiento';
        }

        $vacacion->makeHidden(['aprobacion']);

        $vacacion->empleado->makeHidden([
            'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
            'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor'
        ]);

        $vacacion->empleado->nombre_area = $vacacion->empleado->area->area;
        $vacacion->empleado->nombre_puesto = $vacacion->empleado->puesto;

        $vacacion->empleado->makeHidden([
            'puestoRelacionado', 'area_id', 'puesto_id'
        ]);

        return response(json_encode([
            'vacacion' => $vacacion,
        ]), 200)->header('Content-Type', 'application/json');
    }
}

<?php

namespace App\Http\Controllers\Api\Mobile\SolicitudPermisoGoceSueldo;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaDayOff as MailRespuestaPermisoGoceSueldo;
use App\Mail\SolicitudPermisoGoceSueldo as MailSolicitudPermisoGoceSueldo;
use App\Models\Empleado;
use App\Models\ListaInformativa;
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

class tbApiMobileControllerSolicitudPermisoGoceSueldo extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'SolicitudPermisoGoceSueldo';

    public function index()
    {
        //abort_if(Gate::denies('solicitud_goce_sueldo_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser();

        $solicitudesPermisos = SolicitudPermisoGoceSueldo::with('empleado')->where('empleado_id', '=', $data->empleado->id)->orderByDesc('id')->get();

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
                    'avatar',
                    'avatar_ruta',
                    'resourceId',
                    'empleados_misma_area',
                    'genero_formateado',
                    'puesto',
                    'declaraciones_responsable',
                    'declaraciones_aprobador',
                    'declaraciones_responsable2022',
                    'declaraciones_aprobador2022',
                    'fecha_ingreso',
                    'saludo',
                    'saludo_completo',
                    'actual_birdthday',
                    'actual_aniversary',
                    'obtener_antiguedad',
                    'empleados_pares',
                    'competencias_asignadas',
                    'objetivos_asignados',
                    'es_supervisor',
                    'fecha_min_timesheet',
                    'area',
                    'supervisor',
                ]);

                $solicitante->empleado->nombre_area = $solicitante->empleado->area->area;
                $solicitante->empleado->nombre_puesto = $solicitante->empleado->puesto;

                $solicitante->empleado->makeHidden([
                    'puestoRelacionado',
                    'area_id',
                    'puesto_id',
                ]);
            }
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'solicitudesPermisos' => $solicitudesPermisos,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function catalogoPermisos()
    {
        //abort_if(Gate::denies('solicitud_goce_sueldo_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $vacacion = new SolicitudPermisoGoceSueldo();
        // $autoriza = User::getCurrentUser();
        $permisos = PermisosGoceSueldo::get()->makeHidden([
            'created_at',
            'updated_at',
            'deleted_at',
        ]);

        foreach ($permisos as $key => $permiso) {
            if ($permiso->tipo_permiso == 1) {
                $permiso->categoria_permisos = 'Permisos conforme a la ley';
            } elseif ($permiso->tipo_permiso == 2) {
                $permiso->categoria_permisos = 'Permisos otorgados por la empresa';
            } else {
                $permiso->categoria_permisos = 'No definido';
            }
        }

        return response(json_encode([
            // 'vacacion' => $vacacion,
            // 'autoriza' => $autoriza,
            'permisos' => $permisos,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $newSolicitud = $request->input('solicitud');

        $empleados = Empleado::getAll();

        $solicitante = $empleados->find($newSolicitud['empleado_id']);
        $supervisor = $empleados->find($solicitante->supervisor_id);

        $solicitud = SolicitudPermisoGoceSueldo::create([
            'fecha_inicio' => $newSolicitud['fecha_inicio'],
            'fecha_fin' => $newSolicitud['fecha_fin'],
            'empleado_id' => $solicitante->id,
            'dias_solicitados' => $newSolicitud['dias_solicitados'],
            'descripcion' => $newSolicitud['descripcion'],
            'autoriza' => $supervisor->id,
            'permiso_id' => $newSolicitud['permiso_id'],
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
                'avatar',
                'avatar_ruta',
                'resourceId',
                'empleados_misma_area',
                'genero_formateado',
                'puesto',
                'declaraciones_responsable',
                'declaraciones_aprobador',
                'declaraciones_responsable2022',
                'declaraciones_aprobador2022',
                'fecha_ingreso',
                'saludo',
                'saludo_completo',
                'actual_birdthday',
                'actual_aniversary',
                'obtener_antiguedad',
                'empleados_pares',
                'competencias_asignadas',
                'objetivos_asignados',
                'es_supervisor',
                'fecha_min_timesheet',
                'area',
                'supervisor',
            ]);

            if ($empleado->foto == null || $empleado->foto == '0') {
                if ($empleado->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($empleado->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/'.$empleado->foto);
            }

            // Encode spaces in the URL
            $empleado->ruta_foto = $this->encodeSpecialCharacters($ruta);

            $empleado->id_area = $empleado->area->id;
            $empleado->nombre_area = $empleado->area->area;
            $empleado->id_puesto = $empleado->puestoRelacionado->id;
            $empleado->nombre_puesto = $empleado->puesto;

            $empleado->makeHidden([
                'puestoRelacionado',
                'area_id',
                'puesto_id',
                'foto',
            ]);

            $vacacion->makeHidden([
                'empleado',
            ]);
        }

        return response(json_encode([
            'vacacion' => $vacacion,
            'empleado' => $empleado,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function edit(Request $request, $id) {}

    public function update(Request $request, $id)
    {
        //abort_if(Gate::denies('solicitud_permiso_goce_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuestaSolicitud = $request->input('solicitud');

        $solicitud = SolicitudPermisoGoceSueldo::find($id);

        $usuario = User::getCurrentUser();
        $empleado = Empleado::getAll();

        $supervisor = $empleado->find($usuario->empleado->id);
        $solicitante = $empleado->find($solicitud->empleado_id);

        $solicitud->update([
            'aprobacion' => $respuestaSolicitud['aprobacion'],
            'comentarios_aprobador' => $respuestaSolicitud['comentarios_aprobador'],
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

    public function encodeSpecialCharacters($url)
    {
        // Handle spaces
        // $url = str_replace(' ', '%20', $url);
        // Encode other special characters, excluding /, \, and :
        $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
            return rawurlencode($matches[0]);
        }, $url);

        return $url;
    }

    public function aprobacion()
    {
        //abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $data = User::getCurrentUser()->empleado->id;

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
                    'avatar',
                    'avatar_ruta',
                    'resourceId',
                    'empleados_misma_area',
                    'genero_formateado',
                    'puesto',
                    'declaraciones_responsable',
                    'declaraciones_aprobador',
                    'declaraciones_responsable2022',
                    'declaraciones_aprobador2022',
                    'fecha_ingreso',
                    'saludo',
                    'saludo_completo',
                    'actual_birdthday',
                    'actual_aniversary',
                    'obtener_antiguedad',
                    'empleados_pares',
                    'competencias_asignadas',
                    'objetivos_asignados',
                    'es_supervisor',
                    'fecha_min_timesheet',
                    'area',
                    'supervisor',
                ]);

                if ($solicitante->foto == null || $solicitante->foto == '0') {
                    if ($solicitante->genero == 'H') {
                        $ruta = asset('storage/empleados/imagenes/man.png');
                    } elseif ($solicitante->genero == 'M') {
                        $ruta = asset('storage/empleados/imagenes/woman.png');
                    } else {
                        $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                    }
                } else {
                    $ruta = asset('storage/empleados/imagenes/'.$solicitante->foto);
                }

                // Encode spaces in the URL
                $solicitante->empleado->ruta_foto = $this->encodeSpecialCharacters($ruta);

                $solicitante->empleado->id_area = $solicitante->empleado->area->id;
                $solicitante->empleado->nombre_area = $solicitante->empleado->area->area;
                $solicitante->empleado->id_puesto = $solicitante->empleado->puestoRelacionado->id;
                $solicitante->empleado->nombre_puesto = $solicitante->empleado->puesto;

                $solicitante->empleado->makeHidden([
                    'puestoRelacionado',
                    'area_id',
                    'puesto_id',
                ]);
            }
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'solicitudesPermisos' => $solicitudesPermisos,
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
                'avatar',
                'avatar_ruta',
                'resourceId',
                'empleados_misma_area',
                'genero_formateado',
                'puesto',
                'declaraciones_responsable',
                'declaraciones_aprobador',
                'declaraciones_responsable2022',
                'declaraciones_aprobador2022',
                'fecha_ingreso',
                'saludo',
                'saludo_completo',
                'actual_birdthday',
                'actual_aniversary',
                'obtener_antiguedad',
                'empleados_pares',
                'competencias_asignadas',
                'objetivos_asignados',
                'es_supervisor',
                'fecha_min_timesheet',
                'area',
                'supervisor',
            ]);

            if ($empleado->foto == null || $empleado->foto == '0') {
                if ($empleado->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($empleado->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/'.$empleado->foto);
            }

            $empleado->ruta_foto = $this->encodeSpecialCharacters($ruta);

            $empleado->nombre_area = $empleado->area->area;
            $empleado->nombre_puesto = $empleado->puesto;

            $empleado->makeHidden([
                'puestoRelacionado',
                'area_id',
                'puesto_id',
            ]);

            $vacacion->makeHidden([
                'empleado',
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
            'año' => $año,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function archivo()
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

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
                    'avatar',
                    'avatar_ruta',
                    'resourceId',
                    'empleados_misma_area',
                    'genero_formateado',
                    'puesto',
                    'declaraciones_responsable',
                    'declaraciones_aprobador',
                    'declaraciones_responsable2022',
                    'declaraciones_aprobador2022',
                    'fecha_ingreso',
                    'saludo',
                    'saludo_completo',
                    'actual_birdthday',
                    'actual_aniversary',
                    'obtener_antiguedad',
                    'empleados_pares',
                    'competencias_asignadas',
                    'objetivos_asignados',
                    'es_supervisor',
                    'fecha_min_timesheet',
                    'area',
                    'supervisor',
                ]);

                $solicitante->empleado->nombre_area = $solicitante->empleado->area->area;
                $solicitante->empleado->nombre_puesto = $solicitante->empleado->puesto;

                $solicitante->empleado->makeHidden([
                    'puestoRelacionado',
                    'area_id',
                    'puesto_id',
                ]);
            }
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'solicitudesPermisos' => $solicitudesPermisos,
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
            'avatar',
            'avatar_ruta',
            'resourceId',
            'empleados_misma_area',
            'genero_formateado',
            'puesto',
            'declaraciones_responsable',
            'declaraciones_aprobador',
            'declaraciones_responsable2022',
            'declaraciones_aprobador2022',
            'fecha_ingreso',
            'saludo',
            'saludo_completo',
            'actual_birdthday',
            'actual_aniversary',
            'obtener_antiguedad',
            'empleados_pares',
            'competencias_asignadas',
            'objetivos_asignados',
            'es_supervisor',
            'fecha_min_timesheet',
            'area',
            'supervisor',
        ]);

        $vacacion->empleado->nombre_area = $vacacion->empleado->area->area;
        $vacacion->empleado->nombre_puesto = $vacacion->empleado->puesto;

        $vacacion->empleado->makeHidden([
            'puestoRelacionado',
            'area_id',
            'puesto_id',
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
            'avatar',
            'avatar_ruta',
            'resourceId',
            'empleados_misma_area',
            'genero_formateado',
            'puesto',
            'declaraciones_responsable',
            'declaraciones_aprobador',
            'declaraciones_responsable2022',
            'declaraciones_aprobador2022',
            'fecha_ingreso',
            'saludo',
            'saludo_completo',
            'actual_birdthday',
            'actual_aniversary',
            'obtener_antiguedad',
            'empleados_pares',
            'competencias_asignadas',
            'objetivos_asignados',
            'es_supervisor',
            'fecha_min_timesheet',
            'area',
            'supervisor',
        ]);

        $vacacion->empleado->nombre_area = $vacacion->empleado->area->area;
        $vacacion->empleado->nombre_puesto = $vacacion->empleado->puesto;

        $vacacion->empleado->makeHidden([
            'puestoRelacionado',
            'area_id',
            'puesto_id',
        ]);

        return response(json_encode([
            'vacacion' => $vacacion,
        ]), 200)->header('Content-Type', 'application/json');
    }
}

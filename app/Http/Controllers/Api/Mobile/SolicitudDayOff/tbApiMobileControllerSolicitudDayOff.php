<?php

namespace App\Http\Controllers\Api\Mobile\SolicitudDayOff;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaDayOff as MailRespuestaDayoff;
use App\Mail\SolicitudDayOff as MailSolicitudDayoff;
use App\Models\DayOff;
use App\Models\Empleado;
use App\Models\IncidentesDayoff;
use App\Models\ListaInformativa;
use App\Models\SolicitudDayOff;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class tbApiMobileControllerSolicitudDayOff extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'SolicitudDayOff';

    public function tbFunctionIndex()
    {
        // abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = User::getCurrentUser();
        $data = $usuario->empleado->id;

        $año = Carbon::now()->format('Y');
        $finDayOff = '31-12-'.$año;

        $solicitudesDayOff = SolicitudDayOff::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();

        foreach ($solicitudesDayOff as $key_solicitud => $solicitante) {

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

        $dias_disponibles_date = $this->diasDisponibles();
        if ($dias_disponibles_date > 0) {
            $dias_disponibles = $this->diasDisponibles();
        } else {
            $dias_disponibles = 0;
        }

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'dias_disponibles' => $dias_disponibles,
            'finDayOff' => $finDayOff,
            'solicitudesDayOff' => $solicitudesDayOff,
        ]), 200)->header('Content-Type', 'application/json');

        // return view('admin.solicitudDayoff.index', compact('logo_actual', 'empresa_actual', 'dias_disponibles'));
    }

    public function tbFunctionStore(Request $request)
    {
        // abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $newSolicitud = $request->input('solicitud');

        $empleados = Empleado::getAll();

        $solicitante = $empleados->find($newSolicitud['empleado_id']);
        $supervisor = $empleados->find($solicitante->supervisor_id);

        $ingreso = Carbon::parse($solicitante->antiguedad);
        $año = Carbon::createFromDate($ingreso)->age;

        $solicitud = SolicitudDayOff::create([
            'fecha_inicio' => $newSolicitud['fecha_inicio'],
            'fecha_fin' => $newSolicitud['fecha_fin'],
            'empleado_id' => $solicitante->id,
            'dias_solicitados' => $newSolicitud['dias_solicitados'],
            'año' => $año,
            'descripcion' => $newSolicitud['descripcion'],
            'autoriza' => $supervisor->id,
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
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudDayOff($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudDayOff($solicitante, $supervisor, $solicitud));
        }

        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect()->route('admin.solicitud-dayoff.index');
        return json_encode(['data' => 'La solicitud fue creada exitosamente.'], 200);
    }

    public function tbFunctionShow($id)
    {
        // abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudDayOff::with('empleado')->find($id);

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

        if (empty($vacacion)) {
            Alert::warning('warning', 'Regla de Day´s Off no asociada');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

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
        // return view('admin.solicitudDayoff.show', compact('vacacion'));
    }

    public function tbFunctionUpdate(Request $request, $id)
    {
        // abort_if(Gate::denies('solicitud_dayoff_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuestaSolicitud = $request->input('solicitud');
        $usuario = User::getCurrentUser();
        $solicitud = SolicitudDayOff::find($id);

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
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaDayOff($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaDayOff($solicitante, $supervisor, $solicitud));
        }

        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect(route('admin.solicitud-dayoff.aprobacion'));
        return json_encode(['data' => 'Se ha enviado la respuesta de la solicitud.'], 200);
    }

    public function tbFunctionDestroy($id_solicitud)
    {
        // abort_if(Gate::denies('solicitud_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = SolicitudDayOff::find($id_solicitud);
        $vacaciones->delete();

        return json_encode(['éxito', 'Solicitud eliminada con éxito'], 200);
    }

    public function filtrado_empleados($efecto, $usuario, $año)
    {
        // Sacamos los ids del empleado
        $areaId = $usuario->empleado->area_id;
        $puestoId = $usuario->empleado->puesto_id;
        $idempleado = $usuario->empleado->id;

        // Preparamos los querys que se van a utilizar, buscando si existe coincidencia con el area, puesto o id del empleado
        $queryArea = IncidentesDayoff::where('efecto', $efecto)->where('aniversario', $año)
            ->whereHas('areas', function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            });

        $queryPuesto = IncidentesDayoff::where('efecto', $efecto)->where('aniversario', $año)
            ->whereHas('puestos', function ($query) use ($puestoId) {
                $query->where('puesto_id', $puestoId);
            });

        $queryEmpleado = IncidentesDayoff::where('efecto', $efecto)->where('aniversario', $año)
            ->whereHas('empleados', function ($q) use ($idempleado) {
                $q->where('empleado_id', $idempleado);
            });

        // Se realizan las consultas buscando coincidencias por jerarquia, 1ro area, 2do puesto
        // y 3ro empleado, de no existir ninguna se manda 0
        if (($queryArea->get())->isNotEmpty()) {
            $dias = $queryArea->pluck('dias_aplicados')->sum();

            return $dias;
        } elseif (($queryPuesto->get())->isNotEmpty()) {
            $dias = $queryPuesto->pluck('dias_aplicados')->sum();

            return $dias;
        } elseif (($queryEmpleado->get())->isNotEmpty()) {
            $dias = $queryEmpleado->pluck('dias_aplicados')->sum();

            return $dias;
        } else {
            $dias = 0;

            return $dias;
        }
    }

    public function diasDisponibles()
    {
        $año = Carbon::now()->format('Y');
        $existe_regla_ingreso = DayOff::where('inicio_conteo', 1)->exists();

        $usuario = User::getCurrentUser();
        if ($existe_regla_ingreso) {
            $existe_regla_por_area = DayOff::where('inicio_conteo', '=', 1)->where('afectados', 2)->whereHas('areas', function ($q) use ($usuario) {
                $q->where('area_id', $usuario->empleado->area_id);
            })->select('dias', 'tipo_conteo')->exists();
            $existe_regla_toda_empresa = DayOff::where('inicio_conteo', 1)->where('afectados', 1)->select('dias', 'tipo_conteo')->exists();
            if ($existe_regla_toda_empresa) {
                $regla_aplicada = DayOff::where('inicio_conteo', 1)->where('afectados', 1)->pluck('dias')->first();
            } elseif ($existe_regla_por_area) {
                $regla_aplicada = DayOff::where('inicio_conteo', '=', 1)->whereHas('areas', function ($q) use ($usuario) {
                    $q->where('area_id', $usuario->empleado->area_id);
                })->pluck('dias')->first();
            } else {
                return 0;
            }
        } else {
            return 0;
        }
        $dias_otorgados = $regla_aplicada;
        $dias_extra = $this->filtrado_empleados(1, $usuario, $año);
        $dias_restados = $this->filtrado_empleados(2, $usuario, $año);
        // $dias_extra = IncidentesDayoff::where('efecto', 1)->where('aniversario', $año)->whereHas('empleados', function ($q) use ($usuario) {
        //     $q->where('empleado_id', $usuario->empleado->id);
        // })->pluck('dias_aplicados')->sum();
        // $dias_restados = IncidentesDayoff::where('efecto', 2)->where('aniversario', $año)->whereHas('empleados', function ($q) use ($usuario) {
        //     $q->where('empleado_id', $usuario->empleado->id);
        // })->pluck('dias_aplicados')->sum();

        $dias_gastados = SolicitudDayOff::where('empleado_id', $usuario->empleado->id)->where('año', '=', $año)->where(function ($query) {
            $query->where('aprobacion', '=', 1)
                ->orwhere('aprobacion', '=', 3);
        })->sum('dias_solicitados');
        $dias_disponibles = $dias_otorgados - $dias_gastados + $dias_extra - $dias_restados;

        return $dias_disponibles;
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

    public function tbFunctionAprobacion()
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $usuario = User::getCurrentUser();
        $data = $usuario->empleado->id;

        $solicitudesPermisos = SolicitudDayOff::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();

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

        $dias_disponibles_date = $this->diasDisponibles();
        if ($dias_disponibles_date > 0) {
            $dias_disponibles = $this->diasDisponibles();
        } else {
            $dias_disponibles = 0;
        }

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'dias_disponibles' => $dias_disponibles,
            'solicitudesPermisos' => $solicitudesPermisos,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionRespuesta($id)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

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

        // return view('admin.solicitudDayoff.respuesta', compact('vacacion', 'año'));
    }

    public function tbFunctionArchivo()
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        $solicitudesDayOff = SolicitudDayOff::with('empleado')
            ->where('empleado_id', '=', $data)
            ->where('aprobacion', '=', 2)
            ->orwhere('aprobacion', '=', 3)
            ->orderByDesc('id')
            ->get();

        foreach ($solicitudesDayOff as $key_solicitud => $solicitante) {

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
            'solicitudesDayOff' => $solicitudesDayOff,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionVistaGlobal()
    {
        // abort_if(Gate::denies('reglas_vacaciones_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $data = User::getCurrentUser()->empleado->id;

        $solVac = SolicitudDayOff::getAllwithEmpleados();

        foreach ($solVac as $key_solicitud => $solicitante) {

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
            'solVac' => $solVac,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionShowVistaGlobal($id)
    {
        // abort_if(Gate::denies('reglas_dayoff_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

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

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

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

    public function tbFunctionShowArchivo($id)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

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

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

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

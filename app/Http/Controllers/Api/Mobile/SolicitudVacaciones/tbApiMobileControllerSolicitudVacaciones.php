<?php

namespace App\Http\Controllers\Api\Mobile\SolicitudVacaciones;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaVacaciones as MailRespuestaVacaciones;
use App\Mail\SolicitudVacaciones as MailSolicitudVacaciones;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\IncidentesVacaciones;
use App\Models\ListaInformativa;
use App\Models\Organizacion;
use App\Models\Puesto;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudVacaciones;
use App\Models\User;
use App\Models\Vacaciones;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class tbApiMobileControllerSolicitudVacaciones extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'SolicitudVacaciones';

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

    public function tbFunctionIndex()
    {
        // abort_if(Gate::denies('solicitud_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = User::getCurrentUser();
        $data = $usuario->empleado->id;

        $solicitudesVacaciones = SolicitudVacaciones::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();

        foreach ($solicitudesVacaciones as $key_solicitud => $solicitante) {

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

        $dias_disponibles_date = $this->tbFunctionDiasDisponibles();
        if ($dias_disponibles_date > 0) {
            $dias_disponibles = $this->tbFunctionDiasDisponibles();
        } else {
            $dias_disponibles = 0;
        }

        $ingreso = Carbon::parse($usuario->empleado->antiguedad);
        $año = Carbon::createFromDate($ingreso)->age;
        $inicio_vacaciones = $ingreso->addYear();
        $finVacaciones = $inicio_vacaciones->addYear($año);
        $finVacaciones = $finVacaciones->format('d-m-Y');

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'dias_disponibles' => $dias_disponibles,
            'finVacaciones' => $finVacaciones,
            'solicitudesVacaciones' => $solicitudesVacaciones,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionCreate()
    {
        $usuario = User::getCurrentUser();
        // abort_if(Gate::denies('solicitud_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ingreso = Carbon::parse($usuario->empleado->antiguedad);
        $dia_hoy = Carbon::now();
        $no_vacaciones = $ingreso->format('d-m-Y');
        $año = Carbon::createFromDate($ingreso)->age;
        $seis_meses = ($dia_hoy->diffInMonths($ingreso));

        if ($año == 0 and $seis_meses >= 6) {
            $leyenda_sin_beneficio = false;
            $año = 1;
        } elseif ($año == 0 and $seis_meses < 6) {
            $leyenda_sin_beneficio = true;
            $año = 1;
        } else {
            $leyenda_sin_beneficio = false;
        }

        //  Determina si existe regla asociada
        $existe_regla_por_area = Vacaciones::where('inicio_conteo', '=', $año)->whereHas('areas', function ($q) use ($usuario) {
            $q->where('area_id', $usuario->empleado->area_id);
        })->select('dias', 'tipo_conteo')->exists();
        $existe_regla_toda_empresa = Vacaciones::where('inicio_conteo', $año)->where('afectados', 1)->select('dias', 'tipo_conteo')->exists();

        if ($seis_meses >= 6) {
            if ($existe_regla_toda_empresa) {
                $regla_aplicada = Vacaciones::where('inicio_conteo', $año)->where('afectados', 1)->select('dias', 'tipo_conteo')->first();
            } elseif ($existe_regla_por_area) {
                $regla_aplicada = Vacaciones::where('inicio_conteo', '=', $año)->whereHas('areas', function ($q) use ($usuario) {
                    $q->where('area_id', $usuario->empleado->area_id);
                })->select('dias', 'tipo_conteo')->first();
            } else {
                Alert::warning('warning', 'Data not found');

                return redirect(route('admin.solicitud-vacaciones.index'));
            }
            // Inician vacaciones a los 6 meses
        } else {
            $tipo_conteo = null;
            $fecha_limite = Vacaciones::where('inicio_conteo', '=', $año)->pluck('fin_conteo')->first();
            $inicio_vacaciones = $ingreso->addYear();
            $finVacaciones = $inicio_vacaciones->addYear($año);
            $finVacaciones = $finVacaciones->format('d-m-Y');
            $autoriza = $usuario->empleado->supervisor_id;
            $vacacion = new SolicitudVacaciones;
            $dias_disponibles = null;
            $organizacion = Organizacion::getFirst();
            $dias_pendientes = null;
            $mostrar_reclamo = false;
            $año_pasado = 0;
            $periodo_vencido = 0;
            $finVacaciones_periodo_pasado = null;

            return response(json_encode([
                'leyenda_sin_beneficio' => $leyenda_sin_beneficio,
                'vacacion' => $vacacion,
                'dias_disponibles' => $dias_disponibles,
                'año' => $año,
                'autoriza' => $autoriza,
                'no_vacaciones' => $no_vacaciones,
                'organizacion' => $organizacion,
                'finVacaciones' => $finVacaciones,
                'dias_pendientes' => $dias_pendientes,
                'tipo_conteo' => $tipo_conteo,
                'mostrar_reclamo' => $mostrar_reclamo,
                'periodo_vencido' => $periodo_vencido,
                'año_pasado' => $año_pasado,
                'finVacaciones_periodo_pasado' => $finVacaciones_periodo_pasado,
            ]), 200)->header('Content-Type', 'application/json');
        }

        $tipo_conteo = $regla_aplicada->tipo_conteo;
        $fecha_limite = Vacaciones::where('inicio_conteo', '=', $año)->pluck('fin_conteo')->first();
        $inicio_vacaciones = $ingreso->addYear();
        $finVacaciones = $inicio_vacaciones->addYear($año);
        $finVacaciones = $finVacaciones->format('d-m-Y');
        $autoriza = $usuario->empleado->supervisor_id;
        $vacacion = new SolicitudVacaciones;

        $dias_disponibles = $this->tbFunctionDiasDisponibles();
        $organizacion = Organizacion::getFirst();
        $dias_pendientes = SolicitudVacaciones::where('empleado_id', '=', $usuario->empleado->id)->where('aprobacion', '=', 1)->where('año', '=', $año)->sum('dias_solicitados');

        // Funcion para dias dias disponibles año pasado
        $año_pasado = $this->tbFunctionDiasDisponiblesAñoPasado();
        if ($año_pasado == 0) {
            $mostrar_reclamo = false;
            $periodo_vencido = 0;
            $finVacaciones_periodo_pasado = null;
        } elseif ($año_pasado > 0) {
            $periodo_vencido = $año - 1;
            $finVacaciones_periodo_pasado = $inicio_vacaciones->addMonths(6);
            $finVacaciones_periodo_pasado = $finVacaciones_periodo_pasado->subYear();
            //    $finVacaciones_periodo_pasado = $finVacaciones_periodo_pasado->format('d-m-Y');

            //    $mostrar_reclamo = true;

            if ($finVacaciones_periodo_pasado >= $dia_hoy) {
                $mostrar_reclamo = true;
                $finVacaciones_periodo_pasado = $finVacaciones_periodo_pasado->format('d-m-Y');
            } else {
                $mostrar_reclamo = false;
            }
            //    dd($mostrar_reclamo);
        } else {
            $mostrar_reclamo = false;
            $periodo_vencido = 0;
            $finVacaciones_periodo_pasado = null;
        }

        return response(json_encode([
            'leyenda_sin_beneficio' => $leyenda_sin_beneficio,
            'vacacion' => $vacacion,
            'dias_disponibles' => $dias_disponibles,
            'año' => $año,
            'autoriza' => $autoriza,
            'no_vacaciones' => $no_vacaciones,
            'organizacion' => $organizacion,
            'finVacaciones' => $finVacaciones,
            'dias_pendientes' => $dias_pendientes,
            'tipo_conteo' => $tipo_conteo,
            'mostrar_reclamo' => $mostrar_reclamo,
            'periodo_vencido' => $periodo_vencido,
            'año_pasado' => $año_pasado,
            'finVacaciones_periodo_pasado' => $finVacaciones_periodo_pasado,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionStore(Request $request)
    {
        // abort_if(Gate::denies('solicitud_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $newSolicitud = $request->input('solicitud');
        $empleados = Empleado::getAll();

        $solicitante = $empleados->find($newSolicitud['empleado_id']);
        $supervisor = $empleados->find($solicitante->supervisor_id);

        $ingreso = Carbon::parse($solicitante->antiguedad);
        $año = Carbon::createFromDate($ingreso)->age;

        $solicitud = SolicitudVacaciones::create([
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
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudVacaciones($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudVacaciones($solicitante, $supervisor, $solicitud));
        }

        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect()->route('admin.solicitud-vacaciones.index');
        return json_encode(['data' => 'La solicitud fue creada exitosamente.'], 200);
    }

    public function tbFunctionShow($id)
    {
        // abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

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
        // abort_if(Gate::denies('solicitud_vacaciones_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuestaSolicitud = $request->input('solicitud');
        $solicitud = SolicitudVacaciones::find($id);
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
            Mail::to(trim(removeUnicodeCharacters($solicitante->email)))->queue(new MailRespuestaVacaciones($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(trim(removeUnicodeCharacters($solicitante->email)))->queue(new MailRespuestaVacaciones($solicitante, $supervisor, $solicitud));
        }

        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect(route('admin.solicitud-vacaciones.aprobacion'));
        return json_encode(['data' => 'Se ha enviado la respuesta de la solicitud.'], 200);
    }

    public function tbFunctionDestroy($id_solicitud)
    {
        // abort_if(Gate::denies('solicitud_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = SolicitudVacaciones::find($id_solicitud);
        $vacaciones->delete();

        return json_encode(['éxito', 'Solicitud eliminada con éxito'], 200);
    }

    public function tbFunctionMassDestroy(Request $request)
    {
        SolicitudVacaciones::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function tbFunctionFiltradoEmpleados($efecto, $usuario, $año)
    {
        // Sacamos los ids del empleado
        $areaId = $usuario->empleado->area_id;
        $puestoId = $usuario->empleado->puesto_id;
        $idempleado = $usuario->empleado->id;

        // Preparamos los querys que se van a utilizar, buscando si existe coincidencia con el area, puesto o id del empleado
        $queryArea = IncidentesVacaciones::where('efecto', $efecto)->where('aniversario', $año)
            ->whereHas('areas', function ($query) use ($areaId) {
                $query->where('area_id', $areaId);
            });

        $queryPuesto = IncidentesVacaciones::where('efecto', $efecto)->where('aniversario', $año)
            ->whereHas('puestos', function ($query) use ($puestoId) {
                $query->where('puesto_id', $puestoId);
            });

        $queryEmpleado = IncidentesVacaciones::where('efecto', $efecto)->where('aniversario', $año)
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

    public function tbFunctionDiasDisponibles()
    {
        $usuario = User::getCurrentUser();
        $ingreso = $usuario->empleado->antiguedad;
        $año = Carbon::createFromDate($ingreso)->age;

        if ($año == 0) {
            $medio_año = true;
            $año = 1;
        } else {
            $medio_año = false;
        }

        if ($año >= 1) {
            $dias_otorgados = Vacaciones::where('inicio_conteo', '=', $año)->pluck('dias')->first();

            // Se llama a la nueva función, con los parametros de efecto(1-suma y/o 2-resta), el usuario y el año)
            $dias_extra = $this->tbFunctionFiltradoEmpleados(1, $usuario, $año);
            $dias_restados = $this->tbFunctionFiltradoEmpleados(2, $usuario, $año);
            // funcion anterior
            // $dias_extra = IncidentesVacaciones::where('efecto', 1)->where('aniversario', $año)->whereHas('empleados', function ($q) use ($usuario) {
            //     $q->where('empleado_id', $usuario->empleado->id);
            // })->pluck('dias_aplicados')->sum();
            // $dias_restados = IncidentesVacaciones::where('efecto', 2)->where('aniversario', $año)->whereHas('empleados', function ($q) use ($usuario) {
            //     $q->where('empleado_id', $usuario->empleado->id);
            // })->pluck('dias_aplicados')->sum();

            $dias_gastados = SolicitudVacaciones::where('empleado_id', $usuario->empleado->id)->where('año', '=', $año)->where(function ($query) {
                $query->where('aprobacion', '=', 1)
                    ->orwhere('aprobacion', '=', 3);
            })->sum('dias_solicitados');

            if ($medio_año == true) {
                $dias_otorgados = $dias_otorgados / 2;
            }

            $dias_disponibles = $dias_otorgados - $dias_gastados + $dias_extra - $dias_restados;

            return $dias_disponibles;
        } else {
            return null;
        }
    }

    public function tbFunctionDiasDisponiblesAñoPasado()
    {
        $usuario = User::getCurrentUser();
        $ingreso = $usuario->empleado->antiguedad;
        $año_actual = Carbon::createFromDate($ingreso)->age;
        $año = $año_actual - 1;

        if ($año >= 1) {
            $dias_otorgados = Vacaciones::where('inicio_conteo', '=', $año)->pluck('dias')->first();
            $dias_extra = $this->tbFunctionFiltradoEmpleados(1, $usuario, $año);
            $dias_restados = $this->tbFunctionFiltradoEmpleados(2, $usuario, $año);

            $dias_gastados = SolicitudVacaciones::where('empleado_id', $usuario->empleado->id)->where('año', '=', $año)->where(function ($query) {
                $query->where('aprobacion', '=', 1)
                    ->orwhere('aprobacion', '=', 3);
            })->sum('dias_solicitados');
            $dias_disponibles = $dias_otorgados - $dias_gastados + $dias_extra - $dias_restados;

            return $dias_disponibles;
        } else {
            return null;
        }
    }

    public function tbFunctionPeriodoAdicional()
    {
        $usuario = User::getCurrentUser();
        $ingreso = Carbon::parse($usuario->empleado->antiguedad);
        $dia_hoy = Carbon::now();
        $no_vacaciones = $ingreso->format('d-m-Y');
        $año = Carbon::createFromDate($ingreso)->age;
        $seis_meses = ($dia_hoy->diffInMonths($ingreso));
        // dd($seis_meses);
        $año = $año - 1;
        //  Determina si existe regla asociada
        $existe_regla_por_area = Vacaciones::where('inicio_conteo', '=', $año)->whereHas('areas', function ($q) use ($usuario) {
            $q->where('area_id', $usuario->empleado->area_id);
        })->select('dias', 'tipo_conteo')->exists();
        $existe_regla_toda_empresa = Vacaciones::where('inicio_conteo', $año)->where('afectados', 1)->select('dias', 'tipo_conteo')->exists();

        if ($existe_regla_toda_empresa) {
            $regla_aplicada = Vacaciones::where('inicio_conteo', $año)->where('afectados', 1)->select('dias', 'tipo_conteo')->first();
        } elseif ($existe_regla_por_area) {
            $regla_aplicada = Vacaciones::where('inicio_conteo', '=', $año)->whereHas('areas', function ($q) use ($usuario) {
                $q->where('area_id', $usuario->empleado->area_id);
            })->select('dias', 'tipo_conteo')->first();
        } else {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }

        $tipo_conteo = $regla_aplicada->tipo_conteo;
        $fecha_limite = Vacaciones::where('inicio_conteo', '=', $año)->pluck('fin_conteo')->first();
        $inicio_vacaciones = $ingreso->addYear();
        $finVacaciones = $inicio_vacaciones->addYear($año);
        $finVacaciones = $finVacaciones->format('d-m-Y');
        $autoriza = $usuario->empleado->supervisor_id;
        $vacacion = new SolicitudVacaciones;
        $dias_disponibles = $this->tbFunctionDiasDisponiblesAñoPasado();
        $organizacion = Organizacion::getFirst();
        $dias_pendientes = SolicitudVacaciones::where('empleado_id', '=', $usuario->empleado->id)->where('aprobacion', '=', 1)->where('año', '=', $año)->sum('dias_solicitados');

        return view('admin.solicitudVacaciones.periodoAdicional', compact('vacacion', 'dias_disponibles', 'año', 'autoriza', 'no_vacaciones', 'organizacion', 'finVacaciones', 'dias_pendientes', 'tipo_conteo'));
    }

    public function tbFunctionAprobacion()
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        $solicitudesVacaciones = SolicitudVacaciones::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();

        foreach ($solicitudesVacaciones as $key_solicitud => $solicitante) {

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

        $dias_disponibles_date = $this->tbFunctionDiasDisponibles();
        if ($dias_disponibles_date > 0) {
            $dias_disponibles = $this->tbFunctionDiasDisponibles();
        } else {
            $dias_disponibles = 0;
        }

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'dias_disponibles' => $dias_disponibles,
            'solicitudesVacaciones' => $solicitudesVacaciones,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionRespuesta($id)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

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

            return redirect(route('admin.solicitud-vacaciones.index'));
        } elseif ($vacacion && $vacacion->empleado) {
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

        $solicitante = $vacacion->empleado_id;
        $ingreso = Empleado::where('id', $solicitante)->pluck('antiguedad')->first();
        $año = Carbon::createFromDate($ingreso)->age;

        return response(json_encode([
            'empleado' => $empleado,
            'vacacion' => $vacacion,
            'año' => $año,
        ]), 200)->header('Content-Type', 'application/json');

        $solicitante = $vacacion->empleado_id;
        $ingreso = Empleado::where('id', $solicitante)->pluck('antiguedad')->first();

        $año = Carbon::createFromDate($ingreso)->age;

        if ($año >= 1) {
            $dias_otorgados = Vacaciones::where('inicio_conteo', '=', $año)->pluck('dias')->first();
            $dias_gastados = SolicitudVacaciones::where('año', '=', $año)->where('aprobacion', '=', '3')->sum('dias_solicitados');
            $dias_disponibles = $dias_otorgados - $dias_gastados;
        } else {
            $dias_disponibles = null;
        }

        return response(json_encode([
            'vacacion' => $vacacion,
            'dias_disponibles' => $dias_disponibles,
            'año' => $año,
        ]), 200)->header('Content-Type', 'application/json');
        // return view('admin.solicitudVacaciones.respuesta', compact('vacacion', 'dias_disponibles', 'año'));
    }

    public function tbFunctionArchivo()
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        $solicitudesVacaciones = SolicitudVacaciones::with('empleado')
            ->where('empleado_id', '=', $data)
            ->where('aprobacion', '=', 2)
            ->orwhere('aprobacion', '=', 3)
            ->orderByDesc('id')
            ->get();

        foreach ($solicitudesVacaciones as $key_solicitud => $solicitante) {

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
            'solicitudesVacaciones' => $solicitudesVacaciones,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionArchivoShow($id)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

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

    public function tbFunctionVistaGlobal()
    {
        // abort_if(Gate::denies('reglas_vacaciones_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $data = User::getCurrentUser()->empleado->id;

        $solVac = SolicitudVacaciones::getAllwithEmpleados();

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
        // abort_if(Gate::denies('reglas_vacaciones_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

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

            return redirect(route('admin.solicitud-vacaciones.index'));
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

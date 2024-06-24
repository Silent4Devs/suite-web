<?php

namespace App\Http\Controllers\Api\V1\SolicitudDayOff;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaDayOff as MailRespuestaDayoff;
use App\Mail\SolicitudDayOff as MailSolicitudDayoff;
use App\Models\DayOff;
use App\Models\Empleado;
use App\Models\IncidentesDayoff;
use App\Models\ListaInformativa;
use App\Models\Organizacion;
use App\Models\SolicitudDayOff;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;

class SolicitudDayOffApiController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo = 'SolicitudDayOff';

    public function index($id_user)
    {
        // abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = User::find($id_user);
        $data = $usuario->empleado->id;


        $solicitudesDayOff = SolicitudDayOff::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();

        foreach ($solicitudesDayOff as $key_solicitud => $solicitante) {
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

        $dias_disponibles_date = $this->diasDisponibles($usuario->id);
        if ($dias_disponibles_date > 0) {
            $dias_disponibles = $this->diasDisponibles($usuario->id);
        } else {
            $dias_disponibles = 0;
        }

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'dias_disponibles' => $dias_disponibles,
            'solicitudesDayOff' => $solicitudesDayOff
        ]), 200)->header('Content-Type', 'application/json');

        // return view('admin.solicitudDayoff.index', compact('logo_actual', 'empresa_actual', 'dias_disponibles'));
    }

    public function create($id_usuario)
    {
        // abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $año = Carbon::now()->format('Y');

        $existe_regla_ingreso = DayOff::where('inicio_conteo', 1)->exists();
        $usuario = User::find($id_usuario);
        if ($existe_regla_ingreso) {
            $existe_regla_por_area = DayOff::where('inicio_conteo', '=', 1)->where('afectados', 2)->whereHas('areas', function ($q) use ($usuario) {
                $q->where('area_id', $usuario->empleado->area_id);
            })->select('dias', 'tipo_conteo')->exists();

            $existe_regla_toda_empresa = DayOff::where('inicio_conteo', 1)->where('afectados', 1)->select('dias', 'tipo_conteo')->exists();

            if ($existe_regla_toda_empresa) {
                $regla_aplicada = DayOff::where('inicio_conteo', 1)->where('afectados', 1)->select('dias', 'tipo_conteo')->first();
            } elseif ($existe_regla_por_area) {
                $regla_aplicada = DayOff::where('inicio_conteo', '=', 1)->whereHas('areas', function ($q) use ($usuario) {
                    $q->where('area_id', $usuario->empleado->area_id);
                })->select('dias', 'tipo_conteo')->first();
            } else {
                Alert::warning('warning', 'Regla de Day´s Off no asociada');

                return redirect(route('admin.solicitud-dayoff.index'));
            }
        } else {
            Alert::warning('warning', 'Regla de Day´s Off no asociada');

            return redirect(route('admin.solicitud-dayoff.index'));
        }
        $tipo_conteo = $regla_aplicada->tipo_conteo;

        $autoriza = $usuario->empleado->supervisor_id;
        $vacacion = new DayOff();
        $dias_disponibles = $this->diasDisponibles($usuario->id);
        // $organizacion = Organizacion::getFirst(); Innecesario
        $dias_pendientes = SolicitudDayOff::where('empleado_id', '=', $usuario->empleado->id)->where('aprobacion', '=', 1)->where('año', '=', $año)->sum('dias_solicitados');

        return response(json_encode([
            'vacacion' => $vacacion,
            'dias_disponibles' => $dias_disponibles,
            'año' => $año,
            'autoriza' => $autoriza,
            // 'organizacion' => $organizacion, Innecesario
            'dias_pendientes' => $dias_pendientes,
            'tipo_conteo' => $tipo_conteo,
        ]), 200)->header('Content-Type', 'application/json');

        // return view('admin.solicitudDayoff.create', compact('vacacion', 'dias_disponibles', 'año', 'autoriza', 'organizacion', 'dias_pendientes', 'tipo_conteo'));
    }

    public function store(Request $request)
    {
        // abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $newSolicitud = $request->input('solicitud');
        // dd($newSolicitud['fecha_inicio']);

        // $request->validate([
        //     'fecha_inicio' => 'required|date',
        //     'fecha_fin' => 'required|date',
        //     'empleado_id' => 'required|int',
        //     'dias_solicitados' => 'required|int',
        //     'año' => 'required|int',
        //     'autoriza' => 'required|int',
        // ]);

        $empleado = Empleado::getAll();

        $supervisor = $empleado->find($request->autoriza);
        $solicitante = $empleado->find($request->empleado_id);
        $solicitud = SolicitudDayOff::create([
            'fecha_inicio' => $newSolicitud['fecha_inicio'],
            'fecha_fin' => $newSolicitud['fecha_fin'],
            'empleado_id' => $newSolicitud['empleado_id'],
            'dias_solicitados' => $newSolicitud['dias_solicitados'],
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
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudDayOff($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudDayOff($solicitante, $supervisor, $solicitud));
        }
        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect()->route('admin.solicitud-dayoff.index');
        return json_encode(['data' => 'La solicitud fue creada exitosamente.'], 200);
    }

    public function show($id)
    {
        // abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Regla de Day´s Off no asociada');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

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
        // return view('admin.solicitudDayoff.show', compact('vacacion'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        // abort_if(Gate::denies('solicitud_dayoff_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuestaSolicitud = $request->input('solicitud');

        // $request->validate([
        //     'fecha_inicio' => 'required|date',
        //     'fecha_fin' => 'required|date',
        //     'empleado_id' => 'required|int',
        //     'dias_solicitados' => 'required|int',
        //     'año' => 'required|int',
        //     'autoriza' => 'required|int',
        //     'aprobacion' => 'required|int',
        // ]);

        $solicitud = SolicitudDayOff::find($id);

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
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaDayOff($solicitante, $supervisor, $solicitud, $correos));
        } else {
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaDayOff($solicitante, $supervisor, $solicitud));
        }
        // Alert::success('éxito', 'Información añadida con éxito');
        // return redirect(route('admin.solicitud-dayoff.aprobacion'));
        return json_encode(['data' => 'Se ha enviado la respuesta de la solicitud.'], 200);
    }

    public function destroy($id_solicitud)
    {
        // abort_if(Gate::denies('solicitud_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacaciones = SolicitudDayOff::find($id_solicitud);
        $vacaciones->delete();

        return json_encode(['éxito', 'Solicitud eliminada con éxito'], 200);
    }

    public function filtrado_empleados($efecto, $usuario, $año)
    {
        //Sacamos los ids del empleado
        $areaId = $usuario->empleado->area_id;
        $puestoId = $usuario->empleado->puesto_id;
        $idempleado = $usuario->empleado->id;

        //Preparamos los querys que se van a utilizar, buscando si existe coincidencia con el area, puesto o id del empleado
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

        //Se realizan las consultas buscando coincidencias por jerarquia, 1ro area, 2do puesto
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

    public function diasDisponibles($id_user)
    {
        $año = Carbon::now()->format('Y');
        $existe_regla_ingreso = DayOff::where('inicio_conteo', 1)->exists();

        $usuario = User::find($id_user);
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

    public function aprobacion($id_user)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = User::find($id_user);
        $data = $usuario->empleado->id;

        $solicitudesDayOff = SolicitudDayOff::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();

        foreach ($solicitudesDayOff as $key_solicitud => $solicitante) {
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

        $dias_disponibles_date = $this->diasDisponibles($usuario->id);
        if ($dias_disponibles_date > 0) {
            $dias_disponibles = $this->diasDisponibles($usuario->id);
        } else {
            $dias_disponibles = 0;
        }

        return response(json_encode([
            'logo_actual' => $logo_actual,
            'empresa_actual' => $empresa_actual,
            'dias_disponibles' => $dias_disponibles,
            'solicitudesDayOff' => $solicitudesDayOff
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function respuesta($id)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

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

        // return view('admin.solicitudDayoff.respuesta', compact('vacacion', 'año'));
    }

    public function archivo($id_usuario)
    {
        // abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::find($id_usuario)->empleado->id;

        $solicitudesDayOff = SolicitudDayOff::with('empleado')
            ->where('empleado_id', '=', $data)
            ->where('aprobacion', '=', 2)
            ->orwhere('aprobacion', '=', 3)
            ->orderByDesc('id')
            ->get();

        foreach ($solicitudesDayOff as $key_solicitud => $solicitante) {
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
            'solicitudesDayOff' => $solicitudesDayOff
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function vistaGlobal()
    {
        // abort_if(Gate::denies('reglas_vacaciones_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // $data = User::getCurrentUser()->empleado->id;

        $solVac = SolicitudDayOff::getAllwithEmpleados();

        foreach ($solVac as $key_solicitud => $solicitante) {
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
            'solVac' => $solVac,
        ]), 200)->header('Content-Type', 'application/json');
    }

    public function showVistaGlobal($id)
    {
        // abort_if(Gate::denies('reglas_dayoff_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

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
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

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

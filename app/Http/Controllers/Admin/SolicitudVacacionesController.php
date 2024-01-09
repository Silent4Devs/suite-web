<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaVacaciones as MailRespuestaVacaciones;
use App\Mail\SolicitudVacaciones as MailSolicitudVacaciones;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\IncidentesVacaciones;
use App\Models\Organizacion;
use App\Models\Puesto;
use App\Models\SolicitudDayOff;
use App\Models\SolicitudPermisoGoceSueldo;
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

class SolicitudVacacionesController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('solicitud_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudVacaciones::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'no_permitido';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'solicitud-vacaciones';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            // $table->editColumn('descripcion', function ($row) {
            //     return $row->descripcion ? $row->descripcion : '';
            // });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });
            $table->editColumn('año', function ($row) {
                return $row->año ? $row->año : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        $ingreso = User::getCurrentUser()->empleado->antiguedad;
        $dia_hoy = Carbon::now();
        $seis_meses = ($dia_hoy->diffInMonths($ingreso));
        if ($seis_meses >= 6) {
            $dias_disponibles_date = $this->diasDisponibles();
            if ($dias_disponibles_date > 0) {
                $dias_disponibles = $this->diasDisponibles();
            } else {
                $dias_disponibles = 0;
            }
        } else {
            $dias_disponibles = 0;
        }

        return view('admin.solicitudVacaciones.index', compact('logo_actual', 'empresa_actual', 'dias_disponibles'));
    }

    public function create()
    {
        $usuario = User::getCurrentUser();
        abort_if(Gate::denies('solicitud_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
            $vacacion = new SolicitudVacaciones();
            $dias_disponibles = null;
            $organizacion = Organizacion::getFirst();
            $dias_pendientes = null;
            $mostrar_reclamo = false;
            $año_pasado = 0;
            $periodo_vencido = 0;
            $finVacaciones_periodo_pasado = null;

            return view('admin.solicitudVacaciones.create', compact('leyenda_sin_beneficio', 'finVacaciones_periodo_pasado', 'periodo_vencido', 'año_pasado', 'mostrar_reclamo', 'vacacion', 'dias_disponibles', 'año', 'autoriza', 'no_vacaciones', 'organizacion', 'finVacaciones', 'dias_pendientes', 'tipo_conteo'));
        }

        $tipo_conteo = $regla_aplicada->tipo_conteo;
        $fecha_limite = Vacaciones::where('inicio_conteo', '=', $año)->pluck('fin_conteo')->first();
        $inicio_vacaciones = $ingreso->addYear();
        $finVacaciones = $inicio_vacaciones->addYear($año);
        $finVacaciones = $finVacaciones->format('d-m-Y');
        $autoriza = $usuario->empleado->supervisor_id;
        $vacacion = new SolicitudVacaciones();

        $dias_disponibles = $this->diasDisponibles();
        $organizacion = Organizacion::getFirst();
        $dias_pendientes = SolicitudVacaciones::where('empleado_id', '=', $usuario->empleado->id)->where('aprobacion', '=', 1)->where('año', '=', $año)->sum('dias_solicitados');

        // Funcion para dias dias disponibles año pasado
        $año_pasado = $this->diasDisponiblesAñopasado();
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

        return view('admin.solicitudVacaciones.create', compact('leyenda_sin_beneficio', 'vacacion', 'dias_disponibles', 'año', 'autoriza', 'no_vacaciones', 'organizacion', 'finVacaciones', 'dias_pendientes', 'tipo_conteo', 'mostrar_reclamo', 'periodo_vencido', 'año_pasado', 'finVacaciones_periodo_pasado'));
    }

    public function periodoAdicional()
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
        $vacacion = new SolicitudVacaciones();
        $dias_disponibles = $this->diasDisponiblesAñopasado();
        $organizacion = Organizacion::getFirst();
        $dias_pendientes = SolicitudVacaciones::where('empleado_id', '=', $usuario->empleado->id)->where('aprobacion', '=', 1)->where('año', '=', $año)->sum('dias_solicitados');

        return view('admin.solicitudVacaciones.periodoAdicional', compact('vacacion', 'dias_disponibles', 'año', 'autoriza', 'no_vacaciones', 'organizacion', 'finVacaciones', 'dias_pendientes', 'tipo_conteo'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('solicitud_vacaciones_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'empleado_id' => 'required|int',
            'dias_solicitados' => 'required|int',
            'año' => 'required|int',
            'autoriza' => 'required|int',
        ]);
        //envio de email
        $empleados = Empleado::getAll();

        $supervisor = $empleados->find($request->autoriza);
        $solicitante = $empleados->find($request->empleado_id);

        $solicitud = SolicitudVacaciones::create($request->all());

        Mail::to(removeUnicodeCharacters($supervisor->email))->send(new MailSolicitudVacaciones($solicitante, $supervisor, $solicitud));

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.solicitud-vacaciones.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('solicitud_vacaciones_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }

        return view('admin.solicitudVacaciones.show', compact('vacacion'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('solicitud_vacaciones_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'empleado_id' => 'required|int',
            'dias_solicitados' => 'required|int',
            'año' => 'required|int',
            'autoriza' => 'required|int',
            'aprobacion' => 'required|int',
        ]);

        $solicitud = SolicitudVacaciones::find($id);
        $empleados = Empleado::getAll();
        $supervisor = $empleados->find($request->autoriza);
        $solicitante = $empleados->find($request->empleado_id);

        $solicitud->update($request->all());

        Mail::to(trim(removeUnicodeCharacters($solicitante->email)))->send(new MailRespuestaVacaciones($solicitante, $supervisor, $solicitud));
        Alert::success('éxito', 'Información añadida con éxito');

        return redirect(route('admin.solicitud-vacaciones.aprobacion'));
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('solicitud_vacaciones_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = $request->id;
        $vacaciones = SolicitudVacaciones::find($id);
        $vacaciones->delete();
        Alert::success('éxito', 'Información eliminada con éxito');

        return response()->json(['status' => 200]);
    }

    public function massDestroy(Request $request)
    {
        SolicitudVacaciones::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function filtrado_empleados($efecto, $usuario, $año)
    {
        //Sacamos los ids del empleado
        $areaId = $usuario->empleado->area_id;
        $puestoId = $usuario->empleado->puesto_id;
        $idempleado = $usuario->empleado->id;

        //Preparamos los querys que se van a utilizar, buscando si existe coincidencia con el area, puesto o id del empleado
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

    public function diasDisponibles()
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

            //Se llama a la nueva función, con los parametros de efecto(1-suma y/o 2-resta), el usuario y el año)
            $dias_extra = $this->filtrado_empleados(1, $usuario, $año);
            $dias_restados = $this->filtrado_empleados(2, $usuario, $año);
            //funcion anterior
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

    public function diasDisponiblesAñopasado()
    {
        $usuario = User::getCurrentUser();
        $ingreso = $usuario->empleado->antiguedad;
        $año_actual = Carbon::createFromDate($ingreso)->age;
        $año = $año_actual - 1;

        if ($año >= 1) {
            $dias_otorgados = Vacaciones::where('inicio_conteo', '=', $año)->pluck('dias')->first();
            $dias_extra = $this->filtrado_empleados(1, $usuario, $año);
            $dias_restados = $this->filtrado_empleados(2, $usuario, $año);

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

    public function aprobacionMenu(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usuario = User::getCurrentUser();
        $solicitud_vacacion = SolicitudVacaciones::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitud_dayoff = SolicitudDayOff::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitud_permiso = SolicitudPermisoGoceSueldo::where('autoriza', $usuario->empleado->id)->where('aprobacion', 1)->count();
        $solicitudes_pendientes = $solicitud_vacacion + $solicitud_dayoff + $solicitud_permiso;

        return view('admin.solicitudVacaciones.aprobacion-menu', compact('solicitud_dayoff', 'solicitud_vacacion', 'solicitud_permiso'));
    }

    public function aprobacion(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudVacaciones::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();
            $table = datatables()::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('empleado', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });

            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });
            // $table->editColumn('descripcion', function ($row) {
            //     return $row->descripcion ? $row->descripcion : '';
            // });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.solicitudVacaciones.global-solicitudes', compact('logo_actual', 'empresa_actual'));
    }

    public function respuesta($id)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }
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

        return view('admin.solicitudVacaciones.respuesta', compact('vacacion', 'dias_disponibles', 'año'));
    }

    public function archivo(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudVacaciones::with('empleado')->where('autoriza', '=', $data)->where(function ($query) {
                $query->where('aprobacion', '=', 2)
                    ->orwhere('aprobacion', '=', 3);
            })->orderByDesc('id')->get();
            $table = datatables()::of($query);
            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'solicitud-vacaciones';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('empleado', function ($row) {
                return $row->empleado ? $row->empleado : '';
            });
            $table->editColumn('dias_solicitados', function ($row) {
                return $row->dias_solicitados ? $row->dias_solicitados : '';
            });
            $table->editColumn('fecha_inicio', function ($row) {
                return $row->fecha_inicio ? $row->fecha_inicio : '';
            });
            $table->editColumn('fecha_fin', function ($row) {
                return $row->fecha_fin ? $row->fecha_fin : '';
            });
            $table->editColumn('aprobacion', function ($row) {
                return $row->aprobacion ? $row->aprobacion : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.solicitudVacaciones.archivo', compact('logo_actual', 'empresa_actual'));
    }

    public function showVistaGlobal($id)
    {
        abort_if(Gate::denies('reglas_vacaciones_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }

        return view('admin.solicitudVacaciones.vistaGlobal', compact('vacacion'));
    }

    public function archivoShow($id)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudVacaciones::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }

        return view('admin.solicitudVacaciones.archivoShow', compact('vacacion'));
    }
}

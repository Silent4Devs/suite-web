<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\RespuestaDayOff as MailRespuestaDayoff;
use App\Mail\SolicitudDayOff as MailSolicitudDayoff;
use App\Models\DayOff;
use App\Models\Empleado;
use App\Models\IncidentesDayoff;
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

class SolicitudDayOffController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudDayOff::with('empleado')->where('empleado_id', '=', $data)->orderByDesc('id')->get();
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
            // $table->editColumn('aprobacion', function ($row) {
            //     return $row->aprobacion ? $row->aprobacion : '';
            // });
            // $table->editColumn('año', function ($row) {
            //     return $row->año ? $row->año : '';
            // });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
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

        return view('admin.solicitudDayoff.index', compact('logo_actual', 'empresa_actual', 'dias_disponibles'));
    }

    public function create()
    {
        abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $año = Carbon::now()->format('Y');

        $existe_regla_ingreso = DayOff::where('inicio_conteo', 1)->exists();
        $usuario = User::getCurrentUser();
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
        $dias_disponibles = $this->diasDisponibles();
        $organizacion = Organizacion::getFirst();
        $dias_pendientes = SolicitudDayOff::where('empleado_id', '=', $usuario->empleado->id)->where('aprobacion', '=', 1)->where('año', '=', $año)->sum('dias_solicitados');

        return view('admin.solicitudDayoff.create', compact('vacacion', 'dias_disponibles', 'año', 'autoriza', 'organizacion', 'dias_pendientes', 'tipo_conteo'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('solicitud_dayoff_crear'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'empleado_id' => 'required|int',
            'dias_solicitados' => 'required|int',
            'año' => 'required|int',
            'autoriza' => 'required|int',
        ]);

        $empleado = Empleado::getAll();

        $supervisor = $empleado->find($request->autoriza);
        $solicitante = $empleado->find($request->empleado_id);
        $solicitud = SolicitudDayOff::create($request->all());
        Mail::to(removeUnicodeCharacters($supervisor->email))->queue(new MailSolicitudDayOff($solicitante, $supervisor, $solicitud));

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect()->route('admin.solicitud-dayoff.index');
    }

    public function show($id)
    {
        abort_if(Gate::denies('solicitud_dayoff_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Regla de Day´s Off no asociada');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

        return view('admin.solicitudDayoff.show', compact('vacacion'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('solicitud_dayoff_aprobar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'empleado_id' => 'required|int',
            'dias_solicitados' => 'required|int',
            'año' => 'required|int',
            'autoriza' => 'required|int',
            'aprobacion' => 'required|int',
        ]);

        $solicitud = SolicitudDayOff::find($id);

        $empleados = Empleado::getAll();

        $supervisor = $empleados->find($request->autoriza);
        $solicitante = $empleados->find($request->empleado_id);

        $solicitud->update($request->all());
        Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new MailRespuestaDayOff($solicitante, $supervisor, $solicitud));

        Alert::success('éxito', 'Información añadida con éxito');

        return redirect(route('admin.solicitud-dayoff.aprobacion'));
    }

    public function destroy(Request $request)
    {
        abort_if(Gate::denies('solicitud_dayoff_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $id = $request->id;
        $vacaciones = SolicitudDayOff::find($id);
        $vacaciones->delete();
        Alert::success('éxito', 'Información eliminada con éxito');

        return response()->json(['status' => 200]);
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

    public function aprobacion(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudDayOff::with('empleado')->where('autoriza', '=', $data)->where('aprobacion', '=', 1)->orderByDesc('id')->get();
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

        return view('admin.solicitudDayoff.global-solicitudes', compact('logo_actual', 'empresa_actual'));
    }

    public function respuesta($id)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-vacaciones.index'));
        }
        $solicitante = $vacacion->empleado_id;
        $ingreso = Empleado::where('id', $solicitante)->pluck('antiguedad')->first();
        $año = Carbon::createFromDate($ingreso)->age;

        return view('admin.solicitudDayoff.respuesta', compact('vacacion', 'año'));
    }

    public function archivo(Request $request)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $data = User::getCurrentUser()->empleado->id;

        if ($request->ajax()) {
            $query = SolicitudDayOff::with('empleado')->where('autoriza', '=', $data)->where(function ($query) {
                $query->where('aprobacion', '=', 2)
                    ->orwhere('aprobacion', '=', 3);
            })->orderByDesc('id')->get();
            $table = datatables()::of($query);
            $table->editColumn('actions', function ($row) {
                $viewGate = 'amenazas_ver';
                $editGate = 'amenazas_editar';
                $deleteGate = 'amenazas_eliminar';
                $crudRoutePart = 'solicitud-dayoff';

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

        return view('admin.solicitudDayoff.archivo', compact('logo_actual', 'empresa_actual'));
    }

    public function showVistaGlobal($id)
    {
        abort_if(Gate::denies('reglas_dayoff_vista_global'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

        return view('admin.solicitudDayoff.vistaGlobal', compact('vacacion'));
    }

    public function showArchivo($id)
    {
        abort_if(Gate::denies('modulo_aprobacion_ausencia'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $vacacion = SolicitudDayOff::with('empleado')->find($id);

        if (empty($vacacion)) {
            Alert::warning('warning', 'Data not found');

            return redirect(route('admin.solicitud-dayoff.index'));
        }

        return view('admin.solicitudDayoff.showArchivo', compact('vacacion'));
    }
}

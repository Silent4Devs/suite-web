<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TimesheetHorasSobrepasadas;
use App\Mail\TimesheetHorasSolicitudAprobacion;
use App\Mail\TimesheetSolicitudAprobada;
use App\Mail\TimesheetSolicitudRechazada;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\TimesheetTarea;
use App\Services\TimesheetService;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

class TimesheetController extends Controller
{
    use ObtenerOrganizacion;

    private $timesheetService;

    public function __construct(TimesheetService $timesheetService)
    {
        $this->timesheetService = $timesheetService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cacheKey = 'timesheet-'.auth()->user()->empleado->id;

        $times = Timesheet::getPersonalTimesheet();

        $todos_contador = $times->count();
        $borrador_contador = $times->where('estatus', 'papelera')->count();
        $pendientes_contador = $times->where('estatus', 'pendiente')->count();
        $aprobados_contador = $times->where('estatus', 'aprobado')->count();
        $rechazos_contador = $times->where('estatus', 'rechazado')->count();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.index', compact('times', 'rechazos_contador', 'todos_contador', 'borrador_contador', 'pendientes_contador', 'aprobados_contador', 'logo_actual', 'empresa_actual'));
    }

    public function timesheetInicio()
    {
        abort_if(Gate::denies('timesheet_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion = Organizacion::getFirst();

        if (Timesheet::count() > 0) {
            $time_viejo = Timesheet::orderBy('fecha_dia')->first()->fecha_dia;
            $time_exist = true;
        } else {
            $time_viejo = null;
            $time_exist = false;
        }

        $rechazos_contador = Timesheet::getPersonalTimesheet()->where('estatus', 'rechazado')->count();
        $aprobar_contador = Timesheet::where('aprobador_id', auth()->user()->empleado->id)->where('estatus', 'pendiente')->count();

        return view('admin.timesheet.timesheet-inicio', compact('organizacion', 'rechazos_contador', 'aprobar_contador', 'time_viejo', 'time_exist'));
    }

    public function actualizarDia(Request $request)
    {
        $organizacion = Organizacion::getFirst();
        $semanasAdicionales = $request->semanas_adicionales < 0 ? 0 : $request->semanas_adicionales;
        $organizacion->update([
            'dia_timesheet' => $request->dia_timesheet,
            'inicio_timesheet' => $request->inicio_timesheet,
            'fecha_registro_timesheet' => $request->fecha_registro_timesheet,
            'semanas_min_timesheet' => $request->semanas_min_timesheet,
            'semanas_adicionales' => $semanasAdicionales,
        ]);

        $empleados = Empleado::getAll();
        foreach ($empleados as $key => $empleado) {
            $empleado->update([
                'semanas_min_timesheet' => $request->semanas_min_timesheet,
            ]);
        }

        return redirect()->route('admin.timesheet-inicio')->with('success', 'Guardado con éxito');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fechasRegistradas = Timesheet::getPersonalTimesheet()->pluck('fecha_dia')->toArray();

        $organizacion = Organizacion::getFirst();

        return view('admin.timesheet.create', compact('fechasRegistradas', 'organizacion'));
    }

    public function createCopia($id)
    {
        $empleado = Empleado::find(auth()->user()->empleado->id);

        // areas proyectos
        $proyectos_array = collect();
        $proyectos_totales = TimesheetProyecto::getAll();
        foreach ($proyectos_totales as $key => $proyecto) {
            if ($proyecto->estatus == 'proceso') {
                foreach ($proyecto->areas as $key => $area) {
                    if ($area['id'] == $empleado->area_id) {
                        $proyectos_array->push([
                            'id' => $proyecto->id,
                            'identificador' => $proyecto->identificador,
                            'proyecto' => $proyecto->proyecto,
                        ]);
                    }
                }
            }
        }
        $proyectos = $proyectos_array->unique();

        $tareas = TimesheetTarea::getAll();
        $timesheet = Timesheet::find($id);
        $fechasRegistradas = Timesheet::getPersonalTimesheet()->pluck('fecha_dia')->toArray();
        $organizacion = Organizacion::getFirst();
        $horas_count = TimesheetHoras::where('timesheet_id', $id)->count();

        return view('admin.timesheet.create-copia', compact('timesheet', 'proyectos', 'tareas', 'fechasRegistradas', 'organizacion', 'horas_count'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_semana = Organizacion::getFirst();

        $request->validate(
            [
                'timesheet.1.proyecto' => 'required',
                'timesheet.1.tarea' => 'required',
                'fecha_dia' => 'required',
            ],
            [
                'timesheet.*.proyecto.required' => 'Seleccionar proyecto',
                'timesheet.*.tarea.required' => 'Seleccionar tarea',
                'fecha_dia.required' => 'Seleccione fecha',
            ],
        );
        if (
            $request->timesheet[1]['lunes'] == null &&
            $request->timesheet[1]['martes'] == null &&
            $request->timesheet[1]['miercoles'] == null &&
            $request->timesheet[1]['jueves'] == null &&
            $request->timesheet[1]['viernes'] == null &&
            $request->timesheet[1]['sabado'] == null &&
            $request->timesheet[1]['domingo'] == null
        ) {
            $request->validate(
                [
                    'timesheet.1.horas' => 'required',
                ],
                [
                    'timesheet.1.horas.required' => 'Registre horas de la semana',
                ]
            );
        }

        foreach ($request->timesheet as $index => $hora) {
            if ($index > 1) {
                if (array_key_exists('proyecto', $hora) || array_key_exists('tarea', $hora)) {
                    $request->validate(
                        [
                            "timesheet.{$index}.proyecto" => 'required',
                            "timesheet.{$index}.tarea" => 'required',
                        ],
                        [
                            "timesheet.{$index}.proyecto.required" => 'Seleccionar proyecto',
                            "timesheet.{$index}.tarea.required" => 'Seleccionar tarea',
                        ],
                    );

                    if (
                        $hora['lunes'] == null &&
                        $hora['martes'] == null &&
                        $hora['miercoles'] == null &&
                        $hora['jueves'] == null &&
                        $hora['viernes'] == null &&
                        $hora['sabado'] == null &&
                        $hora['domingo'] == null
                    ) {
                        $request->validate(
                            [
                                "timesheet.{$index}.horas" => 'required',
                            ],
                            [
                                "timesheet.{$index}.horas.required" => 'Registre horas de la semana',
                            ],
                        );
                    }
                } else {
                    // dd($hora);
                    if (
                        $hora['lunes'] != null ||
                        $hora['martes'] != null ||
                        $hora['miercoles'] != null ||
                        $hora['jueves'] != null ||
                        $hora['viernes'] != null ||
                        $hora['sabado'] != null ||
                        $hora['domingo'] != null
                    ) {
                        $request->validate(
                            [
                                "timesheet.{$index}.proyecto" => 'required',
                                "timesheet.{$index}.tarea" => 'required',
                            ],
                            [
                                "timesheet.{$index}.proyecto.required" => 'Seleccionar proyecto',
                                "timesheet.{$index}.tarea.required" => 'Seleccionar tarea',
                            ],
                        );
                    }
                }
            }
        }
        // dd($organizacion_semana->dia_timesheet);
        $timesheet_nuevo = Timesheet::create([
            'fecha_dia' => $request->fecha_dia,
            'dia_semana' => $organizacion_semana->dia_timesheet,
            'inicio_semana' => $organizacion_semana->inicio_timesheet,
            'fin_semana' => $organizacion_semana->fin_timesheet,
            'empleado_id' => auth()->user()->empleado->id,
            'aprobador_id' => auth()->user()->empleado->supervisor_id,
            'estatus' => $request->estatus,
        ]);

        foreach ($request->timesheet as $index => $hora) {
            if (array_key_exists('proyecto', $hora) && array_key_exists('tarea', $hora)) {
                $horas_nuevas = TimesheetHoras::create([
                    'timesheet_id' => $timesheet_nuevo->id,
                    'proyecto_id' => array_key_exists('proyecto', $hora) ? $hora['proyecto'] : null,
                    'tarea_id' => array_key_exists('tarea', $hora) ? $hora['tarea'] : null,
                    'facturable' => array_key_exists('facturable', $hora) ? true : false,
                    'horas_lunes' => $hora['lunes'],
                    'horas_martes' => $hora['martes'],
                    'horas_miercoles' => $hora['miercoles'],
                    'horas_jueves' => $hora['jueves'],
                    'horas_viernes' => $hora['viernes'],
                    'horas_sabado' => $hora['sabado'],
                    'horas_domingo' => $hora['domingo'],
                    'descripcion' => $hora['descripcion'],
                    'empleado_id' => auth()->user()->empleado->id,
                ]);
            }
        }

        if ($timesheet_nuevo->estatus == 'pendiente') {
            $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->supervisor_id);

            $solicitante = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->id);

            Mail::to($aprobador->email)->send(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_nuevo, $solicitante));
        }

        $this->notificacionhorassobrepasadas(auth()->user()->empleado->id);

        return response()->json(['status' => 200]);
        // return redirect()->route('admin.timesheet')->with('success', 'Registro Enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $timesheet = Timesheet::find($id);
        $horas = TimesheetHoras::where('timesheet_id', $id)->get();
        $horas_count = TimesheetHoras::where('timesheet_id', $id)->count();

        $hoy = Carbon::now();
        $hoy_format = $hoy->format('d/m/Y');

        return view('admin.timesheet.show', compact('timesheet', 'horas', 'hoy_format', 'horas_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find(auth()->user()->empleado->id);

        // areas proyectos
        $proyectos_array = collect();
        $proyectos_totales = TimesheetProyecto::getAll();
        foreach ($proyectos_totales as $key => $proyecto) {
            if ($proyecto->estatus == 'proceso') {
                foreach ($proyecto->areas as $key => $area) {
                    if ($area['id'] == $empleado->area_id) {
                        $proyectos_array->push([
                            'id' => $proyecto->id,
                            'identificador' => $proyecto->identificador,
                            'proyecto' => $proyecto->proyecto,
                        ]);
                    }
                }
            }
        }
        $proyectos = $proyectos_array->unique();

        $tareas = TimesheetTarea::getAll();
        $timesheet = Timesheet::find($id);
        $fechasRegistradas = Timesheet::getPersonalTimesheet()->pluck('fecha_dia')->toArray();
        $organizacion = Organizacion::getFirst();
        $horas_count = TimesheetHoras::where('timesheet_id', $id)->count();

        return view('admin.timesheet.edit', compact('timesheet', 'proyectos', 'tareas', 'fechasRegistradas', 'organizacion', 'horas_count'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_semana = Organizacion::getFirst();

        $request->validate(
            [
                'timesheet.1.proyecto' => 'required',
                'timesheet.1.tarea' => 'required',
            ],
            [
                'timesheet.*.proyecto.required' => 'Seleccionar proyecto',
                'timesheet.*.tarea.required' => 'Seleccionar tarea',
            ],
        );
        if (
            $request->timesheet[1]['lunes'] == null &&
            $request->timesheet[1]['martes'] == null &&
            $request->timesheet[1]['miercoles'] == null &&
            $request->timesheet[1]['jueves'] == null &&
            $request->timesheet[1]['viernes'] == null &&
            $request->timesheet[1]['sabado'] == null &&
            $request->timesheet[1]['domingo'] == null
        ) {
            $request->validate(
                [
                    'timesheet.1.horas' => 'required',
                ],
                [
                    'timesheet.1.horas.required' => 'Registre horas de la semana',
                ]
            );
        }

        foreach ($request->timesheet as $index => $hora) {
            if ($index > 1) {
                if (array_key_exists('proyecto', $hora) || array_key_exists('tarea', $hora)) {
                    $request->validate(
                        [
                            "timesheet.{$index}.proyecto" => 'required',
                            "timesheet.{$index}.tarea" => 'required',
                        ],
                        [
                            "timesheet.{$index}.proyecto.required" => 'Seleccionar proyecto',
                            "timesheet.{$index}.tarea.required" => 'Seleccionar tarea',
                        ],
                    );

                    if (
                        $hora['lunes'] == null &&
                        $hora['martes'] == null &&
                        $hora['miercoles'] == null &&
                        $hora['jueves'] == null &&
                        $hora['viernes'] == null &&
                        $hora['sabado'] == null &&
                        $hora['domingo'] == null
                    ) {
                        $request->validate(
                            [
                                "timesheet.{$index}.horas" => 'required',
                            ],
                            [
                                "timesheet.{$index}.horas.required" => 'Registre horas de la semana',
                            ],
                        );
                    }
                } else {
                    // dd($hora);
                    if (
                        $hora['lunes'] != null ||
                        $hora['martes'] != null ||
                        $hora['miercoles'] != null ||
                        $hora['jueves'] != null ||
                        $hora['viernes'] != null ||
                        $hora['sabado'] != null ||
                        $hora['domingo'] != null
                    ) {
                        $request->validate(
                            [
                                "timesheet.{$index}.proyecto" => 'required',
                                "timesheet.{$index}.tarea" => 'required',
                            ],
                            [
                                "timesheet.{$index}.proyecto.required" => 'Seleccionar proyecto',
                                "timesheet.{$index}.tarea.required" => 'Seleccionar tarea',
                            ],
                        );
                    }
                }
            }
        }

        $timesheet_edit = Timesheet::find($id);

        $timesheet_edit->update([
            'empleado_id' => auth()->user()->empleado->id,
            'aprobador_id' => auth()->user()->empleado->supervisor_id,
            'estatus' => $request->estatus,
        ]);

        foreach ($request->timesheet as $index => $hora) {
            if (array_key_exists('proyecto', $hora) && array_key_exists('tarea', $hora)) {
                $horas_nuevas = TimesheetHoras::find($hora['id_hora']);

                if ($horas_nuevas != null) {
                    $horas_nuevas->update([
                        'timesheet_id' => $timesheet_edit->id,
                        'proyecto_id' => array_key_exists('proyecto', $hora) ? $hora['proyecto'] : null,
                        'tarea_id' => array_key_exists('tarea', $hora) ? $hora['tarea'] : null,
                        'facturable' => array_key_exists('facturable', $hora) ? true : false,
                        'horas_lunes' => $hora['lunes'],
                        'horas_martes' => $hora['martes'],
                        'horas_miercoles' => $hora['miercoles'],
                        'horas_jueves' => $hora['jueves'],
                        'horas_viernes' => $hora['viernes'],
                        'horas_sabado' => $hora['sabado'],
                        'horas_domingo' => $hora['domingo'],
                        'descripcion' => $hora['descripcion'],
                        'empleado_id' => auth()->user()->empleado->id,
                    ]);
                } else {
                    TimesheetHoras::create([
                        'timesheet_id' => $timesheet_edit->id,
                        'proyecto_id' => array_key_exists('proyecto', $hora) ? $hora['proyecto'] : null,
                        'tarea_id' => array_key_exists('tarea', $hora) ? $hora['tarea'] : null,
                        'facturable' => $hora['facturable'],
                        'horas_lunes' => $hora['lunes'],
                        'horas_martes' => $hora['martes'],
                        'horas_miercoles' => $hora['miercoles'],
                        'horas_jueves' => $hora['jueves'],
                        'horas_viernes' => $hora['viernes'],
                        'horas_sabado' => $hora['sabado'],
                        'horas_domingo' => $hora['domingo'],
                        'descripcion' => $hora['descripcion'],
                        'empleado_id' => auth()->user()->empleado->id,
                    ]);
                }
            }
        }

        if ($timesheet_edit->estatus == 'pendiente') {
            $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->supervisor_id);

            $solicitante = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->id);

            Mail::to($aprobador->email)->send(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_edit, $solicitante));
        }

        $this->notificacionhorassobrepasadas(auth()->user()->empleado->id);

        return response()->json(['status' => 200]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function eliminar($id)
    {
        $timesheet_eliminar = Timesheet::find($id);

        $timesheet_eliminar->delete();

        return redirect()->back()->with('success', 'Eliminado con éxito');
    }

    public function proyectos()
    {
        $clientes = TimesheetCliente::getAll();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.proyectos', compact('clientes', 'logo_actual', 'empresa_actual'));
    }

    public function createProyectos()
    {
        $clientes = TimesheetCliente::getAll();
        $sedes = Sede::getAll();
        $areas = Area::getAll();
        $tipos = TimesheetProyecto::TIPOS;
        $tipo = $tipos['Interno'];

        return view('admin.timesheet.create-proyectos', compact('clientes', 'areas', 'sedes', 'tipos', 'tipo'));
    }

    public function storeProyectos(Request $request)
    {
        $request->validate(
            [
                'identificador' => 'required|unique:timesheet_proyectos,identificador',
                'proyecto_name' => 'required',
                'cliente_id' => 'required',
                'sede_id' => 'required',
                'tipo' => 'required',
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
            ],
        );
        if ($request->fecha_inicio && $request->fecha_fin) {
            $request->validate(
                [
                    'fecha_inicio' => 'before:fecha_fin',
                    'fecha_fin' => 'after:fecha_inicio',
                ],
                [
                    'fecha_inicio.before' => 'La fecha de incio debe ser anterior a la fecha de fin',
                    'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de incio',
                ],
            );
        }
        $nuevo_proyecto = TimesheetProyecto::create([
            'identificador' => $request->identificador,
            'proyecto' => $request->proyecto_name,
            'cliente_id' => $request->cliente_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'sede_id' => $request->sede_id,
            'tipo' => $request->tipo,
            'horas_proyecto' => $request->horas_proyecto,
        ]);

        foreach ($request->areas_seleccionadas as $key => $area_id) {
            TimesheetProyectoArea::create([
                'proyecto_id' => $nuevo_proyecto->id,
                'area_id' => $area_id,
            ]);
        }

        // return redirect('admin/timesheet/proyecto-empleados/' . $nuevo_proyecto->id);
        return redirect('admin/timesheet/proyectos');
    }

    public function showProyectos($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $areas = TimesheetProyectoArea::where('proyecto_id', $id)
            ->join('areas', 'timesheet_proyectos_areas.area_id', '=', 'areas.id')
            ->get('areas.area');

        $sedes = TimesheetProyecto::where('timesheet_proyectos.id', $id)
            ->join('sedes', 'timesheet_proyectos.sede_id', '=', 'sedes.id')
            ->get('sedes.sede');

        $clientes = TimesheetProyecto::where('timesheet_proyectos.id', $id)
            ->join('timesheet_clientes', 'timesheet_proyectos.cliente_id', '=', 'timesheet_clientes.id')
            ->get('timesheet_clientes.nombre');

        // dd($proyecto, $areas, $sedes);

        return view('admin.timesheet.show-proyectos', compact('proyecto', 'areas', 'sedes', 'clientes'));
    }

    public function updateProyectos(Request $request, $id)
    {
        $request->validate(
            [
                'identificador' => 'required',
                'proyecto_name' => 'required',
                'cliente_id' => 'required',
                'sede_id' => 'required',
                'tipo' => 'required',
            ],
        );

        if ($request->fecha_inicio && $request->fecha_fin) {
            $request->validate(
                [
                    'fecha_inicio' => 'required|before:fecha_fin',
                    'fecha_fin' => 'required|after:fecha_inicio',
                ],
                [
                    'fecha_inicio.before' => 'La fecha de incio debe ser anterior a la fecha de fin',
                    'fecha_fin.after' => 'La fecha de fin debe ser posterior a la fecha de incio',
                ],
            );
        }

        $edit_proyecto = TimesheetProyecto::find($id);

        $edit_proyecto->update([
            'identificador' => $request->identificador,
            'proyecto' => $request->proyecto_name,
            'cliente_id' => $request->cliente_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'sede_id' => $request->sede_id,
            'tipo' => $request->tipo,
            'horas_proyecto' => $request->horas_proyecto,
        ]);

        $proyectos_areas_eliminados = TimesheetProyectoArea::where('proyecto_id', $edit_proyecto->id)->delete();

        foreach ($request->areas_seleccionadas as $key => $area_id) {
            TimesheetProyectoArea::create([
                'proyecto_id' => $edit_proyecto->id,
                'area_id' => $area_id,
            ]);
        }

        // return back()->with('success', 'Guardado con éxito');
        return redirect('admin/timesheet/proyecto-empleados/'.$edit_proyecto->id);
    }

    public function tareas()
    {
        abort_if(Gate::denies('timesheet_administrador_tareas_proyectos_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.tareas', compact('logo_actual', 'empresa_actual'));
    }

    public function tareasProyecto($proyecto_id)
    {
        $proyecto = TimesheetProyecto::select('proyecto', 'id')->find($proyecto_id);

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.tareas-proyecto', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function papelera()
    {
        abort_if(Gate::denies('mi_timesheet_horas_rechazadas_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $papelera = Timesheet::where('estatus', 'papelera')->where('empleado_id', auth()->user()->empleado->id)->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.papelera', compact('papelera', 'logo_actual', 'empresa_actual'));
    }

    public function obtenerEquipo($childrens)
    {
        $equipo_a_cargo = collect();

        foreach ($childrens as $evaluador) {
            $equipo_a_cargo->push($evaluador->id);

            if (count($evaluador->children)) {
                $equipo_a_cargo->push($this->obtenerEquipo($evaluador->children));
            }
        }

        return $equipo_a_cargo->flatten(1)->toArray();
    }

    public function aprobaciones(Request $request)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $habilitarTodos = $request->habilitarTodos ? true : false;
        $equipo_a_cargo = $this->obtenerEquipo(auth()->user()->empleado->children);
        array_push($equipo_a_cargo, auth()->user()->empleado->id);
        if ($habilitarTodos) {
            $aprobaciones = Timesheet::where('estatus', 'pendiente')
                ->where('estatus', 'pendiente')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get();
        } else {
            $aprobaciones = Timesheet::where('estatus', 'pendiente')
                ->where('estatus', 'pendiente')
                ->where('aprobador_id', auth()->user()->empleado->id)
                ->get();
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.aprobaciones', compact('aprobaciones', 'logo_actual', 'empresa_actual', 'habilitarTodos'));
    }

    public function aprobados(Request $request)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habilitarTodos = $request->habilitarTodos ? true : false;
        $equipo_a_cargo = $this->obtenerEquipo(auth()->user()->empleado->children);
        array_push($equipo_a_cargo, auth()->user()->empleado->id);

        if ($habilitarTodos) {
            $aprobados = Timesheet::where('estatus', 'aprobado')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get();
        } else {
            $aprobados = Timesheet::where('estatus', 'aprobado')
                ->where('aprobador_id', auth()->user()->empleado->id)
                ->get();
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.aprobados', compact('aprobados', 'logo_actual', 'empresa_actual', 'habilitarTodos'));
    }

    public function rechazos(Request $request)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $habilitarTodos = $request->habilitarTodos ? true : false;
        $equipo_a_cargo = $this->obtenerEquipo(auth()->user()->empleado->children);
        array_push($equipo_a_cargo, auth()->user()->empleado->id);

        if ($habilitarTodos) {
            $rechazos = Timesheet::where('estatus', 'rechazado')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get();
        } else {
            $rechazos = Timesheet::where('estatus', 'rechazado')
                ->where('aprobador_id', auth()->user()->empleado->id)
                ->get();
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.rechazos', compact('rechazos', 'logo_actual', 'empresa_actual', 'habilitarTodos'));
    }

    public function aprobar(Request $request, $id)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_horas'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $aprobar = Timesheet::find($id);
        $aprobar->update([
            'estatus' => 'aprobado',
            'comentarios' => $request->comentarios,
        ]);

        $solicitante = Empleado::select('id', 'name', 'email', 'foto')->find($aprobar->empleado_id);

        $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find($aprobar->aprobador_id);

        Mail::to($solicitante->email)->send(new TimesheetSolicitudAprobada($aprobador, $aprobar, $solicitante));

        return redirect()->route('admin.timesheet-aprobaciones')->with('success', 'Guardado con éxito');
    }

    public function rechazar(Request $request, $id)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_horas'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rechazar = Timesheet::find($id);
        $rechazar->update([
            'estatus' => 'rechazado',
            'comentarios' => $request->comentarios,
        ]);

        $solicitante = Empleado::select('id', 'name', 'email', 'foto')->find($rechazar->empleado_id);

        $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find($rechazar->aprobador_id);

        Mail::to($solicitante->email)->send(new TimesheetSolicitudRechazada($aprobador, $rechazar, $solicitante));

        return redirect()->route('admin.timesheet-aprobaciones')->with('success', 'Guardado con éxito');
    }

    public function clientes()
    {
        abort_if(Gate::denies('timesheet_administrador_clientes_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clientes = TimesheetCliente::orderByDesc('id')->get();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.clientes.index', compact('clientes', 'logo_actual', 'empresa_actual'));
    }

    public function clientesCreate()
    {
        return view('admin.timesheet.clientes.create');
    }

    public function clientesEdit($id)
    {
        $cliente = TimesheetCliente::find($id);

        return view('admin.timesheet.clientes.edit', compact('cliente'));
    }

    public function clientesStore(Request $request)
    {
        $request->validate(
            [
                'identificador' => 'required|unique:timesheet_clientes,identificador',
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
            ],
        );

        $cliente_nuevo = TimesheetCliente::create($request->all());

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Guardado con éxito');
    }

    public function clientesUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'identificador' => "required|unique:timesheet_clientes,identificador,{$id}",
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
            ],
        );

        $cliente = TimesheetCliente::find($id);
        $cliente->update($request->all());

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Guardado con éxito');
    }

    public function clientesDelete($id)
    {
        $cliente_borrado = TimesheetCliente::find($id);

        $cliente_borrado->delete();

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Eliminado');
    }

    public function dashboard()
    {
        $counters = $this->timesheetService->totalCounters();
        $areas_array = $this->timesheetService->totalRegisterByAreas();
        $proyectos = $this->timesheetService->getRegistersByProyects();

        return view(
            'admin.timesheet.dashboard',
            compact('counters', 'areas_array', 'proyectos')
        );
    }

    public function reportes()
    {
        $clientes = TimesheetCliente::getAll();

        $proyectos = TimesheetProyecto::getAll();

        $tareas = TimesheetTarea::getAll();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reportes', compact('clientes', 'proyectos', 'tareas', 'logo_actual', 'empresa_actual'));
    }

    public function obtenerTareas(Request $request)
    {
        $proyecto_id = $request->proyecto_id;
        $tareas_obtenidas = TimesheetTarea::where('proyecto_id', $proyecto_id)->get();
        $tareas_array = collect();

        foreach ($tareas_obtenidas as $key => $tarea) {
            if (($tarea->todos == true) || ($tarea->area_id == auth()->user()->empleado->area_id)) {
                $tareas_array->push([
                    'id' => $tarea->id,
                    'tarea' => $tarea->tarea,
                ]);
            }
        }

        return response()->json(['tareas' => $tareas_array]);
    }

    public function reporteAprobador($id)
    {
        $aprobador = Empleado::find($id);

        $empleados_childern = $aprobador->children;

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reporte-aprobador', compact('logo_actual', 'empresa_actual'));
    }

    public function proyectosEmpleados($id)
    {
        $proyecto = TimesheetProyecto::find($id);

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.proyecto-empleados', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function proyectosExternos($id)
    {
        $proyecto = TimesheetProyecto::find($id);

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.proyecto-externos', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function editProyectos($id)
    {
        $proyecto = TimesheetProyecto::find($id);
        $clientes = TimesheetCliente::getAll();
        $areas = Area::getAll();
        $sedes = Sede::getAll();
        $tipos = TimesheetProyecto::TIPOS;
        $tipo = $tipos['Interno'];

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.edit-proyectos', compact('proyecto', 'logo_actual', 'empresa_actual', 'clientes', 'areas', 'sedes', 'tipos'));
    }

    public function notificacionhorassobrepasadas($id)
    {
        // dd("Si llega a la funcion");
        $verificacion_proyectos = TimesheetProyectoEmpleado::where('empleado_id', '=', $id)->with('empleado', 'proyecto')->exists();
        // dd($emp_proyectos);
        if ($verificacion_proyectos === false) {
            return null;
        } else {
            $emp_proyectos = TimesheetProyectoEmpleado::where('empleado_id', '=', $id)->with('empleado', 'proyecto')->get();
        }

        foreach ($emp_proyectos as $ep) {
            $times = TimesheetHoras::where('proyecto_id', '=', $ep->proyecto_id)
                ->where('empleado_id', '=', $ep->empleado_id)
                ->get();

            $tot_horas_proyecto = 0;

            $sumalun = $times->sum('horas_lunes');
            $sumamar = $times->sum('horas_martes');
            $sumamie = $times->sum('horas_miercoles');
            $sumajue = $times->sum('horas_jueves');
            $sumavie = $times->sum('horas_viernes');
            $sumasab = $times->sum('horas_sabado');
            $sumadom = $times->sum('horas_domingo');

            $tot_horas_proyecto = $sumalun + $sumamar + $sumamie + $sumajue + $sumavie + $sumasab + $sumadom;

            if ($ep->proyecto->tipo === 'Externo') {
                if ($tot_horas_proyecto > $ep->horas_asignadas) {
                    // if($ep->correo_enviado == false){

                    $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->supervisor_id);

                    $empleado = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->id);
                    //Se comentaron los correos a quienes se les enviara al final
                    // Mail::to(['marco.luna@silent4business.com', 'eugenia.gomez@silent4business.com', $aprobador->email, $empleado->email])
                    Mail::to('marco.luna@silent4business.com')
                        ->send(new TimesheetHorasSobrepasadas($ep->empleado->name, $ep->proyecto->proyecto, $tot_horas_proyecto, $ep->horas_asignadas));

                    //     $ep->update([
                    //         'correo_enviado' => true,
                    //     ]);
                    // }
                }
            }
        }
    }
}

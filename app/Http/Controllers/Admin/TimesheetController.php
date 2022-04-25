<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organizacion;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use App\Models\Empleado;
use App\Models\Area;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class TimesheetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $times = timesheet::where('empleado_id', auth()->user()->empleado->id)->get();

        $todos_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->count();
        $borrador_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->where('estatus', 'papelera')->count();
        $pendientes_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->where('estatus', 'pendiente')->count();
        $aprobados_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->where('estatus', 'aprobado')->count();
        $rechazos_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->where('estatus', 'rechazado')->count();

        return view('admin.timesheet.index', compact('times', 'rechazos_contador', 'todos_contador', 'borrador_contador', 'pendientes_contador', 'aprobados_contador'));
    }

    public function timesheetInicio()
    {
        abort_if(Gate::denies('timesheet_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion = Organizacion::first();

        $rechazos_contador = Timesheet::where('empleado_id', auth()->user()->empleado->id)->where('estatus', 'rechazado')->count();
        $aprobar_contador = Timesheet::where('aprobador_id', auth()->user()->empleado->id)->where('estatus', 'pendiente')->count();

        return view('admin.timesheet.timesheet-inicio', compact('organizacion', 'rechazos_contador', 'aprobar_contador'));
    }

    public function actualizarDia(Request $request)
    {
        $organizacion = Organizacion::first();

        $organizacion->update([
            'dia_timesheet'=>$request->dia_timesheet,
            'inicio_timesheet'=>$request->inicio_timesheet,
        ]);

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
        $proyectos = TimesheetProyecto::get();
        $tareas = TimesheetTarea::get();

        $fechasRegistradas = Timesheet::where('empleado_id', auth()->user()->empleado->id)->pluck('fecha_dia')->toArray();

        $organizacion = Organizacion::first();

        return view('admin.timesheet.create', compact('proyectos', 'tareas', 'fechasRegistradas', 'organizacion'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_semana = Organizacion::first();

        $request->validate([
            'timesheet.1.proyecto' => 'required',
            'timesheet.1.tarea' => 'required',
        ]);
        if (
            $request->timesheet[1]['lunes'] == null &&
            $request->timesheet[1]['martes'] == null &&
            $request->timesheet[1]['miercoles'] == null &&
            $request->timesheet[1]['jueves'] == null &&
            $request->timesheet[1]['viernes'] == null &&
            $request->timesheet[1]['sabado'] == null &&
            $request->timesheet[1]['domingo'] == null
        ) {
            $request->validate([
                'timesheet.1.horas' => 'required',
            ]);
        }

        foreach ($request->timesheet as $index => $hora) {
            if ($index > 1) {
                if (array_key_exists('proyecto', $hora) || array_key_exists('tarea', $hora)) {
                    $request->validate([
                        "timesheet.{$index}.proyecto" => 'required',
                        "timesheet.{$index}.tarea" => 'required',
                    ]);

                    if (
                        $hora['lunes'] == null &&
                        $hora['martes'] == null &&
                        $hora['miercoles'] == null &&
                        $hora['jueves'] == null &&
                        $hora['viernes'] == null &&
                        $hora['sabado'] == null &&
                        $hora['domingo'] == null
                    ) {
                        $request->validate([
                            "timesheet.{$index}.horas" => 'required',
                        ]);
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
                ]);
            }
        }

        return redirect()->route('admin.timesheet')->with('success', 'Registro Enviado');
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

        return view('admin.timesheet.show', compact('timesheet', 'horas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proyectos = TimesheetProyecto::get();
        $tareas = TimesheetTarea::get();
        $timesheet = Timesheet::find($id);
        $fechasRegistradas = Timesheet::where('empleado_id', auth()->user()->empleado->id)->pluck('fecha_dia')->toArray();

        return view('admin.timesheet.edit', compact('timesheet', 'proyectos', 'tareas', 'fechasRegistradas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_semana = Organizacion::first();

        $request->validate([
            'timesheet.1.proyecto' => 'required',
            'timesheet.1.tarea' => 'required',
        ]);
        if (
            $request->timesheet[1]['lunes'] == null &&
            $request->timesheet[1]['martes'] == null &&
            $request->timesheet[1]['miercoles'] == null &&
            $request->timesheet[1]['jueves'] == null &&
            $request->timesheet[1]['viernes'] == null &&
            $request->timesheet[1]['sabado'] == null &&
            $request->timesheet[1]['domingo'] == null
        ) {
            $request->validate([
                'timesheet.1.horas' => 'required',
            ]);
        }

        foreach ($request->timesheet as $index => $hora) {
            if ($index > 1) {
                if (array_key_exists('proyecto', $hora) || array_key_exists('tarea', $hora)) {
                    $request->validate([
                        "timesheet.{$index}.proyecto" => 'required',
                        "timesheet.{$index}.tarea" => 'required',
                    ]);

                    if (
                        $hora['lunes'] == null &&
                        $hora['martes'] == null &&
                        $hora['miercoles'] == null &&
                        $hora['jueves'] == null &&
                        $hora['viernes'] == null &&
                        $hora['sabado'] == null &&
                        $hora['domingo'] == null
                    ) {
                        $request->validate([
                            "timesheet.{$index}.horas" => 'required',
                        ]);
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
                    ]);
                }
            }
        }

        return redirect()->route('admin.timesheet')->with('success', 'Registro Enviado');
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
        $clientes = TimesheetCliente::get();

        return view('admin.timesheet.proyectos', compact('clientes'));
    }

    public function tareas()
    {
        abort_if(Gate::denies('timesheet_administrador_tareas_proyectos_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.timesheet.tareas');
    }

    public function tareasProyecto($proyecto_id)
    {
        $proyecto_id = $proyecto_id;

        return view('admin.timesheet.tareas-proyecto', compact('proyecto_id'));
    }

    public function papelera()
    {
        abort_if(Gate::denies('mi_timesheet_horas_rechazadas_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $papelera = Timesheet::where('estatus', 'papelera')->where('empleado_id', auth()->user()->empleado->id)->get();

        return view('admin.timesheet.papelera', compact('papelera'));
    }

    public function aprobaciones()
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $aprobaciones = Timesheet::where('estatus', 'pendiente')
            ->where('estatus', 'pendiente')
            ->where('aprobador_id', auth()->user()->empleado->id)
            ->get();

        return view('admin.timesheet.aprobaciones', compact('aprobaciones'));
    }

    public function rechazos()
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rechazos = Timesheet::where('estatus', 'rechazado')
            ->where('aprobador_id', auth()->user()->empleado->id)
            ->get();

        return view('admin.timesheet.rechazos', compact('rechazos'));
    }

    public function aprobar(Request $request, $id)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_horas'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $aprobar = Timesheet::find($id);
        $aprobar->update([
            'estatus' => 'aprobado',
            'comentarios' => $request->comentarios,
        ]);

        return redirect()->route('admin.timesheet-aprobaciones')->with('success', 'Guardado con éxito');
    }

    public function rechazar($id)
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_horas'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $aprobar = Timesheet::find($id);
        $aprobar->update([
            'estatus' => 'rechazado',
        ]);

        return redirect()->route('admin.timesheet-aprobaciones')->with('success', 'Guardado con éxito');
    }

    public function clientes()
    {
        abort_if(Gate::denies('timesheet_administrador_clientes_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $clientes = TimesheetCliente::get();

        return view('admin.timesheet.clientes.index', compact('clientes'));
    }

    public function clientesCreate()
    {
        return view('admin.timesheet.clientes.create');
    }

    public function clientesStore(Request $request)
    {
        $cliente_nuevo = TimesheetCliente::create($request->all());

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Guardado con éxito');
    }

    // public function clientesEdit($id)
    // {
    //     return view('admin.timesheet.clientes.edit');
    // }

    // public function clientesStore(Request $request)
    // {
    //     $cliente = TimesheetCliente::find($id);

    //     $cliente->update($request->all());

    //     return redirect()->route('admin.timesheet-clientes')->with('success', 'Guardado con éxito');
    // }

    public function clientesDelete($id)
    {
        $cliente_borrado = TimesheetCliente::create($id);

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Eliminado');
    }

    public function dashboard()
    {
        $borrador_contador = Timesheet::where('estatus', 'papelera')->count();
        $pendientes_contador = Timesheet::where('estatus', 'pendiente')->count();
        $aprobados_contador = Timesheet::where('estatus', 'aprobado')->count();
        $rechazos_contador = Timesheet::where('estatus', 'rechazado')->count();

        // graf areas ------------
        $areas = Area::get();

        $areas_array = collect();
        foreach ($areas as $area) {
            $contador_times_aprobados_areas = 0;
            $contador_times_pendientes_areas = 0;
            $contador_times_rechazados_areas = 0;
            $proyectos_area = TimesheetProyecto::where('area_id', $area->id)->get();
            foreach ($proyectos_area as $pro_a) {
                $times_horas_area = TimesheetHoras::where('proyecto_id', $pro_a->id)->with('timesheet')->get();
                
                foreach ($times_horas_area as $times_h_a) {
                    if ($times_h_a->timesheet->estatus == 'pendiente') {
                        $contador_times_pendientes_areas++;
                    }
                    if ($times_h_a->timesheet->estatus == 'aprobado') {
                        $contador_times_aprobados_areas++;
                    }
                    if ($times_h_a->timesheet->estatus == 'rechazado') {
                        $contador_times_rechazados_areas++;
                    }
                }
            }
            $areas_array->push([
                'area'=>$area->area,
                'times_aprobados'=>$contador_times_aprobados_areas,
                'times_pendientes'=>$contador_times_pendientes_areas,
                'times_rechazados'=>$contador_times_rechazados_areas,
            ]);
        }

        // graf empleados ---------------------
        $hoy = Carbon::now();
        $semanas_del_mes = intval(($hoy->format('d') * 4) / 29);
        $empleados_partisipacion = Empleado::get();
        $empleados_count = Empleado::count();
        $times_por_mes_esperados = $semanas_del_mes * $empleados_count;
        $total_times_mes = 0;
        $empleados_times_atrasados = 0;
        foreach ($empleados_partisipacion as $emp_part) {
            $times_empleado_part = Timesheet::whereMonth('fecha_dia', $hoy)->where('empleado_id', $emp_part->id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->count();
            $total_times_mes += $times_empleado_part;

            if ($times_empleado_part < ($semanas_del_mes - 1) ) {
                $empleados_times_atrasados ++;
            }
        }
        $porcentaje_participacion = round((($total_times_mes * 100) / $times_por_mes_esperados), 2);
        
        // graf proyectos -----------------------
        $proyectos_proceso_c = TimesheetProyecto::where('estatus', 'proceso')->count();
        $proyectos_cancelados_c = TimesheetProyecto::where('estatus', 'cancelado')->count();
        $proyectos_terminados_c = TimesheetProyecto::where('estatus', 'terminado')->count();

        $proyectos_proceso = TimesheetProyecto::get();
        $proyectos_array = collect();
        foreach ($proyectos_proceso as $proyect) {
            $horas_totales_proyecto = 0;
            $tareas_proyecto = TimesheetTarea::where('proyecto_id', $proyect->id)->get();
            foreach ($tareas_proyecto as $tarea_p) {
                $horas_proyecto = TimesheetHoras::where('tarea_id', $tarea_p->id)->get();
                foreach ($horas_proyecto as $horas_p) {
                    $horas_totales_proyecto += $horas_p->horas_lunes;
                    $horas_totales_proyecto += $horas_p->horas_martes;
                    $horas_totales_proyecto += $horas_p->horas_miercoles;
                    $horas_totales_proyecto += $horas_p->horas_jueves;
                    $horas_totales_proyecto += $horas_p->horas_viernes;
                    $horas_totales_proyecto += $horas_p->horas_sabado;
                    $horas_totales_proyecto += $horas_p->horas_domingo;
                }
            }
            $proyectos_array->push([
                'proyecto'=>$proyect->proyecto,
                'horas'=>$horas_totales_proyecto,
                'tareas'=>$tareas_proyecto,
                'tareas_count'=>$tareas_proyecto->count(),
                'estatus'=>$proyect->estatus,
            ]);
        }

        $proyectos_proceso_array = 0;
        $proyectos_cancelado_array = 0;
        $proyectos_terminado_array = 0;
        foreach ($proyectos_array as $proyect_array) {
            if ($proyect_array['estatus'] == 'proceso') {
                $proyectos_proceso_array += $proyect_array['horas'];
            }
            if ($proyect_array['estatus'] == 'cancelado') {
                $proyectos_cancelado_array += $proyect_array['horas'];
            }
            if ($proyect_array['estatus'] == 'terminado') {
                $proyectos_terminado_array += $proyect_array['horas'];
            }
        }

        return view('admin.timesheet.dashboard', compact('borrador_contador', 'pendientes_contador', 'aprobados_contador', 'rechazos_contador', 'areas_array', 'porcentaje_participacion', 'empleados_times_atrasados', 'empleados_count', 'areas', 'proyectos_proceso_c', 'proyectos_cancelados_c', 'proyectos_terminados_c', 'proyectos_array', 'proyectos_proceso_array', 'proyectos_cancelado_array', 'proyectos_terminado_array'));
    }

    public function reportes()
    {
        $clientes = TimesheetCliente::get();

        $proyectos = TimesheetProyecto::get();

        $tareas = TimesheetTarea::get();

        return view('admin.timesheet.reportes', compact('clientes', 'proyectos', 'tareas'));
    }
}

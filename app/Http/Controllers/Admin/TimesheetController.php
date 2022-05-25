<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TimesheetHorasSolicitudAprobacion;
use App\Mail\TimesheetSolicitudAprobada;
use App\Mail\TimesheetSolicitudRechazada;
use App\Models\Area;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetTarea;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;

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

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.index', compact('times', 'rechazos_contador', 'todos_contador', 'borrador_contador', 'pendientes_contador', 'aprobados_contador', 'logo_actual', 'empresa_actual'));
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
            'fecha_registro_timesheet'=>$request->fecha_registro_timesheet,
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
        // $proyectos = TimesheetProyecto::get();
        // $tareas = TimesheetTarea::get();

        $fechasRegistradas = Timesheet::where('empleado_id', auth()->user()->empleado->id)->pluck('fecha_dia')->toArray();

        $organizacion = Organizacion::first();

        return view('admin.timesheet.create', compact('fechasRegistradas', 'organizacion'));
    }

    public function createCopia($id)
    {
        $empleado = Empleado::find(auth()->user()->empleado->id);
        $proyectos = TimesheetProyecto::where('area_id', $empleado->area_id)->get();
        $tareas = TimesheetTarea::get();
        $timesheet = Timesheet::find($id);
        $fechasRegistradas = Timesheet::where('empleado_id', auth()->user()->empleado->id)->pluck('fecha_dia')->toArray();
        $organizacion = Organizacion::first();
        $horas_count = TimesheetHoras::where('timesheet_id', $id)->count();

        return view('admin.timesheet.create-copia', compact('timesheet', 'proyectos', 'tareas', 'fechasRegistradas', 'organizacion', 'horas_count'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_semana = Organizacion::first();

        $request->validate(
            [
                'timesheet.1.proyecto' => 'required',
                'timesheet.1.tarea' => 'required',
                'fecha_dia' => 'required',
            ],
            [
                'timesheet.*.proyecto.required'=>'Seleccionar proyecto',
                'timesheet.*.tarea.required'=>'Seleccionar tarea',
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
                ]);
            }
        }

        if ($timesheet_nuevo->estatus == 'pendiente') {
            $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->supervisor_id);

            $solicitante = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->id);

            Mail::to($aprobador->email)->send(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_nuevo, $solicitante));
        }

        return response()->json(['status'=>200]);
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

        $hoy = Carbon::now();
        $hoy_format = $hoy->format('d/m/Y');

        return view('admin.timesheet.show', compact('timesheet', 'horas', 'hoy_format'));
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
        $proyectos = TimesheetProyecto::where('area_id', $empleado->area_id)->get();
        $tareas = TimesheetTarea::get();
        $timesheet = Timesheet::find($id);
        $fechasRegistradas = Timesheet::where('empleado_id', auth()->user()->empleado->id)->pluck('fecha_dia')->toArray();
        $organizacion = Organizacion::first();
        $horas_count = TimesheetHoras::where('timesheet_id', $id)->count();

        return view('admin.timesheet.edit', compact('timesheet', 'proyectos', 'tareas', 'fechasRegistradas', 'organizacion', 'horas_count'));
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
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_semana = Organizacion::first();

        $request->validate(
            [
                'timesheet.1.proyecto' => 'required',
                'timesheet.1.tarea' => 'required',
            ],
            [
                'timesheet.*.proyecto.required'=>'Seleccionar proyecto',
                'timesheet.*.tarea.required'=>'Seleccionar tarea',
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

        if ($timesheet_edit->estatus == 'pendiente') {
            $aprobador = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->supervisor_id);

            $solicitante = Empleado::select('id', 'name', 'email', 'foto')->find(auth()->user()->empleado->id);

            Mail::to($aprobador->email)->send(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_edit, $solicitante));
        }

        return response()->json(['status'=>200]);
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

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.proyectos', compact('clientes', 'logo_actual', 'empresa_actual'));
    }

    public function tareas()
    {
        abort_if(Gate::denies('timesheet_administrador_tareas_proyectos_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.tareas', compact('logo_actual', 'empresa_actual'));
    }

    public function tareasProyecto($proyecto_id)
    {
        $proyecto = TimesheetProyecto::select('proyecto', 'id')->find($proyecto_id);

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.tareas-proyecto', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function papelera()
    {
        abort_if(Gate::denies('mi_timesheet_horas_rechazadas_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $papelera = Timesheet::where('estatus', 'papelera')->where('empleado_id', auth()->user()->empleado->id)->get();

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.papelera', compact('papelera', 'logo_actual', 'empresa_actual'));
    }

    public function aprobaciones()
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $aprobaciones = Timesheet::where('estatus', 'pendiente')
            ->where('estatus', 'pendiente')
            ->where('aprobador_id', auth()->user()->empleado->id)
            ->get();

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.aprobaciones', compact('aprobaciones', 'logo_actual', 'empresa_actual'));
    }

    public function aprobados()
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $aprobados = Timesheet::where('estatus', 'aprobado')
            ->Where('aprobador_id', auth()->user()->empleado->id)
            ->get();

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.aprobados', compact('aprobados', 'logo_actual', 'empresa_actual'));
    }

    public function rechazos()
    {
        abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $rechazos = Timesheet::where('estatus', 'rechazado')
            ->Where('aprobador_id', auth()->user()->empleado->id)
            ->get();

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.rechazos', compact('rechazos', 'logo_actual', 'empresa_actual'));
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
        $clientes = TimesheetCliente::get();

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
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
        $borrador_contador = Timesheet::where('estatus', 'papelera')->count();
        $pendientes_contador = Timesheet::where('estatus', 'pendiente')->count();
        $aprobados_contador = Timesheet::where('estatus', 'aprobado')->count();
        $rechazos_contador = Timesheet::where('estatus', 'rechazado')->count();

        // graf areas ------------
        $hoy = Carbon::now();
        $semanas_del_mes = intval(($hoy->format('d') * 4) / 29);
        $empleados_partisipacion = Empleado::get();

        $areas = Area::get();

        $areas_array = collect();
        foreach ($areas as $area) {
            $times_complit_esperados_area = 0;

            $empleados_area = Empleado::where('area_id', $area->id)->get();
            foreach ($empleados_area as $empleado) {
                $fecha_inicio = date_create($empleado->antiguedad->format('d-m-Y'));
                $fecha_fin = date_create($hoy->format('d-m-Y'));
                $times_esperados_empleado = intval(date_diff($fecha_inicio, $fecha_fin)->format('%R%a') / 7);

                $times_complit_esperados_area += $times_esperados_empleado;
            }

            if ($times_complit_esperados_area == 0) {
                $times_complit_esperados_area = 1;
            }

            $total_times_complit_area = 0;
            $empleados_times_atrasados = 0;
            foreach ($empleados_partisipacion as $emp_part_area) {
                if ($emp_part_area->area_id == $area->id) {
                    $times_empleado_part_area = Timesheet::where('empleado_id', $emp_part_area->id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->where('estatus', '!=', 'pendiente')->count();
                } else {
                    $times_empleado_part_area = 0;
                }
                $total_times_complit_area += $times_empleado_part_area;
            }

            $porcentaje_participacion_area = round((($total_times_complit_area * 100) / $times_complit_esperados_area), 2);
            if ($total_times_complit_area >= $times_complit_esperados_area) {
                $porcentaje_participacion_area = 100;
            }
            if ($porcentaje_participacion_area <= 44) {
                $nivel_participacion = 'baja';
            }
            if (($porcentaje_participacion_area > 45) && ($porcentaje_participacion_area < 89)) {
                $nivel_participacion = 'media';
            }
            if ($porcentaje_participacion_area >= 90) {
                $nivel_participacion = 'alta';
            }
            $contador_times_aprobados_areas = 0;
            $contador_times_pendientes_areas = 0;
            $contador_times_rechazados_areas = 0;
            $contador_times_papelera_areas = 0;
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
                    if ($times_h_a->timesheet->estatus == 'papelera') {
                        $contador_times_papelera_areas++;
                    }
                }
            }
            $areas_array->push([
                'area'=>$area->area,
                'times_aprobados'=>$contador_times_aprobados_areas,
                'times_pendientes'=>$contador_times_pendientes_areas,
                'times_rechazados'=>$contador_times_rechazados_areas,
                'times_papelera'=>$contador_times_papelera_areas,
                'partisipacion'=>$porcentaje_participacion_area,
                'nivel_p'=>$nivel_participacion,
                'times_esperados'=>$times_complit_esperados_area,
            ]);
        }

        // graf empleados ---------------------
        $empleados_count = Empleado::count();
        $times_por_mes_esperados = $semanas_del_mes * $empleados_count;
        if ($times_por_mes_esperados == 0) {
            $times_por_mes_esperados = 1;
        }
        $total_times_mes = 0;
        $empleados_times_atrasados = 0;
        foreach ($empleados_partisipacion as $emp_part) {
            $times_empleado_part = Timesheet::whereMonth('fecha_dia', $hoy)->where('empleado_id', $emp_part->id)->where('estatus', '!=', 'rechazado')->where('estatus', '!=', 'papelera')->count();
            $total_times_mes += $times_empleado_part;

            if ($times_empleado_part < ($semanas_del_mes)) {
                $empleados_times_atrasados++;
            }
        }

        $porcentaje_participacion = round((($total_times_mes * 100) / $times_por_mes_esperados), 2);
        if ($total_times_mes >= $times_por_mes_esperados) {
            $porcentaje_participacion = 100;
        }

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

        $organizacion_actual = Organizacion::select('empresa', 'logotipo')->first();
        if (is_null($organizacion_actual)) {
            $organizacion_actual = new Organizacion();
            $organizacion_actual->logotipo = asset('img/logo.png');
            $organizacion_actual->empresa = 'Silent4Business';
        }
        $logo_actual = $organizacion_actual->logotipo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reportes', compact('clientes', 'proyectos', 'tareas', 'logo_actual', 'empresa_actual'));
    }

    public function obtenerTareas(Request $request)
    {
        $proyecto_id = $request->proyecto_id;
        $tareas_obtenidas = TimesheetTarea::where('proyecto_id', $proyecto_id)->get();

        return response()->json(['tareas'=>$tareas_obtenidas]);
    }
}

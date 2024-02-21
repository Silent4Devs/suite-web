<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\MiExcepcionTimeshetClientes;
use App\Http\Controllers\Controller;
use App\Jobs\NuevoProyectoJob;
use App\Mail\TimesheetHorasSobrepasadas;
use App\Mail\TimesheetHorasSolicitudAprobacion;
use App\Mail\TimesheetSolicitudAprobada;
use App\Mail\TimesheetSolicitudRechazada;
use App\Models\Area;
use App\Models\ContractManager\Fiscale;
use App\Models\Empleado;
use App\Models\ListaInformativa;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\Timesheet;
use App\Models\TimesheetCliente;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyecto;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\TimesheetTarea;
use App\Models\User;
use App\Services\TimesheetService;
use App\Traits\ObtenerOrganizacion;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use PDF;
use Throwable;

class TimesheetController extends Controller
{
    use ObtenerOrganizacion;

    public $modelo_proyectos = 'TimesheetProyecto';

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
    public function index($estatus = 'todos')
    {
        $cacheKey = 'timesheet-' . User::getCurrentUser()->empleado->id;

        $times = Timesheet::getPersonalTimesheet();

        $todos_contador = $times->count();
        $borrador_contador = $times->where('estatus', 'papelera')->count();
        $pendientes_contador = $times->where('estatus', 'pendiente')->count();
        $aprobados_contador = $times->where('estatus', 'aprobado')->count();
        $rechazos_contador = $times->where('estatus', 'rechazado')->count();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.mis-registros', compact('times', 'rechazos_contador', 'todos_contador', 'borrador_contador', 'pendientes_contador', 'aprobados_contador', 'logo_actual', 'empresa_actual', 'estatus'));
    }

    public function misRegistros($estatus = 'todos')
    {
        $times = Timesheet::getPersonalTimesheet();

        $todos_contador = $times->count();
        $borrador_contador = $times->where('estatus', 'papelera')->count();
        $pendientes_contador = $times->where('estatus', 'pendiente')->count();
        $aprobados_contador = $times->where('estatus', 'aprobado')->count();
        $rechazos_contador = $times->where('estatus', 'rechazado')->count();

        $times = $times->sortByDesc('created_at');

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.mis-registros', compact('times', 'rechazos_contador', 'todos_contador', 'borrador_contador', 'pendientes_contador', 'aprobados_contador', 'logo_actual', 'empresa_actual', 'estatus'));
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
        $aprobar_contador = Timesheet::where('aprobador_id', User::getCurrentUser()->empleado->id)->where('estatus', 'pendiente')->count();

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

        return redirect()->route('admin.timesheet-create')->with('success', 'Guardado con éxito');
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

        // Si la fecha no está registrada, continúa con la vista de creación.
        return view('admin.timesheet.create', compact('fechasRegistradas', 'organizacion'));
    }

    public function createCopia($id)
    {
        $empleado = Empleado::find(User::getCurrentUser()->empleado->id);

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
        $horas_count = TimesheetHoras::getData()->where('timesheet_id', $id)->count();

        return view('admin.timesheet.create-copia', compact('timesheet', 'proyectos', 'tareas', 'fechasRegistradas', 'organizacion', 'horas_count'));
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        DB::beginTransaction();

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
        $usuario = User::getCurrentUser();

        try {
            $timesheet_nuevo = Timesheet::create([
                'fecha_dia' => $request->fecha_dia,
                'dia_semana' => $organizacion_semana->dia_timesheet,
                'inicio_semana' => $organizacion_semana->inicio_timesheet,
                'fin_semana' => $organizacion_semana->fin_timesheet,
                'empleado_id' => $usuario->empleado->id,
                'aprobador_id' => $usuario->empleado->supervisor_id,
                'estatus' => $request->estatus,
            ]);

            foreach ($request->timesheet as $index => $hora) {
                if (array_key_exists('proyecto', $hora) && array_key_exists('tarea', $hora)) {

                    foreach ($hora as $key => $value) {
                        if ($value === '') {
                            $hora[$key] = null;
                        }
                    }

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
                        'empleado_id' => $usuario->empleado->id,
                    ]);
                }
            }

            if ($timesheet_nuevo->estatus == 'pendiente') {
                $aprobador = Empleado::find($usuario->empleado->supervisor_id);

                $solicitante = Empleado::find($usuario->empleado->id);

                try {
                    // Enviar correo
                    Mail::to(removeUnicodeCharacters($aprobador->email))->queue(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_nuevo, $solicitante));
                } catch (Throwable $e) {
                    report($e);

                    return response()->json(['status' => 520]);
                }
            }

            $this->notificacionhorassobrepasadas($usuario->empleado->id);

            // Your database operations here
            DB::commit();

            return response()->json(['status' => 200]);
        }
        // catch exception and rollback transaction
        catch (Throwable $e) {
            DB::rollback();

            // throw $e;
            return response()->json(['status' => 400]);
        }

        // return redirect()->route('admin.timesheet-mis-registros')->with('success', 'Registro Enviado');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $timesheet = Timesheet::find($id);

            $horas = TimesheetHoras::where('timesheet_id', $id)->get();
            $horas_count = $horas->count();

            $hoy = Carbon::now();
            $hoy_format = $hoy->format('d/m/Y');

            return view('admin.timesheet.show', compact('timesheet', 'horas', 'hoy_format', 'horas_count'));
        } catch (\Exception $e) {
            return redirect('admin/timesheet/proyectos')->with('error', 'No se localizo  ningun id  en la ruta');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleado = Empleado::find(Auth::user()->empleado->id);
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

        $horas_count = TimesheetHoras::select('id')->where('timesheet_id', $id)->count();

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
        $usuario = User::getCurrentUser();
        $timesheet_edit->update([
            'empleado_id' => $usuario->empleado->id ?? null,
            'aprobador_id' => $usuario->empleado->supervisor_id ?? null,
            'estatus' => $request->estatus ?? null,
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
                        'empleado_id' => $usuario->empleado->id,
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
                        'empleado_id' => $usuario->empleado->id,
                    ]);
                }
            }
        }

        if ($timesheet_edit->estatus == 'pendiente') {
            $aprobador = Empleado::getDataColumns()->find($usuario->empleado->supervisor_id);

            $solicitante = Empleado::getDataColumns()->find($usuario->empleado->id);

            try {
                // Enviar correo
                Mail::to(removeUnicodeCharacters($aprobador->email))->queue(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_edit, $solicitante));
            } catch (Throwable $e) {
                report($e);

                return response()->json(['status' => 520]);
            }
        }

        $this->notificacionhorassobrepasadas($usuario->empleado->id);

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
        if ($request->fecha_fin) {
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
            'fecha_inicio' => $request->fecha_inicio == '' ? null : $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin == '' ? null : $request->fecha_fin,
            'sede_id' => $request->sede_id,
            'tipo' => $request->tipo,
            'horas_proyecto' => $request->horas_proyecto == '' ? null : $request->horas_proyecto,
        ]);

        foreach ($request->areas_seleccionadas as $key => $area_id) {
            TimesheetProyectoArea::create([
                'proyecto_id' => $nuevo_proyecto->id,
                'area_id' => $area_id,
            ]);
        }

        $informados = ListaInformativa::with('participantes.empleado', 'usuarios.usuario')->where('modelo', '=', $this->modelo_proyectos)->first();

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

            dispatch(
                new NuevoProyectoJob(
                    $correos,
                    $nuevo_proyecto->proyecto,
                    $nuevo_proyecto->identificador,
                    $nuevo_proyecto->cliente->nombre,
                    User::getCurrentUser()->empleado->name,
                    $nuevo_proyecto->id
                )
            );
        }

        // return redirect('admin/timesheet/proyecto-empleados/' . $nuevo_proyecto->id);
        return redirect('admin/timesheet/proyectos');
    }

    public function showProyectos($id)
    {
        $proyecto = TimesheetProyecto::getAll($id)->find($id);

        if (!$proyecto) {
            return redirect()->route('admin.timesheet-proyectos')->with('error', 'El registro fue eliminado ');
        }
        $areas = TimesheetProyectoArea::where('proyecto_id', $id)
            ->join('areas', 'timesheet_proyectos_areas.area_id', '=', 'areas.id')
            ->get('areas.area');

        $sedes = TimesheetProyecto::getAll('sedes_' . $id)->where('timesheet_proyectos.id', $id)
            ->join('sedes', 'timesheet_proyectos.sede_id', '=', 'sedes.id')
            ->get('sedes.sede');

        $clientes = TimesheetProyecto::getAll('clientes_' . $id)->where('timesheet_proyectos.id', $id)
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

        // // return back()->with('success', 'Guardado con éxito');
        return redirect('admin/timesheet/proyectos')->with('success', 'Guardado con éxito');
        // return redirect('admin/timesheet/proyecto-empleados/'.$edit_proyecto->id);
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
        $proyecto = TimesheetProyecto::getAll('tareas_' . $proyecto_id)->find($proyecto_id);

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.tareas-proyecto', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function papelera()
    {
        abort_if(Gate::denies('mi_timesheet_horas_rechazadas_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $papelera = Timesheet::where('estatus', 'papelera')->where('empleado_id', User::getCurrentUser()->empleado->id)->get();

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
        $usuario = User::getCurrentUser();
        $equipo_a_cargo = $this->obtenerEquipo($usuario->empleado->children);
        array_push($equipo_a_cargo, $usuario->empleado->id);
        if ($habilitarTodos) {
            $aprobaciones = Timesheet::where('estatus', 'pendiente')
                ->where('estatus', 'pendiente')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get();
        } else {
            $aprobaciones = Timesheet::where('estatus', 'pendiente')
                ->where('estatus', 'pendiente')
                ->where('aprobador_id', $usuario->empleado->id)
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
        $usuario = User::getCurrentUser();
        $equipo_a_cargo = $this->obtenerEquipo($usuario->empleado->children);
        array_push($equipo_a_cargo, $usuario->empleado->id);

        if ($habilitarTodos) {
            $aprobados = Timesheet::where('estatus', 'aprobado')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get();
        } else {
            $aprobados = Timesheet::where('estatus', 'aprobado')
                ->where('aprobador_id', $usuario->empleado->id)
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
        $usuario = User::getCurrentUser();
        $equipo_a_cargo = $this->obtenerEquipo($usuario->empleado->children);
        array_push($equipo_a_cargo, $usuario->empleado->id);

        if ($habilitarTodos) {
            $rechazos = Timesheet::where('estatus', 'rechazado')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get();
        } else {
            $rechazos = Timesheet::where('estatus', 'rechazado')
                ->where('aprobador_id', $usuario->empleado->id)
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

        $solicitante = Empleado::getDataColumns()->find($aprobar->empleado_id);

        $aprobador = Empleado::getDataColumns()->find($aprobar->aprobador_id);

        try {
            // Enviar correo
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new TimesheetSolicitudAprobada($aprobador, $aprobar, $solicitante));
        } catch (Throwable $e) {
            report($e);

            return redirect()->route('admin.timesheet-aprobaciones')->with('success', 'Guardado con éxito, correo no enviado');
        }

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

        $solicitante = Empleado::getDataColumns()->find($rechazar->empleado_id);

        $aprobador = Empleado::getDataColumns()->find($rechazar->aprobador_id);

        try {
            // Enviar correo
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new TimesheetSolicitudRechazada($aprobador, $rechazar, $solicitante));
        } catch (Throwable $e) {
            report($e);

            return redirect()->route('admin.timesheet-aprobaciones')->with('success', 'Guardado con éxito, correo no enviado');
        }

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
        // $personas = Fiscale::get();
        return view('admin.timesheet.clientes.create');
    }

    public function clientesEdit($id)
    {
        try {

            $cliente = TimesheetCliente::find($id);

            if (!$cliente) {
                return redirect()->route('admin.timesheet-clientes')->with('error', 'El registro fue eliminado ');
            }

            return view('admin.timesheet.clientes.edit', compact('cliente'));
        } catch (MiExcepcionTimeshetClientes $excepcionPersonalizada) {

            Log::error('Ocurrió una excepción personalizada: ' . $excepcionPersonalizada->getMessage());

            return response()->json(['error' => $excepcionPersonalizada->getMessage()], 400);
        }
    }

    public function clientesStore(Request $request)
    {
        $request->validate(
            [
                'identificador' => 'required|unique:timesheet_clientes,identificador',
                'razon_social' => 'required|string|max:255',
                'nombre' => 'required|string|max:255',
                'rfc' => 'max:15',
                'calle' => 'max:255',
                'colonia' => 'max:255',
                'ciudad' => 'max:255',
                'codigo_postal' => 'max:255',
                'telefono' => 'max:255',
                'pagina_web' => 'max:255',
                'nombre_contacto' => 'max:255',
                'puesto_contacto' => 'max:255',
                'correo_contacto' => 'max:255',
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
                'razon_social.max' => 'La  razon social no debe exceder de 255 caracteres',
                'nombre.max' => 'El nombre no debe exceder de 255 caracteres',
                'rfc.max' => 'El rfc no debe exceder de 255 caracteres',
                'calle.max' => 'El calle no debe exceder de 255 caracteres',
                'colonia.max' => 'La colonia no debe exceder de 255 caracteres',
                'codigo_postal.max' => 'El codigo_postal no debe exceder de 255 caracteres',
                'telefono.max' => 'El telefono no debe exceder de 255 caracteres',
                'pagina_web.max' => 'La pagina_web no debe exceder de 255 caracteres',
                'nombre_contacto.max' => 'El nombre_contacto no debe exceder de 255 caracteres',
                'puesto_contacto.max' => 'El puesto_contacto no debe exceder de 255 caracteres',
                'correo_contacto.max' => 'El correo_contacto no debe exceder de 255 caracteres',
            ],
        );

        $cliente_nuevo = TimesheetCliente::create($request->all());

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Guardado con éxito');
    }

    public function clientesUpdate(Request $request, $id)
    {
        $request->validate(
            [
                'identificador' => 'required|unique:timesheet_clientes,identificador',
                'razon_social' => 'required|string|max:255',
                'nombre' => 'required|string|max:255',
                'rfc' => 'max:15',
                'calle' => 'max:255',
                'colonia' => 'max:255',
                'ciudad' => 'max:255',
                'codigo_postal' => 'max:255',
                'telefono' => 'max:255',
                'pagina_web' => 'max:255',
                'nombre_contacto' => 'max:255',
                'puesto_contacto' => 'max:255',
                'correo_contacto' => 'max:255',
            ],
            [
                'identificador.unique' => 'El ID ya esta en uso',
                'razon_social.max' => 'La  razon social no debe exceder de 255 caracteres',
                'nombre.max' => 'El nombre no debe exceder de 255 caracteres',
                'rfc.max' => 'El rfc no debe exceder de 255 caracteres',
                'calle.max' => 'El calle no debe exceder de 255 caracteres',
                'colonia.max' => 'La colonia no debe exceder de 255 caracteres',
                'codigo_postal.max' => 'El codigo_postal no debe exceder de 255 caracteres',
                'telefono.max' => 'El telefono no debe exceder de 255 caracteres',
                'pagina_web.max' => 'La pagina_web no debe exceder de 255 caracteres',
                'nombre_contacto.max' => 'El nombre_contacto no debe exceder de 255 caracteres',
                'puesto_contacto.max' => 'El puesto_contacto no debe exceder de 255 caracteres',
                'correo_contacto.max' => 'El correo_contacto no debe exceder de 255 caracteres',
            ],
        );

        $cliente = TimesheetCliente::find($id);
        $cliente->update($request->all());

        return redirect()->route('admin.timesheet-clientes')->with('success', 'Guardado con éxito');
    }

    public function clientesDelete($id)
    {
        $cliente_borrado = TimesheetCliente::find($id);

        $cliente_borrado->forceDelete();

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

        return view('admin.timesheet.reportes', compact(
            // 'clientes', 'proyectos', 'tareas',
            'logo_actual',
            'empresa_actual'
        ));
    }

    public function reportesRegistros()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reportes.reportes-registros', compact('logo_actual', 'empresa_actual'));
    }

    public function reportesEmpleados()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reportes.reportes-empleados', compact('logo_actual', 'empresa_actual'));
    }

    public function reportesProyectos()
    {
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reportes.reportes-proyectos', compact('logo_actual', 'empresa_actual'));
    }

    public function reportesProyemp()
    {
        $proyectos = TimesheetProyecto::getAll();

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.reportes.reportes-proyemp', compact('proyectos', 'logo_actual', 'empresa_actual'));
    }

    public function obtenerTareas(Request $request)
    {
        $proyecto_id = $request->proyecto_id;
        $tareas_obtenidas = TimesheetTarea::where('proyecto_id', $proyecto_id)->get();
        $tareas_array = collect();

        foreach ($tareas_obtenidas as $key => $tarea) {
            if (($tarea->todos == true) || ($tarea->area_id == User::getCurrentUser()->empleado->area_id)) {
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
        $proyecto = TimesheetProyecto::getAll('empleado_' . $id)->find($id);

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.proyecto-empleados', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function proyectosExternos($id)
    {
        $proyecto = TimesheetProyecto::getAll('externos_' . $id)->find($id);

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.proyecto-externos', compact('proyecto', 'logo_actual', 'empresa_actual'));
    }

    public function editProyectos($id)
    {
        $proyecto = TimesheetProyecto::getAll()->find($id);
        if (!$proyecto) {
            return redirect()->route('admin.timesheet-proyectos')->with('error', 'El registro fue eliminado ');
        }
        $clientes = TimesheetCliente::getAll();
        $areas = Area::getIdNameAll();
        $sedes = Sede::getAll();
        $tipos = TimesheetProyecto::TIPOS;
        $tipo = $tipos['Interno'];

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.timesheet.edit-proyectos', compact('proyecto', 'logo_actual', 'empresa_actual', 'clientes', 'areas', 'sedes', 'tipos'));
    }

    public function pdf($id)
    {
        $timesheet = Timesheet::with('horas.proyecto', 'horas.tarea')->where('id', $id)->first();
        $organizacions = Organizacion::getFirst();
        $logo_actual = $organizacions->logo;

        // Cargar la vista 'timesheet' con los datos necesarios
        $view = view('timesheet', compact('timesheet', 'organizacions', 'logo_actual'));

        // Crear una instancia de la clase PDF
        $pdf = \PDF::loadHTML($view);

        // Configurar el tamaño del papel y la orientación
        $pdf->setPaper('tabloid', 'landscape');

        // Descargar el PDF
        return $pdf->download('timesheet.pdf');
    }

    public function pdfClientes()
    {

        $timesheetCliente = TimesheetCliente::get();
        $organizacions = Organizacion::getFirst();
        $logo_actual = $organizacions->logo;

        $pdf = PDF::loadView('timesheetCliente', compact('timesheetCliente', 'organizacions', 'logo_actual'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->download('clientes.pdf');
    }

    public function notificacionhorassobrepasadas($id)
    {
        // dd("Si llega a la funcion");
        $verificacion_proyectos = TimesheetProyectoEmpleado::select('id', 'empleado_id')->where('empleado_id', '=', $id)->with('empleado', 'proyecto')->exists();
        // dd($emp_proyectos);
        if ($verificacion_proyectos) {
            $emp_proyectos = TimesheetProyectoEmpleado::where('empleado_id', '=', $id)->with('empleado', 'proyecto')->get();
        } else {
            return null;
        }

        foreach ($emp_proyectos as $ep) {
            $times = TimesheetHoras::where('proyecto_id', '=', $ep->proyecto_id)
                ->where('empleado_id', '=', $ep->empleado_id)
                ->get();

            if ($ep->proyecto->tipo === 'Externo') {

                $tot_horas_proyecto = 0;

                $sumalun = 0;
                $sumamar = 0;
                $sumamie = 0;
                $sumajue = 0;
                $sumavie = 0;
                $sumasab = 0;
                $sumadom = 0;

                foreach ($times as $time) {
                    $sumalun += floatval($time->horas_lunes);
                    $sumamar += floatval($time->horas_martes);
                    $sumamie += floatval($time->horas_miercoles);
                    $sumajue += floatval($time->horas_jueves);
                    $sumavie += floatval($time->horas_viernes);
                    $sumasab += floatval($time->horas_sabado);
                    $sumadom += floatval($time->horas_domingo);
                }

                $tot_horas_proyecto = $sumalun + $sumamar + $sumamie + $sumajue + $sumavie + $sumasab + $sumadom;

                if ($tot_horas_proyecto > $ep->horas_asignadas) {
                    // if($ep->correo_enviado == false){
                    $empleado_query = Empleado::getDataColumns();

                    $aprobador = $empleado_query->find(User::getCurrentUser()->empleado->supervisor_id);

                    $empleado = $empleado_query->find(User::getCurrentUser()->empleado->id);
                    //Se comentaron los correos a quienes se les enviara al final
                    // Mail::to(['marco.luna@silent4business.com', 'eugenia.gomez@silent4business.com', $aprobador->email, $empleado->email])
                    try {
                        // Enviar correo
                        Mail::to(removeUnicodeCharacters('marco.luna@silent4business.com'))
                            ->queue(new TimesheetHorasSobrepasadas($ep->empleado->name, $ep->proyecto->proyecto, $tot_horas_proyecto, $ep->horas_asignadas));
                    } catch (Throwable $e) {
                        report($e);

                        return false;
                    }

                    //     $ep->update([
                    //         'correo_enviado' => true,
                    //     ]);
                    // }
                }
            }
        }
    }
}
<?php

namespace App\Http\Controllers\Api\V1\Timesheet;

use App\Http\Controllers\Controller;
use App\Mail\TimesheetSolicitudAprobada;
use App\Mail\TimesheetSolicitudRechazada;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoArea;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Throwable;

class TbTimesheetApiMobileController extends Controller
{
    use ObtenerOrganizacion;

    public function encodeSpecialCharacters($url)
    {
        // Handle spaces
        // $url = str_replace(' ', '%20', $url);
        // Encode other special characters, excluding /, \, and :
        $url = preg_replace_callback(
            '/[^A-Za-z0-9_\-\.~\/\\\:]/',
            function ($matches) {
                return rawurlencode($matches[0]);
            },
            $url,
        );

        return $url;
    }

    public function tbFunctionCreate()
    {
        $empleado = User::getCurrentUser()->empleado;

        $proyectos = TimesheetProyectoArea::with(['proyecto.tareas' => function ($query) {
            $query->select('id', 'proyecto_id', 'tarea');
        }])
            ->whereHas('proyecto', function ($query) {
                $query->where('estatus', '=', 'proceso');
            })
            ->where('area_id', $empleado->area_id)
            ->orderByDesc('id')
            ->get()
            ->map(function ($proyectoArea) {
                return [
                    "id" => $proyectoArea->proyecto->id,
                    "proyecto" => $proyectoArea->proyecto->proyecto,
                    "identificador" => $proyectoArea->proyecto->identificador,
                    "selector" => "{$proyectoArea->proyecto->identificador} - {$proyectoArea->proyecto->proyecto}",
                    "tareas" => $proyectoArea->proyecto->tareas->map(function ($tarea) {
                        return [
                            "id" => $tarea->id,
                            'tarea' => $tarea->tarea,
                        ];
                    })
                ];
            });

        return response()->json(['proyectos' => $proyectos], 200);
    }


    public function tbFunctionStore(Request $request)
    {
        $validatedData = $request->validate([
            // Validaciones para timesheet
            'timesheet.fecha_dia' => ['required', 'date'],
            'timesheet.estatus' => ['required', 'in:pendiente,papelera'], // Ajusta los estatus permitidos

            // Validaciones para registros (arreglo de registros)
            'registros' => ['required', 'array'],
            'registros.*.proyecto_id' => ['required', 'integer'],
            'registros.*.tarea_id' => ['required', 'integer'],
            'registros.*.facturable' => ['required', 'boolean'],
            'registros.*.descripcion' => ['required', 'string'],

            // Validaciones para horas (0 a 24)
            'registros.*.horas_lunes' => ['nullable', 'integer', 'between:0,24'],
            'registros.*.horas_martes' => ['nullable', 'integer', 'between:0,24'],
            'registros.*.horas_miercoles' => ['nullable', 'integer', 'between:0,24'],
            'registros.*.horas_jueves' => ['nullable', 'integer', 'between:0,24'],
            'registros.*.horas_viernes' => ['nullable', 'integer', 'between:0,24'],
            'registros.*.horas_sabado' => ['nullable', 'integer', 'between:0,24'],
            'registros.*.horas_domingo' => ['nullable', 'integer', 'between:0,24'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'between' => 'El valor de :attribute debe estar entre 0 y 24.',
            'exists' => 'El :attribute seleccionado no existe.',
        ]);

        // Validación personalizada para verificar que al menos una hora esté definida
        $errors = [];
        foreach ($request->input('registros') as $key => $registro) {
            if (
                ($registro['horas_lunes'] == 0 || is_null($registro['horas_lunes'])) &&
                ($registro['horas_martes'] == 0 || is_null($registro['horas_martes'])) &&
                ($registro['horas_miercoles'] == 0 || is_null($registro['horas_miercoles'])) &&
                ($registro['horas_jueves'] == 0 || is_null($registro['horas_jueves'])) &&
                ($registro['horas_viernes'] == 0 || is_null($registro['horas_viernes'])) &&
                ($registro['horas_sabado'] == 0 || is_null($registro['horas_sabado'])) &&
                ($registro['horas_domingo'] == 0 || is_null($registro['horas_domingo']))
            ) {
                $errors["registros.$key"] = 'Al menos una hora debe ser mayor que 0.';
            }
        }

        // Si hay errores de validación personalizada
        if (!empty($errors)) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $errors,
            ], 422); // Código de estado HTTP 422 Unprocessable Entity
        }

        // Guardar los datos después de validar
        // Aquí va tu lógica para guardar los datos
        DB::beginTransaction();

        $usuario = User::getCurrentUser();
        $organizacion_semana = Organizacion::getFirst();

        $semanasAtras = $usuario->empleado->semanas_min_timesheet ? $usuario->empleado->semanas_min_timesheet : 4;

        $today = Carbon::now();

        $firstDay = $today->copy()->subWeeks($semanasAtras);
        $endDay = $today->copy()->addWeeks($organizacion_semana->semanas_adicionales);
        $firstDayFormatted = $firstDay->format('Y/m/d');
        $endDayFormatted = $endDay->format('Y/m/d');

        $fechaTimeSheetFormatted = Carbon::parse($request->fecha_dia)->format('Y/m/d');

        if ($request->timesheet["estatus"] === 'pendiente' || $request->timesheet["estatus"] === 'papelera') {
            if (($fechaTimeSheetFormatted >= $firstDayFormatted && $fechaTimeSheetFormatted <= $endDayFormatted) || ($fechaTimeSheetFormatted >= $firstDayFormatted && $endDayFormatted <= $fechaTimeSheetFormatted)) {
                try {
                    // $timesheet_nuevo = Timesheet::create([
                    //     'fecha_dia' => $request->fecha_dia,
                    //     'dia_semana' => $organizacion_semana->dia_timesheet,
                    //     'inicio_semana' => $organizacion_semana->inicio_timesheet,
                    //     'fin_semana' => $organizacion_semana->fin_timesheet,
                    //     'empleado_id' => $usuario->empleado->id,
                    //     'aprobador_id' => $usuario->empleado->supervisor_id,
                    //     'estatus' => $request->estatus,
                    // ]);

                    foreach ($request->registros as $index => $registro) {
                        dd($registro);
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

                    if ($timesheet_nuevo->estatus === 'pendiente') {
                        $aprobador = Empleado::find($usuario->empleado->supervisor_id);

                        $solicitante = Empleado::find($usuario->empleado->id);

                        try {
                            // Enviar correo
                            Mail::to(trim(removeUnicodeCharacters($aprobador->email)))->queue(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_nuevo, $solicitante));
                        } catch (Throwable $e) {
                            report($e);

                            return response()->json(['status' => 520]);
                        }
                    }

                    $this->notificacionhorassobrepasadas($usuario->empleado->id);

                    // Your database operations here
                    DB::commit();

                    return response()->json(['status' => 200]);
                } catch (Throwable $th) {
                }
            }
        }

        return response()->json([
            'success' => true,
            'message' => 'Datos guardados correctamente.',
        ], 201); // Código de estado HTTP 201 Created
    }

    // public function store(Request $request)
    // {
    //     abort_if(Gate::denies('timesheet_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

    //     DB::beginTransaction();

    //     $organizacion_semana = Organizacion::getFirst();

    //     $request->validate(
    //         [
    //             'timesheet.1.proyecto' => 'required',
    //             'timesheet.1.tarea' => 'required',
    //             'fecha_dia' => 'required',
    //         ],
    //         [
    //             'timesheet.*.proyecto.required' => 'Seleccionar proyecto',
    //             'timesheet.*.tarea.required' => 'Seleccionar tarea',
    //             'fecha_dia.required' => 'Seleccione fecha',
    //         ],
    //     );
    //     if (
    //         $request->timesheet[1]['lunes'] == null &&
    //         $request->timesheet[1]['martes'] == null &&
    //         $request->timesheet[1]['miercoles'] == null &&
    //         $request->timesheet[1]['jueves'] == null &&
    //         $request->timesheet[1]['viernes'] == null &&
    //         $request->timesheet[1]['sabado'] == null &&
    //         $request->timesheet[1]['domingo'] == null
    //     ) {
    //         $request->validate(
    //             [
    //                 'timesheet.1.horas' => 'required',
    //             ],
    //             [
    //                 'timesheet.1.horas.required' => 'Registre horas de la semana',
    //             ]
    //         );
    //     }

    //     foreach ($request->timesheet as $index => $hora) {
    //         if ($index > 1) {
    //             if (array_key_exists('proyecto', $hora) || array_key_exists('tarea', $hora)) {
    //                 $request->validate(
    //                     [
    //                         "timesheet.{$index}.proyecto" => 'required',
    //                         "timesheet.{$index}.tarea" => 'required',
    //                     ],
    //                     [
    //                         "timesheet.{$index}.proyecto.required" => 'Seleccionar proyecto',
    //                         "timesheet.{$index}.tarea.required" => 'Seleccionar tarea',
    //                     ],
    //                 );

    //                 if (
    //                     $hora['lunes'] == null &&
    //                     $hora['martes'] == null &&
    //                     $hora['miercoles'] == null &&
    //                     $hora['jueves'] == null &&
    //                     $hora['viernes'] == null &&
    //                     $hora['sabado'] == null &&
    //                     $hora['domingo'] == null
    //                 ) {
    //                     $request->validate(
    //                         [
    //                             "timesheet.{$index}.horas" => 'required',
    //                         ],
    //                         [
    //                             "timesheet.{$index}.horas.required" => 'Registre horas de la semana',
    //                         ],
    //                     );
    //                 }
    //             } else {
    //                 if (
    //                     $hora['lunes'] != null ||
    //                     $hora['martes'] != null ||
    //                     $hora['miercoles'] != null ||
    //                     $hora['jueves'] != null ||
    //                     $hora['viernes'] != null ||
    //                     $hora['sabado'] != null ||
    //                     $hora['domingo'] != null
    //                 ) {
    //                     $request->validate(
    //                         [
    //                             "timesheet.{$index}.proyecto" => 'required',
    //                             "timesheet.{$index}.tarea" => 'required',
    //                         ],
    //                         [
    //                             "timesheet.{$index}.proyecto.required" => 'Seleccionar proyecto',
    //                             "timesheet.{$index}.tarea.required" => 'Seleccionar tarea',
    //                         ],
    //                     );
    //                 }
    //             }
    //         }
    //     }
    //     $usuario = User::getCurrentUser();
    //     $organizacion = Organizacion::getFirst();

    //     $semanasAtras = $usuario->empleado->semanas_min_timesheet ? $usuario->empleado->semanas_min_timesheet : 4;

    //     $today = Carbon::now();

    //     $firstDay = $today->copy()->subWeeks($semanasAtras);
    //     $endDay = $today->copy()->addWeeks($organizacion->semanas_adicionales);
    //     $firstDayFormatted = $firstDay->format('Y/m/d');
    //     $endDayFormatted = $endDay->format('Y/m/d');

    //     $fechaTimeSheetFormatted = Carbon::parse($request->fecha_dia)->format('Y/m/d');
    //     if ($request->estatus === 'pendiente' || $request->estatus === 'papelera') {
    //         if (($fechaTimeSheetFormatted >= $firstDayFormatted && $fechaTimeSheetFormatted <= $endDayFormatted) || ($fechaTimeSheetFormatted >= $firstDayFormatted && $endDayFormatted <= $fechaTimeSheetFormatted)) {
    //             try {
    //                 $timesheet_nuevo = Timesheet::create([
    //                     'fecha_dia' => $request->fecha_dia,
    //                     'dia_semana' => $organizacion_semana->dia_timesheet,
    //                     'inicio_semana' => $organizacion_semana->inicio_timesheet,
    //                     'fin_semana' => $organizacion_semana->fin_timesheet,
    //                     'empleado_id' => $usuario->empleado->id,
    //                     'aprobador_id' => $usuario->empleado->supervisor_id,
    //                     'estatus' => $request->estatus,
    //                 ]);

    //                 foreach ($request->timesheet as $index => $hora) {
    //                     if (array_key_exists('proyecto', $hora) && array_key_exists('tarea', $hora)) {

    //                         foreach ($hora as $key => $value) {
    //                             if ($value === '') {
    //                                 $hora[$key] = null;
    //                             }
    //                         }

    //                         $horas_nuevas = TimesheetHoras::create([
    //                             'timesheet_id' => $timesheet_nuevo->id,
    //                             'proyecto_id' => array_key_exists('proyecto', $hora) ? $hora['proyecto'] : null,
    //                             'tarea_id' => array_key_exists('tarea', $hora) ? $hora['tarea'] : null,
    //                             'facturable' => array_key_exists('facturable', $hora) ? true : false,
    //                             'horas_lunes' => $hora['lunes'],
    //                             'horas_martes' => $hora['martes'],
    //                             'horas_miercoles' => $hora['miercoles'],
    //                             'horas_jueves' => $hora['jueves'],
    //                             'horas_viernes' => $hora['viernes'],
    //                             'horas_sabado' => $hora['sabado'],
    //                             'horas_domingo' => $hora['domingo'],
    //                             'descripcion' => $hora['descripcion'],
    //                             'empleado_id' => $usuario->empleado->id,
    //                         ]);
    //                     }
    //                 }

    //                 if ($timesheet_nuevo->estatus === 'pendiente') {
    //                     $aprobador = Empleado::find($usuario->empleado->supervisor_id);

    //                     $solicitante = Empleado::find($usuario->empleado->id);

    //                     try {
    //                         // Enviar correo
    //                         Mail::to(trim(removeUnicodeCharacters($aprobador->email)))->queue(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_nuevo, $solicitante));
    //                     } catch (Throwable $e) {
    //                         report($e);

    //                         return response()->json(['status' => 520]);
    //                     }
    //                 }

    //                 $this->notificacionhorassobrepasadas($usuario->empleado->id);

    //                 // Your database operations here
    //                 DB::commit();

    //                 return response()->json(['status' => 200]);
    //             }
    //             // catch exception and rollback transaction
    //             catch (Throwable $e) {
    //                 //Regresa la Base de datos a la normalidad
    //                 DB::rollback();
    //                 //Limpia la cache para que no muestre registros que no existen en la base
    //                 $this->forgetCache();

    //                 // throw $e;
    //                 return response()->json(['status' => 400]);
    //             }
    //         }
    //     }
    // }

    public function tbFunctionShow($id)
    {
        // dd($id);
        // $id_empleado = User::getCurrentUser()->empleado->id;

        // try {
        $timesheet = Timesheet::findOrFail($id)->makeHidden(['created_at', 'updated_at', 'proyectos']);

        $timesheet->empleado->makeHidden(['avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo', 'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor']);

        if ($timesheet->empleado->foto == null || $timesheet->empleado->foto == '0') {
            if ($timesheet->empleado->genero == 'H') {
                $ruta = asset('storage/empleados/imagenes/man.png');
            } elseif ($timesheet->empleado->genero == 'M') {
                $ruta = asset('storage/empleados/imagenes/woman.png');
            } else {
                $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
            }
        } else {
            $ruta = asset('storage/empleados/imagenes/' . $timesheet->empleado->foto);
        }

        // Encode spaces in the URL
        $timesheet->nombre_empleado = $timesheet->empleado->name;
        $timesheet->ruta_foto = $this->encodeSpecialCharacters($ruta);

        // Transformar los proyectos ocultando las propiedades
        // $proyectos = $timesheet->proyectos->toJson();
        // $proyectos = $timesheet->proyectos;//[0]->makeHidden(['created_at', 'updated_at', 'areas', 'fecha_inicio', 'fecha_fin', 'sede_id', 'tipo', 'horas_proyecto'])->toJson();
        $proyectos = [];

        foreach ($timesheet->proyectos as $proyecto) {
            // arra_push($prueba)
            $proyectos[] = $proyecto->makeHidden(['created_at', 'updated_at', 'areas', 'fecha_inicio', 'fecha_fin', 'sede_id', 'tipo', 'horas_proyecto']);
        }
        //     return collect($proyecto)->except([
        //         'areas',
        //     ]);
        // });
        // $proyectos = $timesheet->proyectos->map(function ($proyecto) {
        //     return $proyecto->makeHidden(['created_at', 'updated_at', 'fecha_inicio', 'fecha_fin', 'sede_id', 'tipo', 'horas_proyecto'])->toArray();
        // });

        // dd($prueba);

        // "id" => 181
        // "created_at" => "2022-10-31 14:06:20"
        // "updated_at" => "2022-10-31 14:06:20"
        // "proyecto" => "PRO-INT-S4B Tabantaj"
        // "cliente_id" => 16
        // "estatus" => "proceso"
        // "identificador" => "I 015"
        // "fecha_inicio" => null
        // "fecha_fin" => null
        // "sede_id" => 1
        // "tipo" => "Interno"
        // "horas_proyecto" => null

        // Obtener y ocultar propiedades en las horas
        $horas = TimesheetHoras::where('timesheet_id', $id)
            ->get()
            ->map(function ($hora) {
                return $hora->makeHidden(['created_at', 'updated_at', 'tarea']);
            });

        foreach ($horas as $key => $hora) {
            $hora->nombre_tarea = $hora->tarea->tarea;
        }

        $horas_count = $horas->count();
        // dd($horas);

        return response(
            json_encode([
                'timesheet' => $timesheet,
                'proyectos' => $proyectos,
                'horas' => $horas,
                'horas_count' => $horas_count,
            ]),
            200,
        )->header('Content-Type', 'application/json');
        //         return view('admin.timesheet.show', compact('timesheet', 'horas', 'hoy_format', 'horas_count'));
        //     } else {
        //         abort(Response::HTTP_FORBIDDEN, '403 Forbidden');
        //     }
        // } catch (\Exception $e) {
        //     return redirect('admin/timesheet')->with('error', 'No tienes permitido el acceso a estos registros.');
        // }

    }

    public function tbFunctionObtenerEquipo($childrens)
    {
        $equipo_a_cargo = collect();

        foreach ($childrens as $evaluador) {
            $equipo_a_cargo->push($evaluador->id);

            if (count($evaluador->children)) {
                $equipo_a_cargo->push($this->tbFunctionObtenerEquipo($evaluador->children));
            }
        }

        return $equipo_a_cargo->flatten(1)->toArray();
    }

    public function tbFunctionAprobaciones(Request $request)
    {
        // abort_if(Gate::denies('timesheet_administrador_aprobar_rechazar_horas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $habilitarTodos = $request->habilitarTodos ? true : false;

        $usuario = User::getCurrentUser()->makeHidden(['empleado', 'email_verified_at', 'approved', 'verified', 'verified_at', 'verification_token', 'two_factor', 'two_factor_expires_at', 'created_at', 'updated_at', 'deleted_at', 'organizacion_id', 'area_id', 'puesto_id', 'team_id']);

        if ($usuario->empleado->foto == null || $usuario->empleado->foto == '0') {
            if ($usuario->empleado->genero == 'H') {
                $ruta = asset('storage/empleados/imagenes/man.png');
            } elseif ($usuario->empleado->genero == 'M') {
                $ruta = asset('storage/empleados/imagenes/woman.png');
            } else {
                $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
            }
        } else {
            $ruta = asset('storage/empleados/imagenes/' . $usuario->empleado->foto);
        }

        $usuario->ruta_foto = $this->encodeSpecialCharacters($ruta);

        $usuario->id_empleado = $usuario->empleado->id;
        $usuario->nombre_empleado = $usuario->empleado->name;
        $usuario->id_area_empleado = $usuario->empleado->area->id;
        $usuario->nombre_area_empleado = $usuario->empleado->area->area;
        $usuario->id_puesto_empleado = $usuario->empleado->puesto_id;
        $usuario->nombre_puesto_empleado = $usuario->empleado->puesto;

        $equipo_a_cargo = $this->tbFunctionObtenerEquipo($usuario->empleado->children);
        array_push($equipo_a_cargo, $usuario->empleado->id);
        if ($habilitarTodos) {
            $aprobaciones = Timesheet::with('empleado')
                ->where('estatus', 'pendiente')
                ->whereIn('aprobador_id', $equipo_a_cargo)
                ->get()
                ->makeHidden(['proyectos', 'created_at', 'updated_at', 'semana', 'empleado']);
        } else {
            $aprobaciones = Timesheet::with('empleado')
                ->where('estatus', 'pendiente')
                ->where('aprobador_id', $usuario->empleado->id)
                ->get()
                ->makeHidden(['proyectos', 'created_at', 'updated_at', 'semana', 'empleado']);
        }

        foreach ($aprobaciones as $key => $aprobacion) {
            $aprobacion->texto_semana = \Illuminate\Support\Str::limit(strip_tags($aprobacion->semana), 3000);

            $aprobacion->empleado->makeHidden(['avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo', 'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet', 'area', 'supervisor']);

            if ($aprobacion->empleado->foto == null || $aprobacion->empleado->foto == '0') {
                if ($aprobacion->empleado->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($aprobacion->empleado->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/' . $aprobacion->empleado->foto);
            }

            // Encode spaces in the URL
            $aprobacion->nombre_empleado = $aprobacion->empleado->name;
            $aprobacion->ruta_foto = $this->encodeSpecialCharacters($ruta);
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return response(
            json_encode([
                'usuario' => $usuario,
                'aprobaciones' => $aprobaciones,
                'logo_actual' => $logo_actual,
                'empresa_actual' => $empresa_actual,
                'habilitarTodos' => $habilitarTodos,
            ]),
            200,
        )->header('Content-Type', 'application/json');
    }

    public function tbFunctionAprobar(Request $request, $id)
    {
        // abort_if(Gate::denies('timesheet_administrador_aprobar_horas'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuesta = $request->input('respuesta');

        $aprobar = Timesheet::find($id);
        $aprobar->update([
            'estatus' => 'aprobado',
            'comentarios' => $respuesta['comentarios'],
        ]);

        $solicitante = Empleado::getDataColumns()->find($aprobar->empleado_id);

        $aprobador = Empleado::getDataColumns()->find($aprobar->aprobador_id);

        try {
            // Enviar correo
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new TimesheetSolicitudAprobada($aprobador, $aprobar, $solicitante));
        } catch (Throwable $e) {
            report($e);

            return json_encode(['éxito', 'Guardado con éxito, correo no enviado'], 200);
        }

        return json_encode(['éxito', 'Guardado con éxito'], 200);
    }

    public function tbFunctionRechazar(Request $request, $id)
    {
        // abort_if(Gate::denies('timesheet_administrador_aprobar_horas'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $respuesta = $request->input('respuesta');
        // dd($respuesta, $respuesta["comentarios"]);
        $rechazar = Timesheet::find($id);
        $rechazar->update([
            'estatus' => 'rechazado',
            'comentarios' => $respuesta['comentarios'],
        ]);

        $solicitante = Empleado::getDataColumns()->find($rechazar->empleado_id);

        $aprobador = Empleado::getDataColumns()->find($rechazar->aprobador_id);

        try {
            // Enviar correo
            Mail::to(removeUnicodeCharacters($solicitante->email))->queue(new TimesheetSolicitudRechazada($aprobador, $rechazar, $solicitante));
        } catch (Throwable $e) {
            report($e);

            return json_encode(['éxito', 'Guardado con éxito, correo no enviado'], 200);
        }

        return json_encode(['éxito', 'Guardado con éxito'], 200);
    }

    public function tbFunctionContadorPendientesTimesheetAprobador()
    {
        $usuario = User::getCurrentUser();
        // papelera, aprobado, rechazado, pendiente

        $pendientes = Timesheet::with('empleado')
            ->where('estatus', 'pendiente')
            ->where('aprobador_id', $usuario->empleado->id)
            ->count();

        return response(
            json_encode([
                'pendientes' => $pendientes,
            ]),
            200,
        )->header('Content-Type', 'application/json');
    }
}

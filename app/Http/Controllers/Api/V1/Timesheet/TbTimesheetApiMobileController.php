<?php

namespace App\Http\Controllers\Api\V1\Timesheet;

use App\Http\Controllers\Controller;
use App\Mail\TimesheetHorasSobrepasadas;
use App\Mail\TimesheetHorasSolicitudAprobacion;
use App\Mail\TimesheetSolicitudAprobada;
use App\Mail\TimesheetSolicitudRechazada;
use App\Models\Empleado;
use App\Models\Organizacion;
use App\Models\Sede;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\TimesheetProyectoArea;
use App\Models\TimesheetProyectoEmpleado;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
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

    public function proyectosArea($empleado){
        $proyects = TimesheetProyectoArea::with(['proyecto.tareas' => function ($query) {
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

        return $proyects;
    }

    public function tbFunctionCreate()
    {
        $empleado = User::getCurrentUser()->empleado;

        $proyectos = $this->proyectosArea($empleado);

        return response()->json(['proyectos' => $proyectos], 200);
    }


    public function tbFunctionStore(Request $request)
    {
        // Define las reglas de validación
        $validator = Validator::make($request->all(), [
            'timesheet.fecha_dia' => ['required', 'date'],
            'timesheet.estatus' => ['required', 'in:pendiente,papelera'],
            'registros' => ['required', 'array'],
            'registros.*.proyecto_id' => ['required', 'integer'],
            'registros.*.tarea_id' => ['required', 'integer'],
            'registros.*.facturable' => ['required', 'boolean'],
            'registros.*.descripcion' => ['required', 'string'],
    
            // Validaciones para horas decimales con hasta 2 decimales
            'registros.*.horas_lunes' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_martes' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_miercoles' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_jueves' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_viernes' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_sabado' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_domingo' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'regex' => 'El campo :attribute debe ser un número con hasta 2 decimales.',
            'between' => 'El valor de :attribute debe estar entre 0 y 24.',
        ]);

        // Si hay errores de validación, retornamos un JSON con el error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors(),
            ], 422); // Código HTTP 422 Unprocessable Entity
        }

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

        $fechaTimeSheetFormatted = Carbon::parse($request->timesheet["fecha_dia"])->format('Y/m/d');

        if ($request->timesheet["estatus"] === 'pendiente' || $request->timesheet["estatus"] === 'papelera') {
            if (($fechaTimeSheetFormatted >= $firstDayFormatted && $fechaTimeSheetFormatted <= $endDayFormatted) || ($fechaTimeSheetFormatted >= $firstDayFormatted && $endDayFormatted <= $fechaTimeSheetFormatted)) {
                try {
                    $timesheet_nuevo = Timesheet::create([
                        'fecha_dia' => $request->timesheet["fecha_dia"],
                        'dia_semana' => $organizacion_semana->dia_timesheet,
                        'inicio_semana' => $organizacion_semana->inicio_timesheet,
                        'fin_semana' => $organizacion_semana->fin_timesheet,
                        'empleado_id' => $usuario->empleado->id,
                        'aprobador_id' => $usuario->empleado->supervisor_id,
                        'estatus' => $request->timesheet["estatus"],
                    ]);

                    foreach ($request->registros as $index => $registro) {

                        $horas_nuevas[] = [
                            'timesheet_id' => $timesheet_nuevo->id,
                            'proyecto_id' => $registro['proyecto_id'],
                            'tarea_id' => $registro['tarea_id'],
                            'facturable' => $registro['facturable'],
                            'horas_lunes' => $registro['horas_lunes'],
                            'horas_martes' => $registro['horas_martes'],
                            'horas_miercoles' => $registro['horas_miercoles'],
                            'horas_jueves' => $registro['horas_jueves'],
                            'horas_viernes' => $registro['horas_viernes'],
                            'horas_sabado' => $registro['horas_sabado'],
                            'horas_domingo' => $registro['horas_domingo'],
                            'descripcion' => $registro['descripcion'],
                            'empleado_id' => $usuario->empleado->id,
                        ];
                    }

                    TimesheetHoras::insert($horas_nuevas);

                    if ($timesheet_nuevo->estatus === 'pendiente') {
                        $aprobador = Empleado::find($usuario->empleado->supervisor_id);

                        $solicitante = Empleado::find($usuario->empleado->id);

                        try {
                            // Enviar correo
                            Mail::to(trim(removeUnicodeCharacters($aprobador->email)))->queue(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_nuevo, $solicitante));
                        } catch (Throwable $e) {
                            report($e);

                            return response()->json([
                                'success' => true,
                                'message' => 'Datos guardados correctamente. Error al enviar el correo',
                            ], 501);
                        }
                    }

                    $this->notificacionhorassobrepasadas($usuario->empleado->id);

                    // Your database operations here
                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Datos guardados correctamente.',
                    ], 201);
                } catch (Throwable $th) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al registrar timesheet por favor vuelva a intentar mas tarde.',
                    ], 400);
                }
            }
        }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Datos guardados correctamente.',
        // ], 201); // Código de estado HTTP 201 Created
    }

    public function tbFunctionEdit($id)
    {
        $empleado = User::getCurrentUser()->empleado;

        $proyectos = $this->proyectosArea($empleado);

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

        $registros = [];

        // Obtener y ocultar propiedades en las horas
        $horas = TimesheetHoras::where('timesheet_id', $id)
            ->get();

        foreach ($horas as $key => $hora) {
            $registros[] = [
                "id_registro" => $hora->id,
                "id_proyecto" => $hora->proyecto_id,
                "proyecto" => $hora->proyecto->proyecto,
                "identificador" => $hora->proyecto->identificador,
                "selector" => $hora->proyecto->identificador . " - " . $hora->proyecto->proyecto,
                "id_tarea" => $hora->tarea->id,
                "tarea" => $hora->tarea->tarea,
                "facturable" => $hora->facturable,
                "horas" =>[
                    "horas_lunes"=> floatval($hora->horas_lunes),
                    "horas_martes"=> floatval($hora->horas_martes),
                    "horas_miercoles"=> floatval($hora->horas_miercoles),
                    "horas_jueves"=> floatval($hora->horas_jueves),
                    "horas_viernes"=> floatval($hora->horas_viernes),
                    "horas_sabado"=> floatval($hora->horas_sabado),
                    "horas_domingo"=> floatval($hora->horas_domingo),
                ],
                "descripcion" => $hora->descripcion,
                "horas_totales_tarea" => $hora->horas_totales_tarea,
            ];
        }

        $horas_count = $horas->count();

        return response(
            json_encode([
                'timesheet' => $timesheet,
                'proyectos' => $proyectos,
                'registros' => $registros,
                'horas_count' => $horas_count,
            ]),
            200,
        )->header('Content-Type', 'application/json');

    }

    public function tbFunctionUpdate(Request $request)
    {
        // dd($request);
        $validator = Validator::make($request->all(), [
            // Validaciones para timesheet
            'timesheet.id_timesheet' => ['required', 'integer'],
            'timesheet.fecha_dia' => ['required', 'date'],
            'timesheet.estatus' => ['required', 'string', 'min:1', 'in:pendiente,papelera'], // Ajusta los estatus permitidos

            // Validaciones para registros (arreglo de registros)
            'registros' => ['required', 'array'],
            'registros.*.id_registro' => ['nullable', 'integer'],
            'registros.*.proyecto_id' => ['required', 'integer'],
            'registros.*.tarea_id' => ['required', 'integer'],
            'registros.*.facturable' => ['required', 'boolean'],
            'registros.*.descripcion' => ['required', 'string'],

            // Validaciones para horas decimales con hasta 2 decimales
            'registros.*.horas_lunes' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_martes' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_miercoles' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_jueves' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_viernes' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_sabado' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
            'registros.*.horas_domingo' => ['nullable', 'numeric', 'regex:/^\d{1,2}(\.\d{1,2})?$/', 'between:0,24'],
        ], [
            'required' => 'El campo :attribute es obligatorio.',
            'numeric' => 'El campo :attribute debe ser un número.',
            'regex' => 'El campo :attribute debe ser un número con hasta 2 decimales.',
            'between' => 'El valor de :attribute debe estar entre 0 y 24.',
        ]);

        // Si hay errores de validación, retornamos un JSON con el error
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Errores de validación',
                'errors' => $validator->errors(),
            ], 422); // Código HTTP 422 Unprocessable Entity
        }

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

        $fechaTimeSheetFormatted = Carbon::parse($request->timesheet["fecha_dia"])->format('Y/m/d');

        if ($request->timesheet["estatus"] === 'pendiente' || $request->timesheet["estatus"] === 'papelera') {
            if (($fechaTimeSheetFormatted >= $firstDayFormatted && $fechaTimeSheetFormatted <= $endDayFormatted) || ($fechaTimeSheetFormatted >= $firstDayFormatted && $endDayFormatted <= $fechaTimeSheetFormatted)) {
                try {
                    $timesheet_editado = Timesheet::where('id', $request->timesheet["id_timesheet"])->first();

                    $timesheet_editado->update([
                        'fecha_dia' => $request->timesheet["fecha_dia"],
                        'dia_semana' => $organizacion_semana->dia_timesheet,
                        'inicio_semana' => $organizacion_semana->inicio_timesheet,
                        'fin_semana' => $organizacion_semana->fin_timesheet,
                        'empleado_id' => $usuario->empleado->id,
                        'aprobador_id' => $usuario->empleado->supervisor_id,
                        'estatus' => $request->timesheet["estatus"],
                    ]);

                    foreach ($request->registros as $index => $registro) {

                        TimesheetHoras::updateOrCreate([
                            'id' => $registro["id_registro"],
                            'timesheet_id' => $timesheet_editado->id,
                        ],
                        [
                            'proyecto_id' => $registro['proyecto_id'],
                            'tarea_id' => $registro['tarea_id'],
                            'facturable' => $registro['facturable'],
                            'horas_lunes' => $registro['horas_lunes'],
                            'horas_martes' => $registro['horas_martes'],
                            'horas_miercoles' => $registro['horas_miercoles'],
                            'horas_jueves' => $registro['horas_jueves'],
                            'horas_viernes' => $registro['horas_viernes'],
                            'horas_sabado' => $registro['horas_sabado'],
                            'horas_domingo' => $registro['horas_domingo'],
                            'descripcion' => $registro['descripcion'],
                            'empleado_id' => $usuario->empleado->id,
                        ]);
                    }

                    if ($timesheet_editado->estatus === 'pendiente') {
                        $aprobador = Empleado::find($usuario->empleado->supervisor_id);

                        $solicitante = Empleado::find($usuario->empleado->id);

                        try {
                            // Enviar correo
                            Mail::to(trim(removeUnicodeCharacters($aprobador->email)))->queue(new TimesheetHorasSolicitudAprobacion($aprobador, $timesheet_editado, $solicitante));
                        } catch (Throwable $e) {
                            report($e);
                            dd($e);
                            return response()->json([
                                'success' => true,
                                'message' => 'Datos guardados correctamente. Error al enviar el correo',
                            ], 501);
                        }
                    }

                    $this->notificacionhorassobrepasadas($usuario->empleado->id);

                    // Your database operations here
                    DB::commit();

                    return response()->json([
                        'success' => true,
                        'message' => 'Datos guardados correctamente.',
                    ], 201);
                } catch (Throwable $th) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al registrar timesheet por favor vuelva a intentar mas tarde.',
                    ], 400);
                }
            }
        }

        // return response()->json([
        //     'success' => true,
        //     'message' => 'Datos guardados correctamente.',
        // ], 201); // Código de estado HTTP 201 Created
    }

    public function tbFunctionShow($id)
    {
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

        $registros = [];

        // Transformar los proyectos ocultando las propiedades
        // $proyectos = [];

        // foreach ($timesheet->proyectos as $proyecto) {
        //     $proyectos[] = $proyecto->makeHidden(['created_at', 'updated_at', 'areas', 'fecha_inicio', 'fecha_fin', 'sede_id', 'tipo', 'horas_proyecto']);
        // }

        // Obtener y ocultar propiedades en las horas
        $horas = TimesheetHoras::where('timesheet_id', $id)
            ->get();

        foreach ($horas as $key => $hora) {
            $registros[] = [
                "id_registro" => $hora->id,
                "id_proyecto" => $hora->proyecto_id,
                "proyecto" => $hora->proyecto->proyecto,
                "identificador" => $hora->proyecto->identificador,
                "selector" => $hora->proyecto->identificador . " - " . $hora->proyecto->proyecto,
                "id_tarea" => $hora->tarea->id,
                "tarea" => $hora->tarea->tarea,
                "facturable" => $hora->facturable,
                "horas" =>[
                    "horas_lunes"=> floatval($hora->horas_lunes),
                    "horas_martes"=> floatval($hora->horas_martes),
                    "horas_miercoles"=> floatval($hora->horas_miercoles),
                    "horas_jueves"=> floatval($hora->horas_jueves),
                    "horas_viernes"=> floatval($hora->horas_viernes),
                    "horas_sabado"=> floatval($hora->horas_sabado),
                    "horas_domingo"=> floatval($hora->horas_domingo),
                ],
                "descripcion" => $hora->descripcion,
                "horas_totales_tarea" => $hora->horas_totales_tarea,
            ];
        }

        $horas_count = $horas->count();
        // dd($horas);

        return response(
            json_encode([
                'timesheet' => $timesheet,
                'registros' => $registros,
                'horas_count' => $horas_count,
            ]),
            200,
        )->header('Content-Type', 'application/json');

    }

    public function tbFunctionEliminarTimesheet($id_registro)
    {
        // dd($id_registro);
        try {
            //code...
            $eliminarRegistro = Timesheet::where('id', $id_registro)->first();
            $eliminarRegistro->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Registro Eliminado Correctamente.',
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el registro, intente mas tarde.',
            ], 400);
        }
    }

    public function tbFunctionEliminarRegistroHoras($id_registro)
    {
        // dd($id_registro);
        try {
            //code...
            $eliminarRegistro = TimesheetHoras::where('id', $id_registro)->first();
            $eliminarRegistro->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Registro Eliminado Correctamente.',
            ], 201);
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar el registro, intente mas tarde.',
            ], 400);
        }
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

    public function notificacionhorassobrepasadas($id)
    {
        $verificacion_proyectos = TimesheetProyectoEmpleado::select('id', 'empleado_id')->where('empleado_id', '=', $id)->with('empleado', 'proyecto')->exists();

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

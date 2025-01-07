<?php

namespace App\Http\Controllers\Api\Mobile\Timesheet;

use App\Http\Controllers\Controller;
use App\Mail\TimesheetSolicitudAprobada;
use App\Mail\TimesheetSolicitudRechazada;
use App\Models\Empleado;
use App\Models\Sede;
use App\Models\Timesheet;
use App\Models\TimesheetHoras;
use App\Models\User;
use App\Traits\ObtenerOrganizacion;
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

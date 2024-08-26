<?php

namespace app\Http\Controllers\Api\V1\PerfilUsuario;

use App\Http\Controllers\Controller;
use App\Models\ComunicacionSgi;
use App\Models\Empleado;
use App\Models\FelicitarCumpleaños;
use App\Models\Organizacione;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class tbApiMobileControllerPerfilUsuario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tbFunctionPerfil()
    {

        function encodeSpecialCharacters($url)
        {
            // Handle spaces
            // $url = str_replace(' ', '%20', $url);
            // Encode other special characters, excluding /, \, and :
            $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
                return rawurlencode($matches[0]);
            }, $url);

            return $url;
        }

        $empleado = Empleado::alta()->select(
            'id',
            'n_empleado',
            'name',
            'email',
            'telefono_movil',
            'area_id',
            'puesto_id',
            'foto',
            'antiguedad',
            'cumpleaños',
            'estatus',
            'supervisor_id',
            'genero',
            'sede_id',
            'perfil_empleado_id',
        )->where('id', User::getCurrentUser()->empleado->id)->first();

        $empleado->id_area = $empleado->area->id;
        $empleado->nombre_area = $empleado->area->area;
        $empleado->id_puesto = $empleado->puestoRelacionado->id;
        $empleado->nombre_puesto = $empleado->puesto;
        $empleado->nombre_sede = $empleado->sede->sede;
        $empleado->nombre_perfil = $empleado->perfil->nombre;
        $empleado->nombre_supervisor = $empleado->supervisor->name;

        if ($empleado->foto == null || $empleado->foto == '0') {
            if ($empleado->genero == 'H') {
                $ruta = asset('storage/empleados/imagenes/man.png');
            } elseif ($empleado->genero == 'M') {
                $ruta = asset('storage/empleados/imagenes/woman.png');
            } else {
                $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
            }
        } else {
            $ruta = asset('storage/empleados/imagenes/' . $empleado->foto);
        }

        // Encode spaces in the URL
        $empleado->ruta_foto = encodeSpecialCharacters($ruta);

        $empleado->makeHidden([
            'avatar',
            'avatar_ruta',
            'resourceId',
            'empleados_misma_area',
            'genero_formateado',
            'puesto',
            'declaraciones_responsable',
            'declaraciones_aprobador',
            'declaraciones_responsable2022',
            'declaraciones_aprobador2022',
            'fecha_ingreso',
            'saludo',
            'saludo_completo',
            'sede',
            'perfil',
            'actual_birdthday',
            'actual_aniversary',
            'obtener_antiguedad',
            'empleados_pares',
            'competencias_asignadas',
            'objetivos_asignados',
            'es_supervisor',
            'fecha_min_timesheet',
            'area',
            'supervisor',
            'area_id',
            'puesto_id',
            'foto',
            'puestoRelacionado',
        ]);

        $equipo_trabajo = $empleado->empleados_misma_area;
        $equipo_trabajo = Empleado::getaltaAll()->find($equipo_trabajo);

        foreach ($equipo_trabajo as $keyEquipo => $equipo) {
            $equipo->makeHidden([
                'avatar',
                'avatar_ruta',
                'resourceId',
                'empleados_misma_area',
                'genero_formateado',
                'puesto',
                'declaraciones_responsable',
                'declaraciones_aprobador',
                'declaraciones_responsable2022',
                'declaraciones_aprobador2022',
                'fecha_ingreso',
                'saludo',
                'saludo_completo',
                'sede',
                'perfil',
                'actual_birdthday',
                'actual_aniversary',
                'obtener_antiguedad',
                'empleados_pares',
                'competencias_asignadas',
                'objetivos_asignados',
                'es_supervisor',
                'fecha_min_timesheet',
                'area',
                'supervisor',
                'area_id',
                'puesto_id',
                'foto',
                'puestoRelacionado',
                // 'name',
                'n_registro',
                'foto',
                'puesto',
                'antiguedad',
                'estatus',
                // 'email',
                'telefono',
                'extension',
                // 'telefono_movil',
                'genero',
                'n_empleado',
                'supervisor_id',
                'area_id',
                'sede_id',
                'direccion',
                'cumpleaños',
                'resumen',
                'puesto_id',
                'perfil_empleado_id',
                'tipo_contrato_empleados_id', //Agregados para nueva version de perfil de empleado
                'terminacion_contrato',
                'renovacion_contrato',
                'esquema_contratacion',
                'proyecto_asignado',
                'telefono_casa',
                'correo_personal',
                'estado_civil',
                'NSS',
                'CURP',
                'RFC',
                'lugar_nacimiento',
                'nacionalidad',
                'entidad_crediticias_id',
                'numero_credito',
                'descuento',
                'banco',
                'cuenta_bancaria',
                'clabe_interbancaria',
                'centro_costos',
                'salario_bruto',
                'salario_diario',
                'salario_diario_integrado',
                'salario_base_mensual',
                'pagadora_actual',
                'periodicidad_nomina',
                'mostrar_telefono',
                'calle',
                'num_exterior',
                'num_interior',
                'colonia',
                'delegacion',
                'estado',
                'pais',
                'cp',
                'fecha_baja',
                'razon_baja',
                'semanas_min_timesheet',
                'vacante_activa',
                "created_at",
                "updated_at",
                "deleted_at",
                "domicilio_personal",
            ]);
        }

        return response(json_encode(
            [
                'empleado' => $empleado,
                'equipo_trabajo' => $equipo_trabajo,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }


    public function tbFunctionIndex()
    {
        // abort_if(Gate::denies('portal_de_comunicaccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hoy = Carbon::now();
        $fecha_hoy = $hoy->toDateString();

        $comunicados = ComunicacionSgi::getAllwithImagenesBlog()->makeHidden(['created_at', 'updated_at', 'deleted_at', 'team_id', 'id_publico', 'imagenes_comunicacion']);

        foreach ($comunicados as $key_comunicados => $comunicado) {
            $comunicado->tipo_imagen = $comunicado->imagenes_comunicacion->first()->tipo;
            $ruta_comunicado = asset('storage/imagen_comunicado_SGI/' . $comunicado->imagenes_comunicacion->first()->imagen);
            $comunicado->ruta_imagen = $ruta_comunicado;
        }

        return response(json_encode(
            [
                'hoy' => $fecha_hoy,
                'comunicados' => $comunicados,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function convertircumpleanos($fecha)
    {
        $dia_cumpleanos = Carbon::parse($fecha)->format('d');
        $mes_fecha = Carbon::parse($fecha)->format('m');

        switch ($mes_fecha) {
            case '01':
                // code...
                $mes_cumpleanos = 'Enero';
                break;

            case '02':
                // code...
                $mes_cumpleanos = 'Febrero';
                break;

            case '03':
                // code...
                $mes_cumpleanos = 'Marzo';
                break;

            case '04':
                // code...
                $mes_cumpleanos = 'Abril';
                break;

            case '05':
                // code...
                $mes_cumpleanos = 'Mayo';
                break;

            case '06':
                // code...
                $mes_cumpleanos = 'Junio';
                break;

            case '07':
                // code...
                $mes_cumpleanos = 'Julio';
                break;

            case '08':
                // code...
                $mes_cumpleanos = 'Agosto';
                break;

            case '09':
                // code...
                $mes_cumpleanos = 'Septiembre';
                break;

            case '10':
                // code...
                $mes_cumpleanos = 'Octubre';
                break;

            case '11':
                // code...
                $mes_cumpleanos = 'Noviembre';
                break;

            case '12':
                // code...
                $mes_cumpleanos = 'Diciembre';
                break;

            default:
                // code...
                break;
        }

        // dd($mes_fecha, $mes_cumpleanos);
        $fecha_cumpleanos = $dia_cumpleanos . ' de ' . $mes_cumpleanos;

        return $fecha_cumpleanos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // public function reportes()
    // {
    //     abort_if(Gate::denies('portal_comunicacion_mostrar_reportar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
    //     $organizacions = Organizacione::first();

    //     return view('admin.portalCommunication.reportes', compact('organizacions'));
    // }

    // public function felicitarCumpleaños($cumpleañero_id)
    // {
    //     $felicitar = FelicitarCumpleaños::create([
    //         'cumpleañero_id' => $cumpleañero_id,
    //         'felicitador_id' => User::getCurrentUser()->empleado->id,
    //         'like' => true,
    //     ]);

    //     return redirect()->route('admin.portal-comunicacion.index')->with('success', 'Like generado');
    // }

    // public function felicitarCumpleañosDislike($id)
    // {
    //     $felicitar = FelicitarCumpleaños::where('id', $id);
    //     $felicitar->update([
    //         'like' => false,
    //     ]);

    //     return redirect()->route('admin.portal-comunicacion.index')->with('success', 'DisLike generado');
    // }

    // public function felicitarCumplesComentarios(Request $request, $cumpleañero_id)
    // {
    //     $comentario = FelicitarCumpleaños::create([
    //         'cumpleañero_id' => $cumpleañero_id,
    //         'felicitador_id' => User::getCurrentUser()->empleado->id,
    //         'comentarios' => $request->comentarios,
    //     ]);

    //     return redirect()->route('admin.portal-comunicacion.index')->with('success', 'Comentario generado');
    // }

    // public function felicitarCumplesComentariosUpdate(Request $request, $id)
    // {
    //     $comentario = FelicitarCumpleaños::where('id', $id);
    //     $comentario->update([
    //         'comentarios' => $request->comentarios,
    //     ]);

    //     return redirect()->route('admin.portal-comunicacion.index')->with('success', 'Comentario actualizado');
    // }
}

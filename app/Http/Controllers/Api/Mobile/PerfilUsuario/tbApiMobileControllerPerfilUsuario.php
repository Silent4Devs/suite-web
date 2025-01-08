<?php

namespace app\Http\Controllers\Api\Mobile\PerfilUsuario;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\User;
use Illuminate\Http\Request;

class tbApiMobileControllerPerfilUsuario extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function encodeSpecialCharacters($url)
    {
        // Handle spaces

        // $url = str_replace(' ', '%20', $url);

        // Encode other special characters, excluding /, \, and :
        $url = preg_replace_callback('/[^A-Za-z0-9_\-\.~\/\\\:]/', function ($matches) {
            return rawurlencode($matches[0]);
        }, $url);

        return $url;
    }

    public function tbFunctionPerfil()
    {

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
            $ruta = asset('storage/empleados/imagenes/'.$empleado->foto);
        }

        // Encode spaces in the URL
        $empleado->ruta_foto = $this->encodeSpecialCharacters($ruta);

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

        return response(json_encode(
            [
                'empleado' => $empleado,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionEquipo()
    {
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

        $equipo_trabajo = $empleado->empleados_misma_area;
        $equipo_trabajo = Empleado::getaltaAll()->find($equipo_trabajo);

        foreach ($equipo_trabajo as $keyEquipo => $equipo) {
            if ($equipo->foto == null || $equipo->foto == '0') {
                if ($equipo->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($equipo->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/'.$equipo->foto);
            }

            // Encode spaces in the URL
            $equipo->ruta_foto = $this->encodeSpecialCharacters($ruta);

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
                'created_at',
                'updated_at',
                'deleted_at',
                'domicilio_personal',
            ]);
        }

        return response(json_encode(
            [
                'equipo_trabajo' => $equipo_trabajo,
            ],
        ), 200)->header('Content-Type', 'application/json');
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
}

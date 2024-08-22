<?php

namespace app\Http\Controllers\Api\V1\PortalComunicacion;

use App\Http\Controllers\Controller;
use App\Models\Comiteseguridad;
use App\Models\ComunicacionSgi;
use App\Models\Documento;
use App\Models\Empleado;
use App\Models\FelicitarCumpleaños;
use App\Models\Organizacione;
use App\Models\PoliticaSgsi;
use App\Models\User;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class tbApiMobileControllerPortalComunicacion extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tbFunctionIndex()
    {
        // abort_if(Gate::denies('portal_de_comunicaccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

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

        $hoy = Carbon::now();
        $fecha_hoy = $hoy->toDateString();

        // $politica_existe = PoliticaSgsi::getAll()->count();
        $empleados = Empleado::alta()->select('id', 'name', 'area_id', 'puesto_id', 'foto', 'antiguedad', 'cumpleaños', 'estatus');
        $user = User::getCurrentUser();

        $user->foto_empleado = $user->empleado->avatar;
        $user->makeHidden([
            'empleado',
        ]);
        $empleado_asignado = $user->n_empleado;
        $authId = $user->id;

        $documentos_publicados = Documento::with('macroproceso', 'responsable')->where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(6);

        foreach ($documentos_publicados as $key_nuevo => $documento) {
            $documento->id_responsable = $documento->responsable->id;
            $documento->nombre_responsable = $documento->responsable->name;
            $documento->archivo = encodeSpecialCharacters($documento->archivo_actual);

            if ($documento->responsable->foto == null || $documento->responsable->foto == '0') {
                if ($documento->responsable->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($documento->responsable->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/'.$documento->responsable->foto);
            }

            // Encode spaces in the URL
            $documento->ruta_responsable_foto = encodeSpecialCharacters($ruta);

            $documento->makeHidden([
                'responsable',
                'archivo_actual',
            ]);
        }

        // $comite_existe = Comiteseguridad::getAll()->count();
        $nuevos = $empleados->whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->get();
        $comunicados = ComunicacionSgi::getAllwithImagenesBlog()->makeHidden(['descripcion', 'created_at', 'updated_at', 'imagenes_comunicacion']);
        foreach ($comunicados as $key_comunicados => $comunicado) {
            $comunicado->texto_descripcion = $comunicado->descripcion;
            $comunicado->tipo_imagen = $comunicado->imagenes_comunicacion->first()->tipo;
            $ruta_comunicado = asset('storage/imagen_comunicado_SGI/'.$comunicado->imagenes_comunicacion->first()->imagen);
            $comunicado->ruta_imagen = encodeSpecialCharacters($ruta_comunicado);
        }

        $imagesCommunications = $comunicados->filter(function ($item) {
            return $item->tipo_imagen === 'imagen';
        });

        foreach ($imagesCommunications->take(4) as $imageCommunication) {
            $comunication[] = $imageCommunication;
        }

        $noticias = ComunicacionSgi::getAllwithImagenesCarrousel()->makeHidden(['descripcion', 'created_at', 'updated_at', 'imagenes_comunicacion']);

        foreach ($noticias as $key_noticia => $noticia) {
            $noticia->texto_descripcion = $noticia->descripcion;
            $noticia->tipo_imagen = $noticia->imagenes_comunicacion->first()->tipo;
            $ruta_noticia = asset('storage/imagen_comunicado_SGI/'.$noticia->imagenes_comunicacion->first()->imagen);
            $noticia->ruta_imagen = encodeSpecialCharacters($ruta_noticia);
        }

        $imagesNews = $noticias->filter(function ($item) {
            return $item->tipo_imagen === 'imagen';
        });

        foreach ($imagesNews->take(3) as $imageNews) {
            $news[] = $imageNews;
        }

        $cumpleaños = Cache::remember('Portal_cumpleaños_'.$authId, 3600, function () use ($hoy) {
            return Empleado::alta()->select('id', 'name', 'area_id', 'puesto_id', 'foto', 'cumpleaños', 'estatus')->whereMonth('cumpleaños', '=', $hoy->format('m'))->get()->makeHidden([
                'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet',
                'area', 'supervisor', 'puestoRelacionado',
            ]);
        });

        foreach ($nuevos as $key_nuevo => $nuevo) {
            $nuevo->id_area = $nuevo->area->id;
            $nuevo->nombre_area = $nuevo->area->area;
            $nuevo->id_puesto = $nuevo->puestoRelacionado->id;
            $nuevo->nombre_puesto = $nuevo->puesto;

            if ($nuevo->foto == null || $nuevo->foto == '0') {
                if ($nuevo->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($nuevo->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/'.$nuevo->foto);
            }

            // Encode spaces in the URL
            $nuevo->ruta_foto = encodeSpecialCharacters($ruta);

            $nuevo->makeHidden([
                'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet',
                'area', 'supervisor', 'area_id', 'puesto_id', 'foto', 'puestoRelacionado',
            ]);
        }

        foreach ($cumpleaños as $key => $cumple) {
            $cumple->id_area = $cumple->area->id;
            $cumple->nombre_area = $cumple->area->area;
            $cumple->id_puesto = $cumple->puestoRelacionado->id;
            $cumple->nombre_puesto = $cumple->puesto;

            $cumple->fecha_cumpleanos = $this->tbFunctionConvertirCumpleanos($cumple->cumpleaños);

            if ($cumple->foto == null || $cumple->foto == '0') {
                if ($cumple->genero == 'H') {
                    $ruta = asset('storage/empleados/imagenes/man.png');
                } elseif ($cumple->genero == 'M') {
                    $ruta = asset('storage/empleados/imagenes/woman.png');
                } else {
                    $ruta = asset('storage/empleados/imagenes/usuario_no_cargado.png');
                }
            } else {
                $ruta = asset('storage/empleados/imagenes/'.$cumple->foto);
            }

            // Encode spaces in the URL
            $cumple->ruta_foto = encodeSpecialCharacters($ruta);

            $cumple->makeHidden([
                'area_id',
                'puesto_id',
                'foto',
                'cumpleaños',
            ]);
        }

        // $aniversarios = Cache::remember('Portal:portal_aniversarios', 3600 * 4, function () use ($hoy, $empleados) {
        //     return $empleados->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->get();
        // });

        // $aniversarios_contador_circulo = Cache::remember('Portal:portal_aniversarios_contador_circulo', 3600 * 4, function () use ($hoy, $empleados) {
        //     return $empleados->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->count();
        // });
        // dd($comunicacionSgis, $comunicacionSgis_carrusel, $empleado_asignado, $aniversarios_contador_circulo, $politica_existe, $comite_existe, $nuevos, $cumpleaños, $user);
        // dd($cumpleaños);

        // dd($comunicados,$noticias);

        return response(json_encode(
            [
                'documentos' => $documentos_publicados,
                'hoy' => $fecha_hoy,
                'comunicados' => $comunication,
                'noticias' => $news,
                'empleado_asignado' => $empleado_asignado,
                // 'aniversarios' => $aniversarios,
                // 'aniversarios_contador_circulo' => $aniversarios_contador_circulo,
                // 'politica_existe' => $politica_existe,
                // 'comite_existe' => $comite_existe,
                'nuevos' => $nuevos,
                'cumpleaños' => $cumpleaños,
                'user' => $user,
            ],
        ), 200)->header('Content-Type', 'application/json');
    }

    public function tbFunctionConvertirCumpleanos($fecha)
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
        $fecha_cumpleanos = $dia_cumpleanos.' de '.$mes_cumpleanos;

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

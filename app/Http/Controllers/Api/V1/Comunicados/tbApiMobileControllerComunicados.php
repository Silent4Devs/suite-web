<?php

namespace app\Http\Controllers\Api\V1\Comunicados;

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

class tbApiMobileControllerComunicados extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tbFunctionIndex()
    {
        // abort_if(Gate::denies('portal_de_comunicaccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hoy = Carbon::now();
        $fecha_hoy = $hoy->toDateString();

        $comunicados = ComunicacionSgi::getAllwithImagenesBlog()->makeHidden(['created_at', 'updated_at', 'deleted_at', 'team_id', 'id_publico', 'imagenes_comunicacion']);

        foreach ($comunicados as $key_comunicados => $comunicado) {
            $comunicado->tipo_imagen = $comunicado->imagenes_comunicacion->first()->tipo;
            $ruta_comunicado = asset('storage/imagen_comunicado_SGI/'.$comunicado->imagenes_comunicacion->first()->imagen);
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

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
use Illuminate\Support\Arr;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;

class PortalComunicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $id)
    {
        // abort_if(Gate::denies('portal_de_comunicaccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hoy = Carbon::now();
        $fecha_hoy = $hoy->toDateString();

        // $politica_existe = PoliticaSgsi::getAll()->count();
        $empleados = Empleado::alta()->select('id', 'name', 'area_id', 'puesto_id', 'foto', 'antiguedad', 'cumpleaños', 'estatus');
        $user = User::find($id);

        $user->foto_empleado = $user->empleado->avatar;
        $user->makeHidden([
            'empleado'
        ]);
        $empleado_asignado = $user->n_empleado;
        $authId = $user->id;

        $documentos_publicados = Documento::getLastFiveWithMacroproceso();
        // $comite_existe = Comiteseguridad::getAll()->count();
        $nuevos = $empleados->whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->get();
        $comunicados = ComunicacionSgi::getAllwithImagenesBlog();
        $noticias = ComunicacionSgi::getAllwithImagenesCarrousel()->take(3);

        $cumpleaños = Cache::remember('Portal_cumpleaños_' . $authId, 3600, function () use ($hoy, $empleados) {
            return Empleado::alta()->select('id', 'name', 'area_id', 'puesto_id', 'foto', 'cumpleaños', 'estatus')->whereMonth('cumpleaños', '=', $hoy->format('m'))->get()->makeHidden([
                'avatar', 'avatar_ruta', 'resourceId', 'empleados_misma_area', 'genero_formateado', 'puesto', 'declaraciones_responsable', 'declaraciones_aprobador', 'declaraciones_responsable2022', 'declaraciones_aprobador2022', 'fecha_ingreso', 'saludo', 'saludo_completo',
                'actual_birdthday', 'actual_aniversary', 'obtener_antiguedad', 'empleados_pares', 'competencias_asignadas', 'objetivos_asignados', 'es_supervisor', 'fecha_min_timesheet',
                'area', 'supervisor'
            ]);
        });

        foreach ($cumpleaños as $key => $cumple) {
            $cumple->nombre_area = $cumple->area->area;
            $cumple->makeHidden([
                'area_id',
                'puesto_id'
            ]);
        }

        // dd($cumpleaños);
        // $aniversarios = Cache::remember('Portal:portal_aniversarios', 3600 * 4, function () use ($hoy, $empleados) {
        //     return $empleados->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->get();
        // });

        // $aniversarios_contador_circulo = Cache::remember('Portal:portal_aniversarios_contador_circulo', 3600 * 4, function () use ($hoy, $empleados) {
        //     return $empleados->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->count();
        // });
        // dd($comunicacionSgis, $comunicacionSgis_carrusel, $empleado_asignado, $aniversarios_contador_circulo, $politica_existe, $comite_existe, $nuevos, $cumpleaños, $user);
        // dd($cumpleaños);
        return response()->json(
            [
                'documentos' => $documentos_publicados,
                'hoy' => $fecha_hoy,
                'comunicados' => $comunicados,
                'noticias' => $noticias,
                'empleado_asignado' => $empleado_asignado,
                // 'aniversarios' => $aniversarios,
                // 'aniversarios_contador_circulo' => $aniversarios_contador_circulo,
                // 'politica_existe' => $politica_existe,
                // 'comite_existe' => $comite_existe,
                'nuevos' => $nuevos,
                'cumpleaños' => $cumpleaños,
                'user' => $user,
            ]
        );
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

    public function reportes()
    {
        abort_if(Gate::denies('portal_comunicacion_mostrar_reportar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $organizacions = Organizacione::first();

        return view('admin.portalCommunication.reportes', compact('organizacions'));
    }

    public function felicitarCumpleaños($cumpleañero_id)
    {
        $felicitar = FelicitarCumpleaños::create([
            'cumpleañero_id' => $cumpleañero_id,
            'felicitador_id' => User::getCurrentUser()->empleado->id,
            'like' => true,
        ]);

        return redirect()->route('admin.portal-comunicacion.index')->with('success', 'Like generado');
    }

    public function felicitarCumpleañosDislike($id)
    {
        $felicitar = FelicitarCumpleaños::where('id', $id);
        $felicitar->update([
            'like' => false,
        ]);

        return redirect()->route('admin.portal-comunicacion.index')->with('success', 'DisLike generado');
    }

    public function felicitarCumplesComentarios(Request $request, $cumpleañero_id)
    {
        $comentario = FelicitarCumpleaños::create([
            'cumpleañero_id' => $cumpleañero_id,
            'felicitador_id' => User::getCurrentUser()->empleado->id,
            'comentarios' => $request->comentarios,
        ]);

        return redirect()->route('admin.portal-comunicacion.index')->with('success', 'Comentario generado');
    }

    public function felicitarCumplesComentariosUpdate(Request $request, $id)
    {
        $comentario = FelicitarCumpleaños::where('id', $id);
        $comentario->update([
            'comentarios' => $request->comentarios,
        ]);

        return redirect()->route('admin.portal-comunicacion.index')->with('success', 'Comentario actualizado');
    }
}

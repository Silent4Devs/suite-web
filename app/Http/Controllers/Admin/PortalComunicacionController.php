<?php

namespace App\Http\Controllers\Admin;

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

class PortalComunicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('portal_de_comunicaccion_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $hoy = Carbon::now();
        $hoy->toDateString();

        // $results = Fork::new()
        //     ->run(
        //         function () {
        //             $user = User::getCurrentUser();

        //             return $user;
        //         },
        //         function () {
        //             $politica_existe = PoliticaSgsi::getAll()->count();

        //             return $politica_existe;
        //         },
        //         function () {
        //             $comite_existe = Comiteseguridad::getAll()->count();

        //             return $comite_existe;
        //         },
        //         function () {
        //             $documentos_publicados = Documento::getLastFiveWithMacroproceso();

        //             return $documentos_publicados;
        //         },

        //         function () {
        //             $comunicacionSgis = ComunicacionSgi::getAllwithImagenesBlog();

        //             return $comunicacionSgis;
        //         },
        //         function () {
        //             $comunicacionSgis_carrusel = ComunicacionSgi::getAllwithImagenesCarrousel();

        //             return $comunicacionSgis_carrusel;
        //         },
        //     );

        $user = User::getCurrentUser();

        $empleado_asignado = $user->n_empleado;
        $authId = $user->id;
        $politica_existe = PoliticaSgsi::getAll()->count();
        $comite_existe = Comiteseguridad::getAll()->count();
        $documentos_publicados = Documento::getLastFiveWithMacroproceso();
        $comunicacionSgis = ComunicacionSgi::getAllwithImagenesBlog();
        $comunicacionSgis_carrusel = ComunicacionSgi::getAllwithImagenesCarrousel();
        $nuevos = Empleado::whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->get();
        $getAlta = Empleado::alta();

        $cumpleaños = Cache::remember('Portal_cumpleaños_'.$authId, 3600, function () use ($hoy, $getAlta) {
            return $getAlta->whereMonth('cumpleaños', '=', $hoy->format('m'))->get();
        });

        $aniversarios = Cache::remember('Portal:portal_aniversarios', 3600 * 4, function () use ($hoy) {
            return Empleado::alta()->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->get();
        });

        $aniversarios_contador_circulo = Cache::remember('Portal:portal_aniversarios_contador_circulo', 3600 * 4, function () use ($hoy) {
            return Empleado::alta()->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->count();
        });

        return view('admin.portal-comunicacion.index', compact('documentos_publicados', 'hoy', 'comunicacionSgis', 'comunicacionSgis_carrusel', 'empleado_asignado', 'aniversarios_contador_circulo', 'politica_existe', 'comite_existe', 'nuevos', 'cumpleaños', 'user'));
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

        return view('admin.portal-comunicacion.reportes', compact('organizacions'));
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

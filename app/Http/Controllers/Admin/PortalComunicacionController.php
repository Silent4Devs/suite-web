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
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
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
        $authId = Auth::user()->id;

        $nuevos = Cache::remember('portal_nuevos_' . $authId, 3600 * 2, function () use ($hoy) {
            return Empleado::whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->get();
        });

        $nuevos_contador_circulo = Cache::remember('portal_nuevos_contador_circulo_' . $authId, 3600 * 2, function () use ($hoy) {
            return Empleado::whereBetween('antiguedad', [$hoy->firstOfMonth()->format('Y-m-d'), $hoy->endOfMonth()->format('Y-m-d')])->count();
        });

        $cumpleaños = Cache::remember('portal_cumpleaños_' . $authId, 3600 * 2, function () use ($hoy) {
            return Empleado::whereMonth('cumpleaños', '=', $hoy->format('m'))->get();
        });

        $cumpleaños_contador_circulo = Cache::remember('portal_contador_circulo_' . $authId, 3600 * 2, function () use ($hoy) {
            return Empleado::alta()->whereMonth('cumpleaños', '=', $hoy->format('m'))->get()->count();
        });

        $aniversarios = Cache::remember('portal_aniversarios_' . $authId, 3600 * 2, function () use ($hoy) {
            return Empleado::alta()->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->get();
        });

        $aniversarios_contador_circulo = Cache::remember('portal_aniversarios_contador_circulo_' . $authId, 3600 * 2, function () use ($hoy) {
            return Empleado::alta()->whereMonth('antiguedad', '=', $hoy->format('m'))->whereYear('antiguedad', '<', $hoy->format('Y'))->count();
        });

        $documentos_publicados = Documento::with('macroproceso')->where('estatus', Documento::PUBLICADO)->latest('updated_at')->get()->take(5);

        $comunicacionSgis = ComunicacionSgi::with('imagenes_comunicacion')->where('publicar_en', '=', 'Blog')->orWhere('publicar_en', '=', 'Ambos')->where('fecha_programable', '<=', Carbon::now()->format('Y-m-d'))->where('fecha_programable_fin', '>=', Carbon::now()->format('Y-m-d'))->get();
        // dd($comunicacionSgis);

        $comunicacionSgis_carrusel = ComunicacionSgi::with('imagenes_comunicacion')->where('publicar_en', '=', 'Carrusel')->orWhere('publicar_en', '=', 'Ambos')->where('fecha_programable', '<=', Carbon::now()->format('Y-m-d'))->where('fecha_programable_fin', '>=', Carbon::now()->format('Y-m-d'))->get();

        $empleado_asignado = auth()->user()->n_empleado;

        $politica_existe = PoliticaSgsi::getAll()->count();
        $comite_existe = Comiteseguridad::getAll()->count();

        return view('admin.portal-comunicacion.index', compact('documentos_publicados', 'nuevos', 'cumpleaños', 'aniversarios', 'hoy', 'comunicacionSgis', 'comunicacionSgis_carrusel', 'empleado_asignado', 'nuevos_contador_circulo', 'cumpleaños_contador_circulo', 'aniversarios_contador_circulo', 'politica_existe', 'comite_existe'));
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
            'felicitador_id' => auth()->user()->empleado->id,
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
            'felicitador_id' => auth()->user()->empleado->id,
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

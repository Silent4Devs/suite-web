<?php

namespace App\Http\Controllers\Admin;

use App\Functions\Porcentaje2022;
use App\Http\Controllers\Controller;
use App\Models\Iso27\GapDosConcentradoIso;
use App\Models\Iso27\GapTresConcentradoIso;
use App\Models\Iso27\GapUnoConcentratoIso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AnalisisBIsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // dd('Vamos bien');
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapunos = GapUnoConcentratoIso::where('id_analisis_brechas', request()->id)->with('gap_uno_catalogo')->orderBy('id', 'ASC')->get();
        $gaptresver = GapTresConcentradoIso::where('id_analisis_brechas', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'verificar');
        })->orderBy('id', 'ASC')->get();
        $gaptresact = GapTresConcentradoIso::where('id_analisis_brechas', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'actuar');
        })->orderBy('id', 'ASC')->get();

        $gapa5 = GapDosConcentradoIso::where('id_analisis_brechas', request()->id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
            ->whereHas('gap_dos_catalogo', function ($query) {
                return $query->where('control_iso', 'LIKE', '5.'.'%');
            })->orderBy('id', 'ASC')->get();

        $gapa6 = GapDosConcentradoIso::where('id_analisis_brechas', request()->id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
            ->whereHas('gap_dos_catalogo', function ($query) {
                return $query->where('control_iso', 'LIKE', '6.'.'%');
            })->orderBy('id', 'ASC')->get();

        $gapa7 = GapDosConcentradoIso::where('id_analisis_brechas', request()->id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
            ->whereHas('gap_dos_catalogo', function ($query) {
                return $query->where('control_iso', 'LIKE', '7.'.'%');
            })->orderBy('id', 'ASC')->get();

        $gapa8 = GapDosConcentradoIso::where('id_analisis_brechas', request()->id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
            ->whereHas('gap_dos_catalogo', function ($query) {
                return $query->where('control_iso', 'LIKE', '8.'.'%');
            })->orderBy('id', 'ASC')->get();

        $gap1porcentaje = GapUnoConcentratoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', request()->id)->orderBy('id', 'asc')->get();
        $gap1satisfactorios = GapUnoConcentratoIso::select('id')->where('valoracion', '1')->where('id_analisis_brechas', '=', request()->id)->count();
        $gap1parcialmente = GapUnoConcentratoIso::select('id')->where('valoracion', '2')->where('id_analisis_brechas', '=', request()->id)->count();
        $gap1nocumple = GapUnoConcentratoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', request()->id)->count();
        $gapunoPorc = new Porcentaje2022();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje);
        // dd($porcentajeGap1);
        // dd($gap1porcentaje, $gap1satisfactorios, $gap1parcialmente, $gap1nocumple);

        $gap2porcentaje = GapDosConcentradoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', request()->id)->orderBy('id', 'asc')->get();
        $gap2satisfactorios = GapDosConcentradoIso::select('id')->where('valoracion', '1')->where('id_analisis_brechas', '=', request()->id)->count();
        $gap2parcialmente = GapDosConcentradoIso::select('id')->where('valoracion', '2')->where('id_analisis_brechas', '=', request()->id)->count();
        $gap2nocumple = GapDosConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', request()->id)->count();
        $gap2noaplica = GapDosConcentradoIso::select('id')->where('valoracion', '=', '4')->where('id_analisis_brechas', '=', request()->id)->count();
        $total = 93 - $gap2noaplica;
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorios, $gap2parcialmente);
        // dd($gap2porcentaje, $gap2satisfactorios, $gap2parcialmente, $gap2nocumple, $gap2noaplica);
        // dd($porcentajeGap2);

        $gap3porcentaje = GapTresConcentradoIso::select('id', 'valoracion', 'id_analisis_brechas')->where('id_analisis_brechas', '=', request()->id)->orderBy('id', 'asc')->count();
        $gap3satisfactorios = GapTresConcentradoIso::select('id')->where('valoracion', '=', '1')->where('id_analisis_brechas', '=', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'verificar');
        })->count();
        $gap3parcialmente = GapTresConcentradoIso::select('id')->where('valoracion', '=', '2')->where('id_analisis_brechas', '=', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'verificar');
        })->count();
        $gap3nocumple = GapTresConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'verificar');
        })->count();
        $gap3asatisfactorios = GapTresConcentradoIso::select('id')->where('valoracion', '=', '1')->where('id_analisis_brechas', '=', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'actuar');
        })->count();
        $gap3aparcialmente = GapTresConcentradoIso::select('id')->where('valoracion', '=', '2')->where('id_analisis_brechas', '=', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'actuar');
        })->count();
        $gap3anocumple = GapTresConcentradoIso::select('id')->where('valoracion', '=', '3')->where('id_analisis_brechas', '=', request()->id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function ($query) {
            return $query->where('estado', '=', 'actuar');
        })->count();
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap3asatisfactorios, $gap3aparcialmente);

        // dd($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap3nocumple, $gap3asatisfactorios, $gap3aparcialmente, $gap3anocumple);
        // dd($porcentajeGap3);

        $conteos = [
            'Gap1' => [
                'satisfactorio' => $gap1satisfactorios,
                'parcialmente' => $gap1parcialmente,
                'nocumple' => $gap1nocumple,
            ],
            'Gap2' => [
                'satisfactorio' => $gap2satisfactorios,
                'parcialmente' => $gap2parcialmente,
                'nocumple' => $gap2nocumple,
                'noaplica' => $gap2noaplica,
            ],
            'Gap3verif' => [
                'satisfactorio' => $gap3satisfactorios,
                'parcialmente' => $gap3parcialmente,
                'nocumple' => $gap3nocumple,
            ],
            'Gap3actuar' => [
                'satisfactorio' => $gap3asatisfactorios,
                'parcialmente' => $gap3aparcialmente,
                'nocumple' => $gap3anocumple,
            ],
        ];

        return view('admin.dashboard-ISO27001.index', compact('gapunos', 'gaptresver', 'gaptresact', 'gapa5', 'gapa6', 'gapa7', 'gapa8'))
            ->with('porcentajeGap1', $porcentajeGap1)->with('porcentajeGap2', $porcentajeGap2)
            ->with('porcentajeGap3', $porcentajeGap3)->with('conteos', $conteos);
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

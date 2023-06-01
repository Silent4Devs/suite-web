<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Models\Iso27\GapUnoCatalogoIso;
use App\Models\Iso27\GapDosCatalogoIso;
use App\Models\Iso27\GapTresCatalogoIso;
use App\Models\Iso27\GapUnoConcentratoIso;
use App\Models\Iso27\GapDosConcentradoIso;
use App\Models\Iso27\GapTresConcentradoIso;
use App\Models\Iso27\AnalisisBrechasIso;

class AnalisisBIsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        // dd('Vamos bien');
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapunos = GapUnoConcentratoIso::where('id_analisis_brechas', $id)->with('gap_uno_catalogo')->orderBy('id', 'ASC')->get();
        $gaptresver = GapTresConcentradoIso::where('id_analisis_brechas', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'verificar');
        })->orderBy('id', 'ASC')->get();
        $gaptresact = GapTresConcentradoIso::where('id_analisis_brechas', $id)->with('gap_tres_catalogo')->whereHas('gap_tres_catalogo', function($query){
            return $query->where('estado', '=', 'actuar');
        })->orderBy('id', 'ASC')->get();

        $gapa5 = GapDosConcentradoIso::where('id_analisis_brechas', $id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
        ->whereHas('gap_dos_catalogo', function($query){
            return $query->where('control_iso', 'LIKE', "A.5.".'%');
        })->orderBy('id', 'ASC')->get();

        $gapa6 = GapDosConcentradoIso::where('id_analisis_brechas', $id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
        ->whereHas('gap_dos_catalogo', function($query){
            return $query->where('control_iso', 'LIKE', "A.6.".'%');
        })->orderBy('id', 'ASC')->get();

        $gapa7 = GapDosConcentradoIso::where('id_analisis_brechas', $id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
        ->whereHas('gap_dos_catalogo', function($query){
            return $query->where('control_iso', 'LIKE', "A.7.".'%');
        })->orderBy('id', 'ASC')->get();

        $gapa8 = GapDosConcentradoIso::where('id_analisis_brechas', $id)->with('gap_dos_catalogo')->with('gap_dos_catalogo.clasificacion')
        ->whereHas('gap_dos_catalogo', function($query){
            return $query->where('control_iso', 'LIKE', "A.8.".'%');
        })->orderBy('id', 'ASC')->get();
        return view('admin.dashboard-ISO27001.index', compact('gapunos', 'gaptresver', 'gaptresact', 'gapa5', 'gapa6', 'gapa7', 'gapa8'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

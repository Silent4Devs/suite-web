<?php

namespace App\Http\Controllers\Admin;


use App\Functions\Porcentaje;
use App\Http\Controllers\Controller;
use App\Models\GapDosSedatu;
use App\Models\GapTresSedatu;
use App\Models\GapUnoSedatu;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class AnalisisBController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapuno = GapUnoSedatu::orderBy('id', 'ASC')->get()->where('analisis_brechas_id', '=', request()->id);
        // dd($gapuno);
        $gaptresVerif = GapTresSedatu::orderBy('id', 'ASC')->get()->where('analisis_brechas_id', '=', request()->id);
        $gaptresAct = GapTresSedatu::get()->where('analisis_brechas_id', '=', request()->id);
        $gapa5 = GapDosSedatu::orderBy('id', 'ASC')->get()->where('analisis_brechas_id', '=', request()->id);
        $gapa6 = GapDosSedatu::orderBy('id', 'ASC')->get()->where('analisis_brechas_id', '=', request()->id);

        $gap1porcentaje = GapUnoSedatu::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', request()->id)->skip(3)->take(91);
        $gap12porcentaje = GapUnoSedatu::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', request()->id)->take(3);
        
        $gap1inexistente = GapUnoSedatu::select('id')->where('valoracion', '=', '0')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1inicial = GapUnoSedatu::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1repetible = GapUnoSedatu::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1definida = GapUnoSedatu::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1administrada = GapUnoSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1optimizada = GapUnoSedatu::select('id')->where('valoracion', '=', '5')->where('analisis_brechas_id', '=', request()->id)->count();

        $gap2inexistente = GapDosSedatu::select('id')->where('valoracion', '=', '0')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2inicial = GapDosSedatu::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2repetible = GapDosSedatu::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2definida = GapDosSedatu::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2administrada = GapDosSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2optimizada = GapDosSedatu::select('id')->where('valoracion', '=', '5')->where('analisis_brechas_id', '=', request()->id)->count();

        $gap3inexistente = GapTresSedatu::select('id')->where('valoracion', '=', '0')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3inicial = GapTresSedatu::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3repetible = GapTresSedatu::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3definida = GapTresSedatu::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3administrada = GapTresSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3optimizada = GapTresSedatu::select('id')->where('valoracion', '=', '5')->where('analisis_brechas_id', '=', request()->id)->count();

        $gap3inexistente1 = GapTresSedatu::select('id')->where('valoracion', '=', '0')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3inicial2 = GapTresSedatu::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3repetible3 = GapTresSedatu::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3definida4 = GapTresSedatu::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3administrada5 = GapTresSedatu::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3optimizada6 = GapTresSedatu::select('id')->where('valoracion', '=', '5')->where('analisis_brechas_id', '=', request()->id)->count();

        $gap3porcentaje = GapTresSedatu::select('id', 'valoracion')->where('analisis_brechas_id', '=', request()->id)->get();
        
        $gap31porcentaje = GapTresSedatu::select('id', 'valoracion')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->get();
        $gap3satisfactorios = GapTresSedatu::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3parcialmente = GapTresSedatu::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3nocumple = GapTresSedatu::select('id')->where('valoracion', '=', '3')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3asatisfactorios = GapTresSedatu::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3aparcialmente = GapTresSedatu::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3anocumple = GapTresSedatu::select('id')->where('valoracion', '=', '3')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();
      
        $total = GapDosSedatu::select('id')->where('analisis_brechas_id','=', request()->id)->get()->count();
        // dd($total);
        $gapunoPorc = new Porcentaje();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
        $porcentajeGap1=(($porcentajeGap1 * 100)/455);
        $porcentajeGap1=(($porcentajeGap1*30)/100);
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($total,$gap2inexistente, $gap2inicial, $gap2repetible,$gap2definida, $gap2administrada,$gap2optimizada);
        $totaltres = GapTresSedatu::select('id')->where('analisis_brechas_id','=', request()->id)->get()->count();
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($totaltres,$gap3porcentaje, $gap31porcentaje,$gap3optimizada,$gap3administrada, $gap3definida, $gap3repetible, $gap3inicial,$gap3inexistente);

        $conteos = [
            'Gap1' => [
                'inexistente' => $gap1inexistente,
                'inicial' => $gap1inicial,
                'repetible' => $gap1repetible,
                'definida' => $gap1definida,
                'administrada' => $gap1administrada,
                'optimizada' => $gap1optimizada,
            ],
            'Gap2' => [
                'inexistente' => $gap2inexistente,
                'inicial' => $gap2inicial,
                'repetible' => $gap2repetible,
                'definida' => $gap2definida,
                'administrada' => $gap2administrada,
                'optimizada' => $gap2optimizada,
            ],
            'Gap3verif' => [
                'inexistente' => $gap3inexistente,
                'inicial' => $gap3inicial,
                'repetible' => $gap3repetible,
                'definida' => $gap3definida,
                'administrada' => $gap3administrada,
                'optimizada' => $gap3optimizada,
            ],
            'Gap3actuar' => [
                'inexistente' => $gap3inexistente1,
                'inicial' => $gap3inicial2,
                'repetible' => $gap3repetible3,
                'definida' => $gap3definida4,
                'administrada' => $gap3administrada5,
                'optimizada' => $gap3optimizada6,
            ],
        ];


        
        return view('dashboard.index', compact('gaptresVerif', 'gaptresAct'))
            ->with('gapunos', $gapuno)->with('gapda5s', $gapa5)->with('gapda6s', $gapa6)
            ->with('porcentajeGap1', $porcentajeGap1)
            ->with('porcentajeGap2', $porcentajeGap2)->with('porcentajeGap3', $porcentajeGap3)->with('conteos', $conteos);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function id($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, $id)
    // {
    //     if ($request->ajax()) {
    //         GapUno::find($request->input('pk'))->update([$request->input('evidencia') => $request->input('value')]);

    //         return response()->json(['success' => true]);
    //     }
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function obtenerAnalisis()
    {
        return view('admin.procesos.vistas');
    }
}

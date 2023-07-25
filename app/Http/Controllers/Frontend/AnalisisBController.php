<?php

namespace App\Http\Controllers\Frontend;

use App\Functions\Porcentaje;
use App\Http\Controllers\Controller;
use App\Models\GapDo;
use App\Models\GapTre;
use App\Models\GapUno;
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
        //abort_if(Gate::denies('analisis_brechas_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapuno = GapUno::orderBy('id', 'DESC')->get();
        $gaptresVerif = GapTre::get()->where('estado', '=', 'verificar');
        $gaptresAct = GapTre::get()->where('estado', '=', 'actuar');
        $gapa5 = GapDo::get()->where('control-uno', '=', 'A5');
        $gapa6 = GapDo::get()->where('control-dos', '=', 'A6.1');
        $gapa62 = GapDo::get()->where('control-dos', '=', 'A6.2');
        $gapa71 = GapDo::get()->where('control-dos', '=', 'A7.1');
        $gapa72 = GapDo::get()->where('control-dos', '=', 'A7.2');
        $gapa73 = GapDo::get()->where('control-dos', '=', 'A7.3');
        $gapa81 = GapDo::get()->where('control-dos', '=', 'A8.1');
        $gapa82 = GapDo::get()->where('control-dos', '=', 'A8.2');
        $gapa83 = GapDo::get()->where('control-dos', '=', 'A8.3');
        $gapa91 = GapDo::get()->where('control-dos', '=', 'A9.1');
        $gapa92 = GapDo::get()->where('control-dos', '=', 'A9.2');
        $gapa93 = GapDo::get()->where('control-dos', '=', 'A9.3');
        $gapa94 = GapDo::get()->where('control-dos', '=', 'A9.4');
        $gapa101 = GapDo::get()->where('control-dos', '=', 'A10.1');
        $gapa111 = GapDo::get()->where('control-dos', '=', 'A11.1');
        $gapa112 = GapDo::get()->where('control-dos', '=', 'A11.2');
        $gapa121 = GapDo::get()->where('control-dos', '=', 'A12.1');
        $gapa122 = GapDo::get()->where('control-dos', '=', 'A12.2');
        $gapa123 = GapDo::get()->where('control-dos', '=', 'A12.3');
        $gapa124 = GapDo::get()->where('control-dos', '=', 'A12.4');
        $gapa125 = GapDo::get()->where('control-dos', '=', 'A12.5');
        $gapa126 = GapDo::get()->where('control-dos', '=', 'A12.6');
        $gapa127 = GapDo::get()->where('control-dos', '=', 'A12.7');
        $gapa131 = GapDo::get()->where('control-dos', '=', 'A13.1');
        $gapa132 = GapDo::get()->where('control-dos', '=', 'A13.2');
        $gapa141 = GapDo::get()->where('control-dos', '=', 'A14.1');
        $gapa142 = GapDo::get()->where('control-dos', '=', 'A14.2');
        $gapa143 = GapDo::get()->where('control-dos', '=', 'A14.3');
        $gapa151 = GapDo::get()->where('control-dos', '=', 'A15.1');
        $gapa152 = GapDo::get()->where('control-dos', '=', 'A15.2');
        $gapa161 = GapDo::get()->where('control-dos', '=', 'A16.1');
        $gapa171 = GapDo::get()->where('control-dos', '=', 'A17.1');
        $gapa172 = GapDo::get()->where('control-dos', '=', 'A17.2');
        $gapa181 = GapDo::get()->where('control-dos', '=', 'A18.1');
        $gapa182 = GapDo::get()->where('control-dos', '=', 'A18.2');
        $gap1porcentaje = GapUno::select('id', 'valoracion')->where('id', '<', '3')->get();
        $gap12porcentaje = GapUno::select('id', 'valoracion')->where('id', '>=', '3')->get();
        $gap1satisfactorios = GapUno::select('id')->where('valoracion', '=', '1')->count();
        $gap1parcialmente = GapUno::select('id')->where('valoracion', '=', '2')->count();
        $gap1nocumple = GapUno::select('id')->where('valoracion', '=', '3')->count();
        $gap2porcentaje = GapDo::select('id', 'valoracion')->where('valoracion', '!=', '4')->count();
        $gap2satisfactorio = GapDo::select('id', 'valoracion')->where('valoracion', '=', '1')->count();
        $gap2parcialmente = GapDo::select('id', 'valoracion')->where('valoracion', '=', '2')->count();
        $gap2nocumple = GapDo::select('id', 'valoracion')->where('valoracion', '=', '3')->count();
        $gap2noaplica = GapDo::select('id')->where('valoracion', '=', '4')->count();
        $gap3porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'verificar')->get();
        $gap31porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'actuar')->get();
        $gap3satisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'verificar')->count();
        $gap3parcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'verificar')->count();
        $gap3nocumple = GapTre::select('id')->where('valoracion', '=', '3')->where('estado', '=', 'verificar')->count();
        $gap3asatisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'actuar')->count();
        $gap3aparcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'actuar')->count();
        $gap3anocumple = GapTre::select('id')->where('valoracion', '=', '3')->where('estado', '=', 'actuar')->count();

        $total = 114 - $gap2noaplica;
        $gapunoPorc = new Porcentaje();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente);
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap31porcentaje);

        $conteos = [
            'Gap1' => [
                'satisfactorio' => $gap1satisfactorios,
                'parcialmente' => $gap1parcialmente,
                'nocumple' => $gap1nocumple,
            ],
            'Gap2' => [
                'satisfactorio' => $gap2satisfactorio,
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

        return view('dashboard.index', compact('gaptresVerif', 'gaptresAct'))
            ->with('gapunos', $gapuno)->with('gapda5s', $gapa5)->with('gapda6s', $gapa6)
            ->with('gapda62s', $gapa62)->with('gapda71s', $gapa71)->with('gapda72s', $gapa72)
            ->with('gapda73s', $gapa73)->with('gapda81s', $gapa81)->with('gapda82s', $gapa82)->with('gapda83s', $gapa83)
            ->with('gapda91s', $gapa91)->with('gapda92s', $gapa92)->with('gapda93s', $gapa93)->with('gapda94s', $gapa94)
            ->with('gapda101s', $gapa101)->with('gapda111s', $gapa111)->with('gapda112s', $gapa112)->with('gapda121s', $gapa121)
            ->with('gapda122s', $gapa122)->with('gapda123s', $gapa123)->with('gapda124s', $gapa124)->with('gapda125s', $gapa125)
            ->with('gapda126s', $gapa126)->with('gapda127s', $gapa127)->with('gapda131s', $gapa131)->with('gapda132s', $gapa132)
            ->with('gapda141s', $gapa141)->with('gapda142s', $gapa142)->with('gapda143s', $gapa143)->with('gapda151s', $gapa151)
            ->with('gapda152s', $gapa152)->with('gapda161s', $gapa161)->with('gapda171s', $gapa171)->with('gapda172s', $gapa172)
            ->with('gapda181s', $gapa181)->with('gapda182s', $gapa182)->with('porcentajeGap1', $porcentajeGap1)
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
    public function id($id)
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
        if ($request->ajax()) {
            GapUno::find($request->input('pk'))->update([$request->input('evidencia') => $request->input('value')]);

            return response()->json(['success' => true]);
        }
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

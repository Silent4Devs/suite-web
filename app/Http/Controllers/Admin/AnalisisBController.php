<?php

namespace App\Http\Controllers\Admin;

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
        abort_if(Gate::denies('analisis_de_brechas_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $gapuno = GapUno::orderBy('id', 'ASC')->get()->where('analisis_brechas_id', '=', request()->id);
        $gaptresVerif = GapTre::get()->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id);
        $gaptresAct = GapTre::get()->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id);
        $gapa5 = GapDo::get()->where('control-uno', '=', 'A5')->where('analisis_brechas_id', '=', request()->id);
        $gapa6 = GapDo::get()->where('control-dos', '=', 'A6.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa62 = GapDo::get()->where('control-dos', '=', 'A6.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa71 = GapDo::get()->where('control-dos', '=', 'A7.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa72 = GapDo::get()->where('control-dos', '=', 'A7.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa73 = GapDo::get()->where('control-dos', '=', 'A7.3')->where('analisis_brechas_id', '=', request()->id);
        $gapa81 = GapDo::get()->where('control-dos', '=', 'A8.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa82 = GapDo::get()->where('control-dos', '=', 'A8.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa83 = GapDo::get()->where('control-dos', '=', 'A8.3')->where('analisis_brechas_id', '=', request()->id);
        $gapa91 = GapDo::get()->where('control-dos', '=', 'A9.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa92 = GapDo::get()->where('control-dos', '=', 'A9.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa93 = GapDo::get()->where('control-dos', '=', 'A9.3')->where('analisis_brechas_id', '=', request()->id);
        $gapa94 = GapDo::get()->where('control-dos', '=', 'A9.4')->where('analisis_brechas_id', '=', request()->id);
        $gapa101 = GapDo::get()->where('control-dos', '=', 'A10.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa111 = GapDo::get()->where('control-dos', '=', 'A11.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa112 = GapDo::get()->where('control-dos', '=', 'A11.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa121 = GapDo::get()->where('control-dos', '=', 'A12.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa122 = GapDo::get()->where('control-dos', '=', 'A12.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa123 = GapDo::get()->where('control-dos', '=', 'A12.3')->where('analisis_brechas_id', '=', request()->id);
        $gapa124 = GapDo::get()->where('control-dos', '=', 'A12.4')->where('analisis_brechas_id', '=', request()->id);
        $gapa125 = GapDo::get()->where('control-dos', '=', 'A12.5')->where('analisis_brechas_id', '=', request()->id);
        $gapa126 = GapDo::get()->where('control-dos', '=', 'A12.6')->where('analisis_brechas_id', '=', request()->id);
        $gapa127 = GapDo::get()->where('control-dos', '=', 'A12.7')->where('analisis_brechas_id', '=', request()->id);
        $gapa131 = GapDo::get()->where('control-dos', '=', 'A13.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa132 = GapDo::get()->where('control-dos', '=', 'A13.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa141 = GapDo::get()->where('control-dos', '=', 'A14.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa142 = GapDo::get()->where('control-dos', '=', 'A14.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa143 = GapDo::get()->where('control-dos', '=', 'A14.3')->where('analisis_brechas_id', '=', request()->id);
        $gapa151 = GapDo::get()->where('control-dos', '=', 'A15.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa152 = GapDo::get()->where('control-dos', '=', 'A15.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa161 = GapDo::get()->where('control-dos', '=', 'A16.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa171 = GapDo::get()->where('control-dos', '=', 'A17.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa172 = GapDo::get()->where('control-dos', '=', 'A17.2')->where('analisis_brechas_id', '=', request()->id);
        $gapa181 = GapDo::get()->where('control-dos', '=', 'A18.1')->where('analisis_brechas_id', '=', request()->id);
        $gapa182 = GapDo::get()->where('control-dos', '=', 'A18.2')->where('analisis_brechas_id', '=', request()->id);
        $gap1porcentaje = GapUno::latest()->select('id', 'valoracion', 'analisis_brechas_id')->get()->where('analisis_brechas_id', '=', request()->id)->skip(3)->take(12);
        $gap12porcentaje = GapUno::select('id', 'valoracion', 'analisis_brechas_id')->orderBy('id', 'asc')->get()->where('analisis_brechas_id', '=', request()->id)->take(3);
        $gap1satisfactorios = GapUno::select('id')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1parcialmente = GapUno::select('id')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap1nocumple = GapUno::select('id')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2porcentaje = GapDo::select('id', 'valoracion')->where('valoracion', '!=', '4')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2satisfactorio = GapDo::select('id', 'valoracion')->where('valoracion', '=', '1')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2parcialmente = GapDo::select('id', 'valoracion')->where('valoracion', '=', '2')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2nocumple = GapDo::select('id', 'valoracion')->where('valoracion', '=', '3')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap2noaplica = GapDo::select('id')->where('valoracion', '=', '4')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap31porcentaje = GapTre::select('id', 'valoracion')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3satisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3parcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3nocumple = GapTre::select('id')->where('valoracion', '=', '3')->where('estado', '=', 'verificar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3asatisfactorios = GapTre::select('id')->where('valoracion', '=', '1')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3aparcialmente = GapTre::select('id')->where('valoracion', '=', '2')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();
        $gap3anocumple = GapTre::select('id')->where('valoracion', '=', '3')->where('estado', '=', 'actuar')->where('analisis_brechas_id', '=', request()->id)->count();

        $total = 114 - $gap2noaplica;
        $gapunoPorc = new Porcentaje();
        $porcentajeGap1 = $gapunoPorc->GapUnoPorc($gap1porcentaje, $gap12porcentaje);
        $porcentajeGap2 = $gapunoPorc->GapDosPorc($gap2porcentaje, $total, $gap2satisfactorio, $gap2parcialmente);
        $porcentajeGap3 = $gapunoPorc->GapTresPorc($gap3porcentaje, $gap3satisfactorios, $gap3parcialmente, $gap31porcentaje, $gap3asatisfactorios, $gap3aparcialmente);

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

    public function obtenerAnalisis()
    {
        return view('admin.procesos.vistas');
    }
}

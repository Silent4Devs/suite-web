<?php

namespace App\Http\Controllers\Admin;

use App\Models\DeclaracionAplicabilidad;
use App\Models\GapDo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Functions\Porcentaje;


class DeclaracionAplicabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $gapa5 = DeclaracionAplicabilidad::get()->where('control-uno', '=', 'A5');
      $gapa6 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A6.1');
      $gapa62 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A6.2');
      $gapa71 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A7.1');
      $gapa72 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A7.2');
      $gapa73 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A7.3');
      $gapa81 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A8.1');
      $gapa82 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A8.2');
      $gapa83 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A8.3');
      $gapa91 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.1');
      $gapa92 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.2');
      $gapa93 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.3');
      $gapa94 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.4');
      $gapa101 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A10.1');
      $gapa111 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A11.1');
      $gapa112 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A11.2');
      $gapa121 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.1');
      $gapa122 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.2');
      $gapa123 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.3');
      $gapa124 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.4');
      $gapa125 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.5');
      $gapa126 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.6');
      $gapa127 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.7');
      $gapa131 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A13.1');
      $gapa132 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A13.2');
      $gapa141 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A14.1');
      $gapa142 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A14.2');
      $gapa143 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A14.3');
      $gapa151 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A15.1');
      $gapa152 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A15.2');
      $gapa161 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A16.1');
      $gapa171 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A17.1');
      $gapa172 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A17.2');
      $gapa181 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A18.1');
      $gapa182 = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A18.2');


      return view('admin.declaracionaplicabilidad.index')
      ->with('gapda6s', $gapa6)->with('gapda5s', $gapa5)
      ->with('gapda62s', $gapa62)->with('gapda71s', $gapa71)->with('gapda72s', $gapa72)
      ->with('gapda73s', $gapa73)->with('gapda81s', $gapa81)->with('gapda82s', $gapa82)->with('gapda83s', $gapa83)
      ->with('gapda91s', $gapa91)->with('gapda92s', $gapa92)->with('gapda93s', $gapa93)->with('gapda94s', $gapa94)
      ->with('gapda101s', $gapa101)->with('gapda111s', $gapa111)->with('gapda112s', $gapa112)->with('gapda121s', $gapa121)
      ->with('gapda122s', $gapa122)->with('gapda123s', $gapa123)->with('gapda124s', $gapa124)->with('gapda125s', $gapa125)
      ->with('gapda126s', $gapa126)->with('gapda127s', $gapa127)->with('gapda131s', $gapa131)->with('gapda132s', $gapa132)
      ->with('gapda141s', $gapa141)->with('gapda142s', $gapa142)->with('gapda143s', $gapa143)->with('gapda151s', $gapa151)
      ->with('gapda152s', $gapa152)->with('gapda161s', $gapa161)->with('gapda171s', $gapa171)->with('gapda172s', $gapa172)
      ->with('gapda181s', $gapa181)->with('gapda182s', $gapa182);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return \Illuminate\Http\Response
     */
    public function show(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return \Illuminate\Http\Response
     */
    public function edit(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      if ($request->ajax()) {
          switch ($request->name) {

              case 'justificacion':
                  $gapun = DeclaracionAplicabilidad::findOrFail($id);
                  $gapun->justificacion = $request->value;
                  $gapun->save();
                  return response()->json(['success' => true]);
                  break;
              case 'aplica':
                  $gapun = DeclaracionAplicabilidad::findOrFail($id);
                  $gapun->aplica = $request->value;
                  $gapun->save();
                  return response()->json(['success' => true]);
                  break;

          }
     }

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        //
    }
}

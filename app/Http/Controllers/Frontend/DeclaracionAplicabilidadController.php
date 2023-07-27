<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DeclaracionAplicabilidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class DeclaracionAplicabilidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('declaracion_aplicabilidad_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        $conteoAplica = DeclaracionAplicabilidad::get()->where('aplica', '=', '1')->count();
        $conteoNoaplica = DeclaracionAplicabilidad::get()->where('aplica', '=', '2')->count();
        $gap182total = $gapa182->count();
        $A5 = $gapa5->where('aplica', '=', 1)->count();
        $A5No = $gapa5->where('aplica', '=', 2)->count();
        $A6 = $gapa6->where('aplica', '=', 1)->count() + $gapa62->where('aplica', '=', 1)->count();
        $A6No = $gapa6->where('aplica', '=', 2)->count() + $gapa62->where('aplica', '=', 2)->count();
        $A7 = $gapa71->where('aplica', '=', 1)->count() + $gapa72->where('aplica', '=', 1)->count() + $gapa73->where('aplica', '=', 1)->count();
        $A7No = $gapa71->where('aplica', '=', 2)->count() + $gapa72->where('aplica', '=', 2)->count() + $gapa73->where('aplica', '=', 2)->count();
        $A8 = $gapa81->where('aplica', '=', 1)->count() + $gapa82->where('aplica', '=', 1)->count() + $gapa83->where('aplica', '=', 1)->count();
        $A8No = $gapa81->where('aplica', '=', 2)->count() + $gapa82->where('aplica', '=', 2)->count() + $gapa83->where('aplica', '=', 2)->count();
        $A9 = $gapa91->where('aplica', '=', 1)->count() + $gapa92->where('aplica', '=', 1)->count() + $gapa93->where('aplica', '=', 1)->count() + $gapa94->where('aplica', '=', 1)->count();
        $A9No = $gapa91->where('aplica', '=', 2)->count() + $gapa92->where('aplica', '=', 2)->count() + $gapa93->where('aplica', '=', 2)->count() + $gapa94->where('aplica', '=', 2)->count();
        $A10 = $gapa101->where('aplica', '=', 1)->count();
        $A10No = $gapa101->where('aplica', '=', 2)->count();
        $A11 = $gapa111->where('aplica', '=', 1)->count() + $gapa112->where('aplica', '=', 1)->count();
        $A11No = $gapa111->where('aplica', '=', 2)->count() + $gapa112->where('aplica', '=', 2)->count();
        $A12 = $gapa121->where('aplica', '=', 1)->count() + $gapa122->where('aplica', '=', 1)->count() + $gapa123->where('aplica', '=', 1)->count() + $gapa124->where('aplica', '=', 1)->count() + $gapa125->where('aplica', '=', 1)->count() + $gapa126->where('aplica', '=', 1)->count() + $gapa127->where('aplica', '=', 1)->count();
        $A12No = $gapa121->where('aplica', '=', 1)->count() + $gapa122->where('aplica', '=', 2)->count() + $gapa123->where('aplica', '=', 2)->count() + $gapa124->where('aplica', '=', 2)->count() + $gapa125->where('aplica', '=', 2)->count() + $gapa126->where('aplica', '=', 2)->count() + $gapa127->where('aplica', '=', 2)->count();
        $A13 = $gapa131->where('aplica', '=', 1)->count() + $gapa132->where('aplica', '=', 1)->count();
        $A13No = $gapa131->where('aplica', '=', 2)->count() + $gapa132->where('aplica', '=', 2)->count();
        $A14 = $gapa141->where('aplica', '=', 1)->count() + $gapa142->where('aplica', '=', 1)->count() + $gapa143->where('aplica', '=', 1)->count();
        $A14No = $gapa141->where('aplica', '=', 2)->count() + $gapa142->where('aplica', '=', 2)->count() + $gapa143->where('aplica', '=', 2)->count();
        $A15 = $gapa151->where('aplica', '=', 1)->count() + $gapa152->where('aplica', '=', 1)->count();
        $A15No = $gapa151->where('aplica', '=', 2)->count() + $gapa152->where('aplica', '=', 2)->count();
        $A16 = $gapa161->where('aplica', '=', 1)->count();
        $A16No = $gapa161->where('aplica', '=', 2)->count();
        $A17 = $gapa171->where('aplica', '=', 1)->count() + $gapa172->where('aplica', '=', 1)->count();
        $A17No = $gapa171->where('aplica', '=', 2)->count() + $gapa172->where('aplica', '=', 2)->count();
        $A18 = $gapa181->where('aplica', '=', 1)->count() + $gapa182->where('aplica', '=', 1)->count();
        $A18No = $gapa181->where('aplica', '=', 2)->count() + $gapa182->where('aplica', '=', 2)->count();

        // dd("test".$A6No);

        // dd($gap5total);
        $ISO27001_SoA_PATH = 'storage/Normas/ISO27001/Analísis Inicial/';
        $path = public_path($ISO27001_SoA_PATH);
        $lista_archivos_declaracion = glob($path.'Analisis Inicial*.pdf');

        return view('frontend.declaracionaplicabilidad.index', compact('conteoAplica', 'conteoNoaplica', 'A5', 'A5No', 'A6', 'A6No', 'A7', 'A7No', 'A8', 'A8No', 'A9', 'A9No', 'A10', 'A10No', 'A11', 'A11No', 'A12', 'A12No', 'A13', 'A13No', 'A14', 'A14No', 'A15', 'A15No', 'A16', 'A16No', 'A17', 'A17No', 'A18', 'A18No'))
            ->with('gapda6s', $gapa6)->with('gapda5s', $gapa5)
            ->with('gapda62s', $gapa62)->with('gapda71s', $gapa71)->with('gapda72s', $gapa72)
            ->with('gapda73s', $gapa73)->with('gapda81s', $gapa81)->with('gapda82s', $gapa82)->with('gapda83s', $gapa83)
            ->with('gapda91s', $gapa91)->with('gapda92s', $gapa92)->with('gapda93s', $gapa93)->with('gapda94s', $gapa94)
            ->with('gapda101s', $gapa101)->with('gapda111s', $gapa111)->with('gapda112s', $gapa112)->with('gapda121s', $gapa121)
            ->with('gapda122s', $gapa122)->with('gapda123s', $gapa123)->with('gapda124s', $gapa124)->with('gapda125s', $gapa125)
            ->with('gapda126s', $gapa126)->with('gapda127s', $gapa127)->with('gapda131s', $gapa131)->with('gapda132s', $gapa132)
            ->with('gapda141s', $gapa141)->with('gapda142s', $gapa142)->with('gapda143s', $gapa143)->with('gapda151s', $gapa151)
            ->with('gapda152s', $gapa152)->with('gapda161s', $gapa161)->with('gapda171s', $gapa171)->with('gapda172s', $gapa172)
            ->with('gapda181s', $gapa181)->with('gapda182s', $gapa182)->with('lista_archivos_declaracion', $lista_archivos_declaracion)
            ->with('ISO27001_SoA_PATH', $ISO27001_SoA_PATH);
    }

    /**
     * Update the specified resource in storage.
     *
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

    public function download(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $gapda5s = DeclaracionAplicabilidad::get()->where('control-uno', '=', 'A5');
        $gapda6s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A6.1');
        $gapda62s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A6.2');
        $gapda71s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A7.1');
        $gapda72s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A7.2');
        $gapda73s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A7.3');
        $gapda81s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A8.1');
        $gapda82s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A8.2');
        $gapda83s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A8.3');
        $gapda91s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.1');
        $gapda92s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.2');
        $gapda93s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.3');
        $gapda94s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A9.4');
        $gapda101s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A10.1');
        $gapda111s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A11.1');
        $gapda112s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A11.2');
        $gapda121s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.1');
        $gapda122s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.2');
        $gapda123s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.3');
        $gapda124s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.4');
        $gapda125s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.5');
        $gapda126s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.6');
        $gapda127s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A12.7');
        $gapda131s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A13.1');
        $gapda132s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A13.2');
        $gapda141s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A14.1');
        $gapda142s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A14.2');
        $gapda143s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A14.3');
        $gapda151s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A15.1');
        $gapda152s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A15.2');
        $gapda161s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A16.1');
        $gapda171s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A17.1');
        $gapda172s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A17.2');
        $gapda181s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A18.1');
        $gapda182s = DeclaracionAplicabilidad::get()->where('control-dos', '=', 'A18.2');
        $logo = DB::table('organizacions')
            ->select('logotipo')
            ->first();
        $logotipo = '';
        if (isset($logo)) {
            if ($logo->logotipo != null) {
                $logotipo = 'images/'.$logo->logotipo;
            } else {
                $logotipo = 'img/Silent4Business-Logo-Color.png';
            }
        } else {
            $logotipo = 'img/Silent4Business-Logo-Color.png';
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('frontend.declaracionaplicabilidad.plantilla', compact(
            'gapda6s',
            'gapda5s',
            'gapda62s',
            'gapda71s',
            'gapda72s',
            'gapda73s',
            'gapda81s',
            'gapda82s',
            'gapda83s',
            'gapda91s',
            'gapda92s',
            'gapda93s',
            'gapda94s',
            'gapda101s',
            'gapda111s',
            'gapda112s',
            'gapda121s',
            'gapda122s',
            'gapda123s',
            'gapda124s',
            'gapda125s',
            'gapda126s',
            'gapda127s',
            'gapda131s',
            'gapda132s',
            'gapda141s',
            'gapda142s',
            'gapda143s',
            'gapda151s',
            'gapda152s',
            'gapda161s',
            'gapda171s',
            'gapda172s',
            'gapda181s',
            'gapda182s',
            'logotipo',
        ));

        $nombre_pdf = 'Analisis Inicial '.Carbon::now()->format('d-m-Y').'.pdf';
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/Normas/ISO27001/Analísis Inicial/'.$nombre_pdf, $content);
        //$pdf->download(storage_path('Normas/ISO27001/Analísis Inicial/' . $nombre_pdf));
        return $pdf->setPaper('a4', 'landscape')->stream();

        /*return view('admin.declaracionaplicabilidad.plantilla', compact(
            'gapda6s',
            'gapda5s',
            'gapda62s',
            'gapda71s',
            'gapda72s',
            'gapda73s',
            'gapda81s',
            'gapda82s',
            'gapda83s',
            'gapda91s',
            'gapda92s',
            'gapda93s',
            'gapda94s',
            'gapda101s',
            'gapda111s',
            'gapda112s',
            'gapda121s',
            'gapda122s',
            'gapda123s',
            'gapda124s',
            'gapda125s',
            'gapda126s',
            'gapda127s',
            'gapda131s',
            'gapda132s',
            'gapda141s',
            'gapda142s',
            'gapda143s',
            'gapda151s',
            'gapda152s',
            'gapda161s',
            'gapda171s',
            'gapda172s',
            'gapda181s',
            'gapda182s',
            'logotipo'
        ));*/
    }
}

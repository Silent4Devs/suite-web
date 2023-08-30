<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DeclaracionAplicabilidadAprobadores as MailDeclaracionAplicabilidadAprobadores;
use App\Mail\NotificacionDeclaracionAplicabilidadAprobadores;
use App\Mail\NotificacionDeclaracionAplicabilidadResponsables;
use App\Models\DeclaracionAplicabilidad;
use App\Models\DeclaracionAplicabilidadAprobadores;
use App\Models\DeclaracionAplicabilidadResponsable;
use App\Models\Empleado;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Throwable;

class DeclaracionAplicabilidadController extends Controller
{
    use ObtenerOrganizacion;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('declaracion_de_aplicabilidad_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $declaracion_aplicabilidad = DeclaracionAplicabilidad::getAllOrderByAsc();

        $gapa5 = $declaracion_aplicabilidad->where('control-uno', '=', 'A5');
        $gapa6 = $declaracion_aplicabilidad->where('control-dos', '=', 'A6.1');
        $gapa62 = $declaracion_aplicabilidad->where('control-dos', '=', 'A6.2');
        $gapa71 = $declaracion_aplicabilidad->where('control-dos', '=', 'A7.1');
        $gapa72 = $declaracion_aplicabilidad->where('control-dos', '=', 'A7.2');
        $gapa73 = $declaracion_aplicabilidad->where('control-dos', '=', 'A7.3');
        $gapa81 = $declaracion_aplicabilidad->where('control-dos', '=', 'A8.1');
        $gapa82 = $declaracion_aplicabilidad->where('control-dos', '=', 'A8.2');
        $gapa83 = $declaracion_aplicabilidad->where('control-dos', '=', 'A8.3');
        $gapa91 = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.1');
        $gapa92 = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.2');
        $gapa93 = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.3');
        $gapa94 = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.4');
        $gapa101 = $declaracion_aplicabilidad->where('control-dos', '=', 'A10.1');
        $gapa111 = $declaracion_aplicabilidad->where('control-dos', '=', 'A11.1');
        $gapa112 = $declaracion_aplicabilidad->where('control-dos', '=', 'A11.2');
        $gapa121 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.1');
        $gapa122 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.2');
        $gapa123 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.3');
        $gapa124 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.4');
        $gapa125 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.5');
        $gapa126 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.6');
        $gapa127 = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.7');
        $gapa131 = $declaracion_aplicabilidad->where('control-dos', '=', 'A13.1');
        $gapa132 = $declaracion_aplicabilidad->where('control-dos', '=', 'A13.2');
        $gapa141 = $declaracion_aplicabilidad->where('control-dos', '=', 'A14.1');
        $gapa142 = $declaracion_aplicabilidad->where('control-dos', '=', 'A14.2');
        $gapa143 = $declaracion_aplicabilidad->where('control-dos', '=', 'A14.3');
        $gapa151 = $declaracion_aplicabilidad->where('control-dos', '=', 'A15.1');
        $gapa152 = $declaracion_aplicabilidad->where('control-dos', '=', 'A15.2');
        $gapa161 = $declaracion_aplicabilidad->where('control-dos', '=', 'A16.1');
        $gapa171 = $declaracion_aplicabilidad->where('control-dos', '=', 'A17.1');
        $gapa172 = $declaracion_aplicabilidad->where('control-dos', '=', 'A17.2');
        $gapa181 = $declaracion_aplicabilidad->where('control-dos', '=', 'A18.1');
        $gapa182 = $declaracion_aplicabilidad->where('control-dos', '=', 'A18.2');

        $conteoAplica = $declaracion_aplicabilidad->where('aplica', '=', '1')->count();
        $conteoNoaplica = $declaracion_aplicabilidad->where('aplica', '=', '2')->count();
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
        $lista_archivos_declaracion = glob($path . 'Analisis Inicial*.pdf');
        $empleados = Empleado::select('id', 'name', 'genero', 'foto')->alta()->get();
        $responsables = DeclaracionAplicabilidadResponsable::with(['empleado' => function ($q) {
            $q->select('id', 'name', 'foto', 'estatus')->where('estatus', 'alta');
        }])->orderBy('id')->get();
        // dd($responsables);
        $aprobadores = DeclaracionAplicabilidadAprobadores::with(['empleado' => function ($q) {
            $q->select('id', 'name', 'foto', 'estatus')->where('estatus', 'alta');
        }])->get();

        // $empleados=Empleado::select('id','name','genero','foto')->get();
        // dd(DB::getQueryLog());
        // dd($lista_archivos_declaracion);

        return view('admin.declaracionaplicabilidad.index', compact('conteoAplica', 'conteoNoaplica', 'A5', 'A5No', 'A6', 'A6No', 'A7', 'A7No', 'A8', 'A8No', 'A9', 'A9No', 'A10', 'A10No', 'A11', 'A11No', 'A12', 'A12No', 'A13', 'A13No', 'A14', 'A14No', 'A15', 'A15No', 'A16', 'A16No', 'A17', 'A17No', 'A18', 'A18No'))
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
            ->with('ISO27001_SoA_PATH', $ISO27001_SoA_PATH)
            ->with('aprobadores', $aprobadores)
            ->with('responsables', $responsables);
    }

    public function tabla(Request $request)
    {
        if ($request->ajax()) {
            $controles = DeclaracionAplicabilidad::getAll();

            return datatables()->of($controles)->toJson();
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.declaracionaplicabilidad.tabla', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function edit(Request $request, $control)
    {
        $control = DeclaracionAplicabilidad::find($control);

        return view('admin.declaracionaplicabilidad.tabla-edit', compact('control'));
    }

    public function updateTabla(Request $request, $control)
    {
        $request->validate([
            'anexo_politica' => 'required',
            'anexo_descripcion' => 'required',
        ]);

        $control = DeclaracionAplicabilidad::find($control);
        $control->update([
            'anexo_politica' => $request->anexo_politica,
            'anexo_descripcion' => $request->anexo_descripcion,
        ]);

        return redirect()->route('admin.declaracion-aplicabilidad.tabla')->with('success', 'Declaración de aplicabilidad actualizada con éxito');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\DeclaracionAplicabilidad  $declaracionAplicabilidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        if ($request->ajax()) {
            switch ($request->name) {
                case 'justificacion':

                    $gapun = DeclaracionAplicabilidadResponsable::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['justificacion' => $request->value]);
                    $control = DeclaracionAplicabilidadResponsable::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->first();
                    $aplicabilidad = DeclaracionAplicabilidad::find($control->declaracion_id);
                    if ($control->aplica != null) {
                        $aprobadorDeclaracion = DeclaracionAplicabilidadAprobadores::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $aprobador = Empleado::select('id', 'name', 'email')->find($aprobadorDeclaracion->aprobadores_id);
                        $responsable = Empleado::select('id', 'name', 'email')->find($control->empleado_id);
                        Mail::to(removeUnicodeCharacters($aprobador->email))->send(new NotificacionDeclaracionAplicabilidadAprobadores($aprobador, $responsable, $aplicabilidad));
                    }

                    return response()->json(['success' => true, 'id' => $id]);

                    break;
                case 'aplica':

                    $gapun = DeclaracionAplicabilidadResponsable::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['aplica' => $request->value]);
                    $control = DeclaracionAplicabilidadResponsable::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->first();

                    $aplicabilidad = DeclaracionAplicabilidad::find($control->declaracion_id);
                    if ($control->justificacion != null) {
                        $aprobadorDeclaracion = DeclaracionAplicabilidadAprobadores::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $aprobador = Empleado::select('id', 'name', 'email')->find($aprobadorDeclaracion->aprobadores_id);
                        $responsable = Empleado::select('id', 'name', 'email')->find($control->empleado_id);
                        Mail::to(removeUnicodeCharacters($aprobador->email))->send(new NotificacionDeclaracionAplicabilidadAprobadores($aprobador, $responsable, $aplicabilidad));
                    }

                    return response()->json(['success' => true, 'id' => $id]);

                    break;
                case 'aplica2':
                    try {
                        $gapun = DeclaracionAplicabilidadResponsable::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['aplica' => $request->value]);
                        // $gapun->aplica = $request->value;
                        return response()->json(['success' => true, 'id' => $id]);
                    } catch (Throwable $e) {
                        return response()->json(['success' => false]);
                    }

                    break;
                case 'estatus':

                    $gapun = DeclaracionAplicabilidadAprobadores::where('declaracion_id', '=', $id)->where('aprobadores_id', auth()->user()->empleado->id)->update(['estatus' => $request->value]);
                    $control = DeclaracionAplicabilidadAprobadores::where('declaracion_id', '=', $id)->where('aprobadores_id', auth()->user()->empleado->id)->first();

                    $aplicabilidad = DeclaracionAplicabilidad::find($control->declaracion_id);
                    if ($control->comentarios != null) {
                        $responsableDeclaracion = DeclaracionAplicabilidadResponsable::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $responsable = Empleado::select('id', 'name', 'email')->find($responsableDeclaracion->empleado_id);
                        $aprobador = Empleado::select('id', 'name', 'email')->find($control->aprobadores_id);
                        Mail::to(removeUnicodeCharacters($responsable->email))->send(new NotificacionDeclaracionAplicabilidadResponsables($aprobador, $responsable, $aplicabilidad, $control));
                    }

                    return response()->json(['success' => true, 'id' => $id, 'value' => $request->value, 'fecha' => Carbon::parse($control->updated_at)->format('d-m-Y')]);

                    break;

                case 'comentarios':
                    $gapun = DeclaracionAplicabilidadAprobadores::where('declaracion_id', '=', $id)->where('aprobadores_id', auth()->user()->empleado->id)->update(['comentarios' => $request->value]);

                    // $gapun->comentarios = $request->value;
                    $control = DeclaracionAplicabilidadAprobadores::where('declaracion_id', '=', $id)->where('aprobadores_id', auth()->user()->empleado->id)->first();

                    $aplicabilidad = DeclaracionAplicabilidad::find($control->declaracion_id);
                    if ($control->estatus != null) {
                        $responsableDeclaracion = DeclaracionAplicabilidadResponsable::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $responsable = Empleado::select('id', 'name', 'email')->find($responsableDeclaracion->empleado_id);
                        $aprobador = Empleado::select('id', 'name', 'email')->find($control->aprobadores_id);
                        Mail::to(removeUnicodeCharacters($responsable->email))->send(new NotificacionDeclaracionAplicabilidadResponsables($aprobador, $responsable, $aplicabilidad, $control));
                    }

                    return response()->json(['success' => true, 'id' => $id]);

                    break;

                case 'fecha_aprobacion':
                    try {
                        $gapun = DeclaracionAplicabilidadAprobadores::where('declaracion_id', '=', $id)->where('aprobadores_id', auth()->user()->empleado->id)->update(['fecha_aprobacion' => $request->value]);
                        $gapun->fecha_aprobacion = $request->value;

                        return response()->json(['success' => true, 'id' => $id]);
                    } catch (Throwable $e) {
                        return response()->json(['success' => false]);
                    }
                    break;

                case 'aprobadores_id':
                    $gapun = DeclaracionAplicabilidadAprobadores::findOrFail($id);
                    $gapun->aprobadores_id = $request->value;

                    return response()->json(['success' => true]);
                    break;

                case 'empleado_id':
                    $gapun = DeclaracionAplicabilidadResponsable::findOrFail($id);
                    $gapun->empleado_id = $request->value;

                    return response()->json(['success' => true]);
                    break;
            }
        }
    }

    public function download(DeclaracionAplicabilidad $declaracionAplicabilidad)
    {
        $declaracion_aplicabilidad = DeclaracionAplicabilidad::getAll();

        $gapda5s = $declaracion_aplicabilidad->where('control-uno', '=', 'A5');
        $gapda6s = $declaracion_aplicabilidad->where('control-dos', '=', 'A6.1');
        $gapda62s = $declaracion_aplicabilidad->where('control-dos', '=', 'A6.2');
        $gapda71s = $declaracion_aplicabilidad->where('control-dos', '=', 'A7.1');
        $gapda72s = $declaracion_aplicabilidad->where('control-dos', '=', 'A7.2');
        $gapda73s = $declaracion_aplicabilidad->where('control-dos', '=', 'A7.3');
        $gapda81s = $declaracion_aplicabilidad->where('control-dos', '=', 'A8.1');
        $gapda82s = $declaracion_aplicabilidad->where('control-dos', '=', 'A8.2');
        $gapda83s = $declaracion_aplicabilidad->where('control-dos', '=', 'A8.3');
        $gapda91s = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.1');
        $gapda92s = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.2');
        $gapda93s = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.3');
        $gapda94s = $declaracion_aplicabilidad->where('control-dos', '=', 'A9.4');
        $gapda101s = $declaracion_aplicabilidad->where('control-dos', '=', 'A10.1');
        $gapda111s = $declaracion_aplicabilidad->where('control-dos', '=', 'A11.1');
        $gapda112s = $declaracion_aplicabilidad->where('control-dos', '=', 'A11.2');
        $gapda121s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.1');
        $gapda122s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.2');
        $gapda123s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.3');
        $gapda124s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.4');
        $gapda125s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.5');
        $gapda126s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.6');
        $gapda127s = $declaracion_aplicabilidad->where('control-dos', '=', 'A12.7');
        $gapda131s = $declaracion_aplicabilidad->where('control-dos', '=', 'A13.1');
        $gapda132s = $declaracion_aplicabilidad->where('control-dos', '=', 'A13.2');
        $gapda141s = $declaracion_aplicabilidad->where('control-dos', '=', 'A14.1');
        $gapda142s = $declaracion_aplicabilidad->where('control-dos', '=', 'A14.2');
        $gapda143s = $declaracion_aplicabilidad->where('control-dos', '=', 'A14.3');
        $gapda151s = $declaracion_aplicabilidad->where('control-dos', '=', 'A15.1');
        $gapda152s = $declaracion_aplicabilidad->where('control-dos', '=', 'A15.2');
        $gapda161s = $declaracion_aplicabilidad->where('control-dos', '=', 'A16.1');
        $gapda171s = $declaracion_aplicabilidad->where('control-dos', '=', 'A17.1');
        $gapda172s = $declaracion_aplicabilidad->where('control-dos', '=', 'A17.2');
        $gapda181s = $declaracion_aplicabilidad->where('control-dos', '=', 'A18.1');
        $gapda182s = $declaracion_aplicabilidad->where('control-dos', '=', 'A18.2');
        $logo = DB::table('organizacions')
            ->select('logotipo')
            ->first();
        $logotipo = '';
        if (isset($logo)) {
            if ($logo->logotipo != null) {
                $logotipo = 'images/' . $logo->logotipo;
            } else {
                $logotipo = 'img/Silent4Business-Logo-Color.png';
            }
        } else {
            $logotipo = 'img/Silent4Business-Logo-Color.png';
        }

        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('admin.declaracionaplicabilidad.plantilla', compact(
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

        $nombre_pdf = 'Analisis Inicial ' . Carbon::now()->format('d-m-Y') . '.pdf';
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/Normas/ISO27001/Analísis Inicial/' . $nombre_pdf, $content);
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

    public function enviarCorreo(Request $request)
    {
        if ($request->enviarTodos) {
            $destinatarios = DeclaracionAplicabilidadAprobadores::distinct('aprobadores_id')->pluck('aprobadores_id')->toArray();
        } elseif ($request->enviarNoNotificados) {
            $destinatarios = DeclaracionAplicabilidadAprobadores::where('notificado', false)->distinct('aprobadores_id')->pluck('aprobadores_id')->toArray();
        } else {
            $destinatarios = json_decode($request->aprobadores);
        }
        // dd($destinatarios);
        $tipo = $request->tipo;
        foreach ($destinatarios as $destinatario) {
            //TODO:FALTA ENVIAR CONTROLES A MailDeclaracionAplicabilidad
            $empleado = Empleado::select('id', 'name', 'email')->find(intval($destinatario));
            Mail::to(removeUnicodeCharacters($empleado->email))->send(new MailDeclaracionAplicabilidadAprobadores($empleado->name, $tipo, []));
            $responsable = DeclaracionAplicabilidadAprobadores::where('empleado_id', $destinatario)->each(function ($item) {
                $item->notificado = true;
            });
        }

        return response()->json(['message' => 'Correo enviado'], 200);
    }
}

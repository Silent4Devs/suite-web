<?php

namespace App\Http\Controllers\Admin\iso27;

use App\Functions\PorcentajeDecApl2022;
use App\Http\Controllers\Controller;
use App\Mail\NotificacionDeclaracionAplicabilidadAprobadores2022;
use App\Mail\NotificacionDeclaracionAplicabilidadResponsables2022;
use App\Models\Empleado;
use App\Models\Iso27\DeclaracionAplicabilidadAprobarIso;
use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use App\Models\Iso27\DeclaracionAplicabilidadResponsableIso;
use App\Models\Iso27\GapDosCatalogoIso;
use App\Traits\ObtenerOrganizacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class DeclaracionAplicabilidadConcentradoIsoController extends Controller
{
    use ObtenerOrganizacion;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        abort_if(Gate::denies('declaracion_de_aplicabilidad_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gapa5 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')
            ->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', '5.' . '%');
            })->orderBy('id', 'ASC')->get();

        $gapa6 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', '6.' . '%');
            })->orderBy('id', 'ASC')->get();

        $gapa7 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', '7.' . '%');
            })->orderBy('id', 'ASC')->get();

        $gapa8 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', '8.' . '%');
            })->orderBy('id', 'ASC')->get();

        $responsables = DeclaracionAplicabilidadResponsableIso::with(['empleado' => function ($q) {
            $q->select('id', 'name', 'foto', 'estatus')->where('estatus', 'alta');
        }])->orderBy('id')->get();
        // dd($responsables);
        $aprobadores = DeclaracionAplicabilidadAprobarIso::with(['empleado' => function ($q) {
            $q->select('id', 'name', 'foto', 'estatus')->where('estatus', 'alta');
        }])->orderBy('id')->get();
        // dd($responsables, $aprobadores);
        $ISO27001_2022_SoA_PATH = 'storage/Normas/ISO27001-2022/Analísis Inicial/';
        $path = public_path($ISO27001_2022_SoA_PATH);
        $lista_archivos_declaracion = glob($path . 'Analisis Inicial-2022*.pdf');

        return view('admin.declaracionaplicabilidad2022.index')
            ->with('gapda6s', $gapa6)->with('gapda5s', $gapa5)
            ->with('gapda7s', $gapa7)->with('gapda8s', $gapa8)
            ->with('lista_archivos_declaracion', $lista_archivos_declaracion)
            ->with('ISO27001_2022_SoA_PATH', $ISO27001_2022_SoA_PATH)
            ->with('aprobadores', $aprobadores)
            ->with('responsables', $responsables);
    }

    public function dashboard()
    {
        $totalconteo = GapDosCatalogoIso::get()->count();
        $conteoAplica = DeclaracionAplicabilidadResponsableIso::where('aplica', '=', '1')->get()->count();
        $conteoNoaplica = DeclaracionAplicabilidadResponsableIso::where('aplica', '=', '2')->get()->count();

        // dd($conteoAplica, $conteoNoaplica);

        $conteoAprobado = DeclaracionAplicabilidadResponsableIso::with('aprobador')->whereHas('aprobador', function ($query) {
            return $query->where('estatus', '2');
        })->orderBy('id')->get()->count();

        $conteoNoaprobado = DeclaracionAplicabilidadResponsableIso::with('aprobador')->whereHas('aprobador', function ($query) {
            return $query->where('estatus', '3');
        })->orderBy('id')->get()->count();

        // dd($conteoAprobado, $conteoNoaprobado);

        $gap5 = DeclaracionAplicabilidadResponsableIso::with('gapdos')->whereHas('gapdos', function ($query) {
            return $query->where('control_iso', 'LIKE', '5.' . '%');
        })->get();
        $gap6 = DeclaracionAplicabilidadResponsableIso::with('gapdos')->whereHas('gapdos', function ($query) {
            return $query->where('control_iso', 'LIKE', '6.' . '%');
        })->get();
        $gap7 = DeclaracionAplicabilidadResponsableIso::with('gapdos')->whereHas('gapdos', function ($query) {
            return $query->where('control_iso', 'LIKE', '7.' . '%');
        })->get();
        $gap8 = DeclaracionAplicabilidadResponsableIso::with('gapdos')->whereHas('gapdos', function ($query) {
            return $query->where('control_iso', 'LIKE', '8.' . '%');
        })->get();

        // dd($gap5, $gap6, $gap7, $gap8);

        // $gap182total = $gapa182->count();
        $A5 = $gap5->where('aplica', '=', 1)->count();
        $A5No = $gap5->where('aplica', '=', 2)->count();
        $A6 = $gap6->where('aplica', '=', 1)->count();
        $A6No = $gap6->where('aplica', '=', 2)->count();
        $A7 = $gap7->where('aplica', '=', 1)->count();
        $A7No = $gap7->where('aplica', '=', 2)->count();
        $A8 = $gap8->where('aplica', '=', 1)->count();
        $A8No = $gap8->where('aplica', '=', 2)->count();

        // dd($A5, $A5No, $A6, $A6No, $A7, $A7No, $A8, $A8No);
        // dd($gapa5, $gapa6, $gapa7, $gapa8);
        $total = 93 - $conteoNoaplica;
        $Porc = new PorcentajeDecApl2022();

        $porcentajeDecApl = $Porc->GapDecAplPorc($total, $conteoAprobado);

        // dd($porcentajeDecApl['porcentaje'], $porcentajeDecApl['faltante']);

        return view('admin.declaracionaplicabilidad2022.declaracion-dashboard', compact(
            'conteoAplica',
            'conteoNoaplica',
            'totalconteo',
            'A5',
            'A5No',
            'A6',
            'A6No',
            'A7',
            'A7No',
            'A8',
            'A8No'
        ))
            ->with('total', $total)
            ->with('porcentaje', $porcentajeDecApl['porcentaje'])
            ->with('faltante', $porcentajeDecApl['faltante']);
    }

    public function tabla(Request $request)
    {
        // dd("Llega a la tabla");
        if ($request->ajax()) {
            $controles = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
                ->orderBy('id')->get();

            return datatables()->of($controles)->toJson();
        }

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.declaracionaplicabilidad2022.tabla', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function updateTabla(Request $request, $control)
    {
        $request->validate([
            'anexo_politica' => 'required',
            'anexo_descripcion' => 'required',
        ]);

        $control = GapDosCatalogoIso::find($control);
        $control->update([
            'anexo_politica' => $request->anexo_politica,
            'anexo_descripcion' => $request->anexo_descripcion,
        ]);

        return redirect()->route('admin.declaracion-aplicabilidad-2022.tabla')->with('success', 'Declaración de aplicabilidad actualizada con éxito');
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
            switch ($request->name) {
                case 'justificacion':
                    // dd('Si esta llegando aqui al update del controller', $request, $id);
                    $gapun = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['justificacion' => $request->value]);
                    $control = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->first();
                    $aplicabilidad = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->find($control->declaracion_id);
                    if ($control->aplica != null) {
                        $aprobadorDeclaracion = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $aprobador = Empleado::select('id', 'name', 'email')->find($aprobadorDeclaracion->empleado_id);
                        $responsable = Empleado::select('id', 'name', 'email')->find($control->empleado_id);
                        Mail::to(removeUnicodeCharacters($aprobador->email))->send(new NotificacionDeclaracionAplicabilidadAprobadores2022($aprobador, $responsable, $aplicabilidad));
                    }

                    return response()->json(['success' => true, 'id' => $id]);

                    break;
                case 'aplica':

                    $gapun = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['aplica' => $request->value]);
                    $control = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->first();

                    $aplicabilidad = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->find($control->declaracion_id);
                    if ($control->justificacion != null) {
                        $aprobadorDeclaracion = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $aprobador = Empleado::select('id', 'name', 'email')->find($aprobadorDeclaracion->empleado_id);
                        $responsable = Empleado::select('id', 'name', 'email')->find($control->empleado_id);
                        Mail::to(removeUnicodeCharacters($aprobador->email))->send(new NotificacionDeclaracionAplicabilidadAprobadores2022($aprobador, $responsable, $aplicabilidad));
                    }

                    return response()->json(['success' => true, 'id' => $id]);

                    break;
                case 'aplica2':
                    try {
                        $gapun = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['aplica' => $request->value]);
                        // $gapun->aplica = $request->value;
                        return response()->json(['success' => true, 'id' => $id]);
                    } catch (Throwable $e) {
                        return response()->json(['success' => false]);
                    }

                    break;
                case 'estatus':

                    $fecha_aprob = Carbon::today();
                    $gapun = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['estatus' => $request->value, 'fecha_aprobacion' => $fecha_aprob]);
                    $control = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->first();

                    $aplicabilidad = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->find($control->declaracion_id);

                    if ($control->comentarios != null) {
                        $responsableDeclaracion = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $responsable = Empleado::select('id', 'name', 'email')->find($responsableDeclaracion->empleado_id);
                        $aprobador = Empleado::select('id', 'name', 'email')->find($control->empleado_id);
                        Mail::to(removeUnicodeCharacters($responsable->email))->send(new NotificacionDeclaracionAplicabilidadResponsables2022($aprobador, $responsable, $aplicabilidad, $control));
                    }

                    return response()->json(['success' => true, 'id' => $id, 'value' => $request->value, 'fecha' => Carbon::parse($control->updated_at)->format('d-m-Y')]);

                    break;

                case 'comentarios':
                    $gapun = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['comentarios' => $request->value]);

                    // $gapun->comentarios = $request->value;
                    $control = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->first();

                    $aplicabilidad = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->find($control->declaracion_id);
                    if ($control->estatus != null) {
                        $responsableDeclaracion = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $id)->orderBy('created_at')->first();
                        $responsable = Empleado::select('id', 'name', 'email')->find($responsableDeclaracion->empleado_id);
                        $aprobador = Empleado::select('id', 'name', 'email')->find($control->empleado_id);
                        Mail::to(removeUnicodeCharacters($responsable->email))->send(new NotificacionDeclaracionAplicabilidadResponsables2022($aprobador, $responsable, $aplicabilidad, $control));
                    }

                    return response()->json(['success' => true, 'id' => $id]);

                    break;

                case 'fecha_aprobacion':
                    try {
                        $gapun = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', '=', $id)->where('empleado_id', auth()->user()->empleado->id)->update(['fecha_aprobacion' => $request->value]);
                        $gapun->fecha_aprobacion = $request->value;

                        return response()->json(['success' => true, 'id' => $id]);
                    } catch (Throwable $e) {
                        return response()->json(['success' => false]);
                    }
                    break;

                case 'empleado_id':
                    $gapun = DeclaracionAplicabilidadAprobarIso::findOrFail($id);
                    $gapun->empleado_id = $request->value;

                    return response()->json(['success' => true]);
                    break;

                case 'empleado_id':
                    $gapun = DeclaracionAplicabilidadResponsableIso::findOrFail($id);
                    $gapun->empleado_id = $request->value;

                    return response()->json(['success' => true]);
                    break;
            }
        }
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
    public function edit(Request $request, $control)
    {
        $control = GapDosCatalogoIso::with('clasificacion')->find($control);
        // dd($control);

        return view('admin.declaracionaplicabilidad2022.tabla-edit', compact('control'));
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

    public function download(DeclaracionAplicabilidadConcentradoIso $declaracionAplicabilidad)
    {
        $gapa5 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')
            ->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', 'A.5.' . '%');
            })
            ->with('responsables2022')
            ->orderBy('id', 'ASC')->get();

        $gapa6 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', 'A.6.' . '%');
            })
            ->with('responsables2022')
            ->orderBy('id', 'ASC')->get();

        $gapa7 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', 'A.7.' . '%');
            })
            ->with('responsables2022')
            ->orderBy('id', 'ASC')->get();

        $gapa8 = DeclaracionAplicabilidadConcentradoIso::with('gapdos')->with('gapdos.clasificacion')
            ->whereHas('gapdos', function ($query) {
                return $query->where('control_iso', 'LIKE', 'A.8.' . '%');
            })
            ->with('responsables2022')
            ->orderBy('id', 'ASC')->get();

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
        $pdf->loadView('admin.declaracionaplicabilidad2022.plantilla', compact(
            'gapa5',
            'gapa6',
            'gapa7',
            'gapa8',
            'logotipo',
        ));

        $nombre_pdf = 'Analisis Inicial-2022 ' . Carbon::now()->format('d-m-Y') . '.pdf';
        $content = $pdf->download()->getOriginalContent();
        Storage::put('public/Normas/ISO27001-2022/Analísis Inicial/' . $nombre_pdf, $content);
        //$pdf->download(storage_path('Normas/ISO27001/Analísis Inicial/' . $nombre_pdf));
        return $pdf->setPaper('a4', 'landscape')->stream();
    }

    public function enviarCorreo(Request $request)
    {
        if ($request->enviarTodos) {
            $destinatarios = DeclaracionAplicabilidadAprobarIso::distinct('aprobadores_id')->pluck('aprobadores_id')->toArray();
        } elseif ($request->enviarNoNotificados) {
            $destinatarios = DeclaracionAplicabilidadAprobarIso::where('notificado', false)->distinct('aprobadores_id')->pluck('aprobadores_id')->toArray();
        } else {
            $destinatarios = json_decode($request->aprobadores);
        }
        // dd($destinatarios);
        $tipo = $request->tipo;
        foreach ($destinatarios as $destinatario) {
            //TODO:FALTA ENVIAR CONTROLES A MailDeclaracionAplicabilidad
            $empleado = Empleado::select('id', 'name', 'email')->find(intval($destinatario));
            Mail::to(removeUnicodeCharacters($empleado->email))->send(new MailDeclaracionAplicabilidadAprobadores($empleado->name, $tipo, []));
            $responsable = DeclaracionAplicabilidadAprobarIso::where('empleado_id', $destinatario)->each(function ($item) {
                $item->notificado = true;
            });
        }

        return response()->json(['message' => 'Correo enviado'], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DeclaracionAplicabilidadIso;
use App\Models\Empleado;
use App\Models\Iso27\DeclaracionAplicabilidadAprobarIso;
use App\Models\Iso27\DeclaracionAplicabilidadConcentradoIso;
use App\Models\Iso27\DeclaracionAplicabilidadResponsableIso;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PanelDeclaracionIsoController extends Controller
{
    //
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        $asignados = DeclaracionAplicabilidadConcentradoIso::select(
            'id',
            'id_gap_dos_catalogo',
        )->with('gapdos')
            ->with('gapdos.clasificacion')
            ->with(['responsables2022.responsable_declaracion' => function ($q) {
                $q->select('empleados.id', 'empleados.name', 'foto');
            }])
            ->with('responsables2022.empleado')
            ->with(['aprobadores2022.aprobador_declaracion' => function ($q) {
                $q->select('empleados.id', 'empleados.name', 'foto');
            }])
            ->with('aprobadores2022.empleado')
            ->orderBy('id')->get();

        return view('admin.panelDeclaracion2022.index', compact('empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual', 'asignados'));
    }

    public function controles()
    {
        $query = DeclaracionAplicabilidadConcentradoIso::select(
            'id',
            'id_gap_dos_catalogo',
        )->with('gapdos')
            ->with('gapdos.clasificacion')
            ->with(['responsables2022.responsable_declaracion' => function ($q) {
                $q->select('empleados.id', 'empleados.name', 'foto');
            }])
            ->with(['aprobadores2022.aprobador_declaracion' => function ($q) {
                $q->select('empleados.id', 'empleados.name', 'foto');
            }])
            ->orderBy('id')->get();

        return datatables()->of($query)->toJson();
    }

    public function create()
    {
        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();
        // $controles = DeclaracionAplicabilidadConcentradoIso::OrderBy('id')->get();

        return view('admin.panelDeclaracion2022.create', compact('empleados', 'controles'));
    }

    public function store(Request $request, $id)
    {
        $declaracion = DeclaracionAplicabilidadConcentradoIso::find($id);
        //guarda lo que viene en el request
        $responsables = $request->responsables;
        //sincroniza mi declaracion con lo que le voy a poner
        $declaracion->responsables()->sync($responsables);

        $aprobadores = $request->aprobadores;
        $declaracion->aprobadores()->sync($aprobadores);
        // }

        return redirect()->route('admin.panelDeclaracion-2022.index');
    }

    public function show(DeclaracionAplicabilidadConcentradoIso $controles)
    {
        //
    }

    public function edit($id)
    {
        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();
        // $controles = DeclaracionAplicabilidadConcentradoIso::get();

        return view('admin.panelDeclaracion2022.edit', compact('empleados', 'controles'));
    }

    public function update(Request $request, $id)
    {
        $declaracion = DeclaracionAplicabilidadConcentradoIso::find($id);

        $responsables = $request->responsables;
        $declaracion->responsables()->sync($responsables);
        $declaracion->responsables()->sync($responsables);

        $aprobadores = $request->aprobadores;
        $declaracion->aprobadores()->sync($aprobadores);

        return redirect()->route('admin.panelDeclaracion-2022.index')->with('success', 'Editado con éxito');
    }

    //Ruta donde vamos a guardar el responsable a traves del script
    public function relacionarResponsable(Request $request)
    {
        $declaracion = $request->declaracion;
        $responsable = $request->responsable;
        $existResponsable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->exists();

        $isReasignable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->whereNull('empleado_id')->exists();
        $readyExistResponsable = DeclaracionAplicabilidadAprobarIso::select('declaracion_id')
            ->where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
        if ($readyExistResponsable) {
            return response()->json(['estatus' => 'ya_es_aprobador', 'message' => 'Ya fue asignado como aprobador'], 200);
        } else {
            if (! $existResponsable) {
                $exists = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
                if (! $exists) {
                    DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)
                        ->update([
                            'declaracion_id' => $declaracion,
                            'empleado_id' => $responsable,
                        ], [
                            'esta_correo_enviado' => false,

                        ]);

                    return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
                } else {
                    return response()->json(['estatus' => 'ya_asignado', 'message' => 'Este responsable ya ha sido asignado'], 200);
                }
            } else {
                if ($isReasignable) {
                    DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->update(['empleado_id' => $responsable,  'esta_correo_enviado' => false]);

                    return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
                } else {
                    return response()->json(['estatus' => 'limite_alcanzado', 'message' => 'Limite de responsables alcanzado'], 200);
                }
            }
        }
    }

    //QUITAR EL RESPONSABLE
    public function quitarRelacionResponsable(Request $request)
    {
        $declaracion = $request->declaracion;
        $responsable = $request->responsable;
        $registro = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable);

        $exists = $registro->exists();
        if ($exists) {
            $registro = DeclaracionAplicabilidadResponsableIso::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->update(['empleado_id' => null, 'esta_correo_enviado' => true]);

            return response()->json(['message' => 'Responsable desasignado', 'request' => $request->all()], 200);
        }
    }

    //Ruta donde vamos a guardar el aprobador a traves del script
    public function relacionarAprobador(Request $request)
    {
        $declaracion = $request->declaracion;
        $aprobador = $request->aprobador;
        $existAprobador = DeclaracionAplicabilidadAprobarIso::select('declaracion_id')->where('declaracion_id', $declaracion)->exists();
        $readyExistResponsable = DeclaracionAplicabilidadResponsableIso::select('declaracion_id')->where('declaracion_id', $declaracion)->where('empleado_id', $aprobador)->exists();
        if ($readyExistResponsable) {
            return response()->json(['estatus' => 'ya_es_responsable', 'message' => 'Ya fue asignado como responsable'], 200);
        } else {
            if ($existAprobador) {
                $exists = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracion)->where('empleado_id', $aprobador)->exists();
                if (! $exists) {
                    DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracion)
                        ->update(
                            [
                                'declaracion_id' => $declaracion,
                                'empleado_id' => $aprobador,
                            ],
                            [
                                'esta_correo_enviado' => false,
                            ]);

                    return response()->json(['estatus' => 'asignado', 'message' => 'Aprobador asignado'], 200);
                } else {
                    return response()->json(['estatus' => 'ya_asignado', 'message' => 'Este aprobador ya ha sido asignado'], 200);
                }
            } else {
                return response()->json(['estatus' => 'limite_alcanzado', 'message' => 'Limite de responsables alcanzado'], 200);
            }
        }
    }

    //QUITAR EL APROBADOR
    public function quitarRelacionAprobador(Request $request)
    {
        $declaracion = $request->declaracion;
        $aprobador = $request->aprobador;
        $registro = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracion)->where('empleado_id', $aprobador);
        $exists = $registro->exists();
        if ($exists) {
            $registro = DeclaracionAplicabilidadAprobarIso::where('declaracion_id', $declaracion)->where('empleado_id', $aprobador)->update(['empleado_id' => null, 'esta_correo_enviado' => true]);

            return response()->json(['message' => 'Aprobador desasignado'], 200);
        } else {
            return response()->json(['message' => 'Este aprobador no ha sido asignado'], 200);
        }
    }

    //Enviar Correo

    public function enviarCorreo(Request $request)
    {
        if ($request->enviarTodos) {
            $destinatarios = DeclaracionAplicabilidadResponsableIso::distinct('empleado_id')->pluck('empleado_id')->toArray();
        } elseif ($request->enviarNoNotificados) {
            $destinatarios = DeclaracionAplicabilidadResponsableIso::where('esta_correo_enviado', false)->distinct('empleado_id')->pluck('empleado_id')->toArray();
        } else {
            $destinatarios = json_decode($request->responsables);
        }
        $tipo = $request->tipo;
        $declaracion = $request->declaracion;

        foreach ($destinatarios as $destinatario) {
            $empleado = Empleado::alta()->select('id', 'name', 'email')->find(intval($destinatario));
            $responsable = DeclaracionAplicabilidadResponsableIso::with('declaracion_aplicabilidad', 'gapdos')->where('empleado_id', $destinatario)->get();
            $controles_name = collect();
            foreach ($responsable as $control) {
                $controles_name->push($control->gapdos);
            }

            Mail::to($empleado->email)->send(new DeclaracionAplicabilidadIso($empleado->name, $tipo, $controles_name));
            $responsable = DeclaracionAplicabilidadResponsableIso::where('empleado_id', $destinatario)->first();
            $responsable->update(['esta_correo_enviado' => true]);
        }

        return response()->json(['message' => 'Correo enviado'], 200);
    }
}

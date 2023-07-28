<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DeclaracionAplicabilidad as MailDeclaracionAplicabilidad;
use App\Models\DeclaracionAplicabilidad;
use App\Models\DeclaracionAplicabilidadAprobadores;
use App\Models\DeclaracionAplicabilidadResponsable;
use App\Models\Empleado;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PanelDeclaracionController extends Controller
{
    use ObtenerOrganizacion;

    public function index(Request $request)
    {
        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();
        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.panelDeclaracion.index', compact('empleados', 'organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    public function controles()
    {
        $query = DeclaracionAplicabilidad::select(
            'id',
            'control-uno',
            'control-dos',
            'anexo_politica',
            'anexo_indice',
        )->with(['responsables' => function ($q) {
            $q->select('empleados.id', 'empleados.name', 'foto');
        }, 'aprobadores' => function ($q) {
            $q->select('empleados.id', 'empleados.name', 'foto');
        }])->orderBy('id')->get();

        return datatables()->of($query)->toJson();
    }

    public function create()
    {
        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();
        $controles = DeclaracionAplicabilidad::getAll();

        return view('admin.panelDeclaracion.create', compact('empleados', 'controles'));
    }

    public function store(Request $request, $id)
    {
        //cuando mandamos muchos datos es necesario el foreach
        // foreach($request->controles as $control){
        // $declaracion =DeclaracionAplicabilidad::find($id);

        $declaracion = DeclaracionAplicabilidad::find($id);
        //guarda lo que viene en el request
        $responsables = $request->responsables;
        //sincroniza mi declaracion con lo que le voy a poner
        $declaracion->responsables()->sync($responsables);

        $aprobadores = $request->aprobadores;
        $declaracion->aprobadores()->sync($aprobadores);
        // }

        return redirect()->route('admin.panelDeclaracion.index');
    }

    public function show(DeclaracionAplicabilidad $controles)
    {
        //
    }

    public function edit($id)
    {
        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();
        $controles = DeclaracionAplicabilidad::getAll();

        return view('admin.panelDeclaracion.edit', compact('empleados', 'controles'));
    }

    public function update(Request $request, $id)
    {
        $declaracion = DeclaracionAplicabilidad::find($id);

        $responsables = $request->responsables;
        $declaracion->responsables()->sync($responsables);
        $declaracion->responsables()->sync($responsables);

        $aprobadores = $request->aprobadores;
        $declaracion->aprobadores()->sync($aprobadores);

        return redirect()->route('admin.panelDeclaracion.index')->with('success', 'Editado con éxito');
    }

    //Ruta donde vamos a guardar el responsable a traves del script
    public function relacionarResponsable(Request $request)
    {
        $declaracion = $request->declaracion;
        $responsable = $request->responsable;
        $existResponsable = DeclaracionAplicabilidadResponsable::select('declaracion_id')->where('declaracion_id', $declaracion)->exists();

        $isReasignable = DeclaracionAplicabilidadResponsable::select('declaracion_id')->where('declaracion_id', $declaracion)->whereNull('empleado_id')->exists();
        $readyExistResponsable = DeclaracionAplicabilidadAprobadores::select('declaracion_id')
            ->where('declaracion_id', $declaracion)->where('aprobadores_id', $responsable)->exists();
        if ($readyExistResponsable) {
            return response()->json(['estatus' => 'ya_es_aprobador', 'message' => 'Ya fue asignado aprobador'], 200);
        } else {
            if (!$existResponsable) {
                $exists = DeclaracionAplicabilidadResponsable::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->exists();
                if (!$exists) {
                    // dd($responsable);
                    DeclaracionAplicabilidadResponsable::updateOrCreate([
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
                    DeclaracionAplicabilidadResponsable::where('declaracion_id', $declaracion)->update(['empleado_id' => $responsable,  'esta_correo_enviado' => false]);

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
        $registro = DeclaracionAplicabilidadResponsable::where('declaracion_id', $declaracion)->where('empleado_id', $responsable);

        $exists = $registro->exists();
        if ($exists) {
            $registro = DeclaracionAplicabilidadResponsable::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->update(['empleado_id' => null, 'esta_correo_enviado' => true]);

            return response()->json(['message' => 'Responsable desasignado', 'request' => $request->all()], 200);
            // } else {
            //     return response()->json(['message'=>'Este responsable no ha sido asignado'], 200);
        }
    }

    //Ruta donde vamos a guardar el aprobador a traves del script
    public function relacionarAprobador(Request $request)
    {
        $declaracion = $request->declaracion;
        $aprobador = $request->aprobador;
        $existAprobador = DeclaracionAplicabilidadAprobadores::select('declaracion_id')->where('declaracion_id', $declaracion)->exists();
        $readyExistResponsable = DeclaracionAplicabilidadResponsable::select('declaracion_id')->where('declaracion_id', $declaracion)->where('empleado_id', $aprobador)->exists();
        if ($readyExistResponsable) {
            return response()->json(['estatus' => 'ya_es_responsable', 'message' => 'Ya fue asignado responsable'], 200);
        } else {
            if (!$existAprobador) {
                $exists = DeclaracionAplicabilidadAprobadores::where('declaracion_id', $declaracion)->where('aprobadores_id', $aprobador)->exists();
                if (!$exists) {
                    DeclaracionAplicabilidadAprobadores::updateOrCreate(
                        [
                            'declaracion_id' => $declaracion,
                            'aprobadores_id' => $aprobador,
                        ],
                        [
                            'esta_correo_enviado' => false,
                        ]
                    );

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
        $registro = DeclaracionAplicabilidadAprobadores::where('declaracion_id', $declaracion)->where('aprobadores_id', $aprobador);
        $exists = $registro->exists();
        if ($exists) {
            $registro->first()->delete();

            return response()->json(['message' => 'Aprobador desasignado'], 200);
        } else {
            return response()->json(['message' => 'Este aprobador no ha sido asignado'], 200);
        }
    }

    //Enviar Correo

    public function enviarCorreo(Request $request)
    {
        // // return response()->json(['message'=>$request->all()],200);
        // dd($request->all());
        // $declaracion = $request->declaracion;

        if ($request->enviarTodos) {
            $destinatarios = DeclaracionAplicabilidadResponsable::distinct('empleado_id')->pluck('empleado_id')->toArray();
        } elseif ($request->enviarNoNotificados) {
            $destinatarios = DeclaracionAplicabilidadResponsable::where('esta_correo_enviado', false)->distinct('empleado_id')->pluck('empleado_id')->toArray();
            // dd($destinatarios);
        } else {
            $destinatarios = json_decode($request->responsables);
        }
        // dd( $declaracion);
        // dd($destinatarios);
        $tipo = $request->tipo;
        $declaracion = $request->declaracion;

        foreach ($destinatarios as $destinatario) {
            $empleado = Empleado::alta()->select('id', 'name', 'email')->find(intval($destinatario));
            // dd($empleado); Hacer la consulta de controles se la envio como controles buscar la tabla where->
            $responsable = DeclaracionAplicabilidadResponsable::with('declaracion_aplicabilidad')->where('empleado_id', $destinatario)->get();
            // dd($responsable);
            $controles = collect();
            foreach ($responsable as $control) {
                $controles->push($control->declaracion_aplicabilidad);
            }
            Mail::to($empleado->email)->send(new MailDeclaracionAplicabilidad($empleado->name, $tipo, $controles));
            $responsable = DeclaracionAplicabilidadResponsable::where('empleado_id', $destinatario)->first();
            $responsable->update(['esta_correo_enviado' => true]);
        }

        return response()->json(['message' => 'Correo enviado'], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\DeclaracionAplicabilidad as MailDeclaracionAplicabilidad;
use App\Models\DeclaracionAplicabilidad;
use App\Models\DeclaracionAplicabilidadAprobadores;
use App\Models\DeclaracionAplicabilidadResponsable;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Yajra\DataTables\Facades\DataTables;

class PanelDeclaracionController extends Controller
{
    public function index(Request $request)
    {

        // dd(Empleado::select('id','name','genero','foto')->find(9)->declaraciones_responsable);
        if ($request->ajax()) {
            $query = DeclaracionAplicabilidad::with(['responsables', 'aprobadores'])->orderBy('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'paneldeclaracion';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->editColumn('controles', function ($row) {
                return $row->anexo_indice ? $row->anexo_indice : '';
            });
            $table->editColumn('politica', function ($row) {
                return $row->anexo_politica ? $row->anexo_politica : '';
            });
            $table->editColumn('responsable', function ($row) {
                return $row->responsables ? $row->responsables : '';
            });
            $table->editColumn('aprobador', function ($row) {
                return $row->aprobadores ? $row->aprobadores : '';
            });
            $table->editColumn('empleados', function ($row) {
                $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();

                return $empleados;
            });
            $table->editColumn('notificar', function ($row) {
                return $row->responsables ? $row->responsables : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }

        $empleados = Empleado::alta()->select('id', 'name', 'genero', 'foto')->get();

        return view('admin.panelDeclaracion.index', compact('empleados'));
    }

    public function create()
    {
        $empleados = Empleado::alta()->get();
        $controles = DeclaracionAplicabilidad::OrderBy('id')->get();

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
        $empleados = Empleado::alta()->get();
        $controles = DeclaracionAplicabilidad::get();

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
                    DeclaracionAplicabilidadResponsable::create([
                        'declaracion_id' => $declaracion,
                        'empleado_id' => $responsable,
                    ]);

                    return response()->json(['estatus' => 'asignado', 'message' => 'Responsable asignado'], 200);
                } else {
                    return response()->json(['estatus' => 'ya_asignado', 'message' => 'Este responsable ya ha sido asignado'], 200);
                }
            } else {
                if ($isReasignable) {
                    DeclaracionAplicabilidadResponsable::where('declaracion_id', $declaracion)->update(['empleado_id' => $responsable]);

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
            $registro = DeclaracionAplicabilidadResponsable::where('declaracion_id', $declaracion)->where('empleado_id', $responsable)->update(['empleado_id' => null]);

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
                    DeclaracionAplicabilidadAprobadores::create([
                        'declaracion_id' => $declaracion,
                        'aprobadores_id' => $aprobador,
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
            $destinatarios = DeclaracionAplicabilidadResponsable::where('notificado', false)->distinct('empleado_id')->pluck('empleado_id')->toArray();
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
            $responsable = DeclaracionAplicabilidadResponsable::where('empleado_id', $destinatario)->each(function ($item) {
                $item->notificado = true;
            });
        }

        return response()->json(['message' => 'Correo enviado'], 200);
    }
}

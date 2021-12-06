<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\DeclaracionAplicabilidad as MailDeclaracionAplicabilidad;
use Illuminate\Support\Facades\Mail;
use App\Models\DeclaracionAplicabilidad;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DeclaracionAplicabilidadAprobadores;
use App\Models\DeclaracionAplicabilidadResponsable;


class PanelDeclaracionController extends Controller
{
    public function index(Request $request){

        // dd(Empleado::select('id','name','genero','foto')->find(9)->declaraciones_responsable);
        if ($request->ajax()) {
            $query = DeclaracionAplicabilidad::with(['responsables','aprobadores'])->orderBy('id')->get();
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
                $empleados=Empleado::select('id','name','genero','foto')->get();
                return $empleados;
            });
            $table->editColumn('notificar', function ($row) {
                return $row->responsables ? $row->responsables : '';

            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);

        }

        $empleados=Empleado::select('id','name','genero','foto')->get();

        return view('admin.paneldeclaracion.index',compact('empleados'));

    }



    public function create()
    {
        $empleados = Empleado::get();
        $controles = DeclaracionAplicabilidad::OrderBy('id')->get();
        return view('admin.paneldeclaracion.create', compact('empleados','controles'));
    }


    public function store(Request $request,$id)
    {

        //cuando mandamos muchos datos es necesario el foreach
        // foreach($request->controles as $control){
            // $declaracion =DeclaracionAplicabilidad::find($id);

        $declaracion =DeclaracionAplicabilidad::find($id);
        //guarda lo que viene en el request
        $responsables=$request->responsables;
        //sincroniza mi declaracion con lo que le voy a poner
        $declaracion->responsables()->sync($responsables);

        $aprobadores=$request->aprobadores;
        $declaracion->aprobadores()->sync($aprobadores);
        // }


        return redirect()->route('admin.paneldeclaracion.index');

    }

    public function show(DeclaracionAplicabilidad $controles)
    {
        //
    }

    public function edit($id)
    {
        $empleados = Empleado::get();
        $controles = DeclaracionAplicabilidad::get();
        return view('admin.paneldeclaracion.edit', compact('empleados','controles'));

    }

    public function update(Request $request,$id)
    {
        $declaracion =DeclaracionAplicabilidad::find($id);

        $responsables=$request->responsables;
        $declaracion->responsables()->sync($responsables);
        $declaracion->responsables()->sync($responsables);

        $aprobadores=$request->aprobadores;
        $declaracion->aprobadores()->sync($aprobadores);


        return redirect()->route('admin.paneldeclaracion.index')->with('success', 'Editado con éxito');
    }

    //Ruta donde vamos a guardar el responsable a traves del script
    public function relacionarResponsable(Request $request)
    {

        $declaracion=$request->declaracion;
        $responsable=$request->responsable;
        $exists=DeclaracionAplicabilidadResponsable::where('declaracion_id',$declaracion)->where('empleado_id',$responsable)->exists();
        if(!$exists){
            DeclaracionAplicabilidadResponsable::create([
                'declaracion_id' => $declaracion,
                'empleado_id'=>$responsable,
            ]);
            return response()->json(['message'=>'Responsable asignado'],200);
        }else{
            return response()->json(['message'=>'Este responsable ya ha sido asignado'],200);

        }

    }
    //QUITAR EL RESPONSABLE
    public function quitarRelacionResponsable(Request $request)
    {

        $declaracion=$request->declaracion;
        $responsable=$request->responsable;
        $registro=DeclaracionAplicabilidadResponsable::where('declaracion_id',$declaracion)->where('empleado_id',$responsable);
        $exists=$registro->exists();
        if($exists){
           $registro->first()->delete();
            return response()->json(['message'=>'Responsable desasignado'],200);
        }else{
            return response()->json(['message'=>'Este responsable no ha sido asignado'],200);

        }

    }

        //Ruta donde vamos a guardar el aprobador a traves del script
        public function relacionarAprobador(Request $request)
        {
            $declaracion=$request->declaracion;
            $aprobador=$request->aprobador;
            $exists=DeclaracionAplicabilidadAprobadores::where('declaracion_id',$declaracion)->where('aprobadores_id',$aprobador)->exists();
            if(!$exists){
                DeclaracionAplicabilidadAprobadores::create([
                    'declaracion_id' => $declaracion,
                    'aprobadores_id'=>$aprobador,
                ]);
                return response()->json(['message'=>'Aprobador asignado'],200);
            }else{
                return response()->json(['message'=>'Este aprobador ya ha sido asignado'],200);
            }

        }


           //QUITAR EL APROBADOR
        public function quitarRelacionAprobador(Request $request)
        {
            $declaracion=$request->declaracion;
            $aprobador=$request->aprobador;
            $registro=DeclaracionAplicabilidadAprobadores::where('declaracion_id',$declaracion)->where('aprobadores_id',$aprobador);
            $exists=$registro->exists();
            if($exists){
            $registro->first()->delete();
                return response()->json(['message'=>'Aprobador desasignado'],200);
            }else{
                return response()->json(['message'=>'Este aprobador no ha sido asignado'],200);

            }

        }


        //Enviar Correo

        public function enviarCorreo(Request $request)
        {
            if($request->enviarTodos){
                $destinatarios=DeclaracionAplicabilidadResponsable::distinct("empleado_id")->pluck('empleado_id')->toArray();
            }elseif($request->enviarNoNotificados){
               $destinatarios=DeclaracionAplicabilidadResponsable::where('notificado',false)->distinct("empleado_id")->pluck('empleado_id')->toArray();
            }else{
                $destinatarios=json_decode($request->responsables);

            }
            // dd($destinatarios);
            $tipo=$request->tipo;
            foreach ($destinatarios as $destinatario){
                $empleado=Empleado::select('id','name','email')->find(intval($destinatario));
                Mail::to($empleado->email)->send(new MailDeclaracionAplicabilidad($empleado->name,$tipo));
                $responsable=DeclaracionAplicabilidadResponsable::where('empleado_id',$destinatario)->each(function($item){
                    $item->notificado=true;
                });
            }
            return response()->json(['message'=>'Correo enviado'],200);
        }


}

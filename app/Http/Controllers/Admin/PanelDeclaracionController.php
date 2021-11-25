<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empleado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DeclaracionAplicabilidad;
use Yajra\DataTables\Facades\DataTables;
use App\Models\DeclaracionAplicabilidadAprobadores;
use App\Models\DeclaracionAplicabilidadResponsable;


class PanelDeclaracionController extends Controller
{
    public function index(Request $request){

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
            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);

        }

        return view('admin.paneldeclaracion.index');

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
        DeclaracionAplicabilidadResponsable::create([
            'declaracion_id' => $declaracion,
            'empleado_id'=>$responsable,
        ]);
        return response()->json(['message'=>'Responsable asignado'],200);
    }

        //Ruta donde vamos a guardar el aprobador a traves del script
        public function relacionarAprobador(Request $request)
        {
            $declaracion=$request->declaracion;
            $aprobador=$request->aprobador;
            DeclaracionAplicabilidadAprobadores::create([
                'declaracion_id' => $declaracion,
                'empleado_id'=>$aprobador,
            ]);
            return response()->json(['message'=>'Aprobador asignado'],200);
        }
}

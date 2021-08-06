<?php

namespace App\Http\Controllers\Admin;

use App\Models\Empleado;
use Laracasts\Flash\Flash;
use Illuminate\Http\Request;
use App\Models\AnalisisDeRiesgo;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\MassDestroyAnalisisRiesgosRequest;

class AnalisisdeRiesgosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            //Esta es el error , activo_id no lo encuentra, hay que modificar la relacion en el modelo de matrizriesgo
            $query = AnalisisDeRiesgo::get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_show';
                $editGate      = 'user_edit';
                $deleteGate    = 'user_delete';
                $crudRoutePart = 'analisis-riesgos';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : "";
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : "";
            });

            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : "";
            });

            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? $row->fecha : "";
            });

            $table->editColumn('porcentaje_implementacion', function ($row) {
                return $row->porcentaje_implementacion ? $row->porcentaje_implementacion : "";
            });

            $table->editColumn('elaboro', function ($row) {
                return $row->empleado ? $row->empleado->name : "";
            });

            $table->editColumn('estatus', function ($row) {
                return $row->estatus ? $row->estatus : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'activo_id', 'controles']);

            return $table->make(true);
        }


        return view('admin.analisis-riesgos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empleados = Empleado::get();

        //$tipoactivos = Tipoactivo::all()->pluck('tipo', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.analisis-riesgos.create', compact('empleados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $analisis = AnalisisDeRiesgo::create($request->all());
        switch ($request->tipo) {
            case 'Seguridad de la información':
                Flash::success('<h5 class="text-center">Análisis de riesgo agregado</h5>');
                return redirect()->route('admin.matriz-seguridad', ['id' => $analisis->id]);
                break;
            default:
                Flash::error('<h5 class="text-center">Ocurrio un error intente de nuevo</h5>');
                return redirect()->route('admin.analisis-riesgos.index');
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalisisDeRiesgo;
use App\Models\Area;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Yajra\DataTables\Facades\DataTables;

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
            $query = AnalisisDeRiesgo::orderByDesc('id')->get();
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
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
                return $row->id ? $row->id : '';
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });

            $table->editColumn('tipo', function ($row) {
                return $row->tipo ? $row->tipo : '';
            });

            $table->editColumn('fecha', function ($row) {
                return $row->fecha ? \Carbon\Carbon::parse($row->fecha)->format('d-m-Y') : '';
            });

            $table->editColumn('porcentaje_implementacion', function ($row) {
                return $row->porcentaje_implementacion ? $row->porcentaje_implementacion : '';
            });

            $table->editColumn('elaboro', function ($row) {
                return $row->empleado ? $row->empleado->name : '';
            });

            $table->editColumn('estatus', function ($row) {
                if ($row->estatus == 1) {
                    return $row->estatus ? 'Válido' : '';
                } else {
                    return $row->estatus ? 'Obsoleto' : '';
                }
            });
            $table->editColumn('enlace', function ($row) {
                return $row->id ? $row->id : '';
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
        $empleados = Empleado::getAll();

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
    public function show(Request $request, $id)
    {
        $analisis = AnalisisDeRiesgo::find($id);

        return view('admin.analisis-riesgos.show', compact('analisis'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $empleados = Empleado::getAll();
        $analisis = AnalisisDeRiesgo::find($id);

        return view('admin.analisis-riesgos.edit', compact('empleados', 'analisis'));
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
        $analisis = AnalisisDeRiesgo::find($id);

        $analisis->update([
            'nombre' =>  $request->nombre,
            'tipo' =>  $request->tipo,
            'fecha' =>  $request->fecha,
            'id_elaboro' =>  $request->id_elaboro,
            'porcentaje_implementacion' => $request->porcentaje_implementacion,
            'estatus' =>  $request->estatus,
        ]);

        return redirect()->route('admin.analisis-riesgos.index')->with('success', 'Editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $analisis = AnalisisDeRiesgo::find($id);
        $analisis->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }

    public function getEmployeeData(Request $request)
    {
        $empleados = Empleado::find($request->id);
        $areas = Area::find($empleados->area_id);

        return response()->json(['puesto' => $empleados->puesto, 'area' => $areas->area]);
    }
}

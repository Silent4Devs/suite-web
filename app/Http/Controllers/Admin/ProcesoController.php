<?php

namespace App\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use App\Models\Proceso;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Proceso::get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate      = 'recurso_show';
                $editGate      = 'recurso_edit';
                $deleteGate    = 'recurso_delete';
                $crudRoutePart = 'procesos';

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
            $table->editColumn('codigo', function ($row) {
                return $row->codigo ? $row->codigo : "";
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : "";
            });
            $table->editColumn('macroproceso', function ($row) {
                return $row->macroproceso->nombre ? $row->macroproceso->nombre : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.procesos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $macroproceso = DB::table('macroprocesos')->select('id', 'codigo' ,'nombre')->get();
        //dd("teasdas". $organizaciones);

        return view('admin.procesos.create')->with('macroprocesos', $macroproceso);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_macroproceso' => 'required|integer',
                'descripcion' => 'required|string'
            ],
        );
        $procesos = proceso::create($request->all());
        Flash::success('<h5 class="text-center">Proceso agregado satisfactoriamente</h5>');
        return redirect()->route('admin.procesos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function show(Proceso $proceso)
    {
        return view('admin.procesos.show', compact('proceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Proceso $proceso)
    {
        $macroproceso = DB::table('macroprocesos')->select('id', 'codigo' ,'nombre')->get();

        return view('admin.procesos.edit', compact('proceso'))->with('macroprocesos', $macroproceso);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proceso $proceso)
    {
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_macroproceso' => 'required|integer',
                'descripcion' => 'required|string'
            ],
        );
        $proceso->update($request->all());
        Flash::success('<h5 class="text-center">Proceso actualizado satisfactoriamente</h5>');
        return redirect()->route('admin.procesos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proceso  $proceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proceso $proceso)
    {
        $proceso->delete();
        Flash::success('<h5 class="text-center">Proceso eliminado satisfactoriamente</h5>');
        return redirect()->route('admin.procesos.index');

    }
}

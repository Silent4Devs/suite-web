<?php

namespace App\Http\Controllers\Admin;

use Laracasts\Flash\Flash;
use App\Models\Macroproceso;
use App\Models\Organizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class MacroprocesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Macroproceso::get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate      = 'recurso_show';
                $editGate      = 'recurso_edit';
                $deleteGate    = 'recurso_delete';
                $crudRoutePart = 'macroprocesos';

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
            $table->editColumn('grupo', function ($row) {
                return $row->grupo->nombre ? $row->grupo->nombre : "";
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : "";
            });

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.macroprocesos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $grupos = DB::table('grupos')->select('id', 'nombre')->get();
        //dd("teasdas". $organizaciones);

        return view('admin.macroprocesos.create')->with('grupos', $grupos);
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
                'id_grupo' => 'required|integer',
                'descripcion' => 'required|string'
            ],
        );
        $macroprocesos = Macroproceso::create($request->all());
        Flash::success('<h5 class="text-center">Macroproceso agregado satisfactoriamente</h5>');
        return redirect()->route('admin.macroprocesos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function show(Macroproceso $macroproceso)
    {
        return view('admin.macroprocesos.show', compact('macroproceso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function edit(Macroproceso $macroproceso)
    {
        $grupos = DB::table('grupos')->select('id', 'nombre')->get();

        return view('admin.macroprocesos.edit', compact('macroproceso'))->with('grupos', $grupos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Macroproceso $macroproceso)
    {
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_grupo' => 'required|integer',
                'descripcion' => 'required|string'
            ],
        );
        $macroproceso->update($request->all());
        Flash::success('<h5 class="text-center">Macroproceso actualizado satisfactoriamente</h5>');
        return redirect()->route('admin.macroprocesos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Macroproceso  $macroproceso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Macroproceso $macroproceso)
    {
        $macroproceso->delete();
        Flash::success('<h5 class="text-center">Macroproceso eliminado satisfactoriamente</h5>');
        return redirect()->route('admin.macroprocesos.index');
    }
}

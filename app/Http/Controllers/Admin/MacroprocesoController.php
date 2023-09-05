<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Macroproceso;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Laracasts\Flash\Flash;
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
        abort_if(Gate::denies('macroprocesos_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // dd($query = Macroproceso::get());
        if ($request->ajax()) {
            $query = Macroproceso::get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'macroprocesos_ver';
                $editGate = 'macroprocesos_editar';
                $deleteGate = 'macroprocesos_eliminar';
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
                return $row->id ? $row->id : '';
            });
            $table->editColumn('codigo', function ($row) {
                return $row->codigo ? $row->codigo : '';
            });
            $table->editColumn('nombre', function ($row) {
                return $row->nombre ? $row->nombre : '';
            });
            $table->editColumn('grupo', function ($row) {
                return $row->grupo ? $row->grupo->nombre : '';
            });
            $table->editColumn('descripcion', function ($row) {
                return $row->descripcion ? $row->descripcion : '';
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
        abort_if(Gate::denies('macroprocesos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $grupos = DB::table('grupos')->select('id', 'nombre')->get();
        //dd("teasdas". $organizaciones);

        return view('admin.macroprocesos.create')->with('grupos', $grupos);
    }

    public function store(Request $request)
    {
        abort_if(Gate::denies('macroprocesos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_grupo' => 'required|integer',
                'descripcion' => 'required|string',
            ]
        );
        $macroprocesos = Macroproceso::create($request->all());

        // Flash::success('<h5 class="text-center">Macroproceso agregado satisfactoriamente</h5>');
        return redirect()->route('admin.macroprocesos.index')->with('success', 'Guardado con éxito');
    }

    public function show(Macroproceso $macroproceso)
    {
        abort_if(Gate::denies('macroprocesos_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.macroprocesos.show', compact('macroproceso'));
    }

    public function edit(Macroproceso $macroproceso)
    {
        abort_if(Gate::denies('macroprocesos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $grupos = DB::table('grupos')->select('id', 'nombre')->get();

        return view('admin.macroprocesos.edit', compact('macroproceso'))->with('grupos', $grupos);
    }

    public function update(Request $request, Macroproceso $macroproceso)
    {
        abort_if(Gate::denies('macroprocesos_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate(
            [
                'codigo' => 'required|string',
                'nombre' => 'required|string',
                'id_grupo' => 'required|integer',
                'descripcion' => 'required|string',
            ],
        );
        $macroproceso->update($request->all());

        return redirect()->route('admin.macroprocesos.index')->with('success', 'Editado con éxito');
    }

    public function destroy(Macroproceso $macroproceso)
    {
        abort_if(Gate::denies('macroprocesos_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $macroproceso->delete();

        return back()->with('deleted', 'Registro eliminado con éxito');
    }
}

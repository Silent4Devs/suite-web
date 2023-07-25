<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaCapacitacion;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoriaCapacitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = CategoriaCapacitacion::orderByDesc('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'recurso_show';
                $editGate = 'recurso_edit';
                $deleteGate = 'recurso_delete';
                $crudRoutePart = 'categoria-capacitacion';

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

            $table->rawColumns(['actions']);

            return $table->make(true);
        }

        return view('admin.categoria-capacitacion.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categoria-capacitacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|unique:categoria_capacitacions,nombre',
        ], ['nombre.unique' => 'Esta categoria ya ha sido utilizada']);
        CategoriaCapacitacion::create($request->all());

        return redirect()->route('admin.categoria-capacitacion.index');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaCapacitacion $categoriaCapacitacion)
    {
        return view('admin.categoria-capacitacion.show', compact('categoriaCapacitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaCapacitacion $categoriaCapacitacion)
    {
        return view('admin.categoria-capacitacion.edit', compact('categoriaCapacitacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaCapacitacion $categoriaCapacitacion)
    {
        $request->validate([
            'nombre' => 'required|string|unique:categoria_capacitacions,nombre,'.$categoriaCapacitacion->id,
        ], ['nombre.unique' => 'Esta categoria ya ha sido utilizada']);
        $categoriaCapacitacion->update($request->all());

        return redirect()->route('admin.categoria-capacitacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaCapacitacion $categoriaCapacitacion)
    {
        $categoriaCapacitacion->delete();

        return redirect()->route('admin.categoria-capacitacion.index');
    }
}

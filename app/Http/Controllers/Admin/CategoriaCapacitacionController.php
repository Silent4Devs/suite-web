<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaCapacitacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
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
        abort_if(Gate::denies('categorias_capacitaciones_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = CategoriaCapacitacion::orderByDesc('id')->get();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'categorias_capacitaciones_show';
                $editGate = 'categorias_capacitaciones_edit';
                $deleteGate = 'categorias_capacitaciones_delete';
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
        abort_if(Gate::denies('categorias_capacitaciones_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria-capacitacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('categorias_capacitaciones_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|unique:categoria_capacitacions,nombre',
        ], ['nombre.unique' => 'Esta categoria ya ha sido utilizada']);
        CategoriaCapacitacion::create($request->all());

        return redirect()->route('admin.categoria-capacitacion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategoriaCapacitacion  $categoriaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function show(CategoriaCapacitacion $categoriaCapacitacion)
    {
        abort_if(Gate::denies('categorias_capacitaciones_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria-capacitacion.show', compact('categoriaCapacitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategoriaCapacitacion  $categoriaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaCapacitacion $categoriaCapacitacion)
    {
        abort_if(Gate::denies('categorias_capacitaciones_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria-capacitacion.edit', compact('categoriaCapacitacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategoriaCapacitacion  $categoriaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaCapacitacion $categoriaCapacitacion)
    {
        abort_if(Gate::denies('categorias_capacitaciones_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $request->validate([
            'nombre' => 'required|string|unique:categoria_capacitacions,nombre,' . $categoriaCapacitacion->id,
        ], ['nombre.unique' => 'Esta categoria ya ha sido utilizada']);
        $categoriaCapacitacion->update($request->all());

        return redirect()->route('admin.categoria-capacitacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategoriaCapacitacion  $categoriaCapacitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoriaCapacitacion $categoriaCapacitacion)
    {
        abort_if(Gate::denies('categorias_capacitaciones_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoriaCapacitacion->delete();
        $competencia->delete();

        return redirect()->route('admin.categoria-capacitacion.index');
    }
}

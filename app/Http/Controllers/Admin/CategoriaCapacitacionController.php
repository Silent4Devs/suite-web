<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoriaCapacitacion;
use App\Traits\ObtenerOrganizacion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class CategoriaCapacitacionController extends Controller
{
    use ObtenerOrganizacion;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        abort_if(Gate::denies('capacitaciones_categorias_acceder'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        if ($request->ajax()) {
            $query = CategoriaCapacitacion::getAll();
            $table = DataTables::of($query);

            $table->addColumn('actions', '&nbsp;');
            $table->addIndexColumn();
            $table->editColumn('actions', function ($row) {
                $viewGate = 'capacitaciones_categorias_ver';
                $editGate = 'capacitaciones_categorias_editar';
                $deleteGate = 'capacitaciones_categorias_eliminar';
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

        $organizacion_actual = $this->obtenerOrganizacion();
        $logo_actual = $organizacion_actual->logo;
        $empresa_actual = $organizacion_actual->empresa;

        return view('admin.categoria-capacitacion.index', compact('organizacion_actual', 'logo_actual', 'empresa_actual'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('capacitaciones_categorias_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria-capacitacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        abort_if(Gate::denies('capacitaciones_categorias_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('capacitaciones_categorias_ver'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria-capacitacion.show', compact('categoriaCapacitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(CategoriaCapacitacion $categoriaCapacitacion)
    {
        abort_if(Gate::denies('capacitaciones_categorias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.categoria-capacitacion.edit', compact('categoriaCapacitacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoriaCapacitacion $categoriaCapacitacion)
    {
        abort_if(Gate::denies('capacitaciones_categorias_editar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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
        abort_if(Gate::denies('capacitaciones_categorias_eliminar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $categoriaCapacitacion->delete();

        return redirect()->route('admin.categoria-capacitacion.index');
    }
}

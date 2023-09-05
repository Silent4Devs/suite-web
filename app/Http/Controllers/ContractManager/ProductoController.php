<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\Producto;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('katbol_producto_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $productos = Producto::select('id', 'clave', 'descripcion')->where('archivo', false)->get();
        $productos_id = Producto::get()->pluck('id');
        $ids = [];

        foreach ($productos_id as $id) {
            $ids = $id;
        }

        return view('contract_manager.productos.index', compact('productos', 'ids'));
    }

    public function getProductosIndex()
    {
        $query = Producto::select('id', 'clave', 'descripcion')->where('archivo', false)->get()->sortBy('clave');

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('katbol_producto_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('contract_manager.productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productos = new Producto();
        $productos->descripcion = $request->descripcion;
        $productos->clave = $request->clave;
        $productos->save();

        return redirect('/contract_manager/productos');
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
        abort_if(Gate::denies('katbol_producto_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $productos = Producto::find($id);

        return view('contract_manager.productos.edit', compact('productos'));
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
        $request->validate([
         'descripcion' => 'required',
         'clave' => 'required',
        ]);
        $sucursal = Producto::find($id);

        $sucursal->update([
            'descripcion' => $request->descripcion,
            'clave' => $request->clave,
        ]);

        return redirect('/contract_manager/productos');
    }

    public function view_archivados()
    {
        $productos = Producto::select('id', 'clave', 'descripcion')->where('archivo', true)->get();
        $productos_id = Producto::get()->pluck('id');
        $ids = [];

        foreach ($productos_id as $id) {
            $ids = $id;
        }

        return view('contract_manager.productos.archivo', compact('productos', 'ids'));
    }

    public function getArchivadosIndex(Request $request)
    {
        $query = Producto::select('id', 'clave', 'descripcion')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archivar($id)
    {
        abort_if(Gate::denies('katbol_producto_archivar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $productos = Producto::find($id);

        if ($productos->archivo === false) {
            $productos->update([
                'archivo' => true,
            ]);
        } else {
            $productos->update([
                'archivo' => false,
            ]);
        }

        return redirect('/contract_manager/productos');
    }
}

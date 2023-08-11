<?php

namespace App\Http\Controllers\Katbol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Katbol\Producto;
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $productos = Producto::select('id', 'clave', 'descripcion')->where('archivo', true)->get();
        $productos_id = Producto::get()->pluck('id');
        $ids = [];

        foreach ($productos_id as $id) {
            $ids =  $id;
        }

        return view('katbol.productos.index', compact('productos', 'ids'));



    }

    public function getProductosIndex(Request $request)
    {
        $query = Producto::select('id', 'clave', 'descripcion')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katbol.productos.create');
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

            return redirect('/katbol/productos');
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

        $productos = Producto::find($id);

        return view('katbol.productos.edit', compact('productos'));
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
                'clave' => $request->clave
            ]);

            return redirect('/katbol/productos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archivar($id)
    {
        $productos = Producto::find($id);

        if($productos->archivo === false){
            $productos->update([
                'archivo' => true,
            ]);

        }else{
            $productos->update([
                'archivo' => false,
            ]);

        }

        return redirect('/katbol/productos');
    }


}

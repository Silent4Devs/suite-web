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

        $productos = Producto::get();

        return view('katbol.productos.index', compact('productos'));
    }

    public function getProductosIndex(Request $request)
    {
        $query = Producto::get();

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
    public function destroy($id)
    {
        Producto::destroy($id);
    }


    public function massDestroy(Request $request)
    {
        Producto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function archivo()
    {
      $productos = Producto::where('archivo', true)->get();

      return view('productos.archivo', compact('productos'));
    }


    public function estado($id)
    {
        $producto = Producto::find($id);
        if($producto->archivo === 0){
            $producto->update([
                'archivo' => 1,
            ]);

        }else{
            $producto->update([
                'archivo' => 0,
            ]);
        }
        $productos = Producto::where('archivo', true)->get();
        return view('productos.archivo', compact('productos'));
    }
}

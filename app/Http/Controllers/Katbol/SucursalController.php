<?php

namespace App\Http\Controllers\Katbol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Katbol\Sucursal;

class SucursalController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sucursales = Sucursal::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', true)->get();
        $sucursales_id = Sucursal::get()->pluck('id');
        $ids = [];

        foreach ($sucursales_id as $id) {
            $ids =  $id;
        }

        return view('katbol.sucursales.index', compact('sucursales', 'ids'));
    }

    public function getSucursalesIndex(Request $request)
    {
        $query = Sucursal::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katbol.sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $sucursales = new Sucursal();
            $sucursales->clave = $request->clave;
            $sucursales->descripcion = $request->descripcion;
            $sucursales->rfc = $request->rfc;
            $sucursales->empresa = $request->empresa;
            $sucursales->cuenta_contable = $request->cuenta_contable;
            $sucursales->zona = $request->zona;
            $sucursales->direccion = $request->direccion;
            $sucursales->mylogo = $request->mylogo;
            $sucursales->save();

            return redirect('/katbol/sucursales');
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

        $sucursales = Sucursal::find($id);

        return view('katbol.sucursales.edit', compact('sucursales'));
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
             'clave' => 'required',
             'descripcion' => 'required',
             'rfc' => 'required',
             'empresa' => 'required',
             'cuenta_contable' => 'required',
             'zona' => 'required',
             'direccion' => 'required',
             'mylogo' => 'required',
            ]);
            $sucursal = Sucursal::find($id);

            $sucursal->update([
                'clave' => $request->clave,
                'descripcion' => $request->descripcion,
                'rfc' => $request->rfc,
                'empresa' => $request->empresa,
                'cuenta_contable' => $request->cuenta_contable,
                'direccion' => $request->direccion,
                'mylogo' => $request->mylogo,
            ]);

            return redirect('/katbol/sucursales');
    }


     /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function archivar($id)
    {
        $sucursal = Sucursal::find($id);
        if($sucursal->archivo === false){
            $sucursal->update([
                'archivo' => true,
            ]);

        }else{
            $sucursal->update([
                'archivo' => false,
            ]);
        }
        return redirect('/katbol/sucursales');
    }
}

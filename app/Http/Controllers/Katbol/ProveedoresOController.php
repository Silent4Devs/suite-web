<?php

namespace App\Http\Controllers\Katbol;
use App\Http\Controllers\Controller;
use App\Models\Katbol\ProveedoresOC;
use App\Models\Katbol\ProveedorOC;
use Illuminate\Http\Request;

class ProveedoresOController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $proveedores = ProveedorOC::select('id', 'nombre', 'razon_social', 'rfc', 'contacto', 'estado', 'facturacion', 'direccion', 'envio', 'credito', 'fecha_inicio', 'fecha_fin')->where('estado', false)->get();
        $proveedores_id = ProveedorOC::get()->pluck('id');
        $ids = [];

        foreach ($proveedores_id as $id) {
            $ids =  $id;
        }

        return view('katbol.proveedores.index', compact('proveedores', 'ids'));
    }

    public function getproveedoresIndex(Request $request)
    {
        $query = ProveedorOC::select('id', 'nombre', 'razon_social', 'rfc', 'contacto', 'estado', 'facturacion', 'direccion', 'envio', 'credito', 'fecha_inicio', 'fecha_fin')->where('estado', false)->get();
        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katbol.proveedores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $proveedores = new ProveedorOC();
            $proveedores->nombre = $request->nombre;
            $proveedores->razon_social = $request->razon_social;
            $proveedores->rfc = $request->rfc;
            $proveedores->contacto = $request->contacto;
            $proveedores->facturacion = $request->facturacion;
            $proveedores->direccion = $request->direccion;
            $proveedores->envio = $request->envio;
            $proveedores->credito = $request->credito;
            $proveedores->fecha_inicio = $request->fecha_inicio;
            $proveedores->fecha_fin = $request->fecha_fin;
            $proveedores->save();

            return redirect('/katbol/proveedores');
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

        $proveedores = ProveedorOC::find($id);

        return view('katbol.proveedores.edit', compact('proveedores'));
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
             'nombre' => 'required',
             'razon_social' => 'required',
             'contacto' => 'required',
             'facturacion' => 'required',
             'direccion' => 'required',
             'envio' => 'required',
             'credito' => 'required',
             'fecha_inicio' => 'required',
             'fecha_fin' => 'required',
            ]);
            $proveedores = ProveedorOC::find($id);

            $proveedores->update([
                'nombre' => $request->nombre,
                'razon_social' => $request->razon_social,
                'contacto' => $request->contacto,
                'facturacion' => $request->facturacion,
                'cuenta_contable' => $request->cuenta_contable,
                'direccion' => $request->direccion,
                'envio' => $request->envio,
                'credito' => $request->credito,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
            ]);

            return redirect('/katbol/proveedores');
    }


     /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function archivar($id)
    {
        $proveedores = ProveedorOC::find($id);
        if($proveedores->estado === false){
            $proveedores->update([
                'estado' => true,
            ]);

        }else{
            $proveedores->update([
                'estado' => false,
            ]);
        }

        return redirect('/katbol/proveedores');
    }

}

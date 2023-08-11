<?php

namespace App\Http\Controllers\Katbol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Katbol\CentroCosto;

class CentroCostosController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $centros = CentroCosto::select('id', 'clave', 'descripcion', 'estado', 'archivo')->where('archivo', true)->get();
        $centros_id = CentroCosto::get()->pluck('id');
        $ids = [];

        foreach ($centros_id as $id) {
            $ids =  $id;
        }

        return view('katbol.centro-costos.index', compact('centros', 'ids'));
    }

    public function getCentroCostosIndex(Request $request)
    {
        $query = CentroCosto::select('id', 'clave', 'descripcion', 'estado', 'archivo')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katbol.centro-costos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $centro = new CentroCosto();
            $centro->descripcion = $request->descripcion;
            $centro->clave = $request->clave;
            $centro->save();

            return redirect('/katbol/centro-costos');
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

        $centros = CentroCosto::find($id);

        return view('katbol.centro-costos.edit', compact('centros'));
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

            $centros = CentroCosto::find($id);

            $centros->update([
                'descripcion' => $request->descripcion,
                'clave' => $request->clave
            ]);

            return redirect('/katbol/centro-costos');
    }


    public function archivar($id)
    {
        $centro = CentroCosto::find($id);
        if($centro->archivo === false){
            $centro->update([
                'archivo' => true,
            ]);

        }else{
            $centro->update([
                'archivo' => false,
            ]);
        }
        return redirect('/katbol/centro-costos');
    }
}

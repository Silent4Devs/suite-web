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

        $centros = CentroCosto::get();

        return view('katbol.centro-costos.index', compact('centros'));
    }

    public function getCentroCostosIndex(Request $request)
    {
        $query = CentroCosto::get();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CentroCosto::destroy($id);
    }


    public function massDestroy(Request $request)
    {
        CentroCosto::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function archivo()
    {
      $centros = CentroCosto::where('archivo', true)->get();

      return view('centro-costos.archivo', compact('centro-costos'));
    }


    public function estado($id)
    {
        $centro = CentroCosto::find($id);
        if($centro->archivo === 0){
            $centro->update([
                'archivo' => 1,
            ]);

        }else{
            $centro->update([
                'archivo' => 0,
            ]);
        }
        $centros = CentroCosto::where('archivo', true)->get();
        return view('centro-costos.archivo', compact('centros'));
    }
}

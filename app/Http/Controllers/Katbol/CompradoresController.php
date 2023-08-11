<?php

namespace App\Http\Controllers\Katbol;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Katbol\Comprador;
use App\Models\Katbol\Producto;
use Exception;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\DB;

class CompradoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $compradores = Comprador::select('id', 'clave', 'nombre', 'estado')->where('archivo', false)->get();
        $compradores_id = Comprador::get()->pluck('id');
        $ids = [];

        foreach ($compradores_id as $id) {
            $ids =  $id;
        }

        return view('katbol.compradores.index', compact('compradores', 'ids'));



    }

    public function getCompradoresIndex(Request $request)
    {
        $query = Comprador::select('id', 'clave', 'nombre', 'estado')->where('archivo', false)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('katbol.compradores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            $compradores = new Comprador();
            $compradores->nombre = $request->nombre;
            $compradores->clave = $request->clave;
            $compradores->id_user = $request->id_user;
            $compradores->save();

            return redirect('/katbol/compradores');
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

        $compradores = Comprador::find($id);

        return view('katbol.compradores.edit', compact('compradores'));
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
             'clave' => 'required',
            ]);
            $comprador = Comprador::find($id);

            $comprador->update([
                'nombre' => $request->nombre,
                'clave' => $request->clave
            ]);

            return redirect('/katbol/compradores');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function archivar($id)
    {
        $compradores = Comprador::find($id);

        if($compradores->archivo === false){
            $compradores->update([
                'archivo' => true,
            ]);

        }else{
            $compradores->update([
                'archivo' => false,
            ]);

        }

        return redirect('/katbol/compradores');
    }


}

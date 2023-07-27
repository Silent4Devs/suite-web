<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $request->validate([
                'nombre' => 'required|string|unique:marca,nombre',
            ]);
            // $nombre = $request->nombre;
            // // dd($request->all());
            // $marca = Marca::create([
            //     'nombre'=>$nombre,
            // ]);
            // if ($marca) {
            //     return response()->json(['success'=>true]);
            // } else {
            //     return response()->json(['success'=>false]);
            // }
            $marca = Marca::create($request->all());
            if (array_key_exists('ajax', $request->all())) {
                return response()->json(['success' => true, 'activo' => $marca]);
            }
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getMarcas(Request $request)
    {
        if ($request->ajax()) {
            $marcas_arr = [];
            $marcas = Marca::getAll();
            // dd($marcas);
            foreach ($marcas as $marca) {
                $marcas_arr[] = ['id' => $marca->id, 'text' => $marca->nombre];
            }

            $array_m = [];
            $array_m['results'] = $marcas_arr;
            $array_m['pagination'] = ['more' => false];

            return $array_m;
        }
    }
}

<?php

namespace App\Http\Controllers\ContractManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContractManager\Comprador;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class CompradoresController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('katbol_producto_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $compradores = Comprador::select('id', 'clave', 'nombre', 'estado')->where('archivo', false)->get();
        $compradores_id = Comprador::get()->pluck('id');
        $ids = [];

        foreach ($compradores_id as $id) {
            $ids =  $id;
        }

        return view('contract_manager.compradores.index', compact('compradores', 'ids'));



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
        abort_if(Gate::denies('katbol_producto_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('contract_manager.compradores.create');
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

            return redirect('/contract_manager/compradores');
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
        $compradores = Comprador::find($id);

        return view('contract_manager.compradores.edit', compact('compradores'));
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

            return redirect('/contract_manager/compradores');
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

        return redirect('/contract_manager/compradores');
    }


    public function view_archivados()
    {
      $compradores = Comprador::where('archivo', true)->get();
      $compradores_id = Comprador::get()->pluck('id');
      $ids = [];

      foreach ($compradores_id as $id) {
          $ids =  $id;
      }

      return view('contract_manager.compradores.archivo', compact('compradores', 'ids'));
    }


    public function getArchivadosIndex(Request $request)
    {
        $query = Comprador::select('id', 'clave', 'nombre')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }


}

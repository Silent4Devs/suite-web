<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\CentroCosto;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CentroCostosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('katbol_centro_costos_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $centros = CentroCosto::select('id', 'clave', 'descripcion', 'estado', 'archivo')->where('archivo', false)->get();
        $centros_id = CentroCosto::get()->pluck('id');
        $ids = [];

        foreach ($centros_id as $id) {
            $ids = $id;
        }

        return view('contract_manager.centro-costos.index', compact('centros', 'ids'));
    }

    public function getCentroCostosIndex(Request $request)
    {
        $query = CentroCosto::select('id', 'clave', 'descripcion', 'estado', 'archivo')->where('archivo', false)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('katbol_centro_costos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('contract_manager.centro-costos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $ids = CentroCosto::pluck('id');

        foreach ($ids as $id) {
            $string1 = strval($id);
            if ($string1  === $request->id) {
                return view('contract_manager.proveedores.error');
            }
        }

        $centro = new CentroCosto();
        $centro->id = $request->id;
        $centro->descripcion = $request->descripcion;
        $centro->clave = 0;
        $centro->save();

        return redirect('/contract_manager/centro-costos');
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
        abort_if(Gate::denies('katbol_centro_costos_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $centros = CentroCosto::find($id);

        return view('contract_manager.centro-costos.edit', compact('centros'));
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
            'id' => 'required',
        ]);

        $centros = CentroCosto::find($id);

        $centros->update([
            'descripcion' => $request->descripcion,
            'id' => $request->id,
        ]);

        return redirect('/contract_manager/centro-costos');
    }

    public function view_archivados()
    {
        $centros = CentroCosto::select('id', 'clave', 'descripcion')->where('archivo', true)->get();
        $centros_id = CentroCosto::get()->pluck('id');
        $ids = [];

        foreach ($centros_id as $id) {
            $ids = $id;
        }

        return view('contract_manager.centro-costos.archivo', compact('centros', 'ids'));
    }

    public function getArchivadosIndex(Request $request)
    {
        $query = CentroCosto::select('id', 'clave', 'descripcion')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }

    public function archivar($id)
    {
        abort_if(Gate::denies('katbol_centro_costos_archivar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $centro = CentroCosto::find($id);
        if ($centro->archivo) {
            $centro->update([
                'archivo' => false,
            ]);
        } else {
            $centro->update([
                'archivo' => true,
            ]);
        }

        return redirect('/contract_manager/centro-costos');
    }
}

<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\Sucursal;
use Gate;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('katbol_sucursales_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sucursales = Sucursal::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', false)->get();
        $sucursales_id = Sucursal::get()->pluck('id');
        $ids = [];

        foreach ($sucursales_id as $id) {
            $ids = $id;
        }

        return view('contract_manager.sucursales.index', compact('sucursales', 'ids'));
    }

    public function getSucursalesIndex(Request $request)
    {
        $query = Sucursal::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', false)->get();

        return datatables()->of($query)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('katbol_sucursales_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('contract_manager.sucursales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $sucursales = new Sucursal();
            $sucursales->descripcion = $request->descripcion;
            $sucursales->rfc = $request->rfc;
            $sucursales->empresa = $request->empresa;
            $sucursales->cuenta_contable = $request->cuenta_contable;
            $sucursales->zona = $request->zona;
            $sucursales->direccion = $request->direccion;

            $file = $request->file('mylogo');

            if ($file != null) {
                $nombre = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(base_path('public/razon_social'), $nombre);
                $sucursales->mylogo = $nombre;
                $sucursales->save();
            }
            DB::commit();

            return redirect('/contract_manager/sucursales');
        } catch (QueryException $e) {
            DB::rollback();
            return "Error al insertar el proveedor: " . $e->getMessage();
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
        abort_if(Gate::denies('katbol_sucursales_modificar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sucursales = Sucursal::find($id);

        return view('contract_manager.sucursales.edit', compact('sucursales'));
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
            'rfc' => 'required',
            'empresa' => 'required',
            'cuenta_contable' => 'required',
            'zona' => 'required',
            'direccion' => 'required',
            'mylogo' => 'required',
        ]);
        $sucursal = Sucursal::find($id);

        $file = $request->file('mylogo');

        if ($file != null) {
            $nombre = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(base_path('public/razon_social'), $nombre);

            $sucursal->update([
                'descripcion' => $request->descripcion,
                'rfc' => $request->rfc,
                'empresa' => $request->empresa,
                'cuenta_contable' => $request->cuenta_contable,
                'estado' => $request->estado,
                'zona' =>  $request->zona,
                'direccion' =>  $request->direccion,
                'mylogo' =>   $nombre,
            ]);
        }

        return redirect('/contract_manager/sucursales');
    }

    /**
     * Remove the specified resource from storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function archivar($id)
    {
        abort_if(Gate::denies('katbol_sucursales_archivar'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $sucursal = Sucursal::find($id);
        if ($sucursal->archivo === false) {
            $sucursal->update([
                'archivo' => true,
            ]);
        } else {
            $sucursal->update([
                'archivo' => false,
            ]);
        }

        return redirect('/contract_manager/sucursales');
    }

    public function view_archivados()
    {
        $sucursales = Sucursal::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', true)->get();
        $sucursales_id = Sucursal::get()->pluck('id');
        $ids = [];

        foreach ($sucursales_id as $id) {
            $ids = $id;
        }

        return view('contract_manager.sucursales.archivo', compact('sucursales', 'ids'));
    }

    public function getArchivadosIndex(Request $request)
    {
        $query = Sucursal::select('id', 'clave', 'descripcion', 'rfc', 'empresa', 'cuenta_contable', 'estado', 'zona', 'archivo', 'direccion', 'mylogo')->where('archivo', true)->get();

        return datatables()->of($query)->toJson();
    }
}

<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\HistoricoCedulaCumplimiento;
use Illuminate\Http\Request;

class HistoricoCedulaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($cedula_id)
    {
        $items_historico = HistoricoCedulaCumplimiento::where('id_cedula', '=', $cedula_id)->paginate(10);

        return view('livewire.cedula-cumplimiento.historico-component', compact('items_historico'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CedulaCumplimientoHistorico  $cedulaCumplimientoHistorico
     * @return \Illuminate\Http\Response
     */
    public function show(CedulaCumplimientoHistorico $cedulaCumplimientoHistorico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CedulaCumplimientoHistorico  $cedulaCumplimientoHistorico
     * @return \Illuminate\Http\Response
     */
    public function edit(CedulaCumplimientoHistorico $cedulaCumplimientoHistorico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CedulaCumplimientoHistorico  $cedulaCumplimientoHistorico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CedulaCumplimientoHistorico $cedulaCumplimientoHistorico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CedulaCumplimientoHistorico  $cedulaCumplimientoHistorico
     * @return \Illuminate\Http\Response
     */
    public function destroy(CedulaCumplimientoHistorico $cedulaCumplimientoHistorico)
    {
        //
    }
}

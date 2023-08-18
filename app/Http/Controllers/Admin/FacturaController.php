<?php

namespace App\Http\Controllers\admin;

use App\Models\ContractManager\Contrato;
use App\Models\Factura;
use App\Models\FacturaFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;

class FacturaController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $factura = new Factura;
        $factura->no_factura = $request['no_factura'];
        $factura->periodo = $request['periodo'];
        $factura->fecha_recepcion = $request['fecha_recepcion'];
        $factura->no_revisiones = $request['no_revisiones'];
        $factura->cumple = $request['cumple'];
        $factura->firma = $request['firma'];
        $factura->conformidad = $request['conformidad'];
        $factura->n_cxl = $request['n_cxl'];
        $factura->fecha_liberacion = $request['fecha_liberacion'];
        $factura->monto_factura = $request['monto_factura'];
        $factura->no_pagos = $request['no_pagos'];
        $factura->perioricidad_pago = $request['perioricidad_pago'];
        $factura->fecha_inicio_pago = $request['fecha_inicio_pago'];
        $factura->save();

        $xml = $request->file('xml');
        $pdf = $request->file('pdf');
        //$dataImg = $file->get();
        $nombrex = $xml->getClientOriginalName();
        $nombrep = $pdf->getClientOriginalName();

        Storage::disk('facturas')->put('pdf/', $pdf);
        Storage::disk('facturas')->put('xml/', $xml);

        $facturafile = new FacturaFile;
        $facturafile->pdf = $nombrep;
        $facturafile->xml = $nombrex;
        $facturafile->factura_id = $factura->id;
        $facturafile->save();

        //dd($factura, $facturafile, $nombrep, $nombrex);
        notify()->success('¡Se ha registrado satisfactoriamente el contrato!');

        return redirect(route('contratos.create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }

    public function ContratoInsert($id)
    {
        // dd($id);
        $contrato = Contrato::find($id);

        return view('admin.facturas.index')
            ->with('ids', $id)
            ->with('contratos', $contrato);
    }
}

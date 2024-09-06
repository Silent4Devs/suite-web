<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\Factura;
use App\Models\ContractManager\FacturaFile;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

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
        // notify()->success('¡Se ha registrado satisfactoriamente el contrato!');

        return redirect(route('contratos.create'));
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }

    public function ContratoInsert($id)
    {
        try {
            abort_if(Gate::denies('katbol_contratos_agregar'), Response::HTTP_FORBIDDEN, '403 Forbidden');

            $contrato = Contrato::find($id);

            if (! $contrato) {
                abort(404);
            }

            return view('admin.facturas.index')
                ->with('ids', $id)
                ->with('contratos', $contrato);
        } catch (\Throwable $th) {
            abort(404);
        }
    }
}

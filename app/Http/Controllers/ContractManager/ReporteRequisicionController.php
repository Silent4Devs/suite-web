<?php

namespace App\Http\Controllers\ContractManager;

use App\Exports\ContratosExport;
use App\Http\Controllers\Controller;
use App\Models\ContractManager\AmpliacionContrato as KatbolAmpliacionContrato;
use App\Models\ContractManager\CedulaCumplimiento as KatbolCedulaCumplimiento;
use App\Models\ContractManager\CierreContrato as KatbolCierreContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual as KatbolEntregaMensual;
use App\Models\ContractManager\Factura as KatbolFactura;
use App\Models\ContractManager\NivelesServicio as KatbolNivelesServicio;
use App\Models\ContractManager\Proveedores as KatbolProveedores;
use App\Models\Organizacion;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

class ReporteRequisicionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('katbol_reportes_requisicion_acceso'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $proveedores = KatbolProveedores::get();
        $contratos = Contrato::getAll();

        $organizacion = Organizacion::getFirst();

        $logotipo = DB::table('organizacions')->get('logotipo');

        if (empty($organizacion)) {
            $count = Organizacion::getAll()->count();
            $empty = false;

            return view('contract_manager.reportes.index', compact('organizacion', 'proveedores', 'contratos'))->with('organizacion', $organizacion)->with('count', $count)->with('empty', $empty);
        } else {
            $empty = true;
            $count = Organizacion::getAll()->count();

            return view('contract_manager.reportes.index', compact('organizacion', 'proveedores', 'contratos'))->with('organizacion', $organizacion)->with('count', $count)->with('empty', $empty)->with('logotipo', $logotipo[0]);
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function show(Reporte $reporte)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reporte  $reporte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reporte $reporte)
    {
        //
    }

    public function ExcelContratos(Request $request)
    {
        return Excel::download(new ContratosExport($request->id), 'Reporte '.$request->id.'-'.Carbon::now()->format('Y-m-D').'.xlsx');
    }

    public function AjaxRequestProveedores(Request $request)
    {
        $input = $request->all();
        $proveedor_seleccionado = KatbolProveedores::where('id', '=', $request->valor)->get();

        $contratos_de_proveedor = Contrato::where('proveedor_id', '=', $request->valor)->get();

        $hoy = date('d/m/y');

        $reporte_generado = view('contract_manager.reportes.proveedor_template', compact('proveedor_seleccionado', 'contratos_de_proveedor', 'hoy', 'input'))->render();

        return response()->json($reporte_generado, 200);
    }

    public function AjaxRequestContratos(Request $request)
    {
        $input = $request->all();

        $contrato_seleccionado = Contrato::where('id', '=', $request->valor)->get();

        $cedula_cumplimiento = KatbolCedulaCumplimiento::where('contrato_id', '=', $request->valor)->get();

        $facturas_de_contrato = KatbolFactura::where('contrato_id', '=', $request->valor)->get();
        $niveles_de_contrato = KatbolNivelesServicio::where('contrato_id', '=', $request->valor)->get();
        $entregables_de_contrato = KatbolEntregaMensual::where('contrato_id', '=', $request->valor)->get();
        $cierre_de_contrato = KatbolCierreContrato::where('contrato_id', '=', $request->valor)->get();
        $ampliacion_de_contrato = KatbolAmpliacionContrato::where('contrato_id', '=', $request->valor)->get();

        $hoy = date('d/m/y');

        $reporte_generado = view('contract_manager.reportes.contrato_template', compact('proveedor_seleccionado', 'contratos_de_proveedor', 'hoy', 'input'))->render();

        return response()->json($reporte_generado, 200);
    }
}

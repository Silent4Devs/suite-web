<?php

namespace App\Http\Controllers\ContractManager;

use App\Exports\ContratosExport;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Gate;
use Illuminate\Http\Request;
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

        return view('contract_manager.reportes.index');
    }

    public function ExcelContratos(Request $request)
    {
        return Excel::download(new ContratosExport($request->id), 'Reporte '.$request->id.'-'.Carbon::now()->format('Y-m-D').'.xlsx');
    }
}

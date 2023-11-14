<?php

namespace App\Http\Controllers\ContractManager;

use App\Http\Controllers\Controller;
use App\Models\ContractManager\CedulaCumplimiento;
use App\Models\ContractManager\CierreContrato;
use App\Models\ContractManager\Contrato;
use App\Models\ContractManager\EntregaMensual;
use App\Models\ContractManager\Factura;
use App\Models\ContractManager\Proveedores;
use App\Models\TimesheetCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Contratos = Contrato::getAll();
        //select count(*) from cedula_cumplimiento left join contratos on cedula_cumplimiento.contrato_id = contratos.id where cedula_cumplimiento.deleted_at is null
        //and contratos.deleted_at is null;
        //contadores
        // ...

        $topten = DB::table('timesheet_clientes')
            ->leftJoin('contratos', 'timesheet_clientes.id', '=', 'contratos.proveedor_id')
            ->selectRaw('COUNT(contratos.id) AS totalcontrato, timesheet_clientes.nombre, timesheet_clientes.id')
            ->whereNull('contratos.deleted_at')
            ->groupBy('timesheet_clientes.id', 'timesheet_clientes.nombre')
            ->orderBy('id', 'desc')
            ->limit(10)
            ->offset(0)
            ->get();

        $vigente = CedulaCumplimiento::leftjoin('contratos', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')
            ->whereNull('cedula_cumplimiento.deleted_at')
            ->where('contratos.deleted_at', '=', null)
            ->where('estatus', '=', 'vigente')
            ->get();

        //dd($vigente);

        $cerrado = CedulaCumplimiento::leftjoin('contratos', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')
            ->whereNull('cedula_cumplimiento.deleted_at')
            ->where('contratos.deleted_at', '=', null)
            ->where('estatus', '=', 'Cerrado')
            ->get();

        $renovacion = CedulaCumplimiento::leftjoin('contratos', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')
            ->whereNull('cedula_cumplimiento.deleted_at')
            ->where('contratos.deleted_at', '=', null)
            ->where('estatus', '=', 'renovaciones')
            ->get();

        //\DB::enableQueryLog();
        $nocumple = CedulaCumplimiento::leftjoin('contratos', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')->whereNull('cumple')
            ->orWhere('cumple', '=', '0')->where('contratos.deleted_at', '=', null)
            ->count();
        //dd(\DB::getQueryLog());
        //
        $cumple = CedulaCumplimiento::leftjoin('contratos', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')->where('cumple', '=', '1')
            ->where('contratos.deleted_at', '=', null)
            ->count();

        //
        $total = CedulaCumplimiento::leftjoin('contratos', 'contratos.id', '=', 'cedula_cumplimiento.contrato_id')->whereNull('cedula_cumplimiento.deleted_at')
            ->where('contratos.deleted_at', '=', null)
            ->count();

        $totalVig = $vigente->count();
        // dd($vigente);
        $totalCer = $cerrado->count();
        $totalRev = $renovacion->count();
        //Grafica 1
        $fabricaDes = $Contratos->where('tipo_contrato', Contrato::FabricaDesarrollo);

        $totalfabricaDes = $fabricaDes->count();
        $fabricaPrue = $Contratos->where('tipo_contrato', Contrato::FabricaPruebas);
        $totalfabricaPrue = $fabricaPrue->count();
        $telecom = $Contratos->where('tipo_contrato', Contrato::Telecomunicaciones)->count();
        $SeguridadInfo = $Contratos->where('tipo_contrato', Contrato::SeguridadInfo)->count();
        $Infraestructura = $Contratos->where('tipo_contrato', Contrato::Infraestructura)->count();
        $ServNube = $Contratos->where('tipo_contrato', Contrato::ServNube)->count();
        $ServCNorm = $Contratos->where('tipo_contrato', Contrato::ServCNorm)->count();
        $ArrenEqui = $Contratos->where('tipo_contrato', Contrato::ArrenEqui)->count();
        $AdqBien = $Contratos->where('tipo_contrato', Contrato::AdqBien)->count();
        $Soporte = $Contratos->where('tipo_contrato', Contrato::Soporte)->count();
        $Impresion = $Contratos->where('tipo_contrato', Contrato::Impresion)->count();
        $Licencia = $Contratos->where('tipo_contrato', Contrato::Licencia)->count();
        $Administrativo = $Contratos->where('tipo_contrato', Contrato::Administrativo)->count();
        $AdquisicionPapeleria = $Contratos->where('tipo_contrato', Contrato::AdquisicionPapeleria)->count();
        $ServiciosConsultoria = $Contratos->where('tipo_contrato', Contrato::ServiciosConsultoria)->count();
        $ServiciosMedicos = $Contratos->where('tipo_contrato', Contrato::ServiciosMedicos)->count();
        $ServicioSeguros = $Contratos->where('tipo_contrato', Contrato::ServicioSeguros)->count();
        $MantenimientoEdificio = $Contratos->where('tipo_contrato', Contrato::MantenimientoEdificio)->count();
        $SeguridadyVigilancia = $Contratos->where('tipo_contrato', Contrato::SeguridadyVigilancia)->count();
        $ServiciodeLimpieza = $Contratos->where('tipo_contrato', Contrato::ServiciodeLimpieza)->count();
        $ServiciosdeAlimentos = $Contratos->where('tipo_contrato', Contrato::ServiciosdeAlimentos)->count();
        $EducacionContinua = $Contratos->where('tipo_contrato', '=', 'EducacionContinua')->count();
        $AdquisiciónPruebasCOVID = $Contratos->where('tipo_contrato', Contrato::AdquisiciónPruebasCOVID)->count();
        $AdquisiciónMascarillas = $Contratos->where('tipo_contrato', Contrato::AdquisiciónMascarillas)->count();
        $Restauracion = $Contratos->where('tipo_contrato', '=', 'Restauracion')->count();
        $Servicio = $Contratos->where('tipo_contrato', '=', 'Servicio')->count();
        $Abastecimiento = $Contratos->where('tipo_contrato', '=', 'Abastecimiento')->count();

        $Otro = $Contratos->where('tipo_contrato', Contrato::Otro)->count();

        //grafica 2
        $renovacion = $Contratos->where('fase', Contrato::renovacion)->count();
        $solicituCont = $Contratos->where('fase', Contrato::solicituCont)->count();
        $autorizacion = $Contratos->where('fase', Contrato::autorizacion)->count();
        $negociacion = $Contratos->where('fase', Contrato::negociacion)->count();
        $aprobacion = $Contratos->where('fase', Contrato::aprobacion)->count();
        $ejecucion = $Contratos->where('fase', Contrato::ejecucion)->count();
        $gestionOb = $Contratos->where('fase', Contrato::gestionOb)->count();
        $modifCont = $Contratos->where('fase', Contrato::modifCont)->count();
        $auditRep = $Contratos->where('fase', Contrato::auditRep)->count();

        $DashboardTipoContrato = [
            'fabrica_desarrollo' => $totalfabricaDes,
            'fabrica_pruebas' => $totalfabricaPrue,
            'telecomunicaciones' => $telecom,
            'seguridad_informacion' => $SeguridadInfo,
            'Infraestructura' => $Infraestructura,
            'servicio_nube' => $ServNube,
            'servicio_norma' => $ServCNorm,
            'arrendamiento_equipo' => $ArrenEqui,
            'Adquisición de bienes' => $AdqBien,
            'Soporte' => $Soporte,
            'impresion' => $Impresion,
            'licencia' => $Licencia,
            'administrativo' => $Administrativo,
            'adquisicion_de_papeleria' => $AdquisicionPapeleria,
            'servicios_de_consultoria' => $ServiciosConsultoria,
            'servicios_medicos' => $ServiciosMedicos,
            'servicio_de_seguros' => $ServicioSeguros,
            'mantenimiento_de_edificio' => $MantenimientoEdificio,
            'seguridad_y_vigilancia' => $SeguridadyVigilancia,
            'servicio_de_limpieza' => $ServiciodeLimpieza,
            'servicios_de_alimentos' => $ServiciosdeAlimentos,
            'educacion_continua' => $EducacionContinua,
            'adquisicion_de_pruebas_covid' => $AdquisiciónPruebasCOVID,
            'adquisicion_de_mascarillas' => $AdquisiciónMascarillas,
            'restauracion' => $Restauracion,
            'servicio' => $Servicio,
            'abastecimiento' => $Abastecimiento,
            'otro' => $Otro,
        ];

        $DashboardCicloVida = [
            'renovacion' => $renovacion,
            'solicitud_contrato' => $solicituCont,
            'autorizacion' => $autorizacion,
            'negociacion' => $negociacion,
            'aprobacion' => $aprobacion,
            'ejecucion' => $ejecucion,
            'gestionOb' => $gestionOb,
            'modif_contrato' => $modifCont,
            'auditoria_reportes' => $auditRep,
        ];
        //dd($DashboardCicloVida);
        $totales = 'SELECT COUNT(contratos.id) AS totalcontrato, timesheet_clientes.nombre, timesheet_clientes.id
                    FROM timesheet_clientes
                    LEFT JOIN contratos ON timesheet_clientes.id = contratos.proveedor_id
                    WHERE contratos.deleted_at IS NULL
                    GROUP BY timesheet_clientes.id, timesheet_clientes.nombre
                    LIMIT 10 OFFSET 0';

        $topten = DB::select($totales);
        // dd($topten);
        $suma = 'SELECT COUNT(contratos.id) as totalcontrato, timesheet_clientes.nombre, timesheet_clientes.id
                FROM contratos
                INNER JOIN timesheet_clientes
                ON timesheet_clientes.id = contratos.proveedor_id
                INNER JOIN cedula_cumplimiento
                ON cedula_cumplimiento.contrato_id = contratos.id
                WHERE (cedula_cumplimiento.cumple IS NULL OR cedula_cumplimiento.cumple::INTEGER = 0)
                AND contratos.deleted_at IS NULL
                GROUP BY timesheet_clientes.id, timesheet_clientes.nombre
                LIMIT 10 OFFSET 0';

        $topnocumpletot = DB::select($suma);

        $clientes = TimesheetCliente::get();

        return view('contract_manager.dashboard.index', compact('total', 'totalVig', 'totalCer', 'totalRev', 'DashboardTipoContrato', 'DashboardCicloVida', 'nocumple', 'cumple', 'topten', 'topnocumpletot', 'clientes'));
    }

    // ajax
    public function AjaxRequestClientes(Request $request)
    {
        $input = $request->all();
        $clientes = TimesheetCliente::where('id', '=', $request->valor)->get();
        $clientesContratos = Contrato::where('proveedor_id', '=', $request->valor)->get();

        $res = '
            <div class="col l12">
                <div class="ct-chart card z-depth-2 border-radius-6">
                    <div class="card-content m-3">
                    ';
        foreach ($clientes as $cliente) {
            $sec1 = '

                    <h4 class="card-title graficas_titulos graficas_titulo1">'.$cliente->nombre.'</h4>
                    <div class="row">
                        <div class="col m6">
                            <strong>ID: </strong>'.$cliente->id.'
                        </div>
                        <div class="col m6">
                            <strong>Razón social: </strong>'.$cliente->razon_social.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6">
                            <strong>Nombre comercial: </strong>'.$cliente->nombre.'
                        </div>
                        <div class="col m6">
                            <strong>RFC: </strong>'.$cliente->rfc.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6">
                            <strong>Dirección: </strong>'.$cliente->calle.', '.$cliente->colonia.', '.$cliente->ciudad.'
                        </div>
                        <div class="col m6">
                            <strong>Código postal: </strong>'.$cliente->codigo_postal.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6">
                            <strong>Teléfono: </strong>'.$cliente->telefono.'
                        </div>
                        <div class="col m6">
                            <strong>Página web: </strong>'.$cliente->pagina_web.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6">
                            <strong>Nombre completo: </strong>'.$cliente->nombre_completo.'
                        </div>
                        <div class="col m6">
                            <strong>Puesto: </strong>'.$cliente->puesto.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6">
                            <strong>Correo: </strong>'.$cliente->correo.'
                        </div>
                        <div class="col m6">
                            <strong>Celular: </strong>'.$cliente->celular.'
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6">
                            <strong>Descripción: </strong>'.$cliente->objeto_descripcion.'
                        </div>
                        <div class="col m6">
                            <strong>Cobertura: </strong>'.$cliente->cobertura.'
                        </div>
                    </div>

                    ';
            $res .= $sec1;
        }
        $sec2 = '
            </div>
            </div>
            </div>
            ';
        $res .= $sec2;
        $sec3 = '
            <div class="col s12 select_ajax_live">
                <div class="card">
                    <div class="card-content m-3">
                        <h4 class="card-title graficas_titulos graficas_titulo2">
                           Contratos
                        </h4>

                        <p style="padding:10px 15px; font-size:13px;"><strong>Instrucciones<span style="color:red">*</span>: </strong>
                            Selecciona el <strong>contrato</strong> dando clic en la siguiente lista desplegable.
                        </p>
                        <select searchable="Buscar..." name="contrato" id="contrato" onchange="buscarcontrato()" class="" style="opacity:1 !important;">
                            <option value="" selected disabled>Seleccione un contrato</option>
            ';
        $res .= $sec3;
        foreach ($clientesContratos as $clienteContrato) {
            $sec4 =
                '<option value="'.$clienteContrato->id.'">Contrato: '.$clienteContrato->no_contrato.' '.$clienteContrato->nombre_servicio.' </option>
                ';
            $res .= $sec4;
        }
        $sec5 = '

                        </select>
                    </div>
                </div
            </div>

            ';
        $res .= $sec5;

        return response()->json($res, 200);
    }

    public function AjaxRequestContratos(Request $request)
    {
        $input = $request->all();
        // $entregables = DB::table('entregas_mensuales')
        //     ->join('contratos', 'entregas_mensuales.contrato_id', '=', 'contratos.id')
        //     ->join('proveedores', 'proveedores.id', '=', 'contratos.proveedor_id')
        //     ->select(
        //         'entregas_mensuales.contrato_id',
        //         'entregas_mensuales.id as entrega_id',
        //         'entregas_mensuales.nombre_entregable',
        //         'entregas_mensuales.plazo_entrega_termina',
        //         'entregas_mensuales.entrega_real',
        //         'entregas_mensuales.no as no_entrega',
        //         'contratos.id as contrato_id',
        //         'contratos.proveedor_id',
        //         'proveedores.nombre',
        //         'proveedores.id as proveedor_id'
        //     )
        //     ->where('contratos.id', '=', $input['contratoq'])
        //     ->get()->toArray();

        $entregables = EntregaMensual::select(
            'entregas_mensuales.contrato_id',
            'entregas_mensuales.id as entrega_id',
            'entregas_mensuales.nombre_entregable',
            'entregas_mensuales.plazo_entrega_termina',
            'entregas_mensuales.entrega_real',
            'entregas_mensuales.no as no_entrega',
            'contratos.id as contrato_id',
            'contratos.proveedor_id',
            'timesheet_clientes.nombre',
            'timesheet_clientes.id as proveedor_id'
        )
            ->join('contratos', 'entregas_mensuales.contrato_id', '=', 'contratos.id')
            ->join('timesheet_clientes', 'timesheet_clientes.id', '=', 'contratos.proveedor_id')
            ->where('contratos.id', '=', $input['contratoq'])
            ->get()->toArray();

        // $facturas_recibidas = DB::table('facturacion')
        //     ->join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
        //     ->join('proveedores', 'proveedores.id', '=', 'contratos.proveedor_id')
        //     ->where('facturacion.contrato_id', '=', $input['contratoq'])
        //     ->where('facturacion.estatus', '=', 'recibido')
        //     ->get();

        $facturas_recibidas = Factura::join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
            ->join('timesheet_clientes', 'timesheet_clientes.id', '=', 'contratos.proveedor_id')
            ->where('facturacion.contrato_id', '=', $input['contratoq'])
            ->where('facturacion.estatus', '=', 'recibido')
            ->count();

        // $facturas_progreso = DB::table('facturacion')
        //     ->join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
        //     ->join('proveedores', 'proveedores.id', '=', 'contratos.proveedor_id')
        //     ->where('facturacion.contrato_id', '=', $input['contratoq'])
        //     ->where('facturacion.estatus', '=', 'progreso')
        //     ->get();

        $facturas_progreso = Factura::join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
            ->join('timesheet_clientes', 'timesheet_clientes.id', '=', 'contratos.proveedor_id')
            ->where('facturacion.contrato_id', '=', $input['contratoq'])
            ->where('facturacion.estatus', '=', 'progreso')
            ->count();

        // $facturas_pagadas = DB::table('facturacion')
        //     ->join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
        //     ->join('proveedores', 'proveedores.id', '=', 'contratos.proveedor_id')
        //     ->where('facturacion.contrato_id', '=', $input['contratoq'])
        //     ->where('facturacion.estatus', '=', 'pagada')
        //     ->get();

        $facturas_pagadas = Factura::join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
            ->join('timesheet_clientes', 'timesheet_clientes.id', '=', 'contratos.proveedor_id')
            ->where('facturacion.contrato_id', '=', $input['contratoq'])
            ->where('facturacion.estatus', '=', 'pagada')
            ->count();

        $facturas = Factura::join('contratos', 'facturacion.contrato_id', '=', 'contratos.id')
            // ->select('facturacion.contrato_id','facturacion.no_factura', 'facturacion.cumple', 'facturacion.monto_factura', 'facturacion.estatus')
            ->where('facturacion.contrato_id', '=', $input['contratoq'])->get();
        $cumple_factura = DB::table('facturacion')
            ->where('contrato_id', '=', $input['contratoq'])
            ->where('cumple', '=', 1)
            ->count();

        $no_cumple_factura = DB::table('facturacion')
            ->where('contrato_id', '=', $input['contratoq'])
            ->where('cumple', '=', 0)
            ->count();

        $cierre_contrato = CierreContrato::where('contrato_id', '=', $input['contratoq'])->get()->toArray();
        // $niveles_servicio = DB::table('niveles_servicio')
        //     ->join('evaluacion_servicio', 'niveles_servicio.id', '=', 'evaluacion_servicio.servicio_id')
        //     ->where('contrato_id', '=', $input['contratoq'])
        //     ->select(array(
        //         'niveles_servicio.*',
        //         DB::raw('AVG(evaluacion_servicio.promedio) as p_general'),
        //     ))
        //     ->groupBy('evaluacion_servicio.servicio_id')
        //     ->get();

        $niveles_servicio = DB::table('niveles_servicio')
            ->join('evaluacion_servicio', 'niveles_servicio.id', '=', 'evaluacion_servicio.servicio_id')
            ->where('contrato_id', '=', $input['contratoq'])
            ->select([
                'niveles_servicio.*',
                DB::raw('ROUND(AVG(CAST(evaluacion_servicio.promedio AS NUMERIC)), 2) as p_general'),
            ])
            ->groupBy('evaluacion_servicio.id', 'niveles_servicio.id')
            ->get();

        $resc = '';

        return response()->json([
            'html' => $resc,
            'dato' => $entregables,
            'facturacion' => [
                'facturas' => $facturas,
                'recibidas' => $facturas_recibidas,
                'progreso' => $facturas_progreso,
                'pagadas' => $facturas_pagadas,
            ],
            'cierre' => $cierre_contrato,
            'niveles_servicio' => $niveles_servicio,
        ]);
    }

    public function AjaxRequestEvaluacionesServicio(Request $request)
    {
        $input = $request->all();
        $evaluacion_servicio = DB::table('evaluacion_servicio')
            ->join('niveles_servicio', 'evaluacion_servicio.servicio_id', '=', 'niveles_servicio.id')
            ->select([
                'evaluacion_servicio.*',
                'niveles_servicio.meta',
            ])
            ->where('servicio_id', '=', $input['servicio_id'])->get();
        $data = ['historico' => $evaluacion_servicio];

        return response()->json($data);
    }
}

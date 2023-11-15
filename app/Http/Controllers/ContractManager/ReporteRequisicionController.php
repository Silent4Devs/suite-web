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
        $contratos = Contrato::get();

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

        foreach ($proveedor_seleccionado as $it_proveedor) {
            $reporte_generado = '

                    <div class="card-content">
                        <table class="encabezado">
                            <thead>
                                <tr>
                                    <th><div class="logo_organizacion"></div></th>
                                    <th><font style="font-weight: lighter;">Ficha de proveedor:</font> <br> <font>'.$it_proveedor->nombre_comercial.'</font></th>
                                    <th>'.$hoy.'</th>
                                </tr>
                            </thead>
                        </table>

                        <h1>DATOS GENERALES</h1>
                        <table class="line_dato">
                            <tr>
                                <th>Razón  social</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->razon_social.'</div></td>
                            </tr>
                        </table>
                        <table class="line_dato">
                            <tr>
                                <th> Nombre comercial del proveedor</th>
                                <th> RFC persona moral o persona física</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->nombre_comercial.'</div></td>
                                <td><div>'.$it_proveedor->rfc.'</div></td>
                            </tr>
                        </table>

                        <h1>DOMICILIO FISCAL</h1>
                        <table class="line_dato">
                            <tr>
                                <th>Calle y número</th>
                                <th>Colonia</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->calle.'</div></td>
                                <td><div>'.$it_proveedor->colonia.'</div></td>
                            </tr>
                        </table>

                        <table class="line_dato">
                            <tr>
                                <th>Ciudad o municipio/ país</th>
                                <th>Código postal</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->ciudad.'</div></td>
                                <td><div>'.$it_proveedor->codigo_postal.'</div></td>
                            </tr>
                        </table>

                        <table class="line_dato">
                            <tr>
                                <th>Teléfono</th>
                                <th>Página web</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->telefono.'</div></td>
                                <td><div>'.$it_proveedor->pagina_web.'</div></td>
                            </tr>
                        </table>

                        <h1>DATOS DEL CONTACTO</h1>
                        <table class="line_dato">
                            <tr>
                                <th>Nombre completo del contacto</th>
                                <th>Puesto </th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->nombre_completo.'</div></td>
                                <td><div>'.$it_proveedor->puesto.' </div></td>
                            </tr>
                        </table>

                        <table class="line_dato">
                            <tr>
                                <th> Correo electrónico</th>
                                <th>Celular </th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->correo.'</div></td>
                                <td><div>'.$it_proveedor->celular.' </div></td>
                            </tr>
                        </table>

                        <h1>DATOS COMPLEMENTARIOS</h1>
                        <table class="line_dato">
                            <tr>
                                <th>Objeto social / descripción del servicio o producto</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->objeto_descripcion.'</div></td>
                            </tr>
                        </table>

                        <table class="line_dato">
                            <tr>
                                <th>Cobertura, rango geográfico en el cual presta los servicios</th>
                            </tr>
                            <tr>
                                <td><div>'.$it_proveedor->cobertura.'</div></td>
                            </tr>
                        </table>



                        <h1>CONTRATO</h1>
                        <table class="tabla">
                            <tr>
                                <th>N° contrato</th>
                                <th>Nombre del servicio</th>
                                <th>Tipo de contrato</th>
                                <th>Vigencia</th>
                                <th>Fecha inicio</th>
                                <th>Fecha fin</th>
                                <th>Estatus</th>
                                <th>Fase</th>
                                <th>Monto</th>
                            </tr>';
            if (! empty($contratos_de_proveedor)) {
                foreach ($contratos_de_proveedor as $it_contrato_de_proveedor) {
                    $r1 = '

                                    <tr>
                                        <td>'.$it_contrato_de_proveedor->no_contrato.'</td>
                                        <td>'.$it_contrato_de_proveedor->nombre_servicio.'</td>
                                        <td>'.$it_contrato_de_proveedor->tipo_contrato.'</td>
                                        <td>'.$it_contrato_de_proveedor->vigencia_contrato.'</td>
                                        <td>'.$it_contrato_de_proveedor->fecha_inicio.'</td>
                                        <td>'.$it_contrato_de_proveedor->fecha_fin.'</td>
                                        <td>'.$it_contrato_de_proveedor->estatus.'</td>
                                        <td>'.$it_contrato_de_proveedor->fase.'</td>
                                        <td>$'.number_format($it_contrato_de_proveedor->monto_pago, 2).'</td>
                                    </tr>';
                    $reporte_generado .= $r1;
                }
            } else {
                $r1_1 = '<tr>
                                            <td colspan="8">No hay contratos de este proveedor</td>
                                        </tr>';
                $reporte_generado .= $r1_1;
            }
            $r2 =
                '</table>
                    </div>

            ';
            $reporte_generado .= $r2;
        }

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

        foreach ($contrato_seleccionado as $it_contrato) {
            $reporte_generado = '


                <div class="card-content">
                    <table class="encabezado">
                        <thead>
                            <tr>
                                <th><div class="logo_organizacion"></div></th>
                                <th><font style="font-weight: lighter;">Contrato:</font> <br> <font> '.$it_contrato->no_contrato.' </font></th>
                                <th>'.$hoy.'</th>
                            </tr>
                        </thead>
                    </table>

                    <h1>INFORMACIÓN GENERAL DEL CONTRATO</h1>
                    <table class="arriba_derecha">
                        <tr>
                            <td><div><font style="font-weight: bolder;">N° Contrato:</font> '.$it_contrato->no_contrato.'</div></td>
                        </tr>
                    </table>
                    <table class="line_dato">
                        <tr>
                            <th>Nombre del servicio</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->nombre_servicio.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th style="width: 30%;">Vigencia</th>
                            <th style="width: 70%;">Tipo de contrato</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->vigencia_contrato.'</div></td>
                            <td><div>'.$it_contrato->tipo_contrato.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato celda3">
                        <tr>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                            <th>Fecha firma</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->fecha_inicio.'</div></td>
                            <td><div>'.$it_contrato->fecha_fin.'</div></td>
                            <td><div>'.$it_contrato->fecha_firma.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>No. pagos</th>
                            <th>Monto de pago M.X.N.</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->no_pagos.'</div></td>
                            <td><div>$'.number_format($it_contrato->monto_pago, 2).'</div></td>

                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>Monto máximo M.X.N.</th>
                            <th>Monto mínimo M.X.N.</th>
                        </tr>
                        <tr>
                            <td><div>$'.number_format($it_contrato->maximo, 2).'</div></td>
                            <td><div>$'.number_format($it_contrato->minimo, 2).'</div></td>
                        </tr>
                    </table>

                    <h1>FIANZA/REPONSABILIDAD CIVIL</h1>
                    <table class="line_dato">
                        <tr>
                            <th>Fianza o responsabilidad civil: Número de folio</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->folio.'</div></td>
                        </tr>
                    </table>


                    <h1>RESPONSABLES</h1>
                    <table class="line_dato">
                        <tr>
                            <th>Nombre del supervisor</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->pmp_asignado.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>Puesto</th>
                            <th>Área</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->puesto.'</div></td>
                            <td><div>'.$it_contrato->area.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>Nombre del administrador</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->administrador_contrato.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>Puesto</th>
                            <th>Área</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->cargo_administrador.'</div></td>
                            <td><div>'.$it_contrato->area_administrador.'</div></td>
                        </tr>
                    </table>';

            foreach ($cedula_cumplimiento as $it_cedula) {
                if ($it_cedula->cumple == 1) {
                    $cumple_cedula_cumplimineto = 'si';
                } else {
                    $cumple_cedula_cumplimineto = 'no';
                }

                $reporte_generado_1 = '


                    <h1>CEDULA DE CUMPLIMIENTO</h1>
                    <table class="line_dato">
                        <tr>
                            <th>Elaboró el análisis </th>
                            <th>Revisó los resultados</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_cedula->elaboro.'</div></td>
                            <td><div>'.$it_cedula->reviso.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>Autorizó la cédula</th>
                            <th>Cumple</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_cedula->autorizo.'</div></td>
                            <td><div>'.strtoupper($cumple_cedula_cumplimineto).'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th>Número de folio </th>
                            <th>Documento</th>
                        </tr>
                        <tr>
                            <td><div>'.$it_contrato->folio.'</div></td>
                            <td><div>'.$it_contrato->file_contrato.'</div></td>
                        </tr>
                    </table>

                    <table class="line_dato">
                        <tr>
                            <th> Conclusiones generales </th>
                        </tr>
                        <tr>
                            <td><div>'.$it_cedula->conclusiones_generales.'</div></td>
                        </tr>
                    </table>';
                $reporte_generado .= $reporte_generado_1;
            }

            $reporte_generado_2 = '


                    <h1>FACTURACIÓN</h1>
                    <table class="tabla">
                        <tr>
                            <th>No. factura</th>
                            <th>Recepción</th>
                            <th>Liberación</th>
                            <th>No. revisiones</th>
                            <th>Cumple</th>
                            <th>Subtotal</th>
                            <th>IVA 16%</th>
                            <th>Monto factura</th>
                            <th>Estatus</th>
                        </tr>';
            $reporte_generado .= $reporte_generado_2;
            if (! empty($facturas_de_contrato)) {
                foreach ($facturas_de_contrato as $it_facturas_de_contrato) {
                    if ($it_facturas_de_contrato->cumple == 1) {
                        $cumple_factura = 'si';
                    } else {
                        $cumple_factura = 'no';
                    }

                    $factura_iva = $it_facturas_de_contrato->monto_factura / 16;

                    $subtotal_factura = $it_facturas_de_contrato->monto_factura + $factura_iva;

                    $r1 = '
                        <tr>
                            <td>'.$it_facturas_de_contrato->no_factura.'</td>
                            <td>'.$it_facturas_de_contrato->fecha_recepcion.'</td>
                            <td>'.$it_facturas_de_contrato->fecha_liberacion.'</td>
                            <td>'.$it_facturas_de_contrato->no_revisiones.'</td>
                            <td>'.$cumple_factura.'</td>
                            <td>$'.number_format($it_facturas_de_contrato->monto_factura, 2).'</td>

                            <td>$'.number_format($factura_iva, 2).'</td>
                            <td>$'.number_format($subtotal_factura, 2).' </td>
                            <td>'.$it_facturas_de_contrato->estatus.'</td>
                        </tr>';
                    $reporte_generado .= $r1;
                }
            } else {
                $r1_1 = '<tr>
                                            <td colspan="8">No hay facturas de este contrato</td>
                                        </tr>';
                $reporte_generado .= $r1_1;
            }

            $r2 =
                '</table>


                    <h1>NIVELES DE SERVICIO</h1>
                    <table class="tabla">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Periodo evaluación</th>
                            <th>Área</th>
                            <th>Evaluar</th>
                            <th>Consultar</th>
                        </tr>';
            $reporte_generado .= $r2;
            if (! empty($niveles_de_contrato)) {
                foreach ($niveles_de_contrato as $it_niveles_de_contrato) {
                    $r3 = '
                        <tr>
                            <td>'.$it_niveles_de_contrato->id.'</td>
                            <td>'.$it_niveles_de_contrato->nombre.'</td>
                            <td>'.$it_niveles_de_contrato->descripcion.'</td>
                            <td>'.$it_niveles_de_contrato->periodo_evaluacion.'</td>
                            <td>'.$it_niveles_de_contrato->area.'</td>
                            <td>'.$it_niveles_de_contrato->periodo_evaluacion.'</td>
                            <td>'.$it_niveles_de_contrato->info_consulta.'</td>
                        </tr>';
                    $reporte_generado .= $r3;
                }
            } else {
                $r3_1 = '<tr>
                                            <td colspan="8">No hay niveles de servicio de este contrato</td>
                                        </tr>';
                $reporte_generado .= $r3_1;
            }
            $r4 = '
                    </table>


                    <h1>ENTREGABLES MENSUALES</h1>
                    <table class="tabla">
                        <tr>
                            <th>Nombre entregable</th>
                            <th>Descripción</th>
                            <th>Plazo entrega inicio</th>
                            <th>Plazo entrega termina</th>
                            <th>Entrega real</th>
                            <th>Cumple</th>
                            <th>Observaciones</th>
                        </tr>';
            $reporte_generado .= $r4;

            if (! empty($entregables_de_contrato)) {
                foreach ($entregables_de_contrato as $it_entregables_de_contrato) {
                    if ($it_entregables_de_contrato->cumplimiento == 1) {
                        $cumple_entregables = 'si';
                    } else {
                        $cumple_entregables = 'no';
                    }

                    $r5 = '
                        <tr>
                            <td>'.$it_entregables_de_contrato->nombre_entregable.'</td>
                            <td>'.$it_entregables_de_contrato->descripcion.'</td>
                            <td>'.$it_entregables_de_contrato->plazo_entrega_inicio.'</td>
                            <td>'.$it_entregables_de_contrato->plazo_entrega_termina.'</td>
                            <td>'.$it_entregables_de_contrato->entrega_real.'</td>
                            <td>'.$cumple_entregables.'</td>
                            <td>'.$it_entregables_de_contrato->observaciones.'</td>
                        </tr>';
                    $reporte_generado .= $r5;
                }
            } else {
                $r5_1 = '<tr>
                                            <td colspan="8">No hay entregables mensuales de este contrato</td>
                                        </tr>';
                $reporte_generado .= $r5_1;
            }

            $r6 = '
                    </table>

                    <table class="tabla" style="margin-top: 10px;">
                        <tr>
                            <th>Nombre entregable</th>
                            <th>Aplica Deductiva/Penalización</th>
                            <th>Justificación Deductiva/Penalización</th>
                            <th>Monto Deductiva/Penalización</th>
                        </tr>';
            $reporte_generado .= $r6;

            if (! empty($entregables_de_contrato)) {
                foreach ($entregables_de_contrato as $it_entregables_de_contrato) {
                    if ($it_entregables_de_contrato->aplica_deductiva == 1) {
                        $aplica_deductiva_render = 'si';
                    } else {
                        $aplica_deductiva_render = 'no';
                    }
                    $r7 = '
                        <tr>
                            <td>'.$it_entregables_de_contrato->nombre_entregable.'</td>
                            <td>'.$aplica_deductiva_render.'</td>
                            <td>'.$it_entregables_de_contrato->justificacion_deductiva_penalizacion.'</td>
                            <td>$'.number_format(floatval($it_entregables_de_contrato->deductiva_penalizacion), 2).'</td>
                        </tr>';
                    $reporte_generado .= $r7;
                }
            }
            $r8 = '
                    </table>


                    <h1>CIERRE CONTRATO</h1>
                    <table class="tabla">
                        <tr>
                            <th>Aspectos para validación de cierre</th>
                            <th>Cumple</th>
                            <th>Observaciones</th>
                        </tr>';
            $reporte_generado .= $r8;
            if (! empty($cierre_de_contrato)) {
                foreach ($cierre_de_contrato as $it_cierre_de_contrato) {
                    if ($it_cierre_de_contrato->cumple == 1) {
                        $cumple_cierre = 'si';
                    } else {
                        $cumple_cierre = 'no';
                    }
                    $r9 = '
                        <tr>
                            <td>'.$it_cierre_de_contrato->aspectos.'</td>
                            <td>'.$cumple_cierre.'</td>
                            <td>'.$it_cierre_de_contrato->observaciones.'</td>
                        </tr>';
                    $reporte_generado .= $r9;
                }
            } else {
                $r9_1 = '<tr>
                                            <td colspan="8">No hay cierre de este contrato</td>
                                        </tr>';
                $reporte_generado .= $r9_1;
            }
            $r10 = '
                    </table>


                    <h1>AMPLIACIÓN DE CONTRATO</h1>
                    <table class="tabla">
                        <tr>
                            <th>No. Contrato</th>
                            <th>Importe</th>
                            <th>Monto total ampliado</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                        </tr>';
            $reporte_generado .= $r10;
            if (! empty($ampliacion_de_contrato)) {
                foreach ($ampliacion_de_contrato as $it_ampliacion_de_contrato) {
                    $r11 = '
                        <tr>
                            <td>'.$it_contrato->no_contrato.'</td>
                            <td>$'.number_format($it_ampliacion_de_contrato->importe, 2).'</td>
                            <td>$'.number_format($it_ampliacion_de_contrato->monto_total_ampliado, 2).'</td>
                            <td>'.$it_ampliacion_de_contrato->fecha_inicio.'</td>
                            <td>'.$it_ampliacion_de_contrato->fecha_fin.'</td>
                        </tr>';
                    $reporte_generado .= $r11;
                }
            } else {
                $ra = '<tr>
                                            <td colspan="8">No hay ampliación de contrato</td>
                                        </tr>';
                $reporte_generado .= $ra;
            }
            $r12 = '
                    </table>
                </div>


            ';
            $reporte_generado .= $r12;
        }

        return response()->json($reporte_generado, 200);
    }
}

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contrato-pdf</title>
    <link rel="preload" type="text/css" href="{{ asset('css/reports/reports_contratos_pdf.css') }}{{ config('app.cssVersion') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reports/reports_contratos_pdf.css') }}{{ config('app.cssVersion') }}" />

</head>

<body>
    @foreach ($contrato_seleccionado as $it_contrato)
            <table class="encabezado">
                <tr>
                    <td class="td-img-doc">
                        @if ($organizacion->logo)
                    <td><img src="{{ asset($organizacion->logo) }}" style="width: 100%; max-width: 150px;"></td>
                    @else
                    <td><img src="{{ asset('img/global/silent4business.png') }}"
                            style="width:150%; max-width:150px; position: relative; right: 3rem;"></td>
                    @endif
                    </td>
                    <td class="info-header">
                        <p style="margin: 5px 0;">
                            <strong style="color: #49598A;">Nombre:</strong> {{ $organizacion->empresa }}
                        </p>
                        <p style="margin: 5px 0;">
                            <strong style="color: #49598A;">Dirección:</strong>
                            {{ $organizacion->direccion }}
                        </p>
                        <p style="margin: 5px 0;">
                            <strong style="color: #49598A;">Teléfono:</strong> {{ $organizacion->telefono }}
                        </p>
                        <p style="margin: 5px 0;">
                            <strong style="color: #49598A;">Correo:</strong>
                            <a href="mailto:{{ $organizacion->correo }}"
                                style="text-decoration: none; color: #1d72b8;">{{ $organizacion->correo }}</a>
                        </p>
                        <p style="margin: 5px 0;">
                            <strong style="color: #49598A;">Página web:</strong>
                            <a href="{{ $organizacion->pagina_web }}" target="_blank"
                                style="text-decoration: none; color: #1d72b8;">{{ $organizacion->pagina_web }}</a>
                        </p>
                    </td>

                    <td class="td-blue-header">
                        <h4
                            style="font-size: 13px; color: #49598A; margin: 10px 0; font-weight: bold; text-transform: uppercase;">
                            reporte de contrato
                        </h4>
                        <p style="font-size: 14px; margin: 5px 0; color: #666;">
                            <strong>Fecha de consulta:</strong> {{ date('d/m/y') }}
                        </p>
                    </td>
                </tr>
            </table>
            <div class="n_contrato">
                <table class="arriba_derecha text-white ">
                    <tr>
                        <td>
                            <div><strong>N° Contrato:</strong> {{ $it_contrato->no_contrato }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato text-white">
                    <tr>
                        <th style="width: 33.33%;">Nombre del servicio</th>
                        <th style="width: 33.33%;">Vigencia</th>
                        <th style="width: 33.33%;">Tipo de contrato</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->nombre_servicio }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->vigencia_contrato }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->tipo_contrato }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato text-white">
                    <tr>
                        <th style="width: 33.33%;">Fecha inicio</th>
                        <th style="width: 33.33%;">Fecha fin</th>
                        <th style="width: 33.33%;">Fecha firma</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->fecha_inicio }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->fecha_fin }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->fecha_firma }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato text-white">
                    <tr>
                        <th style="width: 33.33%;">No. pagos</th>
                        <th style="width: 33.33%;">Monto de pago M.X.N.</th>
                        <th style="width: 33.33%;">Monto máximo M.X.N.</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->no_pagos }}</div>
                        </td>
                        <td>
                            <div>${{ number_format($it_contrato->monto_pago, 2) }}</div>
                        </td>
                        <td>
                            <div>${{ number_format($it_contrato->maximo, 2) }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato text-white">
                    <tr>
                        <th style="width: 50%;">Monto mínimo M.X.N.</th>
                    </tr>
                    <tr>
                        <td>
                            <div>${{ number_format($it_contrato->minimo, 2) }}</div>
                        </td>
                    </tr>
                </table>
            </div>
            <div style="background-color: #EEE;">
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>FIANZA/RESPONSABILIDAD CIVIL</strong>
                    </div>
                </div>
                <table class="line_dato">
                    <tr>
                        <th>Fianza o responsabilidad civil: Número de folio</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->folio }}</div>
                        </td>
                    </tr>
                </table>
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>RESPONSABLES</strong>
                    </div>
                </div>

                <table class="line_dato">
                    <tr>
                        <th>Nombre del supervisor</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->pmp_asignado }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Puesto</th>
                        <th>Área</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->puesto }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->area }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Nombre del administrador</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->administrador_contrato }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Puesto</th>
                        <th>Área</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->cargo_administrador }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->area_administrador }}</div>
                        </td>
                    </tr>
                </table>
            </div>


            @foreach ($cedula_cumplimiento as $it_cedula)
                @php
                    $cumple_cedula_cumplimiento = $it_cedula->cumple ? 'si' : 'no';
                @endphp

                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>CEDULA DE CUMPLIMIENTO</strong>
                    </div>
                </div>
                <table class="line_dato">
                    <tr>
                        <th>Elaboró el análisis</th>
                        <th>Revisó los resultados</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_cedula->elaboro }}</div>
                        </td>
                        <td>
                            <div>{{ $it_cedula->reviso }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Autorizó la cédula</th>
                        <th>Cumple</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_cedula->autorizo }}</div>
                        </td>
                        <td>
                            <div>{{ strtoupper($cumple_cedula_cumplimiento) }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Número de folio</th>
                        <th>Documento</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_contrato->folio }}</div>
                        </td>
                        <td>
                            <div>{{ $it_contrato->file_contrato }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Conclusiones generales</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_cedula->conclusiones_generales }}</div>
                        </td>
                    </tr>
                </table>
            @endforeach

            <div class="apartado-tablas">
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>FACTURACIÓN</strong>
                    </div>
                </div>
                <table class="tabla">

                    @forelse ($facturas_de_contrato as $it_facturas_de_contrato)
                        @php
                            $cumple_factura = $it_facturas_de_contrato->cumple == 1 ? 'si' : 'no';
                            $factura_iva = $it_facturas_de_contrato->monto_factura / 16;
                            $subtotal_factura = $it_facturas_de_contrato->monto_factura + $factura_iva;
                        @endphp
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
                        </tr>
                        <tr>
                            <td>{{ $it_facturas_de_contrato->no_factura }}</td>
                            <td>{{ $it_facturas_de_contrato->fecha_recepcion }}</td>
                            <td>{{ $it_facturas_de_contrato->fecha_liberacion }}</td>
                            <td>{{ $it_facturas_de_contrato->no_revisiones }}</td>
                            <td>{{ $cumple_factura }}</td>
                            <td>${{ number_format($subtotal_factura, 2) }}</td>
                            <td>${{ number_format($factura_iva, 2) }}</td>
                            <td>${{ number_format($it_facturas_de_contrato->monto_factura, 2) }}</td>
                            <td>{{ $it_facturas_de_contrato->estatus }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center;">No hay facturas de este contrato</td>
                        </tr>
                    @endforelse
                </table>


                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>NIVELES DE SERVICIO</strong>
                    </div>
                </div>
                <table class="tabla mt-3">
                    @forelse ($niveles_de_contrato as $it_niveles_de_contrato)
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Periodo evaluación</th>
                            <th>Área</th>
                            <th>Evaluar</th>
                            <th>Consultar</th>
                        </tr>
                        <tr>
                            <td>{{ $it_niveles_de_contrato->id }}</td>
                            <td>{{ $it_niveles_de_contrato->nombre }}</td>
                            <td>{{ $it_niveles_de_contrato->descripcion }}</td>
                            <td>{{ $it_niveles_de_contrato->periodo_evaluacion }}</td>
                            <td>{{ $it_niveles_de_contrato->area }}</td>
                            <td>{{ $it_niveles_de_contrato->evaluar }}</td>
                            <td>{{ $it_niveles_de_contrato->info_consulta }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No hay niveles de servicio de este contrato
                            </td>
                        </tr>
                    @endforelse
                </table>

                <table class="tabla mt-3">
                    @if (!empty($niveles_de_contrato))
                        @foreach ($niveles_de_contrato as $it_niveles_de_contrato)
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Periodo evaluación</th>
                                <th>Área</th>
                                <th>Evaluar</th>
                                <th>Consultar</th>
                            </tr>
                            <tr>
                                <td>{{ $it_niveles_de_contrato->id }}</td>
                                <td>{{ $it_niveles_de_contrato->nombre }}</td>
                                <td>{{ $it_niveles_de_contrato->descripcion }}</td>
                                <td>{{ $it_niveles_de_contrato->periodo_evaluacion }}</td>
                                <td>{{ $it_niveles_de_contrato->area }}</td>
                                <td>{{ $it_niveles_de_contrato->evaluar }}</td>
                                <td>{{ $it_niveles_de_contrato->info_consulta }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <th>Descripcion</th>
                        </tr>
                        <tr>
                            <td>No hay niveles de servicio de este contrato</td>
                        </tr>
                    @endif
                </table>
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>ENTREGABLES MENSUALES</strong>
                    </div>
                </div>
                <table class="tabla mt-3">

                    @forelse ($entregables_de_contrato as $it_entregables_de_contrato)
                        @php
                            $cumple_entregables = $it_entregables_de_contrato->cumplimiento == 1 ? 'si' : 'no';
                        @endphp
                        <tr>
                            <th>Nombre entregable</th>
                            <th>Descripción</th>
                            <th>Plazo entrega inicio</th>
                            <th>Plazo entrega termina</th>
                            <th>Entrega real</th>
                            <th>Cumple</th>
                            <th>Observaciones</th>
                        </tr>
                        <tr>
                            <td>{{ $it_entregables_de_contrato->nombre_entregable }}</td>
                            <td>{{ $it_entregables_de_contrato->descripcion }}</td>
                            <td>{{ $it_entregables_de_contrato->plazo_entrega_inicio }}</td>
                            <td>{{ $it_entregables_de_contrato->plazo_entrega_termina }}</td>
                            <td>{{ $it_entregables_de_contrato->entrega_real }}</td>
                            <td>{{ $cumple_entregables }}</td>
                            <td>{{ $it_entregables_de_contrato->observaciones }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No hay entregables mensuales de este contrato
                            </td>
                        </tr>
                    @endforelse
                </table>

                <table class="tabla" style="margin-top: 10px;">

                    <tr>
                        <th>Nombre entregable</th>
                        <th>Aplica Deductiva/Penalización</th>
                        <th>Justificación Deductiva/Penalización</th>
                        <th>Monto Deductiva/Penalización</th>
                    </tr>
                    @foreach ($entregables_de_contrato as $it_entregables_de_contrato)
                        @if ($it_entregables_de_contrato->aplica_deductiva == 1)
                            @php $aplica_deductiva_render = 'si'; @endphp
                        @else
                            @php $aplica_deductiva_render = 'no'; @endphp
                        @endif

                        <tr>
                            <td>{{ $it_entregables_de_contrato->nombre_entregable }}</td>
                            <td>{{ $aplica_deductiva_render }}</td>
                            <td>{{ $it_entregables_de_contrato->justificacion_deductiva_penalizacion }}</td>
                            <td>${{ number_format(floatval($it_entregables_de_contrato->deductiva_penalizacion), 2) }}
                            </td>
                        </tr>
                    @endforeach
                </table>

                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>CIERRE CONTRATO</strong>
                    </div>
                </div>
                <table class="tabla mt-3">

                    @forelse ($cierre_de_contrato as $it_cierre_de_contrato)
                    @if ($it_cierre_de_contrato->cumple == 1)
                    @php $cumple_cierre = 'si'; @endphp
                    @else
                    @php $cumple_cierre = 'no'; @endphp
                    @endif
                        <tr>
                            <th>Aspectos para validación de cierre</th>
                            <th>Cumple</th>
                            <th>Observaciones</th>
                        </tr>

                        <tr>
                            <td>{{ $it_cierre_de_contrato->aspectos }}</td>
                            <td>{{ $cumple_cierre }}</td>
                            <td>{{ $it_cierre_de_contrato->observaciones }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8">No hay cierre de este contrato</td>
                        </tr>
                    @endforelse
                </table>

                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>AMPLIACIÓN DE CONTRATO</strong>
                    </div>
                </div>
                <table class="tabla mt-3">

                    @forelse ($ampliacion_de_contrato as $it_ampliacion_de_contrato)
                        <tr>
                            <th>No. Contrato</th>
                            <th>Importe</th>
                            <th>Monto total ampliado</th>
                            <th>Fecha inicio</th>
                            <th>Fecha fin</th>
                        </tr>
                        <tr>
                            <td>{{ $it_ampliacion_de_contrato->no_contrato }}</td>
                            <td>${{ number_format($it_ampliacion_de_contrato->importe, 2) }}</td>
                                <td>${{ number_format($it_ampliacion_de_contrato->monto_total_ampliado, 2) }}</td>
                                <td>{{ $it_ampliacion_de_contrato->fecha_inicio }}</td>
                                <td>{{ $it_ampliacion_de_contrato->fecha_fin }}</td>
                            </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No hay ampliación de contrato</td>
                        </tr>
                    @endforelse
                </table>
            </div>

    @endforeach
</body>

</html>

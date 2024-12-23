@foreach ($contrato_seleccionado as $it_contrato)
    <div class="card-content">
        <table class="encabezado">
            <thead>
                <tr>
                    <th>
                        <div class="logo_organizacion"></div>
                    </th>
                    <th>
                        <span style="font-weight: lighter;">Contrato:</span> <br>
                        <span>{{ $it_contrato->no_contrato }}</span>
                    </th>
                    <th>{{ $hoy }}</th>
                </tr>
            </thead>
        </table>

        <h1>INFORMACIÓN GENERAL DEL CONTRATO</h1>
        <table class="arriba_derecha">
            <tr>
                <td>
                    <div><strong>N° Contrato:</strong> {{ $it_contrato->no_contrato }}</div>
                </td>
            </tr>
        </table>

        <table class="line_dato">
            <tr>
                <th>Nombre del servicio</th>
            </tr>
            <tr>
                <td>
                    <div>{{ $it_contrato->nombre_servicio }}</div>
                </td>
            </tr>
        </table>

        <table class="line_dato">
            <tr>
                <th style="width: 30%;">Vigencia</th>
                <th style="width: 70%;">Tipo de contrato</th>
            </tr>
            <tr>
                <td>
                    <div>{{ $it_contrato->vigencia_contrato }}</div>
                </td>
                <td>
                    <div>{{ $it_contrato->tipo_contrato }}</div>
                </td>
            </tr>
        </table>

        <table class="line_dato celda3">
            <tr>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
                <th>Fecha firma</th>
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

        <table class="line_dato">
            <tr>
                <th>No. pagos</th>
                <th>Monto de pago M.X.N.</th>
            </tr>
            <tr>
                <td>
                    <div>{{ $it_contrato->no_pagos }}</div>
                </td>
                <td>
                    <div>${{ number_format($it_contrato->monto_pago, 2) }}</div>
                </td>
            </tr>
        </table>

        <table class="line_dato">
            <tr>
                <th>Monto máximo M.X.N.</th>
                <th>Monto mínimo M.X.N.</th>
            </tr>
            <tr>
                <td>
                    <div>${{ number_format($it_contrato->maximo, 2) }}</div>
                </td>
                <td>
                    <div>${{ number_format($it_contrato->minimo, 2) }}</div>
                </td>
            </tr>
        </table>

        <h1>FIANZA/RESPONSABILIDAD CIVIL</h1>
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

        <h1>RESPONSABLES</h1>
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

        @foreach ($cedula_cumplimiento as $it_cedula)
            @php
                $cumple_cedula_cumplimiento = $it_cedula->cumple ? 'si' : 'no';
            @endphp

            <h1>CEDULA DE CUMPLIMIENTO</h1>
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
            </tr>
            @if (!empty($facturas_de_contrato))
                @foreach ($facturas_de_contrato as $it_facturas_de_contrato)
                    @php
                        $cumple_factura = $it_facturas_de_contrato->cumple == 1 ? 'si' : 'no';
                        $factura_iva = $it_facturas_de_contrato->monto_factura / 16;
                        $subtotal_factura = $it_facturas_de_contrato->monto_factura + $factura_iva;
                    @endphp
                    <tr>
                        <td>{{ $it_facturas_de_contrato->no_factura }}</td>
                        <td>{{ $it_facturas_de_contrato->fecha_recepcion }}</td>
                        <td>{{ $it_facturas_de_contrato->fecha_liberacion }}</td>
                        <td>{{ $it_facturas_de_contrato->no_revisiones }}</td>
                        <td>{{ $cumple_factura }}</td>
                        <td>${{ number_format($it_facturas_de_contrato->monto_factura, 2) }}</td>
                        <td>${{ number_format($factura_iva, 2) }}</td>
                        <td>${{ number_format($subtotal_factura, 2) }}</td>
                        <td>{{ $it_facturas_de_contrato->estatus }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">No hay facturas de este contrato</td>
                </tr>
            @endif
        </table>

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
            </tr>
            @if (!empty($niveles_de_contrato))
                @foreach ($niveles_de_contrato as $it_niveles_de_contrato)
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
                    <td colspan="8">No hay niveles de servicio de este contrato</td>
                </tr>
            @endif
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
            </tr>

            @if (!empty($entregables_de_contrato))
                @foreach ($entregables_de_contrato as $it_entregables_de_contrato)
                    @php
                        $cumple_entregables = $it_entregables_de_contrato->cumplimiento == 1 ? 'si' : 'no';
                    @endphp
                    <tr>
                        <td>{{ $it_entregables_de_contrato->nombre_entregable }}</td>
                        <td>{{ $it_entregables_de_contrato->descripcion }}</td>
                        <td>{{ $it_entregables_de_contrato->plazo_entrega_inicio }}</td>
                        <td>{{ $it_entregables_de_contrato->plazo_entrega_termina }}</td>
                        <td>{{ $it_entregables_de_contrato->entrega_real }}</td>
                        <td>{{ $cumple_entregables }}</td>
                        <td>{{ $it_entregables_de_contrato->observaciones }}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8">No hay entregables mensuales de este contrato</td>
                </tr>
            @endif
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
                    <td>${{ number_format(floatval($it_entregables_de_contrato->deductiva_penalizacion), 2) }}</td>
                </tr>
            @endforeach
        </table>

        <h1>CIERRE CONTRATO</h1>
        <table class="tabla">
            <tr>
                <th>Aspectos para validación de cierre</th>
                <th>Cumple</th>
                <th>Observaciones</th>
            </tr>

            @forelse ($cierre_de_contrato as $it_cierre_de_contrato)
                @if ($it_cierre_de_contrato->cumple == 1)
                    @php $cumple_cierre = 'si'; @endphp
                @else
                    @php $cumple_cierre = 'no'; @endphp
                @endif

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

        <h1>AMPLIACIÓN DE CONTRATO</h1>
        <table class="tabla">
            <tr>
                <th>No. Contrato</th>
                <th>Importe</th>
                <th>Monto total ampliado</th>
                <th>Fecha inicio</th>
                <th>Fecha fin</th>
            </tr>

            @forelse ($ampliacion_de_contrato as $it_ampliacion_de_contrato)
                <tr>
                    <td>{{ $it_ampliacion_de_contrato->no_contrato }}</td>
                    <td>${{ number_format($it_ampliacion_de_contrato->importe, 2) }}</td>
                    <td>${{ number_format($it_ampliacion_de_contrato->monto_total_ampliado, 2) }}</td>
                    <td>{{ $it_ampliacion_de_contrato->fecha_inicio }}</td>
                    <td>{{ $it_ampliacion_de_contrato->fecha_fin }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">No hay ampliación de contrato</td>
                </tr>
            @endforelse
        </table>

    </div>
@endforeach

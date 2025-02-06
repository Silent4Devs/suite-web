<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OC</title>

    <link rel="stylesheet" href="css/requisitions/pdf.css{{ config('app.cssVersion') }}">
</head>

<body>

    <div class="caja-general-doc">
        <table class="encabezado">
            <tr>
                <td class="td-img-doc">
                    @if ($organizacion->logo)
                    <td><img src="{{ asset($organizacion->logo) }}" style="width:100%; max-width:150px; position: relative; right: 6rem;"></td>
                    @else
                        <td><img src="{{ asset('sinLogo.png') }}" style="width:100%; max-width:150px; position: relative; right: 6rem;"></td>
                    @endif
                </td>
                <td class="info-header">
                    {{ $requisiciones->sucursal->empresa }} <br>
                    {{ $requisiciones->sucursal->rfc }} <br>
                    {{ $requisiciones->sucursal->direccion }} <br>
                </td>
                <td class="td-blue-header">
                    <h5 style="color:var(--color-tbj);">ORDEN DE COMPRA</h5>
                    Folio: {{ $requisiciones->folio }} <br>
                    Fecha de solicitud: {{ date('d-m-Y', strtotime($requisiciones->fecha)) }}
                </td>
            </tr>
        </table>

        <table class="table-tada-requi">
            <tr>
                <td>
                    <strong>Referencia:</strong> <br>
                    @if ($requisiciones->referencia)
                        {{ $requisiciones->referencia }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong> Área que solicita: </strong> <br>
                    @if ($requisiciones->area)
                        {{ $requisiciones->area }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong> Solicita: </strong> <br>
                    {{ $requisiciones->user }}
                </td>
                <td>
                    <strong> Fecha de entrega: </strong> <br>
                    @if ($requisiciones->fecha_entrega)
                        {{ date('d-m-Y', strtotime($requisiciones->fecha_entrega)) }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Proyecto: </strong> <br>
                    @if ($requisiciones->contrato === null)
                        <strong>Contrato Eliminado!</strong>
                    @else
                        {{ optional($requisiciones->contrato)->no_proyecto }} -
                        {{ optional($requisiciones->contrato)->no_contrato }} -
                        {{ optional($requisiciones->contrato)->nombre_servicio }}
                    @endif
                </td>
                <td>
                    <strong> Comprador: </strong> <br>
                    @if ($requisiciones->comprador->user->name)
                        {{ $requisiciones->comprador->user->name }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td colspan="2">
                    <strong> Centro de costos: </strong> <br>
                    @foreach ($requisiciones->productos_requisiciones as $producto)
                        @isset($producto->centro_costo)
                            {{ $producto->centro_costo->clave }}
                            {{ $producto->centro_costo->descripcion }},
                        @endisset
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Moneda: </strong> <br>
                    @if ($requisiciones->moneda)
                        {{ $requisiciones->moneda }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong>Pago a:</strong> <br>
                    @if ($requisiciones->pago)
                        Crédito
                    @else
                        <font style="text-transform: capitalize;">
                            {{ $requisiciones->pago }}
                        </font>
                    @endif
                </td>
                <td>
                    <strong>Días de crédito del proveedor: </strong> <br>
                    @if ($requisiciones->dias_credito)
                        {{ $requisiciones->dias_credito }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong>Tipo de cambio: </strong> <br>
                    @if ($requisiciones->cambio)
                        {{ $requisiciones->cambio }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
            </tr>
        </table>

        <div class="caja-proveedor">
            <h5 class="title-proveedor" style="font-weight: bolder;">Datos Proveedor</h5>
            <table class="table-proveedor">
                <tr>
                    <td>
                        <strong> Proveedor: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->razon_social }}
                        @endisset
                    </td>
                    <td>
                        <strong> Nombre Comercial: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->nombre }}
                        @endisset
                    </td>
                    <td colspan="2">
                        <strong> RFC: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->rfc }}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong> Nombre de Contacto: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->contacto }}
                        @endisset
                    </td>
                    <td colspan="3">
                        <strong> Dirección: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->direccion }}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong> Envio a: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->envio }}
                        @endisset
                    </td>
                    <td>
                        <strong> Facturación: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->facturacion }}
                        @endisset
                    </td>
                    <td>
                        <strong> Crédito Disponible: </strong> <br>
                        @isset($proveedores)
                            {{ $proveedores->credito }}
                        @endisset
                    </td>
                </tr>
            </table>
        </div>

        <h5 class="title-proveedor" style="font-weight: bolder;">Producto o Servicio: </h5>
        <table class="table-product">
            @foreach ($requisiciones->productos_requisiciones as $producto)
                <tr>
                    <td>
                        <strong> Cantidad: </strong> <br>
                        @isset($producto->cantidad)
                            {{ $producto->cantidad }}
                        @endisset
                    </td>
                    <td>
                        <strong> Producto: </strong> <br>
                        @isset($producto->cantidad)
                            {{ $producto->producto->descripcion }}
                        @endisset
                    </td>
                    <td colspan="2">
                        <strong> Descripción: </strong> <br>
                        @isset($producto->espesificaciones)
                            {{ $producto->espesificaciones }}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong> Centro de costo: </strong> <br>
                        @isset($producto->centro_costo)
                            {{ $producto->centro_costo->descripcion }}
                        @endisset
                    </td>
                    <td>
                        <strong> Proyecto: </strong> <br>
                        {{ optional($producto->contrato)->no_proyecto }} /
                        {{ optional($producto->contrato)->no_contrato }} -
                        {{ optional($producto->contrato)->nombre_servicio }}
                    </td>
                    <td>
                        <strong> No. de Personas: </strong> <br>
                        @isset($producto->no_personas)
                            {{ $producto->no_personas }}
                        @endisset
                    </td>
                    <td>
                        <strong> Porcentaje de involucramiento: </strong> <br>
                        @isset($producto->porcentaje_involucramiento)
                            {{ $producto->porcentaje_involucramiento }}
                        @endisset
                    </td>
                </tr>
                <tr style="background-color: #F5F5F5;">
                    <td>
                        <strong> SubTotal: </strong> <br>
                        @isset($producto->sub_total)
                            {{ $producto->sub_total }}
                        @endisset
                    </td>
                    <td>
                        <strong> IVA: </strong> <br>
                        @isset($producto->iva)
                            {{ $producto->iva }}
                        @endisset
                    <td>
                        <strong> IVA retenido: </strong> <br>
                        @isset($producto->iva_retenido)
                            {{ $producto->iva_retenido }}
                        @endisset
                    </td>
                    <td>

                    </td>
                </tr>
                <tr style="background-color: #F5F5F5;">
                    <td>
                        <strong> Descuento: </strong> <br>
                        @isset($producto->descuento)
                            {{ $producto->descuento }}
                        @endisset
                    </td>
                    <td>
                        <strong> Otro impuesto: </strong> <br>
                        @isset($producto->otro_impuesto)
                            {{ $producto->otro_impuesto }}
                        @endisset
                    </td>
                    <td>
                        <strong> ISR retenido: </strong> <br>
                        @isset($producto->isr_retenido)
                            {{ $producto->isr_retenido }}
                        @endisset
                    </td>
                    <td>
                        <strong> Total: </strong> <br>
                        {{ $producto->total }}
                    </td>
                </tr>
            @endforeach
        </table>

        <table class="table-totales">
            <tr>
                <td>
                    Son:
                </td>
                <td>
                    <strong> {{ $letras }} {{ $requisiciones->moneda ? $requisiciones->moneda : '' }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    SubTotal:
                </td>
                <td>
                    <strong> $ {{ $requisiciones->sub_total }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    IVA:
                </td>
                <td>
                    <strong> $ {{ $requisiciones->iva }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    IVA&nbsp;retenido:
                </td>
                <td>
                    <strong> $ {{ $requisiciones->iva_retenido }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    ISR&nbsp;retenido:
                </td>
                <td>
                    <strong> $ {{ $requisiciones->isr_retenido }} </strong>
                </td>
            </tr>
            <tr>
                <td>
                    Total:
                </td>
                <td>
                    <strong> $ {{ $requisiciones->total }} </strong>
                </td>
            </tr>
        </table>

        <table class="caja-firmas">
            <tr>
                <td align="center" colspan="2">
                    <div style="width: 40%; margin-left:30%;">
                        @if ($requisiciones->fecha_firma_solicitante_orden)
                            <img src="{{ $requisiciones->firma_solicitante_orden }}" class="img-firma"> <br>
                            <small> {{ $requisiciones->user }} | {{ $requisiciones->fecha_firma_solicitante_orden }}
                            </small>
                        @else
                            <div style="height: 185px;"></div>
                        @endif
                        <hr>
                        FECHA, FIRMA Y NOMBRE DEL SOLICITANTE
                    </div>
                </td>
            </tr>
            <tr>
                <td align="center">
                    @if ($requisiciones->fecha_firma_finanzas_orden)
                        <img src="{{ $requisiciones->firma_finanzas_orden }}" class="img-firma"> <br>
                        <small> {{ $firma_finanzas_name ?? '' }} | {{ $requisiciones->fecha_firma_finanzas_orden }}
                        </small>
                    @else
                        <div style="height: 185px;"></div>
                    @endif
                    <hr>
                    FECHA, FIRMA Y NOMBRE DE FINANZAS
                </td>
                <td align="center">
                    @if ($requisiciones->firma_comprador_orden)
                        <img src="{{ $requisiciones->firma_comprador_orden }}" class="img-firma"> <br>
                        <small> {{ $requisiciones->comprador->user->name }} |
                            {{ $requisiciones->fecha_firma_comprador_orden }} </small>
                    @else
                        <div style="height: 185px;"></div>
                    @endif
                    <hr>
                    FECHA, FIRMA Y NOMBRE DEL COMPRADOR
                </td>
            </tr>
        </table>

        <div style="page-break-after: always;"></div>

        <table class="table-politicas">
            <tbody>
                <tr>
                    <td>{!! $firstClause !!}
                        <table>
                            <tr>
                                <td style="width: 75%; vertical-align: top;">
                                    <p style="font-size: 10px; margin: 0;">{!! $textoIzquierdoHtml !!}</p>
                                </td>
                                <td style="width: 75%; vertical-align: top;">
                                    <p style="font-size: 10px; margin: 0;">{!! $textoDerechoHtml !!}</p>
                                </td>
                            </tr>
                        </table>
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>

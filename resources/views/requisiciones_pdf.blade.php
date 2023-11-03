<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requisición</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css">
</head>
<body>

    <div class="caja-general-doc">
        <table class="encabezado">
            <tr>
                <td class="td-img-doc">
                    @if ($requisiciones->sucursal->mylogo)
                        <img style="width:100%; max-width:150px;" src="{{ asset('razon_social/'.$requisiciones->sucursal->mylogo) }}">
                    @else
                        <img src="{{ asset('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif
                </td>
                <td class="info-header">
                    {{ $requisiciones->sucursal->empresa }}  <br>
                    {{ $requisiciones->sucursal->rfc }}   <br>
                    {{ $requisiciones->sucursal->direccion }} <br>
                </td>
                <td class="td-blue-header">
                    <h5 style="color:#49598A;">REQUISICIÓN DE ADQUISICIONES</h5>
                    Folio: RQ-00-00-{{ $requisiciones->id}} <br>
                    Fecha de solicitud: {{ date('d-m-Y', strtotime($requisiciones->fecha))  }}
                </td>
            </tr>
        </table>

        <table class="table-tada-requi" style="background: #295082 0% 0% no-repeat padding-box;
        opacity: 1;">
            <tr>
                <td style="color: white;" >
                    <strong>Referencia:</strong> <br>
                    {{ $requisiciones->referencia }}
                </td>
                <td style="color: white;" >
                    <strong> Área que solicita: </strong> <br>
                    {{ $requisiciones->area }}
                </td>
                <td style="color: white;" >
                    <strong> Solicita: </strong> <br>
                    {{ $requisiciones->user }}
                </td>
            </tr>
            <tr>
                <td style="color: white;" >
                    <strong> Proyecto: </strong> <br>
                    {{ $requisiciones->contrato->no_proyecto }} / {{ $requisiciones->contrato->no_contrato }} - {{ $requisiciones->contrato->nombre_servicio }}
                </td>
                <td style="color: white;" >
                    <strong> Comprador: </strong> <br>
                    {{ $requisiciones->comprador->nombre}}
                </td>
                <td></td>
            </tr>
        </table>

        <h5 class="title-product">Producto o Servicio: </h5>
        <table class="table-product">
            @foreach ($requisiciones->productos_requisiciones  as $producto)
                <tr>
                    <td>
                        <strong> Cantidad: </strong> <br><br>
                        {{ $producto->cantidad }}
                    </td>
                    <td>
                        <strong> Producto: </strong> <br><br>
                        {{ $producto->producto->descripcion }}
                    </td>
                    <td>
                        <strong> Descripción: </strong> <br> <br>
                        {{ $producto->espesificaciones }}
                    </td>
                </tr>
                <tr>
                    <td colspan="3"><hr></td>
                </tr>
            @endforeach
        </table>
        @foreach ($requisiciones->provedores_requisiciones  as $proveedores)
        <div class="caja-proveedor">
            <h5 class="title-proveedor">Proveedor: <strong> {{ $proveedores->proveedor }} </strong> </h5>
            <table class="table-proveedor">
                <tr>
                    <td>
                        <strong> Proveedor: </strong> <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->proveedor }}
                        @endisset
                    </td>
                    <td>
                        <strong> Detalles: </strong> <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->detalles }}
                        @endisset
                    </td>
                    <td colspan="2">
                        <strong> Comentarios: </strong>  <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->comentarios }}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong> Tipo: </strong> <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->tipo }}
                        @endisset
                    </td>
                    <td>
                        <strong> Contacto: </strong> <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->contacto }}
                        @endisset
                    </td>
                    <td>
                        <strong> Correo: </strong> <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->contacto_correo }}
                        @endisset
                    </td>
                    <td>

                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <strong> URL: </strong> <br> <br>
                        @isset($proveedores)
                            {{ $proveedores->url }}
                        @endisset
                    </td>
                </tr>
            </table>
        </div>
        @endforeach

        @if ($requisiciones->proveedor_catalogo  != null)
         @foreach ($proveedores_catalogo as $prov)
         <div class="caja-proveedor">
            <h5 class="title-proveedor">Proveedor: <strong> {{$prov->nombre}} </strong> </h5>
            <table class="table-proveedor">
                <tr>
                    <td>
                        <strong> Razón Social: </strong> <br> <br>
                        @isset($prov->razon_social)
                        {{$prov->razon_social}}
                        @endisset
                    </td>
                    <td>
                        <strong> RFC: </strong> <br> <br>
                        @isset($prov->rfc)
                        {{$prov->rfc}}
                        @endisset
                    </td>
                    <td>
                        <strong> Contacto: </strong>  <br> <br>
                        @isset($prov->contacto)
                        {{$prov->contacto}}
                        @endisset
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <strong> Fecha Inicio: </strong> <br> <br>
                        @isset($prov->fecha_inicio)
                            {{ date('d-m-Y', strtotime($prov->fecha_inicio)) }}
                        @endisset
                    </td>
                    <td colspan="2">
                        <strong> Fecha Fin: </strong> <br> <br>
                        @isset($prov->fecha_fin)
                            {{ date('d-m-Y', strtotime($prov->fecha_fin)) }}
                        @endisset
                    </td>
                </tr>
            </table>
        </div>
        </div>
        @endforeach
        @endif
        @if ($proveedor_indistinto)
        <div class="caja-proveedor">
            <h5 class="title-proveedor">Proveedor: <strong> Indistinto </strong> </h5>
            <table class="table-proveedor">
                <tr>
                    <td>
                        <strong> Fecha Inicio: </strong> <br> <br>
                        {{ date('d-m-Y', strtotime($proveedor_indistinto->fecha_inicio))  }}
                    </td>
                    <td>
                        <strong> Fecha fin: </strong> <br> <br>
                        {{ date('d-m-Y', strtotime($proveedor_indistinto->fecha_fin))  }}
                    </td>
                </tr>
            </table>
        </div>
        @endif
    </div>

   <table class="caja-firmas">
        <tr>
            <td align="center" >
                @if ($requisiciones->firma_solicitante)
                    <img src="{{$requisiciones->firma_solicitante}}" class="img-firma"> <br>
                    <small> {{$requisiciones->user}} | {{ $requisiciones->fecha_firma_solicitante_requi }} </small>
                @else
                    <div style="height: 185px;"></div>
                @endif
                <hr>
                FECHA, FIRMA Y NOMBRE DEL SOLICITANTE
            </td>
            <td align="center" >
                @if ($requisiciones->firma_jefe)
                    <img src="{{$requisiciones->firma_jefe}}" class="img-firma"> <br>
                    <small> @isset($supervisor) {{$supervisor}} @endisset | {{ $requisiciones->fecha_firma_jefe_requi }}</small>
                @else
                    <div style="height: 185px;"></div>
                @endif
                <hr>
                FECHA, FIRMA Y NOMBRE DEL JEFE
            </td>
        </tr>
        <tr>
            <td align="center">
                @if ($requisiciones->firma_finanzas)
                    <img src="{{$requisiciones->firma_finanzas}}" class="img-firma"> <br>
                    <small> Lourdes del Pilar Abadía Velasco | {{ $requisiciones->fecha_firma_finanzas_requi }} </small>
                @else
                    <div style="height: 185px;"></div>
                @endif
                <hr>
                FECHA, FIRMA Y NOMBRE DE FINANZAS
            </td>
            <td align="center">
                @if ($requisiciones->firma_compras)
                    <img src="{{$requisiciones->firma_compras}}" class="img-firma"> <br>
                    <small> {{$requisiciones->comprador->user->name}} | {{ $requisiciones->fecha_firma_comprador_requi }} </small>
                @else
                    <div style="height: 185px;"></div>
                @endif
                <hr>
                FECHA, FIRMA Y NOMBRE DEL COMPRADOR
            </td>
        </tr>
    </table>
</div>
</body>
</html>

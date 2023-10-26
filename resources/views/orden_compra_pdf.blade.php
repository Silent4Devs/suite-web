<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OC</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css">
</head>
<body>

    <div class="caja-general-doc">
        <table class="encabezado">
            <tr>
                <td class="td-img-doc">
                    @if ($requisiciones->sucursal->mylogo)
                        <img src="{{ url('razon_social/'.$requisiciones->sucursal->mylogo) }}">
                    @else
                        <img src="{{ asset('sinLogo.png') }}">
                    @endif
                </td>
                <td class="info-header">
                    {{ $requisiciones->sucursal->empresa }}  <br>
                    {{ $requisiciones->sucursal->rfc }}   <br>
                    {{ $requisiciones->sucursal->direccion }} <br>
                </td>
                <td class="td-blue-header">
                    <h5 style="color:#49598A;">ORDEN DE COMPRA</h5>
                    Folio: {{ $requisiciones->folio}} <br>
                    Fecha de solicitud: {{ date('d-m-Y', strtotime($requisiciones->fecha))  }}
                </td>
            </tr>
        </table>

        <table class="table-tada-requi">
            <tr>
                <td>
                    <strong>Referencia:</strong> <br>
                    @if( $requisiciones->referencia )
                    {{ $requisiciones->referencia }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong> Área que solicita: </strong> <br>
                    @if( $requisiciones->area )
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
                    @if($requisiciones->fecha_entrega)
                        {{ date('d-m-Y', strtotime($requisiciones->fecha_entrega))  }}
                    @endif
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Proyecto: </strong> <br>
                    @if( $requisiciones->contrato->no_contrato )
                    {{ $requisiciones->contrato->no_contrato }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong> Comprador: </strong> <br>
                    @if( $requisiciones->comprador->user->name )
                    {{ $requisiciones->comprador->user->name }}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td colspan="2">
                    <strong> Centro de costos: </strong> <br>
                    @foreach ($requisiciones->productos_requisiciones  as $producto)
                        @isset($producto->centro_costo)
                            {{ $producto->centro_costo->clave}}
                            {{ $producto->centro_costo->descripcion}},
                        @endisset
                    @endforeach
                </td>
            </tr>
            <tr>
                <td>
                    <strong> Moneda: </strong> <br>
                    @if( $requisiciones->moneda)
                    {{ $requisiciones->moneda}}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong>Pago a:</strong> <br>
                    @if($requisiciones->pago)
                            Crédito
                        @else
                            <font style="text-transform: capitalize;">
                                {{ $requisiciones->pago }}
                            </font>
                        @endif
                </td>
                <td>
                    <strong>Días de crédito del proveedor: </strong> <br>
                    @if( $requisiciones->dias_credito)
                    {{ $requisiciones->dias_credito}}
                    @else
                        <small class="not-register">Sin registro</small>
                    @endif
                </td>
                <td>
                    <strong>Tipo de cambio: </strong> <br>
                    @if( $requisiciones->cambio)
                    {{ $requisiciones->cambio}}
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
                        <strong> Nombre Comercial:  </strong> <br>
                        @isset($proveedores) {{ $proveedores->nombre }} @endisset
                    </td>
                    <td colspan="2">
                        <strong> RFC:  </strong> <br>
                        @isset($proveedores) {{ $proveedores->rfc }} @endisset
                    </td>
                 </tr>
                 <tr>
                    <td>
                        <strong> Nombre de Contacto:  </strong> <br>
                        @isset($proveedores) {{ $proveedores->contacto }} @endisset
                    </td>
                    <td colspan="3">
                        <strong> Dirección:  </strong> <br>
                        @isset($proveedores) {{ $proveedores->direccion }} @endisset
                    </td>
                 </tr>
                 <tr>
                    <td colspan="2">
                        <strong> Envio a:  </strong> <br>
                        @isset($proveedores) {{ $proveedores->envio }} @endisset
                    </td>
                    <td>
                        <strong> Facturación:  </strong> <br>
                        @isset($proveedores) {{ $proveedores->facturacion }} @endisset
                    </td>
                    <td>
                        <strong> Crédito Disponible: </strong> <br>
                        @isset($proveedores) {{ $proveedores->credito }} @endisset
                    </td>
                 </tr>
            </table>
        </div>

        <h5 class="title-proveedor" style="font-weight: bolder;">Producto o Servicio: </h5>
        <table class="table-product">
            @foreach ($requisiciones->productos_requisiciones  as $producto)
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
                        @isset( $producto->contrato)
                        {{ $producto->contrato->no_proyecto }} / {{ $producto->contrato->no_contrato }} - {{ $producto->contrato->nombre_servicio }}
                        @endisset
                    </td>
                    <td>
                        <strong> No. de Personas: </strong> <br>
                        @isset( $producto->no_personas)
                        {{ $producto->no_personas }}
                        @endisset
                    </td>
                    <td>
                        <strong> Porcentaje de involucramiento: </strong> <br>
                        @isset( $producto->porcentaje_involucramiento)
                        {{ $producto->porcentaje_involucramiento }}
                        @endisset
                    </td>
                </tr>
                <tr style="background-color: #F5F5F5;">
                    <td>
                        <strong> SubTotal:  </strong> <br>
                        @isset(  $producto->sub_total)
                        {{  $producto->sub_total }}
                        @endisset
                    </td>
                    <td>
                        <strong> IVA: </strong> <br>
                        @isset( $producto->iva)
                        {{ $producto->iva }}
                        @endisset
                    <td>
                        <strong> IVA retenido: </strong> <br>
                        @isset( $producto->iva_retenido)
                        {{ $producto->iva_retenido }}
                        @endisset
                    </td>
                    <td>

                    </td>
                </tr>
                <tr style="background-color: #F5F5F5;">
                    <td>
                        <strong> Descuento: </strong> <br>
                        @isset( $producto->descuento)
                        {{ $producto->descuento }}
                        @endisset
                    </td>
                    <td>
                        <strong> Otro impuesto: </strong> <br>
                        @isset( $producto->otro_impuesto)
                        {{ $producto->otro_impuesto }}
                        @endisset
                    </td>
                    <td>
                        <strong> ISR retenido: </strong> <br>
                        @isset( $producto->isr_retenido)
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
                    <strong> {{ $letras }} dolares </strong>
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
                            <img src="{{$requisiciones->firma_solicitante_orden}}" class="img-firma"> <br>
                            <small> {{$requisiciones->user}} | {{ $requisiciones->fecha_firma_solicitante_orden }} </small>
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
                        <img src="{{$requisiciones->firma_finanzas_orden}}" class="img-firma"> <br>
                        <small> Lourdes del Pilar Abadía Velasco | {{ $requisiciones->fecha_firma_finanzas_orden}} </small>
                    @else
                        <div style="height: 185px;"></div>
                    @endif
                    <hr>
                    FECHA, FIRMA Y NOMBRE DE FINANZAS
                </td>
                <td align="center">
                    @if ($requisiciones->firma_comprador_orden)
                        <img src="{{$requisiciones->firma_comprador_orden}}" class="img-firma"> <br>
                        <small> {{$requisiciones->comprador->user->name}} | {{ $requisiciones->fecha_firma_comprador_orden }} </small>
                    @else
                        <div style="height: 185px;"></div>
                    @endif
                    <hr>
                    FECHA, FIRMA Y NOMBRE DEL COMPRADOR
                </td>
            </tr>
        </table>
        {{-- <table class="encabezado" style="margin-top: 100px">
            <tr>
                <td class="td-img-doc">
                    <img class="img-doc" src="{{ $organizacion->logotipo }}">
                </td>
                <td class="info-header">
                    {{ $requisiciones->sucursal->empresa }}  <br>
                    {{ $requisiciones->sucursal->rfc }}   <br>
                    {{ $requisiciones->sucursal->direccion }} <br>
                </td>
                <td class="td-blue-header">
                    <h5 style="color:#49598A;">ORDEN DE COMPRA</h5>
                    Folio: {{ $requisiciones->folio}} <br>
                    Fecha de solicitud: {{ date('d-m-Y', strtotime($requisiciones->fecha))  }}
                </td>
            </tr>
        </table> --}}

        <table class="table-politicas">
            <tr>
                <td>
                    <p>
                        Los términos y condiciones que se establecen a continuación regirán la relación con carácter de contrato comercial de la presente orden de compra (“OC”), entre SILENT4BUSINESS, S.A. de C.V(“Cliente”) y la persona física o moral señalada en el anverso y/o anexo a la presente OC  (“presentador”) por la prestación de cualquier tipo de servicios y/o entrega de bienes  o productos (“los servicios”) de conformidad con las
                    </p>

                    <h5 style="margin-top: 30px; text-align:center;">CLAUSULAS</h5>

                    <p>
                        1.	Se entenderá que existe relación contractual entre el Prestador y el Cliente (“las Partes”) cuando en la OC medie la firma del Cliente a través de un representante o bien, mediante autorización previa y expresa de este.
                    </p>

                    <p>
                        2.	El prestador, manifiesta que para la prestación de los servicios cuenta con todo tipo de autorizaciones, permisos o licencias, así como recursos económicos, técnicos y humanos , proporcionado la totalidad de materiales y servicios en el lugar y tiempos previstos en la OC.
                    </p>

                    <p>
                        3.	Una vez que los servicios hayan sido prestados y/ o entregados a entera satisfacción del Cliente, este se pagará a favor del prestador las cantidades señaladas en la OC, dentro de los 20 (veinte) días naturales siguientes contados a partir de la entrega de la factura correspondiente y de entregables en el cual debe de proporcionar el número de recepción correspondiente, misma que deberá cumplir con todos los requisitos fiscales vigentes (la “Contraprestación”)
                    </p>

                    <p>
                        4.	La forma de pago de la Contraprestación será en tipo de moneda que se  señale en el anverso en cualquiera de las siguientes formas; (i) mediante transferencia electrónica  en la cuenta bancaria que para el efecto señale El prestador, (ii) mediante cheque; o (iii) en el domicilio que para efecto señale El prestador al Cliente, en caso de cambio de datos bancario enviar correo a recepción.factura@silent4business.com  con la actualización de datos solicitados.
                    </p>
                </td>

                <td>
                    <p>
                        5.	El prestador deberá de realizar, elaborar y/o entregar los servicios con los estándares mas altos de calidad en la industria, así como cumplir con todos y cada uno de los requerimientos del cliente a su entera satisfacción, por lo que garantiza que estos cumplirán con las especificaciones indicadas por el cliente tanto en la OC como en la documentación técnica e información adicional que proporcione. En caso de no cumplir con lo anterior, o si el Cliente manifiesta inconformidad en los servicios de manera total o parcial, el prestador deberá a elección del cliente; (i) Volverá a prestar el servicio o entregara el producto de manera inmediata y sin ningún cobro adicional; (ii) Hacer el reembolso total entregada al prestador o erogada con motivo de dicha inconformidad, o (iii) pago de una pena convencional ya sea (a) del (treinta por ciento) de la factura o (b) la pena convencional la que hay a la que haya sido acreedor el cliente por el retraso o incumplimiento por parte del prestador.
                    </p>

                    <p>
                        6.	El  prestador manifiesta y acuerda conforme al Articulo 13 de la ley federal del Trabajo Vigente en México, cuenta con los elementos propios y suficientes para dar cumplimiento a sus obligaciones y llevar acabo sus actividades por lo que será el único responsable del debido cumplimiento de todas y cada una de sus obligaciones con respecto a sus trabajadores, empleados y agentes. No existirá relación laboral o de cualquier clase entre una de las partes con los empleados de la parte.
                    </p>

                    <p>
                        7.	La presente OC no implica el otorgamiento de una licencia o cualquier otro titulo que le permita  al prestador utilizar las marcas, nombres y avisos comerciales, denominaciones de productos o cualquier otro derecho de propiedad industrial o intelectual o derecho de autor perteneciente al cliente sin su previo consentimiento por escrito.
                    </p>

                    <p>
                        8.	Las partes convienen en que por el pago de la contraprestación objeto del presente instrumento, cualquiera tipo de derechos de propiedad intelectual y/o industrial derivados de los productos y/o servicios, serán propiedad exclusiva del cliente.
                    </p>
                </td>
            </tr>
        </table>

        <table class="table-politicas">
            <tr>
                <td>
                    <p>
                        9.	Las partes se obligan a utilizar la información confidencial que puedan llegar a proporcionar únicamente para la realización y cumplimiento de la presente OC, quedándole estrictamente prohibido divulgar por cualquier medio o terceros o darle cualquier uso diverso al establecido, obligándose a resguardarla como tal permaneciendo vigente como toda su valides y alcances aun después de terminada la vigencia del presente instrumento hasta por 3(tres) años y en el caso de servicios a gobierno hasta por 5(cinco) años. Se entenderá como información confidencial (de forma enunciativa, mas no limitada) toda aquella información oral, escrita, verbal o gráfica, así como la contenida en medios físicos, electrónicos o electromagnéticos, que se encuentren identificada claramente por la parte reveladora.
                    </p>
                    <p>
                        10.	Durante la vigencia de esta OC y después de concluida la misma, el prestador será responsable frente al cliente y frente a cualquier tercero de todos aquellos actos u omisiones que por culpa, negligencia, dolo o mala fe ,se cometa en la presentación de los servicios objeto de esta OC, que ponga o puedan poner en peligro, causen o puedan causar un daño y/o perjurio a los bienes, propiedades, posesiones, derechos reputación, imagen corporativa o buen nombre comercial del cliente o daños y/o prejuicios que se causen a terceros.
                    </p>
                    <p>
                        11.	Para cualquier notificación relacionada con la presente OC , las partes señalan como sus domicilios los establecidos en la OC, mismas que deberán ser hechas personalmente , por correo certificada o servicio de mensajería especializada en caso de que cualquiera de las partes cambie de domicilio deberá de notificarlo con anticipación a la otra parte, de no ser así cualquier notificación realizada en los domicilios antes señalados será considerado como efectivamente realizado.
                    </p>
                    <p>
                        12.	La invalidez de alguna cláusula del presente instrumento no afectara las demás disposiciones del mismo, las cuales continuara en plena fuerza y vigor y deberán interpretarse como si la cláusula o inciso    respectivo no hubieran sido insertados.
                    </p>
                </td>
                <td>
                    <p>
                        13.	El presente se obliga o no ceder o subcontratar en todo o en parte los derechos y obligaciones que se deriven de esta OC, a menos que el cliente lo apruebe por escrito y en su caso el prestador será responsable de la relación con las compañías y/o terceros con los que contrate o subcontrate.
                    </p>
                    <p>
                        14.	Para la interpretación y cumplimiento de los términos y condiciones de la OC, las partes se someten a la jurisdicción de los tribunales de la ciudad de México, renunciando expresamente a cualquier otro fuero que pudiera corresponderles por razón de sus domicilios presentes o futuros.
                    </p>
                    <p>
                        15.	Temas relacionados con pagos facturas y de temas de OC al correo de recepción.factura@silent4business.com
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>



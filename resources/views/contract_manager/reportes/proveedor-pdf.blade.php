<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proveedor-pdf</title>
    <link rel="preload" type="text/css" href="{{ asset('css/reports/reports_proveedores_pdf.css') }}{{ config('app.cssVersion') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('css/reports/reports_proveedores_pdf.css') }}{{ config('app.cssVersion') }}" />
</head>

<body>
    @foreach ($proveedor_seleccionado as $it_proveedor)

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
                            Reporte de Proveedor
                        </h4>
                        <p style="font-size: 14px; margin: 5px 0; color: #666;">
                            <strong>Fecha de consulta:</strong> {{ date('d/m/y') }}
                        </p>
                    </td>
                </tr>
            </table>

            <div style="background-color: #EEE;">
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>DATOS GENERALES</strong>
                    </div>
                </div>
                <table class="line_dato">
                    <tr>
                        <th>Razón social</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->razon_social }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Nombre comercial del proveedor</th>
                        <th>RFC persona moral o persona física</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->nombre_comercial }}</div>
                        </td>
                        <td>
                            <div>{{ $it_proveedor->rfc }}</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>DOMICILIO FISCAL</strong>
                    </div>
                </div>
                <table class="line_dato">
                    <tr>
                        <th>Calle y número</th>
                        <th>Colonia</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->calle }}</div>
                        </td>
                        <td>
                            <div>{{ $it_proveedor->colonia }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Ciudad o municipio/ país</th>
                        <th>Código postal</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->ciudad }}</div>
                        </td>
                        <td>
                            <div>{{ $it_proveedor->codigo_postal }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Teléfono</th>
                        <th>Página web</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->telefono }}</div>
                        </td>
                        <td>
                            <div>{{ $it_proveedor->pagina_web }}</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="background-color: #EEE;">
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>DATOS DEL CONTACTO</strong>
                    </div>
                </div>
                <table class="line_dato">
                    <tr>
                        <th>Nombre completo del contacto</th>
                        <th>Puesto</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->nombre_completo }}</div>
                        </td>
                        <td>
                            <div>{{ $it_proveedor->puesto }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Correo electrónico</th>
                        <th>Celular</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->correo }}</div>
                        </td>
                        <td>
                            <div>{{ $it_proveedor->celular }}</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div>
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>DATOS COMPLEMENTARIOS</strong>
                    </div>
                </div>
                <table class="line_dato">
                    <tr>
                        <th>Objeto social / descripción del servicio o producto</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->objeto_descripcion }}</div>
                        </td>
                    </tr>
                </table>

                <table class="line_dato">
                    <tr>
                        <th>Cobertura, rango geográfico en el cual presta los servicios</th>
                    </tr>
                    <tr>
                        <td>
                            <div>{{ $it_proveedor->cobertura }}</div>
                        </td>
                    </tr>
                </table>
            </div>

            <div style="background-color: #EEE;">
                <div class="titulo-tablas">
                    <div class="col-12">
                        <strong>CONTRATO</strong>
                    </div>
                </div>
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
                    </tr>

                    @forelse ($contratos_de_proveedor as $it_contrato_de_proveedor)
                        <tr>
                            <td>{{ $it_contrato_de_proveedor->no_contrato }}</td>
                            <td>{{ $it_contrato_de_proveedor->nombre_servicio }}</td>
                            <td>{{ $it_contrato_de_proveedor->tipo_contrato }}</td>
                            <td>{{ $it_contrato_de_proveedor->vigencia_contrato }}</td>
                            <td>{{ $it_contrato_de_proveedor->fecha_inicio }}</td>
                            <td>{{ $it_contrato_de_proveedor->fecha_fin }}</td>
                            <td>{{ $it_contrato_de_proveedor->estatus }}</td>
                            <td>{{ $it_contrato_de_proveedor->fase }}</td>
                            <td>${{ number_format($it_contrato_de_proveedor->monto_pago, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">No hay contratos de este proveedor</td>
                        </tr>
                    @endforelse
                </table>
            </div>

    @endforeach


</body>

</html>

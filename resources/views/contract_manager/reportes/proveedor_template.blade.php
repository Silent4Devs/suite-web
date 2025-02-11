<link rel="stylesheet" type="text/css" href="{{ asset('css/reports/reports_proveedores.css') }}{{ config('app.cssVersion') }}" />
@foreach ($proveedor_seleccionado as $it_proveedor)
    <div class="card-content">
        <div class="flex header-doc">
            <div class="flex-item item-doc-img">
                <img src="{{ asset('img/global/silent4business.png') }}" style="width: 100%; max-width: 150px;">
            </div>
            <div class="flex-item" style="font-family: Arial, sans-serif; color: #333;">
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
            </div>
            <div class="flex-item item-header-doc-info"
                style="text-align: center; font-family: Arial, sans-serif; color: #333;">
                <h4 style="font-size: 20px; color: #49598A; margin: 10px 0; font-weight: bold; text-transform: uppercase;">
                    Reporte de proveedor
                </h4>
                <p style="font-size: 14px; margin: 5px 0; color: #666;">
                    <strong>Fecha de consulta:</strong> {{ $hoy }}
                </p>
            </div>
        </div>
        <div class="doc-blue p-3">
            <table class="arriba_derecha text-white text-center">
                <tr>
                    <th>Razón social</th>
                </tr>
                <tr>
                    <td>
                        <div>{{ $it_proveedor->razon_social }}</div>
                    </td>
                </tr>
            </table>

            <table class="line_dato text-white">
                <tr>
                    <th style="width: 33.33%;">Nombre comercial del proveedor</th>
                    <th style="width: 33.33%;">RFC persona moral o persona física</th>
                </tr>
                <tr>
                    <td>
                        <div>{{ $it_proveedor->nombre }}</div>
                    </td>
                    <td>
                        <div>{{ $it_proveedor->rfc }}</div>
                    </td>
                </tr>
            </table>
        </div>
        <div style="background-color: #EEE;">
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

        <div class="titulo-tablas">
            <div class="col-12">
                <strong>FIANZA/RESPONSABILIDAD CIVIL</strong>
            </div>
        </div>
        <table class="line_dato">
            <tr>
                <th>Nombre completo del contacto</th>
                <th>Puesto</th>
            </tr>
            <tr>
                <td>
                    <div>{{ $it_proveedor->nombre_contacto }}</div>
                </td>
                <td>
                    <div>{{ $it_proveedor->puesto_contacto }}</div>
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
                    <div>{{ $it_proveedor->celular_contacto }}</div>
                </td>
            </tr>
        </table>

        <div style="background-color: #EEE;">
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
                    <td colspan="9" style="padding: 20px;">No hay contratos de este proveedor</td>
                </tr>
            @endforelse
        </table>
    </div>
@endforeach

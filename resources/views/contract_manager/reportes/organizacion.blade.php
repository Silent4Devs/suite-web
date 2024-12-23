<div style="display: flex; justify-content: space-between; padding:10px; margin-bottom: 20px;">
    <h4 class="sub-titulo-form">REPORTE ORGANIZACIÓN</h4>
    <button class="btn imprimir" style="bottom: 60 !important;"
        onclick="printJS({
        printable: 'proveedor_reporte',
        type: 'html',
        css: '{{ asset('css/reports.css/reports.css') }}',})">
        <i class="fas fa-print"></i>
        Imprimir Reporte
    </button>
</div>

@if (!$organizacion)
    <div class="card">
        <p style="padding: 20px;">
            No se ha registrado organización
        </p>
    </div>
@endif
@isset($organizacion)
    <div class="card">
        <div id="miorganizacion_reporte" class="card-content">
            <table class="encabezado">
                <thead>
                    <tr>
                        <th>

                            @if (isset($logotipo->logotipo))
                                <img src="{{ url('images/' . $logotipo->logotipo) }}">
                            @else
                                <img src="{{ url('img/Silent4Business-Logo-Color.png') }}">
                            @endif
                        </th>
                        <th>
                            <font style="font-weight: lighter;">Datos de la organización: </font><br>
                            {{ $organizacion->empresa }}
                        </th>
                        <th>{{ date('d/m/y') }}</th>
                    </tr>
                </thead>
            </table>

            <h1>DATOS GENERALES</h1>
            <table class="line_dato">
                <tr>
                    <th>Nombre</th>
                    <th>Dirección</th>
                </tr>
                <tr>
                    <td>
                        <div>{{ $organizacion->empresa }}</div>
                    </td>
                    <td>
                        <div>{{ $organizacion->direccion }}</div>
                    </td>
                </tr>
            </table>

            <table class="line_dato">
                <tr>
                    <th>Teléfono</th>
                    <th>Correo</th>
                </tr>
                <tr>
                    <td>
                        <div>{{ $organizacion->telefono }}</div>
                    </td>
                    <td>
                        <div>{{ $organizacion->correo }}</div>
                    </td>
                </tr>
            </table>

            <table class="line_dato">
                <tr>
                    <th>Página web</th>
                </tr>
                <tr>
                    <td>
                        <div>{{ $organizacion->pagina_web }}</div>
                    </td>
                </tr>
            </table>

            <h1>DATOS COMPLEMENTARIOS</h1>
            <table class="line_dato">
                <tr>
                    <th>Productos o Servicios </th>
                    <th>Giro</th>
                </tr>
                <tr>
                    <td>
                        <div>{{ $organizacion->servicios }} </div>
                    </td>
                    <td>
                        <div>{{ $organizacion->giro }}</div>
                    </td>
                </tr>
            </table>

            <table class="line_dato">
                <tr>
                    <th>Misión </th>
                    <th>Visión</th>
                </tr>
                <tr>
                    <td>
                        <div>{!! strip_tags($organizacion->mision) !!}</div>
                    </td>
                    <td>
                        <div>{!! strip_tags($organizacion->vision) !!}</div>
                    </td>
                </tr>
            </table>

            <table class="line_dato">
                <tr>
                    <th> Valores </th>
                    <th> Antecedentes</th>
                </tr>
                <tr>
                    <td>
                        <div>{!! strip_tags($organizacion->valores) !!} </div>
                    </td>
                    <td>
                        <div>{!! strip_tags($organizacion->antecedentes) !!} </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endisset

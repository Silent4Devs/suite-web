<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>organizacion-pdf</title>
    <link rel="preload" type="text/css" href="{{ asset('css/reports/reports_pdf.css') }}{{ config('app.cssVersion') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/reports/reports_pdf.css') }}{{ config('app.cssVersion') }}" />

</head>

<body>
    @if (!$organizacion)
        <div class="card">
            <p style="padding: 20px;">
                No se ha registrado organización
            </p>
        </div>
    @endif
    @isset($organizacion)
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
                        Reporte de la Organización
                    </h4>
                    <p style="font-size: 14px; margin: 5px 0; color: #666;">
                        <strong>Fecha de consulta:</strong> {{ date('d/m/y') }}
                    </p>
                </td>
            </tr>
        </table>

        <h1 style="background-color:  #EEF5FF;">DATOS COMPLEMENTARIOS</h1>
        <table class="line_dato text-white" style="background-color:  #EEF5FF;">
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
                <th>Misión</th>
                <th>Visión</th>
            </tr>
            <tr>
                <td>
                    {!! strip_tags($organizacion->mision) !!}
                </td>
                <td>
                    {!! strip_tags($organizacion->vision) !!}
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
                    {!! strip_tags($organizacion->valores) !!}
                </td>
                <td style="text-align: justify; text-justify: inter-world;">
                    {!! strip_tags($organizacion->antecedentes) !!}
                </td>
            </tr>
        </table>
    @endisset
</body>

</html>

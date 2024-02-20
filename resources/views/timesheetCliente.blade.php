analisis brecha

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TimeSheet Clientes</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/requisiciones_pdf.css{{config('app.cssVersion')}}">
    <style>

        body{
            font-size: 7px;
            text-align: justify;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap; /* Evitar el ajuste de texto a múltiples líneas */
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .highlight {
            font-weight: bold;
            color: #0066cc;
        }
    </style>
</head>
<body>

    <div class="caja-general-doc">
        <table class="encabezado">
            <tr>
                <td class="td-img-doc">
                    @php
                    use App\Models\Organizacion;
                    $organizacion = Organizacion::getFirst();
                    $logotipo = $organizacion->logotipo;
                    $empresa = $organizacion->empresa;
                    @endphp

                    @if ($logotipo)
                    <img style="width:100%; max-width:100px; position: relative; left:2rem;"  src="{{ asset($logotipo) }}">
                    @else
                        <img src="{{ asset('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif
                </td>
                <td class="info-header">
                    <div style="position: relative; left: 3rem;">
                        <p style="font-size: 8px;">
                            {{$organizacions->empresa}} <br>
                            RFC:{{$organizacions->rfc}} <br>
                            Av. Insurgentes Sur 2453 piso 4,<br> Colonia Tizapán San Ángel, <br> Álvaro Obregón, C.P. 01090, CDMX <br></p>
                    </div>
                </td>
                <td class="td-blue-header">
                  <br>
                  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp;  <span class="textopdf"> <strong> Reporte Timesheet</strong></span>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <h2>TimeSheet Clientes</h2>

        <table>
            <thead>
                <tr>
                    <th style="width: 50%;">Identificador</th>
                    {{-- <th>Razon Social</th> --}}
                    <th style="width: 50%;">Nombre</th>
                    <th style="width: 50%;">RFC</th>
                    <th style="width: 50%;">Calle</th>
                    <th style="width: 50%;">Colonia</th>
                    <th style="width: 50%;">Ciudad</th>
                    <th style="width: 50%;">Codigo postal</th>
                    <th style="width: 50%;">Telefono</th>
                    <th style="width: 50%;">Pagina web</th>
                    <th style="width: 50%;">Nombre Contacto</th>
                    <th style="width: 50%;">Puesto Contacto</th>
                    <th style="width: 50%;">Correo</th>
                    <th style="width: 50%;">Celular</th>
                    <th style="width: 50%;">Objeto</th>
                    <th style="width: 50%;">Cobertura</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($timesheetCliente as  $timesheetCl)
                    <tr>
                        <td>
                            @if ($timesheetCl->identificador)
                            <center>   {{ substr($timesheetCl->identificador, 0, 12) }} </center>
                            @else
                            <center>   No hay registro </center>
                            @endif

                        </td>
                        {{-- <td style="width: 40%;">
                            @if ($timesheetCl->razon_social)
                            {{$timesheetCl->razon_social}}
                            @else
                                No hay registro
                            @endif
                        </td> --}}
                        <td>
                            @if ($timesheetCl->nombre)
                            <center>   {{ substr($timesheetCl->nombre, 0, 12) }} </center>
                            @else
                            <center>    No hay registro </center>
                            @endif
                        </td>
                        <td>
                            @if ($timesheetCl->rfc)
                            <center>  {{ substr($timesheetCl->rfc, 0, 15) }} </center>
                            @else
                            <center>      No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->calle)
                            <center>  {{ substr($timesheetCl->calle, 0, 12) }} </center>
                            @else
                            <center>    No hay registro </center>
                            @endif
                        </td>


                        <td>
                            @if ($timesheetCl->colonia)
                            <center>   {{ substr($timesheetCl->colonia, 0, 12) }} </center>
                            @else
                            <center>    No hay registro </center>
                            @endif
                        </td>


                        <td>
                            @if ($timesheetCl->ciudad)
                            <center>   {{ substr($timesheetCl->ciudad, 0, 12) }} </center>
                            @else
                            <center>      No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->codigo_postal)
                            <center>   {{ substr($timesheetCl->codigo_postal, 0, 12) }} </center>
                            @else
                            <center>    No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->telefono)
                            <center>   {{ substr($timesheetCl->telefono, 0, 12) }} </center>
                            @else
                            <center>     No hay registro </center>
                            @endif
                        </td>
                        <td>
                            @if ($timesheetCl->pagina_web)
                            <center>    {{$timesheetCl->pagina_web}} </center>
                            @else
                            <center>    No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->nombre_contanto)
                            <center>  {{ substr($timesheetCl->nombre_contanto, 0, 15) }} </center>
                            @else
                            <center>     No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->puesto_contanto)
                            <center>   {{ substr($timesheetCl->puesto_contanto, 0, 15) }} </center>
                            @else
                            <center>   No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->correo_contanto)
                            <center>  {{ substr($timesheetCl->correo_contanto, 0, 25) }} </center>
                            @else
                            <center>   No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->celular_contanto)
                            <center>  {{ substr($timesheetCl->celular_contanto, 0, 10) }} </center>
                            @else
                            <center>    No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->objeto_descripcion)
                            <center>  {{ substr($timesheetCl->objeto_descripcion, 0, 15) }} </center>
                            @else
                            <center>   No hay registro </center>
                            @endif
                        </td>

                        <td>
                            @if ($timesheetCl->cobertura)
                            <center>   {{ substr($timesheetCl->cobertura, 0, 15) }} </center>
                            @else
                            <center>   No hay registro </center>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>

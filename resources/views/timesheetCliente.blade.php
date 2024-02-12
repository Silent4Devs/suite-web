analisis brecha

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TimeSheet Clientes</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css{{config('app.cssVersion')}}">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            font-size: 7px;
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
                    <img style="width:100%; max-width:100px; position: relative; left:2rem;" src="{{ asset($logotipo) }}">
                    @else
                        <img src="{{ asset('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif 
                </td>
                <td class="info-header">
                    <div style="position: relative; left: 3rem; text-align: justify;">
                        <p style="font-size: 15px;">
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
                    <th>Identificador</th>
                    {{-- <th>Razon Social</th> --}}
                    <th>Nombre</th>
                    <th>RFC</th>
                    <th>Calle</th>
                    <th>Colonia</th>
                    <th>Ciudad</th>
                    <th>Codigo postal</th>
                    <th>Telefono</th>
                    <th>Pagina web</th>
                    <th>Nombre Contacto</th>
                    <th>Puesto Contacto</th>
                    <th>Correo</th>
                    <th>Celular</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($timesheetCliente as  $timesheetCl)
                    <tr>
                        <td style="width: 30%;">
                            @if ($timesheetCl->identificador)
                                {{$timesheetCl->identificador}}
                            @else
                                No hay registro
                            @endif
                        
                        </td>
                        {{-- <td style="width: 40%;">
                            @if ($timesheetCl->razon_social)
                            {{$timesheetCl->razon_social}}
                            @else
                                No hay registro
                            @endif
                        </td> --}}
                        <td style="width: 30%;">
                            @if ($timesheetCl->nombre)
                            {{ substr($timesheetCl->nombre, 0, 12) }}
                            @else
                                No hay registro
                            @endif
                        </td>
                        <td style="width: 30%;">
                            @if ($timesheetCl->rfc)
                            {{ substr($timesheetCl->rfc, 0, 15) }}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->calle)
                            {{ substr($timesheetCl->calle, 0, 12) }}
                            @else
                                No hay registro
                            @endif
                        </td>


                        <td style="width: 30%;">
                            @if ($timesheetCl->colonia)
                            {{ substr($timesheetCl->colonia, 0, 12) }}
                            @else
                                No hay registro
                            @endif
                        </td>


                        <td style="width: 30%;">
                            @if ($timesheetCl->ciudad)
                            {{ substr($timesheetCl->ciudad, 0, 12) }}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->codigo_postal)
                            {{$timesheetCl->codigo_postal}}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->telefono)
                            {{$timesheetCl->telefono}}
                            @else
                                No hay registro
                            @endif
                        </td>
                        <td style="width: 60%;">
                            @if ($timesheetCl->pagina_web)
                            {{$timesheetCl->pagina_web}}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->nombre_contanto)
                            {{$timesheetCl->nombre_contanto}}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->puesto_contanto)
                            {{$timesheetCl->puesto_contanto}}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->correo_contanto)
                            {{$timesheetCl->correo_contanto}}
                            @else
                                No hay registro
                            @endif
                        </td>

                        <td style="width: 30%;">
                            @if ($timesheetCl->celular_contanto)
                            {{$timesheetCl->celular_contanto}}
                            @else
                                No hay registro
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>

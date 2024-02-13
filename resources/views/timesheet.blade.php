analisis brecha

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Timesheet</title>

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
                            Av. Insurgentes Sur 2453 piso 4, Colonia Tizapán San Ángel,
                            <br> Álvaro Obregón, C.P. 01090, C <br></p>
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
        <h2>TimeSheet</h2>

        <table>
            <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Tarea</th>
                    <th>Facturable</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Sábado</th>
                    <th>Domingo</th>
                    <th>Descripción</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($timesheet->horas as  $timesh)
                    <tr>
                        <td style="width: 20%;">{{$timesh->proyecto->proyecto}}</td>
                        <td style="width: 25%;">{{$timesh->tarea->tarea}}</td>
                        <td style="width: 10%;">{{$timesh->facturable}}</td>
                        <td style="width: 10%;">{{$timesh->horas_lunes}}</td>
                        <td style="width: 10%;">{{$timesh->horas_martes}}</td>
                        <td style="width: 10%;">{{$timesh->horas_miercoles}}</td>
                        <td style="width: 10%;">{{$timesh->horas_jueves}}</td>
                        <td style="width: 10%;">{{$timesh->horas_viernes}}</td>
                        <td style="width: 10%;">{{$timesh->horas_sabado}}</td>
                        <td style="width: 10%;">{{$timesh->horas_domingo}}</td>
                        <td style="width: 28%;">{{$timesh->descripcion}}</td>
                        <td style="width: 10%;">{{$timesh->horas_totales_tarea}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>

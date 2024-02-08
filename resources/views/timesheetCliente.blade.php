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
                    $organizacion = Organizacion::first();
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
                            Av. Insurgentes Sur 2453 piso 4,<br> Colonia Tizapán San Ángel, Álvaro Obregón, C.P. 01090, CDMX <br></p>
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
                    <th>Razon Social</th>
                    <th>Nombre</th>
                    <th>RFC</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($timesheetCliente as  $timesheetCl)
                    <tr>
                        <td>{{$timesheetCl->identificador}}</td>
                        <td>{{$timesheetCl->razon_social}}</td>
                        <td>{{$timesheetCl->nombre}}</td>
                        <td>{{$timesheetCl->rfc}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</body>
</html>

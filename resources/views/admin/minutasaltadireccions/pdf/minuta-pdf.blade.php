<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Example 1</title>
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 18cm;
            height: 29.7cm;
            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 12px;
            font-family: Arial;
        }

        header {
            padding: 10px 0;
            margin-bottom: 30px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        h1 {
            border-top: 1px solid #5D6975;
            border-bottom: 1px solid #5D6975;
            color: #5D6975;
            font-size: 2em;
            line-height: 1.4em;
            font-weight: normal;
            text-align: center;
            margin: 0 0 20px 0;
        }

        #project {
            float: left;
        }

        #project span {
            color: #5D6975;
            text-align: right;
            width: 52px;
            margin-right: 10px;
            display: inline-block;
            font-size: 0.8em;
        }

        #company {
            float: right;
            text-align: right;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;
        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 5px;
            text-align: left;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.qty,
        table td.total {
            font-size: 1.2em;
        }

        table td.grand {
            border-top: 1px solid #5D6975;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.2em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>
</head>

<body>
    <header class="clearfix">
        <div id="logo">
            <img src="{{ asset('img/logo_policromatico_2.png') }}">
        </div>
        <h1 style="background:url({{ asset('img/dimension.png') }})">MINUTA DE REUNIÓN</h1>
        {{-- <div id="company" class="clearfix">
            <div>Company Name</div>
            <div>455 Foggy Heights,<br /> AZ 85004, US</div>
            <div>(602) 519-0450</div>
            <div><a href="mailto:company@example.com">company@example.com</a></div>
        </div>
        <div id="project">
            <div><span>PROJECT</span> Website development</div>
            <div><span>CLIENT</span> John Doe</div>
            <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
            <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
            <div><span>DATE</span> August 17, 2015</div>
            <div><span>DUE DATE</span> September 17, 2015</div>
        </div> --}}
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th colspan="4">INFORMACIÓN GENERAL</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fecha&nbsp;de&nbsp;Reunión:</td>
                    <td>
                        {{ \Carbon\Carbon::parse($minutasaltadireccion->fechareunion)->format('d-m-Y') }}</td>
                    <td>Hora&nbsp;de&nbsp;inicio: </td>
                    <td>
                        {{ \Carbon\Carbon::parse($minutasaltadireccion->hora_inicio)->format('g:i A') }}</td>
                </tr>
                <tr>
                    <td>
                        Elaboró: </td>
                    <td>
                        {{ $minutasaltadireccion->responsable->name }}</td>
                    <td>Hora&nbsp;de&nbsp;término: </td>
                    <td>
                        {{ \Carbon\Carbon::parse($minutasaltadireccion->hora_termino)->format('g:i A') }}</td>
                </tr>
                <tr>
                    <td class="td_row_normal">Tema&nbsp;de&nbsp;la&nbsp;reunión: </td>
                    <td class="td_row_normal" colspan="3">
                        {{ $minutasaltadireccion->tema_reunion }}
                    </td>
                </tr>
                <tr>
                    <td class="td_row_normal">
                        Objetivo&nbsp;de&nbsp;la&nbsp;reunión: </td>
                    <td class="td_row_normal" colspan="3">
                        {{ $minutasaltadireccion->objetivoreunion }}
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th colspan="3">PARTICIPANTES</th>
                </tr>
                <tr>
                    <th>Nombre</th>
                    <th>Puesto</th>
                    <th>Firma&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($minutasaltadireccion->participantes as $participante)
                    <tr>
                        <td style="padding: 25px 5px;">{{ $participante->name }}</td>
                        <td style="padding: 25px 5px;">{{ $participante->puesto }}</td>
                        <td style="padding: 25px 5px;"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th>TEMAS TRATADOS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        {!! $minutasaltadireccion->tema_tratado !!}
                    </td>
                </tr>
            </tbody>
        </table>
        <table>
            <thead>
                <tr>
                    <th colspan="6">ACUERDOS Y COMPROMISOS</th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>ACTIVIDAD</th>
                    <th>RESPONSABLE(S)</th>
                    <th>FECHA COMPROMISO</th>
                    <th>ESTATUS</th>
                    <th>COMENTARIOS</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($actividades))
                    @foreach ($actividades as $idx => $task)
                        <tr>
                            <td>{{ $idx }}</td>
                            <td>{{ $task->name }}</td>
                            <td>
                                <ul>
                                    @foreach ($task->assigs as $assig)
                                        @php
                                            $empleado = App\Models\Empleado::getAll()->find(intval($assig->resourceId));
                                        @endphp
                                        <li>{{ $empleado->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                {{ \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp(intval($task->end) / 1000)->toDateTimeString())->format('d-m-Y') }}
                            </td>
                            <td>En Proceso</td>
                            <td>{{ $task->description }}</td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{-- <div id="notices">
            <div>NOTICE:</div>
            <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
        </div> --}}
    </main>
    <footer>
        TABANTAJ | {{ \Carbon\Carbon::parse($minutasaltadireccion->fechareunion)->format('d-m-Y') }}
    </footer>
</body>

</html>

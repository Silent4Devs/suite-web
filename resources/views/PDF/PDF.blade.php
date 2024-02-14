<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="pdf-template/style.css{{config('app.cssVersion')}}" media="all"/>
    <title>Partes interesadas</title>
</head>
<body>
<header class="clearfix">
    <div id="logo" align="center">
        <img src="img/Silent4Business-Logo-Color.png" style="width: 20%;">
    </div>
    <h4 align="center">DATOS EMPRESA</h4>

    <table style="text-align:center;" align="center">
        @switch($pdfvalue)
            @case('PartesInt')
            <thead>
            <tr>
                @foreach($cabeceras as $item)
                    <th>{{$item}}</th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$datavalues->parteinteresada}}</td>
                    <td>{{$datavalues->requisitos}}</td>
                    <td>{{$datavalues->clausula}}</td>
                </tr>
            </tbody>
            @break
            @default
            <thead>
            <tr>
                <td><h1>Try again</h1></td>
            </tr>
            </thead>
        @endswitch
    </table>
</header>


</body>
</html>

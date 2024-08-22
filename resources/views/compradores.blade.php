<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Compradores</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/requisitions/pdf.css{{config('app.cssVersion')}}">
    <style>

        body{
                text-align: justify;
        }
        .quitar{
            font-weight: normal;
            text-align: justify;
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

                   <img style="width: 100%; max-width: 100px; height: auto;" src="{{ asset($logotipo) }}">

                </td>
                <td class="info-header">
                    <div style="position: relative; right: 5rem;">
                        {{$organizacion->empresa}} <br>
                       RFC:{{$organizacion->rfc}} <br>
                        {{$organizacion->direccion}} <br>
                    </div>
                </td>
                <td class="td-blue-header">
                    <h5 style="font: normal normal medium 20px/20px Roboto;
                    letter-spacing: 0px;
                    opacity: 1;"></h5>
                    Compradores
                </td>
            </tr>
        </table>
        <br>
        <br>
            <table style="border: 1px solid black;">
                <tr>
                    <td><strong>Clave </strong> </td>
                    <td><strong>Nombre </strong> </td>
                </tr>
                <tbody>

                    @foreach ($compradores as $comprador)
                        <tr>
                            <td style="width: 20%;">{{ $comprador->clave }}</td>
                            <td style="width: 25%;">{{ $comprador->nombre }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        <hr>
    </div>
</div>
</body>
</html>

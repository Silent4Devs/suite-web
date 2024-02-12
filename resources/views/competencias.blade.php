<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Competencias</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css{{config('app.cssVersion')}}">
    <style>
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
                    @if ($logo_actual)
                    <img style="width:100%; max-width:100px; position: relative; left:2rem;" src="{{ asset( $logo_actual )}}">
                    @else
                        <img src="{{ asset('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif
                </td>
                <td class="info-header">
                    <div style="position: relative; right: 5rem; text-align: justify;">
                        {{$organizacions->empresa}} <br>
                       RFC:{{$organizacions->rfc}} <br>
                        {{$organizacions->direccion}} <br>
                    </div>
                </td>
                <td class="td-blue-header">
                    <h5 style="font: normal normal medium 20px/20px Roboto;
                    letter-spacing: 0px;
                    opacity: 1;"></h5>
                   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Competencias
                </td>
            </tr>
        </table>
        <br>
        <br>
        @foreach ($competencias as $competencia)
        <div class="">
            <table class="table-proveedor">
                <tr>
                    <td><strong> Nombre: </strong> {{$competencia->nombre}}<br> <br>
                        <strong> Descripción: </strong>  {{$competencia->descripcion}} <br> <br>
                        <strong>Tipo: </strong>   {{$competencia->tipo->nombre}}
                    </td>
                </tr>
            </table>
        </div>
        <hr>
        @endforeach
    </div>
</div>
</body>
</html>

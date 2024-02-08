<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alcance  SGSIS</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css">
    <style>
        .quitar{
            font-weight: normal;
            text-align: justify;
        }
        .textopdf{
            font-size: 11px;
            font-weight: bold;
            po
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
                    <img style="width:100%; max-width:100px; position: relative; left:1.5rem;" src="{{asset($logotipo)}}">
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
                  <br>
                  <span class="textopdf"> <strong> Reporte Determinación de  Alcance</strong></span>
                </td>
            </tr>
        </table>
        <br>
        <br>
        <div class="">
            <table class="table-proveedor">
                <tr>
                    <td><strong>{{$alcances->nombre}} </strong> <br> <br>
                        Fecha publicacion:  {{$alcances->fecha_publicacion}}  &nbsp;&nbsp;&nbsp;&nbsp;
                        Fecha revision: {{$alcances->fecha_revision}}   <br> <br>
                        <p class="quitar">{!! \Illuminate\Support\Str::limit(strip_tags($alcances->alcancesgsi), 3000) !!}</p>

                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
</body>
</html>

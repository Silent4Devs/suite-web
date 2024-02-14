<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Alcance  SGSIS</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css{{config('app.cssVersion')}}">
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
                    $organizacion = Organizacion::getFirst();
                    $logotipo = $organizacion->logotipo;
                    $empresa = $organizacion->empresa;
                    @endphp

                    @if ($logotipo)
                    <img style="width:100%; max-width:100px; position: relative; left:1.5rem;" src="{{ url($logotipo) }}">
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
        @foreach ($alcances as $alcance)
        <div class="">
            <table class="table-proveedor">
                <tr>
                    <td><strong>{{$alcance->nombre}} </strong> <br> <br>
                        Fecha publicacion:  {{$alcance->fecha_publicacion}}  &nbsp;&nbsp;&nbsp;&nbsp;
                        Fecha revision: {{$alcance->fecha_revision}}   <br> <br>
                        <p class="quitar">{!! \Illuminate\Support\Str::limit(strip_tags($alcance->alcancesgsi), 3000) !!}</p>

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

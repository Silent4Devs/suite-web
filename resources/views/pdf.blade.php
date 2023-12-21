<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Política del Sistema de Gestión</title>

    <link rel="stylesheet" href="css/requisiciones_pdf.css">
</head>
<body>

    <div class="caja-general-doc">
        <table class="encabezado">
            <tr>
                <td class="td-img-doc">
                    @if ($organizacions->logotipo)
                    {{-- <img style="width:100%; max-width:100px; position: relative; left:2rem;" src="{{asset($organizacions->logotipo)}}"> --}}
                    <img style="width:100%; max-width:100px; position: relative; left:1rem;" src="{{asset('silent.png')}}">
                    @else
                        <img src="{{ public_path('sinLogo.png') }}"  style="width:100%; max-width:150px;">
                    @endif
                </td>
                <td class="info-header">
                    <div style="position: relative; right: 5rem; text-align: justify;">
                        {{$organizacions->empresa}} <br>
                        {{$organizacions->rfc}} <br>
                        {{$organizacions->direccion}} <br>
                    </div>
                </td>
                <td class="td-blue-header">
                    <h5 style="font: normal normal medium 20px/20px Roboto;
                    letter-spacing: 0px;
                    color: #306BA9;
                    opacity: 1;"></h5>
                    Políticas del Sistema de Gestión
                </td>
            </tr>
        </table>
        <br>
        <br>
        @foreach ($politicas as $politica)
        <div class="">
            <table class="table-proveedor">
                <tr>
                    <td><strong>{{$politica->nombre_politica}} </strong> <br> <br>
                        Fecha publicacion:  {{$politica->fecha_publicacion}}  &nbsp;&nbsp;&nbsp;&nbsp;
                        Fecha revision: {{$politica->fecha_revision}}   <br> <br>
                        <p style="text-align: justify;">{{ \Illuminate\Support\Str::limit($politica->politicasgsi, 1000) }}</p>

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

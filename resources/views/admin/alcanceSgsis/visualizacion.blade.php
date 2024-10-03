@extends('layouts.admin')
@section('content')

@section('styles')
    <style type="text/css">
        .caja_titulo {
            position: relative;
            width: 100%;
        }

        .logo_organizacion_alcance {
            height: 150px;
            position: absolute;
            right: 50px;
            bottom: 0;
        }

        .caja_titulo h3 {
            color: var(--color-tbj);
            bottom: 0;
        }

        .form-group {
            color: rgb(255, 255, 255) !important;
        }

        .iconos-crear {
            color: rgb(255, 255, 255);
        }

        .dato_alcance {
            font-size: 9pt !important;
            margin-left: 25px;
        }

        .form-label {
            font-size: 9pt !important;
            font-weight: bolder !important;
            color: rgb(255, 255, 255) !important;
        }

        .card {
            border-radius: 15px;
            /* Puedes ajustar el valor según tus preferencias */
            overflow: hidden;
            /* Asegura que las esquinas redondas se apliquen correctamente */
        }

        .encabezado {
            background: #FFF5DF;
            color: #606060;
            /* Color del texto en el encabezado */
            padding: 10px;
            /* Ajusta el espaciado interno del encabezado */
            border-top-left-radius: 15px;
            /* Aplica esquinas redondeadas solo en la esquina superior izquierda */
            border-top-right-radius: 15px;
            /* Aplica esquinas redondeadas solo en la esquina superior derecha */
            position: relative;
            top: 2rem;
        }

        .quitar {
            font-weight: normal;
        }
    </style>
@endsection
<h5 class="col-12 titulo_general_funcion">Alcances: <strong> {{ $organizacions->empresa }}</strong></h5>

@if ($alcances->isEmpty())
    <div class="row">
        <h4 class="alert-heading">¡Aún no hay alcances aprobadas!</h4>
    </div>
@else
    @foreach ($alcances as $data)
        <div class="encabezado">
            <h6><strong>{{ $data->nombre ?: 'Nombre: No definido' }}</strong></h6>
            <p class="quitar">Fecha de publicación :
                {{ $data->fecha_publicacion ?: 'Fecha de publicación: No definido' }}</p>
            <br>
            <div class="d-flex justify-content-end" style="position: relative; top: -2rem; right: 2rem;">@livewire('aceptar-alcance', ['id_alcance' => $data->id])
            </div>
        </div>
        <div class="card card-body">
            <div class="col-sm-12 d-flex align-items-center">
                <div>
                    <p class="quitar">{!! \Illuminate\Support\Str::limit(strip_tags($data->alcancesgsi), 1050) !!}</p>
                </div>
                <div class="ml-auto">
                    <img src="{{ asset('comite.png') }}" alt="Imagen del Comité">
                </div>
            </div>
        </div>
    @endforeach
@endif


@endsection

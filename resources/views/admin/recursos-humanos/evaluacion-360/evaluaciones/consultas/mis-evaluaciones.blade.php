@extends('layouts.admin')
@section('content')

    @if (!$equipo)
        {{ Breadcrumbs::render('EV360-Evaluacion-Consulta-Evaluado', ['evaluacion' => $evaluacion, 'evaluado' => $evaluado]) }}
    @endif

    <style>
        .fs-consulta {
            font-size: 11px;
        }

        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(40px at 50% 50%);
            height: 20px;
        }

    </style>
    <style>
        .lds-facebook {
            display: inline-block;
            position: relative;
            width: 80px;
            height: 80px;
        }

        .lds-facebook div {
            display: inline-block;
            position: absolute;
            left: 8px;
            width: 16px;
            background: rgb(24, 24, 24);
            animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
        }

        .lds-facebook div:nth-child(1) {
            left: 8px;
            animation-delay: -0.24s;
        }

        .lds-facebook div:nth-child(2) {
            left: 32px;
            animation-delay: -0.12s;
        }

        .lds-facebook div:nth-child(3) {
            left: 56px;
            animation-delay: 0;
        }

        @keyframes lds-facebook {
            0% {
                top: 8px;
                height: 64px;
            }

            50%,
            100% {
                top: 24px;
                height: 32px;
            }
        }

        .display-almacenando {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 15px;
            z-index: 2;
            margin-left: -15px;
            background: #0000000d;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .display-almacenando h1 {
            font-size: 50px;
        }

        .display-almacenando p {
            font-size: 30px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white">
                <strong>{{ $equipo ? 'Evaluaciones De Mi Equipo' : 'Mis Evaluaciones' }}</strong> </h3>
        </div>
        <div class="card-body">
            <div class="col-12">
                @if ($equipo)
                    @livewire('consulta-de-evaluciones', ['evaluacion' => $evaluacion->id,
                    'evaluado'=>$evaluado->id,'equipo'=>$equipo,'evaluador'=>$evaluador->id])
                @else
                    @livewire('consulta-de-evaluciones', ['evaluacion' =>
                    $evaluacion->id,'evaluado'=>$evaluado->id,'equipo'=>$equipo])
                @endif
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection

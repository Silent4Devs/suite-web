@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('EV360-Evaluaciones-Create') }}
    <style>
        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(13px at 50% 50%);
            height: 26px;
        }

        table {
            height: 1px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong>Evaluaciones del empleado:</strong>
                {{ $empleado->name }}
            </h3>
        </div>
        <div class="card-body">
            <div class="row">
                @foreach ($lista_evaluaciones as $evaluacion)
                    <div class="card col-3 col-offset-1">
                        <div class="card-body">
                            <h5 class="card-title">{{ $evaluacion['nombre'] }}</h5>
                            <small><i class="mr-1 fas fa-calendar"></i>{{ $evaluacion['fecha_inicio'] }} - <i
                                    class="mr-1 fas fa-calendar"></i>{{ $evaluacion['fecha_fin'] }}</small>
                            <div class="text-center" style="font-size: 60px">
                                <i class="fas fa-poll-h"></i>
                            </div>
                            <a class="btn btn-sm btn-primary"
                                href="{{ route('admin.ev360-evaluaciones.autoevaluacion.consulta.evaluado', [
    'evaluacion' => $evaluacion['id'],
    'evaluado' => $empleado->id,
]) }}"
                                class="card-link"><i class="mr-1 fas fa-link"></i>Ver evaluación</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent

@endsection

@extends('layouts.admin')
@section('content')
    <style>
        span.errors {
            font-size: 11px;
        }

        #sig-evaluador-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        #sig-evaluado-canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(35px at 50% 50%);
            height: 70px;
        }

        .card-custom {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            padding: 10px;
            margin: auto;
            text-align: center;
            height: 100%;
            font-family: arial;
        }

        .title-custom {
            color: grey;
            font-size: 14px;
        }
    </style>

    <h5 class="col-12 titulo_general_funcion">Evaluación: {{ $data_evaluacion->nombre }}</h5>

    <div class="mt-4 card">
        <div class="pt-0 card-body mt-4 col-12">
            <table class="datatable-rds" style="width: 100%;">
                <thead>
                    <th>
                        Nombre de la evaluación
                    </th>
                    <th>
                        Fecha de creación
                    </th>
                    <th>
                        Autoevaluación
                    </th>
                    <th>
                        Evaluaciones a realizar
                    </th>
                </thead>
                <tbody>
                    <td>
                        {{ $data_evaluacion->nombre }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data_evaluacion->fecha_fin)->format('d-m-Y') }}
                    </td>
                    <td>
                        {{ \Carbon\Carbon::parse($data_evaluacion->fecha_fin)->format('d-m-Y') }}
                    </td>
                    <td>
                        @foreach ($evaluaciones_a_realizar as $evaluar)
                            <a
                                href="{{ url('admin/recursos-humanos/evaluacion-360/evaluaciones/' . $data_evaluacion->id . '/evaluacion/' . $evaluar->empleado_evaluado->id . '/' . $usuario->empleado->id) }}">
                                <img style=""
                                    src="{{ asset('storage/empleados/imagenes/') }}/{{ $evaluar->empleado_evaluado->avatar }}"
                                    class="rounded-circle" alt="{{ $evaluar->empleado_evaluado->name }}"
                                    title="{{ $evaluar->empleado_evaluado->name }}">
                                @if ($evaluar->evaluado)
                                    <i class="fas fa-check-circle"
                                        style="position: relative; top: 0; left: -20px; z-index: 1; color: #002102; text-shadow: 1px 1px 0px gainsboro;"></i>
                                @endif
                            </a>
                        @endforeach
                    </td>
                </tbody>
            </table>
        </div>
    </div>
@endsection

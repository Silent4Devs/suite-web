@extends('layouts.admin')
@section('content')


    <style>

        
        span.errors {
            font-size: 11px;
        }

        canvas {
            border: 2px dotted #CCCCCC;
            border-radius: 15px;
            cursor: crosshair;
        }

        canvas {
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

        .circulo-rojo {
            width: 100px;
            height: 100px;
            -moz-border-radius: 20%;
            -webkit-border-radius: 20%;
            border-radius: 50%;
            background: #FF417B;
        }

        .circulo-naranja {
            width: 10px;
            height: 10px;
            -moz-border-radius: 10%;
            -webkit-border-radius: 10%;
            border-radius: 50%;
            background: #FFCB63;
        }

        @media print {
            header {
                display: none !important;
            }

            .ps__rail-y {
                display: none !important;
            }

            .ps__thumb-y {
                display: none !important;
            }

            .titulo_general_funcion {
                display: none !important;
            }

            #sidebar {
                display: none !important;
            }

            body {
                background-color: #fff !important;
            }

            #but {
                display: none !important;
            }

            .datos_der_cv {
                margin-right: -50px !important;


            }

            .table th td:nth-child(1) {
                min-width: 100px;
            }
            .print-none{
            display: none !important;
            }
        }
    </style>

<div class="print-none">
    {{ Breadcrumbs::render('admin.tratamiento-riesgos.show') }}
</div>

    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">

                    <button class="btn btn-danger print-none" style="position: absolute; right:20px;" onclick="javascript:window.print()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button>

                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::first();
                        $logotipo = $organizacion->logotipo;
                        $empresa = $organizacion->empresa;
                    @endphp

                    <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                        <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                            <img src="{{ asset($logotipo) }}" class="mt-2" style="width:90px;">
                        </div>
                        <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                            <span
                                style="font-size:13px; text-transform: uppercase;color:#345183;">{{ $empresa }}</span>
                            <br>
                            <span style="color:#345183; font-size:15px;"><strong>Plan de Tratamiento</strong></span>

                        </div>
                        <div class="col-3 p-2">
                            <span style="color:#345183;">Fecha:
                                {{ \Carbon\Carbon::parse($tratamientoRiesgo->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">ID Riesgo:</span>
                        <strong>{{ $tratamientoRiesgo->identificador ? $tratamientoRiesgo->identificador : 'sin registro' }}</strong>
                    </div>


                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Fecha compromiso:</span>
                        <strong>{{ \Carbon\Carbon::parse($tratamientoRiesgo->fechacompromiso)->format('d-m-Y') }}</strong>
                        </span>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Proceso:</span>
                        <strong>{{ $tratamientoRiesgo->proceso ? $tratamientoRiesgo->proceso->nombre : 'Sin registro' }}</strong>
                        </span>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Dueño del riesgo:</span>

                        <strong>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->name : 'sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Puesto:</span>

                        <strong>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->puesto : 'sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Área:</span>

                        <strong>{{ $tratamientoRiesgo->responsable ? $tratamientoRiesgo->responsable->area->area : 'sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Inversión requerida:</span>
                        @if ($tratamientoRiesgo->inversion_requerida == 1)
                            <strong style="text-align:left">Sí</strong>
                        @elseif($tratamientoRiesgo->inversion_requerida == 0)
                            <strong style="text-align:left">No</strong>
                        @else
                            <strong style="text-align:left">No hay dato</strong>
                        @endif
                    </div>


                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Descripción del Riesgo</span>

                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Tipo de Riesgo:</span>

                        @if ($tratamientoRiesgo->tipo_riesgo == 1)
                            <strong style="text-align:left">Positivo</strong>
                        @elseif($tratamientoRiesgo->tipo_riesgo == 0)
                            <strong style="text-align:left">Negativo</strong>
                        @else
                            <strong style="text-align:left">No hay dato</strong>
                        @endif
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Riesgo Total:</span>
                        @if ($tratamientoRiesgo->riesgototal == null)
                        <span>Sin registro</span>
                        @else
                        @if ($tratamientoRiesgo->riesgototal <= 185)
                            <i class="fas fa-circle" style="color:#FF417B;font-size:10pt;"></i><strong>
                                {{ $tratamientoRiesgo->riesgototal }}</strong>
                        @elseif ($tratamientoRiesgo->riesgototal  <= 135)
                            <i class="fas fa-circle" style="color:#FFAC6A;font-size:10pt;"></i><strong>
                                {{ $tratamientoRiesgo->riesgototal }}</strong>
                        @elseif ($tratamientoRiesgo->riesgototal >= 90)
                            <i class="fas fa-circle" style="color:#FFCB63;font-size:10pt;"></i>
                            {{ $tratamientoRiesgo->riesgototal }}</strong>
                        @elseif ($tratamientoRiesgo->riesgototal <= 45)
                        <i class="fas fa-circle" style="color:#6DC866;font-size:10pt;"></i>
                        {{ $tratamientoRiesgo->riesgototal }}</strong>
                        @endif
                        @endif
                    </div>

                    <div style="color:#18183c">
                        {{$tratamientoRiesgo->riesgo_total_residual}}
                        <span class="p-1" style="text-align:center">Riesgo Residual:</span>
                        @if (is_null($tratamientoRiesgo->riesgo_total_residual))
                        <span>Sin registro</span>
                        @else
                        @if ($tratamientoRiesgo->riesgo_total_residual <= 185)
                        <i class="fas fa-circle" style="color:#FF417B;font-size:10pt;"></i><strong>
                            {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                        @elseif ($tratamientoRiesgo->riesgo_total_residual <= 135)
                        <i class="fas fa-circle" style="color:#FFAC6A;font-size:10pt;"></i><strong>
                            {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                        @elseif ($tratamientoRiesgo->riesgo_total_residual >= 90)
                            <i class="fas fa-circle" style="color:#FFCB63;font-size:10pt;"></i><strong>
                                {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                        @elseif ($tratamientoRiesgo->riesgo_total_residual <= 45)
                            <i class="fas fa-circle" style="color: #6DC866;font-size:10pt;"></i><strong>
                                {{ $tratamientoRiesgo->riesgo_total_residual }}</strong>
                       
                        @endif
                        @endif

                    </div>


                    <div class="col-12 m-0 p-0" style="color:#18183c">
                        <br>
                        {!! $tratamientoRiesgo->descripcionriesgo !!}
                    </div>


                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Acciones de tratamiento</span>
                    </div>

                    <div class="col-12 m-0 p-0" style="color:#18183c">
                        {!! $tratamientoRiesgo->acciones !!}
                    </div>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Participantes</span>
                    </div>

                    @foreach ($tratamientoRiesgo->participantes as $participante)
                        <span style="color:#18183c">Nombre:<strong> {{ $participante->name }}</strong></span>
                        <br>
                        <span style="color:#18183c">Puesto:<strong> {{ $participante->puesto }}</strong></span>
                        <br>
                        <span style="color:#18183c">Área:<strong> {{ $participante->area->area }}</strong></span>
                        <br>
                    @endforeach








                </div>

            </div>
        </div>

    </div>
@endsection

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

            .print-none {
                display: none !important;
            }
        }
    </style>
    <div class="print-none">
        {{ Breadcrumbs::render('admin.auditoria-anuals.create') }}
    </div>
    <h5 class="col-12 titulo_general_funcion">Programa Anual de Auditoría</h5>
    <div class="card card-body" style="background-color: #5397D5; color: #fff;">
        <div class="d-flex" style="gap: 25px;">
            <img src="{{ asset('assets/Imagen 2@2x.png') }}" alt="jpg" style="width:200px;" class="mt-2 mb-2 ml-2 img-fluid">
            <div>
                <br>
                <br>
                <h4>¿Qué es Programa Anual de Auditoria?   </h4>
                <p>
                    Plan para evaluar regularmente el sistema de seguridad de la información de la empresa.
                </p>
                <p>
                    Asegurándote de que todo esté en orden y proporcionando oportunidades para hacer mejoras si es necesario.
                </p>
            </div>
        </div>
    </div>
    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <a href="{{ route('admin.auditoria-anuals.index') }}" class="btn_cancelar">Regresar</a>
                    <button class="btn btn-danger print-none" style="position: absolute; right:20px;"
                        onclick="javascript:window.print()">
                        <i class="fas fa-print"></i>
                        Imprimir
                    </button>

                    @php
                        use App\Models\Organizacion;
                        $organizacion = Organizacion::getFirst();
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
                            <span style="color:#345183; font-size:15px;"><strong>Programa Anual de Auditoría</strong></span>

                        </div>
                        <div class="col-3 p-2">
                            <span style="color:#345183;">Fecha:
                                {{ \Carbon\Carbon::parse($auditoriaAnual->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Nombre:</span>
                        <strong>{{ $auditoriaAnual->nombre ? $auditoriaAnual->nombre : 'sin registro' }}</strong>
                    </div>


                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Fecha Inicio:</span>
                        <strong>{{ $auditoriaAnual->fechafin ? \Carbon\Carbon::parse($auditoriaAnual->fechainicio)->format('d-m-Y') : 'Sin registro' }}</strong>
                        </span>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Fecha Fin:</span>
                        <strong>{{ $auditoriaAnual->fechafin ? \Carbon\Carbon::parse($auditoriaAnual->fechafin)->format('d-m-Y') : 'Sin registro' }}</strong>
                        </span>
                    </div>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Objetivo de la Auditoría</span>
                    </div>

                    <span style="text-align: justify; color:#18183c;">{!! $auditoriaAnual->objetivo ? $auditoriaAnual->objetivo : 'Sin registro' !!}</span>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Alcance de la Auditoría</span>
                    </div>

                    <span style="text-align: justify; color:#18183c;">{!! $auditoriaAnual->alcance ? $auditoriaAnual->alcance : 'Sin registro' !!}</span>

                </div>
            </div>
        </div>

    </div>
@endsection

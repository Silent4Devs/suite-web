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
        {{ Breadcrumbs::render('admin.auditoria-internas.create') }}
    </div>

    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <a href="{{ route('admin.auditoria-internas.index') }}" class="btn_cancelar">Regresar</a>
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
                            <span style="color:#345183; font-size:15px;"><strong>Informe de Auditoría</strong></span>

                        </div>
                        <div class="col-3 p-2">
                            <span style="color:#345183;">Fecha:
                                {{ \Carbon\Carbon::parse($auditoriaInterna->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">ID Auditoría:</span>
                        <strong>{{ $auditoriaInterna->id_auditoria ? $auditoriaInterna->id_auditoria : 'Sin registro' }}</strong>
                    </div>

                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Nombre de la Auditoría:</span>
                        <strong>{{ $auditoriaInterna->nombre_auditoria ? $auditoriaInterna->nombre_auditoria : 'Sin registro' }}</strong>
                    </div>


                    <div style="color:#18183c">
                        <span class="p-1" style="text-align:center">Fecha Inicio:</span>
                        <strong>{{ \Carbon\Carbon::parse($auditoriaInterna->fecha_inicio)->format('d-m-Y') }}</strong>
                        </span>
                    </div>


                    @if ($auditoriaInterna->lider == null)
                        <span class="p-1" style="text-align:center">Auditor:</span>

                        <strong>{{ $auditoriaInterna->auditor_externo ? $auditoriaInterna->auditor_externo : 'Sin registro' }}</strong>
                    @else
                        <div style="color:#18183c">

                            <span class="p-1" style="text-align:center">Auditor:</span>

                            <strong>{{ $auditoriaInterna->lider ? $auditoriaInterna->lider->name : 'Sin registro' }}</strong>
                        </div>

                        <div style="color:#18183c">

                            <span class="p-1" style="text-align:center">Puesto:</span>

                            <strong>{{ $auditoriaInterna->lider ? $auditoriaInterna->lider->puesto : 'Sin registro' }}</strong>
                        </div>

                        <div style="color:#18183c">

                            <span class="p-1" style="text-align:center">Área:</span>

                            <strong>{{ $auditoriaInterna->lider ? $auditoriaInterna->lider->area->area : 'Sin registro' }}</strong>
                        </div>
                    @endif

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Objetivo de la Auditoría</span>
                    </div>

                    <span style="text-align: justify; color:#18183c;">{!! $auditoriaInterna->objetivo ? $auditoriaInterna->objetivo : 'Sin registro' !!}</span>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Alcance de la Auditoría</span>
                    </div>

                    <span style="text-align: justify; color:#18183c;">{!! $auditoriaInterna->alcance ? $auditoriaInterna->alcance : 'Sin registro' !!}</span>


                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Equipo de auditoría</span>
                    </div>

                    <div style="color:#18183c;">
                        @forelse ($auditoriaInterna->equipo as $equipoAuditoria)
                            <span>Nombre:<strong>
                                    {{ $equipoAuditoria->name ? $equipoAuditoria->name : 'Sin registro' }}</strong></span>
                            <br>
                            <span>Puesto:<strong>
                                    {{ $equipoAuditoria->puesto ? $equipoAuditoria->puesto : 'Sin registro' }}</strong></span>
                            <br>
                            <span>Área:<strong>
                                    {{ $equipoAuditoria->area ? $equipoAuditoria->area->area : 'Sin registro' }}</strong></span>
                            <br>
                        @empty
                            <strong>Sin registro</strong>
                        @endforelse
                    </div>
                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Hallazgos</span>
                    </div>

                    <table class="table">
                        <thead class="head-light">
                            <tr>
                                <th scope="col-6">Incumplimiento</th>
                                <th scope="col-6">Descripción</th>
                                <th scope="col-6">Clasificación</th>
                                <th scope="col-6">Proceso relacionado</th>
                                <th scope="col-6">Área relacionada</th>

                            </tr>
                        </thead>
                        <tbody>
                            @forelse($auditoriaInterna->auditoriaHallazgos as $hallazgo)
                                <tr>
                                    <td style="min-width:130px;">
                                        {{ $hallazgo->incumplimiento_requisito ? $hallazgo->incumplimiento_requisito : 'Sin registro' }}
                                    </td>
                                    <td style="min-width:100px;">
                                        {{ $hallazgo->descripcion ? $hallazgo->descripcion : 'Sin registro' }}</td>
                                    <td style="min-width:100px;">
                                        {{ $hallazgo->clasificacion_hallazgo ? $hallazgo->clasificacion_hallazgo : 'Sin registro' }}
                                    </td>
                                    <td style="min-width:100px;">
                                        {{ $hallazgo->procesos ? $hallazgo->procesos->nombre : 'n/a' }}</td>
                                    <td style="min-width:100px;">{{ $hallazgo->areas ? $hallazgo->areas->area : 'n/a' }}
                                    </td>

                                </tr>
                            @empty
                                <strong>Sin registro</strong>
                            @endforelse


                        </tbody>
                    </table>






                </div>

            </div>
        </div>

    </div>
@endsection

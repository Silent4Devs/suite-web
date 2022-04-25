@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .datos_der_cv {
            color: #fff;

        }

        .tabla_verde {
            color: #fff !important;
        }

        .tabla_verde.table-striped tbody tr:nth-of-type(odd),
        table.table tbody tr:nth-child(even) {
            background-color: rgba(0, 0, 0, 0);
        }

        .tabla_verde th {
            background-color: rgb(0, 0, 0, 0) !important;
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
                            <span style="color:#345183; font-size:15px;"><strong>Acción Correctiva:
                                    {{ $accionCorrectiva->tema ?? 'sin registro' }}</strong></span>

                        </div>
                        <div class="col-3 p-2">
                            <span style="color:#345183;">Fecha:
                                {{ \Carbon\Carbon::parse($accionCorrectiva->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>


                    {{-- <div class="row">
                        <div class="col-5">
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193">Reportó</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#345183">Puesto</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#345183">Área</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183"></span>
                                </div>
                            </div>


                        </div>
                        <div class="col-4">
                            <div class="row">
                                <div class="col-7">
                                    <strong style="color:#345183">ID del riesgo</strong>
                                </div>
                                <div class="col-5">
                                    <span style="color:#345183"></span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-7">
                                    <strong style="color:#345183">Implementación del cambio </strong>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-7">
                                    <strong style="color:#345183">Impacto del riesgo evaluado</strong>
                                </div>
                                <div class="col-5">

                                </div>
                            </div>

                        </div>
                        <div class="col-3">
                            <strong style="color:#345183">Fecha de riesgo levantado</strong>
                            <br>
                            <span style="color:#345183"></span>
                            <br>
                            <strong style="color:#345183">Fecha de aprobación del riesgo</strong>
                            <br>
                            <span style="color:#345183"></span>
                            <br>
                            <strong style="color:#345183">Probabilidad del riesgo evaluado</strong>
                            <br>
                            <span style="color:#345183"></span>
                        </div>
                    </div> --}}

                    <div class="mb-5 d-flex" style="margin-left: 70%;position: absolute;">
                        <div style="width:60px; border: 1px solid #ccc; border-radius: 3px;">
                            <span class="p-2" style="text-align:center; color:#0CA193">Folio</span>
                        </div>
                        <div
                            style="margin-left:-3px; width:90px; background-color:#0CA193;border: 1px solid #0CA193; border-radius: 3px;">
                            <span class="p-2"
                                style="color:#fff">{{ $accionCorrectiva->folio ?? 'sin registro' }}</span>
                        </div>
                    </div>

                    <br>
                    <div class="row ml-2 mt-5 p-2" style="border: 2px solid #ccc; border-radius: 3px;">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Reportó</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183">
                                        {{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->name : 'Sin definir' }}
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Puesto</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183">
                                        {{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->puesto : 'Sin definir' }}
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Registró</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183">
                                        {{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->name : 'Sin definir' }}
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Puesto</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183">
                                        {{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->puesto : 'Sin definir' }}
                                    </span>
                                </div>
                            </div>

                        </div>

                        <div class="col-5">
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Fecha de registro</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183">
                                        {{ $accionCorrectiva->fecharegistro? \Carbon\Carbon::parse($accionCorrectiva->fecharegistro)->format('d-m-Y'): 'sin registro' }}
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Causa de origen</strong>
                                </div>
                                <div class="col-6">
                                    <span style="color:#345183">
                                        {{ $accionCorrectiva->causaorigen ?? 'sin registro' }}
                                    </span>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-6">
                                    <strong style="color:#0CA193;">Estatus</strong>
                                </div>
                                <div class="col-6">
                                    {{-- <span style="color:#345183">
                                        {{$accionCorrectiva->estatus ?? 'sin registro' }}
                                    </span> --}}
                                    @switch ($accionCorrectiva->estatus)
                                        @case(1)
                                            <div class="cuadro_verdelimon">{{ $accionCorrectiva->estatus }}</div>
                                        @break

                                        @case(2)
                                            <div class="cuadro_verde">{{ $accionCorrectiva->estatus }}</div>
                                        @break

                                        @case(3)
                                            <div class="cuadro_amarillo">{{ $accionCorrectiva->estatus }}</div>
                                        @break

                                        @case(4)
                                            <div class="cuadro_naranja">{{ $accionCorrectiva->estatus }}</div>
                                        @break

                                        @case(5)
                                            <div class="cuadro_rojo">{{ $accionCorrectiva->estatus }}</div>
                                        @break

                                        ;

                                        @default
                                            <span>No hay registro</span>
                                    @endswitch
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row medidas d-flex" style="justify-content: space-between;">


                        <div class="mt-4 mb-3 ">

                            <div class="ml-4 mt-2 mb-3  dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold; ml-4">
                                    Descripción</span>
                            </div>
                            <div class="form-group ml-4">
                                <span style="text-align: justify;">{!! $accionCorrectiva->descripcion ?? 'sin registro' !!} </span>
                            </div>
                            <div class="ml-4 mt-2 mb-3  dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold; ml-4">
                                    Método utilizado</span>


                            </div>

                            @foreach ($accionCorrectiva->analisis as $analisis)
                                <span class="ml-5"
                                    style="font-size:11pt;color:#0CA193"><strong>{{ $analisis->metodo ?? 'sin registro' }}</strong></span>
                                <br>
                                <br>
                                <div class="ml-4" style="text-align: justify !important;">
                                    <span
                                        style="font-size:11pt; text-align: justify !important;">{!! $analisis->ideas ?? 'sin registro' !!}</span>

                                </div>
                                <br>
                            @endforeach




                            <div class="ml-4 mt-2 mb-3  dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold; ml-4">
                                    Atención de la Acción Correctiva</span>
                            </div>

                            <div class="row ml-2">
                                <div class="col-sm-12 col-lg-12 col-md-12">
                                    <div class="col-12">
                                        <span class="p-2" style="text-align:center;"><strong
                                                style="color:#0CA193">Fecha de cierre</strong>
                                            {{ $accionCorrectiva->fecha_cierre ?? 'Sin registro' }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="ml-4 mt-2 mb-3  dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold; ml-4">
                                    Plan de Acción </span>
                            </div>

                            <div class="mt-4 datatable-fix" style="width: 100%;">
                                <table id="tabla_plan_accion" class="table w-100">
                                    <thead style="background-color:#0CA193;color:#fff">
                                        <tr>
                                            <th>Actividad</th>
                                            <th>Fecha&nbsp;de&nbsp;inicio</th>
                                            <th>Fecha&nbsp;de&nbsp;fin</th>
                                            <th>Prioridad</th>
                                            <th>Tipo</th>
                                            <th>Responsable(s)</th>
                                            <th>Comentarios</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($actividades as $actividad)
                                            <tr>
                                                <td>{{ $actividad->actividad }}</td>
                                                <td>{{ $actividad->fecha_inicio }}</td>
                                                <td>{{ $actividad->fecha_fin }}</td>
                                                <td>{{ $actividad->prioridad }}</td>
                                                <td>{{ $actividad->tipo }}</td>
                                                <td>
                                                    <ul>
                                                        @foreach ($actividad->responsables as $responsable)
                                                            <li>{{ $responsable->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td>{{ !is_null($actividad->comentarios) ? $actividad->comentarios : 'Sin comentarios' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- <div class="form-group">
                                <span style="text-align: justify;"><strong style="color:#0CA193;">Área(s) afectada(s) : </strong>{{$accionCorrectiva->areas ?? 'sin registro' }}  </span>
                            </div>
                            <div class="form-group">
                                <span style="text-align: justify;"><strong style="color:#0CA193;">Proceso(s) afectado(s) : </strong>{{$accionCorrectiva->procesos ?? 'sin registro' }}  </span>
                            </div>
                            <div class="form-group">
                                <span style="text-align: justify;"><strong style="color:#0CA193;">Activo(s) afectado(s) : </strong>{{$accionCorrectiva->activos ?? 'sin registro' }}  </span>
                            </div>
                            <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #0CA193;">
                                <span style="font-size: 17px; font-weight: bold;">
                                    Comentarios</span>
                            </div>
                            <div class="form-group">
                                <span style="text-align: justify;">{!!$accionCorrectiva->comentarios ?? 'sin registro' !!}  </span>
                            </div> --}}
                        </div>
                        {{-- <table class="w-100 mb-5 mt-5">
                            <thead style="background-color:#0CA193;color:#fff;text-align:center">
                                <tr>
                                    <th style = "width: 50% !important;">
                                        Reportó
                                    </th>
                                    <th style = "width: 50% !important;">
                                        Registró
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="text-align:center; vertical-align: initial;">
                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $accionCorrectiva->reporto->name ? $accionCorrectiva->reporto->avatar : "user.png"}}"
                                            class="img_empleado text-center mt-1">
                                        <br>
                                        <span><strong>{{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->name : 'Sin definir' }}</strong></span>
                                        <br>
                                        <span>{{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->puesto : 'Sin definir'}}</span>
                                        <br>
                                        <span style="color:#0CA193">{{$accionCorrectiva->reporto ? $accionCorrectiva->reporto->area->area : 'Sin definir'  }}</span>
                                    </td>


                                    <td style="text-align:center; vertical-align: initial;">
                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->avatar : "user.png"}}"
                                            class="img_empleado text-center mt-1">
                                        <br>
                                        <span><strong>{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->name : 'Sin definir' }}</strong></span>
                                        <br>
                                        <span>{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->puesto : 'Sin definir'}}</span>
                                        <br>
                                        <span style="color:#0CA193">{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->area->area : 'Sin definir' }}</span>

                                    </td>
                                </tr>
                            </tbody>
                        </table> --}}
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>
@endsection
@section('scripts')
    {{-- <script>
    function imprim1(imp1) {
        var printContents = document.getElementById('imp1').innerHTML;
        w = window.open();
        w.document.write(printContents);
        w.document.close(); // necessary for IE >= 10
        w.focus(); // necessary for IE >= 10
        w.print();
        w.close();
        return true;
    }
</script> --}}
@endsection

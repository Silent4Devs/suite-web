@extends('layouts.admin')
@inject('Empleado', 'App\Models\Empleado')
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

            .print-none {
                display: none !important;
            }
        }
    </style>


    <div>
        <div class="mt-4 row justify-content-center">
            <div class="card col-sm-12 col-md-10">
                <div class="card-body">
                    <a href="{{ route('admin.accion-correctivas.index') }}" class="btn_cancelar">Regresar</a>
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
                            <span style="color:#345183; font-size:15px;"><strong>Acción Correctiva:
                                    {{ $accionCorrectiva->tema ?? 'sin registro' }}</strong></span>

                        </div>
                        <div class="col-3 p-2">
                            <span style="color:#345183;">Fecha:
                                {{ \Carbon\Carbon::parse($accionCorrectiva->created_at)->format('d-m-Y') }}
                            </span>
                        </div>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Folio:</span>

                        <strong>{{ $accionCorrectiva->folio ?? 'sin registro' }}</strong>
                    </div>
                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Fecha de registro:</span>

                        <strong>{{ $accionCorrectiva->fecharegistro ? \Carbon\Carbon::parse($accionCorrectiva->fecharegistro)->format('d-m-Y') : 'sin registro' }}
                        </strong>
                    </div>
                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Reportó:</span>

                        <strong>{{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->name : 'Sin definir' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Puesto:</span>

                        <strong>{{ $accionCorrectiva->reporto ? $accionCorrectiva->reporto->puesto : 'Sin definir' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Registró:</span>

                        <strong>{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->name : 'Sin definir' }}</strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Puesto:</span>

                        <strong>{{ $accionCorrectiva->empleados ? $accionCorrectiva->empleados->puesto : 'Sin definir' }}
                        </strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Causa de origen:</span>

                        <strong>{{ $accionCorrectiva->causaorigen ?? 'sin registro' }}
                        </strong>
                    </div>

                    <div style="color:#18183c">

                        <span class="p-1" style="text-align:center">Estatus:</span>
                        @if (is_null($accionCorrectiva->estatus))
                            <span>Sin registro</span>
                        @else
                            @if ($accionCorrectiva->estatus == 'Sin atender')
                                <i class="fas fa-circle" style="color:#FFCB63;font-size:10pt;"></i><strong>
                                    {{ $accionCorrectiva->estatus }}</strong>
                            @elseif ($accionCorrectiva->estatus == 'En curso')
                                <i class="fas fa-circle" style="color:"#AC84FF;font-size:10pt;"></i><strong>
                                    {{ $accionCorrectiva->estatus }}</strong>
                            @elseif ($accionCorrectiva->estatus = 'En espera')
                                <i class="fas fa-circle" style="color:#6863FF;font-size:10pt;"></i><strong>
                                    {{ $accionCorrectiva->estatus }}</strong>
                            @elseif ($accionCorrectiva->estatus == 'Cerrado')
                                <i class="fas fa-circle" style="color: #6DC866;font-size:10pt;"></i><strong>
                                    {{ $accionCorrectiva->estatus }}</strong>
                            @elseif ($accionCorrectiva->estatus == 'No procedente')
                                <i class="fas fa-circle" style="color: #6DC866;font-size:10pt;"></i><strong>
                                    {{ $accionCorrectiva->estatus }}</strong>
                            @endif
                        @endif
                    </div>


                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Descripción</span>
                    </div>

                    <div class="col-12 m-0 p-0" style="color:#18183c">
                        {!! $accionCorrectiva->descripcion ?? 'sin registro' !!}
                    </div>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Análisis Causa Raíz</span>
                    </div>
                    @forelse ($accionCorrectiva->analisis as $analisis)
                        <strong style="color:#18183c">Metodo: {{ $analisis->metodo }}</strong>
                    @empty
                        <strong style="color:#18183c">Sin registro</strong>
                    @endforelse
                    <br>
                    <br>
                    @foreach ($accionCorrectiva->analisis as $analisis)
                        @if ($analisis->metodo == '5 Porqués (5 Why)')
                            <div style="color:#18183c">
                                <p>{{ $analisis->problema_porque ? $analisis->problema_porque : 'Sin registro' }}</p>
                            </div>
                            <div style="color:#18183c">
                                <strong>1. ¿Por qué? </strong>
                                <p>{{ $analisis->porque_1 ? $analisis->porque_1 : 'Sin registro' }}</p>
                            </div>
                            <div style="color:#18183c">
                                <strong>2. ¿Por qué? </strong>
                                <p>{{ $analisis->porque_2 ? $analisis->porque_2 : 'Sin registro' }}</p>
                            </div>
                            <div style="color:#18183c">
                                <strong>3. ¿Por qué? </strong>
                                <p>{{ $analisis->porque_3 ? $analisis->porque_3 : 'Sin registro' }}</p>
                            </div>
                            <div style="color:#18183c">
                                <strong>4. ¿Por qué? </strong>
                                <p>{{ $analisis->porque_4 ? $analisis->porque_4 : 'Sin registro' }}</p>
                            </div>
                            <div style="color:#18183c">
                                <strong>5. ¿Por qué? </strong>
                                <p>{{ $analisis->porque_5 ? $analisis->porque_5 : 'Sin registro' }}</p>
                            </div>
                        @elseif($analisis->metodo == 'Lluvia de ideas (Brainstorming)')
                            <div style="color:#18183c">
                                <span style="text-align: justify">{!! $analisis->ideas ? $analisis->ideas : 'sin registro' !!}
                                </span>
                            </div>
                        @elseif($analisis->metodo == 'Diagrama causa efecto (Ishikawa)')
                            <div class="mt-3 mb-5 col-md-12">
                                <div style="width: 100%;">
                                    <img src="{{ asset('img/diagrama_causa_raiz.png') }}"
                                        style="width:100%; margin-top:20px; height:270px;">
                                    <div
                                        style="top:0px;left:20px; position: absolute;height:35px; width:150px;  background-color:rgb(73, 142, 170); border-radius:15px;">
                                        <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-balance-scale"
                                                style="padding-top:6px; color:white;"></i></span><strong
                                            style="color:#ffffff">Control</strong>
                                    </div>
                                    <div
                                        style="top:0px; left:200px; position: absolute;height:35px; width:150px;  background-color:rgb(73, 142, 170);border-radius:15px;">
                                        <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-balance-scale"
                                                style="padding-top:6px; color:white;"></i></span><strong
                                            style="color:#ffffff">Proceso</strong>
                                    </div>
                                    <div
                                        style="top:0px; left:390px; position: absolute;height:35px; width:150px;  background-color:rgb(73, 142, 170);border-radius:15px;">
                                        <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-users"
                                                style="padding-top:6px; color:white;"></i></span><strong
                                            style="color:#ffffff">Personas</strong>
                                    </div>
                                    <div
                                        style="buttom:0px; left:60px; position: absolute;height:35px; width:150px;  background-color:rgb(73, 142, 170);border-radius:15px;">
                                        <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-sim-card"
                                                style="padding-top:6px; color:white;"></i></span><strong
                                            style="color:#ffffff">Tecnología</strong>
                                    </div>
                                    <div
                                        style="buttom:0px; left:290px; position: absolute;height:35px; width:150px;  background-color:rgb(73, 142, 170);border-radius:15px;">
                                        <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-sim-card"
                                                style="padding-top:6px; color:white;"></i></span><strong
                                            style="color:#ffffff">Métodos</strong>
                                    </div>
                                    <div
                                        style="buttom:0px;left:480px; position: absolute;height:35px; width:150px; background-color:rgb(73, 142, 170);border-radius:15px;">
                                        <span><i class="mt-1 ml-2 mr-2 circulo pl-1 fas fa-chalkboard"
                                                style="padding-top:6px; color:white;"></i></span><strong
                                            style="color:#ffffff">Recursos</strong>
                                    </div>
                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; top:40px; left:5px; position: absolute; height:90px !important; width:180px;">
                                        <span style="font-size:5pt;">{!! $analisis->control_a ? $analisis->control_a : 'Sin registro' !!}</span>
                                    </div>
                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; top:40px; left:195px; position: absolute; height:90px !important; width:180px;">
                                        <span style="font-size:5pt;">{!! $analisis->proceso_a ? $analisis->proceso_a : 'Sin registro' !!}</span>
                                    </div>
                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; top:40px; left:385px; position: absolute; height:90px !important; width:180px;">
                                        <span style="font-size:5pt;">{!! $analisis->personas_a ? $analisis->personas_a : 'Sin registro' !!}</span>
                                    </div>
                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; bottom:15px; right:510px; position: absolute; height:95px !important; width:180px;">
                                        <span style="font-size:5pt;">{!! $analisis->tecnologia_a ? $analisis->tecnologia_a : 'Sin registro' !!}</span>
                                    </div>
                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; bottom:15px; right:320px; position: absolute; height:95px !important; width:180px;">
                                        <span style="font-size:5pt;">{!! $analisis->metodos_a ? $analisis->metodos_a : 'Sin registro' !!}</span>
                                    </div>
                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; bottom:15px; right:125px; position: absolute; height:95px !important; width:180px;">
                                        <span style="font-size:5pt;">{!! $analisis->ambiente_a ? $analisis->ambiente_a : 'Sin registro' !!}</span>
                                    </div>

                                    <div class="p-2"
                                        style="border: 1px solid rgb(48, 247, 230); border-radius: 5px; background-color:white;color:#18183c; bottom:90px; right:-30px; position: absolute; height:95px !important; width:150px;">
                                        <span style="font-size:5pt;">{!! $analisis->problema_diagrama ? $analisis->problema_diagrama : 'Sin registro' !!}</span>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach

                    <br>

                    <div class="mt-4 mb-3 w-100 dato_mairg" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">Plan de Acción</span>
                    </div>

                    <div class="row medidas d-flex" style="justify-content: space-between;">

                        @if ($accionCorrectiva->planes->count() > 0)
                            <div class="mt-2 mb-3 ">
                                <div class="datatable-fix" style="width: 100%;">
                                    <table id="tabla_plan_accion" class="table w-100">
                                        <thead style="background-color:#0CA193;color:#fff">
                                            <tr>
                                                <th>Actividad</th>
                                                <th>Fecha&nbsp;de&nbsp;inicio</th>
                                                <th>Fecha&nbsp;de&nbsp;fin</th>
                                                <th>Estatus</th>
                                                <th>Responsable(s)</th>
                                                <th>Descripción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($accionCorrectiva->planes as $plan)
                                                @php
                                                    $actividades = $plan->tasks;
                                                @endphp
                                                @foreach ($actividades as $actividad)
                                                    <tr>
                                                        <td>
                                                            <span
                                                                style="color:#18183c">{{ $actividad->name ? $actividad->name : 'Sin registro' }}</span>
                                                        </td>
                                                        <td>
                                                            <span
                                                                style="color:#18183c">{{ Carbon\Carbon::parse($actividad->start)->format('d-m-Y') }}</span>

                                                        </td>
                                                        <td>
                                                            <span
                                                                style="color:#18183c">{{ Carbon\Carbon::parse($actividad->end)->format('d-m-Y') }}</span>

                                                        </td>
                                                        <td>
                                                            @if ($actividad->status == 'STATUS_UNDEFINED')
                                                                <span class="badge badge-primary">Sin iniciar</span>
                                                            @elseif ($actividad->status == 'STATUS_ACTIVE')
                                                                <span class="badge badge-warning">En proceso</span>
                                                            @elseif ($actividad->status == 'STATUS_DONE')
                                                                <span class="badge badge-success">Completado</span>
                                                            @elseif ($actividad->status == 'STATUS_FAILED')
                                                                <span class="badge badge-danger">Retraso</span>
                                                            @elseif ($actividad->status == 'STATUS_SUSPENDED')
                                                                <span class="badge badge-secondary">Suspendido</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <ul>
                                                                @forelse($actividad->assigs as $empleado_id)
                                                                    @php
                                                                        $empleado = $Empleado::select('id', 'name')->find($empleado_id->resourceId);
                                                                    @endphp
                                                                    <li>
                                                                        <span
                                                                            style="color:#18183c">{{ $empleado->name }}</span>
                                                                    </li>
                                                                @empty
                                                                    <span style="color:#18183c">Sin registros</span>
                                                                @endforelse
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <span style="color:#18183c">
                                                                {{ $actividad->description ? $actividad->description : 'Sin registro' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        @endif
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

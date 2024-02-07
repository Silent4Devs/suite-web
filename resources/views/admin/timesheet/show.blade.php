@extends('layouts.admin')
@section('content')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">
    @php
        use App\Models\Organizacion;
    @endphp
    {{ Breadcrumbs::render('timesheet-create') }}



    @include('admin.timesheet.complementos.cards')
    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">
            @if (isset($timesheet->semana))
                {!! $timesheet->semana !!} |
            @endif | <font style="font-weight:lighter;">
                @if (isset($timesheet->empleado->name))
                    {{ $timesheet->empleado->name }}
                @endif
            </font>
    </h5>

    <div class="card card-body">
        <div class="row">
            <div class="datatable-fix col-12" style="margin:auto;">
                <div class="col-12 d-flex justify-content-between mb-4">
                    <div class=""><strong>Fecha: </strong>
                        {{ \Carbon\Carbon::parse($timesheet->fecha_dia)->format('d/m/Y') }}</div>
                    <form method="POST" action="{{ route('admin.timesheet.pdf', ['id' => $timesheet->id]) }}">
                        @csrf
                        <button class="boton-transparentev2" type="submit" style="color: #306BA9;">
                            IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
                        </button>
                    </form>
                </div>
                <div id="content_times_show_print" class="w-100">
                    @php
                        $organizacion = Organizacion::getFirst();
                        if (!is_null($organizacion)) {
                            $logotipo = $organizacion->logotipo;
                        } else {
                            $logotipo = 'logotipo-tabantaj.png';
                        }
                    @endphp
                    <style type="text/css">
                        @page {
                            size: landscape;
                        }

                        .boton-transparentev2 {
                            top: 214px;
                            width: 135px;
                            height: 40px;
                            /* UI Properties */
                            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
                            border: 1px solid var(--unnamed-color-057be2);
                            background: #FFFFFF 0% 0% no-repeat padding-box;
                            border: 1px solid #057BE2;
                            opacity: 1;
                        }

                        .encabezado-print {
                            position: absolute;
                            z-index: -10000;
                        }

                        @media print {
                            .tabla-llenar-horas {
                                overflow: unset;
                            }

                            .encabezado-print {
                                position: unset !important;
                            }
                        }
                    </style>
                    <table class="encabezado-print">
                        <tr>
                            <td style="width: 25%;">
                                <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                            </td>
                            <td style="min-width: 50%;">
                                <h4><strong>{{ $organizacion->empresa }}</strong></h4>
                                <h5 style="font-weight: bolder;">Timesheet: <font style="font-weight:lighter;">
                                        {!! $timesheet->semana !!}</font>
                                </h5>
                                <div>{{ $timesheet->empleado->name }}</div>
                            </td>
                            <td style="width: 25%;"class="encabezado_print_td_no_paginas">
                                Fecha: {{ $hoy_format }} <br>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-responsive tabla-llenar-horas dataTables_scrollBody">
                        <thead>
                            <tr>
                                <th style="min-width:250px;">Proyecto </th>
                                <th style="min-width:250px;">Tarea</th>
                                <th>Facturable</th>
                                <th style="min-width:55px;">Lunes</th>
                                <th style="min-width:55px;">Martes</th>
                                <th style="min-width:55px;">Miercoles</th>
                                <th style="min-width:55px;">Jueves</th>
                                <th style="min-width:55px;">Viernes</th>
                                <th style="min-width:55px;">Sabado</th>
                                <th style="min-width:55px;">Domingo</th>
                                <th style="min-width:200px;">Descripción</th>
                                <th style="min-width:100px;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($horas as $index => $hora)
                                <tr>
                                    <td>
                                        <div class="form-control" style="height:unset;">
                                            {{ $hora->proyecto->identificador }}
                                            -
                                            {{ $hora->proyecto->proyecto }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-control" style="height:unset;">{{ $hora->tarea->tarea }}</div>
                                    </td>
                                    <td>
                                        @if ($hora->facturable)
                                            <div id="" data-checked="1" class="btn btn-info"
                                                style="transform: scale(0.5);"><i class="fa-solid fa-check"></i></div>
                                        @else
                                            <div data-checked="0" class="btn btn-info"
                                                style="transform: scale(0.5); background-color: #ccc !important;"><i
                                                    class="fa-solid fa-xmark"></i></div>
                                        @endif
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_lunes_{{ $index + 1 }}" data-dia="lunes"
                                            class="form-control">{{ $hora->horas_lunes }}</div>
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_martes_{{ $index + 1 }}" data-dia="martes"
                                            class="form-control">{{ $hora->horas_martes }}</div>
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_miercoles_{{ $index + 1 }}" data-dia="miercoles"
                                            class="form-control">{{ $hora->horas_miercoles }}</div>
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_jueves_{{ $index + 1 }}" data-dia="jueves"
                                            class="form-control">{{ $hora->horas_jueves }}</div>
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_viernes_{{ $index + 1 }}" data-dia="viernes"
                                            class="form-control">{{ $hora->horas_viernes }}</div>
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_sabado_{{ $index + 1 }}" data-dia="sabado"
                                            class="form-control">{{ $hora->horas_sabado }}</div>
                                    </td>
                                    <td>
                                        <div id="ingresar_hora_domingo_{{ $index + 1 }}" data-dia="domingo"
                                            class="form-control">{{ $hora->horas_domingo }}</div>
                                    </td>
                                    <td>
                                        <div class="form-control" style="height:unset; width: 250px !important">
                                            {{ $hora->descripcion }}</div>
                                    </td>
                                    <td>
                                        <div class="form-control">
                                            <label id="suma_horas_fila_{{ $index + 1 }}" class="total_filas"></label>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="3">Toral horas facturables</td>
                                <td><label id="suma_dia_lunes"></label></td>
                                <td><label id="suma_dia_martes"></label></td>
                                <td><label id="suma_dia_miercoles"></label></td>
                                <td><label id="suma_dia_jueves"></label></td>
                                <td><label id="suma_dia_viernes"></label></td>
                                <td><label id="suma_dia_sabado"></label></td>
                                <td><label id="suma_dia_domingo"></label></td>
                                <td><label id="total_h_facts"></label></td>
                                <td><label id="total_horas_filas"></label></td>
                            </tr>
                            <tr>
                                <td colspan="3">Toral horas no facturables</td>
                                <td><label id="suma_dia_lunes_no_fact"></label></td>
                                <td><label id="suma_dia_martes_no_fact"></label></td>
                                <td><label id="suma_dia_miercoles_no_fact"></label></td>
                                <td><label id="suma_dia_jueves_no_fact"></label></td>
                                <td><label id="suma_dia_viernes_no_fact"></label></td>
                                <td><label id="suma_dia_sabado_no_fact"></label></td>
                                <td><label id="suma_dia_domingo_no_fact"></label></td>
                                <td><label id="total_h_no_facts"></label></td>
                                <td colspan="2"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>


            @if (asset('admin/timesheet/aprobaciones') ==
                    redirect()->getUrlGenerator()->previous())
                <div class="col-12 d-flex justify-content-between">
                    <a href="{{ route('admin.timesheet-create') }}" class="btn_cancelar">Regresar</a>
                    <div class="">
                        <button title="Rechazar" class="btn btn-info" style="background-color:#F05353; border: none;"
                            data-toggle="modal" data-target="#modal_rechazar_{{ $timesheet->id }}">
                            <i class="fa-solid fa-calendar-xmark"></i>
                            Rechazar
                        </button>
                        <button title="Aprobar" class="btn btn-info" style="background-color: #3CA06C; border: none;"
                            data-toggle="modal" data-target="#modal_aprobar_{{ $timesheet->id }}">
                            <i class="fas fa-calendar-check"></i>
                            Aprobar
                        </button>
                    </div>
                </div>

                {{-- aprobar --}}
                <div class="modal fade" id="modal_aprobar_{{ $timesheet->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="delete">
                                    <div class="text-center">
                                        <i class="fa-solid fa-calendar-check" style="color: #3CA06C; font-size:60pt;"></i>
                                        <h1 class="my-4" style="font-size:14pt;">Aprobar Registro</h1>
                                        <p class="parrafo">¿Está seguro que desea aprobar este registro?</p>
                                    </div>

                                    <div class="mt-4">
                                        <form action="{{ route('admin.timesheet-aprobar', ['id' => $timesheet->id]) }}"
                                            method="POST" class="row">
                                            @csrf
                                            <div class="form-group col-12">
                                                <label><i class="fa-solid fa-comment-dots iconos_crear"></i>
                                                    Comentarios</label>
                                                <textarea class="form-control" name="comentarios"></textarea>
                                                <small>Escriba sus comentarios para el solicitante (Opcional).</small>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button title="Rechazar" class="btn btn-info"
                                                    style="border:none; background-color:#3CA06C;">
                                                    <i class="fas fa-calendar-check iconos_crear"></i>
                                                    Aprobar Registro
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- rechazar --}}
                <div class="modal fade" id="modal_rechazar_{{ $timesheet->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="delete">
                                    <div class="text-center">
                                        <i class="fa-solid fa-calendar-xmark" style="color: #F05353; font-size:60pt;"></i>
                                        <h1 class="my-4" style="font-size:14pt;">Rechazar Registro</h1>
                                        <p class="parrafo">¿Está seguro que desea rechazar este registro?</p>
                                    </div>

                                    <div class="mt-4">
                                        <form action="{{ route('admin.timesheet-rechazar', ['id' => $timesheet->id]) }}"
                                            method="POST" class="row">
                                            @csrf
                                            <div class="form-group col-12">
                                                <label><i class="fa-solid fa-comment-dots iconos_crear"></i>
                                                    Comentarios</label>
                                                <textarea class="form-control" name="comentarios" required></textarea>
                                                <small>Escriba el motivo por el cual rechaza este registro
                                                    (Obligatorio).</small>
                                            </div>
                                            <div class="col-12 text-right">
                                                <button title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
                                                    Cancelar
                                                </button>
                                                <button title="Rechazar" class="btn btn-info"
                                                    style="border:none; background-color:#F05353;">
                                                    <i class="fas fa-calendar-xmark iconos_crear"></i>
                                                    Rechazar Registro
                                                </button>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>


@section('scripts')
    <script type="text/javascript">
        function calcularSumatoriasFacturables() {

            // lunes ----------------------------------
            let input_lunes = document.querySelectorAll('div[data-dia="lunes"]');
            let suma_horas_lunes = 0;
            let suma_horas_lunes_no_fact = 0;
            input_lunes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_lunes += Number(item.innerText);
                } else {
                    suma_horas_lunes_no_fact += Number(item.innerText);
                }
            });
            document.getElementById('suma_dia_lunes').innerText = suma_horas_lunes + ' h';
            document.getElementById('suma_dia_lunes_no_fact').innerText = suma_horas_lunes_no_fact + ' h';

            // martes ----------------------------------
            let input_martes = document.querySelectorAll('div[data-dia="martes"]');
            let suma_horas_martes = 0;
            let suma_horas_martes_no_fact = 0;
            input_martes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_martes += Number(item.innerText);
                } else {
                    suma_horas_martes_no_fact += Number(item.innerText);
                }
            });
            document.getElementById('suma_dia_martes').innerText = suma_horas_martes + ' h';
            document.getElementById('suma_dia_martes_no_fact').innerText = suma_horas_martes_no_fact + ' h';

            // miercoles ----------------------------------
            let input_miercoles = document.querySelectorAll('div[data-dia="miercoles"]');
            let suma_horas_miercoles = 0;
            let suma_horas_miercoles_no_fact = 0;
            input_miercoles.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_miercoles += Number(item.innerText);
                } else {
                    suma_horas_miercoles_no_fact += Number(item.innerText);
                }
            });
            document.getElementById('suma_dia_miercoles').innerText = suma_horas_miercoles + ' h';
            document.getElementById('suma_dia_miercoles_no_fact').innerText = suma_horas_miercoles_no_fact + ' h';

            // jueves ----------------------------------
            let input_jueves = document.querySelectorAll('div[data-dia="jueves"]');
            let suma_horas_jueves = 0;
            let suma_horas_jueves_no_fact = 0;
            input_jueves.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_jueves += Number(item.innerText);
                } else {
                    suma_horas_jueves_no_fact += Number(item.innerText);
                }
            });
            document.getElementById('suma_dia_jueves').innerText = suma_horas_jueves + ' h';
            document.getElementById('suma_dia_jueves_no_fact').innerText = suma_horas_jueves_no_fact + ' h';

            // viernes ----------------------------------
            let input_viernes = document.querySelectorAll('div[data-dia="viernes"]');
            let suma_horas_viernes = 0;
            let suma_horas_viernes_no_fact = 0;
            input_viernes.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_viernes += Number(item.innerText);
                } else {
                    suma_horas_viernes_no_fact += Number(item.innerText);
                }
            });
            document.getElementById('suma_dia_viernes').innerText = suma_horas_viernes + ' h';
            document.getElementById('suma_dia_viernes_no_fact').innerText = suma_horas_viernes_no_fact + ' h';

            // sabado ----------------------------------
            let input_sabado = document.querySelectorAll('div[data-dia="sabado"]');
            let suma_horas_sabado = 0;
            let suma_horas_sabado_no_fact = 0;
            input_sabado.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_sabado += Number(item.innerText);
                } else {
                    suma_horas_sabado_no_fact += Number(item.innerText);
                }
            });
            document.getElementById('suma_dia_sabado').innerText = suma_horas_sabado + ' h';
            document.getElementById('suma_dia_sabado_no_fact').innerText = suma_horas_sabado_no_fact + ' h';

            // domingo ----------------------------------
            let input_domingo = document.querySelectorAll('div[data-dia="domingo"]');
            let suma_horas_domingo = 0;
            let suma_horas_domingo_no_fact = 0;
            input_domingo.forEach(item => {
                let es_facturable = item.closest('tr').querySelector('td:nth-child(3) div').getAttribute(
                    'data-checked') == '1' ? true : false;
                if (es_facturable) {
                    suma_horas_domingo += Number(item.innerText);
                } else {
                    suma_horas_domingo_no_fact += Number(item.innerText);
                }
            });

            let total_h_fact = suma_horas_lunes + suma_horas_martes + suma_horas_miercoles + suma_horas_jueves +
                suma_horas_viernes + suma_horas_sabado + suma_horas_domingo;

            let total_h_no_fact = suma_horas_lunes_no_fact + suma_horas_martes_no_fact + suma_horas_miercoles_no_fact +
                suma_horas_jueves_no_fact + suma_horas_viernes_no_fact + suma_horas_sabado_no_fact +
                suma_horas_domingo_no_fact;

            document.getElementById('suma_dia_domingo').innerText = suma_horas_domingo + ' h';
            document.getElementById('suma_dia_domingo_no_fact').innerText = suma_horas_domingo_no_fact + ' h';

            document.getElementById('total_h_facts').innerText = 'Total: ' + total_h_fact + ' h';
            document.getElementById('total_h_no_facts').innerText = 'Total: ' + total_h_no_fact + ' h';

        }
        calcularSumatoriasFacturables();

        let contador_filas = @json($horas_count);
        for (var i = 1; i <= contador_filas; i++) {
            updateValue(i);
        }

        function updateValue(index) {
            const suma_horas = Number($('#ingresar_hora_lunes_' + index).text()) +
                Number($('#ingresar_hora_martes_' + index).text()) +
                Number($('#ingresar_hora_miercoles_' + index).text()) +
                Number($('#ingresar_hora_jueves_' + index).text()) +
                Number($('#ingresar_hora_viernes_' + index).text()) +
                Number($('#ingresar_hora_sabado_' + index).text()) +
                Number($('#ingresar_hora_domingo_' + index).text());


            document.getElementById('suma_horas_fila_' + index).textContent = suma_horas + ' h';
        }
    </script>
@endsection
@endsection

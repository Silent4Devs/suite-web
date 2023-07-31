<div class="caja_anima_reporte">
    @php
        use App\Models\Organizacion;
    @endphp
    <style type="text/css">
        .datatable_timesheet_proyectos tr th:first-child,
        .datatable_timesheet_proyectos tr td:first-child {
            position: sticky !important;
            left: 0;
            z-index: 6;
            transition: 0.3s;
        }

        .datatable_timesheet_proyectos tr th:nth-child(2),
        .datatable_timesheet_proyectos tr td:nth-child(2) {
            position: sticky !important;
            left: 100px;
            z-index: 5;
            transition: 0.3s;
        }

        .datatable_timesheet_proyectos tr th:nth-child(3),
        .datatable_timesheet_proyectos tr td:nth-child(3) {
            position: sticky !important;
            left: 200px;
            z-index: 4;
            transition: 0.3s;
        }

        .datatable_timesheet_proyectos tr th:last-child,
        .datatable_timesheet_proyectos tr td:last-child {
            position: sticky !important;
            right: 0;
            z-index: 6;
        }

        .datatable_timesheet_proyectos tr th:nth-child(2).ver,
        .datatable_timesheet_proyectos tr td:nth-child(2).ver {
            position: sticky !important;
            left: 270px;
            z-index: 5;
            transition: 0.3s;
        }

        .datatable_timesheet_proyectos tr th:nth-child(3).ver,
        .datatable_timesheet_proyectos tr td:nth-child(3).ver {
            position: sticky !important;
            left: 370px;
            z-index: 4;
            transition: 0.3s;
        }



        .datatable_timesheet_proyectos tr th:first-child::before,
        .datatable_timesheet_proyectos tr td:first-child::before,
        .datatable_timesheet_proyectos tr th:nth-child(2)::before,
        .datatable_timesheet_proyectos tr td:nth-child(2)::before,
        .datatable_timesheet_proyectos tr th:nth-child(3)::before,
        .datatable_timesheet_proyectos tr td:nth-child(3)::before {
            content: "";
            position: absolute;
            width: 1px;
            height: 100%;
            top: 0 !important;
            right: 0;
            background-color: grey;
        }

        .datatable_timesheet_proyectos tr th:last-child::before,
        .datatable_timesheet_proyectos tr td:last-child::before {
            content: "";
            position: absolute;
            width: 1px;
            height: 100%;
            top: 0 !important;
            left: 0;
            background-color: grey;
        }

        @media(max-width: 1200px) {

            .tabla-fixed th,
            .tabla-fixed td {
                position: unset !important;
            }

            .tabla-fixed th {
                text-align: left !important;
            }

            .tabla-fixed th::before,
            .tabla-fixed td::before {
                content: "";
                display: none !important;
            }
        }
    </style>
    <div class="w-100">
        <x-loading-indicator />
        <div class="row">
            <div class="col-md-3 form-group">
                <label class="form-label">Área</label>
                <select class="form-control" wire:model="area_id">
                    <option selected value="0">Todas</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group" wire:ignore>
                <label class="form-label">Fecha de inicio</label>
                <input id="fecha_dia_registros_inicio_proyectos" class="form-control date_librery" type="date"
                    name="fecha_inicio" wire:model="fecha_inicio">
            </div>
            <div class="col-md-3 form-group" wire:ignore>
                <label class="form-label">Fecha de fin</label>
                <input id="fecha_dia_registros_fin_proyectos" class="form-control date_librery" type="date"
                    name="fecha_fin" wire:model="fecha_fin">
            </div>
            <div class="col-md-2 form-group">
                <label class="form-label">Horas totales</label>
                <div class="form-control">{{ $horas_totales_todos_proyectos }} h</div>
            </div>
            <div class="col-md-1 form-group">
                <label class="form-label" style="width:100%;">&nbsp;</label><br>
                <a href="" class="btn btn-info"><i class="fa-solid fa-arrow-rotate-right"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="row w-100 mt-4" style="align-items: end">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-6">
                                <div class="row" style="justify-content: center">
                                    <div class="col-3 p-0" style="font-size: 11px;align-self: center">

                                    </div>
                                    <div class="col-3 p-0" style="font-size: 11px;align-self: center">
                                        <p class="m-0">Mostrando</p>
                                    </div>
                                    <div class="col-3 p-0">
                                        <select name="" id="" class="form-control" wire:model="perPage">
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="-1">Todos</option>
                                        </select>
                                    </div>
                                    <div class="col-3 p-0" style="font-size: 11px;align-self: center;text-align: end">
                                        <p class="m-0">por página</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">

                            </div>
                        </div>
                    </div>
                    <div class="col-6 p-0" style="text-align: end">
                        <div class="row">
                            <div class="col-6 p-0"></div>
                            <div class="col-6 p-0">
                                <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="datatable-fix">
                    <table id="datatable_timesheet_proyectos"
                        class="datatable_timesheet_proyectos table w-100 tabla-fixed">
                        <thead>
                            <tr>
                                <th style="min-width:250px;">Proyecto </th>
                                <th style="min-width:250px; text-align: right;">Áreas participantes</th>
                                <th style="min-width:250px; text-align: right;">Cliente</th>
                                @foreach ($calendario_tabla as $calendar)
                                    <th colspan="{{ $calendar['total_weeks'] }}" class="th-calendario th-año">
                                        <small>{{ $calendar['year'] }}</small>
                                    </th>
                                @endforeach
                                <th>Opciones</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                @foreach ($calendario_tabla as $calendar)
                                    @foreach ($calendar['months'] as $key => $mes)
                                        @php
                                            $mes_traducido = '';
                                            if ($key == 'January') {
                                                $mes_traducido = 'Enero';
                                            }
                                            if ($key == 'February') {
                                                $mes_traducido = 'Febrero';
                                            }
                                            if ($key == 'March') {
                                                $mes_traducido = 'Marzo';
                                            }
                                            if ($key == 'April') {
                                                $mes_traducido = 'Abril';
                                            }
                                            if ($key == 'May') {
                                                $mes_traducido = 'Mayo';
                                            }
                                            if ($key == 'June') {
                                                $mes_traducido = 'Junio';
                                            }
                                            if ($key == 'July') {
                                                $mes_traducido = 'Julio';
                                            }
                                            if ($key == 'August') {
                                                $mes_traducido = 'Agosto';
                                            }
                                            if ($key == 'September') {
                                                $mes_traducido = 'Septiembre';
                                            }
                                            if ($key == 'October') {
                                                $mes_traducido = 'Octubre';
                                            }
                                            if ($key == 'November') {
                                                $mes_traducido = 'Noviembre';
                                            }
                                            if ($key == 'December') {
                                                $mes_traducido = 'Diciembre';
                                            }
                                        @endphp
                                        @if ($mes['total_weeks'] > 0)
                                            <th colspan="{{ $mes['total_weeks'] }}" class="th-calendario th-mes">
                                                <small>{{ $mes_traducido }} {{ $calendar['year'] }}</small>
                                            </th>
                                        @endif
                                    @endforeach
                                @endforeach
                                <th></th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                @foreach ($calendario_tabla as $calendar)
                                    @foreach ($calendar['months'] as $key => $mes)
                                        @foreach ($mes['weeks'] as $week)
                                            @php
                                                $semanas_time_array = explode('|', $week);
                                                $fecha_inicio_time = $semanas_time_array['0'];
                                                $fecha_fin_time = $semanas_time_array['1'];
                                                $fecha_inicio_time = \Carbon\Carbon::parse($fecha_inicio_time)->format('d');
                                                $fecha_fin_time = \Carbon\Carbon::parse($fecha_fin_time)->format('d');
                                            @endphp
                                            <th class="th-calendario th-semana">
                                                <small>Del&nbsp;<strong>{{ $fecha_inicio_time }}</strong>&nbsp;al&nbsp;<strong>{{ $fecha_fin_time }}</strong></small>
                                            </th>
                                        @endforeach
                                    @endforeach
                                @endforeach
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proyectos_array as $proyecto)
                                <tr>
                                    <td>{{ $proyecto['proyecto'] }} </td>
                                    <td>
                                        <ul style="padding-left: 10px;">
                                            @foreach ($proyecto['areas'] as $area)
                                                <li>{{ $area['area'] }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $proyecto['cliente'] }} </td>
                                    @foreach ($proyecto['calendario'] as $index => $horas_calendar)
                                        <td style="font-size: 10px !important; text-align: center !important;">
                                            {!! $horas_calendar !!}</td>
                                    @endforeach
                                    <td><button class="btn" wire:click="genrarReporte({{ $proyecto['id'] }})"><i
                                                class="fa-solid fa-file-invoice"></i></button></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mt-4">
                        <div class="col-6 p-0">
                            <strong>
                                Mostrando {{ $perPage }} de {{ $totalRegistrosMostrando }} resultados
                            </strong>
                        </div>
                        <div class="col-6 p-0" style="display: flex;justify-content: end">
                            {{ $proyectos_array->links() }}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if ($proyecto_reporte)
        <div id="reporte_proyecto" class="anima_reporte">
            @php
                $organizacion = Organizacion::getFirst();
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'logotipo-tabantaj.png';
                }
            @endphp
            <table class="encabezado-print">
                <tr>
                    <td style="width: 25%;">
                        <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                    </td>
                    <td style="width: 50%;">
                        <h4><strong>{{ $organizacion->empresa }}</strong></h4>
                        <h5 style="font-weight: bolder;">Proyecto: <font style="font-weight:lighter;">
                                {{ $proyecto_reporte->proyecto }}</font>
                        </h5>
                    </td>
                    <td style="width: 25%;">
                        Fecha: {{ $hoy_format }}
                    </td>
                </tr>
            </table>
            <button class="btn btn-cerrar" onclick="cerrarVentana('reporte_proyecto')"><i
                    class="fa-solid fa-xmark"></i></button>
            <div class="row">
                <div class="col-12">
                    <h6 class="mb-3 separador-titulo">Resumen del Proyecto</h6>
                </div>
                <div class="col-12 text-right">
                    <button class="btn btn-secundario print-none" onclick="print()"><i
                            class="fa-solid fa-print iconos_crear"></i> Imprimir</button>
                </div>
                <div class="col-12 d-flex justify-content-between align-items-center mt-3">
                    <div class="d-flex align-items-center">
                        <div class="ml-3">
                            <span style="width: 75px; display: inline-block; font-weight: bolder;">Proyecto:</span>
                            {{ $proyecto_reporte->proyecto }}<br>
                            <span style="width: 300px; display: inline-block; font-weight: bolder;">Áreas
                                participantes:</span>
                            <ul style="padding-left:15px;">
                                @foreach ($proyecto_reporte->areas as $area)
                                    <li>{{ $area->area }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="d-flex ml-4">
                        <div class="px-4 py-3" style="background-color: #859BC0; color:#fff; border-radius: 4px;">
                            <div class="text-center">
                                <div class="text-center">Horas&nbsp;Totales: </div>
                                <h3 style="margin-top:0;"> {{ $total_horas_proyecto }}h</h3>
                            </div>
                            <div class="text-center mt-2">
                                <div class="text-center">Importe Total ($): </div>
                                <h3 style="margin-top: 0;" id="costo_proyecto_total"></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row mt-5">
                <div class="form-group col-6">
                    <label class="form-label">Rango inicial</label>
                    <input id="fecha_dia_registros_inicio_proyecto_reporte" type="date" name="rango_inicial" class="form-control" wire:model="fecha_inicio_proyecto">
                </div>
                <div class="form-group col-6">
                    <label class="form-label">Rango final</label>
                    <input id="fecha_dia_registros_fin_proyecto_reporte" type="date" name="rango_final" class="form-control" wire:model="fecha_fin_proyecto">
                </div>
            </div> --}}
            <div class="row">
                <div class="col-12">
                    <h6 class="separador-titulo">Tareas</h6>

                    {{-- <ul class="lista_general">
                        @foreach ($tareas_array as $tarea)
                            <li class="general_li">
                                <h4>{{ $tarea['tarea'] }}: <small style="padding:5px;">{{ $tarea['horas_totales'] }}h</small></h4>
                                <ul class="general_li_ul">
                                    @foreach ($tarea['empleados'] as $empleado)
                                        <li style="font-size:10px;">
                                            <img src="{{ $empleado['foto'] }}" class="img_empleado mr-2" style="width: 30px; height: 30px; clip-path:circle( 15px at 50% 50%) !important;">
                                            {{ $empleado['name'] }}:
                                            <label><strong class="horas_tarea_empleado{{ $empleado['id'] }}" data-empleado="{{ $empleado['id'] }}">{{ $empleado['horas'] }}</strong>&nbsp;h</label></li>
                                        <hr>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul> --}}
                    <div id="caja-graf-tareas-horas-proyecto">
                        <canvas id="graf-tareas-horas-proyecto" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-12">
                    <h6 class="separador-titulo">Participantes en el Proyecto</h6>

                    {{-- <ul class="lista_general">
                        @foreach ($tareas_array as $tarea)
                            <li class="general_li">
                                <h4>{{ $tarea['tarea'] }}: <small style="padding:5px;">{{ $tarea['horas_totales'] }}h</small></h4>
                                <ul class="general_li_ul">
                                    @foreach ($tarea['empleados'] as $empleado)
                                        <li style="font-size:10px;">
                                            <img src="{{ $empleado['foto'] }}" class="img_empleado mr-2" style="width: 30px; height: 30px; clip-path:circle( 15px at 50% 50%) !important;">
                                            {{ $empleado['name'] }}:
                                            <label><strong class="horas_tarea_empleado{{ $empleado['id'] }}" data-empleado="{{ $empleado['id'] }}">{{ $empleado['horas'] }}</strong>&nbsp;h</label></li>
                                        <hr>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul> --}}

                    <div id="caja-graf-empleados-horas-proyecto">
                        <canvas id="graf-empleados-horas-proyecto" width="800" height="400"></canvas>
                    </div>
                </div>
            </div>
            <div class="w-100 print-none">
                <div class="datatable-fix mt-5">
                    <table id="datatable_timesheet_proyectos_empleados" class="table w-100">
                        <thead>
                            <tr>
                                <th>Foto </th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Área</th>
                                <th>Horas dedicadas</th>
                                <th>Costo de horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados_proyecto as $empleado_p)
                                <tr>
                                    <td><img src="{{ $empleado_p['foto'] }}" class="img_empleado"></td>
                                    <td>{{ $empleado_p['name'] }}</td>
                                    <td>{{ $empleado_p['puesto'] }}</td>
                                    <td>{{ $empleado_p['area']['area'] }}</td>
                                    <td id="horas_proyecto_empleado_print{{ $empleado_p['id'] }}">
                                        {{ $empleado_p['horas'] }}
                                    </td>
                                    <td id="costo_proyecto_empleado_print{{ $empleado_p['id'] }}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- @php
            $organizacion = Organizacion::select('id', 'logotipo', 'empresa')->first();
            if (!is_null($organizacion)) {
                $logotipo = $organizacion->logotipo;
            } else {
                $logotipo = 'logotipo-tabantaj.png';
            }
        @endphp --}}
        {{-- div para imprimir __________________________________________ --}}
        {{-- <div id="reporte_proyecto_div_imprimir" class="solo-print">
            <table class="encabezado-print">
                <tr>
                    <td style="width: 25%;">
                        <img src="{{ asset($logotipo) }}" class="img_logo" style="height: 70px;">
                    </td>
                    <td style="width: 50%;">
                        <h4><strong>{{ $organizacion->empresa }}</strong></h4>
                        <h5 style="font-weight: bolder;">Proyecto: <font style="font-weight:lighter;">{{ $proyecto_reporte->proyecto }}</font></h5>
                    </td>
                    <td style="width: 25%;">
                        Fecha: {{ $hoy_format }}
                    </td>
                </tr>
            </table>
            <h5 style="font-weight:bolder;">Reporte Timesheet Proyecto: <font style="font-weight:lighter;">{{ $proyecto_reporte->proyecto }}</font></h5>
            <div style="width:100%; display:flex;">
                <div>
                    <h5 style="font-weight:lighter;">Tareas: </h5>
                    <ul class="lista_general">
                        @foreach ($tareas_array as $tarea)
                            <li class="general_li" style="overflow:unset !important;">
                                <h4>{{ $tarea['tarea'] }}: <small style="padding:5px;">{{ $tarea['horas_totales'] }}h</small></h4>
                                <ul class="general_li_ul">
                                    @foreach ($tarea['empleados'] as $empleado)
                                        <li style="font-size:10px;">
                                            <img src="{{ $empleado['foto'] }}" class="img_empleado mr-2" style="width: 30px; height: 30px; clip-path:circle( 15px at 50% 50%) !important;">
                                            {{ $empleado['name'] }}:
                                            <strong>{{ $empleado['horas'] }}h</strong></li>
                                        <hr>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div style="width: 20%;">
                    <div class="w-100" style="background:linear-gradient(0deg, rgba(69,125,182,1) 0%, rgba(8,170,157,1) 60%); color:#fff;">
                        <div class="p-4">
                            <h5 class="text-center">Estadisticas Generales</h5>
                            <div class="mt-3 text-center">Horas Totales Dedicas al Proyecto</div>
                            <h1 class="mt-3 text-center">{{ $total_horas_proyecto }}h</h1>
                            <div class="mt-3 text-center">Costo de Horas del Proyecto</div>
                            <h4 class="mt-3 text-center" id="costo_proyecto_total_print"></h4>
                            <div class="mt-3"><strong>Área: </strong> {{ $area_proyecto->area }}</div>
                            <div class="mt-3"><strong>Cliente: </strong> {{ $cliente_proyecto ? $cliente_proyecto->nombre : 'sin cliente' }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="datatable-fix mt-5">
                    <h5><strong>Empleados en el Proyecto</strong></h5>
                    <table id="datatable_timesheet_proyectos_empleados_print" class="table w-100">
                        <thead>
                            <tr>
                                <th>Foto </th>
                                <th>Nombre</th>
                                <th>Puesto</th>
                                <th>Área</th>
                                <th>Horas dedicadas</th>
                                <th>Costo de horas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empleados_proyecto as $empleado_p)
                                <tr>
                                    <td><img src="{{ $empleado_p['foto'] }}" class="img_empleado"></td>
                                    <td>{{ $empleado_p['name'] }}</td>
                                    <td>{{ $empleado_p['puesto'] }}</td>
                                    <td>{{ $empleado_p['area']['area'] }}</td>
                                    <td id="horas_proyecto_empleado_print{{$empleado_p['id']}}"></td>
                                    <td id="costo_proyecto_empleado_print{{$empleado_p['id']}}"></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        {{-- <script type="text/javascript">
            let costo_proyecto_total = 0;
            let total_horas = 0;
            let costo_proyecto_empleado = 0;
            let horas_empleado_horas;
            let salario_hora;
            @foreach ($empleados_proyecto as $empleado_p)
                total_horas = 0;
                salario_hora = 0;
                costo_proyecto_empleado = 0;
                horas_empleado_horas = document.querySelectorAll('.horas_tarea_empleado{{ $empleado_p['id'] }}');
                total_horas = 0;
                horas_empleado_horas.forEach(function(horas){
                   total_horas += Number(horas.innerText);
                });
                document.getElementById('horas_proyecto_empleado{{$empleado_p['id']}}').innerHTML = total_horas + ' <small>h</small>';
                document.getElementById('horas_proyecto_empleado_print{{$empleado_p['id']}}').innerHTML = total_horas + ' <small>h</small>';

                salario_hora = ({{ $empleado_p['salario_diario'] ? $empleado_p['salario_diario'] : '0' }}) / 24;
                costo_proyecto_empleado = (salario_hora * total_horas).toFixed(2);
                document.getElementById('costo_proyecto_empleado{{$empleado_p['id']}}').innerHTML = '<strong>$</strong> ' + costo_proyecto_empleado;
                document.getElementById('costo_proyecto_empleado_print{{$empleado_p['id']}}').innerHTML = '<strong>$</strong> ' + costo_proyecto_empleado;

                costo_proyecto_total += Number(costo_proyecto_empleado);
            @endforeach
            document.getElementById('costo_proyecto_total').innerHTML = '<strong>$</strong> ' + costo_proyecto_total;
            document.getElementById('costo_proyecto_total_print').innerHTML = '<strong>$</strong> ' + costo_proyecto_total;
        </script> --}}
    @endif


    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                tablaLivewire('datatable_timesheet_proyectos');
                tablaLivewire('datatable_timesheet_proyectos_empleados');
            });

            Livewire.on('scriptChartsProyect', (tareas_detalle, detalle_empleado) => {
                console.log(tareas_detalle);

                initCharts();

                function initCharts() {
                    let labels_tareas = [];
                    let values_tareas = [];
                    let colors_tareas = [];

                    let labels_empleados = [];
                    let values_empleados = [];
                    let colores_empleados = [];

                    tareas_detalle.forEach(item => {
                        labels_tareas.push(item.tarea);
                        values_tareas.push(item.horas_totales);
                        colors_tareas.push('#34DCCF');
                    });

                    console.log(detalle_empleado);
                    detalle_empleado.forEach(item => {
                        labels_empleados.push(item.name);
                        values_empleados.push(item.horas);
                        colores_empleados.push('#34DCCF');
                    });

                    let caja_graf_tareas_horas_proyecto = document.getElementById(
                        'caja-graf-tareas-horas-proyecto');
                    caja_graf_tareas_horas_proyecto.innerHTML = '&nbsp;';
                    $('#caja-graf-tareas-horas-proyecto').append(
                        '<canvas id="graf-tareas-horas-proyecto" width="800" height="400"></canvas>');
                    new Chart(document.getElementById('graf-tareas-horas-proyecto'), {
                        type: 'bar',
                        data: {
                            labels: labels_tareas,
                            datasets: [{
                                label: 'Horas',
                                data: values_tareas,
                                backgroundColor: colors_tareas,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

                    let caja_graf_empleados_horas_proyecto = document.getElementById(
                        'caja-graf-empleados-horas-proyecto');
                    caja_graf_empleados_horas_proyecto.innerHTML = '&nbsp;';
                    $('#caja-graf-empleados-horas-proyecto').append(
                        '<canvas id="graf-empleados-horas-proyecto" width="800" height="400"></canvas>');
                    new Chart(document.getElementById('graf-empleados-horas-proyecto'), {
                        type: 'bar',
                        data: {
                            labels: labels_empleados,
                            datasets: [{
                                label: 'Horas',
                                data: values_empleados,
                                backgroundColor: colores_empleados,
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }
            });
        });

        function getRandomcolor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            console.log(color);
            return color;
        }

        function recotarText(string, length = 50) {
            var trimmedString = string.length > length ?
                string.substring(0, length - 3) + "..." :
                string;
            return trimmedString;
        }
    </script>
</div>

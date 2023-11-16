<div class="caja_anima_reporte">
    <div class="card card-body">
        <div class="row print-none" style="margin: 0 !important;">
            <x-loading-indicator />
            <div class="col-md-3 form-group" style="padding-left:0 !important;">
                <label class="form-label">Colaboradores del Área: </label>
                <select class="form-control" wire:model.live="area_id">
                    <option selected value="0">Todas</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group" wire:ignore>
                <label class="form-label">Fecha de inicio</label>
                <input id="fecha_dia_registros_inicio_empleados" class="form-control date_librery" type="date"
                    name="fecha_inicio" wire:model.live="fecha_inicio">
            </div>
            <div class="col-md-3 form-group" wire:ignore>
                <label class="form-label">Fecha de fin</label>
                <input id="fecha_dia_registros_fin_empleados" class="form-control date_librery" type="date"
                    name="fecha_fin" wire:model.live="fecha_fin">
            </div>
            <div class="col-md-2 form-group">
                <label class="form-label">Horas totales</label>
                <div class="form-control">{{ $horas_totales_filtros_empleados }} h</div>
            </div>
            <div class="col-md-1 form-group">
                <label class="form-label" style="width:100%;">&nbsp;</label><br>
                <a href="" class="btn btn-info"><i class="fa-solid fa-arrow-rotate-right"></i></a>
            </div>
            <div class="col-md-3 form-group" style="padding-left:0px !important;">
                <label class="form-label">Estatus de Colaborador</label>
                <div class="d-flex">
                    <div class="btn btn-info mr-2" wire:click="updateEmpleadosEstatus('alta')"
                        style="background-color: #69D552; border:none !important;">
                        Alta
                    </div>
                    <div class="btn btn-info mr-2" wire:click="updateEmpleadosEstatus('baja')"
                        style="background-color: #FF9D9D; border:none !important;">
                        Baja
                    </div>
                    <div class="btn btn-info mr-2" wire:click="updateEmpleadosEstatus(null)"
                        style="background-color: #42ADDC; border:none !important;">
                        Todos
                    </div>
                </div>
            </div>
            <div class="col-md-9 form-group text-right d-flex" style="align-items: flex-end;">
                <button class="btn btn-success" wire:click="correoMasivo()"><i class="fa-solid fa-envelope mr-3"></i>
                    Enviar
                    correo a todos los colaboradores con horas faltantes de registrar</button>
            </div>
            <div class="datatable-fix w-100 mt-4">
                <table id="timesheet_empleados_lista"
                    class="table w-100 datatable_timesheet_empleados_reportes tabla-fixed"
                    data-semanas="{{ $semanas_totales_calendario }}">
                    <thead class="w-100" style="position: sticky !important; top: 250px;">
                        <tr>
                            <th class="cde-foto">Foto</th>
                            <th class="cde-nombre" style="text-align: right;">Nombre </th>
                            <th class="cde-puesto" style="text-align: right;">Puesto</th>
                            <th class="cde-area" style="text-align: right;">Área</th>
                            <th class="cde-estatus" style="text-align: right;">Estatus</th>
                            <th class="cde-fecha" style="text-align: right;">Fecha</th>
                            @foreach ($calendario_tabla as $calendar)
                                <th colspan="{{ $calendar['total_weeks'] }}" class="th-calendario th-año">
                                    <small>{{ $calendar['year'] }}</small>
                                </th>
                            @endforeach
                            <th class="cde-totalh">Total (hrs)</th>
                            <th class="cde-semenasf">Semanas sin&nbsp;registrar</th>
                            <th style="min-width:100px;" class="cde-op">Opciones</th>
                        </tr>
                        <tr>
                            <th class="cde-foto"></th>
                            <th class="cde-nombre"></th>
                            <th class="cde-puesto"></th>
                            <th class="cde-area"></th>
                            <th class="cde-estatus"></th>
                            <th class="cde-fecha"></th>
                            @foreach ($calendario_tabla as $calendar)
                                @foreach ($calendar['months'] as $key => $mes)
                                    @php
                                        $mes_traducido = '';
                                        switch ($key) {
                                            case 'January':
                                                $mes_traducido = 'Enero';
                                                break;
                                            case 'February':
                                                $mes_traducido = 'Febrero';
                                                break;
                                            case 'March':
                                                $mes_traducido = 'Marzo';
                                                break;
                                            case 'April':
                                                $mes_traducido = 'Abril';
                                                break;
                                            case 'May':
                                                $mes_traducido = 'Mayo';
                                                break;
                                            case 'June':
                                                $mes_traducido = 'Junio';
                                                break;
                                            case 'July':
                                                $mes_traducido = 'Julio';
                                                break;
                                            case 'August':
                                                $mes_traducido = 'Agosto';
                                                break;
                                            case 'September':
                                                $mes_traducido = 'Septiembre';
                                                break;
                                            case 'October':
                                                $mes_traducido = 'Octubre';
                                                break;
                                            case 'November':
                                                $mes_traducido = 'Noviembre';
                                                break;
                                            case 'December':
                                                $mes_traducido = 'Diciembre';
                                                break;
                                        }
                                    @endphp
                                    <th colspan="{{ $mes['total_weeks'] }}" class="th-calendario th-mes">
                                        <small>{{ $mes_traducido }} {{ $calendar['year'] }}</small>
                                    </th>
                                @endforeach
                            @endforeach
                            <th class="cde-totalh"></th>
                            <th class="cde-semenasf"></th>
                            <th class="cde-op"></th>
                        </tr>
                        <tr>
                            <th class="cde-foto"></th>
                            <th style="min-width: 150px;" class="cde-nombre"></th>
                            <th style="min-width: 150px;" class="cde-puesto"></th>
                            <th style="min-width: 150px;" class="cde-area"></th>
                            <th class="cde-estatus"></th>
                            <th class="cde-fecha"></th>
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
                            <th class="cde-totalh"></th>
                            <th class="cde-semenasf"></th>
                            <th class="cde-op"></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($empleados as $empleado_td)
                            <tr>
                                <td class="cde-foto"><img src="{{ $empleado_td['avatar_ruta'] }}"
                                        class="img_empleado">
                                </td>
                                <td class="cde-nombre">{{ $empleado_td['name'] }}</td>
                                <td class="cde-puesto">{{ $empleado_td['puesto'] }}</td>
                                <td class="cde-area">{{ $empleado_td['area'] }}</td>
                                <td style="text-transform: capitalize;" class="cde-estatus">
                                    <span class="empleado_estatus_{{ $empleado_td['estatus'] }}">
                                        {{ $empleado_td['estatus'] }}</span>
                                </td>
                                <td class="cde-fecha">
                                    <small
                                        style="color:#aaa;">Fecha&nbsp;de&nbsp;{{ $empleado_td['estatus'] == 'alta' ? 'ingreso' : 'baja' }}:
                                    </small>
                                    {{ $empleado_td['fecha_alta_baja'] }}
                                </td>
                                @foreach ($empleado_td['calendario'] as $index => $horas_calendar)
                                    <td style="font-size: 10px !important; text-align: center !important;">
                                        {!! $horas_calendar !!}</td>
                                @endforeach
                                <td class="text-center cde-totalh">{{ $empleado_td['horas_totales'] }}</td>
                                <td class="d-flex justify-content-center cde-semenasf"
                                    style="{{ $empleado_td['times_atrasados'] > 0 ? 'background-color:#FF9D9D !important;' : 'background-color:#69D552 !important;' }} cursor: pointer;"
                                    data-toggle="modal" data-target="#modal_semanas_{{ $empleado_td['id'] }}">
                                    {{ $empleado_td['times_atrasados'] }}
                                </td>
                                <td class="cde-op">
                                    {{-- <button class="btn" wire:click="buscarEmpleado({{ $empleado_td['id'] }})"
                                        title="Generar Reporte">
                                        <i class="fa-solid fa-file-invoice" style="color:#173D59 !important;"></i>
                                    </button> --}}

                                    @if ($empleado_td['times_atrasados'] > 0)
                                        <button class="btn" title="Notificar retrasos en Timesheet"
                                            data-toggle="modal"
                                            data-target="#modal_semanas_{{ $empleado_td['id'] }}">
                                            <i class="fa-solid fa-envelope" style="color:#173D59 !important;"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <td class="cde-foto"></td>
                        <td class="cde-nombre"></td>
                        <td class="cde-puesto"></td>
                        <td class="cde-area"></td>
                        <td class="cde-estatus"></td>
                        <td class="cde-fecha">Total:</td>
                        @if (isset($empleado_td))
                            @foreach ($empleado_td['calendario'] as $index => $horas_calendar)
                                <td></td>
                            @endforeach
                        @endif
                        <td class="cde-totalh"></td>
                        <td class="cde-semenasf"></td>
                        <td class="cde-op"></td>
                    </tfoot>
                </table>
            </div>
        </div>
        <!-- Modal semanas faltantes -->
        @foreach ($empleados as $empleado_md)
            <div class="modal fade" id="modal_semanas_{{ $empleado_md['id'] }}" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel{{ $empleado_md['id'] }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="exampleModalLabel{{ $empleado_md['id'] }}">
                                <font style="font-weight:lighter;">Semanas Faltantes de </font>
                                {{ $empleado_md['name'] }}
                            </h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class=" d-flex justify-content-between" style="padding: 7px;">
                                <strong> Semanas sin registrar </strong> <span class="span_atrasos"
                                    {{ $empleado_md['times_atrasados'] > 0 ? 'style=background-color:#FF9D9D;' : 'style=background-color:#69D552;' }}>{{ $empleado_md['times_atrasados'] }}
                                </span>
                            </div>
                            <ul class="list_times_faltantes scroll_estilo mt-3">
                                @foreach ($empleado_md['times_faltantes'] as $time_f)
                                    @php
                                        $fechas_array = explode('|', $time_f);
                                        $start = $fechas_array[0];
                                        $end = $fechas_array[1];
                                        $startDate = \Carbon\Carbon::parse($start)->format('d/m/Y');
                                        $endDate = \Carbon\Carbon::parse($end)->format('d/m/Y');
                                    @endphp
                                    <li>
                                        Del <strong>{{ $startDate }}</strong> al
                                        <strong>{{ $endDate }}</strong>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success"
                                wire:click="correoRetraso({{ $empleado_md['id'] }}, {{ $empleado_md['times_atrasados'] }})"
                                data-dismiss="modal">Notificar
                                Retrasos al Colaborador</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                $(".cde-nombre").mouseover(function() {
                    $(".cde-nombre").addClass("ver");
                });
                $(".cde-nombre").mouseleave(function() {
                    $(".cde-nombre").removeClass("ver");
                });

                $(".cde-puesto").mouseover(function() {
                    $(".cde-puesto").addClass("ver");
                });
                $(".cde-puesto").mouseleave(function() {
                    $(".cde-puesto").removeClass("ver");
                });

                $(".cde-area").mouseover(function() {
                    $(".cde-area").addClass("ver");
                });
                $(".cde-area").mouseleave(function() {
                    $(".cde-area").removeClass("ver");
                });

                $(".cde-estatus").mouseover(function() {
                    $(".cde-estatus").addClass("ver");
                });
                $(".cde-estatus").mouseleave(function() {
                    $(".cde-estatus").removeClass("ver");
                });
                $(".cde-fecha").mouseleave(function() {
                    $(".cde-fecha").removeClass("ver");
                });

                $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
                    .mouseover(
                        function() {
                            $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
                                .addClass("ver");
                        });
                $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
                    .mouseleave(function() {
                        $(".datatable_timesheet_proyectos tr th:nth-child(2), .datatable_timesheet_proyectos tr td:nth-child(2)")
                            .removeClass("ver");
                    });
                $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
                    .mouseover(
                        function() {
                            $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
                                .addClass("ver");
                        });
                $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
                    .mouseleave(function() {
                        $(".datatable_timesheet_proyectos tr th:nth-child(3), .datatable_timesheet_proyectos tr td:nth-child(3)")
                            .removeClass("ver");
                    });
                tablaLivewire('timesheet_empleados_lista');
                tablaLivewire('datatable_timesheet_empleados');
                tablaLivewire('table_horas_empleado_semanas');
                tablaLivewire('datatable_timesheet_empleados_area_general');
                $('.modal-backdrop').modal('hide');

                $("#fecha_dia_registros_inicio_empleado_reporte").flatpickr({
                    "disable": [
                        function(date) {
                            return (date.getDay() === 0 || date.getDay() === 2 || date
                                .getDay() === 3 || date.getDay() === 4 || date.getDay() ===
                                5 ||
                                date.getDay() === 6);

                        }
                    ],
                    locale: {
                        firstDayOfWeek: 1,
                        weekdays: {
                            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves',
                                'Viernes', 'Sábado'
                            ],
                        },
                        months: {
                            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago',
                                'Sep', 'Оct', 'Nov', 'Dic'
                            ],
                            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                                'Diciembre'
                            ],
                        },
                    },
                });
                $("#fecha_dia_registros_fin_empleado_reporte").flatpickr({
                    "disable": [
                        function(date) {
                            return (date.getDay() === 1 || date.getDay() === 2 || date
                                .getDay() === 3 || date.getDay() === 4 || date.getDay() ===
                                5 ||
                                date.getDay() === 6);

                        }
                    ],
                    locale: {
                        firstDayOfWeek: 1,
                        weekdays: {
                            shorthand: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa'],
                            longhand: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves',
                                'Viernes', 'Sábado'
                            ],
                        },
                        months: {
                            shorthand: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago',
                                'Sep', 'Оct', 'Nov', 'Dic'
                            ],
                            longhand: ['Enero', 'Febrero', 'Мarzo', 'Abril', 'Mayo', 'Junio',
                                'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre',
                                'Diciembre'
                            ],
                        },
                    },
                });
            });

            Livewire.on('scriptCharts', (proyectos_detalle, times_empleado_horas) => {
                console.log(proyectos_detalle);
                console.log(times_empleado_horas);

                initCharts();

                function initCharts() {
                    // let proyectos_detalle = @json($proyectos_detalle);
                    let labels_proyectos_detalle = [];
                    let values_proyectos_detalle = [];
                    let colors_proyectos_detalle = [];

                    let labels_tareas = [];
                    let values_tareas = [];
                    let colores_tareas = [];

                    proyectos_detalle.forEach(item => {
                        labels_proyectos_detalle.push(item.proyecto);
                        values_proyectos_detalle.push(item.horas);
                        colors_proyectos_detalle.push('#34DCCF');
                        item.tareas?.forEach(tarea => {
                            labels_tareas.push(recotarText(tarea.tarea));
                            values_tareas.push(tarea.horas);
                            colores_tareas.push(getRandomcolor());
                        });
                    });

                    let caja_graf_proyectos_horas_empleado = document.getElementById(
                        'caja-graf-proyectos-horas-empleado');
                    caja_graf_proyectos_horas_empleado.innerHTML = '&nbsp;';
                    $('#caja-graf-proyectos-horas-empleado').append(
                        '<canvas id="graf-proyectos-horas-empleado" width="800" height="400"></canvas>');
                    new Chart(document.getElementById('graf-proyectos-horas-empleado'), {
                        type: 'bar',
                        data: {
                            labels: labels_proyectos_detalle,
                            datasets: [{
                                label: 'Horas',
                                data: values_proyectos_detalle,
                                backgroundColor: colors_proyectos_detalle,
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

                    // let times_empleado_horas = @json($times_empleado_horas);
                    let labels_times_empleado_horas = [];
                    let values_times_empleado_horas = [];
                    let colors_times_empleado_horas = [];

                    times_empleado_horas.forEach(item => {
                        if ((item.estatus == 'pendiente') || (item.estatus == 'aprobado')) {
                            console.log(item);
                            labels_times_empleado_horas.push(item.semana_y);
                            values_times_empleado_horas.push(item.horas_totales);
                            colors_times_empleado_horas.push('#34DCCF');
                        }
                    });

                    let caja_graf_semanas_empleado = document.getElementById('caja-graf-semanas-empleado');
                    caja_graf_semanas_empleado.innerHTML = '&nbsp;';
                    $('#caja-graf-semanas-empleado').append(
                        '<canvas id="graf-semanas-empleado" width="800" height="400"></canvas>');
                    new Chart(document.getElementById('graf-semanas-empleado'), {
                        type: 'bar',
                        data: {
                            labels: labels_times_empleado_horas,
                            datasets: [{
                                label: 'Horas',
                                data: values_times_empleado_horas,
                                backgroundColor: colors_times_empleado_horas,
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

                    let caja_graf_empleado_tareas_horas = document.getElementById(
                        'caja-graf-empleado-tareas-horas');
                    caja_graf_empleado_tareas_horas.innerHTML = '&nbsp;';
                    $('#caja-graf-empleado-tareas-horas').append(
                        '<canvas id="graf-empleado-tareas-horas" width="800" height="400"></canvas>');
                    new Chart(document.getElementById('graf-empleado-tareas-horas'), {
                        type: 'pie',
                        data: {
                            labels: labels_tareas,
                            datasets: [{
                                label: 'Horas',
                                data: values_tareas,
                                backgroundColor: colores_tareas,
                            }]
                        },
                        options: {
                            legend: {
                                display: true,
                                position: 'right',
                                color: '#fff',
                            },
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            },
                            plugins: {
                                datalabels: {
                                    color: '#fff',
                                    display: true,
                                    font: {
                                        size: 13
                                    }
                                },
                            },
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

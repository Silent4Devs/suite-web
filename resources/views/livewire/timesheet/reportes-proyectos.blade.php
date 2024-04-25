<div class="">
    @php
        use App\Models\Organizacion;
    @endphp
    <style type="text/css">
        .tabla-calendar-time table {
            border-radius: 20px;
            overflow: hidden;
        }

        .tabla-calendar-time td {
            border-bottom: 0px solid #bbb !important;
        }

        .datatable_timesheet_proyectos thead tr:nth-child(1) th {
            background-color: #FFD2D2 !important;
        }

        .datatable_timesheet_proyectos thead tr:nth-child(2) th {
            background-color: #FFEEEE !important;
        }

        .datatable_timesheet_proyectos thead tr:nth-child(3) th {
            background-color: #FFF9EB !important;
        }

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
            right: 0 !important;
            background-color: #c5c5c5;
        }

        table.dataTable thead>tr>th.sorting:before,
        table.dataTable thead>tr>th.sorting:after,
        table.dataTable thead>tr>th.sorting_asc:before,
        table.dataTable thead>tr>th.sorting_asc:after,
        table.dataTable thead>tr>th.sorting_desc:before,
        table.dataTable thead>tr>th.sorting_desc:after,
        table.dataTable thead>tr>th.sorting_asc_disabled:before,
        table.dataTable thead>tr>th.sorting_asc_disabled:after,
        table.dataTable thead>tr>th.sorting_desc_disabled:before,
        table.dataTable thead>tr>th.sorting_desc_disabled:after,
        table.dataTable thead>tr>td.sorting:before,
        table.dataTable thead>tr>td.sorting:after,
        table.dataTable thead>tr>td.sorting_asc:before,
        table.dataTable thead>tr>td.sorting_asc:after,
        table.dataTable thead>tr>td.sorting_desc:before,
        table.dataTable thead>tr>td.sorting_desc:after,
        table.dataTable thead>tr>td.sorting_asc_disabled:before,
        table.dataTable thead>tr>td.sorting_asc_disabled:after,
        table.dataTable thead>tr>td.sorting_desc_disabled:before,
        table.dataTable thead>tr>td.sorting_desc_disabled:after {
            position: absolute !important;
            opacity: 1 !important;
            line-height: 9px !important;
            font-size: .8em !important;
            color: #c5c5c5 !important;
        }

        .datatable_timesheet_proyectos tr th:last-child::before,
        .datatable_timesheet_proyectos tr td:last-child::before {
            content: "";
            position: absolute;
            width: 1px;
            height: 100%;
            top: 0 !important;
            left: 0;
            background-color: #c5c5c5;
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
    <div class="card-body card">
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
            <div class="col-md-3 form-group">
                <label class="form-label">Proyecto</label>
                <select class="form-control" wire:model.defer="proyecto_id">
                    <option selected value="0">
                        Mostrar todos los proyectos
                        @if ($area_id)
                            del área
                        @endif
                    </option>
                    @foreach ($proyectos_select as $proyect)
                        <option value="{{ $proyect->id }}">
                            {{ $proyect->identificador }} - {{ $proyect->proyecto }}
                        </option>
                    @endforeach
                </select>
                <small>Seleccione "Mostrar todo los proyectos" para mostrar todos</small>
            </div>
            <div class="col-md-2 form-group" wire:ignore>
                <label class="form-label">Fecha de inicio</label>
                <input id="fecha_dia_registros_inicio_proyectos" class="form-control date_librery" type="date"
                    name="fecha_inicio" wire:model.defer="fecha_inicio">
            </div>
            <div class="col-md-2 form-group" wire:ignore>
                <label class="form-label">Fecha de fin</label>
                <input id="fecha_dia_registros_fin_proyectos" class="form-control date_librery" type="date"
                    name="fecha_fin" wire:model.defer="fecha_fin">
            </div>
            <div class="col-md-2">
                <label for="">&nbsp;</label>
                <div>
                    <button class="btn btn-secondary" wire:click="render()">Buscar</button>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    <div class="card card-body">
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
                    <div class="col-6 p-0 d-none" style="text-align: end">
                        <div class="row">
                            <div class="col-6 p-0"></div>
                            <div class="col-6 p-0">
                                <input type="text" class="form-control" placeholder="Buscar..." wire:model="search">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="datatable-fix tabla-calendar-time">
            <table id="datatable_timesheet_proyectos"
                class="datatable_timesheet_proyectos table w-100 tabla-fixed tabla-calendar-time">
                <thead>
                    <tr>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;" ROWSPAN=3>
                            ID-Proyecto</th>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;" ROWSPAN=3>
                            Áreas participantes</th>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;" ROWSPAN=3>
                            Empleados participantes</th>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;" ROWSPAN=3>
                            Cliente</th>
                        @foreach ($calendario_tabla as $calendar)
                            <th colspan="{{ $calendar['total_weeks'] }}" class="th-calendario th-año">
                                <small>{{ $calendar['year'] }}</small>
                            </th>
                        @endforeach
                        <th style="min-width: 50px;text-align: justify;width: 50px;align-content: center;" ROWSPAN=3>
                            Total horas</th>
                    </tr>
                    <tr>
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
                    </tr>
                    <tr>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proyectos_array as $proyecto)
                        <tr>
                            <td>{{ $proyecto['identificador'] }} - {{ $proyecto['proyecto'] }}</td>
                            <td>
                                <ul style="padding-left: 10px;">
                                    @foreach ($proyecto['areas'] as $area)
                                        <li>{{ $area['area'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>
                                <ul style="padding-left: 10px;">
                                    @foreach ($proyecto['empleados'] as $empleado)
                                        <li>{{ $empleado['name'] }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $proyecto['cliente'] }} </td>
                            @foreach ($proyecto['calendario'] as $index => $horas_calendar)
                                <td style="font-size: 10px !important; text-align: center !important;">
                                    {!! $horas_calendar !!}</td>
                            @endforeach
                            <td>
                                {{ $proyecto['horas_totales'] }} h
                            </td>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            Livewire.on('scriptTabla', () => {
                tablaLivewire('datatable_timesheet_proyectos');
                tablaLivewire('datatable_timesheet_proyectos_empleados');
            });
        });
    </script>
</div>

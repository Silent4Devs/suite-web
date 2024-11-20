<div class="">
    @php
        use App\Models\Organizacion;
    @endphp
    <style type="text/css">
        .tabla-calendar-time table {
            border-radius: 10px 10px 0 0;
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
                <select class="form-control" wire:model.live="area_id">
                    <option selected value="0">Todas</option>
                    @foreach ($areas as $area)
                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 form-group">
                <label class="form-label">Proyecto</label>
                <select class="form-control" wire:model="proyecto_id">
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
                    name="fecha_inicio" wire:model="fecha_inicio">
            </div>
            <div class="col-md-2 form-group" wire:ignore>
                <label class="form-label">Fecha de fin</label>
                <input id="fecha_dia_registros_fin_proyectos" class="form-control date_librery" type="date"
                    name="fecha_fin" wire:model="fecha_fin">
            </div>
            <div class="col-md-2">
                <label for="">&nbsp;</label>
                <div>
                    <button class="btn btn-secondary" wire:click="$refresh">Buscar</button>
                </div>
            </div>
        </div>
        <div class="row">

        </div>
    </div>
    {{-- <div class="card card-body">
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
                                        <select name="" id="" class="form-control" wire:model.live="perPage">
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
                                <input type="text" class="form-control" placeholder="Buscar..." wire:model.live="search">
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
    </div> --}}
    <div class="card card-body">
        <div class="datatable-fix tabla-calendar-time">
            <table id="datatabletimesheetproyectos"
                class="datatable_timesheet_proyectos table w-100 tabla-fixed tabla-calendar-time">
                <thead>
                    <tr>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;"
                            rowspan="3">ID-Proyecto</th>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;"
                            rowspan="3">Áreas participantes</th>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;"
                            rowspan="3">Empleados participantes</th>
                        <th style="min-width: 250px;text-align: justify;width: 250px;align-content: center;"
                            rowspan="3">Cliente</th>
                        @foreach ($calendario_tabla as $calendar)
                            <th colspan="{{ $calendar['total_weeks'] }}" class="th-calendario th-año">
                                <small>{{ $calendar['year'] }}</small>
                            </th>
                        @endforeach
                        <th style="min-width: 50px;text-align: justify;width: 50px;align-content: center;"
                            rowspan="3">Total horas</th>
                    </tr>
                    <tr>
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
                                        <small>Del <strong>{{ $fecha_inicio_time }}</strong> al
                                            <strong>{{ $fecha_fin_time }}</strong></small>
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
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('scriptTabla', () => {
            tablaLivewire('datatable_timesheet_proyectos');
            tablaLivewire('datatable_timesheet_proyectos_empleados');
            tablaLivewire('datatabletimesheetproyectos');
        });
    });
</script>
<script>
    document.addEventListener('livewire:init', function() {
        setTimeout(function() {
            tablaLivewire('datatabletimesheetproyectos');
        }, 100);
    });

    let cont = 0;

    function tablaLivewire(id_tabla) {
        $('#' + id_tabla).attr('id', id_tabla + cont);
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Mis Registros ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customizeData: function(data) {
                        for (var i = 0; i < data.body.length; i++) {
                            var columnaB = data.body[i][1];
                            var elementosB = columnaB.split(/\s{2,}/);
                            var arrayB = [];
                            elementosB.forEach(function(elemento) {
                                arrayB.push(elemento.trim());
                            });
                            data.body[i][1] = arrayB;

                            var columnaC = data.body[i][2];
                            var elementosC = columnaC.split(/\s{2,}/);
                            var arrayC = [];
                            elementosC.forEach(function(elemento) {
                                arrayC.push(elemento.trim());
                            });
                            data.body[i][2] = arrayC;

                            var columnaD = data.body[i][3];
                            var elementosD = columnaD.split(/\s{2,}/);
                            var arrayD = [];
                            elementosD.forEach(function(elemento) {
                                arrayD.push(elemento.trim());
                            });
                            data.body[i][3] = arrayD;
                        }
                    },
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets[
                            'Sheet1.xml'];
                        $('col', sheet).each(function() {
                            $(this).attr('width', '25');
                        });
                        $('row c[r^="B"], row c[r^="C"], row c[r^="D"]', sheet).each(function() {
                            var cellText = $(this).find('is t').text();
                            cellText = cellText.replace(/,/g, ',\n');
                            $(this).find('is t').text(cellText);
                            $(this).attr('s', '25');
                            $(this).attr('style', 'mso-wrap-text: true;');
                        });
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }
            ];
            let dtOverrideGlobals = {
                buttons: dtButtons,
                destroy: true,
                render: true,
                paging: true, // Enable pagination
                pageLength: 10, // Set the number of records per page
                lengthMenu: [5, 10, 25, 50, 100], // Define available page lengths
            };
            let table = $('#' + id_tabla + cont).DataTable(dtOverrideGlobals);
        });
    }
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            tablaLivewire('datatabletimesheetproyectos');
        }, 100);
    });
</script>
</div>

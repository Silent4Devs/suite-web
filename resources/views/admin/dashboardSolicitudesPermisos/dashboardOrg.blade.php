@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/dashboardPermisos/dahsboardPermisos.css') }}{{ config('app.cssVersion') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboardPermisos/mobiscroll.javascript.min.css') }}">
    <script src="{{ asset('js/dashboardSolicitudes/mobiscroll.javascript.min.js') }}"></script>

    <script src="https://fastly.jsdelivr.net/npm/echarts@5.5.1/dist/echarts.min.js"></script>
@endsection
@section('content')
    <style>
        .dataTables_scroll .datatable-historial.dataTable.no-footer {
            width: 100% !important;
        }
    </style>
    {{-- {{ Breadcrumbs::render('Reglas-DayOff') }} --}}

    <h5 class="titulo_general_funcion">Solicitudes: <span style="font-weight: lighter;">Dashboard</span></h5>

    <div class="d-flex gap-3">
        <div class="card card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center justify-content-between gap-1 mr-5">
                        <span style="font-size: 25px;">Directivo</span>
                        <div>
                            <strong>Nombre del colaborador</strong> <br>
                            <span>{{ $currentUser->empleado->name }}</span>
                        </div>
                        <div class="img-person" style="width: 80px; height: 80px;">
                            <img src="{{ $currentUser->empleado->avatar_ruta }}" alt="{{ $currentUser->empleado->name }}">
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <hr class="line-vertical" style="height: 100%;">
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="">Área</label>
                        <select name="area" id="area" class="form-control" onchange="redirectToPage()">
                            <option value="all">Todas las Áreas</option>
                            @foreach ($areasToSelect as $area)
                                <option value="{{ $area->id }}" {{ $areaSeleccionada == $area->id ? 'selected' : '' }}>
                                    {{ $area->area }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-body text-center justify-content-center" style="max-width: 200px; cursor:pointer;"
            onclick="window.print();">
            <strong>Reporte</strong>
            <i class="material-symbols-outlined" style="font-size: 60px; color:#006DDB;">print</i>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #428BEC;">
                <div class="d-flex align-items-center gap-3">
                    <i class="material-symbols-outlined">water_lux</i>
                    <span>
                        Vacaciones por mes
                    </span>
                </div>
                <span>
                    <strong>
                        @if ($areaSeleccionada === 'all')
                            {{ $vacacionesMounth->count() }}
                        @else
                            @php
                                $vacacionesMounth = $vacacionesMounth->filter(function ($vacation) use (
                                    $areaSeleccionada,
                                ) {
                                    return $vacation->empleado->area_id === $areaSeleccionada;
                                });
                            @endphp
                            {{ $vacacionesMounth->count() }}
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #2972D4;">
                <div class="d-flex align-items-center gap-3">
                    <i class="material-symbols-outlined">work_history</i>
                    <span>
                        Day por mes
                    </span>
                </div>
                <span>
                    <strong>
                        @if ($areaSeleccionada == 'all')
                            {{ $dayOffMounth->count() }}
                        @else
                            @php
                                $dayOffMounth = $dayOffMounth->filter(function ($dayOff) use ($areaSeleccionada) {
                                    return $dayOff->empleado->area_id === $areaSeleccionada;
                                });
                            @endphp
                            {{ $dayOffMounth->count() }}
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #1757AB;">
                <div class="d-flex align-items-center gap-3">
                    <i class="material-symbols-outlined">license</i>
                    <span>
                        Permisos por mes
                    </span>
                </div>
                <span>
                    <strong>
                        @if ($areaSeleccionada === 'all')
                            {{ $permisoMounth->count() }}
                        @else
                            @php
                                $vacacionesMounth = $vacacionesMounth->filter(function ($vacation) {
                                    return $vacation->aprobacion === 3;
                                });
                                $dayOffMounth = $dayOffMounth->filter(function ($dayOff) {
                                    return $dayOff->aprobacion === 3;
                                });
                                $permisoMounth = $permisoMounth->filter(function ($permiso) {
                                    return $permiso->aprobacion === 3;
                                });
                            @endphp
                            {{ $permisoMounth->count() }}
                        @endif
                    </strong>
                </span>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #78BB50;">
                <div class="d-flex align-items-center gap-3">
                    <i class="material-symbols-outlined">check_circle</i>
                    <span>
                        Aprobadas por mes
                    </span>
                </div>
                <span>
                    <strong>

                        @php
                            $permisoMounth = $permisoMounth->filter(function ($permiso) {
                                return $permiso->aprobacion === 3;
                            });
                        @endphp
                        {{ $permisoMounth->count() }}
                    </strong>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #FFA200;">
                <div class="d-flex align-items-center gap-3">
                    <i class="material-symbols-outlined">assignment_late</i>
                    <span>
                        Por aprobar por mes
                    </span>
                </div>
                <span>
                    <strong>0</strong>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #E90046;">
                <div class="d-flex align-items-center gap-3">
                    <i class="material-symbols-outlined">block</i>
                    <span>
                        Rechazadas por mes
                    </span>
                </div>
                <span>
                    <strong>0</strong>
                </span>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">

            <div class="card card-body">
                <div class="calendar calendar-first" id="calendar_first" style="">
                    <div class="calendar_header">
                        <h2></h2>
                        <button class="switch-month switch-left btn">
                            <i class="fa fa-chevron-left"></i>
                        </button>
                        <button class="switch-month switch-right btn">
                            <i class="fa fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="calendar_weekdays"></div>
                    <div class="calendar_content"></div>
                </div>
            </div>

        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-body">


                <div mbsc-page class="demo-daily-agenda-with-week-calendar">
                    <div style="height:100%">
                        <div id="demo-daily-agenda"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="datatable-fix datatable-rds">
            <table class="datatable-historial">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo de solicitud</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($vacaciones as $vacTable)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-4">
                                    <div class="img-person">
                                        <img src="" alt="">
                                    </div>

                                    <span>{{ $vacTable->name }}</span>
                                </div>
                            </td>
                            <td>
                                Vacaciones
                            </td>
                            <td>
                                {{ $vacTable->fecha_inicio }}
                            </td>
                            <td>
                                {{ $vacTable->fecha_fin }}
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($dayOff as $dayTable)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-4">
                                    <div class="img-person">
                                        <img src="" alt="">
                                    </div>

                                    <span>{{ $dayTable->name }}</span>
                                </div>
                            </td>
                            <td>
                                DayOff
                            </td>
                            <td>
                                {{ $dayTable->fecha_inicio }}
                            </td>
                            <td>
                                {{ $dayTable->fecha_fin }}
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($permisos as $permisoTable)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-4">
                                    <div class="img-person">
                                        <img src="" alt="">
                                    </div>

                                    <span>{{ $permisoTable->name }}</span>
                                </div>
                            </td>
                            <td>
                                Permiso
                            </td>
                            <td>
                                {{ $permisoTable->fecha_inicio }}
                            </td>
                            <td>
                                {{ $permisoTable->fecha_fin }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @livewire('dashboard-permisos.graph-areas', ['areaSeleccionada' => $areaSeleccionada])

    <div class="row">
        <div class="col-md-6">
            @livewire('dashboard-permisos.graph-dona', ['areaSeleccionada' => $areaSeleccionada])
        </div>
        <div class="col-md-6">
            @livewire('dashboard-permisos.graph-types', ['areaSeleccionada' => $areaSeleccionada])
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script src="{{ asset('js/calendar-comunicado.js') }}"></script>
    <script src="{{ asset('js/calendario-comunicacion.js') }}"></script>

    <script>
        mobiscroll.setOptions({
            locale: mobiscroll.localeEs, // Idioma: español
            theme: 'ios', // Tema: iOS
            themeVariant: 'light', // Variante del tema: claro
        });

        let dataVacaciones = [];
        let vacacionesEvents = @json($vacacionesEvents);
        vacacionesEvents.forEach(vacacion => {
            dataVacaciones.push({
                title: vacacion['title'],
                start: new Date(
                    vacacion['inicio']['año'],
                    vacacion['inicio']['mes'],
                    vacacion['inicio']['dia'],
                ),
                end: new Date(
                    vacacion['fin']['año'],
                    vacacion['fin']['mes'],
                    vacacion['fin']['dia'],
                ),
                color: vacacion['color'],
            });
        });

        let dataDayOff = [];
        let dayOffEvents = @json($dayOffEvents);
        dayOffEvents.forEach(day => {
            dataDayOff.push({
                title: day['title'],
                start: new Date(
                    day['inicio']['año'],
                    day['inicio']['mes'],
                    day['inicio']['dia'],
                ),
                end: new Date(
                    day['fin']['año'],
                    day['fin']['mes'],
                    day['fin']['dia'],
                ),
                color: day['color'],
            });
        });

        let dataPermisos = [];

        let permisosEvents = @json($permisosEvents);
        permisosEvents.forEach(permiso => {
            dataPermisos.push({
                title: permiso['title'],
                start: new Date(
                    permiso['inicio']['año'],
                    permiso['inicio']['mes'],
                    permiso['inicio']['dia'],
                ),
                end: new Date(
                    permiso['fin']['año'],
                    permiso['fin']['mes'],
                    permiso['fin']['dia'],
                ),
                color: permiso['color'],
            });
        });

        console.log(dataPermisos);

        var inst = mobiscroll.eventcalendar('#demo-daily-agenda', {
            view: {
                agenda: {
                    type: 'day'
                },
            },
            data: dataVacaciones.concat(dataDayOff).concat(dataPermisos),
            onEventClick: function(args) {
                mobiscroll.toast({
                    message: args.event.title,
                });
            },
        });
    </script>

    <script>
        function redirectToPage() {
            var select = document.getElementById("area");
            var selectedValue = 'all';
            selectedValue = select.value;



            if (selectedValue) { // Verifica que una opción esté seleccionada

                var baseUrl = @json(asset('admin/dashboardPermisos/dashboardOrg')) + '/' + selectedValue; // URL base
                window.location.href = baseUrl;
            }
        }
    </script>

    <script>
        mobiscroll.setOptions({
            locale: mobiscroll
                .localeEs, // Specify language like: locale: mobiscroll.localePl or omit setting to use default
            theme: 'ios', // Specify theme like: theme: 'ios' or omit setting to use default
            themeVariant: 'light' // More info about themeVariant: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-themeVariant
        });

        $(function() {
            var inst = $('#demo-daily-events')
                .mobiscroll()
                .eventcalendar({

                    view: { // More info about view: https://mobiscroll.com/docs/jquery/eventcalendar/api#opt-view
                        calendar: {
                            type: 'week'
                        },
                        agenda: {
                            type: 'day'
                        },
                    },
                    onEventClick: function(
                        args
                    ) { // More info about onEventClick: https://mobiscroll.com/docs/jquery/eventcalendar/api#event-onEventClick
                        mobiscroll.toast({

                            message: args.event.title,
                        });
                    },
                })
                .mobiscroll('getInst');

            $.getJSON('https://trial.mobiscroll.com/events/?vers=5&callback=?', function(events) {
                inst.setEvents(events);
            });
        });
    </script>

    <script>
        let currentTime = new Date();
        let options = {
            timeStyle: 'short',
            hour12: true
        };
        let hora_complete = currentTime.toLocaleTimeString('en-US', options);
        let [hora, med] = hora_complete.split(' ');

        document.getElementById('hora-portal').innerHTML = hora;
        document.getElementById('med-portal>').innerHTML = med;

        const fechaActual = new Date();

        // Opciones para el formato de fecha
        const opcionesFecha = {
            month: 'long',
            day: 'numeric',
            weekday: 'long'
        };

        // Convertir la fecha actual a formato humano en español
        const fechaHumana = fechaActual.toLocaleDateString('es-ES', opcionesFecha).replace(' de ', ' ');

        // Mostrar la fecha en la consola
        document.getElementById('fecha-completa').innerHTML = fechaHumana;

        function carruselPortal(tipo) {
            if (tipo == 'advance') {
                console.log('iso');
                document.querySelector('.carrusel-portal:hover .caja-items-carrusel-portal').scrollLeft += 400;
            }
            if (tipo == 'retreat') {
                document.querySelector('.carrusel-portal:hover .caja-items-carrusel-portal').scrollLeft -= 400;
            }
        }

        $(document).ready(function() {
            // Reemplaza '82a605d0' y '010461c49fd2f4a8f1968e0236b802fa' con tus credenciales de WeatherUnlocked
            const appId = '82a605d0';
            const apiKey = '010461c49fd2f4a8f1968e0236b802fa';

            // Coordenadas para una ubicación específica (51.50, -0.12 es Londres, puedes cambiarlo)
            const latitude = 51.50;
            const longitude = -0.12;

            // URL de la API de WeatherUnlocked para obtener datos del tiempo en una ubicación específica
            const apiUrl =
                `http://api.weatherunlocked.com/api/current/${latitude},${longitude}?app_id=${appId}&app_key=${apiKey}`;

            // Realiza la solicitud a la API utilizando jQuery AJAX
            $.ajax({
                url: apiUrl,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Muestra la información del tiempo en el elemento con id 'weather-info'
                    console.log(data);
                },
                error: function(error) {
                    console.error('Error al obtener datos del tiempo:', error);
                }
            });
        });
    </script>

    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'print',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                    <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                            <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                        </div>
                        <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                            <p>${empresa_actual}</p>
                            <strong style="color:#345183">CONFORMACIÓN DEL COMITÉ</strong>
                        </div>
                        <div class="col-3 p-2">
                            Fecha: ${jsDate}
                        </div>
                    </div>
                `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
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
                order: [
                    [0, 'desc']
                ],
            };

            let table = $('.datatable-historial').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

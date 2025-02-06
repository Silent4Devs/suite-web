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
                        <span style="font-size: 25px;" class="text-center me-4">
                            @can('dashboard_solicitudes_directivo')
                                Directivo
                            @else
                                Líder
                            @endcan
                        </span>
                        <div>
                            <strong>Nombre del colaborador</strong> <br>
                            <span>{{ $currentUser->empleado->name }}</span>
                        </div>
                        <div class="img-person" style="width: 80px; height: 80px;">
                            <img src="{{ $currentUser->empleado->avatar_ruta }}" alt="{{ $currentUser->empleado->name }}">
                        </div>
                    </div>
                </div>
                @can('dashboard_solicitudes_directivo')
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
                @endcan
            </div>
        </div>
        <div class="card card-body text-center justify-content-center btn-reporte-print"
            style="max-width: 200px; cursor:pointer;" onclick="window.print();">
            <strong>Reporte</strong>
            <i class="material-symbols-outlined" style="font-size: 60px; color:var(--color-tbj)">print</i>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #5899ef;">
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
                                    return $vacation->empleado->area_id === intval($areaSeleccionada);
                                });
                            @endphp
                            {{ $vacacionesMounth->count() }}
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #2962d4;">
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
                                    return $dayOff->empleado->area_id === intval($areaSeleccionada);
                                });
                            @endphp
                            {{ $dayOffMounth->count() }}
                        @endif
                    </strong>
                </span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-indicator-permiso" style="background-color: #0808a9;">
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
                                $permisoMounth = $permisoMounth->filter(function ($permiso) use ($areaSeleccionada) {
                                    return $permiso->empleado->area_id === intval($areaSeleccionada);
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
                            $vacacionesMounthAprobadas = $vacacionesMounth->filter(function ($vacation) {
                                return $vacation->aprobacion === 3;
                            });
                            $dayOffMounthAprobadas = $dayOffMounth->filter(function ($dayOff) {
                                return $dayOff->aprobacion === 3;
                            });
                            $permisoMounthAprobadas = $permisoMounth->filter(function ($permiso) {
                                return $permiso->aprobacion === 3;
                            });
                        @endphp
                        {{ $vacacionesMounthAprobadas->count() + $dayOffMounthAprobadas->count() + $permisoMounthAprobadas->count() }}
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
                    <strong>
                        @php
                            $vacacionesMounthPendientes = $vacacionesMounth->filter(function ($vacation) {
                                return $vacation->aprobacion === 1;
                            });
                            $dayOffMounthPendientes = $dayOffMounth->filter(function ($dayOff) {
                                return $dayOff->aprobacion === 1;
                            });
                            $permisoMounthPendientes = $permisoMounth->filter(function ($permiso) {
                                return $permiso->aprobacion === 1;
                            });
                        @endphp
                        {{ $vacacionesMounthPendientes->count() + $dayOffMounthPendientes->count() + $permisoMounthPendientes->count() }}
                    </strong>
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
                    <strong>
                        @php
                            $vacacionesMounthRechazadas = $vacacionesMounth->filter(function ($vacation) {
                                return $vacation->aprobacion === 2;
                            });
                            $dayOffMounthRechazadas = $dayOffMounth->filter(function ($dayOff) {
                                return $dayOff->aprobacion === 2;
                            });
                            $permisoMounthRechazadas = $permisoMounth->filter(function ($permiso) {
                                return $permiso->aprobacion === 2;
                            });
                        @endphp
                        {{ $vacacionesMounthRechazadas->count() + $dayOffMounthRechazadas->count() + $permisoMounthRechazadas->count() }}
                    </strong>
                </span>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6 d-flex">

            <div class="card card-body">

                <div class="container">
                    <div class="calendar">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <button id="prevMonth" class="btn">
                                <i class="material-symbols-outlined">arrow_back_ios</i>
                            </button>
                            <h3 id="monthYear"></h3>
                            <button id="nextMonth" class="btn">
                                <i class="material-symbols-outlined">arrow_forward_ios</i>
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead>
                                    <tr>
                                        <th>Lun</th>
                                        <th>Mar</th>
                                        <th>Mié</th>
                                        <th>Jue</th>
                                        <th>Vie</th>
                                        <th>Sáb</th>
                                        <th>Dom</th>
                                    </tr>
                                </thead>
                                <tbody id="calendarDays"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="eventModalLabel">Personas en el día <span id="modalDay"></span>
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <ul id="eventList" class="list-unstyled"></ul>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
        <div class="col-md-6 d-flex">
            <div class="card card-body">


                <style>
                    #agnEventsContainer {
                        max-height: 450px;
                    }

                    .agn-event-card {
                        display: flex;
                        align-items: center;
                        border: 1px solid #ddd;
                        border-radius: 5px;
                        padding: 10px;
                        margin-bottom: 10px;
                        background-color: #f9f9f9;
                    }

                    .agn-event-image {
                        width: 50px;
                        height: 50px;
                        border-radius: 50%;
                        object-fit: cover;
                        margin-right: 10px;
                    }

                    .agn-no-events {
                        color: #999;
                        font-style: italic;
                    }
                </style>

                <div class="container">

                    <!-- Controles de navegación -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button id="agnPrevBtn" class="btn btn-primary">← Anterior</button>
                        <input type="date" id="agnDatePicker" class="form-control w-auto" />
                        <button id="agnNextBtn" class="btn btn-primary">Siguiente →</button>
                    </div>

                    <!-- Eventos del día -->
                    <div id="agnEventsContainer">
                        <!-- Los eventos se mostrarán aquí -->
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
                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-4">
                                    <div class="img-person">
                                        <img src="{{ $solicitud->empleado->avatar_ruta }}"
                                            alt="{{ $solicitud->empleado->name }}">
                                    </div>

                                    <span>{{ $solicitud->empleado->name }}</span>
                                </div>
                            </td>
                            <td>
                                {{ $solicitud->tipo_solicitud }}
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($solicitud->fecha_inicio)->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ Carbon\Carbon::parse($solicitud->fecha_fin)->format('d/m/Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    @can('dashboard_solicitudes_directivo')
        @livewire('dashboard-permisos.graph-areas', ['areaSeleccionada' => $areaSeleccionada])
    @endcan

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
    <script>
        document.addEventListener("DOMContentLoaded", () => {

            let vacacionesEvents = @json($vacacionesEvents);
            let dayOffEvents = @json($dayOffEvents);
            let permisosEvents = @json($permisosEvents);

            const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
                "Septiembre",
                "Octubre", "Noviembre", "Diciembre"
            ];
            let currentDate = new Date();

            let dataVacaciones = [];
            vacacionesEvents.forEach(vacacion => {
                dataVacaciones.push({
                    name: vacacion['title'],
                    image: vacacion['empleado_img'],
                    startDate: vacacion['inicio']['año'] + '-' + vacacion['inicio']['mes'] + '-' +
                        vacacion[
                            'inicio']['dia'],
                    endDate: vacacion['fin']['año'] + '-' + vacacion['fin']['mes'] + '-' + vacacion[
                        'fin']['dia'],
                });
            });

            let dataDayOff = [];
            dayOffEvents.forEach(day => {
                dataDayOff.push({
                    name: day['title'],
                    image: day['empleado_img'],
                    startDate: day['inicio']['año'] + '-' + day['inicio']['mes'] + '-' + day[
                        'inicio']['dia'],
                    endDate: day['fin']['año'] + '-' + day['fin']['mes'] + '-' + day[
                        'fin']['dia'],
                });
            });

            let dataPermisos = [];
            permisosEvents.forEach(permiso => {
                dataPermisos.push({
                    name: permiso['title'],
                    image: permiso['empleado_img'],
                    startDate: permiso['inicio']['año'] + '-' + permiso['inicio']['mes'] + '-' +
                        permiso[
                            'inicio']['dia'],
                    endDate: permiso['fin']['año'] + '-' + permiso['fin']['mes'] + '-' + permiso[
                        'fin']['dia'],
                });
            });


            // Ejemplo de eventos con rango de fechas (inicio, fin)
            const events = dataVacaciones.concat(dataDayOff).concat(dataPermisos);
            console.log(events);

            renderCalendar();

            document.getElementById("prevMonth").addEventListener("click", function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                renderCalendar();
            });

            document.getElementById("nextMonth").addEventListener("click", function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                renderCalendar();
            });

            function renderCalendar() {
                const month = currentDate.getMonth();
                const year = currentDate.getFullYear();
                document.getElementById("monthYear").textContent = `${monthNames[month]} ${year}`;

                const firstDayOfMonth = new Date(year, month, 1).getDay();
                const lastDateOfMonth = new Date(year, month + 1, 0).getDate();

                const calendarDays = document.getElementById("calendarDays");
                calendarDays.innerHTML = "";

                let row = document.createElement("tr");
                let dayCellCount = 0;

                // Ajustar primer día (Lunes es 1)
                const startDay = (firstDayOfMonth + 6) % 7;

                // Fill empty cells before the start of the month
                for (let i = 0; i < startDay; i++) {
                    row.appendChild(createEmptyDay());
                    dayCellCount++;
                }

                // Fill the actual days of the month
                for (let day = 1; day <= lastDateOfMonth; day++) {
                    if (dayCellCount === 7) {
                        calendarDays.appendChild(row);
                        row = document.createElement("tr");
                        dayCellCount = 0;
                    }

                    const dayKey =
                        `${year}-${(month + 1).toString().padStart(2, '0')}-${day.toString().padStart(2, '0')}`;
                    const dayCell = createDayCell(day, dayKey);
                    row.appendChild(dayCell);

                    dayCellCount++;
                }

                // Fill remaining empty cells
                while (dayCellCount < 7) {
                    row.appendChild(createEmptyDay());
                    dayCellCount++;
                }
                calendarDays.appendChild(row);
            }

            function createDayCell(day, dayKey) {
                const cell = document.createElement("td");
                cell.classList.add("day");
                cell.innerHTML = `<span class="date">${day}</span>`;

                const dayEvents = events.filter(event => isEventInDay(event, dayKey));

                if (dayEvents.length > 0) {
                    const imgContainer = document.createElement("div");
                    imgContainer.classList.add("event-images");

                    dayEvents.slice(0, 2).forEach(person => {
                        const imgPersonContainer = document.createElement("div");
                        imgPersonContainer.classList.add("img-person");

                        const img = document.createElement("img");
                        img.src = person.image;
                        img.alt = person.name;

                        imgPersonContainer.appendChild(img);
                        imgContainer.appendChild(imgPersonContainer);
                    });

                    if (dayEvents.length > 2) {
                        const moreIndicator = document.createElement("span");
                        moreIndicator.textContent = `+${dayEvents.length - 2}`;
                        imgContainer.appendChild(moreIndicator);
                    }

                    cell.appendChild(imgContainer);

                    cell.addEventListener('click', function() {
                        showEventModal(day, dayEvents);
                    });
                }

                return cell;
            }

            function createEmptyDay() {
                const cell = document.createElement("td");
                cell.classList.add("empty");
                return cell;
            }

            function isEventInDay(event, dayKey) {
                const day = new Date(dayKey);
                const startDate = new Date(event.startDate);
                const endDate = new Date(event.endDate);
                return day >= startDate && day <= endDate;
            }

            function showEventModal(day, eventPeople) {
                document.getElementById("modalDay").textContent = day;
                const eventList = document.getElementById("eventList");
                eventList.innerHTML = '';

                eventPeople.forEach(person => {
                    const listItem = document.createElement("li");
                    listItem.classList.add("d-flex", "align-items-center", "mb-2");
                    listItem.innerHTML =
                        `
                            <div class="img-person">
                                <img src="${person.image}" alt="${person.name}">
                            </div>
                            <span class="ms-3">${person.name}</span>

                        `;
                    eventList.appendChild(listItem);
                });

                const eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
                eventModal.show();
            }

            // agenda ---------------

            const agnEvents = events;

            const agnEventsContainer = document.getElementById("agnEventsContainer");
            const agnDatePicker = document.getElementById("agnDatePicker");
            const agnPrevBtn = document.getElementById("agnPrevBtn");
            const agnNextBtn = document.getElementById("agnNextBtn");

            // Fecha actual seleccionada
            let agnCurrentDate = new Date();

            // Formatear fecha en "d / m / Y" (sin modificar el objeto Date)
            function agnFormatDateDMY(dateStr) {
                const [year, month, day] = dateStr.split("-");
                return `${day} / ${month} / ${year}`;
            }

            // Mostrar eventos para la fecha seleccionada
            function agnDisplayEvents() {
                const selectedDate = agnCurrentDate.toISOString().split("T")[0];
                agnDatePicker.value = selectedDate; // Actualizar input date

                agnEventsContainer.innerHTML = ""; // Limpiar contenedor

                const filteredEvents = agnEvents.filter((event) => {
                    return (
                        selectedDate >= event.startDate && selectedDate <= event.endDate
                    );
                });

                const formattedDate = agnFormatDateDMY(selectedDate); // Fecha formateada
                agnEventsContainer.insertAdjacentHTML(
                    "beforeend",
                    `<h4 class="mb-3">${formattedDate}</h4>`
                );

                if (filteredEvents.length > 0) {
                    filteredEvents.forEach((event) => {
                        const eventCard = `
            <div class="agn-event-card">
              <img src="${event.image}" alt="${
              event.name
            }" class="agn-event-image" />
              <div>
                <h5 class="mb-0">${event.name}</h5>
                <small><strong class="me-3"> Del </strong> ${agnFormatDateDMY(
                  event.startDate
                )} <strong class="mx-3"> al </strong> ${agnFormatDateDMY(event.endDate)}</small>
              </div>
            </div>
          `;
                        agnEventsContainer.insertAdjacentHTML("beforeend", eventCard);
                    });
                } else {
                    agnEventsContainer.insertAdjacentHTML(
                        "beforeend",
                        `<p class="agn-no-events">No hay eventos para este día.</p>`
                    );
                }
            }

            // Navegar días
            function agnChangeDay(offset) {
                agnCurrentDate.setDate(agnCurrentDate.getDate() + offset);
                agnDisplayEvents();
            }

            // Eventos de botones
            agnPrevBtn.addEventListener("click", () => agnChangeDay(-1));
            agnNextBtn.addEventListener("click", () => agnChangeDay(1));

            // Evento input date
            agnDatePicker.addEventListener("change", (e) => {
                agnCurrentDate = new Date(e.target.value);
                agnDisplayEvents();
            });

            // Inicializar agenda
            agnDisplayEvents();
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

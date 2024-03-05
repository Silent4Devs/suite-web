<style type="text/css">
    #calendar-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    #calendar {
        /* max-width: 1100px; */
        margin: -2px auto;
    }

    .popover-title {
        font-weight: bold;
        background-color: #007bff;
        color: #fff;
    }

    .popover-content {
        color: #333;
    }

    .popover {
        max-width: 250px;
        width: auto;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .cardCalendario {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
        gap: 1rem;
        color: rgb(152, 162, 179);
        font-size: 14px;
        background: rgb(252, 252, 253);
        box-shadow: rgb(16 24 40 / 30%) 0px 0.5px 2px;
        border-radius: 8px;
        /* max-width: 350px; */
        margin: auto;
    }
</style>
{{-- <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-toggle="tab" data-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-toggle="tab" data-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="contact-tab" data-toggle="tab" data-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Contact</button>
    </li>
  </ul> --}}
<div class="cardCalendario" style="box-shadow: none; !important">
    <div class="card-body" style="height: 658px;">
        <div id='calendar'></div>
    </div>
</div>

@section('scripts')
    @parent
    <script src="{{ asset('../js/calendario-fullcalendar/index.global.js') }}"></script>
    <script src="{{ asset('../js/calendario-fullcalendar/locales/locales-all.global.js') }}"></script>

    <script>
        var calendar;
        $(document).ready(function() {
            //initCalendar();
        });

        function initCalendar() {
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('admin.planes-de-accion.loadProject', $planImplementacion) }}",
                success: function(response) {
                    renderCalendar(response);
                }
            });
        }
        let eventsCalendar = [];

        function renderCalendar(response) {
            const mapStatusToColor = {
                "STATUS_ACTIVE": "#ecde00",
                "STATUS_DONE": "#17d300",
                "STATUS_FAILED": "#e10000",
                "STATUS_SUSPENDED": "#e7e7e7",
                "STATUS_UNDEFINED": "#00b1e1"
            };

            const mapStatusToEstatus = {
                "STATUS_ACTIVE": "En progreso",
                "STATUS_DONE": "Completado",
                "STATUS_FAILED": "Con retraso",
                "STATUS_SUSPENDED": "Suspendida",
                "STATUS_UNDEFINED": "Sin iniciar"
            };

            response.tasks.forEach(item => {
                // Destructuramos el objeto para obtener los valores específicos
                const {
                    id,
                    name,
                    progress,
                    status,
                    start,
                    duration,
                    end,
                    color
                } = item;

                const jsonEvents = {
                    id: id,
                    title: name,
                    color: mapStatusToColor[status] || "#00b1e1",
                    start: start,
                    end: end,
                    extendedProps: {
                        status: mapStatusToEstatus[status]
                    }
                };

                eventsCalendar.push(jsonEvents);
            });

            var calendarEl = document.getElementById('calendar');
            calendar = new FullCalendar.Calendar(calendarEl, {
                expandRows: true,
                locale: 'es',
                slotMinTime: '09:00',
                slotMaxTime: '19:00',
                height: '100%',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                initialView: 'dayGridMonth',
                initialDate: obtenerFechaActual(),
                navLinks: false, // can click day/week names to navigate views
                editable: false,
                selectable: false,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
                eventDidMount: function(info) {
                    $(info.el).popover({
                        title: info.event.title,
                        placement: 'top',
                        trigger: 'hover',
                        content: '<div style="font-family: Arial, sans-serif; font-size: 14px; padding: 5px;">' +
                            '<p><strong>Estado:</strong> ' + info.event.extendedProps.status + '</p>' +
                            '<p><strong>Fecha inicial:</strong> ' + convertirFecha(info.event.start) +
                            '</p>' +
                            '<p><strong>Fecha final:</strong> ' + convertirFecha(info.event.end) +
                            '</p>' +
                            '</div>',
                        container: 'body',
                        html: true
                    });
                },
                events: eventsCalendar,
                eventClick: function(info) {
                    alert('Event: ' + info.event.title);
                    alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                    alert('View: ' + info.view.type);

                    // change the border color just for fun
                    info.el.style.borderColor = 'red';
                },
                dateClick: function(arg) {
                    console.log(arg.date.toUTCString()); // use *UTC* methods on the native Date Object
                    // will output something like 'Sat, 01 Sep 2018 00:00:00 GMT'
                }
            });

        }

        function renderCaleendar() {
            const tiempoEspera = 300;
            setTimeout(() => {

                calendar.render();
                calendar.setOption('locale', 'es');
                console.log('ejecutado');
            }, tiempoEspera);
        }

        function convertirFecha(cadenaFecha) {
            // Crear un objeto de fecha a partir de la cadena
            var fecha = new Date(cadenaFecha);

            // Obtener los componentes de la fecha
            var dia = fecha.getDate();
            var mes = fecha.getMonth() + 1; // Los meses van de 0 a 11, por lo que sumamos 1
            var año = fecha.getFullYear();

            // Asegurarnos de que los valores tengan dos dígitos (por ejemplo, '05' en lugar de '5')
            dia = (dia < 10) ? '0' + dia : dia;
            mes = (mes < 10) ? '0' + mes : mes;

            // Formatear la fecha como 'dd/mm/aaaa'
            var fechaFormateada = dia + '/' + mes + '/' + año;

            // Retornar la fecha formateada
            return fechaFormateada;
        }

        function obtenerFechaActual() {
            // Obtener la fecha actual
            const fechaActual = new Date();

            // Formatear la fecha en el formato deseado (por ejemplo, YYYY-MM-DD)
            const dia = String(fechaActual.getDate()).padStart(2, '0');
            const mes = String(fechaActual.getMonth() + 1).padStart(2,
                '0'); // El mes es devuelto de 0 a 11, por eso se suma 1
            const anio = fechaActual.getFullYear();

            // Retornar la fecha formateada
            return `${anio}-${mes}-${dia}`;
        }
    </script>
@endsection

<style type="text/css">
    #calendar-container {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
    }

    #calendar {
        max-width: 1100px;
        margin: -2px auto;
    }
</style>

<div class="card" style="box-shadow: none; !important">
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
                    end: end
                };

                eventsCalendar.push(jsonEvents);
            });
            // Obtener la fecha actual
            const fechaActual = new Date();
            // Obtener los componentes de la fecha (año, mes, día)
            const year = fechaActual.getFullYear();
            const month = String(fechaActual.getMonth() + 1).padStart(2,
                '0'); // Se suma 1 al mes ya que los meses se cuentan desde 0 (enero es 0)
            const day = String(fechaActual.getDate()).padStart(2, '0');
            // Formatear la fecha en el formato 'YYYY-MM-DD'
            const fechaFormateada = `${year}-${month}-${day}`;


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
                initialDate: fechaFormateada,
                navLinks: false, // can click day/week names to navigate views
                editable: false,
                selectable: false,
                nowIndicator: true,
                dayMaxEvents: true, // allow "more" link when too many events
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
    </script>
@endsection

function renderCalendar() {

    events.forEach(item => {
        const {
            id,
            nombre,
            fecha,
            categoria,
            descripcion
        } = item;

        const jsonEvents = {
            id: id,
            title: nombre,
            start: TbConvertStringToTimeStamp(fechaInicio(fecha), 'MM/DD/YYYY'),
            end: TbConvertStringToTimeStamp(fechaFin(fecha), 'MM/DD/YYYY'),
            color: "#AFD6E5"
        };
        eventsCalendar.push(jsonEvents);
    });

    recursos.forEach(item => {
        const {
            id,
            cursoscapacitaciones,
            fecha_curso,
            fecha_fin
        } = item;

        const jsonRecursos = {
            id: id,
            title: cursoscapacitaciones,
            start: TbConvertStringToTimeStamp(fecha_curso, 'DD-MM-YYYY hh:mm:ss'),
            end: TbConvertStringToTimeStamp(fecha_fin, 'DD-MM-YYYY hh:mm:ss'),
            color: "#D6E5A1"
        };
        eventsCalendar.push(jsonRecursos);
    });

    contratos.forEach((item, index) => {
        const {
            nombre_servicio,
            fecha_inicio,
            fecha_fin
        } = item;
        let id = index;
        const jsonContratos = {
            id: id,
            title: nombre_servicio,
            start: fecha_inicio ? TbConvertStringToTimeStamp(fecha_inicio, 'YYYY-MM-DD') : null,
            end: fecha_fin ? TbConvertStringToTimeStamp(fecha_fin, 'YYYY-MM-DD') : null,
            color: "#C0AEE5"
        };
        eventsCalendar.push(jsonContratos);
    });

    facturas.forEach(item => {
        const {
            calendarId,
            title,
            start,
            end
        } = item;

        const jsonFacturas = {
            id: calendarId,
            title: title,
            start: TbConvertStringToTimeStamp(start, 'YYYY-MM-DD'),
            end: TbConvertStringToTimeStamp(end, 'YYYY-MM-DD'),
            color: "#E6A8C1"
        };
        eventsCalendar.push(jsonFacturas);
    });

    cumple.forEach(item => {
        const {
            calendarId,
            title,
            start,
            end
        } = item;

        const jsonCumples = {
            id: calendarId,
            title: title,
            start: TbConvertStringToTimeStamp(start, 'YYYY-MM-DD'),
            end: TbConvertStringToTimeStamp(end, 'YYYY-MM-DD'),
            color: "#E5C5A4"
        };
        eventsCalendar.push(jsonCumples);
    });

    aniversario.forEach(item => {
        const {
            calendarId,
            title,
            start,
            end
        } = item;

        const jsonAniversario = {
            id: calendarId,
            title: title,
            start: TbConvertStringToTimeStamp(start, 'YYYY-MM-DD'),
            end: TbConvertStringToTimeStamp(end, 'YYYY-MM-DD'),
            color: "#A9E6CF"
        };
        eventsCalendar.push(jsonAniversario);
    });

    revisiones.forEach(item => {
        const {
            calendarId,
            title,
            start,
            end
        } = item;

        const jsonRevisiones = {
            id: calendarId,
            title: title,
            start: TbConvertStringToTimeStamp(start, 'YYYY-MM-DD'),
            end: TbConvertStringToTimeStamp(end, 'YYYY-MM-DD'),
            color: "FFF4AF"
        };
        eventsCalendar.push(jsonRevisiones);
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
        initialDate: '2024-05-15',
        navLinks: false,
        editable: false,
        selectable: false,
        nowIndicator: true,
        dayMaxEvents: true,
        eventDidMount: function(info) {
            // $(info.el).popover({
            //     title: info.event.title,
            //     placement: 'top',
            //     trigger: 'hover',
            //     content: '<div style="font-family: Arial, sans-serif; font-size: 14px; padding: 5px;">' +
            //         '<p><strong>Estado:</strong> ' + info.event.extendedProps.title + '</p>' +
            //         '</p>' +
            //         '</div>',
            //     container: 'body',
            //     html: true
            // });
        },
        events: eventsCalendar,
        eventClick: function(info) {
            // alert('Event: ' + info.event.title);
            // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
            // alert('View: ' + info.view.type);

            // // change the border color just for fun
            // info.el.style.borderColor = 'red';
        },
        dateClick: function(arg) {
            console.log(arg.date.toUTCString()); // use *UTC* methods on the native Date Object
            // will output something like 'Sat, 01 Sep 2018 00:00:00 GMT'
        }
    });
}

function fechaInicio(fechaRango) {
    const fechas = fechaRango.split(" - ");
    return fechas[0];
}

function fechaFin(fechaRango) {
    const fechas = fechaRango.split(" - ");
    return fechas[1];
}

document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        renderCalendar();
        calendar.render();
        calendar.setOption('locale', 'es');
    }, 100);
});

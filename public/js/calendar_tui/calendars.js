'use strict';

/* eslint-disable require-jsdoc, no-unused-vars */

var CalendarList = [];

function CalendarInfo() {
    this.id = null;
    this.name = null;
    this.checked = true;
    this.color = null;
    this.bgColor = null;
    this.borderColor = null;
    this.dragBgColor = null;
}

function addCalendar(calendar) {
    CalendarList.push(calendar);
}

function findCalendar(id) {
    var found;

    CalendarList.forEach(function(calendar) {
        if (calendar.id === id) {
            found = calendar;
        }
    });

    return found || CalendarList[0];
}

function hexToRGBA(hex) {
    var radix = 16;
    var r = parseInt(hex.slice(1, 3), radix),
        g = parseInt(hex.slice(3, 5), radix),
        b = parseInt(hex.slice(5, 7), radix),
        a = parseInt(hex.slice(7, 9), radix) / 255 || 1;
    var rgba = 'rgba(' + r + ', ' + g + ', ' + b + ', ' + a + ')';

    return rgba;
}

(function() {
    var calendar;
    var id = 0;

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Mis&nbsp;Actividades';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#A0CDFF';
    calendar.dragBgColor = '#A0CDFF';
    calendar.borderColor = '#A0CDFF';
    addCalendar(calendar);


    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Mis&nbsp;Capacitaciones';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#B1F094';
    calendar.dragBgColor = '#B1F094';
    calendar.borderColor = '#B1F094';
    addCalendar(calendar);

    // calendar = new CalendarInfo();
    // id += 1;
    // calendar.id = String(id);
    // calendar.name = 'Mis&nbsp;Auditorias';
    // calendar.color = '#2E2E2E';
    // calendar.bgColor = '#FCB3C2';
    // calendar.dragBgColor = '#FCB3C2';
    // calendar.borderColor = '#FCB3C2';
    // addCalendar(calendar);


    calendar = new CalendarInfo();
    id += 2;
    calendar.id = String(id);
    calendar.name = 'Eventos';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#FFD698';
    calendar.dragBgColor = '#FFD698';
    calendar.borderColor = '#FFD698';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Cumpleaños';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#BBB9FF';
    calendar.dragBgColor = '#BBB9FF';
    calendar.borderColor = '#BBB9FF';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Aniversarios';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#FFF690';
    calendar.dragBgColor = '#FFF690';
    calendar.borderColor = '#FFF690';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Festivos';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#CFD8DF';
    calendar.dragBgColor = '#CFD8DF';
    calendar.borderColor = '#CFD8DF';
    addCalendar(calendar);


    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Contratos';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#CFD8DF';
    calendar.dragBgColor = '#CFD8DF';
    calendar.borderColor = '#CFD8DF';
    addCalendar(calendar);


    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Fecha de recepción de factura';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#CFD8DF';
    calendar.dragBgColor = '#CFD8DF';
    calendar.borderColor = '#CFD8DF';
    addCalendar(calendar);



    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Fecha de liberación de factura';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#CFD8DF';
    calendar.dragBgColor = '#CFD8DF';
    calendar.borderColor = '#CFD8DF';
    addCalendar(calendar);


    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = 'Revisión de entregables';
    calendar.color = '#2E2E2E';
    calendar.bgColor = '#CFD8DF';
    calendar.dragBgColor = '#CFD8DF';
    calendar.borderColor = '#CFD8DF';
    addCalendar(calendar);







})();

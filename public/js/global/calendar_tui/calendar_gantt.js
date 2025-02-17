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
    calendar.name = '<i class="fas fa-window-restore i_calendar" style="color:#0400f7;"></i> Fases';
    calendar.color = '#ffffff';
    calendar.bgColor = '#0400f7';
    calendar.dragBgColor = '#0400f7';
    calendar.borderColor = '#0400f7';
    addCalendar(calendar);

    calendar = new CalendarInfo();
    id += 1;
    calendar.id = String(id);
    calendar.name = '<i class="fas fa-thumbtack i_calendar i_calendar" style="color:var(--color-tbj)"></i> Actividades';
    calendar.color = '#ffffff';
    calendar.bgColor = '#345183';
    calendar.dragBgColor = '#345183';
    calendar.borderColor = '#345183';
    addCalendar(calendar);

})();

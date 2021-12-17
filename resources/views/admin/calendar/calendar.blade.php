@extends('layouts.admin')
@section('content')





    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css">
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/tui-calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/default.css') }}">



<style type="text/css">
    .caja{
        width: 50% !important;
        padding: 0;
        overflow: hidden !important;
    }
    #lnb{
        background: rgba(0,0,0,0) !important;
        border: none !important;
    }
    #lnb div{
        border: none !important;
    }
    #calendarList{
        border: none !important;
    }
    #calendar{
        width: 100%;
        overflow: hidden;
        overflow-y: scroll;
        border: none !important;
    }
    #calendarList span{
        margin-left: 0px;
        font-size: 8pt;
        float: left;
        width: 100px;
    }
     #calendarList span:nth-child(even){
        width: 20px;
     }
    span strong{
        font-size: 15pt !important;
    }
    span:not(.lever)::before{
        left: -30px !important;
        top: -5px !important;
        transform: scale(0.7);
        display: none;
    }
    .tui-full-calendar-month-dayname{
        border: none !important;
    }
    .tui-full-calendar-popup-section div{
        border: none !important;
        margin-top: 20px !important;
    }
    .tui-full-calendar-popup-section input{
        border-bottom: 1px solid #eee !important;
    }


    .btn.btn-default.btn-sm.move-day{
        width: 30px;
        height: 30px;
        position: relative;
    }
    .calendar-icon.ic-arrow-line-right::before{
        content: ">";
        position: absolute;
        transform: scale(1.3);
        font-size: 10pt;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .calendar-icon.ic-arrow-line-left::before{
        content: "<";
        position: absolute;
        transform: scale(1.3);
        font-size: 10pt;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    a:hover{
        text-decoration: none !important;
    }

    .tui-full-calendar-popup .tui-full-calendar-popup-container{
        display: none;
    }

    .tui-full-calendar-popup.tui-full-calendar-popup-detail .tui-full-calendar-popup-container{
        display: block;
    }


    .tui-full-calendar-weekday-schedule-title{
        position: relative;
   }
    .tui-full-calendar-weekday-schedule-title strong{
        font-size: 9pt !important;
        position: absolute;
        right: 10px;
   }
    .tui-full-calendar-weekday-schedule-title strong:before{
        content: "Inicio:  ";
   }
   .dropdown-menu.show{
        width: 250px !important;
   }

   .i_calendar{
        font-size: 11pt;
        width: 20px;
        text-align: center;
   }
   .i_calendar_cuadro{
        margin: 0px 8px;
   }
</style>



<div class="card" style="margin-top:50px;">
  <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
      <h3 class="mb-2  text-center text-white"><strong>Calendario</strong></h3>
  </div>

    <div class="card-body" style="height: 600px;">




       {{--  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css' /> --}}

        {{-- <div id='calendar'></div> --}}







        <div class="caja">
            <div id="lnb">

                <div id="lnb-calendars" class="lnb-calendars">
                    <div>
                        <div class="lnb-calendars-item">
                            <label>
                                <input class="tui-full-calendar-checkbox-square" type="checkbox" value="all" checked>
                                <span style="">
                                    <span style="margin-left: 20px; width: 100px !important; position: absolute;">Ver Todos</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div id="calendarList" class="lnb-calendars-d1">
                    </div>
                </div>

            </div>
            <div id="right">
                <div id="menu">
                    <span class="dropdown">
                        <button id="dropdownMenu-calendarType" class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                            <i id="calendarTypeIcon" class="calendar-icon ic_view_month" style="margin-right: 4px;"></i>
                            <span id="calendarTypeName"></span>&nbsp;
                            <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu-calendarType">
                            <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-daily">
                                    <i class="calendar-icon ic_view_day"></i>Diario
                                </a>
                            </li>
                            <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                                    <i class="calendar-icon ic_view_week"></i>Semanal
                                </a>
                            </li>
                            <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                                    <i class="calendar-icon ic_view_month"></i>Mensual
                                </a>
                            </li>
                            <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks2">
                                    <i class="calendar-icon ic_view_week"></i>2 Semanas
                                </a>
                            </li>
                            <li role="presentation">
                                <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weeks3">
                                    <i class="calendar-icon ic_view_week"></i>3 Semanas
                                </a>
                            </li>
                            <li role="presentation" class="dropdown-divider"></li>
                            <li role="presentation">
                                <a role="menuitem" data-action="toggle-workweek">
                                    <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                                    <span class="checkbox-title"></span>Fines de semana
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" data-action="toggle-start-day-1">
                                    <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                                    <span class="checkbox-title"></span>Inicio de semana en lunes
                                </a>
                            </li>
                            <li role="presentation">
                                <a role="menuitem" data-action="toggle-narrow-weekend">
                                    <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                                    <span class="checkbox-title"></span>Reducir dias no laborales
                                </a>
                            </li>
                        </ul>
                    </span>
                    <span id="menu-navi">
                        <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Hoy</button>
                        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                            <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                            <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                        </button>
                    </span>
                    <span id="renderRange" class="render-range"></span>
                </div>
                <div id="calendar"></div>
            </div>
        </div>




    </div>
</div>



@endsection

@section('scripts')
@parent





    <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
    <script src="https://uicdn.toast.com/tui.time-picker/v2.0.3/tui-time-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui.date-picker/v4.0.3/tui-date-picker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chance/1.0.13/chance.min.js"></script>
    <script src="{{ asset('../js/calendar_tui/tui-calendar.js') }}"></script>
    <script src="{{ asset('../js/calendar_tui/calendar_agenda.js') }}"></script>
    <script src="{{ asset('../js/calendar_tui/schedules.js') }}"></script>
    <script>
        ScheduleList = [
            @foreach($plan_base as $it_plan_base)
                {
                    id: 'planinicio{{$it_plan_base->id}}',
                    calendarId: '1',
                    title: '<i class="fas fa-thumbtack i_calendar_cuadro"></i> Actividad: {{$it_plan_base->actividad}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{  \Carbon\Carbon::createFromFormat("d-m-Y", $it_plan_base->fecha_inicio)->format("Y-m-d") }}',
                    end: '{{  \Carbon\Carbon::createFromFormat("d-m-Y", $it_plan_base->fecha_fin)->format("Y-m-d") }}',
                    isReadOnly : true,
                },
            @endforeach

            @foreach($auditoria_internas as $it_auditoria_internas)
                {
                    id: 'auditoria{{$it_auditoria_internas->id}}',
                    calendarId: '3',
                    title: '<i class="fas fa-clipboard-list i_calendar_cuadro"></i> Alcance: {{$it_auditoria_internas->alcance}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{  \Carbon\Carbon::parse($it_auditoria_internas->fecha_inicio)->toDateTimeString() }}',
                    end: '{{  \Carbon\Carbon::parse($it_auditoria_internas->fecha_fin)->toDateTimeString() }}',
                    isReadOnly : true, 

                },
            @endforeach


            @foreach($recursos as $it_recursos)
                {

                    id: 'recursos{{$it_recursos->id}}',
                    calendarId: '2',
                    title: '<i class="fas fa-graduation-cap i_calendar_cuadro"></i> Tipo: {{$it_recursos->cursoscapacitaciones}}',
                    category: 'time',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse($it_recursos->fecha_curso)->toDateTimeString() }}',
                    end: '{{ \Carbon\Carbon::parse($it_recursos->fecha_fin)->toDateTimeString() }}',
                    isReadOnly : true,
                },

            @endforeach

            @foreach ($actividades as $it_plan_base)
                {
                id: 'planinicio{{ $it_plan_base->id }}',
                calendarId: '1',
                title: '<i class="fas fa-thumbtack i_calendar_cuadro"></i> Actividad: {{ $it_plan_base->name }}',
                category: 'allday',
                dueDateClass: '',
                start: '{{ \Carbon\Carbon::createFromTimestamp(($it_plan_base->start/1000))->toDateString()}}',

                end: '{{ \Carbon\Carbon::createFromTimestamp(($it_plan_base->end/1000))->toDateString()}}',
                isReadOnly : true,
                },
            @endforeach
            @foreach ($eventos as $evento)

                {
                id: 'evento{{ $evento->id }}',
                calendarId: '4',
                title: 'Evento: {{ $evento->nombre }}',
                category: 'allday',
                dueDateClass: '',
                start: '{{  \Carbon\Carbon::parse(explode("-",$evento->fecha)[0])->format("Y-m-d") }}',
                end: '{{  \Carbon\Carbon::parse(explode("-",$evento->fecha)[1])->format("Y-m-d") }}',
                isReadOnly : true,
                },
            @endforeach
        ];
    </script>

    </script>
    <script src="{{ asset('../js/calendar_tui/app.js') }}"></script>




{{-- <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js'></script>
<script>
    $(document).ready(function () {
            // page is now ready, initialize the calendar...
            events={!! json_encode($events) !!};
            $('#calendar').fullCalendar({
                // put your options and callbacks here
                locale: 'es',
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
                dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
                events: events,
                buttonText: {
                next: '>',
                nextYear: '>>',
                prev: '<',
                prevYear: '<<',
                today:    'Hoy',
                //today: moment().locale('es', {months : "Ene_Feb_Mar_Abr_May_Jun_Jul_Ago_Sep_Oct_Nov_Dic".split("_")}).format("MMMM YYYY"),
                },

            })
        });
</script> --}}
@stop

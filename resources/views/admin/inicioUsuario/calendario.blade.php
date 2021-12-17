@inject('Empleado', 'App\Models\Empleado')

<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css">
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">

<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/tui-calendar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/default.css') }}">

<style type="text/css">
    .caja{
        width: 100%;
        height:600px;
        padding: 0; 
        position: relative;
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


    .tui-full-calendar-weekday-grid-more-schedules{
        position: relative !important;
   }
   .tui-full-calendar-weekday-grid-more-schedules:after{
        content: "más";
        position: absolute;
        background-color: #fff;
        z-index: 1;
        padding: 0 5px  !important;
        left: 15px;
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


@section('scripts')
    @parent
    <script src="https://uicdn.toast.com/tui.code-snippet/v1.5.2/tui-code-snippet.min.js"></script>
    <script src="https://uicdn.toast.com/tui.time-picker/v2.0.3/tui-time-picker.min.js"></script>
    <script src="https://uicdn.toast.com/tui.date-picker/v4.0.3/tui-date-picker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.20.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chance/1.0.13/chance.min.js"></script>
    <script src="{{ asset('../js/calendar_tui/tui-calendar.js') }}"></script>
    <script src="{{ asset('../js/calendar_tui/calendars.js') }}"></script>
    <script src="{{ asset('../js/calendar_tui/schedules.js') }}"></script>



    <script type="text/javascript">

        

         ScheduleList = [
            

           


            @foreach($recursos as $it_recursos)

                {

                    id: 'recursos{{$it_recursos->id}}',
                    calendarId: '2',
                    title: '<i class="fas fa-graduation-cap i_calendar_cuadro"></i> Curso: {{$it_recursos->cursoscapacitaciones}}',
                    category: 'time',
                    dueDateClass: '',
                    start: '{{  \Carbon\Carbon::parse($it_recursos->fecha_curso)->toDateTimeString() }}',
                    end: '{{  \Carbon\Carbon::parse($it_recursos->fecha_fin)->toDateTimeString() }}',
                    body: `
                        <font style="font-weight: bold;">Categoria:</font> ${@json($it_recursos->tipo)}<br>
                        <font style="font-weight: bold;">Inicio:</font> ${@json($it_recursos->fecha_curso)} horas<br>
                        <font style="font-weight: bold;">Fin:</font> ${@json($it_recursos->fecha_fin)} horas<br>
                        <font style="font-weight: bold;">Duración:</font> ${@json($it_recursos->duracion)} horas<br>
                        <font style="font-weight: bold;">Instructor:</font> ${@json($it_recursos->instructor)}<br>
                        <font style="font-weight: bold;">${@json($it_recursos->modalidad)=='presencial' ? 'Ubicación' : 'Link'}:</font> ${@json($it_recursos->ubicacion)}<br>
                    `,
                    isReadOnly : true,
                },

            @endforeach

             @foreach($auditoria_internas as $it_auditoria_internas)
                {
                    id: 'auditoria{{$it_auditoria_internas->id}}',
                    calendarId: '3',
                    title: '<i class="fas fa-clipboard-list i_calendar_cuadro"></i> Alcance: {{$it_auditoria_internas->alcance}}',
                    category: 'time',
                    dueDateClass: '',
                    start: '{{  \Carbon\Carbon::parse($it_auditoria_internas->fecha_inicio)->toDateTimeString() }}',
                    end: '{{  \Carbon\Carbon::parse($it_auditoria_internas->fecha_fin)->toDateTimeString() }}',
                    isReadOnly : true, 
                },
            @endforeach

            @foreach($actividades as $task)
                 {
                    id: 'recurasdsos{{$task->id}}',
                    calendarId: '1',
                    title: '<i class="fas fa-thumbtack i_calendar_cuadro"></i> Actividad: {{$task->name}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::createFromTimestamp($task->start / 1000)->toDateTimeString()
                     }}',
                    end: '{{ \Carbon\Carbon::createFromTimestamp($task->end / 1000)->toDateTimeString()
                     }}',
                    isReadOnly : true,
                    body:  ` Origen: {{$task->parent}} <br/>

                        Asigandos: 
                        @foreach ($task->assigs as $assig)
                            @php
                                $empleado = $Empleado->where('id', intval($assig->resourceId))->first();
                            @endphp
                            @if ($empleado)
                                <img src="{{ asset('storage/empleados/imagenes/' . $empleado->avatar) }}"
                                    style="height: 37px; clip-path: circle(18px at 50% 50%);"
                                    class="rounded-circle {{ $empleado->id == auth()->user()->empleado->id ? 'd-none' : '' }}"
                                    alt="{{ $empleado->name }}" title="{{ $empleado->name }}">
                                {{ $empleado->id == auth()->user()->empleado->id ? '' : '' }}
                            @endif
                        @endforeach

                    `,
                },
            @endforeach
        ]


        
    </script>

    <script src="{{ asset('../js/calendar_tui/app.js') }}"></script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function(){
            document.getElementById('dropdownMenu-calendarType').addEventListener('change', function(e){
                
            });
        });
    </script>
@endsection
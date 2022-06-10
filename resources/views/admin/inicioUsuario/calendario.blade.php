@inject('Empleado', 'App\Models\Empleado')

<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.time-picker/latest/tui-time-picker.css">
<link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">

<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/tui-calendar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/default.css') }}">

<style type="text/css">
    .caja{
        width: 100%;
        height:740px;
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
        /*overflow-y: auto;*/
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
   .dropdown-menu.show{
        width: 250px ;
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


<div class="card card-body" style="margin-top:50px;">
    @can('mi_perfil_mi_calendario_acceder')
    <div class="caja" style="margin-top:-60px;">
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
    @endcan
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
            @foreach ($eventos as $evento)
                {
                id: 'evento{{ $evento->id }}',
                calendarId: '4',
                title: '<i class="fas fa-cocktail i_calendar_cuadro"></i> Evento: {{ $evento->nombre }}',
                category: 'allday',
                dueDateClass: '',
                start: '{{  \Carbon\Carbon::parse(explode("-",$evento->fecha)[0])->format("Y-m-d") }}',
                end: '{{  \Carbon\Carbon::parse(explode("-",$evento->fecha)[1])->format("Y-m-d") }}',
                isReadOnly : true,
                body: `
                        <font style="font-weight: bold;">Categoria:</font> ${@json($evento->tipo)}<br>
                        <font style="font-weight: bold;">Inicio:</font> ${@json($evento->fecha_curso)} horas<br>
                        <font style="font-weight: bold;">Fin:</font> ${@json($evento->fecha_fin)} horas<br>
                        <font style="font-weight: bold;">Duración:</font> ${@json($evento->duracion)} horas<br>
                        <font style="font-weight: bold;">Instructor:</font> ${@json($evento->instructor)}<br>
                        <font style="font-weight: bold;">${@json($evento->modalidad)=='presencial' ? 'Ubicación' : 'Link'}: </font>${@json($evento->modalidad)=='presencial' ? @json($evento->ubicacion) : '<a href="'+@json($evento->ubicacion)+'">'+@json($evento->ubicacion)+'</a> '} <br>
                    `,
                },
            @endforeach

            @foreach($cumples_aniversarios as $cumple)
                {
                    id: 'cumple{{$cumple->id}}',
                    calendarId: '5',
                    title: '<i class="fas fa-birthday-cake i_calendar_cuadro"></i> Cumpleaños de {{$cumple->name}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ $cumple->actual_birdthday }}',
                    end: '{{ $cumple->actual_birdthday }}',
                    isReadOnly : true,
                    body: `
                        <font style="font-weight: bold;">Cumpleaños:</font> ${@json(\Carbon\Carbon::parse($cumple->cumpleaños)->format('d-m'))}<br>
                        <font style="font-weight: bold;">Area:</font> ${@json($cumple->area ?$cumple->area->area:null)}<br>
                        <font style="font-weight: bold;">Puesto:</font> ${@json($cumple->puesto)}<br>

                    `,
                },
            @endforeach


            @foreach($cumples_aniversarios as $aniversario)
                {
                    id: 'aniversario{{$aniversario->id}}',
                    calendarId: '6',
                    title: '<i class="fas fa-award i_calendar_cuadro"></i> Aniversario de {{$aniversario->name}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ $aniversario->actual_aniversary }}',
                    end: '{{ $aniversario->actual_aniversary }}',
                    isReadOnly : true,
                    body: `
                        <font style="font-weight: bold;">Aniversario:</font> ${@json(\Carbon\Carbon::parse($aniversario->antiguedad)->format('d-m'))}<br>
                        <font style="font-weight: bold;">Area:</font> ${@json($aniversario->area?$aniversario->area->area:null)}<br>
                        <font style="font-weight: bold;">Puesto:</font> ${@json($aniversario->puesto)}<br>

                    `,
                },
            @endforeach

             @foreach ($oficiales as $oficial)
                {
                id: 'oficial{{ $oficial->id }}',
                calendarId: '7',
                title: '<i class="fas fa-drum i_calendar_cuadro"></i>Festivo: {{ $oficial->nombre }}',
                category: 'allday',
                dueDateClass: '',
                start: '{{  \Carbon\Carbon::parse(explode("-",$oficial->fecha)[0])->format("Y-m-d") }}',
                end: '{{  \Carbon\Carbon::parse(explode("-",$oficial->fecha)[1])->format("Y-m-d") }}',
                isReadOnly : true,
                },
            @endforeach

            {{-- @foreach($auditoria_internas as $it_auditoria_internas) --}}
                //{
                //    id: 'auditoria{{-- $it_auditoria_internas->id --}}',
                //    calendarId: '3',
                //    title: '<i class="fas fa-clipboard-list i_calendar_cuadro"></i> Alcance: {{-- $it_auditoria_internas->alcance --}}',
                //    category: 'time',
                //    dueDateClass: '',
                //    start: '{{--  \Carbon\Carbon::parse($it_auditoria_internas->fecha_inicio)->toDateTimeString() --}}',
                //    end: '{{--  \Carbon\Carbon::parse($it_auditoria_internas->fecha_fin)->toDateTimeString() --}}',
                //    isReadOnly : true,
                //    body: `
                //       <font style="font-weight: bold;">Inicio:</font> ${  {{-- @json($it_auditoria_internas->fecha_inicio->format("d-m-Y")) --}}  }<br>
                //       <font style="font-weight: bold;">Fin:</font> ${  {{--@json($it_auditoria_internas->fecha_fin->format("d-m-Y"))--}}  }<br>
                //    `,
                //},
            {{-- @endforeach --}}

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
            $(".tui-full-calendar-weekday-schedule-title").attr("title", "");
        });
    </script>
@endsection

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
                            <i class="calendar-icon ic_view_day"></i>Atrasados
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-weekly">
                            <i class="calendar-icon ic_view_week"></i>Semanales
                        </a>
                    </li>
                    <li role="presentation">
                        <a class="dropdown-menu-title" role="menuitem" data-action="toggle-monthly">
                            <i class="calendar-icon ic_view_month"></i>Mensuales
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

        // let recursos = @json($recursos);
        // let recursos_array = recursos.map(recurso=>{
        //     return { 
        //         id: `recursos${recurso.id}`,
        //         calendarId: '3',
        //         title: `${recurso.cursoscapacitaciones}`,
        //         category: 'allday',
        //         dueDateClass: '',
        //         start: `${recurso.fecha_curso}`,
        //         end: `${recurso.fecha_fin}`,
        //         isReadOnly : true,
        //     }
        // });

        // let actividades = @json($actividades);
        // actividades.forEach(task => {
        //     console.log(task);
        // });
        // let actividades_array = actividades.map(task=>{
        //    let foto = 'man.png';
        //          let images = "";
        //          let assigs = task.assigs.map(asignado => {
        //              return response.resources.find(r => Number(r.id) === Number(asignado.resourceId));
        //          });
        //          let filteredAssigs = assigs.filter(function(a) {
        //              return a != null;
        //          });
        //          let bgColor = "#00b1e1";
        //          let estatus = "Sin iniciar";
        //          if (filteredAssigs.length > 0) {
        //              filteredAssigs.forEach(assig => {
        //                  if (assig.foto == null) {
        //                      if (assig.genero == 'M') {
        //                          foto = 'woman.png';
        //                      } else {
        //                          foto = 'usuario_no_cargado.png';
        //                      }
        //                  } else {
        //                      foto = assig.foto;
        //                  }

        //                  images +=
        //                      `<img class="rounded-circle" src="{{ asset('storage/empleados/imagenes') }}/${foto}" title="${assig.name}"/>`;
        //              });
        //          }
        //          switch (task.status) {
        //              case "STATUS_ACTIVE":
        //                  bgColor = "#ecde00";
        //                  estatus = "En progreso"
        //                  break;
        //              case "STATUS_DONE":
        //                  bgColor = "#17d300";
        //                  estatus = "Completado"
        //                  break;
        //              case "STATUS_FAILED":
        //                  bgColor = "#e10000";
        //                  estatus = "Con retraso"
        //                  break;
        //              case "STATUS_SUSPENDED":
        //                  bgColor = "#e7e7e7";
        //                  estatus = "Suspendida"
        //                  break;
        //              case "STATUS_UNDEFINED":
        //                  bgColor = "#00b1e1";
        //                  estatus = "Sin iniciar"
        //                  break;
        //              default:
        //                  bgColor = "#00b1e1";
        //                  estatus = "Sin iniciar"
        //                  break;
        //          }
        //          return {
        //              id: `r_${task.id}`,
        //              calendarId: `${task.level == 0 ? '1': '2'}`,
        //             //  bgColor: bgColor,
        //              title: `${task.level == 0 ? 'Fase: ': 'Actividad: '}${task.name}`,
        //              category: 'allday',
        //              body: `${filteredAssigs.length > 0 ? "<h5>Responsables</h5>":""} ${images} <p>Estatus: <span class="badge ${task.status}">${estatus}</span></p>`,
        //              dueDateClass: '',
        //              start: `${moment.unix((task.start)/1000).format("YYYY-MM-DD")} 04:59:59`,
        //              end: `${moment.unix((task.end)/1000).format("YYYY-MM-DD")} 05:00:00`,
        //              isReadOnly: true,
        //              disableClick: true,
        //              useCreationPopup: true
        //          }
        // });
        // console.log(actividades);

         ScheduleList = [
            

           


            @foreach($recursos as $it_recursos)

                {

                    id: 'recursos{{$it_recursos->id}}',
                    calendarId: '2',
                    title: '{{$it_recursos->cursoscapacitaciones}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{  \Carbon\Carbon::parse($it_recursos->fecha_curso)->format('Y-m-d') }}',
                    end: '{{  \Carbon\Carbon::parse($it_recursos->fecha_fin)->format('Y-m-d') }}',
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

             @foreach($auditorias_anual as $it_auditorias_anual)
                {
                    id: 'auditoria{{$it_auditorias_anual->id}}',
                    calendarId: '3',
                    title: 'Tipo: {{$it_auditorias_anual->tipo}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{  \Carbon\Carbon::createFromFormat("d-m-Y", $it_auditorias_anual->fechainicio)->format("Y-m-d") }}',
                    end: '',
                    isReadOnly : true, 
                },
            @endforeach

            @foreach($actividades as $task)
                 {
                    id: 'recurasdsos{{$task->id}}',
                    calendarId: '1',
                    title: 'Actividad: {{$task->name}}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::createFromTimestamp($task->start / 1000)->toDateTimeString()
                     }}',
                    end: '{{ \Carbon\Carbon::createFromTimestamp($task->end / 1000)->toDateTimeString()
                     }}',
                    isReadOnly : true,

                },
            @endforeach
        ]
    </script>
    <script src="{{ asset('../js/calendar_tui/app.js') }}"></script>
@endsection
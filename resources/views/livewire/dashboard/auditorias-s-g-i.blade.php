<div>
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.comt/ui.time-picker/latest/tui-time-picker.css">
    <link rel="stylesheet" type="text/css" href="https://uicdn.toast.com/tui.date-picker/latest/tui-date-picker.css">

    <link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/tui-calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('../css/calendar_tui/default.css') }}">
    <style type="text/css">
        .caja {
            width: 100%;
            height: 740px;
            padding: 0;
            position: relative;
            top: 0px;
            right: -35px;
            bottom: 0;
            left: 35px;
        }

        .tamaño-calendario {
            position: absolute;
            top: 49px;
            right: 80px;
            bottom: 0;
            left: 180px;
        }

        .menu {
            padding: 0px 16px !important;
            text-align: right !important;
            position: relative;
        }

        #lnb {
            background: rgba(0, 0, 0, 0) !important;
            border: none !important;
        }

        #lnb div {
            border: none !important;
        }

        #calendarList {
            border: none !important;
        }

        #calendar {
            width: 100%;
            overflow: hidden;
            /*overflow-y: auto;*/
            border: none !important;
        }

        #calendarList span {
            margin-left: 0px;
            font-size: 8pt;
            float: left;
            width: 100px;
        }

        #calendarList span:nth-child(even) {
            width: 20px;
        }

        span strong {
            font-size: 15pt !important;
        }

        span:not(.lever)::before {
            left: -30px !important;
            top: -5px !important;
            transform: scale(0.7);
            display: none;
        }

        .tui-full-calendar-month-dayname {
            border: none !important;
        }

        .tui-full-calendar-popup-section div {
            border: none !important;
            margin-top: 20px !important;
        }

        .tui-full-calendar-popup-section input {
            border-bottom: 1px solid #eee !important;
        }


        .btn.btn-default.btn-sm.move-day {
            width: 30px;
            height: 30px;
            position: relative;
        }

        a:hover {
            text-decoration: none !important;
        }

        .tui-full-calendar-popup .tui-full-calendar-popup-container {
            display: none;
        }

        .tui-full-calendar-popup.tui-full-calendar-popup-detail .tui-full-calendar-popup-container {
            display: block;
        }


        .tui-full-calendar-weekday-grid-more-schedules {
            position: relative !important;
        }

        .dropdown-menu.show {
            width: 250px;
        }

        .i_calendar {
            font-size: 11pt;
            width: 20px;
            text-align: center;
        }

        .i_calendar_cuadro {
            margin: 0px 8px;
        }

        .Tarjetap {
            /* CSS proporcionado */
            /* Layout Properties */
            top: 140px;
            left: 286px;
            width: 1115px;
            height: 57px;
            display: flex;
            align-items: center;
            padding: 32px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 16px;
            opacity: 1;
        }

        .Tarjetap2 {
            top: 287px;
            left: 285px;
            width: 1112px;
            height: 57px;
            display: flex;
            align-items: center;
            padding: 32px;
            margin: 0px 0px 16px 20px;
            /* UI Properties */
            background: #FCF8C4 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px;
            opacity: 1;
            border-left: none;
            /* Quitar el borde del lado izquierdo */
        }

        .ojo-botones-o {
            top: 212px;
            left: 287px;
            width: 61px;
            height: 58px;
            margin: 16px 0px 0px 0px;
            background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
            background: #4BB3E8 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px 0px 0px 8px;
            opacity: 1;
            display: flex;
            justify-content: center;
        }

        .ojo-botones-a {
            top: 212px;
            left: 287px;
            width: 61px;
            height: 58px;
            margin: 16px 0px 0px 0px;
            background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
            background: #306BA9 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px 0px 0px 8px;
            opacity: 1;
            display: flex;
            justify-content: center;
        }

        .letra-tarjeta {
            /* Layout Properties */
            top: 393px;
            left: 366px;
            width: 143px;
            height: 39px;
            display: flex;
            align-items: center;
            padding: 32px;
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal medium 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-464646);
            text-align: left;
            font: normal normal medium 16px/20px Roboto;
            letter-spacing: 0px;
            color: #464646;
            font-weight: bold;
            opacity: 1;
        }

        .letra-tarjeta2 {
            /* Layout Properties */
            top: 393px;
            left: 366px;
            width: 143px;
            height: 39px;
            display: flex;
            align-items: center;
            margin: 28px 0px 24px 12px;
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal medium 16px/var(--unnamed-line-spacing-20) var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            color: var(--unnamed-color-464646);
            text-align: left;
            font: normal normal medium 16px/20px Roboto;
            letter-spacing: 0px;
            color: #464646;
            font-weight: bold;
            opacity: 1;
        }

        .tarjetas-container {
            display: flex;
        }

        .botones {
            top: 212px;
            left: 287px;
            width: 160px;
            height: 58px;
            margin: 16px 0px 0px 0px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 0px 8px 8px 0px;
            opacity: 1;
        }

        .botones2 {
            top: 367px;
            left: 285px;
            width: 165px;
            height: 90px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 0px 16px 16px 0px;
            opacity: 1;
        }

        .datosconformidades {
            display: flex;
            justify-content: center;
            top: 367px;
            left: 285px;
            width: 61px;
            height: 90px;
            background: var(--unnamed-color-306ba9) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 1px 4px #0000000F;
            border-radius: 8px 0px 0px 8px;
            border-right: 0.5px solid #606060;
            /* border-right: 0.5px solid #606060;
            border-right-style: solid;
            border-right-width: medium; */
            opacity: 1;
        }

        .fondo-grafica {
            /* Layout Properties */
            top: 474px;
            left: 285px;
            width: 1090px;
            height: 524px;
            margin: 20px 15px 50px 15px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 2px 4px #0000001F;
            border-radius: 16px;
            opacity: 1;
        }

        .fondo-calendario {
            /* Layout Properties */
            top: 474px;
            left: 285px;
            width: 1090px;
            height: 900px;
            margin: 50px 15px 50px 15px;
            /* UI Properties */
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 2px 4px #0000001F;
            border-radius: 16px;
            opacity: 1;
        }

        .titulo-graficas {
            top: 515px;
            left: 313px;
            height: 24px;
            display: flex;
            padding: 32px 32px 25px 32px;
            /* UI Properties */
            text-align: left;
            font: normal normal normal 20px/24px Roboto;
            letter-spacing: 0px;
            color: #5A5A5A;
            opacity: 1;
        }

        .subtitulo {
            /* Layout Properties */
            margin: 6px 12px 20px 16px;
            top: 303px;
            left: 286px;
            height: 22px;
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal medium 18px/22px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            text-align: left;
            font: 18px Roboto;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            font-weight: bold;
        }

        .tarjetas {
            margin: 6px 0px 0px 0px;
            top: 344px;
            left: 287px;
            width: 230px;
            height: 80px;
            margin-left: 1px;
            opacity: 1;
            border-radius: 8px
        }

        .letra-tarjeta-MYA {
            margin-top: 15px;
            margin-left: 20px;
            text-align: left;
            font: 14px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
            opacity: 1;
            display: flex;
            align-items: center;
        }

        .datos-letra-tarjeta-MYA {
            margin-left: 20px;
            text-align: left;
            font: 24px Roboto;
            letter-spacing: 0px;
            color: #FFFFFF;
            font-weight: bolder;
            opacity: 1;
            display: flex;
            align-items: center;
        }

        .display-grafica {
            top: 438px;
            left: 287px;
            width: 520px;
            height: 477px;
            margin: 20px 0px 40px 0px;
            background: var(--unnamed-color-ffffff) 0% 0% no-repeat padding-box;
            background: #FFFFFF 0% 0% no-repeat padding-box;
            box-shadow: 0px 2px 4px #0000001F;
            border-radius: 16px;
            opacity: 1;
        }

        .filtro {
            /* Layout Properties */
            margin: 24px 0px 0px 700px;
            top: 152px;
            left: 500px;
            width: 200px;
            height: 34px;
            /* UI Properties */
            border: 1px solid var(--unnamed-color-d5d5d5);
            background: #F8FAFC 0% 0% no-repeat padding-box;
            border: 1px solid #D5D5D5;
            border-radius: 4px;
            opacity: 1;
        }

        .letra-filtro {
            margin-top: 8px;
            margin-left: 15px;
            top: 152px;
            left: 500px;
            width: 157px;
            height: 34px;
            text-align: left;
            font: 14px Roboto;
            letter-spacing: 0px;
            color: #606060;
            opacity: 1;
        }

        .titulo-dashboard {
            margin: 6px 12px 24px 8px;
            top: 303px;
            left: 286px;
            height: 22px;
            /* UI Properties */
            font: var(--unnamed-font-style-normal) normal medium 18px/22px var(--unnamed-font-family-roboto);
            letter-spacing: var(--unnamed-character-spacing-0);
            text-align: left;
            font: 24px Roboto;
            letter-spacing: 0px;
            color: #2567AE;
            opacity: 1;
            font-weight: bold;
        }

        .datos-letra-tarjeta-A {
            margin: 16px;
            text-align: left;
            font: 24px Roboto;
            letter-spacing: 0px;
            color: #464646;
            font-weight: bolder;
            opacity: 1;
            display: flex;
            align-items: center;
        }

        /* Estilo para el primer tipo de línea de cuadrícula */
        .yaxislayer-above:first-child {
            top: 627px;
            left: 329px;
            width: 949px;
            height: 24px;
            transform: matrix(0, -1, 1, 0, 0, 0);
            background: #F3F3F3;
            /* Color de fondo para el primer tipo de línea de cuadrícula */
            opacity: 1;
        }

        /* Estilo para el segundo tipo de línea de cuadrícula */
        .yaxislayer-above:last-child {
            top: 651px;
            left: 329px;
            width: 949px;
            height: 24px;
            transform: matrix(0, -1, 1, 0, 0, 0);
            background: #FCFCFC;
            /* Color de fondo para el segundo tipo de línea de cuadrícula */
            opacity: 1;
        }

        /* Estilo común para ambas líneas de cuadrícula */
        .yaxislayer-above .gridlayer-y .grid-line-x {
            height: 1px;
            /* Grosor de las líneas de cuadrícula */
        }

        .yaxislayer-above .gridlayer-y .grid-line-x:not(.zero-line) {
            background: transparent;
            /* Color de las líneas de cuadrícula */
        }
    </style>
    {{-- HTML DASHBOARD --}}
    <div class="container">
        <h1 class="titulo-dashboard">Dashboard</h1>
        <div class="Tarjetap">Selecciona la Norma que desees monitorear

            <div class="">
                {{-- <select class="form-control filtro" style="margin-left: 570px;margin-bottom: 24px;">
                    <option>ISO 27001</option>
                </select> --}}
            </div>
        </div>
    </div>
    <div>
        <div class="row" style="margin-left: 6px;">
            {{-- MI PLAN ISO --}}
            <div class="col-md-3">
                <ul class="nav nav-tabs d-flex inline">
                    <li class="active ojo-botones-o">
                        <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                    </li>
                    <a class="botones" href="#mi-plan-iso" data-toggle="tab" data-target="#mi-plan-iso">
                        <!-- Agrega data-target -->
                        <h3 class="letra-tarjeta">Mi plan ISO</h3>
                    </a>
                </ul>
            </div>
            {{-- RIESGOS --}}
            <div class="col-md-3" style="padding-left:0px">
                <ul class="nav nav-tabs d-flex inline">
                    <li class="ojo-botones-o">
                        <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                    </li>
                    <a class="botones" href="#riesgos" data-toggle="tab">
                        <h3 class="letra-tarjeta">Riesgos</h3>
                    </a>
                </ul>
            </div>
            {{-- Auditorias --}}
            <div class="col-md-3" style="padding-left:0px">
                <ul class="nav nav-tabs d-flex inline">
                    <li class="ojo-botones-o">
                        <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                    </li>
                    <a class="botones" href="#auditorias" data-toggle="tab">
                        <h3 class="letra-tarjeta">Auditorias</h3>
                    </a>
                </ul>
            </div>
            {{-- Mejoras y Acciones --}}
            <div class="col-md-3" style="padding-left:0px">
                <ul class="nav nav-tabs d-flex inline">
                    <li class="ojo-botones-o">
                        <i class="fa-regular fa-eye fa-xl" style="margin-top: 30px; color:#FFFFFF;"></i>
                    </li>
                    <a class="botones" href="#mejorasyacciones" data-toggle="tab">
                        <h3 class="letra-tarjeta">Mejoras y Acciones</h3>
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content">
        {{-- MI PLAN ISO (TAB CONTENT) --}}
        <div class="tab-pane fade text-center" id="mi-plan-iso">
            <img src="{{ asset('img/escuela/home/technical-issues-1.jpg') }}" alt="jpg"
                style="width:50%; max-width:400px;">
            <p></p>
        </div>
        {{-- RIESGOS (TAB CONTENT) --}}
        <div class="tab-pane fade text-center" id="riesgos">
            <img src="{{ asset('img/escuela/home/technical-issues-2.jpg') }}" alt="jpg"
                style="width:50%; max-width:1000px;">
            <p></p>
        </div>
        {{-- AUDITORIAS (TAB CONTENT) --}}
        <div class="tab-pane fade" id="auditorias">
            <div class="Tarjetap2">Selecciona el informe que desees consultar
                <select class="form-control filtro" style="margin-left: 570px;margin-bottom: 24px;">
                    @foreach ($nombreaudits as $nombreaudit)
                        <option>{{ $nombreaudit }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row" style="margin: 0px 0px 0px 54px;">
                @foreach ($clasificaciones_array as $key => $clasificacion)
                    <div class="d-flex inline m-3">
                        <div class="datosconformidades">
                            <h6 class="datos-letra-tarjeta-A">{{ $clasificacion }}</h6>
                        </div>
                        <div class="botones2">
                            <h3 class="letra-tarjeta2">{{ $key }}</h3>
                        </div>
                    </div>
                @endforeach
                <div class="row" style="margin: 0px 0px 0px 8px;">
                    <div class="d-flex inline m-3">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="fondo-grafica">
                            <h1 class="titulo-graficas">Auditorias</h1>
                            <hr style="margin: 0px 32px 0px 32px;">
                            <!-- Reemplaza el select existente con la lista desplegable personalizada de Select2 -->
                            <select id="filtroClasificacion" class="form-control filtro" style="margin-left: 780px;">
                                @foreach ($clasificaciones as $clasificacion)
                                    <option>{{ $clasificacion }}</option>
                                @endforeach
                            </select>
                            <div id="A"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="fondo-calendario">
                            <h1 class="titulo-graficas">Calendario de auditorias</h1>
                            <hr style="margin: 0px 32px 0px 32px;">
                            <div class="" style="margin-top:50px;">
                                @can('mi_perfil_mi_calendario_acceder')
                                    <div class="caja" style="margin-top:-60px;">
                                        <div id="lnb">

                                            <div id="lnb-calendars" class="lnb-calendars">
                                                <div>
                                                    <div class="lnb-calendars-item">
                                                        <label>
                                                            <input class="tui-full-calendar-checkbox-square"
                                                                type="checkbox" value="all" checked>
                                                            <span style="">
                                                                <span
                                                                    style="margin-left: 20px; width: 100px !important; position: absolute;">Ver
                                                                    Todos</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div id="calendarList" class="lnb-calendars-d1">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tamaño-calendario">
                                            <div class="menu">
                                                <span class="dropdown">
                                                    <button id="dropdownMenu-calendarType"
                                                        class="btn btn-default btn-sm dropdown-toggle" type="button"
                                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i id="calendarTypeIcon" class="calendar-icon ic_view_month"
                                                            style="margin-right: 4px;"></i>
                                                        <span id="calendarTypeName"></span>&nbsp;
                                                        <i class="calendar-icon tui-full-calendar-dropdown-arrow"></i>
                                                    </button>
                                                    <ul class="dropdown-menu" role="menu"
                                                        aria-labelledby="dropdownMenu-calendarType">
                                                        <li role="presentation">
                                                            <a class="dropdown-menu-title" role="menuitem"
                                                                data-action="toggle-daily">
                                                                <i class="calendar-icon ic_view_day"></i>Diario
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-menu-title" role="menuitem"
                                                                data-action="toggle-weekly">
                                                                <i class="calendar-icon ic_view_week"></i>Semanal
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-menu-title" role="menuitem"
                                                                data-action="toggle-monthly">
                                                                <i class="calendar-icon ic_view_month"></i>Mensual
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-menu-title" role="menuitem"
                                                                data-action="toggle-weeks2">
                                                                <i class="calendar-icon ic_view_week"></i>2 Semanas
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a class="dropdown-menu-title" role="menuitem"
                                                                data-action="toggle-weeks3">
                                                                <i class="calendar-icon ic_view_week"></i>3 Semanas
                                                            </a>
                                                        </li>
                                                        <li role="presentation" class="dropdown-divider"></li>
                                                        <li role="presentation">
                                                            <a role="menuitem" data-action="toggle-workweek">
                                                                <input type="checkbox"
                                                                    class="tui-full-calendar-checkbox-square"
                                                                    value="toggle-workweek" checked>
                                                                <span class="checkbox-title"></span>Fines de semana
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" data-action="toggle-start-day-1">
                                                                <input type="checkbox"
                                                                    class="tui-full-calendar-checkbox-square"
                                                                    value="toggle-start-day-1">
                                                                <span class="checkbox-title"></span>Inicio de semana en
                                                                lunes
                                                            </a>
                                                        </li>
                                                        <li role="presentation">
                                                            <a role="menuitem" data-action="toggle-narrow-weekend">
                                                                <input type="checkbox"
                                                                    class="tui-full-calendar-checkbox-square"
                                                                    value="toggle-narrow-weekend">
                                                                <span class="checkbox-title"></span>Reducir dias no
                                                                laborales
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </span>
                                                <span id="menu-navi">
                                                    <button type="button" class="btn btn-default btn-sm move-today"
                                                        data-action="move-today">Hoy</button>
                                                    <button type="button" class="btn btn-default btn-sm move-day"
                                                        data-action="move-prev">
                                                        <i class="calendar-icon ic-arrow-line-left"
                                                            data-action="move-prev"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-default btn-sm move-day"
                                                        data-action="move-next">
                                                        <i class="calendar-icon ic-arrow-line-right"
                                                            data-action="move-next"></i>
                                                    </button>
                                                </span>
                                                <span id="renderRange" class="render-range"></span>
                                            </div>
                                            <div id="calendar"></div>
                                        </div>
                                    </div>
                                @endcan
                            </div>
                        </div>
                        <p></p>
                    </div>
                </div>
            </div>
        </div>

        {{-- MEJORAS Y ACCIONES (TAB CONTENT) --}}
        <div class="tab-pane fade" id="mejorasyacciones">
            <p></p>
            <h1 class="subtitulo">Mejoras</h1>
            <div>
                <div class="row" style="margin-left:3px">
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #28C2A3;">
                            <h3 class="letra-tarjeta-MYA">En curso</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($encursoCount, 2, '0', STR_PAD_LEFT) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #FF9B65;">
                            <h3 class="letra-tarjeta-MYA">En espera</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($enesperaCount, 2, '0', STR_PAD_LEFT) }}
                            </h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #6C6C6C;">
                            <h3 class="letra-tarjeta-MYA">Cerrados</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($cerradoCount, 2, '0', STR_PAD_LEFT) }}
                            </h6>
                        </div>
                    </div>
                    <div class="d-flex inline col-md-3">
                        <div class="tarjetas" style="background: #E66060;">
                            <h3 class="letra-tarjeta-MYA">Sin atender</h3>
                            <h6 class="datos-letra-tarjeta-MYA">{{ str_pad($sinatenderCount, 2, '0', STR_PAD_LEFT) }}
                            </h6>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="display-grafica" style="margin-left: 6px;">
                                <h3 class="titulo-graficas">Total de las mejoras</h3>
                                <hr style="margin: 0px 32px 0px 32px;">
                                <div id="TM"></div>
                            </div>
                        </div>
                        <div class="row" style="margin-left:3px">
                            <div class="col-md-6">
                                <div class="display-grafica">
                                    <h3 class="titulo-graficas">Porcentaje de mejora</h3>
                                    <hr style="margin: 0px 32px 0px 32px;">
                                    <div id="PM"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h1 class="subtitulo">Acciones Correctivas</h1>
                <div>
                    <div class="row">
                        <div class="d-flex inline col-md-3">
                            <div class="tarjetas" style="background: #28C2A3;">
                                <h3 class="letra-tarjeta-MYA">En curso</h3>
                                <h6 class="datos-letra-tarjeta-MYA">
                                    {{ str_pad($encursoCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                            </div>
                        </div>
                        <div class="d-flex inline col-md-3">
                            <div class="tarjetas" style="background: #FF9B65;">
                                <h3 class="letra-tarjeta-MYA">En espera </h3>
                                <h6 class="datos-letra-tarjeta-MYA">
                                    {{ str_pad($enesperaCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                            </div>
                        </div>
                        <div class="d-flex inline col-md-3">
                            <div class="tarjetas" style="background: #6C6C6C;">
                                <h3 class="letra-tarjeta-MYA">Cerrados</h3>
                                <h6 class="datos-letra-tarjeta-MYA">
                                    {{ str_pad($cerradoCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                            </div>
                        </div>
                        <div class="d-flex inline col-md-3">
                            <div class="tarjetas" style="background: #E66060;">
                                <h3 class="letra-tarjeta-MYA">Sin atender </h3>
                                <h6 class="datos-letra-tarjeta-MYA">
                                    {{ str_pad($sinatenderCountAC, 2, '0', STR_PAD_LEFT) }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="display-grafica">
                                    <h3 class="titulo-graficas">Total de las Acciones Correctivas</h3>
                                    <hr style="margin: 0px 32px 0px 32px;">
                                    <div id="TAC"></div>
                                </div>
                            </div>
                            <div class="row" style="margin-left:3px">
                                <div class="d-flex inline col-md-6">
                                    <div class="display-grafica">
                                        <h3 class="titulo-graficas">Porcentaje de Acciones Correctivas</h3>
                                        <hr style="margin: 0px 32px 0px 32px;">
                                        <div id="PAC"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script src="https://cdn.plot.ly/plotly-2.26.0.min.js" charset="utf-8"></script>
    <script src="{{ asset('../js/calendar_tui/tui-calendar.js') }}"></script>
    <script src="{{ asset('../js/calendar_tui/calendar_auditoria.js') }}"></script>
    <script src="{{ asset('../js/calendar_tui/schedules.js') }}"></script>
    <!-- Agrega la referencia a la librería Select2 CSS y JS -->
    <link href="ruta-a-select2.min.css" rel="stylesheet">
    <script src="ruta-a-select2.min.js"></script>


    <script>
        $(document).ready(function() {
            // Activa la pestaña "Mi plan ISO" al cargar la página
            $('#mi-plan-iso').tab('show');

            // Asigna un evento click a los enlaces de los tabs
            $('.botones').click(function(e) {
                e.preventDefault(); // Evita el comportamiento predeterminado del enlace

                // Restaura la clase ojo-botones-o en todos los botones
                $('.botones li').removeClass('ojo-botones-a').addClass('ojo-botones-o');

                // Cambia la clase del botón actual a ojo-botones-a
                $(this).find('li').removeClass('ojo-botones-o').addClass('ojo-botones-a');

                // Oculta todos los tab-pane excepto el que se va a mostrar
                $('.tab-pane').removeClass('active');

                // Activa el tab correspondiente
                $($(this).attr('href')).addClass('active');
            });
        });
    </script>



    {{-- DASHBOARD DE AUDITORIAS --}}

    {{-- GRAFICA DE BARRAS AUDITORIAS --}}


    <script>
        // Define los datos iniciales para la gráfica

        let datosGrafica = {
            x: ['Contexto', 'Liderazgo', 'Planificación', 'Soporte', 'Operación', 'Evaluación', 'Mejora'],
            y: [{{ $contexto }}, {{ $liderazgo }}, {{ $planificacion }}, {{ $soporte }},
                {{ $operacion }}, {{ $evaluacion }}, {{ $mejora }}
            ],
            type: 'bar',
            marker: {
                color: ['#CEB475', '#65CDEE', '#EE6581', '#8965EE', '#C665EE', '#36C8D2', '#28C2A3'],
            },
            textfont: {
                color: 'white',
                size: 16
            },
            text: [{{ $contexto }}, {{ $liderazgo }}, {{ $planificacion }}, {{ $soporte }},
                {{ $operacion }}, {{ $evaluacion }}, {{ $mejora }}
            ],
            textposition: 'auto'
        };

        // Define el diseño de la gráfica
        let layoutsssss = {
            height: 390,
            width: 1070,
            bargap: 0.35,
            xaxis: {
                showgrid: false
            },
            yaxis: {
                showgrid: true,
                gridwidth: 27,
                gridshape: 'linear',
                gridpattern: 'alternate',
                gridcolor: ['#F3F3F3', '#FCFCFC'],
            }
        };

        // Función para actualizar el gráfico cuando cambie la selección
        function actualizarGrafico() {
            let selectedValue = document.getElementById("filtroAudit").value;

            // Realiza una petición AJAX para obtener el clausula_id correspondiente
            fetch(`/obtener-clausula-id/${selectedValue}`)
                .then(response => response.json())
                .then(data => {
                    // Copia los datos actuales
                    let newData = {
                        ...datosGrafica
                    };

                    // Actualiza newData.y según el clausula_id obtenido
                    // Esto es solo un ejemplo, debes definir los valores correspondientes según tu lógica
                    switch (data.clausula_id) {
                        case 1:
                            newData.y = [{{ $contexto }}, 0, 0, 0, 0, 0, 0];
                            break;
                        case 2:
                            newData.y = [0, {{ $liderazgo }}, 0, 0, 0, 0, 0];
                            break;
                        case 3:
                            newData.y = [0, 0, {{ $planificacion }}, 0, 0, 0, 0];
                            break;
                            // Agrega más casos según tus clausulas...
                        default:
                            newData.y = [0, 0, 0, 0, 0, 0, 0]; // Valores predeterminados si no hay coincidencia
                    }

                    // Actualiza el gráfico
                    Plotly.newPlot("A", [newData], layoutsssss);
                })
                .catch(error => {
                    console.error('Error al obtener el clausula_id:', error);
                });
        }

        // Inicializa el gráfico con los datos iniciales
        Plotly.newPlot("A", [datosGrafica], layoutsssss);
    </script>

    {{-- DASHBOARD DE MEJORAS Y ACCIONES --}}


    {{-- GRAFICA DE BARRAS TOTAL DE MEJORAS --}}

    <script>
        let data = [{
            x: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
            y: [{{ $encursoCount }}, {{ $enesperaCount }}, {{ $cerradoCount }}, {{ $sinatenderCount }}],
            type: 'bar',
            marker: {
                color: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
            },
            textfont: {
                color: 'white',
                size: 12
            },
            text: [{{ $encursoCount }}, {{ $enesperaCount }}, {{ $cerradoCount }},
                {{ $sinatenderCount }}
            ], // Aquí se especifica el texto
            textposition: 'auto' // Establece la posición del texto (en este caso, se coloca automáticamente)
        }];
        let layout = {
            height: 400,
            width: 520,
            bargap: 0.05, // Ajusta este valor para controlar el espacio entre las barras
            xaxis: {
                showgrid: false // Desactiva las líneas de la cuadrícula vertical
            },
            yaxis: {
                showgrid: true, // Activa las líneas de la cuadrícula horizontal
                gridcolor: 'rgba(128,128,128,0.5)' // Establece el color de las líneas de la cuadrícula
            }
        };
        Plotly.newPlot('TM', data, layout);
    </script>


    {{-- GRAFICA DE PASTEL PORCENTAJE DE MEJORA --}}

    <script>
        let datass = [{
            values: [{{ $encursoCount }}, {{ $enesperaCount }}, {{ $cerradoCount }}, {{ $sinatenderCount }}],
            labels: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
            hole: .45,
            type: 'pie',
            marker: {
                colors: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060'],
            },
            textfont: {
                color: 'white',
                size: 12
            }
        }];

        let layoutss = {
            height: 400,
            width: 500,
        };

        Plotly.newPlot('PM', datass, layoutss);
    </script>

    {{-- GRAFICA DE BARRA TOTAL DE LAS ACCIONES CORRECTIVAS --}}

    <script>
        let datasss = [{
            x: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
            y: [{{ $encursoCountAC }}, {{ $enesperaCountAC }}, {{ $cerradoCountAC }}, {{ $sinatenderCountAC }}],
            type: 'bar',
            marker: {
                color: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
            },
            textfont: {
                color: 'white',
                size: 12
            },
            text: [{{ $encursoCountAC }}, {{ $enesperaCountAC }}, {{ $cerradoCountAC }},
                {{ $sinatenderCountAC }}
            ], // Aquí se especifica el texto
            textposition: 'auto' // Establece la posición del texto (en este caso, se coloca automáticamente)
        }];

        let layoutsss = {
            height: 400,
            width: 520,
            bargap: 0.05, // Ajusta este valor para controlar el espacio entre las barras
            xaxis: {
                showgrid: false // Desactiva las líneas de la cuadrícula vertical
            },
            yaxis: {
                showgrid: true, // Activa las líneas de la cuadrícula horizontal
                gridcolor: 'rgba(128,128,128,0.5)' // Establece el color de las líneas de la cuadrícula
            }
        };

        Plotly.newPlot('TAC', datasss, layoutsss);
    </script>

    {{-- GRAFICA DE PASTEL PORCENTAJE DE ACCIONES CORRECTIVAS --}}

    <script>
        let datas = [{
            values: [{{ $encursoCountAC }}, {{ $enesperaCountAC }}, {{ $cerradoCountAC }},
                {{ $sinatenderCountAC }}
            ],
            labels: ['En curso', 'En espera', 'Cerrados', 'Sin atender'],
            hole: .45,
            type: 'pie',
            marker: {
                colors: ['#28C2A3', '#FF9B65', '#6C6C6C', '#E66060']
            },
            textfont: {
                color: 'white',
                size: 12
            }
        }];

        let layouts = {
            height: 400,
            width: 500
            // width: 480px;
            // height: 477px;
        };

        Plotly.newPlot('PAC', datas, layouts);
    </script>

    <script type="text/javascript">
        ScheduleList = [
            @foreach ($audits as $audit)
                {
                    id: 'revisiones{{ $audit->id }}',
                    calendarId: '12',
                    title: '<i class="fas fa-drum i_calendar_cuadro"></i> Revisión de entregables: {{ $audit->nombre }}',
                    category: 'allday',
                    dueDateClass: '',
                    start: '{{ \Carbon\Carbon::parse($audit->fechainicio)->format('Y-m-d') }}',
                    end: '{{ \Carbon\Carbon::parse($audit->fechafin)->format('Y-m-d') }}',
                    isReadOnly: true,
                },
            @endforeach
        ];
    </script>

    <script src="{{ asset('../js/calendar_tui/app.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {



            }, 5000);
        })
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            $(".tui-full-calendar-weekday-schedule-title").attr("title", "");
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function dato() {
            var select = document.getElementById('filtroAudit');
            var valorSeleccionado = select.value;
            console.log(valorSeleccionado);
            axios.post('obtenerauditoria', {
                    valorSeleccionado
                })
                .then(function(response) {
                    console.log(response.data.message); // Mensaje de respuesta del servidor
                })
                .catch(function(error) {
                    console.error('Error:', error);
                });

        }
    </script>

@endsection
</div>

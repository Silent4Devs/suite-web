<div class="tab-pane fade" id="auditorias">
    <div class="Tarjetap2">Selecciona el informe que desees consultar
        <select class="form-control filtro" style="margin-left: 570px;margin-bottom: 24px;">
            @foreach($nombreaudits as $nombreaudit)
                <option>{{$nombreaudit}}</option>
            @endforeach
        </select>
    </div>
    <div class="row" style="margin: 0px 0px 0px 54px;">
       @foreach ($totalclasificaciones as $totalclasificacion )
        <div class="d-flex inline m-3">
            <div class="datosconformidades">
                <h6 class="datos-letra-tarjeta-A">{{$totalclasificacion->total}}</h6>
            </div>
            <div class="botones2">
                <h3 class="letra-tarjeta2">{{$totalclasificacion->nombre_clasificaciones}}</h3>
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
                        @foreach($clasificaciones as $clasificacion)
                            <option>{{$clasificacion}}</option>
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
                <div class="tamaño-calendario">
                    <div class="menu">
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
                </div>
                <p></p>
            </div>
        </div>
    </div>
</div>

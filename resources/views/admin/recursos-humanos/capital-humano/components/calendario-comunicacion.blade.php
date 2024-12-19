<ul class="menu-modulos">
    @can('calendario_corporativo_acceder')
        <li>
            <a href="{{ route('admin.systemCalendar') }}">
                <i class="bi bi-calendar"></i>
                <span>
                    Calendario Corporativo
                </span>
            </a>
        </li>
    @endcan
    @can('dias_festivos_acceder')
        <li>
            <a href="{{ route('admin.calendario-oficial.index') }}">
                <i class="bi bi-calendar2-check"></i>
                <span>
                    Días Festivos
                </span>
            </a>
        </li>
    @endcan
    @can('eventos_acceder')
        <li>
            <a href="{{ route('admin.tabla-calendario.index') }}">
                <i class="bi bi-calendar-event"></i>
                <span>
                    Eventos
                </span>
            </a>
        </li>
    @endcan
    @can('comunicados_generales_acceder')
        <li>
            <a href="{{ route('admin.comunicacion-sgis.index') }}">
                <i class="bi bi-megaphone"></i>
                <span>
                    Comunicados
                </span>
            </a>
        </li>
    @endcan
    @can('centro_de_atencion_acceder')
        <li>
            <a href="{{ route('admin.desk.index') }}">
                <i class="bi bi-person-workspace"></i>
                <span>
                    Centro de Atención
                </span>
            </a>
        </li>
    @endcan
</ul>

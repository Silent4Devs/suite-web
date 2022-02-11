<ul class="mt-4">
    @can('agenda_access')
        <li><a href="{{ route('admin.systemCalendar') }}">
                <div>
                    <i class="bi bi-calendar"></i><br>
                    Calendario Corporativo
                </div>
            </a></li>
    @endcan
    @can('dias_festivos_access')
        <li><a href="{{ route('admin.calendario-oficial.index') }}">
                <div>
                    <i class="bi bi-calendar2-check"></i><br>
                    Días Festivos
                </div>
            </a>
        </li>
    @endcan
    @can('eventos_organizacion_access')
        <li><a href="{{ route('admin.tabla-calendario.index') }}">
                <div>
                    <i class="bi bi-calendar-event"></i><br>
                    Eventos
                </div>
            </a></li>
    @endcan
    @can('comunicacion_sgi_access')
        <li><a href="{{ route('admin.comunicacion-sgis.index') }}">
                <div>
                    <i class="bi bi-megaphone"></i><br>
                    Comunicados
                </div>
            </a></li>
    @endcan
    @can('centro_atencion_access')
        <li><a href="{{ route('admin.desk.index') }}">
                <div>
                    <i class="bi bi-person-workspace"></i><br>
                    Centro de Atención
                </div>
            </a>
        </li>
    @endcan
    @can('centro_atencion_access')
        <li>
            <a href="#">
                <div>
                    <i class="bi bi-file-spreadsheet"></i><br>
                    TimeSheet
                </div>
            </a>
        </li>
    @endcan
    @can('minutasaltadireccion_create')
        <li>
            <a href="#">
                <div>
                    <i class="bi bi-file-minus"></i><br>
                    Minutas
                </div>
            </a>
        </li>
    @endcan
</ul>

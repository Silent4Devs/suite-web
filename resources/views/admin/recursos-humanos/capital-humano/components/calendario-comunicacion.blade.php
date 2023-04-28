<ul class="mt-4">
    @can('calendario_corporativo_acceder')
        <li><a href="{{ route('admin.systemCalendar') }}">
                <div>
                    <i class="bi bi-calendar"></i><br>
                    Calendario Corporativo
                </div>
            </a></li>
    @endcan
    @can('dias_festivos_acceder')
        <li><a href="{{ route('admin.calendario-oficial.index') }}">
                <div>
                    <i class="bi bi-calendar2-check"></i><br>
                    Días Festivos
                </div>
            </a>
        </li>
    @endcan
    @can('eventos_acceder')
        <li><a href="{{ route('admin.tabla-calendario.index') }}">
                <div>
                    <i class="bi bi-calendar-event"></i><br>
                    Eventos
                </div>
            </a></li>
    @endcan
    @can('comunicados_generales_acceder')
        <li><a href="{{ route('admin.comunicacion-sgis.index') }}">
                <div>
                    <i class="bi bi-megaphone"></i><br>
                    Comunicados
                </div>
            </a></li>
    @endcan
    @can('centro_de_atencion_acceder')
        <li><a href="{{ route('admin.desk.index') }}">
                <div>
                    <i class="bi bi-person-workspace"></i><br>
                    Centro de Atención
                </div>
            </a>
        </li>
    @endcan

    {{-- @can('minutasaltadireccion_create')
        <li>
            <a href="#">
                <div>
                    <i class="bi bi-file-minus"></i><br>
                    Minutas
                </div>
            </a>
        </li>
    @endcan --}}
</ul>

@can('sistema_gestion_contratos_acceder')
    <ul class="mt-4">
        @can('katbol_contratos_acceso')
            <li><a href="{{ route('contract_manager.contratos-katbol.index') }}">
                    <div>
                        <i class="fa-regular fa-file-lines"></i><br>
                        Contratos
                    </div>
                </a></li>
        @endcan
        @can('katbol_requisiciones_acceso')
            <li><a href="{{ route('contract_manager.requisiciones') }}">
                    <div>
                        <i class="fa-regular fa-folder-open"></i><br>
                        Requisiciones
                    </div>
                </a></li>
        @endcan
        @can('dashboard_gestion_contratos_acceder')
        <li><a href="{{ route('contract_manager.dashboard.katbol') }}">
                    <div>
                        <i class="fa-solid fa-chart-column "></i><br>
                        Dashboard
                    </div>
                </a></li>
        @endcan
        @can('calendario_corporativo_acceder')
            <li><a href="{{ route('admin.systemCalendar') }}">
                    <div>
                        <i class="fa-solid fa-calendar-day"></i><br>
                        Calendario
                    </div>
                </a></li>
        @endcan
        @can('timesheet_administrador_clientes_access')
            <li><a href="{{ route('admin.timesheet-clientes') }}">
                    <div>
                        <i class="bi bi-bag"></i><br>
                        Clientes
                    </div>
                </a></li>
        @endcan
        @can('katbol_reportes_requisicion_acceso')
            <li><a href="{{ route('contract_manager.reportes.index') }}">
                    <div>
                        <i class="fa-solid fa-file-circle-exclamation"></i>
                        Reportes
                    </div>
                </a></li>
        @endcan
    </ul>
@else
    <div class="row" style="margin-left: -10px">
        <div class="mb-3 col-12">
            <img src="{{ asset('img/not_access.svg') }}" width="400px" style="margin-left: calc(50% - 200px);" />
        </div>
        <div class="col-12">
            <strong style="font-size:12pt">
                <i class="mr-1 fas fa-info-circle"></i>
                No puedes acceder al módulo de Gestion de Contratos, solicita al administrador que te
                otorge dichos permisos
            </strong>
        </div>
    </div>
@endcan

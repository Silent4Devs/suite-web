@php
    use App\Models\User;
    use App\Models\Timesheet;
    use App\Models\Organizacion;

    $usuario = User::getCurrentUser();

    $organizacion = Organizacion::first();

    if (Timesheet::count() > 0) {
        $time_viejo = Timesheet::orderBy('fecha_dia')->first()->fecha_dia;
        $time_exist = true;
    } else {
        $time_viejo = null;
        $time_exist = false;
    }
@endphp

@if ($usuario->empleado)
    @if (
        $usuario->empleado->es_supervisor ||
            $usuario->can('timesheet_administrador_proyectos_access') ||
            $usuario->can('timesheet_administrador_tareas_proyectos_access') ||
            $usuario->can('timesheet_administrador_clientes_access') ||
            $usuario->can('timesheet_administrador_dashboard_access'))
        <div class="option-fixed-admin">

            @if ($usuario->empleado->es_supervisor)
                <button class="btn"
                    onclick="document.querySelector('.modal-aprobador').classList.remove('invisible');">
                    <img src="{{ asset('img/calendar-icon-time-person.svg') }}" alt="">
                    Aprobador
                </button>
            @endif
            @if (
                $usuario->can('timesheet_administrador_proyectos_access') ||
                    $usuario->can('timesheet_administrador_tareas_proyectos_access') ||
                    $usuario->can('timesheet_administrador_clientes_access') ||
                    $usuario->can('timesheet_administrador_dashboard_access'))
                <button class="btn" onclick="document.querySelector('.modal-config').classList.remove('invisible');">
                    <img src="{{ asset('img/calendar-icon-time-config.svg') }}" alt="">
                    Administrador
                </button>
            @endif
            <i class="bi bi-chevron-compact-right"
                style="position: absolute; top: 50%; transform: translateY(-50%); right: 3px;"></i>
        </div>
    @endif
@endif

@if ($usuario->empleado)
    @if ($usuario->empleado->es_supervisor)
        <div class="modal-admin-time modal-aprobador invisible">
            <button class="btn" style="position: absolute; right: 10px; top: 10px;"
                onclick="document.querySelector('.modal-aprobador').classList.add('invisible');">
                <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
            </button>

            <h3 class="text-white text-center" style="font-size:30px; margin-top: 100px;">Aprobador</h3>

            <div class="caja-cards-time-admin" style="gap: 60px; margin-top: 100px;">
                @can('timesheet_administrador_aprobar_rechazar_horas_access')
                    <a href="{{ route('admin.timesheet-aprobaciones') }}">
                        <div class="card-time-admin">
                            <div class="img-card-time-admin">
                                <img src="{{ asset('img/iso/iso7.webp') }}" alt="">
                            </div>
                            <div class="info-card-time-admin">
                                <h5>Pendientes de aprobar</h5>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('timesheet_administrador_aprobar_rechazar_horas_access')
                    <a href="{{ route('admin.timesheet-aprobados') }}">
                        <div class="card-time-admin">
                            <div class="img-card-time-admin">
                                <img src="{{ asset('img/iso/iso15.webp') }}" alt="">
                            </div>
                            <div class="info-card-time-admin">
                                <h5>Aprobados</h5>
                            </div>
                        </div>
                    </a>
                    <a href="{{ route('admin.timesheet-rechazos') }}">
                        <div class="card-time-admin">
                            <div class="img-card-time-admin">
                                <img src="{{ asset('img/iso/iso21.webp') }}" alt="">
                            </div>
                            <div class="info-card-time-admin">
                                <h5>Rechazados</h5>
                            </div>
                        </div>
                    </a>
                @endcan
                @can('timesheet_administrador_reportes_aprobador_access')
                    <a href="{{ route('admin.timesheet-reporte-aprobador', $usuario->empleado->id) }}">
                        <div class="card-time-admin">
                            <div class="img-card-time-admin">
                                <img src="{{ asset('img/iso/iso25.webp') }}" alt="">
                            </div>
                            <div class="info-card-time-admin">
                                <h5>Reportes</h5>
                            </div>
                        </div>
                    </a>
                @endcan
            </div>
        </div>
    @endif
@endif

@if (
    $usuario->can('timesheet_administrador_proyectos_access') ||
        $usuario->can('timesheet_administrador_tareas_proyectos_access') ||
        $usuario->can('timesheet_administrador_clientes_access') ||
        $usuario->can('timesheet_administrador_dashboard_access'))
    <div class="modal-admin-time modal-config invisible">
        <button class="btn btn-close-time-config" style="position: absolute; right: 10px; top: 10px;"
            onclick="document.querySelector('.modal-config').classList.add('invisible');">
            <i class="bi bi-x-lg text-white" style="font-size: 40px;"></i>
        </button>

        <button class="btn btn-retreat-time-config d-none" style="position: absolute; right: 10px; top: 10px;"
            onclick="reportesCards()">
            <i class="bi bi-chevron-left text-white" style="font-size: 40px;"></i>
        </button>

        <h3 class="text-white text-center title-aprob-time-config" style="font-size:30px; margin-top: 100px;">
            Administrador
        </h3>
        <h3 class="text-white text-center title-report-time-config d-none" style="font-size:30px; margin-top: 100px;">
            Reportes</h3>

        <div class="caja-cards-time-admin cards-config-config active" style="gap: 60px; margin-top: 100px;">
            @can('timesheet_administrador_configuracion_access')
                <a href="{{ route('admin.timesheet-inicio') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso12.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Configuración Timesheet</h5>
                        </div>
                    </div>
                </a>
            @endcan
            @can('timesheet_administrador_clientes_access')
                <a href="{{ route('admin.timesheet-clientes') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso10.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Clientes</h5>
                        </div>
                    </div>
                </a>
            @endcan
            @can('timesheet_administrador_proyectos_access')
                <a href="{{ route('admin.timesheet-proyectos') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso14.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Proyectos</h5>
                        </div>
                    </div>
                </a>
            @endcan
            @can('timesheet_administrador_tareas_proyectos_access')
                <a href="{{ route('admin.timesheet-tareas') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso2.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Tareas</h5>
                        </div>
                    </div>
                </a>
            @endcan
            @can('timesheet_administrador_reportes_access')
                @if ($organizacion->fecha_registro_timesheet && $time_exist)
                    <a href="#" onclick="reportesCards()">
                        <div class="card-time-admin">
                            <div class="img-card-time-admin">
                                <img src="{{ asset('img/iso/iso27.webp') }}" alt="">
                            </div>
                            <div class="info-card-time-admin">
                                <h5>Reportes</h5>
                            </div>
                        </div>
                    </a>
                @endif
            @endcan
            @can('timesheet_administrador_dashboard_access')
                <a href="{{ route('admin.timesheet-dashboard') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso16.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Dashboard</h5>
                        </div>
                    </div>
                </a>
            @endcan
        </div>
        @can('timesheet_administrador_reportes_aprobador_access')
            <div class="d-flex justify-content-center w-100 px-5 flex-wrap cards-reportes-config"
                style="gap: 60px; margin-top: 100px;">
                <a href="{{ route('admin.timesheet-reportes-registros') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso3.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Registros Timesheet</h5>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.timesheet-reportes-empleados') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso7.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Registros por área</h5>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.timesheet-reportes-proyectos') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso12.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Proyectos</h5>
                        </div>
                    </div>
                </a>
                <a href="{{ route('admin.timesheet-reportes-proyemp') }}">
                    <div class="card-time-admin">
                        <div class="img-card-time-admin">
                            <img src="{{ asset('img/iso/iso22.webp') }}" alt="">
                        </div>
                        <div class="info-card-time-admin">
                            <h5>Registros Colaboradores Tareas</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endcan
    </div>
@endif

<script>
    function reportesCards() {
        document.querySelector('.cards-reportes-config').classList.toggle('active');
        document.querySelector('.cards-config-config').classList.toggle('active');
        document.querySelector('.title-aprob-time-config').classList.toggle('d-none');
        document.querySelector('.title-report-time-config').classList.toggle('d-none');

        document.querySelector('.btn-close-time-config').classList.toggle('d-none');
        document.querySelector('.btn-retreat-time-config').classList.toggle('d-none');
    }
</script>

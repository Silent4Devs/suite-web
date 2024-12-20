@extends('layouts.admin')
@section('content')
    <style>
        :root {
            --color-menu-modulo: #ffd3bf;
        }

        ul.menu-modulos li a,
        ul.menu-modulos li a::before {
            background-image: url("{{ asset('img/menu-modulos/menu-grafis-2.png') }}");
        }
    </style>

    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}
    <h5 class="titulo_general_funcion">Centro de Administración</h5>


    <ul class="menu-modulos">
        @can('reglas_vacaciones_acceder')
            <li>
                <a href="ajustes-vacaciones">
                    <i class="fa-solid fa-users-gear"></i>

                    <span>
                        Ajustes Vacaciones
                    </span>
                </a>
            </li>
        @endcan
        @can('reglas_dayoff_acceder')
            <li>
                <a href="ajustes-dayoff">
                    <i class="bi bi-gear-fill"></i>
                    <span>

                        Ajustes Day Off´s
                    </span>
                </a>
            </li>
        @endcan
        @can('reglas_goce_sueldo_acceder')
            <li>
                <a href="ajustes-permisos-goce-sueldo">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>
                        Ajustes Permisos
                    </span>
                </a>
            </li>
        @endcan
        @can('solicitud_mensajeria_ajustes')
            <li>
                <a href="ajustes-envio-documentos">
                    <i class="bi bi-send-plus-fill"></i>
                    <span>
                        Ajustes Envios
                    </span>
                </a>
            </li>
        @endcan
        @can('dashboard_solicitudes_directivo')
            <li>
                <a href="{{ route('admin.dashboard-permisos.dashboard-org', 'all') }}">
                    <i class="bi bi-bar-chart-line-fill"></i>
                    <span>
                        Dashboard Solicitudes
                    </span>
                </a>
            </li>
        @endcan
    </ul>
@endsection

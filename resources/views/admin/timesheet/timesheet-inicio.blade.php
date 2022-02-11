@extends('layouts.admin')
@section('content')
    {{-- menus horizontales --}}
    <style type="text/css">
        .caja_botones_menu {
            display: flex;
        }

        .caja_botones_menu a {
            width: 33.33%;
            text-decoration: none;
            display: inline-block;
            color: #345183;
            padding: 5px 0px;
            border-top: 1px solid #ccc !important;
            border-right: 1px solid #ccc;
            background-color: #f9f9f9;
            margin: 0;
            text-align: center;
            align-items: center;
        }

        .caja_botones_menu a:first-child {
            border-left: 1px solid #ccc;
        }

        .caja_botones_menu a:not(.caja_botones_menu a.btn_activo) {
            border-bottom: 1px solid #ccc;
        }

        .caja_botones_menu a i {
            margin-right: 7px;
            font-size: 15pt;
        }

        .caja_botones_menu a.btn_activo,
        .caja_botones_menu a.btn_activo:hover {
            background-color: #fff;
        }

        .caja_botones_menu a:hover {
            background-color: #f1f1f1;
        }

        .caja_caja_secciones {
            width: 100%;
        }

        .caja_secciones {
            width: 100%;
            display: flex;
        }

        .caja_secciones section {
            width: 0px;
            overflow: hidden;
            transition: 0.4s;
            opacity: 0;
        }

        .caja_tab_reveldada {
            width: 100% !important;
            overflow: none;
            opacity: 1 !important;
        }



        .seccion_div {
            overflow: hidden;
            width: 990px;
        }

        .caja_tab_reveldada .seccion_div {
            overflow: hidden;
            transition-delay: 0.5s;
            width: 100%;
        }

    </style>
    <style type="text/css">
        div.nav .nav-link {
            color: #345183;
        }

        .nav-tabs .nav-link.active {
            border-top: 2px solid #345183;
        }

        div.tab-pane ul {
            padding: 0;
            margin: 0;
            text-align: center;
        }

        div.tab-pane li {
            list-style: none;
            width: 150px;
            height: 150px;
            box-sizing: border-box;
            position: relative;
            margin: 10px;
            display: inline-block;
        }

        div.tab-pane li i {
            font-size: 30pt;
            margin-bottom: 10px;
            width: 100%;
        }

        div.tab-pane a {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #eee;
            color: #345183;
            border-radius: 6px;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
            transition: 0.1s;
            padding: 7px;
        }

        div.tab-pane a:hover {
            text-decoration: none !important;
            color: #345183;
            border: 1px solid #345183;
            box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.0);
            background-color: #fff;
        }

        a:hover {
            text-decoration: none !important;
        }



        @media(max-width: 648px) {
            .caja_secciones {
                min-height: 1000px;
            }
        }

        @media(max-width: 474px) {
            .caja_secciones {
                min-height: 2000px;
            }
        }

        .tabs {
            outline: none;
        }

    </style>
    <style>
        .ventana_menu {
            width: calc(100% - 40px);
            background-color: #fff;
            position: absolute;
            margin: auto;
            display: none;
            top: 35px;
            z-index: 3;
            height: calc(100% - 40px);

        }


        .btn_modal_video {
            width: 160px !important;
            transform: scale(0.7);
            position: absolute;
            right: 0;
            margin-top: -35px;
        }

    </style>


    {{-- {{ Breadcrumbs::render('admin.iso27001.index') }} --}}
    <h5 class="titulo_general_funcion">Timesheet</h5>
    <div class="mt-5 card">
        <div class="card-body">
            <nav>
                <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
                    <a class="nav-link active" id="nav-contexto-tab" data-type="contexto" data-toggle="tab"
                        href="#nav-contexto" role="tab" aria-controls="nav-contexto" aria-selected="true">
                        <i class="bi bi-calendar4"></i>
                        Mi Timesheet
                    </a>
                    <a class="nav-link" id="nav-liderazgo-tab" data-type="liderazgo" data-toggle="tab"
                        href="#nav-liderazgo" role="tab" aria-controls="nav-liderazgo" aria-selected="false">
                        <i class="bi bi-person-lines-fill"></i>
                        Administrador
                    </a>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane mb-4 fade show active" id="nav-contexto" role="tabpanel"
                    aria-labelledby="nav-contexto-tab">
                    <ul class="mt-4">
                        @can('mi_timesheet_horas_aceptadas_show')
                            <li>
                                <a href="{{ route('admin.timesheet') }}">
                                    <div>
                                        <i class="bi bi-calendar4"></i><br>
                                        Mis Horas
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('timesheet_create')
                            <li>
                                <a href="{{ route('admin.timesheet-create') }}">
                                    <div>
                                        <i class="bi bi-calendar-plus"></i><br>
                                        Crear Timesheet
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('mi_timesheet_horas_rechazadas_show')
                            <li>
                                <a href="{{ route('admin.timesheet-rechazadas') }}">
                                    <div>
                                        <i class="bi bi-calendar2-x"></i><br>
                                        Horas Rechazadas
                                    </div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
                <div class="tab-pane mb-4 fade" id="nav-liderazgo" role="tabpanel" aria-labelledby="nav-liderazgo-tab">
                    <ul class="mt-4">
                        @can('timesheet_administrador_proyectos_access')
                            <li>
                                <a href="{{ route('admin.timesheet-proyectos') }}">
                                    <div>
                                        <i class="bi bi-list-task"></i><br>
                                        Proyectos
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('timesheet_administrador_tareas_proyectos_access')
                            <li>
                                <a href="{{ route('admin.timesheet-tareas') }}">
                                    <div>
                                        <i class="bi bi-card-list"></i><br>
                                        Tareas
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('timesheet_administrador_aprobar_rechazar_horas_access')
                            <li>
                                <a href="{{ route('admin.timesheet-aprobaciones') }}">
                                    <div>
                                        <i class="bi bi-calendar2-check"></i><br>
                                        Aprobaciones
                                    </div>
                                </a>
                            </li>
                        @endcan
                        @can('timesheet_administrador_clientes_access')
                            <li>
                                <a href="{{ route('admin.timesheet-clientes') }}">
                                    <div>
                                        <i class="bi bi-bag"></i><br>
                                        Clientes
                                    </div>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')

@endsection

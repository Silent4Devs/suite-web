@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('styles')
    <style>
        .nav.nav-tabs {
            background-color: #ffffff00 !important;
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-direction: row;
            flex-wrap: nowrap;
            min-width: 100%;
        }

        .nav.nav-tabs .nav-link,
        .nav.nav-tabs .nav-link.active {
            background-color: #fff !important;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            color: #575757 !important;
            padding-top: 20px !important;
            padding-bottom: 20px !important;
            text-align: center;
            border: 1px solid #ccc !important;
        }

        .nav.nav-tabs .nav-link.active {
            background-color: #DEF9FF !important;
        }

        .nav-tabs .nav-link:not(.nav-link:first-child)::before,
        .line-active-nav {
            display: none;
        }
    </style>
@endsection
@section('content')
    {{ Breadcrumbs::render('timesheet-dashboard') }}

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <h5 class="titulo_general_funcion">
        Timesheet: <font style="font-weight:lighter;">Dashboard</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    <div class="box-caja-cards-times d-flex justify-content-between mb-4" style="gap: 20px; width: 100%; margin:auto;">
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #DFF7FF;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between w-100">
                <strong style="font-size: 16px;">Todos</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['totales'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #DEDEDE;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between w-100">
                <strong style="font-size: 16px;">Borradores</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['borrador_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #FFD7A4;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between w-100">
                <strong style="font-size: 16px;"> Pendientes</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['pendientes_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #E2F6E1;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between w-100">
                <strong style="font-size: 16px;"> Aprobados</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['aprobados_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #F2ADAD;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between w-100">
                <strong style="font-size: 16px;"> Rechazados</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['rechazos_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
    </div>

    <div class="mt-2">
        <nav class="mt-4 d-flex justify-content-center">
            <div class="nav nav-tabs" id="tabsIso27001" role="tablist">
                @can('visualizar_registros_dashboard_timesheet')
                    <a class="nav-link active" id="nav-registros-tab" data-type="registros" data-toggle="tab"
                        href="#nav-registros" role="tab" aria-controls="nav-registros" aria-selected="true">
                        Registros Timesheet
                    </a>
                @endcan
                @can('visualizar_registros_dashboard_empleados_timesheet')
                    <a class="nav-link" id="nav-empleados-tab" data-type="empleados" data-toggle="tab" href="#nav-empleados"
                        role="tab" aria-controls="nav-empleados" aria-selected="false">
                        Empleados
                    </a>
                @endcan
                @can('visualizar_registros_dashboard_proyectos_timesheet')
                    <a class="nav-link" id="nav-proyectos-tab" data-type="proyectos" data-toggle="tab" href="#nav-proyectos"
                        role="tab" aria-controls="nav-proyectos" aria-selected="false">
                        Proyectos
                    </a>
                @endcan
                @can('timesheet_administrador_dashboard_financiero_access')
                    <a class="nav-link" id="nav-financiero-tab" data-type="financiero" data-toggle="tab" href="#nav-financiero"
                        role="tab" aria-controls="nav-financiero" aria-selected="false">
                        Finanzas
                    </a>
                @endcan
            </div>
        </nav>

        <div class="tab-content mt-2" id="nav-tabContent">
            @can('visualizar_registros_dashboard_timesheet')
                <div class="tab-pane mb-4 fade show active" id="nav-registros" role="tabpanel"
                    aria-labelledby="nav-registros-tab">
                    @include('admin.timesheet.dashboard.general')
                </div>
            @endcan
            @can('visualizar_registros_dashboard_empleados_timesheet')
                <div class="tab-pane mb-4 fade" id="nav-empleados" role="tabpanel" aria-labelledby="nav-empleados-tab">
                    @include('admin.timesheet.dashboard.empleados')
                </div>
            @endcan
            @can('visualizar_registros_dashboard_proyectos_timesheet')
                <div class="tab-pane mb-4 fade" id="nav-proyectos" role="tabpanel" aria-labelledby="nav-proyectos-tab">
                    @include('admin.timesheet.dashboard.proyectos')
                </div>
            @endcan
            @can('visualizar_registros_dashboard_proyectos_timesheet')
                <div class="tab-pane mb-4 fade" id="nav-financiero" role="tabpanel" aria-labelledby="nav-financiero-tab">
                    @include('admin.timesheet.dashboard.financiero')
                </div>
            @endcan
        </div>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuActive = localStorage.getItem('menu-iso27001-active');
            $(`#tabsIso27001 [data-type="${menuActive}"]`).tab('show');
            $('#tabsIso27001').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                const keyTab = this.getAttribute('data-type');
                localStorage.setItem('menu-iso27001-active', keyTab);
            });
        });
    </script>
@endsection

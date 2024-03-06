@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('styles')
    <style>
        .col-xl,
        .col-xl-auto,
        .col-xl-12,
        .col-xl-11,
        .col-xl-10,
        .col-xl-9,
        .col-xl-8,
        .col-xl-7,
        .col-xl-6,
        .col-xl-5,
        .col-xl-4,
        .col-xl-3,
        .col-xl-2,
        .col-xl-1,
        .col-lg,
        .col-lg-auto,
        .col-lg-12,
        .col-lg-11,
        .col-lg-10,
        .col-lg-9,
        .col-lg-8,
        .col-lg-7,
        .col-lg-6,
        .col-lg-5,
        .col-lg-4,
        .col-lg-3,
        .col-lg-2,
        .col-lg-1,
        .col-md,
        .col-md-auto,
        .col-md-12,
        .col-md-11,
        .col-md-10,
        .col-md-9,
        .col-md-8,
        .col-md-7,
        .col-md-6,
        .col-md-5,
        .col-md-4,
        .col-md-3,
        .col-md-2,
        .col-md-1,
        .col-sm,
        .col-sm-auto,
        .col-sm-12,
        .col-sm-11,
        .col-sm-10,
        .col-sm-9,
        .col-sm-8,
        .col-sm-7,
        .col-sm-6,
        .col-sm-5,
        .col-sm-4,
        .col-sm-3,
        .col-sm-2,
        .col-sm-1,
        .col,
        .col-auto,
        .col-12,
        .col-11,
        .col-10,
        .col-9,
        .col-8,
        .col-7,
        .col-6,
        .col-5,
        .col-4,
        .col-3,
        .col-2,
        .col-1 {
            padding-left: 0px !important;
            padding-right: 0px !important;
        }

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
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;">Todos</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['totales'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #DEDEDE;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;">Borradores</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['borrador_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #FFD7A4;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;"> Pendientes</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['pendientes_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #E2F6E1;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
                <strong style="font-size: 16px;"> Aprobados</strong>
                <span class="d-flex align-items-center" style="gap: 5px;">
                    <strong style="font-size: 22px"> {{ $counters['aprobados_contador'] }} </strong>
                    <small> Sem </small>
                </span>
            </div>
        </div>
        <div class="card-complement">
            <div class="bg-objet" style="background-color: #F2ADAD;"></div>
            <div class="card-comple-info d-flex align-items-center justify-content-between px-3 w-100">
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

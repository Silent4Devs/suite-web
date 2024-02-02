@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">
@endsection
@section('content')
    {{ Breadcrumbs::render('timesheet-dashboard') }}

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <h5 class="col-12 titulo_general_funcion">
        TimeSheet: <font style="font-weight:lighter;">Dashboard</font>
    </h5>

    @include('admin.timesheet.complementos.cards')
    @include('admin.timesheet.complementos.admin-aprob')
    @include('admin.timesheet.complementos.blue-card-header')
    <div class="mt-5">
        <nav class="mt-4 d-flex justify-content-between">
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

        <div class="tab-content" id="nav-tabContent">
            @can('visualizar_registros_dashboard_timesheet')
                <div class="tab-pane mb-4 fade p-4 show active" id="nav-registros" role="tabpanel"
                    aria-labelledby="nav-registros-tab">
                    @include('admin.timesheet.dashboard.general')
                </div>
            @endcan
            @can('visualizar_registros_dashboard_empleados_timesheet')
                <div class="tab-pane mb-4 fade p-4" id="nav-empleados" role="tabpanel" aria-labelledby="nav-empleados-tab">
                    @include('admin.timesheet.dashboard.empleados')
                </div>
            @endcan
            @can('visualizar_registros_dashboard_proyectos_timesheet')
                <div class="tab-pane mb-4 fade p-4" id="nav-proyectos" role="tabpanel" aria-labelledby="nav-proyectos-tab">
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

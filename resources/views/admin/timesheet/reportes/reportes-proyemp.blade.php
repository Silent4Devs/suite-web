@extends('layouts.admin')
@section('content')
    <style type="text/css">
        #lista_proyectos_tareas li {
            padding-top: 13px;
        }

        @media print {

            #sidebar,
            header,
            .nav-tabs,
            .titulo_general_funcion,
            .breadcrumb {
                display: none !important;
            }

        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <script src="https://unpkg.com/gauge-chart@latest/dist/bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@0.7.0/dist/chartjs-plugin-datalabels.min.js">
    </script>

    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Reporte Registros Colaboradores
            Tareas</font>
    </h5>

    @include('admin.timesheet.complementos.cards')

    @include('admin.timesheet.complementos.blue-card-header')

    @livewire('timesheet.reportes-proyemp')
@endsection

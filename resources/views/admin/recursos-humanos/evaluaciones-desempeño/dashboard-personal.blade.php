@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Dashboard personal </h5>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>
                                <h5 style="color: #306BA9;">Evaluación Trimestral 2023</h5>
                                Nombre de Evaluación
                            </th>
                            <th>
                                Estatus
                            </th>
                            <th>
                                Inicio
                            </th>
                            <th>
                                Finaliza
                            </th>
                            <th>
                                Foto
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <p>Evaluación Trimestral del año 2023</p>
                            </td>
                            <td>
                                En curso
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                10/10/2023
                            </td>
                            <td>
                                <div class="img-person">
                                    <img src="" alt="">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <div class="d-flex w-100">
                    <div class="">
                        <span>Evaluaciones contestadas</span>
                        <div class="progress">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%" aria-valuenow="75"
                                aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <div class="">
                        <span>Avance de la evaluación</span>
                        <p>
                            3/4
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" style="font-size: 18px;">
        <div class="col-md-4">
            <div class="d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #fff; color: #5F6EB9;">
                <div>
                    <strong>Promedio General</strong>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #fff; color: #5F6EB9;">
                <div>
                    <strong>Objetivos</strong>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="d-flex align-items-center justify-content-between p-4 rounded-lg"
                style="background-color: #fff; color: #5F6EB9;">
                <div>
                    <strong>Competencias</strong>
                </div>
                <div>
                    <small>Resultado</small> <strong>75%</strong>
                </div>
            </div>
        </div>

    </div>

    <div class="card card-body mt-3">
        <h5>Resultado por área</h5>
        grahp
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card card-body">
                <h5>Cumplimiento de Objetivos</h5>
                grahp
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-body">
                <h5>Resultado de evaluación por escalas</h5>

                grahp
            </div>
        </div>
    </div>

    <div class="card card-body">
        <h5>Cumplimiento de Competencias</h5>
        graph
    </div>



    <div class="card card-body">
        <div class="datatable-fix">
            <table id="" class="table table-bordered w-100 datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Evaluadores</th>
                        <th>Avance</th>
                        <th>Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td>Evaluadores</td>
                        <td>Avance</td>
                        <td>Actividad</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card card-body">
        <div class="datatable-fix">
            <table id="" class="table table-bordered w-100 datatable">
                <thead class="thead-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Evaluadores</th>
                        <th>Avance</th>
                        <th>Actividad</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Nombre</td>
                        <td>Evaluadores</td>
                        <td>Avance</td>
                        <td>Actividad</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];


            let dtOverrideGlobals = {
                buttons: dtButtons,
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.datatable').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

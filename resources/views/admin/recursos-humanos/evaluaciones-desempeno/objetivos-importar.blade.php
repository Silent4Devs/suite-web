@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Objetivos: Importar </h5>

    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Selecciona al colaborador del cual quieras importar sus objetivos</h4>
            <hr class="my-4">
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" disabled selected>Área</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" disabled selected>Puesto</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" disabled selected>Perfil</option>
                </select>
            </div>
            <div class="col-md-3 form-group">
                <select name="" id="" class="form-control">
                    <option value="" disabled selected>Colaborador</option>
                </select>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 form-group anima-focus">
                <input type="text" name="" id="" class="form-control">
                <label for="">Buscar Objetivo</label>
            </div>
        </div>
    </div>

    <div class="card card-body">
        <div class="info-first-config">
            <h4 class="title-config">Objetivos de: Zaid Arath García Hernández</h4>
            <hr class="my-4">
        </div>

        <div class="datatable-fix">
            <table class="table datatable">
                <thead>
                    <tr>
                        <th>Categoría</th>
                        <th>Objetivos Estratégicos</th>
                        <th>Descripción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Categoría</td>
                        <td>Objetivos Estratégicos</td>
                        <td>Descripción</td>
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
            let table = $('.table').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

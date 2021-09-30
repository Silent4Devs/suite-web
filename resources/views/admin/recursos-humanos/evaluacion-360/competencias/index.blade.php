@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Competencias') }}
    </div>
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Competencias</strong></h3>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 tblCompetencias">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            ID
                        </th>
                        <th style="vertical-align: top">
                            Nombre
                        </th>
                        <th style="vertical-align: top">
                            Tipo
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>

                </thead>
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
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        // doc.styles.tableHeader.fontSize = 6.5;
                        // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
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
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar competencia',
                url: "{{ route('admin.ev360-competencias.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-competencias.index') }}",
                columns: [{
                        data: 'id'
                    }, {
                        data: 'nombre'
                    }, {
                        data: 'tipo',
                        render: function(data, type, row, meta) {
                            return data.nombre;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlBtnEditar =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}/edit`;
                            // let urlBtnEvaluacionEstatus =
                            //     `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}/evaluacion`;
                            let urlBtnVisualizar =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}`;
                            let urlBtnEliminar =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}`;
                            //let urlBtnVinc

                            let botones = `
                                <a class="btn btn-sm btn-editar" title="Editar" href="${urlBtnEditar}"><i class="fas fa-edit"></i></a>
                                <a class="btn btn-sm btn-editar" title="Visualizar" href="${urlBtnVisualizar}"><i class="fas fa-eye"></i></a>
                                <button class="btn btn-sm btn-eliminar text-danger" title="Eliminar" onclick="event.preventDefault();Eliminar('${urlBtnEliminar}')"><i class="fas fa-trash-alt"></i></button>
                            `;
                            return botones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.tblCompetencias').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

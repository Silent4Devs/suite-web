@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Objetivos') }}
    </div>
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Objetivos</strong></h3>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="px-1 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                            asigne los objetivos definidos a cada uno de los colaboradores de la organización <small
                                class="text-muted">(Consulte los objetivos con el jefe inmediato de cada
                                colaborador)</small></p>
                    </div>
                </div>
            </div>
            <table class="table table-bordered w-100 tblObjetivos">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            ID
                        </th>
                        <th style="vertical-align: top">
                            Nombre
                        </th>
                        <th style="vertical-align: top">
                            Puesto
                        </th>
                        <th style="vertical-align: top">
                            Área
                        </th>
                        <th style="vertical-align: top">
                            Perfil
                        </th>
                        <th style="vertical-align: top">
                            Cantidad Objetivos
                        </th>
                        <th style="vertical-align: top">
                            Asignar
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
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Objetivos ${new Date().toLocaleDateString().trim()}`,
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
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-objetivos.index') }}",
                columns: [{
                        data: 'id'
                    }, {
                        data: 'name'
                    }, {
                        data: 'puesto',
                    }, {
                        data: 'area.area',
                    }, {
                        data: 'perfil.nombre',
                    },
                    {
                        data: 'objetivos',
                        render: function(data, type, row, meta) {
                            if (data.length > 0) {
                                if (data.length == 1) {
                                    return `<span class="badge badge-primary">${data.length} asignado</span>`;
                                } else {
                                    return `<span class="badge badge-primary">${data.length} asignados</span>`;
                                }
                            } else {
                                return `<span class="badge badge-dark">Sin asignar</span>`;
                            }
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlAsignar =
                                `/admin/recursos-humanos/evaluacion-360/${data}/objetivos`;
                            let html = `
                            <div class="btn-group">
                                <a href="${urlAsignar}" title="Editar" class="btn btn-sm"><i class="fas fa-sync-alt"></i></a>
                            </div>
                            `;
                            return html;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.tblObjetivos').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

@extends('layouts.admin')
@section('content')

        <div class="mt-3">
            {{ Breadcrumbs::render('EV360-EntidadesCrediticeas') }}
        </div>

        <h5 class="col-12 titulo_general_funcion">Entidades crediticias</h5>
        <div class="text-right">
            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.entidades-crediticias.create') }}" type="button" class="btn btn-primary">Registrar Entidad crediticia</a>
            </div>
        </div>
        @include('partials.flashMessages')
        <div class="datatable-fix datatable-rds">
            <h3 class="title-table-rds"> Entidades crediticias</h3>
            <table class="datatable tblEntidadesCrediticias" id="tblEntidadesCrediticias">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            ID
                        </th>
                        <th style="vertical-align: top">
                            Entidad
                        </th>
                        <th style="vertical-align: top">
                            Descripción
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Entidades Crediticias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Entidades Crediticias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Entidades Crediticias ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Entidades Crediticias ${new Date().toLocaleDateString().trim()}`,
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
                ajax: "{{ route('admin.entidades-crediticias.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'entidad',
                        name: 'entidad'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row, meta) {
                            if (data) {
                                if (data.length > 50) {
                                    return `${data.substr(0, 50)}...`;
                                }
                                return `${data.substr(0, 50)}`;
                            }
                            return "Sin descripción"
                        }
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }

                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };

            let table = $('.tblEntidadesCrediticias').DataTable(dtOverrideGlobals);

            window.Eliminar = function(boton, url, modelo_id, tipo) {

                Swal.fire({
                    title: '¿Estás seguro de eliminar?',
                    text: `Eliminarás la entidad crediticia: ${tipo}`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        try {
                            const response = await fetch(url, {
                                method: 'DELETE',
                                headers: {
                                    Accept: "application/json",
                                    "Content-Type": "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        "content"),
                                },
                            });
                            toastr.success('Registro eliminado')
                            table.ajax.reload();
                        } catch (error) {
                            toastr.error('Ocurrió un error: ' + error)
                        }
                    }
                })

            }
        });
    </script>
@endsection

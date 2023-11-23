@extends('layouts.admin')
@section('content')
    @can('procesos_agregar')
        <h5 class="col-12 titulo_general_funcion">Procesos</h5>

        <div class="mt-5 card">
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Procesos</strong></h3>

            </div> --}}
        @endcan
        <div class="card-body datatable-fix">
            <table class="table table-bordered tbl-categorias w-100">
                <thead class="thead-dark">
                    <tr>
                        <th></th>
                        <th>
                        </th>
                        <th class="estilotd contratos-table">Codigo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </th>
                        <th>
                            Nombre&nbsp;del&nbsp;proceso
                        </th>

                        <th class="estilotd contratos-table">Macroproceso&nbsp;
                        </th>
                        <th>
                            Descripción
                        </th>
                        <th>
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
                    title: `Procesos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Procesos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Procesos ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Procesos ${new Date().toLocaleDateString().trim()}`,
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

            @can('procesos_agregar')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar proceso',
                    url: "{{ route('admin.procesos.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                dtButtons.push(btnAgregar);
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.procesos.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        visible: false
                    }, {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'codigo',
                        name: 'codigo'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre',
                        render: function(data, type, row) {
                            // return data with justify left
                            return `<div style="text-align:left">${data}</div>`;

                        }
                    },
                    {
                        data: 'macroproceso',
                        name: 'macroproceso',
                        render: function(data, type, row) {
                            // return data with justify left
                            return `<div style="text-align:left">${data}</div>`;

                        }
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row) {
                            // return data with justify left
                            let descripcion = `${data.substring(0, 100)}...`;
                            if (data.length <= 100) {
                                descripcion = data;
                            }
                            return `<div style="text-align:justify">${descripcion}</div>`;

                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            //create buttons for show, edit, delete
                            let buttons = `
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    @can('procesos_ver')
                                    <a href="{{ route('admin.procesos.show', ':id') }}" class="btn rounded-0" title="Ver"><i class="fas fa-eye"></i></a>
                                    @endcan
                                    @can('procesos_editar')
                                    <a href="{{ route('admin.procesos.edit', ':id') }}" class="btn rounded-0" title="Ver"><i class="fas fa-edit"></i></a>
                                    @endcan
                                    @can('procesos_eliminar')
                                   ${row.documento_id==null?` <button onclick="Eliminar(this)" data-url="{{ route('admin.procesos.destroy', ':id') }}" class="btn rounded-0 text-danger" title="Ver"><i class="fas fa-trash-alt"></i></button>`:''}
                                   @endcan
                                </div>
                            `;
                            buttons = buttons.replaceAll(':id', data);
                            return buttons;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.tbl-categorias').DataTable(dtOverrideGlobals);
            window.Eliminar = (e) => {
                let url = $(e).data('url');
                Swal.fire({
                    title: '¿Estás seguro?',
                    text: "¡No podrás revertir esto!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}'
                            },
                            success: function(data) {
                                if (data.success) {
                                    Swal.fire(
                                        'Eliminado!',
                                        'El proceso ha sido eliminado.',
                                        'success'
                                    ).then().then(() => {
                                        table.ajax.reload();
                                    });
                                }
                            }
                        });
                    }
                });
            }
        });
    </script>
@endsection

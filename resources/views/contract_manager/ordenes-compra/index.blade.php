@extends('layouts.admin')
@section('content')
    <style>
        .table tr td:nth-child(1) {
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            min-width: 200px !important;
        }

    </style>
     @include('flash::message')
     @include('partials.flashMessages')
    <h5 class="col-12 titulo_general_funcion">Orden De Compra</h5>
    <div class="mt-5 card">

        <div class="card-body datatable-fix">

            <table class="table table-bordered w-100 datatable-Requisiciones">
                <thead class="thead-dark">
                    <tr>

                        <th style="vertical-align: top">Folio</th>
                        <th style="vertical-align: top">Fecha De Solicitud</th>
                        <th style="vertical-align: top">Referencia</th>
                        <th style="vertical-align: top">Producto</th>
                        <th style="vertical-align: top">Proveedor</th>
                        <th style="vertical-align: top">Estatus</th>
                        <th style="vertical-align: top">Proyecto</th>
                        <th style="vertical-align: top">Área que Solicita</th>
                        <th style="vertical-align: top">Solicitante</th>
                        <th style="vertical-align: top">Opciones</th>

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
                    title: `Proveedores ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Proveedores ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Proveedores ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Proveedores ${new Date().toLocaleDateString().trim()}`,
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
                let archivarButton = {
                    text: 'Archivar Registro',
                    url: "",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).data(), function(entry) {
                            return entry.id
                        });

                        if (ids.length === 0) {
                            alert('undefine')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'POST'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: {
                    url: "{{ route('contract_manager.orden-compra.getRequisicionIndex') }}",
                    type: 'POST',
                    data: {
                        _token: _token
                    }
                },
                columns: [
                    {
                        data: 'folio',
                        name: 'folio'
                    },
                    {
                        data: 'fecha',
                        name: 'fecha'
                    },
                    {
                        data: 'referencia',
                        name: 'referencia'
                    },
                    {
                        data: 'producto_id',
                        name: 'producto_id'
                    },
                    {
                        data: 'proveedor_catalogo',
                        name: 'proveedor_catalogo'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'contrato_id',
                        name: 'contrato_id'
                    },
                    {
                        data: 'area',
                        name: 'area'
                    },
                    {
                        data: 'user',
                        name: 'user'
                    },
                    {
                        data: 'id',
                        name: 'actions',
                        render: function(data, type, row, meta) {
                            let requisiciones = @json($requisiciones);
                            let urlButtonArchivar = `/contract_manager/orden-compra/archivar/${data}`;
                            let urlButtonEdit = `/contract_manager/orden-compra/${data}/edit`;
                            let htmlBotones =
                                `
                                <div class="btn-group">
                                    <a href="${urlButtonEdit}" class="btn btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                    <a title="Archivar" class="btn btn-sm text-blue"  onclick="Archivar('${urlButtonArchivar}','${row.nombre}');"> <i class="fa-solid fa-box-archive"></i></a>
                                </div>

                            `;
                            return htmlBotones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('.datatable-Requisiciones').DataTable(dtOverrideGlobals);

            window.Archivar = function(url, nombre) {
                Swal.fire({
                    title: `¿Estás seguro de archivar el siguiente registro?`,
                    html: `<strong><i class="mr-2 fas fa-exclamation-triangle"></i>${nombre}</strong>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, archivar!',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            headers: {
                                'x-csrf-token': $('meta[name="csrf-token"]').attr('content')
                            },
                            url: url,
                            beforeSend: function() {
                                Swal.fire(
                                    '¡Estamos Archivar!',
                                    `El proveedor: ${nombre} está siendo archivado`,
                                    'info'
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Archivando!',
                                    `El proveedor: ${nombre} ha sido archivado`,
                                    'success'
                                )
                                table.ajax.reload();
                            },
                            error: function(error) {
                                console.log(error);
                                Swal.fire(
                                    'Ocurrió un error',
                                    `Error: ${error.responseJSON.message}`,
                                    'error'
                                )
                            }
                        });
                    }
                })
            }

        });
    </script>
@endsection

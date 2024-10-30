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

    @include('partials.flashMessages')
    <h5 class="col-12 titulo_general_funcion">Orden De Compra</h5>
    <div class="text-right">
        <button type="button" class="btn  tb-btn-primary" id="filtrarBtn4">Aprobadores</button>
    </div>
    <div class="mt-5 card">
        <div class="card-body datatable-fix">

            <table class="table w-100 datatable-Requisiciones">
                <thead class="">
                    <tr>

                        <th style="vertical-align: top">Folio</th>
                        <th style="vertical-align: top">Fecha De Solicitud</th>
                        <th style="vertical-align: top">Referencia</th>
                        <th style="vertical-align: top">Proveedor</th>
                        <th style="vertical-align: top">Estatus</th>
                        <th style="vertical-align: top">No. Proyecto</th>
                        <th style="vertical-align: top">Proyecto</th>
                        <th style="vertical-align: top">Área que Solicita</th>
                        <th style="vertical-align: top">Solicitante</th>
                        <th style="vertical-align: top">SUBTOTAL</th>
                        <th style="vertical-align: top">IVA</th>
                        <th style="vertical-align: top">Total</th>
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
        function mostrarAlerta3(url, id) {
            let titleText =
                '¿Está seguro de cancelar la orden de compra OC-' + id +
                '?';

            Swal.fire({
                title: titleText,
                text: 'No podrás deshacer esta acción',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Realizar la solicitud AJAX usando fetch
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                id: id
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('¡Cancelado!', 'La Orden de Compra ha sido cancelada.', 'success')
                                    .then(
                                        () => {
                                            window.location.reload(); // Refresca la página
                                        });
                            } else {
                                Swal.fire('Error',
                                    'No se pudo cancelar la orden de compra. Inténtelo de nuevo.',
                                    'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error', 'Hubo un problema al procesar la solicitud.', 'error');
                            console.error('Error:', error);
                        });
                }
            });
        }
    </script>

    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Ordenes_Compra ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] // Include indexes of all columns
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Ordenes_Compra ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] // Include indexes of all columns
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     title: `Ordenes_Compra ${new Date().toLocaleDateString().trim()}`,
                //     text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                //     className: "btn-sm rounded pr-2",
                //     titleAttr: 'Exportar PDF',
                //     orientation: 'landscape',
                //     exportOptions: {
                //         columns: [0, 1, 2, 3, 4, 6, 7, 8]
                //     },
                //     customize: function(doc) {
                //         doc.pageMargins = [5, 20, 5, 20];
                //         // doc.styles.tableHeader.fontSize = 6.5;
                //         // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                //     }
                // },
                {
                    extend: 'print',
                    title: `Ordenes_Compra ${new Date().toLocaleDateString().trim()}`,
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
                    url: "{{ route('contract_manager.orden-compra.getOCIndex') }}",
                    type: 'POST',
                    data: {
                        _token: _token
                    }
                },
                columns: [{
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
                        data: 'proveedor_catalogo_oc',
                        render: function(data, type, row) {
                            // Verifica si 'data' es null o undefined
                            if (data === null || typeof data === 'undefined') {
                                // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
                                if (row.proveedores_requisiciones && row.proveedores_requisiciones
                                    .length > 0) {
                                    return row.proveedores_requisiciones[0].contacto;
                                } else {
                                    return 'Pendiente';
                                }
                            } else {
                                return data; // Valor no es null ni undefined
                            }
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            var firma_solicitante = row.firma_solicitante_orden;
                            var firma_comprador = row.firma_comprador_orden;
                            var firma_finanzas = row.firma_finanzas_orden;
                            var estatus = row.estado_orden;

                            if (row.estado_orden == 'cancelada') {
                                return '<h5><span class="badge badge-pill badge-danger">Cancelada</span></h5>';
                            } else if (estatus == "rechazado_oc") {
                                return '<h5><span class="badge badge-pill badge-danger">Rechazado</span></h5>';
                            } else {
                                if (!firma_solicitante && !firma_comprador && !firma_finanzas) {
                                    return '<h5><span class="badge badge-pill badge-primary">Por iniciar</span></h5>';
                                } else if (firma_solicitante && firma_comprador && firma_finanzas) {
                                    return '<h5><span class="badge badge-pill badge-success">Firmada</span></h5>';
                                } else {
                                    return '<h5><span class="badge badge-pill badge-info">En curso</span></h5>';
                                }
                            }
                        }
                    },
                    {
                        data: 'contrato.no_contrato',
                        name: 'contrato.no_contrato',
                        render: function(data, type, row) {
                            // Verifica si 'data' es null o una cadena vacía
                            if (data == null || data == "") {
                                return '<span class="error">Campo Vacío</span>'; // Mensaje de error o cómo deseas mostrar la validación
                            } else {
                                return data; // Valor no es null ni vacío
                            }
                        }
                    },
                    {
                        data: 'contrato.nombre_servicio',
                        name: 'contrato.nombre_servicio',
                        render: function(data, type, row) {
                            // Verifica si 'data' es null o una cadena vacía
                            if (data == null || data == "") {
                                return '<span class="error">Campo Vacío</span>'; // Mensaje de error o cómo deseas mostrar la validación
                            } else {
                                return data; // Valor no es null ni vacío
                            }
                        }
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
                        data: 'sub_total',
                        name: 'sub_total',
                        visible: false
                    },
                    {
                        data: 'iva',
                        name: 'iva',
                        visible: false
                    },
                    {
                        data: 'total',
                        name: 'total',
                        visible: false
                    },
                    {
                        data: 'id',
                        name: 'actions',
                        render: function(data, type, row, meta) {
                            let urlButtonArchivar = `/contract_manager/orden-compra/archivar/${data}`;
                            let urlButtonRellenar = `/contract_manager/orden-compra/${data}/edit`;
                            let urlButtonShow = `/contract_manager/orden-compra/show/${data}`;
                            let urlButtonEditar =
                                `/contract_manager/orden-compra/${data}/editar-orden-compra`;
                            let urlButtonCancelar =
                                `/contract_manager/orden-compra/${data}/cancelarOrdenCompra`;
                            let htmlBotones = '<div class="btn-group">';

                            if (row.firma_comprador_orden === null && row.estado_orden != 'cancelada' &&
                                row.contador_version_orden_compra == 3) {
                                // Si el campo es null, se muestra el botón de edición
                                htmlBotones += `@can('katbol_ordenes_compra_modificar')
                                                <a href="${urlButtonRellenar}" class="btn btn-sm" title="Ingresar Información"><i class="fas fa-edit"></i></a>
                                                @endcan`;
                            }

                            if (row.estado_orden == 'cancelada') {
                                htmlBotones += `<a href="${urlButtonEditar}" >
                                <i class = "fas fa-pen" ></i></a >`;
                            }

                            if (row.estado_orden == 'curso') {
                                htmlBotones += `<a onclick="mostrarAlerta3('${urlButtonCancelar}', ${data})" >
                                <i class = "fa-regular fa-rectangle-xmark" > </i></a >`;
                            }

                            // Agrega el botón para ver/imprimir independientemente del estado del campo 'firma_comprador_orden'
                            htmlBotones += `<a href="${urlButtonShow}" title="Ver/Imprimir" class="btn btn-sm"><i class="fa-solid fa-print"></i></a>
                                            </div>`;

                            return htmlBotones;

                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                columnDefs: [{
                    targets: [9, 10, 11], // Indexes of columns SUBTOTAL and IVA
                    visible: false, // Hide the columns on the webpage
                    searchable: false // Exclude the columns from searching
                }]
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
                                    `La orden de compra: ${nombre} está siendo archivado`,
                                    'info'
                                )
                            },
                            success: function(response) {
                                Swal.fire(
                                    'Archivando!',
                                    `La orden de compra: ${nombre} ha sido archivado`,
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
    <script>
        $(document).ready(function() {
            $('#filtrarBtn4').click(function() {
                window.location.href = "{{ route('contract_manager.orden-compra.indexAprobadores') }}";
            });
        });
    </script>
@endsection

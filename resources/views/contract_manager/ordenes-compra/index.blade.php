@extends('layouts.admin')
@section('content')
    <style>
        .table tr td:nth-child(1) {
            min-width: 200px !important;
        }

        .table tr td:nth-child(4) {
            min-width: 200px !important;
        }

        #form_id {
            display: none;
        }
    </style>

    @include('partials.flashMessages')
    <h5 class="col-12 titulo_general_funcion">Orden De Compra</h5>
    <div class="text-right">
        <button type="button" class="btn  tb-btn-primary" id="filtrarBtn4">Aprobadores</button>
    </div>
    <div class="mt-5 card">
        <div class="card-body">
            <div class="datatable-rds w-100">
                <table class="table datatable-Requisiciones w-100 tblCSV" id="datatable-Requisiciones">
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
                            <th style="display:none">SUBTOTAL</th>
                            <th style="display:none">IVA</th>
                            <th style="display:none">Total</th>
                            <th style="vertical-align: top">Opciones</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requisiciones as $keyReq => $req)
                            <tr>
                                <td>{{ $req->folio }}</td>
                                <td>{{ $req->fecha }}</td>
                                <td>{{ $req->referencia }}</td>
                                <td>
                                    @php
                                        $dataProv = $req->proveedor_catalogo_oc;
                                    @endphp

                                    @if (is_null($dataProv))
                                        <!-- Blade usa `is_null` para verificar null -->
                                        {{-- Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto --}}
                                        @if (!empty($req->proveedores_requisiciones) && count($req->proveedores_requisiciones) > 0)
                                            {{ $req->proveedores_requisiciones[0]->contacto }}
                                        @else
                                            <p>Pendiente</p>
                                        @endif
                                    @else
                                        {{ $dataProv }} {{-- Valor no es null --}}
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $firma_solicitante = $req->firma_solicitante_orden;
                                        $firma_comprador = $req->firma_comprador_orden;
                                        $firma_finanzas = $req->firma_finanzas_orden;
                                        $estatus = $req->estado_orden;
                                    @endphp

                                    @if ($estatus == 'cancelada')
                                        <h5><span class="badge badge-pill badge-danger">Cancelada</span></h5>
                                    @elseif ($estatus == 'rechazado_oc')
                                        <h5><span class="badge badge-pill badge-danger">Rechazado</span></h5>
                                    @else
                                        @if (!$firma_solicitante && !$firma_comprador && !$firma_finanzas)
                                            <h5><span class="badge badge-pill badge-primary">Por iniciar</span></h5>
                                        @elseif ($firma_solicitante && $firma_comprador && $firma_finanzas)
                                            <h5><span class="badge badge-pill badge-success">Firmada</span></h5>
                                        @else
                                            <h5><span class="badge badge-pill badge-info">En curso</span></h5>
                                        @endif
                                    @endif

                                </td>
                                <td>
                                    @php
                                        $n_contrato = $req->contrato->no_contrato ?? null;
                                    @endphp

                                    @if (empty($n_contrato))
                                        <span class="error">Campo Vacío</span> <!-- Mensaje cuando no hay datos -->
                                    @else
                                        {{ $n_contrato }} <!-- Muestra el valor cuando no es vacío -->
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $nombre_servicio = $req->contrato->nombre_servicio ?? null;
                                    @endphp

                                    @if (empty($nombre_servicio))
                                        <span class="error">Campo Vacío</span> <!-- Mensaje cuando no hay datos -->
                                    @else
                                        {{ $nombre_servicio }} <!-- Muestra el valor cuando no es vacío -->
                                    @endif
                                </td>
                                <td>{{ $req->area }}</td>
                                <td>{{ $req->user }}</td>
                                <td style="display: none">{{ $req->sub_total }}</td>
                                <td style="display: none">{{ $req->iva }}</td>
                                <td style="display: none">{{ $req->total }}</td>
                                @php
                                    $data = $req->id;
                                    $urlButtonArchivar = url("/contract_manager/orden-compra/archivar/{$data}");
                                    $urlButtonRellenar = url("/contract_manager/orden-compra/{$data}/edit");
                                    $urlButtonShow = url("/contract_manager/orden-compra/show/{$data}");
                                    $urlButtonEditar = url(
                                        "/contract_manager/orden-compra/{$data}/editar-orden-compra",
                                    );
                                    $urlButtonCancelar = url(
                                        "/contract_manager/orden-compra/{$data}/cancelarOrdenCompra",
                                    );
                                @endphp

                                <td>
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fa-solid fa-ellipsis-vertical" style="color: #000000;"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                                            @if (is_null($req->firma_comprador_orden) &&
                                                    $req->estado_orden != 'cancelada' &&
                                                    $req->contador_version_orden_compra == 3)
                                                @can('katbol_ordenes_compra_modificar')
                                                    <a href="{{ $urlButtonRellenar }}" class="dropdown-item"
                                                        title="Ingresar Información">
                                                        <i class="fas fa-edit"></i> Ingresar Información
                                                    </a>
                                                @endcan
                                            @endif

                                            @if ($req->estado_orden == 'cancelada' || $req->estado_orden == 'rechazado')
                                                <a href="{{ $urlButtonEditar }}" class="dropdown-item"
                                                    title="Editar Orden Cancelada">
                                                    <i class="fas fa-pen"></i> Editar Orden Cancelada
                                                </a>
                                            @endif

                                            @if ($req->estado_orden == 'curso' || $req->estado_orden == 'fin')
                                                <a href="#"
                                                    onclick="mostrarAlerta3('{{ $urlButtonCancelar }}', {{ $data }})"
                                                    class="dropdown-item" title="Cancelar Orden">
                                                    <span class="material-symbols-outlined">cancel</span> Cancelar Orden
                                                </a>
                                            @endif

                                            <a href="{{ $urlButtonShow }}" title="Ver/Imprimir" class="dropdown-item">
                                                <i class="fa-solid fa-print"></i> Ver/Imprimir
                                            </a>
                                        </div>
                                    </div>
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <form method="GET" id="form_id" style="position: relative; left: 10rem; " action="{{ route('orden-compra.excel') }}">
        <button class="boton-transparentev2" type="submit" style="color: var(--color-tbj);">
            IMPRIMIR <img src="{{ asset('imprimir.svg') }}" alt="Importar" class="icon">
        </button>
    </form>

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
                                Swal.fire('¡Cancelado!', 'La orden de compra ha sido cancelada.', 'success')
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
        console.log('Entra funcion');
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
                        columns: ['th:not(:last-child):visible']
                    },
                    action: function(e, dt, button, config) {
                        document.getElementById('form_id').submit();
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

            console.log('antes de la tabla');
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: false,
                retrieve: true,
                aaSorting: [],
                // ajax: {
                //     url: "{{ route('contract_manager.orden-compra.get-oc-index') }}",
                //     type: 'POST',
                //     data: {
                //         _token: _token
                //     }
                // },
                // columns: [{
                //         data: 'folio',
                //         name: 'folio'
                //     },
                //     {
                //         data: 'fecha',
                //         name: 'fecha'
                //     },
                //     {
                //         data: 'referencia',
                //         name: 'referencia'
                //     },
                //     {
                //         data: 'proveedor_catalogo_oc',
                //         render: function(data, type, row) {
                //             // Verifica si 'data' es null o undefined
                //             if (data === null || typeof data === 'undefined') {
                //                 // Verifica si 'proveedores_requisiciones' está definido y tiene al menos un contacto
                //                 if (row.proveedores_requisiciones && row.proveedores_requisiciones
                //                     .length > 0) {
                //                     return row.proveedores_requisiciones[0].contacto;
                //                 } else {
                //                     return 'Pendiente';
                //                 }
                //             } else {
                //                 return data; // Valor no es null ni undefined
                //             }
                //         }
                //     },
                //     {
                //         data: null,
                //         render: function(data, type, row) {
                //             var firma_solicitante = row.firma_solicitante_orden;
                //             var firma_comprador = row.firma_comprador_orden;
                //             var firma_finanzas = row.firma_finanzas_orden;
                //             var estatus = row.estado_orden;

                //             if (row.estado_orden == 'cancelada') {
                //                 return '<h5><span class="badge badge-pill badge-danger">Cancelada</span></h5>';
                //             } else if (estatus == "rechazado_oc") {
                //                 return '<h5><span class="badge badge-pill badge-danger">Rechazado</span></h5>';
                //             } else {
                //                 if (!firma_solicitante && !firma_comprador && !firma_finanzas) {
                //                     return '<h5><span class="badge badge-pill badge-primary">Por iniciar</span></h5>';
                //                 } else if (firma_solicitante && firma_comprador && firma_finanzas) {
                //                     return '<h5><span class="badge badge-pill badge-success">Firmada</span></h5>';
                //                 } else {
                //                     return '<h5><span class="badge badge-pill badge-info">En curso</span></h5>';
                //                 }
                //             }
                //         }
                //     },
                //     {
                //         data: 'contrato.no_contrato',
                //         name: 'contrato.no_contrato',
                //         render: function(data, type, row) {
                //             // Verifica si 'data' es null o una cadena vacía
                //             if (data == null || data == "") {
                //                 return '<span class="error">Campo Vacío</span>'; // Mensaje de error o cómo deseas mostrar la validación
                //             } else {
                //                 return data; // Valor no es null ni vacío
                //             }
                //         }
                //     },
                //     {
                //         data: 'contrato.nombre_servicio',
                //         name: 'contrato.nombre_servicio',
                //         render: function(data, type, row) {
                //             // Verifica si 'data' es null o una cadena vacía
                //             if (data == null || data == "") {
                //                 return '<span class="error">Campo Vacío</span>'; // Mensaje de error o cómo deseas mostrar la validación
                //             } else {
                //                 return data; // Valor no es null ni vacío
                //             }
                //         }
                //     },
                //     {
                //         data: 'area',
                //         name: 'area'
                //     },
                //     {
                //         data: 'user',
                //         name: 'user'
                //     },
                //     {
                //         data: 'sub_total',
                //         name: 'sub_total',
                //         visible: false
                //     },
                //     {
                //         data: 'iva',
                //         name: 'iva',
                //         visible: false
                //     },
                //     {
                //         data: 'total',
                //         name: 'total',
                //         visible: false
                //     },
                //     {
                //         data: 'id',
                //         name: 'actions',
                //         render: function(data, type, row, meta) {
                //             let urlButtonArchivar = `/contract_manager/orden-compra/archivar/${data}`;
                //             let urlButtonRellenar = `/contract_manager/orden-compra/${data}/edit`;
                //             let urlButtonShow = `/contract_manager/orden-compra/show/${data}`;
                //             let urlButtonEditar =
                //                 `/contract_manager/orden-compra/${data}/editar-orden-compra`;
                //             let urlButtonCancelar =
                //                 `/contract_manager/orden-compra/${data}/cancelarOrdenCompra`;
                //             let htmlBotones = '<div class="btn-group">';

                //             if (row.firma_comprador_orden === null && row.estado_orden != 'cancelada' &&
                //                 row.contador_version_orden_compra == 3) {
                //                 // Si el campo es null, se muestra el botón de edición
                //                 htmlBotones += `@can('katbol_ordenes_compra_modificar')
            //                                 <a href="${urlButtonRellenar}" class="btn btn-sm" title="Ingresar Información"><i class="fas fa-edit"></i></a>
            //                                 @endcan`;
                //             }

                //             if (row.estado_orden == 'cancelada') {
                //                 htmlBotones += `<a href="${urlButtonEditar}" >
            //                 <i class = "fas fa-pen" ></i></a >`;
                //             }

                //             if (row.estado_orden == 'curso') {
                //                 htmlBotones += `<a onclick="mostrarAlerta3('${urlButtonCancelar}', ${data})" >
            //                 <i class = "fa-regular fa-rectangle-xmark" > </i></a >`;
                //             }

                //             // Agrega el botón para ver/imprimir independientemente del estado del campo 'firma_comprador_orden'
                //             htmlBotones += `<a href="${urlButtonShow}" title="Ver/Imprimir" class="btn btn-sm"><i class="fa-solid fa-print"></i></a>
            //                             </div>`;

                //             return htmlBotones;

                //         }
                //     }
                // ],
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

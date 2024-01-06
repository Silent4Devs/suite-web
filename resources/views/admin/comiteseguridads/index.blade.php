@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.comiteseguridads.index') }}
    @can('comformacion_comite_seguridad_agregar')
        <h5 class="col-12 titulo_general_funcion">Conformación del Comité</h5>
        <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.comiteseguridads.create') }}" type="button" class="btn btn-primary">Registrar Comité</a>
                </div>
        </div>
                @include('partials.flashMessages')
                <div class="datatable-fix datatable-rds">
                    <h3 class="title-table-rds"> Comites</h3>
                    @include('admin.comiteseguridads.table')
                </div>
    @endcan
@endsection
@section('scripts')
    @parent
    <script>
        $('#btnImport').on('click', function(e) {
        e.preventDefault();
        $('#xlsxImportModal').modal('show');
     });
    </script>
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'print',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                            <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">CONFORMACIÓN DEL COMITÉ</strong>
                                </div>
                                <div class="col-3 p-2">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
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
            @can('comformacion_comite_seguridad_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.comiteseguridads.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).data(), function(entry) {
                            return entry.id
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

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
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                //dtButtons.push(deleteButton)
            @endcan
            @can('comformacion_comite_seguridad_agregar')
                let btnExport = {
                    text: '<i class="fas fa-download"></i>',
                    titleAttr: 'Descargar plantilla',
                    className: "btn btn_cargar",
                    url: "{{ route('descarga-comite_seguridad') }}",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
                let btnImport = {
                    text: '<i class="fas fa-file-upload"></i>',
                    titleAttr: 'Importar datos',
                    className: "btn btn_cargar",
                    action: function(e, dt, node, config) {
                        $('#xlsxImportModal').modal('show');
                    }
                };
                dtButtons.push(btnExport);
                dtButtons.push(btnImport);
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.comiteseguridads.index') }}",
                columns: [{
                        data: 'nombre_comite',
                        name: 'nombre_comite',
                        render: function(data, type, row) {
                            return `<div style="text-align:left">${data}</div>`;
                        }
                    },
                    {
                            data: 'miembros',
                            name: 'miembros',
                            render: function (data, type, row, meta) {
                                let miembros = data;

                                if (type === "miembroText") {
                                    let miembrosTexto = "";
                                    miembros.slice(0, 3).forEach(miembro => {
                                        miembrosTexto += `${miembro.name}, `;
                                    });
                                    return miembrosTexto.trim();
                                } else {
                                    let html = '<div style="display: flex; align-items: center;">'; // Contenedor flexbox con alineación vertical centrada
                                    const maxVisibleImages = 3;

                                    miembros.slice(0, maxVisibleImages).forEach(miembro => {
                                        html += `
                                            <div style="width: 30px; height: 30px; overflow: hidden; border-radius: 50%; margin-right: 5px;">
                                                <img src="{{ asset('storage/empleados/imagenes/') }}/${miembro.avatar}"
                                                    class="rounded-circle" alt="${miembro.name}"
                                                    title="${miembro.name}" style="width: 100%; height: 100%; object-fit: cover;">
                                            </div>
                                        `;
                                    });

                                    if (miembros.length > maxVisibleImages) {
                                        // Si hay más de tres imágenes, mostrar el botón de más
                                        html += `
                                        <button type="button" class="btn btn-xs rounded-circle" data-toggle="modal" data-target="#miembrosModal" style="background-color: #f7f3d2; width: 20px; height: 20px; font-size: 10px; line-height: 14px; border: none; border-radius: 50%;">
                                            +3
                                        </button>
                                        `;

                                        // Modal con las imágenes adicionales
                                        html += `
                                                <div class="modal fade" id="miembrosModal" tabindex="-1" role="dialog" aria-labelledby="miembrosModalLabel" aria-hidden="true">
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <br>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 30px; color: #ffffff; position: relative; right: 24rem; top: -10px;">
                                                        <span aria-hidden="true" class="fas fa-times"></span>
                                                    </button>
                                                    <br>
                                                    <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5  class="modal-title" id="miembrosModalLabel"  style="position:relative; left:170px;">Participantes</h5>
                                                        </div>
                                                            <div class="modal-body" style="text-align: center; display: flex; flex-wrap: nowrap; justify-content: center; overflow-x: auto;">
                                            `;

                                        // Mostrar las imágenes adicionales en el modal
                                        miembros.forEach(miembro => {
                                            html += `
                                                <img src="{{ asset('storage/empleados/imagenes/') }}/${miembro.avatar}"
                                                    class="rounded-circle" alt="${miembro.name}" title="${miembro.name}"
                                                    style="object-fit: cover; clip-path: circle(50%); height: 30px; width: 30px; margin-right: 10px;">
                                            `;
                                        });
                                    }

                                    html += '</div>'; // Cierre del contenedor flexbox
                                    return html;
                                }
                            }
                        },

                    {
                        data: 'descripcion',
                        name: 'descripcion',
                        render: function(data, type, row) {
                            return `<div style="text-align:left" class="module line-clamp" ><p>${data}</p></div>`;
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
                ],
            };

            let table = $('.datatable-Comiteseguridad').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

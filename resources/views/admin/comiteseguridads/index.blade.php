@extends('layouts.admin')
@section('content')
    <style>
        .btn-outline-success {
            background: #788bac !important;
            color: white;
            border: none;
        }

        .btn-outline-success:focus {
            border-color: #345183 !important;
            box-shadow: none;
        }

        .btn-outline-success:active {
            box-shadow: none !important;
        }

        .btn-outline-success:hover {
            background: #788bac;
            color: white;

        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .table tr th:nth-child(2) {


            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr th:nth-child(3) {


            min-width: 80px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(3) {

            text-align: center !important;
        }

        .table tr th:nth-child(4) {

            min-width: 130px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(4) {

            text-align: center !important;
        }

        .table tr th:nth-child(5) {


            min-width: 900px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(5) {

            text-align: justify !important;
        }


        .agregar {
            margin-right: 15px;
        }

        .module {
            width: 250px;
            margin: 0 0 1em 0;
            overflow: hidden;
        }

        .module p {
            margin: 0;
        }

        .line-clamp {
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
        }
    </style>

    {{ Breadcrumbs::render('admin.comiteseguridads.index') }}
    @can('comformacion_comite_seguridad_agregar')
        <h5 class="col-12 titulo_general_funcion">Conformación del Comité</h5>
        <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.comiteseguridads.create') }}" type="button" class="btn btn-primary">Crear Comité</a>
                </div>
        </div>
                <div class="col-lg-12">
                    @include('csvImport.modalcomitedeseguridad', [
                        'model' => 'Vulnerabilidad',
                        'route' => 'admin.vulnerabilidads.parseCsvImport',
                    ])
                </div>
                @include('partials.flashMessages')
                <div class="datatable-fix datatable-rds">
                    <h3 class="title-table-rds">Comites</h3>
                    @include('admin.comiteseguridads.table')
                </div>
    @endcan
@endsection
@section('scripts')
    @parent
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
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar nuevo comite de seguridad',
                    url: "{{ route('admin.comiteseguridads.create') }}",
                    className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                    action: function(e, dt, node, config) {
                        let {
                            url
                        } = config;
                        window.location.href = url;
                    }
                };
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

                dtButtons.push(btnAgregar);
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
                        render: function(data, type, row, meta) {
                            let miembros = data;
                            if (type === "miembroText") {
                                let miembrosTexto = "";
                                miembros.forEach(miembro => {
                                    miembrosTexto += `
                            ${miembro.name},
                            `;
                                });
                                return miembrosTexto.trim();
                            }
                            let html = '';
                            miembros.forEach(miembro => {
                                html += `
                            <img src="{{ asset('storage/empleados/imagenes/') }}/${miembro.avatar}"
                                        class="rounded-circle" alt="${miembro.name}"
                                        title="${miembro.name}" style="clip-path: circle(15px at 50% 50%);height: 30px;">
                            `
                            });
                            return html;
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

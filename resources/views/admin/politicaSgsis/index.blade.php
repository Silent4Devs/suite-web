@extends('layouts.admin')
@section('content')


    <style>
         .table tr td:nth-child(2) {
            text-align: justify !important;
        }

        .table tr th:nth-child(2) {
            min-width: 150px !important;
            text-align: center !important;

        }
        .table tr td:nth-child(3) {
            text-align: justify !important;
        }

        .table tr th:nth-child(3) {
            min-width: 900px !important;
            text-align: center !important;

        }

        .table tr th:nth-child(4) {
            text-align: center !important;
        }

        .table tr th:nth-child(5) {
            min-width: 70px !important;
            text-align: center !important;
        }

        .table tr td:nth-child(5) {
            text-align: center !important;
        }

        .table tr td:nth-child(6) {
            text-align: center !important;
        }

        .table tr th:nth-child(7) {
            text-align: center !important;
            min-width: 130px !important;
        }

        .table tr th:nth-child(9) {
            text-align: center !important;
            min-width: 70px !important;
        }

        .btn_cargar {
            border-radius: 100px !important;
            border: 1px solid #345183;
            color: #345183;
            text-align: center;
            padding: 0;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 !important;
            margin-right: 10px !important;
        }

        .btn_cargar:hover {
            color: #fff;
            background: #345183;
        }

        .btn_cargar i {
            font-size: 15pt;
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .agregar {
            margin-right: 15px;
        }

    </style>

    {{ Breadcrumbs::render('admin.politica-sgsis.index') }}

    @can('politica_sistema_gestion_agregar')

        <h5 class="col-12 titulo_general_funcion">Política del Sistema de Gestión</h5>
        <div class="mt-5 card">
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Política SGSI</strong></h3>
            </div> --}}
            <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    @include('csvImport.modelpoliticasgsi', ['model' => 'Vulnerabilidad', 'route' =>
                    'admin.vulnerabilidads.parseCsvImport'])
                </div>
            </div>
        @endcan

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-PoliticaSgsi" id="datatable-PoliticaSgsi">
                <thead class="thead-dark">
                    <tr>
                        <th style="text-transform: capitalize">
                            {{ trans('cruds.politicaSgsi.fields.id') }}
                        </th>
                        <th>
                            Nombre de la política
                        </th>
                        <th>
                            Política&nbsp;del&nbsp;Sistema&nbsp;de&nbsp;Gestión
                        </th>
                        <th>
                            Fecha de publicación
                        </th>
                        <th>
                            Fecha&nbsp;de&nbsp;entrada en vigor
                        </th>
                        <th>
                            Revisó
                        </th>
                        <th>
                            Puesto
                        </th>
                        <th>
                            Área
                        </th>
                        <th>
                            Fecha de revisión
                        </th>
                        <th>
                            Opciones
                        </th>
                    </tr>
                    {{-- <tr>
                            <td>
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                            </td>
                        </tr> --}}
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
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 7.5;
                        doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Política SGSI ${new Date().toLocaleDateString().trim()}`,
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
            @can('politica_sistema_gestion_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar nueva política SGSI',
                url: "{{ route('admin.politica-sgsis.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3 agregar",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                let btnExport = {
                text: '<i class="fas fa-download"></i>',
                titleAttr: 'Descargar plantilla',
                className: "btn btn_cargar" ,
                url:"{{ route('descarga-politica_sgi') }}",
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
            @can('politica_sistema_gestion_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.politica-sgsis.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
                return $(entry).data('entry-id')
                });

                if (ids.length === 0) {
                alert('{{ trans('global.datatables.zero_selected') }}')

                return
                }

                if (confirm('{{ trans('global.areYouSure') }}')) {
                $.ajax({
                headers: {'x-csrf-token': _token},
                method: 'POST',
                url: config.url,
                data: { ids: ids, _method: 'DELETE' }})
                .done(function () { location.reload() })
                }
                }
                }
                //dtButtons.push(deleteButton)
            @endcan



            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.politica-sgsis.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nombre_politica',
                        name: 'nombre_politica'
                    },
                    {
                        data: 'politicasgsi',
                        name: 'politicasgsi'
                    },
                    {
                        data: 'fecha_publicacion',
                        name: 'fecha_publicacion'
                    },
                    {
                        data: 'fecha_entrada',
                        name: 'fecha_entrada'
                    },
                    {
                        data: 'reviso_politica',
                        name: 'reviso_politica',
                        render: function(data, type, row, config, meta) {
                            let responsablereunion = "";
                            if (row.reviso) {
                                responsablereunion += `
                            <img src="{{ asset('storage/empleados/imagenes') }}/${row.reviso.avatar}" title="${row.reviso.name}" class="rounded-circle" style="clip-path: circle(15px at 50% 50%);height: 30px;" />
                            `;
                            }
                            return responsablereunion;
                        }
                    },
                    {
                        data: 'puesto_reviso',
                        name: 'puesto_reviso'
                    },
                    {
                        data: 'area_reviso',
                        name: 'area_reviso'
                    },
                    {
                        data: 'fecha_revision',
                        name: 'fecha_revision'
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

            // let table = $('.datatable-PoliticaSgsi:not(.ajaxTable)').DataTable({
            let table = $('#datatable-PoliticaSgsi').DataTable(dtOverrideGlobals);

            // buttons: dtButtons
            // })
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
        });
    </script>
@endsection

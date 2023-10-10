@extends('layouts.admin')
@section('content')

    <style>
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

    {{ Breadcrumbs::render('admin.revision-direccions.index') }}

    @can('revision_direccion_create')

    @endcan
    <h5 class="col-12 titulo_general_funcion">Revisión por Dirección</h5>
    <div class="mt-5 card">
        <div style="margin-bottom: 10px; margin-left:10px;" class="row">
            <div class="col-lg-12">
                @include('csvImport.modalrevisiondireccion', ['model' => 'Vulnerabilidad', 'route' =>
                'admin.vulnerabilidads.parseCsvImport'])
            </div>
        </div>
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-RevisionDireccion">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            {{ trans('cruds.revisionDireccion.fields.id') }}
                        </th>
                        <th style="vertical-align: top">
                            Estatus&nbsp;de&nbsp;las&nbsp;acciones de&nbsp;revisiones&nbsp;previas
                        </th>
                        <th style="vertical-align: top">
                            Cambios&nbsp;en&nbsp;aspectos&nbsp;internos&nbsp;y
                            externos&nbsp;que&nbsp;sean&nbsp;relevantes&nbsp;a&nbsp;SGSI
                        </th>
                        <th style="vertical-align: top; min-width: 500px;">
                            Retroalimentación&nbsp;sobre&nbsp;el&nbsp;desempeño&nbsp;de&nbsp;la
                            seguridad&nbsp;de&nbsp;la&nbsp;información
                        </th>
                        <th style="vertical-align: top; min-width: 500px;">
                            Retroalimentación&nbsp;de&nbsp;las partes&nbsp;interesadas
                        </th>
                        <th style="vertical-align: top">
                            Resultados&nbsp;de&nbsp;los&nbsp;análisis&nbsp;de&nbsp;riesgos&nbsp;y
                            estatus&nbsp;del&nbsp;plan&nbsp;de&nbsp;tratamiento&nbsp;de&nbsp;riesgos

                        </th>
                        <th style="vertical-align: top">
                            Oportunidades&nbsp;para&nbsp;la mejora&nbsp;continua
                        </th>
                        <th style="vertical-align: top; min-width: 500px;">
                            Acuerdos&nbsp;relativos&nbsp;a&nbsp;la&nbsp;mejora&nbsp;continua&nbsp;del
                            SGSI&nbsp;y&nbsp;cambios&nbsp;requeridos&nbsp;por&nbsp;el&nbsp;sistema
                        </th>
                        <th style="vertical-align: top">
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                    title: `Revisión por Dirección ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Revisión por Dirección ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Revisión por Dirección ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Revisión por Dirección ${new Date().toLocaleDateString().trim()}`,
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
            @can('revision_por_direccion_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar revisión por dirección',
                url: "{{ route('admin.revision-direccions.create') }}",
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
                url:"{{ route('descarga-revisiondireccion') }}",
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
            @can('revision_por_direccion_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.revision-direccions.massDestroy') }}",
                className: 'btn-danger',
                action: function (e, dt, node, config) {
                var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
                return entry.id
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
                ajax: "{{ route('admin.revision-direccions.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'estadorevisionesprevias',
                        name: 'estadorevisionesprevias'
                    },
                    {
                        data: 'cambiosinternosexternos',
                        name: 'cambiosinternosexternos'
                    },
                    {
                        data: 'retroalimentaciondesempeno',
                        name: 'retroalimentaciondesempeno'
                    },
                    {
                        data: 'retroalimentacionpartesinteresadas',
                        name: 'retroalimentacionpartesinteresadas'
                    },
                    {
                        data: 'resultadosriesgos',
                        name: 'resultadosriesgos'
                    },
                    {
                        data: 'oportunidadesmejoracontinua',
                        name: 'oportunidadesmejoracontinua'
                    },
                    {
                        data: 'acuerdoscambios',
                        name: 'acuerdoscambios'
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            let table = $('.datatable-RevisionDireccion').DataTable(dtOverrideGlobals);
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

@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.auditoria-internas.index') }}

    @can('auditoria_interna_create')

    @endcan
    <h5 class="col-12 titulo_general_funcion">Auditoría Interna</h5>
    <div class="mt-5 card">
        {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="ml-4 row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.auditoria-internas.create') }}">
                    Agregar <strong>+</strong>
            </a>
        </div>
    </div> --}}

        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-AuditoriaInterna">
                <thead class="thead-dark">
                    <tr>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.id') }}
                        </th>
                        <th>
                            Alcance&nbsp;auditoría
                        </th>
                        <th>
                            Fecha&nbsp;inicio
                        </th>
                        <th>
                            Fecha&nbsp;fin
                        </th>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.clausulas') }}
                        </th>
                        <th>
                            Auditor&nbsp;líder
                        </th>
                        <th>
                            Equipo&nbsp;auditoría
                        </th>
                        <th style="min-width: 500px;">
                            {{ trans('cruds.auditoriaInterna.fields.hallazgos') }}
                        </th>
                        <th>
                            No.&nbsp;conformidad&nbsp;menor
                        </th>
                        <th>
                            Total&nbsp;No.&nbsp;conformidad&nbsp;menor
                        </th>
                        <th>
                            No.&nbsp;conformidad&nbsp;mayor
                        </th>
                        <th>
                            Total&nbsp;No.&nbsp;conformidad&nbsp;mayor
                        </th>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.checkobservacion') }}
                        </th>
                        <th>
                            Total&nbsp;observación
                        </th>
                        <th>
                            {{ trans('cruds.auditoriaInterna.fields.checkmejora') }}
                        </th>
                        <th>
                            Total&nbsp;mejora
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
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Auditoría Interna ${new Date().toLocaleDateString().trim()}`,
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
            @can('auditoria_interna_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar auditoría interna',
                url: "{{ route('admin.auditoria-internas.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('auditoria_interna_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.auditoria-internas.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.auditoria-internas.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'alcance',
                        name: 'alcance'
                    },
                    {
                        data: 'fecha_inicio',
                        name: 'fecha_inicio'
                    },
                    {
                        data: 'fecha_fin',
                        name: 'fecha_fin'
                    },
                    {
                        data: 'clausulas',
                        render: function(data, type, row, meta){
                            let html = '<ul>';
                            data.forEach(clausula=>{
                                html += `
                                    <li>${clausula.nombre}</li>
                                `;
                            })
                            html += '</ul>';
                            return html
                        }
                    },
                    {
                        data: 'lider',
                    },
                    {
                        data: 'equipo',
                        render: function(data, type, row, meta){
                            let equipos = JSON.parse(data);
                            let html = '<ul>';
                            equipos.forEach(empleado=>{
                                html += `
                                    <li>${empleado.name}</li>
                                `;
                            })
                            html += '</ul>';
                            return html
                        }
                    },
                    {
                        data: 'hallazgos',
                        name: 'hallazgos'
                    },
                    {
                        data: 'cheknoconformidadmenor',
                        name: 'cheknoconformidadmenor'
                    },
                    {
                        data: 'totalnoconformidadmenor',
                        name: 'totalnoconformidadmenor'
                    },
                    {
                        data: 'checknoconformidadmayor',
                        name: 'checknoconformidadmayor'
                    },
                    {
                        data: 'totalnoconformidadmayor',
                        name: 'totalnoconformidadmayor'
                    },
                    {
                        data: 'checkobservacion',
                        name: 'checkobservacion'
                    },
                    {
                        data: 'totalobservacion',
                        name: 'totalobservacion'
                    },
                    {
                        data: 'checkmejora',
                        name: 'checkmejora'
                    },
                    {
                        data: 'totalmejora',
                        name: 'totalmejora'
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
            let table = $('.datatable-AuditoriaInterna').DataTable(dtOverrideGlobals);
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

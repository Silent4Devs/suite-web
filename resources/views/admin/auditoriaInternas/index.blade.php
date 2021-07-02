@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.auditoria-internas.index') }}
    
    @can('auditoria_interna_create')

    @endcan
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Auditoría Interna</strong></h3>
        </div>

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
                            {{ trans('cruds.auditoriaInterna.fields.clausulas') }}
                        </th>
                        <th>
                            Fecha&nbsp;auditoría
                        </th>
                        <th>
                            Auditor&nbsp;líder
                        </th>
                        <th>
                            Equipo&nbsp;auditoría
                        </th>
                        <th>
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
                            {{ trans('cruds.auditoriaInterna.fields.logotipo') }}
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($controles as $key => $item)
                                    <option value="{{ $item->control }}">{{ $item->control }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
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
            @can('auditoria_interna_create')
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
            @can('auditoria_interna_delete')
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
                        data: 'clausulas_control',
                        name: 'clausulas.control'
                    },
                    {
                        data: 'fechaauditoria',
                        name: 'fechaauditoria'
                    },
                    {
                        data: 'auditorlider_name',
                        name: 'auditorlider.name'
                    },
                    {
                        data: 'equipoauditoria_name',
                        name: 'equipoauditoria.name'
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
                        data: 'logotipo',
                        name: 'logotipo',
                        sortable: false,
                        searchable: false
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

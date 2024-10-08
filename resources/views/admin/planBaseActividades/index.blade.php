@extends('layouts.admin')
@section('content')
    @can('plan_base_actividade_create')
        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Plan de Trabajo Base </strong></h3>
            </div>
            {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="{{ route('admin.plan-base-actividades.create') }}">
                        Agregar <strong>+</strong>
                    </a>
                </div>
            </div> --}}
        @endcan
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-PlanBaseActividade">
                <thead class="thead-dark">
                    <tr>
                        <th style="max-width: 50px;">
                            {{ trans('cruds.planBaseActividade.fields.id') }}
                        </th>
                        <th style="min-width: 200px;">
                            Actividad
                        </th>
                        <th style="min-width: 200px;">
                            Actividad&nbsp;Principal
                        </th>
                        <th style="min-width: 200px;">
                            Ejecutar
                        </th>
                        <th style="min-width: 200px;">
                            Guia
                        </th>
                        <th style="min-width: 200px;">
                            Estatus
                        </th>
                        <th style="min-width: 200px;">
                            Responsable
                        </th>
                        <th style="min-width: 200px;">
                            Colaborador
                        </th>
                        <th style="min-width: 200px;">
                            Fecha&nbsp;inicio
                        </th>
                        <th style="min-width: 200px;">
                            Fecha&nbsp;fin
                        </th>
                        <th style="min-width: 200px;">
                            Fecha&nbsp;compromiso
                        </th>
                        <th style="min-width: 200px;">
                            Fecha&nbsp;real
                        </th>
                        <th style="max-width: 150px;">
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
                                @foreach ($plan_base_actividades as $key => $item)
                                    <option value="{{ $item->actividad }}">{{ $item->actividad }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($enlaces_ejecutars as $key => $item)
                                    <option value="{{ $item->ejecutar }}">{{ $item->ejecutar }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($estatus_plan_trabajos as $key => $item)
                                    <option value="{{ $item->estado }}">{{ $item->estado }}</option>
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach ($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                        <td>
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
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        doc.styles.tableHeader.fontSize = 8.5;
                        doc.defaultStyle.fontSize = 8.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Plan de Trabajo Base ${new Date().toLocaleDateString().trim()}`,
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

            @can('plan_base_actividade_create')
                let btnAgregar = {
                    text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                    titleAttr: 'Agregar plan de trabajo base',
                    url: "{{ route('admin.plan-base-actividades.create') }}",
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
            @can('plan_base_actividade_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.plan-base-actividades.massDestroy') }}",
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
                // dtButtons.push(deleteButton)
            @endcan
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.plan-base-actividades.index') }}",
                columns: [{
                        data: 'id',
                        name: 'plan_base_actividades.id'
                    },
                    {
                        data: 'actividad',
                        name: 'plan_base_actividades.actividad'
                    },
                    {
                        data: 'actividad_padre',
                        name: 'plan_base_actividades.actividad'
                    },
                    {
                        data: 'ejecutar',
                        name: 'ejecutar.ejecutar'
                    },
                    {
                        data: 'guia',
                        name: 'guia',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'estado',
                        name: 'estatus.estado'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {


                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.responsable.avatar}" title="${row.responsable.name}"></img>`;

                            return `${row.responsable ? html: ''}`;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {


                            let html =
                                `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.colaborador.avatar}" title="${row.colaborador.name}"></img>`;

                            return `${row.colaborador ? html: ''}`;
                        }
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
                        data: 'compromiso',
                        name: 'compromiso'
                    },
                    {
                        data: 'real',
                        name: 'real'
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
            let table = $('.datatable-PlanBaseActividade').DataTable(dtOverrideGlobals);
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

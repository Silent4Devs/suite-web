@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.tratamiento-riesgos.index') }}


    <h5 class="col-12 titulo_general_funcion">Tratamiento de los Riesgos</h5>

        <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 datatable-TratamientoRiesgo">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width: 30px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.id') }}
                        </th>
                        <th style="min-width: 100px;">
                            Niveles&nbsp;de&nbsp;riesgo
                        </th>
                        <th style="min-width: 300px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.control') }}
                        </th>
                        <th style="min-width: 100px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.acciones') }}
                        </th>
                        <th style="min-width: 300px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.responsable') }}
                        </th>
                        <th style="min-width: 200px;">
                            Fecha&nbsp;compromiso
                        </th>
                        <th style="min-width: 100px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}
                        </th>
                        <th style="min-width: 100px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.estatus') }}
                        </th>
                        <th style="min-width: 150px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}
                        </th>
                        <th style="min-width: 150px;">
                            {{ trans('cruds.tratamientoRiesgo.fields.impacto') }}
                        </th>
                        <th style="min-width: 150px;">
                            Niveles&nbsp;de&nbsp;riesgo&nbsp;residual
                        </th>
                        <th style="min-width: 20px;">
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
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach (App\Models\TratamientoRiesgo::PRIORIDAD_SELECT as $key => $item)
                                    <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
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
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Tratamiento de los Riesgos ${new Date().toLocaleDateString().trim()}`,
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

            @can('tratamiento_de_los_riesgos_agregar')
                let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar tratamiento de los riesgos',
                url: "{{ route('admin.tratamiento-riesgos.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
                };
                dtButtons.push(btnAgregar);
            @endcan
            @can('tratamiento_de_los_riesgos_eliminar')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                text: deleteButtonTrans,
                url: "{{ route('admin.tratamiento-riesgos.massDestroy') }}",
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
                ajax: "{{ route('admin.tratamiento-riesgos.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nivelriesgo',
                        name: 'nivelriesgo'
                    },
                    {
                        data: 'control_id',
                        name: 'control_id'
                    },
                    {
                        data: 'acciones',
                        name: 'acciones'
                    },
                    {
                        data: 'id_reviso',
                        name: 'id_reviso'
                    },
                    {
                        data: 'fechacompromiso',
                        name: 'fechacompromiso'
                    },
                    {
                        data: 'prioridad',
                        name: 'prioridad'
                    },
                    {
                        data: 'estatus',
                        name: 'estatus'
                    },
                    {
                        data: 'probabilidad',
                        name: 'probabilidad'
                    },
                    {
                        data: 'impacto',
                        name: 'impacto'
                    },
                    {
                        data: 'nivelriesgoresidual',
                        name: 'nivelriesgoresidual'
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
            let table = $('.datatable-TratamientoRiesgo').DataTable(dtOverrideGlobals);
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

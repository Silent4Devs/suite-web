@extends('layouts.admin')
@section('content')
    @can('planaccion_correctiva_create')
        <div class="card mt-5">
            <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2  text-center text-white"><strong>Plan acción</strong></h3>
            </div>
            <div style="margin-bottom: 10px; margin-left:12px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="{{ route('admin.planaccion-correctivas.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.planaccionCorrectiva.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="card">
            <div class="card-header">
                {{ trans('cruds.planaccionCorrectiva.title_singular') }} {{ trans('global.list') }}
            </div>

            <div class="card-body">
                <table
                    class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PlanaccionCorrectiva">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.planaccionCorrectiva.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}
                            </th>
                            <th>
                                {{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}
                            </th>
                            <th>
                                {{ trans('cruds.planaccionCorrectiva.fields.actividad') }}
                            </th>
                            <th>
                                {{ trans('cruds.planaccionCorrectiva.fields.responsable') }}
                            </th>
                            <th>
                                {{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}
                            </th>
                            <th>
                                {{ trans('cruds.planaccionCorrectiva.fields.estatus') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <select class="search">
                                    <option value>{{ trans('global.all') }}</option>
                                    @foreach ($accion_correctivas as $key => $item)
                                        <option value="{{ $item->tema }}">{{ $item->tema }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
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
                                    @foreach (App\Models\PlanaccionCorrectiva::ESTATUS_SELECT as $key => $item)
                                        <option value="{{ $key }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                            </td>
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
                let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
                @can('planaccion_correctiva_delete')
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.planaccion-correctivas.massDestroy') }}",
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
                    dtButtons.push(deleteButton)
                @endcan

                let dtOverrideGlobals = {
                    buttons: dtButtons,
                    processing: true,
                    serverSide: true,
                    retrieve: true,
                    aaSorting: [],
                    ajax: "{{ route('admin.planaccion-correctivas.index') }}",
                    columns: [{
                            data: 'placeholder',
                            name: 'placeholder'
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'accioncorrectiva_tema',
                            name: 'accioncorrectiva.tema'
                        },
                        {
                            data: 'accioncorrectiva.fecharegistro',
                            name: 'accioncorrectiva.fecharegistro'
                        },
                        {
                            data: 'actividad',
                            name: 'actividad'
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
                            data: 'fechacompromiso',
                            name: 'fechacompromiso'
                        },
                        {
                            data: 'estatus',
                            name: 'estatus'
                        },
                        {
                            data: 'actions',
                            name: '{{ trans('global.actions') }}'
                        }
                    ],
                    orderCellsTop: true,
                    order: [
                        [1, 'desc']
                    ],
                    pageLength: 100,
                };
                let table = $('.datatable-PlanaccionCorrectiva').DataTable(dtOverrideGlobals);
                $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                    $($.fn.dataTable.tables(true)).DataTable()
                        .columns.adjust();
                });
                $('.datatable thead').on('input', '.search', function() {
                    let strict = $(this).attr('strict') || false
                    let value = strict && this.value ? "^" + this.value + "$" : this.value
                    table
                        .column($(this).parent().index())
                        .search(value, strict)
                        .draw()
                });
            });
        </script>
    @endsection

@extends('layouts.admin')
@section('content')
    @can('dmaic_create')
        <div class="card mt-5">
            <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2  text-center text-white"><strong>DMAIC</strong></h3>
            </div>
            <div style="margin-bottom: 10px; margin-left:12px;" class="row">
                <div class="col-lg-12">
                    <a class="btn btn-primary" href="{{ route('admin.dmaics.create') }}">
                        {{ trans('global.add') }} {{ trans('cruds.dmaic.title_singular') }}
                    </a>
                </div>
            </div>
        @endcan
        <div class="card">
            <div class="card-header">
                {{ trans('cruds.dmaic.title_singular') }} {{ trans('global.list') }}
            </div>

            <div class="card-body">
                <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Dmaic">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.id') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.mejora') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.definir') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.medir') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.analizar') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.implementar') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.controlar') }}
                            </th>
                            <th>
                                {{ trans('cruds.dmaic.fields.leccionesaprendidas') }}
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
                                    @foreach ($registromejoras as $key => $item)
                                        <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
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
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                            </td>
                            <td>
                                <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                @can('dmaic_delete')
                    let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                    let deleteButton = {
                        text: deleteButtonTrans,
                        url: "{{ route('admin.dmaics.massDestroy') }}",
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
                    ajax: "{{ route('admin.dmaics.index') }}",
                    columns: [{
                            data: 'placeholder',
                            name: 'placeholder'
                        },
                        {
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'mejora_nombre',
                            name: 'mejora.nombre'
                        },
                        {
                            data: 'definir',
                            name: 'definir'
                        },
                        {
                            data: 'medir',
                            name: 'medir'
                        },
                        {
                            data: 'analizar',
                            name: 'analizar'
                        },
                        {
                            data: 'implementar',
                            name: 'implementar'
                        },
                        {
                            data: 'controlar',
                            name: 'controlar'
                        },
                        {
                            data: 'leccionesaprendidas',
                            name: 'leccionesaprendidas'
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
                let table = $('.datatable-Dmaic').DataTable(dtOverrideGlobals);
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

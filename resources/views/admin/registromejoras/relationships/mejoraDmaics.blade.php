@can('dmaic_create')
    <div style="margin-bottom: 10px;" class="row">
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
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-mejoraDmaics">
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
                </thead>
                <tbody>
                    @foreach ($dmaics as $key => $dmaic)
                        <tr data-entry-id="{{ $dmaic->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $dmaic->id ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->mejora->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->definir ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->medir ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->analizar ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->implementar ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->controlar ?? '' }}
                            </td>
                            <td>
                                {{ $dmaic->leccionesaprendidas ?? '' }}
                            </td>
                            <td>
                                @can('dmaic_show')
                                    <a class="btn btn-xs tb-btn-primary"
                                        href="{{ route('admin.dmaics.show', $dmaic->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('dmaic_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.dmaics.edit', $dmaic->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('dmaic_delete')
                                    <form action="{{ route('admin.dmaics.destroy', $dmaic->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
            @can('dmaic_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.dmaics.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-mejoraDmaics:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection

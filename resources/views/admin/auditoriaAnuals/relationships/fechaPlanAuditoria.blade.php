@can('plan_auditorium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-primary" href="{{ route('admin.plan-auditoria.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.planAuditorium.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.planAuditorium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-fechaPlanAuditoria">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.fecha') }}
                        </th>
                        <th>
                            {{ trans('cruds.auditoriaAnual.fields.tipo') }}
                        </th>
                        <th>
                            {{ trans('cruds.auditoriaAnual.fields.observaciones') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.objetivo') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.alcance') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.criterios') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.documentoauditar') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.equipoauditor') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.auditados') }}
                        </th>
                        <th>
                            {{ trans('cruds.planAuditorium.fields.descripcion') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planAuditoria as $key => $planAuditorium)
                        <tr data-entry-id="{{ $planAuditorium->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $planAuditorium->id ?? '' }}
                            </td>
                            <td>
                                {{ $planAuditorium->fecha->fechainicio ?? '' }}
                            </td>
                            <td>
                                @if ($planAuditorium->fecha)
                                    {{ $planAuditorium->fecha::TIPO_SELECT[$planAuditorium->fecha->tipo] ?? '' }}
                                @endif
                            </td>
                            <td>
                                {{ $planAuditorium->fecha->observaciones ?? '' }}
                            </td>
                            <td>
                                {{ $planAuditorium->objetivo ?? '' }}
                            </td>
                            <td>
                                {{ $planAuditorium->alcance ?? '' }}
                            </td>
                            <td>
                                {{ $planAuditorium->criterios ?? '' }}
                            </td>
                            <td>
                                {{ $planAuditorium->documentoauditar ?? '' }}
                            </td>
                            <td>
                                {{ $planAuditorium->equipoauditor ?? '' }}
                            </td>
                            <td>
                                @foreach ($planAuditorium->auditados as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $planAuditorium->descripcion ?? '' }}
                            </td>
                            <td>
                                @can('plan_auditorium_show')
                                    <a class="btn btn-xs tb-btn-primary"
                                        href="{{ route('admin.plan-auditoria.show', $planAuditorium->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('plan_auditorium_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.plan-auditoria.edit', $planAuditorium->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('plan_auditorium_delete')
                                    <form action="{{ route('admin.plan-auditoria.destroy', $planAuditorium->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
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
            @can('plan_auditorium_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.plan-auditoria.massDestroy') }}",
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
            let table = $('.datatable-fechaPlanAuditoria:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection

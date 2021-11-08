@can('incidentes_de_seguridad_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('incidentes-de-seguridads.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.incidentesDeSeguridad.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.incidentesDeSeguridad.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-activoIncidentesDeSeguridads">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.folio') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.resumen') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.prioridad') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.activo') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.clasificacion') }}
                        </th>
                        <th>
                            {{ trans('cruds.incidentesDeSeguridad.fields.estado') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($incidentesDeSeguridads as $key => $incidentesDeSeguridad)
                        <tr data-entry-id="{{ $incidentesDeSeguridad->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $incidentesDeSeguridad->id ?? '' }}
                            </td>
                            <td>
                                {{ $incidentesDeSeguridad->folio ?? '' }}
                            </td>
                            <td>
                                {{ $incidentesDeSeguridad->resumen ?? '' }}
                            </td>
                            <td>
                                {{ App\Models\IncidentesDeSeguridad::PRIORIDAD_SELECT[$incidentesDeSeguridad->prioridad] ?? '' }}
                            </td>
                            <td>
                                {{ $incidentesDeSeguridad->fechaocurrencia ?? '' }}
                            </td>
                            <td>
                                @foreach($incidentesDeSeguridad->activos as $key => $item)
                                    <span class="badge badge-info">{{ $item->descripcion }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $incidentesDeSeguridad->clasificacion ?? '' }}
                            </td>
                            <td>
                                {{ $incidentesDeSeguridad->estado->estado ?? '' }}
                            </td>
                            <td>
                                @can('incidentes_de_seguridad_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('incidentes-de-seguridads.show', $incidentesDeSeguridad->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('incidentes_de_seguridad_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('incidentes-de-seguridads.edit', $incidentesDeSeguridad->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('incidentes_de_seguridad_delete')
                                    <form action="{{ route('incidentes-de-seguridads.destroy', $incidentesDeSeguridad->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('incidentes_de_seguridad_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('incidentes-de-seguridads.massDestroy') }}",
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
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-activoIncidentesDeSeguridads:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('material_iso_veinticiente_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.material-iso-veinticientes.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.materialIsoVeinticiente.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.materialIsoVeinticiente.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MaterialIsoVeinticiente">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.objetivo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($areas as $key => $item)
                                                <option value="{{ $item->area }}">{{ $item->area }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materialIsoVeinticientes as $key => $materialIsoVeinticiente)
                                    <tr data-entry-id="{{ $materialIsoVeinticiente->id }}">
                                        <td>
                                            {{ $materialIsoVeinticiente->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $materialIsoVeinticiente->objetivo ?? '' }}
                                        </td>
                                        <td>
                                            @if($materialIsoVeinticiente->listaasistencia)
                                                <a href="{{ $materialIsoVeinticiente->listaasistencia->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $materialIsoVeinticiente->arearesponsable->area ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT[$materialIsoVeinticiente->tipoimparticion] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $materialIsoVeinticiente->fechacreacion_actualizacion ?? '' }}
                                        </td>
                                        <td>
                                            @if($materialIsoVeinticiente->materialarchivo)
                                                <a href="{{ $materialIsoVeinticiente->materialarchivo->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('material_iso_veinticiente_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.material-iso-veinticientes.show', $materialIsoVeinticiente->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('material_iso_veinticiente_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.material-iso-veinticientes.edit', $materialIsoVeinticiente->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('material_iso_veinticiente_delete')
                                                <form action="{{ route('frontend.material-iso-veinticientes.destroy', $materialIsoVeinticiente->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('material_iso_veinticiente_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.material-iso-veinticientes.massDestroy') }}",
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
  let table = $('.datatable-MaterialIsoVeinticiente:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
})

</script>
@endsection
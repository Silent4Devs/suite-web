@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('material_sgsi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.material-sgsis.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.materialSgsi.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.materialSgsi.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-MaterialSgsi">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.objetivo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.personalobjetivo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.arearesponsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.tipoimparticion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.fechacreacion_actualizacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.materialSgsi.fields.archivo') }}
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
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\MaterialSgsi::PERSONALOBJETIVO_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
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
                                            @foreach(App\Models\MaterialSgsi::TIPOIMPARTICION_SELECT as $key => $item)
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
                                @foreach($materialSgsis as $key => $materialSgsi)
                                    <tr data-entry-id="{{ $materialSgsi->id }}">
                                        <td>
                                            {{ $materialSgsi->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $materialSgsi->objetivo ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\MaterialSgsi::PERSONALOBJETIVO_SELECT[$materialSgsi->personalobjetivo] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $materialSgsi->arearesponsable->area ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\MaterialSgsi::TIPOIMPARTICION_SELECT[$materialSgsi->tipoimparticion] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $materialSgsi->fechacreacion_actualizacion ?? '' }}
                                        </td>
                                        <td>
                                            @if($materialSgsi->archivo)
                                                <a href="{{ $materialSgsi->archivo->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('material_sgsi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.material-sgsis.show', $materialSgsi->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('material_sgsi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.material-sgsis.edit', $materialSgsi->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('material_sgsi_delete')
                                                <form action="{{ route('frontend.material-sgsis.destroy', $materialSgsi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('material_sgsi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.material-sgsis.massDestroy') }}",
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
  let table = $('.datatable-MaterialSgsi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
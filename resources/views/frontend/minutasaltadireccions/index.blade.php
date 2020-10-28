@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('minutasaltadireccion_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.minutasaltadireccions.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.minutasaltadireccion.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.minutasaltadireccion.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Minutasaltadireccion">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.minutasaltadireccion.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.minutasaltadireccion.fields.objetivoreunion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.minutasaltadireccion.fields.responsablereunion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.minutasaltadireccion.fields.arearesponsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.minutasaltadireccion.fields.fechareunion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.minutasaltadireccion.fields.archivo') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($users as $key => $item)
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
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($minutasaltadireccions as $key => $minutasaltadireccion)
                                    <tr data-entry-id="{{ $minutasaltadireccion->id }}">
                                        <td>
                                            {{ $minutasaltadireccion->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $minutasaltadireccion->objetivoreunion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $minutasaltadireccion->responsablereunion->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $minutasaltadireccion->arearesponsable ?? '' }}
                                        </td>
                                        <td>
                                            {{ $minutasaltadireccion->fechareunion ?? '' }}
                                        </td>
                                        <td>
                                            @if($minutasaltadireccion->archivo)
                                                <a href="{{ $minutasaltadireccion->archivo->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('minutasaltadireccion_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.minutasaltadireccions.show', $minutasaltadireccion->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('minutasaltadireccion_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.minutasaltadireccions.edit', $minutasaltadireccion->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('minutasaltadireccion_delete')
                                                <form action="{{ route('frontend.minutasaltadireccions.destroy', $minutasaltadireccion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('minutasaltadireccion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.minutasaltadireccions.massDestroy') }}",
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
  let table = $('.datatable-Minutasaltadireccion:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
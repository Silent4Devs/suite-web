@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('objetivosseguridad_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.objetivosseguridads.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.objetivosseguridad.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.objetivosseguridad.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Objetivosseguridad">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.objetivosseguridad.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.objetivosseguridad.fields.objetivoseguridad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.objetivosseguridad.fields.indicador') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.objetivosseguridad.fields.anio') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($objetivosseguridads as $key => $objetivosseguridad)
                                    <tr data-entry-id="{{ $objetivosseguridad->id }}">
                                        <td>
                                            {{ $objetivosseguridad->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $objetivosseguridad->objetivoseguridad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $objetivosseguridad->indicador ?? '' }}
                                        </td>
                                        <td>
                                            {{ $objetivosseguridad->anio ?? '' }}
                                        </td>
                                        <td>
                                            @can('objetivosseguridad_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.objetivosseguridads.show', $objetivosseguridad->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('objetivosseguridad_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.objetivosseguridads.edit', $objetivosseguridad->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('objetivosseguridad_delete')
                                                <form action="{{ route('frontend.objetivosseguridads.destroy', $objetivosseguridad->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('objetivosseguridad_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.objetivosseguridads.massDestroy') }}",
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
  let table = $('.datatable-Objetivosseguridad:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
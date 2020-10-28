@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('comiteseguridad_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.comiteseguridads.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.comiteseguridad.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.comiteseguridad.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-Comiteseguridad">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.comiteseguridad.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.comiteseguridad.fields.nombrerol') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.comiteseguridad.fields.personaasignada') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.comiteseguridad.fields.fechavigor') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.comiteseguridad.fields.responsabilidades') }}
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
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comiteseguridads as $key => $comiteseguridad)
                                    <tr data-entry-id="{{ $comiteseguridad->id }}">
                                        <td>
                                            {{ $comiteseguridad->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $comiteseguridad->nombrerol ?? '' }}
                                        </td>
                                        <td>
                                            {{ $comiteseguridad->personaasignada->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $comiteseguridad->fechavigor ?? '' }}
                                        </td>
                                        <td>
                                            {{ $comiteseguridad->responsabilidades ?? '' }}
                                        </td>
                                        <td>
                                            @can('comiteseguridad_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.comiteseguridads.show', $comiteseguridad->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('comiteseguridad_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.comiteseguridads.edit', $comiteseguridad->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('comiteseguridad_delete')
                                                <form action="{{ route('frontend.comiteseguridads.destroy', $comiteseguridad->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('comiteseguridad_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.comiteseguridads.massDestroy') }}",
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
    order: [[ 3, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-Comiteseguridad:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
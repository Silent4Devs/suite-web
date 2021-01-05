@extends('layouts.admin')
@section('content')
@can('control_documento_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.control-documentos.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.controlDocumento.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
  
    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-ControlDocumento">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.clave') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.nombre') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.fecha_creacion') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.version') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.elaboro') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.reviso') }}
                        </th>
                        <th>
                            {{ trans('cruds.controlDocumento.fields.estado') }}
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($users as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($estado_documentos as $key => $item)
                                    <option value="{{ $item->estado }}">{{ $item->estado }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($controlDocumentos as $key => $controlDocumento)
                        <tr data-entry-id="{{ $controlDocumento->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $controlDocumento->id ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->clave ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->nombre ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->fecha_creacion ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->version ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->elaboro->name ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->reviso->name ?? '' }}
                            </td>
                            <td>
                                {{ $controlDocumento->estado->estado ?? '' }}
                            </td>
                            <td>

                                @can('control_documento_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.control-documentos.edit', $controlDocumento->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('control_documento_delete')
                                    <form action="{{ route('admin.control-documentos.destroy', $controlDocumento->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('control_documento_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.control-documentos.massDestroy') }}",
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
  let table = $('.datatable-ControlDocumento:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
})

</script>
@endsection
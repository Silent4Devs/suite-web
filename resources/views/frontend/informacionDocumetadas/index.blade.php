@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('informacion_documetada_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.informacion-documetadas.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.informacionDocumetada.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.informacionDocumetada.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-InformacionDocumetada">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.titulodocumento') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.tipodocumento') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.identificador') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.version') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.politicas') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.contenido') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.elaboro') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.reviso') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.aprobacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.informacionDocumetada.fields.logotipo') }}
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
                                            @foreach(App\Models\InformacionDocumetada::TIPODOCUMENTO_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($politica_sgsis as $key => $item)
                                                <option value="{{ $item->politicasgsi }}">{{ $item->politicasgsi }}</option>
                                            @endforeach
                                        </select>
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
                                            @foreach($users as $key => $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($informacionDocumetadas as $key => $informacionDocumetada)
                                    <tr data-entry-id="{{ $informacionDocumetada->id }}">
                                        <td>
                                            {{ $informacionDocumetada->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->titulodocumento ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\InformacionDocumetada::TIPODOCUMENTO_SELECT[$informacionDocumetada->tipodocumento] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->identificador ?? '' }}
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->version ?? '' }}
                                        </td>
                                        <td>
                                            @foreach($informacionDocumetada->politicas as $key => $item)
                                                <span>{{ $item->politicasgsi }}</span>
                                            @endforeach
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->contenido ?? '' }}
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->elaboro->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->reviso->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $informacionDocumetada->aprobacion->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($informacionDocumetada->logotipo)
                                                <a href="{{ $informacionDocumetada->logotipo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $informacionDocumetada->logotipo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('informacion_documetada_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.informacion-documetadas.show', $informacionDocumetada->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('informacion_documetada_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.informacion-documetadas.edit', $informacionDocumetada->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('informacion_documetada_delete')
                                                <form action="{{ route('frontend.informacion-documetadas.destroy', $informacionDocumetada->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('informacion_documetada_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.informacion-documetadas.massDestroy') }}",
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
  let table = $('.datatable-InformacionDocumetada:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
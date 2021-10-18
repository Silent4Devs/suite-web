@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('organizacion_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.organizacions.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.organizacion.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.organizacion.title_singular') }} {{ trans('global.list') }}
                </div>

                @include('partials.flashMessages')
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table  table-bordered table-striped table-hover datatable datatable-Organizacion">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.empresa') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.direccion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.telefono') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.correo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.pagina_web') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.giro') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.servicios') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.mision') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.vision') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.valores') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.organizacion.fields.logotipo') }}
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
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
                                @foreach($organizacions as $key => $organizacion)
                                    <tr data-entry-id="{{ $organizacion->id }}">
                                        <td>
                                            {{ $organizacion->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->empresa ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->direccion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->telefono ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->correo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->pagina_web ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->giro ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->servicios ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->mision ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->vision ?? '' }}
                                        </td>
                                        <td>
                                            {{ $organizacion->valores ?? '' }}
                                        </td>
                                        <td>
                                            @if($organizacion->logotipo)
                                                <a href="{{ $organizacion->logotipo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $organizacion->logotipo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('organizacion_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.organizacions.show', $organizacion->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('organizacion_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.organizacions.edit', $organizacion->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('organizacion_delete')
                                                <form action="{{ route('frontend.organizacions.destroy', $organizacion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('organizacion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.organizacions.massDestroy') }}",
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
    pageLength: 10,
  });
  let table = $('.datatable-Organizacion:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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

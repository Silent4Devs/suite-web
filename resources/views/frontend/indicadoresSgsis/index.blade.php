@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('indicadores_sgsi_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.indicadores-sgsis.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.indicadoresSgsi.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.indicadoresSgsi.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-IndicadoresSgsi">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.control') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.titulo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.responsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.formula') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.frecuencia') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.unidadmedida') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.meta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.semaforo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.enero') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.febrero') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.marzo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.abril') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.mayo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.junio') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.julio') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.agosto') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.septiembre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.octubre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.noviembre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.diciembre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.indicadoresSgsi.fields.anio') }}
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
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\IndicadoresSgsi::FRECUENCIA_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\IndicadoresSgsi::UNIDADMEDIDA_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\IndicadoresSgsi::SEMAFORO_SELECT as $key => $item)
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
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($indicadoresSgsis as $key => $indicadoresSgsi)
                                    <tr data-entry-id="{{ $indicadoresSgsi->id }}">
                                        <td>
                                            {{ $indicadoresSgsi->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->control ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->titulo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->responsable->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->formula ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\IndicadoresSgsi::FRECUENCIA_SELECT[$indicadoresSgsi->frecuencia] ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\IndicadoresSgsi::UNIDADMEDIDA_SELECT[$indicadoresSgsi->unidadmedida] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->meta ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\IndicadoresSgsi::SEMAFORO_SELECT[$indicadoresSgsi->semaforo] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->enero ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->febrero ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->marzo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->abril ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->mayo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->junio ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->julio ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->agosto ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->septiembre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->octubre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->noviembre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->diciembre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $indicadoresSgsi->anio ?? '' }}
                                        </td>
                                        <td>
                                            @can('indicadores_sgsi_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.indicadores-sgsis.show', $indicadoresSgsi->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('indicadores_sgsi_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.indicadores-sgsis.edit', $indicadoresSgsi->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('indicadores_sgsi_delete')
                                                <form action="{{ route('frontend.indicadores-sgsis.destroy', $indicadoresSgsi->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('indicadores_sgsi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.indicadores-sgsis.massDestroy') }}",
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
  let table = $('.datatable-IndicadoresSgsi:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
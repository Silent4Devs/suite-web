@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('tratamiento_riesgo_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.tratamiento-riesgos.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.tratamientoRiesgo.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.tratamientoRiesgo.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-TratamientoRiesgo">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.nivelriesgo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.control') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.acciones') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.responsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.fechacompromiso') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.prioridad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.estatus') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.probabilidad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.impacto') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.tratamientoRiesgo.fields.nivelriesgoresidual') }}
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
                                            @foreach($controles as $key => $item)
                                                <option value="{{ $item->control }}">{{ $item->control }}</option>
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
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\TratamientoRiesgo::PRIORIDAD_SELECT as $key => $item)
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
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tratamientoRiesgos as $key => $tratamientoRiesgo)
                                    <tr data-entry-id="{{ $tratamientoRiesgo->id }}">
                                        <td>
                                            {{ $tratamientoRiesgo->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->nivelriesgo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->control->control ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->acciones ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->responsable->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->fechacompromiso ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\TratamientoRiesgo::PRIORIDAD_SELECT[$tratamientoRiesgo->prioridad] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->estatus ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->probabilidad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->impacto ?? '' }}
                                        </td>
                                        <td>
                                            {{ $tratamientoRiesgo->nivelriesgoresidual ?? '' }}
                                        </td>
                                        <td>
                                            @can('tratamiento_riesgo_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.tratamiento-riesgos.show', $tratamientoRiesgo->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('tratamiento_riesgo_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.tratamiento-riesgos.edit', $tratamientoRiesgo->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('tratamiento_riesgo_delete')
                                                <form action="{{ route('frontend.tratamiento-riesgos.destroy', $tratamientoRiesgo->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('tratamiento_riesgo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.tratamiento-riesgos.massDestroy') }}",
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
  let table = $('.datatable-TratamientoRiesgo:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
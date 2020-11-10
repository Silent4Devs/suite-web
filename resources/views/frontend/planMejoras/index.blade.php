@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('plan_mejora_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.plan-mejoras.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.planMejora.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.planMejora.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PlanMejora">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planMejora.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planMejora.fields.mejora') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planMejora.fields.descripcion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planMejora.fields.responsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planMejora.fields.fecha_compromiso') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planMejora.fields.estatus') }}
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
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($registromejoras as $key => $item)
                                                <option value="{{ $item->nombre }}">{{ $item->nombre }}</option>
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
                                            @foreach(App\Models\PlanMejora::ESTATUS_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planMejoras as $key => $planMejora)
                                    <tr data-entry-id="{{ $planMejora->id }}">
                                        <td>
                                            {{ $planMejora->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planMejora->mejora->nombre ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planMejora->descripcion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planMejora->responsable->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planMejora->fecha_compromiso ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\PlanMejora::ESTATUS_SELECT[$planMejora->estatus] ?? '' }}
                                        </td>
                                        <td>
                                            @can('plan_mejora_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.plan-mejoras.show', $planMejora->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('plan_mejora_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.plan-mejoras.edit', $planMejora->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('plan_mejora_delete')
                                                <form action="{{ route('frontend.plan-mejoras.destroy', $planMejora->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('plan_mejora_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.plan-mejoras.massDestroy') }}",
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
  let table = $('.datatable-PlanMejora:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
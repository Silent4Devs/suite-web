@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('plan_base_actividade_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.plan-base-actividades.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.planBaseActividade.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.planBaseActividade.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PlanBaseActividade">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.actividad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.actividad_padre') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.ejecutar') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.guia') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.estatus') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.responsable') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.colaborador') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.fecha_inicio') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.fecha_fin') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.compromiso') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planBaseActividade.fields.real') }}
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
                                            @foreach($plan_base_actividades as $key => $item)
                                                <option value="{{ $item->actividad }}">{{ $item->actividad }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($enlaces_ejecutars as $key => $item)
                                                <option value="{{ $item->ejecutar }}">{{ $item->ejecutar }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                        <select class="search">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach($estatus_plan_trabajos as $key => $item)
                                                <option value="{{ $item->estado }}">{{ $item->estado }}</option>
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
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($planBaseActividades as $key => $planBaseActividade)
                                    <tr data-entry-id="{{ $planBaseActividade->id }}">
                                        <td>
                                            {{ $planBaseActividade->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->actividad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->actividad_padre->actividad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->ejecutar->ejecutar ?? '' }}
                                        </td>
                                        <td>
                                            @if($planBaseActividade->guia)
                                                <a href="{{ $planBaseActividade->guia->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->estatus->estado ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->responsable->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->colaborador->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->fecha_inicio ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->fecha_fin ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->compromiso ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planBaseActividade->real ?? '' }}
                                        </td>
                                        <td>
                                            @can('plan_base_actividade_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.plan-base-actividades.show', $planBaseActividade->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('plan_base_actividade_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.plan-base-actividades.edit', $planBaseActividade->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('plan_base_actividade_delete')
                                                <form action="{{ route('frontend.plan-base-actividades.destroy', $planBaseActividade->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('plan_base_actividade_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.plan-base-actividades.massDestroy') }}",
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
    pageLength: 50,
  });
  let table = $('.datatable-PlanBaseActividade:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
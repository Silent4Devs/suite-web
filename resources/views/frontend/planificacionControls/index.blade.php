@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('planificacion_control_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.planificacion-controls.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.planificacionControl.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.planificacionControl.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-PlanificacionControl">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.activo') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.descripcion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.dueno') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.vulnerabilidad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.amenaza') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.confidencialidad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.integridad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.disponibilidad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.probabilidad') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.impacto') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.planificacionControl.fields.nivelriesgo') }}
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
                                @foreach($planificacionControls as $key => $planificacionControl)
                                    <tr data-entry-id="{{ $planificacionControl->id }}">
                                        <td>
                                            {{ $planificacionControl->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->activo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->descripcion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->dueno->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->vulnerabilidad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->amenaza ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->confidencialidad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->integridad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->disponibilidad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->probabilidad ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->impacto ?? '' }}
                                        </td>
                                        <td>
                                            {{ $planificacionControl->nivelriesgo ?? '' }}
                                        </td>
                                        <td>
                                            @can('planificacion_control_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.planificacion-controls.show', $planificacionControl->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('planificacion_control_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.planificacion-controls.edit', $planificacionControl->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('planificacion_control_delete')
                                                <form action="{{ route('frontend.planificacion-controls.destroy', $planificacionControl->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('planificacion_control_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.planificacion-controls.massDestroy') }}",
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
  let table = $('.datatable-PlanificacionControl:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
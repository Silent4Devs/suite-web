@extends('layouts.admin')
@section('content')
@can('planificacion_control_create')

<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Planificación y Control</strong></h3>
    </div>

    <div style="margin-bottom: 10px;  margin-left:10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.planificacion-controls.create') }}">
                      Agregar <strong>+</strong>
            </a>
        </div>
    </div>
@endcan

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PlanificacionControl">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('planificacion_control_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.planificacion-controls.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).data(), function (entry) {
          return entry.id
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

  let dtOverrideGlobals = {
    buttons: dtButtons,
    processing: true,
    serverSide: true,
    retrieve: true,
    aaSorting: [],
    ajax: "{{ route('admin.planificacion-controls.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'activo', name: 'activo' },
{ data: 'descripcion', name: 'descripcion' },
{ data: 'dueno_name', name: 'dueno.name' },
{ data: 'vulnerabilidad', name: 'vulnerabilidad' },
{ data: 'amenaza', name: 'amenaza' },
{ data: 'confidencialidad', name: 'confidencialidad' },
{ data: 'integridad', name: 'integridad' },
{ data: 'disponibilidad', name: 'disponibilidad' },
{ data: 'probabilidad', name: 'probabilidad' },
{ data: 'impacto', name: 'impacto' },
{ data: 'nivelriesgo', name: 'nivelriesgo' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PlanificacionControl').DataTable(dtOverrideGlobals);
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
});

</script>
@endsection

@extends('layouts.admin')
@section('content')
@can('plan_auditorium_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.plan-auditoria.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.planAuditorium.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.planAuditorium.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PlanAuditorium">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.fecha') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.tipo') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.observaciones') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.objetivo') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.alcance') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.criterios') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.documentoauditar') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.equipoauditor') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.auditados') }}
                    </th>
                    <th>
                        {{ trans('cruds.planAuditorium.fields.descripcion') }}
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
                            @foreach($auditoria_anuals as $key => $item)
                                <option value="{{ $item->fechainicio }}">{{ $item->fechainicio }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
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
@can('plan_auditorium_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.plan-auditoria.massDestroy') }}",
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
    ajax: "{{ route('admin.plan-auditoria.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'fecha_fechainicio', name: 'fecha.fechainicio' },
{ data: 'fecha.tipo', name: 'fecha.tipo' },
{ data: 'fecha.observaciones', name: 'fecha.observaciones' },
{ data: 'objetivo', name: 'objetivo' },
{ data: 'alcance', name: 'alcance' },
{ data: 'criterios', name: 'criterios' },
{ data: 'documentoauditar', name: 'documentoauditar' },
{ data: 'equipoauditor', name: 'equipoauditor' },
{ data: 'auditados', name: 'auditados.name' },
{ data: 'descripcion', name: 'descripcion' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PlanAuditorium').DataTable(dtOverrideGlobals);
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
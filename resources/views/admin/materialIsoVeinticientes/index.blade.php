@extends('layouts.admin')
@section('content')
@can('material_iso_veinticiente_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.material-iso-veinticientes.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.materialIsoVeinticiente.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.materialIsoVeinticiente.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MaterialIsoVeinticiente">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.objetivo') }}
                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.listaasistencia') }}
                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.arearesponsable') }}
                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.tipoimparticion') }}
                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.fechacreacion_actualizacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.materialIsoVeinticiente.fields.materialarchivo') }}
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
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($areas as $key => $item)
                                <option value="{{ $item->area }}">{{ $item->area }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\MaterialIsoVeinticiente::TIPOIMPARTICION_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
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
@can('material_iso_veinticiente_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.material-iso-veinticientes.massDestroy') }}",
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
    ajax: "{{ route('admin.material-iso-veinticientes.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'objetivo', name: 'objetivo' },
{ data: 'listaasistencia', name: 'listaasistencia', sortable: false, searchable: false },
{ data: 'arearesponsable_area', name: 'arearesponsable.area' },
{ data: 'tipoimparticion', name: 'tipoimparticion' },
{ data: 'fechacreacion_actualizacion', name: 'fechacreacion_actualizacion' },
{ data: 'materialarchivo', name: 'materialarchivo', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MaterialIsoVeinticiente').DataTable(dtOverrideGlobals);
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
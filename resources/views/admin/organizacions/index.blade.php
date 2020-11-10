@extends('layouts.admin')
@section('content')
@can('organizacion_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.organizacions.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.organizacion.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.organizacion.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table table-responsive-sm table-sm  ajaxTable datatable datatable-Organizacion">
            <thead>
                <tr>
                    <th width="10">

                    </th>
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
        </table>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('organizacion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.organizacions.massDestroy') }}",
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
    ajax: "{{ route('admin.organizacions.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'empresa', name: 'empresa' },
{ data: 'direccion', name: 'direccion' },
{ data: 'telefono', name: 'telefono' },
{ data: 'correo', name: 'correo' },
{ data: 'pagina_web', name: 'pagina_web' },
{ data: 'giro', name: 'giro' },
{ data: 'servicios', name: 'servicios' },
{ data: 'mision', name: 'mision' },
{ data: 'vision', name: 'vision' },
{ data: 'valores', name: 'valores' },
{ data: 'logotipo', name: 'logotipo', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 10,
  };
  let table = $('.datatable-Organizacion').DataTable(dtOverrideGlobals);
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
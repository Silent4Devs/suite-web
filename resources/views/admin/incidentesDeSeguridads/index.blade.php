@extends('layouts.admin')
@section('content')
@can('incidentes_de_seguridad_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.incidentes-de-seguridads.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.incidentesDeSeguridad.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.incidentesDeSeguridad.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IncidentesDeSeguridad">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.folio') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.resumen') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.prioridad') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.fechaocurrencia') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.activo') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.clasificacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.incidentesDeSeguridad.fields.estado') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\IncidentesDeSeguridad::PRIORIDAD_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($activos as $key => $item)
                                <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($estado_incidentes as $key => $item)
                                <option value="{{ $item->estado }}">{{ $item->estado }}</option>
                            @endforeach
                        </select>
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
@can('incidentes_de_seguridad_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.incidentes-de-seguridads.massDestroy') }}",
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
    ajax: "{{ route('admin.incidentes-de-seguridads.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'folio', name: 'folio' },
{ data: 'resumen', name: 'resumen' },
{ data: 'prioridad', name: 'prioridad' },
{ data: 'fechaocurrencia', name: 'fechaocurrencia' },
{ data: 'activo', name: 'activos.descripcion' },
{ data: 'clasificacion', name: 'clasificacion' },
{ data: 'estado_estado', name: 'estado.estado' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-IncidentesDeSeguridad').DataTable(dtOverrideGlobals);
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
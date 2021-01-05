@extends('layouts.admin')
@section('content')
@can('registromejora_create')
<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Registro de Mejoras</strong></h3>
    </div>
    <div style="margin-bottom: 10px; margin-left:12px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.registromejoras.create') }}">
                  Agregar <strong>+<strong>
            </a>
        </div>
    </div>
@endcan


    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Registromejora">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.nombre_reporta') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.nombre') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.prioridad') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.clasificacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.descripcion') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.responsableimplementacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.participantes') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.recursos') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.beneficios') }}
                    </th>
                    <th>
                        {{ trans('cruds.registromejora.fields.valida') }}
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
                            @foreach(App\Models\Registromejora::PRIORIDAD_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($users as $key => $item)
                                <option value="{{ $item->name }}">{{ $item->name }}</option>
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
@can('registromejora_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.registromejoras.massDestroy') }}",
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
    ajax: "{{ route('admin.registromejoras.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'nombre_reporta_name', name: 'nombre_reporta.name' },
{ data: 'nombre', name: 'nombre' },
{ data: 'prioridad', name: 'prioridad' },
{ data: 'clasificacion', name: 'clasificacion' },
{ data: 'descripcion', name: 'descripcion' },
{ data: 'responsableimplementacion_name', name: 'responsableimplementacion.name' },
{ data: 'participantes', name: 'participantes' },
{ data: 'recursos', name: 'recursos' },
{ data: 'beneficios', name: 'beneficios' },
{ data: 'valida_name', name: 'valida.name' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-Registromejora').DataTable(dtOverrideGlobals);
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

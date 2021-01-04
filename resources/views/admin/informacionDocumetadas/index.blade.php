@extends('layouts.admin')
@section('content')
@can('informacion_documetada_create')

<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Información Documentada</strong></h3>
    </div>

    <div style="margin-bottom: 10px; margin-left:10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.informacion-documetadas.create') }}">
                  Agregar <strong>+<strong>
            </a>
        </div>
    </div>
@endcan

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-InformacionDocumetada">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.titulodocumento') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.tipodocumento') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.identificador') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.version') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.politicas') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.contenido') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.elaboro') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.reviso') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.aprobacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.informacionDocumetada.fields.logotipo') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\InformacionDocumetada::TIPODOCUMENTO_SELECT as $key => $item)
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
                            @foreach($politica_sgsis as $key => $item)
                                <option value="{{ $item->politicasgsi }}">{{ $item->politicasgsi }}</option>
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
@can('informacion_documetada_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.informacion-documetadas.massDestroy') }}",
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
    ajax: "{{ route('admin.informacion-documetadas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'titulodocumento', name: 'titulodocumento' },
{ data: 'tipodocumento', name: 'tipodocumento' },
{ data: 'identificador', name: 'identificador' },
{ data: 'version', name: 'version' },
{ data: 'politicas', name: 'politicas.politicasgsi' },
{ data: 'contenido', name: 'contenido' },
{ data: 'elaboro_name', name: 'elaboro.name' },
{ data: 'reviso_name', name: 'reviso.name' },
{ data: 'aprobacion_name', name: 'aprobacion.name' },
{ data: 'logotipo', name: 'logotipo', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-InformacionDocumetada').DataTable(dtOverrideGlobals);
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

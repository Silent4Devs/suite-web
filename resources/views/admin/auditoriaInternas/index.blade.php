@extends('layouts.admin')
@section('content')
@can('auditoria_interna_create')

@endcan
<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Auditoría Interna</strong></h3>
    </div>

    <div style="margin-bottom: 10px; margin-left:10px;" class="row ml-4">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.auditoria-internas.create') }}">
                    Agregar <strong>+</strong>
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AuditoriaInterna">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.alcance') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.clausulas') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.fechaauditoria') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.auditorlider') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.equipoauditoria') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.hallazgos') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.cheknoconformidadmenor') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmenor') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.checknoconformidadmayor') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.totalnoconformidadmayor') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.checkobservacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.totalobservacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.checkmejora') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.totalmejora') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaInterna.fields.logotipo') }}
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
                            @foreach($controles as $key => $item)
                                <option value="{{ $item->control }}">{{ $item->control }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
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
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
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
@can('auditoria_interna_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.auditoria-internas.massDestroy') }}",
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
    ajax: "{{ route('admin.auditoria-internas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'alcance', name: 'alcance' },
{ data: 'clausulas_control', name: 'clausulas.control' },
{ data: 'fechaauditoria', name: 'fechaauditoria' },
{ data: 'auditorlider_name', name: 'auditorlider.name' },
{ data: 'equipoauditoria_name', name: 'equipoauditoria.name' },
{ data: 'hallazgos', name: 'hallazgos' },
{ data: 'cheknoconformidadmenor', name: 'cheknoconformidadmenor' },
{ data: 'totalnoconformidadmenor', name: 'totalnoconformidadmenor' },
{ data: 'checknoconformidadmayor', name: 'checknoconformidadmayor' },
{ data: 'totalnoconformidadmayor', name: 'totalnoconformidadmayor' },
{ data: 'checkobservacion', name: 'checkobservacion' },
{ data: 'totalobservacion', name: 'totalobservacion' },
{ data: 'checkmejora', name: 'checkmejora' },
{ data: 'totalmejora', name: 'totalmejora' },
{ data: 'logotipo', name: 'logotipo', sortable: false, searchable: false },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AuditoriaInterna').DataTable(dtOverrideGlobals);
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

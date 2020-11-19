@extends('layouts.admin')
@section('content')
@can('auditoria_anual_create')
    
@endcan
<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center" style="margin-top: -40px">
         <h3 class="mb-1  text-center text-white">
        {{ trans('cruds.auditoriaAnual.title_singular') }} {{ trans('global.list') }} </h3>
    </div>

    <div style="margin-bottom: 10px;" class="row ml-4">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.auditoria-anuals.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.auditoriaAnual.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-AuditoriaAnual">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.tipo') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.fechainicio') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.dias') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.auditorlider') }}
                    </th>
                    <th>
                        {{ trans('cruds.auditoriaAnual.fields.observaciones') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\AuditoriaAnual::TIPO_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
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
@can('auditoria_anual_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.auditoria-anuals.massDestroy') }}",
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
    ajax: "{{ route('admin.auditoria-anuals.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'tipo', name: 'tipo' },
{ data: 'fechainicio', name: 'fechainicio' },
{ data: 'dias', name: 'dias' },
{ data: 'auditorlider_name', name: 'auditorlider.name' },
{ data: 'observaciones', name: 'observaciones' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-AuditoriaAnual').DataTable(dtOverrideGlobals);
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
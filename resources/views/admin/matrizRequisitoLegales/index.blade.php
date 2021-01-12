@extends('layouts.admin')
@section('content')
@can('matriz_requisito_legale_create')

<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong>Matriz de Requisitos Legales</strong></h3>
    </div>

    <div style="margin-bottom: 10px; margin-left:10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.matriz-requisito-legales.create') }}">
                Agregar <strong>+</strong>
            </a>
        </div>
    </div>
@endcan

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MatrizRequisitoLegale">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.nombrerequisito') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.fechaexpedicion') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.fechavigor') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.requisitoacumplir') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.cumplerequisito') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.formacumple') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.periodicidad_cumplimiento') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRequisitoLegale.fields.fechaverificacion') }}
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
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\MatrizRequisitoLegale::CUMPLEREQUISITO_SELECT as $key => $item)
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
@can('matriz_requisito_legale_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.matriz-requisito-legales.massDestroy') }}",
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
    ajax: "{{ route('admin.matriz-requisito-legales.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'nombrerequisito', name: 'nombrerequisito' },
{ data: 'fechaexpedicion', name: 'fechaexpedicion' },
{ data: 'fechavigor', name: 'fechavigor' },
{ data: 'requisitoacumplir', name: 'requisitoacumplir' },
{ data: 'cumplerequisito', name: 'cumplerequisito' },
{ data: 'formacumple', name: 'formacumple' },
{ data: 'periodicidad_cumplimiento', name: 'periodicidad_cumplimiento' },
{ data: 'fechaverificacion', name: 'fechaverificacion' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MatrizRequisitoLegale').DataTable(dtOverrideGlobals);
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

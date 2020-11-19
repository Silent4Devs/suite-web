@extends('layouts.admin')
@section('content')
@can('indicadores_sgsi_create')
    
@endcan
<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center" style="margin-top: -40px">
         <h3 class="mb-1  text-center text-white"><strong>
        {{ trans('cruds.indicadoresSgsi.title_singular') }} {{ trans('global.list') }}</strong></h3>
    </div>

    <div style="margin-bottom: 10px;" class="row ml-4">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.indicadores-sgsis.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.indicadoresSgsi.title_singular') }}
            </a>
        </div>
    </div>

    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-IndicadoresSgsi">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.control') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.titulo') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.responsable') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.formula') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.frecuencia') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.unidadmedida') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.meta') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.semaforo') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.enero') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.febrero') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.marzo') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.abril') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.mayo') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.junio') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.julio') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.agosto') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.septiembre') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.octubre') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.noviembre') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.diciembre') }}
                    </th>
                    <th>
                        {{ trans('cruds.indicadoresSgsi.fields.anio') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\IndicadoresSgsi::FRECUENCIA_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\IndicadoresSgsi::UNIDADMEDIDA_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\IndicadoresSgsi::SEMAFORO_SELECT as $key => $item)
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
@can('indicadores_sgsi_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.indicadores-sgsis.massDestroy') }}",
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
    ajax: "{{ route('admin.indicadores-sgsis.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'control', name: 'control' },
{ data: 'titulo', name: 'titulo' },
{ data: 'responsable_name', name: 'responsable.name' },
{ data: 'formula', name: 'formula' },
{ data: 'frecuencia', name: 'frecuencia' },
{ data: 'unidadmedida', name: 'unidadmedida' },
{ data: 'meta', name: 'meta' },
{ data: 'semaforo', name: 'semaforo' },
{ data: 'enero', name: 'enero' },
{ data: 'febrero', name: 'febrero' },
{ data: 'marzo', name: 'marzo' },
{ data: 'abril', name: 'abril' },
{ data: 'mayo', name: 'mayo' },
{ data: 'junio', name: 'junio' },
{ data: 'julio', name: 'julio' },
{ data: 'agosto', name: 'agosto' },
{ data: 'septiembre', name: 'septiembre' },
{ data: 'octubre', name: 'octubre' },
{ data: 'noviembre', name: 'noviembre' },
{ data: 'diciembre', name: 'diciembre' },
{ data: 'anio', name: 'anio' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-IndicadoresSgsi').DataTable(dtOverrideGlobals);
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
@extends('layouts.admin')
@section('content')
@can('matriz_riesgo_create')

<div class="card mt-5">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center "
         style="margin-top:-40px; ">
        <h3 class="mb-2  text-center text-white"><strong><i class="fas fa-table letra_blanca" style="font-size:20pt; margin-right:15px;" ></i>Matriz de Riesgo</strong></h3>
    </div>

    <div style="margin-bottom:10px; margin-left:12px;"  class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.matriz-riesgos.create') }}">
                Agregar Riesgo
            </a>
        </div>
    </div>
@endcan


    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-MatrizRiesgo">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.proceso') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.activo') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.responsableproceso') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.amenaza') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.vulnerabilidad') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.descripcionriesgo') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.tipo_riesgo') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.confidencialidad') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.integridad') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.disponibilidad') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.resultadoponderacion') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.probabilidad') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.impacto') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.nivelriesgo') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.riesgototal') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.riesgoresidual') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.controles') }}
                    </th>
                    <th>
                        {{ trans('cruds.matrizRiesgo.fields.justificacion') }}
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
                            @foreach($activos as $key => $item)
                                <option value="{{ $item->descripcion }}">{{ $item->descripcion }}</option>
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\MatrizRiesgo::TIPO_RIESGO_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                              @endforeach
                        </select>
                    </td>
                    <td>
                      <select class="search" strict="true">
                          <option value>{{ trans('global.all') }}</option>
                          @if($errors->has('confidencialidad'))
                              <option value="{{ $key }}">{{ $item }}</option>
                        @endif
                      </select>
                    </td>
                    <td>
                      <select class="search" strict="true">
                          <option value>{{ trans('global.all') }}</option>
                          @if($errors->has('integridad'))
                              <option value="{{ $key }}">{{ $item }}</option>
                          @endif
                      </select>
                    </td>
                    <td>
                      <select class="search" strict="true">
                          <option value>{{ trans('global.all') }}</option>
                        @if($errors->has('disponibilidad'))
                              <option value="{{ $key }}">{{ $item }}</option>
                          @endif
                      </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\MatrizRiesgo::PROBABILIDAD_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\MatrizRiesgo::IMPACTO_SELECT as $key => $item)
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
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach($controles as $key => $item)
                                <option value="{{ $item->numero }}">{{ $item->numero }}</option>
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
@can('matriz_riesgo_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.matriz-riesgos.massDestroy') }}",
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
    ajax: "{{ route('admin.matriz-riesgos.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'proceso', name: 'proceso' },
{ data: 'activo_descripcion', name: 'activo.descripcion' },
{ data: 'responsableproceso', name: 'responsableproceso' },
{ data: 'amenaza', name: 'amenaza' },
{ data: 'vulnerabilidad', name: 'vulnerabilidad' },
{ data: 'descripcionriesgo', name: 'descripcionriesgo' },
{ data: 'tipo_riesgo', name: 'tipo_riesgo' },
{ data: 'confidencialidad', name: 'confidencialidad' },
{ data: 'integridad', name: 'integridad' },
{ data: 'disponibilidad', name: 'disponibilidad' },
{ data: 'resultadoponderacion', name: 'resultadoponderacion' },
{ data: 'probabilidad', name: 'probabilidad' },
{ data: 'impacto', name: 'impacto' },
{ data: 'nivelriesgo', name: 'nivelriesgo' },
{ data: 'riesgototal', name: 'riesgototal' },
{ data: 'riesgoresidual', name: 'riesgoresidual' },
{ data: 'controles_numero', name: 'controles.numero' },
{ data: 'justificacion', name: 'justificacion' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-MatrizRiesgo').DataTable(dtOverrideGlobals);
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

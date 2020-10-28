@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('accion_correctiva_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.accion-correctivas.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.accionCorrectiva.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.accionCorrectiva.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AccionCorrectiva">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.nombrereporta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.puestoreporta') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.nombreregistra') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.puestoregistra') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.tema') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.causaorigen') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.descripcion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.metodo_causa') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.solucion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.cierre_accion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.estatus') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.fecha_compromiso') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.fecha_verificacion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.responsable_accion') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.nombre_autoriza') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.accionCorrectiva.fields.documentometodo') }}
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
                                            @foreach($puestos as $key => $item)
                                                <option value="{{ $item->puesto }}">{{ $item->puesto }}</option>
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
                                            @foreach($puestos as $key => $item)
                                                <option value="{{ $item->puesto }}">{{ $item->puesto }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                                    </td>
                                    <td>
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\AccionCorrectiva::METODO_CAUSA_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
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
                                        <select class="search" strict="true">
                                            <option value>{{ trans('global.all') }}</option>
                                            @foreach(App\Models\AccionCorrectiva::ESTATUS_SELECT as $key => $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
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
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($accionCorrectivas as $key => $accionCorrectiva)
                                    <tr data-entry-id="{{ $accionCorrectiva->id }}">
                                        <td>
                                            {{ $accionCorrectiva->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->fecharegistro ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->nombrereporta->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->puestoreporta->puesto ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->nombreregistra->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->puestoregistra->puesto ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->tema ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT[$accionCorrectiva->causaorigen] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->descripcion ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AccionCorrectiva::METODO_CAUSA_SELECT[$accionCorrectiva->metodo_causa] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->solucion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->cierre_accion ?? '' }}
                                        </td>
                                        <td>
                                            {{ App\Models\AccionCorrectiva::ESTATUS_SELECT[$accionCorrectiva->estatus] ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->fecha_compromiso ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->fecha_verificacion ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->responsable_accion->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $accionCorrectiva->nombre_autoriza->name ?? '' }}
                                        </td>
                                        <td>
                                            @if($accionCorrectiva->documentometodo)
                                                <a href="{{ $accionCorrectiva->documentometodo->getUrl() }}" target="_blank">
                                                    {{ trans('global.view_file') }}
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('accion_correctiva_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.accion-correctivas.show', $accionCorrectiva->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('accion_correctiva_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.accion-correctivas.edit', $accionCorrectiva->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('accion_correctiva_delete')
                                                <form action="{{ route('frontend.accion-correctivas.destroy', $accionCorrectiva->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('accion_correctiva_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.accion-correctivas.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
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

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-AccionCorrectiva:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
})

</script>
@endsection
@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('auditoria_interna_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.auditoria-internas.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.auditoriaInterna.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.auditoriaInterna.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-AuditoriaInterna">
                            <thead>
                                <tr>
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
                            <tbody>
                                @foreach($auditoriaInternas as $key => $auditoriaInterna)
                                    <tr data-entry-id="{{ $auditoriaInterna->id }}">
                                        <td>
                                            {{ $auditoriaInterna->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->alcance ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->clausulas->control ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->fechaauditoria ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->auditorlider->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->equipoauditoria->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->hallazgos ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $auditoriaInterna->cheknoconformidadmenor ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->cheknoconformidadmenor ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->totalnoconformidadmenor ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $auditoriaInterna->checknoconformidadmayor ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->checknoconformidadmayor ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->totalnoconformidadmayor ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $auditoriaInterna->checkobservacion ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->checkobservacion ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->totalobservacion ?? '' }}
                                        </td>
                                        <td>
                                            <span style="display:none">{{ $auditoriaInterna->checkmejora ?? '' }}</span>
                                            <input type="checkbox" disabled="disabled" {{ $auditoriaInterna->checkmejora ? 'checked' : '' }}>
                                        </td>
                                        <td>
                                            {{ $auditoriaInterna->totalmejora ?? '' }}
                                        </td>
                                        <td>
                                            @if($auditoriaInterna->logotipo)
                                                <a href="{{ $auditoriaInterna->logotipo->getUrl() }}" target="_blank" style="display: inline-block">
                                                    <img src="{{ $auditoriaInterna->logotipo->getUrl('thumb') }}">
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @can('auditoria_interna_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.auditoria-internas.show', $auditoriaInterna->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('auditoria_interna_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.auditoria-internas.edit', $auditoriaInterna->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('auditoria_interna_delete')
                                                <form action="{{ route('frontend.auditoria-internas.destroy', $auditoriaInterna->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('auditoria_interna_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.auditoria-internas.massDestroy') }}",
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
  let table = $('.datatable-AuditoriaInterna:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
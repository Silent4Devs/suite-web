@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @can('revision_direccion_create')
                <div style="margin-bottom: 10px;" class="row">
                    <div class="col-lg-12">
                        <a class="btn btn-success" href="{{ route('frontend.revision-direccions.create') }}">
                            {{ trans('global.add') }} {{ trans('cruds.revisionDireccion.title_singular') }}
                        </a>
                    </div>
                </div>
            @endcan
            <div class="card">
                <div class="card-header">
                    {{ trans('cruds.revisionDireccion.title_singular') }} {{ trans('global.list') }}
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable datatable-RevisionDireccion">
                            <thead>
                                <tr>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.id') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.estadorevisionesprevias') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.cambiosinternosexternos') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.retroalimentaciondesempeno') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.retroalimentacionpartesinteresadas') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.resultadosriesgos') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.oportunidadesmejoracontinua') }}
                                    </th>
                                    <th>
                                        {{ trans('cruds.revisionDireccion.fields.acuerdoscambios') }}
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
                            <tbody>
                                @foreach($revisionDireccions as $key => $revisionDireccion)
                                    <tr data-entry-id="{{ $revisionDireccion->id }}">
                                        <td>
                                            {{ $revisionDireccion->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->estadorevisionesprevias ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->cambiosinternosexternos ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->retroalimentaciondesempeno ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->retroalimentacionpartesinteresadas ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->resultadosriesgos ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->oportunidadesmejoracontinua ?? '' }}
                                        </td>
                                        <td>
                                            {{ $revisionDireccion->acuerdoscambios ?? '' }}
                                        </td>
                                        <td>
                                            @can('revision_direccion_show')
                                                <a class="btn btn-xs btn-primary" href="{{ route('frontend.revision-direccions.show', $revisionDireccion->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan

                                            @can('revision_direccion_edit')
                                                <a class="btn btn-xs btn-info" href="{{ route('frontend.revision-direccions.edit', $revisionDireccion->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('revision_direccion_delete')
                                                <form action="{{ route('frontend.revision-direccions.destroy', $revisionDireccion->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('revision_direccion_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('frontend.revision-direccions.massDestroy') }}",
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
  let table = $('.datatable-RevisionDireccion:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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
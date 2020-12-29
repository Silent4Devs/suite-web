<div class="card">
    <div class="card-body">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PlanaccionCorrectiva">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}
                    </th>
                    <th>
                        {{ trans('cruds.accionCorrectiva.fields.fecharegistro') }}
                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.actividad') }}
                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.responsable') }}
                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}
                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.estatus') }}
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
                            <option value=""></option>
                          
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
              
                           <option value=""></option>
                           
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                        <option value=""></option>
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>


@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('planaccion_correctiva_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.planaccion-correctivas.massDestroy') }}",
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
    ajax: "{{ route('admin.planaccion-correctivas.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'accioncorrectiva_tema', name: 'accioncorrectiva.tema' },
{ data: 'accioncorrectiva.fecharegistro', name: 'accioncorrectiva.fecharegistro' },
{ data: 'actividad', name: 'actividad' },
{ data: 'responsable_name', name: 'responsable.name' },
{ data: 'fechacompromiso', name: 'fechacompromiso' },
{ data: 'estatus', name: 'estatus' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-PlanaccionCorrectiva').DataTable(dtOverrideGlobals);
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
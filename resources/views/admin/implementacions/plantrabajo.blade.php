

<div class="row">
        <div class="col-lg-12">
<a class="btn" style="background-color:#048c74;color:white;" href="admin/gantt'); }}">
                Cronograma
            </a>
        </div>
        
</div>
@can('plan_base_actividade_create')
    <div style="margin-top:-30px; margin-right: 10px;" class="row text-right">
        <div class="col-lg-12">
            <a  href="{{ route('admin.plan-base-actividades.create') }}">
               
                <i class="fas fa-plus-circle fa-3x" style="color:#048c74"></i>
            </a>
        </div>
    </div>
@endcan
    
<div class="card">
 

    <div class="card-body">
        <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-PlanBaseActividade">
            <thead>
                <tr>
                    <th width="10" >

                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.actividad') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.actividad_padre') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.ejecutar') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.guia') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.estatus') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.responsable') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.colaborador') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.fecha_inicio') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.fecha_fin') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.compromiso') }}
                    </th>
                    <th>
                        {{ trans('cruds.planBaseActividade.fields.real') }}
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
                        
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                           
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                          
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                           
                        </select>
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                    
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
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
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('plan_base_actividade_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.plan-base-actividades.massDestroy') }}",
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
    ajax: "{{ route('admin.plan-base-actividades.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'actividad', name: 'actividad' },
{ data: 'actividad_padre_actividad', name: 'actividad_padre.actividad' },
{ data: 'ejecutar_ejecutar', name: 'ejecutar.ejecutar' },
{ data: 'guia', name: 'guia', sortable: false, searchable: false },
{ data: 'estatus_estado', name: 'estatus.estado' },
{ data: 'responsable_name', name: 'responsable.name' },
{ data: 'colaborador_name', name: 'colaborador.name' },
{ data: 'fecha_inicio', name: 'fecha_inicio' },
{ data: 'fecha_fin', name: 'fecha_fin' },
{ data: 'compromiso', name: 'compromiso' },
{ data: 'real', name: 'real' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 50,
  };
  let table = $('.datatable-PlanBaseActividade').DataTable(dtOverrideGlobals);
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
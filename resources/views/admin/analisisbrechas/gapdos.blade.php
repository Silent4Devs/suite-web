      <div class="row">
          <div class="col-12 col-md-12 col-sm-12">
              <div class="text-white card-header font-weight-bold" style="text-align:center; background-color:#048c74; margin-top:-30px;" align="justify">
              GAP 02: IMPLEMENTACIÓN DEL PLAN DE SEGURIDAD Y PRIVACIDAD DE LA INFORMACIÓN (40%)
              </div>

              <!-- Card -->
              <div class="card" style=" border:none; margin-left:10px; margin-right:10px;">
                  <!-- Card content -->
                  <div class="card-body">
                      <!-- Text -->
                      <p class="card-text" align="justify">Implementacion del Plan de Seguridad y Privacidad. Tiene un peso del 40% del total del componente: 20% - Identificacion y analisis de riesgos, 20% - Plan de tratamiento de riesgos, clasificacion y gestion de controles.
                      </p>
                      <p> <strong>INSTRUCCIONES:</strong> Por favor, conteste el siguiente cuestionario de acuerdo con los siguientes parámetros:</p>



              <table
                  class="table table-bordered table-striped table-hover ajaxTable datatable">
                  <thead>

                  <tr>
                      <th class="text-center text-white bg-info">Cumple satisfactoriamente</th>
                      <th class="font-weight-normal">Existe, es gestionado, se está cumpliendo con lo que la norma ISO 27001  solicita, está documentado,  es conocido y aplicado por todos los involucrados en el SGSI.  cumple 100%.
                  </th>
                  <tr>
                      <th class="text-center text-white bg-warning" >Cumple parcialmente</th>
                      <th class="font-weight-normal">Lo que la norma requiere  (ISO27001 versión 2013)  se está haciendo de manera parcial, se está haciendo diferente, no está documentado, se definió y aprobó pero no se gestiona.
                  </th>
                  <tr>
                      <th class="text-center text-white bg-danger"><p style="margin-top:-12px;">No cumple</p></th>
                      <th class="font-weight-normal">Existe, es gestionado, se está cumpliendo con lo que la norma ISO 27001  solicita, está documentado,  es conocido y aplicado por todos los involucrados en el SGSI.  cumple 100%.
                  </th>
                  <tr>
                      <th style="background-color: #ced2d8;  margin-top:-20px;" class="text-center" style="color: #000;"><p  style="margin-top:-20px;"> No aplica </p></th>
                      <th class="font-weight-normal">El control no es aplicable para la entidad. En el campo evidencia por favor indicar la justificación respectiva de su no aplicabilidad.
                  </th>
                  </tr>
                  </thead>

              </table>


              <table class="table table-bordered table-striped table-hover ajaxTable datatable datatable-GapDo">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.anexo_indice') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.control') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.descripcion_control') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.valoracion') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.evidencia') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapDo.fields.recomendacion') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\GapDo::VALORACION_SELECT as $key => $item)
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
                </tr>
            </thead>
        </table>


            </div>
              <!-- Card body -->
        </div>
        <!-- Card -->

    </div>

</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('gap_do_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.gap-dos.massDestroy') }}",
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
    ajax: "{{ route('admin.gap-dos.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'anexo_indice', name: 'anexo_indice' },
{ data: 'control', name: 'control' },
{ data: 'descripcion_control', name: 'descripcion_control' },
{ data: 'valoracion', name: 'valoracion' },
{ data: 'evidencia', name: 'evidencia' },
{ data: 'recomendacion', name: 'recomendacion' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-GapDo').DataTable(dtOverrideGlobals);
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });

let visibleColumnsIndexes = null;
$('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value

      let index = $(this).parent().index()
      if (visibleColumnsIndexes !== null) {
        index = visibleColumnsIndexes[index]
      }

      table
        .column(index)
        .search(value, strict)
        .draw()
  });
table.on('column-visibility.dt', function(e, settings, column, state) {
      visibleColumnsIndexes = []
      table.columns(":visible").every(function(colIdx) {
          visibleColumnsIndexes.push(colIdx);
      });
  })
});

</script>
@endsection

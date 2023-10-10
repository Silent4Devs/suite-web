<div class="row">
          <div class="col-12 col-md-12 col-sm-12">
              <div class="card-header font-weight-bold  text-white" style="text-align:center; background-color:#048c74; margin-top:-30px;" align="justify">
              GAP 03:  MONITOREO Y MEJORA CONTINUA (30%)
              </div>

              <!-- Card -->
              <div class="card" style="border:none; margin-left:10px; margin-right:10px;">
                  <!-- Card content -->
                  <div class="card-body">
                      <!-- Text -->
                      <p class="card-text" align="justify">Monitoreo y mejoramiento continuo. Tiene un peso del 30% del total del componente: 20% - Actividades de seguimiento, medicion, analisis y evaluacion. 10% - Revision e Implementacion de Acciones de Mejora.
                      </p>
                      <p>
                       <strong>INSTRUCCIONES:</strong> Por favor, conteste el siguiente cuestionario de acuerdo con los siguientes parámetros:
                      </p>

                      <table cellspacing="0" cellpadding="15px" style="margin-top: 50px; margin-bottom: 25px;">
                        <tr>
                            <td class="bg-success">
                                Cumple satisfactoriamente
                            </td>
                            <td>
                              Existe, es gestionado, se está cumpliendo con lo que la norma ISO 27001  solicita, está documentado,  es conocido y aplicado por todos los involucrados en el SGSI.  cumple 100%.
                            </td>
                        </tr>
                        <tr>
                            <td class="bg-warning">
                                "Cumple
                                parcialmente"
                            </td>
                            <td>
                                Lo que la norma requiere  (ISO27001 versión 2013)  se está haciendo de manera parcial, se está haciendo diferente, no está documentado, se definió y aprobó pero no se gestiona
                            </td>
                        </tr>
                         <tr>
                            <td class="bg-danger">
                                No cumple
                            </td>
                            <td>
                                No existe y/o no se está haciendo.
                            </td>
                        </tr>
                      </table>
                      <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-GapTre">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.gapTre.fields.id') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapTre.fields.pregunta') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapTre.fields.valoracion') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapTre.fields.evidencia') }}
                    </th>
                    <th>
                        {{ trans('cruds.gapTre.fields.recomendacion') }}
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
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\GapTre::VALORACION_SELECT as $key => $item)
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

              </div>
              <!-- Card -->
          </div>

      </div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('gap_tre_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.gap-tres.massDestroy') }}",
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
    ajax: "{{ route('admin.gap-tres.index') }}",
    columns: [
      { data: 'placeholder', name: 'placeholder' },
{ data: 'id', name: 'id' },
{ data: 'pregunta', name: 'pregunta' },
{ data: 'valoracion', name: 'valoracion' },
{ data: 'evidencia', name: 'evidencia' },
{ data: 'recomendacion', name: 'recomendacion' },
{ data: 'actions', name: '{{ trans('global.actions') }}' }
    ],
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  };
  let table = $('.datatable-GapTre').DataTable(dtOverrideGlobals);
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

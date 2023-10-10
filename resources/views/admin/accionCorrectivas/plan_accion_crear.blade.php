@can('planaccion_correctiva_create')
<h5 class="col-12 titulo_general_funcion">Plan acción</h5>
<div class="card mt-5" style="border: none;">
    <div style="margin-bottom: 10px; margin-left:12px; border:none;" class="row">
        <div class="col-12 text-right">
            <div class="btn btn-success boton_verde">
                
                Agregar Actividad
            </div>
        </div>
    </div>
@endcan
<div class="card" style="border: none;">

    <div class="card-body" style="border: none;">
        <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-PlanaccionCorrectiva">
            <thead>
                <tr>
                    <th width="10">

                    </th>
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.id') }}
                    </th>
      <!--  
                    <th>
                        {{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}
                    </th>
             -->
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
                 <!--
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            <option></option>
                        </select>
                    </td>
                -->
                    <td>
                    </td>
                    <td>
                        <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                    </td>
                    <td>
                        <select class="search">
                            <option value>{{ trans('global.all') }}</option>
                            
                            <option></option>
                        </select>
                    </td>
                    <td>
                    </td>
                    <td>
                        <select class="search" strict="true">
                            <option value>{{ trans('global.all') }}</option>
                            @foreach(App\Models\PlanaccionCorrectiva::ESTATUS_SELECT as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                    </td>
                </tr>
            </thead>
        </table>
    </div>
</div>

<style type="text/css">
    .fondo_negro{
        width: 100%;
        height: 100%;
        position: fixed;
        left: 0;
        top: 0;
        background-color: rgba(0,0,0,0.7);
        z-index: 99999999999;
        display: none;
    }
    .ventana{
        width: 90%;
        max-width: 700px;
        height: 500px;
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
        background-color: rgba(255,255,255,0);
        overflow-y: scroll;
        padding: 25px;
        padding-top: 60px;
    }
</style>

<div class="fondo_negro">
    <div class="ventana">
        
        <div class="card mt-4">
            <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
                <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Plan de Acción  </h3>
            </div>

            <div class="card-body">


            <form method="POST" action="{{ route("admin.planaccion-correctivas.store") }}" enctype="multipart/form-data" class="row">
                @csrf
            <!--    
                <div class="form-group col-md-6">
                    <label for="accioncorrectiva_id"><i class="fas fa-exclamation-triangle iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva') }}</label>
                    <select class="form-control select2 {{ $errors->has('accioncorrectiva') ? 'is-invalid' : '' }}" name="accioncorrectiva_id" id="accioncorrectiva_id">
                        <option></option>
                    </select>
                    @if($errors->has('accioncorrectiva'))
                        <div class="invalid-feedback">
                            {{ $errors->first('accioncorrectiva') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.accioncorrectiva_helper') }}</span>
                </div>
            -->
                <div class="form-group col-12">
                    <label class="required" for="actividad"><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.actividad') }}</label>
                    <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text" name="actividad" id="actividad" value="{{ old('actividad', '') }}" required>
                    @if($errors->has('actividad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('actividad') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.actividad_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="responsable_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.responsable') }}</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}" name="responsable_id" id="responsable_id">
                        <option></option>
                    </select>
                    @if($errors->has('responsable'))
                        <div class="invalid-feedback">
                            {{ $errors->first('responsable') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.responsable_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="fechacompromiso"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}</label>
                    <input class="form-control date {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}" type="text" name="fechacompromiso" id="fechacompromiso" value="{{ old('fechacompromiso') }}">
                    @if($errors->has('fechacompromiso'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fechacompromiso') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso_helper') }}</span>
                </div>
                <div class="form-group col-12">
                    <label><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.estatus') }}</label>
                    <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus" id="estatus">
                        <option value disabled {{ old('estatus', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                        @foreach(App\Models\PlanaccionCorrectiva::ESTATUS_SELECT as $key => $label)
                            <option value="{{ $key }}" {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('estatus'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.estatus_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right">
                    <div class="btn btn btn-outline-danger boton_cancelar">Cancelar</div>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>

                </div>
            </form>
        </div>
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
//{ data: 'accioncorrectiva_tema', name: 'accioncorrectiva.tema' },
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



<script type="text/javascript">
    $(".boton_verde").click(function(){
        $(".fondo_negro").fadeIn(100);
    });
    $(".boton_cancelar").click(function(){
        $(".fondo_negro").fadeOut(100);
    });
</script>

@endsection
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>


<form method="POST" action="{{ route("admin.planaccion-correctivas.store") }}" enctype="multipart/form-data" class="row">
    @csrf



    <div class="form-group col-12">
        <label class="required" for="actividad"><i class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.actividad') }}
        </label>
        <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text" name="actividad" id="actividad" value="{{ old('actividad', '') }}" required>
        @if($errors->has('actividad'))
        <div class="invalid-feedback">
            {{ $errors->first('actividad') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.actividad_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="responsable_id"><i class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.responsable') }}
        </label>
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
        <label for="fechacompromiso"><i class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}
        </label>
        <input class="form-control date {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}" type="text" name="fechacompromiso" id="fechacompromiso" value="{{ old('fechacompromiso') }}">
        @if($errors->has('fechacompromiso'))
        <div class="invalid-feedback">
            {{ $errors->first('fechacompromiso') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso_helper') }}</span>
    </div>
    <div class="form-group col-12">
        <label><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.estatus') }}
        </label>
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

        <a class="btn btn-danger" href="{{ route("admin.accion-correctivas.index") }}">Cancelar</a>
        <button class="btn btn-success " type="submit">
            {{ trans('global.save') }}
        </button>

    </div>
</form>





<table class="table" id="editplanact" style="font-size: 12px;">
    <thead class="thead-dark">
        <tr>
            <th scope="col">NO</th>
            <th scope="col">Actividad</th>
            <th scope="col">Fecha compromiso</th>
            <th scope="col">Estado</th>
            <th scope="col">Responsable</th>
        </tr>
    </thead>
    <tbody>
        <tr>

            @foreach($planaccionCorrectiva as $planactiv)
            <td>{​​​​​{​​​​​$planactiv->id}​​​​​}​​​​​</td>
            <td>{​​​​​{​​​​​$planactiv->actividad}​​​​​}​​​​​</td>
            <td><a href="#" data-type="text" data-pk="{​​​​​{​​​​​$planactiv->id}​​​​​}​​​​​" data-url="{​​​​​{​​​​​url("/accion-correctivas/editarplan/$planactiv->id")}​​​​​}​​​​​" data-title="Descripción" data-value="{​​​​​{​​​​​$planactiv->fechacompromiso}​​​​​}​​​​​" class="fechacompromi" data-name="fechacompromi">
                </a></td>
            <td><a href="#" data-type="text" data-pk="{​​​​​{​​​​​$planactiv->id}​​​​​}​​​​​" data-url="{​​​​​{​​​​​url("/accion-correctivas/editarplan/$planactiv->id")}​​​​​}​​​​​" data-title="Descripción" data-value="{​​​​​{​​​​​$planactiv->estatus}​​​​​}​​​​​" class="estado" data-name="estado">
                </a></td>
            <td><a href="#" data-type="text" data-pk="{​​​​​{​​​​​$planactiv->id}​​​​​}​​​​​" data-url="{​​​​​{​​​​​url("/accion-correctivas/editarplan/$planactiv->id")}​​​​​}​​​​​" data-title="Descripción" data-value="{​​​​​{​​​​​$planactiv->reponsable_id}​​​​​}​​​​​" class="responsbl" data-name="responsbl">
                </a></td>
            <!--<td>{​​​​​{​​​​​$planactiv->descripcion}​​​​​}​​​​​</td>-->
            {​​​​​!! Form::open(['route' => ['planaccionCorrectiva.destroy', $planactiv->id], 'method' => 'delete']) !!}​​​​​
            <td>
                <a href="{​​​​​{​​​​​ route('planaccionCorrectiva.edit', [$planactiv->id]) }​​​​​}​​​​​" class='btn btn-default px-3'><i class="fas fa-edit"></i></a>
            </td>
            <td>
                {​​​​​!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger px-3', 'onclick' => "return confirm('Are you sure?')"]) !!}​​​​​
            </td>
            {​​​​​!! Form::close() !!}​​​​​
        </tr>
        @endforeach



    </tbody>
</table>



<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.fn.editable.defaults.ajaxOptions = {​​​​​type: 'POST'}​​​​​;
        $(".fechacompromi").editable({
            mode: 'inline',
        });

        $(".estado").editable({
            mode: 'inline',
        });

        $(".responsbl").editable({
            mode: 'inline',
        });
    
    });
</script>
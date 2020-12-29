<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

                    <div class="collapse show" id="collapseactividad">
                        <div class="card card-body">

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
                                    {!! Html::decode(Form::text('accioncorrectivaid', $ids, ['id' => 'accioncorrectivaid', 'disabled'], ['class' => 'form-control mx-auto'])) !!}
                                    {{ Form::hidden('accioncorrectiva_id', $ids, ['id' => 'accioncorrectiva_id']) }}
                                </div>
            
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


                        </div>


                        <table class="table" style="font-size: 12px;">
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
                            @foreach($planaccion as $planac)
                                <tr>
                                    <th scope="row">
                                        {{$gapuno->id}}
                                    </th>
                                    <td>
                                        {{$gapuno->actitividad}}
                                    </td>
                                    <td>
                                      
                                    </td>
                                    <td>
                                        <a href="" class="update" data-pk="{{ $gapuno->id }}" data-type="text" data-name="evidencia" data-title="Actualizar evidencia">{{ $gapuno->evidencia }}</a>
                                    </td>
                                    <td>
                                    <input name="recomendacion" id="recomendacion{{ $gapuno->id }}" value="{{ $gapuno->recomendacion }}">
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    

</div>


<script>
    $(document).ready(function() {

        $.fn.editable.defaults.mode = 'popup';
        $.fn.editable.defaults.send = "always";

        $.fn.editable.defaults.params = function (params)
        {
            params._token = $("#_token").data("token");
            return params;
        };

        $('#investmentName').editable({

            type: 'text',
            url: '/',
            send: 'always'

        });
    });
</script>
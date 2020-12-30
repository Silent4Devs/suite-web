<form method="POST" action="{{url('admin/plan-correctivas-storeedit')}}" enctype="multipart/form-data"
      class="row">
    @csrf

    <div class="form-group col-12">

        {!! Html::decode(Form::label('id', '<i class="fas fa-file iconos-crear"></i>No. Acción Correctiva:')) !!}
        {!! Html::decode(Form::text('accioncorrectiva_id', $id, ['id' => 'accioncorrectivaid', 'disabled'], ['class' => 'form-control mx-auto'])) !!}
        {{ Form::hidden('accioncorrectiva_id', $id, ['id' => 'accioncorrectiva_id']) }}
    </div>
    <div class="form-group col-md-8">
        <label for="actividad"><i
                class="fas fa-bullseye iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.actividad') }}
        </label>
        <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text" name="actividad"
               id="actividad" value="{{ old('actividad', '') }}" required>
        @if($errors->has('actividad'))
            <div class="invalid-feedback">
                {{ $errors->first('actividad') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.actividad_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="responsable_id"><i
                class="fas fa-user-tag iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.responsable') }}
        </label>
        <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}" name="responsable_id"
                id="responsable_id" required>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        @if($errors->has('responsable'))
            <div class="invalid-feedback">
                {{ $errors->first('responsable') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.planaccionCorrectiva.fields.responsable_helper') }}</span>
    </div>
    <div class="form-group col-md-6">
        <label for="fechacompromiso"><i
                class="far fa-calendar-alt iconos-crear"></i>{{ trans('cruds.planaccionCorrectiva.fields.fechacompromiso') }}
        </label>
        <input class="form-control date {{ $errors->has('fechacompromiso') ? 'is-invalid' : '' }}" type="text"
               name="fechacompromiso" id="fechacompromiso" value="{{ old('fechacompromiso') }}" required>
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
        <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus" id="estatus" required>
            <option value
                    disabled {{ old('estatus', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\PlanaccionCorrectiva::ESTATUS_SELECT as $key => $label)
                <option
                    value="{{ $key }}" {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
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


<p>Total de registro encontrados en la acción: {{$Count}}</p>
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
    @foreach($PlanAccion as $item)
        <tr>
            <td>{{$item->id}}</td>
            <td><a href="#"
                   data-type="text"
                   data-pk="{{$item->id}}"
                   data-url="{{route("admin.planaccion-correctivas.update", $item->id)}}"
                   data-title="Actividad"
                   data-value="{{$item->actividad}}"
                   class="actividad"
                   data-name="actividad">
                </a></td>
            <td>
                <a href="#"
                   data-type="combodate"
                   data-pk="{{$item->id}}"
                   data-url="{{route("admin.planaccion-correctivas.update", $item->id)}}"
                   data-title="Seleccione fecha"
                   data-value="{{$item->fechacompromiso}}"
                   class="fechacompromiso"
                   data-name="fechacompromiso">
                </a>
            </td>
            <td><a href="#"
                   data-type="select"
                   data-pk="{{$item->id}}"
                   data-url="{{route("admin.planaccion-correctivas.update", $item->id)}}"
                   data-title="Seleccionar estatus"
                   data-value="{{$item->estatus}}"
                   class="estatus"
                   data-name="estatus">
                </a>
            </td>
            <td>
                <a href="#"
                   data-type="select"
                   data-pk="{{$item->id}}"
                   data-url="{{route("admin.planaccion-correctivas.update", $item->id)}}"
                   data-title="Seleccionar responsable"
                   data-value="{{$item->responsable_id}}"
                   class="responsable"
                   data-name="responsable">
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    @section('x-editable')
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        //categories table
        $(".actividad").editable({
            dataType: 'json',
            success: function (response, newValue) {
                console.log('Actualizado, response')
            }
        });

        $(".estatus").editable({
            dataType: 'json',
            source: [
                {value: 'por_iniciar', text: 'Por iniciar'},
                {value: 'en_proceso', text: 'En proceso'},
                {value: 'terminado', text: 'Terminado'}
            ],
            success: function (response, newValue) {
                console.log('Actualizado, response')
            }
        });

        $(".fechacompromiso").editable({
            dataType: 'json',
            format: 'YYYY-MM-DD',
            viewformat: 'YYYY.MM.DD',
            template: 'D / MM / YYYY',
            combodate: {
                minYear: 2019,
                maxYear: 2100,
                minuteStep: 1
            },
            success: function (response, newValue) {
                console.log('Actualizado, response')
            }
        });

    });

    $(".responsable").editable({
        dataType: 'json',
        source: [
                @foreach($users as $user)
                    { value: '{{ $user->id }}', text: '{{ $user->name }}' }
                    @unless ($loop->last)
                    ,
                    @endunless
                @endforeach
        ],
        success: function (response, newValue) {
            console.log('Actualizado, response')
        }
    });
    @endsection
</script>
<!-- x-editable -->


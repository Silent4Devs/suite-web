<form method="POST" action="{{ route("admin.accion-correctivas.store") }}" enctype="multipart/form-data" class="row" id="formulario">
    @csrf

    {{ Form::hidden('pdf-value', 'accioncorrectiva')}}



    <div class="form-group col-sm-12 col-md-12 col-lg-12">
        <label for="fecharegistro"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de registro</label>
        <input class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}" type="date" name="fecharegistro" id="fecharegistro" value="{{ old('fecharegistro') }}">
        @if($errors->has('fecharegistro'))
        <div class="invalid-feedback">
            {{ $errors->first('fecharegistro') }}
        </div>
        @endif
    </div>

    <div class="mt-1 form-group col-12">
        <b>Reportó Acción Correctiva:</b>
    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="id_reporto"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
        <select class="form-control  {{ $errors->has('id_reporto') ? 'is-invalid' : '' }}"
            name="id_reporto" id="id_reporto">
            <option selected value="" disabled>-- Selecciona un área --</option>
            @foreach ($empleados as $empleado)
                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                    data-area="{{ $empleado->area->area }}">
                    {{ $empleado->name }}
                </option>

            @endforeach
        </select>
        @if ($errors->has('id_reporto'))
            <div class="invalid-feedback">
                {{ $errors->first('id_reporto') }}
            </div>
        @endif
    </div>

    <div class="form-group col-md-4">
        <label for="id_reporto_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
        <div class="form-control" id="reporto_puesto"></div>

    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="id_reporto_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
        <div class="form-control" id="reporto_area"></div>

    </div>


    <div class="mt-1 form-group col-12">
        <b>Registró Acción Correctiva:</b>
    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="id_registro"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
        <select class="form-control  {{ $errors->has('id_registro') ? 'is-invalid' : '' }}"
            name="id_registro" id="id_registro">
            <option selected value="" disabled>-- Selecciona un área --</option>
            @foreach ($empleados as $empleado)
                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                    data-area="{{ $empleado->area->area }}">

                    {{ $empleado->name }}
                </option>

            @endforeach
        </select>
        @if ($errors->has('id_registro'))
            <div class="invalid-feedback">
                {{ $errors->first('id_registro') }}
            </div>
        @endif
    </div>


    <div class="form-group col-md-4">
        <label for="id_registro_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
        <div class="form-control" id="registro_puesto"></div>

    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="id_registro_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
        <div class="form-control" id="registro_area"></div>

    </div>


    <div class="form-group col-12">
        <label for="tema"><i class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.tema') }}
        </label>
        <textarea class="form-control {{ $errors->has('tema') ? 'is-invalid' : '' }}" name="tema" id="tema">{{ old('tema') }}</textarea>
        @if($errors->has('tema'))
        <div class="invalid-feedback">
            {{ $errors->first('tema') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.tema_helper') }}</span>
    </div>
    <div class="form-group col-12">
        <label><i class="fas fa-project-diagram iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.causaorigen') }}
        </label>
        <select class="form-control {{ $errors->has('causaorigen') ? 'is-invalid' : '' }}" name="causaorigen" id="causaorigen">
            <option></option>
            <option value disabled {{ old('causaorigen', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
            @foreach(App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $label)
            <option value="{{ $key }}" {{ old('causaorigen', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if($errors->has('causaorigen'))
        <div class="invalid-feedback">
            {{ $errors->first('causaorigen') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.causaorigen_helper') }}</span>
    </div>
    <div class="form-group col-12">
        <label for="descripcion"><i class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.descripcion') }}
        </label>
        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
        @if($errors->has('descripcion'))
        <div class="invalid-feedback">
            {{ $errors->first('descripcion') }}
        </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.descripcion_helper') }}</span>
    </div>


    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
        <button id="form-siguienteaccion" data-toggle="collapse" onclick="closetabcollanext2()" data-target="#collapseplan" class="btn btn-danger">Siguiente</button>
    </div>





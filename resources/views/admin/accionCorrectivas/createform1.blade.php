<form method="POST" action="{{ route('admin.accion-correctivas.store') }}" enctype="multipart/form-data"
    class="row" id="formulario">
    @csrf

    {{ Form::hidden('pdf-value', 'accioncorrectiva') }}



    <div class="form-group col-md-8 col-lg-8 col-sm-12">
        <label class="required" for="tema"><i class="fas fa-text-width iconos-crear"></i>Título corto de la acción correctiva
        </label>
        <input class="form-control {{ $errors->has('tema') ? 'is-invalid' : '' }}" name="tema" id="tema"
            maxlength="255" {{ old('tema') }} required>
        @if ($errors->has('tema'))
            <div class="invalid-feedback">
                {{ $errors->first('tema') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.tema_helper') }}</span>
    </div>

    {{-- <div class="form-group col-md-4 col-lg-4 col-sm-12">
        <label class="form-label"><i class="fas fa-traffic-light iconos-crear"></i>Estatus</label>
        <select name="estatus" class="form-control" id="opciones" onchange='cambioOpciones();'>
            <option {{ old('estatus') == 'nuevo' ? 'selected' : '' }} value="nuevo">Nuevo</option>
            <option {{ old('estatus') == 'en curso' ? 'selected' : '' }} value="en curso">En curso</option>
            <option {{ old('estatus') == 'en espera' ? 'selected' : '' }} value="en espera">En espera</option>
            <option {{ old('estatus') == 'cerrado' ? 'selected' : '' }} value="cerrado">Cerrado</option>
            <option {{ old('estatus') == 'cancelado' ? 'selected' : '' }} value="cancelado">Cancelado</option>
        </select>
    </div> --}}

    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label class="required" for="fecharegistro"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha y hora de registro de la AC</label>
        <input required class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}" type="datetime-local"
            min="1945-01-01T00:00" name="fecharegistro" id="fecharegistro" value="{{ old('fecharegistro') }}">
        @if ($errors->has('fecharegistro'))
            <div class="invalid-feedback">
                {{ $errors->first('fecharegistro') }}
            </div>
        @endif
    </div>

    {{-- <div class="form-group col-sm-12 col-md-6 col-lg-6">
        <label for="fecha_verificacion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de recepción de la AC</label>
        <input class="form-control date {{ $errors->has('fecha_verificacion') ? 'is-invalid' : '' }}" type="datetime-local"
            name="fecha_verificacion" id="fecha_verificacion" value="{{ old('fecha_verificacion') }}">
        @if ($errors->has('fecha_verificacion'))
            <div class="invalid-feedback">
                {{ $errors->first('fecha_verificacion') }}
            </div>
        @endif
    </div> --}}

    {{-- <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label for="fecha_cierre"> <i class="far fa-calendar-alt iconos-crear"></i>Fecha y
            hora de cierre del ticket</label>
        <input class="form-control" id="solucion" name="fecha_cierre">
    </div> --}}

    <div class="mt-1 form-group col-12">
        <b>Reportó Acción Correctiva:</b>
    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label class="required" for="id_reporto"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
        <select class="form-control  {{ $errors->has('id_reporto') ? 'is-invalid' : '' }}" name="id_reporto"
            id="id_reporto" required>
            <option selected value="" disabled>-- Selecciona un empleado --</option>
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
        <label class="required" for="id_registro"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
        <select class="form-control  {{ $errors->has('id_registro') ? 'is-invalid' : '' }}" name="id_registro"
            id="id_registro" required>
            <option selected value="" disabled>-- Selecciona un empleado --</option>
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
        <label class="required"><i
                class="fas fa-project-diagram iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.causaorigen') }}
        </label>
        <select class="form-control {{ $errors->has('causaorigen') ? 'is-invalid' : '' }}" name="causaorigen"
            id="causaorigen" required>
            <option></option>
            <option value disabled {{ old('causaorigen', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\AccionCorrectiva::CAUSAORIGEN_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('causaorigen', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        @if ($errors->has('causaorigen'))
            <div class="invalid-feedback">
                {{ $errors->first('causaorigen') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.causaorigen_helper') }}</span>
    </div>

    <div class="form-group col-12">
        <label class="required" for="descripcion"><i
                class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.descripcion') }}
        </label>
        <textarea required class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
            id="descripcion">{{ old('descripcion') }}</textarea>
        @if ($errors->has('descripcion'))
            <div class="invalid-feedback">
                {{ $errors->first('descripcion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.descripcion_helper') }}</span>
    </div>


    <div class="text-right form-group col-12">
        <a href="{{ route('admin.accion-correctivas.index') }}" class="btn_cancelar">Cancelar</a>
        <button class="btn btn-danger" type="submit" id="btnGuardar">
            {{ trans('global.save') }}
        </button>
        {{-- <button id="form-siguienteaccion" data-toggle="collapse" onclick="closetabcollanext2()" data-target="#collapseplan" class="btn btn-danger">Siguiente</button> --}}
    </div>
</form>

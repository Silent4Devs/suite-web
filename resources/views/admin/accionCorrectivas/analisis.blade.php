<div class="form-group col-12">
    <label><i class="fas fa-list-ul iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.metodo_causa') }}
    </label>
    <select class="form-control {{ $errors->has('metodo_causa') ? 'is-invalid' : '' }}" name="metodo_causa"
            id="metodo_causa" >
        <option></option>
        <option value
                disabled {{ old('metodo_causa', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
        @foreach(App\Models\AccionCorrectiva::METODO_CAUSA_SELECT as $key => $label)
            <option
                value="{{ $key }}" {{ old('metodo_causa', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @if($errors->has('metodo_causa'))
        <div class="invalid-feedback">
            {{ $errors->first('metodo_causa') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.metodo_causa_helper') }}</span>
</div>
<div class="form-group col-md-12 col-lg-12 col-sm-12">
    <label for="solucion"><i
            class="far fa-file-alt iconos-crear"></i>Descripción de la solución
    </label>
    <textarea class="form-control {{ $errors->has('solucion') ? 'is-invalid' : '' }}" name="solucion" id="solucion"
              >{{ old('solucion') }}</textarea>
    @if($errors->has('solucion'))
        <div class="invalid-feedback">
            {{ $errors->first('solucion') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.solucion_helper') }}</span>
</div>
<div class="form-group col-md-12 col-lg-12 col-sm-12">
    <label for="cierre_accion"><i
            class="far fa-file-alt iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.cierre_accion') }}
    </label>
    <textarea class="form-control {{ $errors->has('cierre_accion') ? 'is-invalid' : '' }}" name="cierre_accion"
              id="cierre_accion">{{ old('cierre_accion') }}</textarea>
    @if($errors->has('cierre_accion'))
        <div class="invalid-feedback">
            {{ $errors->first('cierre_accion') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.cierre_accion_helper') }}</span>
</div>
<div class="form-group col-12">
    <label><i class="fas fa-signal iconos-crear"></i>{{ trans('cruds.accionCorrectiva.fields.estatus') }}
    </label>
    <select class="form-control {{ $errors->has('estatus') ? 'is-invalid' : '' }}" name="estatus" id="estatus">
        <option></option>
        <option value
                disabled {{ old('estatus', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
        @foreach(App\Models\AccionCorrectiva::ESTATUS_SELECT as $key => $label)
            <option
                value="{{ $key }}" {{ old('estatus', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    @if($errors->has('estatus'))
        <div class="invalid-feedback">
            {{ $errors->first('estatus') }}
        </div>
    @endif
    <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.estatus_helper') }}</span>
</div>


<div class="form-group col-sm-12 col-md-6 col-lg-6">
    <label for="fecha_compromiso"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha compromiso</label>
    <input class="form-control date {{ $errors->has('fecha_compromiso') ? 'is-invalid' : '' }}" type="date" name="fecha_compromiso" id="fecha_compromiso" value="{{ old('fecha_compromiso') }}">
    @if($errors->has('fecha_compromiso'))
    <div class="invalid-feedback">
        {{ $errors->first('fecha_compromiso') }}
    </div>
    @endif
</div>


<div class="form-group col-sm-12 col-md-6 col-lg-6">
    <label for="fecha_verificacion"> <i class="far fa-calendar-alt iconos-crear"></i> Fecha de verificación</label>
    <input class="form-control date {{ $errors->has('fecha_verificacion') ? 'is-invalid' : '' }}" type="date" name="fecha_verificacion" id="fecha_verificacion" value="{{ old('fecha_verificacion') }}">
    @if($errors->has('fecha_verificacion'))
    <div class="invalid-feedback">
        {{ $errors->first('fecha_verificacion') }}
    </div>
    @endif
</div>



<div class="mt-1 form-group col-12">
    <b>Responsable Atención AC</b>
</div>


<div class="form-group col-sm-12 col-md-4 col-lg-4">
    <label for="id_atencion"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
    <select class="form-control  {{ $errors->has('id_atencion') ? 'is-invalid' : '' }}"
        name="id_atencion" id="id_atencion">
        <option selected value="" disabled>-- Selecciona un área --</option>
        @foreach ($empleados as $empleado)
            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                data-area="{{ $empleado->area->area }}">

                {{ $empleado->name }}
            </option>

        @endforeach
    </select>
    @if ($errors->has('id_atencion'))
        <div class="invalid-feedback">
            {{ $errors->first('id_atencion') }}
        </div>
    @endif
</div>


<div class="form-group col-md-4">
    <label for="id_atencion_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
    <div class="form-control" id="atencion_puesto"></div>

</div>


<div class="form-group col-sm-12 col-md-4 col-lg-4">
    <label for="id_atencion_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
    <div class="form-control" id="atencion_area"></div>

</div>

<div class="mt-1 form-group col-12">
    <b>Responsable Autorización AC</b>
</div>


<div class="form-group col-sm-12 col-md-4 col-lg-4">
    <label for="id_autorizo"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
    <select class="form-control  {{ $errors->has('id_autorizo') ? 'is-invalid' : '' }}"
        name="id_autorizo" id="id_autorizo">
        <option selected value="" disabled>-- Selecciona un área --</option>
        @foreach ($empleados as $empleado)
            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                data-area="{{ $empleado->area->area }}">

                {{ $empleado->name }}
            </option>

        @endforeach
    </select>
    @if ($errors->has('id_autorizo'))
        <div class="invalid-feedback">
            {{ $errors->first('id_autorizo') }}
        </div>
    @endif
</div>


<div class="form-group col-md-4">
    <label for="id_autorizo_puesto"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
    <div class="form-control" id="autorizo_puesto"></div>

</div>


<div class="form-group col-sm-12 col-md-4 col-lg-4">
    <label for="id_autorizo_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
    <div class="form-control" id="autorizo_area"></div>

</div>



    <div class="col-sm-12 col-md-12 col-lg-12 form-group">
        <label for="documentometodo"><i
                class="fas fa-folder-open iconos-crear"></i>Adjuntar
            Documento</label>
        <div class="custom-file">
            <input type="file" name="files[]" multiple class="form-control"
                id="documentometodo">

        </div>
    </div>



<div class="text-right form-group col-12">
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>




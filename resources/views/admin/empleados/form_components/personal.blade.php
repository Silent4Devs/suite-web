<div class="row mt-4">
    <div class="form-group col-sm-12">
        <label for="domicilio_personal"><i class="fas fa-home iconos-crear"></i>Domicilio
            Personal</label>
        <input class="form-control {{ $errors->has('domicilio_personal') ? 'is-invalid' : '' }}" type="text"
            name="domicilio_personal" id="domicilio_personal"
            value="{{ old('domicilio_personal', $empleado->domicilio_personal) }}">
        <small id="error_domicilio_personal" class="text-danger"></small>
        @if ($errors->has('domicilio_personal'))
            <div class="invalid-feedback">
                {{ $errors->first('domicilio_personal') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="telefono_casa"><i class="fas fa-phone iconos-crear"></i>Teléfono de casa</label>
        <input class="form-control {{ $errors->has('telefono_casa') ? 'is-invalid' : '' }}" type="text"
            name="telefono_casa" id="telefono_casa" value="{{ old('telefono_casa', $empleado->telefono_casa) }}">
        <small id="error_telefono_casa" class="text-danger"></small>
        @if ($errors->has('telefono_casa'))
            <div class="invalid-feedback">
                {{ $errors->first('telefono_casa') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="correo_personal"><i class="fas fa-envelope iconos-crear"></i>Correo Personal</label>
        <input class="form-control {{ $errors->has('correo_personal') ? 'is-invalid' : '' }}" type="text"
            placeholder="example@tabantaj.com" name="correo_personal" id="correo_personal"
            value="{{ old('correo_personal', $empleado->correo_personal) }}">
        <small id="error_correo_personal" class="text-danger"></small>
        @if ($errors->has('correo_personal'))
            <div class="invalid-feedback">
                {{ $errors->first('correo_personal') }}
            </div>
        @endif
    </div>
    {{-- Componente dependientes economicos --}}
    <div class="col-sm-12">
        <label for=""><i class="fas fa-users iconos-crear"></i>Dependientes Económicos</label>
        @include('admin.empleados.components.dependientes-economicos',[
        'empleado'=>$empleado
        ])
    </div>
    {{-- Fin componente dependientes economicos --}}
    <div class="form-group col-sm-6">
        <label for="estado_civil"><i class="fas fa-book iconos-crear"></i>Estado
            civil</label>
        <select class="form-control select-search {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}"
            name="estado_civil" id="estado_civil" value="{{ old('estado_civil', '') }}" required>
            <option value="" selected disabled>
                -- Selecciona el estado civil --
            </option>
            <option value="casado" {{ old('estado_civil', $empleado->estado_civil) == 'casado' ? 'selected' : '' }}>
                Casado</option>
            <option value="soltero"
                {{ old('estado_civil', $empleado->estado_civil) == 'soltero' ? 'selected' : '' }}>
                Soltero</option>
        </select>
        <small id="error_estado_civil" class="text-danger"></small>
        @if ($errors->has('estado_civil'))
            <div class="invalid-feedback">
                {{ $errors->first('estado_civil') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="NSS"><i class="fas fa-clinic-medical iconos-crear"></i>NSS</label>
        <input class="form-control {{ $errors->has('NSS') ? 'is-invalid' : '' }}" type="text" name="NSS" id="NSS"
            value="{{ old('NSS', $empleado->NSS) }}">
        <small id="error_NSS" class="text-danger"></small>
        @if ($errors->has('NSS'))
            <div class="invalid-feedback">
                {{ $errors->first('NSS') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="CURP"><i class="fas fa-address-card iconos-crear"></i>CURP</label>
        <input class="form-control {{ $errors->has('CURP') ? 'is-invalid' : '' }}" type="text" name="CURP" id="CURP"
            value="{{ old('CURP', $empleado->CURP) }}">
        <small id="error_CURP" class="text-danger"></small>
        @if ($errors->has('CURP'))
            <div class="invalid-feedback">
                {{ $errors->first('CURP') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="RFC"><i class="fas fa-address-card iconos-crear"></i>RFC</label>
        <input class="form-control {{ $errors->has('RFC') ? 'is-invalid' : '' }}" type="text" name="RFC" id="RFC"
            value="{{ old('RFC', $empleado->RFC) }}">
        <small id="error_RFC" class="text-danger"></small>
        @if ($errors->has('RFC'))
            <div class="invalid-feedback">
                {{ $errors->first('RFC') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-12 col-md-6">
        <label for="cumpleaños"><i class="fas fa-birthday-cake iconos-crear"></i>Fecha de nacimiento</label>
        <input class="form-control {{ $errors->has('cumpleaños') ? 'is-invalid' : '' }}" type="date"
            name="cumpleaños" id="cumpleaños" value="{{ old('cumpleaños', $empleado->cumpleaños) }}">
        <small id="error_cumpleaños" class="text-danger"></small>
        @if ($errors->has('cumpleaños'))
            <div class="invalid-feedback">
                {{ $errors->first('cumpleaños') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="lugar_nacimiento"><i class="fas fa-map-marker-alt iconos-crear"></i>Lugar de
            nacimiento</label>
        <input class="form-control {{ $errors->has('lugar_nacimiento') ? 'is-invalid' : '' }}" type="text"
            name="lugar_nacimiento" id="lugar_nacimiento"
            value="{{ old('lugar_nacimiento', $empleado->lugar_nacimiento) }}">
        <small id="error_lugar_nacimiento" class="text-danger"></small>
        @if ($errors->has('lugar_nacimiento'))
            <div class="invalid-feedback">
                {{ $errors->first('lugar_nacimiento') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-12">
        <label for="nacionalidad"><i class="fas fa-globe-americas iconos-crear"></i>Nacionalidad</label>
        <select class="form-control {{ $errors->has('nacionalidad') ? 'is-invalid' : '' }}" name="nacionalidad"
            id="nacionalidad">
            <option value="" selected disabled>-- Selecciona la nacionalidad --</option>
            @foreach ($countries as $country)
                <option data-flag={{ $country->flag }}
                    {{ old('nacionalidad', $empleado->nacionalidad) == $country->name ? ' selected' : '' }}
                    value="{{ $country->name }}">{{ $country->name }}</option>
            @endforeach
        </select>
        <small id="error_nacionalidad" class="text-danger"></small>
        @if ($errors->has('nacionalidad'))
            <div class="invalid-feedback">
                {{ $errors->first('nacionalidad') }}
            </div>
        @endif
    </div>

    {{-- Componente contacto(s) de emergencia --}}
    <div class="col-sm-12">
        <label><i class="fas fa-users iconos-crear"></i>Contáctos de emergencia</label>
        @include('admin.empleados.components.contactos-emergencia',[
        'empleado'=>$empleado
        ])
    </div>
    {{-- Fin Componente contacto(s) de emergencia --}}
    <div class="form-group col-sm-6">
        <label for="entidad_crediticias_id"><i class="fas fa-landmark iconos-crear"></i>Entidad
            crediticia</label>
        <select class="form-control select-search {{ $errors->has('entidad_crediticias_id') ? 'is-invalid' : '' }}"
            name="entidad_crediticias_id" id="entidad_crediticias_id"
            value="{{ old('entidad_crediticias_id', $empleado->entidad_crediticias_id) }}">
            <option value="" selected disabled>
                -- Selecciona una entidad crediticia --
            </option>
            @foreach ($entidadesCrediticias as $entidad)
                <option value="{{ $entidad->id }}">{{ $entidad->entidad }}</option>
            @endforeach
        </select>
        <small id="error_entidad_crediticias_id" class="text-danger"></small>
        @if ($errors->has('entidad_crediticias_id'))
            <div class="invalid-feedback">
                {{ $errors->first('entidad_crediticias_id') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-6">
        <label for="numero_credito"><i class="fas fa-barcode iconos-crear"></i>Número de crédito</label>
        <input class="form-control {{ $errors->has('numero_credito') ? 'is-invalid' : '' }}" type="text"
            name="numero_credito" id="numero_credito" value="{{ old('numero_credito', $empleado->numero_credito) }}">
        <small id="error_numero_credito" class="text-danger"></small>
        @if ($errors->has('numero_credito'))
            <div class="invalid-feedback">
                {{ $errors->first('numero_credito') }}
            </div>
        @endif
    </div>
    <div class="form-group col-sm-12">
        <label for="descuento"><i class="fas fa-percentage iconos-crear"></i>Descuento</label>
        <input placeholder="$1,000,000.00" data-type='currency'
            class="form-control {{ $errors->has('descuento') ? 'is-invalid' : '' }}" type="text" name="descuento"
            id="descuento" value="{{ old('descuento', $empleado->descuento) }}">
        <small id="error_descuento" class="text-danger"></small>
        @if ($errors->has('descuento'))
            <div class="invalid-feedback">
                {{ $errors->first('descuento') }}
            </div>
        @endif
    </div>
</div>

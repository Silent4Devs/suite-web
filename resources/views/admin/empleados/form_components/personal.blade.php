<div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
    Datos Personales
</div>

<div class="row mt-4">
    <div class="form-group col-sm-6">
        <label for="calle"><i class="fas fa-home iconos-crear"></i>Calle</label>
        <input class="form-control {{ $errors->has('calle') ? 'is-invalid' : '' }}" type="text" maxlength="15"
            name="calle" id="calle"
            value="{{ old('calle', $empleado->calle) }}">
        <small id="error_calle" class="text-danger"></small>
        @if ($errors->has('calle'))
            <div class="invalid-feedback">
                {{ $errors->first('calle') }}
            </div>
        @endif
    </div>

    <div class="form-group col-sm-3">
        <label for="num_exterior"><i class="fas fa-home iconos-crear"></i>Núm. Exterior</label>
        <input class="form-control {{ $errors->has('num_exterior') ? 'is-invalid' : '' }}" type="text" pattern="\d*" maxlength="6"
            name="num_exterior" id="num_exterior" value="{{ old('num_exterior', $empleado->num_exterior) }}">
        <small id="error_num_exterior" class="text-danger"></small>
        @if ($errors->has('num_exterior'))
            <div class="invalid-feedback">
                {{ $errors->first('num_exterior') }}
            </div>
        @endif
    </div>



    <div class="form-group col-sm-3">
        <label for="num_interior"><i class="fas fa-home iconos-crear"></i>Núm. Interior</label>
        <input class="form-control {{ $errors->has('num_interior') ? 'is-invalid' : '' }}" name="num_interior" id="num_interior"
        value="{{ old('num_interior', $empleado->num_interior) }}" type="text" pattern="\d*" maxlength="6">
        <small id="error_num_interior" class="text-danger"></small>
        @if ($errors->has('num_interior'))
            <div class="invalid-feedback">
                {{ $errors->first('num_interior') }}
            </div>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <label for="colonia"><i class="fas fa-home iconos-crear"></i>Colonia</label>
        <input class="form-control {{ $errors->has('colonia') ? 'is-invalid' : '' }}" type="text" maxlength="15"
            name="colonia" id="colonia"
            value="{{ old('colonia', $empleado->colonia) }}">
        <small id="error_colonia" class="text-danger"></small>
        @if ($errors->has('colonia'))
            <div class="invalid-feedback">
                {{ $errors->first('colonia') }}
            </div>
        @endif
    </div>

    <div class="form-group col-sm-6">
        <label for="delegacion"><i class="fas fa-home iconos-crear"></i>Delegación o Municipio</label>
        <input class="form-control {{ $errors->has('delegacion') ? 'is-invalid' : '' }}" type="text" maxlength="15"
            name="delegacion" id="delegacion"
            value="{{ old('delegacion', $empleado->delegacion) }}">
        <small id="error_delegacion" class="text-danger"></small>
        @if ($errors->has('delegacion'))
            <div class="invalid-feedback">
                {{ $errors->first('delegacion') }}
            </div>
        @endif
    </div>

    <div class="form-group col-sm-4">
        <label for="estado"><i class="fas fa-home iconos-crear"></i>Estado</label>
        <input class="form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}" type="text" maxlength="15"
            name="estado" id="estado"
            value="{{ old('estado', $empleado->estado) }}">
        <small id="error_estado" class="text-danger"></small>
        @if ($errors->has('estado'))
            <div class="invalid-feedback">
                {{ $errors->first('estado') }}
            </div>
        @endif
    </div>

    <div class="form-group col-sm-4">
        <label for="pais"><i class="fas fa-home iconos-crear"></i>País</label>
        <input class="form-control {{ $errors->has('pais') ? 'is-invalid' : '' }}" type="text" maxlength="15"
            name="pais" id="pais"
            value="{{ old('pais', $empleado->pais) }}">
        <small id="error_pais" class="text-danger"></small>
        @if ($errors->has('pais'))
            <div class="invalid-feedback">
                {{ $errors->first('pais') }}
            </div>
        @endif
    </div>

    <div class="form-group col-sm-4">
        <label for="cp"><i class="fas fa-home iconos-crear"></i>C. P.</label> 
        <input class="form-control {{ $errors->has('cp') ? 'is-invalid' : '' }}" type="text" pattern="\d*" maxlength="5" 
            name="cp" id="cp"
            value="{{ old('delegacion', $empleado->cp) }}">
        <small id="error_cp" class="text-danger"></small>
        @if ($errors->has('cp'))
            <div class="invalid-feedback">
                {{ $errors->first('cp') }}
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
        <label for="nacionalidad"><i class="fas fa-globe-americas iconos-crear"></i>País de nacimiento</label>
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
      {{-- Componente dependientes economicos --}}
      <div class="col-sm-12">
        <label for=""><i class="fas fa-users iconos-crear"></i>Dependientes Económicos</label>
        @include('admin.empleados.components.dependientes-economicos',[
        'empleado'=>$empleado
        ])
    </div>
    {{-- Fin componente dependientes economicos --}}

</div>

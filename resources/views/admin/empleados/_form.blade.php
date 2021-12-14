<style>
    .select2-container {
        margin-top: 0px !important;
    }

</style>

<div>
    <div class="mt-4 text-center form-group" style="background-color:#1BB0B0; border-radius: 100px; color: white;">
        INFORMACIÓN GENERAL
    </div>
    <div class="informacion-general">
        @include('admin.empleados._imagen_empleado')
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="required" for="name"><i class="fas fa-street-view iconos-crear"></i>Nombre</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                    id="name" value="{{ old('name', $empleado->name) }}" required>
                <small id="error_name" class="text-danger"></small>
                @if ($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                    de
                    empleado</label>
                <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                    name="n_empleado" id="n_empleado" value="{{ old('n_empleado', $empleado->n_empleado) }}" required>
                <small id="error_n_empleado" class="text-danger"></small>
                @error('n_empleado')
                    <span class="invalid-feedback d-block" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-{{ $ceo_exists ? '6' : '12' }}">
                <label class="required" for="area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                <select class="custom-select areas" id="inputGroupSelect01" name="area_id">
                    <option selected value="" disabled>-- Selecciona un área --</option>
                    @forelse ($areas as $area)
                        <option value="{{ $area->id }}"
                            {{ old('area_id', $empleado->area_id) == $area->id ? ' selected' : '' }}>
                            {{ $area->area }}</option>
                    @empty
                        <option value="" disabled>Sin registros de áreas</option>
                    @endforelse
                </select>
                <small id="error_area_id" class="text-danger"></small>
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="puesto_id"><i
                        class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                <select class="form-control {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}" name="puesto_id"
                    id="puesto_id" required>
                    <option value="" selected disabled>
                        -- Selecciona un puesto --
                    </option>
                    @foreach ($puestos as $puesto)
                        <option value="{{ $puesto->id }}"
                            {{ old('puesto_id', $empleado->puesto_id) == $puesto->id ? ' selected' : '' }}>
                            {{ $puesto->puesto }}
                        </option>
                    @endforeach
                </select>
                <small id="error_puesto_id" class="text-danger"></small>
                @if ($errors->has('puesto_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('puesto_id') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            @if ($ceo_exists)
                <div class="form-group col-sm-3">
                    <label class="required" for="jefe"><i class="fas fa-user iconos-crear"></i>Jefe
                        Inmediato</label>
                    <div class="mb-3 input-group">

                        <select class="custom-select supervisor" id="inputGroupSelect01" name="supervisor_id">
                            <option value="" selected disabled>-- Selecciona supervisor --</option>
                            @forelse ($empleados as $empleado_s)
                                <option value="{{ $empleado_s->id }}"
                                    {{ old('supervisor_id', $empleado->supervisor_id) == $empleado_s->id ? 'selected' : '' }}>
                                    {{ $empleado_s->name }}
                                </option>
                            @empty
                                <option value="" disabled>Sin Datos</option>
                            @endforelse
                        </select>
                        <small id="error_supervisor_id" class="text-danger"></small>
                    </div>
                    @if ($errors->has('supervisor_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('supervisor_id') }}
                        </div>
                    @endif
                </div>
            @endif
            <div class="form-group col-sm-3">
                <label class="required" for="perfil_empleado_id"><i
                        class="fas fa-briefcase iconos-crear"></i>Perfil</label>
                <select class="form-control {{ $errors->has('perfil_empleado_id') ? 'is-invalid' : '' }}"
                    name="perfil_empleado_id" id="perfil_empleado_id" value="{{ old('perfil_empleado_id', '') }}"
                    required>
                    <option value="" selected disabled>
                        -- Selecciona un perfil --
                    </option>
                    @foreach ($perfiles as $perfil)
                        <option value="{{ $perfil->id }}"
                            {{ old('perfil_empleado_id', $empleado->perfil_empleado_id) == $perfil->id ? ' selected="selected"' : '' }}>
                            {{ $perfil->nombre }}
                        </option>
                    @endforeach
                </select>
                <small id="error_perfil_empleado_id" class="text-danger"></small>
                @if ($errors->has('perfil_empleado_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('perfil_empleado_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="genero"><i class="fas fa-user iconos-crear"></i>Género</label>
                <div class="mb-3 input-group">
                    <select class="custom-select genero select-search" id="genero" name="genero">
                        <option selected value="" disabled>-- Selecciona Género --</option>
                        <option value="H" {{ old('genero', $empleado->genero) == 'H' ? 'selected' : '' }}>
                            Hombre
                        </option>
                        <option value="M" {{ old('genero', $empleado->genero) == 'M' ? 'selected' : '' }}>
                            Mujer
                        </option>
                        <option value="X" {{ old('genero', $empleado->genero) == 'X' ? 'selected' : '' }}>
                            Otro
                        </option>
                    </select>
                    <small id="error_genero" class="text-danger"></small>
                </div>
                @if ($errors->has('genero'))
                    <div class="invalid-feedback">
                        {{ $errors->first('genero') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label class="required" for="estatus"><i
                        class="fas fa-business-time iconos-crear"></i>Estatus</label>
                <select class="form-control validate select-search" required="" name="estatus">
                    <option value="" disabled selected>Escoga una opción</option>
                    <option value="alta" {{ old('estatus', $empleado->estatus) == 'alta' ? 'selected' : '' }}>Alta
                    </option>
                    <option value="baja" {{ old('estatus', $empleado->estatus) == 'baja' ? 'selected' : '' }}>Baja
                    </option>
                </select>
                <small id="error_estatus" class="text-danger"></small>
                @if ($errors->has('estatus'))
                    <div class="invalid-feedback">
                        {{ $errors->first('estatus') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="email"><i class="far fa-envelope iconos-crear"></i>Correo
                    electrónico</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="email"
                    placeholder="example@tabantaj.com" id="email" value="{{ old('email', $empleado->email) }}"
                    required>
                <small id="error_email" class="text-danger"></small>
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-sm-6">
                <label for="telefono_movil"><i class="fas fa-mobile-alt iconos-crear"></i></i>Teléfono
                    móvil</label>
                <input class="form-control {{ $errors->has('telefono_movil') ? 'is-invalid' : '' }}" type="text"
                    name="telefono_movil" id="telefono_movil"
                    value="{{ old('telefono_movil', $empleado->telefono_movil) }}">
                <small id="error_telefono_movil" class="text-danger"></small>
                @if ($errors->has('telefono_movil'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefono_movil') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-4">
                <label for="telefono"><i class="fas fa-phone iconos-crear"></i>Teléfono
                    oficina</label>
                <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="text"
                    name="telefono" id="telefono" value="{{ old('telefono', $empleado->telefono) }}">
                <small id="error_telefono" class="text-danger"></small>
                @if ($errors->has('telefono'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefono') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-2">
                <label for="extension"><i class="fas fa-phone-volume iconos-crear"></i>Ext.</label>
                <input class="form-control {{ $errors->has('extension') ? 'is-invalid' : '' }}" type="text"
                    name="extension" id="extension" value="{{ old('extension', $empleado->extension) }}">
                <small id="error_extension" class="text-danger"></small>
                @if ($errors->has('extension'))
                    <div class="invalid-feedback">
                        {{ $errors->first('extension') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-3">
                <label for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
                <select class="form-control select-search select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}"
                    name="sede_id" id="sede_id">
                    <option selected value="" disabled>-- Selecciona Sede --</option>
                    @foreach ($sedes as $sede)
                        <option data-direction="{{ $sede->direccion }}" value="{{ $sede->id }}"
                            {{ old('sede_id', $empleado->sede_id) == $sede->id ? 'selected' : '' }}>
                            {{ $sede->sede }}</option>
                    @endforeach
                </select>
                <small id="error_sede_id" class="text-danger"></small>
                @if ($errors->has('sede_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('sede_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-12 col-md-3">
                <label for="direccion"><i class="fas fa-map iconos-crear"></i>Dirección</label>
                <input class="form-control" type="text" name="direccion" id="direccion"
                    value="{{ old('direccion', $empleado->direccion) }}" disabled readonly>
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="antiguedad"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
                    ingreso</label>
                <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
                    name="antiguedad" id="antiguedad"
                    value="{{ old('antiguedad', \Carbon\Carbon::parse($empleado->antiguedad)->format('Y-m-d')) }}"
                    required>
                <small id="error_antiguedad" class="text-danger"></small>
                @if ($errors->has('antiguedad'))
                    <div class="invalid-feedback">
                        {{ $errors->first('antiguedad') }}
                    </div>
                @endif

            </div>
            <div class="form-group col-sm-4">
                <label for="tipo_contrato_empleados_id"><i class="fas fa-briefcase iconos-crear"></i>Tipo de
                    contrato</label>
                <select
                    class="form-control select-search {{ $errors->has('tipo_contrato_empleados_id') ? 'is-invalid' : '' }}"
                    name="tipo_contrato_empleados_id" id="tipo_contrato_empleados_id">
                    <option value="" selected disabled>
                        -- Selecciona el tipo de contrato asignado --
                    </option>
                    @foreach ($tipoContratoEmpleado as $tipo)
                        <option data-slug="{{ $tipo->slug }}" value="{{ $tipo->id }}"
                            {{ old('tipo_contrato_empleados_id', $empleado->tipo_contrato_empleados_id) == $tipo->id ? 'selected' : '' }}>
                            {{ $tipo->name }}
                        </option>
                    @endforeach
                </select>
                <small id="error_tipo_contrato_empleados_id" class="text-danger"></small>
                @if ($errors->has('tipo_contrato_empleados_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('tipo_contrato_empleados_id') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-4">
                <label for="terminacion_contrato"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de terminación
                    de
                    contrato</label>
                <input class="form-control {{ $errors->has('terminacion_contrato') ? 'is-invalid' : '' }}"
                    type="date" name="terminacion_contrato" id="terminacion_contrato"
                    value="{{ old('terminacion_contrato', $empleado->terminacion_contrato) }}">
                <small id="error_terminacion_contrato" class="text-danger"></small>
                @if ($errors->has('terminacion_contrato'))
                    <div class="invalid-feedback">
                        {{ $errors->first('terminacion_contrato') }}
                    </div>
                @endif
            </div>
            <div class="text-center custom-control custom-checkbox form-group col-sm-4 align-self-end">
                <input type="checkbox"
                    {{ old('renovacion_contrato', $empleado->renovacion_contrato) == $tipo->id ? 'checked' : '' }}
                    class="custom-control-input" id="renovacion_contrato" name="renovacion_contrato">
                <small id="error_renovacion_contrato" class="text-danger"></small>
                <label class="custom-control-label" for="renovacion_contrato">¿Renovación de
                    contrato?</label>
            </div>
            <div class="form-group col-sm-12" id="c_esquema_contratacion">
                <label for="esquema_contratacion"><i class="fas fa-briefcase iconos-crear"></i>Esquema de
                    contratación</label>
                <select
                    class="form-control select-search {{ $errors->has('esquema_contratacion') ? 'is-invalid' : '' }}"
                    name="esquema_contratacion" id="esquema_contratacion">
                    <option value="" selected disabled>
                        -- Selecciona el esquema de contratación --
                    </option>
                    <option value="mixto"
                        {{ old('esquema_contratacion', $empleado->esquema_contratacion) == 'mixto' ? 'selected' : '' }}>
                        Mixto</option>
                </select>
                <small id="error_esquema_contratacion" class="text-danger"></small>
                @if ($errors->has('esquema_contratacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('esquema_contratacion') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6 d-none" id="c_proyecto_asignado">
                <label for="proyecto_asignado"><i class="fas fa-street-view iconos-crear"></i>Proyecto asignado
                </label>
                <input class="form-control {{ $errors->has('proyecto_asignado') ? 'is-invalid' : '' }}" type="text"
                    name="proyecto_asignado" id="proyecto_asignado"
                    value="{{ old('proyecto_asignado', $empleado->proyecto_asignado) }}">
                <small id="error_proyecto_asignado" class="text-danger"></small>
                @if ($errors->has('proyecto_asignado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('proyecto_asignado') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="text-center form-group" style="background-color:#1BB0B0; border-radius: 100px; color: white;">
        INFORMACIÓN PERSONAL
    </div>
    <div class="informacion-financiera">
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="domicilio_personal"><i class="fas fa-street-view iconos-crear"></i>Domicilio
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
                    name="telefono_casa" id="telefono_casa"
                    value="{{ old('telefono_casa', $empleado->telefono_casa) }}">
                <small id="error_telefono_casa" class="text-danger"></small>
                @if ($errors->has('telefono_casa'))
                    <div class="invalid-feedback">
                        {{ $errors->first('telefono_casa') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label for="correo_personal"><i class="fas fa-at iconos-crear"></i>Correo Personal</label>
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
                <label for="estado_civil"><i class="fas fa-briefcase iconos-crear"></i>Estado
                    civil</label>
                <select class="form-control select-search {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}"
                    name="estado_civil" id="estado_civil" value="{{ old('estado_civil', '') }}" required>
                    <option value="" selected disabled>
                        -- Selecciona el estado civil --
                    </option>
                    <option value="casado"
                        {{ old('estado_civil', $empleado->estado_civil) == 'casado' ? 'selected' : '' }}>
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
                <input class="form-control {{ $errors->has('NSS') ? 'is-invalid' : '' }}" type="text" name="NSS"
                    id="NSS" value="{{ old('NSS', $empleado->NSS) }}">
                <small id="error_NSS" class="text-danger"></small>
                @if ($errors->has('NSS'))
                    <div class="invalid-feedback">
                        {{ $errors->first('NSS') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label for="CURP"><i class="fas fa-address-card iconos-crear"></i>CURP</label>
                <input class="form-control {{ $errors->has('CURP') ? 'is-invalid' : '' }}" type="text" name="CURP"
                    id="CURP" value="{{ old('CURP', $empleado->CURP) }}">
                <small id="error_CURP" class="text-danger"></small>
                @if ($errors->has('CURP'))
                    <div class="invalid-feedback">
                        {{ $errors->first('CURP') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label for="RFC"><i class="fas fa-address-card iconos-crear"></i>RFC</label>
                <input class="form-control {{ $errors->has('RFC') ? 'is-invalid' : '' }}" type="text" name="RFC"
                    id="RFC" value="{{ old('RFC', $empleado->RFC) }}">
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
                <label for="lugar_nacimiento"><i class="fas fa-street-view iconos-crear"></i>Lugar de
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
                <label for="nacionalidad"><i class="fas fa-street-view iconos-crear"></i>Nacionalidad</label>
                <select class="form-control {{ $errors->has('nacionalidad') ? 'is-invalid' : '' }}"
                    name="nacionalidad" id="nacionalidad">
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
                <label for="entidad_crediticias_id"><i class="fas fa-briefcase iconos-crear"></i>Entidad
                    crediticia</label>
                <select
                    class="form-control select-search {{ $errors->has('entidad_crediticias_id') ? 'is-invalid' : '' }}"
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
                <label for="numero_credito"><i class="fas fa-address-card iconos-crear"></i>Número de crédito</label>
                <input class="form-control {{ $errors->has('numero_credito') ? 'is-invalid' : '' }}" type="text"
                    name="numero_credito" id="numero_credito"
                    value="{{ old('numero_credito', $empleado->numero_credito) }}">
                <small id="error_numero_credito" class="text-danger"></small>
                @if ($errors->has('numero_credito'))
                    <div class="invalid-feedback">
                        {{ $errors->first('numero_credito') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-12">
                <label for="descuento"><i class="fas fa-address-card iconos-crear"></i>Descuento</label>
                <input class="form-control {{ $errors->has('descuento') ? 'is-invalid' : '' }}" type="text"
                    name="descuento" id="descuento" value="{{ old('descuento', $empleado->descuento) }}">
                <small id="error_descuento" class="text-danger"></small>
                @if ($errors->has('descuento'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descuento') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="text-center form-group" style="background-color:#1BB0B0; border-radius: 100px; color: white;">
        INFORMACIÓN FINANCIERA
    </div>
    <div class="informacion-financiera row">
        <div class="form-group col-sm-6">
            <label for="banco"><i class="fas fa-address-card iconos-crear"></i>Banco</label>
            <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="banco"
                id="banco" value="{{ old('banco', $empleado->banco) }}">
            <small id="error_banco" class="text-danger"></small>
            @if ($errors->has('banco'))
                <div class="invalid-feedback">
                    {{ $errors->first('banco') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="cuenta_bancaria"><i class="fas fa-address-card iconos-crear"></i>Cuenta
                Bancaria</label>
            <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
                name="cuenta_bancaria" id="cuenta_bancaria"
                value="{{ old('cuenta_bancaria', $empleado->cuenta_bancaria) }}">
            <small id="error_cuenta_bancaria" class="text-danger"></small>
            @if ($errors->has('cuenta_bancaria'))
                <div class="invalid-feedback">
                    {{ $errors->first('cuenta_bancaria') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="clabe_interbancaria"><i class="fas fa-address-card iconos-crear"></i>Clave
                Interbancaria</label>
            <input class="form-control {{ $errors->has('clabe_interbancaria') ? 'is-invalid' : '' }}" type="text"
                name="clabe_interbancaria" id="clabe_interbancaria"
                value="{{ old('clabe_interbancaria', $empleado->clabe_interbancaria) }}">
            <small id="error_clabe_interbancaria" class="text-danger"></small>
            @if ($errors->has('clabe_interbancaria'))
                <div class="invalid-feedback">
                    {{ $errors->first('clabe_interbancaria') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="centro_costos"><i class="fas fa-address-card iconos-crear"></i>Centro de
                costos</label>
            <input class="form-control {{ $errors->has('centro_costos') ? 'is-invalid' : '' }}" type="text"
                name="centro_costos" id="centro_costos"
                value="{{ old('centro_costos', $empleado->centro_costos) }}">
            <small id="error_centro_costos" class="text-danger"></small>
            @if ($errors->has('centro_costos'))
                <div class="invalid-feedback">
                    {{ $errors->first('centro_costos') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="salario_bruto"><i class="fas fa-address-card iconos-crear"></i>Salario
                Bruto</label>
            <input data-type='currency' placeholder="$1,000,000.00"
                class="form-control {{ $errors->has('salario_bruto') ? 'is-invalid' : '' }}" type="text"
                name="salario_bruto" id="salario_bruto"
                value="{{ old('salario_bruto', $empleado->salario_bruto) }}">
            <small id="error_salario_bruto" class="text-danger"></small>
            @if ($errors->has('salario_bruto'))
                <div class="invalid-feedback">
                    {{ $errors->first('salario_bruto') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="salario_diario"><i class="fas fa-address-card iconos-crear"></i>Salario
                Diario</label>
            <input class="form-control {{ $errors->has('salario_diario') ? 'is-invalid' : '' }}" type="text"
                placeholder="$1,000,000.00" name="salario_diario" id="salario_diario" data-type='currency'
                value="{{ old('salario_diario', $empleado->salario_diario) }}">
            <small id="error_salario_diario" class="text-danger"></small>
            @if ($errors->has('salario_diario'))
                <div class="invalid-feedback">
                    {{ $errors->first('salario_diario') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="salario_diario_integrado"><i class="fas fa-address-card iconos-crear"></i>Salario Diario
                Integrado</label>
            <input class="form-control {{ $errors->has('salario_diario_integrado') ? 'is-invalid' : '' }}"
                placeholder="$1,000,000.00" type="text" name="salario_diario_integrado" id="salario_diario_integrado"
                data-type='currency'
                value="{{ old('salario_diario_integrado', $empleado->salario_diario_integrado) }}">
            <small id="error_salario_diario_integrado" class="text-danger"></small>
            @if ($errors->has('salario_diario_integrado'))
                <div class="invalid-feedback">
                    {{ $errors->first('salario_diario_integrado') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="salario_base_mensual"><i class="fas fa-address-card iconos-crear"></i>Salario Base
                Mensual</label>
            <input class="form-control {{ $errors->has('salario_base_mensual') ? 'is-invalid' : '' }}" type="text"
                placeholder="$1,000,000.00" data-type='currency' name="salario_base_mensual" id="salario_base_mensual"
                value="{{ old('salario_base_mensual', $empleado->salario_base_mensual) }}">
            <small id="error_salario_base_mensual" class="text-danger"></small>
            @if ($errors->has('salario_base_mensual'))
                <div class="invalid-feedback">
                    {{ $errors->first('salario_base_mensual') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="pagadora_actual"><i class="fas fa-address-card iconos-crear"></i>Pagadora Actual</label>
            <input class="form-control {{ $errors->has('pagadora_actual') ? 'is-invalid' : '' }}" type="text"
                name="pagadora_actual" id="pagadora_actual"
                value="{{ old('pagadora_actual', $empleado->pagadora_actual) }}">
            <small id="error_pagadora_actual" class="text-danger"></small>
            @if ($errors->has('pagadora_actual'))
                <div class="invalid-feedback">
                    {{ $errors->first('pagadora_actual') }}
                </div>
            @endif
        </div>
        <div class="form-group col-sm-6">
            <label for="periodicidad_nomina"><i class="fas fa-address-card iconos-crear"></i>Periodicidad de
                nómina</label>
            <select
                class="select-search form-control {{ $errors->has('periodicidad_nomina') ? 'is-invalid' : '' }}"
                name="periodicidad_nomina" id="periodicidad_nomina">
                <option value="" selected disabled>-- Selecciona la peridicidad --</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Diaria' ? 'selected' : '' }}
                    value="Diaria">Diaria</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Semanal' ? 'selected' : '' }}
                    value="Semanal">Semanal</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Decenal' ? 'selected' : '' }}
                    value="Decenal">Decenal</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Oncenal' ? 'selected' : '' }}
                    value="Oncenal">Oncenal</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Catorcenal' ? 'selected' : '' }}
                    value="Catorcenal">Catorcenal</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Quincenal' ? 'selected' : '' }}
                    value="Quincenal">Quincenal</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Mensual' ? 'selected' : '' }}
                    value="Mensual">Mensual</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Semestral' ? 'selected' : '' }}
                    value="Semestral">Semestral</option>
                <option
                    {{ old('periodicidad_nomina', $empleado->periodicidad_nomina) == 'Anual' ? 'selected' : '' }}
                    value="Anual">Anual</option>
            </select>
            <small id="error_periodicidad_nomina" class="text-danger"></small>
            @if ($errors->has('periodicidad_nomina'))
                <div class="invalid-feedback">
                    {{ $errors->first('periodicidad_nomina') }}
                </div>
            @endif
        </div>
        {{-- Componente Beneficiarios --}}
        <div class="col-sm-12">
            <label><i class="fas fa-users iconos-crear"></i>Beneficiarios</label>
            @include('admin.empleados.components.beneficiarios',[
            'empleado'=>$empleado
            ])
        </div>
        {{-- Fin Componente Beneficiarios --}}
    </div>
    {{-- </div> --}}
</div>
<script type="module">
    import {
        formatNumber,
        formatCurrency
    } from "{{ asset('js/money-format/moneyInput.js') }}";

    document.addEventListener('DOMContentLoaded', function() {
        initInpusToMoneyFormat();
        inputsToMoneyFormat();
        const toogleProyectoAsignado = (ocultar) => {
            const elProyectoAsignado = document.getElementById('proyecto_asignado');
            const containerProyectoAsignado = document.getElementById('c_proyecto_asignado');
            const containerEsquemaContratacion = document.getElementById('c_esquema_contratacion');
            if (ocultar) {
                containerProyectoAsignado.classList.remove('col-sm-6');
                containerProyectoAsignado.classList.add('d-none');
                containerEsquemaContratacion.classList.remove('col-sm-6');
                containerEsquemaContratacion.classList.add('col-sm-12');
                elProyectoAsignado.setAttribute('disabled', 'disabled');
                elProyectoAsignado.removeAttribute('type');
                elProyectoAsignado.setAttribute('type', 'hidden');
                elProyectoAsignado.value = "";
            } else {
                containerProyectoAsignado.classList.add('col-sm-6');
                containerProyectoAsignado.classList.remove('d-none');
                containerEsquemaContratacion.classList.remove('col-sm-12');
                containerEsquemaContratacion.classList.add('col-sm-6');
                elProyectoAsignado.removeAttribute('disabled');
                elProyectoAsignado.removeAttribute('type');
                elProyectoAsignado.setAttribute('type', 'text');
            }
        }

        $('#sede_id').on('select2:select', function(e) {
            const direction = e.target.options[e.target.selectedIndex].getAttribute('data-direction');
            setDirectionOnInput(direction);
        });
        $('#tipo_contrato_empleados_id').on('select2:select', function(e) {
            const slug = e.target.options[e.target.selectedIndex].getAttribute('data-slug');
            console.log(slug);
            if (slug === "por-proyecto") {
                toogleProyectoAsignado(false);
            } else {
                toogleProyectoAsignado(true);
            }
        });

        document.getElementById('sede_id').addEventListener('change', function(e) {
            const direction = e.target.options[e.target.selectedIndex].getAttribute('data-direction');
            setDirectionOnInput(direction);
        })
        const setDirectionOnInput = (direction) => {
            document.getElementById('direccion').value = direction;
        }
    })

    function initInpusToMoneyFormat() {
        document.querySelectorAll("input[data-type='currency']").forEach(element => {
            formatCurrency($(element));
        })
    }

    function inputsToMoneyFormat() {
        $("input[data-type='currency']").on({
            init: function() {
                console.log(this);
            },
            keyup: function() {
                formatCurrency($(this));
            },
            blur: function() {
                formatCurrency($(this), "blur");
            }
        });
    }
</script>

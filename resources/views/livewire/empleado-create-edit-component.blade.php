<div>
    <style>
        .select2-container {
            margin-top: 0px !important;
        }

    </style>

    <div>
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            INFORMACIÓN GENERAL
        </div>
        <div class="informacion-general">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="required" for="name"><i class="fas fa-street-view iconos-crear"></i>Nombre</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" id="name"
                        wire:model="name" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label for="n_empleado"><i class="fas fa-street-view iconos-crear"></i>N°
                        de
                        empleado</label>
                    <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
                        id="n_empleado" wire:model="n_empleado" required>
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
                    <select class="custom-select areas" id="inputGroupSelect01" wire:model="area_id">
                        <option selected value="" disabled>-- Selecciona un área --</option>
                        @forelse ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}</option>
                        @empty
                            <option value="" disabled>Sin registros de áreas</option>
                        @endforelse
                    </select>
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="puesto_id"><i
                            class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                    <select class="form-control {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}"
                        wire:model="puesto_id" id="puesto_id" required>
                        <option value="" selected disabled>
                            -- Selecciona un puesto --
                        </option>
                        @foreach ($puestos as $puesto)
                            <option value="{{ $puesto->id }}">
                                {{ $puesto->puesto }}
                            </option>
                        @endforeach
                    </select>
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

                            <select class="custom-select supervisor" id="inputGroupSelect01"
                                wire:model="supervisor_id">
                                <option value="" disabled>-- Selecciona supervisor --</option>
                                @forelse ($empleados as $empleado_s)
                                    <option value="{{ $empleado_s->id }}">
                                        {{ $empleado_s->name }}
                                    </option>
                                @empty
                                    <option value="" disabled>Sin Datos</option>
                                @endforelse
                            </select>
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
                        wire:model="perfil_empleado_id" id="perfil_empleado_id" required>
                        <option value="" selected disabled>
                            -- Selecciona un perfil --
                        </option>
                        @foreach ($perfiles as $perfil)
                            <option value="{{ $perfil->id }}">
                                {{ $perfil->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('perfil_empleado_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('perfil_empleado_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="genero"><i class="fas fa-user iconos-crear"></i>Género</label>
                    <div class="mb-3 input-group">
                        <select class="custom-select genero" id="genero" wire:model="genero">
                            <option selected value="" disabled>-- Selecciona Género --</option>
                            <option value="H">
                                Hombre
                            </option>
                            <option value="M">
                                Mujer
                            </option>
                            <option value="X">
                                Otro
                            </option>
                        </select>
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
                    <select class="form-control" class="validate" required="" wire:model="estatus">
                        <option value="" disabled selected>Escoga una opción</option>
                        <option value="alta">Alta
                        </option>
                        <option value="baja">Baja
                        </option>
                    </select>
                    @if ($errors->has('estatus'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estatus') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="email"><i class="far fa-envelope iconos-crear"></i>Correo
                        electrónico</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                        wire:model="email" id="email">
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
                        wire:model="telefono_movil" id="telefono_movil">
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
                        wire:model="telefono" id="telefono">
                    @if ($errors->has('telefono'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telefono') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-2">
                    <label for="extension"><i class="fas fa-phone-volume iconos-crear"></i>Ext.</label>
                    <input class="form-control {{ $errors->has('extension') ? 'is-invalid' : '' }}" type="text"
                        wire:model="extension" id="extension">
                    @if ($errors->has('extension'))
                        <div class="invalid-feedback">
                            {{ $errors->first('extension') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-3">
                    <label for="sede_id"><i class="fas fa-building iconos-crear"></i>Sede</label>
                    <select class="form-control select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}"
                        wire:model="sede_id" id="sede_id">
                        <option selected value="" disabled>-- Selecciona Sede --</option>
                        @foreach ($sedes as $sede)
                            <option data-direction="{{ $sede->direccion }}" value="{{ $sede->id }}">
                                {{ $sede->sede }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('sede_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-12 col-md-3">
                    <label for="direccion"><i class="fas fa-map iconos-crear"></i>Dirección</label>
                    <input class="form-control" type="text" wire:model="direccion" id="direccion" disabled
                        readonly>
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="antiguedad"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha
                        de
                        ingreso</label>
                    <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
                        wire:model="antiguedad" id="antiguedad">
                    @if ($errors->has('antiguedad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('antiguedad') }}
                        </div>
                    @endif

                </div>
                <div class="form-group col-sm-4">
                    <label class="required" for="tipo_contrato_empleados_id"><i
                            class="fas fa-briefcase iconos-crear"></i>Tipo de contrato</label>
                    <select class="form-control {{ $errors->has('tipo_contrato_empleados_id') ? 'is-invalid' : '' }}"
                        wire:model="tipo_contrato_empleados_id" id="tipo_contrato_empleados_id">
                        <option value="" selected disabled>
                            -- Selecciona el tipo de contrato asignado --
                        </option>
                        @foreach ($tipoContratoEmpleado as $tipo)
                            <option value="{{ $tipo->id }}">
                                {{ $tipo->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('tipo_contrato_empleados_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tipo_contrato_empleados_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-4">
                    <label class="required" for="terminacion_contrato"><i
                            class="fas fa-calendar-alt iconos-crear"></i>Fecha de terminación de
                        contrato</label>
                    <input class="form-control {{ $errors->has('terminacion_contrato') ? 'is-invalid' : '' }}"
                        type="date" wire:model="terminacion_contrato" id="terminacion_contrato">
                    @if ($errors->has('terminacion_contrato'))
                        <div class="invalid-feedback">
                            {{ $errors->first('terminacion_contrato') }}
                        </div>
                    @endif
                </div>
                <div class="text-center custom-control custom-checkbox form-group col-sm-4 align-self-end">
                    <input type="checkbox" class="custom-control-input" id="renovacion_contrato"
                        wire:model="renovacion_contrato">
                    <label class="custom-control-label" for="renovacion_contrato">¿Renovación de
                        contrato?</label>
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="esquema_contratacion"><i
                            class="fas fa-briefcase iconos-crear"></i>Esquema de contratación</label>
                    <select class="form-control {{ $errors->has('esquema_contratacion') ? 'is-invalid' : '' }}"
                        wire:model="esquema_contratacion" id="esquema_contratacion">
                        <option value="" selected disabled>
                            -- Selecciona el esquema de contratación --
                        </option>
                        <option value="mixto">
                            Mixto</option>
                    </select>
                    @if ($errors->has('esquema_contratacion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('esquema_contratacion') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="proyecto_asignado"><i
                            class="fas fa-street-view iconos-crear"></i>Proyecto asignado
                    </label>
                    <input class="form-control {{ $errors->has('proyecto_asignado') ? 'is-invalid' : '' }}"
                        type="text" wire:model="proyecto_asignado" id="proyecto_asignado">
                    @if ($errors->has('proyecto_asignado'))
                        <div class="invalid-feedback">
                            {{ $errors->first('proyecto_asignado') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            INFORMACIÓN PERSONAL
        </div>
        <div class="informacion-financiera">
            <div class="row">
                <div class="form-group col-sm-6">
                    <label class="required" for="domicilio_personal"><i
                            class="fas fa-street-view iconos-crear"></i>Domicilio Personal</label>
                    <input class="form-control {{ $errors->has('domicilio_personal') ? 'is-invalid' : '' }}"
                        type="text" wire:model="domicilio_personal" id="domicilio_personal">
                    @if ($errors->has('domicilio_personal'))
                        <div class="invalid-feedback">
                            {{ $errors->first('domicilio_personal') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="telefono_casa"><i
                            class="fas fa-street-view iconos-crear"></i>Teléfono de casa</label>
                    <input class="form-control {{ $errors->has('telefono_casa') ? 'is-invalid' : '' }}" type="text"
                        wire:model="telefono_casa" id="telefono_casa">
                    @if ($errors->has('telefono_casa'))
                        <div class="invalid-feedback">
                            {{ $errors->first('telefono_casa') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="correo_personal"><i
                            class="fas fa-street-view iconos-crear"></i>Correo Personal</label>
                    <input class="form-control {{ $errors->has('correo_personal') ? 'is-invalid' : '' }}"
                        type="text" wire:model="correo_personal" id="correo_personal">
                    @if ($errors->has('correo_personal'))
                        <div class="invalid-feedback">
                            {{ $errors->first('correo_personal') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="estado_civil"><i
                            class="fas fa-briefcase iconos-crear"></i>Estado
                        civil</label>
                    <select class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}"
                        wire:model="estado_civil" id="estado_civil" value="{{ old('estado_civil', '') }}"
                        required>
                        <option value="" selected disabled>
                            -- Selecciona el estado civil --
                        </option>
                        <option value="casado">
                            Casado</option>
                        <option value="soltero">
                            Soltero</option>
                    </select>
                    @if ($errors->has('estado_civil'))
                        <div class="invalid-feedback">
                            {{ $errors->first('estado_civil') }}
                        </div>
                    @endif
                </div>
                {{-- Componente dependientes economicos --}}
                {{-- Fin componente dependientes economicos --}}
                <div class="form-group col-sm-6">
                    <label class="required" for="NSS"><i class="fas fa-street-view iconos-crear"></i>NSS</label>
                    <input class="form-control {{ $errors->has('NSS') ? 'is-invalid' : '' }}" type="text"
                        wire:model="NSS" id="NSS">
                    @if ($errors->has('NSS'))
                        <div class="invalid-feedback">
                            {{ $errors->first('NSS') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="CURP"><i
                            class="fas fa-street-view iconos-crear"></i>CURP</label>
                    <input class="form-control {{ $errors->has('CURP') ? 'is-invalid' : '' }}" type="text"
                        wire:model="CURP" id="CURP">
                    @if ($errors->has('CURP'))
                        <div class="invalid-feedback">
                            {{ $errors->first('CURP') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="RFC"><i class="fas fa-street-view iconos-crear"></i>RFC</label>
                    <input class="form-control {{ $errors->has('RFC') ? 'is-invalid' : '' }}" type="text"
                        wire:model="RFC" id="RFC">
                    @if ($errors->has('RFC'))
                        <div class="invalid-feedback">
                            {{ $errors->first('RFC') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-12 col-md-6">
                    <label for="cumpleaños"><i class="fas fa-birthday-cake iconos-crear"></i>Cumpleaños</label>
                    <input class="form-control {{ $errors->has('cumpleaños') ? 'is-invalid' : '' }}" type="date"
                        wire:model="cumpleaños" id="cumpleaños">
                    @if ($errors->has('cumpleaños'))
                        <div class="invalid-feedback">
                            {{ $errors->first('cumpleaños') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="lugar_nacimiento"><i
                            class="fas fa-street-view iconos-crear"></i>Lugar de nacimiento</label>
                    <input class="form-control {{ $errors->has('lugar_nacimiento') ? 'is-invalid' : '' }}"
                        type="text" wire:model="lugar_nacimiento" id="lugar_nacimiento">
                    @if ($errors->has('lugar_nacimiento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lugar_nacimiento') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="nacionalidad"><i
                            class="fas fa-street-view iconos-crear"></i>Nacionalidad</label>
                    <input class="form-control {{ $errors->has('nacionalidad') ? 'is-invalid' : '' }}" type="text"
                        wire:model="nacionalidad" id="nacionalidad">
                    @if ($errors->has('nacionalidad'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nacionalidad') }}
                        </div>
                    @endif
                </div>

                {{-- Componente contacto(s) de emergencia --}}
                {{-- Fin Componente contacto(s) de emergencia --}}
                <div class="form-group col-sm-6">
                    <label class="required" for="entidad_crediticias_id"><i
                            class="fas fa-briefcase iconos-crear"></i>Entidad crediticia</label>
                    <select class="form-control {{ $errors->has('entidad_crediticias_id') ? 'is-invalid' : '' }}"
                        wire:model="entidad_crediticias_id" id="entidad_crediticias_id">
                        <option value="" selected disabled>
                            -- Selecciona una entidad crediticia --
                        </option>
                        @foreach ($entidadesCrediticias as $entidad)
                            <option value="{{ $entidad->id }}">{{ $entidad->entidad }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('entidad_crediticias_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('entidad_crediticias_id') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="numero_credito"><i
                            class="fas fa-street-view iconos-crear"></i>Número de crédito</label>
                    <input class="form-control {{ $errors->has('numero_credito') ? 'is-invalid' : '' }}" type="text"
                        wire:model="numero_credito" id="numero_credito">
                    @if ($errors->has('numero_credito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('numero_credito') }}
                        </div>
                    @endif
                </div>
                <div class="form-group col-sm-6">
                    <label class="required" for="descuento"><i
                            class="fas fa-street-view iconos-crear"></i>Descuento</label>
                    <input class="form-control {{ $errors->has('descuento') ? 'is-invalid' : '' }}" type="text"
                        wire:model="descuento" id="descuento">
                    @if ($errors->has('descuento'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descuento') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group is-invalid">
                    <div class="form-group" style="width: 100%;border: dashed 1px #cecece;">
                        <div class="row" style="padding: 20px 0;">
                            <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center">
                                <label style="cursor: pointer" for="foto">
                                    <div class="d-flex align-items-center">
                                        <h5>
                                            <i class="fas fa-image iconos-crear"
                                                style="font-size: 20pt;position: relative;top: 4px;"></i>
                                            <span id="texto-imagen" class="pl-2">
                                                Subir imágen
                                                <small class="text-danger" style="font-size: 10px">
                                                    (Opcional)</small>
                                            </span>
                                        </h5>
                                    </div>
                                </label>
                            </div>
                            <div class="col-sm-2 col-md-2 col-12 d-flex justify-content-center">
                                Ó
                            </div>
                            <div class="col-md-5 col-sm-5 col-12 d-flex justify-content-center" id="avatar_choose">
                                <label style="cursor: pointer">
                                    <div class="d-flex align-items-center">
                                        <h5>
                                            <i class="fas fa-image iconos-crear"
                                                style="font-size: 20pt;position: relative;top: 4px;"></i>
                                            <span id="texto-imagen-avatar" class="pl-2">
                                                Tomar Foto
                                                <small class="text-danger" style="font-size: 10px">
                                                    (Opcional)</small>
                                            </span>
                                        </h5>
                                    </div>
                                </label>
                            </div>
                        </div>
                        <input wire:model.live="foto" type="file" accept="image/png, image/jpeg" class="form-control-file"
                            id="foto" hidden="">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="canvasFoto" style="display: none">
            <div class="mt-0 display-cover">
                <span class="badge badge-dark" id="cerrarCanvasFoto">&times;</span>
                <video autoplay></video>
                <canvas class="d-none"></canvas>

                <div class="video-options">
                    <select name="" id="" class="custom-select devices">
                        <option value="">Selecciona una cámara</option>
                    </select>
                </div>

                <img class="screenshot-image d-none" alt="">

                <div class="controls">
                    <button class="btn btn-danger play" title="Iniciar"><i class="fas fa-play-circle"></i></button>
                    <button class="btn btn-info pause d-none" title="Pausar"><i
                            class="fas fa-pause-circle"></i></button>
                    <button class="btn btn-danger stop d-none" title="Detener"><i class="fas fa-stop"></i></button>
                    <button class="btn btn-outline-success screenshot d-none" title="Capturar"><i
                            class="fas fa-image"></i></button>
                </div>
            </div>
            <input type="hidden" id="snapshoot" readonly autocomplete="off" wire:model.live="snap_foto">
        </div>
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            INFORMACIÓN FINANCIERA
        </div>
        <div class="informacion-financiera row">
            <div class="form-group col-sm-6">
                <label class="required" for="banco"><i class="fas fa-street-view iconos-crear"></i>Banco</label>
                <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text"
                    wire:model="banco" id="banco">
                @if ($errors->has('banco'))
                    <div class="invalid-feedback">
                        {{ $errors->first('banco') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="cuenta_bancaria"><i
                        class="fas fa-street-view iconos-crear"></i>Cuenta
                    Bancaria</label>
                <input class="form-control {{ $errors->has('cuenta_bancaria') ? 'is-invalid' : '' }}" type="text"
                    wire:model="cuenta_bancaria" id="cuenta_bancaria">
                @if ($errors->has('cuenta_bancaria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cuenta_bancaria') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="clabe_interbancaria"><i
                        class="fas fa-street-view iconos-crear"></i>Clave Interbancaria</label>
                <input class="form-control {{ $errors->has('clabe_interbancaria') ? 'is-invalid' : '' }}"
                    type="text" wire:model="clabe_interbancaria" id="clabe_interbancaria">
                @if ($errors->has('clabe_interbancaria'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clabe_interbancaria') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="centro_costos"><i
                        class="fas fa-street-view iconos-crear"></i>Centro de
                    costos</label>
                <input class="form-control {{ $errors->has('centro_costos') ? 'is-invalid' : '' }}" type="text"
                    wire:model="centro_costos" id="centro_costos">
                @if ($errors->has('centro_costos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('centro_costos') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="salario_bruto"><i
                        class="fas fa-street-view iconos-crear"></i>Salario
                    Bruto</label>
                <input class="form-control {{ $errors->has('salario_bruto') ? 'is-invalid' : '' }}" type="text"
                    wire:model="salario_bruto" id="salario_bruto">
                @if ($errors->has('salario_bruto'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salario_bruto') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="salario_diario"><i
                        class="fas fa-street-view iconos-crear"></i>Salario
                    Diario</label>
                <input class="form-control {{ $errors->has('salario_diario') ? 'is-invalid' : '' }}" type="text"
                    wire:model="salario_diario" id="salario_diario">
                @if ($errors->has('salario_diario'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salario_diario') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="salario_diario_integrado"><i
                        class="fas fa-street-view iconos-crear"></i>Salario Diario Integrado</label>
                <input class="form-control {{ $errors->has('salario_diario_integrado') ? 'is-invalid' : '' }}"
                    type="text" wire:model="salario_diario_integrado" id="salario_diario_integrado">
                @if ($errors->has('salario_diario_integrado'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salario_diario_integrado') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="salario_base_mensual"><i
                        class="fas fa-street-view iconos-crear"></i>Salario Base Mensual</label>
                <input class="form-control {{ $errors->has('salario_base_mensual') ? 'is-invalid' : '' }}"
                    type="text" wire:model="salario_base_mensual" id="salario_base_mensual">
                @if ($errors->has('salario_base_mensual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('salario_base_mensual') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="pagadora_actual"><i
                        class="fas fa-street-view iconos-crear"></i>Pagadora Actual</label>
                <input class="form-control {{ $errors->has('pagadora_actual') ? 'is-invalid' : '' }}" type="text"
                    wire:model="pagadora_actual" id="pagadora_actual">
                @if ($errors->has('pagadora_actual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('pagadora_actual') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-sm-6">
                <label class="required" for="periodicidad_nomina"><i
                        class="fas fa-street-view iconos-crear"></i>Periodicidad de nómina</label>
                <input class="form-control {{ $errors->has('periodicidad_nomina') ? 'is-invalid' : '' }}"
                    type="text" wire:model="periodicidad_nomina" id="periodicidad_nomina">
                @if ($errors->has('periodicidad_nomina'))
                    <div class="invalid-feedback">
                        {{ $errors->first('periodicidad_nomina') }}
                    </div>
                @endif
            </div>
            {{-- Componente Beneficiarios --}}
            {{-- Fin Componente Beneficiarios --}}
        </div>
        {{-- </div> --}}
    </div>
</div>

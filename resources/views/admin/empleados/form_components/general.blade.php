<div class="row mt-3">
    <div class="col-sm-12 col-md-12 col-12">
        <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            FOTO DEL EMPLEADO
        </div>
        @include('admin.empleados._imagen_empleado')
    </div>
    <div class="col-12">
        <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            INFORMACIÓN GENERAL
        </div>
    </div>
    <div class="form-group col-sm-6">
        <label class="required" for="name"><i class="fas fa-user-circle iconos-crear"></i>Nombre</label>
        <input class="form-control" type="text" name="name" id="name"
            value="{{ old('name', $empleado->name) }}" required>
    </div>
    <div class="form-group col-sm-6">
        <label for="n_empleado"><i class="fas fa-id-card iconos-crear"></i>N°
            de
            empleado</label>
        <input class="form-control {{ $errors->has('n_empleado') ? 'is-invalid' : '' }}" type="text"
            name="n_empleado" id="n_empleado" value="{{ old('n_empleado', $empleado->n_empleado) }}" required>
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-{{ $ceo_exists ? '6' : '12' }}">
        <label class="required" for="area"><i class="fas fa-puzzle-piece iconos-crear"></i>Área</label>
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
        <small id="error_area_id" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-6 row">
        <div class="col-sm-12 col-md-12 col-12">
            <label class="required" for="puesto_id"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
        </div>
        <div class="col-sm-11 col-md-11">
            {{-- <select class="form-control {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}" name="puesto_id"
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
            </select> --}}
            @livewire('puesto-select', ['puestos_seleccionado' => $puestos_seleccionado])
            <small id="error_puesto_id" class="text-danger errores"></small>
        </div>
        <button id="btnAgregarPuesto" onclick="event.preventDefault();" class="text-white btn btn-sm"
            style="background:#3eb2ad;height: 34px;" data-toggle="modal" data-target="#PuestoModal"
            title="Agregar Puesto"><i class="fas fa-plus"></i></button>
        @livewire('puesto-create')
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
                        @if ($empleado->id != $empleado_s->id)
                            <option value="{{ $empleado_s->id }}"
                                {{ old('supervisor_id', $empleado->supervisor_id) == $empleado_s->id ? 'selected' : '' }}>
                                {{ $empleado_s->name }}
                            </option>
                        @endif
                    @empty
                        <option value="" disabled>Sin Datos</option>
                    @endforelse
                </select>
                <small id="error_supervisor_id" class="text-danger errores"></small>
            </div>
        </div>
    @endif
    <div class="form-group col-sm-3">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-12">
                <label class="required" for="perfil_empleado_id"><i class="fas fa-sitemap iconos-crear"></i>
                    Nivel Jerárquico</label>
            </div>
            <div class="col-sm-9 col-md-9 col-9 pr-0">
                @livewire('perfil-select', ['perfiles_seleccionado' => $perfiles_seleccionado])
            </div>
            <div class="col-sm-3 col-md-3 col-3">
                <button id="btnAgregarPerfil" onclick="event.preventDefault();" class="text-white btn btn-sm"
                    style="background:#3eb2ad;height: 34px;" data-toggle="modal" data-target="#PerfilModal"
                    title="Agregar Perfil"><i class="fas fa-plus"></i></button>
                @livewire('perfil-create')
            </div>
        </div>
    </div>
    <div class="form-group col-sm-6">
        <label class="required" for="genero"><i class="fas fa-venus-mars iconos-crear"></i>Sexo</label>
        <div class="mb-3 input-group">
            <select class="custom-select genero select-search" id="genero" name="genero">
                <option selected value="" disabled>-- Selecciona Género --</option>
                <option value="H" {{ old('genero', $empleado->genero) == 'H' ? 'selected' : '' }}>
                    Hombre
                </option>
                <option value="M" {{ old('genero', $empleado->genero) == 'M' ? 'selected' : '' }}>
                    Mujer
                </option>
                {{-- <option value="X" {{ old('genero', $empleado->genero) == 'X' ? 'selected' : '' }}>
                    Otro
                </option> --}}
            </select>
            <small id="error_genero" class="text-danger errores"></small>
        </div>
    </div>
</div>
<div class="row">
    {{-- <div class="form-group col-sm-6">
        <label class="required" for="estatus"><i class="fas fa-business-time iconos-crear"></i>Estatus</label>
        <select class="form-control validate" required="" name="estatus">
            <option value="" disabled selected>Escoga una opción</option>
            <option value="alta" {{ old('estatus', $empleado->estatus) == 'alta' ? 'selected' : '' }}>Alta
            </option>
            <option value="baja" {{ old('estatus', $empleado->estatus) == 'baja' ? 'selected' : '' }}>Baja
            </option>
        </select>
        <small id="error_estatus" class="text-danger errores"></small>
        @if ($errors->has('estatus'))
            <div class="invalid-feedback">
                {{ $errors->first('estatus') }}
            </div>
        @endif
    </div> --}}
    <div class="form-group col-sm-12">
        @livewire('checkifmailexists-component', ['empleadoemail' => $empleado->email])
    </div>
</div>
<div class="row">
    <div class="form-group col-sm-6">
        <label for="telefono_movil"><i class="fas fa-mobile-alt iconos-crear"></i></i>Teléfono
            móvil</label>
        <input class="form-control {{ $errors->has('telefono_movil') ? 'is-invalid' : '' }}" type="text"
            name="telefono_movil" id="telefono_movil"
            value="{{ old('telefono_movil', $empleado->telefono_movil) }}">
        <small id="error_telefono_movil" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-4">
        <label for="telefono"><i class="fas fa-phone iconos-crear"></i>Teléfono
            oficina</label>
        <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="text"
            name="telefono" id="telefono" value="{{ old('telefono', $empleado->telefono) }}">
        <small id="error_telefono" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-2">
        <label for="extension"><i class="fas fa-phone-volume iconos-crear"></i>Ext.</label>
        <input class="form-control {{ $errors->has('extension') ? 'is-invalid' : '' }}" type="text"
            name="extension" id="extension" value="{{ old('extension', $empleado->extension) }}">
        <small id="error_extension" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-6 col-md-6 col-6">
        <label for="sede_id" class="required"><i class="fas fa-building iconos-crear"></i>Sede</label>
        <select class="form-control select-search select2 {{ $errors->has('sede') ? 'is-invalid' : '' }}"
            name="sede_id" id="sede_id" required>
            <option selected value="" disabled>-- Selecciona Sede --</option>
            @foreach ($sedes as $sede)
                <option data-direction="{{ $sede->direccion }}" value="{{ $sede->id }}"
                    {{ old('sede_id', $empleado->sede_id) == $sede->id ? 'selected' : '' }}>
                    {{ $sede->sede }}</option>
            @endforeach
        </select>
        <small id="error_sede_id" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-6">
        <label class="required" for="antiguedad"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de
            ingreso</label>
        <input class="form-control {{ $errors->has('antiguedad') ? 'is-invalid' : '' }}" type="date"
            name="antiguedad" id="antiguedad"
            value="{{ old('antiguedad', \Carbon\Carbon::parse($empleado->antiguedad)->format('Y-m-d')) }}" required>
        <small id="error_antiguedad" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-12 col-md-12 col-12">
        <label for="direccion"><i class="fas fa-map iconos-crear"></i>Dirección</label>
        <input class="form-control" type="text" name="direccion" id="direccion"
            value="{{ old('direccion', $empleado->direccion) }}" disabled readonly>
    </div>
    <div class="form-group col-sm-4">
        <label for="tipo_contrato_empleados_id"><i class="fas fa-file-signature iconos-crear"></i>Tipo de
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
        <small id="error_tipo_contrato_empleados_id" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-4">
        <label for="terminacion_contrato"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha de terminación
            de
            contrato</label>
        <input class="form-control {{ $errors->has('terminacion_contrato') ? 'is-invalid' : '' }}" type="date"
            name="terminacion_contrato" id="terminacion_contrato"
            value="{{ old('terminacion_contrato', $empleado->terminacion_contrato) }}">
        <small id="error_terminacion_contrato" class="text-danger errores"></small>
    </div>
    <div class="text-center custom-control custom-checkbox form-group col-sm-4 align-self-end">
        <input type="checkbox"
            {{ old('renovacion_contrato', $empleado->renovacion_contrato) == true ? 'checked' : '' }}
            class="custom-control-input" id="renovacion_contrato" name="renovacion_contrato">
        <small id="error_renovacion_contrato" class="text-danger errores"></small>
        <label class="custom-control-label" for="renovacion_contrato">¿Renovación de
            contrato?</label>
    </div>
    <div class="form-group col-sm-12" id="c_esquema_contratacion">
        <label for="esquema_contratacion"><i class="fas fa-handshake iconos-crear"></i>Esquema de
            contratación</label>
        <select class="form-control select-search {{ $errors->has('esquema_contratacion') ? 'is-invalid' : '' }}"
            name="esquema_contratacion" id="esquema_contratacion">
            <option value="" selected disabled>
                -- Selecciona el esquema de contratación --
            </option>
            <option value="mixto"
                {{ old('esquema_contratacion', $empleado->esquema_contratacion) == 'mixto' ? 'selected' : '' }}>
                Mixto</option>
        </select>
        <small id="error_esquema_contratacion" class="text-danger errores"></small>
    </div>
    <div class="form-group col-sm-12" id="c_semanas_min_timesheet">
        <label for="semanas_min_timesheet"><i class="fa-solid fa-calendar-week iconos-crear"></i>Semanas limite de
            registros atrasados en Timesheet</label>
        <input class="form-control {{ $errors->has('semanas_min_timesheet') ? 'is-invalid' : '' }}" type="number"
            name="semanas_min_timesheet" id="semanas_min_timesheet"
            value="{{ old('semanas_min_timesheet', $empleado != null ? $empleado->semanas_min_timesheet : ($organizacion != null ? $organizacion->semanas_min_timesheet : 3)) }}"
            min="0">
    </div>
    <div class="form-group col-sm-6 d-none" id="c_proyecto_asignado">
        <label for="proyecto_asignado"><i class="fas fa-street-view iconos-crear"></i>Proyecto asignado
        </label>
        <input class="form-control {{ $errors->has('proyecto_asignado') ? 'is-invalid' : '' }}" type="text"
            name="proyecto_asignado" id="proyecto_asignado"
            value="{{ old('proyecto_asignado', $empleado->proyecto_asignado) }}">
        <small id="error_proyecto_asignado" class="text-danger errores"></small>
    </div>
</div>

<div>
    <div style="margin-left: 20px; margin-right: 25px;">
        <div class="row">
            <div class="form-group col-md-2">
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="creacion_proyecto" id="creacion_proyecto"
                        wire:model.live="creacion_proyecto">
                    <label class="form-check-label" for="creacion_proyecto">
                        Crear Proyecto para Contrato
                    </label>
                </div>
            </div>

            @if (!$creacion_proyecto)
                <div class="form-group col-md-10">
                    <label for="no_proyecto" class="txt-tamaño">Número de proyecto*</label>
                    <select class="form-control float-right" name="no_proyecto" id="no_proyecto" required>
                        <option value="" selected>Seleccione un Numero de proyecto</option>
                        @foreach ($proyectos as $proyecto)
                            <option {{ old('no_proyecto') == $proyecto->identificador ? 'selected' : '' }}
                                data-id="{{ $proyecto->id }}" value="{{ $proyecto->identificador }}">
                                {{ $proyecto->identificador }}-{{ $proyecto->proyecto }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('no_proyecto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('no_proyecto') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>

        @if ($creacion_proyecto)
            <div class="row mb-4" style="margin-left: 2px;">
                <div class="recuadro-instruccion">
                    <strong>!</strong> &nbsp; Debe Ingresar un Identificador antes de poder seleccionar la categoria del
                    Proyecto.
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="identificador_proyect" class="asterisco">ID*</label>
                        <input type="text" id="identificador_proyect" placeholder=""
                            value="{{ old('identificador', '') }}"
                            wire:model.live.debounce.1000ms="identificador_proyect" wire:ignore
                            wire:change="verificarIdentificador($event.target.value)"
                            title="Por favor, no incluyas comas en el nombre de la tarea." name="identificador"
                            pattern="[^\.,]*" class="form-control" maxlength="254" required>
                        @if ($errors->has('identificador'))
                            <div class="invalid-feedback">
                                {{ $errors->first('identificador') }}
                            </div>
                        @endif
                        @error('identificador')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div>
                            @if ($mensaje != null)
                                <span class="{{ $class }}" style="color: {{ $colorTexto }}">{{ $mensaje }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="tipo" class="asterisco">Categoría del Proyecto*</label>
                        <select class="form-control" name="tipo" id="tipo" wire:model.live="tipo" required>
                            <option value="" selected>Seleccione una opción</option>
                            @foreach ($select_tipos as $tipo_it)
                                <option value="{{ $tipo_it }}" {{ (old('tipo') == $tipo_it || $tipo == $tipo_it) ? 'selected' : '' }}>
                                    {{ $tipo_it }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label for="name_proyect" class="asterisco">Nombre del proyecto*</label>
                    <input value="{{ old('proyecto_name', '') }}" type="text" id="name_proyect" placeholder=""
                        name="proyecto_name" class="form-control" maxlength="254" required>
                    <span id="alertaGenerica" style="color: red; display: none;"></span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="sede_id" class="asterisco">Sede</label>
                    <select class="form-control" name="sede_id" id="sede_id" required>
                        <option selected value="">Seleccione sede</option>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->id }}" {{ old('sede_id') == $sede->id ? 'selected' : '' }}>
                                {{ $sede->sede }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4">
                    <label for="fecha_inicio_proyecto" class="asterisco">Fecha de inicio</label>
                    <input type="date" name="fecha_inicio_proyecto" id="fecha_inicio_proyecto" class="form-control"
                        value="{{ old('fecha_inicio_proyecto', '') }}" required>
                    @if ($errors->has('fecha_inicio_proyecto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio_proyecto') }}
                        </div>
                    @endif
                    @error('fecha_inicio_proyecto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group col-md-4">
                    <label for="fecha_fin_proyecto" class="asterisco">Fecha de fin</label>
                    <input type="date" name="fecha_fin_proyecto" id="fecha_fin_proyecto" class="form-control"
                        value="{{ old('fecha_fin_proyecto', '') }}" required>
                    @if ($errors->has('fecha_fin_proyecto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_fin_proyecto') }}
                        </div>
                    @endif
                    @error('fecha_fin_proyecto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="horas_asignadas" class="asterisco">Horas Asignadas al proyecto</label>
                    <input type="text" name="horas_proyecto" id="horas_asignadas" class="form-control"
                        placeholder="" maxlength="250" pattern="[0-9]+" title="Por favor, ingrese solo números enteros."
                        value="{{ old('horas_proyecto', '') }}" required>
                    @if ($errors->has('horas_proyecto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('horas_proyecto') }}
                        </div>
                    @endif
                </div>
            </div>
        @endif
    </div>

</div>

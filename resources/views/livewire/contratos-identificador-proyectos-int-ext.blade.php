<div>
    <div style="margin-left: 20px; margin-right: 25px;">
        <div class="row">
            <div class="form-group col-md-2">
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="creacion_proyecto" id="creacion_proyecto"
                        wire:model.live="creacion_proyecto" value="true">
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
                            <option data-id="{{ $proyecto->id }}" value="{{ $proyecto->identificador }}">
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
                        {!! Form::label('identificador_proyect', 'ID*', ['class' => 'asterisco']) !!}
                        <input type="text" id="identificador_proyect" placeholder=""
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
                                <span class="{{ $class }}"
                                    style="color: {{ $colorTexto }}">{{ $mensaje }}</span>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group ">
                        {!! Form::label('tipo', 'Categoria del Proyecto*', ['class' => 'asterisco']) !!}
                        <select class="form-control" name="tipo" id="tipo" wire:model.live="tipo" required>
                            <option value="" selected>Seleccione una opción</option>
                            @foreach ($select_tipos as $tipo_it)
                                <option value="{{ $tipo_it }}" {{ $tipo == $tipo_it ? 'selected' : '' }}>
                                    {{ $tipo_it }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group col-md-4 ">
                    {!! Form::label('name_proyect', 'Nombre del proyecto*', ['class' => 'asterisco']) !!}
                    <input type="text" id="name_proyect" placeholder="" name="proyecto_name" class="form-control"
                        maxlength="254" required>
                    <span id="alertaGenerica" style="color: red; display: none;"></span>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4 ">
                    {!! Form::label('sede_id', 'Sede', ['class' => 'asterisco']) !!}
                    <select class="form-control" name="sede_id" id="sede_id">
                        <option selected value="">Seleccione sede</option>
                        @foreach ($sedes as $sede)
                            <option value="{{ $sede->id }}">{{ $sede->sede }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group col-md-4 ">
                    {!! Form::label('fecha_inicio_proyecto', 'Fecha de inicio', ['class' => 'asterisco']) !!}
                    <input type="date" name="fecha_inicio_proyecto" placeholder="" id="fecha_inicio_proyecto"
                        class="form-control">
                    @if ($errors->has('fecha_inicio_proyecto'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fecha_inicio_proyecto') }}
                        </div>
                    @endif
                    @error('fecha_inicio_proyecto')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-4 ">
                    {!! Form::label('fecha_fin_proyecto', 'Fecha de fin', ['class' => 'asterisco']) !!}
                    <input type="date" name="fecha_fin_proyecto" id="fecha_fin_proyecto" class="form-control">
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
                <div class="form-group col-md-4 ">
                    {!! Form::label('horas_proyecto', 'Horas Asignadas al proyecto', ['class' => 'asterisco']) !!}
                    <input type="text" pattern="[0-9]+" title="Por favor, ingrese solo números enteros."
                        placeholder="" name="horas_proyecto" maxlength="250" id="horas_asignadas" class="form-control">
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

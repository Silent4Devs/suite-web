<form method="POST" action="{{ route('admin.accion-correctivas.update', [$accionCorrectiva->id]) }}"
    enctype="multipart/form-data" class="row">
    @method('PUT')
    @csrf
    <div class="px-1 py-2 mx-3 mb-4 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
        <div class="row w-100">
            <div class="text-center col-1 align-items-center d-flex justify-content-center">
                <div class="w-100">
                    <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                </div>
            </div>
            <div class="col-11">
                <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                    Instrucciones</p>
                <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Al final de
                    cada formulario dé clic en el botón guardar antes de cambiar de pestaña,
                    de lo contrario la información capturada no será guardada.
                </p>

            </div>
        </div>
    </div>
    <div class=" form-group col-lg-2 col-md-2 col-sm-12 anima-focus">
        <div class="form-control mt-2" readonly>{{ $accionCorrectiva->folio }}</div>
        {!! Form::label('tema', 'Folio*', ['class' => 'asterisco']) !!}
    </div>

    <div class="form-group col-md-6 col-lg-6 col-sm-12 anima-focus">
        <input class="form-control mt-2 {{ $errors->has('tema') ? 'is-invalid' : '' }}" placeholder="" name="tema" id="tema"
            maxlength="255" value="{{ old('tema', $accionCorrectiva->tema) }}" required>
            {!! Form::label('tema', 'Título corto de la acción correctiva*', ['class' => 'asterisco']) !!}
        @if ($errors->has('tema'))
            <div class="invalid-feedback">
                {{ $errors->first('tema') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.tema_helper') }}</span>
    </div>



    @if ($accionCorrectiva->es_externo)
        <div class="form-group col-4 anima-focus">
            <select name="estatus" class="form-control select2" id="opciones" onchange='cambioOpciones();'>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'Sin atender' ? 'selected' : '' }} value="Sin atender">
                    Sin atender
                </option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'En curso' ? 'selected' : '' }}
                    value="En curso">
                    En curso</option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'En espera' ? 'selected' : '' }}
                    value="En espera">En espera</option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'Cerrado' ? 'selected' : '' }}
                    value="Cerrado">
                    Cerrado</option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'No procedente' ? 'selected' : '' }}
                    value="No procedente">No procedente</option>
            </select>
            {!! Form::label('estatus', 'Estatus*', ['class' => 'asterisco']) !!}
        </div>
    @endif

    @if (!$accionCorrectiva->es_externo)
        <div class="form-group col-4 anima-focus">
            <select required name="estatus" class="form-control select2" id="opciones" onchange='cambioOpciones();'>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'Sin atender' ? 'selected' : '' }} value="Sin atender">
                    Sin atender
                </option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'En curso' ? 'selected' : '' }}
                    value="En curso">
                    En curso</option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'En espera' ? 'selected' : '' }}
                    value="En espera">En espera</option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'Cerrado' ? 'selected' : '' }}
                    value="Cerrado">
                    Cerrado</option>
                <option {{ old('estatus', $accionCorrectiva->estatus) == 'No procedente' ? 'selected' : '' }}
                    value="No procedente">Cancelado</option>
            </select>
            {!! Form::label('estatus', 'Estatus*', ['class' => 'asterisco']) !!}
        </div>
    @endif

    <div class="form-group col-sm-12 col-md-4 col-lg-4 anima-focus ">
        <input placeholder="" required class="form-control date {{ $errors->has('fecharegistro') ? 'is-invalid' : '' }}"
            type="datetime-local" min="1945-01-01T00:00" disabled name="fecharegistro" id="fecharegistro"
            value="{{ old('fecharegistro', \Carbon\Carbon::parse($accionCorrectiva->fecharegistro)->format('Y-m-d\TH:i')) }}">
            {!! Form::label('fecharegistro', 'Fecha y hora de registro de la AC*', ['class' => 'asterisco']) !!}
        @if ($errors->has('fecharegistro'))
            <div class="invalid-feedback">
                {{ $errors->first('fecharegistro') }}
            </div>
        @endif
    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4 anima-focus">
        <input placeholder="" class="form-control date {{ $errors->has('fecha_verificacion') ? 'is-invalid' : '' }}"
            type="datetime-local" name="fecha_verificacion" id="fecha_verificacion"
            value="{{ old('fecha_verificacion', \Carbon\Carbon::parse($accionCorrectiva->fecha_verificacion)->format('Y-m-d\TH:i')) }}">
            {!! Form::label('fecha_verificacion', 'Fecha y hora de registro de la VE*', ['class' => 'asterisco']) !!}
        @if ($errors->has('fecha_verificacion'))
            <div class="invalid-feedback">
                {{ $errors->first('fecha_verificacion') }}
            </div>
        @endif
    </div>

    <div class="form-group col-4 anima-focus">
        <input class="form-control" name="fecha_cierre" readonly value="{{ $accionCorrectiva->fecha_cierre }}"
            id="solucion" type="datetime">
            {!! Form::label('fecha_cierre', 'Fecha y hora de cierre del ticket*', ['class' => 'asterisco']) !!}
    </div>



    @if (!$accionCorrectiva->es_externo)

        <div class="mt-1 form-group col-12">
            <b>Reportó Acción Correctiva:</b>
        </div>

        <div class="form-group col-sm-12 col-md-4 col-lg-4 anima-focus">
            <select class="form-control {{ $errors->has('id_reporto') ? 'is-invalid' : '' }}" name="id_reporto"
                id="id_reporto" required>
                @foreach ($empleados as $id => $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                        data-area="{{ $empleado->area->area }}"
                        {{ old('id_reporto', $accionCorrectiva->id_reporto) == $empleado->id ? 'selected' : '' }}>

                        {{ $empleado->name }}
                    </option>
                @endforeach
            </select>
            {!! Form::label('id_reporto', 'Nombre*', ['class' => 'asterisco']) !!}
            @if ($errors->has('id_reporto'))
                <div class="invalid-feedback">
                    {{ $errors->first('id_reporto') }}
                </div>
            @endif
        </div>

        <div class="form-group col-md-4 anima-focus">
            <div class="form-control" id="reporto_puesto"></div>
            {!! Form::label('id_reporto_puesto', 'Puesto*', ['class' => 'asterisco']) !!}
        </div>


        <div class="form-group col-sm-12 col-md-4 col-lg-4 anima-focus">
            <div class="form-control" id="reporto_area"></div>
            {!! Form::label('reporto_area', 'Área*', ['class' => 'asterisco']) !!}
        </div>

    @endif

    {{-- @if ($accionCorrectiva->es_externo)

        <div class="mt-1 form-group col-12">
            <b>Solicitó Acción Correctiva:</b>
        </div>

        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="id_reporto"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
            <select class="form-control {{ $errors->has('id_reporto') ? 'is-invalid' : '' }}" name="id_reporto"
                id="id_reporto" >
                @foreach ($empleados as $id => $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                        data-area="{{ $empleado->area->area }}"
                        {{ old('id_reporto', $accionCorrectiva->id_reporto) == $empleado->id ? 'selected' : '' }}>

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
            <div class="form-control" id="reporto_puesto"  ></div>
        </div>


        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="id_reporto_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
            <div class="form-control" id="reporto_area"  ></div>
        </div>

    @endif --}}

    {{-- @if ($accionCorrectiva->es_externo)

        <div class="mt-1 form-group col-12">
            <b>Solicitó Acción Correctiva:</b>
        </div>

        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="id_reporto"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
            <select class="form-control {{ $errors->has('id_reporto') ? 'is-invalid' : '' }}" name="id_reporto"
                id="id_reporto" disabled>
                @foreach ($empleados as $id => $empleado)
                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                        data-area="{{ $empleado->area->area }}"
                        {{ old('id_reporto', $accionCorrectiva->id_reporto) == $empleado->id ? 'selected' : '' }}>

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
            <div class="form-control" id="reporto_puesto" readonly></div>
        </div>


        <div class="form-group col-sm-12 col-md-4 col-lg-4">
            <label for="id_reporto_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
            <div class="form-control" id="reporto_area" readonly></div>
        </div>

    @endif --}}

    @if ($accionCorrectiva->es_externo)

        <div class="mt-1 form-group col-12">
            <strong>Datos del cliente:</strong>
        </div>


        @foreach ($accionCorrectiva->quejascliente as $queja)
            <div class="mt-0 form-group col-6">
                <label class="form-label"><i class="bi bi-building mr-2 iconos-crear"></i>Cliente</label>
                <div class="form-control" readonly>{{ $queja->cliente->nombre }}</div>
            </div>
            <div class="mt-2 form-group col-6">
                <label class="form-label"><i class="fas fa-list iconos-crear"></i>Proyecto</label>
                <div class="form-control" readonly>{{ $queja->proyectos->proyecto }}</div>
            </div>


            <div class="mt-0 form-group col-6">
                <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre del
                    cliente<sup>*</sup></label>
                <div class="form-control" readonly>{{ $queja->nombre }}</div>
            </div>

            <div class="mt-0 form-group col-6">
                <label class="form-label"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                <div class="form-control" readonly>{{ $queja->puesto }}</div>
            </div>

            <div class="mt-0 form-group col-6">
                <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Teléfono</label>
                <div class="form-control" readonly>{{ $queja->telefono }}</div>
            </div>

            <div class="mt-0 form-group col-6">
                <label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo
                    electrónico</label>
                <div class="form-control" readonly>{{ $queja->correo }}</div>
            </div>

            <div class="mt-1 form-group col-12">
                <b>Solicitó Acción Correctiva:</b>
            </div>

            <div class="mt-2 form-group col-4">
                <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
                <div class="form-control" readonly>{{ Str::limit($queja->registro->name, 30, '...') }}</div>
            </div>

            <div class="mt-2 form-group col-4">
                <label class="form-label"><i class="fas fa-suitcase iconos-crear"></i></i>Puesto</label>
                <div class="form-control" readonly>{{ $queja->registro->puesto }}</div>
            </div>

            <div class="form-group col-4">
                <label class="form-label"><i class="bi bi-geo mr-2 iconos-crear"></i>Área</label>
                <div class="form-control" readonly>{{ $queja->registro->area->area }}
                </div>
            </div>
        @endforeach

    @endif

    <div class="mt-1 form-group col-12">
        <b>Registró Acción Correctiva:</b>
    </div>


    <div class="form-group col-sm-12 col-md-4 col-lg-4">
        <label class="required" for="id_registro"><i class="fas fa-user-tie iconos-crear"></i>Nombre</label>
        <select class="form-control {{ $errors->has('id_registro') ? 'is-invalid' : '' }}" name="id_registro"
            id="id_registro" required>
            @foreach ($empleados as $id => $empleado)
                <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                    data-area="{{ $empleado->area->area }}"
                    {{ old('id_reviso', $accionCorrectiva->id_registro) == $empleado->id ? 'selected' : '' }}>

                    {{ $empleado->name }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('id_registro'))
            <div class="invalid-feedback">
                {{ $errors->first('id_registro') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
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
                    {{ old('causaorigen', $accionCorrectiva->causaorigen) === (string) $key ? 'selected' : '' }}>
                    {{ $label }}</option>
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
            id="descripcion">{{ old('descripcion', $accionCorrectiva->descripcion) }}</textarea>
        @if ($errors->has('descripcion'))
            <div class="invalid-feedback">
                {{ $errors->first('descripcion') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.accionCorrectiva.fields.descripcion_helper') }}</span>
    </div>


    @if ($accionCorrectiva->es_externo)
        <div class="mt-3 form-group col-3">
            <label class="form-label"><i class="fas fa-user-plus iconos-crear"></i>Otro(s)</label>
            <textarea style="min-height:187px;" name="otros" class="form-control">{{ old('otro_quejado', $accionCorrectiva->otro_quejado) }}
    </textarea>
        </div>
    @endif


    <div class="text-right form-group col-12">
        <a href="{{ route('admin.accion-correctivas.index') }}" class="btn_cancelar">Cancelar</a>
        <button class="btn btn-danger" type="submit" id="btnGuardar" style="margin-top: 4px;">
            {{ trans('global.save') }}
        </button>
        {{-- <button id="form-siguienteaccion" data-toggle="collapse" onclick="closetabcollanext2()" data-target="#collapseplan" class="btn btn-danger">Siguiente</button> --}}
    </div>

</form>


<script type="text/javascript">
    window.initSelect2 = () => {

        $('.select2').select2({

            'theme': 'bootstrap4'

        });

    }


    initSelect2();

    Livewire.on('select2', () => {

        initSelect2();

    });
</script>

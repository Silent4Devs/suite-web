<style>
    label {
        color: #8d8d8d;
        font-weight: 600;
        margin: 0;
    }

    input,
    select {
        border: 1px solid #8d8d8d !important;
        outline: none;
    }

    .error-border {
        border: 1px solid red !important;
    }
</style>
<div class="row">
    <div class="col-sm-12 col-lg-2">
        @if ($documentoActual->codigo == null)
            <div class="form-group">
                <label for="codigo">Código:</label>
                <input type="{{ $documentoActual->codigo == null ? 'text' : 'hidden' }}"
                    class="form-control {{ $errors->has('codigo') ? 'error-border' : '' }}" id="codigo"
                    aria-describedby="codigo" name="codigo" value="{{ old('codigo', $documentoActual->codigo) }}"
                    autocomplete="off">
                <span id="existCode"></span>
                @if ($errors->has('codigo'))
                    <span class="text-danger">{{ $errors->first('codigo') }}</span>
                @endif
                <span class="text-danger codigo_error error-ajax"></span>
            </div>
        @else
            <label for="codigo">Código:</label>
            <p class="m-0"
                style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background: #0fe85c69;">
                {{ $documentoActual->codigo }}</p>
        @endif
    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="form-group">
            <label for="nombre">Nombre del documento:</label>
            <input type="text" class="form-control {{ $errors->has('nombre') ? 'error-border' : '' }}" id="nombre"
                aria-describedby="nombre" name="nombre" value="{{ old('nombre', $documentoActual->nombre) }}"
                {{ $documentoActual->nombre ? 'readonly' : '' }}>
            @if ($errors->has('nombre'))
                <span class="text-danger">
                    {{ $errors->first('nombre') }}
                </span>
            @endif
            <span class="text-danger nombre_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <div class="form-group">
            <label for="tipo">Tipo:</label>
            <select class="form-control {{ $errors->has('tipo') ? 'error-border' : '' }}" id="tipo" name="tipo">
                <option value="null" disabled selected>--Seleccionar--</option>
                @if ($documentoActual->tipo == 'proceso' || $documentoActual->tipo == null)
                    <option value="proceso" {{ old('tipo', $documentoActual->tipo) == 'proceso' ? 'selected' : '' }}>
                        Proceso</option>
                @endif
                @if ($documentoActual->tipo != 'proceso' || $documentoActual->tipo == null)
                    <option value="politica" {{ old('tipo', $documentoActual->tipo) == 'politica' ? 'selected' : '' }}>
                        Política</option>
                    <option value="procedimiento"
                        {{ old('tipo', $documentoActual->tipo) == 'procedimiento' ? 'selected' : '' }}>
                        Procedimiento</option>
                    <option value="manual" {{ old('tipo', $documentoActual->tipo) == 'manual' ? 'selected' : '' }}>
                        Manual</option>
                    <option value="plan" {{ old('tipo', $documentoActual->tipo) == 'plan' ? 'selected' : '' }}>
                        Plan</option>
                    <option value="instructivo"
                        {{ old('tipo', $documentoActual->tipo) == 'instructivo' ? 'selected' : '' }}>
                        Instructivo</option>
                    <option value="reglamento"
                        {{ old('tipo', $documentoActual->tipo) == 'reglamento' ? 'selected' : '' }}>
                        Reglamento</option>
                    <option value="externo" {{ old('tipo', $documentoActual->tipo) == 'externo' ? 'selected' : '' }}>
                        Documento Externo</option>
                    <option value="formato" {{ old('tipo', $documentoActual->tipo) == 'formato' ? 'selected' : '' }}>
                        Formato</option>
                @endif
            </select>
            @if ($errors->has('tipo'))
                <span class="text-danger">
                    {{ $errors->first('tipo') }}
                </span>
            @endif
            <span class="text-danger tipo_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <div class="form-group">
            <label for="estatus">Estatus:</label>
            @if ($documentoActual->estatus == null)
                <p class="m-0"
                    style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#0a7eeb69">
                    En elaboración</p>
            @elseif(intval($documentoActual->estatus) == 1)
                <p class="m-0"
                    style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#0a7eeb69">
                    En elaboración</p>
            @elseif(intval($documentoActual->estatus) == 2)
                <p class="m-0"
                    style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#0a7eeb69">
                    En revisión</p>
            @elseif(intval($documentoActual->estatus) == 3)
                <p class="m-0"
                    style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#0fe85c69">
                    Publicado</p>
            @elseif(intval($documentoActual->estatus) == 4)
                <p class="m-0"
                    style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#c417005e">
                    Rechazado</p>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-3 {{ $documentoActual->tipo != 'proceso' ? 'd-none' : '' }}" id="macroprocesos">
        <div class="form-group">
            <label for="macroproceso">Pertenece al Macroproceso:</label>
            <select class="form-control {{ $errors->has('macroproceso') ? 'error-border' : '' }}" id="macroproceso"
                name="macroproceso">
                <option value="" selected disabled>--Seleccionar--</option>
                @foreach ($macroprocesos as $macroproceso)
                    <option value="{{ $macroproceso->id }}"
                        {{ old('macroproceso', $documentoActual->macroproceso_id) == $macroproceso->id ? 'selected' : '' }}>
                        {{ $macroproceso->nombre }}</option>
                @endforeach
            </select>
            @if ($errors->has('macroproceso'))
                <span class="text-danger">
                    {{ $errors->first('macroproceso') }}
                </span>
            @endif
            <span class="text-danger macroproceso_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3 {{ $documentoActual->tipo != 'proceso' ? '' : 'd-none' }}" id="procesos">
        <div class="form-group">
            @if (count($procesos) == 0)
                <span class="badge badge-warning">Debes registrar un documento de tipo PROCESO</span>
            @else
                <label for="proceso">Pertenece al Proceso:</label>
            @endif
            <select class="form-control {{ $errors->has('proceso') ? 'error-border' : '' }}" id="proceso"
                name="proceso">
                <option value="" selected disabled>--Seleccionar--</option>
                @foreach ($procesos as $proceso)
                    <option value="{{ $proceso->id }}" {{ $proceso->estatus == '2' ? 'disabled' : '' }}
                        {{ old('proceso', $documentoActual->proceso_id) == $proceso->id ? 'selected' : '' }}>
                        {{ $proceso->nombre }} {{ $proceso->estatus == '2' ? '- [Aprobación pendiente]' : '' }}
                    </option>
                @endforeach
            </select>
            @if ($errors->has('proceso'))
                <span class="text-danger">
                    {{ $errors->first('proceso') }}
                </span>
            @endif
            <span class="text-danger proceso_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-2" x-data="{ estaBloqueado: true }" x-init="estaBloqueado = true">
        <div class="form-group">
            <template x-if="estaBloqueado">
                <div>
                    <label for="version">Versión:</label>
                    <input readonly class="m-0 form-control" type="number" name="version" min="1" {{-- style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#66666669" --}}
                        value="{{ $newversdoc }}" />
                </div>
            </template>
            <template x-if="!estaBloqueado">
                <div>
                    <label for="version">Versión:</label>
                    <input class="m-0 form-control" type="number" name="version" min="1" {{-- style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#66666669" --}}
                        value="{{ $newversdoc }}" />
                </div>
            </template>
            <input type="checkbox" id="estaBloqueado" style="display:none">
            <label for="estaBloqueado" x-on:click="estaBloqueado=!estaBloqueado"><i class="fas"
                    x-bind:class="!estaBloqueado ? 'fa-lock' : 'fa-unlock'"></i></label>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control {{ $errors->has('fecha') ? 'error-border' : '' }}"
                id="fecha" aria-describedby="fecha" name="fecha"
                value="{{ old('fecha', \Carbon\Carbon::parse($documentoActual->fecha)->format('Y-m-d')) }}">
            @if ($errors->has('fecha'))
                <span class="text-danger">
                    {{ $errors->first('fecha') }}
                </span>
            @endif
            <span class="text-danger fecha_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-4">
        <label for="archivo"
            style="cursor: pointer"><span>{{ $documentoActual->archivo != null ? 'Reemplazar' : 'Archivo' }}</span></label>
        <div class="mb-3 custom-file">
            <input type="file" class="custom-file-input" id="archivo"
                {{ $documentoActual->archivo == null ? 'required' : '' }} name="archivo"
                accept="application/pdf, application/.doc,.docx">
            <label class="custom-file-label"
                for="archivo">{{ $documentoActual->archivo == null ? 'Selecciona un archivo' : $documentoActual->archivo }}</label>
            @if ($errors->has('archivo'))
                <span class="text-danger">
                    {{ $errors->first('archivo') }}
                </span>
            @endif
            <span class="text-danger archivo_error error-ajax"></span>
        </div>
        @if ($documentoActual->archivo != null)
            <!-- Button trigger modal -->
            <a data-toggle="modal" data-target="#documentoCargado" style="color: #0f37e8">
                Documento: {{ $documentoActual->archivo }} (Cargado Actualmente)
            </a>
            <div class="modal fade" id="documentoCargado" tabindex="-1" aria-labelledby="documentoCargadoLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="documentoCargadoLabel">{{ $documentoActual->archivo }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <iframe style="width:100%;height: 100%;" src="{{ $documentoActual->archivo_actual }}"
                                frameborder="0"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group" style="position: relative">
            <label for="elaboro_id">Elaboró:</label>
            <select {{ $documentoActual->elaborador ? 'disabled="disabled"' : '' }}
                class="form-control empleado {{ $errors->has('elaboro_id') ? 'error-border' : '' }}" id="elaboro_id"
                name="elaboro_id">
                <option value="" selected disabled>--Seleccionar--</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}" data-image="{{ $empleado->foto }}"
                        data-gender="{{ $empleado->genero }}"
                        {{ old('elaboro_id', $documentoActual->elaboro_id) == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('elaboro_id'))
                <span class="text-danger">
                    {{ $errors->first('elaboro_id') }}
                </span>
            @endif
            <span class="text-danger elaboro_id_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group" style="position: relative">
            <label for="reviso_id">Revisó:</label>
            <select {{ $documentoActual->revisor ? 'disabled="disabled"' : '' }}
                class="form-control empleado {{ $errors->has('reviso_id') ? 'error-border' : '' }}" id="reviso_id"
                name="reviso_id">
                <option value="" selected disabled>--Seleccionar--</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}" data-image="{{ $empleado->foto }}"
                        data-gender="{{ $empleado->genero }}"
                        {{ old('reviso_id', $documentoActual->reviso_id) == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('reviso_id'))
                <span class="text-danger">
                    {{ $errors->first('reviso_id') }}
                </span>
            @endif
            <span class="text-danger reviso_id_error error-ajax"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group" style="position: relative">
            <label for="aprobo_id">Aprobó:</label>
            <select {{ $documentoActual->aprobador ? 'disabled="disabled"' : '' }}
                class="form-control empleado {{ $errors->has('aprobo_id') ? 'error-border' : '' }}" id="aprobo_id"
                name="aprobo_id">
                <option value="" selected disabled>--Seleccionar--</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}" data-image="{{ $empleado->foto }}"
                        data-gender="{{ $empleado->genero }}"
                        {{ old('aprobo_id', $documentoActual->aprobo_id) == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('aprobo_id'))
                <span class="text-danger">
                    {{ $errors->first('aprobo_id') }}
                </span>
            @endif
            <span class="text-danger aprobo_id_error error-ajax"></span>
        </div>
    </div>
    <div class="col-sm-12 col-lg-6">
        <div class="form-group" style="position: relative">
            <label for="responsable_id">Responsable:</label>
            <select {{ $documentoActual->responsable ? 'disabled="disabled"' : '' }}
                class="form-control empleado {{ $errors->has('responsable_id') ? 'error-border' : '' }}"
                id="responsable_id" name="responsable_id">
                <option value="" selected disabled>--Seleccionar--</option>
                @foreach ($empleados as $empleado)
                    <option value="{{ $empleado->id }}" data-image="{{ $empleado->foto }}"
                        data-gender="{{ $empleado->genero }}"
                        {{ old('responsable_id', $documentoActual->responsable_id) == $empleado->id ? 'selected' : '' }}>
                        {{ $empleado->name }}</option>
                @endforeach
            </select>
            @if ($errors->has('responsable_id'))
                <span class="text-danger">
                    {{ $errors->first('responsable_id') }}
                </span>
            @endif
            <span class="text-danger responsable_id_error error-ajax"></span>
        </div>
    </div>
</div>

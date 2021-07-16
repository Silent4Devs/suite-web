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
                <option value="politica" {{ old('tipo', $documentoActual->tipo) == 'politica' ? 'selected' : '' }}>
                    Políticas</option>
                <option value="procedimiento"
                    {{ old('tipo', $documentoActual->tipo) == 'procedimiento' ? 'selected' : '' }}>
                    Procedimientos</option>
                <option value="manual" {{ old('tipo', $documentoActual->tipo) == 'manual' ? 'selected' : '' }}>
                    Manuales</option>
                <option value="plan" {{ old('tipo', $documentoActual->tipo) == 'plan' ? 'selected' : '' }}>
                    Planes</option>
                <option value="instructivo"
                    {{ old('tipo', $documentoActual->tipo) == 'instructivo' ? 'selected' : '' }}>
                    Instructivos</option>
                <option value="reglamento"
                    {{ old('tipo', $documentoActual->tipo) == 'reglamento' ? 'selected' : '' }}>
                    Reglamentos</option>
                <option value="externo" {{ old('tipo', $documentoActual->tipo) == 'externo' ? 'selected' : '' }}>
                    Externos</option>
                <option value="proceso" {{ old('tipo', $documentoActual->tipo) == 'proceso' ? 'selected' : '' }}>
                    Procesos</option>
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
    <div class="col-sm-12 col-lg-3">
        <div class="form-group">
            <label for="macroproceso">Macroproceso:</label>
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
    <div class="col-sm-12 col-lg-2">
        <div class="form-group">
            <label for="version">Version:</label>
            <p class="m-0"
                style="border: 1px solid #ced4da !important;border-radius: 5px;padding: 6px 2px;background:#66666669">
                {{ $documentoActual->version == null ? '1' : intval($documentoActual->version) }}</p>
        </div>
    </div>
    <div class="col-sm-12 col-lg-3">
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" class="form-control {{ $errors->has('fecha') ? 'error-border' : '' }}" id="fecha"
                aria-describedby="fecha" name="fecha"
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
                {{ $documentoActual->archivo == null ? 'required' : '' }} name="archivo" accept="application/pdf">
            <label class="custom-file-label"
                for="archivo">{{ $documentoActual->archivo == null ? 'Selecciona un archivo' : $documentoActual->archivo }}</label>
            @if ($errors->has('archivo'))
                <span class="text-danger">
                    {{ $errors->first('archivo') }}
                </span>
            @endif
            <span class="text-danger archivo_error error-ajax"></span>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 col-lg-6">
        <div class="form-group" style="position: relative">
            <label for="elaboro_id">Elaboró:</label>
            <select {{ $documentoActual->aprobo_id ? 'disabled="disabled"' : '' }}
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
            <select {{ $documentoActual->reviso_id ? 'disabled="disabled"' : '' }}
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
            <select {{ $documentoActual->aprobo_id ? 'disabled="disabled"' : '' }}
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
            <select {{ $documentoActual->responsable_id ? 'disabled="disabled"' : '' }}
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

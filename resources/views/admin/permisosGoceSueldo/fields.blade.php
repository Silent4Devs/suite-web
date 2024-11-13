<!-- Nombre Field -->
<div class="row">

    <div class="form-group col-sm-6 anima-focus">
        <input type="text" name="nombre" class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}"
            maxlength="255" placeholder="" value="{{ old('nombre', $vacacion->nombre) }}" required>
        @if ($errors->has('nombre'))
            <div class="invalid-feedback">
                {{ $errors->first('nombre') }}
            </div>
        @endif
        <label for="nombre" class="required">Nombre:</label>
        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6 anima-focus">
        <input type="number" name="dias" class="form-control"
            maxlength="255" placeholder="" value="{{ old('dias', $vacacion->dias) }}" required>
        <label for="dias" class="required">Días a otorgar:</label>
    </div>
</div>

<!-- Tipo de Permiso Field -->
<div class="row">
    <div class="form-group col-sm-6 anima-focus">
        <select id="tipo_permiso" name="tipo_permiso" class="form-control" required>
            <option value="1" {{ old('tipo_permiso', $vacacion->tipo_permiso) == 1 ? 'selected' : '' }}>
                Permisos conforme a la ley
            </option>
            <option value="2" {{ old('tipo_permiso', $vacacion->tipo_permiso) == 2 ? 'selected' : '' }}>
                Permisos otorgados por la empresa
            </option>
            <option value="" {{ old('tipo_permiso', $vacacion->tipo_permiso) == null ? 'selected' : '' }} disabled>
                Seleccione...
            </option>
        </select>
        <label for="tipo_permiso" class="required">Tipo de Permiso:</label>
    </div>
</div>

<!-- Descripcion Field -->
<div class="row">
    <div class="form-group col-sm-12 anima-focus">
        <textarea class="form-control" id="descripcion" name="descripcion" rows="2" required>{{ old('descripcion', $vacacion->descripcion) }}</textarea>
        <label for="descripcion">Descripción:</label>
    </div>
</div>

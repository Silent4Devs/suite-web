<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="nombre" class="required">Nombre:</label>
        <input type="text" id="nombre" name="nombre" class="form-control" maxlength="255" required>
    </div>

    <!-- Id Amenaza Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-skull-crossbones iconos-crear"></i>
        <label for="id_amenaza">Amenaza:</label>
        <select class="custom-select" id="id_amenaza" name="id_amenaza" required>
            <option selected value="" disabled>Seleccione una opción</option>
            @forelse ($amenazas as $amenaza)
                <option value="{{ $amenaza->id }}">{{ $amenaza->nombre }}</option>
            @empty
                <option value="" disabled>Sin Datos</option>
            @endforelse
        </select>
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-12">
        <label for="descripcion">
            <i class="fas fa-file-alt iconos-crear"></i> Descripción:
        </label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ old('descripcion', $vulnerabilidad->descripcion) }}</textarea>
    </div>

    <!-- Submit Field -->
    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
        <button class="btn btn-primary" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>

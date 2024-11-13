<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="nombre" class="required">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="255" required>
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-th-list iconos-crear"></i>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" class="form-control" maxlength="255">
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-12">
        <label for="descripcion">
            <i class="fas fa-file-alt iconos-crear"></i> Descripción:
        </label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion', $amenaza->descripcion) }}</textarea>
    </div>

    <!-- Submit Field -->
    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
        <button class="btn btn-primary" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</div>

<div class="row">
    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-file-signature iconos-crear"></i>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $calendario->nombre) }}"
            class="form-control" maxlength="255">
    </div>

    <!-- Fecha inicio Field -->
    @php
        if ($calendario->fecha) {
            $fecha = explode('-', $calendario->fecha);
            $startDate = $fecha[0];
            $endDate = $fecha[1];
        } else {
            $startDate = now();
            $endDate = now();
        }
    @endphp
    <div class="form-group col-sm-6">
        <label for="fecha"><i class="fas fa-calendar-alt iconos-crear"></i>Fecha</label>
        <input type="text" id="fecha" name="fecha" class="form-control">
        <script>
            $('#fecha').daterangepicker({
                startDate: moment(@json($startDate)),
                endDate: moment(@json($endDate))
            });
        </script>
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-th-list iconos-crear"></i>
        <label for="categoria">Categoría:</label>
        <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $calendario->categoria) }}"
            class="form-control" maxlength="255">
    </div>

    <!-- Descripción Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-file-alt iconos-crear"></i>
        <label for="descripcion">Descripción:</label>
        <input type="text" name="descripcion" id="descripcion"
            value="{{ old('descripcion', $calendario->descripcion) }}" class="form-control" maxlength="255">
    </div>


    <!-- Submit Field -->
    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
        <button class="btn btn-primary" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>

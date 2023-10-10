<div id="categorias_capacitacion_select">
    <select name="categoria_capacitacion_id" id="categoria_capacitacion_id" class="form-control select2">
        <option value="" selected disabled>-- Selecciona una categoría --</option>
        @foreach ($categorias as $categoria)
            <option data-nombre="{{ $categoria->nombre }}" value="{{ $categoria->id }}"
                {{ old('categoria_capacitacion_id', $categoria->id) == $categoria_seleccionada ? 'selected' : '' }}>
                {{ $categoria->nombre }}
            </option>
        @endforeach
    </select>
    {{-- <small class="text-muted">Selecciona la categoría</small> --}}
</div>

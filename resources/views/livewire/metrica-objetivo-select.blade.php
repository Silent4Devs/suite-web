<div class="w-100" id="metrica_objetivo_select">
    <select class="form-control metrica-seleccionada select2 {{ $errors->has('metrica_id') ? 'is-invalid' : '' }}"
        name="metrica_id" id="metrica_id">
        @foreach ($metricas as $metrica)
            <option value="{{ $metrica->id }}"
                {{ old('metrica_id', $metrica->id) == $metrica_seleccionada ? 'selected' : '' }}>
                {{ $metrica->definicion }}</option>
        @endforeach
    </select>
    <small class="text-muted">Selecciona la unidad de medición del objetivo estratégico</small>
</div>

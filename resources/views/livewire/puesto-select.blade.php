<div id="puesto_select">
    {{-- <select class="form-control select2 {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}" name="puesto_id"
        id="puesto_id">
        @foreach ($puestos as $puesto)
            <option value="{{ $puesto->id }}"
                {{ old('puesto_id', $puesto->id) == $puestos_seleccionado ? 'selected' : '' }}>
                {{ $puesto->puesto }}</option>
        @endforeach
    </select> --}}
    <select class="form-control {{ $errors->has('puesto_id') ? 'is-invalid' : '' }}" name="puesto_id" id="puesto_id"
        required>
        <option value="" selected disabled>
            -- Selecciona un puesto --
        </option>
        @foreach ($puestos as $puesto)
            <option value="{{ $puesto->id }}"
                {{ old('puesto_id', $puesto->id) == $puestos_seleccionado ? 'selected' : '' }}>
                {{ $puesto->puesto }}
            </option>
        @endforeach
    </select>
</div>

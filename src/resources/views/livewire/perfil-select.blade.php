<div id="perfiles_select">
    <select class="form-control {{ $errors->has('perfil_empleado_id') ? 'is-invalid' : '' }}" name="perfil_empleado_id"
        id="perfil_empleado_id">
        <option value="" disabled selected>-- Selecciona una opción --</option>
        @foreach ($perfiles as $perfil)
            <option value="{{ $perfil->id }}"
                {{ old('perfil_empleado_id', $perfil->id) == $perfiles_seleccionado ? 'selected' : '' }}>
                {{ $perfil->nombre }}</option>
        @endforeach
    </select>

</div>

 <div id="tipo_competencia_select">
     <select class="form-control select2 {{ $errors->has('tipo_id') ? 'is-invalid' : '' }}" name="tipo_id"
         id="tipo_id">
         @foreach ($tipos as $tipo)
             <option value="{{ $tipo->id }}"
                 {{ old('tipo_id', $tipo->id) == $tipo_seleccionado ? 'selected' : '' }}>
                 {{ $tipo->nombre }}</option>
         @endforeach
     </select>
     <small class="text-muted">Selecciona el tipo de competencia</small>
 </div>

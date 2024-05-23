<div class="row">
    <div class="form-group col-md-3 col-sm-12" wire:ignore>
        <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>Confidencialidad</label><br>
        <select class="form-control select2 {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
            name="confidencialidad" id="confidencialidad_informacion" wire:model.live="confidencialidad">
            <option value="0" {{ $confidencialidad == 1 ? 'selected' : '' }}>0</option>
            <option value="1" {{ $confidencialidad == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ $confidencialidad == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ $confidencialidad == 3 ? 'selected' : '' }}>3</option>
            <option value="4" {{ $confidencialidad == 4 ? 'selected' : '' }}>4</option>
            <option value="5" {{ $confidencialidad == 5 ? 'selected' : '' }}>5</option>
        </select>
        <small class="text-danger errores confidencialidad_error"></small>
    </div>
    <div class="form-group col-md-3 col-sm-12" wire:ignore>
        <label for="disponibilidad"><i class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label><br>
        <select class="form-control select2 {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}"
            name="disponibilidad" id="disponibilidad_informacion" wire:model.live="disponibilidad">
            <option value="0" {{ $disponibilidad == 0 ? 'selected' : '' }}>0</option>
            <option value="1" {{ $disponibilidad == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ $disponibilidad == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ $disponibilidad == 3 ? 'selected' : '' }}>3</option>
            <option value="4" {{ $disponibilidad == 4 ? 'selected' : '' }}>4</option>
            <option value="5" {{ $disponibilidad == 5 ? 'selected' : '' }}>5</option>
        </select>
        <small class="text-danger errores disponibilidad_error"></small>
    </div>

    <div class="form-group col-md-3 col-sm-12" wire:ignore>
        <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label><br>
        <select class="form-control select2 {{ $errors->has('integridad') ? 'is-invalid' : '' }}" name="integridad"
            id="integridad_informacion" wire:model.live="integridad">
            <option value="0" {{ $integridad == 0 ? 'selected' : '' }}>0</option>
            <option value="1" {{ $integridad == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ $integridad == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ $integridad == 3 ? 'selected' : '' }}>3</option>
            <option value="4" {{ $integridad == 4 ? 'selected' : '' }}>4</option>
            <option value="5" {{ $integridad == 5 ? 'selected' : '' }}>5</option>
        </select>
        <small class="text-danger errores integridad_error"></small>
    </div>

    <div class="form-group col-md-3 col-sm-12" wire:ignore.self>
        <label for="evaluación_riesgo"><i class="fas fa-exclamation-triangle iconos-crear"></i>Evaluación
            del Riesgo</label><br>
        <input class="mt-2 form-control {{ $errors->has('evaluación_riesgo') ? 'is-invalid' : '' }}" type="text"
            style="background: {{ $colorReglaTipo }};color:{{ $colorTextoTipo }};" name="evaluación_riesgo"
            value="{{ old('evaluación_riesgo', '') }}" id="evaluación_riesgo_informacion"
            wire:model="evaluacion">
        <small class="text-danger errores evaluacion_riesgo_error"></small>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        $('#confidencialidad_informacion').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('confidencialidad', data.id);
        });
        $('#disponibilidad_informacion').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('disponibilidad', data.id);
        });
        $('#integridad_informacion').on('select2:select', function(e) {
            var data = e.params.data;
            @this.set('integridad', data.id);
        });
    })
</script>

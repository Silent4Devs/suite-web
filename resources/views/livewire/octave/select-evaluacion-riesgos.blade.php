<div class="row">
    <div wire:ignore class="form-group col-md-3 col-sm-12">
        <label for="confidencialidad"><i class="fas fa-lock iconos-crear"></i>Confidencialidad</label><br>
        <select class="form-control select2 {{ $errors->has('confidencialidad') ? 'is-invalid' : '' }}"
            name="confidencialidad" wire:model.live="confidencialidad" id="confidencialidad_informacion">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <small class="text-danger errores confidencialidad_error"></small>
    </div>

    <div wire:ignore class="form-group col-md-3 col-sm-12">
        <label for="disponibilidad"><i class="fas fa-lock-open iconos-crear"></i>Disponibilidad</label><br>
        <select class="form-control select2 {{ $errors->has('disponibilidad') ? 'is-invalid' : '' }}"
            name="disponibilidad" wire:model.live="disponibilidad" id="disponibilidad_informacion">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <small class="text-danger errores disponibilidad_error"></small>
    </div>

    <div wire:ignore class="form-group col-md-3 col-sm-12">
        <label for="integridad"><i class="fab fa-black-tie iconos-crear"></i>Integridad</label><br>
        <select class="form-control select2 {{ $errors->has('integridad') ? 'is-invalid' : '' }}" name="integridad"
            wire:model.live="integridad" id="integridad_informacion">
            <option value="0">0</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <small class="text-danger errores integridad_error"></small>
    </div>

    <div wire:ignore.self class="form-group col-md-3 col-sm-12">
        <label for="evaluacion_riesgo"><i class="fas fa-exclamation-triangle iconos-crear"></i>Evaluación
            del Riesgo</label><br>
        <input class="mt-2 form-control {{ $errors->has('evaluacion_riesgo') ? 'is-invalid' : '' }}" type="text"
            style="background: {{ $colorReglaTipo }};color:{{ $colorTextoTipo }};" name="evaluacion_riesgo"
            wire:model.live="evaluacion" id="evaluacion_informacion" value="{{ old('evaluacion_riesgo', '') }}">
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

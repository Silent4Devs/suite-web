<div class="mt-3">
    <label for="competencias">Selecciona las competencias que desees vincular a la evaluación <span
            class="text-danger">*</span></label>
    <select class="mt-2" id="competencias" name="competencias[]" multiple>
        @foreach ($competencias as $competencia)
            <option value="{{ $competencia->id }}"
                {{ in_array($competencia->id, $competencias_seleccionadas) ? 'selected' : '' }}>
                {{ $competencia->nombre }}
            </option>
        @endforeach
    </select>
    <span class="errors competencias_error text-danger"></span>
    <small id="evaluadosQuestionHelp" class="form-text text-muted">Selecciona las competencias que serán evaluadas en el
        cuestionario</small>
</div>

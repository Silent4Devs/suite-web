<div class="mt-3">
    <div>
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
        <small id="evaluadosQuestionHelp" class="form-text text-muted">Selecciona las competencias que serán evaluadas en
            el
            cuestionario</small>
    </div>
    <div>
        <label for="objetivos">Selecciona los objetivos que desees vincular a la evaluación <span
                class="text-danger">*</span></label>
        <select class="mt-2" id="objetivos" name="objetivos[]" multiple>
            @foreach ($objetivos as $objetivo)
                <option value="{{ $objetivo->id }}"
                    {{ in_array($objetivo->id, $objetivos_seleccionados) ? 'selected' : '' }}>
                    {{ $objetivo->nombre }}
                </option>
            @endforeach
        </select>
        <span class="errors objetivos_error text-danger"></span>
        <small id="objetivosHelp" class="form-text text-muted">Selecciona los objetivos que serán evaluados en el
            cuestionario</small>
    </div>
</div>

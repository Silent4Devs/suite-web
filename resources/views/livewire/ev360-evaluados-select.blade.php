<div>
    <p class="text-muted"><i class="fas fa-info-circle"></i> Seleccionar Evaluados</p>
    <select class="form-control" wire:model.live.debounce.800ms="evaluados_objetivo" id="evaluados_objetivo" name="evaluados_objetivo"
        wire:change="habilitarSelectAlternativo()">
        <option value="" selected disabled>-- Seleciona una opción --</option>
        <option value="all">Toda la empresa</option>
        <option value="area">Por areas</option>
        @foreach ($grupos_evaluados as $grupo)
            <option value="{{ $grupo->id }}">{{ $grupo->nombre }} - Grupo</option>
        @endforeach
        <option value="manual">Manualmente</option>
    </select>
    <span class="errors evaluados_manual_error text-danger"></span>
    <small id="evaluadosQuestionHelp" class="form-text text-muted">Selecciona a quien(es)
        irá dirigida la
        evaluación</small>
    @if ($habilitarSelectAreas)
        <select class="mt-3 form-control" id="by_area">
            <option value="" selected disabled>-- Seleciona una opción --</option>
            @foreach ($areas as $area)
                <option value="{{ $area->id }}">{{ $area->area }}</option>
            @endforeach
        </select>
    @endif
    @if ($habilitarSelectManual)
        <select class="mt-3 form-control" multiple id="by_manual">
            @foreach ($empleados as $empleado)
                <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
            @endforeach
        </select>
        <small class="form-text text-muted">No se creará un nuevo grupo, recomendado para
            selecciones de una sola vez</small>
    @endif

    <script>
        // window.initSelect2 = () => {
        //     $('#evaluados_objetivo').select2({
        //         'theme': 'bootstrap4'
        //     });
        // }

        // initSelect2();

        // Livewire.on('select2', () => {
        //     initSelect2();
        // });
    </script>
</div>

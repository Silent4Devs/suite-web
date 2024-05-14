<div>
    <div class="col-12">
        <div class="row justify-content-center align-items-center">
            <div class="col-9">
                <label class="mb-0" for="descripcion">
                    <i class="fas fa-users iconos-crear"></i> Público objetivo <small class="text-danger"></small>
                </label>
                <select class="mt-2 form-control {{ $errors->has('evaluados_objetivo') ? 'is-invalid' : '' }}"
                    wire:model.lazy="evaluados_objetivo" id="evaluados_objetivo" name="evaluados_objetivo"
                    wire:change="habilitarSelectAlternativo()">
                    <option value="" selected>-- Seleciona una opción --</option>
                    <option value="all">Toda la empresa</option>
                    <option value="area">Por Área</option>
                    @foreach ($grupos_evaluados as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }} -
                            Grupo
                        </option>
                    @endforeach
                    <option value="manual">Manualmente</option>
                </select>
                @if ($errors->has('evaluados_objetivo'))
                    <div class="invalid-feedback">
                        {{ $errors->first('evaluados_objetivo') }}
                    </div>
                @endif
                <span class="errors evaluados_manual_error text-danger"></span>
                <small id="evaluadosQuestionHelp" class="form-text text-muted">Selecciona a
                    quien(es)
                    va dirigida la
                    evaluación</small>
                @if ($habilitarSelectAreas)
                    <select class="mt-3 form-control {{ $errors->has('by_area') ? 'is-invalid' : '' }}" id="by_area"
                        wire:model.defer="by_area" name="by_area">
                        <option value="" selected>-- Seleciona el área a evaluar --
                        </option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->id }}">{{ $area->area }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('by_area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('by_area') }}
                        </div>
                    @endif
                @endif
                @if ($habilitarSelectManual)
                    <label class="m-0 mt-2" for="">Selecciona a los empleados a
                        evaluar</label>
                    <select class="mt-3 form-control {{ $errors->has('by_manual') ? 'is-invalid' : '' }}" multiple
                        id="by_manual" wire:model.defer="by_manual" name="by_manual[]">
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->id }}">
                                {{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    @if ($errors->has('by_manual'))
                        <div class="invalid-feedback">
                            {{ $errors->first('by_manual') }}
                        </div>
                    @endif
                    <small class="form-text text-muted">Importante: No se creará un
                        nuevo grupo,esta opción es recomendada para selecciones de una
                        sola vez</small>
                @endif
            </div>
            <div class="col-3" style="margin-top: 0;">
                @livewire('ev360-grupo-evaluados-create')
            </div>
        </div>
    </div>
</div>

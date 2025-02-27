<div class="row">
    <div class="mb-0 form-group col-sm-7">
        <div class="form-group">
            <label for="evaluacion"><i class="fas fa-file-signature iconos-crear"></i>Evaluación</label>
            <input class="form-control {{ $errors->has('evaluacion') ? 'is-invalid' : '' }}" type="text"
                name="evaluacion" wire:model.live="evaluacion" id="evaluacion">
            @if ($errors->has('evaluacion'))
                <div class="invalid-feedback">
                    {{ $errors->first('evaluacion') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>
    </div>
    <div class="mb-0 form-group col-md-5">
        <label for="fecha"><i class="far fa-calendar-alt iconos-crear"></i>Fecha</label>
        <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="date" name="fecha"
            id="fecha" min="1945-01-01" value="{{ old('fecha') }}" wire:model.live="fecha">
        <div class="input-group-addon">
            <span class="glyphicon glyphicon-th"></span>
        </div>
        @if ($errors->has('fecha'))
            <div class="invalid-feedback">
                {{ $errors->first('fecha') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.planBaseActividade.fields.fecha_inicio_helper') }}</span>
    </div>
</div>

<div class="row">
    <div class="mb-2 form-group col-sm-2">
        <div class="form-check">
            <input class="form-check-input @error('no_aplica') is-invalid @enderror" type="checkbox" id="no_aplica"
                wire:model="no_aplica" wire:click="cambio_aplica">
            <label class="form-check-label" for="no_aplica">No aplica evaluación</label>
        </div>
        @error('no_aplica')
            <div class="invalid-feedback d-block">
                {{ $message }}
            </div>
        @enderror
    </div>
</div>
@if ($no_aplica)
    <div class="row">
        <div class="mb-2 form-group col-sm-12">
            <div class="mt-2">
                <label for="justificacion">Justificación</label>
                <textarea class="form-control @error('justificacion') is-invalid @enderror" id="justificacion"
                    wire:model="justificacion"></textarea>

                @error('justificacion')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

                <span class="help-block">{{ trans('cruds.planBaseActividade.fields.fecha_inicio_helper') }}</span>
            </div>
        </div>
    </div>
@else
    <div class="row">
        @foreach ($customFields as $key => $customField)
            @if ($customField != null)
                <div class="mb-0 form-group col-sm-6">
                    <div class="form-group mb-1">
                        <label for="formSlugs.{{ $key }}.{{ $customField }}"><i
                                class="fab fa-diaspora iconos-crear"></i>{{ ucfirst(substr($customField, 1)) }}</label>
                        <input class="form-control slugs-inputs {{ $errors->has('') ? 'is-invalid' : '' }}" type="number"
                            wire:model.live="formSlugs.{{ $key }}.{{ $customField }}"
                            {{-- min="{{ $rangos_ind->valor_minimo ?? 0 }}" max="{{ $rangos_ind->valor_maximo ?? null }}"  --}}
                            id="formSlugs.{{ $key }}.{{ $customField }}" value="" required>
                    </div>
                    @if ($errors->has("formSlugs.$key.$customField"))
                        <small class="text-danger">
                            <p>Debes agregar esta evaluación</p>
                        </small>
                    @endif
                </div>
            @endif
        @endforeach
    </div>
@endif

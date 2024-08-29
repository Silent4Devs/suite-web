{{-- <form wire:submit="store" enctype="multipart/form-data"> --}}
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
    @foreach ($customFields as $key => $customField)
        @if ($customField != null)
            <div class="mb-0 form-group col-sm-6">
                <div class="form-group mb-1">
                    <label for="formSlugs.{{ $key }}.{{ $customField}}"><i
                            class="fab fa-diaspora iconos-crear"></i>{{ ucfirst(substr($customField, 1)) }}</label>
                    <input class="form-control slugs-inputs {{ $errors->has('') ? 'is-invalid' : '' }}" type="number"
                        min="0" wire:model.live="formSlugs.{{ $key }}.{{ $customField }}"
                        id="formSlugs.{{ $key }}.{{ $customField }}" value="" required>
                </div>
                {{-- {{"formSlugs.$key.$customField->variable"}} --}}
                @if ($errors->has("formSlugs.$key.$customField"))
                    <small class="text-danger">
                        {{-- {{ $errors->first("formSlugs.$key.$customField->variable") }} --}}
                        <p>Debes agregar esta evaluación</p>
                    </small>
                @endif
            </div>
        @endif
    @endforeach
    {{-- <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Enviar</button> --}}

</div>
{{-- </form> --}}

{{-- <form wire:submit.prevent="store" enctype="multipart/form-data"> --}}
<div class="row">
    <div class="mb-0 form-group col-sm-7">
        <div class="form-group">
            <label for="evaluacion"><i class="fas fa-file-signature iconos-crear"></i>Evaluación</label>
            <input class="form-control {{ $errors->has('evaluacion') ? 'is-invalid' : '' }}" type="text"
                name="evaluacion" wire:model="evaluacion" id="evaluacion">
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
            id="fecha" value="{{ old('fecha') }}" wire:model="fecha">
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
        <div class="mb-0 form-group col-sm-6">
            <div class="form-group mb-1">
                <label for="formSlugs.{{ $key }}.{{ $customField->variable }}"><i
                        class="fab fa-diaspora iconos-crear"></i>{{ ucfirst(substr($customField->variable, 1)) }}</label>
                <input class="form-control slugs-inputs {{ $errors->has('') ? 'is-invalid' : '' }}" type="number"
                    wire:model="formSlugs.{{ $key }}.{{ $customField->variable }}"
                    id="formSlugs.{{ $key }}.{{ $customField->variable }}" value="" required>
            </div>
            {{-- {{"formSlugs.$key.$customField->variable"}} --}}
            @if ($errors->has("formSlugs.$key.$customField->variable"))
                <small class="text-danger">
                    {{-- {{ $errors->first("formSlugs.$key.$customField->variable") }} --}}
                    <p>Debes agregar esta evaluación</p>
                </small>
            @endif
        </div>
    @endforeach
    {{-- <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Enviar</button> --}}

</div>
{{-- </form> --}}

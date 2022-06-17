{{-- <form wire:submit.prevent="store" enctype="multipart/form-data"> --}}
<div class="row">
    <div class="form-group col-sm-6">
        <div class="form-group">
            <label for="evaluacion"><i class="fas fa-file-signature iconos-crear"></i>Evaluación</label>
            <input class="form-control {{ $errors->has('evaluacion') ? 'is-invalid' : '' }}" type="text"
                name="evaluacion" wire:model="evaluacion" id="evaluacion">
            @if ($errors->has('evaluacion'))
                <div class="invalid-feedback">
                    {{ $errors->first('evaluacion') }}
                </div>
            @endif
            {{ $evaluacion }}
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="fecha"><i class="far fa-calendar-alt iconos-crear"></i>Fecha</label>
        <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="date" name="fecha"
            id="fecha" value="{{ old('fecha') }}" wire:model.defer="fecha">
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
    @foreach ($customFields as $key => $customField)
        <div class="form-group col-sm-6">
            <div class="form-group">
                <label><i
                        class="fab fa-diaspora iconos-crear"></i>{{ ucfirst(substr($customField->variable, 1)) }}</label>
                <input class="form-control {{ $errors->has('') ? 'is-invalid' : '' }}" type="number"
                    wire:model.defer="formSlugs.{{ $key }}.{{ $customField->variable }}" value=""
                    required>
            </div>
        </div>
    @endforeach
    {{-- <button type="button" wire:click.prevent="store()" class="btn btn-success btn-sm">Enviar</button> --}}

</div>
{{-- </form> --}}

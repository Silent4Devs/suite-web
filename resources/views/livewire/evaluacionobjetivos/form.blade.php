{{-- <form wire:submit="store" enctype="multipart/form-data"> --}}
<div class="row">

    <div class="form-group col-sm-6">
        <div class="form-group">
            <label for="evaluacion" class="required"><i class="fas fa-file-signature iconos-crear"></i>Evaluación</label>
            <input id="evaluacion" class="form-control {{ $errors->has('evaluacion') ? 'is-invalid' : '' }}"
                type="text" name="evaluacion" wire:model.live="evaluacion" id="evaluacion" required>
            @if ($errors->has('evaluacion'))
                <div class="invalid-feedback">
                    {{ $errors->first('evaluacion') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>
    </div>
    <div class="form-group col-md-6 col-sm-6">
        <label for="fecha" class="required"><i class="far fa-calendar-alt iconos-crear"></i>Fecha</label>
        <input class="form-control date {{ $errors->has('fecha') ? 'is-invalid' : '' }}" type="date" name="fecha"
            id="fecha" value="{{ old('fecha') }}" wire:model.live="fecha" required>
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
    <div id="caja_eval" class="form-group col-md-12 col-12 col-sm-12">
        <div class="row">
            @foreach ($customFields as $key => $customField)
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="required"><i
                                class="fab fa-diaspora iconos-crear"></i>{{ ucfirst(substr($customField->variable, 1)) }}</label>
                        <input data-type="formSlugs" class="form-control {{ $errors->has('') ? 'is-invalid' : '' }}"
                            type="number" data-key="{{ $key }}" data-variable="{{ $customField->variable }}"
                            value="" required>
                    </div>
                    @error('formSlugs.' . $key . '.' . $customField->variable)
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror
                </div>
            @endforeach
        </div>
    </div>
    <script>
        window.addEventListener('DOMContentLoaded', function() {
            Livewire.on('limpiarSlugs', () => {
                document.querySelectorAll('[data-type="formSlugs"]').forEach(input => {
                    input.value = ''
                })
            });

            document.getElementById('caja_eval').addEventListener('keyup', function(e) {
                var key = e.target.dataset.key;
                var variable = e.target.dataset.variable;
                var input = e.target.value;
                @this.set('formSlugs.' + key + '.' + variable, input, true);
            });

            document.getElementById('caja_eval').addEventListener('change', function(e) {
                var key = e.target.dataset.key;
                var variable = e.target.dataset.variable;
                var input = e.target.value;
                @this.set('formSlugs.' + key + '.' + variable, input, true);
            });
        });
    </script>
</div>
{{-- </form> --}}

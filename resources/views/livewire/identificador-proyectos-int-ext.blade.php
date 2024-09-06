<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group anima-focus">
                <input type="text" id="identificador_proyect" placeholder=""
                    wire:model.live.debounce.1000ms="identificador_proyect"
                    title="Por favor, no incluyas comas en el nombre de la tarea." name="identificador" pattern="[^\.,]*"
                    class="form-control" maxlength="254" required>
                {!! Form::label('identificador', 'ID*', ['class' => 'asterisco']) !!}
                @if ($errors->has('identificador'))
                    <div class="invalid-feedback">
                        {{ $errors->first('identificador') }}
                    </div>
                @endif
                @error('identificador')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
                <div>
                    @if ($mensaje != null)
                        <span class="{{ $class }}" style="color: {{ $colorTexto }}">{{ $mensaje }}</span>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group anima-focus">
                <select class="form-control" name="tipo" id="tipo" wire:model.live="tipo" required>
                    <option value="" selected>Seleccione una opción</option>
                    @foreach ($select_tipos as $tipo_it)
                        <option value="{{ $tipo_it }}" {{ $tipo == $tipo_it ? 'selected' : '' }}>
                            {{ $tipo_it }}
                        </option>
                    @endforeach
                </select>
                {!! Form::label('tipo', 'Tipo*', ['class' => 'asterisco']) !!}
            </div>
        </div>
    </div>
</div>

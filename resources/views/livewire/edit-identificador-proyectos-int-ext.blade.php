<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    <div class="row">
        <div class="col-md-6">
            <div class="form-group anima-focus">
                <input type="text" id="identificador_proyect" placeholder=""
                    wire:model.debounce2000ms="identificador_proyect"
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
            </div>

            <div class="mb-4">
                @if ($mensaje != null)
                    <span class="{{ $class }}">{{ $mensaje }}</span>
                @endif
            </div>
        </div>

        <div class="form-group col-md-6" wire:loading wire:target="identificador_proyect">
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>

        <div class="form-group col-md-4 anima-focus" wire:loading.remove>
            <select class="form-control" name="tipo" id="tipo" wire:model="tipo" required>
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

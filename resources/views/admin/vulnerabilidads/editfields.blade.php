<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form-control" maxlength="255" value="{{ old('nombre') }}">
    </div>

    <!-- Id Amenaza Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-skull-crossbones iconos-crear"></i>
        <label for="id_amenaza">Amenaza:</label>
        <select class="custom-select" id="id_amenaza" name="id_amenaza">
            <option selected value="" disabled>Seleccione una opción</option>
            @forelse ($amenazas as $amenaza)
                <option value="{{ $amenaza->id }}" {{ $vulnerabilidad->id_amenaza == $amenaza->id ? 'selected' : '' }}>
                    {{ $amenaza->nombre }}
                </option>
            @empty
                <option value="" disabled>Sin Datos</option>
            @endforelse
        </select>
    </div>


    <!-- Descripcion Field -->
    {{-- <div class="form-group col-sm-6">
        <i class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}
        {!! Form::text('descripcion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div> --}}
    <div class="form-group col-sm-12">
        <label for="descripcion">
            <i class="fas fa-file-alt iconos-crear"></i> Descripción:
        </label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="2">{{ old('descripcion', $vulnerabilidad->descripcion) }}</textarea>
    </div>

    <!-- Submit Field -->
    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
        <button class="btn btn-primary" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>

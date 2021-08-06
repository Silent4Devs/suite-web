<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}
        {!! Form::text('descripcion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Id Amenaza Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-skull-crossbones iconos-crear"></i>{!! Form::label('id_amenaza', 'Amenaza:') !!}
        <select class="custom-select" id="id_amenaza" name="id_amenaza">
            <option selected value="" disabled>Seleccione una opción</option>
            @forelse ($amenazas as $amenaza)
                <option value="{{ $amenaza->id }}">{{ $amenaza->nombre }}</option>
            @empty
                <option value="" disabled>Sin Datos</option>
            @endforelse
        </select>
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('admin.vulnerabilidads.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

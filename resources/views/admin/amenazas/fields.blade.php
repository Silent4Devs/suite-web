<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('nombre', 'Nombre:') !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-th-list iconos-crear"></i>{!! Form::label('categoria', 'Categoria:') !!}
        {!! Form::text('categoria', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}
        {!! Form::text('descripcion', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit('Enviar', ['class' => 'btn btn-primary']) !!}
        <a href="{{ route('admin.amenazas.index') }}" class="btn btn-secondary">Cancelar</a>
    </div>
</div>

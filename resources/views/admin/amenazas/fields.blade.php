<div class="row">
    <!-- Nombre Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('nombre', 'Nombre:',['class'=>'required']) !!}
        {!! Form::text('nombre', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255,'required']) !!}
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fas fa-th-list iconos-crear"></i>{!! Form::label('categoria', 'Categoría:') !!}
        {!! Form::text('categoria', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Descripcion Field -->
    <div class="form-group col-sm-12">
        <label for="exampleFormControlTextarea1"> <i class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}</label>
        <textarea class="form-control" id="edescripcion" name="descripcion" rows="2">{{ old('descripcion', $amenaza->descripcion) }}</textarea>
    </div>

    <!-- Submit Field -->
   <div class="text-right form-group col-12">
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>

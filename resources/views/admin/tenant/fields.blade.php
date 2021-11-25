<div class="row">
    <!-- id -->
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('id', 'Dominio:') !!}
        {!! Form::text('id', null, ['class' => 'form-control', 'maxlength' => 255, 'maxlength' => 255]) !!}
    </div>

    <!-- Submit Field -->
   <div class="text-right form-group col-12">
    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
    <button class="btn btn-danger" type="submit">
        {{ trans('global.save') }}
    </button>
</div>

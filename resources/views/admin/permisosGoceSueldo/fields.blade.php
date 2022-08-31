<!-- Nombre Field -->
<div class="row">

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
            title="Nombre del lineamiento"></i>{!! Form::label('nombre', 'Nombre:', ['class' => 'required']) !!}
        {!! Form::text('nombre', null, [
            'class' => 'form-control',
            'maxlength' => 255,
            'maxlength' => 255,
            'placeholder' => 'Esciba nombre de la regla de vacaciones...',
        ]) !!}
         @if ($errors->has('nombre'))
         <div class="invalid-feedback">
             {{ $errors->first('nombre') }}
         </div>
     @endif
        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6">
        <i class="fa-solid fa-calendar-day iconos-crear"></i><i class="fas fa-info-circle"
            style="font-size:12pt; float: right;" title="Días otorgados por la organización"></i>{!! Form::label('dias', 'Días a otorgar:', ['class' => 'required']) !!}
        {!! Form::number('dias', null, [
            'class' => 'form-control',
            'maxlength' => 255,
            'maxlength' => 255,
            'placeholder' => 'Ingrese numero inicial de días...',
        ]) !!}
    </div>
</div>
<!-- Descripcion Field -->

<div class="row">
    <div class="form-group col-sm-6">
        <i class="bi bi-book-half iconos-crear"></i><i class="fas fa-info-circle" style="font-size:12pt; float: right;"
        title="Tipo de permiso  otorgado por la organización"></i>{!! Form::label('tipo_permiso', 'Tipo de Permiso', ['class' => 'required']) !!}
        <select id="tipo_permiso" name="tipo_permiso" class="form-control">
            <option value="1" {{ old('tipo_permiso', $vacacion->tipo_permiso) == 1 ? ' selected="selected"' : '' }}>
                Permisos conforme a la ley</option>
            <option value="2" {{ old('tipo_permiso', $vacacion->tipo_permiso) ==  2? ' selected="selected"' : '' }}>
                Permisos otorgados por la empresa</option>
            <option disabled {{ old('tipo_permiso', $vacacion->tipo_permiso) ==  null ? ' selected="selected"' : '' }}>
                Seleccione...</option>
        </select>
    </div>
</div>
<!-- Descripcion Field -->

<div class="row">
    <div class="form-group col-sm-12">
        <label for="exampleFormControlTextarea1"> <i
                class="fas fa-file-alt iconos-crear"></i>{!! Form::label('descripcion', 'Descripción:') !!}</label>
        <textarea class="form-control" id="edescripcion" name="descripcion" rows="2">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
    </div>
</div>

<!-- Submit Field -->
<div class="row">
    <div class="text-right form-group col-12">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
        <button class="btn btn-danger" type="submit">
            {{ trans('global.save') }}
        </button>
    </div>
</div>

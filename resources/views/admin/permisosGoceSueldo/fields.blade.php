<!-- Nombre Field -->
<div class="row">

    <div class="form-group col-sm-6 anima-focus">
        {!! Form::text('nombre', null, [
            'class' => 'form-control',
            'maxlength' => 255,
            'maxlength' => 255,
            'placeholder' => '',
        ]) !!}
        @if ($errors->has('nombre'))
            <div class="invalid-feedback">
                {{ $errors->first('nombre') }}
            </div>
        @endif
        {!! Form::label('nombre', 'Nombre:', ['class' => 'required']) !!}
        <span class="help-block">{{ trans('cruds.matrizRiesgo.fields.amenaza_helper') }}</span>
    </div>

    <!-- Categoria Field -->
    <div class="form-group col-sm-6 anima-focus">
        {!! Form::number('dias', null, [
            'class' => 'form-control',
            'maxlength' => 255,
            'maxlength' => 255,
            'placeholder' => '',
        ]) !!}
        {!! Form::label('dias', 'Días a otorgar:', ['class' => 'required']) !!}
    </div>
</div>
<!-- Descripcion Field -->

<div class="row">
    <div class="form-group col-sm-6 anima-focus">
        <select id="tipo_permiso" name="tipo_permiso" class="form-control">
            <option value="1"
                {{ old('tipo_permiso', $vacacion->tipo_permiso) == 1 ? ' selected="selected"' : '' }}>
                Permisos conforme a la ley</option>
            <option value="2"
                {{ old('tipo_permiso', $vacacion->tipo_permiso) == 2 ? ' selected="selected"' : '' }}>
                Permisos otorgados por la empresa</option>
            <option disabled {{ old('tipo_permiso', $vacacion->tipo_permiso) == null ? ' selected="selected"' : '' }}>
                Seleccione...</option>
        </select>
        {!! Form::label('tipo_permiso', 'Tipo de Permiso', ['class' => 'required']) !!}
    </div>
</div>
<!-- Descripcion Field -->

<div class="row">
    <div class="form-group col-sm-12 anima-focus">
        <textarea class="form-control" id="edescripcion" name="descripcion" rows="2">{{ old('descripcion', $vacacion->descripcion) }}</textarea>
        {!! Form::label('descripcion', 'Descripción:') !!}
    </div>
</div>

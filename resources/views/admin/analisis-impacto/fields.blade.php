<!-- DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO  -->
<div class="row">
    <div class="text-center form-group col-12" style="background-color:#345183; border-radius: 100px; color: white;">
        DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('fecha_entrevista', 'Fecha de la entrevista:', ['class' => 'required']) !!}
        @error('fecha_entrevista')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::date('fecha_entrevista', null, [
            'class' => 'form-control',
            'required',
            'min="1945-01-01"',
        ]) !!}
    </div>
    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('entrevistado', 'Entrevistado:', ['class' => 'required']) !!}
        @error('entrevistado')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('entrevistado', null, [
            'class' => 'form-control ',
            'maxlength' => 120,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('puesto', 'Puesto:', ['class' => 'required']) !!}
        @error('puesto')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('puesto', null, [
            'class' => 'form-control',
            'maxlength' => 200,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('area', 'Área:', ['class' => 'required']) !!}
        @error('area')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('area', null, [
            'class' => 'form-control',
            'maxlength' => 150,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('direccion', 'Dirección:', ['class' => 'required']) !!}
        @error('direccion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('direccion', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('extencion', 'Extensión:') !!}
        @error('extencion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::number('extencion', null, [
            'class' => 'form-control',
            'maxlength' => 4,
            'min=0',
            'max=9999',
            'placeholder' => '...',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('correo', 'Correo:', ['class' => 'required']) !!}
        @error('correo')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::email('correo', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('procesos_a_cargo', 'Procesos a su cargo:', ['class' => 'required']) !!}
        @error('procesos_a_cargo')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('procesos_a_cargo', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>
</div>
<!-- DATOS DE IDENTIFICACIÓN DEL PROCESO  -->
<div class="row">
    <div class="text-center form-group col-12" style="background-color:#345183; border-radius: 100px; color: white;">
        DATOS DE IDENTIFICACIÓN DEL PROCESO
    </div>
</div>

<div class="row" x-data="{ periodicidad: false }">
    <div class="form-group col-sm-8">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('id_proceso', 'ID del Proceso:', ['class' => 'required']) !!}
        @error('id_proceso')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('id_proceso', null, [
            'class' => 'form-control',
            'maxlength' => 20,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-4">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('version', 'Versión:', ['class' => 'required']) !!}
        @error('version')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('version', null, [
            'class' => 'form-control',
            'maxlength' => 50,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-8">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('nombre_proceso', 'Nombre del Proceso:', ['class' => 'required']) !!}
        @error('nombre_proceso')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('nombre_proceso', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-4">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('tipo', 'Tipo:', ['class' => 'required']) !!}
        @error('tipo')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('tipo', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('macroproceso', 'Macroproceso:', ['class' => 'required']) !!}
        @error('macroproceso')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('macroproceso', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('subproceso', 'Subproceso:', ['class' => 'required']) !!}
        @error('subproceso')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('subproceso', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('objetivo_proceso', 'Objetivo del Proceso:', ['class' => 'required']) !!}
        @error('objetivo_proceso')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('objetivo_proceso', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>


    <div class="form-group col-sm-12">
        <label for="tipo_conteo" class="required"><i class="fa-solid fa-calendar-days iconos-crear"></i>Periodicidad con
            que se genera:</label>
        @error('periodicidad')
            <small style="color: red">{{$message}}</small>
        @enderror

    </div>
    <div class="form-group col-sm-12">
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="1"  @click="periodicidad = false" {{ old('periodicidad_mensual',$cuestionario->periodicidad) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio1">Diario</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="2"  @click="periodicidad = false" {{ old('periodicidad_mensual',$cuestionario->periodicidad) == '2' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio2">Semanal</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="3"  @click="periodicidad = false" {{ old('periodicidad_mensual',$cuestionario->periodicidad) == '3' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio3">Mensual</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="4"
                @click="periodicidad = true" {{ old('periodicidad_mensual',$cuestionario->periodicidad) == '4' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio3">Otro: </label>
        </div>
    </div>

    <div class="form-group col-sm-12" x-show="periodicidad">
        <input type="text" class="form-control" name="p_otro_txt" placeholder="Defina" x-bind:disabled="!periodicidad">
    </div>
</div>


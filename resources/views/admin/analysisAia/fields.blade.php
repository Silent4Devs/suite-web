<!-- DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO  -->
<div class="row">
    <div class="text-center form-group col-12" style="background-color:#345183; border-radius: 100px; color: white;">
        DATOS DE IDENTIFICACIÓN DEL ENTREVISTADO
    </div>
</div>

<div class="row">
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('fecha_entrevista', 'Fecha de la entrevista:', ['class' => 'required']) !!}
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
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('entrevistado', 'Entrevistado:', ['class' => 'required']) !!}
        @error('entrevistado')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('entrevistado', null, [
            'class' => 'form-control',
            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('puesto', 'Puesto:', ['class' => 'required']) !!}
        @error('puesto')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('puesto', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('area', 'Área:', ['class' => 'required']) !!}
        @error('area')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('area', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//           'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('extencion', 'Extensión:') !!}
        @error('extencion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::number('extencion', null, [
            'class' => 'form-control',
            'placeholder' => '...',
            'min=0',
            'max=9999',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('correo', 'Correo:', ['class' => 'required']) !!}
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
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('aplicaciones_a_cargo', 'Aplicaciones a su cargo::', ['class' => 'required']) !!}
        @error('aplicaciones_a_cargo')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('aplicaciones_a_cargo', null, [
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
        DATOS DE IDENTIFICACIÓN DE LA APLICACIÓN
    </div>
</div>

<div class="row" x-data="{ periodicidad: false }">

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('nombre_aplicacion', 'Nombre de la Aplicación:', ['class' => 'required']) !!}
        @error('nombre_aplicacion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('nombre_aplicacion', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>
    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('id_aplicacion', 'ID de la Aplicación:', ['class' => 'required']) !!}
        @error('id_aplicacion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('id_aplicacion', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('version', 'Versión:', ['class' => 'required']) !!}
        {!! Form::text('version', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>



    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('productivo_desarrollo', 'Estatus:', ['class' => 'required']) !!}
        @error('productivo_desarrollo')
            <small style="color: red">{{$message}}</small>
        @enderror
        <select class="form-control" name="productivo_desarrollo" required>
            <option value disabled {{ old('productivo_desarrollo', null) === null ? 'selected' : '' }}>
                Selecciona una opción</option>
            @foreach (App\Models\AnalisisAIA::AmbienteSelect as $key => $label)
                <option value="{{ $key }}"
                    {{ old('productivo_desarrollo', $cuestionario->productivo_desarrollo) === (int) $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group col-sm-6">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('interno_externo', 'Publicación:', ['class' => 'required']) !!}
        @error('interno_externo')
            <small style="color: red">{{$message}}</small>
        @enderror
        <select class="form-control" name="interno_externo" required>
            <option value disabled {{ old('interno_externo', null) === null ? 'selected' : '' }}>
                Selecciona una opción</option>
            @foreach (App\Models\AnalisisAIA::PublicacionSelect as $key => $label)
                <option value="{{ $key }}"
                    {{ old('interno_externo', $cuestionario->interno_externo) === (int) $key ? 'selected' : '' }}>
                    {{ $label }}
                </option>
            @endforeach
        </select>
    </div>




    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('objetivo_aplicacion', 'Objetivo de la Aplicación:', ['class' => 'required']) !!}
        @error('objetivo_aplicacion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('objetivo_aplicacion', null, [
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
            <input class="form-check-input" type="radio" name="periodicidad" value="1"
                @click="periodicidad = false"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '1' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio1">Diario</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="2"
                @click="periodicidad = false"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '2' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio2">Semanal</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="3"
                @click="periodicidad = false"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '3' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio3">Mensual</label>
        </div>
        <div class="col-sm-2 form-check form-check-inline">
            <input class="form-check-input" type="radio" name="periodicidad" value="4"
                @click="periodicidad = true"
                {{ old('periodicidad_mensual', $cuestionario->periodicidad) == '4' ? 'checked' : '' }}>
            <label class="form-check-label" for="inlineRadio3">Otro: </label>
        </div>
    </div>

    <div class="form-group col-sm-12" x-show="periodicidad">
        <input type="text" class="form-control" name="p_otro_txt" placeholder="Defina"
            x-bind:disabled="!periodicidad">
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>
        {!! Form::label('area_pertenece_aplicacion', 'Área a la que pertenece la Aplicación:', ['class' => 'required']) !!}
        @error('area_pertenece_aplicacion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('area_pertenece_aplicacion', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>

    <div class="form-group col-sm-12">
        <i class="fas fa-id-card iconos-crear"></i>{!! Form::label('area_responsable_aplicacion', 'Área responsable del uso de la Aplicación:', [
            'class' => 'required']) !!}
        @error('area_responsable_aplicacion')
            <small style="color: red">{{$message}}</small>
        @enderror
        {!! Form::text('area_responsable_aplicacion', null, [
            'class' => 'form-control',
            'maxlength' => 255,
//            'maxlength' => 255,
            'placeholder' => '...',
            'required',
        ]) !!}
    </div>
</div>

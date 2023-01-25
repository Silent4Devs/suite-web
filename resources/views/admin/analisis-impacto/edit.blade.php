@extends('layouts.admin')

<style>
    hr {
        width: 100%;
        margin: 0% !important;
        margin-bottom: 10px !important;
    }

    #primer_semestre {
        display: none;
    }

    #segundo_semestre {
        display: none;
    }

    input[type=checkbox]+.label_calendario {
        cursor: pointer;
    }

    .label_calendario::before {
        content: '';
        background: transparent;
        border: 4px solid #ffffff;
        border-radius: 25px;

        height: 95px;
        margin-right: 20px;
        width: 95px;
    }

    input[type=checkbox]:checked+.label_cuadro::after {
        content: 'PRIMER SEMESTRE';
        background-color: #f4ff00;
        font-size: 15px;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        padding-top: 3px;
    }

    input[type=checkbox]:checked+.label_cuadro_dos::after {
        content: 'SEGUNDO SEMESTRE';
        background-color: #f4ff00;
        font-size: 15px;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 1;
        padding-top: 3px;
    }

    #color-relleno .card {
        background-color: rgba(0, 0, 0, 0) !important;
    }

    .dias td {
        padding: 0;
    }
</style>
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.menu') !!}">Análisis de Impacto (BIA)</a>
        </li>
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.index') !!}">Cuestionario</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Cuestionario de Análisis de Impacto</h5>
    <div class="mt-4 card">
        <div class="card-body">
            {!! Form::model($cuestionario, [
                'route' => ['admin.analisis-impacto.update', $cuestionario->id],
                'method' => 'patch',
            ]) !!}

            @include('admin.analisis-impacto.fields')

            <!--  RESPONSABLES DEL PROCESO -->
            <div class="row">
                <div class="text-center form-group col-12"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    RESPONSABLES DEL PROCESO
                </div>
            </div>
            <div class="row">
                <div class="input-group col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Titular *</strong></span>
                    </div>
                    <input type="text" name="titular_nombre" aria-label="First name" class="form-control"
                        placeholder="Nombre(s)" required
                        value="{{ old('titular_nombre', $cuestionario->titular_nombre) }}">
                        <input type="text" name="titular_a_paterno" aria-label="Last name" class="form-control"
                        placeholder="A. Paterno" required
                        value="{{ old('titular_a_paterno', $cuestionario->titular_a_paterno) }}">
                        <input type="text" name="titular_a_materno" aria-label="Last name" class="form-control"
                        placeholder="A. Materno" required
                        value="{{ old('titular_a_materno', $cuestionario->titular_a_materno) }}"><br>
                    @error('titular_nombre')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    @error('titular_a_paterno')
                    <small style="color: red">{{$message}}</small>
                        @enderror
                    @error('titular_a_materno')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    </div>
                <div class="form-group col-sm-12 mt-3">
                    {!! Form::label('titular_puesto', 'Puesto', ['class' => 'required']) !!}
                    @error('titular_puesto')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('titular_puesto', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('titular_correo', 'Correo electrónico:', ['class' => 'required']) !!}
                    @error('titular_correo')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('titular_correo', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('titular_extencion', 'Extensión') !!}
                    @error('titular_extencion')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('titular_extencion', null, [
                        'class' => 'form-control extencion',
                        'maxlength' => 4,
//                        'maxlength' => 255,
                        'min=0',
                        'max=9999',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <hr>
                <div class="input-group col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Suplente *</strong></span>
                    </div>
                    <input type="text" name="suplente_nombre" aria-label="First name" class="form-control"
                        placeholder="Nombre(s)" required
                        value="{{ old('suplente_nombre', $cuestionario->suplente_nombre) }}">
                        <input type="text" name="suplente_a_paterno" aria-label="Last name" class="form-control"
                        placeholder="A. Paterno" required
                        value="{{ old('suplente_a_paterno', $cuestionario->suplente_a_paterno) }}">
                        <input type="text" name="suplente_a_materno" aria-label="Last name" class="form-control"
                        placeholder="A. Materno" required
                        value="{{ old('suplente_a_materno', $cuestionario->suplente_a_materno) }}"><br>
                        @error('suplente_nombre')
                            <small style="color: red">{{$message}}</small>
                        @enderror
                        @error('suplente_a_paterno')
                            <small style="color: red">{{$message}}</small>
                        @enderror
                        @error('suplente_a_materno')
                            <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                <div class="form-group col-sm-12 mt-3">
                    {!! Form::label('suplente_puesto', 'Puesto', ['class' => 'required']) !!}
                    @error('suplente_puesto')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('suplente_puesto', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('suplente_correo', 'Correo electrónico:', ['class' => 'required']) !!}
                    @error('suplente_correo')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('suplente_correo', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('suplente_extencion', 'Extensión') !!}
                    {!! Form::number('suplente_extencion', null, [
                        'class' => 'form-control extencion1',
                        'maxlength' => 4,
//                        'maxlength' => 255,
                        'min=0',
                        'max=9999',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="input-group col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Supervisor *</strong></span>
                    </div>
                    <input type="text" name="supervisor_nombre" aria-label="First name" class="form-control"
                        placeholder="Nombre(s)" required
                        value="{{ old('supervisor_nombre', $cuestionario->supervisor_nombre) }}">
                    <input type="text" name="supervisor_a_paterno" aria-label="Last name" class="form-control"
                        placeholder="A. Paterno" required
                        value="{{ old('supervisor_a_paterno', $cuestionario->supervisor_a_paterno) }}">
                    <input type="text" name="supervisor_a_materno" aria-label="Last name" class="form-control"
                        placeholder="A. Materno" required
                        value="{{ old('supervisor_a_materno', $cuestionario->supervisor_a_materno) }}"><br>
                    @error('supervisor_nombre')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    @error('supervisor_a_paterno')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    @error('supervisor_a_materno')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                </div>
                <div class="form-group col-sm-12 mt-3">
                    {!! Form::label('supervisor_puesto', 'Puesto', ['class' => 'required']) !!}
                    @error('supervisor_puesto')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('supervisor_puesto', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('supervisor_correo', 'Correo electrónico:', ['class' => 'required']) !!}
                    @error('supervisor_correo')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('supervisor_correo', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('supervisor_extencion', 'Extensión') !!}
                    {!! Form::number('supervisor_extencion', null, [
                        'class' => 'form-control extencion2',
                        'maxlength' => 4,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'min=0',
                        'max=9999',
                    ]) !!}
                </div>
            </div>



            <!-- FLUJO DEL PROCESO -->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    FLUJO DEL PROCESO
                </div>
            </div>
            <div class="row" x-data="{ periodicidad_flujo: false }">
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_1',
                        '1. ¿Qué información se requiere para iniciar el proceso?  (Documentos, Correo electrónico, Oficios, Reportes, etc.)',
                        ['class' => 'required'],
                    ) !!}
                    @error('flujo_q_1')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_1', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_2',
                        '2. ¿De dónde proviene la información? (Nombre de la Empresa / Nombre del Área / Nombre del Proceso / Nombre del Sistema)',
                        ['class' => 'required'],
                    ) !!}
                    @error('flujo_q_2')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_2', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                {{-- livewire 3.¿Quién le proporciona esta información? --}}
                @livewire('propociona-informacion', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_4',
                        '4. ¿De qué manera recibe usted la información? (Entrega Física / Correo Electrónico / Consulta en Aplicativo o Base de Datos / Consulta en Portal Web)',
                        ['class' => 'required'],
                    ) !!}
                    @error('flujo_q_4')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_4', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                {{-- Alpine periodicidad flujo --}}
                <div class="form-group col-sm-12">
                    <label for="tipo_conteo" class="required">5.
                        ¿Con
                        que periodicidad recibe esta información para llevar a cabo el proceso?:</label>
                </div>
                <div class="form-group col-sm-12">
                    <div class="col-sm-2 form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="periodicidad_diario" value="0">
                        <input class="form-check-input" type="checkbox" name="periodicidad_diario" value="1"
                            {{ old('periodicidad_diario', $cuestionario->periodicidad_diario) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio1">Diario</label>
                    </div>
                    <div class="col-sm-2 form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="periodicidad_quincenal" value="0">
                        <input class="form-check-input" type="checkbox" name="periodicidad_quincenal" value="1"
                            {{ old('periodicidad_quincenal', $cuestionario->periodicidad_quincenal) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio2">Quincenal</label>
                    </div>
                    <div class="col-sm-2 form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="periodicidad_mensual" value="0">
                        <input class="form-check-input" type="checkbox" name="periodicidad_mensual" value="1"
                            {{ old('periodicidad_mensual', $cuestionario->periodicidad_mensual) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio3">Mensual</label>
                    </div>
                    <div class="col-sm-2 form-check form-check-inline">
                        <input class="form-check-input" type="hidden" name="periodicidad_otro" value="0">
                        <input class="form-check-input" type="checkbox" name="periodicidad_otro" value="1"
                            x-model="periodicidad_flujo"
                            {{ old('periodicidad_otro', $cuestionario->periodicidad_otro) == '1' ? 'checked' : '' }}>
                        <label class="form-check-label" for="inlineRadio3">Otro: </label>
                    </div>
                </div>
                {{--  --}}
                <div class="form-group col-sm-12" x-show="periodicidad_flujo">
                    <input type="text" class="form-control" name="periodicidad_flujo_txt" placeholder="Defina"
                        x-bind:disabled="!periodicidad_flujo">
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_6',
                        '6. ¿Qué información obtiene al finalizar el proceso? (Documentos, Correo electrónico, Oficios, Reportes, etc.)',
                        ['class' => 'required'],
                    ) !!}
                    @error('flujo_q_6')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_6', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('flujo_q_7', '7.    ¿Este es un proceso final o genera información para iniciar otro proceso?', [
                        'class' => 'required',
                    ]) !!}
                    @error('flujo_q_7')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_7', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_8',
                        '8. ¿A dónde envía la información generada en el proceso? (Nombre de la Empresa / Nombre del Área / Nombre del Proceso / Nombre del Sistema)',
                        ['class' => 'required'],
                    ) !!}
                    @error('flujo_q_8')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_8', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>

                {{-- livewire 9.¿Quién le recibe esta información? --}}
                @livewire('recibe-informacion', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_10',
                        '10.    ¿Cómo valida que el proceso se realizó correctamente? (Carta o firma de aceptación, Acuse de Recibido, Notificación, etc..)',
                        ['class' => 'required'],
                    ) !!}
                    @error('flujo_q_10')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('flujo_q_10', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12"><label for="tipo_conteo" class="required">11. ¿Cuánto tiempo requiere
                        para realizar el
                        proceso de inicio a fin?</label> </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_años', 'Año(s)') !!}
                    @error('flujo_años')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('flujo_años', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'min=0',
                        'max=50',
                        'required',
                    ]) !!}
                </div>

                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_meses', 'Mes(es)') !!}
                    @error('flujo_meses')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('flujo_meses', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'min=0',
                        'max=12',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_semanas', 'Semana(s)') !!}
                    @error('flujo_semanas')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('flujo_semanas', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'min=0',
                        'max=52',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_dias', 'Día(s)') !!}
                    @error('flujo_dias')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('flujo_dias', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                        'min=0',
                        'max=365',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-4">
                    {!! Form::label('flujo_otro_txt', 'Otro') !!}
                    {!! Form::text('flujo_otro_txt', null, [
                        'class' => 'form-control',
                        'placeholder' => 'Defina..',
                    ]) !!}
                </div>
            </div>
            <!-- INFRAESTRUCTURA TECNOLÓGICA (inciso b Anexo 67)-->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    INFRAESTRUCTURA TECNOLÓGICA
                </div>
            </div>
            <div class="row">
                {{-- livewire  INFRAESTRUCTURA TECNOLÓGICA --}}
                @livewire('infraestructura-tecnologica', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}
            </div>

            <!-- RECURSOS HUMANOS (inciso b Anexo67)-->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    RECURSOS HUMANOS
                </div>
            </div>
            <div class="row">
                {{-- livewire RECURSOS HUMANOS (inciso b Anexo67) --}}
                @livewire('recursos-humanos', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}
            </div>


            <!--RECURSOS MATERIALES (inciso b Anexo67)-->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    RECURSOS MATERIALES
                </div>
            </div>
            <div class="row">
                {{-- RECURSOS MATERIALES (inciso b Anexo67) --}}
                @livewire('recursos-materiales', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}
            </div>

            <!--RECURSOS MATERIALES (inciso b Anexo67)-->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    PERÍODOS CRÍTICOS
                </div>
            </div>
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#9da0a6; border-radius: 100px; color: white;">
                    SEMESTRES
                </div>
                <div class="text-center form-group col-12">
                    <table class="table">
                        <TR style="color: rgb(0, 0, 0); text-align:center; height:65px; font-size:15px;"
                            id="color-relleno">
                            <TH>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="primer_semestre">
                                    <input class="form-check-input check_calendario" type="checkbox" id="primer_semestre"
                                        name="primer_semestre" value="2"
                                        {{ old('primer_semestre', $cuestionario->primer_semestre) == 2 ? 'checked' : '' }}>
                                    <label for="primer_semestre" class="label_cuadro">PRIMER SEMESTRE</label>
                                </div>
                            </TH>
                            <TH>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="segundo_semestre">
                                    <input type="checkbox" id="segundo_semestre" name="segundo_semestre" value="2"
                                        {{ old('segundo_semestre', $cuestionario->segundo_semestre) == 2 ? 'checked' : '' }}>
                                    <label for="segundo_semestre" class="label_cuadro_dos">SEGUNDO SEMESTRE</label>
                                </div>
                            </TH>
                        </TR>
                    </table>
                </div>

                <div class="text-center form-group col-12"
                    style="background-color:#9da0a6; border-radius: 100px; color: white;">
                    MESES
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table_checkbox">
                        <TR class="mt-5" style="color: rgb(0, 0, 0); text-align:center; height:65px;">
                            <TH style="position: relative;">
                                <label for="eneCheckbox">ENE</label><br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="ene">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="ene"
                                        id="eneCheckbox" {{ old('ene', $cuestionario->ene) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="febCheckbox">FEB</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="feb">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="feb"
                                        id="febCheckbox" {{ old('feb', $cuestionario->feb) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="marCheckbox">MAR</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="mar">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="mar"
                                        id="marCheckbox" {{ old('mar', $cuestionario->mar) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="abrCheckbox">ABR</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="abr">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="abr"
                                        id="abrCheckbox" {{ old('abr', $cuestionario->abr) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="mayCheckbox">MAY</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="may">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="may"
                                        id="mayCheckbox" {{ old('may', $cuestionario->may) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="junCheckbox">JUN</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="jun">
                                    <input class=" d-none" type="checkbox" value="2" name="jun"
                                        id="junCheckbox" {{ old('jun', $cuestionario->jun) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="julCheckbox">JUL</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="jul">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="jul"
                                        id="julCheckbox" {{ old('jul', $cuestionario->jul) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="agoCheckbox">AGO</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="ago">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="ago"
                                        id="agoCheckbox" {{ old('ago', $cuestionario->ago) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="sepCheckbox">SEP</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="sep">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="sep"
                                        id="sepCheckbox" {{ old('sep', $cuestionario->sep) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="octCheckbox">OCT</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="oct">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="oct"
                                        id="octCheckbox" {{ old('oct', $cuestionario->oct) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="novCheckbox">NOV</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="nov">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="nov"
                                        id="novCheckbox" {{ old('nov', $cuestionario->nov) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                            <TH>
                                <label for="dicCheckbox">DIC</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="dic">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="dic"
                                        id="dicCheckbox" {{ old('dic', $cuestionario->dic) == 2 ? 'checked' : '' }}>
                                </div>
                            </TH>
                        </TR>
                    </table>
                </div>
                <div class="text-center form-group col-12"
                    style="background-color:#9da0a6; border-radius: 100px; color: white;">
                    SEMANAS
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table_checkbox">
                        <TR style="color: rgb(0, 0, 0); text-align:center; height:65px;">
                            <TD>
                                <label for="s1Checkbox">SEMANA 1</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="s1">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="s1"
                                        id="s1Checkbox" {{ old('s1', $cuestionario->s1) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="s2Checkbox">
                                    SEMANA 2
                                </label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="s2">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="s2"
                                        id="s2Checkbox" {{ old('s2', $cuestionario->s2) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="s3Checkbox">SEMANA 3</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="s3">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="s3"
                                        id="s3Checkbox" {{ old('s3', $cuestionario->s3) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="s4Checkbox">SEMANA 4</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="s4">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="s4"
                                        id="s4Checkbox" {{ old('s4', $cuestionario->s4) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                        </TR>
                    </table>
                </div>

                <div class="text-center form-group col-12"
                    style="background-color:#9da0a6; border-radius: 100px; color: white;">
                    DÍAS DEL MES
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table-sm table_checkbox">
                        <TR style="color: rgb(0, 0, 0); text-align:center; height:65px;">
                            <TD>
                                <label for="check_number_01">LUNES</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d1">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d1"
                                        id="check_number_01" {{ old('d1', $cuestionario->d1) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_02">MARTES</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d2">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d2"
                                        id="check_number_02" {{ old('d2', $cuestionario->d2) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_03">MIERCOLES</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d3">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d3"
                                        id="check_number_03" {{ old('d3', $cuestionario->d3) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_04">JUEVES</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d4">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d4"
                                        id="check_number_04" {{ old('d4', $cuestionario->d4) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_05">VIERNES</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d5">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d5"
                                        id="check_number_05" {{ old('d5', $cuestionario->d5) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_06">SABADO</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d6">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d6"
                                        id="check_number_06" {{ old('d6', $cuestionario->d6) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_07">DOMINGO</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d7">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d7"
                                        id="check_number_07" {{ old('d7', $cuestionario->d7) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            {{-- <TD>
                                <label for="check_number_08">08</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d8">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d8"
                                        id="check_number_08" {{ old('d8', $cuestionario->d8) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_09">09</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d9">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d9"
                                        id="check_number_09" {{ old('d9', $cuestionario->d9) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_010">10</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d10">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d10"
                                        id="check_number_010" {{ old('d10', $cuestionario->d10) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_011">11</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d11">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d11"
                                        id="check_number_011" {{ old('d11', $cuestionario->d11) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_012">12</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d12">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d12"
                                        id="check_number_012" {{ old('d12', $cuestionario->d12) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_013">13</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d13">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d13"
                                        id="check_number_013" {{ old('d13', $cuestionario->d13) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_014">14</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d14">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d14"
                                        id="check_number_014" {{ old('d14', $cuestionario->d14) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_015">15</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d15">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d15"
                                        id="check_number_015" {{ old('d15', $cuestionario->d15) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_016">16</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d16">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d16"
                                        id="check_number_016" {{ old('d16', $cuestionario->d16) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_017">17</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d17">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d17"
                                        id="check_number_017" {{ old('d17', $cuestionario->d17) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_018">18</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d18">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d18"
                                        id="check_number_018" {{ old('d18', $cuestionario->d18) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_019">19</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d19">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d19"
                                        id="check_number_019" {{ old('d19', $cuestionario->d19) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_020">20</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d20">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d20"
                                        id="check_number_020" {{ old('d20', $cuestionario->d20) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_021">21</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d21">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d21"
                                        id="check_number_021" {{ old('d21', $cuestionario->d21) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_022">22</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d22">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d22"
                                        id="check_number_022" {{ old('d22', $cuestionario->d22) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_023">23</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d23">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d23"
                                        id="check_number_023" {{ old('d23', $cuestionario->d23) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_024">24</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d24">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d24"
                                        id="check_number_024" {{ old('d24', $cuestionario->d24) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_025">25</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d25">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d25"
                                        id="check_number_025" {{ old('d25', $cuestionario->d25) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_026">26</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d26">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d26"
                                        id="check_number_026" {{ old('d26', $cuestionario->d26) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_027">27</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d27">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d27"
                                        id="check_number_027" {{ old('d27', $cuestionario->d27) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_028">28</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d28">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d28"
                                        id="check_number_028" {{ old('d28', $cuestionario->d28) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_029">29</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d29">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d29"
                                        id="check_number_029" {{ old('d29', $cuestionario->d29) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_030">30</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d30">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d30"
                                        id="check_number_030" {{ old('d30', $cuestionario->d30) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_031">31</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="d31">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="d31"
                                        id="check_number_031" {{ old('d31', $cuestionario->d31) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                        </TR> --}}
                    </table>
                </div>


                <div class="text-center form-group col-12"
                    style="background-color:#9da0a6; border-radius: 100px; color: white;">
                    HORAS DEL DÍA
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table-sm table_checkbox">
                        <TR
                            style="color: rgb(0, 0, 0); text-align:center; text-align:center; font-size:15px; height:65px;">
                            <TD>
                                <label for="check_no_01">01</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h1">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h1"
                                        id="check_no_01" {{ old('h1', $cuestionario->h1) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_02">02</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h2">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h2"
                                        id="check_no_02" {{ old('h2', $cuestionario->h2) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_03">03</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h3">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h3"
                                        id="check_no_03" {{ old('h3', $cuestionario->h3) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_04">04</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h4">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h4"
                                        id="check_no_04" {{ old('h4', $cuestionario->h4) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_05">05</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h5">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h5"
                                        id="check_no_05" {{ old('h5', $cuestionario->h5) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_06">06</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h6">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h6"
                                        id="check_no_06" {{ old('h6', $cuestionario->h6) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_07">07</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h7">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h7"
                                        id="check_no_07" {{ old('h7', $cuestionario->h7) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_08">08</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h8">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h8"
                                        id="check_no_08" {{ old('h8', $cuestionario->h8) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_09">09</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h9">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h9"
                                        id="check_no_09" {{ old('h9', $cuestionario->h9) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_10">10</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h10">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h10"
                                        id="check_no_10" {{ old('h10', $cuestionario->h10) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_11">11</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h11">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h11"
                                        id="check_no_11" {{ old('h11', $cuestionario->h11) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_12">12</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h12">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h12"
                                        id="check_no_12" {{ old('h12', $cuestionario->h12) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_13">13</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h13">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h13"
                                        id="check_no_13" {{ old('h13', $cuestionario->h13) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_14">14</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h14">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h14"
                                        id="check_no_14" {{ old('h14', $cuestionario->h14) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_15">15</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h15">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h15"
                                        id="check_no_15" {{ old('h15', $cuestionario->h15) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_16">16</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h16">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h16"
                                        id="check_no_16" {{ old('h16', $cuestionario->h16) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_17">17</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h17">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h17"
                                        id="check_no_17" {{ old('h17', $cuestionario->h17) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_18">18</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h18">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h18"
                                        id="check_no_18" {{ old('h18', $cuestionario->h18) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_19">19</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h19">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h19"
                                        id="check_no_19" {{ old('h19', $cuestionario->h19) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_20">20</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h20">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h20"
                                        id="check_no_20" {{ old('h20', $cuestionario->h20) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_21">21</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h21">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h21"
                                        id="check_no_21" {{ old('h21', $cuestionario->h21) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_22">22</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h22">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h22"
                                        id="check_no_22" {{ old('h22', $cuestionario->h22) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_23">23</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h23">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h23"
                                        id="check_no_23" {{ old('h23', $cuestionario->h23) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_24">24</label>
                                <br>
                                <div class="form-check">
                                    <input type="hidden" value="1" name="h24">
                                    <input class="form-check-input d-none" type="checkbox" value="2" name="h24"
                                        id="check_no_24" {{ old('h24', $cuestionario->h24) == 2 ? 'checked' : '' }}>
                                </div>
                            </TD>
                        </TR>
                    </table>
                </div>


            </div>




            <!-- RESPALDOS DE INFORMACIÓN -->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    TIEMPOS DE RECUPERACIÓN
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#tiempos_recuperacion"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    </a>
                    {!! Form::label(
                        'respaldo_q_20',
                        '19.    Tiempos de Respaldo (RPO), Recuperación (RTO), Trabajo en Contingencia (WRT) y Máximo Tiempo de Interrupción del Proceso (MTPD)',
                        ['class' => 'required'],
                    ) !!}

                </div>
            </div>
            <hr>
            {{-- RPO: --}}
            <div class="row">
                <div class="form-group col-sm-2">
                    <span class="badge badge-secondary mt-4" style="font-size: 21px">RPO:</span>
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rpo_mes', 'Mes(es)') !!}
                    @error('rpo_mes')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rpo_mes', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rpo_semana', 'Semana(s)') !!}
                    @error('rpo_semana')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rpo_semana', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=52',
                        'required',
                        ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rpo_dia', 'Día(s)') !!}
                    @error('rpo_dia')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rpo_dia', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=365',
                        'required',
                        ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rpo_hora', 'Horas(s)') !!}
                    @error('rpo_hora')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rpo_hora', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                        ]) !!}
                </div>

            </div>
            <hr>
            {{-- RTO: --}}
            <div class="row">
                <div class="form-group col-sm-2">
                    <span class="badge badge-secondary mt-4" style="font-size: 21px">RTO:</span>
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rto_mes', 'Mes(es)') !!}
                    @error('rto_mes')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rto_mes', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rto_semana', 'Semana(s)') !!}
                    @error('rto_semana')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rto_semana', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=52',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rto_dia', 'Día(s)') !!}
                    @error('rto_dia')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rto_dia', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=365',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('rto_hora', 'Horas(s)') !!}
                    @error('rto_hora')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('rto_hora', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>
            </div>
            <hr>
            {{-- WRT: --}}
            <div class="row">
                <div class="form-group col-sm-2">
                    <span class="badge badge-secondary mt-4" style="font-size: 21px">WRT:</span>
                </div>

                <div class="form-group col-sm-2">
                    {!! Form::label('wrt_mes', 'Mes(es)') !!}
                    @error('wrt_mes')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('wrt_mes', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('wrt_semana', 'Semana(s)') !!}
                    @error('wrt_semana')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('wrt_semana', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=52',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('wrt_dia', 'Día(s)') !!}
                    @error('wrt_dia')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('wrt_dia', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=365',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('wrt_hora', 'Horas(s)') !!}
                    @error('wrt_hora')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('wrt_hora', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>

            </div>
            <hr>
            {{-- WRT: --}}
            <div class="row">
                <div class="form-group col-sm-2">
                    <span class="badge badge-secondary mt-4" style="font-size: 21px">MTPD:</span>
                </div>

                <div class="form-group col-sm-2">
                    {!! Form::label('mtpd_mes', 'Mes(es)') !!}
                    @error('mtpd_mes')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('mtpd_mes', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('mtpd_semana', 'Semana(s)') !!}
                    @error('mtpd_semana')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('mtpd_semana', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=52',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('mtpd_dia', 'Día(s)') !!}
                    @error('mtpd_dia')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('mtpd_dia', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=365',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('mtpd_hora', 'Horas(s)') !!}
                    @error('mtpd_hora')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::number('mtpd_hora', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                        'min=0',
                        'max=120',
                        'required',
                    ]) !!}
                </div>

            </div>

            <!-- RESPALDOS DE INFORMACIÓN -->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    RESPALDOS DE INFORMACIÓN
                </div>
            </div>
            <div class="row">
                {{-- RESPALDOS DE INFORMACIÓN --}}

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'respaldo_q_20',
                        '20. ¿Cuáles son los archivos o registros vitales para el proceso? (Formatos, Registros, Directorios, Reportes, etc.)',
                        ['class' => 'required'],
                    ) !!}
                    @error('respaldo_q_20')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('respaldo_q_20', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'respaldo_q_21',
                        '21. ¿Tiene un respaldo fuera de su equipo de los archivos necesarios para ejecutar este proceso? (Registros vitales)',
                        ['class' => 'required'],
                    ) !!}
                    @error('respaldo_q_21')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('respaldo_q_21', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('respaldo_q_22', '22. ¿Alguien más tiene acceso a este respaldo?',
                    ['class' => 'required']) !!}
                    @error('respaldo_q_22')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('respaldo_q_22', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'respaldo_q_23',
                        '23. ¿De qué manera tiene resguardados los usuarios y contraseñas que utiliza para el acceso a los sistemas necesarios en este proceso?',
                        ['class' => 'required'],
                    ) !!}
                    @error('respaldo_q_23')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('respaldo_q_23', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
            </div>

            <!-- PROBABILIDAD DE INCIDENTES DISRUPTIVOS -->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    PROBABILIDAD DE INCIDENTES DISRUPTIVOS
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal"
                        data-target="#probabilidad_incidentes_disruptivos" data-whatever="@mdo" data-whatever="@mdo"
                        title="Dar click"><i class="fas fa-info-circle"></i></a>
                    </a>
                    <label class="required">24. Por favor, indique los tipos de incidentes en los que el proceso se ha visto interrumpido y
                        aproximadamente cada cuando ha ocurrido.</label>
                </div>
                <hr>
                {{-- PROBABILIDAD DE INCIDENTES DISRUPTIVOS --}}
                <label class="col-sm-8 col-form-label">Indisponibilidad de las instalaciones
                    (oficinas), por bloqueo de acceso, manifestaciones.</label>
                @error('disruptivos_q_1')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_1" required>
                        <option value disabled {{ old('disruptivos_q_1', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_1', $cuestionario->disruptivos_q_1) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Ataques cibernéticos o a la actividad
                    informática.</label>
                @error('disruptivos_q_2')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_2" required>
                        <option value disabled {{ old('disruptivos_q_2', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_2', $cuestionario->disruptivos_q_2) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Desastres naturales y ambientales.</label>
                @error('disruptivos_q_3')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_3" required>
                        <option value disabled {{ old('disruptivos_q_3', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_3', $cuestionario->disruptivos_q_3) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Enfermedades infecciosas.</label>
                @error('disruptivos_q_4')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_4" required>
                        <option value disabled {{ old('disruptivos_q_4', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_4', $cuestionario->disruptivos_q_4) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Error Humano.</label>
                @error('disruptivos_q_5')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_5" required>
                        <option value disabled {{ old('disruptivos_q_5', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_5', $cuestionario->disruptivos_q_5) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Fallas o indisponibilidad en la infraestructura
                    tecnológica (telecomunicaciones, procesamiento de información y redes).</label>
                @error('disruptivos_q_6')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_6" required>
                        <option value disabled {{ old('disruptivos_q_6', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_6', $cuestionario->disruptivos_q_6) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Indisponibilidad de recursos humanos,
                    materiales o técnicos.</label>
                @error('disruptivos_q_7')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_7" required>
                        <option value disabled {{ old('disruptivos_q_7', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_7', $cuestionario->disruptivos_q_7) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Interrupciones en el suministro de
                    energía.</label>
                @error('disruptivos_q_8')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_8" required>
                        <option value disabled {{ old('disruptivos_q_8', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_8', $cuestionario->disruptivos_q_8) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Interrupciones ocurridas en servicios prestados
                    por terceros.</label>
                @error('disruptivos_q_9')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_9" required>
                        <option value disabled {{ old('disruptivos_q_9', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_9', $cuestionario->disruptivos_q_9) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Sabotaje.</label>
                @error('disruptivos_q_10')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_10" required>
                        <option value disabled {{ old('disruptivos_q_10', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_10', $cuestionario->disruptivos_q_10) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>

                <label class="col-sm-8 col-form-label">Terrorismo.</label>
                @error('disruptivos_q_11')
                    <small style="color: red">{{$message}}</small>
                @enderror
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_11" required>
                        <option value disabled {{ old('disruptivos_q_11', null) === null ? 'selected' : '' }}>
                            Selecciona una opción</option>
                        @foreach (App\Models\AnalisisImpacto::DisruptivoSelect as $key => $label)
                            <option value="{{ $key }}"
                                {{ old('disruptivos_q_11', $cuestionario->disruptivos_q_11) === (int) $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <hr>
            </div>

            <!-- PROBABILIDAD DE INCIDENTES DISRUPTIVOS -->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    RIESGOS E INCIDENTES DISRUPTIVOS
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-12">
                    <label class="required">25. Por favor, indique el nivel de impacto en los que el proceso se ha visto involucrado.</label>
                </div>

                <label class="col-sm-6 col-form-label offset-6"><strong>NIVELES</strong></label>
                <label class="col-sm-6 col-form-label"><strong>IMPACTOS</strong></label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        placeholder="< 4 hrs" disabled>
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        placeholder="4-24 hrs" disabled>
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        placeholder="> 24 hrs" disabled>
                </div>
                <hr>


                <label class="col-sm-6 col-form-label">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#afectacion_operacional"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    Afectación operacional (IO) </label>
                @error('operacion_q_1')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('operacion_q_2')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('operacion_q_3')
                    <small style="color: red">{{$message}}</small>
                @enderror

                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="operacion_q_1" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->operacion_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="operacion_q_2" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->operacion_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="operacion_q_3" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->operacion_q_3) }}">
                </div>
                <hr>

                <label class="col-sm-6 col-form-label">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#impacto_regulatorio"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    Impacto Regulatorio (IR)</label>
                @error('regulatorio_q_1')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('regulatorio_q_2')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('regulatorio_q_3')
                    <small style="color: red">{{$message}}</small>
                @enderror

                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="regulatorio_q_1" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->regulatorio_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="regulatorio_q_2" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->regulatorio_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="regulatorio_q_3" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->regulatorio_q_3) }}">
                </div>
                <hr>

                <label class="col-sm-6 col-form-label">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#afectacion_reputacion"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    Afectación en la Reputación / Imagen Pública o Política
                    (IIR)</label>
                @error('reputacion_q_1')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('reputacion_q_2')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('reputacion_q_3')
                    <small style="color: red">{{$message}}</small>
                @enderror

                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="reputacion_q_1" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->reputacion_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="reputacion_q_2" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->reputacion_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="reputacion_q_3" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->reputacion_q_3) }}">
                </div>
                <hr>

                <label class="col-sm-6 col-form-label">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#impacto_social"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    Impacto Social (IS)</label>
                @error('social_q_1')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('social_q_2')
                    <small style="color: red">{{$message}}</small>
                @enderror
                @error('social_q_3')
                    <small style="color: red">{{$message}}</small>
                @enderror

                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="social_q_1" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->social_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="social_q_2" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->social_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="social_q_3" min="1" max="5" placeholder="..." required
                        value="{{ old('meta', $cuestionario->social_q_3) }}">
                </div>
                <hr>

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'incidentes_q_26',
                        '26. En caso de que el proceso se interrumpiera, indique cuáles serían las acciones que tomaría.',
                        ['class' => 'required'],
                    ) !!}
                    @error('incidentes_q_26')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('incidentes_q_26', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'incidentes_q_27',
                        '27. ¿Se han realizado ejercicios o pruebas relacionadas a un Plan de Continuidad de las Operaciones (BCP)?',
                        ['class' => 'required'],
                    ) !!}
                    @error('incidentes_q_27')
                        <small style="color: red">{{$message}}</small>
                    @enderror
                    {!! Form::text('incidentes_q_27', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
//                        'maxlength' => 255,
                        'placeholder' => '...',
                        'required',
                    ]) !!}
                </div>
            </div>

            {{-- Firmas --}}
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    FIRMAS
                </div>
            </div>

            <div class="row">
                @if ($cuestionario->firma_Entrevistado)
                    <div class="form-group col-sm-6">
                        <label>Entrevistado</label><br>
                        <img src="{{ asset('storage/' . $cuestionario->firma_Entrevistado) }}">
                    </div>
                @else
                    @livewire('firma-bia', ['cuestionario_id' => $cuestionario->id, 'firmante' => 'Entrevistado'], key(1))
                @endif

                @if ($cuestionario->firma_Jefe)
                    <div class="form-group col-sm-6">
                        <label>Jefe</label><br>
                        <img src="{{ asset('storage/' . $cuestionario->firma_Jefe) }}">
                    </div>
                @else
                    @livewire('firma-bia', ['cuestionario_id' => $cuestionario->id, 'firmante' => 'Jefe'], key(2))
                @endif


            </div>
            <div class="row offset-3">
                @if ($cuestionario->firma_Entrevistador)
                    <div class="form-group col-sm-6">
                        <label>Entrevistador</label><br>
                        <img src="{{ asset('storage/' . $cuestionario->firma_Entrevistador) }}">
                    </div>
                @else
                    @livewire('firma-bia', ['cuestionario_id' => $cuestionario->id, 'firmante' => 'Entrevistador'], key(3))
                @endif

            </div>

            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    Anexos
                </div>
            </div>
            <div class="row">
                <h4><span class="badge badge-secondary">Anexo 1</span></h4>

                <table class="table table-border" style="font-size: 12px">
                    <tr>
                        <th class="col-sm-4" style="background-color:#345183; color: white;">Clasificación</th>
                        <th class="col-sm-8" style="background-color:#345183; color: white;">Escenarios de Contingencia
                        </th>
                    </tr>
                    <tr>
                        <th rowspan="2" style="background-color:#ffffff;">Indisponibilidad de las instalaciones
                            (oficinas), por bloqueo de acceso, manifestaciones.</th>
                        <td>Manifestaciones.</td>
                    </tr>
                    <tr>
                        <td>Bloqueos.</td>
                    </tr>
                    <tr>
                        <th rowspan="4" style="background-color:#ffffff;">Ataques cibernéticos o a la actividad
                            informática</th>
                        <td>Acceso y/o modificaciones no autorizadas a sistemas e información.</td>
                    </tr>
                    <tr>
                        <td>Ataque de denegación de servicios (DoS Attack).</td>
                    </tr>
                    <tr>
                        <td>Hackeo y/o secuestro de información (ransomware).</td>
                    </tr>
                    <tr>
                        <td>Ataque de denegación de servicios (DoS Attack).</td>
                    </tr>
                    <tr>
                        <th rowspan="7" style="background-color:#ffffff;">Desastres naturales y ambientales.</th>
                        <td>Contaminación ambiental.</td>
                    </tr>
                    <tr>
                        <td>Contaminación por agentes químicos.</td>
                    </tr>
                    <tr>
                        <td>Erupción volcánica.</td>
                    </tr>
                    <tr>
                        <td>Incendio / Explosión.</td>
                    </tr>
                    <tr>
                        <td>Inundación.</td>
                    </tr>
                    <tr>
                        <td>Rayos/Tormentas Eléctricas.</td>
                    </tr>
                    <tr>
                        <td>Sismo / Terremoto.</td>
                    </tr>
                    <tr>
                        <th>Enfermedades infecciosas.</th>
                        <td>Indisponibilidad del personal (pandemias, enfermedades virales o infecciosas).</td>
                    </tr>
                    <tr>
                        <th rowspan="2" style="background-color:#ffffff;">Desastres naturales y ambientales.</th>
                        <td>Ejecución inadecuada de los procesos.</td>
                    </tr>
                    <tr>
                        <td>Incumplimiento de obligaciones normativas.</td>
                    </tr>
                    <tr>
                        <th rowspan="3" style="background-color:#ffffff;">Fallas o indisponibilidad en la
                            infraestructura tecnológica (telecomunicaciones, procesamiento de información y redes).</th>
                        <td>Deterioro en aplicaciones (fallas/caídas).</td>
                    </tr>
                    <tr>
                        <td>Falla en enlaces y comunicaciones.</td>
                    </tr>
                    <tr>
                        <td>Fallas en la infraestructura tecnológica (equipos, servidores, etc.).</td>
                    </tr>
                    <tr>
                        <th rowspan="3" style="background-color:#ffffff;">Indisponibilidad del personal (Accidentes,
                            enfermedad, jubilación o fallecimiento del personal).</th>
                        <td>IIndisponibilidad del personal (Accidentes, enfermedad, jubilación o fallecimiento del
                            personal).</td>
                    </tr>
                    <tr>
                        <td>Indisponibilidad del personal (Falta de personal, inasistencia o baja de personal).</td>
                    </tr>
                    <tr>
                        <td>Daño en equipos (aire acondicionado).</td>
                    </tr>
                    <tr>
                        <th style="background-color:#ffffff;">Interrupciones en el suministro de energía eléctrica.</th>
                        <td>Interrupciones en el suministro de energía eléctrica.</td>
                    </tr>
                    <tr>
                        <th style="background-color:#ffffff;">Interrupciones ocurridas en servicios prestados por
                            terceros.
                        </th>
                        <td>Indisponibilidad de información o insumos de terceros o proveedores externos.</td>
                    </tr>
                    <tr>
                        <th rowspan="5" style="background-color:#ffffff;">Sabotaje.</th>
                        <td>Atentados y actos vandálicos a las instalaciones y/o al personal (motín / huelga/ sabotaje /
                            toma de instalaciones).</td>
                    </tr>
                    <tr>
                        <td>Filtración de información (robo, espionaje industrial, fraude interno/externo).</td>
                    </tr>
                    <tr>
                        <td>Negación de acceso a instalaciones por marchas, manifestaciones y bloqueos.</td>
                    </tr>
                    <tr>
                        <td>Robo o daño de activos e información física.</td>
                    </tr>
                    <tr>
                        <td>Violación de acceso físico a las instalaciones y áreas restringidas.</td>
                    </tr>
                    <tr>
                        <th>Terrorismo.</th>
                        <td>Atentados y actos vandálicos a las instalaciones y/o al personal (robo y actividades
                            criminales).</td>
                    </tr>
                </table>
            </div>


            {{-- Modales --}}

            {{-- PROBABILIDAD DE INCIDENTES DISRUPTIVOS --}}
            <div class="modal fade" id="probabilidad_incidentes_disruptivos" tabindex="-1"
                aria-labelledby="probabilidad_incidentes_disruptivos" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Detalle de la probabilidad
                                de
                                los incidentes disruptivos </h5>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Nivel de Probabilidad</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Descripción</span>
                                </div>
                            </div>
                            <div class="row" style="height:60px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:#FF0000;">
                                    <strong style="color:#fff" class="text-center">5-Casi Cierto</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Cuenta con antecedentes de ocurrencia frecuentes; es
                                        más
                                        probable que se presente a que no. Existen muchos factores y condiciones que
                                        propician su ocurrencia. <strong>(Cada semana).</strong> </span>
                                </div>
                            </div>
                            <div class="row" style="height:60px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: #FFC000;">
                                    <strong style="color:#fff" class="text-center">4-Muy probable</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Cuenta con antecedentes de ocurrencia; es más probable
                                        que se presente a que no. Existen factores y condiciones que propician su
                                        ocurrencia. <strong>(Cada mes).</strong></span>
                                </div>
                            </div>
                            <div class="row" style="height:60px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color: yellow">
                                    <strong style="color:black class="text-center">3-Probable</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">Cuenta con antecedentes, pero su ocurrencia ha sido
                                        ocasional; Es igual de probable se presente. Las condiciones son medianamente
                                        favorables para permitir su ocurrencia.<strong>(cada 3 meses).</strong></span>
                                </div>
                            </div>
                            <div class="row" style="height:70px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:#00B050;">
                                    <strong style="color:#fff" class="text-center">2-Poco Probable</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">No se tienen antecedentes de ocurrencia recientes o
                                        Cuenta con antecedentes, pero su ocurrencia ha sido ocasional; Es igual de probable
                                        se presente o no se presente. Las condiciones son mínimamente favorables para
                                        permitir su ocurrencia.<strong>(cada 6 meses).</strong> </span>
                                </div>
                            </div>
                            <div class="row" style="height:70px; border-bottom: 1px solid #ccc;">
                                <div class="col-4" style="background-color:#92D050;">
                                    <strong style="color:#fff" class="text-center">1-Remoto</strong>
                                </div>
                                <div class="col-8">
                                    <span style="justify-content;">No se tienen antecedentes de ocurrencia. Es probable
                                        que
                                        no se presente (no se cuenta con elementos para determinar si es más probable que
                                        suceda o que no suceda). Las condiciones son mínimamente favorables para permitir su
                                        ocurrencia.<strong>(cada año).</strong></span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- TIEMPOS DE RECUPERACIÓN --}}
            <div class="modal fade" id="tiempos_recuperacion" tabindex="tiempos_recuperacion"
                aria-labelledby="tiempos_recuperacion" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Definiciones:</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-2" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Concepto</strong>
                                </div>
                                <div class="col-10" style="background-color:rgb(238, 238, 238);">
                                    <span style="justify-content;">Descripción</span>
                                </div>
                            </div>
                            <div class="row" style="height:60px; border-bottom: 1px solid #ccc;">
                                <div class="col-2" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">RPO:</strong>
                                </div>
                                <div class="col-10">
                                    <span style="justify-content;"><u>Punto Objetivo de Recuperación</u> <i>(Recovery
                                            Point
                                            Objective)</i>, es la cantidad de información expresada en tiempo que podría
                                        perderse en caso de una interrupción del proceso sin que esta pérdida genere un
                                        impacto significativo.</span>
                                </div>
                            </div>
                            <div class="row" style="height:60px; border-bottom: 1px solid #ccc;">
                                <div class="col-2" style="background-color: #c9c7c2;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">RTO:</strong>
                                </div>
                                <div class="col-10">
                                    <span style="justify-content;"><u>Tiempo Objetivo de Recuperación</u> <i>(Recovery
                                            Time
                                            Objective)</i>, es el tiempo en el que los procesos deben ser recuperados antes
                                        de generar un impacto relevante a la institución.</span>
                                </div>
                            </div>
                            <div class="row" style="height:75px; border-bottom: 1px solid #ccc;">
                                <div class="col-2" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">WRT:</strong>
                                </div>
                                <div class="col-10">
                                    <span style="justify-content;"><u>Tiempo de Trabajo en Recuperación </u> <i>(Work
                                            Recovery Time)</i>, es la cantidad de tiempo en el que los procesos son
                                        ejecutados durante la recuperación con los recursos mínimos necesarios y determina
                                        la cantidad máxima de tiempo requerido para verificar la integridad de los sistemas
                                        y de los datos.</span>
                                </div>
                            </div>
                            <div class="row" style="height:75px; border-bottom: 1px solid #ccc;">
                                <div class="col-2" style="background-color: #c9c7c2;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">MTPD:</strong>
                                </div>
                                <div class="col-10">
                                    <span style="justify-content;"><u>Máximo Tiempo de Interrupción Tolerable </u>
                                        <i>(Maximun Tolerable Period of Disruption)</i>, es la suma de RTO y WRT; y se
                                        define como el periodo de tiempo de inactividad máximo tolerable en total que puede
                                        interrumpirse un proceso sin causar consecuencias inaceptables.</span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIESGOS E INCIDENTES DISRUPTIVOS - Afectación operacional (IO) --}}
            <div class="modal fade" id="afectacion_operacional" tabindex="afectacion_operacional"
                aria-labelledby="afectacion_operacional" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="afectacion_operacional" id="exampleModalLabel">Afectación
                                operacional (IO)</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="height:35px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Valor</strong>
                                </div>
                                <div class="col-9" style="background-color:rgb(238, 238, 238);">
                                    <span style="justify-content;">Descripción</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">5-MUY ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Suspende la operación o genera reprocesos mayores a 2
                                        días.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">4-ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Suspende la operación o genera reprocesos mayores a 1
                                        día y hasta 2 días.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">3-MEDIO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Suspende la operación o genera reprocesos mayores a 4
                                        horas y hasta 1 día.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">2-BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Suspende la operación o genera reprocesos mayores a 1
                                        hora y hasta 4 horas.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">1-MUY BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Suspende la operación o genera reprocesos hasta 1
                                        hora.</span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIESGOS E INCIDENTES DISRUPTIVOS - Impacto Regulatorio (IR) --}}
            <div class="modal fade" id="impacto_regulatorio" tabindex="impacto_regulatorio" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="impacto_regulatorio" id="exampleModalLabel">Impacto
                                Regulatorio
                                (IR)</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Valor</strong>
                                </div>
                                <div class="col-9" style="background-color:rgb(238, 238, 238);">
                                    <span style="justify-content;">Descripción</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">5-MUY ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Podrían generarse penalizaciones, y/o investigación
                                        contra la institución por faltas a normatividad Nacional o Constitucional.</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">4-ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Podrían generarse penalizaciones y/o investigación
                                        contra la institución por faltas a los organismos reguladores (ASF y Secretaria de
                                        la Función Pública).</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">3-MEDIO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Podrían generarse penalizaciones por faltas a las
                                        políticas manuales y/o reglamentos organizacionales.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">2-BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Faltas a los procedimientos operativos internos.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">1-MUY BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Sin afectación o incumplimientos regulatorios.</span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIESGOS E INCIDENTES DISRUPTIVOS - Afectación en la Reputación / Imagen Pública o Política (IIR) --}}
            <div class="modal fade" id="afectacion_reputacion" tabindex="afectacion_reputacion" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="afectacion_reputacion">Afectación en la Reputación / Imagen
                                Pública o Política (IIR)</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Valor</strong>
                                </div>
                                <div class="col-9" style="background-color:rgb(238, 238, 238);">
                                    <span style="justify-content;">Descripción</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">5-MUY ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Cobertura mediática a escala nacional y limitada a
                                        nivel internacional, investigación formal de organismos reguladores, implicación de
                                        directivos del SENASICA.</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">4-ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Cobertura mediática a escala nacional, incremento en
                                        reclamaciones de la ciudadanía, solicitud de organismos reguladores.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">3-MEDIO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Cobertura mediática local, incremento en reclamaciones
                                        de la ciudadanía.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">2-BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Sin cobertura mediática, ligero incremento en
                                        reclamaciones de la ciudadanía.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">1-MUY BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Sin efecto externo.</span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIESGOS E INCIDENTES DISRUPTIVOS - Impacto Social (IS) --}}
            <div class="modal fade" id="impacto_social" tabindex="impacto_social" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="afectacion_reputacion">Impacto Social (IS)</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row" style="height:40px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:rgb(238, 238, 238);">
                                    <strong class="text-center">Valor</strong>
                                </div>
                                <div class="col-9" style="background-color:rgb(238, 238, 238);">
                                    <span style="justify-content;">Descripción</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">5-MUY ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Presenta afectación en los servicios brindados a la
                                        ciudadanía a toda la República Mexicana o incluso a niveles Internacionales.</span>
                                </div>
                            </div>
                            <div class="row" style="height:50px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">4-ALTO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Presenta afectación en los servicios brindados a la
                                        ciudadanía a más de un estado de la República Mexicana.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">3-MEDIO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Presenta afectación en los servicios brindados a la
                                        ciudadanía de manera estatal.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">2-BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Presenta afectación en los servicios brindados a la
                                        ciudadanía de manera local.</span>
                                </div>
                            </div>
                            <div class="row" style="height:30px; border-bottom: 1px solid #ccc;">
                                <div class="col-3" style="background-color:#ffffff;">
                                    <strong style="color:rgb(0, 0, 0)" class="text-center">1-MUY BAJO:</strong>
                                </div>
                                <div class="col-9">
                                    <span style="justify-content;">Sin afectación a la población.</span>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Submit Field -->
            <div class="row">
                <div class="text-right form-group col-12">
                    <a href="{{ route('admin.analisis-impacto.index') }}" class="btn_cancelar">Cancelar</a>
                    <button type="submit" class="btn btn-danger">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </div>





            {!! Form::close() !!}
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).ready(function() {

            document.querySelectorAll('.table_checkbox input[type=checkbox]').forEach(element => {
                if (element.checked == true) {
                    $(element).parents('th').css('background-color', 'yellow');
                    $(element).parents('td').css('background-color', 'yellow');

                } else {
                    $(element).parents('th').css('background-color', 'white');
                    $(element).parents('td').css('background-color', 'white');

                }

            });
        });
        $('.table_checkbox input[type=checkbox]').click(function(e) {
            if (e.target.checked == true) {
                $('.table_checkbox th input[type=checkbox]:hover').parents('th').css('background-color', 'yellow');
                $('.table_checkbox td input[type=checkbox]:hover').parents('td').css('background-color', 'yellow');

            } else {
                $('.table_checkbox th input[type=checkbox]:hover').parents('th').css('background-color', 'white');
                $('.table_checkbox td input[type=checkbox]:hover').parents('td').css('background-color', 'white');

            }
        });

        document.querySelector(".extencion").addEventListener("keypress", function(evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
            }
        });

        document.querySelector(".extencion1").addEventListener("keypress", function(evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
            }
        });

        document.querySelector(".extencion2").addEventListener("keypress", function(evt) {
            if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
            }
        });
    </script>
@endsection

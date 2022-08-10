@extends('layouts.admin')

<style>
    hr {
        width: 100%;
        margin: 0% !important;
        margin-bottom: 10px !important;
    }
</style>
@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.analisis-impacto.index') !!}">Cuestionario de Análisis de Impacto</a>
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
                        <span class="input-group-text"><strong>Titular</strong></span>
                    </div>
                    <input type="text" name="titular_nombre" aria-label="First name" class="form-control"
                        placeholder="Nombre(s)" value="{{ old('titular_nombre', $cuestionario->titular_nombre) }}">
                    <input type="text" name="titular_a_paterno" aria-label="Last name" class="form-control"
                        placeholder="A. Paterno" value="{{ old('titular_a_paterno', $cuestionario->titular_a_paterno) }}">
                    <input type="text" name="titular_a_materno" aria-label="Last name" class="form-control"
                        placeholder="A. Materno"
                        value="{{ old('titular_a_materno', $cuestionario->titular_a_materno) }}"><br>
                </div>
                <div class="form-group col-sm-12 mt-3">
                    {!! Form::label('titular_puesto', 'Puesto', ['class' => 'required']) !!}
                    {!! Form::text('titular_puesto', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('titular_correo', 'Correo electrónico:', ['class' => 'required']) !!}
                    {!! Form::text('titular_correo', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('titular_extencion', 'Extensión') !!}
                    {!! Form::text('titular_extencion', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <hr>
                <div class="input-group col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Suplente</strong></span>
                    </div>
                    <input type="text" name="suplente_nombre" aria-label="First name" class="form-control"
                        placeholder="Nombre(s)" value="{{ old('suplente_nombre', $cuestionario->suplente_nombre) }}">
                    <input type="text" name="suplente_a_paterno" aria-label="Last name" class="form-control"
                        placeholder="A. Paterno" value="{{ old('suplente_a_paterno', $cuestionario->suplente_a_paterno) }}">
                    <input type="text" name="suplente_a_materno" aria-label="Last name" class="form-control"
                        placeholder="A. Materno"
                        value="{{ old('suplente_a_materno', $cuestionario->suplente_a_materno) }}"><br>
                </div>
                <div class="form-group col-sm-12 mt-3">
                    {!! Form::label('suplente_puesto', 'Puesto', ['class' => 'required']) !!}
                    {!! Form::text('suplente_puesto', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('suplente_correo', 'Correo electrónico:', ['class' => 'required']) !!}
                    {!! Form::text('suplente_correo', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('suplente_extencion', 'Extensión') !!}
                    {!! Form::text('suplente_extencion', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="input-group col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><strong>Supervisor</strong></span>
                    </div>
                    <input type="text" name="supervisor_nombre" aria-label="First name" class="form-control"
                        placeholder="Nombre(s)" value="{{ old('supervisor_nombre', $cuestionario->supervisor_nombre) }}">
                    <input type="text" name="supervisor_a_paterno" aria-label="Last name" class="form-control"
                        placeholder="A. Paterno"
                        value="{{ old('supervisor_a_paterno', $cuestionario->supervisor_a_paterno) }}">
                    <input type="text" name="supervisor_a_materno" aria-label="Last name" class="form-control"
                        placeholder="A. Materno"
                        value="{{ old('supervisor_a_materno', $cuestionario->supervisor_a_materno) }}"><br>
                </div>
                <div class="form-group col-sm-12 mt-3">
                    {!! Form::label('supervisor_puesto', 'Puesto', ['class' => 'required']) !!}
                    {!! Form::text('supervisor_puesto', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('supervisor_correo', 'Correo electrónico:', ['class' => 'required']) !!}
                    {!! Form::text('supervisor_correo', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-6">
                    {!! Form::label('supervisor_extencion', 'Extensión') !!}
                    {!! Form::text('supervisor_extencion', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
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
                    {!! Form::text('flujo_q_1', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_2',
                        '2. ¿De dónde proviene la información? (Nombre de la Empresa / Nombre del Área / Nombre del Proceso / Nombre del Sistema)',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('flujo_q_2', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                {{-- livewire 3.¿Quién le proporciona esta información? --}}
                @livewire('propociona-informacion', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_4',
                        '4.	¿De qué manera recibe usted la información? (Entrega Física / Correo Electrónico / Consulta en Aplicativo o Base de Datos / Consulta en Portal Web)',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('flujo_q_4', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
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
                        '6.	¿Qué información obtiene al finalizar el proceso? (Documentos, Correo electrónico, Oficios, Reportes, etc.)',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('flujo_q_6', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('flujo_q_7', '7.	¿Este es un proceso final o genera información para iniciar otro proceso?', [
                        'class' => 'required',
                    ]) !!}
                    {!! Form::text('flujo_q_7', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_8',
                        '8.	¿A dónde envía la información generada en el proceso? (Nombre de la Empresa / Nombre del Área / Nombre del Proceso / Nombre del Sistema)',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('flujo_q_8', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>

                {{-- livewire 9.¿Quién le recibe esta información? --}}
                @livewire('recibe-informacion', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'flujo_q_10',
                        '10.	¿Cómo valida que el proceso se realizó correctamente? (Carta o firma de aceptación, Acuse de Recibido, Notificación, etc..)',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('flujo_q_10', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12"><label for="tipo_conteo" class="required">11. ¿Cuánto tiempo requiere
                        para realizar el
                        proceso de inicio a fin?</label> </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_años', 'Año(s)') !!}
                    {!! Form::number('flujo_años', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                    ]) !!}
                </div>

                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_meses', 'Mes(es)') !!}
                    {!! Form::number('flujo_meses', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_semanas', 'Semana(s)') !!}
                    {!! Form::number('flujo_semanas', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_dias', 'Día(s)') !!}
                    {!! Form::number('flujo_dias', null, [
                        'class' => 'form-control',
                        'placeholder' => '...',
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
                    INFRAESTRUCTURA TECNOLÓGICA (inciso b Anexo 67)
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
                    RECURSOS HUMANOS (inciso b Anexo67)
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
                    RECURSOS MATERIALES (inciso b Anexo67)
                </div>
            </div>
            <div class="row">
                {{-- RECURSOS MATERIALES (inciso b Anexo67) --}}
                @livewire('recursos-materiales', ['cuestionario_id' => $cuestionario->id])
                {{-- Termina livewire --}}
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
                    {!! Form::text('respaldo_q_20', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'respaldo_q_21',
                        '21. ¿Tiene un respaldo fuera de su equipo de los archivos necesarios para ejecutar este proceso? (Registros vitales)',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('respaldo_q_21', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label('respaldo_q_22', '22. ¿Alguien más tiene acceso a este respaldo?', ['class' => 'required']) !!}
                    {!! Form::text('respaldo_q_22', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'respaldo_q_23',
                        '23. ¿De qué manera tiene resguardados los usuarios y contraseñas que utiliza para el acceso a los sistemas necesarios en este proceso?',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('respaldo_q_23', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
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
                    <label>24. Por favor, indique los tipos de incidentes en los que el proceso se ha visto interrumpido y
                        aproximadamente cada cuando ha ocurrido.</label>

                </div>
                <hr>
                {{-- PROBABILIDAD DE INCIDENTES DISRUPTIVOS --}}
                <label class="col-sm-8 col-form-label">Indisponibilidad de las instalaciones
                    (oficinas), por bloqueo de acceso, manifestaciones.</label>
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_1">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_2">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_3">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_4">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_5">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_6">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_7">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_8">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_9">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_10">
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
                <div class="form-group col-sm-4">
                    <select class="form-control form-control-sm" name="disruptivos_q_11">
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
                    <label>25. Por favor, indique el nivel de impacto en los que el proceso se ha visto involucrado.</label>

                </div>

                <label class="col-sm-6 col-form-label offset-6"><strong>NIVELES</strong></label>
                <label class="col-sm-6 col-form-label"><strong>IMPACTOS</strong></label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"  placeholder="< 4 hrs" disabled >
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"  placeholder="4-24 hrs" disabled>
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"  placeholder="> 24 hrs" disabled>
                </div><hr>
                

                <label class="col-sm-6 col-form-label">Afectación operacional (IO)</label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="operacion_q_1" placeholder="..." value="{{ old('meta', $cuestionario->operacion_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="operacion_q_2" placeholder="..." value="{{ old('meta', $cuestionario->operacion_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="operacion_q_3" placeholder="..." value="{{ old('meta', $cuestionario->operacion_q_2) }}">
                </div><hr>

                <label class="col-sm-6 col-form-label">Impacto Regulatorio (IR)</label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="regulatorio_q_1" placeholder="..." value="{{ old('meta', $cuestionario->regulatorio_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="regulatorio_q_2" placeholder="..." value="{{ old('meta', $cuestionario->regulatorio_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="regulatorio_q_3" placeholder="..." value="{{ old('meta', $cuestionario->regulatorio_q_3) }}">
                </div><hr>

                <label class="col-sm-6 col-form-label">Afectación en la Reputación / Imagen Pública o Política (IIR)</label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="reputacion_q_1" placeholder="..." value="{{ old('meta', $cuestionario->reputacion_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="reputacion_q_2" placeholder="..." value="{{ old('meta', $cuestionario->reputacion_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="reputacion_q_3"  placeholder="..." value="{{ old('meta', $cuestionario->reputacion_q_3) }}">
                </div><hr>

                <label class="col-sm-6 col-form-label">Impacto Social (IS)</label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="social_q_1" placeholder="..." value="{{ old('meta', $cuestionario->social_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="social_q_2" pplaceholder="..." value="{{ old('meta', $cuestionario->social_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm" name="social_q_3" pplaceholder="..." value="{{ old('meta', $cuestionario->social_q_3) }}">
                </div><hr>

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'incidentes_q_26',
                        '26. En caso de que el proceso se interrumpiera, indique cuáles serían las acciones que tomaría.',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('incidentes_q_26', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
                </div>

                <div class="form-group col-sm-12">
                    {!! Form::label(
                        'incidentes_q_27',
                        '27. ¿Se han realizado ejercicios o pruebas relacionadas a un Plan de Continuidad de las Operaciones (BCP)?',
                        ['class' => 'required'],
                    ) !!}
                    {!! Form::text('incidentes_q_27', null, [
                        'class' => 'form-control',
                        'maxlength' => 255,
                        'maxlength' => 255,
                        'placeholder' => '...',
                    ]) !!}
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


            {!! Form::close() !!}
        </div>
    </div>
@endsection

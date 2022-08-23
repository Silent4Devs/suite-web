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

    input[type=checkbox]:checked+.label_cuadro::after{
        content: 'PRIMER SEMESTRE';
        background-color: #f4ff00;
        font-size: 15px;
        width:100%;
        height: 100%;
        position: absolute;
        top:0;
        left:0;
        z-index:1;
        padding-top:3px; 
    }

    input[type=checkbox]:checked+.label_cuadro_dos::after{
        content: 'SEGUNDO SEMESTRE';
        background-color: #f4ff00;
        font-size: 15px;
        width:100%;
        height: 100%;
        position: absolute;
        top:0;
        left:0;
        z-index:1;
        padding-top:3px;
    }
    #color-relleno .card{
        background-color: rgba(0,0,0,0) !important;
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

            <!--RECURSOS MATERIALES (inciso b Anexo67)-->
            <div class="row">
                <div class="text-center form-group col-12 mt-4"
                    style="background-color:#345183; border-radius: 100px; color: white;">
                    RECURSOS MATERIALES (inciso b Anexo67)
                </div>
            </div>
            <div class="row">
                <div class="text-center form-group col-12">
                    <table class="table">
                        <TR style="color: rgb(0, 0, 0); text-align:center; height:65px; font-size:15px;" id="color-relleno">
                            <TH>
                                <div class="form-check">
                                    <input class="form-check-input check_calendario" type="checkbox"
                                        id="primer_semestre" >
                                    <label for="primer_semestre" class="label_cuadro" >PRIMER SEMESTRE</label>
                                </div>
                            </TH>
                            <TH>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="segundo_semestre">
                                    <label for="segundo_semestre" class="label_cuadro_dos">SEGUNDO SEMESTRE</label>
                                </div>
                            </TH>
                        </TR>
                    </table>
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table_checkbox">
                        <TR class="mt-5"
                            style="color: rgb(0, 0, 0); text-align:center; height:65px;">
                            <TH style="position: relative;">
                                <label for="eneCheckbox">ENE</label><br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="eneCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="febCheckbox">FEB</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="febCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="marCheckbox">MAR</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="marCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="abrCheckbox">ABR</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="abrCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="mayCheckbox">MAY</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="mayCheckbox">
                                </div>
                            </TH>
                            <TH>
                               <label for="junCheckbox">JUN</label> 
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="junCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="julCheckbox">JUL</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="julCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="agoCheckbox">AGO</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="agoCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="sepCheckbox">SEP</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="sepCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="octCheckbox">OCT</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="octCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="novCheckbox">NOV</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="novCheckbox">
                                </div>
                            </TH>
                            <TH>
                                <label for="dicCheckbox">DIC</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="dicCheckbox">
                                </div>
                            </TH>
                        </TR>
                    </table>
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table_checkbox">
                        <TR style="color: rgb(0, 0, 0); text-align:center; height:65px;">
                            <TD>
                                <label for="s1Checkbox">S1</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="s1Checkbox">
                                </div>
                            </TD>
                            <TD>
                                <label for="s2Checkbox">
                                    S2
                                </label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="s2Checkbox">
                                </div>
                            </TD>
                            <TD>
                                <label for="s3Checkbox">S3</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="s3Checkbox">
                                </div>
                            </TD>
                            <TD>
                                <label for="s4Checkbox">S4</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="s4Checkbox">
                                </div>
                            </TD>
                        </TR>
                    </table>
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table-sm table_checkbox">
                        <TR
                            style="color: rgb(0, 0, 0); text-align:center; font-size:10px; height:65px;">
                            <TD>
                                <label for="check_number_01">01</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_01">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_02">02</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_02">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_03">03</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_03">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_04">04</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_04">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_05">05</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_05">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_06">06</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_06">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_07">07</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_07">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_08">08</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_08">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_09">09</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_09">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_010">10</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_010">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_011">11</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_011">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_012">12</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_012">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_013">13</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_013">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_014">14</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_014">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_015">15</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_015">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_016">16</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_016">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_017">17</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_017">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_018">18</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_018">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_019">19</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_019">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_020">20</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_020">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_021">21</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_021">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_022">22</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_022">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_023">23</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_023">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_024">24</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_024">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_025">25</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_025">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_026">26</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_026">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_027">27</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_027">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_028">28</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_028">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_029">29</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_029">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_030">30</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_030">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_number_031">31</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_number_031">
                                </div>
                            </TD>
                        </TR>
                    </table>
                </div>

                <div class="text-center form-group col-12">
                    <table class="table table-sm table_checkbox">
                        <TR
                            style="color: rgb(0, 0, 0); text-align:center; text-align:center; font-size:15px; height:65px;">
                            <TD>
                                <label for="check_no_01">01</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_01">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_02">02</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_02">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_03">03</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_03">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_04">04</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_04">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_05">05</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_05">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_06">06</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_06">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_07">07</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_07">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_08">08</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_08">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_09">09</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_09">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_10">10</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_10">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_11">11</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_11">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_12">12</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_12">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_13">13</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_13">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_14">14</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_14">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_15">15</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_15">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_16">16</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_16">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_17">17</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_17">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_18">18</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_18">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_19">19</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_19">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_20">20</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_20">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_21">21</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_21">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_22">22</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_22">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_23">23</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_23">
                                </div>
                            </TD>
                            <TD>
                                <label for="check_no_24">24</label>
                                <br>
                                <div class="form-check">
                                    <input class="form-check-input d-none" type="checkbox" value="" id="check_no_24">
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
                        '19.	Tiempos de Respaldo (RPO), Recuperación (RTO), Trabajo en Contingencia (WRT) y Máximo Tiempo de Interrupción del Proceso (MTPD)',
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
                    {!! Form::label('flujo_meses', 'Mes(es)') !!}
                    {!! Form::number('flujo_meses', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_semanas', 'Semana(s)') !!}
                    {!! Form::number('flujo_semanas', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_dias', 'Día(s)') !!}
                    {!! Form::number('flujo_dias', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_años', 'Horas(s)') !!}
                    {!! Form::number('flujo_años', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
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
                    {!! Form::label('flujo_meses', 'Mes(es)') !!}
                    {!! Form::number('flujo_meses', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_semanas', 'Semana(s)') !!}
                    {!! Form::number('flujo_semanas', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_dias', 'Día(s)') !!}
                    {!! Form::number('flujo_dias', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_años', 'Horas(s)') !!}
                    {!! Form::number('flujo_años', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
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
                    {!! Form::label('flujo_meses', 'Mes(es)') !!}
                    {!! Form::number('flujo_meses', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_semanas', 'Semana(s)') !!}
                    {!! Form::number('flujo_semanas', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_dias', 'Día(s)') !!}
                    {!! Form::number('flujo_dias', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_años', 'Horas(s)') !!}
                    {!! Form::number('flujo_años', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
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
                    {!! Form::label('flujo_meses', 'Mes(es)') !!}
                    {!! Form::number('flujo_meses', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_semanas', 'Semana(s)') !!}
                    {!! Form::number('flujo_semanas', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_dias', 'Día(s)') !!}
                    {!! Form::number('flujo_dias', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
                    ]) !!}
                </div>
                <div class="form-group col-sm-2">
                    {!! Form::label('flujo_años', 'Horas(s)') !!}
                    {!! Form::number('flujo_años', null, [
                        'class' => 'form-control form-control-sm',
                        'placeholder' => '...',
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
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal"
                        data-target="#probabilidad_incidentes_disruptivos" data-whatever="@mdo" data-whatever="@mdo"
                        title="Dar click"><i class="fas fa-info-circle"></i></a>
                    </a>
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

                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="operacion_q_1" placeholder="..." value="{{ old('meta', $cuestionario->operacion_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="operacion_q_2" placeholder="..." value="{{ old('meta', $cuestionario->operacion_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="operacion_q_3" placeholder="..." value="{{ old('meta', $cuestionario->operacion_q_2) }}">
                </div>
                <hr>

                <label class="col-sm-6 col-form-label">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#impacto_regulatorio"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    Impacto Regulatorio (IR)</label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="regulatorio_q_1" placeholder="..."
                        value="{{ old('meta', $cuestionario->regulatorio_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="regulatorio_q_2" placeholder="..."
                        value="{{ old('meta', $cuestionario->regulatorio_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="regulatorio_q_3" placeholder="..."
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
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="reputacion_q_1" placeholder="..."
                        value="{{ old('meta', $cuestionario->reputacion_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="reputacion_q_2" placeholder="..."
                        value="{{ old('meta', $cuestionario->reputacion_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="reputacion_q_3" placeholder="..."
                        value="{{ old('meta', $cuestionario->reputacion_q_3) }}">
                </div>
                <hr>

                <label class="col-sm-6 col-form-label">
                    <a id="btnAgregarTipo" onclick="event.preventDefault();"
                        style="font-size:12pt; float: right;"data-toggle="modal" data-target="#afectacion_operacional"
                        data-whatever="@mdo" data-whatever="@mdo" title="Dar click"><i
                            class="fas fa-info-circle"></i></a>
                    Impacto Social (IS)</label>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="social_q_1" placeholder="..." value="{{ old('meta', $cuestionario->social_q_1) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="social_q_2" pplaceholder="..." value="{{ old('meta', $cuestionario->social_q_2) }}">
                </div>
                <div class="form-group col-sm-2">
                    <input type="number" style="text-align: center;" class="form-control form-control-sm"
                        name="social_q_3" pplaceholder="..." value="{{ old('meta', $cuestionario->social_q_3) }}">
                </div>
                <hr>

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



            {{-- Modales --}}

            {{-- PROBABILIDAD DE INCIDENTES DISRUPTIVOS --}}
            <div class="modal fade" id="probabilidad_incidentes_disruptivos" tabindex="-1"
                aria-labelledby="probabilidad_incidentes_disruptivos" aria-hidden="true">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modelolec" id="exampleModalLabel">Detalle de la probabilidad de
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
                                    <span style="justify-content;">Cuenta con antecedentes de ocurrencia frecuentes; es más
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
                                    <span style="justify-content;">No se tienen antecedentes de ocurrencia. Es probable que
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
            <div class="modal fade" id="tiempos_recuperacion" tabindex="-1" aria-labelledby="tiempos_recuperacion"
                aria-hidden="true">
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
                                    <span style="justify-content;"><u>Punto Objetivo de Recuperación</u> <i>(Recovery Point
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
                                    <span style="justify-content;"><u>Tiempo Objetivo de Recuperación</u> <i>(Recovery Time
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
                                    <span style="justify-content;"><u>áximo Tiempo de Interrupción Tolerable </u>
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
            <div class="modal fade" id="afectacion_operacional" tabindex="-1" aria-labelledby="afectacion_operacional"
                aria-hidden="true">
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
                            <h5 class="modal-title" id="impacto_regulatorio" id="exampleModalLabel">Impacto Regulatorio
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


@section('scripts')
    <script>
        $('.table_checkbox input[type=checkbox]').click(function(e){
           if(e.target.checked == true){
            $('.table_checkbox th input[type=checkbox]:hover').parents('th').css('background-color', 'yellow');
            $('.table_checkbox td input[type=checkbox]:hover').parents('td').css('background-color', 'yellow');

           }else{
            $('.table_checkbox th input[type=checkbox]:hover').parents('th').css('background-color', 'white');
            $('.table_checkbox td input[type=checkbox]:hover').parents('td').css('background-color', 'white');

           }
        });
    </script>
@endsection

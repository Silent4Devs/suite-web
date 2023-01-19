@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/colores.css') }}">

    <style>
        label, label i{
            color: #3086AF !important;
            font-size: 14px;
        }

        input,
        textarea,
        select {

            border: none !important;
            border-bottom: 1px solid #3086AF !important;
            border-radius: 0 !important;
            resize: none;
            font-size: 14px;
        }

        input {
            background-color: rgba(0, 0, 0, 0) !important;
        }

        textarea {
            background-color: #fff;
        }

        .c_text {
            height: 150px !important;
            overflow: auto !important;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }

        select {
            background-color: rgba(0, 0, 0, 0) !important;
        }

        .caja-redes {
            display: flex;
            /* justify-content: space-between; */
            justify-content: center;
            margin-top: 10px;
            margin-left:5px;

        }

        .redes {
            all: unset;
            margin-left: 10px;
            color: #fff;
            transition: 0.1s;
            cursor: pointer;

            background-color: #345183;
            width: 50px;
            height: 50px;
            border-radius: 100px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .redes i {
            font-size: 20pt;

        }

        .redes:hover {
            color: #fff;
            transform: scale(1.1);
            text-decoration: none;
        }

    </style>

{{ Breadcrumbs::render('admin.visualizarorganizacion') }}
    <h5 class="col-12 titulo_general_funcion"> Organización {{ $organizacion->empresa }} </h5>
    <div class="justify-content-center row m-0">
    </div>

    @if (!is_null($organizacion))

        @if ($panel_rules->linkedin == false &&  $panel_rules->logotipo == false && $panel_rules->youtube == false && $panel_rules->facebook == false && $panel_rules->twitter == false && $panel_rules->empresa == false && $panel_rules->razon_social == false && $panel_rules->rfc == false && $panel_rules->schedule == false && $panel_rules->direccion == false && $panel_rules->telefono == false && $panel_rules->correo == false && $panel_rules->pagina_web == false)

        @elseif($panel_rules->linkedin == true ||  $panel_rules->logotipo == true || $panel_rules->youtube == true||$panel_rules->facebook == true || $panel_rules->twitter == true || $panel_rules->empresa == true || $panel_rules->razon_social == true || $panel_rules->rfc == true || $panel_rules->schedule == true || $panel_rules->direccion == true || $panel_rules->telefono == true || $panel_rules->correo == true || $panel_rules->pagina_web == true)
            <div class="card-body card">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        @if ($panel_rules->linkedin || $panel_rules->logotipo || $panel_rules->youtube || $panel_rules->facebook || $panel_rules->twitter || $panel_rules->empresa || $panel_rules->razon_social || $panel_rules->rfc || $panel_rules->schedule || $panel_rules->direccion || $panel_rules->telefono || $panel_rules->correo || $panel_rules->pagina_web)
                            <h5 class="" style="font-size: 18px;">DATOS GENERALES</h5>
                        @endif
                    </div>
                    <div class="p-0 col-12 mt-5 " style="">
                        <div class="row">
                            <div class="col-{{ $panel_rules->logotipo ? '4' : '12' }}">
                                @if ($panel_rules->logotipo)

                                    <div style="margin-top:0px;transform: scale(0.7);margin-top:-40px">
                                        <img class="" src="{{ url($logotipo) }}" alt="Card image"
                                            style="width:100%;">
                                        <div class="caja-redes">
                                            @if ($panel_rules->pagina_web)
                                            <a class="redes" target="_blank" href='{{ $organizacion->pagina_web}}'><i class="fas fa-globe"></i></a>
                                            @endif
                                            @if ($panel_rules->linkedln)
                                                    <a class="redes" target="_blank" href='{{ $organizacion->linkedln }}'><i
                                                            class="fab fa-linkedin-in" ></i></a>
                                            @endif
                                            @if ($panel_rules->youtube)

                                                    <a class="redes" target="_blank" href='{{ $organizacion->youtube }}'><i
                                                            class="fab fa-youtube"></i></a>

                                            @endif
                                            @if ($panel_rules->facebook)
                                                    <a class="redes" target="_blank" href='{{ $organizacion->facebook }}'><i
                                                            class="fab fa-facebook-f"></i></a>

                                            @endif
                                            @if ($panel_rules->twitter)
                                                    <a class="redes" target="_blank" href='{{ $organizacion->twitter }}'><i
                                                            class="fab fa-twitter"></i></a>
                                            @endif
                                        </div>
                                        @if ($errors->has('logotipo'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('logotipo') }}
                                            </div>
                                        @endif
                                        <span
                                            class="help-block">{{ trans('cruds.organizacion.fields.logotipo_helper') }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="col-{{ !$panel_rules->logotipo ? '12' : '8' }} row">

                                @if ($panel_rules->empresa)
                                    @if (!is_null($organizacion->empresa))
                                        <div class="form-group col-sm-12 col-md-12">
                                            <label for="empresa"><i class="far fa-building iconos-crear"></i> Nombre de la
                                                Empresa
                                            </label>
                                            <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}"
                                                type="text" name="empresa" id="empresa" value="{{ $organizacion->empresa }}"
                                                disabled>
                                            @if ($errors->has('empresa'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('empresa') }}
                                                </div>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span>
                                        </div>
                                    @endif
                                @endif
                                @if ($panel_rules->razon_social)
                                    @if (!is_null($organizacion->razon_social))
                                        <div class="form-group col-sm-12">
                                            <label class="" for="razon_social"><i
                                                    class="far fa-building iconos-crear"></i> Razón Social</label>
                                            <input
                                                class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}"
                                                type="text" name="razon_social" id="razon_social"
                                                value="{{ $organizacion->razon_social }}" disabled>
                                            @if ($errors->has('razon_social'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('razon_social') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif
                                @if ($panel_rules->rfc)
                                    @if (!is_null($organizacion->rfc))
                                        <div class="form-group col-sm-12">
                                            <label class="" for="rfc"><i
                                                    class="fas fa-barcode iconos-crear"></i>RFC</label>
                                            <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}"
                                                type="text" name="rfc" id="rfc" value="{{ $organizacion->rfc }}" disabled>
                                            @if ($errors->has('rfc'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('rfc') }}
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                @endif



                                @if ($panel_rules->direccion)
                                    @if (!is_null($organizacion->direccion))
                                        <div class="form-group col-sm-12 col-md-12">
                                            <label class="" for="direccion"> <i
                                                    class="fas fa-map-marker-alt iconos-crear"></i>
                                                {{ trans('cruds.organizacion.fields.direccion') }}
                                            </label>
                                            <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}"
                                                type="text" name="direccion" id="direccion" value=" {{ $organizacion->direccion }}"
                                                disabled>
                                            @if ($errors->has('direccion'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('direccion') }}
                                                </div>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.organizacion.fields.direccion_helper') }}</span>
                                        </div>
                                    @endif
                                @endif
                                @if ($panel_rules->telefono)
                                    @if (!is_null($organizacion->telefono))
                                        <div class="form-group col-sm-12 col-md-6">
                                            <label for="telefono"> <i class="fas fa-phone iconos-crear"></i>Teléfono
                                            </label>
                                            <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                                                type="number" name="telefono" id="telefono" value="{{ $organizacion->telefono }}"
                                                disabled>
                                            @if ($errors->has('telefono'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('telefono') }}
                                                </div>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.organizacion.fields.telefono_helper') }}</span>
                                        </div>
                                    @endif
                                @endif
                                @if ($panel_rules->correo)
                                    @if (!is_null($organizacion->correo))
                                        <div class="form-group col-sm-12 col-md-6">
                                            <label for="correo"> <i class="far fa-envelope iconos-crear"></i>
                                                {{ trans('cruds.organizacion.fields.correo') }}
                                            </label>
                                            <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" type="email"
                                                name="correo" id="correo" value="{{ $organizacion->correo }}" disabled>
                                            @if ($errors->has('correo'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('correo') }}
                                                </div>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span>
                                        </div>
                                    @endif
                                @endif

                                {{-- @if ($panel_rules->pagina_web)
                                    @if (!is_null($organizacion->pagina_web))
                                        <div class="form-group col-sm-12 col-md-4">
                                            <label for="pagina_web"> <i class="fas fa-pager iconos-crear"></i> Página Web
                                            </label>
                                            <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}"
                                                type="text" name="pagina_web" id="pagina_web" value="{{ $organizacion->pagina_web }}"
                                                disabled>
                                            @if ($errors->has('pagina_web'))
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('pagina_web') }}
                                                </div>
                                            @endif
                                            <span
                                                class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
                                        </div>
                                    @endif
                                @endif --}}
                                @if ($panel_rules->schedule)
                                    @if (!is_null($organizacion->schedule))
                                        <div class="form-group col-12">
                                            <table class="table" id="user_table">
                                                <tbody>
                                                    <div class=" row col-12 p-0 m-0">
                                                        <label class="col-md-4 col-sm-4" for="working_day"
                                                            style="text-align: center;"><i
                                                                class="fas fa-calendar-alt iconos-crear"></i>Día Laboral</label>
                                                        <label class="col-md-4 col-sm-4" for="working_day"
                                                            style="text-align: center;"><i class="fas fa-clock iconos-crear"></i>Horario
                                                            Laboral Inicio</label>
                                                        <label class="col-md-4 col-sm-4" for="working_day"
                                                            style="text-align: center;"><i class="fas fa-clock iconos-crear"></i>Horario
                                                            Laboral Fin</label>
                                                    </div>
                                                </tbody>
                                                <tfoot></tfoot>
                                            </table>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($panel_rules->representante_legal == false && $panel_rules->fecha_constitucion == false && $panel_rules->num_empleados == false && $panel_rules->tamano == false && $panel_rules->giro == false && $panel_rules->servicios == false && $panel_rules->mision == false && $panel_rules->vision == false && $panel_rules->valores == false && $panel_rules->antecedentes)

        @elseif($panel_rules->representante_legal == true ||  $panel_rules->fecha_constitucion == true || $panel_rules->num_empleados == true||$panel_rules->tamano == true || $panel_rules->giro == true || $panel_rules->servicios == true || $panel_rules->mision == true || $panel_rules->vision == true || $panel_rules->valores == true || $panel_rules->antecedentes == true)

            <div class="card-body card">
                <div class="row">
                    <div class="col-md-12 col-sm-12 mb-4">
                        @if ($panel_rules->representante_legal || $panel_rules->fecha_constitucion || $panel_rules->num_empleados || $panel_rules->tamano || $panel_rules->giro || $panel_rules->servicios || $panel_rules->mision || $panel_rules->vision || $panel_rules->valores || $panel_rules->antecedentes)
                            <h5 class="" style="font-size: 18px;">DATOS COMPLEMENTARIOS</h5>
                        @endif
                    </div>

                        @if ($panel_rules->representante_legal)
                            @if (!is_null($organizacion->representante_legal))
                                    <div class="mb-4 col-{{ $panel_rules->fecha_constitucion ? '6' : '12' }} && {{$panel_rules->num_empleados ? '4' : '12'}}">
                                        <label class="" for="representante_legal"><i
                                                class="fas fa-user-tie iconos-crear"></i>Representante Legal</label>
                                        <input
                                            class="form-control {{ $errors->has('representante_legal') ? 'is-invalid' : '' }}"
                                            type="text" name="representante_legal" id="representante_legal"
                                            value="{{ $organizacion->representante_legal }}" disabled>
                                        @if ($errors->has('representante_legal'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('representante_legal') }}
                                            </div>
                                        @endif
                                    </div>
                            @endif
                        @endif

                        @if ($panel_rules->fecha_constitucion)
                            @if (!is_null($organizacion->fecha_constitucion))
                                <div class="mb-4 col-{{ !$panel_rules->representante_legal ? '6' : '6' }}">
                                    <label for="fecha_constitucion"> <i class="far fa-calendar-alt iconos-crear"></i>Fecha de constitución</label>
                                    <input class="form-control date {{ $errors->has('fecha_constitucion') ? 'is-invalid' : '' }}"
                                        type="date" name="fecha_constitucion" id="fecha_constitucion"
                                        value="{{ $organizacion->fecha_constitucion }}" disabled>
                                    @if ($errors->has('fecha_constitucion'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('fecha_constitucion') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif



                        @if ($panel_rules->num_empleados)
                            @if (!is_null($organizacion->num_empleados))
                                <div class="form-group col-{{ $panel_rules->fecha_constitucion ? '6' : '6' }} && {{$panel_rules->tamano ? '6' : '12' }}">
                                    <label class="" for="num_empleados"><i
                                            class="fas fa-users iconos-crear"></i>Número de empleados</label>
                                    <input class="form-control {{ $errors->has('num_empleados') ? 'is-invalid' : '' }}"
                                        type="number" name="num_empleados" id="num_empleados"
                                        value="{{ $organizacion->num_empleados }}" disabled>
                                    @if ($errors->has('num_empleados'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('num_empleados') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif
                        @if ($panel_rules->tamano)
                            @if (!is_null($organizacion->tamano))
                                <div class="form-group  col-{{$panel_rules->num_empleados ? '6' : '12'}}">
                                    <label class="" for="tamano"><i
                                            class="fas fa-boxes iconos-crear"></i>Tamaño</label>
                                    <input class="form-control {{ $errors->has('tamano') ? 'is-invalid' : '' }}" type="text"
                                        name="tamano" id="tamano" value="{{ $organizacion->tamano }}" disabled>
                                    @if ($errors->has('tamano'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('tamano') }}
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endif
                        @if ($panel_rules->giro)
                        @if (!is_null($organizacion->giro))
                            <div class="form-group col-{{$panel_rules->servicios ? '6' : '12'}}">
                                <label for="giro"><i class="fas fa-briefcase iconos-crear"></i>
                                    {{ trans('cruds.organizacion.fields.giro') }}
                                </label>
                                <input class="form-control {{ $errors->has('giro') ? 'is-invalid' : '' }}" type="text"
                                    name="giro" id="giro" value="{{ $organizacion->giro }}" disabled>
                                @if ($errors->has('giro'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('giro') }}
                                    </div>
                                @endif
                                <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
                            </div>
                        @endif
                    @endif
                        @if ($panel_rules->servicios)
                            @if (!is_null($organizacion->servicios))
                                <div class="form-group col-{{$panel_rules->giro ? '6' : '12'}}">
                                    <label for="servicios"><i class="fas fa-briefcase iconos-crear"></i>
                                        {{ trans('cruds.organizacion.fields.servicios') }}
                                    </label>
                                    <input class="form-control {{ $errors->has('servicios') ? 'is-invalid' : '' }}" type="text"
                                        name="servicios" id="servicios" value="{{ $organizacion->servicios }}" disabled>
                                    @if ($errors->has('servicios'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('servicios') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
                                </div>
                            @endif
                        @endif
                        @if ($panel_rules->mision)
                            @if (!is_null($organizacion->mision))
                                <div class="form-group col-{{$panel_rules->vision ? '6' : '12'}}">
                                    <label for="mision"> <i class="fas fa-flag iconos-crear"></i>
                                        {{ trans('cruds.organizacion.fields.mision') }}</label>
                                    <div class="c_text text-justify"
                                        style="background-color:#fff!important; border:1px solid #ccc !important;">
                                        {!! $organizacion->mision !!}</div>
                                    @if ($errors->has('mision'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('mision') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.organizacion.fields.mision_helper') }}</span>
                                </div>
                            @endif
                        @endif
                        @if ($panel_rules->vision)
                            @if (!is_null($organizacion->vision))
                                <div class="form-group col-{{$panel_rules->mision ? '6' : '12'}}">
                                    <label for="vision"> <i class="far fa-eye iconos-crear"></i>
                                        {{ trans('cruds.organizacion.fields.vision') }}</label>
                                    <div class="c_text text-justify"
                                        style="background-color:#fff!important;border:1px solid #ccc !important;">
                                        {!! $organizacion->vision !!}</div>
                                    @if ($errors->has('vision'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('vision') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.organizacion.fields.vision_helper') }}</span>
                                </div>
                            @endif
                        @endif
                        @if ($panel_rules->valores)
                            @if (!is_null($organizacion->valores))
                                <div class="form-group col-{{$panel_rules->antecedentes ? '6':'12'}}">
                                    <label for="valores"> <i class="far fa-heart iconos-crear"></i>
                                        {{ trans('cruds.organizacion.fields.valores') }}
                                    </label>
                                    <div class="c_text"
                                        style="background-color:#fff!important; border:1px solid #ccc !important;">
                                        {!! $organizacion->valores !!}</div>
                                    @if ($errors->has('valores'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('valores') }}
                                        </div>
                                    @endif
                                    <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                                </div>
                            @endif
                        @endif
                        @if ($panel_rules->antecedentes)
                            @if (!is_null($organizacion->antecedentes))
                                <div class="form-group col-6">
                                    <label for="antecedentes"> <i class="far fa-file-alt iconos-crear"></i> Antecedentes
                                    </label>
                                    <div class="c_text text-justify"
                                        style="background-color:#fff!important; border:1px solid #ccc !important;">
                                        {!! $organizacion->antecedentes !!}</div>
                                    <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                                </div>
                            @endif
                        @endif
                </div>
            </div>
        @endif
     @else
        <img src="{{ asset('img/portal_404.png') }} " style="width: 40%;margin-left: 25%;">
    @endif



@endsection

@section('scripts')


    <script>
        $(document).ready(function() {


            function dynamic_field(number, element) {


                if (element === undefined) {
                    console.log(0);

                    html = "<tr>";
                    html +=
                        '<td class="col-3"><input class="form-control" type="hidden" value="0"  name="working[' +
                        number + '][id][]"><select class="workingSelect form-control" name="working[' + number +
                        '][day][]" id="working_day" disabled style="background-color:whithe;"><option value="">Seleccione una opción</option>';
                    html += '<option value="Lunes" >Lunes</option>';
                    html += '<option value="Martes" >Martes</option>';
                    html += '<option value="Miercoles" >Miercoles</option>';
                    html += '<option value="Jueves" >Jueves</option>';
                    html += '<option value="Viernes" >Viernes</option>';
                    html += '<option value="Sabado" >Sabado</option>';
                    html += '<option value="Domingo" >Domingo</option>';
                    html += '</select></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" name="working[' + number +
                        '][start_time][]" id="start_work_time" disabled></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" name="working[' + number +
                        '][end_time][]" id="end_work_time" disabled></td>';

                    /*
                    if (number > 1) {
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="remove" id="" class="btn btn-danger remove col-3" style="background-color: #d96161 !important;"><i class="fas fa-trash-alt"></i></button></td></tr>';
                        $("#user_table tbody").append(html);
                    } else {
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="add" id="add" class="btn btn-success col-3" ><i class="fas fa-plus-square"></i></button></td></tr>';
                        $("#user_table tbody").html(html);
                    }
                    */

                } else {

                    if (element.working_day == "Lunes") {
                        var Lunes = " selected ";
                    } else if (element.working_day == "Martes") {
                        var Martes = " selected ";
                    } else if (element.working_day == "Miercoles") {
                        var Miercoles = " selected ";
                    } else if (element.working_day == "Jueves") {
                        var Jueves = " selected ";
                    } else if (element.working_day == "Viernes") {
                        var Viernes = " selected ";
                    } else if (element.working_day == "Sabado") {
                        var Sabado = " selected ";
                    } else if (element.working_day == "Domingo") {
                        var Domingo = " selected ";
                    }

                    html = "<tr>";
                    html += '<td class="col-3"><input class="form-control" type="hidden" value="' + element
                        .id + '" name="working[' + number +
                        '][id][]"><select class="workingSelect form-control" data-model-id="' + element
                        .id + '" data-type-input="working_day" name="working[' + number +
                        '][day][]" id="working_day" disabled><option value="">Seleccione una opción</option>';
                    html += '<option value="Lunes" ' + Lunes + ' >Lunes</option>';
                    html += '<option value="Martes" ' + Martes + ' >Martes</option>';
                    html += '<option value="Miercoles" ' + Miercoles + ' >Miercoles</option>';
                    html += '<option value="Jueves" ' + Jueves + ' >Jueves</option>';
                    html += '<option value="Viernes" ' + Viernes + ' >Viernes</option>';
                    html += '<option value="Sabado" ' + Sabado + ' >Sabado</option>';
                    html += '<option value="Domingo" ' + Domingo + ' >Domingo</option>';
                    html += '</select></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" data-model-id="' + element
                        .id + '" data-type-input="start_work_time" name="working[' + number +
                        '][start_time][]" id="start_work_time" value="' + element.start_work_time +
                        '" disabled></td>';
                    html += '<td class="col-3"><input class="form-control" type="time" data-model-id="' + element
                        .id + '" data-type-input="end_work_time" name="working[' + number +
                        '][end_time][]" id="end_work_time" value="' + element.end_work_time + '" disabled></td>';
                    // console.log(html);
                    if (number > 1) {
                        /*
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="remove" id="" class="btn btn-danger remove col-3 removeWithFetch" style="background-color: #d96161 !important;" data-model-id="' + element.id + '"><i class="fas fa-trash-alt"></i></button></td></tr>';
                        $("#user_table tbody").append(html);
                        */
                        $("#user_table tbody").append(html);
                    } else {
                        /*
                        html +=
                            '<td style="display: flex;align-items: center;justify-content: center;"><button type="button" name="add" id="add" class="btn btn-success col-3" ><i class="fas fa-plus-square"></i></button></td></tr>';
                        $("#user_table tbody").html(html);
                        */
                        $("#user_table tbody").html(html);
                    }
                }
            }

            $(document).on("click", "#add", function() {
                count++;
                var divs = document.getElementsByClassName("workingSelect").length;
                // console.log("Hay " + divs + " elementos");
                if (divs <= 7) {
                    dynamic_field(count);
                }
            });

            $(document).on("click", ".remove", function() {
                count--;
                $(this).closest("tr").remove();
            });



            let schedule = @json($schedule);
            let dscheduleSize = schedule.length;
            let count = dscheduleSize > 0 ? dscheduleSize : 1;
            if (dscheduleSize) {
                schedule.forEach((element, index) => {
                    ++index;
                    dynamic_field(index, element);

                });
            } else {
                dynamic_field(count);
            }
            $("#user_table").on("change", "input", async function(e) {
                const target = e.target;

                const value = target.value;
                const modelId = target.getAttribute('data-model-id')
                const typeInput = target.getAttribute('data-type-input');

                if (typeInput && modelId) {
                    const url = `/admin/organizacions/${modelId}/update-schedule`;

                    const response = await fetch(url, {

                        method: 'POST',

                        body: JSON.stringify({

                            value,

                            typeInput

                        }),

                        headers: {

                            Accept: "application/json",

                            "Content-Type": "application/json",

                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),

                        },

                    })

                    const data = await response.json();

                    // console.log(data);
                }
            })
            $('#user_table').on('click', '.removeWithFetch', function(e) {
                e.preventDefault()
                let = target = e.target;
                if (target.tagName == 'I') {
                    target = e.target.parentElement
                }

                const modelId = target.getAttribute('data-model-id')



                const url = `/admin/organizacions/${modelId}/delete-schedule`;
                Swal.fire({

                    title: '¿Quieres eliminar este registro?',

                    text: "Este dato ya está almacenado",

                    icon: 'question',

                    showCancelButton: true,

                    confirmButtonColor: '#3085d6',

                    cancelButtonColor: '#d33',

                    confirmButtonText: 'Eliminar',

                    cancelButtonText: 'Cancelar'

                }).then(async (result) => {

                    if (result.isConfirmed) {
                        const response = await fetch(url, {

                            method: 'POST',

                            headers: {

                                Accept: "application/json",

                                "Content-Type": "application/json",

                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),

                            },

                        })

                        const data = await response.json();
                        count--;
                        $(this).closest("tr").remove();
                        console.log(data);
                    }

                })



            });


        });
    </script>

    {{-- <script>
        if $panel_rules->representante_legal == null
            $("#contenedor2").css("display", "none");
        else
            $("#contenedor2").css("display", "block");


    </script> --}}


@endsection

@extends('layouts.admin')
@section('content')


    <link rel="stylesheet" type="text/css" href="{{ asset('css/colores.css') }}{{config('app.cssVersion')}}">

    <style>
        .tarjeta {

            margin-left: 50px;
            margin-top: 20px;
            border-radius: 3px;
            border: solid;
            border-color: #ccc;
            width: 430px;
            border-width: 1px;
            padding-left: 5px;
            padding-bottom: 20px;
            padding-right: 5px;
            padding-top: 5px;
        }

        .imagen_organizacion {
            border-radius: 3px;
            border: solid;
            border-color: #ccc;
            margin-left: 500px;
            margin-top: -110px;
            border-width: 1px;
            width: 500px;


        }

        .boton_organizacion {
            margin-left: 310px;

        }

        @media(max-width: 796px) {

            .tarjeta {

                margin-left: 15px;
                margin-top: 20px;
                border: none;

            }

            .imagen_organizacion {

                margin-left: 335px;
                margin-top: -110px;
                width: 340px;

            }

            .boton_organizacion {

                margin-left: 100px;

            }
        }

        .c_text {
            height: 150px !important;
            overflow: auto !important;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
        }

        .caja-redes {
            display: flex;
            /* justify-content: space-between; */
            justify-content: center;
            margin-top: 10px;

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

        }
    </style>
    <h5 class="col-12 titulo_general_funcion">Mi organización</h5>
    <div class="mt-5 card ">
        <br>
        @include('layouts.errors')


        @if ($empty == true)
            <div class="text-right col-lg-12" style="position:relative; z-index:1;">
                @if (!empty($count == 1))
                @else
                    @can('mi_organizacion_agregar')
                        <a class="btn btn-danger" href="{{ route('admin.organizacions.create') }}">
                            Agregar Organización
                        </a>
                    @endcan
                @endif
                @can('mi_organizacion_panel_de_control')
                    <a class="btn btn-success" style="float: left;" href="{{ route('admin.panel-organizacion.index') }}">
                        Panel de Control
                    @endcan
                    @can('mi_organizacion_editar_organizacion')
                        <a href="{!! route('admin.organizacions.edit', [$organizacion->id]) !!}" class=' btn btn-danger'>
                            Editar Organización
                        </a>
                    @endcan
            </div>

            <div class="card-body">
                <div class="row">
                    @if ($panel_rules->logotipo)
                        <div class="row col-12 justify-content-center d-flex" style="margin-top:-85px;">
                            <div class="text-center p-5 col-sm-6">
                                <label for="logotipo"></label>
                                <img class="  text-center bg-light" src="{{ url($logotipo) }} " alt="Card image"
                                    style="width:200px;">
                                <div class="caja-redes">
                                    @if ($panel_rules->pagina_web)
                                        <a class="redes" target="_blank" href='{{ $organizacion->pagina_web }}'><i
                                                class="fas fa-globe"></i></a>
                                    @endif
                                    @if ($panel_rules->linkedln)
                                        <a class="redes" target="_blank" href='{{ $organizacion->linkedln }}'><i
                                                class="fab fa-linkedin-in"></i></a>
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
                                <span class="help-block">{{ trans('cruds.organizacion.fields.logotipo_helper') }}</span>
                            </div>
                        </div>
                    @endif

                    <div class="col-md-12 col-sm-12">
                        <div class="card vrd-agua">
                            <span class="mb-1 text-center text-white">DATOS GENERALES</span>
                        </div>
                    </div>

                    @if ($panel_rules->empresa)
                        <div class="form-group col-sm-12 col-md-12">
                            <label class="" for="empresa"><i class="far fa-building iconos-crear"></i> Nombre de
                                la
                                Empresa
                            </label>
                            <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                                name="empresa" id="empresa" value="{{ $organizacion->empresa }}" disabled>
                            @if ($errors->has('empresa'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('empresa') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.empresa_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->direccion)
                        <div class="form-group col-sm-12 col-md-12">
                            <label class="" for="direccion"> <i class="fas fa-map-marker-alt iconos-crear"></i>
                                {{ trans('cruds.organizacion.fields.direccion') }}
                            </label>
                            <textarea class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" name="direccion" id="direccion"
                                disabled style="min-height: 0px; max-height: 200px; height: 35px;">{{ $organizacion->direccion }}</textarea>
                            @if ($errors->has('direccion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('direccion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.direccion_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->razon_social)
                        <div class="form-group col-sm-6">
                            <label class="" for="razon_social"><i class="far fa-building iconos-crear"></i> Razón
                                Social</label>
                            <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}"
                                type="text" name="razon_social" id="razon_social"
                                value="{{ $organizacion->razon_social }}" disabled>
                            @if ($errors->has('razon_social'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('razon_social') }}
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($panel_rules->rfc)
                        <div class="form-group col-sm-6">
                            <label class="" for="rfc"><i class="far fa-building iconos-crear"></i>RFC</label>
                            <input class="form-control {{ $errors->has('empresa') ? 'is-invalid' : '' }}" type="text"
                                name="rfc" id="rfc" value="{{ $organizacion->rfc }}" disabled>
                            @if ($errors->has('rfc'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('rfc') }}
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($panel_rules->telefono)
                        <div class="form-group col-sm-6 col-md-6">
                            <label for="telefono"> <i class="fas fa-phone iconos-crear"></i> Teléfono
                            </label>
                            <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" type="number"
                                name="telefono" id="telefono" value="{{ $organizacion->telefono }}" disabled>
                            @if ($errors->has('telefono'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('telefono') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.telefono_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->correo)
                        <div class="form-group col-sm-6 col-md-6">
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
                            <span class="help-block">{{ trans('cruds.organizacion.fields.correo_helper') }}</span>
                        </div>
                    @endif
                    {{-- @if ($panel_rules->pagina_web)
                    <div class="form-group col-sm-4 col-md-4">
                        <label for="pagina_web"> <i class="fas fa-pager iconos-crear"></i> Página Web
                        </label>
                        <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}" type="text"
                            name="pagina_web" id="pagina_web" value="{{ $organizacion->pagina_web }}" disabled>
                        @if ($errors->has('pagina_web'))
                            <div class="invalid-feedback">
                                {{ $errors->first('pagina_web') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.organizacion.fields.pagina_web_helper') }}</span>
                    </div>
                    @endif --}}
                    {{-- @if ($panel_rules->redessociales) --}}
                    {{-- <div class="form-group col-sm-4 col-md-3">
                        <label for="linkedln"><i class="fab fa-linkedin iconos-crear"></i>Linkedln
                        </label>
                        <input class="form-control {{ $errors->has('linkedln') ? 'is-invalid' : '' }}" type="text"
                            name="linkedln" id="linkedln" value="{{ $organizacion->linkedln }}" disabled>
                        @if ($errors->has('linkedln'))
                            <div class="invalid-feedback">
                                {{ $errors->first('linkedln') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for="youtube"><i class="fab fa-youtube iconos-crear"></i>YouTube
                        </label>
                        <input class="form-control {{ $errors->has('youtube') ? 'is-invalid' : '' }}" type="text"
                            name="youtube" id="youtube" value="{{ $organizacion->youtube }}" disabled>
                        @if ($errors->has('youtube'))
                            <div class="invalid-feedback">
                                {{ $errors->first('youtube') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for="facebook"><i class="fab fa-facebook-square iconos-crear"></i>Facebook
                        </label>
                        <input class="form-control {{ $errors->has('facebook') ? 'is-invalid' : '' }}" type="text"
                            name="facebook" id="facebook" value="{{ $organizacion->facebook }}" disabled>
                        @if ($errors->has('facebook'))
                            <div class="invalid-feedback">
                                {{ $errors->first('facebook') }}
                            </div>
                        @endif
                    </div>
                    <div class="form-group col-sm-4 col-md-3">
                        <label for="twitter"><i class="fab fa-twitter-square iconos-crear"></i>Twitter
                        </label>
                        <input class="form-control {{ $errors->has('twitter') ? 'is-invalid' : '' }}" type="text"
                            name="twitter" id="twitter" value="{{ $organizacion->twitter }}" disabled>
                        @if ($errors->has('twitter'))
                            <div class="invalid-feedback">
                                {{ $errors->first('twitter') }}
                            </div>
                        @endif
                    </div> --}}
                    {{-- @endif --}}
                    @if ($panel_rules->schedule)
                        <div class="form-group col-6">
                            <table class="table" id="user_table">
                                <tbody>
                                    <div class=" row col-12 p-0 m-0">
                                        <label class="col-md-4 col-sm-4" for="working_day" style="text-align: center;"><i
                                                class="fas fa-calendar-alt iconos-crear"></i>Día Laboral</label>
                                        <label class="col-md-4 col-sm-4" for="working_day" style="text-align: center;"><i
                                                class="fas fa-clock iconos-crear"></i>Horario Laboral Inicio</label>
                                        <label class="col-md-4 col-sm-4" for="working_day" style="text-align: center;"><i
                                                class="fas fa-clock iconos-crear"></i>Horario Laboral Fin</label>
                                        <!-- <label class="col-md-3 col-sm-3" for="working_day"
                                            style="text-align: center;"></i>Opciones</label> -->
                                    </div>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    @endif

                    <div class="col-md-12 col-sm-12">
                        <div class="card vrd-agua">
                            <p class="mb-1 text-center text-white">DATOS COMPLEMENTARIOS</p>
                        </div>
                    </div>
                    @if ($panel_rules->representante_legal)
                        <div class="form-group  col-sm-12 col-md-6">
                            <label class="" for="representante_legal"><i
                                    class="far fa-building iconos-crear"></i>Representante Legal</label>
                            <input class="form-control {{ $errors->has('representante_legal') ? 'is-invalid' : '' }}"
                                type="text" name="representante_legal" id="representante_legal"
                                value="{{ $organizacion->representante_legal }}" disabled>
                            @if ($errors->has('representante_legal'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('representante_legal') }}
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($panel_rules->fecha_constitucion)
                        <div class="form-group  col-sm-3 col-md-6">
                            <label for="fecha_constitucion"> <i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                                constitución</label>
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
                    @if ($panel_rules->num_empleados)
                        <div class="form-group col-sm-6">
                            <label class="" for="num_empleados"><i class="far fa-building iconos-crear"></i>Número
                                de empleados</label>
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
                    @if ($panel_rules->tamano)
                        <div class="form-group  col-sm-12 col-md-6">
                            <label class="" for="tamano"><i
                                    class="far fa-building iconos-crear"></i>Tamaño</label>
                            <input class="form-control {{ $errors->has('tamano') ? 'is-invalid' : '' }}" type="text"
                                name="tamano" id="tamano" value="{{ $organizacion->tamano }}" disabled>
                            @if ($errors->has('tamano'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('tamano') }}
                                </div>
                            @endif
                        </div>
                    @endif
                    @if ($panel_rules->giro)
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="giro"> <i class="fas fa-briefcase iconos-crear"></i>
                                {{ trans('cruds.organizacion.fields.giro') }}
                            </label>
                            <input class="form-control {{ $errors->has('giro') ? 'is-invalid' : '' }}" type="text"
                                name="giro" id="giro" value="{{ $organizacion->giro }}" disabled>
                            @if ($errors->has('giro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('giro') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.giro_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->servicios)
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="servicios"><i class="fas fa-briefcase iconos-crear"></i>
                                {{ trans('cruds.organizacion.fields.servicios') }}
                            </label>
                            <input class="form-control {{ $errors->has('servicios') ? 'is-invalid' : '' }}"
                                type="text" name="servicios" id="servicios" value="{{ $organizacion->servicios }}"
                                disabled>
                            @if ($errors->has('servicios'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('servicios') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.servicios_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->mision)
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="mision"> <i class="fas fa-flag iconos-crear"></i>
                                {{ trans('cruds.organizacion.fields.mision') }}</label>
                            <div class="c_text">{!! $organizacion->mision !!}</div>
                            @if ($errors->has('mision'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('mision') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.mision_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->vision)
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="vision"> <i class="far fa-eye iconos-crear"></i>
                                {{ trans('cruds.organizacion.fields.vision') }}</label>
                            <div class="c_text">{!! $organizacion->vision !!}</div>
                            @if ($errors->has('vision'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('vision') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.vision_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->valores)
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="valores"> <i class="far fa-heart iconos-crear"></i>
                                {{ trans('cruds.organizacion.fields.valores') }}
                            </label>
                            <div class="c_text">{!! $organizacion->valores !!}</div>
                            @if ($errors->has('valores'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('valores') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                        </div>
                    @endif
                    @if ($panel_rules->antecedentes)
                        <div class="form-group col-sm-12 col-md-6">
                            <label for="antecedentes"> <i class="far fa-file-alt iconos-crear"></i> Antecedentes
                            </label>
                            <div class="c_text">{!! $organizacion->antecedentes !!}</div>
                            <span class="help-block">{{ trans('cruds.organizacion.fields.valores_helper') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="row" style="display: flex; justify-content: center; align-items: center;">

                <div class="col-md-5" style="text-align:center; border:none;">
                    @if (!empty($count == 1))
                    @else
                        <span>Agregue los datos generales de su organización</span>
                        <br>
                        <br>
                        <a class="btn btn-success" href="{{ route('admin.organizacions.create') }}">
                            Agregar
                        </a>
                    @endif
                </div>

                <div class=" col-md-7" style="border: none;">
                    <img src="../img/organizacion.png" width="100%">
                </div>

            </div>
            <!--row-->





            <div class="card-body">
                <div class="row">

                </div>
            </div>
        @endif
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {


            function dynamic_field(number, element) {


                if (element === undefined) {
                    console.log(0);

                    html = "<tr>";
                    html += '<td class="col-3"><div class="form-control" type="hidden" value="0"  name="working[' +
                        number + '][id][]"><div class="workingSelect form-control" name="working[' + number +
                        '][day][]" id="working_day" disabled><option value="">Seleccione una opción</option>';
                    html += '<option value="Lunes" >Lunes</option>';
                    html += '<option value="Martes" >Martes</option>';
                    html += '<option value="Miercoles" >Miercoles</option>';
                    html += '<option value="Jueves" >Jueves</option>';
                    html += '<option value="Viernes" >Viernes</option>';
                    html += '<option value="Sabado" >Sabado</option>';
                    html += '<option value="Domingo" >Domingo</option>';
                    html += '</div></td>';
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
@endsection

@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('perfil-puesto-edit', $puesto) }}
    <h5 class="col-12 titulo_general_funcion"> Editar: Puesto</h5>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.puestos.update', [$puesto->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Identificación del Puesto</span>
                </div>

                <div class="row col-12">
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="puesto"><i
                            class="fas fa-briefcase iconos-crear"></i>Nombre del puesto</label>
                        <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text" name="puesto"
                            id="puesto" value="{{ old('puesto', $puesto->puesto) }}" required>
                        @if ($errors->has('puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('puesto') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
                    </div>

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <select class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}" name="id_area" id="id_area" value="{{ $puesto->id_area}}">
                            @foreach ($areas as $area)
                            <option  value="{{ $area->id }}" {{ $puesto->id_area == $area->id ? 'selected' : '' }}>
                                {{ $area->area }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('id_area'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_area') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="fecha_puesto"><i
                                class="fas fa-calendar-alt iconos-crear"></i>Fecha de creación</label>
                        <input class="form-control {{ $errors->has('fecha_puesto') ? 'is-invalid' : '' }}" type="date" name="fecha_puesto"
                            id="fecha_puesto" value="{{ old('fecha_puesto', $puesto->fecha_puesto) }}">
                        @if ($errors->has('fecha_puesto'))
                            <div class="invalid-feedback">
                                {{ $errors->first('fecha_puesto') }}
                            </div>
                        @endif
                    </div>
                </div>

                <div class="row col-12">

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="id_reporta"><i class="fas fa-user-tie iconos-crear"></i>Reportará a</label>
                        <select class="form-control {{ $errors->has('id_reporta') ? 'is-invalid' : '' }}" name="id_reporta" id="id_reporta">
                            @foreach ($reportas as $reporta)
                            <option data-puesto="{{ $reporta->puesto }}" value="{{ $reporta->id }}" data-area="{{ $reporta->area->area }}"
                                {{ $puesto->id_reporta == $reporta->id  ? 'selected' : '' }}>
                                {{ $reporta->name }}
                            </option>
                            @endforeach
                        </select>
                        @if ($errors->has('reporta'))
                        <div class="invalid-feedback">
                            {{ $errors->first('id_reporta') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group col-md-4">
                        <label for="id_puesto_reviso"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="form-control" id="puesto_reviso"></div>

                    </div>


                    <div class="form-group col-md-4">
                        <label for="id_area_reviso"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="form-control" id="area_reviso"></div>

                    </div>
                </div>


                <div class="form-group col-sm-12 col-md-12 col-lg-12">
                    <label for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>Descripción del puesto</label>
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion"
                        id="descripcion">{{ old('descripcion', strip_tags($puesto->descripcion)) }}</textarea>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.puesto.fields.descripcion_helper') }}</span>
                </div>

                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Principales responsabilidades</span>
                </div>


                <div class="row col-12">
                    <div class="col-sm-12 col-lg-12 col-md-12">
                        <label for="actividad"><i class="fas fa-file-signature iconos-crear"></i>Actividad</label>
                        <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text" name="actividad"
                            id="actividad_responsabilidades" value="{{ old('actividad', '') }}">
                        <span class="errors actividad_error text-danger"></span>
                    </div>
                </div>

                <div class="row col-12 mt-3">
                    <div class="col-sm-4 col-lg-12 col-md-12">
                            <label for="resultado"><i class="fas fa-chart-line iconos-crear"></i>Resultado Esperado</label>
                            <input class="form-control {{ $errors->has('resultado') ? 'is-invalid' : '' }}" type="text" name="resultado"
                                id="resultado_certificado_responsabilidades" value="{{ old('resultado', '') }}">
                            <span class="errors resultado_error text-danger"></span>
                    </div>
                </div>

                <div class="row col-12 mt-3">

                    <div class="col-sm-8 col-lg-8 col-md-8">
                        <label for="indicador"><i class="fas fa-clipboard-check iconos-crear"></i>Cumplimiento</label>
                        <input class="form-control {{ $errors->has('indicador') ? 'is-invalid' : '' }}" type="text" name="indicador"
                            id="indicador_responsabilidades" value="{{ old('indicador', '') }}">
                        <span class="errors indicador_error text-danger"></span>
                    </div>

                    <div class="col-sm-4 col-lg-4 col-md-4">
                        <label for="tiempo_asignado"><i
                            class="far fa-percent iconos-crear"></i> de tiempo</label>
                        <input class="form-control {{ $errors->has('tiempo_asignado') ? 'is-invalid' : '' }}" type="text" name="tiempo_asignado"
                            id="tiempo_asignado_responsabilidades" value="{{ old('tiempo_asignado', '') }}">
                        <span class="errors tiempo_asignado_error text-danger"></span>
                    </div>

                </div>



                <div class="mb-3 col-12 mt-4 " style="text-align: end">
                    <button type="button" name="btn-suscribir-responsabilidades" id="btn-suscribir-responsabilidades" class="btn btn-success">Agregar</button>
                </div>

                <div class="row col-12">
                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                        <table class="table w-100" id="responsabilidades_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Actividad</th>
                                    <th>Resultado Esperado</th>
                                    <th>Cumplimiento</th>
                                    <th>% de tiempo</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor_responsabilidades">
                                {{-- <tr>
                                    <td><input class="form-control" type="text" id="actividad" name="actividad"></td>
                                    <td><input class="form-control" type="text" id="resultado" name="resultado"></td>
                                    <td><input class="form-control" type="text" id="cumplimiento" name="indicador"></td>
                                    <td><input class="form-control" type="text" id="tiempo_asignado" name="tiempo_asignado"></td>
                                    <td><button type="button" name="btn-remove-responsabilidades" id="" class="btn btn-danger remove">Eliminar</button></td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row col- mt-4">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="estudios"><i class="fas fa-graduation-cap iconos-crear"></i>Educación Academica(estudios)<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="estudios" id="estudios">
                                            {{ old('estudios', strip_tags($puesto->estudios)) }}
                                        </textarea>
                        @if ($errors->has('estudios'))
                            <span class="text-danger">
                                {{ $errors->first('estudios') }}
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="experiencia"><i class="fas fa-briefcase iconos-crear"></i>Experiencia Profesional<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="experiencia" id="experiencia">
                                            {{ old('experiencia', strip_tags($puesto->experiencia)) }}
                                        </textarea>
                        @if ($errors->has('experiencia'))
                            <span class="text-danger">
                                {{ $errors->first('experiencia') }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row col-12">
                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="conocimientos"><i class="fas fa-chalkboard-teacher iconos-crear"></i>Conocimientos<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control" type="text" name="conocimientos" id="conocimientos">
                                            {{ old('conocimientos', strip_tags($puesto->conocimientos)) }}</textarea>
                        @if ($errors->has('conocimientos'))
                            <span class="text-danger">
                                {{ $errors->first('conocimientos') }}
                            </span>
                        @endif
                    </div>


                    {{-- <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="conocimientos_esp"><i class="fas fa-file-signature iconos-crear"></i>Conocimientos Especiales<span
                                class="text-danger">*</span></label>
                        <textarea class="form-control date" type="text" name="conocimientos_esp" id="conocimientos_esp">
                                            {{ old('conocimientos_esp', strip_tags($puesto->conocimientos_esp)) }}
                                        </textarea>
                        @if ($errors->has('conocimientos_esp'))
                            <span class="text-danger">
                                {{ $errors->first('conocimientos_esp') }}
                            </span>
                        @endif
                    </div> --}}
                </div>

                    {{-- <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <label for="idioma"><i class="fas fa-user-tie iconos-crear"></i>Idioma</label>
                        <select class="form-control {{ $errors->has('idioma') ? 'is-invalid' : '' }}" name="idioma" id="idioma" value="{{ $puesto->idioma}}">
                            @foreach ($lenguajes as $lenguaje)
                            <option  value={{$lenguaje->abr}} >{{ $lenguaje->idioma }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('idioma'))
                        <div class="invalid-feedback">
                            {{ $errors->first('idioma') }}
                        </div>
                        @endif
                    </div> --}}
                    {{-- <div class="form-group col-sm-3 col-md-3 col-lg-3">
                        <label class="required" for="porcentaje"><i
                                class="fas fa-briefcase iconos-crear"></i>Porcentaje</label>
                        <input class="form-control {{ $errors->has('porcentaje') ? 'is-invalid' : '' }}" type="number" name="porcentaje"
                            id="porcentaje" value="{{ old('porcentaje',strip_tags($puesto->porcentaje)) }}"  min="0" max="100" required>
                        @if ($errors->has('porcentaje'))
                            <div class="invalid-feedback">
                                {{ $errors->first('porcentaje') }}
                            </div>
                        @endif
                    </div> --}}
                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Idioma</span>
                </div>

                <div class="row col-12">
                    <div class="form-group col-sm-12 col-md-12 col-lg-12">
                        <table class="table" id="user_table">
                            <tbody>
                                <div class="row col-12">
                                    <label class="col-md-4 col-sm-4" for="working_day" style="text-align:left;"><i class="fas fa-language iconos-crear"></i>
                                        Idioma</label>
                                    <label class="col-md-4 col-sm-4 " style="margin-left:-5px;"  for="working_day" style="text-align:left;" ><i
                                            class="far fa-percent iconos-crear"></i>Porcentaje</label>
                                     <label style="margin-left:-130px;" class="col-md-4 col-sm-4" style="text-align:left;" for="working_day" ><i
                                        class="fas fa-graduation-cap iconos-crear"></i>Nivel</label>
                                </div>
                            </tbody>
                            <tfoot></tfoot>
                        </table>
                    </div>
                </div>

                <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                    <span style="font-size: 17px; font-weight: bold;">
                        Certificaciones</span>
                </div>

                <div class="row col-12">
                    <div class="col-sm-6 col-lg-6 col-md-6">
                        <label for="nombre"><i class="fas fa-file-signature iconos-crear"></i>Nombre</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                            id="nombre_certificado" value="{{ old('nombre', '') }}">
                        <span class="errors nombre_error text-danger"></span>
                    </div>


                    <div class="form-group col-sm-6 col-md-6 col-lg-6">
                        <label for="requisito"><i class="fas fa-tasks iconos-crear"></i>Requisito</label>
                        {{-- <select class="form-control {{ $errors->has('requisito') ? 'is-invalid' : '' }}" name="requisito" id="requisito"> --}}
                        <select class="form-control {{ $errors->has('requisito') ? 'is-invalid' : '' }}" name="requisito" id="requisito_certificado">
                            <option value="" selected>Selecciona</option>
                            <option value="Indispensable">Indispensable</option>
                            <option value="Deseable">Deseable</option>
                        </select>
                        {{-- </select> --}}
                        @if ($errors->has('requisito'))
                        <div class="invalid-feedback">
                            {{ $errors->first('requisito') }}
                        </div>
                        @endif
                    </div>
                 </div>

                 <div class="mb-3 col-12 mt-4 " style="text-align: end">
                    <button type="button" name="btn-suscribir-certificaciones" id="btn-suscribir-certificaciones" class="btn btn-success">Agregar</button>
                </div>

                <div class="row col-12">
                    <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                        <table class="table w-100" id="certificaciones_table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Requisito</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor_certificados">

                            </tbody>
                        </table>
                    </div>
                </div>




                <div class="row col-12">

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label for="lugar_trabajo"><i class="far fa-building iconos-crear"></i>Lugar de trabajo</label>
                        <select class="form-control {{ $errors->has('lugar_trabajo') ? 'is-invalid' : '' }}" name="lugar_trabajo" id="lugar_trabajo" >
                            <option {{ old('lugar_trabajo', $puesto->lugar_trabajo) == 'Home Office' ? 'selected' : '' }} >Home Office</option>
                            <option {{ old('lugar_trabajo', $puesto->lugar_trabajo) == 'Oficina' ? 'selected' : '' }} >Oficina</option>
                            <option {{ old('lugar_trabajo', $puesto->lugar_trabajo) == 'Cliente' ? 'selected' : '' }}>Cliente</option>
                        </select>
                        @if ($errors->has('lugar_trabajo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('lugar_trabajo') }}
                        </div>
                        @endif
                    </div>

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="sueldo"><i class="fas fa-dollar-sign iconos-crear"></i>Sueldo</label>
                        <input class="form-control {{ $errors->has('sueldo') ? 'is-invalid' : '' }}" type="text" name="sueldo"
                        id="teste" value="{{ old('sueldo', $puesto->sueldo )}}" required>
                        @if ($errors->has('sueldo'))
                            <div class="invalid-feedback">
                                {{ $errors->first('sueldo') }}
                            </div>
                        @endif
                    </div>


                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="horario"><i class="fas fa-business-time iconos-crear"></i>Horario laboral</label>
                               <input  class="form-control {{ $errors->has('horario') ? 'is-invalid' : '' }}" type="text" name="horario"
                                    id="horario" value="{{ old('horario', $puesto->horario) }}" required>
                                @if ($errors->has('horario'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('horario') }}
                                    </div>
                                @endif
                            {{-- <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span> --}}

                    </div>

                </div>
                <div class="row col-12">
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="edad"><i class="fas fa-user iconos-crear"></i>Edad</label>
                        <select class="form-control {{ $errors->has('edad') ? 'is-invalid' : '' }}" name="edad" id="edad_rango">
                            <option value="{{ old('edad', $puesto->edad )}}" selected>Selecciona</option>
                            <option {{ old('edad', $puesto->edad) == 'Indistinto' ? 'selected' : '' }}>Indistinto</option>
                            <option {{ old('edad', $puesto->edad) == 'Rango' ? 'selected' : '' }} value="Rango">Rango</option>
                        </select>
                    </div>

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="genero"><i class="fas fa-restroom iconos-crear"></i>Género</label>
                        <select class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero" id="genero">
                            <option value="{{ old('genero', $puesto->genero )}}" selected>Selecciona</option>
                            <option {{ old('genero', $puesto->genero) == 'Hombre' ? 'selected' : '' }} >Hombre</option>
                            <option {{ old('genero', $puesto->genero) == 'Mujer' ? 'selected' : '' }}>Mujer</option>
                            <option {{ old('genero', $puesto->genero) == 'Indistinto' ? 'selected' : '' }}>Indistinto</option>
                        </select>
                    </div>
                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="estado_civil"><i class=" fas fa-heart iconos-crear"></i>Estado Civil</label>
                        <select class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}" name="estado_civil" id="estado_civil">
                            <option value="{{ old('estado_civil', $puesto->estado_civil)}}" selected>Selecciona</option>
                            <option {{ old('estado_civil', $puesto->estado_civil) == 'Soltero' ? 'selected' : '' }}>Soltero(a)</option>
                            <option {{ old('estado_civil', $puesto->estado_civil) == 'Casado' ? 'selected' : '' }}>Casado(a)</option>
                            <option {{ old('estado_civil', $puesto->estado_civil) == 'Indistinto' ? 'selected' : '' }}>Indistinto</option>
                        </select>
                    </div>
                </div>

                <div class="row col-sm-6 col-md-6 col-lg-6 d-none" id="campos_edad">

                    <div class="form-group col-sm-4 col-md-4 col-lg-4">
                        <label class="required" for="edad_de">De</label>
                            <input  class="form-control {{ $errors->has('edad_de') ? 'is-invalid' : '' }}" type="number" name="edad_de"
                                value="{{ old('edad_de', $puesto->edad_de )}}">
                            @if ($errors->has('edad_de'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('edad_de') }}
                                </div>
                            @endif
                    </div>

                    <div class="form-group col-sm-5 col-md-5 col-lg-5">
                        <label class="required" for="edad_a">A</label>
                        <div style="display:flex;"> <input  class="form-control {{ $errors->has('edad_a') ? 'is-invalid' : '' }}" type="number" name="edad_a"
                              value="{{ old('edad_a', $puesto->edad_a )}}"><strong class="mt-2">&nbsp;&nbsp;&nbsp;Años</strong></div>
                            @if ($errors->has('edad_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('edad_a') }}
                                </div>
                            @endif
                    </div>
                </div>

                <div class="form-group col-12 text-right mt-4" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection


@section('scripts')

    <script type="text/javascript">
        $(document).on('change', '#edad_rango', function(event) {
            if($('#edad_rango option:selected').attr('value') == 'Rango'){
                // console.log('hola');
                $('#campos_edad').removeClass('d-none');
            }else{
                $('#campos_edad').addClass('d-none');
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            CKEDITOR.replace('descripcion', {
                toolbar: [{
                        name: 'styles',
                        items: ['Styles', 'Format', 'Font', 'FontSize']
                    },
                    {
                        name: 'colors',
                        items: ['TextColor', 'BGColor']
                    },
                    {
                        name: 'editing',
                        groups: ['find', 'selection', 'spellchecker'],
                        items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
                    }, {
                        name: 'clipboard',
                        groups: ['undo'],
                        items: ['Undo', 'Redo']
                    },
                    {
                        name: 'tools',
                        items: ['Maximize']
                    },
                    {
                        name: 'basicstyles',
                        groups: ['basicstyles', 'cleanup'],
                        items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript',
                            '-',
                            'CopyFormatting', 'RemoveFormat'
                        ]
                    },
                    {
                        name: 'paragraph',
                        groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                        items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                            'Blockquote',
                            '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight',
                            'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language'
                        ]
                    },
                    {
                        name: 'links',
                        items: ['Link', 'Unlink']
                    },
                    {
                        name: 'insert',
                        items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar']
                    },
                    '/',
                ]
            });

        });

        function initInpusToMoneyFormat() {
            document.querySelectorAll("input[data-type='currency']").forEach(element => {
                formatCurrency($(element));
            })
        }

        function inputsToMoneyFormat() {
            $("input[data-type='currency']").on({
                init: function() {
                    // console.log(this);
                },
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });
        }



    </script>

    {{-- <script>

        $(document).ready(function(){
            var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount:182,
                searchResultLimit:182,
                renderChoiceLimit:182
            });
        });

    </script> --}}

    {{-- <script>
        $(document).ready(function () {
        const lenguajes=@json($idis);
        console.log(lenguajes);
          var count = 1;

         AgregarFilaLenguaje(count);

          functionAgregarFilaLenguaje(number) {
            html = `<tr>
                <td class="col-4">
                <select  class="workingSelect form-control" name="id_language['+number+'][language][]" id="id_language" >`
                lenguajes.forEach(lenguaje=>{
                    html+=`<option value="${lenguaje.id}">${lenguaje.idioma}</option>`
                })
                html+=`</select>
                </td>
                <td><input type="text" name="id_language['+number+'][porcentaje][]" class="form-control" /></td>`;

            if (number > 1) {
              html +=
                '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Eliminar</button></td></tr>';
              $("#user_table tbody").append(html);
            } else {
              html +=
                '<td col-2><button type="button" name="add" id="add" class="btn btn-success">Agregar</button></td></tr>';
              $("#user_table tbody").html(html);
            }
          }

          $(document).on("click", "#add", function () {
            count++;
           AgregarFilaLenguaje(count);
          });

          $(document).on("click", ".remove", function () {
            count--;
            $(this).closest("tr").remove();
          });


        });
      </script> --}}

<script>
    $(document).ready(function () {
    const lenguajes=@json($puesto->language);
    console.log(lenguajes);
      var anadir = 1;

        lenguajes.forEach((lengua,inx) => {
        // console.log(lengua);
        let formleng={
              id:lengua.id,
              languajeIdioma:lengua.id_language,
              porcentaje:lengua.porcentaje,
              nivel:lengua.nivel,
          }
        AgregarFilaLenguaje(inx,formleng);
        anadir ++;
    });


    //   AgregarFilaLenguaje(count,formleng);

      function AgregarFilaLenguaje(count,formleng){
        html = `<tr>
            <td class="col-4" >
            <input type="hidden" name="id_language[${count}][id]" value="${formleng.id?formleng.id:0}">
            <select  class="workingSelect form-control" name="id_language[${count}][language]" id="lenguaje_lenguaje">`
            lenguajes.forEach(lenguaje=>{
                html+=`<option value="${lenguaje.id}">${lenguaje.idioma}</option>`
            })
            html+=`</select>
            </td >
            <td class="col-2" ><input type="text" name="id_language[${count}][porcentaje]" value="${formleng.porcentaje}" id="porcentaje_lenguaje"  class="form-control" /></td>
            <td class="col-4"><select class="workingSelect form-control" name="id_language[${count}][nivel]" value="${formleng.nivel}" id="nivel_lenguaje" ><option value="">Seleccione una opción</option>
            <option  value="Basico" >Básico</option>
            <option  value="Intermedio" >Intermedio</option>
            <option  value="Avanzado" >Avanzado</option>
            </select></td>
            `;


        if (count > 0) {
          html +=
            '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Eliminar</button></td></tr>';
        //   $("#user_table tbody").append(html);
        } else {
          html +=
            '<td col-2><button type="button" name="add" id="add" class="btn btn-success">Agregar</button></td></tr>';
        //   $("#user_table tbody").append(html);
        }
        document.querySelector('#user_table tbody').innerHTML +=html
      }



      $(document).on("click", "#add", function () {

          const languajeIdioma = document.getElementById('lenguaje_lenguaje').value;
          const porcentaje = document.getElementById('porcentaje_lenguaje').value;
          const nivel = document.getElementById('nivel_lenguaje').value;

          let formleng={
              languajeIdioma,
              porcentaje,
              nivel
          }


        AgregarFilaLenguaje(count,formleng);
        anadir++;
      });

      $(document).on("click", ".remove", function () {
        anadir--;
        $(this).closest("tr").remove();
      });


    });
  </script>

<script>
    $(document).ready(function () {
    const responsabilidades=@json($puesto->responsabilidades);
    // console.log(responsabilidades);
      let count = 0;

    //   renderizarTablaResponsabilidades(count);
    // Foreach(item, index cada valor){agregar fila responsabilidad}
    responsabilidades.forEach((responsabilidad,index) => {
        // console.log(responsabilidad);
        let formulario={
              id:responsabilidad.id,
              actividad:responsabilidad.actividad,
              resultado:responsabilidad.resultado,
              indicador:responsabilidad.indicador,
              tiempoAsignado:responsabilidad.tiempo_asignado
          }
        agregarFilaResponsabilidad(index,formulario);
        count ++;
    });


      function agregarFilaResponsabilidad(contador,formulario) {
        //   console.log(formulario)
          const contenedorResponsabilidades=document.getElementById('contenedor_responsabilidades');
          let html=`
          <tr>
            <td><input type="hidden" name="responsabilidades[${contador}][id]" value="${formulario.id?formulario.id:0}"><input class="form-control" type="text"  name="responsabilidades[${contador}][actividad]" value="${formulario.actividad}" style="border:none;" ></td>
            <td><input class="form-control" type="text"  name="responsabilidades[${contador}][resultado]" value="${formulario.resultado}" style="border:none;"></td>
            <td><input class="form-control" type="text"  name="responsabilidades[${contador}][indicador]" value="${formulario.indicador}" style="border:none;"></td>
            <td><input class="form-control" type="text"  name="responsabilidades[${contador}][tiempo_asignado]" value="${formulario.tiempoAsignado}" style="border:none;"></td>
            <td><button type="button" name="btn-remove-responsabilidades" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
         contenedorResponsabilidades.innerHTML += html;
         limpiarFormulario();

        // if (number > 1) {
        //   html +=
        //     '<td><button type="button" name="btn-remove-responsabilidades" id="" class="btn btn-danger remove">Eliminar</button></td></tr>';
        //   $("#responsabilidades_table tbody").append(html);
        // }
      }

      function limpiarFormulario(){
          const actividad = document.getElementById('actividad_responsabilidades').value=null;
          const resultado = document.getElementById('resultado_certificado_responsabilidades').value=null;
          const indicador = document.getElementById('indicador_responsabilidades').value=null;
          const tiempoAsignado = document.getElementById('tiempo_asignado_responsabilidades').value=null;
      }


      $(document).on("click", "#btn-suscribir-responsabilidades", function () {

          const actividad = document.getElementById('actividad_responsabilidades').value;
          const resultado = document.getElementById('resultado_certificado_responsabilidades').value;
          const indicador = document.getElementById('indicador_responsabilidades').value;
          const tiempoAsignado = document.getElementById('tiempo_asignado_responsabilidades').value;
        // index el de la 686 se queda tal cual, y desde la 680 a la 683 colocar los valores desde mi base despues de actividad : color el valor item.y el valor
          let formulario={
              actividad,
              resultado,
              indicador,
              tiempoAsignado
          }


        agregarFilaResponsabilidad(count,formulario);
        count ++;

      });

      $(document).on("click", ".btn-remove-responsabilidades", function () {
        $(this).closest("tr").remove();
        count --;
      });


    });
  </script>

<script>
    $(document).ready(function () {
    //$certificados el nombre de la relacion definida en mi modelo
    const certificados=@json($puesto->certificados);
    // console.log(certificados);
    let sumar = 0;


    // ForEach: Va traer mis datos de la base
    //dentro de mi let formulario va ir
    // 1. nombre asignado de cada campo en la const
    // 2.variable asignada dentro del forEach (certificado)
    //3. Nombre del campo en la base de datos
    //El primer campo que se agrega dentro de mi let es mi id que trae los datos
    certificados.forEach((certificado,ind) => {
        // console.log(certificado);
        let certificacion={
              id:certificado.id,
              nombreCertificado:certificado.nombre,
              requisito:certificado.requisito,

          }
        agregarFilaCertificados(ind,certificacion) ;
        sumar ++;

    });

    function agregarFilaCertificados(contable,certificacion) {
        //   console.log(certificacion)
          const contenedorCertificados=document.getElementById('contenedor_certificados');
          let html=`
          <tr>
            <td><input type="hidden" name="certificados[${contable}][id]" value="${certificacion.id?certificacion.id:0}"><input class="form-control" type="text" name="certificados[${contable}][nombre]" value="${certificacion.nombreCertificado}" style="border:none;"></td>
            <td><input class="form-control" type="text" name="certificados[${contable}][requisito]" value="${certificacion.requisito}"  style="border:none;"></td>
            <td><button type="button" name="btn-remove-certificaciones" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
          contenedorCertificados.innerHTML += html;
          limpiarFormularioCertificados();

        }

        function limpiarFormularioCertificados(){
          const nombreCertificado = document.getElementById('nombre_certificado').value=null;
          const requisito = document.getElementById('requisito_certificado').value=null;
      }


          $(document).on("click", "#btn-suscribir-certificaciones", function () {

            const nombreCertificado = document.getElementById('nombre_certificado').value;
            const requisito = document.getElementById('requisito_certificado').value;


            let certificacion={
                nombreCertificado,
                requisito
            }

            agregarFilaCertificados(sumar,certificacion);
            sumar ++;

         });
        $(document).on("click", ".btn-remove-certificaciones", function () {
            $(this).closest("tr").remove();
            sumar --;
     });
});
  </script>


      <script>

        $(document).ready(function() {
                $("#competencias").select2({
                    theme: "bootstrap4",
                });
            });

     </script>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
        let responsable = document.querySelector('#id_reporta');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');

        document.getElementById('puesto_reviso').innerHTML = puesto_init;
        document.getElementById('area_reviso').innerHTML = area_init;
        responsable.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_reviso').innerHTML = puesto;
            document.getElementById('area_reviso').innerHTML = area;
        })
    })

    </script>


    <script>
        $(document).ready(function() {
            CKEDITOR.replace('estudios', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
            CKEDITOR.replace('experiencia', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
            CKEDITOR.replace('conocimientos', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
            CKEDITOR.replace('certificaciones', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
            CKEDITOR.replace('conocimientos_esp', {
                toolbar: [{
                    name: 'paragraph',
                    groups: ['list', 'indent', 'blocks', 'align'],
                    items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-',
                        'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-',
                        'Bold', 'Italic'
                    ]
                }, {
                    name: 'clipboard',
                    items: ['Link', 'Unlink']
                }, ]
            });
        });

    </script>

    <script>
        $(document).ready(function() {
            $(function() {

                new AutoNumeric('#teste', {

                    decimalCharacter: ',',

                    decimalCharacter: '.',

                    maximumValue: '100000000000',

                    minimumValue: '0.00',

                    currencySymbol: '$',

                    decimalPlacesOverride: 2

                });

            });
        });

    </script>



@endsection



@extends('layouts.admin')
@section('content')

    @can('lista_de_perfiles_de_puesto_agregar')
        {{ Breadcrumbs::render('perfil-puesto-create') }}
        <h5 class="col-12 titulo_general_funcion">Registrar: Puesto</h5>
        <div class="card mt-4">
            <div class="col-md-10 col-sm-9 py-3 card-body verde_silent align-self-center" style="margin-top: -40px;">
                <h3 class="mb-1  text-center text-white"><strong> Registrar: </strong> Perfil de Puesto</h3>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('admin.puestos.store') }}" enctype="multipart/form-data">
                    @csrf


                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Identificación del Puesto</span>
                    </div>

                    <div class="row col-12">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label class="required" for="puesto"><i class="fas fa-briefcase iconos-crear"></i>Nombre del
                                puesto</label>
                            <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" type="text"
                                name="puesto" id="puesto" value="{{ old('puesto', '') }}" required>
                            @if ($errors->has('puesto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('puesto') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
                        </div>

                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="id_area"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <select class="form-control {{ $errors->has('id_area') ? 'is-invalid' : '' }}" name="id_area"
                                id="id_area">
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">
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
                    </div>

                    <div class="row col-12">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="reporta_puesto_id"><i class="fas fa-user-tie iconos-crear"></i>Reportará a</label>
                            <select class="form-control {{ $errors->has('reporta_puesto_id') ? 'is-invalid' : '' }}"
                                name="reporta_puesto_id" id="reporta_puesto_id">
                                <option value="" selected disabled>
                                    -- Selecciona el puesto--
                                </option>
                                @foreach ($puesto as $pues)
                                    <option value="{{ $pues->id }}"
                                        data-area="{{ $pues->area ? $pues->area->area : 'Sin definir' }}">
                                        {{ $pues->puesto }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('puesto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reporta_puesto_id') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-md-6">
                            <label><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_puesto_reporta"></div>

                        </div>

                        <div class="form-group col-md-4 mt-3">
                            <label for="id_area_reviso"><i class="fas fa-users iconos-crear"></i>No de personas a su
                                cargo</label>


                        </div>

                        <div style="display:flex; justify-content:space-between;" class="form-group col-md-4 mt-3">
                            <strong class="mr-2">Internas</strong>
                            <input class="form-control {{ $errors->has('personas_internas') ? 'is-invalid' : '' }}"
                                type="number" name="personas_internas" value="{{ old('personas_internas', '') }}">
                            @if ($errors->has('personas_internas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('personas_internas') }}
                                </div>
                            @endif
                        </div>

                        <div style="display:flex; justify-content:space-between;" class="form-group col-md-4 mt-3">
                            <strong class="mr-2">Externas</strong>
                            <input class="form-control {{ $errors->has('personas_externas') ? 'is-invalid' : '' }}"
                                type="number" name="personas_externas" value="{{ old('personas_externas', '') }}">
                            @if ($errors->has('personas_externas'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('personas_externas') }}
                                </div>
                            @endif

                        </div>
                    </div>



                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Descripción del puesto</span>
                    </div>

                    <div class="row col-12">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <label for="descripcion"><i class="fas fa-clipboard-list iconos-crear"></i>Objetivo
                                general del puesto</label>
                            <textarea class="form-control date" type="text" name="descripcion" id="descripcion" required>
                                            {{ old('descripcion') }}
                                        </textarea>
                            @if ($errors->has('descripcion'))
                                <span class="text-danger">
                                    {{ $errors->first('descripcion') }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Principales responsabilidades</span>
                    </div>

                    <div class="row col-12">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <label for="actividad"><i class="fas fa-file-signature iconos-crear"></i>Actividad</label>
                            <input class="form-control {{ $errors->has('actividad') ? 'is-invalid' : '' }}" type="text"
                                name="actividad" id="actividad_responsabilidades" value="{{ old('actividad', '') }}">
                            <small class="text-danger errores actividad_responsabilidad_error"></small>
                        </div>
                    </div>

                    <div class="row col-12 mt-3">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <label for="resultado"><i class="fas fa-chart-line iconos-crear"></i>Resultado Esperado </label>
                            <textarea class="form-control {{ $errors->has('resultado') ? 'is-invalid' : '' }}" type="text" name="resultado"
                                id="resultado_certificado_responsabilidades">{{ old('resultado', '') }}</textarea>
                            <small class="text-danger errores resultado_responsabilidad_error"></small>
                        </div>


                    </div>

                    <div class="row col-12 mt-3">
                        <div class="col-sm-8 col-lg-8 col-md-8">
                            <label for="indicador"><i class="fas fa-clipboard-check iconos-crear"></i>Cumplimiento</label>
                            <input class="form-control {{ $errors->has('indicador') ? 'is-invalid' : '' }}" type="text"
                                name="indicador" id="indicador_responsabilidades" value="{{ old('indicador', '') }}">
                            <small class="text-danger errores indicador_responsabilidad_error"></small>
                        </div>

                        <div class="col-sm-4 col-lg-4 col-md-4">
                            <label for="tiempo_asignado"><i class="far fa-percent iconos-crear"></i> de tiempo</label>
                            <input class="form-control {{ $errors->has('tiempo_asignado') ? 'is-invalid' : '' }}"
                                type="text" name="tiempo_asignado" id="tiempo_asignado_responsabilidades"
                                value="{{ old('tiempo_asignado', '') }}">
                            <small class="text-danger errores tiempo_responsabilidad_error"></small>
                        </div>
                    </div>



                    <div class="row col-12">
                        <div class="mb-3 mr-4 col-12 mt-4 text-right">
                            <button type="button" name="btn-suscribir-responsabilidades"
                                id="btn-suscribir-responsabilidades" class="btn btn-success">Agregar</button>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                            <table class="table w-100" id="responsabilidades_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Actividad</th>
                                        <th style="min-width:300px;">Resultado Esperado</th>
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

                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Herramientas para desempeñar el puesto</span>
                    </div>


                    <div class="row col-12 mt-3">
                        <div class="col-sm-12 col-lg-12 col-md-12">
                            <label for="nombre_herramienta"><i class="fas fa-tools iconos-crear"></i>Nombre</label>
                            <input class="form-control {{ $errors->has('nombre_herramienta') ? 'is-invalid' : '' }}"
                                type="text" name="nombre_herramienta" id="nombre_herramienta_puesto"
                                value="{{ old('indicador', '') }}">
                            <small class="text-danger errores nombre_herramienta_error"></small>
                        </div>

                        <div class="col-sm-12 col-lg-12 col-md-12 mt-2">
                            <label for="descripcion_herramienta"><i class="fas fa-clipboard-list iconos-crear"></i>Descripción
                                de la herramienta</label>
                            <input class="form-control {{ $errors->has('descripcion_herramienta') ? 'is-invalid' : '' }}"
                                type="text" name="descripcion_herramienta" id="descripcion_herramienta_puesto"
                                value="{{ old('descripcion_herramienta', '') }}">
                            <small class="text-danger errores descripcion_herramienta_error"></small>
                        </div>
                    </div>


                    <div class="row col-12">
                        <div class="mb-3 col-12 mt-4 " style="text-align: end">
                            <button type="button" name="btn-suscribir-herramientas" id="btn-suscribir-herramientas"
                                class="btn btn-success">Agregar</button>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                            <table class="table w-100" id="herramientas_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripción</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedor_herramientas">
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

                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Requisitos y habilidades para el puesto</span>
                    </div>

                    <div class="row col-12 mt-4">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="estudios"><i class="fas fa-graduation-cap iconos-crear"></i>Educación Academica
                                (Estudios)</label>
                            <textarea class="form-control date" type="text" name="estudios" id="estudios">
                                            {{ old('estudios') }}
                                        </textarea>
                            @if ($errors->has('estudios'))
                                <span class="text-danger">
                                    {{ $errors->first('estudios') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="experiencia"><i class="fas fa-briefcase iconos-crear"></i>Experiencia
                                Profesional</label>
                            <textarea class="form-control date" type="text" name="experiencia" id="experiencia">
                                            {{ old('experiencia') }}
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
                            <label for="conocimientos"><i
                                    class="fas fa-chalkboard-teacher iconos-crear"></i>Conocimientos</label>
                            <textarea class="form-control date" type="text" name="conocimientos" id="conocimientos">
                                            {{ old('conocimientos') }}
                                        </textarea>
                            @if ($errors->has('conocimientos'))
                                <span class="text-danger">
                                    {{ $errors->first('conocimientos') }}
                                </span>
                            @endif
                        </div>

                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="entrenamiento"><i class="fa-solid fa-person-running iconos-crear"></i>Entrenamiento
                                recomendado para este rol</label>
                            <textarea class="form-control date" type="text" name="entrenamiento" id="entrenamiento">
                                            {{ old('entrenamiento') }}
                                        </textarea>
                            @if ($errors->has('entrenamiento'))
                                <span class="text-danger">
                                    {{ $errors->first('entrenamiento') }}
                                </span>
                            @endif
                        </div>

                    </div>

                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Idiomas</span>
                    </div>

                    <div class="row col-12">
                        <div class="form-group col-sm-12 col-md-12 col-lg-12">
                            <table class="table" id="user_table">
                                <tbody>
                                    <div class="row col-12">
                                        <label class="col-md-4 col-sm-4" for="working_day" style="text-align:left;"><i
                                                class="fas fa-language iconos-crear"></i>
                                            Idioma</label>
                                        <label class="col-md-4 col-sm-4 " style="margin-left:-5px;" for="working_day"
                                            style="text-align:left;"><i
                                                class="far fa-percent iconos-crear"></i>Porcentaje</label>
                                        <label style="margin-left:-130px;" class="col-md-4 col-sm-4" style="text-align:left;"
                                            for="working_day"><i class="fas fa-graduation-cap iconos-crear"></i>Nivel</label>
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
                            <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                                name="nombre" id="nombre_certificado" value="{{ old('nombre', '') }}">
                            <small class="text-danger errores nombre_certificado_error"></small>
                        </div>


                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="requisito"><i class="fas fa-tasks iconos-crear"></i>Requisito</label>
                            {{-- <select class="form-control {{ $errors->has('requisito') ? 'is-invalid' : '' }}" name="requisito" id="requisito"> --}}
                            <select class="form-control {{ $errors->has('requisito') ? 'is-invalid' : '' }}" name="requisito"
                                id="requisito_certificado">
                                <option value="" selected>Selecciona</option>
                                <option value="Indispensable">Indispensable</option>
                                <option value="Deseable">Deseable</option>
                            </select>
                            <small class="text-danger errores requisito_certificado_error"></small>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="mb-3 col-12 mt-4 " style="text-align: end">
                            <button type="button" name="btn-suscribir-certificaciones" id="btn-suscribir-certificaciones"
                                class="btn btn-success">Agregar</button>
                        </div>
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




                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Datos generales</span>
                    </div>


                    <div class="row col-12 mt-4">
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="lugar_trabajo"><i class="far fa-building iconos-crear"></i>Lugar de trabajo</label>
                            {{-- <select class="form-control {{ $errors->has('lugar_trabajo') ? 'is-invalid' : '' }}" name="lugar_trabajo" id="lugar_trabajo"> --}}
                            <select class="form-control {{ $errors->has('lugar_trabajo') ? 'is-invalid' : '' }}"
                                name="lugar_trabajo" id="lugar_trabajo">
                                <option value="" selected>Selecciona</option>
                                <option value="Home Office">Home Office</option>
                                <option value="Oficina">Oficina</option>
                                <option value="Cliente">Cliente</option>
                            </select>
                            {{-- </select> --}}
                            @if ($errors->has('lugar_trabajo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('lugar_trabajo') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="sueldo"><i class="fas fa-dollar-sign iconos-crear"></i>Sueldo</label>
                            <input class="form-control {{ $errors->has('sueldo') ? 'is-invalid' : '' }}" type="text"
                                name="sueldo" id="teste" value="{{ old('sueldo', '') }}" data-type='currency'>
                            @if ($errors->has('sueldo'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('sueldo') }}
                                </div>
                            @endif
                        </div>


                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="horario"><i class="fas fa-business-time iconos-crear"></i>Horario laboral</label>
                            <input class="form-control {{ $errors->has('horario') ? 'is-invalid' : '' }}" type="type"
                                name="horario" id="horario" value="{{ old('horario', '') }}">
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
                            <label for="edad"><i class="fas fa-user iconos-crear"></i>Edad</label>
                            <select class="form-control {{ $errors->has('edad') ? 'is-invalid' : '' }}" name="edad"
                                id="edad_rango">
                                <option value="" selected>Selecciona</option>
                                <option value="Indistinto">Indistinto</option>
                                <option value="Rango">Rango</option>
                            </select>
                        </div>



                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="genero"><i class="fas fa-restroom iconos-crear"></i>Género</label>
                            <select class="form-control {{ $errors->has('genero') ? 'is-invalid' : '' }}" name="genero"
                                id="genero">
                                <option value="" selected>Selecciona</option>
                                <option value="Hombre">Hombre</option>
                                <option value="Mujer">Mujer</option>
                                <option value="Indistinto">Indistinto</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="estado_civil"><i class=" fas fa-heart iconos-crear"></i>Estado Civil</label>
                            <select class="form-control {{ $errors->has('estado_civil') ? 'is-invalid' : '' }}"
                                name="estado_civil" id="estado_civil">
                                <option value="" selected>Selecciona</option>
                                <option value="Soltero">Soltero(a)</option>
                                <option value="Casado">Casado(a)</option>
                                <option value="Indistinto">Indistinto</option>
                            </select>
                        </div>

                    </div>

                    <div class="row col-sm-6 col-md-6 col-lg-6 d-none" id="campos_edad">

                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="edad_de">De</label>
                            <input class="form-control {{ $errors->has('edad_de') ? 'is-invalid' : '' }}" type="text"
                                name="edad_de" value="{{ old('edad_de', '') }}">
                            @if ($errors->has('edad_de'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('edad_de') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-sm-5 col-md-5 col-lg-5">
                            <label for="edad_a">A</label>
                            <div style="display:flex;"><input
                                    class="form-control {{ $errors->has('edad_a') ? 'is-invalid' : '' }}" type="text"
                                    name="edad_a" value="{{ old('edad_a', '') }}"><strong
                                    class="mt-2">&nbsp;&nbsp;&nbsp;Años</strong></div>
                            @if ($errors->has('edad_a'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('edad_a') }}
                                </div>
                            @endif
                        </div>

                    </div>

                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Contactos del puesto</span>
                    </div>


                    <div class="row col-12 mt-4">
                        <div class="form-group col-sm-6 col-md-6 col-lg-6">
                            <label for="contacto_puesto_id"><i class="fas fa-user-tie iconos-crear"></i>Puesto</label>
                            <select class="form-control {{ $errors->has('contacto_puesto_id') ? 'is-invalid' : '' }}"
                                name="contacto_puesto_id" id="nombre_contacto_puesto">
                                <option value="">
                                    -- Selecciona el contacto asignado --
                                </option>
                                @foreach ($puesto as $pues)
                                    <option value="{{ $pues->id }}"
                                        data-area="{{ $pues->area ? $pues->area->area : 'Sin definir' }}">
                                        {{ $pues->puesto }}
                                    </option>
                                @endforeach
                            </select>
                            <small class="text-danger errores contacto_puesto_error"></small>
                        </div>

                        <div class="form-group col-md-6">
                            <label><i class="fas fa-briefcase iconos-crear"></i>Area</label>
                            <div class="form-control" id="area_contacto"></div>
                            <small class="text-danger errores contacto_area_error"></small>
                        </div>
                    </div>

                    <div class="row col-12 ">
                        <div class="col-sm-12 col-lg-12 col-md-12 mt-2">
                            <label for="contacto"><i class="fas fa-clipboard-list iconos-crear"></i>Propósito del
                                contacto</label>
                            <textarea class="form-control {{ $errors->has('contacto') ? 'is-invalid' : '' }}" name="contacto"
                                id="descripcion_contacto_puesto">{{ old('contacto') }}</textarea>
                            <small class="text-danger errores descripcion_contacto_error"></small>
                        </div>
                    </div>


                    <div class="row col-12">
                        <div class="mb-3 col-12 mt-4 " style="text-align: end">
                            <button type="button" name="btn-suscribir-contactos" id="btn-suscribir-contactos"
                                class="btn btn-success">Agregar</button>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                            <table class="table w-100" id="contactos_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Puesto</th>
                                        <th>Área</th>
                                        <th style="min-width:300px;">Propósito</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedor_contactos">

                                </tbody>
                            </table>
                        </div>
                    </div>


                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Contactos Externos del puesto</span>
                    </div>

                    <div class="row col-12 ">
                        <div class="col-sm-12 col-lg-12 col-md-12 mt-2">
                            <label for="nombre_contacto_int"><i class="fas fa-clipboard-list iconos-crear"></i>Nombre del
                                contacto</label>
                            <input class="form-control {{ $errors->has('nombre_contacto_int') ? 'is-invalid' : '' }}"
                                name="nombre_contacto_int" id="nombre_contacto_int"
                                value="{{ old('nombre_contacto_int') }}">
                            <small class="text-danger errores nombre_contacto_int_error"></small>
                        </div>
                    </div>

                    <div class="row col-12 ">
                        <div class="col-sm-12 col-lg-12 col-md-12 mt-2">
                            <label for="proposito"><i class="fas fa-clipboard-list iconos-crear"></i>Propósito del
                                contacto</label>
                            <textarea class="form-control {{ $errors->has('proposito') ? 'is-invalid' : '' }}" name="proposito"
                                id="proposito_contacto_int">{{ old('proposito') }}</textarea>
                            <small class="text-danger errores proposito_contacto_int_error"></small>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="mb-3 col-12 mt-4 " style="text-align: end">
                            <button type="button" name="btn-suscribir-contactos-externos"
                                id="btn-suscribir-contactos-externos" class="btn btn-success">Agregar</button>
                        </div>
                    </div>

                    <div class="row col-12">
                        <div class="mt-3 mb-4 col-12 w-100 datatable-fix p-0">
                            <table class="table w-100" id="contactos_externos_table" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Contacto</th>
                                        <th style="min-width:300px;">Propósito</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody id="contenedor_contactos_externos">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-4 mb-3 w-100" style="border-bottom: solid 2px #345183;">
                        <span style="font-size: 17px; font-weight: bold;">
                            Responsiva</span>
                    </div>

                    <div class="row col-12">
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="elaboro_id"><i class="fas fa-user-tie iconos-crear"></i>Elaboró</label>
                            <select class="form-control {{ $errors->has('elaboro_id') ? 'is-invalid' : '' }}"
                                name="elaboro_id" id="elaboro_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($empleados as $empleado)
                                    <option data-image="{{ $empleado->foto }}" data-id-empleado="{{ $empleado->id }}"
                                        data-gender="{{ $empleado->genero }}" data-puesto="{{ $empleado->puesto }}"
                                        value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}">
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('elaboro'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('elaboro_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_elaboro"></div>

                        </div>


                        <div class="form-group col-md-4">
                            <label><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_elaboro"></div>

                        </div>
                    </div>


                    <div class="row col-12">
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="autoriza_id"><i class="fas fa-user-tie iconos-crear"></i>Autoriza</label>
                            <select class="form-control {{ $errors->has('autoriza_id') ? 'is-invalid' : '' }}"
                                name="autoriza_id" id="autoriza_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($empleados as $empleado)
                                    <option data-image="{{ $empleado->foto }}" data-puesto="{{ $empleado->puesto }}"
                                        value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}">
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('autoriza'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('autoriza_id') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group col-md-4">
                            <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_autoriza"></div>

                        </div>


                        <div class="form-group col-md-4">
                            <label><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_autoriza"></div>

                        </div>
                    </div>


                    <div class="row col-12">
                        <div class="form-group col-sm-4 col-md-4 col-lg-4">
                            <label for="reviso_id"><i class="fas fa-user-tie iconos-crear"></i>Revisó</label>
                            <select class="form-control {{ $errors->has('reviso_id') ? 'is-invalid' : '' }}" name="reviso_id"
                                id="reviso_id">
                                <option value="" selected disabled>
                                    -- Selecciona el nombre del empleado --
                                </option>
                                @foreach ($empleados as $empleado)
                                    <option data-image="{{ $empleado->foto }}" data-puesto="{{ $empleado->puesto }}"
                                        value="{{ $empleado->id }}" data-area="{{ $empleado->area->area }}">
                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('reviso'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('reviso_id') }}
                                </div>
                            @endif
                        </div>



                        <div class="form-group col-md-4">
                            <label><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_reviso"></div>

                        </div>


                        <div class="form-group col-md-4">
                            <label><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_reviso"></div>

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
    @endcan

@endsection



@section('scripts')
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
                    console.log(this);
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

    <script>
        $(document).ready(function() {
            const lenguajes = @json($idis);
            console.log(lenguajes);
            var count = 1;

            AgregarFilaLenguaje(count);

            functionAgregarFilaLenguaje(number) {
                html =
                    `<tr>
                <td class="col-4">
                <select  class="workingSelect form-control" name="id_language['+number+'][language][]" id="id_language" >`
                lenguajes.forEach(lenguaje => {
                    html += `<option value="${lenguaje.id}">${lenguaje.idioma}</option>`
                })
                html += `</select>
                </td>
                <td><input type="text" name="id_language['+number+'][porcentaje][]" class="form-control" /></td>`;

                if (number > 1) {
                    html +=
                        '<td><button type="button" name="remove" id="remove" class="btn btn-danger remove">Eliminar</button></td></tr>';
                    $("#user_table tbody").append(html);
                } else {
                    html +=
                        '<td col-2><button type="button" name="add" id="add" class="btn btn-success">Agregar</button></td></tr>';
                    $("#user_table tbody").html(html);
                }
            }

            $(document).on("click", "#add", function() {
                count++;
                AgregarFilaLenguaje(count);
            });

            $(document).on("click", ".remove", function() {
                count--;
                $(this).closest("tr").remove();
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            const lenguajes = @json($idis);
            console.log(lenguajes);
            var count = 1;

            AgregarFilaLenguaje(count);

            function AgregarFilaLenguaje(number) {
                html = `<tr>
            <td class="col-4" >
            <input type="hidden" name="id_language[${count}][id]" value="0">
            <select  class="workingSelect form-control" name="id_language[${count}][language]" >`
                lenguajes.forEach(lenguaje => {
                    html += `<option value="${lenguaje.id}">${lenguaje.idioma}</option>`
                })
                html += `</select>
            </td >
            <td class="col-2" ><input type="text" name="id_language[${count}][porcentaje]" class="form-control" /></td>
            <td class="col-4"><select class="workingSelect form-control" name="id_language[${count}][nivel]" id="working_day"><option value="">Seleccione una opción</option>
            <option  value="Basico" >Básico</option>
            <option  value="Intermedio" >Intermedio</option>
            <option  value="Avanzado" >Avanzado</option>
            </select></td>
            `;


                if (number > 1) {
                    html +=
                        '<td><button type="button" name="remove" id="remove" class="btn btn-danger remove">Eliminar</button></td></tr>';
                    $("#user_table tbody").append(html);
                } else {
                    html +=
                        '<td col-2><button type="button" name="add" id="add" class="btn btn-success">Agregar</button></td></tr>';
                    $("#user_table tbody").html(html);
                }
            }

            $(document).on("click", "#add", function() {
                count++;
                AgregarFilaLenguaje(count);
            });

            $(document).on("click", ".remove", function() {
                count--;
                $(this).closest("tr").remove();
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            const herramientas = @json($herramientas);
            console.log(herramientas);
            let agregar = 0;

            function agregarFilaHerramienta(cont, informacion) {
                console.log(informacion)
                const contenedorHerramientas = document.getElementById('contenedor_herramientas');
                let html = `
          <tr>
            <td><input type="hidden" name="herramientas[${cont}][id]" value="${informacion.id?informacion.id:0}"><input class="form-control" type="text"  name="herramientas[${cont}][nombre_herramienta]" value="${informacion.nombreHerramienta}" ></td>
            <td><textarea class="form-control" type="text"  style="min-height: 25px !important;" name="herramientas[${cont}][descripcion_herramienta]" value="">${informacion.descripcionHerramienta}</textarea></td>
            <td><button type="button" name="btn-remove-herramientas" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
                contenedorHerramientas.innerHTML += html;
                limpiarFormularioHerramientas();
            }

            function limpiarFormularioHerramientas() {
                const nombreHerramienta = document.getElementById('nombre_herramienta_puesto').value = null;
                const descripcionHerramienta = document.getElementById('descripcion_herramienta_puesto').value =
                    null;
            }

            function limpiarErroesHerramientas() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerText = null
                })
            }

            $(document).on("click", "#btn-suscribir-herramientas", function() {
                limpiarErroesHerramientas()

                const nombreHerramienta = document.getElementById('nombre_herramienta_puesto').value;
                const descripcionHerramienta = document.getElementById('descripcion_herramienta_puesto')
                    .value;

                if (nombreHerramienta == "" || descripcionHerramienta == "") {
                    if (nombreHerramienta == "") {
                        document.querySelector('.nombre_herramienta_error').innerText =
                            "Debes agregar un nombre de herramienta";
                    }
                    if (descripcionHerramienta == "") {
                        document.querySelector('.descripcion_herramienta_error').innerText =
                            "Debes agregar una descripción";
                    }
                } else {

                    let informacion = {
                        nombreHerramienta,
                        descripcionHerramienta
                    }

                    agregarFilaHerramienta(agregar, informacion);
                    agregar++;
                }

            });
            $(document).on("click", ".btn-remove-herramientas", function() {
                $(this).closest("tr").remove();
                agregar--;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            const responsabilidades = @json($responsabilidades);
            console.log(responsabilidades);
            let count = 0;

            //   renderizarTablaResponsabilidades(count);

            function agregarFilaResponsabilidad(contador, formulario) {
                console.log(formulario)
                const contenedorResponsabilidades = document.getElementById('contenedor_responsabilidades');
                let html = `
          <tr>
            <td><input type="hidden" name="responsabilidades[${contador}][id]" value="${formulario.id?formulario.id:0}"><input class="form-control" type="text"  name="responsabilidades[${contador}][actividad]" value="${formulario.actividad}"></td>
            <td><textarea class="form-control" style="min-height: 25px !important;" type="text" name="responsabilidades[${contador}][resultado]" value="" >${formulario.resultado}</textarea></td>
            <td><input class="form-control" type="text"  name="responsabilidades[${contador}][indicador]" value="${formulario.indicador}" ></td>
            <td><input class="form-control" type="text"  name="responsabilidades[${contador}][tiempo_asignado]" value="${formulario.tiempoAsignado}"></td>
            <td><button type="button" name="btn-remove-responsabilidades" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
                contenedorResponsabilidades.innerHTML += html;
                limpiarFormulario();


            }



            function limpiarFormulario() {
                const actividad = document.getElementById('actividad_responsabilidades').value = null;
                const resultado = document.getElementById('resultado_certificado_responsabilidades').value = null;
                const indicador = document.getElementById('indicador_responsabilidades').value = null;
                const tiempoAsignado = document.getElementById('tiempo_asignado_responsabilidades').value = null;
            }

            function limpiarErroresResponsabilidad() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerText = null
                })
            }


            $(document).on("click", "#btn-suscribir-responsabilidades", function() {
                limpiarErroresResponsabilidad()
                const actividad = document.getElementById('actividad_responsabilidades').value;
                const resultado = document.getElementById('resultado_certificado_responsabilidades').value;
                const indicador = document.getElementById('indicador_responsabilidades').value;
                const tiempoAsignado = document.getElementById('tiempo_asignado_responsabilidades').value;

                if (actividad == "" || resultado == "" || indicador == "" || tiempoAsignado == "") {
                    if (actividad == "") {
                        document.querySelector('.actividad_responsabilidad_error').innerText =
                            "Debes agregar una actividad";
                    }
                    if (resultado == "") {
                        document.querySelector('.resultado_responsabilidad_error').innerText =
                            "Debes agregar un resultado";
                    }
                    if (indicador == "") {
                        document.querySelector('.indicador_responsabilidad_error').innerText =
                            "Debes agregar un indicador";
                    }
                    if (tiempoAsignado == "") {
                        document.querySelector('.tiempo_responsabilidad_error').innerText =
                            "Debes agregar tiempo asignado";
                    }

                } else {
                    let formulario = {
                        actividad,
                        resultado,
                        indicador,
                        tiempoAsignado
                    }


                    agregarFilaResponsabilidad(count, formulario);
                    count++;
                }

            });

            $(document).on("click", ".btn-remove-responsabilidades", function() {
                $(this).closest("tr").remove();
                count--;
            });


        });
    </script>

    <script>
        $(document).ready(function() {
            const certificados = @json($certificados);
            console.log(certificados);
            let sumar = 0;


            function agregarFilaCertificados(contable, certificacion) {
                console.log(certificacion)
                const contenedorCertificados = document.getElementById('contenedor_certificados');
                let html = `
          <tr>
            <td><input type="hidden" name="certificados[${contable}][id]" value="${certificacion.id?certificacion.id:0}"><input class="form-control" type="text" name="certificados[${contable}][nombre]" value="${certificacion.nombreCertificado}"></td>
            <td class="col-4"><select class="form-control" name="certificados[${contable}][requisito]" value="${certificacion.requisito}"><option value="">Seleccione una opción</option>
            <option  ${certificacion.requisito == "Indispensable" ? "selected":''} value="Indispensable" >Indispensable</option>
            <option  ${certificacion.requisito == "Deseable" ? "selected":''} value="Deseable" >Deseable</option>
            </select></td>
            <td><button type="button" name="btn-remove-certificaciones" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
                contenedorCertificados.innerHTML += html;
                limpiarFormularioCertificados();

            }

            function limpiarFormularioCertificados() {
                const nombreCertificado = document.getElementById('nombre_certificado').value = null;
                const requisito = document.getElementById('requisito_certificado').value = null;
            }

            function limpiarErroresCertificacion() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerText = null
                })
            }

            $(document).on("click", "#btn-suscribir-certificaciones", function() {
                limpiarErroresCertificacion()
                const nombreCertificado = document.getElementById('nombre_certificado').value;
                const requisito = document.getElementById('requisito_certificado').value;


                if (nombreCertificado == "" || requisito == "") {
                    if (nombreCertificado == "") {
                        document.querySelector('.nombre_certificado_error').innerText =
                            "Debes agregar un nombre de certificado";
                    }
                    if (requisito == "") {
                        document.querySelector('.requisito_certificado_error').innerText =
                            "Debes seleccionar un requisito";
                    }

                } else {
                    let certificacion = {
                        nombreCertificado,
                        requisito
                    }

                    agregarFilaCertificados(sumar, certificacion);
                    sumar++;
                }


            });
            $(document).on("click", ".btn-remove-certificaciones", function() {
                $(this).closest("tr").remove();
                sumar--;
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            const puesto = @json($puesto);
            const contactos = @json($contactos);
            console.log(contactos);
            let fila = 0;


            function agregarFilaContactos(contable, contact) {
                console.log(contact)
                const contenedorContactos = document.getElementById('contenedor_contactos');
                let html =
                    `
          <tr>
            <td><input type="hidden" name="contactos[${contable}][id]"  value="${contact.id?contact.id:0}"><select class="form-control" value="${contact.puestoContacto}" name="contactos[${contable}][contacto_puesto_id]">`
                puesto.forEach(pues => {
                    html +=
                        `<option data-puesto="${pues.puesto}" data-contact="${contact.id}" value="${pues.id}" ${contact.puestoContacto ==  pues.id ? "selected":''} >${pues.puesto}</option>`
                })
                html += `</select>
            </td >
            <td><div class="form-control" style="white-space:nowrap" id="puesto${contact.id}">${contact.areaContacto}</div>
            <td><textarea class="form-control" style="min-height: 25px !important;" type="text" name="contactos[${contable}][descripcion_contacto]" value="" >${contact.descripcionContacto }</textarea></td>
            <td><button type="button"  name="btn-remove-contactos" id="" class="btn btn-danger remove">Eliminar</button></td>
         </tr>
          `
                contenedorContactos.innerHTML += html;
                limpiarFormularioContactos();

            }

            function limpiarFormularioContactos() {
                //   const puestoContacto = document.getElementById('puesto_contacto_puesto').value=null;
                const puestoContacto = document.getElementById('nombre_contacto_puesto').value = null;
                const areaContacto = document.getElementById('area_contacto').innerText = null;
                const descripcionContacto = document.getElementById('descripcion_contacto_puesto').value = null;
            }

            function limpiarErrores() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerText = null
                })
            }

            $(document).on("click", "#btn-suscribir-contactos", function() {
                limpiarErrores()
                // const puestoContacto = document.getElementById('puesto_contacto_puesto').value;
                const puestoContacto = document.getElementById('nombre_contacto_puesto').value;
                const areaContacto = document.getElementById('area_contacto').innerText;
                const descripcionContacto = document.getElementById('descripcion_contacto_puesto').value;

                if (puestoContacto == "" || puestoContacto == "" || descripcionContacto == "") {
                    if (puestoContacto == "") {
                        document.querySelector('.contacto_puesto_error').innerText =
                            "Debes seleccionar un puesto";
                    }
                    if (areaContacto == "") {
                        document.querySelector('.contacto_area_error').innerText =
                            "Debes seleccionar un puesto";
                    }
                    if (descripcionContacto == "") {
                        document.querySelector('.descripcion_contacto_error').innerText =
                            "Debes agregar un propósito";
                    }
                } else {
                    let contact = {
                        // puestoContacto,
                        puestoContacto,
                        areaContacto,
                        descripcionContacto
                    }

                    agregarFilaContactos(fila, contact);
                    fila++;
                }

            });

            //  tagName etiquetas HTML en la linea del IF entro al SELECT  si tuviera dos SELECT tendría que
            // darle un DATA ATTRIBUTE al select y especificarlo ahi en la linea del if con un &
            document.getElementById('contactos_table').addEventListener('change', function(e) {
                console.log(e.target.tagName);
                if (e.target.tagName == 'SELECT') {
                    const area = e.target.options[e.target.selectedIndex].getAttribute('data-area');
                    const contact = e.target.options[e.target.selectedIndex].getAttribute('data-contact');
                    document.getElementById(`puesto${contact}`).innerText = area;
                }

            })


            $(document).on("click", ".btn-remove-contactos", function() {
                $(this).closest("tr").remove();
                fila--;
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            const externos = @json($externos);
            let sumar = 0;


            function agregarFilaContactosExternos(contable, contactosexternos) {
                console.log(contactosexternos)
                const contenedorContactosExternos = document.getElementById('contenedor_contactos_externos');
                let html = `
                <tr>
                  <td><input type="hidden" name="externos[${contable}][id]" value="${contactosexternos.id?contactosexternos.id:0}"><input class="form-control" type="text" name="externos[${contable}][nombre_contacto_int]" value="${contactosexternos.nombreContactoExterno}"></td>
                  <td><textarea class="form-control" style="min-height: 25px !important;" type="text" name="externos[${contable}][proposito]" value="" >${contactosexternos.propositoContactoExterno}</textarea></td>
                  <td><button type="button" name="btn-remove-contactos-externos" id="" class="btn btn-danger remove">Eliminar</button></td>
               </tr>
                `

                contenedorContactosExternos.innerHTML += html;
                limpiarFormularioContactosExternos();

            }

            function limpiarFormularioContactosExternos() {
                const nombreContactoExterno = document.getElementById('nombre_contacto_int').value = null;
                const propositoContactoExterno = document.getElementById('proposito_contacto_int').value = null;
            }

            function limpiarErroresContactosExternos() {
                document.querySelectorAll('.errores').forEach(item => {
                    item.innerText = null
                })
            }

            $(document).on("click", "#btn-suscribir-contactos-externos", function() {
                limpiarErroresContactosExternos()
                const nombreContactoExterno = document.getElementById('nombre_contacto_int').value;
                const propositoContactoExterno = document.getElementById('proposito_contacto_int').value;


                if (nombreContactoExterno == "" || propositoContactoExterno == "") {
                    if (nombreContactoExterno == "") {
                        document.querySelector('.nombre_contacto_int_error').innerText =
                            "Debes agregar un contacto";
                    }
                    if (propositoContactoExterno == "") {
                        document.querySelector('.proposito_contacto_int_error').innerText =
                            "Debes agregar un propósito";
                    }

                } else {
                    let contactosexternos = {
                        nombreContactoExterno,
                        propositoContactoExterno
                    }

                    agregarFilaContactosExternos(sumar, contactosexternos);
                    sumar++;
                }


            });
            $(document).on("click", ".btn-remove-contactos-externos", function() {
                $(this).closest("tr").remove();
                sumar--;
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




    {{-- <script>
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

    </script> --}}


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let elaboro = document.querySelector('#elaboro_id');
            let area_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-area');
            let puesto_init = elaboro.options[elaboro.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_elaboro').innerHTML = puesto_init;
            document.getElementById('area_elaboro').innerHTML = area_init;
            elaboro.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_elaboro').innerHTML = puesto;
                document.getElementById('area_elaboro').innerHTML = area;
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let autoriza = document.querySelector('#autoriza_id');
            let area_init = autoriza.options[autoriza.selectedIndex].getAttribute('data-area');
            let puesto_init = autoriza.options[autoriza.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_autoriza').innerHTML = puesto_init;
            document.getElementById('area_autoriza').innerHTML = area_init;
            autoriza.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_autoriza').innerHTML = puesto;
                document.getElementById('area_autoriza').innerHTML = area;
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let reviso = document.querySelector('#reviso_id');
            let area_init = reviso.options[reviso.selectedIndex].getAttribute('data-area');
            let puesto_init = reviso.options[reviso.selectedIndex].getAttribute('data-puesto');

            document.getElementById('puesto_reviso').innerHTML = puesto_init;
            document.getElementById('area_reviso').innerHTML = area_init;
            reviso.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
                document.getElementById('puesto_reviso').innerHTML = puesto;
                document.getElementById('area_reviso').innerHTML = area;
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let reportapuesto = document.querySelector('#reporta_puesto_id');
            let area_init = reportapuesto.options[reportapuesto.selectedIndex].getAttribute('data-area');

            document.getElementById('area_puesto_reporta').innerHTML = area_init;
            reportapuesto.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                document.getElementById('area_puesto_reporta').innerHTML = area;
            })
        })
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let contacto = document.querySelector('#nombre_contacto_puesto');
            let area_init = contacto.options[contacto.selectedIndex].getAttribute('data-area');

            document.getElementById('area_contacto').innerHTML = area_init;
            contacto.addEventListener('change', function(e) {
                e.preventDefault();
                let area = this.options[this.selectedIndex].getAttribute('data-area');
                document.getElementById('area_contacto').innerHTML = area;
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


            CKEDITOR.replace('entrenamiento', {
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

    <script type="text/javascript">
        $(document).on('change', '#edad_rango', function(event) {
            if ($('#edad_rango option:selected').attr('value') == 'Rango') {
                $('#campos_edad').removeClass('d-none');
            } else {
                $('#campos_edad').addClass('d-none');
            }
        });
    </script>

    <script type="module">
        import {
            formatNumber,
            formatCurrency
        } from "{{ asset('js/money-format/moneyInput.js') }}";

        document.addEventListener('DOMContentLoaded', function() {
            initInpusToMoneyFormat();
            inputsToMoneyFormat();
        })

        function initInpusToMoneyFormat() {
            document.querySelectorAll("input[data-type='currency']").forEach(element => {
                formatCurrency($(element));
            })
        }

        function inputsToMoneyFormat() {
            $("input[data-type='currency']").on({
                init: function() {},
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() {
                    formatCurrency($(this), "blur");
                }
            });
        }
    </script>
@endsection

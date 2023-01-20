@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Activo de Información</h5>
    <div class="mt-4 card">
        <form method="POST" action="{{ route("admin.activosInformacion.update",$activos)}}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
                <div class="mt-5">
                    @include('admin.OCTAVE.menu')
                </div>
                {{-- Informacion General --}}
                <div class="col-12">
                        <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                            Información General
                        </div>
                    <div class="row">
                        <input type="hidden" name="matriz_id" value="{{$matriz}}"/>
                        <div class="form-group col-sm-3">
                            <label for="identificador"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                            <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="identificador" id="identificador" value="{{ old('identificador', $activos->identificador) }}">
                            <small id="identificador" class="text-danger"></small>
                        </div>
                        <div class="form-group col-sm-9">
                            <label for="activo_informacion"><i class="fas fa-folder-plus iconos-crear"></i>Activo de información</label>
                            <input class="form-control {{ $errors->has('activo_informacion') ? 'is-invalid' : '' }}" type="text"
                                name="activo_informacion" id="activo_informacion" value="{{ old('activo_informacion', $activos->activo_informacion)}}">
                        </div>
                    </div>
                    <div class="form-group col-sm-12 multi_select_box">
                        <label for="contenedores" class="required"><i class="fas fa-boxes iconos-crear"></i>Contenedor asociado al activo</label>
                        <select class="multi_select select2 col-sm-12" multiple size="3" name="contenedores[]" required>
                            @foreach ($contenedores as $contenedor)
                            <option value="{{$contenedor->id}}" data-riesgo="{{$contenedor->riesgo}}"
                                {{ in_array(old('contenedores[]',$contenedor->id),$activos->contenedores->pluck('id')->toArray()) == $contenedor->id ? 'selected' : '' }}>{{$contenedor->nom_contenedor}}</option>
                            @endforeach
                          </select>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="nombreVP"><i class="fas fa-list-ol iconos-crear"></i>Nombre VP</label>
                            <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="nombreVP" id="nombreVP" value="{{ old('nombreVP', $activos->nombreVP) }}">
                            <small id="nombreVP" class="text-danger"></small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="duenoVP"><i class="fas fa-user-tie iconos-crear"></i>Dueño AI Nombre del VP</label>
                            <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                name="duenoVP" id="duenoVP">
                                @foreach ($empleados as $empleado)
                                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                        data-area="{{ $empleado->area->area }}"  {{ old('duenoVP', $activos->duenoVP) == $empleado->id ? 'selected' : '' }}>

                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('empleados'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_puesto_responsable"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_responsable"></div>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="id_area_responsable"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_responsable"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label for="nombre_direccion"><i class="fas fa-list-ol iconos-crear"></i>Nombre Dirección</label>
                            <input class="form-control {{ $errors->has('banco') ? 'is-invalid' : '' }}" type="text" name="nombre_direccion" id="nombre_direccion" value="{{ old('nombre_direccion', $activos->nombre_direccion)}}">
                            <small id="error_banco" class="text-danger"></small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="custodioALDirector"><i class="fas fa-user-tie iconos-crear"></i>Custodio AI Nombre Director</label>
                            <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                name="custodioALDirector" id="custodioALDirector">
                                @foreach ($empleados as $empleado)
                                    <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                        data-area="{{ $empleado->area->area }}"
                                        {{ old('custodioALDirector', $activos->custodioALDirector) == $empleado->id ? 'selected' : '' }}>

                                        {{ $empleado->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('empleados'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="puesto_custodio"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                            <div class="form-control" id="puesto_custodio"></div>

                        </div>
                        <div class="form-group col-md-4">
                            <label for="area_custodio"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                            <div class="form-control" id="area_custodio"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-4">
                                    <label for="proceso_id"><i class="bi bi-file-earmark-post iconos-crear"></i>Proceso</label>
                                        <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                                            name="proceso_id" id="proceso_id">
                                            @foreach ($procesos as $proceso)
                                                <option data-codigo="{{ $proceso->codigo }}" value="{{ $proceso->id }}"
                                                    data-macroproceso="{{ $proceso->macroproceso->nombre }}"
                                                    {{ old('proceso_id', $activos->proceso_id) == $proceso->id ? 'selected' : '' }}>
                                                    {{ $proceso->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @if ($errors->has('empleados'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('area') }}
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="codigo_proceso"><i class="fas fa-barcode iconos-crear" style="margin-top: 8px"></i>Codigo</label>
                                    <div class="form-control" id="codigo_proceso"></div>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="macroproceso"><i class="bi bi-file-earmark-post-fill iconos-crear"></i>Macroproceso</label>
                                    <div class="form-control" id="macroproceso"></div>
                                </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="formato"><i class="fas fa-file-contract iconos-crear"></i>Formato</label>
                            <input class="form-control {{ $errors->has('formato') ? 'is-invalid' : '' }}" type="text"
                                name="formato" id="formato" value="{{ old('formato', $activos->formato)}}">
                        </div>
                    </div>
                </div>
                {{-- 1 Creas/Reccibes --}}
                <div class="col-12">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                        1. ¿ A través de que medio CREAS al interno o RECIBES de un tercero el activo de información?
                    </div>
                    <p style="text-align: center">
                        <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Se Crea
                        </a>
                        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample1" aria-expanded="false" aria-controls="collapseExample">
                        Se Recibe
                        </button>
                    </p>
                    <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                Creación digital
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="1"
                                {{old('creacion',$activos->creacion) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion1">
                                    Aplicación de negocio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="2"
                                {{old('creacion',$activos->creacion) == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Google Workspace
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="3"
                                {{old('creacion',$activos->creacion) == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Paquetería multimedia
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="4"
                                {{old('creacion',$activos->creacion) == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Escaneo
                                </label>
                            </div><br>
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                Creación física
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="creacion" id="creacion" value="5"
                                {{old('creacion',$activos->creacion) == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="creacion">
                                    Manualmente
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapseExample1">
                        <div class="card card-body">
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                    Recepción digital
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="1"
                                {{old('recepcion',$activos->recepcion) == '1' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Aplicación de negocio
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="2"
                                {{old('recepcion',$activos->recepcion) == '2' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion2">
                                    Mail corporativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion3" value="3"
                                {{old('recepcion',$activos->recepcion) == '3' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Mail personal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="4"
                                {{old('recepcion',$activos->recepcion) == '4' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Carpeta compartida
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="5"
                                {{old('recepcion',$activos->recepcion) == '5' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Medio extraíble
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="6"
                                {{old('recepcion',$activos->recepcion) == '6' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Página web
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="7"
                                {{old('recepcion',$activos->recepcion) == '7' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                    Vía telefónica
                                </label>
                            </div>
                            <div class="mt-4 text-center form-group" style="background-color:rgb(33, 129, 207); border-radius: 100px; color: white;">
                                Recepción física
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="8"
                                {{old('recepcion',$activos->recepcion) == '8' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                Entrega personal
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="9"
                                {{old('recepcion',$activos->recepcion) == '9' ? 'checked' : '' }}>
                                <label class="form-check-label" for="recepcion">
                                Mensajería externa
                                </label>
                            </div>

                            <div class="form-check">
                                    <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="10"
                                    {{old('recepcion',$activos->recepcion) == '10' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="recepcion">Otro
                            </div>
                            {{-- <input type="text" class="form-control"  placeholder="Ingresa el medio de recepción"> --}}
                            <br>
                        </div>
                    </div>


                </div>
                {{-- 2 Usas/tratas --}}
                <div class="col-12">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    2. ¿A través de que medio USAS / TRATAS el activo de información?
                    </div>

                    <div class="form-group">
                    <label for="uso_digital">Uso digital</label>
                        <select class="custom-select my-1 mr-sm-2" id="uso_digital" name="uso_digital">
                        <option value='1' {{old('uso_digital',$activos->uso_digital) == '1' ? 'selected' : '' }}>Aplicación de negocio</option>
                        <option value="2" {{old('uso_digital',$activos->uso_digital) == '2' ? 'selected' : '' }}>Google Workspace</option>
                        <option value="3" {{old('uso_digital',$activos->uso_digital) == '3' ? 'selected' : '' }}>Paquetería multimedia</option>
                        <option value="4" {{old('uso_digital',$activos->uso_digital) == '4' ? 'selected' : '' }}>Carpeta compartida</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre_aplicacion">Nombre aplicación (si aplica)</label>
                        <input type="text" class="form-control" id="nombre_aplicacion" name="nombre_aplicacion" placeholder="..." value="{{ old('nombre_aplicacion', $activos->nombre_aplicacion)}}">
                    </div>
                    <div class="form-group">
                        <label for="carpeta_compartida">Nombre carpeta compartida (si aplica)</label>
                        <input type="text" class="form-control" id="carpeta_compartida" name="carpeta_compartida" placeholder="..." value="{{ old('carpeta_compartida', $activos->carpeta_compartida)}}">
                    </div>
                    <div class="form-group">
                        <label for="otra_AppCarpeta">Otra Aplicación/carpeta</label>
                        <input type="text" class="form-control" id="otra_AppCarpeta" name="otra_AppCarpeta" placeholder="..." value="{{ old('otra_AppCarpeta', $activos->otra_AppCarpeta)}}">
                    </div>

                    <div class="form-group">
                        <label for="imprime">¿Se imprime?</label>
                        <select class="custom-select my-1 mr-sm-2" id="name" name="imprime">
                            <option value="no" {{old('imprime',$activos->imprime) == 'no' ? 'selected' : '' }}>No</option>
                            <option value="si" {{old('imprime',$activos->imprime) == 'si' ? 'selected' : '' }}>Si</option>
                        </select>
                    </div>


                </div>
                {{-- 3 Envias/Guardas --}}
                <div class="col-12">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                        3. ¿A través de que medio ENVÍAS / TRANSPORTAS el activo de información?
                    </div>
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                        <div class="card-header" id="headingOne">
                            <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left  collapsed" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Interno
                            </button>
                            </h2>
                        </div>
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="direccion_envio">Nombre Dirección</label>
                                        <select class="custom-select my-1 mr-sm-2" id="direccion_envio" name="direccion_envio">
                                            <option value="1" {{old('direccion_envio',$activos->direccion_envio) == '1' ? 'selected' : '' }}>Dirección 1</option>
                                            <option value="2" {{old('direccion_envio',$activos->direccion_envio) == '2' ? 'selected' : '' }}>Dirección 2</option>
                                            <option value="3" {{old('direccion_envio',$activos->direccion_envio) == '3' ? 'selected' : '' }}>Dirección 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="vp_envio"><i class="fas fa-list-ol iconos-crear"></i>Nombre VP</label>
                                        <select class="custom-select my-1 mr-sm-2" id="vp_envio" name="vp_envio">
                                            <option value="1" {{old('vp_envio',$activos->vp_envio) == '1' ? 'selected' : '' }}>Vicepresidencia 1</option>
                                            <option value="2" {{old('vp_envio',$activos->vp_envio) == '2' ? 'selected' : '' }}>Vicepresidencia 2</option>
                                            <option value="3" {{old('vp_envio',$activos->vp_envio) == '3' ? 'selected' : '' }}>Vicepresidencia 3</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-body">
                                        <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                            Envío digital
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="1"
                                            {{old('envio_digital',$activos->envio_digital) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Aplicación de negocio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="2"
                                            {{old('envio_digital',$activos->envio_digital) == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Mail coorporativo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="3"
                                            {{old('envio_digital',$activos->envio_digital) == '3' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Medio extraíble
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="4"
                                            {{old('envio_digital',$activos->envio_digital) == '4' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Mail personal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="5"
                                            {{old('envio_digital',$activos->envio_digital) == '5' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Carpeta compartida
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="6"
                                            {{old('envio_digital',$activos->envio_digital) == '6' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Google Workspace
                                            </label>
                                        </div><br>
                                        <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                            Envío físico
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="7"
                                            {{old('envio_digital',$activos->envio_digital) == '7' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Envío personal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="8"
                                            {{old('envio_digital',$activos->envio_digital) == '8' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Mensajería interna
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="9"
                                            {{old('envio_digital',$activos->envio_digital) == '9' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_digital">
                                                Mensajería externa
                                            </label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="otro_envio_digital"><i class="fas fa-folder-plus iconos-crear"></i>Otro</label>
                                        <input class="form-control {{ $errors->has('aotro_envio_digital') ? 'is-invalid' : '' }}" type="text"
                                            name="otro_envio_digital" id="otro_envio_digital" value="{{ old('otro_envio_digital', $activos->otro_envio_digital)}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="informacion_total">¿Requiere la información en su totalidad?</label>
                                        <select class="custom-select my-1 mr-sm-2" id="informacion_total" name="informacion_total">
                                            <option value="Si" {{old('informacion_total',$activos->informacion_total) == 'Si' ? 'selected' : '' }}>Si</option>
                                            <option value="No" {{old('informacion_total',$activos->informacion_total) == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="card">
                        <div class="card-header" id="headingTwo">
                            <h2 class="mb-0">
                            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Externo
                            </button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="proveedor_envio"><i class="fas fa-folder-plus iconos-crear"></i>Proveedor</label>
                                        <input class="form-control {{ $errors->has('proveedor_envio') ? 'is-invalid' : '' }}" type="text"
                                            name="proveedor_envio" id="proveedor_envio">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="card-body">
                                        <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                            Envío digital
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="1"
                                            {{old('envio_ext',$activos->envio_ext) == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Aplicación de negocio
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="2"
                                            {{old('envio_ext',$activos->envio_ext) == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Mail coorporativo
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="3"
                                            {{old('envio_ext',$activos->envio_ext) == '3' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Medio extraíble
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="4"
                                            {{old('envio_ext',$activos->envio_ext) == '4' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Mail personal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="5"
                                            {{old('envio_ext',$activos->envio_ext) == '5' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Carpeta compartida
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="6"
                                            {{old('envio_ext',$activos->envio_ext) == '6' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Google Workspace
                                            </label>
                                        </div><br>
                                        <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                            Envío físico
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="7"
                                            {{old('envio_ext',$activos->envio_ext) == '7' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Envío personal
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="8"
                                            {{old('envio_ext',$activos->envio_ext) == '8' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Mensajería interna
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="9"
                                            {{old('envio_ext',$activos->envio_ext) == '9' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="envio_ext">
                                                Mensajería externa
                                            </label>
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="form-group col-sm-6">
                                        <label for="otro_envioExt"><i class="fas fa-folder-plus iconos-crear"></i>Otro</label>
                                        <input class="form-control {{ $errors->has('tro_envioExt') ? 'is-invalid' : '' }}" type="text"name="otro_envioExt" id="otro_envioExt"
                                        value="{{ old('otro_envioExt', $activos->otro_envioExt)}}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="informacion_totalExt"> ¿Requiere la información en su totalidad?</label>
                                        <select class="custom-select my-1 mr-sm-2" id="informacion_totalExt" name="informacion_totalExt">
                                            <option value="Si" {{old('informacion_totalExt',$activos->informacion_totalExt) == 'Si' ? 'selected' : '' }}>Si</option>
                                            <option value="No" {{old('informacion_totalExt',$activos->informacion_totalExt) == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <label for="acceso_informacionExt"> ¿Tiene acceso a todos los medios requeridos por su operación para transmitir la información?</label>
                                        <select class="custom-select my-1 mr-sm-2" id="acceso_informacionExt" name="acceso_informacionExt">
                                            <option value="Si" {{old('acceso_informacionExt',$activos->acceso_informacionExt) == 'Si' ? 'selected' : '' }}>Si</option>
                                            <option value="No" {{old('acceso_informacionExt',$activos->acceso_informacionExt) == 'No' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="requiere_info"><i class="fas fa-folder-plus iconos-crear"></i>En caso de no tener acceso, ¿qué accesos se requieren?
                                        </label>
                                        <input class="form-control {{ $errors->has('requiere_info') ? 'is-invalid' : '' }}" type="text"
                                            name="requiere_info" id="requiere_info" value="{{ old('requiere_info', $activos->requiere_info)}}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
                {{-- 4 Almacenas/resguardas --}}
                <div class="col-12">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                        4. ¿A través de que medio ALMACENAS / RESGUARDAS el activo de información?
                    </div>
                        <div class="accordion1" id="accordionAlmacenamiento">
                            <div class="card">
                            <div class="card-header" id="AlmacenamientoOne">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#AlmacenamientoOne" aria-expanded="true" aria-controls="AlmacenamientoOne">
                                    Almacenamiento Digital
                                </button>
                                </h2>
                            </div>

                            <div id="AlmacenamientoOne" class="collapse show" aria-labelledby="AlmacenamientoheadingOne" data-parent="#accordionAlmacenamiento">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="almacenamiento_digital">Uso digital</label>
                                            <select class="custom-select my-1 mr-sm-2" id="almacenamiento_digital" name="almacenamiento_digital">
                                            <option value="1" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '1' ? 'selected' : '' }}>Aplicación de negocio</option>
                                            <option value="2" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '2' ? 'selected' : '' }}>Google Workspace</option>
                                            <option value="3" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '3' ? 'selected' : '' }}>Equipo de cómputo</option>
                                            <option value="4" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '4' ? 'selected' : '' }}>Carpeta compartida</option>
                                            <option value="5" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '5' ? 'selected' : '' }}>Medio extraíble</option>
                                            <option value="6" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '6' ? 'selected' : '' }}>Mail corporativo</option>
                                            <option value="7" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '7' ? 'selected' : '' }}>Mail personal</option>
                                            <option value="8" {{old('almacenamiento_digital',$activos->almacenamiento_digital) == '8' ? 'selected' : '' }}>Dispositivo móvil</option>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="almacenamiento_aplicacion">Nombre aplicación (si aplica)</label>
                                        <select class="custom-select my-1 mr-sm-2" id="almacenamiento_aplicacion" name="almacenamiento_aplicacion">
                                            <option value="1" {{old('almacenamiento_aplicacion',$activos->almacenamiento_aplicacion) == '1' ? 'selected' : '' }}>Aplicación 1</option>
                                            <option value="2" {{old('almacenamiento_aplicacion',$activos->almacenamiento_aplicacion) == '2' ? 'selected' : '' }}>Aplicación 2</option>
                                            <option value="3" {{old('almacenamiento_aplicacion',$activos->almacenamiento_aplicacion) == '3' ? 'selected' : '' }}>Aplicación 3</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="carpeta_compartida_almacenamiento">Nombre carpeta compartida (si aplica)</label>
                                        <input type="text" class="form-control" id="carpeta_compartida_almacenamiento" name="carpeta_compartida_almacenamiento" value="{{ old('carpeta_compartida_almacenamiento', $activos->carpeta_compartida_almacenamiento)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="otra_AppCarpeta_almacenamiento">Otra Aplicación/carpeta</label>
                                        <input type="text" class="form-control" id="otra_AppCarpeta_almacenamiento" name="otra_AppCarpeta_almacenamiento" value="{{ old('otra_AppCarpeta_almacenamiento', $activos->otra_AppCarpeta_almacenamiento)}}">
                                    </div>
                                </div>
                            </div>
                            </div>

                            <div class="card">
                            <div class="card-header" id="AlmacenamientoTwo">
                                <h2 class="mb-0">
                                <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#AlmacenamientoTwo" aria-expanded="false" aria-controls="AlmacenamientoTwo">
                                    Almacenamiento Físico
                                </button>
                                </h2>
                            </div>
                            <div id="AlmacenamientoTwo" class="collapse" aria-labelledby="AlmacenamientoheadingTwo" data-parent="#accordionAlmacenamiento">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="almacenamiento_fisico">Almacenamiento físico</label>
                                        <select class="custom-select my-1 mr-sm-2" id="almacenamiento_fisico" name="almacenamiento_fisico">
                                            <option value="1" {{old('almacenamiento_fisico',$activos->almacenamiento_fisico) == '1' ? 'selected' : '' }}>Mobiliario</option>
                                            <option value="2" {{old('almacenamiento_fisico',$activos->almacenamiento_fisico) == '2' ? 'selected' : '' }}>Archivero</option>
                                            <option value="3" {{old('almacenamiento_fisico',$activos->almacenamiento_fisico) == '3' ? 'selected' : '' }}>Bóveda</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="otro_almacenamiento_fisico">Otro</label>
                                        <input type="text" class="form-control" id="otro_almacenamiento_fisico" name="otro_almacenamiento_fisico" value="{{ old('otro_almacenamiento_fisico', $activos->otro_almacenamiento_fisico)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ubicacion_fisica">Ubicación física donde se almacena</label>
                                        <input type="text" class="form-control" id="ubicacion_fisica" name="ubicacion_fisica" value="{{ old('ubicacion_fisica', $activos->ubicacion_fisica)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="almacenamiento_acceso">
                                            ¿Tiene acceso a todos los medios requeridos por su operación para almacenar la información?</label>
                                        <select class="custom-select my-1 mr-sm-2" id="almacenamiento_acceso" name="almacenamiento_acceso">
                                            <option value="Si" {{old('almacenamiento_acceso',$activos->almacenamiento_acceso) == '1' ? 'selected' : '' }}>Si</option>
                                            <option value="No" {{old('almacenamiento_acceso',$activos->almacenamiento_acceso) == '2' ? 'selected' : '' }}>No</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="acceso_requerido">En caso de no tener acceso, ¿qué accesos se requieren?</label>
                                        <input type="text" class="form-control" id="acceso_requerido" name="acceso_requerido" value="{{ old('acceso_requerido', $activos->acceso_requerido)}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="tiempo_almacenamiento">Tiempo de almacenamiento (con base a regulaciones, reglas internas y/o necesidades de negocio)</label>
                                        <input type="text" class="form-control" id="tiempo_almacenamiento" name="tiempo_almacenamiento" value="{{ old('tiempo_almacenamiento', $activos->tiempo_almacenamiento)}}">
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>

                </div>
                {{-- 5 BORRAS / DESTRUYES --}}
                <div class="col-12" id="contenedor-activos">
                    <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                        5. ¿A través de que medio BORRAS / DESTRUYES el activo de información?
                    </div>
                    {{-- Formulario --}}
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="destruye">Se destruye una vez concluido su uso</label>
                                <select class="custom-select my-1 mr-sm-2" id="destruye" name="destruye">
                                <option value="Si" {{old('destruye',$activos->destruye) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="No" {{old('destruye',$activos->destruye) == '2' ? 'selected' : '' }}>No</option>
                                </select>
                        </div>
                        <div class="form-group col-12">
                            <label for="eliminacion_digital">Eliminación digital</label>
                            <input type="text" class="form-control" id="eliminacion_digital" name="eliminacion_digital" value="{{ old('eliminacion_digital', $activos->eliminacion_digital)}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="eliminacion_fisica">Eliminación física</label>
                            <select class="custom-select my-1 mr-sm-2" id="eliminacion_fisica" name="eliminacion_fisica">
                                <option value="1" {{old('eliminacion_fisica',$activos->eliminacion_fisica) == '1' ? 'selected' : '' }}>Manual (cesto de basura)</option>
                                <option value="2" {{old('eliminacion_fisica',$activos->eliminacion_fisica) == '2' ? 'selected' : '' }}>Trituradora</option>
                                <option value="3" {{old('eliminacion_fisica',$activos->eliminacion_fisica) == '3' ? 'selected' : '' }}>Reciclaje</option>
                                <option value="4" {{old('eliminacion_fisica',$activos->eliminacion_fisica) == '4' ? 'selected' : '' }}>Proveedor</option>
                                <option value="5" {{old('eliminacion_fisica',$activos->eliminacion_fisica) == '5' ? 'selected' : '' }}>No se detruye</option>
                                <option value="6" {{old('eliminacion_fisica',$activos->eliminacion_fisica) == '6' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                        <div class="form-group col-6">
                            <label for="otro_eliminacion">Otro (si aplica)</label>
                            <input type="text" class="form-control" id="otro_eliminacion" name="otro_eliminacion" value="{{ old('otro_eliminacion', $activos->otro_eliminacion)}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question">¿Se tiene conocimiento si a quien se le comparte la información la borra una vez concluido su uso?</label>
                            <select class="custom-select my-1 mr-sm-2" id="question" name="question">
                                <option value="1" {{old('question',$activos->question) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question',$activos->question) == '2' ? 'selected' : '' }}>No</option>
                                <option value="3" {{old('question',$activos->question) == '3' ? 'selected' : '' }}>Se desconoce</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_1">1. ¿El activo de información contiene datos PÚBLICOS?</label>
                            <select class="custom-select my-1 mr-sm-2" id="question_1" name="question_1">
                                <option value="1" {{old('question_1',$activos->question_1) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_1',$activos->question_1) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_2">2. ¿El activo de información contiene INFORMACIÓN DE USO INTERNO?
                                </label>
                            <select class="custom-select my-1 mr-sm-2" id="question_2" name="question_2">
                                <option value="1" {{old('question_2',$activos->question_2) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_2',$activos->question_2) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_3">3. ¿El activo de información contiene DATOS PERSONALES DE IDENTIFICACIÓN, FINANCIEROS y/o PATRIMONIALES?</label>
                            <select class="custom-select my-1 mr-sm-2" id="question_3" name="question_3">
                                <option value="1" {{old('question_3',$activos->question_3) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_3',$activos->question_3) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_4">4. ¿El activo de información contiene INFORMACIÓN FINANCIERA de la organización o INFORMACIÓN CLAVE para la operación del negocio?</label>
                            <select class="custom-select my-1 mr-sm-2" id="question_4" name="question_4">
                                <option value="1" {{old('question_4',$activos->question_4) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_4',$activos->question_4) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_5">5. ¿El activo de información contiene DATOS PERSONALES SENSIBLES?</label><br>
                            <small>(Ubicación en conjunto con patrimoniales, información adicional de la tarjeta bancaria, titulares de alto riesgo, salud, origen, creencias, religión e ideologías)</small>
                            <select class="custom-select my-1 mr-sm-2" id="question_5" name="question_5">
                                <option value="1" {{old('question_5',$activos->question_5) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_5',$activos->question_5) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_6">6. ¿El activo de información contiene datos de TARJETA BANCARIA?</label><br>
                            <small>(Datos del titular de la tarjeta y datos de autenticación sensibles)</small>
                            <select class="custom-select my-1 mr-sm-2" id="question_6" name="question_6">
                                <option value="1" {{old('question_6',$activos->question_6) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_6',$activos->question_6) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="question_7">7. ¿El activo de información contiene INFORMACIÓN ESTRATÉGICA que representa un diferenciador y/o ventaja competitiva?</label>
                            <select class="custom-select my-1 mr-sm-2" id="question_7" name="question_7">
                                <option value="1" {{old('question_7',$activos->question_7) == '1' ? 'selected' : '' }}>Si</option>
                                <option value="2" {{old('question_7',$activos->question_7) == '2' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                    </div>
                    {{-- Calculo Criticidad --}}
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="confidencialidad_id"><i class="fab fa-expeditedssl iconos-crear"></i>Confidencialidad</label>
                                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }} sumatoria-select"
                                    name="confidencialidad_id" id="confidencialidad_id">
                                    @foreach ($confidencials as $confidencial)
                                        <option data-confindencialValor="{{ $confidencial->valor }}" value="{{ $confidencial->valor }}"
                                            {{ old('confidencialidad_id', $activos->confidencialidad_id) == $confidencial->id ? 'selected' : '' }}>
                                            {{ $confidencial->confidencialidad }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="valor_confidencial"><i class="fas fa-ruler-combined iconos crear"></i> Impacto numérico</label>
                            <div class="form-control" id="valor_confidencial"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="integridad_id"><i class="bi bi-file-earmark-post iconos-crear"></i>Integridad</label>
                                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}  sumatoria-select"
                                    name="integridad_id" id="integridad_id">
                                    @foreach ($integridads as $integridad)
                                        <option data-integridadValor="{{ $integridad->id }}" value="{{ $integridad->valor }}"
                                            {{ old('integridad_id', $activos->integridad_id) == $integridad->id ? 'selected' : '' }}>
                                            {{ $integridad->integridad }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="valor_integridad"><i class="fas fa-ruler-combined iconos-crear" style="margin-top: 8px"></i>Impacto numérico</label>
                            <i class="fas fa-info-circle" style="font-size:12pt; float: right;" title="Fecha de finalización de la
                            actividad" data-toggle="modal" data-target="#infoIntegridad"></i>
                            <div class="form-control" id="valor_integridad"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="disponibilidad_id"><i class="fas fa-clipboard-check iconos-crear"></i>Disponibilidad</label>
                                <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}  sumatoria-select"
                                    name="disponibilidad_id" id="disponibilidad_id">
                                    @foreach ($disponibilidads as $disponibilidad)
                                        <option data-disponibilidadValor="{{ $disponibilidad->id }}" value="{{ $disponibilidad->valor }}"
                                            {{ old('disponibilidad_id', $activos->disponibilidad_id) == $disponibilidad->id ? 'selected' : '' }}>
                                            {{ $disponibilidad->disponibilidad }}
                                        </option>
                                    @endforeach
                                </select>
                            @if ($errors->has('empleados'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label for="valor_disponibilidad"><i class="fas fa-ruler-combined iconos-crear"></i>Impacto numérico</label>
                            <i class="fas fa-info-circle" style="font-size:12pt; float: right;" title="Fecha de finalización de la
                            actividad" data-toggle="modal" data-target="#infoDisponibilidad"></i>
                            <div class="form-control" id="valor_disponibilidad"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-12" style="text-align: center !important;">
                            <label for="valor_criticidad"  ><i class="fas fa-exclamation-triangle iconos-crear"></i>Criticidad del activo Suma de las dimensiones</label>
                            <i class="fas fa-info-circle" style="font-size:12pt; float: right;" title="Fecha de finalización de la
                            actividad" data-toggle="modal" data-target="#infoCriticidad"></i>
                            <input class="form-control text-center" id="valor_criticidad" name="valor_criticidad" readonly/>
                        </div>
                    </div>
                </div>
                 {{--Envias/Guardas --}}
                <div class="col-12">
                    <div class="form-group col-12 text-right" style="margin-left:15px;" >
                        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                        <button class="btn btn-danger" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>

                 <!-- Modal  Integridad-->
                <div class="modal fade" id="infoIntegridad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Escala Integridad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Integridad</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Numérico</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Baja</th>
                                    <td>Afectación en la operación de algún proceso</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <th scope="row">Media</th>
                                    <td>Afectación en la operación de varios procesos</td>
                                    <div class="text-center"><td>2</td></div>
                                </tr>
                                <tr>
                                    <th scope="row">Alta</th>
                                    <td>Afectación en la operación de algún proceso crítico</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <th scope="row">Crítica</th>
                                    <td>Afectación en la operación de varios procesos críticos</td>
                                    <td>4</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Modal Disponibilidad-->
                <div class="modal fade" id="infoDisponibilidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Escala Disponibilidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Disponibilidad</th>
                                    <th scope="col">Descripción</th>
                                    <th scope="col">Numérico</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Baja</th>
                                    <td>Mayor a 72 horas</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <th scope="row">Media</th>
                                    <td>de 24 a 72 horas</td>
                                    <div class="text-center"><td>2</td></div>
                                </tr>
                                <tr>
                                    <th scope="row">Alta</th>
                                    <td>de 12 a 24 horas</td>
                                    <td>3</td>
                                </tr>
                                <tr>
                                    <th scope="row">Crítica</th>
                                    <td>de 0 a 12 horas</td>
                                    <td>4</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- Modal  Crtiticidad-->
                <div class="modal fade" id="infoCriticidad" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Escala Criticidad</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body ">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Criticidad</th>
                                    <th scope="col">Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">Baja</th>
                                    <td>3-4</td>
                                </tr>
                                <tr>
                                    <th scope="row">Media</th>
                                    <td>5-6</td>
                                </tr>
                                <tr>
                                    <th scope="row">Alta</th>
                                    <td>7-9</td>
                                </tr>
                                <tr>
                                    <th scope="row">Crítica</th>
                                    <td>10-12</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>


        </form>
    </div>




@endsection


@section('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function(e) {

        obtenerCriticidad()
        let responsable = document.querySelector('#duenoVP');
        let area_init = responsable.options[responsable.selectedIndex].getAttribute('data-area');
        let puesto_init = responsable.options[responsable.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_responsable').innerHTML = puesto_init
        document.getElementById('area_responsable').innerHTML = area_init
        let proceso = document.getElementById('proceso_id');
        let confidencial = document.getElementById('confidencialidad_id');
        let integridad= document.getElementById('integridad_id');
        let disponibilidad = document.getElementById('disponibilidad_id');

        let custodio = document.querySelector('#custodioALDirector');
        let area_custodio_init = custodio.options[custodio.selectedIndex].getAttribute('data-area');
        let puesto_custodio_init = custodio.options[custodio.selectedIndex].getAttribute('data-puesto');
        document.getElementById('puesto_custodio').innerHTML = puesto_custodio_init
        document.getElementById('area_custodio').innerHTML = area_custodio_init

        document.getElementById('codigo_proceso').innerHTML=proceso.options[proceso.selectedIndex].getAttribute('data-codigo')
        document.getElementById('macroproceso').innerHTML=proceso.options[proceso.selectedIndex].getAttribute('data-macroproceso')

        document.getElementById('valor_confidencial').innerHTML=confidencial.options[confidencial.selectedIndex].getAttribute('data-confindencialValor')
        document.getElementById('valor_integridad').innerHTML=integridad.options[integridad.selectedIndex].getAttribute('data-integridadValor')
        document.getElementById('valor_disponibilidad').innerHTML=disponibilidad.options[disponibilidad.selectedIndex].getAttribute('data-disponibilidadValor')


        proceso.addEventListener('change', function(e) {
            e.preventDefault();
            console.log()
            document.getElementById('codigo_proceso').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-codigo')
            document.getElementById('macroproceso').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-macroproceso')
        })
        confidencial.addEventListener('change', function(e) {
            e.preventDefault();
           obtenerCriticidad();
            document.getElementById('valor_confidencial').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-confindencialValor')
        })
        integridad.addEventListener('change', function(e) {
            e.preventDefault();
            obtenerCriticidad();
            document.getElementById('valor_integridad').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-integridadValor')
        })
        disponibilidad.addEventListener('change', function(e) {
            e.preventDefault();
            obtenerCriticidad();
            document.getElementById('valor_disponibilidad').innerHTML=e.target.options[e.target.selectedIndex].getAttribute('data-disponibilidadValor')
        })

        responsable.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_responsable').innerHTML = puesto
            document.getElementById('area_responsable').innerHTML = area
        })
        custodio.addEventListener('change', function(e) {
            e.preventDefault();
            let area = this.options[this.selectedIndex].getAttribute('data-area');
            let puesto = this.options[this.selectedIndex].getAttribute('data-puesto');
            document.getElementById('puesto_custodio').innerHTML = puesto
            document.getElementById('area_custodio').innerHTML = area
        })
        function obtenerCriticidad(){
            let sumatoria = 0;
            document.querySelectorAll('.sumatoria-select').forEach(element => {
            sumatoria= sumatoria+ Number(element.options[element.selectedIndex].value);
            });
            document.getElementById('valor_criticidad').value= sumatoria;
        }

        document.getElementById('identificador').addEventListener('keyup',(e)=>{
            $.ajax({
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{route('admin.activosInformacion.validacion')}}",
            data: {identificador:e.target.value},
            dataType: "JSON",
            beforeSend:function(){
                if(e.target.classList.contains('is-valid')){
                    e.target.classList.remove('is-valid')
                }
                if(e.target.classList.contains('is-invalid')){
                    e.target.classList.remove('is-invalid')
                }
                document.getElementById('validar-identificador').innerHTML="Validando identificador"
            },
            success: function (response) {
               if(response.existe){
                e.target.classList.add('is-invalid')
                document.getElementById('validar-identificador').innerHTML="Este identificador ya esta en uso"
               }else{
               e.target.classList.add('is-valid')
               document.getElementById('validar-identificador').innerHTML="Este identificador esta disponible"
               }
            }
        });
        })
    })


</script>


@endsection


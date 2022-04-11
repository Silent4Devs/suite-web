@extends('layouts.admin')
@section('content')
<style>

.alert.alert-danger{
    display: none !important;
}
</style>

    <h5 class="col-12 titulo_general_funcion">Registrar: Activo de Información</h5>
<div class="mt-4 card">
    <div class="card-body">
    @include('admin.OCTAVE.menu')

    <form method="POST" action="{{ route("admin.activosInformacion.store")}}" enctype="multipart/form-data">
        @csrf
        {{-- Informacion General --}}
        <div class="col-12">
                <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    Información General
                </div>
            <div class="row">
                <input type="hidden" name="matriz_id" value="{{$matriz}}"/>
                <div class="form-group col-sm-3">
                    <label for="identificador"><i class="fas fa-barcode iconos-crear"></i>ID</label>
                    <input class="form-control" type="text" name="identificador" id="identificador" required>
                    <small id="validar-identificador"></small>
                    <small id="identificador1" class="text-danger"></small>
                </div>
                <div class="form-group col-sm-9">
                    <label for="activo_informacion"><i class="fas fa-folder-plus iconos-crear"></i>Nombre del Activo de información</label>
                    <input class="form-control {{ $errors->has('activo_informacion') ? 'is-invalid' : '' }}" type="text"
                        name="activo_informacion" id="activo_informacion">
                </div>
                <div class="form-group col-sm-12 multi_select_box">
                    <label for="contenedores"><i class="fas fa-boxes iconos-crear"></i>Contenedor(es) asociado(s) al</label>
                    <select style="height:150px;" class="multi_select select2 col-sm-12" multiple size="3" name="contenedores[]">
                        @foreach ($contenedores as $contenedor)
                        <option value="{{$contenedor->id}}" data-riesgo="{{$contenedor->riesgo}}">{{$contenedor->nom_contenedor}}</option>
                        @endforeach
                      </select>
                      @error('contenedores')
                      <span class="invalid-feedback d-block" role="alert">
                          <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                </div>

                <div class="form-group col-sm-12">
                    <label for="nombreVP"><i class="fas fa-street-view iconos-crear"></i>Nombre VP</label>
                    <select class="custom-select my-1 mr-sm-2" id="nombredevp_id" name="nombredevp_id">
                        @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id }}"
                                >
                                {{ $grupo->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="duenoVP"><i class="fas fa-user-tie iconos-crear"></i>Dueño AI Nombre del VP</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="duenoVP" id="duenoVP">
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}">

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
                    <label for="id_area_responsable"><i class="fas fa-street-view iconos-crear"></i>Dirección</label>
                    <div class="form-control" id="area_responsable"></div>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-sm-12">
                    <label for="nombre_direccion"><i class="fas fa-street-view iconos-crear"></i>Nombre Dirección</label>
                    <select class="custom-select my-1 mr-sm-2" id="nombre_direccion" name="nombre_direccion">
                        @foreach ($area as $direccion)
                            <option value="{{ $direccion->id }}">
                                {{ $direccion->area }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="form-group col-md-4">
                    <label for="custodioALDirector"><i class="fas fa-user-tie iconos-crear"></i>Custodio AI Nombre Director</label>
                    <select class="form-control select2 {{ $errors->has('responsable') ? 'is-invalid' : '' }}"
                        name="custodioALDirector" id="custodioALDirector">
                        @foreach ($empleados as $empleado)
                            <option data-puesto="{{ $empleado->puesto }}" value="{{ $empleado->id }}"
                                data-area="{{ $empleado->area->area }}">

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
                    <label for="area_custodio"><i class="fas fa-street-view iconos-crear"></i>Dirección</label>
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
                                            data-macroproceso="{{ $proceso->macroproceso->nombre }}">
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
                            <label for="codigo_proceso"><i class="fas fa-barcode iconos-crear" style="margin-top: 8px"></i>Código</label>
                            <div class="form-control" id="codigo_proceso"></div>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="macroproceso"><i class="bi bi-file-earmark-post-fill iconos-crear"></i>Macroproceso</label>
                            <div class="form-control" id="macroproceso"></div>
                        </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6">
                    <label for="formato">Formato</label>
                    <select class="custom-select my-1 mr-sm-2" id="formato" name="formato">
                        <option value="Digital">Digital</option>
                        <option value="Físico">Físico</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- 1 Creas/Reccibes --}}
        <div class="col-12" x-data='{openCrea:false, openRecibe:false}'>
            <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                1. ¿ A través de que medio CREAS al interno o RECIBES de un tercero el activo de información?
            </div>
            <p style="text-align: center">
                <button class="btn btn-primary" x-on:click.prevent='openCrea= !openCrea'>
                Se Crea
                </button>
                <button class="btn btn-primary" x-on:click.prevent='openRecibe= !openRecibe'>
                Se Recibe
                </button>
            </p>
            <div id="collapseExample" x-show='openCrea' x-transition>
                <div class="card card-body">
                    <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                        Creación digital
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="creacion" id="creacion" value="1">
                        <label class="form-check-label" for="creacion1">
                            Aplicación de negocio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="creacion" id="creacion" value="2">
                        <label class="form-check-label" for="creacion">
                            Google Workspace
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="creacion" id="creacion" value="3">
                        <label class="form-check-label" for="creacion">
                            Paquetería multimedia
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="creacion" id="creacion" value="4">
                        <label class="form-check-label" for="creacion">
                            Escaneo
                        </label>
                    </div><br>
                    <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                        Creación física
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="creacion" id="creacion" value="5">
                        <label class="form-check-label" for="creacion">
                            Manualmente
                        </label>
                    </div>
                </div>
            </div>

            <div id="collapseExample1" x-show='openRecibe' x-transition>
                <div class="card card-body">
                    <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                            Recepción digital
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="1">
                        <label class="form-check-label" for="recepcion">
                            Aplicación de negocio
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="2">
                        <label class="form-check-label" for="recepcion2">
                            Mail corporativo
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion3" value="3">
                        <label class="form-check-label" for="recepcion">
                            Mail personal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="4">
                        <label class="form-check-label" for="recepcion">
                            Carpeta compartida
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="5">
                        <label class="form-check-label" for="recepcion">
                            Medio extraíble
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="6">
                        <label class="form-check-label" for="recepcion">
                            Página web
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="7">
                        <label class="form-check-label" for="recepcion">
                            Vía telefónica
                        </label>
                    </div>
                    <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                        Recepción física
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="8">
                        <label class="form-check-label" for="recepcion">
                        Entrega personal
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="9">
                        <label class="form-check-label" for="recepcion">
                        Mensajería externa
                        </label>
                    </div>

                    <div class="form-check">
                            <input class="form-check-input" type="radio" name="recepcion" id="recepcion" value="10">
                            <label class="form-check-label" for="recepcion">Otro
                    </div>
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
                <option value="1">Aplicación de negocio</option>
                <option value="2">Google Workspace</option>
                <option value="3">Paquetería multimedia</option>
                <option value="4">Carpeta compartida</option>
                </select>
            </div>

            {{-- <label for="form-group">"Nombre aplicación(si aplica)"</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with checkbox">
            </div>
            <label for="formGroupExampleInput">"Nombre carpeta compartida (si aplica)"</label>
            <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                <input type="checkbox" aria-label="Checkbox for following text input">
                </div>
            </div>
            <input type="text" class="form-control" aria-label="Text input with checkbox">
            </div>
            --}}
            {{-- <div class="form-group">
                <label for="nombre_aplicacion">Nombre aplicación (si aplica)</label>
                <input type="text" class="form-control" id="nombre_aplicacion" name="nombre_aplicacion" placeholder="...">
            </div> --}}
            <div class="form-group">
                <label for="nombre_aplicacion">Nombre aplicación (si aplica)</label>
                <input type="text" class="form-control" id="nombre_aplicacion" name="nombre_aplicacion" placeholder="...">
            </div>
            <div class="form-group">
                <label for="carpeta_compartida">Nombre carpeta compartida (si aplica)</label>
                <input type="text" class="form-control" id="carpeta_compartida" name="carpeta_compartida" placeholder="...">
            </div>
            <div class="form-group">
                <label for="otra_AppCarpeta">Otra Aplicación/carpeta</label>
                <input type="text" class="form-control" id="otra_AppCarpeta" name="otra_AppCarpeta" placeholder="...">
            </div>
            {{-- <div class="form-group">
                <label for="uso_fisico">Uso físico</label>
                <input type="text" class="form-control" id="uso_fisico" name="uso_fisico" placeholder="...">
            </div>
            <div class="form-group">
                <label for="otro">Otro</label>
                <input type="text" class="form-control" id="otro" name="otro" placeholder="...">
            </div> --}}


            <div class="form-group">
                <label for="imprime">¿Se imprime?</label>
                <select class="custom-select my-1 mr-sm-2" id="name" name="imprime">
                    <option selected value="no">No</option>
                    <option value="si">Si</option>
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
                                <select class="custom-select my-1 mr-sm-2" id="name_direccion_id" name="name_direccion_id">
                                    @foreach ($area as $direccionname)
                                        <option value="{{ $direccion->id }}">
                                            {{ $direccionname->area }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="vp_envio"><i class="fas fa-list-ol iconos-crear"></i>Nombre VP</label>
                                <select class="custom-select my-1 mr-sm-2" id="vp_id'" name="vp_id'">
                                    @foreach ($grupos as $vp)
                                        <option value="{{ $vp->id }}"
                                            >
                                            {{ $vp->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                    Envio digital
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="1">
                                    <label class="form-check-label" for="envio_digital">
                                        Aplicación de negocio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="2">
                                    <label class="form-check-label" for="envio_digital">
                                        Mail coorporativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="3">
                                    <label class="form-check-label" for="envio_digital">
                                        Medio extraíble
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="4">
                                    <label class="form-check-label" for="envio_digital">
                                        Mail personal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="5">
                                    <label class="form-check-label" for="envio_digital">
                                        Carpeta compartida
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="6">
                                    <label class="form-check-label" for="envio_digital">
                                        Google Workspace
                                    </label>
                                </div><br>
                                <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                    Envio físico
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="7">
                                    <label class="form-check-label" for="envio_digital">
                                        Envío personal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="8">
                                    <label class="form-check-label" for="envio_digital">
                                        Mensajería interna
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_digital" id="envio_digital" value="9">
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
                                    name="otro_envio_digital" id="otro_envio_digital">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="informacion_total">¿Requiere la información en su totalidad?</label>
                                <select class="custom-select my-1 mr-sm-2" id="informacion_total" name="informacion_total">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
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
                                    Envio digital
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="1">
                                    <label class="form-check-label" for="envio_ext">
                                        Aplicación de negocio
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="2">
                                    <label class="form-check-label" for="envio_ext">
                                        Mail coorporativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="3">
                                    <label class="form-check-label" for="envio_ext">
                                        Medio extraíble
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="4">
                                    <label class="form-check-label" for="envio_ext">
                                        Mail personal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="5">
                                    <label class="form-check-label" for="envio_ext">
                                        Carpeta compartida
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="6">
                                    <label class="form-check-label" for="envio_ext">
                                        Google Workspace
                                    </label>
                                </div><br>
                                <div class="mt-4 text-center form-group" style="background-color:rgb(224, 231, 236); border-radius: 100px; color: rgb(0, 0, 0);">
                                    Envio físico
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="7">
                                    <label class="form-check-label" for="envio_ext">
                                        Envío personal
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="8">
                                    <label class="form-check-label" for="envio_ext">
                                        Mensajería interna
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="envio_ext" id="envio_ext" value="9">
                                    <label class="form-check-label" for="envio_ext">
                                        Mensajería externa
                                    </label>
                                </div>
                            </div>
                        </div><br>
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="otro_envioExt"><i class="fas fa-folder-plus iconos-crear"></i>Otro</label>
                                <input class="form-control {{ $errors->has('tro_envioExt') ? 'is-invalid' : '' }}" type="text"
                                    name="otro_envioExt" id="otro_envioExt">
                            </div>
                            <div class="form-group col-sm-6">
                                <label for="informacion_totalExt"> ¿Requiere la información en su totalidad?</label>
                                <select class="custom-select my-1 mr-sm-2" id="informacion_totalExt" name="informacion_totalExt">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-sm-12">
                                <label for="acceso_informacionExt"> ¿Tiene acceso a todos los medios requeridos por su operación para transmitir la información?</label>
                                <select class="custom-select my-1 mr-sm-2" id="acceso_informacionExt" name="acceso_informacionExt">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="requiere_info"><i class="fas fa-folder-plus iconos-crear"></i>En caso que no, ¿cuáles se requieren?
                                </label>
                                <input class="form-control {{ $errors->has('requiere_info') ? 'is-invalid' : '' }}" type="text"
                                    name="requiere_info" id="requiere_info">
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
                                    <option value="1">Aplicación de negocio</option>
                                    <option value="2">Google Workspace</option>
                                    <option value="3">Equipo de cómputo</option>
                                    <option value="4">Carpeta compartida</option>
                                    <option value="5">Medio extraíble</option>
                                    <option value="6">Mail corporativo</option>
                                    <option value="7">Mail personal</option>
                                    <option value="8">Dispositivo móvil</option>
                                    </select>
                            </div>
                            <div class="form-group">
                                <label for="almacenamiento_aplicacion">Nombre aplicación (si aplica)</label>
                                <input type="text" class="form-control" id="almacenamiento_aplicacion" name="almacenamiento_aplicacion" placeholder="...">

                            </div>
                            <div class="form-group">
                                <label for="carpeta_compartida_almacenamiento">Nombre carpeta compartida (si aplica)</label>
                                <input type="text" class="form-control" id="carpeta_compartida_almacenamiento" name="carpeta_compartida_almacenamiento" placeholder="...">
                            </div>
                            <div class="form-group">
                                <label for="otra_AppCarpeta_almacenamiento">Otra Aplicación/carpeta</label>
                                <input type="text" class="form-control" id="otra_AppCarpeta_almacenamiento" name="otra_AppCarpeta_almacenamiento" placeholder="...">
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
                                    <option value="1">Mobiliario</option>
                                    <option value="2">Archivero</option>
                                    <option value="3">Bóveda</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="otro_almacenamiento_fisico">Otro</label>
                                <input type="text" class="form-control" id="otro_almacenamiento_fisico" name="otro_almacenamiento_fisico" placeholder="...">
                            </div>
                            <div class="form-group">
                                <label for="ubicacion_fisica">Ubicación física donde se almacena</label>
                                <input type="text" class="form-control" id="ubicacion_fisica" name="ubicacion_fisica" placeholder="...">
                            </div>
                            <div class="form-group">
                                <label for="almacenamiento_acceso">
                                    ¿Tiene acceso a todos los medios requeridos por su operación para almacenar la información?</label>
                                <select class="custom-select my-1 mr-sm-2" id="almacenamiento_acceso" name="almacenamiento_acceso">
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="acceso_requerido">En caso que no, ¿cuáles se requieren?</label>
                                <input type="text" class="form-control" id="acceso_requerido" name="acceso_requerido" placeholder="...">
                            </div>
                            <div class="form-group">
                                <label for="tiempo_almacenamiento">Tiempo de almacenamiento (con base a regulaciones, reglas internas y/o necesidades de negocio)</label>
                                <input type="text" class="form-control" id="tiempo_almacenamiento" name="tiempo_almacenamiento" placeholder="...">
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
                        <option value="Si">Si</option>
                        <option value="No">No</option>
                        </select>
                </div>
                <div class="form-group col-12">
                    <label for="eliminacion_digital">Eliminación digital</label>
                    <input type="text" class="form-control" id="eliminacion_digital" name="eliminacion_digital" placeholder="...">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-6">
                    <label for="eliminacion_fisica">Eliminación física</label>
                    <select class="custom-select my-1 mr-sm-2" id="eliminacion_fisica" name="eliminacion_fisica">
                        <option value="1">Manual (cesto de basura)</option>
                        <option value="2">Trituradora</option>
                        <option value="3">Reciclaje</option>
                        <option value="4">Proveedor</option>
                        <option value="5">No se detruye</option>
                        <option value="6">Otro</option>
                    </select>
                </div>
                <div class="form-group col-6">
                    <label for="otro_eliminacion">Otro (si aplica)</label>
                    <input type="text" class="form-control" id="otro_eliminacion" name="otro_eliminacion" placeholder="...">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question">¿Se tiene conocimiento si a quien se le comparte la información la borra una vez concluido su uso?</label>
                    <select class="custom-select my-1 mr-sm-2" id="question" name="question">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                        <option value="3">Se desconoce</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_1">1. ¿El activo de información contiene datos PÚBLICOS?</label>
                    <select class="custom-select my-1 mr-sm-2" id="question_1" name="question_1">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_2">2. ¿El activo de información contiene INFORMACIÓN DE USO INTERNO?
                        </label>
                    <select class="custom-select my-1 mr-sm-2" id="question_2" name="question_2">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_3">3. ¿El activo de información contiene DATOS PERSONALES DE IDENTIFICACIÓN, FINANCIEROS y/o PATRIMONIALES?</label>
                    <select class="custom-select my-1 mr-sm-2" id="question_3" name="question_3">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_4">4. ¿El activo de información contiene INFORMACIÓN FINANCIERA de la organización o INFORMACIÓN CLAVE para la operación del negocio?</label>
                    <select class="custom-select my-1 mr-sm-2" id="question_4" name="question_4">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_5">5. ¿El activo de información contiene DATOS PERSONALES SENSIBLES?</label><br>
                    <small>(Ubicación en conjunto con patrimoniales, información adicional de la tarjeta bancaria, titulares de alto riesgo, salud, origen, creencias, religión e ideologías)</small>
                    <select class="custom-select my-1 mr-sm-2" id="question_5" name="question_5">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_6">6. ¿El activo de información contiene datos de TARJETA BANCARIA?</label><br>
                    <small>(Datos del titular de la tarjeta y datos de autenticación sensibles)</small>
                    <select class="custom-select my-1 mr-sm-2" id="question_6" name="question_6">
                        <option value="1">Si</option>
                        <option value="2">No</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-12">
                    <label for="question_7">7. ¿El activo de información contiene INFORMACIÓN ESTRATÉGICA que representa un diferenciador y/o ventaja competitiva?</label>
                    <select class="custom-select my-1 mr-sm-2" id="question_7" name="question_7">
                        <option value="1">Si</option>
                        <option value="2">No</option>
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
                                <option data-confindencialValor="{{ $confidencial->valor }}" value="{{ $confidencial->valor }}">
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
                                <option data-integridadValor="{{ $integridad->id }}" value="{{ $integridad->valor }}">
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
                                <option data-disponibilidadValor="{{ $disponibilidad->id }}" value="{{ $disponibilidad->valor }}">
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
                <div class="form-group col-md-6">
                    <label for="valor_criticidad"><i class="fas fa-exclamation-triangle iconos-crear"></i>Nivel de Criticidad del AI</label>
                    <div class="form-control" id="valorCriticidadTxt" ></div>
                </div>
                <div class="form-group col-md-6">
                    <label for="valor_criticidad"><i class="fas fa-exclamation-triangle iconos-crear"></i>Valor de Criticidad del AI</label>
                    <i class="fas fa-info-circle" style="font-size:12pt; float: right;" title="Fecha de finalización de la
                    actividad" data-toggle="modal" data-target="#infoCriticidad"></i>
                    <input class="form-control text-center"  id="valor_criticidad" name="valor_criticidad" readonly/>
                </div>

            </div>
        </div>
        {{--  Guardar --}}
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
</div>
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
            let contenedorTxt=document.getElementById('valorCriticidadTxt');
            contenedorTxt.innerHTML=null;
            let contenedorValor=document.getElementById('valor_criticidad');
            contenedorValor.innerHTML=null;
            let sumatoria = 0;
            document.querySelectorAll('.sumatoria-select').forEach(element => {
            sumatoria= sumatoria+ Number(element.options[element.selectedIndex].value);
            });
            let resultado="";
            if (sumatoria <=4){
                resultado="Baja"
                contenedorTxt.style.background="green"
                contenedorValor.style.background="green"
                contenedorTxt.style.color="white"
                contenedorValor.style.color="white"
            }
            if (sumatoria >=5){
                resultado="Media"
                contenedorTxt.style.background="yellow"
                contenedorValor.style.background="yellow"
                contenedorTxt.style.color="black"
                contenedorValor.style.color="black"
            }
            if (sumatoria >=7){
                resultado="Alta"
                contenedorTxt.style.background="orange"
                contenedorValor.style.background="orange"
                contenedorTxt.style.color="white"
                contenedorValor.style.color="white"

            }
            if (sumatoria >=10){
                resultado="Crítica"
                contenedorTxt.style.background="red"
                contenedorValor.style.background="red"
                contenedorTxt.style.color="white"
                contenedorValor.style.color="white"

            }
            document.getElementById('valor_criticidad').value= sumatoria;
            document.getElementById('valorCriticidadTxt').innerHTML=resultado;
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
{{-- <script>
    document.addEventListener('DOMContentLoaded', function(e) {
         $('.select2').select2({
        'theme': 'bootstrap4'
        });
    });

</script> --}}




@endsection


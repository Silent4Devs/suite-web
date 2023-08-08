@extends('layouts.admin')

@section('content')
@section('titulo', 'Clientes')
{{-- {{ Breadcrumbs::render('proveedores_create') }} --}}
    <form method="POST" action="{{ route('admin.proveedores.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="card card-content row">

            <div class="col s12" style="margin-bottom: 30px;">
                <h3 class="titulo-form">AGREGAR CLIENTE</h3>
                <p class="instrucciones">Por favor ingrese los datos del cliente para poder darlo de alta</p>
            </div>

            <h4 class="sub-titulo-form col s12">DATOS GENERALES</h4>

            <div class="col s12 l6 distancia">
                <label for="razon_social" class="txt-tamaño"><i class="far fa-building iconos-crear"></i> Razón
                    Social<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text"
                    name="razon_social" id="razon_social" value="{{ old('razon_social', '') }}" required>
                @if ($errors->has('razon_social'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('razon_social') }}
                    </div>
                @endif
            </div>



            <div class="col s12 l6 distancia">
                <label for="nombre_comercial" class="txt-tamaño"><i class="far fa-building iconos-crear"></i>
                    Nombre Comercial del Cliente<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('nombre_comercial') ? 'is-invalid' : '' }}"
                    type="text" name="nombre_comercial" id="nombre_comercial"
                    value="{{ old('nombre_comercial', '') }}" required>
                @if ($errors->has('nombre_comercial'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('nombre_comercial') }}
                    </div>
                @endif

            </div>

            <div class="col s12 l6 distancia">
                <label for="rfc" class="txt-tamaño"><i class="fas fa-file-alt iconos-crear"></i> RFC persona
                    moral o persona física </label>
                <input class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" name="rfc" id="rfc"
                    value="{{ old('rfc', '') }}">
                @if ($errors->has('rfc'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('rfc') }}
                    </div>
                @endif

            </div>

            <div class="col s12 l6 distancia">
                <label for="id_fiscale" class="txt-tamaño"><i class="fas fa-file-alt iconos-crear"></i> Persona fiscal </label>
                <select name="id_fiscale" id="" class="form-control">
                @if (!($personas->isEmpty()))
                    <option value="" disabled selected>Seleccione una opción</option>
                    @foreach($personas as $persona)
                        <option  value="{{$persona->id}}">{{$persona->persona_fiscal}}</option>
                    @endforeach
                @else
                    <option value="" disabled>No hay proveedores registrados</option>
                @endif
                </select>
                @if ($errors->has('persona_fiscal'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('persona_fiscal') }}
                    </div>
                @endif
            </div>
        </div>


        <div class="card card-content row">

            <h4 class="sub-titulo-form col s12">DOMICILIO FISCAL</h4>

            <div class="col s12 l6 distancia">
                <label for="calle" class="txt-tamaño"> <i class="fas fa-map-marker-alt iconos-crear"></i> Calle
                    y Número<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('calle') ? 'is-invalid' : '' }}" name="calle"
                    id="calle" value="{{ old('calle', '') }}" required>
                @if ($errors->has('calle'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('calle') }}
                    </div>
                @endif

            </div>
            <!--form-group-->

            <div class="col s12 l6 distancia">
                <label for="colonia" class="txt-tamaño"> <i class="fas fa-map-marker-alt iconos-crear"></i>
                    Colonia<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('colonia') ? 'is-invalid' : '' }}" name="colonia"
                    id="colonia" value="{{ old('colonia', '') }}" required>
                @if ($errors->has('colonia'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('colonia') }}
                    </div>
                @endif

            </div>
            <!--form-group-->


            <div class="col s12 l6 distancia">
                <label for="ciudad" class="txt-tamaño"> <i class="fas fa-map-marker-alt iconos-crear"></i>
                    Ciudad o Municipio/ País:<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('ciudad') ? 'is-invalid' : '' }}" name="ciudad"
                    id="ciudad" value="{{ old('ciudad', '') }}" required>
                @if ($errors->has('ciudad'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('ciudad') }}
                    </div>
                @endif

            </div>
            <!--form-group-->


            <div class="col s12 l6 distancia">
                <label for="codigo_postal" class="txt-tamaño"> <i
                        class="fas fa-map-marker-alt iconos-crear"></i> Código Postal:<font class="asterisco">*
                    </font></label>
                <input class="form-control {{ $errors->has('codigo_postal') ? 'is-invalid' : '' }}"
                    type="number" name="codigo_postal" id="codigo_postal"
                    value="{{ old('codigo_postal', '') }}" required>
                @if ($errors->has('codigo_postal'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('codigo_postal') }}
                    </div>
                @endif

            </div>
            <!--form-group-->


            <div class="col s12 l6 distancia">
                <label for="telefono" class="txt-tamaño"><i
                        class="fas fa-phone-square-alt iconos-crear"></i></i> Teléfono:</label>
                <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}"
                    name="telefono" id="telefono" value="{{ old('telefono', '') }}">
                @if ($errors->has('telefono'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('telefono') }}
                    </div>
                @endif

            </div>
            <!--form-group-->


            <div class="col s12 l6 distancia">
                <label for="pagina_web" class="txt-tamaño"><i class="fas fa-laptop iconos-crear"></i> Página
                    Web:</label>
                <input class="form-control {{ $errors->has('pagina_web') ? 'is-invalid' : '' }}" type="url"
                    name="pagina_web" id="pagina_web" value="{{ old('pagina_web', '') }}">
                @if ($errors->has('pagina_web'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('pagina_web') }}
                    </div>
                @endif

            </div>
            <!--form-group-->
        </div>

        <div class="card card-content row">

            <h4 class="sub-titulo-form col s12">DATOS DEL CONTACTO</h4>

            <div class="col s12 l6 distancia">
                <label for="nombre_completo" class="txt-tamaño"> <i class="fas fa-user iconos-crear"></i></i>
                    Nombre Completo del contacto<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('nombre_completo') ? 'is-invalid' : '' }}"
                    name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo', '') }}"
                    required>
                @if ($errors->has('nombre_completo'))
                    <div class="invalid-feedback red-text" style="position:absolute">
                        {{ $errors->first('nombre_completo') }}
                    </div>
                @endif

            </div>
            <!--form-group-->


            <div class="col s12 l6 distancia">
                <label for="puesto" class="txt-tamaño"> <i class="fas fa-briefcase iconos-crear"></i> Puesto
                </label>
                <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" name="puesto"
                    id="puesto" value="{{ old('puesto', '') }}">
                @if ($errors->has('puesto'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('puesto') }}
                    </div>
                @endif
            </div>


            <div class="col s12 l6 distancia">
                <label for="correo" class="txt-tamaño"> <i class="fas fa-envelope iconos-crear"></i> Correo
                    Electrónico</label>
                <input class="form-control {{ $errors->has('correo') ? 'is-invalid' : '' }}" name="correo"
                    type="email" id="correo" value="{{ old('correo', '') }}">
                @if ($errors->has('correo'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('correo') }}
                    </div>
                @endif

            </div>
            <!--form-group-->



            <div class="col s12 l6 distancia">
                <label for="celular" class="txt-tamaño"> <i class="fas fa-mobile-alt iconos-crear"></i>
                    Celular</label>
                <input class="form-control {{ $errors->has('celular') ? 'is-invalid' : '' }}" name="celular"
                    id="correo" value="{{ old('celular', '') }}">
                @if ($errors->has('celular'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('celular') }}
                    </div>
                @endif
            </div>
        </div>


        <div class="card card-content row">

            <h4 class="sub-titulo-form col s12">PRODUCTOS Y/O SERVICIOS</h4>


            <div class="form-group col l6 s12" style="margin-top:40px;">
                <label for="objeto_descripcion" class="txt-tamaño"> <i
                        class="fas fa-people-carry iconos-crear"></i> Objeto social / Descripción del servicio o
                    producto</label>
                <textarea class="form-control materialize-textarea {{ $errors->has('objeto_descripcion') ? 'is-invalid' : '' }}"
                    name="objeto_descripcion" id="objeto_descripcion"
                    value="{{ old('objeto_descripcion', '') }}"></textarea>
                @if ($errors->has('objeto_descripcion'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('objeto_descripcion') }}
                    </div>
                @endif

            </div>
            <!--form-group-->


            <div class="form-group col s12 l6 distancia">
                <label for="cobertura" class="txt-tamaño"> <i class="fas fa-map-marker-alt iconos-crear"></i>
                    Cobertura, Rango geográfico en el cual presta los servicios </label>
                <textarea class="form-control materialize-textarea {{ $errors->has('cobertura') ? 'is-invalid' : '' }}"
                    name="cobertura" id="cobertura" value="{{ old('cobertura', '') }}"></textarea>
                @if ($errors->has('cobertura'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('cobertura') }}
                    </div>
                @endif

            </div>
            <!--form-group-->
            <div class="col s12 right-align distancia">
                <a href="{{ route('admin.proveedores.index') }}" class="btn-redondeado btn btn-default" style="background: #959595 !important">Cancelar</a>
                <button class="btn-redondeado btn btn-danger" type="submit">
                    GUARDAR
                </button>
            </div>
        </div>

    </form>

@endsection

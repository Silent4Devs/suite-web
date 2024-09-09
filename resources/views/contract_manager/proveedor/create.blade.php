@extends('layouts.admin')

@section('content')
@section('titulo', 'Clientes')
{{-- {{ Breadcrumbs::render('proveedores_create') }} --}}
<form method="POST" action="{{ route('contract_manager.proveedor.store') }}" enctype="multipart/form-data">
    @csrf

    <div class="card card-content row">

        <div class="col s12" style="margin-top: 30px;">
            <h3>AGREGAR CLIENTE</h3>
            <p>Por favor ingrese los datos del cliente para poder darlo de alta</p>
        </div>

        <div class="col s12">
            <h4>DATOS GENERALES</h4>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="razon_social" class="txt-tamaño">Razón
                    Social<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('razon_social') ? 'is-invalid' : '' }}" type="text"
                    name="razon_social" id="razon_social" value="{{ old('razon_social', '') }}" required>
                @if ($errors->has('razon_social'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('razon_social') }}
                    </div>
                @endif
            </div>

            <div class="distancia form-group col-md-6">
                <label for="nombre_comercial" class="txt-tamaño">
                    Nombre Comercial del Cliente<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('nombre_comercial') ? 'is-invalid' : '' }}" type="text"
                    name="nombre_comercial" id="nombre_comercial" value="{{ old('nombre_comercial', '') }}" required>
                @if ($errors->has('nombre_comercial'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('nombre_comercial') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px; margin-bottom: 30px;">
            <div class="distancia form-group col-md-6">
                <label for="rfc" class="txt-tamaño">
                    RFC persona
                    moral o persona física </label>
                <input class="form-control {{ $errors->has('rfc') ? 'is-invalid' : '' }}" name="rfc" id="rfc"
                    value="{{ old('rfc', '') }}">
                @if ($errors->has('rfc'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('rfc') }}
                    </div>
                @endif
            </div>

            <div class="distancia form-group col-md-6">
                <label for="id_fiscale" class="txt-tamaño">
                    Persona fiscal
                </label>
                <select name="id_fiscale" id="" class="form-control">
                    @if (!$personas->isEmpty())
                        <option value="" disabled selected>Seleccione una opción</option>
                        @foreach ($personas as $persona)
                            <option value="{{ $persona->id }}">{{ $persona->persona_fiscal }}</option>
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
    </div>

    <div class="card card-content row">

        <div class="col s12">
            <h4 style="margin-top: 20px;">DOMICILIO FISCAL</h4>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="calle" class="txt-tamaño"> Calle
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

            <div class="distancia form-group col-md-6">
                <label for="colonia" class="txt-tamaño">
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
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="ciudad" class="txt-tamaño">
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

            <div class="distancia form-group col-md-6">
                <label for="codigo_postal" class="txt-tamaño"> Código
                    Postal:<font class="asterisco">*
                    </font></label>
                <input class="form-control {{ $errors->has('codigo_postal') ? 'is-invalid' : '' }}" type="number"
                    name="codigo_postal" id="codigo_postal" value="{{ old('codigo_postal', '') }}" required>
                @if ($errors->has('codigo_postal'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('codigo_postal') }}
                    </div>
                @endif
            </div>
            <!--form-group-->
        </div>
        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="telefono" class="txt-tamaño">
                    Teléfono:</label>
                <input class="form-control {{ $errors->has('telefono') ? 'is-invalid' : '' }}" name="telefono"
                    id="telefono" value="{{ old('telefono', '') }}">
                @if ($errors->has('telefono'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('telefono') }}
                    </div>
                @endif

            </div>
            <!--form-group-->

            <div class="distancia form-group col-md-6">
                <label for="pagina_web" class="txt-tamaño"> Página
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
    </div>
    <div class="card card-content row">

        <div class="col s12">
            <h4 style="margin-top: 20px;">DATOS DEL CONTACTO</h4>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-7">
                <label for="nombre_completo" class="txt-tamaño">
                    Nombre Completo del contacto<font class="asterisco">*</font></label>
                <input class="form-control {{ $errors->has('nombre_completo') ? 'is-invalid' : '' }}"
                    name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo', '') }}" required>
                @if ($errors->has('nombre_completo'))
                    <div class="invalid-feedback red-text" style="position:absolute">
                        {{ $errors->first('nombre_completo') }}
                    </div>
                @endif
            </div>
            <!--form-group-->


            <div class="distancia form-group col-md-5">
                <label for="puesto" class="txt-tamaño"> Puesto
                </label>
                <input class="form-control {{ $errors->has('puesto') ? 'is-invalid' : '' }}" name="puesto"
                    id="puesto" value="{{ old('puesto', '') }}">
                @if ($errors->has('puesto'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('puesto') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-6">
                <label for="correo" class="txt-tamaño"> Correo
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

            <div class="distancia form-group col-md-6">
                <label for="celular" class="txt-tamaño">
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
    </div>

    <div class="card card-content row">

        <div class="col s12">
            <h4 style="margin-top: 30px;">PRODUCTOS Y/O SERVICIOS</h4>
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-12">
                <label for="objeto_descripcion" class="txt-tamaño">
                    Objeto social / Descripción del servicio o
                    producto</label>
                <textarea class="form-control materialize-textarea {{ $errors->has('objeto_descripcion') ? 'is-invalid' : '' }}"
                    name="objeto_descripcion" id="objeto_descripcion" value="{{ old('objeto_descripcion', '') }}"></textarea>
                @if ($errors->has('objeto_descripcion'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('objeto_descripcion') }}
                    </div>
                @endif

            </div>
            <!--form-group-->
        </div>

        <div class="row" style="margin-left: 10px; margin-right: 10px;">
            <div class="distancia form-group col-md-12">
                <label for="cobertura" class="txt-tamaño">
                    Cobertura, Rango geográfico en el cual presta los servicios </label>
                <textarea class="form-control materialize-textarea {{ $errors->has('cobertura') ? 'is-invalid' : '' }}"
                    name="cobertura" id="cobertura" value="{{ old('cobertura', '') }}"></textarea>
                @if ($errors->has('cobertura'))
                    <div class="invalid-feedback red-text">
                        {{ $errors->first('cobertura') }}
                    </div>
                @endif

            </div>
        </div>
        <!--form-group-->
        <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
            <div class="col s12 m12 right-align btn-grd distancia">
                <a href="{{ route('contract_manager.proveedor.index') }}" class="btn btn_cancelar">Cancelar</a>
                <button class="btn-redondeado btn btn-danger" type="submit">
                    GUARDAR
                </button>
            </div>
        </div>
    </div>

</form>

@endsection

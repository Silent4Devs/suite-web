<div class="card card-content row">
    <div class="col s12" style="margin-bottom: 30px;">
        @if($show_proveedor)
            <h3 class="titulo-form">CLIENTE</h3>
            <p class="instrucciones">Información sobre el cliente</p>
         @else
             <h3 class="titulo-form">AGREGAR CLIENTE</h3>
            <p class="instrucciones">Por favor edite los datos del cliente para actualizarlo</p>
        @endif
    </div>

    <h4 class="sub-titulo-form col s12">DATOS GENERALES</h4>

    <div class="col s12 l6 distancia">
        <label for="razon_social" class="txt-tamaño"><i class="far fa-building iconos-crear"></i> Razón Social<font
                class="asterisco">*</font></label>
        <input class="form-control" type="text" name="razon_social" id="razon_social"
            value="{{ $proveedores->razon_social }}" {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('razon_social'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('razon_social') }}
            </div>
        @endif
        <span class="help-block"></span>
    </div>
    <div class="col s12 l6 distancia">
        <label for="nombre_comercial" class="txt-tamaño"><i class="far fa-building iconos-crear"></i> Nombre Comercial
            del Cliente<font class="asterisco">*</font> </label>
        <input class="form-control" name="nombre_comercial" id="nombre_comercial"
            value="{{ $proveedores->nombre_comercial }}" {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('nombre_comercial'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('nombre_comercial') }}
            </div>
        @endif
    </div>
    <div class="col s12 l6 distancia">
        <label for="rfc" class="txt-tamaño"><i class="fas fa-file-alt iconos-crear"></i> RFC persona moral o persona
            física</label>
        <input class="form-control" name="rfc" id="rfc" value="{{ $proveedores->rfc }}"
            {{ $show_proveedor ? 'readonly' : '' }}>
        @if ($errors->has('rfc'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('rfc') }}
            </div>
        @endif
    </div>
    <div class="col s12 m6 distancia">
        <label for="id_fiscale" class="txt-tamaño"><i class="material-icons-outlined iconos-crear">article</i>Persona fiscal<font class="asterisco">*</font></label>
        <select class="selectBuscar" name="id_fiscale" class="required center-align" >
            {{-- @if ($personas) --}}
                @foreach ($personas as $persona)
                    <option value="{{$persona->id}}"
                        {{ $persona->id == $persona->id ? 'selected' : '' }}>
                        {{ $persona->persona_fiscal }}</option>
                @endforeach
            {{-- @else --}}
                {{-- <option value="">No hay proveedores registrados</option> --}}
            {{-- @endif --}}
        </select>
    </div>
</div>

<div class="card card-content row">

    <h4 class="sub-titulo-form col s12">DOMICILIO FISCAL</h4>

    <div class="col s12 l6 distancia">
        <label class="required txt-tamaño" for="calle"><i class="fas fa-map-marker-alt iconos-crear"></i> Calle y Número<font class="asterisco">*</font>
        </label>
        <input class="form-control" name="calle" id="calle" value="{{ $proveedores->calle }}"
            {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('calle'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('calle') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="colonia" class="txt-tamaño"><i class="fas fa-map-marker-alt iconos-crear"></i> Colonia<font
                class="asterisco">*</font></label>
        <input class="form-control" name="colonia" id="colonia" value="{{ $proveedores->colonia }}"
            {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('colonia'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('colonia') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="ciudad" class="txt-tamaño"><i class="fas fa-map-marker-alt iconos-crear"></i> Ciudad o Municipio/
            País:<font class="asterisco">*</font></label>
        <input class="form-control" name="ciudad" id="ciudad" value="{{ $proveedores->ciudad }}"
            {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('ciudad'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('ciudad') }}
            </div>
        @endif
    </div>
    <!--col-->



    <div class="col s12 l6 distancia">
        <label for="codigo_postal" class="txt-tamaño"><i class="fas fa-map-marker-alt iconos-crear"></i> Código Postal:<font class="asterisco">*</font>
        </label>
        <input class="form-control" name="codigo_postal" id="codigo_postal" type="number"
            value="{{ $proveedores->codigo_postal }}" {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('codigo_postal'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('codigo_postal') }}
            </div>
        @endif
    </div>
    <div class="col s12 l6 distancia">
        <label for="telefono" class="txt-tamaño"><i class="fas fa-phone-square-alt iconos-crer"></i></i>
            Teléfono:</label>
        <input class="form-control" name="telefono" id="telefono" value="{{ $proveedores->telefono }}"
            {{ $show_proveedor ? 'readonly' : '' }}>
        @if ($errors->has('telefono'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('telefono') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="pagina_web" class="txt-tamaño"><i class="fas fa-laptop iconos-crear"></i> Página Web:</label>
        <input class="form-control" name="pagina_web" id="pagina_web" value="{{ $proveedores->pagina_web }}"
            type="url" {{ $show_proveedor ? 'readonly' : '' }}>
        @if ($errors->has('pagina_web'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('pagina_web') }}
            </div>
        @endif

    </div>
</div>

<div class="card card-content row">

    <h4 class="sub-titulo-form col s12">DATOS DEL CONTACTO</h4>

    <div class="col s12 l6 distancia">
        <label for="nombre_completo" class="txt-tamaño"><i class="fas fa-user iconos-crear"></i></i> Nombre Completo del
            contacto<font class="asterisco">*</font></label>
        <input class="form-control" name="nombre_completo" id="nombre_completo"
            value="{{ $proveedores->nombre_completo }}" {{ $show_proveedor ? 'readonly' : '' }} required>
        @if ($errors->has('nombre_completo'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('nombre_completo') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="puesto" class="txt-tamaño"><i class="fas fa-briefcase iconos-crear"></i> Puesto</label>
        <input class="form-control" name="puesto" id="puesto" value="{{ $proveedores->puesto }}"
            {{ $show_proveedor ? 'readonly' : '' }}>
        @if ($errors->has('puesto'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('puesto') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="correo" class="txt-tamaño"> <i class="fas fa-envelope iconos-crear"></i> Correo Electrónico</label>
        <input class="form-control" name="correo" id="correo" value="{{ $proveedores->correo }}" type="email"
            {{ $show_proveedor ? 'readonly' : '' }}>
        @if ($errors->has('correo'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('correo') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="celular" class="txt-tamaño"><i class="fas fa-mobile-alt iconos-crear"></i> Celular</label>
        <input class="form-control" name="celular" id="celular" value="{{ $proveedores->celular }}"
            {{ $show_proveedor ? 'readonly' : '' }}>
        @if ($errors->has('celular'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('celular') }}
            </div>
        @endif

    </div>
</div>

<div class="card card-content row">

    <h4 class="sub-titulo-form col s12">PRODUCTOS Y/O SERVICIOS</h4>

    <div class="col s12 l6 distancia">
        <label for="objeto_descripcion" class="txt-tamaño"><i class="fas fa-people-carry iconos-crear"></i> Objeto
            social / Descripción del servicio o producto</label>
        <textarea class="form-control materialize-textarea" name="objeto_descripcion" id="objeto_descripcion"
            value="{{ $proveedores->objeto_descripcion }}" {{ $show_proveedor ? 'readonly' : '' }}>{{ old('objeto_descripcion',  $proveedores->objeto_descripcion) }}</textarea>
        @if ($errors->has('objeto_descripcion'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('objeto_descripcion') }}
            </div>
        @endif

    </div>
    <div class="col s12 l6 distancia">
        <label for="cobertura" class="txt-tamaño"><i class="fas fa-map-marker-alt iconos-crear"></i> Cobertura, Rango
            geográfico en el cual presta los servicios</label>
        <textarea class="form-control materialize-textarea" name="cobertura" id="cobertura"
            {{ $show_proveedor ? 'readonly' : '' }}>{{ old('cobertura',  $proveedores->cobertura) }}</textarea>
        @if ($errors->has('cobertura'))
            <div class="invalid-feedback red-text">
                {{ $errors->first('cobertura') }}
            </div>
        @endif

    </div>
    @if (!$show_proveedor)
    {{-- <div class="row"> --}}
        <div class="col s12 right-align distancia">
            <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secundario" style="background: #959595 !important">Cancelar</a>
            <button class="btn" type="submit">
                GUARDAR
            </button>
        </div>
    {{-- </div> --}}
    <!--row-->
@endif
</div>



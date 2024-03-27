<div class="card card-content row">
    <div class="col s12" style="margin-bottom: 30px;">
        @if ($show_proveedor)
            <h3 class="titulo-form">CLIENTE</h3>
            <p class="instrucciones">Información sobre el cliente</p>
        @else
            <div class="col s12" style="margin-top: 30px;">
                <h3 class="titulo-form">EDITAR CLIENTE</h3>
                Por favor edite los datos del cliente para actualizarlo
            </div>
        @endif
    </div>

    <div class="col s12">
        <h4>DATOS GENERALES</h4>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="razon_social" class="txt-tamaño"> Razón Social<font class="asterisco">*</font></label>
            <input class="form-control" type="text" name="razon_social" id="razon_social"
                value="{{ $proveedores->razon_social }}" {{ $show_proveedor ? 'readonly' : '' }} required>
            @if ($errors->has('razon_social'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('razon_social') }}
                </div>
            @endif
            <span class="help-block"></span>
        </div>
        <div class="distancia form-group col-md-6">
            <label for="nombre_comercial" class="txt-tamaño"> Nombre Comercial
                del Cliente<font class="asterisco">*</font> </label>
            <input class="form-control" name="nombre_comercial" id="nombre_comercial"
                value="{{ $proveedores->nombre_comercial }}" {{ $show_proveedor ? 'readonly' : '' }} required>
            @if ($errors->has('nombre_comercial'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('nombre_comercial') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px; margin-bottom: 30px;">
        <div class="distancia form-group col-md-6">
            <label for="rfc" class="txt-tamaño"> RFC persona moral o persona
                física</label>
            <input class="form-control" name="rfc" id="rfc" value="{{ $proveedores->rfc }}"
                {{ $show_proveedor ? 'readonly' : '' }}>
            @if ($errors->has('rfc'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('rfc') }}
                </div>
            @endif
        </div>

        <div class="distancia form-group col-md-6">
            <label for="id_fiscale" class="txt-tamaño">Persona fiscal<font class="asterisco">*</font></label><br>
            <select class="selectBuscar form-control" name="id_fiscale" class="required center-align">
                @if (!$personas->isEmpty())
                    @foreach ($personas as $persona)
                        <option value="{{ $persona->id }}" {{ $persona->id == $persona->id ? 'selected' : '' }}>
                            {{ $persona->persona_fiscal }}</option>
                    @endforeach
                @else
                    <option value="" disabled>No hay proveedores registrados</option>
                @endif
            </select>
        </div>
    </div>
</div>

<div class="card card-content row">

    <div class="col s12">
        <h4 style="margin-top: 20px;">DOMICILIO FISCAL</h4>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label class="required txt-tamaño" for="calle"> Calle y Número<font class="asterisco">*</font>
            </label>
            <input class="form-control" name="calle" id="calle" value="{{ $proveedores->calle }}"
                {{ $show_proveedor ? 'readonly' : '' }} required>
            @if ($errors->has('calle'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('calle') }}
                </div>
            @endif

        </div>
        <div class="distancia form-group col-md-6">
            <label for="colonia" class="txt-tamaño"> Colonia<font class="asterisco">*</font></label>
            <input class="form-control" name="colonia" id="colonia" value="{{ $proveedores->colonia }}"
                {{ $show_proveedor ? 'readonly' : '' }} required>
            @if ($errors->has('colonia'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('colonia') }}
                </div>
            @endif

        </div>
    </div>
    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="ciudad" class="txt-tamaño"> Ciudad o Municipio/
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

        <div class="distancia form-group col-md-6">
            <label for="codigo_postal" class="txt-tamaño"> Código Postal:<font class="asterisco">*</font>
            </label>
            <input class="form-control" name="codigo_postal" id="codigo_postal" type="number"
                value="{{ $proveedores->codigo_postal }}" {{ $show_proveedor ? 'readonly' : '' }} required>
            @if ($errors->has('codigo_postal'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('codigo_postal') }}
                </div>
            @endif
        </div>
    </div>
    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="telefono" class="txt-tamaño">
                Teléfono:</label>
            <input class="form-control" name="telefono" id="telefono" value="{{ $proveedores->telefono }}"
                {{ $show_proveedor ? 'readonly' : '' }}>
            @if ($errors->has('telefono'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('telefono') }}
                </div>
            @endif

        </div>

        <div class="distancia form-group col-md-6">
            <label for="pagina_web" class="txt-tamaño"> Página Web:</label>
            <input class="form-control" name="pagina_web" id="pagina_web" value="{{ $proveedores->pagina_web }}"
                type="url" {{ $show_proveedor ? 'readonly' : '' }}>
            @if ($errors->has('pagina_web'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('pagina_web') }}
                </div>
            @endif

        </div>
    </div>
</div>

<div class="card card-content row">

    <div class="col s12">
        <h4 style="margin-top: 20px;">DATOS DEL CONTACTO</h4>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-7">
            <label for="nombre_completo" class="txt-tamaño"> Nombre Completo del
                contacto<font class="asterisco">*</font></label>
            <input class="form-control" name="nombre_completo" id="nombre_completo"
                value="{{ $proveedores->nombre_completo }}" {{ $show_proveedor ? 'readonly' : '' }} required>
            @if ($errors->has('nombre_completo'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('nombre_completo') }}
                </div>
            @endif

        </div>
        <div class="distancia form-group col-md-5">
            <label for="puesto" class="txt-tamaño"> Puesto</label>
            <input class="form-control" name="puesto" id="puesto" value="{{ $proveedores->puesto }}"
                {{ $show_proveedor ? 'readonly' : '' }}>
            @if ($errors->has('puesto'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('puesto') }}
                </div>
            @endif

        </div>
    </div>
    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-6">
            <label for="correo" class="txt-tamaño"> Correo Electrónico</label>
            <input class="form-control" name="correo" id="correo" value="{{ $proveedores->correo }}"
                type="email" {{ $show_proveedor ? 'readonly' : '' }}>
            @if ($errors->has('correo'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('correo') }}
                </div>
            @endif
        </div>

        <div class="distancia form-group col-md-6">
            <label for="celular" class="txt-tamaño"> Celular</label>
            <input class="form-control" name="celular" id="celular" value="{{ $proveedores->celular }}"
                {{ $show_proveedor ? 'readonly' : '' }}>
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
            <label for="objeto_descripcion" class="txt-tamaño"> Objeto
                social / Descripción del servicio o producto</label>
            <textarea class="form-control materialize-textarea" name="objeto_descripcion" id="objeto_descripcion"
                value="{{ $proveedores->objeto_descripcion }}" {{ $show_proveedor ? 'readonly' : '' }}>{{ old('objeto_descripcion', $proveedores->objeto_descripcion) }}</textarea>
            @if ($errors->has('objeto_descripcion'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('objeto_descripcion') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row" style="margin-left: 10px; margin-right: 10px;">
        <div class="distancia form-group col-md-12">
            <label for="cobertura" class="txt-tamaño"> Cobertura, Rango
                geográfico en el cual presta los servicios</label>
            <textarea class="form-control materialize-textarea" name="cobertura" id="cobertura"
                {{ $show_proveedor ? 'readonly' : '' }}>{{ old('cobertura', $proveedores->cobertura) }}</textarea>
            @if ($errors->has('cobertura'))
                <div class="invalid-feedback red-text">
                    {{ $errors->first('cobertura') }}
                </div>
            @endif
        </div>
    </div>
    {{-- <div class="row"> --}}
    <div class="form-group col-12 text-right mt-4" style="margin-left: 10px; margin-right: 10px;">
        <div class="col s12 m12 right-align btn-grd distancia">
            <a href="{{ route('contract_manager.proveedor.index') }}" class="btn btn_cancelar">Cancelar</a>
            @if (!$show_proveedor)
                <button class="btn btn-primary" type="submit">
                    GUARDAR
                </button>
            @endif
        </div>
        {{-- </div> --}}
        <!--row-->
    </div>
</div>

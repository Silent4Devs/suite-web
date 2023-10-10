@extends('layouts.admin')
@section('content')
    <style type="text/css">
        .btn-transparent {
            background-color: rgba(0, 0, 0, 0) !important;
            color: #3490dc !important;
        }
    </style>


    {{ Breadcrumbs::render('timesheet-clientes-form') }}

    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Cliente</font>
    </h5>

    <div class="card card-body">
        <form action="{{ asset('admin/timesheet/clientes/update') }}/{{ $cliente->id }}" method="POST" class="row">
            @csrf
            <div class="form-group col-md-2">
                <label class="form-label"><i class="fas fa-address-card iconos-crear"></i> ID <sup
                        style="color: red;">*</sup></label>
                <input type="" required name="identificador" class="form-control" required
                    value="{{ $cliente->identificador }}">
            </div>

            <div class="form-group col-md-5">
                <label class="form-label"><i class="far fa-building iconos-crear"></i> Razon Social <sup
                        style="color: red;">*</sup></label>
                <input type="" required name="razon_social" class="form-control" value="{{ $cliente->razon_social }}"
                    required>
            </div>

            <div class="form-group col-md-5">
                <label class="form-label"><i class="far fa-building iconos-crear"></i> Nombre Comercial del Cliente <sup
                        style="color: red;">*</sup></label>
                <input type="" required name="nombre" class="form-control" required value="{{ $cliente->nombre }}">
            </div>

            <div class="form-group col-12">
                <div class="btn btn-primary btn-transparent" id="btn_registro_completo">Registro Completo</div>
            </div>

            <div id="registro_completo" class="d-none w-100 row" style="margin:0 !important;">
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> RFC</label>
                    <input type="" name="rfc" class="form-control" value="{{ $cliente->rfc }}">
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DOMICILIO</p>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Calle y Número</label>
                    <input type="" name="calle" class="form-control" value="{{ $cliente->calle }}">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Colonia</label>
                    <input type="" name="colonia" class="form-control" value="{{ $cliente->colonia }}">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Ciudad o Municipio/
                        País</label>
                    <input type="" name="ciudad" class="form-control" value="{{ $cliente->ciudad }}">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Código Postal </label>
                    <input type="" name="codigo_postal" class="form-control" value="{{ $cliente->codigo_postal }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="" class="txt-tamaño">

                        Teléfono*
                    </label>
                    <input id="phone" type="text" name="telefono" value="{{ $cliente->telefono }}"
                        class="form-control" pattern="\x2b[0-9]+" size="20" placeholder="+54976284353">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-laptop iconos-crear"></i> Página Web</label>
                    <input type="" name="pagina_web" class="form-control" value="{{ $cliente->pagina_web }}">
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DATOS DEL CONTACTO</p>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre Completo del contacto</label>
                    <input type="" name="nombre_contacto" class="form-control"
                        value="{{ $cliente->nombre_contacto }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i> Puesto </label>
                    <input type="" name="puesto_contacto" class="form-control"
                        value="{{ $cliente->puesto_contacto }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electronico</label>
                    <input type="email" id="foo" class="form-control" value="{{ $cliente->correo_contacto }}"
                        placeholder="example@example.com" name="correo_contacto">

                    <h6 id="emailV"></h6>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-mobile-alt iconos-crear"></i> Celular </label>
                    <input pattern="[0-9]{10}" name="celular_contacto" class="form-control"
                        value="{{ $cliente->celular_contacto }}">
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">PRODUCTOS Y/O SERVICIOS</p>
                    </div>
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label">Objeto social / Descripción
                        del servicio o producto</label>
                    <textarea class="form-control" name="objeto_descripcion" id="objeto_descripcion">{{ old('objeto_descripcion', $cliente->objeto_descripcion) }}</textarea>
                </div>

                <div class="form-group col-md-12">
                    <label class="form-label">Cobertura, Rango geográfico
                        en el cual presta los servicios</label>
                    <textarea class="form-control" name="cobertura" id="cobertura">{{ old('objeto_descripcion', $cliente->cobertura) }}</textarea>
                </div>
            </div>

            <div class="form-group col-12 text-right mt-4">
                <a href="{{ route('admin.timesheet-clientes') }}" class="btn btn_cancelar">Cancelar</a>
                <button class="btn btn-success">Guardar</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        var emailV = document.getElementById('emailV');
        $(function() {
            $(document).on('keyup', '#foo', function() {
                var val = $(this).val().trim(),
                    reg =
                    /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                if (reg.test(val) == false) {
                    emailV.innerHTML = "correo incorrecto";
                } else {
                    emailV.innerHTML = "";
                }
            });
        });
    </script>
    <script type="text/javascript">
        $('#btn_registro_completo').click(function() {
            $('#registro_completo').toggleClass('d-none');
            $('#btn_registro_completo').toggleClass('btn-transparent');
        });
    </script>
@endsection

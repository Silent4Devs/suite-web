@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet/timesheet.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <style type="text/css">
        .btn-transparent {
            background-color: rgba(0, 0, 0, 0) !important;
            color: #3490dc !important;
        }
    </style>


    {{ Breadcrumbs::render('timesheet-clientes-form') }}


    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Cliente</font>
    </h5>

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    <div class="card card-body">
        <div class="row">
            <div class="col-12">
                <h4 class="title-card-time">Nuevo Cliente</h4>
                <hr class="my-4">
            </div>
        </div>
        <form action="{{ asset('admin/timesheet/clientes/store') }}" method="POST" class="row">
            @csrf
            <div class="form-group col-md-2 anima-focus">
                <input id="identificador" name="identificador" placeholder="" type="text" maxlength="255"
                    class="form-control" required value="{{ old('identificador') }}">
                <label for="identificador" class="asterisco">ID*</label>
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input name="razon_social" placeholder="" maxlength="255" class="form-control"
                    value="{{ old('razon_social') }}" required>
                <label for="razon_social" class="asterisco">Razón Social*</label>
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input name="nombre" placeholder="" maxlength="255" class="form-control" required
                    value="{{ old('nombre') }}">
                <label for="nombre" class="asterisco">Nombre Comercial del Cliente*</label>
            </div>

            <div class="form-group col-12">
                <div class="btn tb-btn-primary btn-transparent" id="btn_registro_completo">Registro Completo</div>
            </div>

            <div id="registro_completo" class="d-none w-100 row" style="margin:0 !important;">
                <div class="form-group col-md-6 anima-focus">
                    <input name="rfc" placeholder="" maxlength="255"
                        pattern="^[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0-9A]$"
                        class="form-control" value="{{ old('rfc') }}">
                    <label for="rfc" class="asterisco">RFC*</label>
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="mb-3" style="background-color:#fff;">
                        <p class="mb-1">DOMICILIO</p>
                    </div>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="calle" class="form-control" maxlength="255" placeholder="" value="{{ old('calle') }}">
                    <label for="calle" class="asterisco">Calle y Número*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="colonia" placeholder="" maxlength="255" class="form-control" value="{{ old('colonia') }}">
                    <label for="colonia" class="asterisco">Colonia*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="ciudad" placeholder="" maxlength="255" class="form-control" value="{{ old('ciudad') }}">
                    <label for="ciudad" class="asterisco">Ciudad o Municipio / País*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="codigo_postal" placeholder="" maxlength="255" class="form-control"
                        value="{{ old('codigo_postal') }}">
                    <label for="codigo_postal" class="asterisco">Código Postal*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input id="phone" type="text" pattern="[0-9]+" title="Por favor, introduce solo números"
                        name="telefono" value="{{ old('telefono') }}" maxlength="12" class="form-control" size="20"
                        placeholder="">
                    <label for="telefono" class="asterisco">Teléfono*</label>
                    <div class="error-message"></div>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="pagina_web" placeholder="" maxlength="255" class="form-control"
                        value="{{ old('pagina_web') }}">
                    <label for="pagina_web" class="asterisco">Página Web*</label>
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="mb-3" style="background-color:#fff;">
                        <p class="mb-1">DATOS DEL CONTACTO</p>
                    </div>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input name="nombre_contacto" placeholder="" maxlength="255" class="form-control"
                        value="{{ old('nombre_contacto') }}">
                    <label for="nombre_contacto" class="asterisco">Nombre Completo del contacto*</label>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input placeholder="" name="puesto_contacto" maxlength="255" class="form-control"
                        value="{{ old('puesto_contacto') }}">
                    <label for="puesto_contacto" class="asterisco">Puesto*</label>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="email" id="foo" class="form-control" maxlength="255"
                        value="{{ old('correo_contacto') }}" placeholder="" name="correo_contacto">
                    <label for="correo_contacto" class="asterisco">Correo Electrónico*</label>
                    <h6 id="emailV"></h6>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="tel" pattern="[0-9]+" maxlength="10" title="Por favor, introduce solo números"
                        name="celular_contacto" placeholder="" class="form-control"
                        value="{{ old('celular_contacto') }}">
                    <label for="celular_contacto" class="asterisco">Celular*</label>
                    <div class="error-message"></div>
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="mb-3" style="background-color:#fff;">
                        <p class="mb-1">PRODUCTOS Y/O SERVICIOS</p>
                    </div>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="objeto_descripcion" maxlength="550" id="objeto_descripcion">{{ old('objeto_descripcion', '') }}</textarea>
                    <label for="objeto_descripcion" class="asterisco">Objeto social / Descripción del servicio o
                        producto*</label>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="cobertura" maxlength="550" id="cobertura">{{ old('cobertura', '') }}</textarea>
                    <label for="cobertura" class="asterisco">Cobertura, Rango geográfico en el cual presta los
                        servicios*</label>
                </div>
            </div>

            <div class="form-group col-12 text-right mt-4">
                <a href="{{ route('admin.timesheet-clientes') }}" class="btn btn-outline-primary">Cancelar</a>
                <button class="btn btn-primary">Guardar</button>
            </div>
        </form>
    </div>
@endsection


@section('scripts')
    @parent
    <script>
        //funcion que valida correo
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

        function myFunction() {
            window.alert('Input validado');
        }
    </script>
    <script type="text/javascript">
        $('#btn_registro_completo').click(function() {
            $('#registro_completo').toggleClass('d-none');
            $('#btn_registro_completo').toggleClass('btn-transparent');
        });
    </script>
@endsection

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

    {{-- @include('admin.timesheet.complementos.cards') --}}
    @include('admin.timesheet.complementos.admin-aprob')
    {{-- @include('admin.timesheet.complementos.blue-card-header') --}}

    {{ Breadcrumbs::render('timesheet-clientes-form') }}

    <h5 class="col-12 titulo_general_funcion">Timesheet: <font style="font-weight:lighter;">Cliente</font>
    </h5>

    <div class="card card-body">
        <div class="row">
            <div class="col-12">
                <h4 class="title-card-time">Cliente</h4>
                <hr class="my-4">
            </div>
        </div>
        <form action="{{ asset('admin/timesheet/clientes/update') }}/{{ $cliente->id }}" method="POST" class="row">
            @csrf
            <div class="form-group col-md-2 anima-focus">
                <input required name="identificador" placeholder="" maxlength="255" type="text" class="form-control"
                    value="{{ $cliente->identificador }}">
                <label for="identificador" class="asterisco">ID*</label>
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input required name="razon_social" placeholder="" maxlength="255" class="form-control"
                    value="{{ $cliente->razon_social }}">
                <label for="razon_social" class="asterisco">Razón Social*</label>
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input required name="nombre" placeholder="" maxlength="255" class="form-control"
                    value="{{ $cliente->nombre }}">
                <label for="nombre" class="asterisco">Nombre Comercial del Cliente*</label>
            </div>

            <div class="form-group col-12">
                <div class="btn tb-btn-primary btn-transparent" id="btn_registro_completo">Registro Completo</div>
            </div>

            <div id="registro_completo" class="d-none w-100 row" style="margin:0 !important;">
                <div class="form-group col-md-6 anima-focus">
                    <input name="rfc" placeholder="" maxlength="255" class="form-control" value="{{ $cliente->rfc }}">
                    <label for="rfc" class="asterisco">RFC*</label>
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="mb-3" style="background-color:#fff;">
                        <p class="mb-1">DOMICILIO</p>
                    </div>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="calle" maxlength="255" class="form-control" value="{{ $cliente->calle }}">
                    <label for="calle" class="asterisco">Calle y Número*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="colonia" maxlength="255" class="form-control" value="{{ $cliente->colonia }}">
                    <label for="colonia" class="asterisco">Colonia*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="ciudad" maxlength="255" class="form-control" value="{{ $cliente->ciudad }}">
                    <label for="ciudad" class="asterisco">Ciudad o Municipio / País*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="codigo_postal" class="form-control" maxlength="255" value="{{ $cliente->codigo_postal }}">
                    <label for="codigo_postal" class="asterisco">Código Postal*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input id="phone" name="telefono" pattern="[0-9]+" maxlength="12"
                        title="Por favor, introduce solo números" value="{{ $cliente->telefono }}" class="form-control"
                        size="20" placeholder="">
                    <label for="telefono" class="asterisco">Teléfono*</label>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input name="pagina_web" maxlength="255" class="form-control" value="{{ $cliente->pagina_web }}">
                    <label for="pagina_web" class="asterisco">Página Web*</label>
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="mb-3" style="background-color:#fff;">
                        <p class="mb-1">DATOS DEL CONTACTO</p>
                    </div>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input name="nombre_contacto" maxlength="255" class="form-control"
                        value="{{ $cliente->nombre_contacto }}">
                    <label for="nombre_contacto" class="asterisco">Nombre Completo del contacto*</label>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input name="puesto_contacto" maxlength="255" class="form-control"
                        value="{{ $cliente->puesto_contacto }}">
                    <label for="puesto_contacto" class="asterisco">Puesto*</label>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="email" id="foo" maxlength="255" class="form-control"
                        value="{{ $cliente->correo_contacto }}" name="correo_contacto">
                    <label for="correo_contacto" class="asterisco">Correo Electrónico*</label>
                    <h6 id="emailV"></h6>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input pattern="[0-9]+" title="Por favor, introduce solo números" maxlength="10"
                        name="celular_contacto" class="form-control" value="{{ $cliente->celular_contacto }}">
                    <label for="celular_contacto" class="asterisco">Celular*</label>
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="mb-3" style="background-color:#fff;">
                        <p class="mb-1">PRODUCTOS Y/O SERVICIOS</p>
                    </div>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="objeto_descripcion" maxlength="550" id="objeto_descripcion">{{ old('objeto_descripcion', $cliente->objeto_descripcion) }}</textarea>
                    <label for="objeto_descripcion" class="asterisco">Objeto social / Descripción del servicio o
                        producto*</label>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="cobertura" maxlength="550" id="cobertura">{{ old('cobertura', $cliente->cobertura) }}</textarea>
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

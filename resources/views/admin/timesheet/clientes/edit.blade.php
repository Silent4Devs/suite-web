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
            <div class="form-group col-md-2 anima-focus">
                <input type="" required name="identificador" placeholder=""  class="form-control" required
                    value="{{ $cliente->identificador }}">
                    {!! Form::label('identificador', 'ID*', ['class' => 'asterisco']) !!}
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input type="" placeholder="" required name="razon_social" class="form-control" value="{{ $cliente->razon_social }}"
                    required>
                    {!! Form::label('razon_social', 'Razon Social*', ['class' => 'asterisco']) !!}
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input type="" required name="nombre" placeholder="" class="form-control" required value="{{ $cliente->nombre }}">
                {!! Form::label('nombre', 'Nombre Comercial del Cliente*', ['class' => 'asterisco']) !!}
            </div>

            <div class="form-group col-12">
                <div class="btn btn-primary btn-transparent" id="btn_registro_completo">Registro Completo</div>
            </div>

            <div id="registro_completo" class="d-none w-100 row" style="margin:0 !important;">
                <div class="form-group col-md-6  anima-focus">
                    <input type="" placeholder="" name="rfc" class="form-control" value="{{ $cliente->rfc }}">
                    {!! Form::label('rfc', 'RFC*', ['class' => 'asterisco']) !!}
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DOMICILIO</p>
                    </div>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" placeholder="" name="calle" class="form-control" value="{{ $cliente->calle }}">
                    {!! Form::label('calle', 'Calle y Número*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" name="colonia" placeholder="" class="form-control" value="{{ $cliente->colonia }}">
                    {!! Form::label('colonia', 'Colonia*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" placeholder="" name="ciudad" class="form-control" value="{{ $cliente->ciudad }}">
                    {!! Form::label('ciudad', ' Ciudad o Municipio/
                    País*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" name="codigo_postal" class="form-control" value="{{ $cliente->codigo_postal }}">
                    {!! Form::label('codigo_postal', 'Código Postal*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input id="phone" type="text" name="telefono" value="{{ $cliente->telefono }}"
                        class="form-control" pattern="\x2b[0-9]+" size="20" placeholder="">
                        {!! Form::label('telefono', 'Teléfono*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" placeholder="" name="pagina_web" class="form-control" value="{{ $cliente->pagina_web }}">
                    {!! Form::label('pagina_web', 'Página Web*', ['class' => 'asterisco']) !!}
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DATOS DEL CONTACTO</p>
                    </div>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="" placeholder="" name="nombre_contacto" class="form-control"
                        value="{{ $cliente->nombre_contacto }}">
                        {!! Form::label('nombre_contacto', 'Nombre Completo del
                        contacto*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="" placeholder="" name="puesto_contacto" class="form-control"
                        value="{{ $cliente->puesto_contacto }}">
                        {!! Form::label('puesto_contacto', 'Puesto*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="email" id="foo" placeholder="" class="form-control" value="{{ $cliente->correo_contacto }}"
                        placeholder="" name="correo_contacto">
                        {!! Form::label('correo_contacto', 'Correo Electronico*', ['class' => 'asterisco']) !!}

                    <h6 id="emailV"></h6>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input pattern="[0-9]{10}" name="celular_contacto" placeholder="" class="form-control"
                        value="{{ $cliente->celular_contacto }}">
                        {!! Form::label('celular_contacto', 'Celular*', ['class' => 'asterisco']) !!}
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">PRODUCTOS Y/O SERVICIOS</p>
                    </div>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="objeto_descripcion" id="objeto_descripcion">{{ old('objeto_descripcion', $cliente->objeto_descripcion) }}</textarea>
                    {!! Form::label('objeto_descripcion', 'Objeto social / Descripción
                        del servicio o producto*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="cobertura" id="cobertura">{{ old('objeto_descripcion', $cliente->cobertura) }}</textarea>
                    {!! Form::label('cobertura', 'Cobertura, Rango geográfico
                    en el cual presta los servicios*', ['class' => 'asterisco']) !!}
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

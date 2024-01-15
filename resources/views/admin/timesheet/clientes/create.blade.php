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
        <form action="{{ asset('admin/timesheet/clientes/store') }}" method="POST" class="row">
            @csrf
            <div class="form-group col-md-2 anima-focus">
                <input type="" name="identificador" placeholder="" class="form-control" required value="{{ old('identificador') }}">
                {!! Form::label('identificador', 'ID*', ['class' => 'asterisco']) !!}
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input type="" name="razon_social" placeholder="" class="form-control" value="{{ old('razon_social') }}" required>
                {!! Form::label('razon_social', 'Razon Social*', ['class' => 'asterisco']) !!}
            </div>

            <div class="form-group col-md-5 anima-focus">
                <input type="" name="nombre" placeholder="" class="form-control" required value="{{ old('nombre') }}">
                {!! Form::label('nombre', 'Nombre Comercial del Cliente*', ['class' => 'asterisco']) !!}
            </div>

            <div class="form-group col-12">
                <div class="btn btn-primary btn-transparent" id="btn_registro_completo">Registro Completo</div>
            </div>

            <div id="registro_completo" class="d-none w-100 row" style="margin:0 !important;">
                <div class="form-group col-md-6 anima-focus">
                    <input name="rfc" placeholder=""
                        pattern="^[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0-9A]$"
                        class="form-control" value="{{ old('rfc') }}">
                        {!! Form::label('rfc', 'RFC*', ['class' => 'asterisco']) !!}
                </div>

                {{-- <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Persona Fiscal</label>
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
                </div> --}}

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DOMICILIO</p>
                    </div>
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" name="calle" class="form-control" placeholder="" value="{{ old('calle') }}">
                    {!! Form::label('calle', 'Calle y Número*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4  anima-focus">
                    <input type="" name="colonia" placeholder="" class="form-control" value="{{ old('colonia') }}">
                    {!! Form::label('colonia', 'Colonia*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" name="ciudad" placeholder="" class="form-control" value="{{ old('ciudad') }}">
                    {!! Form::label('ciudad', ' Ciudad o Municipio/
                    País*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input type="" name="codigo_postal" placeholder="" class="form-control" value="{{ old('codigo_postal') }}">
                    {!! Form::label('codigo_postal', 'Código Postal*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-4 anima-focus">
                    <input id="phone" type="text" name="telefono" value="{{ old('telefono') }}" class="form-control"
                        pattern="\x2b[0-9]+" size="20" placeholder="">
                        {!! Form::label('telefono', 'Teléfono*', ['class' => 'asterisco']) !!}
                </div>
                <div class="form-group col-md-4 anima-focus">
                    <input type="" name="pagina_web" placeholder="" class="form-control" value="{{ old('pagina_web') }}">
                    {!! Form::label('pagina_web', 'Página Web*', ['class' => 'asterisco']) !!}
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DATOS DEL CONTACTO</p>
                    </div>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="" name="nombre_contacto" placeholder="" class="form-control"
                        value="{{ old('nombre_contacto') }}">
                        {!! Form::label('nombre_contacto', 'Nombre Completo del
                        contacto*', ['class' => 'asterisco']) !!}

                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="" placeholder="" name="puesto_contacto" class="form-control"
                        value="{{ old('puesto_contacto') }}">
                        {!! Form::label('puesto_contacto', 'Puesto*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="email" id="foo" class="form-control" value="{{ old('correo_contacto') }}"
                        placeholder="" name="correo_contacto">
                        {!! Form::label('correo_contacto', 'Correo Electronico*', ['class' => 'asterisco']) !!}

                    <h6 id="emailV"></h6>
                </div>

                <div class="form-group col-md-6 anima-focus">
                    <input type="tel" name="celular_contacto" pattern="[0-9]{10}" placeholder="" class="form-control"
                        value="{{ old('celular_contacto') }}">
                        {!! Form::label('correo_contacto', 'Celular*', ['class' => 'asterisco']) !!}
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">PRODUCTOS Y/O SERVICIOS</p>
                    </div>
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="objeto_descripcion" id="objeto_descripcion"
                        value="{{ old('objeto_descripcion', '') }}"></textarea>
                        {!! Form::label('objeto_descripcion', 'Objeto social / Descripción
                        del servicio o producto*', ['class' => 'asterisco']) !!}
                </div>

                <div class="form-group col-md-12 anima-focus">
                    <textarea class="form-control" name="cobertura" id="cobertura" value="{{ old('cobertura', '') }}"></textarea>
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

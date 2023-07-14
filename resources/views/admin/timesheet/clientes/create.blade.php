@extends('layouts.admin')
@section('content')

    <style type="text/css">
        .btn-transparent{
            background-color: rgba(0, 0, 0, 0) !important;
            color: #3490dc !important;
        }
    </style>


     {{ Breadcrumbs::render('timesheet-clientes-form') }}

	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Cliente</font> </h5>

	<div class="card card-body">
		<form action="{{ asset('admin/timesheet/clientes/store') }}" method="POST" class="row">
			@csrf
            <div class="form-group col-md-2">
                <label class="form-label"><i class="fas fa-address-card iconos-crear"></i> ID <sup style="color: red;">*</sup></label>
                <input type="text" maxlength="255"  name="identificador" class="form-control" required  value="{{ old('identificador') }}">
            </div>

	        <div class="form-group col-md-5">
                <label class="form-label"><i class="far fa-building iconos-crear"></i> Razon Social <sup style="color: red;">*</sup></label>
                <input type="text" maxlength="255" name="razon_social" class="form-control" value="{{ old('razon_social') }}" required>
            </div>

            <div class="form-group col-md-5">
                <label class="form-label"><i class="far fa-building iconos-crear"></i> Nombre Comercial del Cliente <sup style="color: red;">*</sup></label>
                <input type="text" maxlength="255" name="nombre" class="form-control" required value="{{ old('nombre') }}">
            </div>

            <div class="form-group col-12">
                <div class="btn btn-primary btn-transparent" id="btn_registro_completo">Registro Completo</div>
            </div>

            <div id="registro_completo" class="d-none w-100 row" style="margin:0 !important;">
                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> RFC<sup style="color: red;">*</sup></label>
                    <input type="text" placeholder="QUMA470929F37" required name="rfc" pattern="^[A-Z&Ñ]{3,4}[0-9]{2}(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])[A-Z0-9]{2}[0-9A]$" class="form-control" value="{{ old('rfc') }}">
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DOMICILIO</p>
                    </div>
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Calle y Número<sup style="color: red;">*</sup></label>
                    <input type="text" maxlength="255" required name="calle" class="form-control" value="{{ old('calle') }}">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Colonia<sup style="color: red;">*</sup></label>
                    <input type="text" maxlength="255" required name="colonia" class="form-control" value="{{ old('colonia') }}">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Ciudad o Municipio/ País<sup style="color: red;">*</sup></label>
                    <input type="text" maxlength="255" required name="ciudad" class="form-control" value="{{ old('ciudad') }}">
                </div>

                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i>  Código Postal<sup style="color: red;">*</sup> </label>
                    <input type="text" maxlength="20" required name="codigo_postal" class="form-control" value="{{ old('codigo_postal') }}">
                </div>

                <div class="form-group col-md-4">
                    <label for="" class="txt-tamaño">
                        Teléfono*<sup style="color: red;">*</sup>
                    </label>
                    <input id="phone" type="text" name="telefono" value="{{ old('telefono') }}" class="form-control" pattern="\x2b[0-9]+" size="20" placeholder="+54976284353" required>
                </div>
                <div class="form-group col-md-4">
                    <label class="form-label"><i class="fas fa-laptop iconos-crear"></i> Página Web<sup style="color: red;">*</sup></label>
                    <input type="text" required name="pagina_web" class="form-control" value="{{ old('pagina_web') }}">
                </div>

                <div class="col-md-12 col-sm-12 mt-4">
                    <div class="card vrd-agua" style="background-color:#345183;">
                        <p class="mb-1 text-center text-white">DATOS DEL CONTACTO</p>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre Completo del contacto<sup style="color: red;">*</sup></label>
                    <input type="text" maxlength="255" required name="nombre_contacto" class="form-control" value="{{ old('nombre_contacto') }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i> Puesto<sup style="color: red;">*</sup> </label>
                    <input type="text" maxlength="255"  name="puesto_contacto" class="form-control"  required value="{{ old('puesto_contacto') }}">
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electronico <sup style="color: red;">*</sup></label>
                    <input type="email" type="text" maxlength="255" id="foo" class="form-control"  value="{{ old('correo_contacto') }}"  placeholder="example@example.com" name="correo_contacto"
                        required>

                    <h6 id="emailV"></h6>
                </div>

                <div class="form-group col-md-6">
                    <label class="form-label"><i class="fas fa-mobile-alt iconos-crear"></i> Celular <sup style="color: red;">*</sup> </label>
                    <input type="tel" name="celular_contacto" pattern="[0-9]{10}" placeholder="54976284353" class="form-control" required value="{{ old('celular_contacto') }}">
                </div>
            </div>

            <div class="form-group col-12 text-right mt-4">
                <a href="{{ route('admin.timesheet-clientes') }}" class="btn btn_cancelar">Cancelar</a>
                <button  class="btn btn-success">Guardar</button>
            </div>
		</form>
	</div>

@endsection


@section('scripts')
    @parent
    <script>

    //funcion que valida correo
    var emailV = document.getElementById('emailV');
     $(function(){
     $(document).on('keyup','#foo',function(){
    var val = $(this).val().trim(),
        reg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if( reg.test(val) == false ){
        emailV.innerHTML =  "Correo no valido";
    }

    else{
        emailV.innerHTML =  "";
     }
     });
    });

    function myFunction() {
    window.alert('Input validado');
    }

    </script>
    <script type="text/javascript">
        $('#btn_registro_completo').click(function(){
            $('#registro_completo').toggleClass('d-none');
            $('#btn_registro_completo').toggleClass('btn-transparent');
        });
    </script>
@endsection

@extends('layouts.admin')
@section('content')
    
    <style type="text/css">
    </style>


     {{ Breadcrumbs::render('timesheet-index') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Clientes</font> </h5>

	<div class="card card-body">
		<form action="{{ asset('admin/timesheet/clientes/store') }}" method="POST" class="row">
			@csrf
	        <div class="form-group col-12">
                <label class="form-label"><i class="far fa-building iconos-crear"></i> Razon Social <sup style="color: red;">*</sup></label>
                <input type="" name="razon_social" class="form-control" required>
            </div>

            <div class="form-group col-md-6">
                <label class="form-label"><i class="far fa-building iconos-crear"></i> Nombre Comercial del Cliente</label>
                <input type="" name="nombre" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> RFC</label>
                <input type="" name="rfc" class="form-control">
            </div>

            <div class="col-md-12 col-sm-12 mt-4">
                <div class="card vrd-agua" style="background-color:#345183;">
                    <p class="mb-1 text-center text-white">DOMICILIO</p>
                </div>
            </div>

            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Calle y Número</label>
                <input type="" name="calle" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Colonia</label>
                <input type="" name="colonia" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Ciudad o Municipio/ País</label>
                <input type="" name="ciudad" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i>  Código Postal </label>
                <input type="" name="codigo_postal" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-phone-square-alt iconos-crear"></i> Teléfono</label>
                <input type="" name="telefono" class="form-control">
            </div>

            <div class="form-group col-md-4">
                <label class="form-label"><i class="fas fa-laptop iconos-crear"></i> Página Web</label>
                <input type="" name="pagina_web" class="form-control">
            </div>

            <div class="col-md-12 col-sm-12 mt-4">
                <div class="card vrd-agua" style="background-color:#345183;">
                    <p class="mb-1 text-center text-white">DATOS DEL CONTACTO</p>
                </div>
            </div>

            <div class="form-group col-md-6">
                <label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre Completo del contacto</label>
                <input type="" name="nombre_contacto" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i> Puesto </label>
                <input type="" name="puesto_contacto" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electronico</label>
                <input type="" name="correo_contacto" class="form-control">
            </div>

            <div class="form-group col-md-6">
                <label class="form-label"><i class="fas fa-mobile-alt iconos-crear"></i> Celular </label>
                <input type="" name="celular_contacto" class="form-control">
            </div>

            <div class="form-group col-12 text-right mt-4">
                <a href="" class="btn btn_cancelar">Cancelar</a>
                <button class="btn btn-success">Guardar</button>
            </div>
		</form>
	</div>
	
@endsection


@section('scripts')
    @parent
    
@endsection
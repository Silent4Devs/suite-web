@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-rocket mr-4"></i>Mejoras</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"

			<form class="row" method="POST" action="{{ route('admin.reportes-mejoras-store') }}">
				@csrf

				<div class="form-group mt-2 col-4">
					<label class="form-label">Nombre</label>
					<div class="form-control">{{ auth()->user()->empleado->name }}</div>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label">Area</label>
					<div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label">Puesto</label>
					<div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label">Correo electrónico</label>
					<div class="form-control">{{ auth()->user()->empleado->email }}</div>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label">Telefono</label>
					<div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label">Nombre de la mejora</label>
					<input type="" name="mejora" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Describa detalladamente la mejora</label>
					<textarea name="descripcion" class="form-control"></textarea>
				</div>

				<div class="form-group mt-4 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
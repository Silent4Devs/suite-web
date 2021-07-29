@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-lightbulb mr-4"></i>Sugerencias</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"

			<form class="row">

				<div class="form-group mt-2 col-md-6">
					<label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-2 col-md-6">
					<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i> Puesto</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-2 col-md-6">
					<label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo electrónico</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-2 col-md-6">
					<label class="form-label"><i class="fas fa-phone iconos-crear"></i> Teléfono</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i> Área a la que dirige su sugerencia</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user-tie iconos-crear"></i> Nombre del colaborador a quien dirige su sugerencia</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> Describa detalladamente su sugerencia</label>
					<textarea name="" class="form-control"></textarea>
				</div>

				<div class="form-group mt-2 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
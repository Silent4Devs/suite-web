@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-shield-virus mr-4"></i>Riesgos identificados</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clickc en el botón "Enviar"

			<form class="row">

				<div class="form-group mt-4 col-12">
					<label class="form-label">Nombre</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Correo electrónico</label>
					<input type="" name="" class="form-control">
				</div>

				<div class="form-group mt-4 col-6">
					<label class="form-label">Fecha</label>
					<input type="date" name="" class="form-control">
				</div>
				<div class="form-group mt-4 col-6">
					<label class="form-label">Proceso al que afecta</label>
					<input type="time" name="" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Describa detalladamente el riesgo identificado</label>
					<textarea name="" class="form-control"></textarea>
				</div>

				<div class="form-group mt-4 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
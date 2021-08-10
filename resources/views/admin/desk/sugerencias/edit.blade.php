@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-lightbulb mr-4"></i>Sugerencias</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"

			<form method="POST" action="{{ route('admin.desk.sugerencias-update', $sugerencias) }}" class="row">
				@csrf

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre</label>
					<div class="form-control">{{ $sugerencias->sugerir->name }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user iconos-crear"></i> Area</label>
					<div class="form-control">{{ $sugerencias->sugerir->area->area }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i> Puesto</label>
					<div class="form-control">{{ $sugerencias->sugerir->puesto }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electrónico</label>
					<div class="form-control">{{ $sugerencias->sugerir->email }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-phone iconos-crear"></i> Teléfono</label>
					<div class="form-control">{{ $sugerencias->sugerir->telefono }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-project-diagram iconos-crear"></i> Área a la que dirige su sugerencia</label>
					<select class="form-control">
						<option></option>
					</select>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user-tie iconos-crear"></i> Nombre del colaborador a quien dirige su sugerencia</label>
					<input name="sugerencia_dirigida" class="form-control" value="{{ $sugerencias->sugerencia_dirigida }}">
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> Describa detalladamente su sugerencia</label>
					<textarea name="descripcion" class="form-control">{{ $sugerencias->descripcion }}</textarea>
				</div>

				<div class="form-group mt-2 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
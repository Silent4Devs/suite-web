@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-hand-paper mr-4"></i>Denuncias</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clickc en el botón "Enviar"

			<form class="row" method="POST" action="{{ route('admin.reportes-denuncias-store') }}">
				@csrf
				<div class="form-group col-12">
					<label class="form-label">Su queja será:</label><br>
					<input type="radio" name="anonimo" value="si"> Anónima<br>
					<input type="radio" name="anonimo" value="no"> Proporcionare mis datos
				</div>

				<div class="form-group mt-4 col-12">
					<b>Al enviar este formulario, el propietario podrá ver su nombre y dirección de correo electrónico.</b>
				</div>

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
					<label class="form-label">Seleccione al colaborador al que denuncia</label>
					<input type="" name="denunciado" class="form-control">
				</div>

				<div class="form-group mt-4 col-6">
					<label class="form-label">Area al pertenece colaborador denunciado</label>
					<input type="" name="area_denunciado" class="form-control">
				</div>

				<div class="form-group mt-4 col-6">
					<label class="form-label">Indique el tipo de denuncia de que se trata</label>
					<input type="" name="tipo" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Describa detalladamente su denuncia</label><br>
					<div style="color: #555;">
						Detallar lo sucedido, es muy importante ser lo más objetivo posible y plasmar únicamente hechos evitando juicios de percepción o
					desvirtuar la información. Asegúrese de que su relato pueda responder a las siguientes preguntas: ¿Qué?. ¿Quién?, ¿Cómo?,
					¿Cuándo?, ¿Dónde?, considerando lugares y fechas, horas, palabras utilizadas, acciones que dan origen al hecho
					</div>
					<input type="" name="descripcion" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Adjuntar evidencia</label>
					<input type="" name="evidencia" class="form-control">
				</div>

				<div class="form-group mt-4 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
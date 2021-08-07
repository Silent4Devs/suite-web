@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-frown mr-4"></i>Quejas</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clickc en el botón "Enviar"

			<form class="row" method="POST" action="{{ route('admin.reportes-quejas-store') }}">
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

				<div class="form-group mt-4 col-4">
					<label class="form-label">¿De quién se desea quejar (Área/Persona/Proceso)?</label>
					<input type="" name="quejado" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Describa detalladamente su queja</label><br>
					<div style="color: #555;">
						Detallar lo sucedido, es muy importante ser lo más objetivo posible y plasmar únicamente hechos evitando juicios de percepción o
						desvirtuar la información. Asegúrese de que su relato pueda responder a las siguientes preguntas: ¿Qué?. ¿Quién?, ¿Cómo?,
						¿Cuándo?, ¿Dónde?
					</div>
					<input type="" name="descripcion" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label">Adjuntar evidencia</label>
					<input type="" name="evidencia" class="form-control">
				</div>

				<div class="form-group mt-4 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
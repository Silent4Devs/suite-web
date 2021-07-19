@extends('layouts.admin')
@section('content')
	




<div class="card">
	<div class="card-header text-center" style="background-color: #00abb2;">
		<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-exclamation-triangle mr-4"></i>Incidentes de seguridad</strong>
	</div>
	<div class="card-body">
		<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clickc en el botón "Enviar"

		<form class="row" method="POST" action="{{ route('admin.desk.seguridad-update', $incidentesSeguridad) }}">
		@csrf

		<div class="form-group mt-2 col-2">
			<label class="form-label">Folio</label>
			<div class="form-control" id="input_folio">{{ $incidentesSeguridad->folio }}</div>
		</div>

		<div class="form-group mt-2 col-5">
			<label class="form-label">Titulo</label>
			<input type="" name="titulo" value="{{ $incidentesSeguridad->titulo }}" class="form-control">
		</div>

		<div class="form-group mt-2 col-5">
			<label class="form-label">Estatus</label>
			<select name="estatus" class="form-control">
				<option {{ old('estatus', $incidentesSeguridad->estatus) == 'nuevo'? 'selected':'' }} value="nuevo">nuevo</option>
				<option {{ old('estatus', $incidentesSeguridad->estatus) == 'en curso'? 'selected':'' }} value="en curso">en curso</option>
				<option {{ old('estatus', $incidentesSeguridad->estatus) == 'en espera'? 'selected':'' }} value="en espera">en espera</option>
				<option {{ old('estatus', $incidentesSeguridad->estatus) == 'cerrado'? 'selected':'' }} value="cerrado">cerrado</option>
				<option {{ old('estatus', $incidentesSeguridad->estatus) == 'cancelado'? 'selected':'' }} value="cancelado">cancelado</option>
			</select>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Fecha de ocurrencia</label>
			<input type="datetime" name="fecha" value="{{ $incidentesSeguridad->fecha }}" class="form-control">
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Reportó</label>
			<div class="form-control">{{ $incidentesSeguridad->reporto->name }}</div>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Área</label>
			<div class="form-control">{{ $incidentesSeguridad->reporto->area->area }}</div>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Puesto</label>
			<div class="form-control">{{ $incidentesSeguridad->reporto->puesto }}</div>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Correo</label>
			<div class="form-control">{{ $incidentesSeguridad->reporto->email }}</div>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Teléfono</label>
			<div class="form-control">{{ $incidentesSeguridad->reporto->telefono }}</div>
		</div>

		<div class="form-group mt-2 col-12">
			<label class="form-label">Describa detalladamente el incidente</label>
			<textarea name="descripcion" class="form-control">{{ $incidentesSeguridad->descripcion }}
			</textarea>
		</div>

		<div class="form-group mt-2 col-12">
			<label class="form-label">Activos afectados</label>
			<select class="form-control" id="activos">
					<option disabled selected>Seleccionar activo</option>
				@foreach($activos as $activo)
					<option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}</option>
				@endforeach
			</select>
			<textarea name="activos_afectados" class="form-control" id="texto_activos" required>{{ $incidentesSeguridad->activos_afectados }}</textarea>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Categoría</label>
			<select class="form-control" value="{{ $incidentesSeguridad->categoria }}" name="categoria"></select>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Subcategoría</label>
			<select class="form-control" value="{{ $incidentesSeguridad->subcategoria }}" name="subcatgoría"></select>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Prioridad</label>
			<select class="form-control" value="{{ $incidentesSeguridad->prioridad }}" name="prioridad">
				<option name="alta">Alta</option>
				<option name="media">Media</option>
				<option name="baja">Baja</option>
			</select>
		</div>

		<div class="form-group mt-2 col-3">
			<label class="form-label">Asignado a</label>
			<select name="empleado_asignado_id" class="form-control">
				<option value="}" disabled selected></option>
				@foreach($empleados as $empleado)
					<option {{ old('empleado_asignado_id', $incidentesSeguridad->empleado_asignado_id) ? 'selected':'' }} value="{{ $empleado->id }}">{{ $empleado->name }}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group mt-2 col-12">
			<label class="form-label">Comentarios</label>
			<textarea name="comentarios" class="form-control">{{ $incidentesSeguridad->comentarios }}</textarea>
		</div>

		<div class="form-group mt-2 text-right col-12">
			<a href="{{ asset('admin/desk') }}" class="btn btn_cancelar">Cancelar</a>
			<input type="submit" name="" class="btn btn-success" value="Enviar">
		</div>
	</form>

	</div>
</div>
@endsection



@section('scripts')
@parent
	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function(){
			let select_activos = document.querySelector('#activos');
			select_activos.addEventListener('change', function(e){
				e.preventDefault();
				let texto_activos = document.querySelector('#texto_activos');
				
					texto_activos.value += `${this.value}, `;
				
			});


		function padLeftWithBounds(input, padChar, maxLength, min, max) {
			if (input <= min)
			    return min;
			  if (input >= max)
			    return max;

			  var s = input.toString(10);
			  var padding = "";
			  for (var i = 0; i < maxLength; ++i)
			    padding += padChar;

			  return padding.substring(0, maxLength - s.length) + s;
			};

			$("#input_folio").on("keyup", function() {
			  if (!$(this).val())
			    return;
			  $(this).val(padLeftWithBounds(parseInt($(this).val()), '0', 3, 0, 999));
			});
		});
	</script>
@endsection
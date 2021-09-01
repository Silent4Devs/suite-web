@extends('layouts.admin')
@section('content')

<style type="text/css">
	.d-none{
		display: none;
	}
</style>
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-hand-paper mr-4"></i>Denuncias</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"

			<form class="row" method="POST" action="{{ route('admin.reportes-denuncias-store') }}" enctype="multipart/form-data">
				@csrf
				<div class="form-group col-12 tipo_datos mt-4">
					<label class="form-label"><strong>Su queja será:</strong></label><br>
					<input type="radio" name="anonimo" value="si" required checked> Anónima<br>
					<input type="radio" name="anonimo" value="no" required> Proporcionaré mis datos
				</div>

				<div id="datos_personales" class="col-12 row" style="display: none;">
					<div class="form-group mt-4 col-12">
						<b>Datos generales:</b>
						<p>Al enviar este formulario, el receptor podrá ver sus datos de contacto</p>
					</div>


					<div class="form-group mt-0 col-4">
						<label class="form-label"><i class="fas fa-user iconos-crear"></i>Nombre</label>
						<div class="form-control">{{ auth()->user()->empleado->name }}</div>
					</div>

					<div class="form-group mt-0 col-4">
						<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto</label>
						<div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
					</div>
					
					<div class="form-group mt-0 col-4">
						<label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
						<div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
					</div>

					<div class="form-group mt-4 col-6">
						<label class="form-label"><i class="fas fa-envelope iconos-crear"></i>Correo electrónico</label>
						<div class="form-control">{{ auth()->user()->empleado->email }}</div>
					</div>

					<div class="form-group mt-4 col-6">
						<label class="form-label"><i class="fas fa-phone iconos-crear"></i>Teléfono</label>
						<div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
					</div>
				</div>

				<div class="form-group mt-4 col-12">
					<b>¿A quién denuncia?</b>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label"><i class="fas fa-user iconos-crear"></i>Nombre</label>
					<select name="empleado_denunciado_id" class="form-control" id="select_empleado_denunciado">
						@foreach($empleados as $empleado)
							<option value="{{$empleado->id}}" data-puesto="{{$empleado->puesto}}" data-area="{{$empleado->area->area}}">{{$empleado->name}}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i>Puesto</label>
					<div class="form-control" id="puesto"></div>
				</div>

				<div class="form-group mt-2 col-4">
					<label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i></i>Área</label>
					<div class="form-control" id="area"></div>
				</div>

				<div class="form-group mt-4 col-12">
					<b>Descripción de la denuncia:</b>
				</div>

				<div class="form-group mt-2 col-12 select_tipo">
					<label class="form-label"><i class="fas fa-hand-paper iconos-crear"></i>Indique el tipo de denuncia de que se trata</label>
					<select name="tipo" class="form-control">
						<option>Abuso de autoridad</option>
						<option>Acoso sexual</option>
						<option>Agresión física y/o verbal</option>
						<option>Consumo de alcohol o sustancias prohibidas</option>
						<option>Despido injustificado</option>
						<option>Discriminación</option>
						<option>Extorsión</option>
						<option>Manipulación de infomación personal/laboral</option>
						<option value="otra">Otra</option>
					</select>
				</div>

				<div class="form-group mt-2 col-4 otra" style="display: none;">
					<label class="form-label">¿Cuál?</label>
					<input type="" name="otra" class="form-control">
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y Hora de ocurrencia<sup>*</sup></label>
					<input type="datetime-local" name="fecha" class="form-control" required>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-map-marker-alt iconos-crear"></i> Sede</label>
					<select class="form-control" name="sede">
						<option disabled selected>seleccione sede</option>
						@foreach($sedes as $sede)
							<option value="{{ $sede->sede }}">{{ $sede->sede }}</option>
						@endforeach
					</select>
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-map iconos-crear"></i> Ubicación exacta</label>
					<input type="" name="ubicacion" class="form-control">
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label"><i class="fas fa-file-alt iconos-crear"></i>Describa detalladamente su denuncia</label><br>
					<textarea name="descripcion" class="form-control"></textarea>
					<small style="color: #555;">
						Detallar lo sucedido, es muy importante ser lo más objetivo posible y plasmar únicamente hechos evitando juicios de percepción o
					desvirtuar la información. Asegúrese de que su relato pueda responder a las siguientes preguntas: ¿Qué?. ¿Quién?, ¿Cómo?,
					¿Cuándo?, ¿Dónde?, considerando lugares y fechas, horas, palabras utilizadas, acciones que dan origen al hecho
					</small>
				</div>

				<div class="form-group mt-4 col-12">
					<label class="form-label"><i class="fas fa-file-import iconos-crear"></i>Adjuntar evidencia</label>
					<input type="file" name="evidencia[]" class="form-control" multiple="multiple">
				</div>

				<div class="form-group mt-4 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<button class="btn btn-success">Enviar</button>
				</div>

			</form>
		</div>
	</div>
@endsection


@section('scripts')
	<script type="text/javascript">


		document.addEventListener('DOMContentLoaded', function() {
		
		    document.querySelector('.select_tipo select').addEventListener('change', function(e) {
		        e.preventDefault();
		        console.log(e.target.value);
		        if(e.target.value == 'otra'){
		        	$(".select_tipo").removeClass('col-12');
		        	$(".select_tipo").addClass('col-8')
		        	$(".otra").show(100);
		        }
		        else{
		        	$(".otra").hide(0);
		        	$(".select_tipo").removeClass('col-8');
		        	$(".select_tipo").addClass('col-12')
		        }

		    });
	   	});


    	$('.tipo_datos input[value="no"]').click(function(){
    		$("#datos_personales").fadeIn(100);
    	});

    	$('.tipo_datos input[value="si"]').click(function(){
    		$("#datos_personales").fadeOut(100);
    	});
    </script>

    <script type="text/javascript">
    	
    	document.addEventListener('DOMContentLoaded', function() {
			
		    document.querySelector('#select_empleado_denunciado').addEventListener('change', function(e) {
		        e.preventDefault();

		       	let area = $("#select_empleado_denunciado option:selected").attr('data-area');

		       	let puesto = $("#select_empleado_denunciado option:selected").attr('data-puesto');

		        document.getElementById('area').innerHTML = area;

		        document.getElementById('puesto').innerHTML = puesto;

		    });
	   	});
    </script>
@endsection
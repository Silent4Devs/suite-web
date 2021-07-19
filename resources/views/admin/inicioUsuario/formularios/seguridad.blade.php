@extends('layouts.admin')
@section('content')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css">

	<style type="text/css">
		sup{
			color: red;
		}
	</style>
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-exclamation-triangle mr-4"></i>Incidentes de seguridad</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clickc en el botón "Enviar"

			<form method="POST" action="{{ route('admin.reportes-seguridad-store') }}" class="row"  enctype="multipart/form-data">
				@csrf
				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user iconos-crear"></i> Nombre</label>
					<div class="form-control">{{ auth()->user()->empleado->name }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user iconos-crear"></i> Area</label>
					<div class="form-control">{{ auth()->user()->empleado->area->area }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-user-tag iconos-crear"></i> Puesto</label>
					<div class="form-control">{{ auth()->user()->empleado->puesto }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-envelope iconos-crear"></i> Correo Electrónico</label>
					<div class="form-control">{{ auth()->user()->empleado->email }}</div>
				</div>

				<div class="form-group mt-2 col-6">
					<label class="form-label"><i class="fas fa-phone iconos-crear"></i> Teléfono</label>
					<div class="form-control">{{ auth()->user()->empleado->telefono }}</div>
				</div>

				<div class="form-group mt-2 col-md-6">
					<label class="form-label"><i class="fas fa-calendar-alt iconos-crear"></i> Fecha y Hora del incidente<sup>*</sup></label>
					<input type="datetime-local" name="fecha" class="form-control" required>
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Titulo corto del incidente<sup>*</sup></label>
					<input type="" name="titulo" class="form-control" required>
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> Describa detalladamente el incidente<sup>*</sup></label>
					<textarea name="descripcion" class="form-control" required></textarea>
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-arrow-circle-right iconos-crear"></i> Activos afectados<sup>*</sup></label>
					<select class="form-control" id="activos">
							<option disabled selected>Seleccionar activo</option>
						@foreach($activos as $activo)
							<option value="{{ $activo->nombreactivo }}">{{ $activo->nombreactivo }}</option>
						@endforeach
					</select>
					<textarea name="activos_afectados" class="form-control" id="texto_activos" required></textarea>
				</div>





				<div class="form-group col-12">
	                <label for="archivo"><i class="far fa-file iconos-crear"></i>{{ trans('cruds.materialSgsi.fields.archivo') }}</label>
	                <div class="needsclick dropzone {{ $errors->has('archivo') ? 'is-invalid' : '' }}" id="archivo-dropzone">
	                </div>
	                @if($errors->has('archivo'))
	                    <div class="invalid-feedback">
	                        {{ $errors->first('archivo') }}
	                    </div>
	                @endif
	                <span class="help-block">{{ trans('cruds.materialSgsi.fields.archivo_helper') }}</span>
	            </div>





				<div class="form-group mt-2 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar" id="btn_enviar">
				</div>
			</form>

			

		</div>
	</div>
@endsection


@section('scripts')
	


	<script>
		let archivos = [];
		let contador = 1;
    Dropzone.options.archivoDropzone = {
	    url: '{{ route('admin.material-sgsis.storeMedia') }}',
	    maxFilesize: 4, // MB
	    maxFiles: 5,
	    addRemoveLinks: true,
	    headers: {
	      'X-CSRF-TOKEN': "{{ csrf_token() }}"
	    },
	    params: {
	      size: 4
	    },
	    success: function (file, response) {
	    	console.log(file);
	    	console.log(response);
	      $('form').find('input[name="archivo"]').remove()
	      // $('form').append('<input type="hidden" name="archivo" value="' + response.name + '">')
	      archivos.push(response.name);
	    },
	    removedfile: function (file) {
	      file.previewElement.remove()
	      if (file.status !== 'error') {
	        $('form').find('input[name="archivo"]').remove()
	        this.options.maxFiles = this.options.maxFiles + 1
	      }
	    },
	    init: function () {
		@if(isset($incidenteSeguridad) && $incidenteSeguridad->archivo)
		      var file = {!! json_encode($incidenteSeguridad->archivo) !!}
		          this.options.addedfile.call(this, file)
		      file.previewElement.classList.add('dz-complete')
		      $('form').append('<input type="hidden" name="archivo" value="' + file.file_name + '">')
		      this.options.maxFiles = this.options.maxFiles - 1
		@endif
	    },
	     error: function (file, response) {
	         if ($.type(response) === 'string') {
	             var message = response //dropzone sends it's own error messages in string
	         } else {
	             var message = response.errors.file
	         }
	         file.previewElement.classList.add('dz-error')
	         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
	         _results = []
	         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
	             node = _ref[_i]
	             _results.push(node.textContent = message)
	         }

	         return _results
	     }
	}

	document.getElementById('btn_enviar').addEventListener('click', function(e){
			
		let input = `<input type="hidden" multiple name="archivo" value="${archivos}">`;

		$('form').append(input);

	});
</script>




	<script type="text/javascript">
		document.addEventListener('DOMContentLoaded', function(){
			let select_activos = document.querySelector('#activos');
			select_activos.addEventListener('change', function(e){
				e.preventDefault();
				let texto_activos = document.querySelector('#texto_activos');
				
					texto_activos.value += `${this.value}, `;
				
			});
		});
	</script>



@endsection

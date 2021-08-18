@extends('layouts.admin')
@section('content')
	<div class="card">
		<div class="card-header text-center" style="background-color: #00abb2;">
			<strong style="font-size: 16pt; color: #fff;"><i class="fas fa-lightbulb mr-4"></i>Sugerencias</strong>
		</div>
		<div class="card-body">
			<strong>INSTRUCCIONES:</strong> Por favor, conteste las siguientes preguntas y dé clic en el botón "Enviar"

			<form method="POST" action="{{ route('admin.reportes-sugerencias-store') }}" class="row">
				@csrf

				<div class="form-group mt-4 col-12">
					<b>Datos generales:</b>
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

				<div class="form-group mt-4 col-12">
					<b>Sugerencia dirigida a:</b>
				</div>

				<div class="form-group mt-4 col-6 multiselect_areas">
                	<label class="form-label"><i class="fas fa-puzzle-piece iconos-crear"></i>Área(s)</label>
                    <select class="form-control">
                        <option disabled selected>Seleccionar áreas</option>
                        @foreach ($areas as $area)
                            <option value="{{ $area->area }}">
                            	{{ $area->area }}
                            </option>
                        @endforeach
                    </select>
                    <textarea name="area_quejado" class="form-control"></textarea>
                </div>

                <div class="form-group mt-4 col-6 multiselect_empleados">
                	<label class="form-label"><i class="fas fa-user iconos-crear"></i>Colaborador(es)</label>
                    <select class="form-control">
                        <option disabled selected>Seleccionar colaborador</option>
                        @foreach ($empleados as $empleado)
                            <option value="{{ $empleado->name }}">
                            	{{ $empleado->name }}
                            </option>
                        @endforeach
                    </select>
                    <textarea name="quejado" class="form-control"></textarea>
                </div>

                <div class="form-group mt-4 col-12">
					<b>Descripción de la sugerencia:</b>
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-text-width iconos-crear"></i> Titulo corto de la sugerencia</label>
					<input name="sugerencia_dirigida" class="form-control">
				</div>

				<div class="form-group mt-2 col-12">
					<label class="form-label"><i class="fas fa-file-alt iconos-crear"></i> Describa detalladamente su sugerencia</label>
					<textarea name="descripcion" class="form-control"></textarea>
				</div>

				<div class="form-group mt-2 text-right col-12">
					<a href="{{ asset('admin/inicioUsuario') }}" class="btn btn_cancelar">Cancelar</a>
					<input type="submit" name="" class="btn btn-success" value="Enviar">
				</div>

			</form>
		</div>
	</div>
@endsection
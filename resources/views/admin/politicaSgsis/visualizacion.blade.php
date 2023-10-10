@extends('layouts.admin')
@section('content')
	
	@section('styles')
		<style type="text/css">
			.caja_titulo{
				position: relative;
				width: 100%;
				height: 150px;
			}
			.logo_organizacion_politica{
				height: 150px;
				position: absolute;
				right: 50px;
				bottom: 0;
			}
			.caja_titulo h1{
				position: absolute;
				width: 300px;
				font-weight: bold;
				color: #00abb2;
				bottom: 0;
			}
		</style>
	@endsection
	{{ Breadcrumbs::render('admin.politicaSgsis.visualizacion') }}
	<div class="card card-body" style="margin-top: -50PX;">
		<div class="row" style="border-bottom: 2px solid #ccc;">
			<div class="col-12 caja_titulo">
				<h1>Politíca del SGSI</h1>

@section('styles')
    <style type="text/css">
        .caja_titulo {
            position: relative;
            width: 100%;
        }

        .logo_organizacion_politica {
            height: 150px;
            position: absolute;
            right: 50px;
            bottom: 0;
        }

        .caja_titulo h3 {
            color: #345183;
            bottom: 0;
        }

        .form-group {
            color: rgb(255, 255, 255) !important;
        }

        .iconos-crear {
            color: rgb(255, 255, 255);
        }

        .dato_politica {
            font-size: 9pt !important;
            margin-left: 25px;
        }

        .form-label {
            font-size: 9pt !important;
            font-weight: bolder !important;
            color: rgb(255, 255, 255) !important;
        }
    </style>
@endsection
{{ Breadcrumbs::render('admin.politicaSgsis.visualizacion') }}
<h5 class="col-12 titulo_general_funcion">Politícas de la Organización: <strong> {{ $organizacions->empresa }}</h5>
<div class="card card-body" style="">

    <div class="row" style="border-bottom: 2px solid #ccc;">
        <div class="col-12 caja_titulo">
            <h3>Políticas SGSI</h3>

        </div>
    </div>
    @if ($politicaSgsis)
        @foreach ($politicaSgsis as $data)
            <div class="row ml-1 mt-3">
                <h4><strong>{{ $data->nombre_politica ?: 'Nombre: No definido' }}</strong></h4>
            </div>
            <div class="row" style="margin-top: -2px;">
                <div class="col-lg-9">
                    <p>
                        {!! $data->politicasgsi !!}
                    </p>
                    @livewire('aceptar-politica', ['id_politica' => $data->id])
                </div>

                <div class="col-sm-3" style="background-color:#345183; padding-top: 10px;">
                    <div class="form-group">
                        <label class="form-label"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                            publicación</label>
                        <div class="dato_politica">{{ $data->fecha_publicacion ?: 'No definido' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de entrada en
                            vigor</label>
                        <div class="dato_politica">{{ $data->fecha_entrada ?: 'No definido' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="far fa-calendar-alt iconos-crear"></i>Fecha de
                            revisión</label>
                        <div class="dato_politica">{{ $data->fecha_revision ?: 'No definido' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-user-tie iconos-crear"></i>Revisó: </label>
                        <div class="dato_politica">{{ $data->reviso->name ?: 'No definido' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-briefcase iconos-crear"></i>Puesto</label>
                        <div class="dato_politica">{{ $data->reviso->puesto ?: 'No definido' }}</div>
                    </div>
                    <div class="form-group">
                        <label class="form-label"><i class="fas fa-street-view iconos-crear"></i>Área</label>
                        <div class="dato_politica">{{ $data->reviso->area->area ?: 'No definido' }}</div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    @else
        <div class="row">
            <h3>Sin registro</h3>
        </div>
    @endif
</div>
@endsection

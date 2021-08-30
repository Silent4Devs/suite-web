@extends('layouts.admin')
@section('content'){{-- 
	
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



			.cards_reportes{
		        width: 250px;
		        padding: 20px 0px;
		        padding-left: 30px;
		        border: 1px solid #ccc;
		        border-radius: 5px;
		        text-align: left;
		        display:inline-block;
		        margin: 10px;
		        cursor: pointer;
		        color: #888888;
		    }
		    .cards_reportes i{
		        font-size: 16pt;
		        margin-right: 10px;
		    }
		    .cards_reportes:hover{
		        color: #00abb2;
		        border: 1px solid #00abb2;
		    }
		</style>
	@endsection
	{{ Breadcrumbs::render('admin.portal-comunicacion.reportes') }}
	<div class="card card-body" style="margin-top: -50PX;">
		<div class="row" style="border-bottom: 2px solid #ccc;">
			<div class="col-12 caja_titulo">
				<h1>Generar Reporte</h1>

			            @php
			                use App\Models\Organizacion;
			                $organizacion = Organizacion::first();
			                $logotipo = 'img/logo_policromatico_2.png';
			                if ($organizacion) {
			                    if ($organizacion->logotipo) {
			                        $logotipo = 'images/' . $organizacion->logotipo;
			                    }
			                }
			            @endphp
			            <img src="{{ asset($logotipo) }}" class="logo_organizacion_politica">
			 
			</div>
		</div>
		<div class="row" style="">
			<div style="text-align: center;" class="mt-5">
			    <a href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}" class="cards_reportes">
			        <i class="fas fa-exclamation-triangle"></i> Incidentes de seguridad
			    </a>
			    <a href="{{ asset('admin/inicioUsuario/reportes/riesgos') }}" class="cards_reportes">
			        <i class="fas fa-shield-virus"></i> Riesgo Identificado
			    </a>
			    <a href="{{ asset('admin/inicioUsuario/reportes/quejas') }}" class="cards_reportes">
			        <i class="fas fa-frown"></i> Realizar queja
			    </a>
			    <a href="{{ asset('admin/inicioUsuario/reportes/denuncias') }}" class="cards_reportes">
			        <i class="fas fa-hand-paper"></i> Realizar denuncia
			    </a>
			    <a href="{{ asset('admin/inicioUsuario/reportes/mejoras') }}" class="cards_reportes">
			        <i class="fas fa-rocket"></i> Reportar mejora
			    </a>
			    <a href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}" class="cards_reportes">
			        <i class="fas fa-lightbulb"></i> Realizar sugerencia
			    </a>
			</div>
		</div>
	</div> --}}







	<style type="text/css">
		.img_comunicado{
            width: 100%;
            height: 300px;

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: all;
        }
	</style>

	<div class="card mt-5" style="">
		<div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Organizaciones</strong></h3>
        </div>
		<div class=" card-body" style="">
			<div class="row">
				<div class="col-12">
					<h1 style="color:#00abb2;">Comenzamos auditorías</h1>
				</div>
				<div class="col-md-5 mt-3">
					<div class="img_comunicado" style="background-image: url('https://directivosygerentes.es/wp-content/uploads/2018/05/oficina-pyme.jpg');"></div>
				</div>
				<div class="col-md-7 mt-3" style="display:flex; align-items: center;">
					<p>
						Proveer servicios especializados de atención y respuesta a amenazas e incidentes de seguridad, a través de mejora continua de nuestros procesos y alianzas con otras organizaciones para contribuir a un entorno digital de nuestros clientes.
					</p>
				</div>
			</div>
		</div>
	</div>
@endsection
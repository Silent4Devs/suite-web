@extends('layouts.admin')
@section('content')

	<style type="text/css">
		.caja_btn_a{
			width: 100%;
			height: auto;
			text-align: center;
		}
		.caja_btn_a a{
			padding: 15px;
			margin-top: 10px;
			color: #008186;
			display: inline-block;
		}
		.caja_btn_a a:hover, .btn_a_seleccionado{
			border-bottom: 2px solid #00abb2;
			margin-bottom: -2px;
		}
		.caja_secciones{
			width: 100%;
			min-height: 600px;
			overflow: hidden;
			scroll-behavior: smooth;
			position: relative;
		}
		.secciones{
			position: absolute;
			width: 800%;
			height: auto;
		}
		section{
			float: left;
			width: 12.5%;
			height: auto;
			text-align: left;
			padding: 10px;
		}


		section ul{
			padding: 0;
			margin: 0;
			text-align: center;
		}
		section li{
			list-style: none;
			width: 150px;
			height: 150px;
			box-sizing: border-box;
			position: relative;
			margin: 10px;
			display: inline-block;
		}
		section li i{
			font-size: 30pt;
			margin-bottom: 10px;
			width: 100%;
		}
		section a{
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
			background-color: #eee;
			color: #008186;
			border-radius: 6px;
			box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.2);
			transition: 0.1s;
			padding: 7px;
		}
		section a:hover{
			text-decoration: none !important;
			color: #008186;
			border: 1px solid #00abb2;
			box-shadow: 0px 2px 3px 1px rgba(0, 0, 0, 0.0);
			background-color: #fff;
		}
		a:hover{
			text-decoration: none !important; 
		}



		@media(max-width: 648px){
			.caja_secciones{
				min-height: 1000px;
			}
		}
		@media(max-width: 474px){
			.caja_secciones{
				min-height: 2000px;
			}
		}
	</style>

	{{ Breadcrumbs::render('admin.iso27001.index') }}

	<div class="card mt-5">
		<div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>ISO 27001</strong></h3>
        </div>
        <div class="card-body">
			<div class="caja_btn_a">
				<a href="#s1"><i class="fa-fw fas fa-archive"></i> Contexto </a>
				<a href="#s2"><i class="fa-fw fas fa-gavel"></i> Liderazgo </a>
				<a href="#s3"><i class="fa-fw fas fa-tasks"></i> Planificación </a>
				<a href="#s4"><i class="fa-fw fas fa-headset"></i> Soporte</a>
				<a href="#s5"><i class="fa-fw fas fa-briefcase"></i> Operación </a>
				<a href="#s6"><i class="fa-fw fas fa-file-signature"></i> Evaluación</a>
				<a href="#s7"><i class="fa-fw fas fa-infinity"></i> Mejora</a>
				<a href="#s8"><i class=""></i> Seccion </a>
			</div>

			<div class="caja_secciones">
				<div class="secciones">
					<section id="s1">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.declaracion-aplicabilidad.index") }}">
									<div>
										<i class="far fa-file"></i>
										Declaracion de aplicabilidad 
									</div>
								</a></li>
								<li><a href="{{ route("admin.partes-interesadas.index") }}">
									<div>
										<i class="far fa-handshake"></i>
										Partes interesadas 
									</div>
								</a></li>
								<li><a href="{{ route("admin.matriz-requisito-legales.index") }}">
									<div>
										<i class="fas fa-balance-scale"></i>
										Matriz de requisitos legales 
									</div>
								</a></li>
								<li><a href="{{ route("admin.entendimiento-organizacions.index") }}">
									<div>
										<i class="far fa-list-alt"></i>
										FODA
									</div>
								</a></li>
								<li><a href="{{ route("admin.alcance-sgsis.index") }}">
									<div>
										<i class="fas fa-bullseye"></i>
										Determinación de alcance 
									</div>
								</a></li>
								<li><a href="{{ route("admin.reportes-contexto.index") }}">
									<div>
										<i class="far fa-file-alt"></i>
										Generar Reporte
									</div>
								</a></li>
							</ul>
						</div>
					</section>



					<section id="s2">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.comiteseguridads.index") }}">
									<div>
										<i class="fas fa-shield-alt"></i>
										Conformación del comité de seguridad 
									</div>
								</a></li>
								<li><a href="{{ route("admin.minutasaltadireccions.index") }}">
									<div>
										<i class="fas fa-columns"></i>
										Minutas de sesiones con Ata dirección 
									</div>
								</a></li>
								<li><a href="{{ route("admin.evidencias-sgsis.index") }}">
									<div>
										<i class="far fa-window-restore"></i>
										Evidencias de asignación de recursos al SGSI 
									</div>
								</a></li>
								<li><a href="{{ route("admin.politica-sgsis.index") }}">
									<div>
										<i class="fas fa-landmark"></i>
										Política SGSI 
									</div>
								</a></li>
								<li><a href="{{ route("admin.roles-responsabilidades.index") }}">
									<div>
										<i class="fas fa-user-tag"></i>
										Roles y responsabilidades 
									</div>
								</a></li>
							</ul>
						</div>
					</section>



					<section id="s3">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.riesgosoportunidades.index") }}">
									<div>
										<i class="fas fa-asterisk"></i>
										Riesgos y oportunidades 
									</div>
								</a></li>
								<li><a href="{{ route("admin.objetivosseguridads.index") }}">
									<div>
										<i class="fas fa-lock"></i>
										 Objetivos de seguridad
									</div>
								</a></li>
							</ul>
						</div>
					</section>



					<section id="s4">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.recursos.index") }}">
									<div>
										<i class="fas fa-chalkboard-teacher"></i>
										Capacitaciones	
									</div>
								</a></li>
								<li><a href="{{ route("admin.competencia.index") }}">
									<div>
										<i class="fas fa-flag-checkered"></i>
										Competencias
									</div>
								</a></li>
								<li><a href="{{ route("admin.concientizacion-sgis.index") }}">
									<div>
										<i class="fas fa-book-reader"></i>
										Concientización SGI
									</div>
								</a></li>
								<li><a href="{{ route("admin.material-sgsis.index") }}">
									<div>
										<i class="fas fa-cubes"></i>
										Material SGI
									</div>
								</a></li>
								<li><a href="{{ route("admin.material-iso-veinticientes.index") }}">
									<div>
										<i class="far fa-object-ungroup"></i>
										Material ISO 27001: 2013
									</div>
								</a></li>
								<li><a href="{{ route("admin.comunicacion-sgis.index") }}">
									<div>
										<i class="far fa-comments"></i>
										Comunicación SGI
									</div>
								</a></li>
								<li><a href="{{ route("admin.politica-del-sgsi-soportes.index") }}">
									<div>
										<i class="fas fa-landmark"></i>
										Política SGI
									</div>
								</a></li>
								<li><a href="{{ route("admin.control-accesos.index") }}">
									<div>
										<i class="fas fa-vote-yea"></i>
										Control de Accesos 
									</div>
								</a></li>
								<li><a href="{{ route("admin.informacion-documetadas.index") }}">
									<div>
										<i class="far fa-folder-open"></i>
										Infomación Documentada
									</div>
								</a></li>
							</ul>
						</div>
					</section>


					<section id="s5">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.planificacion-controls.index") }}">
									<div>
										<i class="fas fa-clipboard-list"></i>
										Planificaión y Control
									</div>
								</a></li>
								<li><a href="{{ route("admin.tratamiento-riesgos.index") }}">
									<div>
										<i class="fas fa-viruses"></i>
										Tratamiento de riesgos
									</div>
								</a></li>
							</ul>
						</div>
					</section>



					<section id="s6">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.indicadores-sgsis.index") }}">
									<div>
										<i class="fas fa-list-ul"></i>
										Indicadores SGSI
									</div>
								</a></li>
								<li><a href="{{ route("admin.incidentes-de-seguridads.index") }}">
									<div>
										<i class="fas fa-lock"></i>
										Incidentes de Seguridad 
									</div>
								</a></li>
								<li><a href="{{ route("admin.indicadorincidentessis.index") }}">
									<div>
										<i class="fas fa-file-contract"></i>
										Indicador Incidentes 
									</div>
								</a></li>
								<li><a href="{{ route("admin.auditoria-anuals.index") }}">
									<div>
										<i class="far fa-calendar-alt"></i>
										Programa Anual de Auditoria 
									</div>
								</a></li>
								<li><a href="{{ route("admin.plan-auditoria.index") }}">
									<div>
										<i class="fas fa-clipboard-list"></i>
										Plan de Auditoria 
									</div>
								</a></li>
								<li><a href="{{ route("admin.auditoria-internas.index") }}">
									<div>
										<i class="fas fa-network-wired"></i>
										Auditoria Interna 
									</div>
								</a></li>
								<li><a href="{{ route("admin.revision-direccions.index") }}">
									<div>
										<i class="fas fa-tasks"></i>
										Revisión por dirección
									</div>
								</a></li>
							</ul>
						</div>
					</section>



					<section id="s7">
						<div class="card card-body">
							<ul>
								<li><a href="{{ route("admin.accion-correctivas.index") }}">
									<div>
										<i class="far fa-thumbs-down"></i>
										Acción Correctiva 
									</div>
								</a></li>
								<li><a href="{{ route("admin.registromejoras.index") }}">
									<div>
										<i class="far fa-thumbs-up"></i>
										Registro Mejora 
									</div>
								</a></li>
							</ul>
						</div>
					</section>



					<section id="s8">
						<div class="card card-body">
							Seccion
						</div>
					</section>



				</div>
			</div>
		</div>

	</div>


@endsection


@section('scripts')
	<script type="text/javascript">
		$(".caja_btn_a a").click(function(){
			$(".caja_btn_a a").removeClass("btn_a_seleccionado");
			$(".caja_btn_a a:hover").addClass("btn_a_seleccionado");
			$(".c-wrapper").scrollTop(0);
		});
	</script>	
@endsection
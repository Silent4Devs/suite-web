@extends('layouts.admin')
@section('content')



	<style type="text/css">
		body{
				margin: 0;
			}
		.contacto{
			width: 100%;
			height: 471px;
			max-width: 1000px;
			background-image: url(../img/implementacion/fondo_consultoria.jpg);
			background-size: cover;
			background-color: #ccc;
			/* font-family: calibri; */
		}
		.tiulo {
			width: 100%;
			margin: 0;
			margin-top: 30px;
			text-align: center;
			font-size: 30pt;
			float: left;
			color: #285a9d;
		}
		.tiulo font{
			font-size: 31pt;
			font-weight: bolder;
			color: #30289d;
		}
		.info{
			/* width: 475px;
			 */
			margin: 0;

			font-size: 12pt;
			font-weight: lighter;
			/* float: right; */
			/* margin-right: 10%; */
			text-align: center;
			color: #05192c;
		}
		.boton{
			float: left;
			margin-top: 15px;
		}
		.cel{
			margin-left: 0;
		}
		.whats{
			margin-left: 20px;
		}
		.correo{
			margin-left: 40px;
		}
		/* .btn_consultores {
			width: 140px;
			height: 37px;
			border: 1px solid #fff;

			color: #fff;
			font-size: 12pt;
			border-radius: 8px;
			box-shadow: 0px 0px 5px -1px;
			cursor: pointer;
			margin:auto;
			
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.btn_consultores:hover{
			background-color: #fff;
			color: #888888;
			box-shadow: none;
			transition: 0.1s;
		} */

		.tabla_consultores, .tabla_soporte{
			width: 100%;
			margin-top: 30px;
			display: none;
		}

		.contacto table{
			width: 670px;
			margin: auto;
			color: #fff;
		}
		.contacto table thead tr{
			background-color: #345183;
			transform: scale(1.01);
			box-shadow: 0px 3px 5px -3px #000;
		}
		.contacto table th{
			border-bottom: 1px;
			padding: 10px;
			text-align: center;
		}
		.contacto table td{
			padding: 10px;
		}
		.contacto table tbody tr{
			border-bottom: 1px solid rgba(255,255,255,0.3);
			background-color: rgba(0,0,0,0.4);
			transition: 0.1s;
		}
		.contacto table tbody tr:hover{
			transform: scale(1.015);

			background-color: rgba(0,0,0,0.5);
		}
		.btn_cerrar{
			/* display: none; */
			width: 50px;
			height: 50px;
			right: 30px;
			position: absolute;
		}
		.icono_cerrar{
			font-size: 40px;
			cursor: pointer;
			color: #345183;
			margin-top: -25px;
		}
		.icono_cerrar:hover{
			transform: scale(1.1);
		}

		.btn.btn-success:hover{
			background-color:#345183 !important;
			color:#fff !important;
		}
		.secundario_revelado .tabla_consultores{
			display:block !important;
		}
		.secundario_revelado .genreal{
			display:none !important;
		}
		.tercero_revelado .tabla_soporte{
			display:block !important;
		}
		.tercero_revelado .genreal{
			display:none !important;
		}
		.tabla_soporte{
			display:none;
		}
		.card_equipos{
			background-color:rgba(255,255,255, 0.4);
			width:350px;
			padding:25px;
			border-radius:6px;
			box-shadow:0px 0px 5px 1px rgba(0,0,0,0.3);
			margin-top:35px;

		}
		.info strong{
			font-size:16pt;
			font-weight: bold;
			color:#30289d;
		}
		.caja_btn{
			margin-bottom:25px;
		}
		.caja_btn i{
			/* font-size:25pt; */
			margin-right:10px;
			transform:scale(1.4);
		}
}

	
	</style>


	<div class="card card-body caja_general_soporte">
		<div class="contacto">
			<div class="genreal">
				<p class="tiulo">¿CÓMO PODEMOS AYUDARTE? &nbsp;&nbsp; <font>CONTÁCTANOS</font></p>
                <div class="row col-12" style="margin:auto;">
                    <div class="col-6 text-center " style="display:flex; justify-content:center;">
						<div class="card_equipos">
							<p class="info"><strong>Equipo de consultores</strong><br><br>
								Si requieres asesoría sobre el llenado de un módulo, contacta a nuestro equipo de consultores.</p><br>
								<div  id="btn_consultores" class="btn btn-success" style="margin:auto;">Consultores
								</div>
						</div>
                    </div>
                    <div class="col-6 text-center" style="display:flex; justify-content:center;">
						<div class="card_equipos">
							<p class="info"><strong>Equipo de soporte técnico</strong><br><br> Si deseas reportar alguna falla del sistema, contacta a nuestro equipo de soporte técnico.</p><br>
								<div id="btn_soporte" class="btn btn-success">Soporte técnico</div>
						</div>
                    </div>
                </div>
			</div>
			<div class="tabla_consultores">
				<div class="py-3 col-md-12 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
					<h3 class="mb-2 text-center text-white"><strong>Consultores</strong></h3>
				</div>
				<div class="caja_btn text-center">
					<a class="btn btn-success" href="tel:525572480010"><i class="fas fa-phone-square"></i>Teléfono</a>
					<a class="btn btn-success" href="https://wa.me/525572480010" target="_blank"><i class="fab fa-whatsapp-square"></i>Whatsapp</a>
					<a class="btn btn-success" href="mailto:miguel.gaspar@silent4business.com"><i class="fas fa-envelope-square"></i>Correo</a>
				</div>

				<table>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Puesto</th>
							<th>Teléfono</th>  
							<th>Correo</th>  
		
						</tr>
					</thead>
					<tbody>
						@foreach($ConfigurarSoporteModel as $key)
						<tr>
							<td>{{ $key->id_elaboro}}</td>
							<td>{{ $key->puesto }}</td>
							<td>{{ $key->telefono }}</td>
							<td>{{ $key->correo }}</td>
							{{-- <td>
								<a class="btn btn-primary btn-xs" href="{{ route('movie.edit',['id' => $movie->id] )}}" >Edit</a> 
								<a class="btn btn-danger btn-xs" href="{{ route('movie/destroy',['id' => $movie->id] )}}" >Delete</a>
							</td> --}}
		
						</tr>
						@endforeach
					</tbody>
				</table>

				{{-- <table>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Puesto</th>
							<th>Teléfono</th>
							<th>Correo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Alejandro Said Pacheco Salas</td>
							<td>Consultor Estratégico Jr.</td>
							<td>5578232000 Ext. 146</td>
							<td>alejandro.pacheco@silent4business.com</td>
						</tr>
						<tr>
							<td>Yediael Ceja</td>
							<td>Consultor Estratégico Jr.</td>
							<td>5578232000 Ext. 146</td>
							<td>yediael.ceja@silent4business.com</td>
						</tr>
						<tr style="border: none;">
							<td>Marco Luna Robles</td>
							<td>Líder de Consultoría Estratégica</td>
							<td>5578232000 Ext. 158</td>
							<td>marco.luna@silent4business.com</td>
						</tr>
					</tbody>
				</table> --}}
				<div class="btn_cerrar btn btn-success" style="color:#30289d;margin-top: 40px;margin-right:10px;">Cancelar</div>
			</div>
			<div class="tabla_soporte">
				<div class="py-3 col-md-12 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
					<h3 class="mb-2 text-center text-white"><strong>Soporte Técnico</strong></h3>
				</div>
				<div class="caja_btn text-center">
					<a class="btn btn-success" href="tel:525525115770"><i class="fas fa-phone-square"></i>Teléfono</a>
					<a class="btn btn-success" href="https://wa.me/525525115770" target="_blank"><i class="fab fa-whatsapp-square"></i>Whatsapp</a>
					<a class="btn btn-success" href="mailto:contacto@silent4business.com"><i class="fas fa-envelope-square"></i>Correo</a>
				</div>
			{{--	<table class="table table-condensed table-striped table-bordered">
					<thead>
						<tr>
						  <th>Nombre</th>
						  <th>Puesto</th>
						  <th>Teléfono</th>  
						  <th>Correo</th>  
		
						</tr>
					</thead>
					 <tbody>
						@foreach($movies as $movie)
						<tr>
							<td>{{ $movie->name }}</td>
							<td>{{ $movie->description }}</td>
							<td>
								<a class="btn btn-primary btn-xs" href="{{ route('movie.edit',['id' => $movie->id] )}}" >Edit</a> 
								<a class="btn btn-danger btn-xs" href="{{ route('movie/destroy',['id' => $movie->id] )}}" >Delete</a>
							</td>
		
						</tr>
						@endforeach
					</tbody>
				</table> --}}
				<table>
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Puesto</th>
							<th>Teléfono</th>
							<th>Correo</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Miguel Ángel Gaspar Galicia</td>
							<td>Líder de Innovación y Desarrollo.</td>
							<td>5578233000 <br> Ext. 151 5572480010</td>
							<td>miguel.gaspar@silent4business.com</td>
						</tr>
						<tr>
							<td>Luis Fernando Jonathan Vargas Osornio</td>
							<td>Coordinador de Desarrollo Innovación y Desarrollo.</td>
							<td>55 7823 3000</td>
							<td>luis.vargas@silent4business.com</td>
						</tr>
						<tr>
							<td>Uriel Santiago Reyes</td>
							<td>Desarrollador Jr.</td>
							<td>55 7823 3000</td>
							<td>uriel.santiago@silent4business.com</td>
						</tr>
						{{-- <tr style="border: none;">
							<td>Marco Luna Robles</td>
							<td>Líder de Consultoría Estratégica</td>
							<td>5578232000 Ext. 158</td>
							<td>marco.luna@silent4business.com</td>
						</tr> --}}
					</tbody>
				</table>
				<div class="btn_cerrar btn btn-success" style="color:#30289d;margin-top: 15px;margin-right:10px;">Cancelar</div>
			</div>
		</div>
	</div>

	{{ \TawkTo::widgetCode('https://tawk.to/chat/5fa08d15520b4b7986a0a19b/default') }}
@endsection


@section('scripts')

	<script type="text/javascript">
		
		$("#btn_consultores").click(function(){
			$('.caja_general_soporte').addClass('secundario_revelado');
			
		});
	
		$(".btn_cerrar").click(function(){
			$('.caja_general_soporte').removeClass('secundario_revelado');
			
		});

		$("#btn_soporte").click(function(){
			$('.caja_general_soporte').addClass('tercero_revelado');
			
		});
	
		$(".btn_cerrar").click(function(){
			$('.caja_general_soporte').removeClass('tercero_revelado');
			
		});

	</script>

@endsection

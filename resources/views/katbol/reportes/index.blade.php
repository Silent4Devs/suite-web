@extends('layouts.admin')
@section('content')
@section('titulo', 'Reportes')

<link rel="stylesheet" type="text/css" href="{{ asset('css/reportes.css') }}"/>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
<link rel="stylesheet" type="text/css" href=" https://printjs-4de6.kxcdn.com/print.min.css">

<style type="text/css">
	.caja_general_p{
		display: flex;
		align-items: center;
	}

	.a_btn{
		width: 100px;
		height: 100px;
		/* background-color: #0ebfbf; */
		display: inline-block;
		position: relative;
		margin-left: 3%;
		text-align: center;
		border-radius: 5px;
		transition: 0.1s;
		/*box-shadow: 0px 3px 5px -2px #888;*/
	}
	.a_btn:hover{
		/*box-shadow: 0px 3px 6px 0px #888;*/
	}
	.icono_btn{
		position: absolute;
		top: 22px;
		font-size: 34pt;
		color: #fff !important;
	}
	.text_btn{
		position: absolute;
		top: 70px;
		font-size: 10pt;
		color: #fff !important;
	}

	section{
		display: none;
		width: 90%;
		max-width: 850px;
		min-height: 500px;
		margin: auto;
		overflow-x: auto;
		padding: 20px;
	}
	section:target{
		display: block;
	}
	section .card{
		width: 792px;
		margin: auto;
	}

	.seleccionar{
		margin-bottom: 20px;
	}

	@media(max-width: 1188px){
		.caja_general_p{
			display: block;
		}

		.a_btn{
			margin-top: 10px;
		}
	}

	.logo_organizacion{
		width: 120px;
		height: 120px;
		margin: auto;
		@isset($logotipo->logotipo)
		background-image: url('{{ url('images/'.$logotipo->logotipo) }}');
		@endisset
		background-repeat: no-repeat;
		background-size: contain;
		background-position: center;
	}

	.btn.btn-primary{
		margin-top: 30px;
	}


	button i{
		margin-right: 10px;
	}

	h5{
		margin-bottom: 20px;
		color: #777;
		border-bottom: 2px solid #bbb;
		text-align: right;
		padding-bottom: 9px;
	}


    .align{
        text-align: left !important;
        font-size: 18px;
        color: #777777;
        opacity: 100% !important;
    }

    .titulo-form, .sub-titulo-form {
            font-size: 18px;
            color: #4c4790;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

</style>
<div class="page-reportes">
	<div class="card card-content">
		<div class="row">
			<div class="col s12" style="margin-bottom: 30px;">
                <h4 class="titulo-form">GENERAR REPORTE</h4>
                <p class="instrucciones">Por favor seleccione el tipo de reporte</p>
            </div>
		</div>
       <center>
		<div class="row">
	        <div class="col s12 m8">
	      		<a href="#organizacion" class="a_btn">
	                <img src="{{ asset('img/reportes/org.svg') }}" style="left: 40px; width: 100%; padding-bottom: 6px;">
	      			<span style="color: #2395AA;"><strong>Organización</strong></span>
	      		</a>

	      		<a href="#proveedores" class="a_btn">
	                <img src="{{ asset('img/reportes/prov.svg') }}" style="left: 40px; width: 100%; padding-bottom: 6px;">
	                <span style="color: #2395AA;"><strong>Proveedores</strong></span>
	      		</a>

	      		<a href="#contratos" class="a_btn">
	                <img src="{{ asset('img/reportes/contr.svg') }}" style="left: 40px; width: 100%; padding-bottom: 6px;">
	                <span style="color: #2395AA;"><strong>Contratos</strong></span>
	      		</a>
			</div>
	    </div>
       </center>

		<div class="row">
		    <div class="col s12 m12">

				<section id="organizacion">
	                <div style="display: flex; justify-content: space-between; padding:10px; margin-bottom: 20px;">
	                	<h4 class="sub-titulo-form">REPORTE ORGANIZACIÓN</h4>
	                    <button class="btn imprimir" style="bottom: 60 !important;" onclick="printJS({
	                        printable: 'miorganizacion_reporte',
	                        type: 'html',
	                        css: '{{ asset('css/reportes.css') }}',})">
	                        <i class="fas fa-print"></i>
	                        Imprimir Reporte
	                    </button>
	                </div>

					@if (!$organizacion)
						<div class="card">
							<p style="padding: 20px;">
								No se ha registrado organización
							</p>
						</div>
					@endif
					@isset($organizacion)
						<div class="card">
				        		<div id="miorganizacion_reporte" class="card-content">
				        			<table class="encabezado">
										<thead>
											<tr>
												<th>

													@if(isset($logotipo->logotipo))
													<img src="{{ url('images/'.$logotipo->logotipo) }}">
													@else
													<img src="{{ url('img/Silent4Business-Logo-Color.png') }}">
													@endif
												</th>
												<th><font style="font-weight: lighter;">Datos de la organización: </font><br>  {{$organizacion->empresa}} </th>
												<th>{{ date("d/m/y")  }}</th>
											</tr>
										</thead>
									</table>

									<h1>DATOS GENERALES</h1>
									<table class="line_dato">
										<tr>
											<th>Nombre</th>
											<th>Dirección</th>
										</tr>
										<tr>
											<td><div>{{$organizacion->empresa}}</div></td>
											<td><div>{{$organizacion->direccion}}</div></td>
										</tr>
									</table>

									<table class="line_dato">
										<tr>
											<th>Teléfono</th>
											<th>Correo</th>
										</tr>
										<tr>
											<td><div>{{$organizacion->telefono}}</div></td>
											<td><div>{{$organizacion->correo}}</div></td>
										</tr>
									</table>

									<table class="line_dato">
										<tr>
											<th>Página web</th>
										</tr>
										<tr>
											<td><div>{{$organizacion->pagina_web}}</div></td>
										</tr>
									</table>

									<h1>DATOS COMPLEMENTARIOS</h1>
									<table class="line_dato">
										<tr>
											<th>Productos o Servicios </th>
											<th>Giro</th>
										</tr>
										<tr>
											<td><div>{{$organizacion->servicios}} </div></td>
											<td><div>{{$organizacion->giro}}</div></td>
										</tr>
									</table>

									<table class="line_dato">
										<tr>
											<th>Misión </th>
											<th>Visión</th>
										</tr>
										<tr>
											<td><div>{{$organizacion->mision}}</div></td>
											<td><div>{{$organizacion->vision}}</div></td>
										</tr>
									</table>

									<table class="line_dato">
										<tr>
											<th> Valores </th>
											<th> Antecedentes</th>
										</tr>
										<tr>
											<td><div>{{$organizacion->valores}}</div></td>
											<td><div>{{$organizacion->antecedentes}}</div></td>
										</tr>
									</table>
			        			</div>
			        	</div>
		        	@endisset
				</section>


				<section id="proveedores">
					<div style="display: flex; justify-content: space-between; padding:10px; margin-bottom: 20px;">
	                	<h4 class="sub-titulo-form">REPORTE PROVEEDOR</h4>
	                    <button class="btn" style="bottom: 25px !important;" onclick="printJS({
                            printable: 'proveedor_reporte',
                            type: 'html',
                            css: '{{ asset('css/reportes.css') }}',})">
                            <i class="fas fa-print"></i>
                            Imprimir Reporte
                        </button>
	                </div>
					<div class="seleccionar">
						<select searchable="Buscar..." name="proveedor" id="proveedor">
		                    <option value="" selected disabled>Seleccione un proveedor</option>
		                    @forelse($proveedores as $item_proveedor)
		                        <option value="{{$item_proveedor->id}}">{{$item_proveedor->nombre_comercial}}</option>
		                    @empty
		                        <option value="">No hay proveedores registrados</option>
		                    @endforelse
		                </select>
		                {!! Form::submit('Generar reporte', ['class' => 'btn btn-primary', 'id' => 'buscar_proveedor', 'onclick' => "buscarproveedor($('#proveedor').val());return false;", 'style' => '']) !!}
					</div>
					<div class="card">
						<div id="proveedor_reporte" class="card-content">
							<style type="text/css">
								.logo_organizacion{
								width: 120px;
								height: 120px;
								margin: auto;
								@if(isset($logotipo->logotipo))
								background-image: url('{{ url('images/'.$logotipo->logotipo) }}');
								@else
								background-image: url('{{ url('img/Silent4Business-Logo-Color.png') }}');
								@endif
								background-repeat: no-repeat;
								background-size: contain;
								background-position: center;
							}
							</style>
							<div id="caja_reporte_proveedor_ajax"></div>
						</div>
		        	</div>
				</section>



				<section id="contratos">
					<div style="display: flex; justify-content: space-between; padding:10px; margin-bottom: 20px;">
	                	<h4 class="sub-titulo-form">REPORTE CONTRATO</h4>
	                    <button class="btn" style="bottom: 25px !important;" onclick="printJS({
                            printable: 'contrato_reporte',
                            type: 'html',
                            css: '{{ asset('css/reportes.css') }}',})">
                            <i class="fas fa-print"></i>
                            Imprimir Reporte
                        </button>
	                </div>
					<div class="seleccionar">
						<select searchable="Buscar..." name="contrato" id="contrato" class="">
		                    <option value="" selected disabled>Seleccione un contrato</option>
		                    @forelse($contratos as $item_contrato)
		                        <option value="{{$item_contrato->id}}">{{$item_contrato->no_contrato}}</option>
		                    @empty
		                        <option value="">No hay contratos registrados</option>
		                    @endforelse
		                </select>
		                {!! Form::submit('Generar reporte', ['class' => 'btn btn-primary', 'id' => 'buscar_contrato', 'onclick' => "buscarcontrato($('#contrato').val());return false;", 'style' => '']) !!}
					</div>
					<div class="card">
						<div id="contrato_reporte" class="card-content">
							<style type="text/css">
								.logo_organizacion{
								width: 120px;
								height: 120px;
								margin: auto;
								@if(isset($logotipo->logotipo))
								background-image: url('{{ url('images/'.$logotipo->logotipo) }}');
								@else
								background-image: url('{{ url('img/Silent4Business-Logo-Color.png') }}');
								@endif
								background-repeat: no-repeat;
								background-size: contain;
								background-position: center;
							}
							</style>
							<div id="caja_reporte_contrato_ajax"></div>
						</div>
		        	</div>
				</section>
				<p style="opacity: 0.9; margin-top: 30px;">
					<span style="font-weight: bold;"><span style="color: #2395AA;">Nota:</span></span> Para la visualización de elementos gráficos dentro del reporte es necesario activar la opción <strong>"imprimir gráficos"</strong> que se encuentra dentro de más opciones - imprimir gráficos
				</p>
		    </div>
		</div>
	</div>

    <div class="card card-content" id="test2">
        <div class="row">
            <div class="col s12" style="margin-bottom: 30px;">
	            <h4 class="sub-titulo-form">DESCARGAR CONTRATO</h4>
	            <p class="instrucciones">Por favor selecciones un contrato para descargar su reporte</p>
			</div>
            <form method="post" action="excelContratos" >
                @csrf
                <div class="input-field col s6">
	                <label>Contrato</label>
	                <select class="browser-default" name="id" required>
						<option value="" selected>Seleccione una opción</option>
						@foreach ($contratos as $contrato)
							<option value="{{$contrato->id}}">{{$contrato->no_contrato}}</option>
						@endforeach
	                </select>
                </div>
                <div class="input-field col s6">
                    <button type="submit" class="btn btn-primary">Descargar Reporte</button>
                </div>
        	</form>
		</div>
	</div>
</div>

<script>
	 function buscarproveedor(valorPuesto) {
        $.ajax({
            data: {valor: valorPuesto},
            url: '{{ route('provedor_reporte') }}',
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},

            beforeSend: function () {
                $("#caja_reporte_proveedor_ajax").html("<div class='progress md-progress primary-color-dark'>\n " +
                    "<div class='indeterminate'></div>\n</div>");
            },
            success: function (data) {
                console.log(data);
                $("#caja_reporte_proveedor_ajax").html(data);

            },
            error: function (data) {
                console.log(data);
                $("#caja_reporte_proveedor_ajax").html("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    " ¡Intente de nuevo!\n" + "</div>");
            }
        });
    }
</script>

<script>
	 function buscarcontrato(valorPuesto) {
        $.ajax({
            data: {valor: valorPuesto},
            url: '{{ route('contrato_reporte') }}',
            type: 'POST',
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        	},

            beforeSend: function () {
                $("#caja_reporte_contrato_ajax").html("<div class='progress md-progress primary-color-dark'>\n " +
                    "<div class='indeterminate'></div>\n</div>");
            },
            success: function (data) {
                console.log(data);
                $("#caja_reporte_contrato_ajax").html(data);

            },
            error: function (data) {
                console.log(data);
                $("#caja_reporte_contrato_ajax").html("<div class=\"alert alert-danger\" role=\"alert\">\n" +
                    " ¡Intente de nuevo!\n" + "</div>");
            }
        });
    }
</script>

{{-- <script type="text/javascript">
	function imprimir(el){
		var rp = document.body.innerHTML;
		var pt = document.getElementById(el).innerHTML;
		document.body.innerHTML = pt;
		window.print();
		document.body.innerHTML = rp;
	}
</script> --}}




@endsection

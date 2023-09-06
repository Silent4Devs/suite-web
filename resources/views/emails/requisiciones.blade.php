<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
	<meta charset="utf-8">

	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="supported-color-schemes" content="light dark">

	<title>Requisciones</title>
	<style>
		.content{
			border-top: 30px solid #2567AE;
			border-bottom: 30px solid #2567AE;
			background-color: #f4f4f4;
			width: 550px !important;
			max-width: 550px !important;
			text-align: center;
			font-family: arial;
			color: #707070;
		}
		.caja-info{
			text-align: center;
			font-family: arial;
			color: #707070;
		}
		img {
			height: auto !important;
        }
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td align="center">

				<table class="content">
					<tr>
						<td>

							<table class="caja-info">
								<tr>
									<td style="padding: 10px 30px 10px 30px;">
										<img class="img-firts" vspace="15" hspace="7" width="100" height="70" src="{{$logo}}" style="margin: auto; margin-top: 30px;"><br><br>
										<img class="img-firts" width="150" height="150" src="{{$img_requi}}" style="margin: auto; margin-top: 30px;">

										@if($tipo_firma_siguiente != 'firma_solicitante')

											@if(($tipo_firma_siguiente == 'firma_comprador_orden') or ($tipo_firma_siguiente == 'firma_finanzas_orden') or ($tipo_firma_siguiente == 'firma_solicitante_orden'))
												<h4 style="font-size: 26px;">Firma de Orden de Compra</h4>
											@elseif ($tipo_firma_siguiente != 'firma_solicitante_orden_finalizado'  && $tipo_firma_siguiente != 'firma_solicitante_orden' && $tipo_firma_siguiente != 'firma_finanzas_orden' && $tipo_firma_siguiente != 'firma_solicitante_orden_finalizado'  && $tipo_firma_siguiente != 'orden_rechazado' && $tipo_firma_siguiente != 'requisicion_rechazado')
												<h4 style="font-size: 26px;">Firma de Requisición</h4>
											@endif

											<p style="font-size: 16px;">
												@if($tipo_firma_siguiente == 'firma_jefe')
													<strong>{{ $requisicion->user }}</strong> le ha mandado una solicitud de firma de requisición.
												@endif
												@if($tipo_firma_siguiente == 'firma_finanzas')
													<strong>{{$supervisor}}</strong> ha autorizado una requisición y solicita su firma.
												@endif
												@if($tipo_firma_siguiente == 'firma_compras')
													Se ha autorizado una requisición y solicita su firma.
												@endif

												@if($tipo_firma_siguiente == 'firma_solicitante_orden')
													<strong>El comprador</strong> ha autorizado la orden de compra <strong>{{ $requisicion->referencia }}</strong> y solicita su firma.
												@endif
												@if($tipo_firma_siguiente == 'firma_finanzas_orden')
													<strong>El comprador y solicitante</strong> han autorizado la orden de compra <strong>{{ $requisicion->referencia }}</strong> y solicitan su firma.
												@endif

                                                @if($tipo_firma_siguiente == 'orden_rechazado')
                                                <strong>Fue rechazada tu Orden Compra</strong> <strong>{{ $requisicion->referencia }}</strong>.
                                                @endif

                                                @if($tipo_firma_siguiente == 'requisicion_rechazado')
                                                <strong>Fue rechazada tu Requisición</strong> <strong>{{ $requisicion->referencia }}</strong>.
                                                @endif
											</p>

                                            @if ($tipo_firma_siguiente != 'firma_solicitante_orden_finalizado'  && $tipo_firma_siguiente != 'firma_jefe'  && $tipo_firma_siguiente != 'firma_compras'  && $tipo_firma_siguiente != 'firma_solicitante'  && $tipo_firma_siguiente != 'firma_finanzas'  && ($tipo_firma_siguiente === 'orden_rechazado' || $tipo_firma_siguiente == 'firma_comprador_orden' ||  $tipo_firma_siguiente == 'firma_finanzas_orden' || $tipo_firma_siguiente == 'firma_solicitante_orden') && $tipo_firma_siguiente != 'requisicion_rechazado')
                                            <p style="font-size: 14px; margin-top: 30px;">
												Para ingresar a la orden de compra dé clic a la siguiente liga, está le llevará directamente a la pantalla para que visualice el documento el cual deberá firmar si lo autoriza.
											</p>
                                            @else
                                            <p style="font-size: 14px; margin-top: 30px;">
                                                @if ($tipo_firma_siguiente != 'firma_solicitante_orden_finalizado')
                                                Para ingresar a la requisición dé clic a la siguiente liga, está le llevará directamente a la pantalla para que visualice el documento el cual deberá firmar si lo autoriza.
                                                @endif

											</p>
                                            @endif


											@if(($tipo_firma_siguiente == 'firma_comprador_orden') or ($tipo_firma_siguiente == 'firma_finanzas_orden') or ($tipo_firma_siguiente == 'firma_solicitante_orden'))
												<a class="link" href="{{ route('orden-compra.firmar', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}" style=" display: block; font-size: 13px;">{{ route('orden-compra.firmar', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}</a>
											@endif

											@if(($tipo_firma_siguiente == 'firma_jefe') or ($tipo_firma_siguiente == 'firma_finanzas') or ($tipo_firma_siguiente == 'firma_compras'))
												<a class="link" href="{{ route('requisiciones.firmar', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}" style=" display: block; font-size: 13px;">{{ route('requisiciones.firmar', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}</a>
											@endif

										@endif


										@if($tipo_firma_siguiente == 'firma_solicitante')

											<h4 style="color: #0BD140; font-size: 26px;">Requisición firmada</h4>

											<p style="font-size: 16px;">
												La requisición <strong>{{ $requisicion->referencia }}</strong> ha sido autorizada y se está generando la orden de compra.
											</p>
											<p style="font-size: 14px; margin-top: 30px;">
												<strong>¡Buen día!</strong>
											</p>

										@endif

										 @if($tipo_firma_siguiente == 'firma_solicitante_orden_finalizado')

											<h4 style="color: #0BD140; font-size: 26px;">Orden de Compra firmada</h4>

											<p style="font-size: 16px;">
												La orden de compra <strong>{{ $requisicion->referencia }}</strong> ha sido autorizada y se está generando tu compra.
											</p>

										@endif

                                        @if($tipo_firma_siguiente == 'firma_solicitante_orden_finalizado')
                                        <a class="link" href="{{ route('orden-compra.show', ['id' => $requisicion->id]) }}" style=" display: block; font-size: 13px;">{{ route('requisiciones.firmar', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}</a>
                                        @endif

                                        @if($tipo_firma_siguiente == 'orden_rechazado')
                                        <a class="link" href="{{ route('orden-compra.edit', ['id' => $requisicion->id]) }}" style=" display: block; font-size: 13px;">{{ route('orden-compra.edit', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}</a>
                                        @endif

                                        @if($tipo_firma_siguiente == 'requisicion_rechazado')
                                        <a class="link" href="{{ route('requisiciones.edit', ['id' => $requisicion->id]) }}" style=" display: block; font-size: 13px;">{{ route('requisiciones.edit', ['tipo_firma' => $tipo_firma_siguiente,'id' => $requisicion->id]) }}</a>
                                        @endif


									</td>
								</tr>
								</table>
							<br><br>
							<div class="caja-blue" style="background-color: #2567AE; padding: 25px 0px;">
								<a href="https://www.facebook.com/silent4business" style="margin: 10px;"><img src="{{ $img_facebook }}" width="25px"></a>&nbsp;&nbsp;&nbsp;
								<a href="https://twitter.com/silent4business" style="margin: 10px;"><img src="{{ $img_twitter }}" width="25px"></a>&nbsp;&nbsp;&nbsp;
								<a href="https://www.linkedin.com/company/silent4business/mycompany/" style="margin: 0px 10px;"><img src="{{ $img_linkedin }}" width="25px"></a>
							</div>
							<p>
								SISTEMA DE REQUISICIONES Y ORDENES DE COMPRA
							</p>
						</td>
					</tr>
				</table>
			</td>
		</tr>

	</table>

</body>
</html>

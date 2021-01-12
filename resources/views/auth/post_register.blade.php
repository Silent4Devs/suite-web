<!DOCTYPE html>
<html>
<head>
	<title>TABANTAJ</title>
	<meta charset="utf-8">

	<style type="text/css">
		body{
			background-image: url(img/auth-bg2.jpg);
			background-size: cover;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-position: center;

			font-family: calibri;
			font-weight: lighter;
		}

		.contenido{
			width: 90%;
			max-width: 500px;
			height: 220px;
			padding: 20px;
			background-color: #fff;

			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			margin: auto;
			border: 1px solid #ccc;
		}
		h1{
			width: 100%;
			margin: 0;
			color: #3f4959;
			font-size: 30pt;
			font-weight: normal;
		}
		p{
			font-size: 13pt;
			color: #3f4959;
		}
		.caja_btn{
			width: 100%;
		}
		.caja_btn a{
			color: #fff;
			text-decoration: none;
		}
		.btn{
			width: 100%;
			background-color: #1d00cf;
			opacity: 0.85;
			padding: 10px 0px;
			border-radius: 6px;
			text-align: center;
			transition: 0.2s;
		}
		.btn:hover{
			opacity: 1;
		}
	</style>
</head>
<body>
	<div class="contenido">
		<h1>TABANTAJ</h1>
		<p>
			¡Registro exitoso!
		</p>
		<p>
			 El administrador del sistema aprobará su solicitud en un lapso de 48 horas y se le notificará a través de su correo electrónico.
		</p>
		<div class="caja_btn">
			<a href="{{ url("/login") }}">
				<div class="btn">
					Inicio
				</div>
			</a>
		</div>
	</div>
</body>
</html>
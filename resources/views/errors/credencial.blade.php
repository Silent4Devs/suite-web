<!DOCTYPE html>
<html>
<head>
	<title></title>

	<style type="text/css">
		body{
			margin: 0;

			background-image: url({{ asset('img/errors/fondo.png') }});
			background-repeat: no-repeat;
			background-position: center;
			background-size: cover;
			background-attachment: fixed;
		}
		.tarjeta{
			width: 95%;
			max-width: 600px;
			height: 350px;
			border-radius: 25px;
			background-color: rgba(0,51,64,0.75);
			box-shadow: 10px 10px 15px -5px #131c24;

			position: absolute;
			margin:auto;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;

			display: flex;
			align-items: center;
			justify-content: center;
		}
		.izquierda{
			width: 45%;
			height: 100%;

			display: flex;
			justify-content: center;
			align-items: center;
		}
		.imagen{
			width: 200px;
			height: 250px;

			background-image: url({{ asset('img/errors/credencial.png') }});
			background-repeat: no-repeat;
			background-size: contain;
			background-position: center;
			position: absolute;

			animation: mover 7s infinite linear;
		}
		@keyframes mover{
			0%{
				margin-left: 0px;
				margin-top: -20px;
			}
			25%{
				margin-left: 20px;
				margin-top: 0px;
			}
			50%{
				margin-left: 0px;
				margin-top: 20px;
				transform: rotate(6deg);
			}
			75%{
				margin-left: -20px;
				margin-top: 0px;
			}
			100%{
				margin-left: 0px;
				margin-top: -20px;
				transform: (0deg);
			}
		}
		.derecha{
			width: 55%;
			height: 60%;
		}
		.caja{
			width: 100%;
			height: 33.33%;
			font-family: 'Nunito', sans-serif;
			color: #fff;

			display: flex;
			justify-content: center;
			align-items: center;
		}
		.codigo{
			font-size: 70pt;
			font-weight: bolder;
		}
		.mensaje{
			font-size: 20pt;
		}
		.boton{
			width: 170px;;
			height: 40px;
			color: #fff;
			border-radius: 10px;
			border: 1px solid #fff;

			display: flex;
			justify-content: center;
			align-items: center;
			transition: 0.2s;
		}
		.boton:hover{
			border-radius: 50px;
			background-color: #fff;
			color: #0b3963;

		}
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>

	<div class="tarjeta">
		<div class="izquierda">
			<div class="imagen"></div>
		</div>
		<div class="derecha">
			<div class="caja codigo">
				@yield('code')
			</div>
			<div class="caja mensaje">
				@yield('message')
			</div>
			<div class="caja">
				<a href="{{ app('router')->has('home') ? route('home') : url('/admin') }}">
					<div class="boton">Ok</div>
				</a>
			</div>
		</div>
	</div>

</body>
</html>
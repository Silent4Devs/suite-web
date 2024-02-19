<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="3600">
	<title>TABANTAJ</title>
	<style type="text/css">
		body{
			background-color: #000;
			margin: 0;
		}
		#slider{
			position: absolute;
			height: 100%;
			width: 100%;
			padding: 0;
			margin: 0;
			list-style: none;
			overflow: hidden;
		}
		#slider li{
			position: absolute;
			width: 100%;
			height: 100%;
			justify-content: center;
			align-items: center;
			display: flex;
			background-color: #000;
			transition: 1.5s;
			opacity: 0;
			margin-left: 80%;
			transform: scale(0.65);
		}
		#slider li img, #slider li video{
			height: 100%;
		}
		#slider .actual{
			opacity: 1;
			margin-left: 0%;
			transform: scale(1);
			/*animation: 1s cambio;*/
		}
		.siguiente{
			opacity: 0;
			margin-left: -80% !important;
			transform: scale(0.65) !important;
		}
	</style>
</head>
<body>

	<ul id="slider">
		<li class=""><img src="{{ asset('img/Carrusel_inicio.png') }}"></li>
		@forelse($comunicacionSgis_carrusel as $idx=>$carrusel)
            @php
                if ($carrusel->first()->count()) {
                    if ($carrusel->imagenes_comunicacion->first()) {
                        $imagen = 'storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen;
                    }
                } else {
                    $imagen = 'img/tabantaj_fondo_blanco.webp';
                }

                $tipo_archivo = $carrusel->imagenes_comunicacion->first() ?  $carrusel->imagenes_comunicacion->first()->tipo : '';
            @endphp
			<li class="" data-tipo="{{ $tipo_archivo }}">
				@if($tipo_archivo == 'video')
					<video muted controls src="{{ asset($imagen) }}">
						<source src="{{ asset($imagen) }}" type="video">
					</video>
				 @else
				 	<img src="{{ asset($imagen) }}">
				@endif
			</li>
		 @empty
		 	<li class=""><img src="{{ asset('img/tabantaj_fondo_blanco.webp') }}"></li>
		@endforelse
	</ul>

	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script type="text/javascript">
		$(document).click(function(){
			document.body.requestFullscreen();
		});

		$(document).ready(function(){
			let duracion = Number(30000);
			let video_duracion;

			let first = $('#slider li:first-child');
			let last = $('#slider li:last-child');

			first.attr('data-n', 'primero');
			last.attr('data-n', 'ultimo');

			$('#slider li:last-child').addClass('anterior');
			$('#slider li:first-child').addClass('actual');
			$('#slider li:nth-child(2)').addClass('siguiente');

			let previous = $('#slider li.anterior');;
			let current = $('#slider li.actual');
			let next = $('#slider li.siguiente');

			previous.addClass('anterior');
			current.addClass('actual');
			next.addClass('siguiente');

			function slider()
			{
				previous.removeClass('anterior');
				previous = current;
				previous.addClass('anterior');

				current.removeClass('actual');
				current = next;
				current.addClass('actual');

				if (next.attr('data-n') != 'ultimo') {
					next = $('#slider li.siguiente + li');
				}else{
					next = $('#slider li:first-child');
				}
				$('#slider li.siguiente').removeClass('siguiente');
				next.addClass('siguiente');

				if (current.attr('data-tipo') === 'video') {
					document.querySelector('#slider li.actual video').play();
					video_duration = (Number(document.querySelector('#slider li.actual video').duration)) * 1000;
					setTimeout(slider, video_duration);
				}else{
					setTimeout(slider, duracion);
				}
			}
			if (current.attr('data-n') != 'ultimo') {
				setTimeout(slider, duracion);
			}
		});
	</script>
    <script>
        // JavaScript para recargar la página automáticamente cada hora
        setTimeout(function() {
            location.reload(true);
        }, 3600000); // 3600000 milisegundos = 1 hora
    </script>
</body>
</html>

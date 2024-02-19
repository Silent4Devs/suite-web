<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta http-equiv="refresh" content="3600"> --}}
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
            width: 100%;
			height: 100%;
            object-fit: contain;
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
					<video muted controls>
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
	<script type="text/javascript">
		document.addEventListener("click", function() {
            if (document.body.requestFullscreen) {
                document.body.requestFullscreen();
            } else if (document.body.webkitRequestFullscreen) { /* Safari */
                document.body.webkitRequestFullscreen();
            } else if (document.body.msRequestFullscreen) { /* IE11 */
                document.body.msRequestFullscreen();
            }
        });

        document.addEventListener("DOMContentLoaded", function() {
            let duracion = Number(30000);
            let video_duration;

            let first = document.querySelector('#slider li:first-child');
            let last = document.querySelector('#slider li:last-child');

            first.setAttribute('data-n', 'primero');
            last.setAttribute('data-n', 'ultimo');

            document.querySelector('#slider li:last-child').classList.add('anterior');
            document.querySelector('#slider li:first-child').classList.add('actual');
            document.querySelector('#slider li:nth-child(2)').classList.add('siguiente');

            let previous = document.querySelector('#slider li.anterior');
            let current = document.querySelector('#slider li.actual');
            let next = document.querySelector('#slider li.siguiente');

            previous.classList.add('anterior');
            current.classList.add('actual');
            next.classList.add('siguiente');

            function slider() {
                previous.classList.remove('anterior');
                previous = current;
                previous.classList.add('anterior');

                current.classList.remove('actual');
                current = next;
                current.classList.add('actual');

                if (next.getAttribute('data-n') !== 'ultimo') {
                    next = document.querySelector('#slider li.siguiente + li');
                } else {
                    next = document.querySelector('#slider li:first-child');
                }
                document.querySelector('#slider li.siguiente').classList.remove('siguiente');
                next.classList.add('siguiente');

                if (current.getAttribute('data-tipo') === 'video') {
                    document.querySelector('#slider li.actual video').play();
                    video_duration = Number(document.querySelector('#slider li.actual video').duration) * 1000;
                    setTimeout(slider, video_duration);
                } else {
                    setTimeout(slider, duracion);
                }
            }

            if (current.getAttribute('data-n') !== 'ultimo') {
                setTimeout(slider, duracion);
            }
        });

        // setTimeout(function() {
        //     location.reload(true);
        // }, 3600000); // 3600000 milisegundos = 1 hora
    </script>
</body>
</html>

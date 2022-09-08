<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
			transition: 0.5s;
			opacity: 0;
			margin-left: 300px;
			transform: scale(0.9);
		}
		#slider li img{
			height: 100%;
		}
		#slider .active{
			transition: 0;
			opacity: 1;
			margin-left: 0px;
			transform: scale(1);
			animation: 1s cambio;
		}

		@keyframes cambio{
			0%{
				opacity: 0;
				margin-left: -300px;
				transform: scale(0.9);
			}	
			100%{
				opacity: 1;
				margin-left: 0px;
				transform: scale(1);
			}
		} 
	</style>
</head>
<body>

	<ul id="slider">
		@forelse($comunicacionSgis_carrusel as $idx=>$carrusel)
            @php
                if ($carrusel->first()->count()) {
                    if ($carrusel->imagenes_comunicacion->first()) {
                        $imagen = 'storage/imagen_comunicado_SGI/' . $carrusel->imagenes_comunicacion->first()->imagen;
                    }
                } else {
                    $imagen = 'img/tabantaj_fondo_blanco.png';
                }

            @endphp
			<li class=""><img src="{{ asset($imagen) }}"></li>
		 @empty
		 	<li class=""><img src="{{ asset('img/tabantaj_fondo_blanco.png') }}"></li>
		@endforelse
	</ul>

	<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
	<script type="text/javascript">
		$('#slider li:first-child').addClass('active');
		function slider() {
			let current = $('#slider li.active');
			let next = $('#slider li.active + li');
			let first = $('#slider li:first-child'); 
			let last = $('#slider li:last-child');

			last.attr('data-n', 'ultimo');
			
			if (current.attr('data-n') != 'ultimo') {
				current.removeClass('active');	
				next.addClass('active');	
			}else{
				current.removeClass('active');
				first.addClass('active');
			}
			setTimeout(slider, 20000);
		}
		setTimeout(slider, 20000);
		$(document).click(function(){
			document.body.requestFullscreen();
		});
	</script>
</body>
</html>
<div class="row">
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica">Todos los Registros</h4>
		<canvas id="graf-registros-general" width="400" height="400"></canvas>
	</div>
	<div class="col-md-8 caja-cards-areas p-4" style="position: relative;">
		<h4 class="titulo-grafica">Partisipación de Áreas</h4>
		<div style="position:absolute; height:90%; overflow:auto;" class="scroll_estilo mt-3">
			@foreach($areas_array as $area_p)
				<div class="card-body card partisipacion-{{ $area_p['nivel_p'] }}">
					<h5>{{ $area_p['area'] }}</h5>
					<h4>{{ $area_p['partisipacion'] }}%</h4>
					<div class="progress mt-3">
					  	<div class="progress-bar" role="progressbar" style="width: {{ $area_p['partisipacion'] }}%" aria-valuenow="{{ $area_p['partisipacion'] }}" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
				</div>
		    @endforeach
		</div>
	</div>
</div>
<div class="row">
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica">Áreas con horas aprobadas</h4>
		<canvas id="graf-areas-aprobadas-general" width="400" height="400"></canvas>
	</div>
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica">Áreas con horas pendientes de aprobar</h4>
		<canvas id="graf-areas-pendientes-general" width="400" height="400"></canvas>
	</div>
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica">Áreas con horas rechazadas</h4>
		<canvas id="graf-areas-rechazadas-general" width="400" height="400"></canvas>
	</div>
</div>
<script>
	new Chart(document.getElementById('graf-registros-general'), {
	    type: 'doughnut',
	    data: {
	        labels: ['Aprobados', 'Rechazados', 'Pendientes', 'Borradores'],
	        datasets: [{
	            label: '# of Votes',
	            data: [{{ $aprobados_contador }}, {{ $rechazos_contador }}, {{ $pendientes_contador }}, {{ $borrador_contador }}],
	            backgroundColor: [
	                '#61CB5C',
	                '#EA7777',
	                '#F48C16',
	                '#aaa',
	            ],
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }
	        }
	    }
	});
</script>
<script>
	new Chart(document.getElementById('graf-areas-aprobadas-general'), {
	    type: 'bar',
	    data: {
	        labels: [
		        @foreach($areas_array as $area_a)
		        	'{{ $area_a['area'] }}',
		        @endforeach
	        ],
	        datasets: [{
	            label: '', 
	            data: [
	            	@foreach($areas_array as $area_a)
		            	{{ $area_a['times_aprobados'] }}, 
		            @endforeach
	            ],
	            backgroundColor: [
	            	@foreach($areas_array as $area_a)
	                	'#61CB5C',
	                @endforeach
	            ],
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }
	        }
	    }
	});
</script>
<script>
	new Chart(document.getElementById('graf-areas-pendientes-general'), {
	    type: 'bar',
	    data: {
	        labels: [
		        @foreach($areas_array as $area_a)
		        	'{{ $area_a['area'] }}',
		        @endforeach
	        ],
	        datasets: [{
	            label: '', 
	            data: [
	            	@foreach($areas_array as $area_a)
		            	{{ $area_a['times_pendientes'] }}, 
		            @endforeach
	            ],
	            backgroundColor: [
	            	@foreach($areas_array as $area_a)
	                	'#F48C16',
	                @endforeach
	            ],
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }
	        }
	    }
	});
</script>
<script>
	new Chart(document.getElementById('graf-areas-rechazadas-general'), {
	    type: 'bar',
	    data: {
	        labels: [
		        @foreach($areas_array as $area_a)
		        	'{{ $area_a['area'] }}',
		        @endforeach
	        ],
	        datasets: [{
	            label: '', 
	            data: [
	            	@foreach($areas_array as $area_a)
		            	{{ $area_a['times_rechazados'] }}, 
		            @endforeach
	            ],
	            backgroundColor: [
	            	@foreach($areas_array as $area_a)
	                	'#EA7777',
	                @endforeach
	            ],
	        }]
	    },
	    options: {
	        scales: {
	            y: {
	                beginAtZero: true
	            }
	        }
	    }
	});
</script>
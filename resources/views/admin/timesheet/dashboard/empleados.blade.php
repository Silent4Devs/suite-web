<div class="row">
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica d-flex justify-content-between">Porcentaje de participación de los empleados de este mes <a href="{{ asset('admin/timesheet/reportes') }}">Ver detalle</a></h4>
		<canvas id="graf-empleados-participacion" width="400" height="400"></canvas>
	</div>
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica d-flex justify-content-between">Empleados con registros atrasados <a href="{{ asset('admin/timesheet/reportes') }}">Ver detalle</a></h4>
		<canvas id="graf-empleados-atrasados" width="400" height="400"></canvas>
	</div>
	<div class=" col-md-4 p-4">
		<h4 class="titulo-grafica d-flex justify-content-between">Empleados por área <a href="{{ asset('admin/timesheet/reportes') }}">Ver detalle</a></h4>
		<canvas id="graf-empleados-area" width="400" height="400"></canvas>
	</div>
</div>
<script>
	new Chart(document.getElementById('graf-empleados-participacion'), {
	    type: 'doughnut',
	    data: {
	        labels: ['% Empleados con registros', '% Empleados sin registros'],
	        datasets: [{
	            label: '%',
	            data: [{{ $porcentaje_participacion }}, {{ 100 - $porcentaje_participacion }}],
	            backgroundColor: [
	                '#29C0D2',
	                '#bbb',
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
	new Chart(document.getElementById('graf-empleados-atrasados'), {
	    type: 'pie',
	    data: {
	        labels: ['Atrasados','Actuales'],
	        datasets: [{
	            label: 'Empleados',
	            data: [{{ $empleados_times_atrasados }}, {{ $empleados_count - $empleados_times_atrasados }}],
	            backgroundColor: [
	                '#FF5454',
	                '#29C0D2',
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
	new Chart(document.getElementById('graf-empleados-area'), {
	    type: 'bar',
	    data: {
	        labels: [
	        	@foreach($areas as $area)
					'{{ $area->area }}',
				@endforeach
	        ],
	        datasets: [{
	            label: 'Empleados',
	            data: [
	            	@foreach($areas as $area)
						{{ $area->empleados->count() }},
					@endforeach
	            ],
	            backgroundColor: [
	                @foreach($areas as $area)
						'#34DCCF',
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
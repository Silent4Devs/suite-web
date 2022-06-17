<div class="row">
	<div class=" col-lg-4 p-4">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">Empleados por área <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-empleados-area" width="400" height="400"></canvas>
        </div>
	</div>
	<div class=" col-lg-4 p-4">
        <div class="card card-body"  style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">Porcentaje de participación de los empleados de este mes <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-empleados-participacion" width="400" height="400"></canvas>
        </div>
	</div>
	<div class=" col-lg-4 p-4">
        <div class="card card-body" style="min-height:330px !important;">
            <h4 class="titulo-grafica d-flex justify-content-between">Empleados con registros atrasados de este mes <a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a></h4>
            <canvas id="graf-empleados-atrasados" width="400" height="400"></canvas>
        </div>
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
	            yAxes: [{
	                ticks: {
	                    beginAtZero:true
	                }
	            }]
	        }
        },

        plugins: [{
		    /* Adjust axis labelling font size according to chart size */
		    beforeDraw: function(c) {
		        var chartHeight = c.chart.height;
		        var size = chartHeight * 5 / 100;
		        c.scales['y-axis-0'].options.ticks.minor.fontSize = size;
		    }
		}]
	});
</script>

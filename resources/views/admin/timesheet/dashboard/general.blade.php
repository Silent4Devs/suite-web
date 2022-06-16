<div class="row">
	<div class="col-md-4 p-4" style="position:relative; height: 500px;">
		<div class="card card-body" style="position: absolute; height:90%; width: 90%;">
			<h5 class="titulo-grafica d-flex justify-content-between">
				<div><i class="fa-solid fa-circle mr-3" style="color:#F48C16;"></i>Registros en Timesheet</div>
				<a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
			</h5>
			<canvas id="graf-registros-general" width="400" height="400"></canvas>
			<div class="total_graf_times_inner" style="position: absolute; z-index:2; top: -10px; left:0; right:0; bottom: 0; width: 30px; margin:auto; height: 30px; color:#000;">
				<div class="d-flex justify-content-center align-items-center" style="font-size: 50px; font-weight: lighter; margin-top: -40px;">
					{{-- {{ $aprobados_contador + $rechazos_contador + $pendientes_contador + $borrador_contador }} --}}
				</div>
				<div class="d-flex justify-content-center align-items-center" style="font-size: 30px; margin-top:-15px; font-weight: lighter;">
					{{-- <small style="color:#777;">Registros</small> --}}
				</div>
			</div>

			

			<div class="d-flex mt-4">            	
            	Registros totales: <strong class="ml-3"> {{ $aprobados_contador + $rechazos_contador + $pendientes_contador + $borrador_contador }}</strong>
            </div>
		</div>
	</div>
	<div class="col-md-8 p-4" style="position: relative; height: 500px;">
		<div class="card-body card caja-cards-areas" style="position: absolute; height:90%; width: 90%; right: 1.5rem;">
			<h5 class="titulo-grafica d-flex justify-content-between">
				<div><i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros Aprobados por Área</div>
				<a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
			</h5>
			<div style="width: 100%; overflow:auto;" class="scroll_estilo mt-3 d-flex p-2">
				@php
					$i=0;
				@endphp
				@foreach($areas_array as $area_p)
					@php
						$i++;
					@endphp
					@if($i==1)
						<div>
					@endif
					
					<div class="card-body card" style="position:relative;">
						<div style="background-color:#DBEBF4; padding: 4px; border-radius: 4px; position: absolute; right: 6px; top: 6px; font-size: 9px;">Total de registros: <strong>{{ $area_p['times_aprobados'] + $area_p['times_pendientes'] + $area_p['times_rechazados'] + $area_p['times_papelera'] }}</strong></div>
						<h5 class="mt-2">{{ Str::limit($area_p['area'], 30, '...') }}</h5>
						<h4>{{ $area_p['partisipacion'] }}% <small style="font-size: 13px;">de participación</small></h4>
						<div class="progress">
						  	<div class="progress-bar partisipacion-{{ $area_p['nivel_p'] }}" role="progressbar" style="width: {{ $area_p['partisipacion'] }}%" aria-valuenow="{{ $area_p['partisipacion'] }}" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
						<small><strong>{{ $area_p['times_aprobados'] }}</strong> aprobados / <strong>{{ $area_p['times_esperados']}}</strong> registros esperados</small>

						{{-- <div class="mt-2">
							<strong>Aprobación del Área</strong><br>
							<small><strong>{{ $area_p['times_aprobados'] }}</strong> aprobados / <strong>{{ $area_p['times_pendientes'] }}</strong> pendientes</small>
						</div> --}}
					</div>


					@if($i==2)
						</div>
						@php
							$i=0;
						@endphp
					@endif
			    @endforeach
			    @if($i==1)
					</div>
				@endif
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-12 p-4">
		<div class="card-body card">
			<h5 class="titulo-grafica d-flex justify-content-between">
				<div><i class="fa-solid fa-circle mr-3" style="color:#8BE578;"></i>Registros de Timesheet por Área</div>
				<a href="{{ asset('admin/timesheet/reportes') }}">Ver&nbsp;detalle</a>
			</h5>
			<canvas id="graf-areas-times-estatus-general" width="400" height="200"></canvas>
		</div>
	</div>
</div>
<script>
	const legendMargin = {
		id: 'legendMargin',
		beforeInit (chart, legend, options) {
			const fitValue = chart.legend. fit;

			chart.legend.fit = function fit() {
				fitValue.bind(chart.legend)();
				return this.height += 20;
			}
		}
	};
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
	        },
	        layout:{
	        	padding:{
	        		top:20
	        	}
	        },
	        legend: {
	        	display:true,
	        	position:'bottom',
	        	align:'start',
	        	labels: {
	                fontColor: "black",
	                boxWidth: 20,
	                padding: 10
	            }
	        },
	        plugins: {
			      datalabels: {
			        color: '#fff',
			        display: true, 
			        font:{
						size:20
					}
				},
			},
	    }
	});

	// Chart.pluginService.register({
	//   beforeDraw: function(chart) {
	//     var width = chart.chart.width,
	//         height = chart.chart.height,
	//         ctx = chart.chart.ctx;
	//     ctx.restore();
	//     var fontSize = (height / 114).toFixed(2);
	//     ctx.font = fontSize + "em sans-serif";
	//     ctx.textBaseline = "middle";
	//     var text = "{{ $aprobados_contador + $rechazos_contador + $pendientes_contador + $borrador_contador }}",
	//         textX = Math.round((width - ctx.measureText(text).width) / 2),
	//         textY = height / 2;
	//     ctx.fillText(text, textX, textY);
	//     ctx.save();
	//   }
	// });
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

<script>

    let areas_array = @json($areas_array);
    console.log(areas_array);
    var ctx = document.getElementById("graf-areas-times-estatus-general");
    var chart = new Chart(ctx, {
        type: "horizontalBar",
        data: {
            labels: [
            	@foreach($areas_array as $area_a)
		        	'{{ $area_a['area'] }}',
		        @endforeach
            ],
            datasets: [
                {
                    type: "horizontalBar",
                    backgroundColor: "#61CB5C",
                    label: "Aprobados",
                    data: [@foreach($areas_array as $area) {{ $area['times_aprobados'] }}, @endforeach],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#F48C16",
                    label: "Pendientes",
                    data: [@foreach($areas_array as $area) {{ $area['times_pendientes'] }}, @endforeach],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',
                    }
                },
            	{
                    type: "horizontalBar",
                    backgroundColor: "#EA7777",
                    label: "Rechazados",
                    data: [@foreach($areas_array as $area) {{ $area['times_rechazados'] }}, @endforeach],
                    options: {
                        indexAxis: 'y',
                    }
                },
                {
                    type: "horizontalBar",
                    backgroundColor: "#aaa",
                    label: "Borradores",
                    data: [@foreach($areas_array as $area) {{ $area['times_papelera'] }}, @endforeach],
                    lineTension: 0,
                    fill: true,
                    options: {
                        indexAxis: 'y',

                    }
                }
            ]
        },
        options: {
            yAxis: {
                title: {
                    text: 'Total tipo contrato'
                },
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    },
                    scaleLabel: {
                        display: true,
                        labelString: 'Áreas',
                        fontSize: 15,
                        fontColor: "#345183"

                    },
                    gridLines: {
                        color: "#ccc"
                    },
                }],

                xAxes:[{
                    scaleLabel: {
                        display: true,
                        labelString: 'Registros de Timesheet',
                        fontSize: 15,
                        fontColor: "#345183"

                    },
                    gridLines: {
                        color: "#ccc"
                    },
                }]
            },

           plugins: {

	            datalabels: {
	                color: '#000',
	                display: true,
	                font: {
	                    size: 8
	                },
	                formatter: function(value,index,values){
	                    if(value>0){
	                        return value;
	                    }
	                    return '';
	                }
	            },
	        },

        },

    });
</script>
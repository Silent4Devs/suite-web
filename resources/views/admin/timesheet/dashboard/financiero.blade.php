<div class="card card-body">
    <canvas id="graf-financiero-1" width="400" height="100"></canvas>
</div>
<div class="card-body">
    <div class="d-flex gap-2 flex-wrap">
        @foreach ($proyectos_array as $proyecto)
            <div class="card card-body">
                <h5 class="text-center">{{ $proyecto->proyecto }}</h5>
                @php
                    $suma_costo = 0;
                @endphp
                @if (isset($proyecto->empleados))
                    @foreach ($proyecto->empleados as $empleado)
                        @php
                            $suma_costo += $empleado['costo_horas'];
                        @endphp
                    @endforeach
                @endif

                <p>
                    Costo total: <strong> ${{ $suma_costo }} </strong>
                </p>
                <p>
                    Total de Horas: <strong> {{ $proyecto->horas_totales_llenas }} </strong>
                </p>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let graf_general = new Chart(document.getElementById('graf-financiero-1'), {
            type: 'bar', // Cambiado a tipo de gráfico de barras
            data: {
                labels: [

                ],
                datasets: [{
                    data: [1, 2, 3, 4],
                    backgroundColor: [
                        '#61CB5C',
                        '#EA7777',
                        '#F48C16',
                        '#aaa',
                    ],
                }]
            },
            options: {
                layout: {
                    padding: {
                        top: 20
                    }
                },
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        color: '#fff',
                        display: false,
                        font: {
                            size: 20
                        }
                    },
                },
            }
        });
    });
</script>

<div>
    <div class="mt-3 row">
        <div class="col-12">
            <div class="mt-2 text-center form-group"
                style="background-color:#345183; border-radius: 100px; color: white;">
                Comparar
            </div>
        </div>
        <div class="col-5">
            <select class="form-control" name="" wire:model="evaluacion1" id="evaluacion1">
                <option value="">-- Selecciona evaluación 1 --</option>
                @foreach ($evaluaciones as $evaluacion)
                    <option value="{{ $evaluacion->id }}">{{ $evaluacion->nombre }}</option>
                @endforeach
            </select>
            @if ($errors->has('evaluacion1'))
                <span clas="text-danger">{{ $errors->first() }}</span>
            @endif
        </div>
        <div class="col-5">
            <select class="form-control" name="" wire:model="evaluacion2" id="evaluacion2">
                <option value="">-- Selecciona evaluación 2 --</option>
                @foreach ($evaluaciones as $evaluacion)
                    <option value="{{ $evaluacion->id }}">{{ $evaluacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <button class="h-100 btn btn-sm btn-primary" wire:click="compararEvaluaciones('evaluado')">Comparar</button>
        </div>

        <div class="col-6">
            <canvas id="autoevaluacionGraficaCompare" width="400" height="400"></canvas>
        </div>
        <div class="col-6">
            <canvas id="radarCompetenciasCompare" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('renderCharts', () => {
            let competencias_lista_nombre = @this.get('competencias_lista_nombre_max');
            let calificaciones_autoevaluacion_competencias = @this.get(
                'calificaciones_autoevaluacion_competencias_compare_first');
            let calificaciones_autoevaluacion_competencias_compare = @this.get(
                'calificaciones_autoevaluacion_competencias_compare');

            compararGraficas(competencias_lista_nombre, calificaciones_autoevaluacion_competencias,
                calificaciones_autoevaluacion_competencias_compare);
        });
    })

    function compararGraficas(competencias_lista_nombre, calificaciones_autoevaluacion_competencias,
        calificaciones_autoevaluacion_competencias_compare) {
        let labels = competencias_lista_nombre;
        let data = {
            labels: labels,
            datasets: [{
                label: 'Autoevaluación',
                backgroundColor: 'rgb(46, 204, 65)',
                borderColor: 'rgb(46, 204, 65)',
                data: calificaciones_autoevaluacion_competencias,
            }, {
                label: 'Jefe Inmediato',
                backgroundColor: 'rgb(46, 106, 204)',
                borderColor: 'rgb(46, 106, 204)',
                data: calificaciones_autoevaluacion_competencias_compare,
            }]
        };
        let config = {
            type: 'line',
            data: data,
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'Autoevaluación vs Jefe Inmediato',
                    }
                }
            }
        };

        if (window.graficaAutoJefe instanceof Chart) {
            window.graficaAutoJefe.destroy();
        }
        window.graficaAutoJefe = new Chart(
            document.getElementById('autoevaluacionGraficaCompare'),
            config
        );


        //Radar
        const dataRadar = {
            labels: competencias_lista_nombre,
            datasets: [{
                label: 'Evaluación 1',
                data: calificaciones_autoevaluacion_competencias,
                fill: true,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgb(255, 99, 132)',
                pointBackgroundColor: 'rgb(255, 99, 132)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(255, 99, 132)'
            }, {
                label: 'Evaluación 2',
                data: calificaciones_autoevaluacion_competencias_compare,
                fill: true,
                backgroundColor: 'rgba(192, 57, 43, 0.2)',
                borderColor: 'rgb(192, 57, 43)',
                pointBackgroundColor: 'rgb(192, 57, 43)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(192, 57, 43)'
            }]
        };
        const configRadar = {
            type: 'radar',
            data: dataRadar,
            options: {
                elements: {
                    line: {
                        borderWidth: 3
                    },
                    plugins: {
                        title: {
                            display: true,
                            text: 'Autoevaluación vs Misma área',
                        }
                    }
                }
            },
        };
        if (window.radarChart instanceof Chart) {
            window.radarChart.destroy();
        }
        window.radarChart = new Chart(
            document.getElementById('radarCompetenciasCompare'),
            configRadar
        );
    }
</script>

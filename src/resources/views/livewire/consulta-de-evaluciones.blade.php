<div>
    <div class="mt-2 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
        Aplicar Búsqueda
    </div>
    <div class="row">
        <div class="col-6">
            <label for="evaluacion"><i class="mr-2 fas fa-filter"></i>Consulta por evaluación</label>
            <select wire:change.prevent="resetComparar" class="form-control" name="" wire:model="evaluacion"
                id="evaluacion">
                <option value="">-- Selecciona una evaluación --</option>
                @foreach ($evaluaciones as $evaluacion)
                    <option value="{{ $evaluacion->id }}">{{ $evaluacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        @if ($equipo)
            <div class="col-6">
                <label for="evaluado"><i class="mr-2 fas fa-filter"></i>Selecciona Evaluado</label>
                <select wire:change.prevent="resetComparar" class="form-control" name="" wire:model="evaluado"
                    id="evaluado">
                    <option value="">-- Selecciona una evaluado --</option>
                    @foreach ($empleados as $empleado)
                        <option value="{{ $empleado->id }}">{{ $empleado->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>

    <div x-data="{ show: true }">
        <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
            Resultados
            <a style="cursor: pointer" @click="show=!show">
                <i style="float: right;margin-right: 12px;margin-top: 4px;" class="fas"
                    :class="[show ? 'fa-minus' : 'fa-plus']"></i>
            </a>
        </div>
        <div class="row" x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
            <div class="col-12" x-data="{ show: false }" style="width:100px !important;">
                <div style="display: flex;justify-content: end">
                    <button title="Gráfica Radar" @click="show=true" class="btn btn-sm"
                        x-bind:style="show?'background:blue;color:white':'backgrond:white'"><i
                            class="fas fa-chart-area"></i></button>
                    <button title="Gráfica de Barras" @click="show=false" class="btn btn-sm"
                        x-bind:style="!show?'background:blue;color:white':'backgrond:white'"><i
                            class="fas fa-chart-bar"></i></button>
                </div>
                <div x-show="show" x-transition>
                    <canvas id="radarCompetencias" width="400" height="400"></canvas>
                </div>
                <div x-show="!show" x-transition>
                    <canvas id="barCompetencias" width="400" height="400"></canvas>
                </div>
            </div>
            <div class="col-6">
                <canvas id="jefeGrafica" width="350" height="350"></canvas>
            </div>
            <div class="col-6">
                <canvas id="equipoGrafica" width="350" height="350"></canvas>
            </div>
            <div class="col-6">
                <canvas id="areaGrafica" width="350" height="350"></canvas>
            </div>
            {{-- @dump($competencias_lista_nombre) --}}
        </div>
        <div x-show="show" x-transition:enter.duration.500ms x-transition:leave.duration.400ms
            class="display-almacenando row" wire:loading.grid>
            <div class="col-12">
                <h1>
                    <div class="lds-facebook">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </h1>
            </div>
        </div>
    </div>

    <div class="mt-3 row">
        <div class="col-12">
            <div class="mt-2 text-center form-group"
                style="background-color:#345183; border-radius: 100px; color: white;">
                Comparar
            </div>
        </div>
        <div class="col-5">
            <label for="evaluacion1"><i class="mr-2 fas fa-book"></i>Evaluación 1</label>
            <select class="form-control" name="" wire:model.defer="evaluacion1" id="evaluacion1">
                <option value="">-- Selecciona evaluación 1 --</option>
                @foreach ($evaluaciones as $evaluacion)
                    <option value="{{ $evaluacion->id }}">{{ $evaluacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-5">
            <label for="evaluacion2"><i class="mr-2 fas fa-book"></i>Evaluación 2</label>
            <select class="form-control" name="" wire:model.defer="evaluacion2" id="evaluacion2">
                <option value="">-- Selecciona evaluación 2 --</option>
                @foreach ($evaluaciones as $evaluacion)
                    <option value="{{ $evaluacion->id }}">{{ $evaluacion->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <button class="h-100 btn btn-sm btn-primary" wire:click="compararEvaluaciones">Comparar</button>
        </div>
        <div class="col-12" x-data="{ show: $wire.showCompare }">
            <div class="row">
                <div class="col-12">
                    <p class="m-0 mt-2">
                        <i class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i>
                        <a style="cursor: pointer" @click="show=!show" x-text="!show?'Mostrar':'Ocultar'">
                            Mostrar
                        </a>
                    </p>
                </div>
                <div class="col-6" x-show="show" x-transition:enter.duration.500ms
                    x-transition:leave.duration.400ms>
                    <canvas id="radarCompetenciasCompare" width="400" height="400"></canvas>
                </div>
                <div class="col-6" x-show="show" x-transition:enter.duration.500ms
                    x-transition:leave.duration.400ms>
                    <canvas id="autoevaluacionGraficaCompare" width="400" height="400"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('renderCharts', () => {
            let competencias_lista_nombre = @this.get('competencias_lista_nombre');
            let calificaciones_autoevaluacion_competencias = @this.get(
                'calificaciones_autoevaluacion_competencias');
            let calificaciones_jefe_competencias = @this.get('calificaciones_jefe_competencias');
            let calificaciones_equipo_competencias = @this.get('calificaciones_equipo_competencias');
            let calificaciones_area_competencias = @this.get('calificaciones_area_competencias');
            let calificaciones_meta_competencias = @this.get('calificaciones_meta_competencias');
            console.log(calificaciones_meta_competencias);
            renderGraficas(competencias_lista_nombre,
                calificaciones_autoevaluacion_competencias,
                calificaciones_jefe_competencias,
                calificaciones_equipo_competencias,
                calificaciones_area_competencias,
                calificaciones_meta_competencias);
        });

        window.livewire.on('renderCharts', () => {
            let competencias_lista_nombre = @this.get('competencias_lista_nombre_max');
            let calificaciones_autoevaluacion_competencias = @this.get(
                'calificaciones_autoevaluacion_competencias_compare_first');
            let calificaciones_autoevaluacion_competencias_compare = @this.get(
                'calificaciones_autoevaluacion_competencias_compare');

            compararGraficas(competencias_lista_nombre, calificaciones_autoevaluacion_competencias,
                calificaciones_autoevaluacion_competencias_compare);
        });
        renderGraficas(@json($competencias_lista_nombre),
            @json($calificaciones_autoevaluacion_competencias),
            @json($calificaciones_jefe_competencias),
            @json($calificaciones_equipo_competencias),
            @json($calificaciones_area_competencias),
            @json($calificaciones_meta_competencias));
    });

    function renderGraficas(competencias_lista_nombre, calificaciones_autoevaluacion_competencias,
        calificaciones_jefe_competencias, calificaciones_equipo_competencias, calificaciones_area_competencias,
        calificaciones_meta_competencias) {
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
                data: calificaciones_jefe_competencias,
            }, {
                label: 'Meta',
                backgroundColor: 'rgb(255, 77, 0)',
                borderColor: 'rgb(255, 77, 0)',
                data: calificaciones_jefe_competencias,
            }]
        };
        let config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Autoevaluación vs Jefe Inmediato vs Meta',
                    }
                }
            }
        };

        if (window.graficaAutoJefe instanceof Chart) {
            window.graficaAutoJefe.destroy();
        }
        window.graficaAutoJefe = new Chart(
            document.getElementById('jefeGrafica'),
            config
        );

        //Equipo
        let labelsEquipo = competencias_lista_nombre;
        let dataEquipo = {
            labels: labelsEquipo,
            datasets: [{
                label: 'Autoevaluación',
                backgroundColor: 'rgb(46, 204, 65)',
                borderColor: 'rgb(46, 204, 65)',
                data: calificaciones_autoevaluacion_competencias,
            }, {
                label: 'Subordinado',
                backgroundColor: 'rgb(46, 106, 204)',
                borderColor: 'rgb(46, 106, 204)',
                data: calificaciones_equipo_competencias,
            }, {
                label: 'Meta',
                backgroundColor: 'rgb(255, 77, 0)',
                borderColor: 'rgb(255, 77, 0)',
                data: calificaciones_jefe_competencias,
            }]
        };
        let configEquipo = {
            type: 'line',
            data: dataEquipo,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Autoevaluación vs Subordinado vs Meta',
                    }
                }
            }
        };
        if (window.graficaAutoEquipo instanceof Chart) {
            window.graficaAutoEquipo.destroy();
        }
        window.graficaAutoEquipo = new Chart(
            document.getElementById('equipoGrafica'),
            configEquipo
        );
        //Area
        let labelsArea = competencias_lista_nombre;
        let dataArea = {
            labels: labelsArea,
            datasets: [{
                label: 'Autoevaluación',
                backgroundColor: 'rgb(46, 204, 65)',
                borderColor: 'rgb(46, 204, 65)',
                data: calificaciones_autoevaluacion_competencias,
            }, {
                label: 'Par',
                backgroundColor: 'rgb(46, 106, 204)',
                borderColor: 'rgb(46, 106, 204)',
                data: calificaciones_area_competencias,
            }, {
                label: 'Meta',
                backgroundColor: 'rgb(255, 77, 0)',
                borderColor: 'rgb(255, 77, 0)',
                data: calificaciones_jefe_competencias,
            }]
        };
        let configArea = {
            type: 'line',
            data: dataArea,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Autoevaluación vs Par vs Meta',
                    }
                }
            }
        };
        if (window.graficaAutoArea instanceof Chart) {
            window.graficaAutoArea.destroy();
        }
        window.graficaAutoArea = new Chart(
            document.getElementById('areaGrafica'),
            configArea
        );
        //Radar
        const dataRadar = {
            labels: competencias_lista_nombre,
            datasets: [{
                    label: 'Autoevaluación',
                    data: calificaciones_autoevaluacion_competencias,
                    fill: true,
                    backgroundColor: 'rgba(46, 204, 65, 0.2)',
                    borderColor: 'rgb(46, 204, 65)',
                    pointBackgroundColor: 'rgb(46, 204, 65)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(46, 204, 65)'
                }, {
                    label: 'Jefe Inmediato',
                    data: calificaciones_jefe_competencias,
                    fill: true,
                    backgroundColor: 'rgba(0,128,255, 0.2)',
                    borderColor: 'rgb(0,128,255)',
                    pointBackgroundColor: 'rgb(0,128,255)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(0,128,255)'
                },
                {
                    label: 'Subordinado',
                    data: calificaciones_equipo_competencias,
                    fill: true,
                    backgroundColor: 'rgba(255,228,0, 0.2)',
                    borderColor: 'rgb(255,228,0)',
                    pointBackgroundColor: 'rgb(255,228,0)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255,228,0)'
                }, {
                    label: 'Par',
                    data: calificaciones_area_competencias,
                    fill: true,
                    backgroundColor: 'rgba(230, 126, 34, 0.2)',
                    borderColor: 'rgb(230, 126, 34)',
                    pointBackgroundColor: 'rgb(230, 126, 34)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(230, 126, 34)'
                }, {
                    label: 'Meta',
                    data: calificaciones_meta_competencias,
                    fill: true,
                    backgroundColor: 'rgba(255,0,0, 0.2)',
                    borderColor: 'rgb(255,0,0)',
                    pointBackgroundColor: 'rgb(255,0,0)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgb(255,0,0)'
                }
            ]
        };
        const configRadar = {
            type: 'radar',
            data: dataRadar,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Promedios'
                    },
                    legend: {
                        display: true
                    },
                },
                scale: {
                    min: 0,
                },
            }
        };
        const configBarChart = {
            type: 'bar',
            data: dataRadar,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Promedios'
                    },
                    legend: {
                        display: true
                    },
                },
                scale: {
                    min: 0,
                },
            }
        };
        if (window.radarChart instanceof Chart) {
            window.radarChart.destroy();
        }
        if (window.barChart instanceof Chart) {
            window.barChart.destroy();
        }
        window.radarChart = new Chart(
            document.getElementById('radarCompetencias'),
            configRadar
        );
        window.barChart = new Chart(
            document.getElementById('barCompetencias'),
            configBarChart
        );
        radarChart.resize();
        barChart.resize();
    }

    function compararGraficas(competencias_lista_nombre, calificaciones_autoevaluacion_competencias,
        calificaciones_autoevaluacion_competencias_compare) {
        let labels = competencias_lista_nombre;
        let data = {
            labels: labels,
            datasets: [{
                label: 'Evaluación 1',
                backgroundColor: 'rgb(46, 204, 65)',
                borderColor: 'rgb(46, 204, 65)',
                data: calificaciones_autoevaluacion_competencias,
            }, {
                label: 'Evaluación 2',
                backgroundColor: 'rgb(46, 106, 204)',
                borderColor: 'rgb(46, 106, 204)',
                data: calificaciones_autoevaluacion_competencias_compare,
            }]
        };
        let config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    title: {
                        display: true,
                        text: 'Evaluación 1 vs Evaluacion 2',
                    }
                }
            }
        };

        if (window.graficaCompareAuto instanceof Chart) {
            window.graficaCompareAuto.destroy();
        }
        window.graficaCompareAuto = new Chart(
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
                backgroundColor: 'rgba(46, 106, 204, 0.2)',
                borderColor: 'rgb(46, 106, 204)',
                pointBackgroundColor: 'rgb(46, 106, 204)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgb(46, 106, 204)'
            }]
        };
        const configRadar = {
            type: 'radar',
            data: dataRadar,
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Promedios'
                    },
                    legend: {
                        display: true
                    },
                },
                scale: {
                    min: 0,
                },
            }
        };
        if (window.radarChartCompare instanceof Chart) {
            window.radarChartCompare.destroy();
        }
        window.radarChartCompare = new Chart(
            document.getElementById('radarCompetenciasCompare'),
            configRadar
        );
        radarChartCompare.resize();
    }

    function destroyGraficas() {
        graficaAutoJefe.destroy();
        graficaAutoEquipo.destroy();
        graficaAutoArea.destroy();
        radarChart.destroy();
    }
</script>

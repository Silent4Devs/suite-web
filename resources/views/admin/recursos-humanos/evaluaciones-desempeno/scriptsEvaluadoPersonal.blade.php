<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function generarColorAleatorio() {
        let color = '#' + Math.floor(Math.random() * 16777215).toString(16).toUpperCase();
        while (color.length < 7) {
            color = color + '0';
        }
        return color;
    }
</script>

@if ($evaluacion->activar_objetivos)
    {{-- Codigo primera vez que carga --}}
    <script>
        document.addEventListener('livewire:initialized', function() {

            const tipos = @json($resObj['nombres'][$periodo_seleccionado]);
            const resultados = @json($resObj['resultados'][$periodo_seleccionado]);

            var ctx2 = document.getElementById('cumplimientoObjetivos').getContext('2d');
            ChartCO = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: tipos,
                    datasets: [{
                        label: 'Porcentaje de cumplimiento',
                        data: resultados,
                        backgroundColor: generarColorAleatorio(),
                        borderWidth: 1
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
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('cumplimientoObj', (cumpObjWrapper) => {
                const cumpObj = cumpObjWrapper.cumpObj;
                document.getElementById('cumplimientoObjetivos').remove();
                let canvas = document.createElement("canvas");
                canvas.id = "cumplimientoObjetivos";
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                document.getElementById("contenedor-objetivos").appendChild(canvas);

                let grafica_objetivos_area = new Chart(document.getElementById('cumplimientoObjetivos'), {
                    type: 'bar',
                    data: {
                        labels: cumpObj.labels,
                        datasets: [{
                            label: 'Porcentaje de cumplimiento',
                            data: cumpObj.data,
                            backgroundColor: generarColorAleatorio(),
                            borderWidth: 1
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
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {

            const escalas = @json($escalas['nombres']);
            const colores = @json($escalas['colores']);
            const resultados = @json($escalas['resultados'][$periodo_seleccionado]);

            var ctx3 = document.getElementById('escalas').getContext('2d');
            ChartCO = new Chart(ctx3, {
                type: 'bar',
                data: {
                    labels: escalas,
                    datasets: [{
                        label: 'Porcentaje de cumplimiento',
                        data: resultados,
                        backgroundColor: colores,
                        borderWidth: 1
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
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('escalasObj', (escObjWrapper) => {
                const escObj = escObjWrapper.escObj;
                document.getElementById('escalas').remove();
                let canvas = document.createElement("canvas");
                canvas.id = "escalas";
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                document.getElementById("contenedor-escalas").appendChild(canvas);

                let grafica_escalas = new Chart(document.getElementById('escalas'), {
                    type: 'bar',
                    data: {
                        labels: escObj.labels,
                        datasets: [{
                            label: 'Porcentaje de cumplimiento',
                            data: escObj.data,
                            backgroundColor: escObj.colores,
                            borderWidth: 1
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
            });
        });
    </script>
@endif

@if ($evaluacion->activar_competencias)
    <script>
        document.addEventListener('livewire:initialized', function() {

            const competencias = @json($resComp['nombres'][$periodo_seleccionado]);
            const resultados = @json($resComp['resultados'][$periodo_seleccionado]);

            var ctx4 = document.getElementById('cumplimientoCompetencias').getContext('2d');
            ChartCO = new Chart(ctx4, {
                type: 'bar',
                data: {
                    labels: competencias,
                    datasets: [{
                        label: 'Porcentaje de cumplimiento',
                        data: resultados,
                        backgroundColor: '#BB68A8', // Color de las barras
                        borderWidth: 1
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
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('cumplimientoComp', (cumpCompWrapper) => {
                const cumpComp = cumpCompWrapper.cumpComp;
                document.getElementById('cumplimientoCompetencias').remove();
                let canvas = document.createElement("canvas");
                canvas.id = "cumplimientoCompetencias";
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                document.getElementById("contenedor-competencias").appendChild(canvas);

                let grafica_objetivos_area = new Chart(document.getElementById(
                    'cumplimientoCompetencias'), {
                    type: 'bar',
                    data: {
                        labels: cumpComp.labels,
                        datasets: [{
                            label: 'Porcentaje de cumplimiento',
                            data: cumpComp.data,
                            backgroundColor: '#BB68A8', // Color de las barras
                            borderWidth: 1
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
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {

            const competencias = @json($resComp['nombres'][$periodo_seleccionado]);
            const resultados = @json($resComp['resultado_competencia'][$periodo_seleccionado]);
            const esperados = @json($resComp['nivel_esperado'][$periodo_seleccionado]);

            var ctx5 = document.getElementById('cumplimientoCompetenciasRadar').getContext('2d');
            ChartCO = new Chart(ctx5, {
                type: 'radar',
                data: {
                    labels: competencias,
                    datasets: [{
                            label: 'Nivel Alcanzado',
                            data: resultados,
                            borderWidth: 1
                        },
                        {
                            label: 'Nivel Esperado',
                            data: esperados,
                            borderWidth: 1
                        },
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>

    <script>
        document.addEventListener('livewire:initialized', function() {
            @this.on('cumplimientoRadarComp', (cumpCompRadarWrapper) => {
                const cumpCompRadar = cumpCompRadarWrapper.cumpCompRadar;
                document.getElementById('cumplimientoCompetenciasRadar').remove();
                let canvas = document.createElement("canvas");
                canvas.id = "cumplimientoCompetenciasRadar";
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                document.getElementById("contenedor-competencias-radar").appendChild(canvas);

                let grafica_competencias_radar = new Chart(document.getElementById(
                    'cumplimientoCompetenciasRadar'), {
                    type: 'radar',
                    data: {
                        labels: cumpCompRadar.labels,
                        datasets: [{
                                label: 'Nivel Alcanzado',
                                data: cumpCompRadar.data,
                                borderWidth: 1
                            },
                            {
                                label: 'Nivel Esperado',
                                data: cumpCompRadar.data2,
                                borderWidth: 1
                            },
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        });
    </script>
@endif

<script>
    function confirmDeleteEvaluadorObjetivos(keyPeriodo, keyEvaluador) {
        Swal.fire({
            title: 'Eliminar Evaluador - Objetivos',
            text: '¿Seguro que desea eliminar al evaluador?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteEvaluadorObjetivos', {
                    keyPeriodo,
                    keyEvaluador,
                });
            }
        });
    }
</script>

<script>
    function confirmDeleteEvaluadorCompetencias(keyPeriodo, keyEvaluador) {
        Swal.fire({
            title: 'Eliminar Evaluador - Competencias',
            text: '¿Seguro que desea eliminar al evaluador?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, confirmar!',
            cancelButtonText: 'Cancelar',
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('deleteEvaluadorCompetencias', {
                    keyPeriodo,
                    keyEvaluador
                });
            }
        });
    }
</script>

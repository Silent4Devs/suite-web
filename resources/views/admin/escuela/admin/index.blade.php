@extends('adminlte::page')

@section('title', 'Silent4Business')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">Niveles</div>
                        <canvas id="graficaNiveles"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">Categorías más populares</div>
                        <canvas id="graficaBarras"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">Estatus de los cursos</div>
                        <canvas id="graficaPastel"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@latest/dist/Chart.min.js"></script>

    <script>
        let niveles = @json($nivelesLabel);
        var nivelgrafica = document.getElementById("graficaNiveles");
        let nivelesLabelArray = [];
        let cantidadNivelesArray = [];
        let coloresAutomaticosNiveles = [];
        
        niveles.forEach(nivel => {
            nivelesLabelArray.push(nivel.name)
            cantidadNivelesArray.push(nivel.cantidad)

        });

        for (let index = 0; index < cantidadNivelesArray.length; index++) {
            coloresAutomaticosNiveles.push("rgba(74, 152, 255, 1)");

        }

        var mygrafic = new Chart(nivelgrafica, {
            type: 'bar',
            data: {
                labels: nivelesLabelArray,
                datasets: [{
                    backgroundColor: coloresAutomaticosNiveles,
                    borderColor: coloresAutomaticosNiveles,
                    borderWidth: 1,
                    label: ["Niveles utilizados"],

                    data: cantidadNivelesArray,

                }]
            },


            options: {
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
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },
        });
    </script>

    <script>
        let categorias = @json($categoriasLabel);
        var ctx = document.getElementById("graficaBarras");
        let categoriasLabelArray = [];
        let cantidadCategoriasArray = [];
        let coloresAutomaticos = [];
        
        categorias.forEach(categoria => {
            categoriasLabelArray.push(categoria.name)
            cantidadCategoriasArray.push(categoria.cantidad)

        });

        for (let index = 0; index < cantidadCategoriasArray.length; index++) {
            coloresAutomaticos.push("rgba(172, 132, 255, 1)");

        }

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categoriasLabelArray,
                datasets: [{
                    backgroundColor: coloresAutomaticos,
                    borderColor: coloresAutomaticos,
                    borderWidth: 1,
                    label: ["Categorías más populares"],

                    data: cantidadCategoriasArray,

                }]
            },


            options: {
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
                        color: 'white',
                        display: true,
                        font: {
                            size: 20
                        }
                    },
                },
            },
        });
    </script>

    <script>
        let cursosStatusBorrador = @json($cursosStatusBorrador);
        let cursosStatusPublicado = @json($cursosStatusPublicado);
        var canvas_sgsi = document.getElementById("graficaPastel");
        var pie_sgsi = new Chart(canvas_sgsi, {
            type: 'pie',
            labels: {
                render: 'value'
            },
            data: {
                labels: [
                    "Borrador",
                    "Publicados"
                ],
                datasets: [{
                    data: [cursosStatusBorrador, cursosStatusPublicado],
                    backgroundColor: [
                        'rgba(22, 193, 66, 66)',
                        'rgba(22, 160, 133, 0.6)',


                    ]
                }]
            },
            options: {
                responsive: true,
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: "black",
                        boxWidth: 20,
                        padding: 8
                    }
                },
                tooltips: {
                    mode: 'label'
                },

            }
        });
    </script>
@stop

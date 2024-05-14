@extends('layouts.admin')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Dashboard</h5>
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="font-weight-bold mb-4"
                            style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 15px; border-bottom-style:solid;border-width: 1px;">
                            Niveles</div>
                        <canvas id="graficaNiveles"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <div class="font-weight-bold mb-4"
                            style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 15px; border-bottom-style:solid;border-width: 1px;">
                            Estatus de los cursos</div>
                        <canvas id="graficaAnillo"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 mt-4">
                <div class="card">
                    <div class="card-body font-weight-bold mb-4"
                        style="padding-bottom: 10px; border-color: #3086AF !important; font-size: 15px; border-bottom-style:solid;border-width: 1px;">
                        Categorías populares</div>
                    <canvas id="graficaBarras"></canvas>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let niveles = @json($nivelesLabel);
        var nivelgrafica = document.getElementById("graficaNiveles");
        let nivelesLabelArray = [];
        let cantidadNivelesArray = [];
        let coloresPaleta = [
            '#F24BA7', '#EF49F2', '#81BF54', '#F2994B', '#D97979',
            '#A729E6', '#6287F5', '#3AC278', '#F5E866', '#DB3A46'
        ];
        niveles.forEach(nivel => {
            nivelesLabelArray.push(nivel.name)
            cantidadNivelesArray.push(nivel.cantidad)

        });

        let totalNiveles = cantidadNivelesArray.reduce((acc, val) => acc + val, 0);
        let cantidadNivelesArrayPorcentaje = cantidadNivelesArray.map(val => ((val / totalNiveles) * 100).toFixed(2));

        let coloresAutomaticosNiveles = [];
        for (let index = 0; index < cantidadNivelesArray.length; index++) {
            coloresAutomaticosNiveles.push(coloresPaleta[index % coloresPaleta.length]);
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
                    data: cantidadNivelesArrayPorcentaje,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return value + '%';
                            }
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
        let coloresPaletaCategorias = [
            '#D97979', '#6287F5', '#3AC278', '#F5E866', '#F24BA7', '#EF49F2',
            '#81BF54', '#F2994B', '#A729E6'
        ];

        categorias.forEach(categoria => {
            categoriasLabelArray.push(categoria.name)
            cantidadCategoriasArray.push(categoria.cantidad)

        });

        let totalCategorias = cantidadCategoriasArray.reduce((acc, val) => acc + val, 0);
        let cantidadCategoriasArrayPorcentaje = cantidadCategoriasArray.map(val => ((val / totalCategorias) * 100).toFixed(
            2));

        let coloresAutomaticosCategorias = [];
        for (let index = 0; index < cantidadCategoriasArray.length; index++) {
            coloresAutomaticosCategorias.push(coloresPaletaCategorias[index % coloresPaletaCategorias.length]);

        }

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: categoriasLabelArray,
                datasets: [{
                    backgroundColor: coloresAutomaticosCategorias,
                    borderColor: coloresAutomaticosCategorias,
                    borderWidth: 1,
                    label: ["Categorías más populares"],
                    data: cantidadCategoriasArrayPorcentaje,
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) {
                                return value + '%';
                            }
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
        let totalCursos = cursosStatusBorrador + cursosStatusPublicado;
        let porcentajeBorrador = (cursosStatusBorrador / totalCursos) * 100;
        let porcentajePublicado = (cursosStatusPublicado / totalCursos) * 100;

        let canvas_sgsi = document.getElementById("graficaAnillo");
        let coloresPaletaEstatus = [
            '#F24BA7', '#6287F5', '#3AC278', '#F5E866', '#DB3A46', '#EF49F2',
            '#81BF54', '#F2994B', '#A729E6', '#D97979'
        ];

        let pie_sgsi = new Chart(canvas_sgsi, {
            type: 'doughnut',
            data: {
                labels: [
                    `Borrador (${porcentajeBorrador.toFixed(2)}%)`,
                    `Publicados (${porcentajePublicado.toFixed(2)}%)`
                ],
                datasets: [{
                    data: [porcentajeBorrador, porcentajePublicado],
                    backgroundColor: coloresPaletaEstatus,
                }]
            },
            options: {
                responsive: true,
                cutoutPercentage: 40,
                legend: {
                    display: true,
                    position: 'right',
                    labels: {
                        fontColor: "black",
                        boxWidth: 20,
                        padding: 8
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                if (label) {
                                    label += ': ';
                                }
                                if (context.parsed) {
                                    label += context.parsed.toFixed(2) + '%';
                                }
                                return label;
                            }
                        }
                    },
                    datalabels: {
                        formatter: (value, ctx) => {
                            let label = '';
                            if (ctx.dataset.labels[ctx.dataIndex]) {
                                label = ctx.dataset.labels[ctx.dataIndex] + ": ";
                            }
                            label += value.toFixed(2) + '%';
                            return label;
                        },
                        color: '#fff',
                        font: {
                            weight: 'bold'
                        }
                    }
                }
            }
        });
    </script>
@endsection

@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('EV360-Evaluacion-Resumen', $evaluacion) }}
    <style>
        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(11px at 50% 50%);
            height: 20px;
        }

        table {
            height: 1px;
        }

        .tabla-fija .celdas-colaborador{
            position: sticky !important;
            left: 0px;
            z-index: 2;
        }
        .tabla-fija td.celdas-colaborador{
            background-color: #fff;
        }
        .tabla-fija tr:nth-child(even) td.celdas-colaborador{
            background-color: #eee;
        }

        .tabla-fija .celdas-puesto{
            position: sticky !important;
            left: 91px;
            background-color: #fff;
            z-index: 2;
        }
        .tabla-fija td.celdas-puesto{
            background-color: #fff;
        }
        .tabla-fija tr:nth-child(even) td.celdas-puesto{
            background-color: #eee;
        }
        
        .tabla-fija .celdas-evaluacion{
            position: sticky !important;
            left: 209px;
            background-color: #fff;
            z-index: 2;
        }
        .tabla-fija td.celdas-evaluacion{
            background-color: #fff;
        }
        .tabla-fija tr:nth-child(even) td.celdas-evaluacion{
            background-color: #eee;
        }
    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Resumen: </strong> Evaluación </h3>
        </div>
        <div x-data="{ open: true }">
            <div class="mt-3 col-12">
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    RESUMEN GENERAL <i x-bind:class="open ? 'fas fa-minus' : 'fas fa-plus'" @click="open = !open"></i>
                </div>
            </div>
            <div class="my-2 col-12" style="text-align: end;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#normalizarResultados">
                    <i class="fas fa-chart-line mr-2"></i>Normalizar Resultados
                </button>
            </div>
            <div class="modal fade" id="normalizarResultados" data-backdrop="static" data-keyboard="false" tabindex="-1"
                aria-labelledby="normalizarResultadosLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="normalizarResultadosLabel">Normalizar resultados</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Modifique los rangos de calificación por categoría</p>
                            <form action="{{ route('admin.ev360-normalizar-resultados', $evaluacion) }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Inaceptable (menor o igual a)</label>
                                    <input type="number" class="form-control" id="inaceptable" name="inaceptable"
                                        placeholder="Inaceptable" value="{{ $rangosResultados['inaceptable'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Mínimo Aceptable (menor o igual a)</label>
                                    <input type="number" class="form-control" id="minimoAceptable" name="minimoAceptable"
                                        placeholder="Mínimo Aceptable"
                                        value="{{ $rangosResultados['minimo_aceptable'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Aceptable (menor o igual a)</label>
                                    <input type="number" class="form-control" id="aceptable" name="aceptable"
                                        placeholder="Aceptable" value="{{ $rangosResultados['aceptable'] }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Sobresaliente (mayor a)</label>
                                    <input type="number" class="form-control" id="sobresaliente" name="sobresaliente"
                                        readonly placeholder="Sobresaliente"
                                        value="{{ $rangosResultados['sobresaliente'] }}">
                                </div>
                                <button id="resetValues" type="button" class="btn btn-primary">Restablecer Valores</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" style="float: right;">Normalizar</button>
                            </form>
                        </div>
                        {{-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div> --}}
                    </div>
                </div>
            </div>
            <div class="col-12" x-show="open" x-transition>
                <div class="row">
                    <div class="col-6">
                        <canvas id="resultadosGenerales"></canvas>
                    </div>
                    <div class="col-6">
                        <table class="table table-sm">
                            <thead>
                                <th class="text-center" colspan="2">Calificaciones</th>
                            </thead>
                            <tbody>
                                @foreach ($calificaciones as $key => $calificacion)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $calificacion }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div x-data="{ open: true }">
            <div class="mt-3 col-12">
                <div class="text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                    RESULTADO DE LA EVALUACIÓN <i x-bind:class="open ? 'fas fa-minus' : 'fas fa-plus'"
                        @click="open = !open"></i>
                </div>
            </div>
            <div class="col-12" x-show="open" x-transition>
                @livewire('ev360-resumen-tabla', ['evaluacion' => $evaluacion->id, 'rangos' => $rangosResultados])
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0-rc.1/chartjs-plugin-datalabels.min.js"
        integrity="sha512-+UYTD5L/bU1sgAfWA0ELK5RlQ811q8wZIocqI7+K0Lhh8yVdIoAMEs96wJAIbgFvzynPm36ZCXtkydxu1cs27w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('resetValues').addEventListener('click', () => {
                document.getElementById('inaceptable').value = '60';
                document.getElementById('minimoAceptable').value = '80';
                document.getElementById('aceptable').value = '100';
                document.getElementById('sobresaliente').value = '100';
            });
            document.getElementById('aceptable').addEventListener('keyup', () => {
                document.getElementById('sobresaliente').value = parseInt(document.getElementById(
                    'aceptable').value);
            });
            var ctx = document.getElementById('resultadosGenerales').getContext('2d');
            var resultadosGenerales = new Chart(ctx, {
                type: 'bar',
                data: {
                    datasets: [{
                        label: 'Resultados Generales',
                        data: @json($calificaciones),
                        backgroundColor: [
                            'rgba(231, 76, 60, 0.8)',
                            'rgba(230, 126, 34 , 0.8)',
                            'rgba(54, 162, 235, 0.8)',
                            'rgba(46, 204, 113 , 0.8)',

                        ],
                        borderColor: [
                            'rgba(231, 76, 60, 1)',
                            'rgba(230, 126, 34 , 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(46, 204, 113 , 1)',

                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                },
                plugins: [ChartDataLabels],
                options: {
                    color: 'black',
                    display: true
                }
            });
        });
    </script>
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Resumen Evaluación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Resumen Evaluación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "export"
                    }
                },
                {
                    extend: 'print',
                    title: `Resumen Evaluación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:visible'],
                        orthogonal: "export"
                    }
                },
                {
                    extend: 'colvis',
                    text: '<i class="fas fa-filter" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Seleccionar Columnas',
                },
                {
                    extend: 'colvisGroup',
                    text: '<i class="fas fa-eye" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    show: ':hidden',
                    titleAttr: 'Ver todo',
                },
                {
                    extend: 'colvisRestore',
                    text: '<i class="fas fa-undo" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Restaurar a estado anterior',
                }

            ];
            let dtOverrideGlobals = {
                buttons: dtButtons,
                scrollCollapse: true,
                columnDefs: [{
                    targets: 3,
                    render: function(data, type, row, meta) {
                        if (type === "export") {
                            return data.trim();
                        }
                        return data;
                    }
                }],
            };
            let table = $("#tblResumen").DataTable(dtOverrideGlobals);
            // new $.fn.dataTable.FixedColumns(table, {
            //     leftColumns: 3
            // });
        })
    </script>
@endsection

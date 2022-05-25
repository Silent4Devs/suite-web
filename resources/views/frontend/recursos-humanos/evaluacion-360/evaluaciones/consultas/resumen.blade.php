@extends('layouts.frontend')
@section('content')
    {{ Breadcrumbs::render('EV360-Evaluaciones-Create') }}
    <style>
        img.rounded-circle {
            border-radius: 0 !important;
            clip-path: circle(13px at 50% 50%);
            height: 26px;
        }

        table {
            height: 1px;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Resumen: </strong> Evaluación </h3>
        </div>
        @livewire('ev360-resumen-tabla', ['evaluacion' => $evaluacion->id])

        <div class="container row">
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
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
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
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 6.5;
                        doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Acciones Correctivas ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
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
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
                }

            };
            $("#tblResumen").DataTable(dtOverrideGlobals);
        })
    </script>
@endsection

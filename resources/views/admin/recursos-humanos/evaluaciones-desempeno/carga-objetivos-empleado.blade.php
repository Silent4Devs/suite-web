@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/evaluations/evaluations.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')
    <style>
        .custom-switch-xl .custom-control-label::before {
            left: -6.75rem;
            /* Triple the original left offset */
            width: 10.5rem;
            /* Triple the original width */
            height: 5.25rem;
            /* Triple the original height */
            border-radius: 5.25rem;
            /* Triple the original border-radius */
        }

        .custom-switch-xl .custom-control-label::after {
            top: calc(0.375rem + 6px);
            /* Triple the original top offset */
            left: calc(-6.75rem + 6px);
            /* Triple the original left offset */
            width: calc(5.25rem - 12px);
            /* Triple the original width */
            height: calc(5.25rem - 12px);
            /* Triple the original height */
            border-radius: 5.25rem;
            /* Triple the original border-radius */
        }

        .custom-switch-xl .custom-control-input:checked~.custom-control-label::after {
            transform: translateX(5.25rem);
            /* Triple the original translateX */
        }
    </style>
    {{-- {{ Breadcrumbs::render('capital-humano') }} --}}

    <h5 class="titulo_general_funcion"> Carga de Objetivos: {{ $empleado->name }} </h5>

    <div class="card card-body" style="color: #464646;">
        <div class="d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center" style="gap: 30px;">
                <div class="img-person" style="width: 80px; height: 80px;">
                    <img src="{{ asset('storage/empleados/imagenes/') . '/' . $empleado->avatar }}" alt="">
                </div>
                <span>{{ $empleado->name }}</span>
                <hr class="line-vertical mx-2">
                <di class="d-flex flex-column">
                    <span> {{ $empleado->puestoRelacionado->puesto }} </span>
                    <span class="mt-3"> {{ $empleado->area->area }}</span>
                </di>
            </div>
            <img src="{{ $organizacion->logotipo }}" alt="" style="height: 90px;">
        </div>
    </div>

    @livewire('formulario-objetivos-desempeno-empleados', ['id_empleado' => $empleado->id])
@endsection

@section('scripts')
    @parent

    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Sedes - Ubicación ${new Date().toLocaleDateString().trim()}`,
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
                order: [
                    [0, 'desc']
                ],
            };
            let table = $('.table').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

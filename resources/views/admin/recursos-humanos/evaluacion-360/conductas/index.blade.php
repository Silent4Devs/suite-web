@extends('layouts.admin')
@section('content')
    <style>
        span.errors {
            font-size: 11px;
        }

    </style>
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Evaluaciones') }}
    </div>
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Cuestionarios</strong></h3>
        </div>
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <table class="table table-bordered w-100 tblEvaluaciones">
                <thead class="thead-dark">
                    <tr>
                        <th style="vertical-align: top">
                            ID
                        </th>
                        <th style="vertical-align: top">
                            Nombre
                        </th>
                        <th style="vertical-align: top">
                            Opciones
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="evaluacionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="evaluacionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="evaluacionModalLabel"><i class="fas fa-cog"></i> Configuración
                        Inicial de la evaluación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formEvaluacionCreate" action="{{ route('admin.ev360-conductas.store') }}" method="post">
                        @include('admin.recursos-humanos.evaluacion-360.evaluaciones._form')
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnCancelarEvaluacion" class="btn_cancelar"
                        data-dismiss="modal">Descartar</button>
                    <button type="button" id="btnGuardarEvaluacion" class="btn btn-danger">Guardar</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Evaluaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Evaluaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Evaluaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'landscape',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        // doc.styles.tableHeader.fontSize = 6.5;
                        // doc.defaultStyle.fontSize = 6.5; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Evaluaciones ${new Date().toLocaleDateString().trim()}`,
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

            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Construir evaluacion',
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    $('#evaluacionModal').modal('show');
                }
            };
            dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-evaluaciones.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id',

                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlShow = `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}`;
                            let urlEdit =
                                `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}/edit`;
                            let urlDelete =
                                `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}`;
                            let urlEvaluacion =
                                `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}/evaluacion`;
                            let html = `
                                <a href="${urlEdit}" class="btn btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                                <a href="${urlShow}" class="btn btn-sm" title="Visualizar"><i class="fas fa-eye"></i></a>
                                <a href="${urlEvaluacion}" class="btn btn-sm" title="Evaluación"><i class="fas fa-cogs"></i></a>
                                <button onclick="Delete('${urlEdit}',${row})" class="btn btn-sm text-danger" title="Eliminar"><i class="fas fa-trash-alt"></i></button>
                            `;

                            return html;
                        }
                    },
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ]
            };
            window.table = $('.tblEvaluaciones').DataTable(dtOverrideGlobals);
        });
        $(document).ready(function() {
            document.getElementById('btnGuardarEvaluacion').addEventListener('click', function(e) {
                e.preventDefault();
                limpiarErrores();
                let datos = $('#formEvaluacionCreate').serialize();
                let url = $("#formEvaluacionCreate").attr('action');
                console.log(datos);
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: datos,
                    dataType: "JSON",
                    beforeSend: function() {
                        document.getElementById("evaluacionModal").style.pointerEvents = "none";
                        toastr.info(
                            'Guardando y configurando Evaluación, espere unos instantes...');
                    },
                    success: function(response) {
                        document.getElementById("evaluacionModal").style.pointerEvents = "all";
                        toastr.success(
                            'Evaluación configurada y almacenada con éxito');
                        $('#evaluacionModal').modal('hide');
                        table.ajax.reload();
                    },
                    error: function(request, status, error) {
                        if (error != 'Unprocessable Entity') {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        } else {
                            $.each(request.responseJSON.errors, function(indexInArray,
                                valueOfElement) {
                                document.querySelector(`span.${indexInArray}_error`)
                                    .innerHTML =
                                    `<i class="mr-2 fas fa-info-circle"></i> ${valueOfElement[0]}`;
                            });
                        }
                    }
                });
            });
        });

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errors');
            errores.forEach(element => {
                element.innerHTML = "";
            });
        }
    </script>
@endsection

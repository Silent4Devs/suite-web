@extends('layouts.admin')
@section('content')
    <style>
        span.errors {
            font-size: 11px;
        }

        table {
            height: 1px;
        }

        td.padding-0 {
            padding: 0;
        }

    </style>
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Evaluaciones') }}
    </div>
    <h5 class="col-12 titulo_general_funcion">Evaluaciones 360°</h5>
    <div class="mt-5 card">

        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="px-1 py-2 mb-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En este apartado podrá visualizar
                            las evaluaciones creadas y conocer el
                            estatus en el que se encuentran, así como crear nuevas evaluaciones.
                        </p>
                    </div>
                </div>
            </div>

            <div class="text-right">
                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.ev360-evaluaciones.create') }}" type="button" class="btn btn-primary">Registrar Evaluación 360°</a>
                </div>
            </div>
            @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                <h3 class="title-table-rds">Evaluaciones 360°</h3>
                <table class="datatable  tblEvaluaciones">
                    <thead class="thead-dark">
                        <tr>
                            <th style="vertical-align: top">
                                ID
                            </th>
                            <th style="vertical-align: top">
                                Nombre
                            </th>
                            <th style="vertical-align: top">
                                Estatus
                            </th>
                            {{-- <th style="vertical-align: top">
                                Autoevaluación
                            </th>
                            <th style="vertical-align: top">
                                Jefe&nbsp;Inmediato
                            </th>
                            <th style="vertical-align: top">
                                Equipo&nbsp;a&nbsp;Cargo
                            </th>
                            <th style="vertical-align: top">
                                Misma&nbsp;Área
                            </th> --}}
                            <th style="vertical-align: top">
                                Fecha&nbsp;Inicio
                            </th>
                            <th style="vertical-align: top">
                                Fecha&nbsp;Fin
                            </th>
                            <th style="vertical-align: top">
                                ¿Incluye Competencias?
                            </th>
                            <th style="vertical-align: top">
                                ¿Incluye Objetivos?
                            </th>
                            <th style="vertical-align: top;">
                                Opciones
                            </th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
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
                    <form id="formEvaluacionCreate" action="" method="post">
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
                        name: 'nombre',
                        width: '800px'
                    },
                    {
                        data: 'estatus_formateado',
                        name: 'estatus_formateado',
                        render: function(data, type, row, meta) {
                            return `
                            <div class="text-center d-flex w-100 align-items-center" style="height:100%;background-color:${row.color_estatus};color:${row.color_estatus_text}">
                                <p class="m-0 w-100">${data}</p>
                            </div>
                            `;
                        },
                        className: "padding-0",
                        width: '110px'
                    },
                    // {
                    //     data: 'autoevaluacion',
                    //     name: 'autoevaluacion',
                    //     render: function(data, type, row, meta) {
                    //         return `<span class="badge badge-primary">${data?'Si':'No'}</span>`;
                    //     }
                    // },
                    // {
                    //     data: 'evaluado_por_jefe',
                    //     name: 'evaluado_por_jefe',
                    //     render: function(data, type, row, meta) {
                    //         return `<span class="badge badge-primary">${data?'Si':'No'}</span>`;
                    //     }
                    // },
                    // {
                    //     data: 'evaluado_por_equipo_a_cargo',
                    //     name: 'evaluado_por_equipo_a_cargo',
                    //     render: function(data, type, row, meta) {
                    //         return `<span class="badge badge-primary">${data?'Si':'No'}</span>`;
                    //     }
                    // },
                    // {
                    //     data: 'evaluado_por_misma_area',
                    //     name: 'evaluado_por_misma_area',
                    //     render: function(data, type, row, meta) {
                    //         return `<span class="badge badge-primary">${data?'Si':'No'}</span>`;
                    //     }
                    // },
                    {
                        data: 'fecha_inicio',
                        name: 'fecha_inicio',
                        width: '110px'
                    },
                    {
                        data: 'fecha_fin',
                        name: 'fecha_fin',
                        width: '110px'
                    },
                    {
                        data: 'include_competencias',
                        name: 'include_competencias',
                        render: function(data, type, row, meta) {
                            return `<span class="badge badge-primary">${data?'Si':'No'}</span>`;
                        }
                    },
                    {
                        data: 'include_objetivos',
                        name: 'include_objetivos',
                        render: function(data, type, row, meta) {
                            return `<span class="badge badge-primary">${data?'Si':'No'}</span>`;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlShow = `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}`;
                            let urlEdit =
                                `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}/edit`;
                            let urlBtnEliminar =
                                `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}`;
                            let urlEvaluacion =
                                `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}/evaluacion`;
                            let urlResumen = `
                                /admin/recursos-humanos/evaluacion-360/evaluacion/${data}/resumen
                                `;
                            // <a href="${urlEdit}" class="btn btn-sm" title="Editar"><i class="fas fa-edit"></i></a>
                            // <a href="${urlShow}" class="btn btn-sm" title="Visualizar"><i class="fas fa-eye"></i></a>
                            let html = `
                                <div class="btn-group" style="background: white;">
                                @can('seguimiento_evaluaciones_evaluacion')
                                    <a href="${urlEvaluacion}" class="btn btn-sm" title="Evaluación"><i class="fas fa-cogs"></i></a>
                                @endcan
                                @can('seguimiento_evaluaciones_grafica')
                                    <a href="${urlResumen}" class="btn btn-sm" title="Gráfica"><i class="fas fa-chart-bar"></i></a>
                                @endcan
                                @can('seguimiento_evaluaciones_eliminar')
                                    <button class="btn btn-sm text-danger" title="Eliminar" data-action="Eliminar" data-url="${urlBtnEliminar}"><i
                                            class="fas fa-trash-alt"></i></button>
                                @endcan
                                </div>
                            `;

                            return html;
                        }
                    },
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                // fixedColumns: true,
                // scrollX: true,
                // scrollCollapse: true,
                // paging: false,
                // fixedColumns: {
                //     left: 0,
                //     right: 1
                // }
            };
            window.table = $('.tblEvaluaciones').DataTable(dtOverrideGlobals);
        });

        document.querySelector('.datatable-fix').addEventListener('click', function(e) {
            let target = e.target;
            if (e.target.tagName == 'I') {
                target = e.target.closest('button');
            }
            if (target.getAttribute('data-action') == 'Eliminar') {
                const url = target.getAttribute('data-url');
                Swal.fire({
                    title: '¿Desea eliminar esta Evaluación?',
                    html: '',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            beforeSend: function() {
                                let timerInterval
                                Swal.fire({
                                    title: 'Eliminando!',
                                    html: 'Estamos eliminando el registro, espere un momento.',
                                    timer: 2000,
                                    timerProgressBar: true,
                                    didOpen: () => {
                                        Swal.showLoading()
                                        timerInterval = setInterval(
                                            () => {
                                                const content = Swal
                                                    .getHtmlContainer()
                                                if (content) {
                                                    const b =
                                                        content
                                                        .querySelector(
                                                            'b')
                                                    if (b) {
                                                        b.textContent =
                                                            Swal
                                                            .getTimerLeft()
                                                    }
                                                }
                                            }, 100)
                                    },
                                    willClose: () => {
                                        clearInterval(timerInterval)
                                    }
                                })

                            },
                            success: function(response) {
                                if (response.deleted) {
                                    Swal.fire(
                                        '¡Evaluación Eliminada!',
                                        '',
                                        'success'
                                    )
                                    table.ajax.reload();
                                } else {
                                    Swal.fire(
                                        '¡No se eliminó el registro!',
                                        'Ocurrió un error',
                                        'error'
                                    )
                                }

                            },
                            error: function(err) {
                                Swal.fire(
                                    'Ocurrió un error',
                                    `${err.message}`,
                                    'error'
                                )
                            }
                        });

                    }
                });
            }
        })


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
                    xhr: function() {
                        var xhr = $.ajaxSettings.xhr();
                        xhr.onprogress = function e() {
                            // For downloads
                            if (e.lengthComputable) {
                                console.log(e.loaded / e.total);
                            }
                        };
                        xhr.upload.onprogress = function(e) {
                            // For uploads
                            if (e.lengthComputable) {
                                console.log(e.loaded / e.total);
                            }
                        };
                        return xhr;
                    },
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

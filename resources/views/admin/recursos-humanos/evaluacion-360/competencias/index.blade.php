@extends('layouts.admin')
@section('content')
    <div class="mt-3">
        {{ Breadcrumbs::render('EV360-Competencias') }}
    </div>
    <style>
        .imagen-responsiva {
            clip-path: circle(10px at 50% 50%);
            height: 20px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

    </style>
    <h5 class="col-12 titulo_general_funcion">Competencias</h5>
    <div class="mt-5 card">
        @include('partials.flashMessages')
        <div class="card-body datatable-fix">
            <div class="px-1 py-2 mb-3 rounded" style="background-color: #DBEAFE; border-top:solid 1px #3B82F6;">
                <div class="row w-100">
                    <div class="text-center col-1 align-items-center d-flex justify-content-center">
                        <div class="w-100">
                            <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                        </div>
                    </div>
                    <div class="col-11">
                        <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                            Instrucciones</p>
                        <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor
                            ingrese las competencias definidas en la organización</p>
                    </div>
                </div>
            </div>
            <table class="table table-bordered w-100 tblCompetencias">
                <thead class="thead-dark">
                    <tr>
                        <th style="min-width:50px;">
                            Competencias
                        </th>
                        <th style="vertical-align: top; min-width:250px;">
                            Nombre
                        </th>
                        <th style="vertical-align: top; min-width:150px;">
                            Tipo
                        </th>
                        <th style="vertical-align: top;min-width:150px;">
                            Opciones
                        </th>
                    </tr>

                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent

    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Competencias ${new Date().toLocaleDateString().trim()}`,
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
                titleAttr: 'Agregar competencia',
                url: "{{ route('admin.ev360-competencias.create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                    let {
                        url
                    } = config;
                    window.location.href = url;
                }
            };
            dtButtons.push(btnAgregar);

            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-competencias.index') }}",
                columns: [{
                        data: 'imagen',
                        render: function(data, type, row, meta) {
                            // console.log(row.imagen_ruta)
                            let html = '<div>';
                            html += `
                                <img class="imagen-responsiva" src="${row.imagen_ruta}" title="${row.nombre}"/>
                                `;
                            html += '</div>';
                            return html;
                        },

                    }, {
                        data: 'nombre'
                    }, {
                        data: 'tipo',
                        render: function(data, type, row, meta) {
                            return data.nombre;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlBtnEditar =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}/edit`;
                            let urlBtnEditarConductas =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}/${'editar-conductas'}/edit`;
                            // let urlBtnEvaluacionEstatus =
                            //     `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}/evaluacion`;
                            let urlBtnVisualizar =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}`;
                            let urlBtnEliminar =
                                `/admin/recursos-humanos/evaluacion-360/competencias/${data}`;

                            let botones = `
                            @can('competencias_editar')

                                <a class="btn btn-sm btn-editar" title="Editar" href="${urlBtnEditar}"><i class="fas fa-edit"></i></a>
                            @endcan
                            @can('competencias_show')
                                <a class="btn btn-sm btn-editar" title="Visualizar" href="${urlBtnVisualizar}"><i class="fas fa-eye"></i></a>
                            @endcan
                            @can('competencias_eliminar')
                                <button class="btn btn-sm btn-eliminar text-danger" title="Eliminar" data-action="Eliminar"
                                    data-url="${urlBtnEliminar}"><i class="fas fa-trash-alt"></i></button>
                            @endcan
                            `;
                            return botones;
                        }
                    }
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ],
                dom: "<'row align-items-center justify-content-center container m-0 p-0'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-6 col-lg-6'B><'col-md-3 col-12 col-sm-12 m-0 p-0'f>>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>",
            };
            let table = $('.tblCompetencias').DataTable(dtOverrideGlobals);
            document.querySelector('.datatable-fix').addEventListener('click', function(e) {
                let target = e.target;
                if (e.target.tagName == 'I') {
                    target = e.target.closest('button');
                }
                if (target.getAttribute('data-action') == 'Eliminar') {
                    const url = target.getAttribute('data-url');
                    Swal.fire({
                        title: '¿Desea eliminar esta competencia?',
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
                                            '¡Registro Eliminado!',
                                            // 'Las áreas relacionadas quedarán sin grupo asignado',
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
        });
    </script>
@endsection

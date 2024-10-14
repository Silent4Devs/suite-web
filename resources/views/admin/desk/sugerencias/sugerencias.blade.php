<div class="cards-status-centro-atencion">
    <div class="card-status-centro" style="background-color: #4A98FF !important;">
        <i class="material-symbols-outlined">warning</i>
        <div class="info">
            <span>Quejas</span><br>
            <strong>{{ $total_sugerencias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #FF8F55 !important;">
        <i class="material-symbols-outlined">flag</i>
        <div class="info">
            <span>Sin atender</span><br>
            <strong>{{ $nuevos_sugerencias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #78BB50 !important;">
        <i class="material-symbols-outlined">check_circle</i>
        <div class="info">
            <span>En curso</span><br>
            <strong>{{ $en_curso_sugerencias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #BE74FF !important;">
        <i class="material-symbols-outlined">pause</i>
        <div class="info">
            <span>En espera</span><br>
            <strong>{{ $en_espera_sugerencias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #7A7A7A !important;">
        <i class="material-symbols-outlined">cancel_presentation</i>
        <div class="info">
            <span>Cerrados</span><br>
            <strong>{{ $cerrados_sugerencias }}</strong>
        </div>
    </div>
    <div class="card-status-centro" style="background-color: #FE5661 !important;">
        <i class="material-symbols-outlined">block</i>
        <div class="info">
            <span>Cancelados</span><br>
            <strong>{{ $cancelados_sugerencias }}</strong>
        </div>
    </div>
</div>

<div class="card card-body box-sentimientos mt-4">
    <div class="card-sentimiento">
        <div>
            <span>No prioritario</span><br>
            <strong>10</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji1.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Bajo</span><br>
            <strong>20</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji2.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Medio</span><br>
            <strong>40</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji3.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Alto</span><br>
            <strong>80</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji4.png') }}" alt="Emoji">
    </div>
    <div class="card-sentimiento">
        <div>
            <span>Urgente</span><br>
            <strong>100</strong>
        </div>
        <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji">
    </div>
</div>

<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_sugerencias }}</div>
            <div>Sugerencias</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_sugerencias }}</div>
            <div>Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_sugerencias }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_sugerencias }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_sugerencias }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_sugerencias }}</div>
            <div>Cancelados</div>
        </div>
    </div>
</div>


@can('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia')
    <div class="mb-3 text-right">
        <a class="btn btn-primary" href="{{ asset('admin/inicioUsuario/reportes/sugerencias') }}">Crear reporte</a>
    </div>
@endcan


@include('partials.flashMessages')
<div class="datatable-fix datatable-rds">
    <table class="datatable tabla_sugerencias">
        <thead>
            <tr>
                <th>Folio</th>
                <th>Estatus</th>
                <th style="min-width: 200px;">Fecha de recepción</th>
                <th style="min-width: 200px;">Fecha de cierre</th>
                <th style="min-width: 200px;">Nombre</th>
                <th style="min-width: 200px;">Correo</th>
                <th style="min-width: 200px;">Teléfono</th>
                <th style="min-width: 200px;">Sugerencia</th>
                <th style="min-width: 200px;">Área</th>
                <th style="min-width: 200px;">Proceso</th>
                <th style="min-width: 500px;">Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
    </table>
</div>

@foreach ($sugerencias as $item)
    <div class="modal fade" id="sentimiento-modal-sugerencias-{{ $item->id }}" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 800px;">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <div class="text-end">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row mt-4">
                        <div class="col-6">
                            <div class="mb-2">
                                <strong>Ticket:</strong>
                                <span>{{ $item->folio }}</span>
                            </div>
                            <div class="mb-2">
                                <strong>Palabras clave:</strong>
                                <span>Mobiliario, sucio, proyecto</span>
                            </div>
                            <div class="mb-2">
                                <strong>Categoría de la queja:</strong>
                                <span>Lorem ipsum dolor sit amet</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card card-body">
                                <div class="d-flex gap-3 align-items-center">
                                    <img src="{{ asset('img/centroAtencion/emoji5.png') }}" alt="Emoji"
                                        style="width: 60px;">
                                    <div>
                                        <strong style="font-size: 16px;">{{ $item->titulo }}</strong><br>
                                        <span>Prioridad de atención:</span> <span>Alta</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-4">
                    <div>
                        <h5>Frases nominales</h5>
                        <ul class="mt-3">
                            <li>
                                Últimamente hemos tenido malentendidos constantes en el equipo, especialmente cuando se
                                trata de definir responsabilidades en los proyectos.
                            </li>
                            <li>
                                Estoy viendo un conflicto de intereses entre lo que mi equipo prioriza y lo que la
                                gerencia espera de nosotros.
                            </li>
                            <li>
                                El ambiente en el equipo se ha vuelto tóxico. Hay comentarios sarcásticos constantes y
                                falta de respeto en las reuniones, lo cual afecta mucho la motivación.
                            </li>
                        </ul>

                        <h5 class="mt-5">Resumen</h5>
                        <p class="mt-3">
                            Los colaboradores a menudo utilizan frases nominales para describir los problemas que
                            enfrentan en su entorno de trabajo, abarcando tanto conflictos con otros compañeros como
                            dificultades internas en su labor diaria. Uno de los problemas más comunes que mencionan es
                            la falta de comunicación, donde indican que reciben información incompleta o tardía, lo que
                            complica la coordinación y cumplimiento de tareas. También reportan malentendidos
                            constantes, refiriéndose a confusiones sobre las responsabilidades o expectativas, lo que
                            genera tensiones en el equipo y afecta la productividad.
                        </p>

                        <h5 class="mt-5">Interpretación de Sentimientos</h5>
                        <p class="mt-3">
                            En cuanto al clima laboral, algunos empleados señalan la presencia de un ambiente tóxico,
                            caracterizado por actitudes negativas, comentarios sarcásticos y falta de respeto entre los
                            compañeros, lo que impacta la motivación. Además, muchos describen la falta de apoyo por
                            parte de sus supervisores, quienes no están disponibles para brindar orientación o ayuda
                            cuando es necesario, dejando a los empleados sintiéndose desamparados.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach

@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-pdf" style="font-size: 1.1rem;color:#e3342f"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar PDF',
                    orientation: 'portrait',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    },
                    customize: function(doc) {
                        doc.pageMargins = [5, 20, 5, 20];
                        doc.styles.tableHeader.fontSize = 10;
                        doc.defaultStyle.fontSize = 10; //<-- set fontsize to 16 instead of 10
                    }
                },
                {
                    extend: 'print',
                    title: `Inventario de Activos ${new Date().toLocaleDateString().trim()}`,
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
                },
                {
                    text: '<i class="fas fa-archive" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Archivo',
                    action: function(e, dt, node, config) {
                        window.location.href = '/admin/desk/sugerencia-archivo';
                    }
                }

            ];
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar empleado',
            //     url: "{{ asset('admin/inicioUsuario/reportes/sugerencias') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     action: function(e, dt, node, config) {
            //     let {
            //     url
            //     } = config;
            //     window.location.href = url;
            //     }
            // };


            // let dtOverrideGlobals = {
            //     buttons: dtButtons,
            //     order:[
            //                 [0,'desc']
            //             ]
            // };
            // let table = $('.tabla_sugerencias').DataTable(dtOverrideGlobals);
            // $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
            //     $($.fn.dataTable.tables(true)).DataTable()
            //         .columns.adjust();
            // });
            // $('.datatable thead').on('input', '.search', function() {
            //     let strict = $(this).attr('strict') || false
            //     let value = strict && this.value ? "^" + this.value + "$" : this.value
            //     table
            //         .column($(this).parent().index())
            //         .search(value, strict)
            //         .draw()
            // });
            $(document).ready(function() {
                if (!$.fn.dataTable.isDataTable('.tabla_sugerencias')) {
                    window.tabla_sugerencias_desk = $(".tabla_sugerencias").DataTable({
                        ajax: '/admin/desk/sugerencias',
                        buttons: dtButtons,
                        columns: [{
                                data: 'folio',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'estatus',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'fecha_reporte',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'fecha_cierre',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'id',
                                render: function(data, type, row) {
                                    return `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.sugirio?.avatar}" title="${row.sugirio?.name}"></img>`;
                                }
                            },
                            {
                                data: 'id',
                                render: function(data, type, row) {
                                    return `${row.sugirio?.email}`;
                                }
                            },
                            {
                                data: 'id',
                                render: function(data, type, row) {
                                    return `${row.sugirio?.telefono}`;
                                }
                            },
                            {
                                data: 'titulo',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'area_sugerencias',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'proceso_sugerencias',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'descripcion',
                                render: function(data) {
                                    return data ? data : '';
                                }
                            },
                            {
                                data: 'id',
                                render: function(data, type, row) {
                                    let html = `
                            <div class="botones_tabla">
                                @can('centro_atencion_sugerencias_editar')
                                <a href="/admin/desk/${data}/sugerencias-edit/"><i class="fas fa-edit"></i></a>
                                @endcan`;

                                    if (row.estatus === 'cerrado' || row.estatus ===
                                        'cancelado') {
                                        html += `
                                <button class="btn archivar" data-id="${data}" style="margin-top:-10px">
                                    <i class="fas fa-archive"></i>
                                </button>

                                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#sentimiento-modal-sugerencias-${data}">
                                    <i class="fa-regular fa-face-smile"></i>
                                </button>

                                `;
                                    }

                                    html += '</div>';
                                    return html;
                                }
                            }
                        ],
                        order: [
                            [0, 'desc']
                        ],
                        drawCallback: function() {
                            // Maneja los clics en los botones de archivar
                            $('.archivar').off('click').on('click', function(e) {
                                e.preventDefault();
                                let incidente_id = $(this).data('id');
                                let url =
                                    `/admin/desk/${incidente_id}/archivarSugerencia`;
                                Archivar(url);
                            });
                        }
                    });
                }

                window.Archivar = function(url) {
                    Swal.fire({
                        title: '¿Archivar Sugerencia?',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Cancelar',
                        confirmButtonText: 'Archivar',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                type: "post",
                                url: url,
                                data: {
                                    _token: '{{ csrf_token() }}'
                                },
                                dataType: "json",
                                success: function(response) {
                                    if (response.success) {
                                        tabla_sugerencias_desk.ajax.reload();
                                        Swal.fire('Archivado', '', 'success');
                                    }
                                }
                            });
                        }
                    });
                }
            });


            let botones_archivar = document.querySelectorAll('.archivar');
            botones_archivar.forEach(boton => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    let incidente_id = this.getAttribute('data-id');
                    // console.log(incidente_id);
                    let url = `/admin/desk/${incidente_id}/archivarSugerencia`;
                    Archivar(url);
                });
            });
        });
    </script>
@endsection

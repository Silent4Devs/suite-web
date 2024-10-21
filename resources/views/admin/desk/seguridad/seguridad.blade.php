<style type="text/css">
    table {
        width: auto;
        height: auto;
    }
</style>


<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_seguridad }}</div>
            <div>Incidentes</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_seguridad }}</div>
            <div>Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_seguridad }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_seguridad }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_seguridad }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_seguridad }}</div>
            <div>No procedentes</div>
        </div>
    </div>
</div>


<div class="mb-3 text-right">
    <a class="btn btn-primary" href="{{ asset('admin/inicioUsuario/reportes/seguridad') }}">Crear reporte</a>
</div>


@include('partials.flashMessages')
<div class="datatable-fix datatable-rds">
    <table class="datatable tabla_incidentes_seguridad">
        <thead>
            <tr>
                {{-- <th>ID</th> --}}
                <th style="min-width: 250px;">Folio</th>
                <th style="min-width: 250px;">Título</th>
                <th style="min-width: 250px;">Sede</th>
                <th style="min-width: 250px;">Ubicación</th>
                <th style="min-width: 500px;">Descripción</th>
                <th style="min-width: 250px;">Areas Afectadas</th>
                <th style="min-width: 250px;">Procesos Afectados</th>
                <th style="min-width: 250px;">Activos Afectados</th>
                <th style="min-width: 150px;">Fecha</th>
                <th style="min-width: 250px;">Quién reportó</th>
                <th style="min-width: 250px;">Correo</th>
                <th style="min-width: 250px;">Teléfono</th>
                <th style="min-width: 90px;">Estatus</th>
                <th style="min-width: 150px;">Fecha de cierre</th>
                <th style="min-width: 250px;">Asignado a</th>
                <th style="min-width: 500px;">Comentarios</th>
                <th>Opciones</th>
            </tr>
        </thead>
    </table>
</div>




@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'pdfHtml5',
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
                    title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
                        window.location.href = '/admin/desk/seguridad-archivo';
                    }
                }

            ];
            if (!$.fn.dataTable.isDataTable('.tabla_incidentes_seguridad')) {
                window.tabla_incidentes = $(".tabla_incidentes_seguridad").DataTable({
                    ajax: '/admin/desk/seguridad',
                    buttons: dtButtons,
                    columns: [{
                            data: 'folio',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'titulo',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'sede',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'ubicacion',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'descripcion',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'areas_afectados',
                            render: function(data, type, row, meta) {
                                return `${row.areas_afectados?row.areas_afectados :'n/a'}`;
                            }
                        },
                        {
                            data: 'procesos_afectados',
                            render: function(data, type, row, meta) {
                                return `${row.procesos_afectados?row.procesos_afectados :'n/a'}`;
                            }
                        },
                        {
                            data: 'activos_afectados',
                            render: function(data, type, row, meta) {
                                return `${row.activos_afectados?row.activos_afectados :'n/a'}`;
                            }
                        },
                        {
                            data: 'fecha_creacion',
                            render: function(data, type, row, meta) {
                                return data ? data : '';
                            }
                        },
                        {
                            data: 'name',
                            render: function(data, type, row, meta) {
                                let html =
                                    `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.reporto?.avatar}" title="${row.reporto?.name}"></img>`;

                                return html;
                            }
                        },
                        {
                            data: 'email',
                            render: function(data, type, row, meta) {
                                return `${row.reporto?.email}`;
                            }
                        },
                        {
                            data: 'telefono',
                            render: function(data, type, row, meta) {
                                return `${row.reporto?.telefono}`;
                            }
                        },
                        {
                            data: 'estatus',
                            render: function(data, type, row, meta) {
                                return `<span style="text-transform:capitalize">${data}</span>`;
                            }
                        },
                        {
                            data: 'fecha_cerrado'
                        },
                        {
                            data: 'name',
                            render: function(data, type, row, meta) {


                                let html =
                                    `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.asignado?.avatar}" title="${row.asignado?.name}"></img>`;

                                return `${row.asignado ? html: 'sin asignar'}`;
                            }
                        },
                        {
                            data: 'comentarios',
                            render: function(data, type, row, meta) {
                                return `${row.comentarios?row.comentarios :'n/a'}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                                @can('centro_atencion_incidentes_de_seguridad_editar')
                				<a href="/admin/desk/${data}/seguridad-edit/"><i class="fas fa-edit"></i></a>
                                @endcan
                                `;


                                if ((row.estatus == 'cerrado') || (row.estatus == 'cancelado')) {

                                    html += `<button class="btn archivar" onclick='Archivar("/admin/desk/${data}/archivar"); return false;' style="margin-top:-10px">
				       						<i class="fas fa-archive" ></i></a>
				       					</button>
				       					</div>`;
                                }
                                return html;
                            }
                        },
                    ],
                    createdRow: (row, data, dataIndex, cells) => {
                        let fondo = "green";
                        let letras = "white";
                        if (data.estatus == 'Sin atender') {
                            fondo = "#FFCB63";
                            letras = "white";
                        }
                        if (data.estatus == 'En curso') {
                            fondo = "#AC84FF";
                            letras = "white";
                        }
                        if (data.estatus == 'En espera') {
                            fondo = "#6863FF";
                            letras = "white";
                        }
                        if (data.estatus == 'Cerrado') {
                            fondo = "#6DC866";
                            letras = "white";
                        }
                        if (data.estatus == 'No procedente') {
                            fondo = "#FF417B";
                            letras = "white";
                        }
                        if (data.estatus != null) {
                            $(cells[12]).css('background-color', fondo)
                            $(cells[12]).css('color', letras)
                        }

                    },
                    order: [
                        [0, 'desc']
                    ]
                });
            }

            window.Archivar = function(url) {
                Swal.fire({
                    title: '¿Archivar incidente?',
                    text: "",
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
                                    tabla_incidentes.ajax.reload();
                                    Swal.fire(
                                        'Archivado',
                                        '',
                                        'success'
                                    )
                                }

                            }

                        });

                    }
                })
            }

            let botones_archivar = document.querySelectorAll('.archivar');
            botones_archivar.forEach(boton => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    let incidente_id = this.getAttribute('data-id');
                    console.log(incidente_id);
                    let url = `/admin/desk/${incidente_id}/archivar`;
                });
            });


        });
    </script>
@endsection

<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_riesgos }}</div>
            <div>Riesgos</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_riesgos }}</div>
            <div>Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_riesgos }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_riesgos }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_riesgos }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_riesgos }}</div>
            <div>Cancelados</div>
        </div>
    </div>
</div>


@can('mi_perfil_mis_reportes_realizar_reporte_de_riesgo_identificado')
<div class="mb-3 text-right">
    <a class="btn btn-danger" href="{{asset('admin/inicioUsuario/reportes/riesgos')}}">Crear reporte</a>
</div>
@endcan

    @include('partials.flashMessages')
    <div class="datatable-fix datatable-rds">
        <table class="datatable tabla_riesgos">
            <thead>
             <tr>
                 <th>Folio</th>
                 <th style="min-width:200px;">Título</th>
                 <th style="min-width:200px;">Fecha de identificación</th>
                 <th style="min-width:200px;">Fecha de recepción del reporte</th>
                 <th style="min-width:200px;">Fecha de cierre</th>
                 <th style="min-width: 500px;">Descripción</th>
                 <th style="min-width: 500px;">Comentarios</th>
                 <th style="min-width:200px;">Estatus</th>
                 <th style="min-width:200px;">Sede</th>
                 <th style="min-width:200px;">Ubicación</th>
                 <th style="min-width:200px;">Procesos afectados</th>
                 <th style="min-width:200px;">Áreas afectadas</th>
                 <th style="min-width:200px;">Activos afectados</th>
                 <th style="min-width: 500px;">Fecha</th>
                 <th style="min-width:200px;">Quién reportó</th>
                 <th style="min-width:200px;">Correo</th>
                 <th style="min-width:200px;">Teléfono</th>
                 <th>Opciones</th>
             </tr>
            </thead>
            <tbody>
            </tbody>
    </table>
</div>


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
                        doc.pageMargins = [20, 60, 20, 30];
                        // doc.styles.tableHeader.fontSize = 7.5;
                        // doc.defaultStyle.fontSize = 7.5; //<-- set fontsize to 16 instead of 10
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
                        window.location.href = '/admin/desk/riesgos-archivo';
                    }
                }

            ];
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar empleado',
            //     url: "{{asset('admin/inicioUsuario/reportes/seguridad')}}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     action: function(e, dt, node, config) {
            //     let {
            //     url
            //     } = config;
            //     window.location.href = url;
            //     }
            // };
            //     dtButtons.push(btnAgregar)
            if (!$.fn.dataTable.isDataTable('.tabla_riesgos')) {
                window.tabla_riesgos_desk = $(".tabla_riesgos").DataTable({
                    ajax: '/admin/desk/riesgos',
                    buttons: dtButtons,
                    columns: [
                        // {data: 'id'},
                        {
                            data: 'folio'
                        },
                        {
                            data: 'titulo'
                        },
                        {
                            data: 'fecha_creacion'
                        },
                        {
                            data: 'fecha_reporte'
                        },
                        {
                            data: 'fecha_de_cierre'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'comentarios'
                        },
                        {
                            data: 'estatus'
                        },
                        {
                            data: 'sede'
                        },
                        {
                            data: 'ubicacion'
                        },
                        {
                            data: 'procesos_afectados'
                        },
                        {
                            data: 'areas_afectados'
                        },
                        {
                            data: 'activos_afectados'
                        },
                        {
                            data: 'fecha'
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html = `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.reporto?.avatar}" title="${row.reporto?.name}"></img>`;

                                return html;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.reporto?.email}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.reporto?.telefono}`;
                            }
                        },
                        // {
                        //     data: 'id',
                        //     render: function(data, type, row, meta) {


                        //         let html = `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.asignado?.avatar}" title="${row.asignado?.name}"></img>`;

                        //         return `${row.asignado ? html: 'sin asignar'}`;
                        //     }
                        // },
                        // {
                        //     data: 'comentarios'
                        // },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                                @can('centro_atencion_riesgos_editar')
                				<a href="/admin/desk/${data}/riesgos-edit/"><i class="fas fa-edit"></i></a>
                                @endcan
                                `;


                                if ((row.estatus == 'cerrado') || (row.estatus == 'cancelado')) {

                                    html += `<button class="btn archivar" onclick='ArchivarRiesgo("/admin/desk/${data}/archivarRiesgos"); return false;' style="margin-top:-10px">
				       						<i class="fas fa-archive" ></i></a>
				       					</button>

				       					</div>`;
                                }
                                return html;
                            }
                        },
                    ],
                        order:[
                            [0,'desc']
                        ]
                });
            }

            window.ArchivarRiesgo = function(url) {
                Swal.fire({
                    title: '¿Archivar riesgo?',
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
                                    tabla_riesgos_desk.ajax.reload();
                                    Swal.fire(
                                        'Riesgo Archivado',
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
                    // console.log(incidente_id);
                    let url = `/admin/desk/${incidente_id}/archivarRiesgos`;
                });
            });
        });
    </script>
@endsection

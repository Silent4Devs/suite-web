{{-- <style>
         .table tr td:nth-child(5) {

        text-align:left !important;
        }


</style> --}}


<style>
    .textoCentroCard {
            font-size: 12pt !important;
        }
</style>

<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_quejasClientes }}</div>
            <div class="textoCentroCard">Quejas Clientes</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_quejasClientes }}</div>
            <div class="textoCentroCard">Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_quejasClientes }}</div>
            <div class="textoCentroCard">En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_quejasClientes }}</div>
            <div class="textoCentroCard">En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_quejasClientes }}</div>
            <div class="textoCentroCard">Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_quejasClientes }}</div>
            <div class="textoCentroCard">No procedentes</div>
        </div>
    </div>
</div>


<div class="card card-body">
        <div class=" mb-3 text-right">
            @can('centro_atencion_quejas_clientes_agregar')
                <a class="btn btn-danger" href="{{ asset('admin/desk/quejas-clientes') }}">Crear reporte</a>
            @endcan

            @can('centro_atencion_quejas_cliente_dashboard')
                <a class="btn btn-danger" href="{{ asset('admin/desk/quejas-clientes/dashboard') }}">Dashboard</a>
            @endcan
        </div>




         @include('partials.flashMessages')
            <div class="datatable-fix datatable-rds">
                     <table class="datatable tabla_quejasclientes" id="tabla-procesos">
                        <thead>
                            <tr>
                                <th style="min-width:60px;">Folio</th>
                                <th style="min-width:200px;">Cliente</th>
                                <th style="min-width:200px;">Proyecto</th>
                                <th style="min-width:200px;">Nombre del Cliente</th>
                                <th style="min-width:200px;">Puesto</th>
                                <th style="min-width:200px;">Teléfono</th>
                                <th style="min-width:200px;">Correo</th>
                                <th style="min-width:200px;">Título de la Queja</th>
                                <th style="text-align:left !important;min-width:150px;">Fecha de Registro</th>
                                <th style="min-width:150px;">Fecha de Cierre</th>
                                <th style="min-width:200px;">Proceso</th>
                                <th style="min-width:200px;">Ubicación</th>
                                <th style="min-width:200px;">Otros</th>
                                <th style="min-width:500px;">Descripción</th>
                                <th style="min-width:80px;">Estatus</th>
                                <th>Prioridad</th>
                                <th style="min-width:150px;">Acción Correctiva</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                </table>
            </div>

</div>



@section('scripts')
    @parent
    <script type="text/javascript">
        $(document).ready(function() {

            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Quejas de Clientes ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Quejas de Clientes ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible']
                    }
                },
                {
                    extend: 'print',
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;color:#345183"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    // set custom header when print
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
                        $(doc.document.body).prepend(`
                            <div class="row">
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">CENTRO DE ATENCIÓN: QUEJAS CLIENTES</strong>
                                </div>
                                <div class="col-4 text-center p-2" style="border:2px solid #CCCCCC">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
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
                        window.location.href = '/admin/desk/quejas-archivo';
                    }
                }

            ];
            // let btnAgregar = {
            //     text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
            //     titleAttr: 'Agregar empleado',
            //     url: "{{ asset('admin/inicioUsuario/reportes/seguridad') }}",
            //     className: "btn-xs btn-outline-success rounded ml-2 pr-3",
            //     action: function(e, dt, node, config) {
            //     let {
            //     url
            //     } = config;
            //     window.location.href = url;
            //     }
            // };
            //     dtButtons.push(btnAgregar)
            if (!$.fn.dataTable.isDataTable('.tabla_quejasclientes')) {
                window.tabla_quejasclientes_desk = $(".tabla_quejasclientes").DataTable({
                    ajax: "{{ route('admin.desk.quejasClientes-index') }}",
                    buttons: dtButtons,
                    columnDefs: [{
                        targets: [4, 5, 6, 10, 11, 12,13],
                        visible: false,
                    }],
                    columns: [
                        // {data: 'id'},
                        {
                            data: 'folio'
                        },
                        {
                            data: 'cliente',
                            render: function(data, type, row, meta) {
                                return row.cliente.nombre
                            }
                        },
                        {
                            data: 'proyectos',
                            render: function(data, type, row, meta) {
                                return row.proyectos.proyecto
                            }
                        },
                        {
                            data: 'nombre'
                        },
                        {
                            data: 'puesto'
                        },
                        {
                            data: 'telefono'
                        },
                        {
                            data: 'correo'
                        },
                        {
                            data: 'titulo',
                            render: function(data, type, row, meta) {
                                return `<div style="text-align: left">${data}</div>`
                            }
                        },
                        {
                            data: 'fecha_reporte'
                        },
                        {
                            data: 'fecha_de_cierre'
                        },
                        {
                            data: 'proceso_quejado'
                        },
                        {
                            data: 'ubicacion'
                        },
                        {
                            data: 'otro_quejado'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'estatus',
                        },
                        {
                            data: 'prioridad',
                        },
                        {
                            data: 'desea_levantar_ac',
                            render: function(data, type, row, meta) {
                                data = data == "" ? 0 : data
                                let valor= "";
                                if(data == true){
                                    valor= "Solicitada";
                                }
                                if(data == false){
                                    valor= "No aplica";
                                }

                            return `
                                <div>${valor}</div>
                            `
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                				<a href="/admin/desk/${data}/quejas-clientes-edit/"><i class="fas fa-edit" title="Análisis de la queja"></i></a>
                                <a onclick='EliminarQuejaCliente("/admin/desk/${data}/quejas-clientes-delete"); return false;'><i style="color:#000" class="ml-2 fas fa-trash"  data-toggle="tooltip" data-placement="top" title="Eliminar"></i></a>`;

                                if ((row.estatus == 'Cerrado') || (row.estatus == 'No procedente')) {

                                    html += `<button class="btn archivar" onclick='ArchivarQuejaCliente("/admin/desk/${data}/archivarQuejasClientes"); return false;' style="margin-top:-10px">
				       						<i class="fas fa-archive" ></i></a>
				       					</button>
				       					</div>`;
                                }
                                return html;
                            }
                        },
                    ],
                    createdRow: (row, data, dataIndex, cells) => {
                        let color = "green";
                        let texto = "white";
                        if (data.prioridad == 'Alta') {
                            color = "#FF417B";
                            texto = "white";
                        }
                        if (data.prioridad == 'Media') {
                            color = "#FFCB63";
                            texto = "white";
                        }
                        if (data.prioridad == 'Baja') {
                            color = "#6DC866";
                            texto = "white";
                        }

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
                        if(data.estatus !=null){
                            $(cells[14]).css('background-color', fondo)
                            $(cells[14]).css('color', letras)
                        }
                        if(data.prioridad !=null){
                            $(cells[15]).css('background-color', color)
                            $(cells[15]).css('color', texto)

                        }
                    },

                    order: [
                        [0, 'desc']
                    ]
                });
            }

            window.ArchivarQuejaCliente = function(url) {
                Swal.fire({
                    title: '¿Archivar queja clientes?',
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
                                    tabla_quejasclientes_desk.ajax.reload();
                                    Swal.fire(
                                        'Queja Archivada',
                                        '',
                                        'success'
                                    )
                                }

                            }

                        });

                    }
                })
            }

            window.EliminarQuejaCliente = function(url) {
                Swal.fire({
                    title: '¿Eliminar queja cliente?',
                    text: "",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    cancelButtonText: 'Cancelar',
                    confirmButtonText: 'Eliminar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({

                            type: "DELETE",

                            url: url,

                            data: {
                                _token: '{{ csrf_token() }}'
                            },

                            dataType: "json",

                            success: function(response) {

                                    tabla_quejasclientes_desk.ajax.reload();
                                    Swal.fire(
                                        'Queja Eliminada',
                                        '',
                                        'success'
                                    )


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
                    let url = `/admin/desk/${incidente_id}/archivarQuejasClientes`;
                });
            });

        });
    </script>
@endsection

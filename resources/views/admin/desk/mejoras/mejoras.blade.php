<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_mejoras }}</div>
            <div>Mejoras</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_mejoras }}</div>
            <div>Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_mejoras }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_mejoras }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_mejoras }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_mejoras }}</div>
            <div>Cancelados</div>
        </div>
    </div>
</div>

<div class="datatable-fix" style="width: 100%;">
    @can('mi_perfil_mis_reportes_realizar_reporte_de_propuesta_de_mejora')
    <div class="mb-3 text-right">
        <a class="btn btn-danger" href="{{asset('admin/inicioUsuario/reportes/mejoras')}}">Crear reporte</a>
    </div>
    @endcan
    {{-- @foreach($mejoras as $mejora)
        {{$mejora->mejoro}}
    @endforeach --}}
   <table class="table tabla_mejoras" id="tabla_mejoras">
   		<thead>
            <tr style="border: none !important;">
                <th colspan="4" style="background-color: #F5F7FA;"></th>
                <th colspan="7" style="border:1px solid #ccc; text-align:center;">Reporto</th>

            </tr>
   			<tr>
       			<th>Folio</th>
                <th style="min-width:200px;">Estatus</th>
                <th style="min-width:200px;">Fecha de identificación</th>
                <th style="min-width:200px;">Fecha de recepción</th>
                <th style="min-width:200px;">Fecha de cierre</th>
       			<th style="min-width:200px;">Nombre</th>
                <th style="min-width:200px;">Área</th>
                <th style="min-width:200px;">Puesto</th>
       			<th style="min-width:200px;">Correo</th>
       			<th style="min-width:200px;">Teléfono</th>
                <th style="min-width: 500px;">Mejora</th>
                <th style="min-width:200px;">Tipo de mejora</th>
                <th style="min-width:200px;">Proceso</th>
       			<th style="min-width: 500px;">Descripción</th>
                <th style="min-width: 500px;">Beneficios</th>
       			<th>Opciones</th>
   			</tr>
   		</thead>
   		<tbody>
   			{{-- @foreach($mejoras as $mejora)
	   			<tr>
	       			<td>{{ $mejora->folio }}</td>
                    <td>{{ $mejora->estatus }}</td>
                    <td>{{ $mejora->fecha_creacion }}</td>
                    <td>{{ $mejora->fecha_reporte }}</td>
                    <td>{{ $mejora->fecha_de_cierre }}</td>
	       			<td>
                        <img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/{{ $mejora->mejoro->avatar }}" title="{{ $mejora->mejoro->name }}">
                    </td>
	       			<td>{{ $mejora->mejoro->email }}</td>
	       			<td>{{ $mejora->mejoro->telefono }}</td>
                    <td>{{ $mejora->titulo }}</td>
                    <td>{{ $mejora->tipo }}</td>
                    <td>{{ $mejora->area_mejora }}</td>
                    <td>{{ $mejora->proceso_mejora }}</td>
	       			<td>{{ $mejora->descripcion }}</td>
                    <td>{{ $mejora->beneficios }}</td>
	       			<td>
	       				<a href="{{ route('admin.desk.mejoras-edit', $mejora->id) }}"><i class="fas fa-edit"></i></a>
	       			</td>
	   			</tr>
   			@endforeach --}}
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
                        window.location.href = '/admin/desk/mejoras-archivo';
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
            if (!$.fn.dataTable.isDataTable('.tabla_mejoras')) {
                window.tabla_mejoras_desk = $(".tabla_mejoras").DataTable({
                    buttons: dtButtons,
                    ajax: '/admin/desk/mejoras',
                    columnDefs: [
                        {
                            "targets": [ 2,3,4,8,9,10,12,14 ],
                            "visible": false,
                            "searchable": true
                        },

                    ],
                    columns: [
                        // {data: 'id'},
                        {
                            data: 'folio'
                        },
                        {
                            data: 'estatus'
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
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html = `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.mejoro?.avatar}" title="${row.mejoro?.name}"></img>`;

                                return html;
                            }
                        },
                        {
                            data: 'area_mejora'
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.mejoro?.puesto}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.mejoro?.email}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.mejoro?.telefono}`;
                            }
                        },
                        {
                            data: 'titulo',

                        },
                        {
                            data: 'tipo'
                        },
                        {
                            data: 'proceso_mejora'
                        },
                        {
                            data: 'descripcion',
                            render: function(data, type, row, meta){
                                return row.descripcion_html;
                            }
                        },
                        {
                            data: 'beneficios',
                            render: function(data, type, row, meta){
                                return row.beneficio_html;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                                @can('centro_atencion_mejoras_editar')
                				<a href="/admin/desk/${data}/mejoras-edit/"><i class="fas fa-edit"></i></a>
                                @endcan
                                `;


                                if ((row.estatus == 'cerrado') || (row.estatus == 'cancelado')) {

                                    html += `
                                        <button class="btn archivar" onclick='ArchivarMejora("/admin/desk/${data}/archivarMejoras"); return false;' style="margin-top:-10px">
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

            window.ArchivarMejora = function(url) {
                Swal.fire({
                    title: '¿Archivar mejora?',
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
                                console.log(response);
                                if (response.success) {
                                    tabla_mejoras_desk.ajax.reload();
                                    Swal.fire(
                                        'Mejora Archivada',
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
                    let url = `/admin/desk/${incidente_id}/archivarMejoras`;
                });
            });
        });
    </script>
@endsection

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

<div class="datatable-fix" style="width: 100%;">
    @can('mi_perfil_mis_reportes_realizar_reporte_de_sugerencia')
    <div class="mb-3 text-right">
        <a class="btn btn-danger" href="{{asset('admin/inicioUsuario/reportes/sugerencias')}}">Crear reporte</a>
    </div>
    @endcan
   <table class="table tabla_sugerencias">
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
   		<tbody>
   			{{-- @foreach($sugerencias as $sugerencia)
	   			<tr>
	       			<td>{{ $sugerencia->folio }}</td>
                    <td>{{ $sugerencia->estatus }}</td>
                    <td>{{ $sugerencia->fecha_reporte }}</td>
                    <td>{{ $sugerencia->fecha_cierre }}</td>
	       			<td>
                        <img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/{{ $sugerencia->sugirio->avatar }}" title="{{ $sugerencia->sugirio->name }}">
                    </td>
	       			<td>{{ $sugerencia->sugirio->email }}</td>
	       			<td>{{ $sugerencia->sugirio->telefono }}</td>
                    <td>{{ $sugerencia->titulo }}</td>
                    <td>{{ $sugerencia->area_sugerencias }}</td>
                    <td>{{ $sugerencia->proceso_sugerencias }}</td>
	       			<td>{{ $sugerencia->descripcion }}</td>
	       			<td>
	       				<a href="{{ route('admin.desk.sugerencias-edit', $sugerencia->id) }}"><i class="fas fa-edit"></i></a>
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
                    text:'<i class="fas fa-archive" style="font-size: 1.1rem;"></i>',
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
            //     url: "{{asset('admin/inicioUsuario/reportes/sugerencias')}}",
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
            if (!$.fn.dataTable.isDataTable('.tabla_sugerencias')) {
                window.tabla_sugerencias_desk = $(".tabla_sugerencias").DataTable({
                    ajax: '/admin/desk/sugerencias',
                    buttons: dtButtons,
                    columns: [
                        // {data: 'id'},
                        {
                            data: 'folio'
                        },
                        {
                            data: 'estatus'
                        },
                        {
                            data: 'fecha_reporte'
                        },
                        {
                            data: 'fecha_cierre'
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html = `<img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/${row.sugirio?.avatar}" title="${row.sugirio?.name}"></img>`;

                                return html;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.sugirio?.email}`;
                            }
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                return `${row.sugirio?.telefono}`;
                            }
                        },
                        {
                            data: 'titulo'
                        },
                        {
                            data: 'area_sugerencias'
                        },
                        {
                            data: 'proceso_sugerencias'
                        },
                        {
                            data: 'descripcion'
                        },
                        {
                            data: 'id',
                            render: function(data, type, row, meta) {
                                let html =
                                    `
                			<div class="botones_tabla">
                                @can('centro_atencion_sugerencias_editar')
                				<a href="/admin/desk/${data}/sugerencias-edit/"><i class="fas fa-edit"></i></a>
                                @endcan`;

                                if ((row.estatus == 'cerrado') || (row.estatus == 'cancelado')) {

                                    html += `
                                    <button class="btn archivar" onclick='Archivar("/admin/desk/${data}/archivarSugerencia"); return false;' style="margin-top:-10px">
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
                                    tabla_sugerencias_desk.ajax.reload();
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
                    // console.log(incidente_id);
                    let url = `/admin/desk/${incidente_id}/archivarSugerencia`;
                });
            });
        });
    </script>
@endsection

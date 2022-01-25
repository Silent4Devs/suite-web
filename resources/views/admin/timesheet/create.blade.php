@extends('layouts.admin')
@section('content')
	
    <style type="text/css">
        .ingresar_horas{
            width: 50px;
        }
        .table select{
            width: 100%;
            height: calc(1.6em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 14px;
            font-weight: 400;
            line-height: 1.6;
            color: #747474;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }    
    </style>

	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Llenar Horas</font> </h5>

	<div class="card card-body">
		<div class="row">
			
	        <div class="datatable-fix w-100">
	            <table id="datatable_timesheet_create" class="table w-100">
	                <thead class="w-100">
	                    <tr>
	                        <th>Proyecto </th>
	                        <th>Tarea</th>
	                        <th>Billable</th>
	                        <th style="max-width:65px;">Lunes</th>
	                        <th style="max-width:65px;">Martes</th>
	                        <th style="max-width:65px;">Miercoles</th>
                            <th style="max-width:65px;">Jueves</th>
                            <th style="max-width:65px;">Viernes</th>
                            <th style="max-width:65px;">Sabado</th>
	                        <th style="max-width:65px;">Domingo</th>
	                    </tr>
	                </thead>

	                <tbody>
	                	<tr>
	                        <td>
	                            <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
	                        </td>
	                        <td>
	                            <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
	                        </td>
	                        <td class="text-center">
	                            <input type="checkbox" name="" style="min-width: 50px;">
	                        </td>
	                        <td>
	                        	<input type="" name="" class="ingresar_horas form-control">
	                        </td>
	                        <td>
	                        	<input type="" name="" class="ingresar_horas form-control">
	                        </td>
	                        <td>
	                        	<input type="" name="" class="ingresar_horas form-control">
	                        </td>
	                        <td>
	                        	<input type="" name="" class="ingresar_horas form-control">
							</td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   	                    
						</tr>
                        <tr>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="" style="min-width: 50px;">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="" style="min-width: 50px;">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="" style="min-width: 50px;">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="" style="min-width: 50px;">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="" style="min-width: 50px;">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>                           
                        </tr>
                        <tr>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione proyecto</option>   
                                    <option>proyecto1</option>   
                                    <option>proyecto2</option>   
                                </select>
                            </td>
                            <td>
                                <select>
                                    <option selected disabled>Seleccione tarea</option>   
                                    <option>tarea1</option>   
                                    <option>tarea2</option>   
                                </select>
                            </td>
                            <td class="text-center">
                                <input type="checkbox" name="" style="min-width: 50px;">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>   
                            <td>
                                <input type="" name="" class="ingresar_horas form-control">
                            </td>                           
                        </tr>
	                </tbody>
	            </table>
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
                }

            ];
            let btnAgregar = {
                text: '<i class="pl-2 pr-3 fas fa-plus"></i> Agregar',
                titleAttr: 'Agregar empleado',
                url: "{{asset('admin/inicioUsuario/reportes/quejas')}}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config) {
                let {
                url
                } = config;
                window.location.href = url;
                }
            };


            let dtOverrideGlobals = {
                buttons: dtButtons,
                order:[
                            [0,'desc']
                        ]
            };
            let table = $('#datatable_timesheet_create').DataTable(dtOverrideGlobals);
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
        });
    </script>

@endsection
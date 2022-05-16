@extends('layouts.admin')
@section('content')
    
    <style type="text/css">
        .td-cj-1{
            background-color: rgba(0, 0, 0, 0.1) !important;
        }
        .td-cj-2{
            background-color: rgba(0, 0, 0, 0.2) !important;
        }
        #datatable_clientes th{
            min-width: 100px;
        }
    </style>


     {{ Breadcrumbs::render('timesheet-clientes') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Clientes</font> </h5>

	<div class="card card-body">
		<div class="row">
			@include('partials.flashMessages')
	        <div class="datatable-fix w-100">
	            <table id="datatable_clientes" class="table w-100">
	                <thead>
                        <tr>
                            <th rowspan="2">ID</th>
                            <th rowspan="2">Razón social</th>
                            <th rowspan="2">Nombre comercial del proveedor</th>
                            <th rowspan="2">RFC persona moral o persona física</th>
                            <th colspan="6" class="td-cj-1" style="text-align: center;">DOMICILIO FISCAL</th>
                            <th colspan="4" class="td-cj-2" style="text-align: center;">DATOS DEL CONTACTO</th>
                            <th rowspan="2">Opciones</th>
                        </tr>
                        <tr>
                            <th class="td-cj-1">Calle y Número</th>
                            <th class="td-cj-1">Colonia</th>
                            <th class="td-cj-1">Ciudad o Municipio/ País</th>
                            <th class="td-cj-1">Código postal</th>
                            <th class="td-cj-1">Teléfonos con lada</th>
                            <th class="td-cj-1">Página Web</th>

                            <th class="td-cj-2">Nombre completo del contacto:</th>
                            <th class="td-cj-2">Puesto</th>
                            <th class="td-cj-2">Correo electrónico</th>
                            <th class="td-cj-2">Celular</th>
                        </tr>
                    </thead>

	                <tbody>
                        @foreach($clientes as $cliente)
    	                	<tr>
                               <td>{{ $cliente->identificador }}</td>
                               <td>{{ $cliente->razon_social }}</td>
                               <td>{{ $cliente->nombre }}</td>
                               <td>{{ $cliente->rfc }}</td>
                               <td>{{ $cliente->calle }}</td>
                               <td>{{ $cliente->colonia }}</td>
                               <td>{{ $cliente->ciudad }}</td>
                               <td>{{ $cliente->codigo_postal }}</td>
                               <td>{{ $cliente->telefono }}</td>
                               <td>{{ $cliente->pagina_web }}</td>
                               <td>{{ $cliente->nombre_contacto }}</td>
                               <td>{{ $cliente->puesto_contacto }}</td>
                               <td>{{ $cliente->correo_contacto }}</td>
                               <td>{{ $cliente->celular_contacto }}</td>
                               <td class="d-flex">
                                   <a href="{{ asset('admin/timesheet/clientes/edit') }}/{{ $cliente->id }}" class="btn" title="Editar"><i class="fa-solid fa-pen-to-square"></i></a>
                                   <a href="" class="btn" title="Eliminar" style="color:red;"><i class="fa-solid fa-trash-can"></i></a>
                               </td>
    						</tr>
                        @endforeach
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
                titleAttr: 'Agregar sede',
                url: "{{ route('admin.timesheet-clientes-create') }}",
                className: "btn-xs btn-outline-success rounded ml-2 pr-3",
                action: function(e, dt, node, config){
                let {url} = config;
                window.location.href = url;
                }
            };
            dtButtons.push(btnAgregar);



            let dtOverrideGlobals = {
                buttons: dtButtons,
                order:[
                            [0,'desc']
                        ]
            };
            let table = $('#datatable_clientes').DataTable(dtOverrideGlobals);
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
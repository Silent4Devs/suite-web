@extends('layouts.admin')
@section('content')
    
    <style type="text/css">
        .btn_op{
            opacity: 1 !important;
        }
        .btn-primary{
            opacity: 0.6;
        }


        .aprobada{
            padding: 3px;
            background-color: #61CB5C;
            color: #fff;
            border-radius: 4px;
        }
        .rechazada{
            padding: 3px;
            background-color: #EA7777;
            color: #fff;
            border-radius: 4px;
        }
        .pendiente{
            padding: 3px;
            background-color: #F48C16;
            color: #fff;
            border-radius: 4px;
        }
    </style>


     {{ Breadcrumbs::render('timesheet-index') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Mi Timesheet</font> </h5>

	<div class="card card-body">
		<div class="row">
            <div class="w-100 text-right">
                <button class="btn btn-primary" style="background-color: #61CB5C; border:none !important;" id="btn_aprobado">Aprobadas</button>
                <button class="btn btn-primary" style="background-color: #EA7777; border:none !important;" id="btn_rechazado">Rechazadas</button>
                <button class="btn btn-primary" style="background-color: #F48C16; border:none !important;" id="btn_pendiente">Pendientes</button>
            </div>
			
	        <div class="datatable-fix w-100 mt-4">
	            <table id="datatable_timesheet" class="table w-100">
	                <thead class="w-100">
	                    <tr>
	                        <th>Fin de semana </th>
	                        <th>Empleado</th>
	                        <th>Responsable</th>
                            <th>Aprobación</th>
	                        {{-- <th>opciones</th> --}}
	                    </tr>
	                </thead>

	                <tbody>
                        @foreach($times as $time)
                            @php
                                if($time->aprobado){
                                    $class_tr = 'aprobado';
                                }
                                if($time->rechazado){
                                    $class_tr = 'rechazado';
                                }
                                if(($time->rechazado == false) && ($time->aprobado == false)){
                                    $class_tr = 'pendiente';
                                }
                            @endphp
    	                	<tr class="tr_{{ $class_tr }}">
    	                        <td>
    	                            {{ $time->fecha_dia }} 
    	                        </td>
    	                        <td>
    	                            {{ $time->empleado->name }}
    	                        </td>
    	                        <td>
                                    {{ $time->aprobador->name }}
    	                        </td>
    	                        <td>
                                    @if($time->aprobado)
                                        <span class="aprobada">Aprobada</span>
                                    @endif

                                    @if($time->rechazado)
                                        <span class="rechazada">Rechazada</span>
                                    @endif

                                    @if(($time->rechazado == false) && ($time->aprobado == false))
                                        <span class="pendiente">Pendiente</span>
                                    @endif
    	                        </td>
    	                        {{-- <td>
    	                        	<a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" class="btn">ver</a>
    							</td>	 --}}                    
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
            let table = $('#datatable_timesheet').DataTable(dtOverrideGlobals);
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

    <script type="text/javascript">
        $('#btn_aprobado').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_aprobado').removeClass('d-none');

            $('.btn-primary').removeClass('btn_op');
            $('#btn_aprobado').addClass('btn_op');
        });

        $('#btn_rechazado').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_rechazado').removeClass('d-none');

            $('.btn-primary').removeClass('btn_op');
            $('#btn_rechazado').addClass('btn_op');
        });

        $('#btn_pendiente').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_pendiente').removeClass('d-none');

            $('.btn-primary').removeClass('btn_op');
            $('#btn_pendiente').addClass('btn_op');
        });
    </script>
@endsection
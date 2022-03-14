@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">
    
    <style type="text/css">
        .btn_op{
            opacity: 1 !important;
        }
        .btn-primary{
            opacity: 0.6;
        }
    </style>


     {{ Breadcrumbs::render('timesheet-index') }}
	
	<h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Mis Registros</font> </h5>

	<div class="card card-body">
		<div class="row">
            @include('partials.flashMessages')
            <div class="col-12 d-flex justify-content-between">
                <h5 id="titulo_estatus">Todos los Registros</h5>
                <div class="">
                    <button class="btn btn-primary" style="background-color: ; border:none !important;" id="btn_todos">Todos</button>
                    <button class="btn btn-primary" style="background-color: #aaa; border:none !important;" id="btn_papelera">Borrador</button>
                    <button class="btn btn-primary" style="background-color: #F48C16; border:none !important;" id="btn_pendiente">Pendientes</button>
                    <button class="btn btn-primary" style="background-color: #61CB5C; border:none !important;" id="btn_aprobado">Aprobados</button>
                    <button class="btn btn-primary" style="background-color: #EA7777; border:none !important;" id="btn_rechazado">Rechazados</button>
                </div>
			</div>

	        <div class="datatable-fix w-100 mt-4">
	            <table id="datatable_timesheet" class="table w-100">
	                <thead class="w-100">
	                    <tr>
	                        <th>Fin de semana </th>
	                        <th>Empleado</th>
	                        <th>Responsable</th>
                            <th>Aprobación</th>
	                        <th>opciones</th>
	                    </tr>
	                </thead>

	                <tbody>
                        @foreach($times as $time)
    	                	<tr class="tr_{{  $time->estatus }}">
    	                        <td>
                                    @if($time->dia_semana == 'Domingo')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->addDay(6)->format("d/m/Y") }}
                                    @endif
                                    @if($time->dia_semana == 'Lunes')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->subDay(1)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->addDay(5)->format("d/m/Y") }}
                                    @endif
                                    @if($time->dia_semana == 'Martes')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->subDay(2)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->addDay(4)->format("d/m/Y") }}
                                    @endif
                                    @if($time->dia_semana == 'Miércoles')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->subDay(3)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->addDay(3)->format("d/m/Y") }}
                                    @endif
                                    @if($time->dia_semana == 'Jueves')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->subDay(4)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->addDay(2)->format("d/m/Y") }}
                                    @endif
                                    @if($time->dia_semana == 'Viernes')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->subDay(5)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->addDay(1)->format("d/m/Y") }}
                                    @endif
                                    @if($time->dia_semana == 'Sábado')
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->subDay(6)->format("d/m/Y") }}
                                         -  
                                        {{  \Carbon\Carbon::parse($time->fecha_dia)->format("d/m/Y") }}
                                    @endif
    	                        </td>
    	                        <td>
    	                            {{ $time->empleado->name }}
    	                        </td>
    	                        <td>
                                    {{ $time->aprobador->name }}
    	                        </td>
    	                        <td>
                                    @if($time->estatus == 'aprobado')
                                        <span class="aprobado">Aprobada</span>
                                    @endif

                                    @if($time->estatus == 'rechazado')
                                        <span class="aprobado">Rechazada</span>
                                    @endif

                                    @if($time->estatus == 'pendiente')
                                        <span class="pendiente">Pendiente</span>
                                    @endif

                                    @if($time->estatus == 'papelera')
                                        <span class="papelera">Borrador</span>
                                    @endif
    	                        </td>
    	                        <td>
                                    <a href="{{ asset('admin/timesheet/show') }}/{{ $time->id }}" title="Visualizar" class="btn"><i class="fa-solid fa-eye"></i></a>

                                    @if(($time->estatus == 'papelera') || ($time->estatus == 'rechazado'))
                                        <a href="{{ asset('admin/timesheet/edit') }}/{{ $time->id }}" title="Visualizar" class="btn"><i class="fa-solid fa-pen-to-square"></i></a>
                                    @endif

                                    {{-- <a href="{{ route('admin.timesheet.destroy', $time->id) }}" class="btn" style="color:red;"><i class="fa-solid fa-trash-can"></i></a> --}}
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
        $('#btn_todos').click(function(){
            $('tr').removeClass('d-none');

            document.getElementById('titulo_estatus').innerHTML = 'Todos los Registros';

            $('.btn-primary').removeClass('btn_op');
            $('#btn_todos').addClass('btn_op');
        });

        $('#btn_aprobado').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_aprobado').removeClass('d-none');

            document.getElementById('titulo_estatus').innerHTML = 'Registros Aprobados';

            $('.btn-primary').removeClass('btn_op');
            $('#btn_aprobado').addClass('btn_op');
        });

        $('#btn_papelera').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_papelera').removeClass('d-none');

            document.getElementById('titulo_estatus').innerHTML = 'Registros en Borrador';

            $('.btn-primary').removeClass('btn_op');
            $('#btn_papelera').addClass('btn_op');
        });

        $('#btn_rechazado').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_rechazado').removeClass('d-none');

            document.getElementById('titulo_estatus').innerHTML = 'Registros Rechazados por el Aprobador';

            $('.btn-primary').removeClass('btn_op');
            $('#btn_rechazado').addClass('btn_op');
        });

        $('#btn_pendiente').click(function(){
            $('tbody tr').addClass('d-none');
            $('.tr_pendiente').removeClass('d-none');

            document.getElementById('titulo_estatus').innerHTML = 'Registros Pendientes de Aprobación';

            $('.btn-primary').removeClass('btn_op');
            $('#btn_pendiente').addClass('btn_op');
        });
    </script>
@endsection
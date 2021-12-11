@extends('layouts.admin')
@section('content')

	<div class="mt-5 card">
	    <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
	        <h3 class="mb-2 text-center text-white"><strong>Archivo de Actividades</strong></h3>
	    </div>
		
		<div class="card-body">
			<div class="row px-3">
					
				<div class="datatable-fix" style="width: 100%;">
				    <div class="mb-3 text-right">
				        <a class="btn btn-danger" href="{{asset('admin/inicioUsuario#actividades')}}">Regresar</a>
				    </div>

				   <table class="table tabla_archi">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Origen</th>
                                {{-- <th>Categoria</th> --}}
                                {{-- <th>Urgencia</th> --}}
                                <th style="min-width:200px;">Fecha&nbsp;inicio</th>
                                <th style="min-width:200px;">Fecha&nbsp;fin</th>
                                {{-- <th>Asignada por</th> --}}
                                <th>Estatus</th>
                                <th>Recuperar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actividades as $task)
                                @if($task->archivo == 'archivado')
                                    <tr id="{{ $task->id }}" data-parent-plan="{{ $task->slug }}">
                                        <td class="td_nombre">{{ $task->name }}</td>
                                        <td><span class="badge badge-primary">{{ $task->parent }}</span></td>
                                        {{-- <td>Categoria</td> --}}
                                        {{-- <td>Urgencia</td> --}}
                                        <td>{{ \Carbon\Carbon::createFromTimestamp($task->start / 1000)->toDateTime()->format('Y-m-d') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp($task->end / 1000)->toDateTime()->format('Y-m-d') }}
                                        </td>
                                        
                                        {{-- <td>Asignada por</td> --}}
                                        <td>
                                            @switch($task->status)
                                                @case('STATUS_ACTIVE')
                                                    <span class="badge" style="background-color:rgb(253, 171, 61)">En proceso</span>
                                                @break
                                                @case('STATUS_DONE')
                                                    <span class="badge" style="background-color:rgb(0, 200, 117)">Completada</span>
                                                @break
                                                @case ('STATUS_FAILED')
                                                    <span class="badge" style="background-color:rgb(226, 68, 92)">Con retraso</span>
                                                @break
                                                @case ('STATUS_SUSPENDED')
                                                    <span class="badge" style="background-color:#aaaaaa">Suspendida</span>
                                                @break
                                                @case ('STATUS_UNDEFINED')
                                                    <span class="badge" style="background-color:#00b1e1">Sin iniciar</span>
                                                @break
                                                @default
                                                    <span class="badge" style="background-color:#00b1e1">Sin iniciar</span>
                                            @endswitch
                                        </td>
                                        <td class="d-flex">
                                            <form action="{{route('admin.inicio-Usuario.actividades.recuperar', $task->id_implementacion)}}" method="POST">
                                                @csrf
                                                <button class="btn" title="Recuperar" style="all: unset !important;">
                                                    <i class="fas fa-sign-in-alt" style="font-size: 20pt; color:#00abb2;"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
				</div>

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
            let table = $('.tabla_archi').DataTable(dtOverrideGlobals);
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
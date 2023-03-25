@extends('layouts.admin')
@section('content')

	<div class="mt-5 card">
	    <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
	        <h3 class="mb-2 text-center text-white"><strong>Archivo de Aprobaciones</strong></h3>
	    </div>
		
		<div class="card-body">
			<div class="row px-3">

                <div class=" col-12 px-1 py-2 mb-4 rounded " style="background-color: #DBEAFE; border-top:solid 3px #3B82F6; margin: auto;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección encontrará las aprobaciónes que han sido archivadas.
                            </p>

                        </div>
                    </div>
                </div>
					
				<div class="datatable-fix" style="width: 100%;">
				    <div class="mb-3 text-right">
				        <a class="btn btn-danger" href="{{asset('admin/inicioUsuario#capacitaciones')}}">Regresar</a>
				    </div>

				   <table class="table tabla_archi">
				   		<thead>
				            <tr>
                                <th style="vertical-align: top">
                                    Código&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </th>
                                <th style="vertical-align: top">
                                    Nombre
                                </th>
                                <th style="vertical-align: top">
                                    Tipo
                                </th>

                                <th style="vertical-align: top">
                                    Vinculado&nbsp;a
                                </th>
                                <th style="vertical-align: top">
                                    Estatus
                                </th>
                                <th style="vertical-align: top">
                                    Versión
                                </th>
                                <th style="vertical-align: top; min-width:200px;">
                                    Fecha&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </th>
                                <th style="vertical-align: top">
                                    Elaboró
                                </th>
                                <th style="vertical-align: top">
                                    Revisó
                                </th>
                                <th style="vertical-align: top">
                                    Aprobó
                                </th>
                                <th style="vertical-align: top">
                                    Responsable
                                </th>
                                <th style="vertical-align: top">
                                    Recuperar
                                </th>
                            </tr>
				   		</thead>
				   		<tbody>
                			@foreach ($mis_documentos as $documento)
                                @if($documento->archivo == 'archivado')
                                    <tr>
                                        <td>
                                            {{ $documento->codigo ?? '' }}
                                        </td>
                                        <td>
                                            {{ $documento->nombre ?? '' }}
                                        </td>
                                        <td style="text-transform: capitalize">
                                            {{ $documento->tipo ?? '' }}
                                        </td>
                                        @if ($documento->proceso_id == null)
                                            <th style="vertical-align: top">
                                                {{ $documento->macroproceso ? $documento->macroproceso->nombre : 'Sin vincular' }}
                                            </th>
                                        @else
                                            <th style="vertical-align: top">
                                                {{ $documento->proceso ? $documento->proceso->nombre : 'Sin vincular' }}
                                            </th>
                                        @endif
                                        <td>
                                            @if ($documento->estatus)
                                                @switch($documento->estatus)
                                                    @case(1)
                                                        <span class="badge badge-info">EN ELABORACIÓN</span>
                                                    @break
                                                    @case(2)
                                                        <span class="badge badge-primary">EN REVISIÓN</span>
                                                    @break
                                                    @case(3)
                                                        <span class="badge badge-success">PUBLICADO</span>
                                                    @break
                                                    @case(4)
                                                        <span class="badge badge-danger">RECHAZADO</span>
                                                    @break
                                                    @default
                                                        <span class="badge badge-info">EN ELABORACIÓN</span>
                                                @endswitch

                                            @endif
                                        </td>
                                        <td>
                                            {{ $documento->version == 0 ? 'Sin versión actualmente' : $documento->version }}
                                        </td>
                                        <td>
                                            {{ $documento->fecha_dmy ?? '' }}
                                        </td>
                                        <td>
                                            @if ($documento->elaborador)
                                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->elaborador->avatar }}"
                                                    class="rounded-circle" alt="{{ $documento->elaborador->name }}"
                                                    title="{{ $documento->elaborador->name }}" width="40">
                                            @else
                                                <span class="badge badge-info">Sin Asignar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($documento->revisor)
                                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->revisor->avatar }}"
                                                    class="rounded-circle" alt="{{ $documento->revisor->name }}"
                                                    title="{{ $documento->revisor->name }}" width="40">
                                            @else
                                                <span class="badge badge-info">Sin Asignar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($documento->aprobador)
                                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->aprobador->avatar }}"
                                                    class="rounded-circle" alt="{{ $documento->aprobador->name }}"
                                                    title="{{ $documento->aprobador->name }}" width="40">
                                            @else
                                                <span class="badge badge-info">Sin Asignar</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($documento->responsable)
                                                <img src="{{ asset('storage/empleados/imagenes/') . '/' . $documento->responsable->avatar }}"
                                                    class="rounded-circle" alt="{{ $documento->responsable->name }}"
                                                    title="{{ $documento->responsable->name }}" width="40">
                                            @else
                                                <span class="badge badge-info">Sin Asignar</span>
                                            @endif
                                        </td>
                                        <td>
                                           <form action="{{route('admin.inicio-Usuario.aprobacion.recuperar', $documento->id)}}" method="POST">
                                                @csrf
                                                <button class="btn" title="Recuperar" style="all: unset !important;">
                                                    <i class="fas fa-sign-in-alt" style="font-size: 20pt; color:#345183;"></i>
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
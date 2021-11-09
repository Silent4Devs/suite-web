@extends('layouts.frontend')
@section('content')
	<div class="pl-4 pr-4 mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Archivo Incidentes de Seguridad</strong></h3>
        </div>

	<div class="datatable-fix" style="width: 100%;">

	  	<table class="table tabla_incidentes_seguridad">
	   		<thead>
	   			<tr>
	       			<th>ID</th>
	       			<th>Folio</th>
	       			<th>Título</th>
	       			<th>Descripción</th>
	       			<th>Activos, Afectados</th>
	       			<th>Fecha</th>
	       			<th>Quién reporto</th>
	       			<th>Correo</th>
	       			<th>Teléfono</th>
	       			<th>Categoría</th>
	       			<th>Calificación</th>
	       			<th>Prioridad</th>
	       			<th>Estatus</th>
	       			<th>Asigando a</th>
	       			<th>Comentarios</th>
	       			<th>Opciones</th>
	   			</tr>
	   		</thead>
	   		<tbody>
	   			@foreach($incidentes_seguridad_archivados as $incidentes)
		   			<tr>
		       			<td>{{ $incidentes->id }}</td>
		       			<td>{{ $incidentes->folio }}</td>
		       			<td>{{ $incidentes->titulo }}</td>
		       			<td>{{ $incidentes->descripción }}</td>
		       			<td>{{ $incidentes->activos_afectados }}</td>
		       			<td>{{ $incidentes->fecha }}</td>
		       			<td>{{ $incidentes->reporto->name }}</td>
		       			<td>{{ $incidentes->reporto->email }}</td> {{-- correo --}}
		       			<td>{{ $incidentes->reporto->telefono }}</td> {{-- telefono --}}
		       			<td>{{ $incidentes->categoria }}</td>
		       			<td>{{ $incidentes->clacificacion }}</td>
		       			<td>{{ $incidentes->prioridad }}</td>
		       			<td>{{ $incidentes->estatus }}</td>
		       			<td>{{ $incidentes->asignado ? $incidentes->asignado->name:'sin asignar'}}</td>
		       			<td>{{ $incidentes->comentarios }}</td>
		       			<td>
		       				<a href="{{ route('desk.seguridad-edit', $incidentes->id) }}"><i class="fas fa-edit"></i></a>
		       			</td>
		   			</tr>
	   			@endforeach
	   		</tbody>
	   </table>
	</div>

@endsection
@section('scripts')
@parent

    <script type="text/javascript">
        $(document).ready(function(){
            let dtButtons = [{
                        extend: 'csvHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar CSV',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
                        text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                        className: "btn-sm rounded pr-2",
                        titleAttr: 'Exportar Excel',
                        exportOptions: {
                            columns: ['th:not(:last-child):visible']
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
                        title: `Cursos y Capacitaciones ${new Date().toLocaleDateString().trim()}`,
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
            $(".tabla_incidentes_seguridad").DataTable({
                buttons: dtButtons,
            });
        });
    </script>
@endsection

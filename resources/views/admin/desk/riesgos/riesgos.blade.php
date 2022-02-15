<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_riesgos }}</div>
            <div>Riesgos</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_riesgos }}</div>
            <div>Nuevos</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_riesgos }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_riesgos }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_riesgos }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_riesgos }}</div>
            <div>Cancelados</div>
        </div>
    </div>
</div>

<div class="datatable-fix" style="width: 100%;">
    <div class="mb-3 text-right">
        <a class="btn btn-danger" href="{{asset('admin/inicioUsuario/reportes/riesgos')}}">Crear reporte</a>
    </div>

   <table class="table tabla_riesgos">
   		<thead>
            <tr>
       			<th>Folio</th>
       			<th style="min-width:200px;">Título</th>
                <th style="min-width:200px;">Fecha de identificación</th>
                <th style="min-width:200px;">Fecha de recepción del reporte</th>
                <th style="min-width:200px;">Fecha de cierre</th>
       			<th style="min-width: 500px;">Descripción</th>
                <th style="min-width: 500px;">Comentarios</th>
                <th style="min-width:200px;">Estatus</th>
                <th style="min-width:200px;">Sede</th>
                <th style="min-width:200px;">Ubicación</th>
       			<th style="min-width:200px;">Procesos afectados</th>
                <th style="min-width:200px;">Áreas afectadas</th>
                <th style="min-width:200px;">Activos afectados</th>
       			<th style="min-width: 500px;">Fecha</th>
       			<th style="min-width:200px;">Quién reportó</th>
       			<th style="min-width:200px;">Correo</th>
       			<th style="min-width:200px;">Teléfono</th>
       			<th>Opciones</th>
            </tr>
   		</thead>
   		<tbody>
   			@foreach($riesgos_identificados as $riesgo)
	   			<tr>
	       			<td>{{ $riesgo->folio }}</td>
	       			<td>{{ $riesgo->titulo}}</td>
                    <td>{{ $riesgo->fecha_creacion}}</td>
                    <td>{{ $riesgo->fecha_reporte}}</td>
                    <td>{{ $riesgo->fecha_de_cierre}}</td>
                    <td>{{ $riesgo->descripcion }}</td>
                    <td>{{ $riesgo->comentarios }}</td>
                    <td>{{ $riesgo->estatus }}</td>
                    <td>{{ $riesgo->sede }}</td>
                    <td>{{ $riesgo->ubicacion }}</td>
	       			<td>{{ $riesgo->procesos_afectados }}</td>
                    <td>{{ $riesgo->areas_afectados }}</td>
                    <td>{{ $riesgo->activos_afectados }}</td>
	       			<td>{{ $riesgo->fecha }}</td>
	       			<td>
                        <img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/{{ $riesgo->reporto->avatar }}" title="{{ $riesgo->reporto->name }}">
                    </td>
	       			<td>{{ $riesgo->reporto->email }}</td>
	       			<td>{{ $riesgo->reporto->telefono }}</td>
	       			<td>
	       				<a href="{{ route('admin.desk.riesgos-edit', $riesgo->id) }}"><i class="fas fa-edit"></i></a>
	       			</td>
	   			</tr>
   			@endforeach
   		</tbody>
   </table>
</div>


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
                url: "{{asset('admin/inicioUsuario/reportes/riesgos')}}",
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
            let table = $('.tabla_riesgos').DataTable(dtOverrideGlobals);
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

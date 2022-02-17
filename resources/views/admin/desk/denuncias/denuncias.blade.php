<div class="row">
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-celeste">
            <div class="numero"><i class="fas fa-exclamation-triangle"></i> {{ $total_denuncias }}</div>
            <div>Denuncias</div>
        </div>
    </div>
    <div class="col-6 col-md-2 ">
        <div class="tarjetas_seguridad_indicadores cdr-amarillo">
            <div class="numero"><i class="far fa-arrow-alt-circle-right"></i> {{ $nuevos_denuncias }}</div>
            <div>Sin atender</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-morado">
            <div class="numero"><i class="fas fa-redo-alt"></i> {{ $en_curso_denuncias }}</div>
            <div>En curso</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-azul">
            <div class="numero"><i class="fas fa-history"></i> {{ $en_espera_denuncias }}</div>
            <div>En espera</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-verde">
            <div class="numero"><i class="far fa-check-circle"></i> {{ $cerrados_denuncias }}</div>
            <div>Cerrados</div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="tarjetas_seguridad_indicadores cdr-rojo">
            <div class="numero"><i class="far fa-circle"></i> {{ $cancelados_denuncias }}</div>
            <div>Cancelados</div>
        </div>
    </div>
</div>
<div class="datatable-fix" style="width:100%">
    <div class="mb-3 text-right">
        <a class="btn btn-danger" href="{{asset('admin/inicioUsuario/reportes/denuncias')}}">Crear reporte</a>
    </div>

   <table class="table tabla_denuncias">
   		<thead>
            <tr>
                <th colspan="6"></th>
                <th colspan="3" style="text-align:center; border:1px solid #ccc;">Denuncio</th>
                <th colspan="3" style="text-align:center; border:1px solid #ccc;">Denunciado</th>
            </tr>
   			<tr>
       			<th>Folio</th>
       			<th>Anónimo</th>
                <th style="min-width:200px;">Estatus</th>
                <th style="min-width:200px;">Fecha de identificación</th>
                <th style="min-width:200px;">Fecha de recepción</th>
                <th style="min-width:200px;">Fecha de cierre</th>
                <th style="min-width:200px;">Nombre</th>
                <th style="min-width:200px;">Puesto</th>
                <th style="min-width:200px;">Área</th>
                <th style="min-width:200px;">Nombre</th>
                <th style="min-width:200px;">Puesto</th>
                <th style="min-width:200px;">Área</th>
                <th style="min-width: 500px;">Descripción</th>
       			<th>Opciones</th>
   			</tr>
   		</thead>
   		<tbody>
   			@foreach($denuncias as $denuncia)
	   			<tr>
	       			<td>{{ $denuncia->folio }}</td>
	       			<td>{{ $denuncia->anonimo }}</td>
                    <td>{{ $denuncia->estatus }}</td>
                    <td>{{ $denuncia->fecha_creacion }}</td>
                    <td>{{ $denuncia->fecha_reporte }}</td>
                    <td>{{ $denuncia->fecha_de_cierre }}</td>
                    @if($denuncia->anonimo == 'no')
                        <td>
                            <img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/{{ $denuncia->denuncio->avatar }}" title="{{ $denuncia->denuncio->name }}">
                        </td>
                        <td>{{ $denuncia->denuncio->puesto }}</td>
                        <td>{{ $denuncia->denuncio->area->area }}</td>
                    @else
                        <td> -- </td>
                        <td> -- </td>
                        <td> -- </td>
                    @endif
                    <td>
                        <img class="img_empleado" src="{{ asset('storage/empleados/imagenes/') }}/{{ $denuncia->denunciado->avatar }}" title="{{ $denuncia->denunciado->name }}">
                    </td>
                    <td>{{ $denuncia->denunciado->area->area }}</td>
                    <td>{{ $denuncia->denunciado->puesto }}</td>
                    <td>{{ $denuncia->descripcion }}</td>
	       			<td><a href="{{ route('admin.desk.denuncias-edit', $denuncia->id) }}"><i class="fas fa-edit"></i></a></td>
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
                url: "{{asset('admin/inicioUsuario/reportes/denuncias')}}",
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
            let table = $('.tabla_denuncias').DataTable(dtOverrideGlobals);
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

<div class="card-body datatable-fix">
    <table id="tabla_usuario_capacitaciones" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Instructor</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Calificación</th>
                <th>Estatus</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recursos as $recurso)
            <tr>
                <td>{{$recurso->cursoscapacitaciones}}</td>
                <td>{{$recurso->categoria_capacitacion_id}}</td>
                <td>{{$recurso->instructor}}</td>
                <td>{{$recurso->fecha_curso}}</td>
                <td>{{$recurso->fecha_fin}}</td>
                <td>
                    @foreach ($recurso->empleados as $empleado) 
                        {{ $empleado->pivot->calificacion }}
                    @endforeach
                </td>
                <td>
                    @foreach ($recurso->empleados as $empleado) 
                        {{ $empleado->estatus }}
                    @endforeach
                </td>
                <td class="opciones_iconos">
                    <i class="fas fa-trash-alt"></i>
                    <i class="fas fa-file-alt"></i>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


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
            $("#tabla_usuario_capacitaciones").DataTable({
                buttons: dtButtons,
            });
        });
    </script>
@endsection
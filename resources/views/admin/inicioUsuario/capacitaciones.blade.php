<div class="card-body datatable-fix">
    <table id="tabla_usuario_capacitaciones" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Instructor</th>
                <th style="min-width:200px;">Fecha Inicio</th>
                <th style="min-width:200px;">Fecha Fin</th>
                <th>Calificación</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($recursos as $recurso)
            <tr>

                <td>{{$recurso->cursoscapacitaciones}}</td>
                <td>{{$recurso->categoria_capacitacion->nombre}}</td>
                <td>{{$recurso->instructor}}</td>
                <td>{{$recurso->fecha_curso}}</td>
                <td>{{$recurso->fecha_fin}}</td>
                <td>
                    @foreach ($recurso->empleados as $empleado)
                        @if($empleado->id == auth()->user()->empleado->id)
                        {{ $empleado->pivot->calificacion }}
                        @endif
                    @endforeach
                </td>
                <td class="opciones_iconos">
                    <form>
                    <button onclick="archivarCapacitacion('{{auth()->user()->empleado->id}}', '{{$recurso->id}}', '{{route('admin.inicio-Usuario.capacitaciones.archivar')}}')" class="">
                        <i class="fas fa-archive"></i>
                    </button>
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


            window.archivarCapacitacion = function(id_empleado, recurso_id, url){
                Swal.fire({
                  title: 'Are you sure?',
                  text: "You won't be able to revert this!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                  if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: url,
                        data: {
                            id_empleado, recurso_id
                        },
                        dataType: "JSON",
                        beforeSend: function() {
                            let timerInterval
                            Swal.fire({
                                title: 'Archivando...',
                                html: 'Estamos archivando su capacitacion',
                                timer: 4000,
                                timerProgressBar: true,
                                didOpen: () => {
                                    Swal.showLoading()
                                    timerInterval = setInterval(() => {
                                        const content = Swal
                                            .getHtmlContainer()
                                        if (content) {
                                            const b = content
                                                .querySelector('b')
                                            if (b) {
                                                b.textContent = Swal
                                                    .getTimerLeft()
                                            }
                                        }
                                    }, 100)
                                },
                                willClose: () => {
                                    clearInterval(timerInterval)
                                }
                            });
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    '¡Archivado!',
                                    'Su revisión ha sido archivada',
                                    'success'
                                )
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1000);
                            } else {
                                Swal.fire(
                                    'Erro al archivar!',
                                    'Ocurrió un error',
                                    'error'
                                )
                            }
                        },
                        error: function(err) {
                            Swal.fire(
                                'Error!',
                                `${err}`,
                                'error'
                            )
                        }
                    });
                  }
                });
            }
        });
    </script>
@endsection

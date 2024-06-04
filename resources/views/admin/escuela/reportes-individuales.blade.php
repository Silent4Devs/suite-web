@extends('layouts.admin')
@section('content')
    <style>
        table.dataTable {
            margin: 0px !important;
        }
    </style>
    <h5 class="titulo_general_funcion">Cursos</h5>

    <div class="card card-body">
        <div class="datatable-fix datatable-rds">
            <h3 class="title-table-rds"> Reporte individual </h3>

            <table class="table datatable-reportes-individuales">
                <thead>
                    <tr>
                        <th>Colaborador</th>
                        <th>Avance del curso</th>
                        <th>Sección evaluada</th>
                        <th>Calificación gral.</th>
                        <th>Fecha de evaluacón</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos_usuario as $cu)
                        @if ($cu->usuarios)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-1 mt-2">
                                        <div class="img-person">
                                            <img src="{{ $cu->usuarios->avatar_ruta }}" alt="{{ $cu->usuarios->name }}">
                                        </div>
                                        <span class="course-teacher"> {{ $cu->usuarios->name }} </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <div class="progress w-100">
                                            <div class="progress-bar bg-warning" role="progressbar"
                                                style="width: {{ $cu->advance }}%" aria-valuenow="{{ $cu->advance }}"
                                                aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small> {{ $cu->advance }} </small>
                                    </div>
                                </td>
                                <td>
                                    <span>Sección {{ $cu->cursos->lessons->count() }}</span> <br>
                                    <span></span>
                                </td>
                                <td>
                                    {{ $cu->calificacion }}
                                </td>
                                <td>{{ Carbon\Carbon::parse($cu->cursos->created_at)->format('d/m/Y') }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(function() {
            let dtButtons = [{
                    extend: 'csvHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,

                    text: '<i class="fas fa-file-csv" style="font-size: 1.1rem; color:#3490dc"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar CSV',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'excelHtml5',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-file-excel" style="font-size: 1.1rem;color:#0f6935"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Exportar Excel',
                    exportOptions: {
                        columns: ['th:not(:last-child):visible'],
                        orthogonal: "empleadoText"

                    }
                },
                {
                    extend: 'print',
                    title: `Comite Seguridad ${new Date().toLocaleDateString().trim()}`,
                    text: '<i class="fas fa-print" style="font-size: 1.1rem;"></i>',
                    className: "btn-sm rounded pr-2",
                    titleAttr: 'Imprimir',
                    customize: function(doc) {
                        let logo_actual = @json($logo_actual);
                        let empresa_actual = @json($empresa_actual);

                        var now = new Date();
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now
                            .getFullYear();
                        $(doc.document.body).prepend(`
                        <div class="row mt-5 mb-4 col-12 ml-0" style="border: 2px solid #ccc; border-radius: 5px">
                            <div class="col-2 p-2" style="border-right: 2px solid #ccc">
                                    <img class="img-fluid" style="max-width:120px" src="${logo_actual}"/>
                                </div>
                                <div class="col-7 p-2" style="text-align: center; border-right: 2px solid #ccc">
                                    <p>${empresa_actual}</p>
                                    <strong style="color:#345183">CONFORMACIÓN DEL COMITÉ</strong>
                                </div>
                                <div class="col-3 p-2">
                                    Fecha: ${jsDate}
                                </div>
                            </div>
                        `);

                        $(doc.document.body).find('table')
                            .css('font-size', '12px')
                            .css('margin-top', '15px')
                        // .css('margin-bottom', '60px')
                        $(doc.document.body).find('th').each(function(index) {
                            $(this).css('font-size', '18px');
                            $(this).css('color', '#fff');
                            $(this).css('background-color', 'blue');
                        });
                    },
                    title: '',
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

            let dtOverrideGlobals = {
                buttons: dtButtons,
                retrieve: true,
                order: [
                    [0, 'desc']
                ],
            };

            let table = $('.datatable-reportes-individuales').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

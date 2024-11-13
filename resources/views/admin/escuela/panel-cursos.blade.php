@extends('layouts.admin')
@section('content')
    <h5 class="titulo_general_funcion">Panel de Cursos</h5>

    <div class="card card-body">
        <div class="datatable-fix datatable-rds">
            <h3 class="title-table-rds"> Cursos generados </h3>

            <table class="table datatable-panel-cursos">
                <thead>
                    <tr>
                        <th>Nombre del curso</th>
                        <th>Nombre del creador</th>
                        <th>Nombre del Instructor</th>
                        <th>Matriculados</th>
                        <th>Calificación</th>
                        <th>Estatus</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cursos as $curso)
                        <tr>
                            <td>{{ $curso->title }}</td>
                            <td>{{ $curso->instructor ? $curso->instructor->name : '' }}</td>
                            <td>{{ $curso->instructor ? $curso->instructor->name : '' }}</td>
                            <td>{{ $curso->students->count() }}</td>
                            <td>
                                <div class="d-flex">
                                    <p>
                                        ({{ $curso->rating }})
                                    </p>
                                    <div>
                                        <ul class="d-flex px-2" style="list-style: none;">
                                            <li class="mr-1">
                                                <i class="fas fa-star"
                                                    style="color: {{ $curso->rating >= 1 ? '#E3A008' : 'gray' }}; font-size: 18px;">
                                                </i>
                                            </li>
                                            <li class="mr-1">
                                                <i class="fas fa-star"
                                                    style="color: {{ $curso->rating >= 2 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                            </li>
                                            <li class="mr-1">
                                                <i class="fas fa-star"
                                                    style="color: {{ $curso->rating >= 3 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                            </li>
                                            <li class="mr-1">
                                                <i class="fas fa-star"
                                                    style="color: {{ $curso->rating >= 4 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                            </li>
                                            <li class="mr-1">
                                                <i class="fas fa-star"
                                                    style="color: {{ $curso->rating >= 5 ? '#E3A008' : 'gray' }}; font-size: 18px;"></i>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <p>Valoración del curso</p>
                            </td>
                            <td>
                                @switch($curso->status)
                                    @case(1)
                                        <span class="bg-warning p-2 rounded-lg" style="color: #a74b00;">
                                            Borrador
                                        </span>
                                    @break

                                    @case(2)
                                        <span class="bg-info color-white p-2 rounded-lg">
                                            Revisión
                                        </span>
                                    @break

                                    @case(3)
                                        <span class="bg-success color-white p-2 rounded-lg">
                                            Publicado
                                        </span>
                                    @break

                                    @case(4)
                                        <span class="bg-secondary color-white p-2 rounded-lg">
                                            Cerrado
                                        </span>
                                    @break

                                    @default
                                @endswitch
                            </td>
                            <td class="px-6 py-4 text-sm font-medium text-right whitespace-nowrap">
                                <a href="{{ route('admin.courses.edit', $curso) }}" class="fas fa-edit mr-2" title="Editar"
                                    style="color:#747474"></a>
                                <a href="{{ route('admin.courses-reportes-individuales', $curso->id) }}"
                                    class="mr-2 fas fa-file-alt" title="Reportes" style="color:#747474"></a>
                            </td>
                        </tr>
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
                        var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
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
                order: [
                    [0, 'desc']
                ],
            };

            let table = $('.datatable-panel-cursos').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('riesgo-archivo') }} --}}
    <div class="pl-4 pr-4 mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Archivo Quejas Clientes</strong></h3>
        </div>

        <div class="datatable-fix" style="width: 100%;">

            <table class="table tabla_quejas">
                <thead>
                    <tr>
                        <th>Folio</th>
                        <th style="min-width:200px;">Cliente</th>
                        <th style="min-width:200px;">Proyecto</th>
                        <th style="min-width:200px;">Nombre</th>
                        <th style="min-width:200px;">Puesto</th>
                        <th style="min-width:200px;">Teléfono</th>
                        <th style="min-width:200px;">Correo</th>
                        <th style="min-width:200px;">Estatus</th>
                        <th style="min-width:200px;">Fecha de identificación</th>
                        <th style="min-width:200px;">Fecha de cierre</th>
                        <th style="min-width:200px;">Ubicación</th>
                        <th style="min-width:200px;">Área</th>
                        <th style="min-width: 500px;">Descripción</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quejas as $queja)
                        <tr>
                            <td>{{ $queja->folio }}</td>
                            <td>{{ $queja->cliente->nombre}}</td>
                            <td>{{ $queja->proyectos->proyecto}}</td>
                            <td>{{ $queja->nombre }}</td>
                            <td>{{ $queja->puesto }}</td>
                            <td>{{ $queja->telefono }}</td>
                            <td>{{ $queja->correo }}</td>
                            <td>{{ $queja->estatus }}</td>
                            <td>{{ $queja->fecha }}</td>
                            <td>{{ $queja->fecha_cierre }}</td>
                            <td>{{ $queja->ubicacion }}</td>
                            <td>{{ $queja->area_quejado }}</td>
                            <td>{{ $queja->descripcion }}</td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('admin.desk.quejas-edit', $queja->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{route('admin.desk.quejaClientes-archivo.recuperar', $queja->id)}}" method="POST">
                                            @csrf
                                            <button class="btn" title="Recuperar" style="all: unset !important;">
                                                <i class="fas fa-sign-in-alt"></i>
                                            </button>
                                        </form>
                                    </div>

                                </div>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div><br>
        <div class="form-group"  style="text-align: right;">
            <a class="btn_cancelar" href="{{ route('admin.desk.index') }}">
                {{ trans('global.back_to_list') }}
            </a>
        </div>

    @endsection
    @section('scripts')
        @parent

        <script type="text/javascript">
            $(document).ready(function() {
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
                $(".tabla_quejas").DataTable({
                    buttons: dtButtons,
                });
            });
        </script>
    @endsection

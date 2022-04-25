@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('riesgo-archivo') }} --}}
    <div class="pl-4 pr-4 mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Archivo Riesgos</strong></h3>
        </div>

        <div class="datatable-fix" style="width: 100%;">

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
                    @foreach ($riesgos as $riesgo)
                        {{-- @if($incidentes->archivar == 'false') --}}
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
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="{{ route('admin.desk.riesgos-edit', $riesgo->id) }}"><i
                                                class="fas fa-edit"></i></a>
                                        </div>
                                        <div class="col-6">
                                            <form action="{{route('admin.desk.riesgo-archivo.recuperar', $riesgo->id)}}" method="POST">
                                                @csrf
                                                <button class="btn" title="Recuperar" style="all: unset !important;">
                                                    <i class="fas fa-sign-in-alt"></i>
                                                </button>
                                            </form>
                                        </div>

                                    </div>

                                </td>
                                {{-- <td class="opciones_iconos">
                                    <form action="{{route('admin.inicio-Usuario.capacitaciones.recuperar', $incidentes->id)}}" method="POST">
                                        @csrf
                                        <button class="btn" title="Recuperar" style="all: unset !important;">
                                            <i class="fas fa-sign-in-alt" style="font-size: 20pt; color:#345183;"></i>
                                        </button>
                                    </form>
                                </td> --}}
                            </tr>
			   			{{-- @endif --}}

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
                $(".tabla_riesgos").DataTable({
                    buttons: dtButtons,
                });
            });
        </script>
    @endsection

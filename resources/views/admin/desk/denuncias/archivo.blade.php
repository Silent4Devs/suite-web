@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('riesgo-archivo') }} --}}
    <div class="pl-4 pr-4 mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Archivo Denuncias</strong></h3>
        </div>

        <div class="datatable-fix" style="width: 100%;">

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
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="{{ route('admin.desk.denuncias-edit', $denuncia->id) }}"><i
                                            class="fas fa-edit"></i></a>
                                    </div>
                                    <div class="col-6">
                                        <form action="{{route('admin.desk.denuncia-archivo.recuperar', $denuncia->id)}}" method="POST">
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
                $(".tabla_denuncias").DataTable({
                    buttons: dtButtons,
                });
            });
        </script>
    @endsection

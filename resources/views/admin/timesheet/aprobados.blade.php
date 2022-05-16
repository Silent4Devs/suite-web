@extends('layouts.admin')
@section('content')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/timesheet.css') }}">

    {{ Breadcrumbs::render('timesheet-rechazos') }}

    <h5 class="col-12 titulo_general_funcion">TimeSheet: <font style="font-weight:lighter;">Aprobados</font></h5>

    <div class="card card-body">
        <div class="row">

            <div class="datatable-fix w-100">
                <table id="datatable_timesheet" class="table w-100">
                    <thead class="w-100">
                        <tr>
                            <th>Fin de semana </th>
                            <th>Empleado</th>
                            <th>Responsable</th>
                            <th>Aprobación</th>
                            <th>opciones</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($aprobados as $aprobado)
                            <tr>
                                <td>
                                    {!! $aprobado->semana !!}
                                </td>
                                <td>
                                    {{ $aprobado->empleado->name }}
                                </td>
                                <td>
                                    {{ $aprobado->aprobador->name }}
                                </td>
                                <td>
                                    <span class="{{ $aprobado->estatus }}">{{ $aprobado->estatus }}</span>
                                </td>
                                <td class="">
                                    @can('timesheet_administrador_aprobar_horas')
                                        <a href="{{ asset('admin/timesheet/show') }}/{{ $aprobado->id }}" title="Visualizar" class="btn"><i class="fa-solid fa-eye"></i></a>
                                        
                                        @if($aprobado->estatus == 'aprobado')
                                            <div class="btn" data-toggle="modal" data-target="#modal_rechazar_{{ $aprobado->id}}">
                                                <i class="fa-solid fa-calendar-xmark" style="color:#F05353; font-size: 15pt;"></i>
                                            </div>
                                        @endif
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @foreach ($aprobados as $aprobado)
        {{-- aprobar --}}
        <div class="modal fade" id="modal_rechazar_{{ $aprobado->id}}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="delete">
                            <div class="text-center">
                                <i class="fa-solid fa-calendar-xmark" style="color: #F05353; font-size:60pt;"></i>
                                <h1 class="my-4" style="font-size:14pt;">Rechazar Registro</h1>
                                <p class="parrafo">¿Está seguro que desea rechazar este registro?</p>
                            </div>
                            
                            <div class="mt-4">
                                <form action="{{ route('admin.timesheet-rechazar', ['id' => $aprobado->id]) }}" method="POST" class="row">
                                    @csrf
                                    <div class="form-group col-12">
                                        <label><i class="fa-solid fa-comment-dots iconos_crear"></i> Comentarios</label>
                                        <textarea class="form-control" name="comentarios"></textarea>
                                        <small>Escriba las razones por la que rechaza este registro.</small>
                                    </div>
                                    <div class="col-12 text-right">
                                        <button title="Rechazar" class="btn btn_cancelar" data-dismiss="modal">
                                            Cancelar
                                        </button>
                                        <button title="Rechazar" class="btn btn-info" style="border:none; background-color:#F05353;">
                                            <i class="fas fa-calendar-xmark iconos_crear"></i>
                                            Rechazar Registro
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

@endsection


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
                url: "{{ asset('admin/inicioUsuario/reportes/quejas') }}",
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
                order: [
                    [0, 'desc']
                ]
            };
            let table = $('#datatable_timesheet').DataTable(dtOverrideGlobals);
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
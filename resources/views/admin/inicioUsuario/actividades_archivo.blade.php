@extends('layouts.admin')
@section('content')

    @inject('Empleado', 'App\Models\Empleado')

    <style type="text/css">
        .td_div_recursos {
            width: 100px;
            display: flex;
            overflow-x: auto;
        }

        .td_nombre {
            min-width: 400px !important;
        }

    </style>

    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Archivo de Actividades</strong></h3>
        </div>

        <div class="card-body">
            <div class="row px-3">

                <div class=" col-12 px-1 py-2 mb-4 rounded "
                    style="background-color: #DBEAFE; border-top:solid 3px #3B82F6; margin: auto;">
                    <div class="row w-100">
                        <div class="text-center col-1 align-items-center d-flex justify-content-center">
                            <div class="w-100">
                                <i class="bi bi-info mr-3" style="color: #3B82F6; font-size: 30px"></i>
                            </div>
                        </div>
                        <div class="col-11">
                            <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">
                                Instrucciones</p>
                            <p class="m-0" style="font-size: 14px; color:#1E3A8A ">En esta sección encontrará las
                                actividades que han sido archivadas.
                            </p>

                        </div>
                    </div>
                </div>

                <div class="datatable-fix" style="width: 100%;">
                    <div class="mb-3 text-right">
                        <a class="btn btn-danger" href="{{ asset('admin/inicioUsuario#actividades') }}">Regresar</a>
                    </div>

                    <table class="table tabla_archi" id="tblArchivo">
                        <thead>
                            <tr>
                                <th>Actividad</th>
                                <th>Origen</th>
                                {{-- <th>Categoria</th> --}}
                                {{-- <th>Urgencia</th> --}}
                                <th style="min-width:200px;">Fecha&nbsp;inicio</th>
                                <th style="min-width:200px;">Fecha&nbsp;fin</th>
                                <th>Compartida por</th>
                                <th>Estatus</th>
                                <th>Recuperar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($actividades as $task)
                                @php
                                    if (isset($task->archivado)) {
                                        $archivado = $task->archivado;
                                    } else {
                                        $archivado = false;
                                    }
                                @endphp
                                @if ($archivado)
                                    <tr id="{{ $task->id }}" data-parent-plan="{{ $task->slug }}">
                                        <td class="td_nombre">{{ $task->name }}</td>
                                        <td><span class="badge badge-primary">{{ $task->parent }}</span></td>
                                        {{-- <td>Categoria</td> --}}
                                        {{-- <td>Urgencia</td> --}}
                                        <td>{{ \Carbon\Carbon::createFromTimestamp($task->start / 1000)->toDateTime()->format('Y-m-d') }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::createFromTimestamp($task->end / 1000)->toDateTime()->format('Y-m-d') }}
                                        </td>

                                        <td>
                                            <div class="td_div_recursos">
                                                @foreach ($task->assigs as $assig)
                                                    @php
                                                        $empleado = $Empleado->where('id', intval($assig->resourceId))->first();
                                                    @endphp
                                                    @if ($empleado)
                                                        <img src="{{ asset('storage/empleados/imagenes/' . $empleado->avatar) }}"
                                                            style="height: 37px; clip-path: circle(18px at 50% 50%);"
                                                            class="rounded-circle {{ $empleado->id == auth()->user()->empleado->id ? 'd-none' : '' }}"
                                                            alt="{{ $empleado->name }}" title="{{ $empleado->name }}">
                                                        {{ $empleado->id == auth()->user()->empleado->id ? '' : '' }}
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>

                                        <td>
                                            @switch($task->status)
                                                @case('STATUS_ACTIVE')
                                                    <span class="badge" style="background-color:rgb(253, 171, 61)">En
                                                        proceso</span>
                                                @break
                                                @case('STATUS_DONE')
                                                    <span class="badge"
                                                        style="background-color:rgb(0, 200, 117)">Completada</span>
                                                @break
                                                @case ('STATUS_FAILED')
                                                    <span class="badge" style="background-color:rgb(226, 68, 92)">Con
                                                        retraso</span>
                                                @break
                                                @case ('STATUS_SUSPENDED')
                                                    <span class="badge"
                                                        style="background-color:#aaaaaa">Suspendida</span>
                                                @break
                                                @case ('STATUS_UNDEFINED')
                                                    <span class="badge" style="background-color:#00b1e1">Sin
                                                        iniciar</span>
                                                @break
                                                @default
                                                    <span class="badge" style="background-color:#00b1e1">Sin iniciar</span>
                                            @endswitch
                                        </td>
                                        <td class="d-flex">
                                            <button class="btn" title="Recuperar" style="all: unset !important;">
                                                <i class="fas fa-sign-in-alt" style="font-size: 20pt; color:#345183;"
                                                    data-archivar="false" data-actividad-id="{{ $task->id }}"
                                                    data-plan-implementacion="{{ $task->id_implementacion }}"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>
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
            let table = $('.tabla_archi').DataTable(dtOverrideGlobals);
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
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', () => {
            const tblArchivo = document.getElementById('tblArchivo');
            tblArchivo.addEventListener('click', async (e) => {
                if (e.target.getAttribute('data-archivar') == 'false') {
                    const actividadID = e.target.getAttribute('data-actividad-id');
                    const planImplementacionID = e.target.getAttribute('data-plan-implementacion');
                    const url = "{{ route('admin.inicio-Usuario.actividades.recuperar') }}"
                    const formData = new FormData();
                    formData.append('taskID', actividadID);
                    formData.append('planImplementacionID', planImplementacionID);
                    Swal.fire({
                        title: '¿Quieres Desarchivar esta Actividad?',
                        text: "",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Desarchivar',
                        cancelButtonText: 'No',
                    }).then(async (result) => {
                        if (result.isConfirmed) {
                            const response = await fetch(url, {
                                method: "POST",
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.success) {
                                window.location.reload();
                            }
                        }
                    })

                }
            })
        })
    </script>
@endsection

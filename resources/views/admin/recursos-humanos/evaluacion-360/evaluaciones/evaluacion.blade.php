@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.recursos.create') }}
    <style>
        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            color: #fff;
            background-color: #008186;
        }

        a.nav-link {
            color: #008186;
        }

        table.no-footer,
        .dataTables_scrollHeadInner,
        #tblParticipantes {
            width: 100% !important;
        }

    </style>
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong>Evaluación: </strong>{{ $evaluacion->nombre }}</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="p-0 col-2">
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="v-pills-configuracion-tab" data-toggle="pill"
                            href="#v-pills-configuracion" role="tab" aria-controls="v-pills-configuracion"
                            aria-selected="true"><i class="mr-2 fas fa-cogs"></i> Configuración</a>
                        <a class="nav-link" id="v-pills-cuestionario-tab" data-toggle="pill"
                            href="#v-pills-cuestionario" role="tab" aria-controls="v-pills-cuestionario"
                            aria-selected="false"><i class="mr-2 fas fa-file-signature"></i>Competencias y Objetivos</a>
                        <a class="nav-link" id="v-pills-participantes-tab" data-toggle="pill"
                            href="#v-pills-participantes" role="tab" aria-controls="v-pills-participantes"
                            aria-selected="false"><i class="mr-2 fas fa-users"></i> Participantes</a>
                    </div>
                </div>
                <div class="col-10">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-configuracion" role="tabpanel"
                            aria-labelledby="v-pills-configuracion-tab">
                            <div class="w-100" style="border-radius: 8px 8px 5px 5px">
                                <div class="border w-100"
                                    style="padding:15px 10px;color:black;background: #e0e0e0;border-radius: 8px 8px 0 0;">
                                    <div class="row">
                                        <div class="col-6 d-flex align-items-center">
                                            <span style="font-size:20px;"
                                                class="mr-2">{{ $evaluacion->nombre }}</span><span
                                                class="badge"
                                                style="background: {{ $evaluacion->color_estatus }};color:{{ $evaluacion->color_estatus_text }}">
                                                <span
                                                    style="border-radius: 100%;width: 6px;height: 6px;background: white;display: inline-block;margin-right: 3px"></span>{{ $evaluacion->estatus_formateado }}
                                            </span>
                                        </div>
                                        <div class="col-6 d-flex align-items-center justify-content-end">
                                            @if ($evaluacion->estatus == App\Models\RH\Evaluacion::DRAFT)
                                                <button id="btnIniciarEvaluacion" class="btn btn-sm"
                                                    style="background: #2cb142;color: #fff;"><i
                                                        class="mr-2 fas fa-calendar-check"></i>Iniciar
                                                    Evaluación</button>
                                            @elseif ($evaluacion->estatus == App\Models\RH\Evaluacion::CLOSED)
                                                <button id="btnPostergarEvaluacion" class="btn btn-sm"
                                                    style="background: #2c40b1;color: #fff;"><i
                                                        class="mr-2 fas fa-calendar-plus"></i>Reiniciar evaluación con
                                                    nueva fecha de finalización</button>
                                            @else
                                                <button id="btnCerrarEvaluacion"
                                                    onclick="event.preventDefault();CerrarEvaluacion(this,'{{ route('admin.ev360-evaluaciones.cerrarEvaluacion', $evaluacion) }}')"
                                                    class="btn btn-sm" style="background: #c53030;color: #fff;"><i
                                                        class="mr-2 fas fa-calendar-times"></i>Cerrar
                                                    Evaluación</button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <ul class="list-group list-group-horizontal w-100">
                                    <li class="pr-0 list-group-item w-100" style="border:none;">
                                        <p class="m-0 text-muted">Autor</p>
                                        <p class="m-0" style="font-weight: bold;">
                                            <img alt="{{ $evaluacion->autor->name }}"
                                                src="{{ asset('storage/empleados/imagenes/' . $evaluacion->autor->avatar) }}"
                                                class="rounded-circle"
                                                style="clip-path: circle(10px at 50% 50%);height: 20px;margin-left: -6px;" />
                                            {{ $evaluacion->autor->name }}
                                        </p>
                                    </li>
                                    <li class="px-0 list-group-item w-100" style="border:none;">
                                        <p class="m-0 text-muted">Comineza En</p>
                                        <p class="m-0"><i class="mr-1 fas fa-calendar-check"></i>
                                            {{ \Carbon\Carbon::parse($evaluacion->fecha_inicio)->format('d-m-Y') }}</p>
                                    </li>
                                    <li class="px-0 list-group-item w-100" style="border:none;">
                                        <p class="m-0 text-muted">Finaliza En</p>
                                        <p class="m-0"><i class="mr-1 fas fa-calendar-times"></i>
                                            {{ \Carbon\Carbon::parse($evaluacion->fecha_fin)->format('d-m-Y') }}</p>
                                    </li>
                                    <li class="px-0 list-group-item w-100" style="border:none;">
                                        <p class="m-0 text-muted">Participación</p>
                                        <div class="row align-items-center justify-content-center">
                                            <div class="pr-1 col-9">
                                                <div class="progress">
                                                    <div class="progress-bar {{ $progreso == 100 ? 'bg-success' : '' }}"
                                                        role="progressbar" style="width: {{ $progreso }}%;"
                                                        aria-valuenow="{{ $progreso }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        <span style="font-size:8px;">{{ $progreso }}%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-0 col-3">
                                                <span
                                                    style="font-size: 12px; font-weight: bold">{{ $contestadas }}/{{ $total_evaluaciones }}</span>
                                            </div>
                                        </div>

                                    </li>
                                </ul>
                                <!-- Modal -->
                                <div class="modal fade" id="modalIniciarEvaluacion" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1" aria-labelledby="modalIniciarEvaluacionLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalIniciarEvaluacionLabel"><i
                                                        class="mr-2 fas fa-cogs"></i>Iniciar Evaluación</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="formIniciarEvaluacion"
                                                    action="{{ route('admin.ev360-evaluaciones.iniciarEvaluacion', $evaluacion) }}"
                                                    method="POST">
                                                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.iniciar_evaluacion._form')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn_cancelar"
                                                    data-dismiss="modal">Descartar</button>
                                                <button id="btnModalIniciarEvaluacion" type="button"
                                                    class="btn btn-danger">Iniciar Evaluación</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="modalPostergarFechaFinEvaluacion" data-backdrop="static"
                                    data-keyboard="false" tabindex="-1"
                                    aria-labelledby="modalPostergarFechaFinEvaluacionLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalPostergarFechaFinEvaluacionLabel"><i
                                                        class="mr-2 fas fa-cogs"></i>Reiniciar evaluación con nueva fecha de
                                                    finalización</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form id="formPostergarEvaluacion"
                                                    action="{{ route('admin.ev360-evaluaciones.postergarEvaluacion', $evaluacion) }}"
                                                    method="POST">
                                                    @include('admin.recursos-humanos.evaluacion-360.evaluaciones.iniciar_evaluacion._form_postergar')
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn_cancelar"
                                                    data-dismiss="modal">Descartar</button>
                                                <button id="btnmodalPostergarFechaFinEvaluacion" type="button"
                                                    class="btn btn-danger">Iniciar evaluación</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-cuestionario" role="tabpanel"
                            aria-labelledby="v-pills-cuestionario-tab">
                            <div>
                                <div class="w-100"
                                    style="padding:15px 10px;color:white;background: #008186;border-radius: 8px 8px 0 0;">
                                    <div class="row">
                                        <div class="col-12 d-flex align-items-center">
                                            <span style="font-size:18px;"><i class="mr-2 fas fa-sync-alt"></i>Vinculación de
                                                Competencias
                                                y Objetivos
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @if ($evaluacion->estatus == App\Models\RH\Evaluacion::DRAFT)
                                    <form action="" method="POST">
                                        @include('admin.recursos-humanos.evaluacion-360.evaluaciones.vinculacion._form_vinculacion')
                                    </form>
                                @else
                                    <h5 class="my-3"><i class="mr-2 fas fa-check"></i>Competencias seleccionadas
                                    </h5>
                                    <ul class="list-group">
                                        @foreach ($competencias_seleccionadas_text as $competencia)
                                            <li class="list-group-item">{{ $competencia->competencia->nombre }} <span
                                                    class="badge badge-primary">{{ $competencia->competencia->tipo->nombre }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-participantes" role="tabpanel"
                            aria-labelledby="v-pills-participantes-tab">
                            <div class="w-100"
                                style="padding:15px 10px;color:white;background: #008186;border-radius: 8px 8px 0 0;">
                                <div class="row">
                                    <div class="col-12 d-flex align-items-center">
                                        <span style="font-size:18px;">
                                            <i class="mr-2 fas fa-users"></i>Participantes
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="datatable-fix w-100">
                                <table id="tblParticipantes">
                                    <thead>
                                        <tr>
                                            <th>Evaluado</th>
                                            <th>Area</th>
                                            <th>Evaluadores</th>
                                            <th>Participación</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            document.getElementById('btnIniciarEvaluacion')?.addEventListener('click', function(e) {
                e.preventDefault();
                $('#modalIniciarEvaluacion').modal('show');
                document.getElementById('btnModalIniciarEvaluacion').addEventListener('click', function(e) {
                    let url = $('#formIniciarEvaluacion').attr('action');
                    let type = $('#formIniciarEvaluacion').attr('method');
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: type,
                        url: url,
                        data: $("#formIniciarEvaluacion").serialize(),
                        dataType: "JSON",
                        beforeSend: function() {
                            toastr.info('Iniciando evaluación, espere un momento...');
                        },
                        success: function(response) {
                            if (response.success) {
                                toastr.success(
                                    'Evaluación iniciada, recargaremos la página, espere un momento...'
                                );
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            }
                        },
                        error: function(request, status, error) {
                            toastr.error(
                                'Ocurrió un error: ' + error);
                        }
                    });
                })
            });

            document.getElementById('btnPostergarEvaluacion')?.addEventListener('click', function(e) {
                e.preventDefault();
                console.log('click');
                $('#modalPostergarFechaFinEvaluacion').modal('show');
                document.getElementById('btnmodalPostergarFechaFinEvaluacion').addEventListener('click',
                    function(e) {
                        let url = $('#formPostergarEvaluacion').attr('action');
                        let type = $('#formPostergarEvaluacion').attr('method');
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: type,
                            url: url,
                            data: $("#formPostergarEvaluacion").serialize(),
                            dataType: "JSON",
                            beforeSend: function() {
                                toastr.info('Iniciando evaluación, espere un momento...');
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success(
                                        'Evaluación iniciada con una nueva fecha de finalización, recargaremos la página, espere un momento...'
                                    );
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1500);
                                }
                            },
                            error: function(request, status, error) {
                                toastr.error(
                                    'Ocurrió un error: ' + error);
                            }
                        });
                    })
            });

            window.CerrarEvaluacion = function(element, url) {
                Swal.fire({
                    title: '¿Está seguro de cerrar esta evaluación?',
                    text: "¡No podrás revertir esto y las evaluaciones que aún no han sido contestadas ya no podrán contestarse!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sí',
                    cancelButtonText: 'No',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            type: 'POST',
                            url: url,
                            beforeSend: function() {
                                toastr.info(
                                    'Cerrando evaluación, espere un momento...');
                            },
                            success: function(response) {
                                if (response.success) {
                                    toastr.success(
                                        'Evaluación cerrada, recargaremos la página, espere un momento...'
                                    );
                                    setTimeout(() => {
                                        window.location.reload();
                                    }, 1500);
                                }
                            },
                            error: function(request, status, error) {
                                toastr.error(
                                    'Ocurrió un error: ' + error);
                            }
                        });
                    }
                })
            }


            $('#competencias').select2({
                theme: 'bootstrap4'
            });

            $('#competencias').on('select2:select', function(e) {
                let data = e.params.data;
                let competencia_id = data.id;
                let url =
                    "{{ route('admin.ev360-evaluaciones.relatedCompetenciaWithEvaluacion', $evaluacion->id) }}"
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: {
                        competencia_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Competencia Vinculada a la evaluacion');
                        }
                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            });
            $('#competencias').on('select2:unselect', function(e) {
                let data = e.params.data;
                let competencia_id = data.id;
                let url =
                    "{{ route('admin.ev360-evaluaciones.deleteRelatedCompetenciaWithEvaluacion', $evaluacion->id) }}"
                $.ajax({
                    headers: {
                        "X-CSRF-TOKEN": $("meta[name='csrf-token']").attr("content")
                    },
                    type: "POST",
                    url: url,
                    data: {
                        competencia_id
                    },
                    dataType: "JSON",
                    success: function(response) {
                        if (response.success) {
                            toastr.success('Competencia desvinculada a la evaluacion');
                        }
                    },
                    error: function(request, status, error) {
                        toastr.error(
                            'Ocurrió un error: ' + error);
                    }
                });
            });

            let dtButtons = [];
            let dtOverrideGlobals = {
                buttons: dtButtons,
                dom: `<'row align-items-center justify-content-center'<'col-12 col-sm-12 col-md-3 col-lg-3 m-0'l><'text-center col-12 col-sm-12 col-md-5 col-lg-5'B><'col-md-4 col-12 col-sm-12 m-0'f>>
                <'row'<'col-sm-12'tr>>
                <'row align-items-center justify-content-end'<'col-12 col-sm-12 col-md-6 col-lg-6'i><'col-12 col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end'p>>`,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.ev360-evaluaciones.getParticipantes', $evaluacion) }}",
                columns: [{
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'area',
                    },
                    {
                        data: 'evaluadores',
                        render: function(data, type, row, meta) {
                            if (data) {
                                let html = '<div>';
                                data.forEach(element => {
                                    html +=
                                        `                                        
                                        <img style="" src="${@json(asset('storage/empleados/imagenes/'))}/${element.evaluador.avatar}"
                                            class="rounded-circle" alt="${element.evaluador.name}"
                                            title="${element.evaluador.name}" width="40" height="37">
                                            ${element.evaluado?'<i class="fas fa-check-circle" style="position:relative;top:0;left:-20px;z-index:1;color: #3ff556;text-shadow: 1px 1px 0px black;"></i>':''}                                
                                        `
                                });
                                html += '</div>';
                                return html;
                            }
                            return "Sin evaluadores";
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let html = `
                            <div class="row align-items-center justify-content-center">
                                <div class="pr-1 col-9">
                                    <div class="progress">
                                        <div class="progress-bar ${Number(row.progreso)==100?'bg-success':''}" role="progressbar"
                                            style="width: ${row.progreso }%;"
                                            aria-valuenow="${row.progreso }" aria-valuemin="0"
                                            aria-valuemax="100">
                                            <span style="font-size:8px;">${row.progreso }%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-0 col-3">
                                    <span
                                        style="font-size: 12px; font-weight: bold">${row.contestadas }/${row.total_evaluaciones }</span>
                                </div>
                            </div>
                           `;
                            return html;
                        }
                    },
                    {
                        data: 'id',
                        render: function(data, type, row, meta) {
                            let urlShow = `/admin/recursos-humanos/evaluacion-360/evaluaciones/${data}`;
                            let html = `
                                <a href="${urlShow}" class="btn btn-sm" title="Visualizar"><i class="fas fa-arrow-right"></i></a>
                            `;

                            return html;
                        }
                    },
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            window.table = $('#tblParticipantes').DataTable(dtOverrideGlobals);
        });
    </script>
@endsection

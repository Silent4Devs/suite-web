@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('admin.recursos.create') }}
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Seguimiento de la </strong> Capacitación </h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <nav>
                        <div class="nav nav-tabs" id="tabsSeguimientoCapacitaciones" role="tablist">
                            <a class="nav-link active" data-type="capacitacion" id="nav-capacitacion-tab" data-toggle="tab"
                                href="#nav-capacitacion" role="tab" aria-controls="nav-capacitacion" aria-selected="true">
                                <i class="mr-2 fas fa-briefcase" style="font-size:20px;" style="text-decoration:none;"></i>
                                Capacitación
                            </a>
                            <a class="nav-link" data-type="participantes" id="nav-participantes-tab"
                                href="#nav-participantes" style="position: relative;">
                                <i class="mr-2 fas fa-users" style="font-size:20px;" style="text-decoration:none;"></i>
                                Participantes
                            </a>
                            <a class="nav-link" data-type="evaluacion" id="nav-evaluacion-tab" href="#nav-evaluacion"
                                style="position: relative;">
                                <i class="mr-2 fas fa-chart-bar" style="font-size:20px;" style="text-decoration:none;"></i>
                                Evaluación de la Capacitación
                            </a>
                        </div>
                    </nav>
                    <div class="tab-content col-12" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-capacitacion" role="tabpanel"
                            aria-labelledby="nav-capacitacion-tab">
                            @include('admin.recursos.components.seguimiento.capacitacion')
                        </div>
                        <div class="tab-pane fade" id="nav-participantes">
                            @include('admin.recursos.components.seguimiento.participantes')
                        </div>
                        <div class="tab-pane fade" id="nav-evaluacion">
                            @include('admin.recursos.components.seguimiento.evaluacion')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="module">
        import timer from '{{ asset('js/timer/timer.js') }}';
        document.addEventListener('DOMContentLoaded', function() {
            const recurso = @json($recurso);
            let mensajeInicioFin = 'La Capacitación ha Iniciado';
            if (recurso.ya_finalizo) {
                mensajeInicioFin = 'La Capacitación ha Finalizado';
            }
            if (recurso.estatus.toLowerCase() != 'cancelado') {
                timer(new Date(recurso.fecha_inicio_ymd), 'Iniciar La Capacitación', mensajeInicioFin);
            } else {
                document.getElementById('timer').innerHTML =
                    '<i class="fas fa-exclamation-triangle mr-2"></i>Capacitación Cancelada'
            }

            let empleado = null;
            const formularioModal = document.getElementById('formularioModal');
            const urlDataTable = @json(route('admin.recursos.participantes', $recurso));

            let dtOverrideGlobals = {
                buttons: [],
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: urlDataTable,
                columns: [{
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return `
                            <img src="${row.avatar_ruta}" class="img-empleado-tabla" />
                            ${row.name}
                            `;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return `
                            ${row.area.area}
                            `;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            let estatus;
                            if (row.pivot.es_aceptada == null) {
                                estatus =
                                    `<i class="text-muted far fa-question-circle mr-2"></i> Pendiente`;
                            } else if (row.pivot.es_aceptada == true) {
                                estatus =
                                    `<i class="text-success far fa-check-circle mr-2"></i> Aceptada`;
                            } else if (row.pivot.es_aceptada == false) {
                                estatus =
                                    `<i class="text-danger far fa-times-circle mr-2"></i> Rechazada`;
                            }

                            return estatus;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            return row.pivot.calificacion || 'Sin Calificación';
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            let certificadosFolder = @json(asset('storage/capacitaciones/certificados/'));
                            let carpetaCertificado = `${recurso.id}_capacitacion/${row.n_empleado}`;
                            let certificado =
                                `${certificadosFolder}/${carpetaCertificado}/${row.pivot.certificado}`;
                            return row.pivot.certificado ?
                                `<a href="${certificado}">
                                    <img width="40" src="{{ asset('img/graduation-diploma.png') }}"
                                    alt="Certificado">
                                    </a>` :
                                'Sin Certificado';
                        }
                    },
                    {
                        data: 'id',
                        name: 'id',
                        render: function(data, type, row, meta) {
                            let botones = '';
                            if (recurso.ya_finalizo) {
                                if (row.pivot.es_aceptada) {
                                    const data = escape(JSON.stringify(row));
                                    botones += `
                                    <i class="fas fa-medal btnModal" style="cursor: pointer;" data-toggle="modal"
                                    data-target="#modalParticipante" data-empleado="${data}"></i>
                                    `;
                                }
                            }
                            return botones;
                        }
                    },
                ],
                orderCellsTop: true,
                order: [
                    [0, 'desc']
                ]
            };
            const tblParticipantes = $("#tblParticipantes").DataTable(dtOverrideGlobals);

            document.getElementById('tblParticipantes').addEventListener('click', function(e) {
                if (e.target.classList.contains('btnModal')) {
                    empleado = JSON.parse(unescape(e.target.getAttribute('data-empleado')));
                    let html = `
                        <div>
                            <label for="calificacion"><i class="fas fa-calculator mr-2"></i>Calificación</label>
                            <input name="calificacion" id="calificacion" type="number" class="form-control"
                                placeholder="Calificación Obtenida" value="${empleado.pivot.calificacion}">
                            <small id="calificacion_error" class="text-danger"></small>
                        </div>
                        <div class="mt-3 text-center">`;
                    if (empleado.pivot.certificado != null) {
                        html += `
                        <strong id="certificadoCargado"><img width="40" src="{{ asset('img/graduation-diploma.png') }}" alt="Certificado"> ${empleado.pivot.certificado}<i style="cursor: pointer;" class="ml-2 fas fa-times" id="quitarSeleccionArchivo"></i></strong>
                        `;
                    }
                    html += `<div id="labelCertificado" class="${empleado.pivot.certificado != null?'d-none':''}"><label for="certificado" style="cursor: pointer">
                                <img width="40" src="{{ asset('img/graduation-diploma.png') }}" alt="Certificado">
                                <span>Subir Certificado</span>
                                </label>
                                <p class="m-0"><small id="certificado_error" class="text-danger"></small></p>
                                <p class="m-0"><small class="text-muted"><i class="fas fa-file mr-2"></i>Máximo 5MB</small></p>
                            </div>
                            `;
                    html += `                            
                            <small id="informacionArchivo" class="m-0 text-muted"></small>
                            <input name="certificado" id="certificado" type="file" class="form-control d-none"
                                accept="image/jpeg,image/png,application/pdf">
                        </div>
                    `;
                    formularioModal.innerHTML = html;

                    document.getElementById('certificado').addEventListener('change', function(e) {
                        const files = this.files;
                        document.getElementById('labelCertificado').classList.add('d-none');
                        const informacionArchivo = document.getElementById('informacionArchivo');
                        informacionArchivo.innerHTML =
                            `<strong><i class="fas fa-upload mr-2 text-primary"></i>${files.length} Archivo Seleccionado <i style="cursor: pointer;" class="fas fa-times" id="quitarSeleccionArchivo"></i></strong>`;

                        // const quitarSeleccionArchivo = document.getElementById(
                        //     'quitarSeleccionArchivo');
                        // quitarSeleccionArchivo.addEventListener('click', function(e) {
                        //     document.getElementById('certificado').value = null;
                        //     document.getElementById('informacionArchivo').innerHTML = null;
                        //     document.getElementById('labelCertificado').classList.remove(
                        //         'd-none');
                        // });
                    })
                }
            })
            document.getElementById('modalParticipante').addEventListener('click', function(e) {
                if (e.target.getAttribute('id') == 'quitarSeleccionArchivo') {
                    if (empleado.pivot.certificado != null) {
                        document.getElementById('certificadoCargado').classList.add('d-none');
                    }
                    document.getElementById('certificado').value = null;
                    document.getElementById('informacionArchivo').innerHTML = null;
                    document.getElementById('labelCertificado').classList.remove(
                        'd-none');
                }
            })

            //Guardar Información Modal
            const btnGuardarModal = document.getElementById('btnGuardarModal');
            btnGuardarModal.addEventListener('click', async function(e) {
                const url = formularioModal.getAttribute('action');
                const method = formularioModal.getAttribute('method');
                const formData = new FormData(formularioModal);
                console.log(empleado);
                formData.append('empleado', JSON.stringify(empleado));
                formData.append('recurso', recurso.id);
                try {
                    const response = await fetch(url, {
                        method: "POST",
                        body: formData,
                        headers: {
                            Accept: "application/json",
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    })
                    const data = await response.json();
                    if (data.estatus == 200) {
                        toastr.success(data.mensaje);
                        tblParticipantes.ajax.reload();
                        $('#modalParticipante').modal('hide');
                        document.querySelector('.modal-backdrop').style.display = "none";
                    }

                    if (data.errors) {
                        $.each(data.errors, function(indexInArray, valueOfElement) {
                            $(`#${indexInArray.replaceAll('.','_')}_error`).text(
                                valueOfElement[0]);
                        });
                        toastr.error(
                            'Por favor revise que la información ingresa sea correcta'
                        );
                    }
                } catch (error) {
                    console.log(error);
                }
            })

            document.getElementById('btnCancelarModal').addEventListener('click', function(e) {
                formularioModal.reset();
            })

            $('#tabsSeguimientoCapacitaciones a').on('click', function(event) {
                event.preventDefault()
                $(this).tab('show')
                setTimeout(() => {
                    $.fn.dataTable.tables({
                        visible: true,
                        api: true
                    }).columns.adjust();
                }, 1000);
            })
        })
    </script>
@endsection

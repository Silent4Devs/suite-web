<style>
    .img-empleado-tabla {
        clip-path: circle(50% at 50% 50%);
        width: 35px;
    }

    .progress-bar {
        background-color: #345183 !important;
    }

</style>
<div class="row mt-4 align-items-center">
    <div class="col-12 text-muted pr-0 mb-3" style="text-align:right">
        @if (!$recurso->ya_inicio && $recurso->estatus != 'Cancelado')
            <button id="btnEnviarInvitacion" class="btn btn-sm" style="background: #88a4ff;color: rgb(54, 54, 54);">
                <i class="mr-2 fas fa-envelope"></i>Enviar Invitación por Correo
            </button>
        @endif
        @if (\Carbon\Carbon::now()->isBefore(\Carbon\Carbon::parse($recurso->fecha_inicio)) || $recurso->estatus == 'Cancelado')
            <button id="btnReprogramar" class="btn btn-sm" style="background: #99faa6;color: rgb(54, 54, 54);">
                <i class="mr-2 fas fa-calendar-day"></i>Reprogramar Capacitación
            </button>
        @endif
        @if (\Carbon\Carbon::now()->lessThanOrEqualTo(\Carbon\Carbon::parse($recurso->fecha_fin)) && $recurso->estatus != 'Cancelado')
            <button id="btnCancelarCapacitacion" class="btn btn-sm" style="background: #eb4a4a;color: #fff;">
                <i class="mr-2 fas fa-calendar-times"></i>Cancelar Capacitación
            </button>
        @endif
    </div>
    <div class="col-12 px-0" style="text-align: right;">
        <p class="m-0" style="font-size: 12px">
            <span id="timer" style="font-weight: bold;"></span>
        </p>
    </div>
    <div class="col-12 p-0 rounded">
        <table class="w-100 mb-3" style="text-align: center">
            <thead style="background: #788BAC;color: white;">
                <th>Nombre Evaluación</th>
                <th>Estatus</th>
                <th>Comienza El</th>
                <th>Finaliza El</th>
                <th>Instructor</th>
            </thead>
            <tbody>
                <tr>
                    <td class="p-3">{{ $recurso->cursoscapacitaciones }}</td>
                    <td class="p-3">
                        @if ($recurso->ya_finalizo && $recurso->estatus != 'Cancelado')
                            {{ 'Finalizado' }}
                        @else
                            {{ $recurso->estatus }}
                        @endif
                    </td>
                    <td class="p-3"><i
                            class="mr-1 fas fa-calendar-check"></i>{{ $recurso->fecha_inicio_name }}</td>
                    <td class="p-3"><i
                            class="mr-1 fas fa-calendar-times"></i>{{ $recurso->fecha_fin_name }}</td>
                    <td class="p-3"><i class="fas fa-user-circle mr-2"></i>{{ $recurso->instructor }}</td>
                </tr>
            </tbody>
        </table>

        @php
            $aceptadas = 0;
            foreach ($recurso->empleados as $empleado) {
                if ($empleado->pivot->es_aceptada) {
                    $aceptadas++;
                }
            }
            $invitaciones = count($recurso->empleados) > 0 ? count($recurso->empleados) : 1;
            $porcentaje = round(($aceptadas * 100) / $invitaciones);
        @endphp
        <div class="row align-items-center">
            <div class="col-10 pr-0">
                <p class="m-0 text-muted">Porcentaje de Aceptación</p>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ $porcentaje }}%;"
                        aria-valuenow="{{ $porcentaje }}" aria-valuemin="0" aria-valuemax="100">{{ $porcentaje }}%
                    </div>
                </div>
            </div>
            <div class="col-2 text-center px-0">
                <p class="m-0">Invitación Aceptada</p>
                <strong>{{ $aceptadas }} / {{ count($recurso->empleados) }}</strong>
            </div>
        </div>
    </div>
    <div class="col-12 mt-3 text-center p-0">
        <a id="descargarFormato">Descargar
            Formato</a>
        @if ($recurso->ya_finalizo && $recurso->estatus != 'Cancelado')
            @livewire('subir-lista-asistencia-archivo',['recurso'=>$recurso])
        @endif
    </div>

    {{-- MODALES --}}
    <div class="modal fade" id="reprogramarCapacitacion" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="reprogramarCapacitacionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reprogramarCapacitacionLabel"><i class="fas fa-calendar-day"></i>
                        Reprogramar Capacitación</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formularioReprogramarCapacitacion"
                        action="{{ route('admin.recursos.reprogramarCapacitacion', $recurso) }}" method="post">
                        <label class="mt-2" for="fecha_inicio"><i class="fas fa-calendar mr-2"></i> Fecha
                            Inicio</label>
                        <input type="datetime-local" id="fecha_inicio" name="fecha_curso" class="form-control"
                            value="{{ \Carbon\Carbon::parse($recurso->fecha_curso)->format('Y-m-d\TH:i:s') }}" />
                        <p class="errores text-danger" style="font-size: 9px !important;text-transform: capitalize;"
                            id="fecha_curso_error"></p>
                        <label class="mt-2" for="fecha_fin"><i class="fas fa-calendar mr-2"></i> Fecha
                            Fin</label>
                        <input type="datetime-local" id="fecha_fin" name="fecha_fin" class="form-control"
                            value="{{ \Carbon\Carbon::parse($recurso->fecha_fin)->format('Y-m-d\TH:i:s') }}" />
                        <p class="errores text-danger" style="font-size: 9px !important;text-transform: capitalize;"
                            id="fecha_fin_error"></p>
                        <label class="mt-2" for="fecha_limite"><i class="fas fa-calendar mr-2"></i> Fecha
                            Limite
                            Aceptación</label>
                        <input type="datetime-local" id="fecha_limite" name="fecha_limite" class="form-control"
                            value="{{ \Carbon\Carbon::parse($recurso->fecha_limite)->format('Y-m-d\TH:i:s') }}" />
                        <p class="errores text-danger" style="font-size: 9px !important;text-transform: capitalize;"
                            id="fecha_limite_error"></p>
                        @if ($recurso->configuracion_invitacion_envio->programar_envio)
                            <label class="mt-2" for="fecha_envio_invitacion"><i
                                    class="fas fa-calendar mr-2"></i> Fecha
                                Programada Para Envío por Correo</label>
                            <input type="datetime-local" id="fecha_envio_invitacion" name="fecha_envio_invitacion"
                                class="form-control"
                                value="{{ \Carbon\Carbon::parse($recurso->configuracion_invitacion_envio->fecha_envio_invitacion)->format('Y-m-d\TH:i:s') }}" />
                            <p class="errores text-danger" style="font-size: 9px !important;text-transform: capitalize;"
                                id="fecha_envio_invitacion_error"></p>
                        @endif
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnReprogramarAhora">Reprogramar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.8.1/html2pdf.bundle.min.js"
integrity="sha512-vDKWohFHe2vkVWXHp3tKvIxxXg0pJxeid5eo+UjdjME3DBFBn2F8yWOE0XmiFcFbXxrEOR1JriWEno5Ckpn15A=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const recurso = @json($recurso);
        document.getElementById('descargarFormato').addEventListener('click', function(e) {
            let html = `
            <div class="w-100">
                <h3>Lista de asistencias para la capacitación: ${recurso.cursoscapacitaciones}</h3>
                <table class="w-100 table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Empleado</th>
                            <th class="text-center">¿Asistió?</th>
                        </tr>
                    </thead>
                    <tbody>`
            recurso.empleados.forEach(empleado => {
                html += `
                    <tr>
                        <td>
                            <img class="img_empleado" src="${empleado.avatar_ruta}">
                            ${empleado.name}
                        </td>
                        <td class="d-flex justify-content-center">
                            <input class="form-control" type="checkbox">
                        </td>
                    </tr> 
                            `;
            });
            html += `</tbody>
                </table>
            </div>
            `;
            const options = {
                margin: 1,
                filename: `Lista-de-asistencia-${recurso.cursoscapacitaciones}.pdf`,
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 3,
                    letterRendering: true
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a3',
                    orientation: 'portrait'
                }
            };
            // New Promise-based usage:
            // html2pdf().from(html).set(options).save();
            html2pdf(html, options);

        })

        document.getElementById('btnReprogramar').addEventListener('click', function() {
            $('#reprogramarCapacitacion').modal('show');
        })
        document.getElementById('reprogramarCapacitacion').addEventListener('click', function(e) {
            if (e.target.getAttribute('id') == 'btnReprogramarAhora') {
                Swal.fire({
                    title: '¿Quieres reprogramar la capacitación con la configuración establecida?',
                    text: "",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: '¡Sí, reprogramar!',
                    cancelButtonText: 'No'
                }).then(async (result) => {
                    if (result.isConfirmed) {
                        const formulario = document.getElementById(
                            'formularioReprogramarCapacitacion');
                        const url = formulario.getAttribute('action');
                        const formData = new FormData(formulario);
                        try {
                            const response = await fetch(url, {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    Accept: "application/json",
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]')
                                        .attr(
                                            'content'),
                                },
                            })
                            const data = await response.json();
                            if (data.errors) {
                                for (const key in data.errors) {
                                    document.getElementById(`${key}_error`).innerHTML = `
                                    <i class="fas fa-info-circle mr-2"></i>${data
                                        .errors[key]}
                                    `;
                                }
                            }
                            if (data.estatus == 200) {
                                toastr.success(data.mensaje);
                                $('#reprogramarCapacitacion').modal('hide');
                                document.querySelector('.modal-backdrop').style.display =
                                    'none';
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                toastr.error(data.mensaje);
                            }
                        } catch (error) {
                            toastr.error(error);
                        }
                    }
                })
            }
        })
        document.getElementById('btnCancelarCapacitacion').addEventListener('click', function(e) {
            Swal.fire({
                title: '¿Quieres cancelar la capacitación?',
                text: "¡Tendrás que reprogramar una nueva fecha!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, cancelar la capacitación!',
                cancelButtonText: 'No'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const url =
                        "{{ route('admin.recursos.cancelarCapacitacion', $recurso) }}";
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            body: {},
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                        if (data.estatus == 200) {
                            toastr.success(data.mensaje);
                            setTimeout(() => {
                                window.location.reload();
                            }, 1500);
                        } else {
                            toastr.error(data.mensaje);
                        }
                    } catch (error) {
                        toastr.error(error);
                    }
                }
            })
        })
        document.getElementById('btnEnviarInvitacion').addEventListener('click', function(e) {

            Swal.fire({
                title: '¿Quieres enviar correo de invitación para la capacitación?',
                text: "",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '¡Sí, enviar correo(s)!',
                cancelButtonText: 'No'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const url =
                        "{{ route('admin.recursos.enviarInvitacionPorCorreoAhora', $recurso) }}";
                    try {
                        const response = await fetch(url, {
                            method: 'POST',
                            body: {},
                            headers: {
                                Accept: "application/json",
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'),
                            },
                        })
                        const data = await response.json();
                        console.log(data);
                        if (data.estatus == 200) {
                            toastr.success(data.mensaje);
                        } else {
                            toastr.error(data.mensaje);
                        }
                    } catch (error) {
                        toastr.error(error);
                    }
                }
            })
        })
    })
</script>

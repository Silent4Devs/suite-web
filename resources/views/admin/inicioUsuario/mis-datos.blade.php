<style>
    .lds-facebook {
        display: inline-block;
        position: relative;
        width: 80px;
        height: 80px;
    }

    .lds-facebook div {
        display: inline-block;
        position: absolute;
        left: 8px;
        width: 16px;
        background: rgb(24, 24, 24);
        animation: lds-facebook 1.2s cubic-bezier(0, 0.5, 0.5, 1) infinite;
    }

    .lds-facebook div:nth-child(1) {
        left: 8px;
        animation-delay: -0.24s;
    }

    .lds-facebook div:nth-child(2) {
        left: 32px;
        animation-delay: -0.12s;
    }

    .lds-facebook div:nth-child(3) {
        left: 56px;
        animation-delay: 0;
    }

    @keyframes lds-facebook {
        0% {
            top: 8px;
            height: 64px;
        }

        50%,
        100% {
            top: 24px;
            height: 32px;
        }
    }

</style>
<style>
    .display-almacenando {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 2;
        margin-left: 0px;
        background: #0000000d;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .display-almacenando h1 {
        font-size: 50px;
    }

    .display-almacenando p {
        font-size: 30px;
    }

    .img-profile {
        width: 130px;
        height: 130px;
        clip-path: circle(65px at 50% 50%);
    }

    .img-profile-secondary {
        width: 40px;
        height: 40px;
        clip-path: circle(20px at 50% 50%);
    }

    p.new-badge {
        display: inline-block;
        padding: 3px;
        border-radius: 4px;
        font-size: 8px;
        font-weight: 600;
        margin: 0;
    }

    p.new-badge-primary {
        background: rgb(57, 60, 255);
        color: white;
    }

    p.new-badge-dark {
        background: rgb(29, 29, 29);
        color: white;
    }

    span.btn-lista-acciones {
        position: absolute;
        bottom: 26px;
        right: 23px;
        text-shadow: 2px 2px 14px black;
        cursor: pointer;
        font-size: 9px;
    }

    .lista-acciones {
        position: absolute;
        bottom: -18px;
        right: 0px;
        z-index: 1;
    }

    .lista-acciones a {
        padding: 2px;
        font-size: 10px;
        background: white;
        border: 1px solid #3e3e3e;
    }

    .lista-toggle {
        display: none;
        transition: all 0.5s ease-out;
    }

    hr.hr-custom-title {
        width: 100px;
        margin: 8px 0;
        border: 1px solid #008186
    }

    .title-info-personal {
        color: #008186;
        text-transform: capitalize;
    }

    h6.title-mi-info {
        color: #3e3e3e;
        text-transform: capitalize;
    }

</style>

<div class="card-body">
    <div class="row">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="mb-3 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="text-center d-flex flex-column align-items-center">
                                    <img class="img-fluid img-profile" style="position: relative;"
                                        src="{{ asset('storage/empleados/imagenes') }}/{{ $usuario->empleado ? $usuario->empleado->avatar : 'user.png' }}">
                                    <div class="mt-3">
                                        <h4>{{ $usuario->empleado->name }}</h4>
                                        <p class="mb-1 text-secondary">{{ $usuario->empleado->puesto }}</p>
                                        <p class="text-muted font-size-sm">{{ $usuario->empleado->area->area }}</p>
                                        {{-- <button class="btn btn-primary">Follow</button>
                                        <button class="btn btn-outline-primary">Message</button> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 mt-3 card" x-data="{show:false}">
                            <h5 class="text-center"><i class="mr-2 fas fa-users"></i>Mi Equipo
                                <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                        class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                            </h5>
                            <div class="row align-items-center" id="listaEquipo" x-show="show"
                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                @foreach ($equipo_a_cargo as $empleado)
                                    <div class="text-center col-4 col-sm-4 col-lg-4 col-md-4">
                                        <img class="img-fluid img-profile-secondary" style="position:relative;"
                                            src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                        <p class="text-muted" style="font-size:10px;">
                                            {{ Str::limit($empleado->name, 12, '...') }}</p>
                                        <span class="btn-lista-acciones"><i class="fa fa-edit"></i></span>
                                        <div class="list-group lista-acciones lista-toggle">
                                            <a type="button"
                                                href="{{ route('admin.ev360-objetivos-empleado.create', $empleado) }}"
                                                class="list-group-item list-group-item-action text-muted"
                                                aria-current="true"><i class="fas fa-dot-circle"></i>
                                                Objetivos
                                            </a>
                                            <a type="button"
                                                href="{{ route('admin.ev360-evaluaciones.evaluacionesDelEmpleado', $empleado) }}"
                                                class="list-group-item list-group-item-action text-muted"
                                                aria-current="true"><i class="fas fa-book"></i>
                                                Evaluaciones
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="p-3 mt-3 card">
                            <h5 class="text-center"><i class="mr-2 fas fa-chart-bar"></i>Reportes de mis evaluaciones
                            </h5>
                            @foreach ($lista_evaluaciones as $evaluacion)
                                <a href="{{ route('admin.ev360-evaluaciones.autoevaluacion.consulta.evaluado', [
    'evaluacion' => $evaluacion['id'],
    'evaluado' => $usuario->empleado->id,
]) }}"
                                    class="mt-3 d-inline-block" style="font-size:15px"><i
                                        class="mr-2 fas fa-poll-h"></i>{{ $evaluacion['nombre'] }}</a>

                            @endforeach
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3 card">
                            <div class="card-body">
                                <h6 class="m-0 title-mi-info" style="font-weight: bold;">Información Laboral</h6>
                                <hr class="hr-custom-title">
                                <div class="row">
                                    <div class="col-3 title-info-personal">N° Empleado</div>
                                    <div class="col-3 title-info-personal">Email</div>
                                    <div class="col-3 title-info-personal">Fecha Ingreso</div>
                                    <div class="col-3 title-info-personal">Jefe Inmediato</div>
                                </div>
                                <div class="row">
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->n_empleado }}</div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->email }}</div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ \Carbon\Carbon::parse($usuario->empleado->antiguedad)->format('d-m-Y') }}
                                    </div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->supervisor ? $usuario->empleado->supervisor->name : 'Sin Jefe Inmediato' }}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3 title-info-personal">Area</div>
                                    <div class="col-3 title-info-personal">Puesto</div>
                                    <div class="col-3 title-info-personal">Sede</div>
                                    <div class="col-3 title-info-personal">Estatus</div>
                                </div>
                                <div class="row">
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->area ? $usuario->empleado->area->area : 'Dato no registrado' }}
                                    </div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->puesto ? $usuario->empleado->puesto : 'Dato no registrado' }}
                                    </div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->sede ? $usuario->empleado->sede->sede : 'Dato no registrado' }}
                                    </div>
                                    <div class="col-3 text-muted" style="font-size:12px; text-transform: capitalize;">
                                        {{ $usuario->empleado->estatus ? $usuario->empleado->estatus : 'Dato no registrado' }}
                                    </div>
                                </div>
                                <h6 class="m-0 mt-4 title-mi-info" style="font-weight: bold;">Información Básica</h6>
                                <hr class="hr-custom-title">
                                <div class="row">
                                    <div class="col-3 title-info-personal">Nombre</div>
                                    <div class="col-3 title-info-personal">Cumpleaños</div>
                                    <div class="col-3 title-info-personal">Género</div>
                                    <div class="col-3 title-info-personal">Teléfono</div>
                                </div>
                                <div class="row">
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->name }}</div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->cumpleaños ? $usuario->empleado->cumpleaños : 'Dato no registrado' }}
                                    </div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->genero_formateado ? $usuario->empleado->genero_formateado : 'Dato no registrado' }}
                                    </div>
                                    <div class="col-3 text-muted" style="font-size:12px">
                                        {{ $usuario->empleado->telefono ? $usuario->empleado->telefono : 'Dato no registrado' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row gutters-sm">
                            <div class="mb-3 col-sm-12">
                                <div class="card h-100">
                                    <div class="card-body" x-data="{show:false}">
                                        <h5><i class="mr-2 far fa-sticky-note"></i>Evaluaciones a realizar <i
                                                class="ml-2 fas fa-link" style="font-size: 11px;"></i>
                                            <br>
                                            <small style="font-size:10px;"><i
                                                    class="mr-1 fas fa-circle text-primary"></i>Competencias</small>
                                            <small style="font-size:10px;"><i
                                                    class="mr-1 fas fa-circle text-success"></i>Objetivos</small>
                                            <span style="float: right; cursor:pointer; margin-top: -15px;"
                                                @click="show=!show"><i class="fas"
                                                    :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                        </h5>
                                        <div id="evaluacionesRealizar" x-show="show" x-transition:enter.duration.500ms
                                            x-transition:leave.duration.400ms>
                                            @foreach ($evaluaciones as $evaluacion)
                                                <small>{{ $evaluacion->empleado_evaluado->name }}
                                                    @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->id)
                                                        <span class="badge badge-primary">Autoevaluación</span>
                                                    @endif
                                                    @if ($evaluacion->empleado_evaluado->supervisor)
                                                        @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->supervisor->id)
                                                            <span class="badge badge-success">Supervisor</span>
                                                            <i data-evaluacion={{ $evaluacion->evaluacion->id }}
                                                                data-evaluado={{ $evaluacion->empleado_evaluado->id }}
                                                                data-evaluador={{ $evaluacion->evaluador->id }}
                                                                title="Solicitar reunión"
                                                                class="fas fa-envelope-open-text sendInvitacion"
                                                                style="font-size:11px;"></i>
                                                        @endif
                                                    @endif
                                                </small>
                                                <a
                                                    href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion->evaluacion, 'evaluado' => $evaluacion->empleado_evaluado, 'evaluador' => $evaluacion->evaluador]) }}"><i
                                                        class="fas fa-link" style="font-size:11px;"></i></a>
                                                @if ($evaluacion->evaluacion->include_competencias)
                                                    <div class="progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                            role="progressbar"
                                                            style="width: {{ $evaluacion->progreso_competencias }}%;"
                                                            aria-valuenow="{{ $evaluacion->progreso_competencias }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ $evaluacion->progreso_competencias }}%
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($evaluacion->evaluacion->include_objetivos)
                                                    <div class="mt-2 progress">
                                                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                                                            role="progressbar"
                                                            style="width: {{ $evaluacion->progreso_objetivos }}%;"
                                                            aria-valuenow="{{ $evaluacion->progreso_objetivos }}"
                                                            aria-valuemin="0" aria-valuemax="100">
                                                            {{ $evaluacion->progreso_objetivos }}%
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <div class="card h-100">
                                    <div class="card-body" x-data="{show:false}">
                                        <h5><i class="mb-1 mr-2 fas fa-bullseye"></i>Mis Objetivos
                                            <span style="float: right; cursor:pointer; margin-top: 5px;"
                                                @click="show=!show"><i class="fas"
                                                    :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                        </h5>
                                        <small class="text-muted"><i class="fas fa-exclamation-triangle"></i>Tus
                                            objetivos son evaluados por tu jefe
                                            inmediato</small>
                                        <br>
                                        <div x-show="show" x-transition:enter.duration.500ms
                                            x-transition:leave.duration.400ms>
                                            @foreach ($lista_evaluaciones as $evaluacion)
                                                <small class="mt-3 d-inline-block"
                                                    style="font-size:15px">{{ $evaluacion['nombre'] }}</small>
                                                <br>
                                                <small><i
                                                        class="mr-1 fas fa-calendar-day"></i>{{ $evaluacion['fecha_inicio'] }}</small>
                                                <small><i
                                                        class="mr-1 fas fa-calendar-day"></i>{{ $evaluacion['fecha_fin'] }}</small>
                                                @foreach ($evaluacion['informacion_evaluacion']['evaluadores_objetivos'] as $evaluador)
                                                    @if ($evaluador['esSupervisor'])
                                                        <small>{{ $evaluador['nombre'] }}</small>
                                                        <br>
                                                        @foreach ($evaluador['objetivos'] as $objetivo)
                                                            <small style="font-size:13px"
                                                                class="m-0">{{ $objetivo['nombre'] }}</small>
                                                            <br>
                                                            <small>KPI:
                                                                <strong>{{ $objetivo['KPI'] }}</strong></small>
                                                            <small>Meta:
                                                                <strong>{{ $objetivo['meta'] }}</strong></small>
                                                            <small>Alcanzado:
                                                                <strong>{{ $objetivo['calificacion'] }}</strong></small>
                                                            <small>Comentario(s): <strong>
                                                                    {{ $objetivo['meta_alcanzada'] }}</strong></small>
                                                            <div class="progress">
                                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                    role="progressbar"
                                                                    style="width: {{ ($objetivo['calificacion'] * 100) / $objetivo['meta'] }}%;"
                                                                    aria-valuenow="{{ ($objetivo['calificacion'] * 100) / $objetivo['meta'] }}"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    {{ ($objetivo['calificacion'] * 100) / $objetivo['meta'] }}%
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="invitacionModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="invitacionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invitacionModalLabel"><i class="fas fa-plus mr-2"></i>Crear Reunión
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.ev360-evaluaciones.invitacion-reunion-evaluacion') }}"
                    id="formInvitacion">
                    <div class="row">
                        <div class="col-12">
                            <label for="">Nombre<span class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="nombre">
                            <small class="errores error_nombre text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label for="">Fecha Inicio<span class="text-danger">*</span></label>
                            <input class="form-control" type="datetime-local" name="fecha_inicio">
                            <small class="errores error_fecha_inicio text-danger"></small>
                        </div>
                        <div class="col-6">
                            <label for="">Fecha Fin<span class="text-danger">*</span></label>
                            <input class="form-control" type="datetime-local" name="fecha_fin">
                            <small class="errores error_fecha_fin text-danger"></small>
                        </div>
                        <div class="col-12">
                            <label for="">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="" cols="30" rows="1"></textarea>
                            <small class="errores error_descripcion text-danger"></small>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-danger" id="btnEnviarInvitacion">Enviar</button>
            </div>
            <div class="display-almacenando row" id="displayAlmacenandoUniversal" style="display: none">
                <div class="col-12">
                    <h1>
                        <div class="lds-facebook">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </h1>
                </div>
            </div>
        </div>
    </div>

</div>
@section('scripts')
    @parent
    <script>
        let listaAcciones = document.getElementById('listaEquipo');
        listaAcciones.addEventListener('click', function(e) {
            // document.getElementById('listaAcciones').classList.toggle('lista-toggle');
            if (e.target && e.target.tagName == 'I') {
                e.preventDefault();
                e.target.parentNode.nextElementSibling.classList.toggle('lista-toggle');
            } else {
                console.log(e.target);
            }
        })
        document.addEventListener('DOMContentLoaded', function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            document.getElementById('evaluacionesRealizar').addEventListener('click', function(e) {
                if (e.target && e.target.classList.contains('sendInvitacion')) {
                    e.preventDefault();
                    const evaluacion = e.target.getAttribute('data-evaluacion');
                    const evaluado = e.target.getAttribute('data-evaluado');
                    const evaluador = e.target.getAttribute('data-evaluador');
                    $('#invitacionModal').modal('show');
                    // e.target.parentNode.nextElementSibling.classList.toggle('lista-toggle');

                    $('#btnEnviarInvitacion').replaceWith($('#btnEnviarInvitacion')
                        .clone()); //Evitar creacion multiple de eventos click
                    document.getElementById('btnEnviarInvitacion').addEventListener('click', function(e) {
                        e.preventDefault();
                        limpiarErrores();
                        mostrarValidando();
                        let formulario = document.getElementById('formInvitacion');
                        let formData = new FormData(formulario);
                        formData.append('evaluacion', evaluacion);
                        formData.append('evaluado', evaluado);
                        formData.append('evaluador', evaluador);
                        $.ajax({
                            type: "POST",
                            url: formulario.getAttribute('action'),
                            data: formData,
                            processData: false,
                            contentType: false,
                            dataType: "JSON",
                            success: function(response) {
                                toastr.success('Enlace de reunión enviado con éxito');
                                $('#invitacionModal').modal('hide');
                                formulario.reset();
                                ocultarValidando();
                            },
                            error: function(request, status, error) {
                                document.querySelectorAll('.errors').forEach(error => {
                                    error.innerHTML = "";
                                });
                                ocultarValidando();
                                $.each(request.responseJSON.errors, function(
                                    indexInArray, valueOfElement) {
                                    console.log(valueOfElement, indexInArray);
                                    $(`small.error_${indexInArray}`).text(
                                        valueOfElement[0]);

                                });
                            }
                        });
                    })
                }
            });
        })

        function limpiarErrores() {
            let errores = document.querySelectorAll('.errores');
            errores.forEach(error => {
                error.innerHTML = "";
            });
        }

        function mostrarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'grid';
        }

        function ocultarValidando() {
            document.getElementById('displayAlmacenandoUniversal').style.display = 'none';
        }
    </script>
@endsection

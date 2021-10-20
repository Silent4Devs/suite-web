<style>
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
        bottom: 5px;
        right: 0px;
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
                        <div class="p-3 mt-3 card">
                            <h5 class="text-center"><i class="mr-2 fas fa-users"></i>Mi Equipo</h5>
                            <div class="row align-items-center" id="listaEquipo">
                                @foreach ($equipo_a_cargo as $empleado)
                                    <div class="text-center col-4 col-sm-4 col-lg-4 col-md-4">
                                        <img class="img-fluid img-profile-secondary" style="position:relative;"
                                            src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                        <p class="text-muted" style="font-size:10px;">
                                            {{ Str::limit($empleado->name, 12, '...') }}</p>
                                        <span class="btn-lista-acciones"><i class="fa fa-edit"></i></span>
                                        <div class="list-group lista-acciones lista-toggle">
                                            <a type="button"
                                                href="{{ route('frontend.ev360-objetivos-empleado.create', $empleado) }}"
                                                class="list-group-item list-group-item-action text-muted"
                                                aria-current="true"><i class="fas fa-dot-circle"></i>
                                                Objetivos
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
                                <a href="{{ route('frontend.ev360-evaluaciones.autoevaluacion.consulta.evaluado', [
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
                                    <div class="card-body">
                                        <h5><i class="mr-2 far fa-sticky-note"></i>Evaluaciones a realizar <i
                                                class="ml-2 fas fa-link" style="font-size: 11px;"></i>
                                            <br>
                                            <small style="font-size:10px;"><i
                                                    class="mr-1 fas fa-circle text-primary"></i>Competencias</small>
                                            <small style="font-size:10px;"><i
                                                    class="mr-1 fas fa-circle text-success"></i>Objetivos</small>
                                        </h5>
                                        @foreach ($evaluaciones as $evaluacion)
                                            <small>{{ $evaluacion->empleado_evaluado->name }}
                                                @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->id)
                                                    <span class="badge badge-primary">Autoevaluación</span>
                                                @endif
                                            </small>
                                            <a
                                                href="{{ route('frontend.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion->evaluacion, 'evaluado' => $evaluacion->empleado_evaluado, 'evaluador' => $evaluacion->evaluador]) }}"><i
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
                            <div class="mb-3 col-sm-12">
                                <div class="card h-100">
                                    <div class="card-body">
                                        <h5><i class="mb-1 mr-2 fas fa-bullseye"></i>Mis Objetivos</h5>
                                        <small class="text-muted"><i class="fas fa-exclamation-triangle"></i>Tus
                                            objetivos son evaluados por tu jefe
                                            inmediato</small>
                                        <br>
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
                                                        <small>KPI: <strong>{{ $objetivo['KPI'] }}</strong></small>
                                                        <small>Meta: <strong>{{ $objetivo['meta'] }}</strong></small>
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
    </script>
@endsection

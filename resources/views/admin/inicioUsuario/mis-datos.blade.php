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
    .circle-total-evaluaciones {
        position: relative;
        top: 3px;
        padding: 5px;
        border-radius: 100%;
        background: #fb4646;
        width: 16px;
        height: 16px;
        font-size: 10px;
        display: inline-block;
        color: white;
    }

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

    .img-profile-sm {
        width: 50px;
        clip-path: circle(25px at 50% 50%);
    }

    .img-profile-secondary {
        width: 50px;
        clip-path: circle(25px at 50% 50%);
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
        width: 100%;
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

    .cuadro_verde_con_before {
        position: relative;
        overflow: hidden;
    }

    .cuadro_verde_con_before:before {
        content: "";
        background: #00abb2;
        position: absolute;
        width: 100%;
        height: 100px;
        top: 0;
        z-index: 0;
    }

</style>

<div class="card-body">
    <div class="row">
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="mb-3 col-md-4">
                        <div class="card cuadro_verde_con_before">
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
                            <h5 class="mb-0"><i class="fas fa-award mr-2"></i>Mi Perfil Profesional
                                <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                        class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                            </h5>
                            <hr class="hr-custom-title">
                            <div class="row align-items-center" id="listaCompetenciaCV" x-show="show"
                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                <div class="container text-center mt-1">
                                    @if ($usuario->empleado)
                                        <a href="{{ route('admin.miCurriculum', $usuario->empleado->id) }}"
                                            class="btn btn-success">
                                            Ver Curriculum
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-3 mt-3 card" x-data="{show:false}">
                            <h5 class="mb-0"><i class="mr-2 fas fa-users"></i>Mi Equipo
                                @if ($last_evaluacion)
                                    <a href="{{ route('admin.ev360-evaluaciones.evaluacionesDeMiEquipo', ['evaluacion' => $last_evaluacion, 'evaluador' => auth()->user()->empleado->id]) }}"
                                        class="btn btn-xs btn-light"><i class="mr-1 fas fa-link"></i>Evaluaciones</a>
                                @endif
                                <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                        class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                            </h5>
                            <hr class="hr-custom-title">
                            <div class="row align-items-center" id="listaEquipo" x-show="show"
                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                @forelse ($equipo_a_cargo as $empleado)
                                    <div class="col-md-12">
                                        <div class="card" style="position:relative;">
                                            <div class="card-body" style="position:relative">
                                                <div class="text-center d-flex flex-column align-items-center">

                                                    <img class="img-fluid img-profile-sm"
                                                        style="position: relative;z-index: 1;"
                                                        src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                                    <div class="mt-3">
                                                        <h5 style="font-size:1vw;font-weight: bold">
                                                            {{ $empleado->name }}
                                                        </h5>
                                                        {{-- <p class="mb-1 text-secondary">
                                                            {{ $empleado->puesto }}
                                                        </p> --}}
                                                    </div>
                                                    <div>
                                                        <div class="row mb-2">
                                                            <a href="https://wa.me/{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                target="_blank" class="col-4 text-success">
                                                                <p class="m-0 fab fa-whatsapp"></p>
                                                            </a>
                                                            <a href="tel:{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                class="col-4">
                                                                <p class="m-0 fas fa-mobile-alt"></p>
                                                            </a>
                                                            <a href="mailto:{{ $empleado->email }}"
                                                                class="col-4 text-muted">
                                                                <p class="m-0 fas fa-envelope"></p>
                                                            </a>
                                                        </div>
                                                        <a class="btn btn-sm btn-light" style="font-size: 10px;"
                                                            href="{{ route('admin.ev360-objetivos-empleado.create', $empleado) }}">
                                                            <i class="mr-1 fas fa-dot-circle"></i>Objetivos</a>
                                                        <a type="button"
                                                            href="{{ route('admin.ev360-evaluaciones.evaluacionesDelEmpleado', $empleado) }}"
                                                            class="btn btn-sm btn-light" style="font-size: 10px;"
                                                            aria-current="true"><i class="fas fa-book"></i>
                                                            Evaluaciones
                                                        </a>
                                                    </div>
                                                </div>
                                                <div
                                                    style="width:100%;height: 80px;position: absolute;top: 0;left: 0;background: aliceblue;z-index: 0;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    @foreach ($equipo_trabajo as $empleado)
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body" style="position:relative">
                                                    <div class="text-center d-flex flex-column align-items-center">

                                                        <img class="img-fluid img-profile-sm"
                                                            style="position: relative;z-index: 1;"
                                                            src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                                        <div class="mt-3">
                                                            <h5 style="font-size:1vw;font-weight: bold">
                                                                {{ $empleado->name }}
                                                            </h5>
                                                            {{-- <p class="mb-1 text-secondary">
                                                            {{ $empleado->puesto }}
                                                        </p> --}}
                                                        </div>
                                                        <div class="row">
                                                            <a href="https://wa.me/{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                target="_blank" class="col-4 text-success">
                                                                <p class="m-0 fab fa-whatsapp"></p>
                                                            </a>
                                                            <a href="tel:{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"
                                                                class="col-4">
                                                                <p class="m-0 fas fa-mobile-alt"></p>
                                                            </a>
                                                            <a href="mailto:{{ $empleado->email }}"
                                                                class="col-4 text-muted">
                                                                <p class="m-0 fas fa-envelope"></p>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="width:100%;height: 80px;position: absolute;top: 0;left: 0;background: aliceblue;z-index: 0;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endforelse
                            </div>
                        </div>
                        <div class="p-3 mt-3 card" x-data="{show:false}">
                            <h5 class="mb-0"><i class="mr-2 fa-fw fas fa-laptop"></i>Mis Activos
                                <span style="float: right; cursor:pointer; margin-top: 0px;" @click="show=!show"><i
                                        class="fas" :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                            </h5>
                            <hr class="hr-custom-title">
                            <div class="row align-items-center" id="listaEquipo" x-show="show"
                                x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                <div class="container">
                                    @if (count($activos) === 0)
                                        No cuenta con activos a su cargo
                                    @else
                                        <div class="row">
                                            <div class="col-2 title-info-personal">ID</div>
                                            <div class="col-10 title-info-personal">Activo</div>
                                        </div>
                                        @foreach ($activos as $activo)
                                            <div class="row">
                                                <div class="col-2 text-muted" style="font-size:12px">
                                                    <a target="_blank"
                                                        href="{{ route('admin.activos.show', [$activo->id]) }}">
                                                        {{ $activo->id }}
                                                    </a>
                                                </div>
                                                <div class="col-10 text-muted" style="font-size:12px">
                                                    <a target="_blank"
                                                        href="{{ route('admin.activos.show', [$activo->id]) }}">
                                                        {{ $activo->nombreactivo }}
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="mb-3 card">
                            <div class="card-body">
                                <h5 class="mb-0 d-inline-block"><i class="mr-2 far fa-sticky-note"></i>Información
                                    General
                                </h5>
                                <hr class="hr-custom-title">
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->n_empleado)
                                            <div class="col-3 title-info-personal">N° Empleado</div>
                                        @endif

                                        @if ($panel_rules->email)
                                            <div class="col-3 title-info-personal">Email</div>
                                        @endif
                                        @if ($panel_rules->fecha_ingreso)
                                            <div class="col-3 title-info-personal">Fecha Ingreso</div>
                                        @endif
                                        @if ($panel_rules->jefe_inmediato)
                                            <div class="col-3 title-info-personal">Jefe Inmediato</div>
                                        @endif
                                    @endif

                                </div>
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->n_empleado)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->n_empleado }}</div>
                                        @endif
                                        @if ($panel_rules->email)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->email }}</div>
                                        @endif
                                        @if ($panel_rules->fecha_ingreso)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ \Carbon\Carbon::parse($usuario->empleado->antiguedad)->format('d-m-Y') }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->jefe_inmediato)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->supervisor ? $usuario->empleado->supervisor->name : 'Sin Jefe Inmediato' }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->area)
                                            <div class="col-3 title-info-personal">Área</div>
                                        @endif
                                        @if ($panel_rules->puesto)
                                            <div class="col-3 title-info-personal">Puesto</div>
                                        @endif
                                        @if ($panel_rules->sede)
                                            <div class="col-3 title-info-personal">Sede</div>
                                        @endif
                                        @if ($panel_rules->telefono)
                                            <div class="col-3 title-info-personal">Teléfono</div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->area)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->area ? $usuario->empleado->area->area : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->puesto)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->puesto ? $usuario->empleado->puesto : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->sede)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->sede ? $usuario->empleado->sede->sede : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                        @if ($panel_rules->telefono)
                                            <div class="col-3 text-muted" style="font-size:12px">
                                                {{ $usuario->empleado->telefono ? $usuario->empleado->telefono : 'Dato no registrado' }}
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="row">
                                    @if (!empty($panel_rules->n_empleado))
                                        @if ($panel_rules->cumpleaños)
                                            <div class="col-3 title-info-personal">Cumpleaños</div>
                                        @endif
                                        @if ($panel_rules->perfil)
                                            <div class="col-3 title-info-personal">Perfil</div>
                                        @endif
                                        {{-- @if ($panel_rules->cumpleaños)
                                            <div class="col-3 title-info-personal">Sede</div>
                                        @endif --}}
                                    @endif
                                    @if ($panel_rules->genero)
                                        <div class="col-3 title-info-personal">Género</div>
                                    @endif
                                    @if ($panel_rules->estatus)
                                        <div class="col-3 title-info-personal">Estatus</div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($panel_rules->cumpleaños)
                                        <div class="col-3 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->cumpleaños ? $usuario->empleado->cumpleaños : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                    @if ($panel_rules->perfil)
                                        <div class="col-3 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->perfil ? $usuario->empleado->perfil->nombre : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                    @if ($panel_rules->genero)
                                        <div class="col-3 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->genero ? $usuario->empleado->genero : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                    @if ($panel_rules->estatus)
                                        <div class="col-3 text-muted text-uppercase" style="font-size:12px">
                                            {{ $usuario->empleado->estatus ? $usuario->empleado->estatus : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($panel_rules->direccion)
                                        <div class="col-3 title-info-personal">Dirección</div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if ($panel_rules->direccion)
                                        <div class="col-12 text-muted" style="font-size:12px">
                                            {{ $usuario->empleado->direccion ? $usuario->empleado->direccion : 'Dato no registrado' }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row gutters-sm">
                            <div class="mb-3 col-sm-12">
                                <div class="mb-0 card h-100">
                                    <div class="pb-0 card-body" x-data="{show:false}">
                                        <div class="row">
                                            <div class="col-4">
                                                <h5 class="mb-0"><i
                                                        class="mb-1 mr-2 fas fa-bullseye"></i>Mis
                                                    Objetivos

                                                </h5>
                                            </div>
                                            <div class="col-8" style="font-size: 15px;text-align: end">
                                                <a class="mr-2 text-dark"
                                                    href="{{ route('admin.ev360-objetivos-empleado.show', ['empleado' => auth()->user()->empleado->id]) }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <span style="cursor: pointer" @click="show=!show"><i
                                                        class="fas"
                                                        :class="[show ? 'fa-minus' : 'fa-plus']"></i></span>
                                            </div>
                                        </div>
                                        <hr class="hr-custom-title">
                                        <div x-show="show" x-transition:enter.duration.500ms
                                            x-transition:leave.duration.400ms>
                                            {{-- @foreach ($lista_evaluaciones as $evaluacion)
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
                                            @endforeach --}}
                                            @foreach ($mis_objetivos as $objetivo)
                                                <div class="card" style="position:relative">
                                                    <div class="card-body"
                                                        style="z-index: 1;margin-top: 23px;margin-bottom: -12px;">
                                                        <div><strong>Meta:</strong>
                                                            <span>{{ $objetivo->objetivo->meta }}
                                                                {{ $objetivo->objetivo->metrica->definicion }}</span>
                                                            <span class="px-2">|</span>
                                                            <span>
                                                                <span style="font-weight: bold">KPI:</span>
                                                                {{ $objetivo->objetivo->KPI }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div
                                                        style="width: 100%;height: 38px;position: absolute;top: 0;left: 0;background: aliceblue;z-index: 0;">
                                                        <div>
                                                            <img src="{{ $objetivo->objetivo->tipo->imagen_ruta }}"
                                                                class="d-inline-block"
                                                                style="clip-path: circle(9px at 50% 50%);width: 18px;position: absolute;top: 9px;left: 20px;">
                                                            <h6 class="d-inline-block"
                                                                style="padding-left: 41px;font-weight: bold;margin-top: 10px;">
                                                                {{ $objetivo->objetivo->nombre }}</h6>
                                                            <span
                                                                style="float: right;margin-top: 12px;margin-right: 7px;"
                                                                class="badge badge-success">{{ $objetivo->objetivo->tipo->nombre }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <div class="mb-0 card h-100">
                                    <div class="pb-0 card-body" x-data="{show:false}">
                                        <h5 class="mb-0 d-inline-block"><i class="mr-2 fas fa-edit"></i>Mi
                                            Autoevaluación
                                        </h5>
                                        @if ($last_evaluacion)
                                            @include('admin.inicioUsuario.info_card_evaluacion')
                                        @endif
                                        <hr class="hr-custom-title">
                                        <div id="evaluacionesRealizar" x-show="show" x-transition:enter.duration.500ms
                                            x-transition:leave.duration.400ms>
                                            <div class="card" style="position:relative">
                                                <div class="card-body" style="z-index: 1">

                                                    {{-- <div class="progress-bar" role="progressbar" style="width: 25%;
                                                            background: #00abb2;
                                                            font-weight: bold;
                                                            font-size: 13px;" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100">25%</div> --}}
                                                    @if ($last_evaluacion)
                                                        @if ($mis_evaluaciones)
                                                            <div class="progress" style="height: 28px;">
                                                                <div class="progress-bar" role="progressbar"
                                                                    style="width: {{ $mis_evaluaciones->progreso_competencias }}%;background: #00abb2;font-weight: bold;font-size: 13px;"
                                                                    aria-valuenow="
                                                                {{ $mis_evaluaciones->progreso_competencias }}"
                                                                    aria-valuemin="0" aria-valuemax="100">
                                                                    {{ $mis_evaluaciones->progreso_competencias }}%
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="mt-3">
                                                            <a class="btn btn-sm btn-light"
                                                                href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $last_evaluacion->id, 'evaluado' => auth()->user()->empleado->id, 'evaluador' => auth()->user()->empleado->id]) }}"><i
                                                                    class="mr-1 fas fa-link"
                                                                    style="font-size:11px;"></i>
                                                                Autoevaluarme</a>
                                                            <a class="btn btn-sm btn-light"
                                                                href="{{ route('admin.ev360-evaluaciones.misEvaluaciones', ['evaluacion' => $last_evaluacion->id, 'evaluado' => auth()->user()->empleado->id]) }}"><i
                                                                    class="mr-1 fas fa-link"
                                                                    style="font-size:11px;"></i>Ver
                                                                mis Autoevaluaciones</a>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div
                                                    style="width: 100%;height: 38px;position: absolute;top: 0;left: 0;background: aliceblue;z-index: 0;">
                                                    <div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-sm-12">
                                <div class="mb-0 card h-100">
                                    <div class="pb-0 mb-0 card-body" x-data="{show:false}">
                                        <h5 class="mb-0 d-inline-block"><i class="mr-2 fas fa-edit"></i>Evaluaciones a
                                            Realizar
                                            <div class="circle-total-evaluaciones">
                                                <span
                                                    style="position: absolute;top: 3px;">{{ $evaluaciones->count() }}</span>
                                            </div>
                                        </h5>
                                        @if ($last_evaluacion)
                                            @include('admin.inicioUsuario.info_card_evaluacion')
                                        @endif
                                        <hr class="hr-custom-title">

                                        <div id="evaluacionesRealizar" class="row" x-show="show"
                                            x-transition:enter.duration.500ms x-transition:leave.duration.400ms>
                                            @if ($evaluaciones->count())
                                                @foreach ($evaluaciones as $evaluacion)
                                                    <div class="col-md-6">
                                                        <div class="card">
                                                            <div class="card-body" style="position:relative">
                                                                <div
                                                                    class="text-center d-flex flex-column align-items-center">

                                                                    <img class="img-fluid img-profile-sm"
                                                                        style="position: relative;z-index: 1;"
                                                                        src="{{ asset('storage/empleados/imagenes') }}/{{ $evaluacion->empleado_evaluado->avatar }}">
                                                                    <div class="mt-3">
                                                                        <h5 style="font-size:1vw;font-weight: bold">
                                                                            {{ $evaluacion->empleado_evaluado->name }}
                                                                        </h5>
                                                                        <p class="mb-1 text-secondary">
                                                                            {{ $evaluacion->empleado_evaluado->puesto }}
                                                                        </p>
                                                                    </div>
                                                                    <div>
                                                                        <a class="btn btn-sm btn-light"
                                                                            href="{{ route('admin.ev360-evaluaciones.contestarCuestionario', ['evaluacion' => $evaluacion->evaluacion, 'evaluado' => $evaluacion->empleado_evaluado, 'evaluador' => $evaluacion->evaluador]) }}"><i
                                                                                class="mr-1 fas fa-link"
                                                                                style="font-size:11px;"></i> Evaluar</a>
                                                                        {{-- @if ($evaluacion->empleado_evaluado->supervisor)
                                                                        @if (auth()->user()->empleado->id == $evaluacion->empleado_evaluado->supervisor->id)
                                                                            <span
                                                                                style="position: absolute;top: 7px;z-index: 1;right: 7px;"
                                                                                class="badge badge-success">Eres su
                                                                                supervisor</span>
                                                                            <span
                                                                                class="btn btn-sm btn-light sendInvitacion">
                                                                                <i data-evaluacion={{ $evaluacion->evaluacion->id }}
                                                                                    data-evaluado={{ $evaluacion->empleado_evaluado->id }}
                                                                                    data-evaluador={{ $evaluacion->evaluador->id }}
                                                                                    title="Solicitar reunión"
                                                                                    class="fas fa-envelope-open-text"
                                                                                    style="font-size:11px;"></i>
                                                                                Reunión
                                                                            </span>
                                                                        @endif
                                                                    @endif --}}
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    style="width:100%;height: 80px;position: absolute;top: 0;left: 0;background: aliceblue;z-index: 0;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif
                                            {{-- @foreach ($evaluaciones as $evaluacion)
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
                                            @endforeach --}}
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
                <h5 class="modal-title" id="invitacionModalLabel"><i class="mr-2 fas fa-plus"></i>Crear Reunión
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

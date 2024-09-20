@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile/inicio_usuario.css') }}{{ config('app.cssVersion') }}">
@endsection
@section('content')

    <div class="d-flex" style="gap: 30px;">
        <div class="w-100">
            <div class="header-card-iu">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-end">
                        <h4 class="title-name-user">{{ $empleado->name }}</h4>
                        <small class="ml-3">
                            <i class="fa-solid fa-location-dot"></i>
                            Torre Murano
                        </small>
                    </div>
                    <div style="text-align: center;">
                        <span>Estatus</span> <br>
                        <span class="estatus-user"
                            style="background-color: #D2FDB8; color: #04B716;">{{ strtoupper($empleado->estatus) }}
                        </span>
                    </div>
                </div>
                <div>
                    Nº de empleado: <span>{{ $empleado->n_empleado }}</span>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="d-flex">
                    <div class=" info-blue-user">
                        <div class="img-person" style="width: 205px; height: 205px;">
                            <img src="{{ asset('storage/empleados/imagenes/' . '/' . $empleado->avatar) }}" alt="">
                        </div>
                        <div class="mt-4">
                            <a href="{{ route('admin.miCurriculum', $empleado->id) }}">Ver perfil profesional</a>
                            <br>
                            <a href="{{ route('admin.inicio-Usuario.perfil-puesto') }}">Ver perfil de puesto</a> <br>
                            <a href="{{ route('admin.inicio-Usuario.expediente', $empleado->id) }}">Mi
                                expediente</a>
                        </div>
                        <div class="mt-4">
                            <strong>Email</strong><br>
                            {{ $empleado->email }}
                        </div>
                        <div class="mt-4">
                            <strong>Teléfono</strong><br>
                            {{ $empleado->telefono }}
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="title-user-card">
                            @if (isset($empleado->area->area))
                                {{ $empleado->area->area }}
                            @endif
                        </h3>
                        <span> {{ $empleado->puesto }}</span>
                        <hr class="my-4">
                        <div class=" caja-info-user-main">
                            <div>
                                <span>Género</span><br>
                                {{ $empleado->genero }}
                            </div>
                            <div>
                                <span>Perfil</span><br>
                                {{ $empleado->puesto }}
                            </div>
                            <div>
                                <span>Fecha de ingreso</span><br>
                                {{ $empleado->fecha_ingreso }}
                            </div>
                            <div>
                                <span>Jefe inmediato</span><br>
                                {{ $empleado->jefe_inmediato }}
                            </div>
                            <div>
                                <span>Cumpleaños</span><br>
                                {{ $empleado->actual_birdthday }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100" style="max-width: 600px;">
            <div class="header-card-iu d-flex caja-btn-user" style="padding: 20px 0px;">
                <button class="btn tab-my-team" onclick="miCard('#user-equipo')">
                    <i class="material-symbols-outlined">contacts</i>
                    Mi&nbsp;equipo
                </button>
                <button class="btn tab-my-actives" onclick="miCard('#user-activos')">
                    <i class="material-symbols-outlined">devices</i>
                    Mis&nbsp;activos
                </button>
                <button class="btn tab-my-actives" onclick="miCard('#user-competencias')">
                    <i class="material-symbols-outlined">star</i>
                    Mis&nbsp;Competencias
                </button>
            </div>
            <div class="card card-body">
                <div id="user-equipo" class="mis-cards active">
                    <h3 class="title-user-card">Mi equipo</h3>
                    <hr class="mt-4">
                    <div class="caja-equipo content-mi-card scroll_estilo">
                        @forelse ($equipo_a_cargo as $empleado_cargo)
                            <div class="d-flex align-items-center mt-4" style="gap: 30px;">
                                <div class="img-person" style="width: 90px; height:90px;">
                                    <img src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado_cargo->avatar }}"
                                        alt="">
                                </div>
                                <div>
                                    <p class="mb-1">
                                        <strong>{{ $empleado_cargo->name }}</strong>
                                    </p>
                                    <p>
                                        {{ $empleado_cargo->email }}
                                    </p>
                                    <div class="caja-btns-op-equipo-user">
                                        <a
                                            href="tel:{{ $empleado_cargo->telefono_movil ? $empleado_cargo->telefono_movil : $empleado_cargo->telefono }}">
                                            <i class="bi bi-phone"></i>
                                        </a>
                                        <a
                                            href="https://wa.me/{{ $empleado_cargo->telefono_movil ? $empleado_cargo->telefono_movil : $empleado_cargo->telefono }}">
                                            <i class="bi bi-whatsapp"></i>
                                        </a>
                                        <a href="mailto:{{ $empleado_cargo->email }}">
                                            <i class="bi bi-envelope"></i>
                                        </a>
                                        <a href="{{ route('admin.editarCompetencias', $empleado_cargo) }}">
                                            <i class="material-symbols-outlined">
                                                contract_edit
                                            </i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            @foreach ($equipo_trabajo as $empleado_trabajo)
                                <div class="d-flex align-items-center mt-4" style="gap: 30px;">
                                    <div class="img-person" style="width: 90px; height:90px;">
                                        <img src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado_trabajo->avatar }}"
                                            alt="">
                                    </div>
                                    <div>
                                        <p class="mb-1">
                                            <strong>{{ $empleado_trabajo->name }}</strong>
                                        </p>
                                        <p>
                                            {{ $empleado_trabajo->email }}
                                        </p>
                                        <div class="caja-btns-op-equipo-user">
                                            <a
                                                href="tel:{{ $empleado_trabajo->telefono_movil ? $empleado_trabajo->telefono_movil : $empleado_trabajo->telefono }}">
                                                <i class="bi bi-phone"></i>
                                            </a>
                                            <a
                                                href="https://wa.me/{{ $empleado_trabajo->telefono_movil ? $empleado_trabajo->telefono_movil : $empleado_trabajo->telefono }}">
                                                <i class="bi bi-whatsapp"></i>
                                            </a>
                                            <a href="mailto:{{ $empleado_trabajo->email }}">
                                                <i class="bi bi-envelope"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endforelse

                    </div>
                </div>
                <div id="user-activos" class="mis-cards">
                    <h3 class="title-user-card">Mis activos</h3>
                    <hr class="mt-4">


                    <div class="caja-activos content-mi-card scroll_estilo"">

                        @if ($activos)
                            @foreach ($activos as $activo)
                                <div class="mt-5 d-flex align-items-center" style="gap: 15px;">
                                    <div class="icon-activo">
                                        <i class="material-symbols-outlined"> laptop_mac</i>
                                    </div>
                                    <div class="info-activo">
                                        <strong>ACT-{{ $activo->id }}</strong> <br>
                                        <strong>{{ $activo->nombreactivo }}</strong> <br><br>
                                        <strong>Serie: </strong> {{ $activo->descripcion }}
                                    </div>
                                </div>
                            @endforeach
                        @else
                            &nbsp;
                        @endif
                    </div>

                </div>
                <div id="user-competencias" class="mis-cards">
                    <h3 class="title-user-card">Mis competencias</h3>
                    <hr class="mt-4">

                    <div class="caja-competencias content-mi-card scroll_estilo"">

                        @foreach ($competencias as $competencia)
                            @if ($competencia->competencia)
                                <div class="mt-5 d-flex align-items-center" style="gap: 15px;">
                                    <div class="">
                                        <img src="{{ $competencia->competencia->imagen_ruta }}" alt=""
                                            style="width: 50px;">
                                    </div>
                                    <div class="info-activo">
                                        <strong>{{ $competencia->competencia->nombre }}</strong> <br>
                                        <strong>Nivel: </strong> {{ $competencia->nivel_esperado }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div class="card card-body" style="background-color: #D8E1EC !important">
        <h4 class="title-ob-ev">Objetivos y Evaluaciones</h4>

        <div class="d-flex flex-wrap mt-4" style="gap: 25px;">

            <a href="{{ route('admin.ev360-objetivos-empleado.show', ['empleado' => $empleado->id]) }}">
                <div class="item-ob-ev" style="background-color: #2478B8;">
                    <div class="img-ob-ev">
                        <img src="{{ asset('img/inicio_usuario/objetivos.png') }}" alt="">
                    </div>
                    <div class="info-ob-ev">
                        <h5>Mis objetivos</h5>
                        <p><small>Ver mis objetivos</small></p>
                    </div>
                </div>
            </a>

            @if ($mostrarCargaObjetivos)
            <a
                href="{{ route('admin.rh.evaluaciones-desempeno.carga-objetivos-empleado', ['empleado' => $empleado->id]) }}">
                <div class="item-ob-ev" style="background-color: #2478B8;">
                    <div class="img-ob-ev">
                        <img src="{{ asset('img/inicio_usuario/objetivos.png') }}" alt="">
                    </div>
                    <div class="info-ob-ev">
                        <h5>Cargar Objetivos</h5>
                        <p><small>Cargar objetivos de la Evaluación por Periodo</small></p>
                    </div>
                </div>
            </a>
            @endif

            @if ($mostrarCargaObjetivosArea)
            <a
                href="{{ route('admin.rh.evaluaciones-desempeno.carga-objetivos-area', ['area' => $empleado->area_id]) }}">
                <div class="item-ob-ev" style="background-color: #117994;">
                    <div class="img-ob-ev">
                        <img src="{{ asset('img/reunion.png') }}" alt="">
                    </div>
                    <div class="info-ob-ev">
                        <h5>Equipo: Mis Objetivos</h5>
                        <p><small>Habilitado</small></p>
                    </div>
                </div>
            </a>
            @endif

            <a href="" class="d-none">
                <div class="item-ob-ev" style="background-color: #249AB8;">
                    <div class="img-ob-ev">
                        <img src="{{ asset('img/inicio_usuario/ev_tri.png') }}" alt="">
                    </div>
                    <div class="info-ob-ev">
                        <h5>Mi Evaluación Trimestral 2024</h5>
                        <p><small>Ver mi evaluación trimestral</small></p>
                    </div>
                </div>
            </a>

            @if ($redirigirEvaluacion)
                <a
                    href="{{ route('admin.rh.evaluaciones-desempeno.cuestionario', [
                        'evaluacion' => $id_evaluacion,
                        'evaluado' => $id_evaluado,
                        'periodo' => $id_periodo,
                    ]) }}">
                    <div class="item-ob-ev" style="background-color: #19A877;">
                        <div class="img-ob-ev">
                            <img src="{{ asset('img/inicio_usuario/ev360.png') }}" alt="">
                        </div>
                        <div class="info-ob-ev">
                            <h5>Evaluación de Desempeño</h5>
                            <p><small>Calificar Evaluación de Desempeño</small></p>
                        </div>
                    </div>
                </a>
            @endif

            @if (isset($mis_evaluaciones->evaluacion) && $mis_evaluaciones->evaluacion->estatus == 2)
                <a
                    href="{{ url('admin/recursos-humanos/evaluacion-360/evaluaciones/' . $mis_evaluaciones->evaluacion->id . '/evaluacion/' . $usuario->empleado->id . '/' . $usuario->empleado->id) }}">

                    <div class="item-ob-ev" style="background-color: #19A877;">
                        <div class="img-ob-ev">
                            <img src="{{ asset('img/inicio_usuario/ev360.png') }}" alt="">
                        </div>
                        <div class="info-ob-ev">
                            <h5>Evaluación 360</h5>
                            <p><small>Ver mi evaluación 360</small></p>
                        </div>
                    </div>
                </a>
            @elseif (isset($como_evaluador->evaluacion) && $como_evaluador->evaluacion->estatus == 2)
                <a
                    href="{{ url('admin/recursos-humanos/evaluacion-360/vista-evaluador/' . $como_evaluador->evaluacion->id . '/evaluacion/' . $usuario->empleado->id . '/evaluador') }}">

                    <div class="item-ob-ev" style="background-color: #19A877;">
                        <div class="img-ob-ev">
                            <img src="{{ asset('img/inicio_usuario/ev360.png') }}" alt="">
                        </div>
                        <div class="info-ob-ev">
                            <h5>Evaluación 360</h5>
                            <p><small>Evaluar colaboradores</small></p>
                        </div>
                    </div>
                </a>
            @endif

            {{-- Inhabilitado temporalmente --}}
            @if (isset($mis_evaluaciones->evaluacion))
                @if ($mis_evaluaciones->evaluacion->estatus == 2 || $mis_evaluaciones->evaluacion->estatus == 3)
                    <a
                        href="{{ route('admin.ev360-evaluaciones.autoevaluacion.consulta.evaluado', [$mis_evaluaciones->evaluacion->id, auth()->user()->empleado->id]) }}">

                        <div class="item-ob-ev" style="background-color: #249AB8;">
                            <div class="img-ob-ev">
                                <img src="{{ asset('img/inicio_usuario/ev_tri.png') }}" alt="">
                            </div>
                            <div class="info-ob-ev">
                                <h5>Revisar mis resultados Ev360 2024</h5>
                                <p><small>Ver mis resultados de la evaluacion</small></p>
                            </div>
                        </div>
                    </a>
                @endif
            @endif

        </div>
    </div>

@endsection

@section('scripts')
    <script src={{ asset('js/profile/tabs.js') }}></script>
@endsection

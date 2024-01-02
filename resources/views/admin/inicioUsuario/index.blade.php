@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/inicio_usuario.css') }}">
@endsection
@section('content')
    <div class="d-flex" style="gap: 30px;">
        <div class="w-100">
            <div class="header-card-iu">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="d-flex align-items-end">
                        <h4 class="title-name-user">Carlos Fernando Alberto Crúz Andrade</h4>
                        <small class="ml-3">
                            <i class="fa-solid fa-location-dot"></i>
                            Torre Murano
                        </small>
                    </div>
                    <div style="text-align: center;">
                        <span>Estatus</span> <br>
                        <span class="estatus-user" style="background-color: #D2FDB8; color: #04B716;">Alta</span>
                    </div>
                </div>
                <div>
                    Nº de empelado <span>0000</span>
                </div>
            </div>
            <div class="card overflow-hidden">
                <div class="d-flex">
                    <div class=" info-blue-user">
                        <div class="img-person" style="width: 205px; height: 205px;">
                            <img src="{{ asset('') }}" alt="">
                        </div>
                        <div class="mt-4">
                            <a href="">Ver perfil profesional</a> <br>
                            <a href="">Ver perfil de puesto</a> <br>
                            <a href="">Mi expediente</a>
                        </div>
                        <div class="mt-4">
                            <strong>Email</strong><br>
                            nombre@dominio.com
                        </div>
                        <div class="mt-4">
                            <strong>Teléfono</strong><br>
                            55 5555 5555
                        </div>
                    </div>
                    <div class="modal-body">
                        @if (!empty($panel_rules->n_empleado))
                            @if ($panel_rules->n_empleado)
                                <div class="form-group">
                                    <label><i class="bi bi-person iconos-crear"></i>N° Empleado</label>
                                    <div class="text-muted">
                                        {{ $usuario->empleado->n_empleado ?? "Sin registro" }}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->email)
                                <div class="form-group">
                                    <label><i class="bi bi-envelope iconos-crear"></i> Email</label>
                                    <div class="text-muted">
                                        {{ $usuario->empleado->email ?? "Sin registro"}}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->fecha_ingreso)
                                <div class="form-group">
                                    <label><i class="bi bi-calendar2-event iconos-crear"></i> Fecha de ingreso</label>
                                    <div class="text-muted">
                                        {{ \Carbon\Carbon::parse($usuario->empleado->antiguedad)->format('d/m/Y') ?? "Sin registro"}}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->jefe_inmediato)
                                <div class="form-group">
                                    <label><i class="bi bi-person iconos-crear"></i> Jefe inmediato</label>
                                    <div class="text-muted">
                                        {{  $usuario->empleado->name ?? 'Sin Jefe Inmediato' }}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->area)
                                <div class="form-group">
                                    <label><i class="bi bi-diagram-3 iconos-crear"></i> Área</label>
                                    <div class="text-muted">
                                        {{  $usuario->empleado->area->area ?? 'Dato no registrado' }}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->puesto)
                                <div class="form-group">
                                    <label><i class="bi bi-person-badge iconos-crear"></i> Puesto</label>
                                    <div class="text-muted">
                                        {{ $usuario->empleado->puesto ?? 'Dato no registrado' }}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->sede)
                                <div class="form-group">
                                    <label><i class="bi bi-building iconos-crear"></i> Sede</label>
                                    <div class="text-muted">
                                        {{ $usuario->empleado->sede ?? 'Dato no registrado' }}
                                    </div>
                                </div>
                            @endif
                            @if ($panel_rules->telefono)
                                <div class="form-group">
                                    <label><i class="bi bi-telephone iconos-crear"></i> Teléfono</label>
                                    <div class="text-muted">
                                        {{  $usuario->empleado->telefono ?? 'Dato no registrado' }}
                                    </div>
                                </div>
                            @endif
                        @endif

                        @if ($panel_rules->cumpleaños)
                            <div class="form-group">
                                <label><i class="bi bi-calendar4-event iconos-crear"></i> Cumpleaños</label>
                                <div class="text-muted">
                                    {{ \Carbon\Carbon::parse($usuario->empleado->cumpleaños)->format('d-m-Y') ?? 'Dato no registrado' }}
                                </div>
                            </div>
                        @endif
                        @if ($panel_rules->perfil)
                            <div class="form-group">
                                <label><i class="bi bi-person-badge iconos-crear"></i> Perfil</label>
                                <div class="text-muted">
                                    {{ $usuario->empleado->perfil->nombre ?? 'Dato no registrado' }}
                                </div>
                            </div>
                        @endif
                        @if ($panel_rules->genero)
                            <div class="form-group">
                                <label><i class="bi bi-person iconos-crear"></i> Genero</label>
                                <div class="text-muted">
                                    {{ $usuario->empleado->genero ?? 'Dato no registrado' }}
                                </div>
                            </div>
                        @endif
                        @if ($panel_rules->estatus)
                            <div class="form-group">
                                <label><i class="bi bi-reception-3 iconos-crear"></i> Estatus</label>
                                <div class="text-muted">
                                    {{ $usuario->empleado->estatus ?? 'Dato no registrado' }}
                                </div>
                            </div>
                        @endif
                        @if ($panel_rules->direccion)
                            <div class="form-group">
                                <label><i class="bi bi-geo-alt iconos-crear"></i> Dirección</label>
                                <div class="text-muted">
                                    {{ $usuario->empleado->direccion ?? 'Dato no registrado' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- modal mi equipo mobile --}}
        <div class="modal fade" id="mi_equipo_mobile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel" style="color: #3086AF;">Mi Equipo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @forelse ($equipo_a_cargo as $empleado)
                            <div class="caja-lis-mi-equipo-mobile">
                                <div class="d-flex mt-4">
                                    <img class="img_empleado" src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                    <div class="w-100">
                                        <h6 class="w-100 m-0" style="color: #3086AF;">{{ $empleado->name }}</h6>
                                        <div class="d-flex mt-2">
                                            <a class="mr-5" style="font-size:20px; color: #345183;" href="https://wa.me/{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                            <a class="mr-5" style="font-size:20px; color: #345183;" href="tel:{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"><i class="fas fa-mobile-alt"></i></a>
                                            <a class="mr-5" style="font-size:20px; color: #345183;" href="mailto:{{ $empleado->email }}"><i class="fas fa-envelope"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @empty
                            @foreach ($equipo_trabajo as $empleado)
                                <div class="caja-lis-mi-equipo-mobile">
                                    <div class="d-flex mt-4">
                                        <img class="img_empleado" src="{{ asset('storage/empleados/imagenes') }}/{{ $empleado->avatar }}">
                                        <div class="w-100">
                                            <h6 class="w-100 m-0" style="color: #3086AF;">{{ $empleado->name }}</h6>
                                            <div class="d-flex mt-2">
                                                <a class="mr-5" style="font-size:20px; color: #345183;" href="https://wa.me/{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                <a class="mr-5" style="font-size:20px; color: #345183;" href="tel:{{ $empleado->telefono_movil ? $empleado->telefono_movil : $empleado->telefono }}"><i class="fas fa-mobile-alt"></i></a>
                                                <a class="mr-5" style="font-size:20px; color: #345183;" href="mailto:{{ $empleado->email }}"><i class="fas fa-envelope"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        @endforelse

                        <div class="text-right mt-5">
                            <button type="button" class="btn btn_cancelar" data-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card card-body">
                <div id="user-equipo" class="">
                    <h3 class="title-user-card">Mi equipo</h3>
                    <hr class="my-4">
                    <div class="caja-equipo">
                        <div class="d-flex align-items-center" style="gap: 30px;">
                            <div class="img-person" style="width: 90px; height:90px;">
                                <img src="" alt="">
                            </div>
                            <div>
                                <p class="mb-1">
                                    <strong>Mauricio David Blancas García</strong>
                                </p>
                                <p>
                                    Mauricio.blancas@silent4business.com
                                </p>
                                <div class="caja-btns-op-equipo-user">
                                    <a href=""><i class="bi bi-phone"></i></a>
                                    <a href=""><i class="bi bi-whatsapp"></i></a>
                                    <a href=""><i class="bi bi-envelope"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-body" style="background-color: #D8E1EC !important">
        <img src="{{ asset('img/example-remove/iidds.png') }}" alt="" style="width: 60%;">
    </div>
@endsection

@section('scripts')
@endsection

@extends('layouts.admin')
@section('css')
    <link rel="stylesheet" href="{{ asset('css/inicio_usuario.css') }}">
@endsection
@section('content')
    @include('partials.menu-slider')
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
                            <img src="{{ asset('storage/empleados/imagenes/' . '/' . $usuario->empleado->avatar) }}"
                                alt="">
                        </div>
                        <div class="mt-4">
                            <a href="">Ver perfil profesional</a> <br>
                            <a href="">Ver perfil de puesto</a> <br>
                            <a href="">Mi expediente</a>
                        </div>
                        <div class="mt-4">
                            <strong>Email</strong><br>
                            {{ $usuario->empleado->email }}
                        </div>
                        <div class="mt-4">
                            <strong>Teléfono</strong><br>
                            {{ $usuario->empleado->telefono }}
                        </div>
                    </div>
                    <div class="card-body">
                        <h3 class="title-user-card">Innovación y Desarrollo</h3>
                        <span>Desarrollador Full Stack</span>
                        <hr class="my-4">
                        <div class=" caja-info-user-main">
                            <div>
                                <span>Genero</span><br>
                                {{ $usuario->empleado->genero }}
                            </div>
                            <div>
                                <span>Perfil</span><br>
                                Gerente
                            </div>
                            <div>
                                <span>fecha de ingreso</span><br>
                                21-12-22
                            </div>
                            <div>
                                <span>Jefe inmediato</span><br>
                                Juan Francisco Curiel Morales
                            </div>
                            <div>
                                <span>Cumpleaños</span><br>
                                21-12-22
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-100" style="max-width: 600px;">
            <div class="header-card-iu d-flex caja-btn-user" style="padding: 20px 0px;">
                <button class="btn" style="background-color: #B8DFE1;">
                    <i class="material-symbols-outlined">contacts</i>
                    Mi&nbsp;equipo
                </button>
                <button class="btn" style="background-color: #D3ECEC;">
                    <i class="material-symbols-outlined">devices</i>
                    Mis&nbsp;activos
                </button>
                <button class="btn" style="background-color: #CCE2E2;">
                    <i class="material-symbols-outlined">star</i>
                    Mis&nbsp;Competencias
                </button>
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

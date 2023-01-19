<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('panel.site_title') }}</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            margin-top: 20px;
            background: #f6f9fc;
        }

        .logo-tabantaj {
            width: 10%;
            clip-path: circle(70% at 50% 50%);
        }

        .usuario-bloqueado-foto {
            width: 25%;
            clip-path: circle(50% at 50% 50%);
        }

        .account-block img {
            width: 100%;
            clip-path: circle(70% at 50% 50%);
        }

        .account-block .account-testimonial {
            text-align: center;
            color: #fff;
            position: absolute;
            margin: 0 auto;
            padding: 0 1.75rem;
            bottom: 3rem;
            left: 0;
            right: 0;
        }

        .text-theme {
            color: #5369f8 !important;
        }

        .btn-theme {
            background-color: #5369f8;
            border-color: #5369f8;
            color: #fff;
        }

    </style>
</head>

<body>
    <div id="main-wrapper" class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="border-0 card">
                    <div class="p-0 card-body">
                        <div class="row no-gutters">
                            <div class="col-lg-12">
                                <div class="container pt-4 pb-3">
                                    <div class="row align-items-center" style="position: relative;">
                                        <div class="text-center col-12">
                                            {{-- <h3 class="h4 font-weight-bold text-theme padding">Bloqueo de Usuario</h3> --}}
                                        </div>
                                        <img class="logo-tabantaj" src="{{ asset('img/logo_policromatico_2.png') }}"
                                            class="img-fluid" style="position: absolute;top:5px;left: 30px;">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center col-lg-12">
                                <div class="px-5">
                                    @if (auth()->user()->empleado)
                                        <div class="text-center">
                                            {{-- <img src="{{ asset('storage/empleados/imagenes/' . auth()->user()->empleado->avatar) }}"
                                                class="usuario-bloqueado-foto img-fluid" alt=""> --}}
                                            <img src="{{ asset('img/cancel-user.svg') }}" class="img-fluid"
                                                style="width:60%" alt="">
                                        </div>
                                        <h2 class="mt-4 mb-0 h1 text-theme">Sin
                                            acceso
                                            a la plataforma
                                        </h2>
                                        <p class="mt-3 mb-2 text-muted" style="font-size:14px">Hola
                                            {{ auth()->user()->empleado->name }}, ponte en
                                            contacto con el
                                            administrador para
                                            resolver
                                            este conflicto</p>
                                    @else
                                        <div class="text-center">
                                            <img src="{{ asset('img/cancel-user.svg') }}" class="img-fluid"
                                                style="width:60%" alt="">
                                        </div>
                                        <h2 class="mt-4 mb-0 h1 text-theme">Sin
                                            acceso
                                            a la plataforma
                                        </h2>
                                        <p class="mt-3 mb-2 text-muted" style="font-size:14px">Hola
                                            {{ auth()->user()->name }}, ponte en contacto
                                            con el
                                            administrador para
                                            resolver
                                            este conflicto</p>
                                    @endif
                                    <form id="logoutform" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                    @if (auth()->user()->is_active)
                                        <a class="text-muted"
                                            href="{{ route('admin.inicio-Usuario.index') }}">Inicio</a>
                                    @else
                                        <a class="mb-4 btn btn-sm btn-danger" title="Salir"
                                            onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                            <i class="fas fa-power-off"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            {{-- <div class="col-lg-6 d-none d-lg-inline-block">
                                <div class="account-block rounded-right">
                                    <img src="{{ asset('img/logo_policromatico_2.png') }}" class="img-fluid"
                                        alt="">
                                </div>
                            </div> --}}
                        </div>

                    </div>
                    <!-- end card-body -->
                </div>
                <!-- end card -->
                <!-- end row -->

            </div>
            <!-- end col -->
        </div>
        <!-- Row -->
    </div>
</body>

</html>

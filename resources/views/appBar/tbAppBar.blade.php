<header>
    <div class="content-header-blue">
        <div class="caja-inicio-options-header">
            <button class="btn-menu-header" style="height: 40px;" onclick="menuHeader();">
                <div class="line-menu">
                    <hr>
                </div>
            </button>
            <a href="{{ url('/admin/portal-comunicacion') }}"><img src="{{ asset('img/logo-ltr.png') }}"
                    alt="Logo Tabantaj" style="height: 40px;"></a>
            @livewire('global-search-component', ['lugar' => 'header'])
        </div>
        @if ($empleado)
            <ul class="ml-auto c-header-nav">
                <li class="c-header-nav-item dropdown show">
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button"
                        aria-haspopup="true" aria-expanded="false">
                        <div style="width:100%; display: flex; align-items: center;">
                            @if ($empleado)
                                <div style="width: 40px; overflow:hidden;" class="mr-2">
                                    <img class="img_empleado" style=""
                                        src="{{ asset('storage/empleados/imagenes/' . '/' . $empleado->avatar) }}"
                                        alt="{{ $empleado->name }}">
                                </div>
                                <div class="d-mobile-none">
                                    <span class="mr-2" style="font-weight: bold;">
                                        {{ $empleado ? explode(' ', $empleado->name)[0] : '' }}
                                    </span>
                                    {{-- <p class="m-0" style="font-size: 8px">
                                        {{ $usuario->empleado ? Str::limit($usuario->empleado->puesto, 30, '...') : '' }}
                                    </p> --}}
                                </div>
                            @else
                                <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                            @endif
                        </div>
                    </a>

                    @if ($empleado === null)
                        <div class="p-3 mt-3 text-center dropdown-menu dropdown-menu-right hide"
                            style="width:100px; box-shadow: 0px 3px 6px 1px #00000029; border-radius: 4px; border:none;">
                            <div class="px-3 mt-1 d-flex justify-content-center">
                                <a style="all: unset; color: #747474; cursor: pointer;"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Salir
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="p-3 mt-3 text-center dropdown-menu dropdown-menu-right hide"
                            style="width:300px; box-shadow: 0px 3px 6px 1px #00000029; border-radius: 4px; border:none;">
                            <div class="p-2">
                                <p class="m-0 mt-2 text-muted" style="font-size:14px">Hola,
                                    <strong>{{ $empleado->name }}</strong>
                                </p>
                            </div>
                            <div class="px-3 mt-1 d-flex justify-content-center">
                                @if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
                                    @can('profile_password_edit')
                                        <a style="all: unset; color: #747474; cursor: pointer;"
                                            class=" {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}"
                                            href="{{ route('profile.password.edit') }}">
                                            <i class="bi bi-gear"></i>
                                            Configurar Perfil
                                        </a>
                                    @endcan
                                @endif
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <font style="color: #747474;">|</font>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <a style="all: unset; color: #747474; cursor: pointer;"
                                    onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                    <i class="bi bi-box-arrow-right"></i> Salir
                                </a>
                            </div>
                        </div>
                    @endif
                </li>
            </ul>
        @endif
    </div>
    @include('menuBurger.tbMenuBurger')
    <div class="bg-black-header-menu" onclick="menuHeader();"></div>
    <script src="{{asset('js/appBar/appBar.js')}}"></script>
</header>

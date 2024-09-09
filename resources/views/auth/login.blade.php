@extends('layouts.app')
@section('classBody', $errors->has('email') ? ' is-invalid' : 'animate-active')
@section('content')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/auth/TBIconTabantaj.png') }}">
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/auth/TBlogin.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection


<div id="login" class="fondo clase_animacion">
    <div class="caja_marca">
        <div class="marca">
            <br>
            <img class="d-mobile-none" src="{{ asset('img/auth/TBlogoLogin.png') }}"><br>
            <p class="by d-mobile-none">By <strong>Silent</strong>for<strong>Business</strong></p>
            <p class="bienvenidos d-mobile-none"><strong>Bienvenidos al</strong> Sistema Integral de Gestión Empresarial
            </p>
        </div>
    </div>

    @if (session('message'))
        <div class="alert alert-info" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="caja_form">
        <form method="POST" action="{{ route('login') }}" style="height:513px;">
            @csrf

            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::getLogo();
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'img/auth/TBlogoLogin.png';
                }
            @endphp

<<<<<<< HEAD
        <div class="box-logo-org">
            <img src="{{ asset($logotipo) }}" alt="Logo de la Organizacion">
        </div>

        <div class="text-iniciar">
            Iniciar Sesión
        </div>

        <div class="input-item {{ $errors->has('email') ? ' is-invalid ' : '' }}">
            <label for="email" class="icon icon-box">
                <img src="{{ asset('img/auth/icon-person.svg') }}" alt="Icon person">
            </label>
            <input id="email" name="email" type="text" required autocomplete="email"
                placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
        </div>



        <div class="input-item {{ $errors->has('email') ? ' is-invalid' : '' }}">
            <label for="password" class="icon icon-box">
                <img src="{{ asset('img/auth/icon-lock.svg') }}" alt="Icon person">
            </label>
            <input id="password" name="password" type="password" required
                placeholder="{{ trans('global.login_password') }}">
        </div>

        <div class="button-item">
            <button type="submit" class="btn_enviar">Entrar</button>
        </div>

        <div class="box-links">
            @if (Route::has('password.request'))
                <a class="" href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
            @endif
            <a class="" href="#" id="btn_modal_aviso">Aviso de privacidad </a>
            <a href="{{ route('visitantes.presentacion') }}" id="registrar_visitantes">Registro de Visitantes</a>
        </div>

        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif
    </form>
    @include('auth.aviso-privacidad-s4b')
=======
            <img src="{{ asset($logotipo) }}" class="logo_silent">
            <h3 class="mt-5" style="color: #345183; font-weight: normal; font-size:24px;">Iniciar Sesión</h3>
            <div class="input-group mt-5">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #fff;"><i class="bi bi-person"></i></span>
                </div>
                <input id="email" name="email" type="text"
                    class="form-control{{ $errors->has('email') ? ' is-invalid ' : '' }}" required autocomplete="email"
                    autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                @if ($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="input-group" style="margin-top:12px;" style="position: relative">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #fff;"><i class="bi bi-lock"></i></span>
                </div>
                <input id="password" name="password" type="password"
                    class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" required
                    placeholder="{{ trans('global.login_password') }}" style="padding-right: 35px;">
                <span style="position: absolute; top:21px;right: 8px;z-index: 5;"><i id="tooglePassword"
                        style=" display: none;" class="fas fa-eye-slash"></i></span>
                @if ($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="text-center" style="margin-top:20px;">
                <button type="submit" class="btn_enviar" style="background-color: #3c4b64;">Enviar</button>
            </div>
            @if (Route::has('password.request'))
                <a class="btn" href="{{ route('password.request') }}"
                    style="margin-top:20px; color: #006DDB; font-size: 12px;">¿Olvidó su contraseña?</a>
            @endif
            <a class="btn" href="#" style="margin-top: 20px; color: #006DDB; font-size: 12px;"
                id="btn_modal_aviso">Aviso de privacidad </a>
            <a class="btn" href="{{ route('visitantes.presentacion') }}"
                style="margin-top: 20px; color: #006DDB; font-size: 12px;" id="registrar_visitantes"><i
                    class="fas fa-users mr-2"></i> Registro de Visitantes</a>
        </form>
    </div>
</div>
@include('auth.aviso-privacidad-s4b')
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $("#login").click(function() {
        $("#login").removeClass("clase_animacion");
    });

    $('#btn_modal_aviso').click(function() {
        $('#modal_aviso').fadeIn(300);
    });
    $('#btn_closed_modal').click(function() {
        $('#modal_aviso').fadeOut(300);
    });

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('password').addEventListener('keyup', function(e) {
            let tooglePassword = document.getElementById('tooglePassword');
            if (e.target.value.length > 0) {
                tooglePassword.style.display = 'block';
            } else {
                tooglePassword.style.display = 'none';
                document.getElementById('password').type = 'password';
                tooglePassword?.classList.remove('fa-eye');
                tooglePassword?.classList.add('fa-eye-slash');
            }
        });
        document.getElementById('tooglePassword')?.addEventListener('click', function() {
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            var input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    });
</script>
{{-- {{ \TawkTo::widgetCode('https://tawk.to/chat/5fa08d15520b4b7986a0a19b/default') }} --}}
>>>>>>> f6b1792f7727ae93475b72414f9ea514b37ad056
@endsection

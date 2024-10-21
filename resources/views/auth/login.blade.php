@extends('layouts.app')
@section('classBody', $errors->has('email') ? ' is-invalid' : 'animate-active')
@section('content')
    @if (session('message'))
        <div class="alert alert-info" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
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
@endsection

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

@extends('layouts.app')
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

        <input id="email" name="email" type="text" class="{{ $errors->has('email') ? ' is-invalid ' : '' }}" required
            autocomplete="email" placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

        @if ($errors->has('email'))
            <div class="invalid-feedback">
                {{ $errors->first('email') }}
            </div>
        @endif


        <input id="password" name="password" type="password" class="{{ $errors->has('password') ? ' is-invalid' : '' }}"
            required placeholder="{{ trans('global.login_password') }}">

        @if ($errors->has('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
        @endif

        <div class="text-center">
            <button type="submit" class="btn_enviar">Enviar</button>
        </div>
        @if (Route::has('password.request'))
            <a class="" href="{{ route('password.request') }}">¿Olvidó su contraseña?</a>
        @endif
        <a class="" href="#" id="btn_modal_aviso">Aviso de privacidad </a>
        <a href="{{ route('visitantes.presentacion') }}" id="registrar_visitantes">Registro de Visitantes</a>
    </form>
    @include('auth.aviso-privacidad-s4b')
@endsection

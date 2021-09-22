@extends('layouts.app')
@section('content')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj.png') }}">
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
@endsection


<div id="login" class="fondo clase_animacion">
    <div class="caja_marca">
        <div class="marca">
            <img src="{{ asset('img/logo_policromatico.png') }}"><br>
            <p class="by">By <strong>Silent</strong>for<strong>Business</strong></p>
            <p class="bienvenidos"><strong>Bienvenidos al</strong> Sistema de Gestión Normativa</p>
        </div>
    </div>
               
    @if(session('message'))
        <div class="alert alert-info" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="caja_form">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <img src="{{ asset('img/silent4business.png') }}" class="logo_silent">
            <h3 class="mt-5">Iniciar Sesión</h3>
            <div class="input-group mt-5">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid ' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="input-group mt-2">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                </div>
                <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                @if($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                @endif
            </div>

            <div class="form-group mt-3 text-center" style="height: 30px">
                 @if(Route::has('password.request'))
                    <a class="" href="{{ route('password.request') }}" style="position:absolute; left: 0; margin-top: 10px;">¿Olvidó su contraseña?</a>
                 @endif
                <button type="submit" class="btn_enviar" style="background-color: #3c4b64; position:absolute; right: 0;">Enviar</button>
            </div>

            <div class="form-group mt-5">
                <a class="btn_registrate" href="{{ route('register') }}">¿Nuevo usuario? <strong>Registrate</strong></a> 
            </div>
            <a class="" href="https://silent4business.com/aviso-de-privacidad/" target="_blank">Aviso de privacidad </a>
        </form> 
    </div> 
</div>

<script src="https://code.jquery.com/jquery-3.5.0.js"></script>
<script type="text/javascript">
    $("#login").click(function(){
        $("#login").removeClass("clase_animacion");
    });
</script>



    {{ \TawkTo::widgetCode('https://tawk.to/chat/5fa08d15520b4b7986a0a19b/default') }}

@endsection




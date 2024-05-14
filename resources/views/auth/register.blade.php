@extends('layouts.app')
@section('content')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj.png') }}">
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}{{config('app.cssVersion')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
@endsection


<div id="login" class="fondo">
    <div class="caja_marca">
        <div class="marca">
            <img src="{{ asset('img/logo_policromatico.png') }}"><br>
            <p class="by">By <strong>Silent</strong>for<strong>Business</strong></p>
            <p class="bienvenidos"><strong>Bienvenidos al</strong> Sistema Integral de Gestión Empresarial</p>
        </div>
    </div>

    @if(session('message'))
        <div class="alert alert-info" role="alert">
            {{ session('message') }}
        </div>
    @endif

    <div class="caja_form">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::getLogo;
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'silent4business.png';
                }
            @endphp

            <img src="{{ asset($logotipo) }}" class="logo_silent">
            <h3 class="mt-5" style="color: #345183; font-weight: normal; font-size:24px;">Registrarse</h3>

            {{ csrf_field() }}
            @if(request()->has('team'))
                <input type="hidden" name="team" id="team" value="{{ request()->query('team') }}">
            @endif

            <p class="mt-4" style="color: #888;"> Una vez registrado debera esperar la aprobacion del administrador del sistema </p>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-user fa-fw"></i>
                    </span>
                </div>
                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" required autofocus placeholder="{{ trans('global.user_name') }}" value="{{ old('name', null) }}">
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-envelope fa-fw"></i>
                    </span>
                </div>
                <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock fa-fw"></i>
                    </span>
                </div>
                <input type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
            </div>

            <div class="input-group mb-4">
                <div class="input-group-prepend">
                    <span class="input-group-text">
                        <i class="fa fa-lock fa-fw"></i>
                    </span>
                </div>
                <input type="password" name="password_confirmation" class="form-control" required placeholder="Confirmar contraseña">
            </div>

            <div class="text-center" style="margin-top:20px;">
                <button type="submit" class="btn_enviar" style="background-color: #3c4b64;">Registrarse</button>
            </div>


            <p class="mt-4" style="color: #888;"> Una vez registrado debera esperar la aprobacion del administrador del sistema </p>

        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript">
    $("#login").click(function(){
        $("#login").removeClass("clase_animacion");
    });
</script>



{{-- {{ \TawkTo::widgetCode('https://tawk.to/chat/5fa08d15520b4b7986a0a19b/default') }} --}}

@endsection

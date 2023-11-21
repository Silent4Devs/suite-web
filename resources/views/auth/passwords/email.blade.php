@extends('layouts.app')
@section('content')
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon_tabantaj.png') }}">
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/login.css') }}">
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
        <form method="POST" action="{{ route('password.email') }}" style="height:591px;">
            @csrf

            @php
                use App\Models\Organizacion;
                $organizacion = Organizacion::getLogo();
                if (!is_null($organizacion)) {
                    $logotipo = $organizacion->logotipo;
                } else {
                    $logotipo = 'silent4business.png';
                }
            @endphp

            <img src="{{ asset($logotipo) }}" class="logo_silent">
            <h3 class="mt-5" style="color: #345183; font-weight: normal; font-size:24px;">Recuperar Contraseña</h3>

            <p class="text-muted mt-4">Introduce tu correo electrónico registrado y recibirás un correo con las instrucciones para recuperar tu contraseña.</p>

            <div class="input-group mt-5">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #fff;"><i class="bi bi-person"></i></span>
                </div>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
            </div>

            <div class="text-center" style="margin-top:20px;">
                <button type="submit" class="btn_enviar" style="background-color: #3c4b64;">Recuperar contraseña</button>
            </div>

            <p class="mt-4">En caso de requerir asesoría, contactar a soporte técnico al siguiente correo:
            <br><br>
                <a href="mailto:contacto@silent4business.com">contacto@silent4business.com</a></p>
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

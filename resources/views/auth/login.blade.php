@extends('layouts.app')
@section('content')


<style type="text/css">
    body{
        color: #fff;
    }
    .fondo{
        height: 100%; 
        width: 100%; 
        position: absolute; 
        top: 0;
        background: #fff;
    }
    .fondo::before{
        content: "";
        background: url({{ asset('img/auth-bg2.jpg')}});
        background-size: cover; 
        background-position: center; 
        background-repeat: no-repeat;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        animation: anima_fondo 3s linear;
    }
    .caja{
        width: 50%;
    }
    .caja h3{
        width: 100%;
    }
    .caja p{
        width: 100%;
    }
    .img_logo{
        width: 150px;
        margin: 50px;
        filter: grayscale(100%) invert(0.5) brightness(200%);
        position: absolute;
        right: 0;
        top: 0;
        animation: anima_logo 3s;
    }
    .letra{
        font-weight: normal;
        color: #fff;
        animation: anima_letra 3.3s;
    }
    .img_titulo{
        width: 500px;
    }
    .inicio_titulo{
        text-align: left;
        color: #fff;
    }
   .links p{
        width: 100%;
        text-align: left;
    }
    .links p a{
        text-decoration: none;
        color: #fff;
        margin-top: 30px;
        width: 100%;
    }
    .links p a:hover{
        text-decoration: underline;
    }
    .btn{
        background-color: #2d85ce;
        color: #fff;
    }
    .btn:hover{
         filter: brightness(120%);
         color: #fff;
    }
    .caja_dato{
        margin-top: 50px;
    }


    @keyframes anima_logo{
        0%{
            transform: scale(1.5);
            filter: none;
            right: calc(85% - 150px);
            opacity: 0;
            margin: 0;
            top: 60%;
        }
        20%{
            transform: scale(1.5);
            filter: none;
            right: calc(85% - 150px);
            opacity: 0;
            margin: 0;
            top: 60%;
        }
        40%{
            transform: scale(1.5);
            filter: none;
            right: calc(75% - 150px);
            margin: 0;
            top: 60%;
        }
        70%{
            transform: scale(1.5);
            filter: none;
            right: calc(75% - 150px);
            margin: 0;
            top: 60%;
        }
        100%{
            transform: scale(1);
        }
    }
    @keyframes anima_fondo{
        0%{
            filter: grayscale(100%) brightness(200%);
            opacity: 0.3;
        }
        60%{
            filter: grayscale(100%) brightness(200%);
            opacity: 0.3;
        }
        100%{

        }
    }
    @keyframes anima_letra{
        0%{
            opacity: 0;
            margin-left: -100px;
        }
        90%{
            opacity: 0;
            margin-left: -100px;
        }
        100%{

        }
    }
</style>
<div class="row fondo">
    <div class="col-xl-9 d-flex align-items-center justify-content-center py-4 fond_img" style="">
        <div class="caja">
            <span class="db">
                <img class="img_logo" src="{{ asset('img/Silent4Business-Logo-Color.png') }}" style="" alt="logo"/>
            </span>
            <br><br>
            <h3 class="font-light m-t-30 letra">
                <p class="text-left">
                    Bienvenido al Sistema de Gestión Normativa
                <p class="text-center"> 
                    <img class="img_titulo" src="{{ asset('img/tabantaj_titulo.png') }}">
                </p>
                <p class="text-right" style="font-weight: normal;">
                    By silent<font style="font-weight: lighter;">for</font>business
                </p>
            </h3>
        </div>
    </div>
    <div class="col-xl-3 py-4"  style="background-color: rgba(0,0,0,0.4); box-shadow: 0px 0px 11px 1px #000">
        <div class="row">
            <div class="col-12">
                <h1 class="my-5 inicio_titulo" style="">{{ trans('global.login') }}</h1>

                @if(session('message'))
                    <div class="alert alert-info" role="alert">
                        {{ session('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="input-group mb-3 caja_dato">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-user"></i>
                            </span>
                        </div>

                        <input id="email" name="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email', null) }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="input-group mb-3 caja_dato">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>

                        <input id="password" name="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" required placeholder="{{ trans('global.login_password') }}">

                        @if($errors->has('password'))
                            <div class="invalid-feedback">
                                {{ $errors->first('password') }}
                            </div>
                        @endif
                    </div>


                    <div class="row text-right links" whidth="100%">
                        <div class="col-12 caja_dato">
                            <button type="submit" class="btn mb-4">
                                {{ trans('global.login') }}
                            </button>
                        </div>
                        <div class="col-6 text-right">
                            @if(Route::has('password.request'))
                            <p>
                                <a class="" href="{{ route('password.request') }}">
                                    ¿Olvidó su contraseña?
                                </a>
                            </p>
                            @endif
                            <p>
                                <a class="" href="{{ route('register') }}">
                                    {{ trans('global.register') }}
                                </a> 
                            </p>
                            <p>
                                 <a class="" href="https://silent4business.com/aviso-de-privacidad/" target="_blank">
                                    Aviso de privacidad 
                                </a>
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{ TawkTo::widgetCode() }}

@endsection

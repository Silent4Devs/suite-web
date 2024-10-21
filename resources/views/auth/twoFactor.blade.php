@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card-group">
                <div class="p-4 card">
                    <div class="card-body" style="position:relative">
                        <img class="logo-tabantaj" src="{{ asset('img/auth/TBLogoPolicromatico.png') }}" class="img-fluid"
                            style="position: absolute;top:10px;right: 0;width: 130px;z-index: 1;">
                        @if (session()->has('message'))
                            <p class="alert alert-info">
                                {{ session()->get('message') }}
                            </p>
                        @endif
                        <form method="POST" action="{{ route('twoFactor.check') }}">
                            @csrf
                            <h1><i class="mr-2 fas fa-user-lock"></i>Autenticación por dos factores</h1>
                            <div class="p-4 text-center w-100">
                                <img src="{{ asset('img/two_factor_authentication.svg') }}" alt="autenticación"
                                    class="img-fluid" style="width: 50%">
                            </div>
                            <p class="text-muted">
                                El código de autenticación de dos factores se envió por correo electrónico. El código es
                                válido por {{ 15 }} minutos. Si no lo ha recibido, presione reenviar.
                            </p>

                            <div class="mb-3 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </div>
                                <input name="two_factor_code" type="text"
                                    class="form-control{{ $errors->has('two_factor_code') ? ' is-invalid' : '' }}" required
                                    autofocus placeholder="Código">
                                @if ($errors->has('two_factor_code'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('two_factor_code') }}
                                    </div>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button type="submit" class="px-4 btn btn-primary">
                                        Verificar
                                    </button>
                                </div>
                                <div class="text-right col-6">
                                    <a class="px-4 btn btn-secondary" href="{{ route('twoFactor.resend') }}">Reenviar</a>
                                    <a class="px-4 btn btn-primary" href="#"
                                        onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                        Cerrar Sesión
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
        {{ csrf_field() }}
    </form>
@endsection

@extends('layouts.app')
@section('content')
    @if (session('message'))
        <div class="alert alert-info" role="alert">
            {{ session('message') }}
        </div>
    @endif

    @php
        use App\Models\Organizacion;
        $organizacion = Organizacion::getLogo();
        if (!is_null($organizacion)) {
            $logotipo = $organizacion->logotipo;
        } else {
            $logotipo = 'silent4business.png';
        }
    @endphp

    <form method="POST" action="{{ route('password.request') }}" style="height: 513px">
        @csrf

        <img class="logo_silent rounded-circle" style="width: 100px" src="{{ $logotipo }}" />
        <h3 class="mt-2" style="color: #345183; font-weight: normal; font-size:24px;">Reestablecer Contraseña</h3>
        <p class="text-muted mt-4" style="text-align: left">Introduce tu nueva contraseña, una vez realizada esta
            acción oprime el botón
            "Reestablecer contraseña" y automáticamente quedarás logeado dentro de TABANTAJ</p>
        <input name="token" value="{{ $token }}" type="hidden">

        <div class="form-group">
            <input id="email" type="email" name="email"
                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autocomplete="email" autofocus
                placeholder="{{ trans('global.login_email') }}" value="{{ $email ?? old('email') }}" readonly>

            @if ($errors->has('email'))
                <small class="text-danger">
                    {{ $errors->first('email') }}
                </small>
            @endif
        </div>
        <div class="form-group" style="position: relative">
            <input id="password" type="password" name="password" class="form-control" required
                placeholder="{{ trans('global.login_password') }}">
            <span style="position: absolute; top:21px;right: 8px;"><i id="tooglePassword"
                    class="fas fa-eye-slash"></i></span>
            @if ($errors->has('password'))
                <small class="text-danger">
                    {{ $errors->first('password') }}
                </small>
            @endif
        </div>
        <div class="form-group" style="position: relative">
            <input id="password-confirm" type="password" name="password_confirmation" class="form-control" required
                placeholder="{{ trans('global.login_password_confirmation') }}">
            <span style="position: absolute; top:21px;right: 8px;"><i id="tooglePasswordConfirmation"
                    class="fas fa-eye-slash"></i></span>
        </div>

        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn_enviar" style="background-color: #3c4b64;">
                    {{ trans('global.reset_password') }}
                </button>
            </div>
        </div>
    </form>
@endsection

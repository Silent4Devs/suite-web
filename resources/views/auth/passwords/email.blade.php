@extends('layouts.app')
@section('content')
    <form method="POST" action="{{ route('password.email') }}">
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

        <div class="box-logo-org">
            <img src="{{ asset($logotipo) }}" alt="Logo de la Organizacion">
        </div>

        <div class="text-iniciar">
            Recuperar Contraseña
        </div>

        <p class="text-instrucction-mail">
            <small>
                Introduce tu correo electrónico registrado y recibirás un correo con las instrucciones
                para recuperar tu contraseña.
            </small>
        </p>

        <div class="input-item">
            <label for="email" class="icon icon-box">
                <img src="{{ asset('img/auth/icon-person.svg') }}" alt="Icon person">
            </label>

            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                name="email" required autocomplete="email" placeholder="{{ trans('global.login_email') }}"
                value="{{ old('email') }}">
        </div>

        @if ($errors->has('email'))
            <div class="invalid-feedback">
                <small>
                    {{ $errors->first('email') }}
                </small>
            </div>
        @endif

        <div class="button-item">
            <button type="submit" class="btn_enviar">Recuperar contraseña</button>
        </div>
    </form>

    {{-- {{ \TawkTo::widgetCode('https://tawk.to/chat/5fa08d15520b4b7986a0a19b/default') }} --}}
@endsection

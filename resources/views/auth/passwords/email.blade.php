@extends('layouts.app')
@section('content')
<div class="row justify-content-center" style="background-image: url(../img/auth-bg2.jpg); background-size: cover; background-position: center; background-repeat: no-repeat; position: absolute; top: 0;
left: 0; width: 100%; height: 100%; display: flex;
align-items: center; justify-content: center;">
    <div class="col-md-6">
        <div class="card mx-4">
            <div class="card-body p-4">
                <h1>{{ trans('panel.site_title') }}</h1>

                <p class="text-muted">Introduce tu correo electrónico registrado y recibirás un correo con las instrucciones para recuperar tu contraseña...</p>


                @if(session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="form-group">
                        
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}" value="{{ old('email') }}">

                        @if($errors->has('email'))
                            <div class="invalid-feedback">
                                {{ $errors->first('email') }}
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-flat btn-block">
                                Recuperar contraseña
                            </button>
                        </div>
                    </div>
                    <p class="mt-4">En caso de requerir asesoria tecnica contactar a soporte tecnico al siguiente correo <a href="mailto:contacto@silent4business.com">contacto@silent4business.com</a></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')
@section('content')
    <div class="row justify-content-center" style="height: 100vh">
        <div class="col-md-6" style="align-self: center">
            <div class="mx-4 card">
                <div class="p-4 card-body">
                    @if ($organizacion)
                        <div class="text-center d-flex align-items-center justify-content-center">
                            <img class="img-fluid rounded mr-2" style="width: 100px" src="{{ $organizacion->logotipo }}" />
                            <h1>{{ trans('panel.site_title') }}</h1>
                        </div>
                    @endif
                    <p class="text-muted">{{ trans('global.reset_password') }}</p>

                    <form method="POST" action="{{ route('password.request') }}">
                        @csrf

                        <input name="token" value="{{ $token }}" type="hidden">

                        <div class="form-group">
                            <input id="email" type="email" name="email"
                                class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required
                                autocomplete="email" autofocus placeholder="{{ trans('global.login_email') }}"
                                value="{{ $email ?? old('email') }}" readonly>

                            @if ($errors->has('email'))
                                <small class="text-danger">
                                    {{ $errors->first('email') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group" style="position: relative">
                            <input id="password" type="password" name="password" class="form-control" required
                                placeholder="{{ trans('global.login_password') }}">
                            <span style="position: absolute; top:8px;right: 8px;"><i id="tooglePassword"
                                    class="fas fa-eye"></i></span>
                            @if ($errors->has('password'))
                                <small class="text-danger">
                                    {{ $errors->first('password') }}
                                </small>
                            @endif
                        </div>
                        <div class="form-group" style="position: relative">
                            <input id="password-confirm" type="password" name="password_confirmation" class="form-control"
                                required placeholder="{{ trans('global.login_password_confirmation') }}">
                            <span style="position: absolute; top:8px;right: 8px;"><i id="tooglePasswordConfirmation"
                                    class="fas fa-eye"></i></span>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">
                                    {{ trans('global.reset_password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('tooglePassword').addEventListener('click', function() {
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            var input = document.getElementById('password');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
        document.getElementById('tooglePasswordConfirmation').addEventListener('click', function() {
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
            var input = document.getElementById('password-confirm');
            if (input.type === 'password') {
                input.type = 'text';
            } else {
                input.type = 'password';
            }
        });
    </script>
@endsection

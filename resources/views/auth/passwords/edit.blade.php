@extends('layouts.admin')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="p-4 card">
                <div class="row">
                    <div class="text-center col-sm-12 col-lg-6 col-12 justify-content-center align-items-center">
                        <div class="card">
                            <div class="card-body">
                                @if (auth()->user()->empleado)
                                    <img class="rounded-circle" style="height: 170px;clip-path: circle(82px at 50% 50%);"
                                        src="{{ asset('storage/empleados/imagenes/' . '/' . auth()->user()->empleado->avatar) }}"
                                        alt="{{ auth()->user()->empleado->name }}">
                                    <div class="mt-1">
                                        <h1>
                                            {{ auth()->user()->empleado->name }}
                                        </h1>
                                        <p class="m-0">
                                            <i class="fa fa-at"></i> Email: {{ auth()->user()->empleado->email }}
                                        </p>
                                        <p class="m-0">
                                            @foreach (auth()->user()->roles as $rol)
                                                <span class="badge badge-dark"
                                                    style="font-size:13px;">{{ $rol->title }}</span>
                                            @endforeach
                                        </p>
                                    </div>
                                @else
                                    <i class="fas fa-user-circle iconos_cabecera" style="font-size: 33px;"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                {{ trans('global.my_profile') }}
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.password.updateProfile') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            type="text" name="name" id="name"
                                            value="{{ old('name', auth()->user()->name) }}" required>
                                        @if ($errors->has('name'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('name') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="required"
                                            for="title">{{ trans('cruds.user.fields.email') }}</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            type="text" name="email" id="email"
                                            value="{{ old('email', auth()->user()->email) }}" required>
                                        @if ($errors->has('email'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('email') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 row">
                    <div class="col-sm-12 col-lg-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                {{ trans('global.change_password') }}
                            </div>

                            <div class="card-body">
                                <form method="POST" action="{{ route('profile.password.update') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="required" for="title">Nueva
                                            {{ trans('cruds.user.fields.password') }}</label>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            type="password" name="password" id="password" required>
                                        @if ($errors->has('password'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="title">Confirmar nueva
                                            {{ trans('cruds.user.fields.password') }}</label>
                                        <input class="form-control" type="password" name="password_confirmation"
                                            id="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit">
                                            {{ trans('global.save') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-6 col-12">
                        <div class="row">
                            <div class="col-sm-12 col-lg-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        {{ trans('global.delete_account') }}
                                    </div>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('profile.password.destroyProfile') }}"
                                            onsubmit="return prompt('{{ __('global.delete_account_warning') }}') == '{{ auth()->user()->email }}'">
                                            @csrf
                                            <div class="form-group">
                                                <button class="btn btn-danger" type="submit">
                                                    {{ trans('global.delete') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-lg-12 col-12">
                                @if (Route::has('profile.password.toggleTwoFactor'))
                                    <div class="card">
                                        <div class="card-header">
                                            {{ trans('global.two_factor.title') }}
                                        </div>

                                        <div class="card-body">
                                            <form method="POST" action="{{ route('profile.password.toggleTwoFactor') }}">
                                                @csrf
                                                <div class="form-group">
                                                    <button class="btn btn-danger" type="submit">
                                                        {{ auth()->user()->two_factor ? trans('global.two_factor.disable') : trans('global.two_factor.enable') }}
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-12">
                        <p class="m-0 text-muted"><i class="fas fa-info-circle"></i> Permisos del usuario</p>
                        <div class="mt-3">
                            @if (auth()->user()->isAdmin)
                                <div class="p-2 text-center text-white rounded bg-primary">
                                    <i class="mr-2 fa fa-info-circle"></i>El administrador tiene todos los permisos
                                </div>
                            @else
                                @foreach (auth()->user()->roles as $rol)
                                    <table class="table w-100" id="tblPermisos">
                                        <thead>
                                            <th>No.</th>
                                            <th>Nombre</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($rol->permissions as $idx => $permission)
                                                <tr>
                                                    <td>{{ $idx + 1 }}</td>
                                                    <td>{{ $permission->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('#tblPermisos').DataTable({
                buttons: [],
                searching: false
            })
        });
    </script>
@endsection

@extends('layouts.frontend')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Usuario</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Usuario </h3>
        </div> --}}

        <div class="card-body">
            <form method="POST" action="{{ route('admin.users.update', [$user->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label class="required" for="name"><i
                            class="fas fa-user iconos-crear"></i>{{ trans('cruds.user.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name"
                        id="name" value="{{ old('name', $user->name) }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="email"><i
                            class="fas fa-envelope iconos-crear"></i>{{ trans('cruds.user.fields.email') }}</label>
                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                        id="email" value="{{ old('email', $user->email) }}" required>
                    @if ($errors->has('email'))
                        <div class="invalid-feedback">
                            {{ $errors->first('email') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                </div>
                {{-- <div class="form-group">
                <div class="form-check {{ $errors->has('approved') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="approved" value="0">
                    <input class="form-check-input" type="checkbox" name="approved" id="approved" value="1" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                </div>
                @if ($errors->has('approved'))
                    <div class="invalid-feedback">
                        {{ $errors->first('approved') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.user.fields.approved_helper') }}</span>
            </div> --}}
                {{-- <div class="col-sm-12 col-lg-12 col-12">
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
                                            {{ $user->two_factor ? trans('global.two_factor.disable') : trans('global.two_factor.enable') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif
                </div> --}}
                <div class="form-group">
                    <label for="password"><i
                            class="fas fa-lock iconos-crear"></i>{{ trans('cruds.user.fields.password') }}</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password"
                        name="password" id="password" placeholder="Nueva Contraseña">
                    <small><strong>IMPORTANTE:</strong> Este campo debe de utilizarse cuando se cambie la contraseña,
                        por
                        motivos de
                        seguridad la contraseña no
                        puede ser mostrada dentro del campo "Contraseña"</small>
                    @if ($errors->has('password'))
                        <div class="invalid-feedback">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="roles"><i
                            class="fas fa-briefcase iconos-crear"></i>{{ trans('cruds.user.fields.roles') }}</label>
                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]"
                        id="roles" multiple required>
                        @foreach ($roles as $id => $roles)
                            <option value="{{ $id }}"
                                {{ in_array($id, old('roles', [])) || $user->roles->contains($id) ? 'selected' : '' }}>
                                {{ $roles }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('roles'))
                        <div class="invalid-feedback">
                            {{ $errors->first('roles') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                </div>
                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

@section('scripts')

    <script>
        $(document).ready(function() {
            $("#roles").select2({
                theme: "bootstrap4",
            });
        });
    </script>


@endsection

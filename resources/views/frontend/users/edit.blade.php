@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.user.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.users.update", [$user->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="name">{{ trans('cruds.user.fields.name') }}</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required>
                            @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.name_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="email">{{ trans('cruds.user.fields.email') }}</label>
                            <input class="form-control" type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required>
                            @if($errors->has('email'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('email') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.email_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="password">{{ trans('cruds.user.fields.password') }}</label>
                            <input class="form-control" type="password" name="password" id="password">
                            @if($errors->has('password'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('password') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.password_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <div>
                                <input type="hidden" name="approved" value="0">
                                <input type="checkbox" name="approved" id="approved" value="1" {{ $user->approved || old('approved', 0) === 1 ? 'checked' : '' }}>
                                <label for="approved">{{ trans('cruds.user.fields.approved') }}</label>
                            </div>
                            @if($errors->has('approved'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('approved') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.approved_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label class="required" for="roles">{{ trans('cruds.user.fields.roles') }}</label>
                            <div style="padding-bottom: 4px">
                                <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                                <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                            </div>
                            <select class="form-control select2" name="roles[]" id="roles" multiple required>
                                @foreach($roles as $id => $roles)
                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('roles'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('roles') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.roles_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="organizacion_id">{{ trans('cruds.user.fields.organizacion') }}</label>
                            <select class="form-control select2" name="organizacion_id" id="organizacion_id">
                                @foreach($organizacions as $id => $organizacion)
                                    <option value="{{ $id }}" {{ (old('organizacion_id') ? old('organizacion_id') : $user->organizacion->id ?? '') == $id ? 'selected' : '' }}>{{ $organizacion }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('organizacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('organizacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.organizacion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="area_id">{{ trans('cruds.user.fields.area') }}</label>
                            <select class="form-control select2" name="area_id" id="area_id">
                                @foreach($areas as $id => $area)
                                    <option value="{{ $id }}" {{ (old('area_id') ? old('area_id') : $user->area->id ?? '') == $id ? 'selected' : '' }}>{{ $area }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('area'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('area') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.area_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="puesto_id">{{ trans('cruds.user.fields.puesto') }}</label>
                            <select class="form-control select2" name="puesto_id" id="puesto_id">
                                @foreach($puestos as $id => $puesto)
                                    <option value="{{ $id }}" {{ (old('puesto_id') ? old('puesto_id') : $user->puesto->id ?? '') == $id ? 'selected' : '' }}>{{ $puesto }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('puesto'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('puesto') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.puesto_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="team_id">{{ trans('cruds.user.fields.team') }}</label>
                            <select class="form-control select2" name="team_id" id="team_id">
                                @foreach($teams as $id => $team)
                                    <option value="{{ $id }}" {{ (old('team_id') ? old('team_id') : $user->team->id ?? '') == $id ? 'selected' : '' }}>{{ $team }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('team'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('team') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.user.fields.team_helper') }}</span>
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
</div>
@endsection
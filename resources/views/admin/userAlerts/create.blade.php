@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Alerta de Usuario</h5>
    <div class="card mt-4">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.user-alerts.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label class="required" for="alert_text"><i
                            class="fas fa-user-clock iconos-crear"></i>{{ trans('cruds.userAlert.fields.alert_text') }}</label>
                    <input class="form-control {{ $errors->has('alert_text') ? 'is-invalid' : '' }}" type="text"
                        name="alert_text" id="alert_text" value="{{ old('alert_text', '') }}" required>
                    @if ($errors->has('alert_text'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alert_text') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userAlert.fields.alert_text_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="alert_link"><i
                            class="fas fa-user-clock iconos-crear"></i>{{ trans('cruds.userAlert.fields.alert_link') }}</label>
                    <input class="form-control {{ $errors->has('alert_link') ? 'is-invalid' : '' }}" type="text"
                        name="alert_link" id="alert_link" value="{{ old('alert_link', '') }}">
                    @if ($errors->has('alert_link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('alert_link') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userAlert.fields.alert_link_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="users"><i
                            class="fas fa-users iconos-crear"></i>{{ trans('cruds.userAlert.fields.user') }}</label>
                    <div style="padding-bottom: 4px">
                        <span class="btn btn-info btn-xs select-all"
                            style="border-radius: 0">{{ trans('global.select_all') }}</span>
                        <span class="btn btn-info btn-xs deselect-all"
                            style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                    </div>
                    <select class="form-control select2 {{ $errors->has('users') ? 'is-invalid' : '' }}" name="users[]"
                        id="users" multiple>
                        @foreach ($users as $id => $user)
                            <option value="{{ $id }}" {{ in_array($id, old('users', [])) ? 'selected' : '' }}>
                                {{ $user }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('users'))
                        <div class="invalid-feedback">
                            {{ $errors->first('users') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userAlert.fields.user_helper') }}</span>
                </div>
                <div class="form-group col-12 text-right" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

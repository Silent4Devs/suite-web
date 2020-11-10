@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.comiteseguridad.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.comiteseguridads.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="nombrerol">{{ trans('cruds.comiteseguridad.fields.nombrerol') }}</label>
                            <input class="form-control" type="text" name="nombrerol" id="nombrerol" value="{{ old('nombrerol', '') }}" required>
                            @if($errors->has('nombrerol'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('nombrerol') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comiteseguridad.fields.nombrerol_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="personaasignada_id">{{ trans('cruds.comiteseguridad.fields.personaasignada') }}</label>
                            <select class="form-control select2" name="personaasignada_id" id="personaasignada_id">
                                @foreach($personaasignadas as $id => $personaasignada)
                                    <option value="{{ $id }}" {{ old('personaasignada_id') == $id ? 'selected' : '' }}>{{ $personaasignada }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('personaasignada'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('personaasignada') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comiteseguridad.fields.personaasignada_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="fechavigor">{{ trans('cruds.comiteseguridad.fields.fechavigor') }}</label>
                            <input class="form-control date" type="text" name="fechavigor" id="fechavigor" value="{{ old('fechavigor') }}">
                            @if($errors->has('fechavigor'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('fechavigor') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comiteseguridad.fields.fechavigor_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="responsabilidades">{{ trans('cruds.comiteseguridad.fields.responsabilidades') }}</label>
                            <textarea class="form-control" name="responsabilidades" id="responsabilidades">{{ old('responsabilidades') }}</textarea>
                            @if($errors->has('responsabilidades'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('responsabilidades') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.comiteseguridad.fields.responsabilidades_helper') }}</span>
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
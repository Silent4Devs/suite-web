@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center" style="margin-top: -40px">
         <h3 class="mb-1  text-center text-white">
        {{ trans('global.create') }} {{ trans('cruds.comiteseguridad.title_singular') }}</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.comiteseguridads.store") }}" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-12">
                <label class="required" for="nombrerol">{{ trans('cruds.comiteseguridad.fields.nombrerol') }}</label>
                <input class="form-control {{ $errors->has('nombrerol') ? 'is-invalid' : '' }}" type="text" name="nombrerol" id="nombrerol" value="{{ old('nombrerol', '') }}" required>
                @if($errors->has('nombrerol'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombrerol') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comiteseguridad.fields.nombrerol_helper') }}</span>
            </div>
            <div class="form-group col-sm-9">
                <label for="personaasignada_id">{{ trans('cruds.comiteseguridad.fields.personaasignada') }}</label>
                <select class="form-control select2 {{ $errors->has('personaasignada') ? 'is-invalid' : '' }}" name="personaasignada_id" id="personaasignada_id">
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
            <div class="form-group col-sm-3">
                <label for="fechavigor">{{ trans('cruds.comiteseguridad.fields.fechavigor') }}</label>
                <input class="form-control date {{ $errors->has('fechavigor') ? 'is-invalid' : '' }}" type="text" name="fechavigor" id="fechavigor" value="{{ old('fechavigor') }}">
                @if($errors->has('fechavigor'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fechavigor') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comiteseguridad.fields.fechavigor_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <label for="responsabilidades">{{ trans('cruds.comiteseguridad.fields.responsabilidades') }}</label>
                <textarea class="form-control {{ $errors->has('responsabilidades') ? 'is-invalid' : '' }}" name="responsabilidades" id="responsabilidades">{{ old('responsabilidades') }}</textarea>
                @if($errors->has('responsabilidades'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsabilidades') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.comiteseguridad.fields.responsabilidades_helper') }}</span>
            </div>
            <div class="form-group col-12">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
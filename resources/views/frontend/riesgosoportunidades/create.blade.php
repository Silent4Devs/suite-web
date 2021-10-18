@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.riesgosoportunidade.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.riesgosoportunidades.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="control_id">{{ trans('cruds.riesgosoportunidade.fields.control') }}</label>
                            <select class="form-control select2" name="control_id" id="control_id">
                                @foreach($controls as $id => $control)
                                    <option value="{{ $id }}" {{ old('control_id') == $id ? 'selected' : '' }}>{{ $control }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('control'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('control') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.riesgosoportunidade.fields.control_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label>{{ trans('cruds.riesgosoportunidade.fields.aplicaorganizacion') }}</label>
                            <select class="form-control" name="aplicaorganizacion" id="aplicaorganizacion">
                                <option value disabled {{ old('aplicaorganizacion', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                                @foreach(App\Models\Riesgosoportunidade::APLICAORGANIZACION_SELECT as $key => $label)
                                    <option value="{{ $key }}" {{ old('aplicaorganizacion', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('aplicaorganizacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('aplicaorganizacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.riesgosoportunidade.fields.aplicaorganizacion_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="justificacion">{{ trans('cruds.riesgosoportunidade.fields.justificacion') }}</label>
                            <textarea class="form-control" name="justificacion" id="justificacion">{{ old('justificacion') }}</textarea>
                            @if($errors->has('justificacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('justificacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.riesgosoportunidade.fields.justificacion_helper') }}</span>
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
@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.partesInteresada.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.partes-interesadas.update", [$partesInteresada->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="parteinteresada">{{ trans('cruds.partesInteresada.fields.parteinteresada') }}</label>
                <input class="form-control {{ $errors->has('parteinteresada') ? 'is-invalid' : '' }}" type="text" name="parteinteresada" id="parteinteresada" value="{{ old('parteinteresada', $partesInteresada->parteinteresada) }}" required>
                @if($errors->has('parteinteresada'))
                    <div class="invalid-feedback">
                        {{ $errors->first('parteinteresada') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.partesInteresada.fields.parteinteresada_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="requisitos">{{ trans('cruds.partesInteresada.fields.requisitos') }}</label>
                <input class="form-control {{ $errors->has('requisitos') ? 'is-invalid' : '' }}" type="text" name="requisitos" id="requisitos" value="{{ old('requisitos', $partesInteresada->requisitos) }}" required>
                @if($errors->has('requisitos'))
                    <div class="invalid-feedback">
                        {{ $errors->first('requisitos') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.partesInteresada.fields.requisitos_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="clausala">{{ trans('cruds.partesInteresada.fields.clausala') }}</label>
                <textarea class="form-control {{ $errors->has('clausala') ? 'is-invalid' : '' }}" name="clausala" id="clausala">{{ old('clausala', $partesInteresada->clausala) }}</textarea>
                @if($errors->has('clausala'))
                    <div class="invalid-feedback">
                        {{ $errors->first('clausala') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.partesInteresada.fields.clausala_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
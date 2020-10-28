@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.organizacione.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.organizaciones.update", [$organizacione->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label class="required" for="organizacion">{{ trans('cruds.organizacione.fields.organizacion') }}</label>
                            <input class="form-control" type="text" name="organizacion" id="organizacion" value="{{ old('organizacion', $organizacione->organizacion) }}" required>
                            @if($errors->has('organizacion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('organizacion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.organizacione.fields.organizacion_helper') }}</span>
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
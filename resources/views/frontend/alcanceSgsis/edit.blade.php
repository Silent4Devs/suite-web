@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.alcanceSgsi.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.alcance-sgsis.update", [$alcanceSgsi->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="alcancesgsi">{{ trans('cruds.alcanceSgsi.fields.alcancesgsi') }}</label>
                            <textarea class="form-control" name="alcancesgsi" id="alcancesgsi">{{ old('alcancesgsi', $alcanceSgsi->alcancesgsi) }}</textarea>
                            @if($errors->has('alcancesgsi'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('alcancesgsi') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.alcanceSgsi.fields.alcancesgsi_helper') }}</span>
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
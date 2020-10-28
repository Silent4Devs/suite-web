@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.alcanceSgsi.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.alcance-sgsis.update", [$alcanceSgsi->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="alcancesgsi">{{ trans('cruds.alcanceSgsi.fields.alcancesgsi') }}</label>
                <textarea class="form-control {{ $errors->has('alcancesgsi') ? 'is-invalid' : '' }}" name="alcancesgsi" id="alcancesgsi">{{ old('alcancesgsi', $alcanceSgsi->alcancesgsi) }}</textarea>
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



@endsection
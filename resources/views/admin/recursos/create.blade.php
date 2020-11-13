@extends('layouts.admin')
@section('content')

<div class="card mt-4">
    <div class="col-md-10 col-sm-9 py-3 card card-body bg-primary align-self-center" style="margin-top: -40px">
         <h3 class="mb-1  text-center text-white">
        {{ trans('global.create') }} {{ trans('cruds.recurso.title_singular') }} </h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.recursos.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="cursoscapacitaciones">{{ trans('cruds.recurso.fields.cursoscapacitaciones') }}</label>
                <textarea class="form-control {{ $errors->has('cursoscapacitaciones') ? 'is-invalid' : '' }}" name="cursoscapacitaciones" id="cursoscapacitaciones">{{ old('cursoscapacitaciones') }}</textarea>
                @if($errors->has('cursoscapacitaciones'))
                    <div class="invalid-feedback">
                        {{ $errors->first('cursoscapacitaciones') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.cursoscapacitaciones_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="participantes">{{ trans('cruds.recurso.fields.participantes') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('participantes') ? 'is-invalid' : '' }}" name="participantes[]" id="participantes" multiple>
                    @foreach($participantes as $id => $participantes)
                        <option value="{{ $id }}" {{ in_array($id, old('participantes', [])) ? 'selected' : '' }}>{{ $participantes }}</option>
                    @endforeach
                </select>
                @if($errors->has('participantes'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participantes') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.recurso.fields.participantes_helper') }}</span>
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
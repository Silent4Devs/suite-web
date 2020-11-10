@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.edit') }} {{ trans('cruds.recurso.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.recursos.update", [$recurso->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="cursoscapacitaciones">{{ trans('cruds.recurso.fields.cursoscapacitaciones') }}</label>
                            <textarea class="form-control" name="cursoscapacitaciones" id="cursoscapacitaciones">{{ old('cursoscapacitaciones', $recurso->cursoscapacitaciones) }}</textarea>
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
                            <select class="form-control select2" name="participantes[]" id="participantes" multiple>
                                @foreach($participantes as $id => $participantes)
                                    <option value="{{ $id }}" {{ (in_array($id, old('participantes', [])) || $recurso->participantes->contains($id)) ? 'selected' : '' }}>{{ $participantes }}</option>
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

        </div>
    </div>
</div>
@endsection
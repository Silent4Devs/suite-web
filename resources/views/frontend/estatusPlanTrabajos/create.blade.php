@extends('layouts.frontend')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    {{ trans('global.create') }} {{ trans('cruds.estatusPlanTrabajo.title_singular') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route("frontend.estatus-plan-trabajos.store") }}" enctype="multipart/form-data">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="estado">{{ trans('cruds.estatusPlanTrabajo.fields.estado') }}</label>
                            <input class="form-control" type="text" name="estado" id="estado" value="{{ old('estado', '') }}">
                            @if($errors->has('estado'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('estado') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.estatusPlanTrabajo.fields.estado_helper') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">{{ trans('cruds.estatusPlanTrabajo.fields.descripcion') }}</label>
                            <textarea class="form-control" name="descripcion" id="descripcion">{{ old('descripcion') }}</textarea>
                            @if($errors->has('descripcion'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('descripcion') }}
                                </div>
                            @endif
                            <span class="help-block">{{ trans('cruds.estatusPlanTrabajo.fields.descripcion_helper') }}</span>
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
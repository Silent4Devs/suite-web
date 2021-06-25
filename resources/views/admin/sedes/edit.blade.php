@extends('layouts.admin')
@section('content')

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Sedes</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sedes.update", [$sede->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf

            <div class="row">
                <div class="form-group">
                    <label class="required" for="sede">{{ trans('cruds.sede.fields.sede') }}</label>
                    <input class="form-control {{ $errors->has('sede') ? 'is-invalid' : '' }}" type="text" name="sede" id="sede" value="{{ old('sede', $sede->sede) }}" required>
                    @if($errors->has('sede'))
                        <div class="invalid-feedback">
                            {{ $errors->first('sede') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.sede.fields.sede_helper') }}</span>
                </div>  

                <div class="form-group col-sm-6">
                    <label for="foto_sedes"><i class="fas fa-id-card-alt iconos-crear"></i>Fotografía de la Sede</label>
                    <div class="mb-3 input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="foto_sedes" id="foto_sedes" accept="image/*"
                                value="{{ $empleado->foto_sedes }}" readonly>
                            <label class="custom-file-label"
                                for="inputGroupFile02">{{ $empleado->foto_sedes != null ? $empleado->foto_sedes : '' }}</label>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group col-sm-6">
                <label class="required" for="direccion"><i class="fas fa-map-marker-alt iconos-crear"></i>Dirección</label>
                <input class="form-control {{ $errors->has('direccion') ? 'is-invalid' : '' }}" type="text" name="direccion" id="direccion" value="{{ old('direccion', $sede->direccion) }}" required>
                @if($errors->has('direccion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('direccion') }}
                    </div>
                @endif
                <span class="help-block"></span>
            </div>


            <div class="form-group">
                <label for="descripcion">{{ trans('cruds.sede.fields.descripcion') }}</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $sede->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.descripcion_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="organizacion_id">Organización</label>
                <select class="form-control select2 {{ $errors->has('organizacion') ? 'is-invalid' : '' }}" name="organizacion_id" id="organizacion_id">
                    @foreach($organizacions as $id => $organizacion)
                        <option value="{{ $id }}" {{ (old('organizacion_id') ? old('organizacion_id') : $sede->organizacion->id ?? '') == $id ? 'selected' : '' }}>{{ $organizacion }}</option>
                    @endforeach
                </select>
                @if($errors->has('organizacion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organizacion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.sede.fields.organizacion_helper') }}</span>
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

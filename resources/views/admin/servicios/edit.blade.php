@extends('layouts.admin')
@section('content')

<h5 class="col-12 titulo_general_funcion">Registrar: Servicio</h5>
<div class="mt-4 card">
    <div class="card-body">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.servicios.update', [$servicios->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
            <div class="form-group col-sm-6 col-md-6 col-lg-6">
                <label class="required" for="servicio"><i
                        class="fas fa-briefcase iconos-crear"></i>Nombre del servicio</label>
                <input class="form-control {{ $errors->has('servicio') ? 'is-invalid' : '' }}" type="text" name="servicio"
                    id="servicio" value="{{ old('servicio',$servicios->servicio ) }}" required>
                @if ($errors->has('servicio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('servicio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
            </div>


            <div class="form-group col-sm-6 col-md-6 col-lg-6">
                <label for="descripcion"><i
                        class="fas fa-briefcase iconos-crear"></i>Descripcion</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                    id="descripcion" required>{{ old('descripcion', $servicios->descripcion) }}</textarea>
                @if ($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
            </div>

            <div class="text-right form-group col-12">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>

            </form>
        </div>
    </div>
</div>

@endsection

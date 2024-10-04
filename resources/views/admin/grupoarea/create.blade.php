@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion"> Registrar: Grupo</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" action="{{ route('admin.grupoarea.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="form-group col-8">
                        <label for="nombre"><i class="fas fa-users iconos-crear"></i>Nombre del Grupo</label>
                        <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text"
                            name="nombre" id="nombre" value="{{ old('nombre', '') }}">
                        @if ($errors->has('nombre'))
                            <div class="invalid-feedback">
                                {{ $errors->first('nombre') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                    </div>


                    <div class="form-group col-4">
                        <label for="color"><i class="fas fa-palette iconos-crear"></i>Color</label>
                        <input class="col-3 form-control  {{ $errors->has('color') ? 'is-invalid' : '' }}" type="color"
                            name="color" id="color" value="{{ old('color', '') }}">
                        @if ($errors->has('color'))
                            <div class="invalid-feedback">
                                {{ $errors->first('color') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-12">
                        <label for="descripcion"><i class="fas fa-pencil-alt iconos-crear"></i>Descripción</label>
                        <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion"
                            id="descripcion">{{ old('descripcion', '') }}</textarea>
                        @if ($errors->has('descripcion'))
                            <div class="invalid-feedback">
                                {{ $errors->first('descripcion') }}
                            </div>
                        @endif
                        <span class="help-block">{{ trans('cruds.area.fields.area_helper') }}</span>
                    </div>
                </div>

                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

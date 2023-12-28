@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('niveles-jerarquicos-create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: Nivel</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.perfiles.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group anima-focus">
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" placeholder="" type="text" name="nombre"
                        id="nombre" value="{{ old('nombre', '') }}" required>
                        {!! Form::label('nombre', 'Nombre del Nivel*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.puesto.fields.puesto_helper') }}</span>
                </div>
                <div class="form-group anima-focus">
                    <textarea class="form-control  {{ $errors->has('descripcion') ? 'is-invalid' : '' }}"
                        name="descripcion" placeholder="" id="descripcion">{{ old('descripcion') }}</textarea>
                        {!! Form::label('descripcion', 'Descripción*', ['class' => 'asterisco']) !!}
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.puesto.fields.descripcion_helper') }}</span>
                </div>
                <div class="text-right form-group col-12" style="margin-left:15px;">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                    <button class="btn btn-danger" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>



@endsection

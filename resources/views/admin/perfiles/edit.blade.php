@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('niveles-jerarquicos-edit', $perfil) }}
    <h5 class="col-12 titulo_general_funcion">Editar: Nivel</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.perfiles.update', $perfil) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group anima-focus">
                    <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre"
                           id="nombre" placeholder="" value="{{ old('nombre', $perfil->nombre) }}" required>
                    <label for="nombre" class="asterisco">Nombre del Nivel*</label>
                    @if ($errors->has('nombre'))
                        <div class="invalid-feedback">
                            {{ $errors->first('nombre') }}
                        </div>
                    @endif
                </div>
                <div class="form-group anima-focus">
                    <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion"
                              id="descripcion" placeholder="">{{ old('descripcion', $perfil->descripcion) }}</textarea>
                    <label for="descripcion" class="asterisco">Descripción*</label>
                    @if ($errors->has('descripcion'))
                        <div class="invalid-feedback">
                            {{ $errors->first('descripcion') }}
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-outline-primary">Cancelar</a>
                    <button class="btn btn-primary" type="submit">
                        {{ trans('global.save') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

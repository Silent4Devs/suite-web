@extends('layouts.admin')
@section('content')

<div class="mt-4 card">
    <div class="py-3 col-md-10 col-sm-9 card-body azul_silent align-self-center" style="margin-top: -40px;">
        <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Perfil</h3>
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.perfiles.update", [$perfil->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">Perfil</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', $perfil->nombre) }}" required>
                @if($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción</label>
                <textarea class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" name="descripcion" id="descripcion">{{ old('descripcion', $perfil->descripcion) }}</textarea>
                @if($errors->has('descripcion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('descripcion') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn_cancelar">Cancelar</a>
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection

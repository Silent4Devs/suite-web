@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Editar Tipo</h5>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.Tipo.update", $tipos) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">Tipo</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" value="{{ old('nombre', $tipos->nombre) }}" required>
                @if($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="descripcion">Descripción</label>
                <input class="form-control {{ $errors->has('descripcion') ? 'is-invalid' : '' }}" type="text" name="descripcion" id="descripcion" value="{{ old('descripcion', $tipos->descripcion) }}" required>
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

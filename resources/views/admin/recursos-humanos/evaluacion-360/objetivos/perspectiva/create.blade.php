@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Crear Perspectiva </h5>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.Perspectiva.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="nombre">Nombre de la Perspectiva</label>
                <input class="form-control {{ $errors->has('nombre') ? 'is-invalid' : '' }}" type="text" name="nombre" id="nombre" required>
                @if($errors->has('nombre'))
                    <div class="invalid-feedback">
                        {{ $errors->first('nombre') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <label class="required" for="imagen">Imagén</label>
                <input class="form-control {{ $errors->has('imagen') ? 'is-invalid' : '' }}" type="text" name="imagen" id="imagen" value="{{ old('imagen', '') }}">
                @if($errors->has('imagen'))
                    <div class="invalid-feedback">
                        {{ $errors->first('imagen') }}
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

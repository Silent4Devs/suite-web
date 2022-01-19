@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Editar Métrica</h5>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.Metrica.update", $metricas) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="definicion">Nombre</label>
                <input class="form-control {{ $errors->has('definicion') ? 'is-invalid' : '' }}" type="text" name="definicion" id="definicion" value="{{ old('definicion', $metricas->definicion) }}" required>
                @if($errors->has('definicion'))
                    <div class="invalid-feedback">
                        {{ $errors->first('definicion') }}
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

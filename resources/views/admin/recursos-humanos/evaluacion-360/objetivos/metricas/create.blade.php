@extends('layouts.admin')
@section('content')
<h5 class="col-12 titulo_general_funcion">Crear Métrica </h5>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route("admin.Metrica.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="definicion">Unidad</label>
                <input class="form-control {{ $errors->has('definicion') ? 'is-invalid' : '' }}" type="text" name="definicion" id="definicion" required>
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

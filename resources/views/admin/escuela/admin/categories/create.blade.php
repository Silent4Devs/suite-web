@extends('layouts.admin')

@section('title', 'Nueva categoría')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Nueva categoría</h5>
    <div class="mt-5 card">
        <div class="card-body">
            <h5 class="font-weight-bold mb-4">Categoría</h5>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name" class="asterisco">Nombre*</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br>
                    <div class="text-right form-group col-12">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-cancelar" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
                        <button class="btn tb-btn-primary" type="submit">
                            {{ trans('global.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

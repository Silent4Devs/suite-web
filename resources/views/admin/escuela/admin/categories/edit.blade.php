@extends('layouts.admin')
@section('title', 'Nuup')

@section('content')

    @if (session('info'))
        <div class="alert alert-success">
            {{ session('info') }}
        </div>
    @endif
    <h5 class="col-12 titulo_general_funcion">Editar categoría</h5>
    <div class="card">
        <div class="card-body">
            <h5 class="font-weight-bold mb-4">Categoría</h5>
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group mt-4">
                    <label for="name" class="asterisco">Nombre*</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name', $category->name) }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br>
                </div>
                <div class="text-right">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-cancelar" id="btn_cancelar" style="color:#057BE2;">Cancelar</a>
                    <button type="submit" class="btn tb-btn-primary">ACTUALIZAR CATEGORIA</button>
                </div>
            </form>
        </div>
    </div>

@endsection

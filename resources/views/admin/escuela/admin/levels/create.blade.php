@extends('layouts.admin')

@section('title', 'Crear nivel')

@section('content')
    <h5 class="col-12 titulo_general_funcion">Crear Niveles</h5>
    <div class="mt-5 card">
        <div class="card-body">
            <form action="{{ route('admin.levels.store') }}" method="POST">
                @csrf
                <h5 class="font-weight-bold mb-4">Nivel</h5>
                <div class="form-group">
                    <label for="name" class="asterisco">Nombre del Nivel*</label>
                    <input type="text" name="name" class="form-control" placeholder="" value="{{ old('name') }}">
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br>
                    <div class="text-right">
                        <button type="submit" class="btn tb-btn-primary" style="color: #ffff;">CREAR NIVEL +</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

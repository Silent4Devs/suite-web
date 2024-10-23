@extends('layouts.admin')

@section('title', 'Editar nivel')

@section('content')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h5 class="col-12 titulo_general_funcion">Editar Nivel</h5>
    <div class="card">
        <div class="card-body">
            <h5>Nivel</h5>
            <div>
                <form action="{{ route('admin.levels.update', $level) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <span style="color: var(--color-tbj);">Nombre</span><span style="color: #AF3041;">*</span>
                    <div class="row align-items-start">
                        <div class="col-9">
                            <input type="text" name="name" class="form-control" placeholder="Ingrese el nombre del nivel" value="{{ old('name', $level->name) }}">
                        </div>
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div>
                    <div class="mt-4 text-right">
                        <button type="submit" class="btn btn-primary">ACTUALIZAR NIVEL</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.vulnerabilidads.index') !!}">Vulnerabilidad</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion"> Registrar: Vulnerabilidad</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <div class="card-body">
                <form action="{{ route('admin.vulnerabilidads.store') }}" method="POST">
                    @csrf

                    @include('admin.vulnerabilidads.fields')

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>

        </div>
    </div>
@endsection

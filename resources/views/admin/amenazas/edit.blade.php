@extends('layouts.admin')

@section('content')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.amenazas.index') !!}">Amenaza</a>
        </li>
        <li class="breadcrumb-item active">Editar</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Editar: Amenaza</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.amenazas.update', $amenaza->id) }}">
                @csrf
                @method('PATCH')

                @include('admin.amenazas.fields')

            </form>
        </div>

    </div>
@endsection

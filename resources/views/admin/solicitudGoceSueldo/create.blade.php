@extends('layouts.admin')

@section('content')


    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{!! route('admin.solicitud-permiso-goce-sueldo.index') !!}">Solicitud de Permiso</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    </ol>
    <h5 class="col-12 titulo_general_funcion">Solicitar: Permiso</h5>
    <div class="mt-4 card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Amenaza</h3>
        </div> --}}
        <div class="card-body">
            <form action="{{ route('admin.solicitud-permiso-goce-sueldo.store') }}" method="POST">
                @csrf
                @include('admin.solicitudGoceSueldo.fields')
            </form>
        </div>
    </div>
@endsection

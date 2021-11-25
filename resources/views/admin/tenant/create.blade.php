@extends('layouts.admin')

@section('content')


    {{-- <ol class="breadcrumb"> --}}
        <li class="breadcrumb-item">
            <a href="{!! route('admin.tenant.index') !!}">Tenant</a>
        </li>
        <li class="breadcrumb-item active">Crear</li>
    {{-- </ol> --}}
    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Tenant</h3>
        </div>
        <div class="card-body">

        <form action="{{route('admin.tenant.store')}}" method="POST">
            @csrf
            @include('admin.tenant.fields')
        </form>

        </div>
    </div>
@endsection

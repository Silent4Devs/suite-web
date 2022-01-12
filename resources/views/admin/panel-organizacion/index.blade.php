@extends('layouts.admin')
@section('content')
    {{-- @can('role_create') --}}
        <h5 class="col-12 titulo_general_funcion">Mi organización</h5>
        <div class="mt-5 card">

    {{-- @endcan --}}
        <div class="card-body datatable-fix">
            @livewire('organizacion-component')
        </div>
    </div>
@endsection

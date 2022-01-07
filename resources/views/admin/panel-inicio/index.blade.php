@extends('layouts.admin')
@section('content')
    @can('role_create')
        <h5 class="col-12 titulo_general_funcion">Mi perfil</h5>
        <div class="mt-5 card">
            {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Mi perfil</strong></h3>
            </div> --}}
    @endcan
        <div class="card-body datatable-fix">
            @livewire('panelinicio-component')
        </div>
    </div>
@endsection

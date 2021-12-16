@extends('layouts.admin')
@section('content')
    {{-- @can('role_create') --}}

        <div class="mt-5 card">
            <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
                <h3 class="mb-2 text-center text-white"><strong>Mi organización</strong></h3>
            </div>
    {{-- @endcan --}}
        <div class="card-body datatable-fix">
            @livewire('organizacion-component')
        </div>
    </div>
@endsection

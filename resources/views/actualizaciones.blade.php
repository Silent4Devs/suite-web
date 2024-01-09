@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Actualizaciones del sistema</h5>
    <div class="mt-5 card">
        {{-- <div style="margin-bottom: 10px; margin-left:10px;" class="row">
        <div class="col-lg-12">
            @include('csvImport.modalpartesinteresadas', ['model' => 'Amenaza', 'route' => 'admin.amenazas.parseCsvImport'])
        </div>
    </div> --}}

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                </div>
                <div class="col-sm-8 align-content-center">
                </div>
                <div class="col-sm-2">
                </div>
            </div>
        </div>
        @livewire('actualizaciones-component')
    </div>
@endsection

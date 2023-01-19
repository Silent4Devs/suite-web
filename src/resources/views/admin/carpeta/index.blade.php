@extends('layouts.admin')
@section('content')
    @can('carpetum_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
            </div>
        </div>
    @endcan

    <h5 class="col-12 titulo_general_funcion">Documentos </h5>

    <div class="mt-5 card">

        <file-manager v-bind:settings="settings"></file-manager>


        {{-- <div id="fm"></div> --}}

    </div>



@endsection
@section('scripts')
    <script src="{{ asset('js/file-storage.js') }}"></script>
@endsection

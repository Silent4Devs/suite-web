@extends('layouts.admin')
@section('content')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    {{ Breadcrumbs::render('expedientes-profesionales') }}

    <h5 class="col-12 titulo_general_funcion">Perfiles Profesionales </h5>
    <div class="mt-5 card">
        <div class="card-body">
            @livewire('buscar-c-v-component', ['areas' => $areas,'isPersonal'=>false])
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

@endsection

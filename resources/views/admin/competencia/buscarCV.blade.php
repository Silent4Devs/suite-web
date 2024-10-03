@extends('layouts.admin')
@section('content')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    {{ Breadcrumbs::render('admin.competencia.index') }}
    <h5 class="col-12 titulo_general_funcion">Perfiles Profesionales</h5>

    @livewire('buscar-c-v-component', ['areas' => $areas, 'isPersonal' => false])
@endsection
@section('scripts')
    <script src="https://unpkg.com/@yaireo/tagify"></script>
    <script src="https://unpkg.com/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
@endsection

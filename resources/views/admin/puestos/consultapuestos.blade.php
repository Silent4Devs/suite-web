@extends('layouts.admin')
@section('content')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    {{ Breadcrumbs::render('consulta-puestos') }}

    <h5 class="col-12 titulo_general_funcion">Perfiles de Puestos </h5>
    <div class="mt-5 card">
        <div class="card-body">
            @livewire('consulta-perfil-component')
        </div>
    </div>
@endsection

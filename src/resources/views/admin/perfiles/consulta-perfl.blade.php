@extends('layouts.admin')
@section('content')
    <link href="https://unpkg.com/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
    {{ Breadcrumbs::render('expedientes-profesionales') }}
    <h5 class="col-12 titulo_general_funcion">Perfiles de Puestos</h5>
    <div class="mt-5 card">
        <div class="card-body">
            @livewire('consulta-perfil-component', ['areas' => $areas,'isPersonal'=>false])
        </div>
    </div>
@endsection

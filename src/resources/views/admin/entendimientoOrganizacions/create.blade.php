@extends('layouts.admin')
@section('content')



{{ Breadcrumbs::render('admin.entendimiento-organizacions.create') }}
<h5 class="col-12 titulo_general_funcion">Registrar: FODA </h5>
<div class="mt-4 card">

    <div class="card-body">
        <form method="POST" action="{{ route('admin.entendimiento-organizacions.store') }}" class="row">
            @csrf
            @include('admin.entendimientoOrganizacions._form', [
            'btnText' => 'Guardar',
            ])

<script src="{{ asset('js/dark_mode.js') }}"></script>
@endsection


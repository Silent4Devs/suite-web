@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.entendimiento-organizacions.create') }}
    <h5 class="col-12 titulo_general_funcion">Registrar: FODA</h5>
    <div class="mt-4 card">


        <div class="card-body">
            <form method="POST"
                action="{{ route('admin.entendimiento-organizacions.update', $entendimientoOrganizacion) }}" class="row">
                @csrf
                @method('PATCH')
                @include('admin.entendimientoOrganizacions._form', [
                'btnText' => 'Actualizar',
                ])




@endsection


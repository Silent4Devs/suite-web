@extends('layouts.admin')
@section('content')
    {{ Breadcrumbs::render('empleados-create') }}

    <h5 class="col-12 titulo_general_funcion">Importar Empleados</h5>
    <div class="mt-4 card">

        <div class="card-body">
            @livewire('import-empleados-compnent')
        </div>
    </div>
    <x-loading-indicator />
@endsection

@section('scripts')
    @parent
@endsection

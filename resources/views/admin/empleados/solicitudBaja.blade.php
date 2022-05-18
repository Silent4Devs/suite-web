@extends('layouts.admin')
@section('content')
    {{-- {{ Breadcrumbs::render('empleados-create') }} --}}

    <h5 class="col-12 titulo_general_funcion">Baja del Empleado: {{ $empleado->name }}</h5>
    <div class="mt-4 card">
        <div class="card-body">
            @livewire('baja-empleado-component', ['empleado' => $empleado])
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection

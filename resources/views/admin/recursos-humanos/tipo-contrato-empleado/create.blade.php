@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Tipo de contrato para empleado</h5>
    <div class="mt-4 card">

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tipos-contratos-empleados.store') }}"
                enctype="multipart/form-data">
                @csrf
                @include('admin.recursos-humanos.tipo-contrato-empleado._form')
            </form>
        </div>
    </div>



@endsection

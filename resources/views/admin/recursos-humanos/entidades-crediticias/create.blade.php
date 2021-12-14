@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Registrar: </strong> Tipo de contrato para empleado</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.tipos-contratos-empleados.store') }}"
                enctype="multipart/form-data">
                @csrf
                @include('admin.recursos-humanos.tipo-contrato-empleado._form')
            </form>
        </div>
    </div>



@endsection

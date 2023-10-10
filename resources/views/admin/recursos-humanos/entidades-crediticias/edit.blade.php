@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Editar: Entidad crediticia</h5>
    <div class="mt-4 card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.entidades-crediticias.update', $entidadCrediticia) }}">
                @csrf
                @method('PUT')
                @include('admin.recursos-humanos.entidades-crediticias._form')
            </form>
        </div>
    </div>



@endsection

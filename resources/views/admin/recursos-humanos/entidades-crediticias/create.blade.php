@extends('layouts.admin')
@section('content')
    <h5 class="col-12 titulo_general_funcion">Registrar: Entidad Crediticia</h5>
    <div class="mt-4 card">
          <div class="card-body">
            <form method="POST" action="{{ route('admin.entidades-crediticias.store') }}">
                @csrf
                @include('admin.recursos-humanos.entidades-crediticias._form')
            </form>
        </div>
    </div>



@endsection

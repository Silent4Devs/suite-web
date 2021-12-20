@extends('layouts.admin')
@section('content')

    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">
            <h3 class="mb-1 text-center text-white"><strong> Editar: </strong> Entidad crediticia</h3>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.entidades-crediticias.update', $entidadCrediticia) }}">
                @csrf
                @method('PUT')
                @include('admin.recursos-humanos.entidades-crediticias._form')
            </form>
        </div>
    </div>



@endsection

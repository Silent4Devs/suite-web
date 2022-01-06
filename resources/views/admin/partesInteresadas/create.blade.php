@extends('layouts.admin')
@section('content')


    {{ Breadcrumbs::render('admin.partes-interesadas.create') }}



    <div class="mt-4 card">
        <div class="py-3 col-md-10 col-sm-9 card-body verde_silent align-self-center" style="margin-top: -40px;">

            <h3 class="mb-1 text-center text-white"> <strong>Registrar:</strong> Partes Interesadas </h3>

        </div>

        <div class="card-body">
            @livewire('partes-interesadas-component', ['clausulas' => $clausulas])
        </div>
    </div>



@endsection

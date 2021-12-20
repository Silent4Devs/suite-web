@extends('layouts.admin')
@section('content')

    {{ Breadcrumbs::render('admin.competencia.index') }}

    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Competencias</strong></h3>
        </div>

        <div class="card-body">
            @livewire('buscar-c-v-component', ['areas' => $areas,'isPersonal'=>false])
        </div>
    </div>




@endsection

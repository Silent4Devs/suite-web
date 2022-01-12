@extends('layouts.admin')
<style>
    .breadcrumb {
        margin-bottom: 10px !important;
    }
    .datos_der_cv{
        color: #fff;
    }

</style>
@section('content')

    {{ Breadcrumbs::render('Mi-CV', $empleado) }}
    <div class="card">
        {{-- <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Competencias</strong></h3>
        </div> --}}

        <div class="card-body">
            <div class="mt-4 text-center form-group" style="background-color:#345183; border-radius: 100px; color: white;">
                CURRICULUM VITAE
            </div>
            @livewire('buscar-c-v-component',['isPersonal'=>true,'empleadoModel'=>$empleado])
        </div>
    </div>




@endsection

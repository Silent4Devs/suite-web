@extends('layouts.admin')
@section('content')
    <div class="mt-5 card">

        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Matriz Riesgo
                </strong></h3>
        </div>
        <div class="px-1 py-2 mx-3 rounded shadow" style="background-color: #DBEAFE; border-top:solid 3px #3B82F6;">
            <div class="row w-100">
                <div class="text-center col-1 align-items-center d-flex justify-content-center">
                    <div class="w-100">
                        <i class="fas fa-info-circle" style="color: #3B82F6; font-size: 22px"></i>
                    </div>
                </div>
                <div class="col-11">
                    <p class="m-0" style="font-size: 16px; font-weight: bold; color: #1E3A8A">Instrucciones</p>
                    <p class="m-0" style="font-size: 14px; color:#1E3A8A ">Por favor, Seleccione opciones para mostrar sus
                        datos</p>
                </div>
            </div>
        </div>
        @include('partials.flashMessages')
        <div class="card-body">
            <div class="container">
                @livewire('matriz-heatmap', ['id_analisis' => $id])
            </div>
        </div>
    </div>

@endsection

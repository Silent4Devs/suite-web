@extends('layouts.admin')
@section('content')
    <div class="mt-5 card">
        <div class="py-3 col-md-10 col-sm-9 card card-body bg-primary align-self-center " style="margin-top:-40px; ">
            <h3 class="mb-2 text-center text-white"><strong>Creación de Reporte - Contexto</strong></h3>
        </div>
        <div class="card-body datatable-fix">
            @livewire('generar-pdf-component')
        </div>
    </div>
@endsection
@section('scripts')

@endsection

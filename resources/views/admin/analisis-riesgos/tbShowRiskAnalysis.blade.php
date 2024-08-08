@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/templateAnalisisRiesgo/sections.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/global/tbButtons.css') }}">
@endsection
@section('content')
{{-- <style>
    h6 {
        margin:0px;
    }
    .tb-btn-primary:hover {
        color:#006DDB;
    }
</style> --}}
<style>
    .custom-title{
        font-size: 20px;
    }
    .swal2-cancel.custom-cancel-button {
        background-color: #FFFFFF !important; /* Cambia el color de fondo */
        color: #006DDB !important; /* Cambia el color del texto */
        border: 1px solid #0069D2 !important;
        border-radius: 5px !important; /* Ajusta el radio de borde */
        padding: 10px 20px !important; /* Ajusta el relleno */
        font-size: 16px !important; /* Cambia el tamaño de la letra */
    }
    .caja-options{
    z-index: 1;
    width: 180px !important;
    padding: 10px;
    margin-bottom: 0px;
    margin-right: 30px;
    right: 55px;
    margin-top: -40px;
    /* top:10px; */
    /* top: 45px; */
    }

    .options .caja-options {
        display: none;
    }

    .options:hover .caja-options {
    display: flex;
    }

    .icon-option{
        font-size: 20px;
    }
</style>
    <div class="mt-4 card card-body shadow-sm">
        <h4 style="margin: 0px;">Análisis de riesgo: {{$riskAnalysis->name}}</h4>
        <hr style="margin-top: 10px;">
        <div style="display:flex; flex-direction: row; gap:120px; align-items:center;">
            <h6>{{$riskAnalysis->fecha}}</h6>
            <h6>nombre</h6>
            <h6>{{$riskAnalysis->norma->norma}}</h6>
            <div style="position:absolute; right:77px;">
                <div style="flex-direction: row; display:flex; align-items:center; gap:10px">
                    <h6>Responsable</h6>
                    <img class="img_empleado" src="{{ asset('storage/empleados/imagenes') }}/{{$riskAnalysis->elaboro->foto}}"/>
                </div>
            </div>


        </div>

    </div>
    @livewire('analisis-riesgos.form-risk-analysis', ['RiskAnalysisId' => $riskAnalysisId])
@endsection




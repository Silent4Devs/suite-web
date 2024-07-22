@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/templateAnalisisRiesgo/sections.css') }}">
@endsection
@section('content')
<style>
    h6 {
        margin:0px;
    }
    .tb-btn-primary:hover {
        color:#006DDB;
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



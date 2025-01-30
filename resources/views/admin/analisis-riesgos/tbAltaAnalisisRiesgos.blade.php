@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/riskAnalysis/riskAnalysis.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/templateAnalisisRiesgo/inputFile.css') }}">
@endsection
@section('content')
    @livewire('analisis-riesgos.risk-analysis')
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
@endsection

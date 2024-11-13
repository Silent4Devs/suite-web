@extends('layouts.admin')
@section('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/riskAnalysis/riskAnalysis.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/templateAnalisisRiesgo/inputFile.css') }}">
@endsection
@section('content')
    @livewire('analisis-riesgos.risk-analysis')
@endsection
